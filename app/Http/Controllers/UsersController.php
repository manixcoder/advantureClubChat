<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countrie;
use Session;
use Response;
use DB;
use Hash;
use Auth;

class UsersController extends MyController
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }

  public function vendors(Request $request, $id = null)
  {
    $where = ' 19 ';
    if ($id) {
      $where .= ' && srvc.id = ' . $id;
    }
    $services= DB::table('become_partner as bp')
    ->select(
      'bp.*',
      'cntri.country', 
      'pk.title',
      'bp.created_at as request_date',
      'u.name',
      'u.id as user_id'
    )
    ->leftJoin('users as u','bp.user_id','=','u.id')
    ->leftJoin('countries as cntri','cntri.id','=', 'u.country_id')
    ->leftJoin('packages as pk','pk.id','=','bp.packages_id')
    ->where([
      'u.deleted_at' => NULL,
      'u.status' => '1'
    ])
    ->get();
    //dd($services);
    $data['content'] = 'admin.services.vendor_request';
    return view('layouts.content', compact('data'))
    ->with([
      'services' => $services
    ]);
  }

  public function role_access()
  {
    $data['content'] = 'admin.roleaccess';
    return view('layouts.content', compact('data'))
      ->with([
        'usersdata' => ''
      ]);
  }


  public function save_country_session(Request $request)
  {
    $country_id = $_POST['country'];
    Session::put('country_id', $country_id);
    $arrayVal = $request->checkbox;
    // echo $country_id.'--->'. print_r($arrayVal);die;
    $sort = 0;
    if (!empty($arrayVal)) {
      foreach ($arrayVal as $Val) {
        $role_exist = DB::table('role_assignments')
        ->where('country_id', $country_id)
        ->where('role_id', $Val)
        ->count();
        if ($role_exist == 0) {
          $datass = array(
            'country_id' => $country_id,
            'role_id' => $Val,
            'sort' => $sort,
          );
          $addData = DB::table('role_assignments')->insertGetId($datass);
        }
      }
    }



    return redirect()->back();
  }


  public function get_roles(Request $request)
  {
    //  echo '123';die;
    $country_id = $_POST['country'];
    Session::put('country_id', $country_id);
    return redirect()->back();
  }
  public function partnershipDecline(Request $request,$id){
   // dd($id);
    $services= DB::table('become_partner')->where('user_id',$id)->update([
      'is_approved'=>'0'
    ]);
     Session::flash('success', 'Partnership Decline successfully.');
    return redirect()->back();
  }
  public function partnershipAccept(Request $request,$id){
   // dd($id);
     $services= DB::table('become_partner')->where('user_id',$id)->update([
      'is_approved'=>'1'
    ]);
     Session::flash('success', 'Partnership Accept successfully.');
     return redirect()->back();
  }

}
