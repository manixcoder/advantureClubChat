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
use Illuminate\Validation\Rule;
use Session;
use Response;
use App\Category;
use App\Brand;
use App\User;
use App\Models\Promocode;
use DB;
use Hash;
use Auth;

class PromocodeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }

  /* Users Listing Starts */
  function list_promocode()
  {
    $promocodeData = DB::table('promocode')
      ->select('promocode.*')
      ->where(['promocode.deleted_at' => NULL])
      ->get();
    $data['content'] = 'admin.promocode.list_promocode';

    return view('layouts.content', compact('data'))
      ->with([
        'promocodeData' => $promocodeData
      ]);
  }
  /* Adventure Users listing ends */

  /* Add new Promocode starts */
  public function add_promocode(Request $request)
  {  //echo"<pre>";print_r($request->all());exit;

    if ($request->post()) {

      $rules =  [
        'promocode_name'      => 'required|min:4|max:12|unique:promocode,promocode_name' . ($request->edit_id ? ",$request->edit_id" : ''),
        'code'                => 'required|min:8|unique:promocode' . ($request->edit_id ? ",id,$request->edit_id" : ''),
        'discount_type'       => 'required',
        'discount_amount'     => 'required',
        'redeemed_count'      => 'required',
        'start_date'          => 'required|before:end_date',
        'end_date'            => 'required',
        'description'         => 'required'
      ];
      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        $validation = array();
        foreach ($validator->messages()->getMessages() as $field_name => $messages) {
          $validation[$field_name] = $messages[0];
        }
        $data['content'] = 'admin.promocode.add_promocodes';
        return view('layouts.content', compact('data'))
          ->with([
            'validation' => $validation ?? []
          ]);
      } else {
        $request->start_date = date("Y-m-d", strtotime($request->start_date));
        $request->end_date = date("Y-m-d", strtotime($request->end_date));
        $data = array(
          'promocode_name'        => !empty($request->promocode_name) ? $request->promocode_name : '',
          'code'                  => !empty($request->code) ? $request->code : '',
          'discount_type'         => !empty($request->discount_type) ? $request->discount_type : '',
          'discount_amount'       => !empty($request->discount_amount) ? $request->discount_amount : '',
          'redeemed_count'        => !empty($request->redeemed_count) ? $request->redeemed_count : '',
          'start_date'            => !empty($request->start_date) ? $request->start_date : '',
          'end_date'              => !empty($request->end_date) ? $request->end_date : '',
          'description'           => !empty($request->description) ? $request->description : '',
        );


        if ($request->edit_id != '') { // echo"33".$request->edit_id;
          Session::flash('success', 'Updated successfully..!');
          $updateData = DB::table('promocode')
            ->where('id', $request->edit_id)
            ->update($data);
          return back();
        } else {
          Session::flash('success', 'Inserted successfully..!');
          $insertData = DB::table('promocode')
            ->insert($data);
          return redirect('/add-promocodes');
        }
      }
    }
  }

  /* View Adventure users starts */
  public function view_adventure_user($id)
  {
    //$editdata = User::where('id', $id)->first();
    $editdata = DB::table('Users')
      ->rightjoin('countries', 'users.country_id', '=', 'countries.country_id')
      ->rightjoin('region', 'users.country_id', '=', 'region.country_id')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.adventure_users.view_adventure_user';
    return view('layouts.content', compact('data'))
      ->with([
        'editdata' => $editdata
      ]);
  }

  /* View Adventure users ends */

  // public function edit_promocode($id)
  // {
  //     $editData = DB::table('promocode')->where('id', $id)->first();

  //     $data['content'] = 'admin.promocode.add_promocode';
  //     return view('layouts.content', compact('data'))->with(['editData' => $editData ]);
  // }



  /* Update status in db from ajax request starts */
  public function update_promo_status($id)
  {
    $Data = array(
      'id' => $_GET['id'],
      'status' => $_GET['status'],
    );
    $edituserData = DB::table('promocode')
      ->where('id', $id)
      ->update($Data);
    return response()->json(array('msg' => $edituserData), 200);
  }
  /* Update status ends */

  /* soft delete starts */
  public function delete_promo(Request $request, $id)
  {
    $promo = Promocode::find($id);
    if ($promo) {
      $destroy = Promocode::destroy($id);
      $request->session()->flash('success', 'Promocode has been deleted successfully.');
    } else {
      $request->session()->flash('error', 'Something went wrong. Please try again.');
    }
    return redirect()->back();
  }
  /* soft delete ends */
}
