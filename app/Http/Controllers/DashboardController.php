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
use Session;
use Response;
use App\Category;
use App\Brand;
use App\User;
use DB;
use Hash;
use Auth;

class DashboardController extends MyController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    public function dashboard(Request $request)
    {
        $userRole = Session::get('userRole');
        $id = Session::get('user_id');
        $OrgData = DB::table('users')->where('id', $id)->first();

        if ($userRole == '1') {
            $one = "1";
            $where = 'client.status="' . $one . '"';
            $total_partner = DB::table('users')
                ->where(['users_role' => '2', 'deleted_at' => NULL])
                ->count();
            $new_partner = DB::table('users as u')
                ->leftJoin('become_partner as bp', 'bp.user_id', '=', 'u.id')
                ->where(['u.users_role' => '2', 'u.deleted_at' => NULL])
                ->whereRaw('DATE_FORMAT(u.created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')
                ->count();
            $total_customer = DB::table('users')
                ->where(['users_role' => '3', 'deleted_at' => NULL])
                ->where('users.email', '<>', NULL)
                ->where('users.name', '<>', NULL)
                ->count();
            // DB::enableQueryLog();
            $new_customer = DB::table('users')
                ->where(['users_role' => '3', 'deleted_at' => NULL])
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')
                ->count();
            // dd($new_customer);
            // dd(DB::getQueryLog());
            $total_booking = DB::table('bookings')
                ->count();
            $new_booking = DB::table('bookings')
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')
                ->count();
            $total_subscription = DB::table('packages')
                ->count();
            $new_subscription = DB::table('packages')
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')
                ->count();
            $with_data = [
                'total_partner'         => $total_partner,
                'new_partner'           => $new_partner,
                'total_customer'        => $total_customer,
                'new_customer'          => $new_customer,
                'total_subscription'    => $total_subscription,
                'new_subscription'      => $new_subscription,
                'total_booking'         => $total_booking,
                'new_booking'           => $new_booking
            ];
        } elseif ($userRole == '2') {
            $request->session()->flash('error', 'Access not allowed.');
            Auth::logout();
            return redirect()->back();
            die;
        } else {
            $request->session()->flash('error', 'customer login not allowed.');
            Auth::logout();
            return redirect()->back();
            die;
        }

        $service = DB::table('bookings as bkng')
            ->select([
                'bkng.id as booking_id',
                'srvc.id as service_id',
                'cntri.country',
                'cntri.currency',
                'rgn.region',
                'srvc.adventure_name',
                'usr.name as provider_name',
                'client.name as customer',
                'bkng.booking_date',
                'bkng.adult',
                'bkng.kids',
                'bkng.unit_amount as unit_cost',
                'bkng.total_amount as total_cost',
                'pmnt.payment_method as payment_channel',
                
                'bkng.status',
                'bkng.payment_status',
                DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status_text"),
                DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status_text"),
            ])
            ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('users as client', 'client.id', '=', 'bkng.user_id')
            ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
            ->whereRaw($where)
            ->orderBy('bkng.id', 'DESC')
            ->take(5)
            ->get();
        // dd($service);
        $with_data['bookings'] = $service;
        $data['content'] = 'admin.dashboard';
        return view('layouts.content', compact('data'))
            ->with($with_data);
    }
}
