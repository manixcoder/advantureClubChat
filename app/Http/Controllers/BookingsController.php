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
use App\Models\Service;
use App\Models\Countrie;
use App\Models\Service_sector;
use App\Models\Service_categorie;
use App\Models\Service_type;
use App\Models\Service_level;
use Session;
use Response;
use App\Category;
use App\Brand;
use App\Products;
use App\User;
use DB;
use Hash;
use Auth;

class BookingsController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function get(Request $request, $type = 1)
    {
        /* print_r($request->all()); die; */
        if ($type == 2) { //Booking list
            $service = DB::table('bookings as bkng')
                ->select([
                    'bkng.id as booking_id',
                    'srvc.id as service_id',
                    'cntri.country',
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
                    'cntri.currency as currency',
                    DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status"),
                    DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status"),
                ])
                ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('users as client', 'client.id', '=', 'bkng.user_id')
                ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
                ->orderBy('bkng.id', 'DESC')
                ->get();
            $data['content'] = 'admin.services.bookings';
            return view('layouts.content', compact('data'))->with([
                'bookings' => $service
            ]);
        } else { // Service list
            $services = DB::table('services as srvc')
                ->select([
                    'srvc.*',
                    'usr.name as provider_name',
                    DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                    'scat.category as service_category',
                    'ssec.sector as service_sector',
                    'styp.type as service_type',
                    'slvl.level as service_level',
                    'cntri.country'
                ])
                ->join('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
                ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
                ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
                ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
                ->get();
            $data['content'] = 'admin.services.services';
            return view('layouts.content', compact('data'))->with([
                'services' => $services
            ]);
        }
    }

    public function detail(Request $request, $id)
    {
        $service = DB::table('bookings as bkng')
            ->select([
                'bkng.id as booking_id',
                'bkng.user_id as booking_user',
                'usr.profile_image as profile_image',
                'usr.email',
                'usr.nationality_id',
                'srvc.id as service_id',
                'cntri.country',
                'rgn.region',
                'srvc.adventure_name',
                'usr.name as provider_name',
                'client.name as customer',
                'client.email',
                'bkng.booking_date as service_date',
                'bkng.created_at as booked_on',
                'bkng.adult',
                'bkng.kids',
                'bkng.unit_amount as unit_cost',
                'bkng.total_amount as total_cost',
                'pmnt.payment_method as payment_channel',
                'cntri.currency as currency',
                'client.dob',
                'client.height',
                'client.weight',
                'bkng.message',
                'bkng.status',
                'bkng.payment_status',
                DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status_text"),
                DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status_text"),
                'catg.category'
            ])
            ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
            ->leftJoin('service_categories as catg', 'catg.id', '=', 'srvc.service_category')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            //->leftJoin('currencies as crnci', 'crnci.id', '=', 'bkng.currency')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('users as client', 'client.id', '=', 'bkng.user_id')
            ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
            ->where('bkng.id', $id)
            ->orderBy('bkng.id', 'DESC')
            ->first();
        // dd($service);
        $data['content'] = 'admin.services.booking_detail';
        return view('layouts.content', compact('data'))->with([
            'service' => $service
        ]);
    }

    public function accept(Request $request, $id)
    {
        if ($id) {
            $user_id = Auth::user()->id;
            DB::table('bookings')->where(['id' => $id])->update(['status' => 1, 'updated_by' => $user_id]);
            $request->session()->flash('success', 'Request has been accepted successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }

    public function decline(Request $request, $id)
    {
        if ($id) {
            $user_id = Auth::user()->id;
            DB::table('bookings')->where(['id' => $id])->update(['status' => 2, 'updated_by' => $user_id]);
            $request->session()->flash('success', 'Request has been cancelled successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }

    public function notifyUser(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            DB::table('notifications')->insert([
            'sender_id' => Auth::user()->id, 
            'user_id' => $request->user_id,
            'title'=>$request->title,
            'message'=>$request->message,
            'created_at'=>date("Y-m-d H:i:s"),
            'send_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
            $request->session()->flash('success', 'User notify  successfully.');
            return redirect()->back();
            } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
}
