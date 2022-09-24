<?php

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

class CategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }

  /* Product Functions start */
  public function add_category(Request $request)
  {
    /*
    print_r($request->all()); die;
    */
    if ($files = $request->image) {
      $destinationPath = public_path('/category_image/');
      $profileImage = date('YmdHis') . "-" . $files->getClientOriginalName();
      $path =  $files->move($destinationPath, $profileImage);
      $image = $insert['photo'] = "$profileImage";
    }
    if ($request->image != '') {
      $data = array(
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'image' => $image,
      );
    } else {
      $data = array(
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
      );
    }
    if ($request->ids != '') {
      Session::flash('success', 'Updated successfully..!');
      $updateData = DB::table('home_categories')
        ->where('id', $request->ids)
        ->update($data);
      return redirect('category');
    } else {
      Session::flash('success', 'Inserted successfully..!');
      $insertData = DB::table('home_categories')
        ->insert($data);
      return redirect('category');
    }
  }

  public function view_category()
  {
    $categorydata = DB::table('home_categories')
      ->get();

    $data['content'] = 'admin.category.manage_category';
    return view('layouts.content', compact('data'))
      ->with([
        'categorydata' => $categorydata
      ]);
  }

  public function category_edit($id)
  {
    $editdata = DB::table('home_categories')
      ->where('id', $id)
      ->first();
    $data['content'] = 'admin.category.edit_category';
    return view('layouts.content', compact('data'))
      ->with([
        'editdata' => $editdata
      ]);
  }

  public function product_view($id)
  {
    $editdata = DB::table('products')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.product.view_product';
    return view('layouts.content', compact('data'))->with(['editdata' => $editdata]);
  }

  public function delete_category($id)
  {
    $delete = DB::table('home_categories')
      ->where('id', $id)
      ->delete();
    $productdelete = DB::table('home_products')
      ->where('home_cat_id', $id)
      ->get();
    $Service_Category_ActivityType = DB::table('Service_Category_ActivityType')
      ->where('Service_Category_Id', $id)
      ->get();

    foreach ($Service_Category_ActivityType as $data2) {
      $deleteproduct = DB::table('Service_Category_ActivityType')
        ->where('Service_Category_Id', $id)
        ->delete();
    }

    foreach ($productdelete as $data) {
      $deleteproduct = DB::table('home_products')
        ->where('home_cat_id', $id)
        ->delete();
    }

    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }

  public function useremail($y)
  {
    $data = User::where('email', $y)
      ->first();
    if ($data != '') {
      return Response::json($data);
    }
  }
}
