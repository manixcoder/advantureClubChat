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
use App\Models\Users;
use Session;
use Response;
use App\Category;
use App\Brand;
use App\User;
use DB;
use Hash;
use Auth;

class AdventurePartnersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }

  /* Users Listing Starts */
  function list_adventure_partners()
  {
    $usersdata = DB::table('users')->select('users.*', 'countries.country')
      ->join('countries', 'users.country_id', '=', 'countries.id')
      ->where('users.users_role', '2')
      ->where(['users.deleted_at' => NULL])
      ->get();

    $usersdata = DB::table('users as u')
      ->select(
        'u.*',
        'bp.user_id',
        'bp.company_name',
        'bp.address',
        'bp.location',
        'bp.description',
        'bp.license',
        'bp.cr_name',
        'bp.cr_number',
        'bp.cr_copy',
        'bp.debit_card',
        'bp.visa_card',
        'bp.payon_arrival',
        'bp.paypal',
        'bp.bankname',
        'bp.account_holdername',
        'bp.account_number',
        'bp.is_online',
        'bp.is_approved',
        'bp.packages_id',
        'bp.start_date',
        'c.country',
        'bp.end_date'
      )
      ->join('become_partner as bp', 'u.id', '=', 'bp.user_id')
      ->join('countries as c', 'c.id', '=', 'u.country_id')
      ->where('u.users_role', '2')
      ->where(['u.deleted_at' => NULL])
      ->get();
      //dd($usersdata);
      $complete_ser = DB::table('services')->select('services.*')
       ->whereRaw('DATE_FORMAT(services.end_date, "%Y-%m-%d") = "' . date('Y-m-d') . '"')
       ->count();
      //dd($complete_ser);
    $data['content'] = 'admin.adventure_partners.list_adventure_partners'; 
    return view('layouts.content', compact('data'))->with(['usersdata' => $usersdata,'complete_ser'=>$complete_ser]);
  }
  /* Adventure Users listing ends */
  /* Add new Adventure user starts */
  public function add_adventure_partner(Request $request)
  {
    //  dd($request->all());
    if ($request->post()) {
      $rules1 = [];
      $rules =  [
        'user_id'               => 'required',
        'subscription_id'       => 'required',
        'company_name'          => 'required',
        'company_address'       => 'required',
        'company_location'      => 'required',
        'payment_mode'          => 'required'
      ];
      if ($request->license_status == 1) {
        $rules1 = [
          'crName' => 'required',
          'crNumber' => 'required',
          'crCopy' => 'required',
        ];
      }
      $rules += $rules1;
      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        $validation = array();
        foreach ($validator->messages()->getMessages() as $field_name => $messages) {
          $validation[$field_name] = $messages[0];
        }
        $data['content'] = 'admin.adventure_partners.add_adventure_partners';
        return view('layouts.content', compact('data'))->with([
          'validation' => $validation ?? []
        ]);
      } else {
        $subscription = !empty($request->subscription) ? $request->subscription : '1';
        $packageData = DB::table('packages')
          //->where('id', $request->subscription)
          ->where('id', $subscription)
          ->orderBy('id', 'DESC')
          ->first();
        if ($packageData) {
          $day = $packageData->days - 1;
          $enddate = date('Y-m-d H:i:s', strtotime("+" . $day . " day", strtotime(date("Y-m-d H:i:s"))));
          if ($files = $request->image) {
            $destinationPath = public_path('/profile_image/');
            $profileImage = date('YmdHis') . "-" . $files->getClientOriginalName();
            $path =  $files->move($destinationPath, $profileImage);
            $image = $insert['photo'] = "$profileImage";
          }
          if ($file = $request->file('crCopy')) {
            $destinationPath = base_path('public/crCopy/');
            $cr_copy = uniqid('file') . "-" . $file->getClientOriginalName();
            $path = $file->move($destinationPath, $cr_copy);
          } else {
            $cr_copy = "";
          }

          // $request->merge([
          //   // 'health_conditions' => implode(',', (array) $request->get('health_condition')),
          //   'payment_modes' => implode(',', (array) $request->get('payment_mode'))
          // ]);

          $updateData = DB::table('users')->where('id', $request->user_id)->update([
            'users_role'        => '2',
          ]);
          if ($request->payment_mode == 'Bank Muskat') {
            $is_online = '1';
          } else {
            $is_online = '0';
          }
          if ($request->payment_mode == 'pay on arrival') {
            $payon_arrival = '1';
          } else {
            $payon_arrival = '0';
          }
          $companyData = array(
            'user_id'         => $request->user_id,
            'company_name'    => $request->company_name,
            'address'         => $request->company_address,
            'location'        => $request->company_location,
            'license'         => $request->license_status,
            'cr_name'         => !empty($request->crName) ? $request->crName : '',
            'cr_number'       => !empty($request->crNumber) ? $request->crNumber : '',
            'cr_copy'         => !empty($request->crCopy) ? $cr_copy : '',
            'is_online'       => $is_online,
            'payon_arrival'   => $payon_arrival,
            'packages_id'     => $subscription,
            'start_date'      => date("Y-m-d H:i:s"),
            //'end_date'        => $enddate,
            'created_at'      => date('Y-m-d H:i:s'),
          );
          $insertData1 = DB::table('become_partner')->insert($companyData);
          Session::flash('success', 'Partner created successfully..!');
          return redirect('/list-adventure-partners');
        } else {
          Session::flash('error', 'Select a valid package !');
          return redirect('/add-adventure-partners');
        }
      }
    }
  }
  /* Add New Adventure User ends */

  /* View Adventure users starts */
  public function viewAdventurePartner($id)
  {
    // dd($id);
    //$editdata = User::where('id', $id)->first();
    $healthConditionData = '';
    $pModeData = '';

    $editdata =  DB::table('users as u')

      ->join('become_partner as bp', 'u.id', '=', 'bp.user_id')
      ->select(
        'u.*',
        'bp.user_id',
        'bp.company_name',
        'bp.address',
        'bp.location',
        'bp.description',
        'bp.license',
        'bp.cr_name',
        'bp.cr_number',
        'bp.cr_copy',
        'bp.debit_card',
        'bp.visa_card',
        'bp.payon_arrival',
        'bp.paypal',
        'bp.bankname',
        'bp.account_holdername',
        'bp.account_number',
        'bp.is_online',
        'bp.is_approved',
        'bp.packages_id',
        'bp.start_date',
        'bp.end_date'
      )
      ->where('u.id', $id)
      ->first();
     // dd($editdata);
      if($editdata->nationality_id !='0'){
        $countriesData= DB::table('countries')->where('id',$editdata->nationality_id)->first();
        $editdata->country=$countriesData->short_name;
      }else{
        $editdata->country='';
      }
      
      // dd($editdata);
      $healthConditionData = array();
      if (!empty($editdata->health_conditions)) {
        $hCondition = explode(",", $editdata->health_conditions);
        $healthConditionData = DB::table('health_conditions')->select('health_conditions.*')->wherein('health_conditions.id', $hCondition)->get();
      } else {
        $healthConditionData = array();
      }
      $subscriptionData = array();
      if (!empty($editdata->subscription_id)) {
        $subscriptionData = DB::table('packages')->select('packages.*')->where('packages.id', $editdata->subscription_id)->get();
      } else {
        $subscriptionData = array();
      }
      $pModeData = array();
      if (!empty($editdata->payment_mode)) {
        $pMode = explode(",", $editdata->payment_mode);
        $pModeData = DB::table('get_all_paymentmode')
        ->select('get_all_paymentmode.*')
        ->wherein('get_all_paymentmode.id', $pMode)
        ->get();
      } else {
        $pModeData = array();
      }
      $services = DB::table('services as srvc')
      ->select([
        'srvc.*',
        'usr.name as provider_name',
        DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
        'scat.category as service_category',
        'ssec.sector as service_sector',
        'styp.type as service_type',
        'slvl.level as service_level',
        'cntri.country',
        'cntri.currency as currency_sign',
        'rgns.region'
      ])
      ->join('users as usr', 'usr.id', '=', 'srvc.owner')
      ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
      ->leftJoin('regions as rgns', 'rgns.id', '=', 'srvc.region')
      ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
      ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
      ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
      ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
      ->where([
        'srvc.deleted_at' => NULL,
        'srvc.owner'=>$id
      ])
      ->orderBy('srvc.id', 'DESC')
      ->get();
    $service_ids = array_column($services->toArray(), 'id');
    //dd($service_ids);

    
    
    $participants = DB::table('bookings')
      ->select(['service_id', DB::raw("COUNT(id) AS service_count")])
      ->whereIn('service_id', $service_ids)
      ->groupBy('service_id')
      ->get();
    $parti_array = [];
    if (!$participants->isEmpty()) {
      foreach ($participants as $key => $part) {
        $parti_array[$part->service_id] = $part->service_count;
      }
    }
    foreach ($services as $key => $ser) {
      $purchases = DB::table('bookings')
      ->where('bookings.service_id', '=', $ser->id)
      ->sum('bookings.total_amount');
      $services[$key]->totalAmount = $purchases;
    }

    foreach ($services as $key => $ser) {
      $unitAmount = DB::table('bookings')
      ->where('bookings.service_id', '=', $ser->id)
      ->sum('bookings.unit_amount');;
      $services[$key]->unit_amount = $unitAmount;
    }
    foreach ($services as $key => $ser) {
      $services[$key]->participants = $parti_array[$ser->id] ?? 0;
    }
    $bookings = DB::table('bookings as bkng')
            ->select([
                'bkng.id as booking_id',
                'srvc.id',
                'srvc.id as service_id',
                'cntri.country',
                'rgn.region',
                'srvc.adventure_name',
                'usr.name as provider_name',
                'client.id as client_id',
                'client.name as customer',
                'client.nationality_id as nationality_id',
                'client.profile_image',
                'bkng.booking_date as service_date',
                'bkng.created_at as booked_on',
                'bkng.adult',
                'bkng.kids',
                'bkng.unit_amount as unit_cost',
                'bkng.total_amount as total_cost',
                'pmnt.payment_method as payment_channel',
                'client.dob',
                'client.Height',
                'client.Weight',
                'client.profile_image',
                'bkng.message',
                'bkng.created_at as required_at',
                'srvc.start_date',
                'srvc.end_date',
                'bkng.status', 
                'bkng.payment_status',
                DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status_text"),
                DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status_text"),
                'catg.category'
            ])
            ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
            ->leftJoin('service_categories as catg', 'catg.id', '=', 'srvc.service_category')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('users as client', 'client.id', '=', 'bkng.user_id')
            ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
            ->whereIn('bkng.service_id', $service_ids)
            ->orderBy('bkng.id', 'DESC')
            ->get();


            $reviews = DB::table('service_reviews')
            ->select([
              '*',
             // DB::raw("AVG(star) AS stars"),
            ])
            ->whereIn('service_id', $service_ids)
            ->get();
            //dd($reviews);
            $ratingStart=0;
            foreach($reviews as $review){
              $ratingStart +=$review->star;
            }
            if(!$reviews->isEmpty()){
              $stars = $ratingStart/count($reviews);
            }else{
              $stars = 0;
            }
            
            $data['content'] = 'admin.adventure_partners.view_adventure_partner';
            return view('layouts.content', compact('data'))->with([
              'editdata' => $editdata,
              'healthConditionData' => $healthConditionData,
              'pModeData' => $pModeData,
              'services' => $services,
              'bookings' => $bookings,
              'subscriptionData' => $subscriptionData,
              'starRating'=>$stars,
              'numberofreview'=>count($reviews),
              
            ]);
  }

  /* View Adventure users ends */

  // public function getService() {
  //     $services = DB::table('services as srvc')
  //     ->select(['srvc.*', 'usr.name as provider_name', DB::raw("CONCAT(srvc.duration,' Min') AS duration"), 'scat.category as service_category', 'ssec.sector as service_sector', 'styp.type as service_type', 'slvl.level as service_level', 'cntri.country', 'crnci.sign as currency_sign', 'rgns.region'])
  //     ->join('users as usr', 'usr.id', '=', 'srvc.owner')
  //     ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
  //     ->leftJoin('regions as rgns', 'rgns.id', '=', 'srvc.region')
  //     ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
  //     ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
  //     ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
  //     ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
  //     ->leftJoin('currencies as crnci', 'crnci.id', '=', 'srvc.currency')
  //     ->where(['srvc.deleted_at' => NULL])
  //     ->orderBy('srvc.id', 'DESC')
  //     ->get();
  //   $service_ids = array_column($services->toArray(), 'id');
  //   $data['content'] = 'admin.adventure_partners.view_adventure_partner';
  //   return view('layouts.content', compact('data'))->with(['editdata' => $editdata ,'healthConditionData'=>$healthConditionData,'pModeData'=>$pModeData]);
  // }

  /* Update status in db from ajax request starts */
  public function update_user_status($id, $status)
  {
    $Data = array(
      'id' => $_GET['id'],
      'status' => $_GET['status'],
    );
    $edituserData = DB::table('users')
    ->where('id', $id)
    ->update($Data);
    DB::table('become_partner')
      ->where('user_id', $id)
      ->update([
        'is_approved' => '1',
      ]);
    DB::table('notifications')->insert([
      'sender_id' => Auth::user()->id,
      'user_id' => $id,
      'title' => 'Your request has been approved.',
      'message' => 'Now you may proceed to buy your subscription package & will be able to provide your service.',
      'is_approved' => '0'
    ]);
    if ($_GET['become'] == '1') {
      DB::table('become_partner')
        ->where('user_id', $id)
        ->update([
          'is_approved' => '1',
        ]);
      DB::table('notifications')->insert([
        'sender_id' => Auth::user()->id,
        'user_id' => $id,
        'title' => 'Your request has been approved.',
        'message' => 'Now you may proceed to buy your subscription package & will be able to provide your service.',
        'is_approved' => '0'
      ]);
    }
    return response()->json(array('msg' => $edituserData), 200);
  }
  public function update_partner_status($id)
  {
    if ($_GET['status'] === '1') {
      $statusMsg = 'approved';
      $is_approved = '1';
    } else {
      $is_approved = '0';
      $statusMsg = 'Unapproved';
    }
    // $partnerData = DB::table('become_partner')->where('user_id', $id)->get();
    // //  dd($partnerData);
    // if (!$partnerData->isEmpty()) {
    $update = array(
      'is_approved' => $_GET['status']
    );
    $approveData = DB::table('become_partner')
    ->where('user_id', $id)
    ->update($update);
    $editpartnerData = DB::table('notifications')
      ->insert([
        'sender_id' => Auth::user()->id,
        'user_id' => $_GET['id'],
        'is_approved' => $is_approved,
        'title' => 'Your request has been ' . $statusMsg,
        'message' => 'Now you may proceed to buy subscription package & will be able to provide your service.'
      ]);
    // }
    // $Data = array(
    //   'id' => $_GET['id'],
    //   'status' => $_GET['status'],
    // );
    // $edituserData = DB::table('users')->where('id', $id)->update($Data);
    return response()->json(array('msg' => $editpartnerData), 200);
  }
  /* Update status ends */

  /* soft delete starts */
  public function deleteUser(Request $request, $id)
  {
    $user = Users::find($id);
    if ($user) {
      // dd($id);
      DB::table('become_partner')
        ->where('user_id', $id)
        ->delete();
      //$destroy = Users::destroy($id);
      $request->session()->flash('success', 'Partner has been deleted successfully.');
    } else {
      $request->session()->flash('error', 'Something went wrong. Please try again.');
    }
    return redirect()->back();
  }
  /* soft delete ends */
}
