<?php

/*Session::get('user_id')
Session::get('userRole')*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Session;
use Response;
use App\Category;
use App\Brand;
use App\Products;
use App\User;
use DB;
use Hash;
use Auth;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }
  /* Product Functions start */
  public function edit_product_image(Request $request)
  {
    /*print_r($request->all()); die;*/
    if ($files = $request->image) {
      $destinationPath = public_path('/product_image/');
      $profileImage = date('YmdHis') . "-" . $files->getClientOriginalName();
      $path =  $files->move($destinationPath, $profileImage);
      $image = $insert['photo'] = "$profileImage";
    }

    if ($request->ids != '') {
      $updateData = DB::table('home_products_gallery')
        ->where('id', $request->ids)
        ->update([
          'image' => $image
        ]);
      session()->flash('success', 'Image Update successfully..!');
      return back();
    } else {
      $insertData = DB::table('home_products_gallery')
        ->insertgetId([
          'image' => $image,
          'home_product_id' => $request->product_id
        ]);
      session()->flash(
        'success',
        'Image Add successfully..!'
      );
      return back();
    }
  }

  public function activityImg_detele($id)
  {
    $delete = DB::table('home_products_gallery')
      ->where('id', $id)
      ->delete();
    session()->flash(
      'error',
      'Deleted Successfully..!'
    );
    return redirect()->back();
  }

  public  function product_image_edit($id)
  {
    $data = DB::table('home_products_gallery')
      ->where('id', $id)
      ->first();
    return Response::json($data);
  }
  public function admin_approvel($id)
  {
    $productdata = DB::table('home_products')
      ->where('id', $id)
      ->first();
    if ($productdata->status == 1) {
      $updateData = DB::table('home_products')
        ->where('id', $id)
        ->update([
          'status' => 0
        ]);
    } else {
      $updateData = DB::table('home_products')
        ->where('id', $id)
        ->update([
          'status' => 1
        ]);
    }
    session()->flash('success', 'Status Update successfully..!');
    return back();
  }

  public function add_product(Request $request)
  {
    /*print_r($request->all()); die;*/
    $ServiceRequestType = implode(',', $request->ServiceRequestType);
    $Dependency = implode(',', $request->DependencyId);
    $AimedId = implode(',', $request->AimedId);
    $advprograms_ids = implode(',', $request->advprograms_ids);

    $data = array(
      'creator_id'            => Session::get('user_id'),
      'title'                 => $request->title,
      'AimedId'               => $AimedId,
      'ServiceRequestType'    => $ServiceRequestType,
      'DependencyId'          => $Dependency,
      'advprograms_ids'       => $advprograms_ids,
      'home_cat_id'           => $request->home_cat_id,
      'CountryId'             => $request->CountryId,
      'ServiceId'             => $request->ServiceId,
      'Level_Id'              => $request->Level_Id,
      'RegionId'              => $request->RegionId,
      'short_description'     => $request->short_description,
      'description'           => $request->description,
      'fitness_requirement'   => $request->fitness_requirement,
      'start_date'            => $request->start_date,
      'end_date'              => $request->end_date,
      'lattitude'             => $request->lattitude,
      'longitude'             => $request->longitude,
      'price'                 => $request->price,
      'Include_Gear_Price'    => $request->Include_Gear_Price,
      'Exclude_Gear_Price'    => $request->Exclude_Gear_Price,
      'Available_Seats'       => $request->Available_Seats,
      'status'                => 1,
    );

    if ($request->edit_id != '') {
      $updateData = DB::table('home_products')
        ->where('id', $request->edit_id)
        ->update($data);
      Session::flash('success', 'Updated successfully..!');
      return redirect('product');
    } else {
      $insertData = DB::table('home_products')
        ->insertgetId($data);

      if ($files = $request->file('image')) {
        $destinationPath = public_path('/product_image/'); // upload path
        foreach ($files as $img) {
          $profileImage = date('YmdHis') . "-" . $img->getClientOriginalName();
          $path =  $img->move($destinationPath, $profileImage);
          $image = $insert['photo'] = "$profileImage";
          $data = array(
            'home_product_id' => $insertData,
            'image' => $image
          );
          $insertIamge = DB::table('home_products_gallery')
            ->insert($data);
        }
      }
      Session::flash('success', 'Inserted successfully..!');
      return redirect('product');
    }
  }

  public function product_listing()
  {
    if (Session::get('userRole') == 1) {
      $productdata = DB::table('home_products')
        ->orderBy('id', 'desc')
        ->get();
    } else {
      $productdata = DB::table('home_products')
        ->orderBy('id', 'desc')
        ->where('creator_id', Session::get('user_id'))
        ->get();
    }

    $data['content'] = 'admin.product.manage_product';
    return view('layouts.content', compact('data'))
      ->with([
        'productdata' => $productdata
      ]);
  }

  public function product_edit($id)
  {
    $product_view_data = DB::table('home_products')
      ->where('id', $id)
      ->first();

    /*print_r($product_view_data); die;*/

    $data['content'] = 'admin.product.edit_products';
    return view('layouts.content', compact('data'))
      ->with([
        'product_view_data' => $product_view_data
      ]);
  }

  public function product_view($id)
  {
    $product_view_data = DB::table('home_products')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.product.view_product';
    return view('layouts.content', compact('data'))
      ->with([
        'product_view_data' => $product_view_data
      ]);
  }

  public function delete_product($id)
  {
    $delete = DB::table('home_products')
      ->where('id', $id)
      ->delete();
    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }

  public function get_service_category($serviceid)
  {
    $data = DB::table('Service_Category')
      ->where('Service_Id', $serviceid)
      ->get();
    return response()->json($data);
  }

  public function get_service_activity($service_cat_id)
  {
    $data = DB::table('Service_Category_ActivityType')
      ->where('Service_Category_Id', $service_cat_id)
      ->get();
    /* print_r($data); die;*/
    return response()
      ->json($data);
  }
  /* Product Functions End */
}
