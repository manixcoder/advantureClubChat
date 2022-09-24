<?php
/*
  Session::get('user_id')
  Session::get('userRole')
*/

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
use App\User;
use DB;
use Hash;
use Auth;

class ShopProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }
  /* Shop Product Functions start */
  public function admin_approvel($id)
  {
    $productdata = DB::table('home_products')
      ->where('id', $id)
      ->first();
    if ($productdata->status = 1) {
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
    return back();
  }

  public function add_shop_product(Request $request)
  {
    /*print_r($request->all()); die; */
    if ($files = $request->ProductImage) {
      $destinationPath    = public_path('/shop_product_image/');
      $profileImage       = date('YmdHis') . "-" . $files->getClientOriginalName();
      $path               =  $files->move($destinationPath, $profileImage);
      $image              = $insert['photo'] = "$profileImage";
    }
    if ($request->ProductImage != '') {
      $data = array(
        'CreatorVendorId'     => Session::get('user_id'),
        'ProductName'         => $request->ProductName,
        'ProductPrice'        => $request->ProductPrice,
        'CurrencyId'          => $request->CurrencyId,
        'ProductCategoryId'   => $request->ProductCategoryId,
        'ProductDescription'  => $request->ProductDescription,
        'ProductCreatedDate'  => date('Y-m-d H:i'),
        'ProductImage'        => $image ?? '',
      );
    } else {
      $data = array(
        'CreatorVendorId'     => Session::get('user_id'),
        'ProductName'         => $request->ProductName,
        'ProductPrice'        => $request->ProductPrice,
        'CurrencyId'          => $request->CurrencyId,
        'ProductCategoryId'   => $request->ProductCategoryId,
        'ProductDescription'  => $request->ProductDescription,
        'ProductCreatedDate'  => date('Y-m-d H:i'),
      );
    }

    if ($request->edit_id != '') {
      $updateData = DB::table('ShopProduct')
        ->where('id', $request->edit_id)
        ->update($data);
      Session::flash('success', 'Updated successfully..!');
      return redirect('shop-product');
    } else {
      $insertData = DB::table('ShopProduct')
        ->insertgetId($data);
      Session::flash('success', 'Inserted successfully..!');
      return redirect('shop-product');
    }
  }

  public function shop_product_listing()
  {
    if (Session::get('userRole') == 1) {
      $shopproductdata = DB::table('ShopProduct')
        ->orderBy('id', 'desc')
        ->get();
    } else {
      $shopproductdata = DB::table('ShopProduct')
        ->orderBy('id', 'desc')
        ->where('CreatorVendorId', Session::get('user_id'))
        ->get();
    }

    $data['content'] = 'admin.shop_product.manage_shop_product';
    return view('layouts.content', compact('data'))
      ->with([
        'shopproductdata' => $shopproductdata
      ]);
  }

  public function edit_shop_product($id)
  {
    $shop_product_edit = DB::table('ShopProduct')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.shop_product.edit_shop_products';
    return view('layouts.content', compact('data'))
      ->with([
        'shop_product_edit' => $shop_product_edit
      ]);
  }

  public function view_shop_product($id)
  {
    $shop_product_view_data = DB::table('ShopProduct')
      ->where('id', $id)
      ->first();

    $data['content']    = 'admin.shop_product.view_shop_product';
    return view('layouts.content', compact('data'))->with([
        'shop_product_view_data' => $shop_product_view_data
      ]);
  }

  public function delete_shop_product($id)
  {
    $delete = DB::table('ShopProduct')
      ->where('id', $id)
      ->delete();
    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }

  /* Product Functions End */
}
