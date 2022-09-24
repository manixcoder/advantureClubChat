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

class ServiceController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }

  /* Service Functions start */
  public function add_service(Request $request)
  {
    /* print_r($request->all()); die;*/
    $data = array(
      'AdminId' => Session::get('user_id'),
      'Name' => $request->service_name,
      'Description' => $request->Description,
    );

    if ($request->ids != '') {
      Session::flash('success', 'Updated successfully..!');
      $updateData = DB::table('Services')
        ->where('id', $request->ids)
        ->update($data);
      return redirect('service');
    } else {
      Session::flash('success', 'Inserted successfully..!');
      $insertData = DB::table('Services')
        ->insert($data);
      return redirect('service');
    }
  }

  public function view_service()
  {
    $servicedata = DB::table('Services')
      ->orderBy('id', 'Desc')
      ->get();

    $data['content'] = 'admin.service.manage_service';
    return view('layouts.content', compact('data'))
      ->with([
        'servicedata' => $servicedata
      ]);
  }

  public function service_edit($id)
  {
    $data = DB::table('services')
      ->where('id', $id)
      ->first();
    return Response::json($data);
  }

  public function delete_service($id)
  {
    $delete = DB::table('Services')
      ->where('id', $id)
      ->delete();
    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }
  /* Service Functions End */

  /* Service Category Functions Start */
  public function view_service_category()
  {
    $servicecategorydata = DB::table('Service_Category')
      ->get();

    $data['content'] = 'admin.service.manage_service_category';
    return view('layouts.content', compact('data'))
      ->with([
        'servicecategorydata' => $servicecategorydata
      ]);
  }

  public function add_service_category(Request $request)
  {
    $data = array(
      'Service_Id' => $request->Service_Id,
      'Name' => $request->Name,
      'Description' => $request->Description,
    );

    if ($request->ids != '') {
      Session::flash('success', 'Updated successfully..!');
      $updateData = DB::table('Service_Category')
        ->where('id', $request->ids)
        ->update($data);
      return back();
    } else {
      Session::flash('success', 'Inserted successfully..!');
      $insertData = DB::table('Service_Category')
        ->insert($data);
      return back();
    }
  }

  public function service_category_edit($id)
  {
    $data = DB::table('Service_Category')
      ->where('id', $id)
      ->first();
    return Response::json($data);
  }

  public function delete_service_category($id)
  {
    $delete = DB::table('Service_Category')
      ->where('Id', $id)
      ->delete();
    $productdelete = DB::table('home_products')
      ->where('home_cat_id', $id)
      ->get();
    $Service_Category_ActivityType = DB::table('Service_Category_ActivityType')
      ->where('Service_Category_Id', $id)
      ->get();
    $shopproduct = DB::table('shopproduct')
      ->where('ProductCategoryId', $id)
      ->get();

    foreach ($shopproduct as $data3) {
      $delete_shopproduct = DB::table('shopproduct')
        ->where('ProductCategoryId', $id)
        ->delete();
    }

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
  /* Service Category Functions End */

  /* Service Category Activity Functions Start */
  public function view_service_activity()
  {
    $serviceactivity_data = DB::table('Service_Category_ActivityType')
      ->orderBy('id', 'Desc')
      ->get();

    $data['content'] = 'admin.service.manage_service_activitytype';
    return view('layouts.content', compact('data'))
      ->with([
        'serviceactivity_data'    => $serviceactivity_data
      ]);
  }

  public function add_service_activitytype(Request $request)
  {
    /* print_r($request->all()); die;*/
    $data = array(
      'Service_Id'            => $request->Service_Id,
      'Service_Category_Id'   => $request->Service_Category_Id,
      'Name'                  => $request->Name,
    );

    if ($request->ids != '') {
      Session::flash('success', 'Updated successfully..!');
      $updateData = DB::table('Service_Category_ActivityType')
        ->where('id', $request->ids)
        ->update($data);
      return back();
    } else {
      Session::flash('success', 'Inserted successfully..!');
      $insertData = DB::table('Service_Category_ActivityType')
        ->insert($data);
      return back();
    }
  }

  public function service_activitytype_edit($id)
  {
    $data = DB::table('Service_Category_ActivityType')
      ->where('id', $id)
      ->first();
    return Response::json($data);
  }

  public function delete_service_activity($id)
  {
    $delete = DB::table('Service_Category_ActivityType')
      ->where('Id', $id)
      ->delete();

    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }
  /* Service Category Activity Functions Start */
}
