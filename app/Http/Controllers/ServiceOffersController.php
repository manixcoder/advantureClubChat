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
use App\Models\Service_offers;
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

class ServiceOffersController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function listServiceOffers(Request $request)
    {
        $usersdata = DB::table(
            'service_offers'
        )
            ->select([
                'service_offers.*',
                'services.adventure_name'
            ])
            ->leftjoin('services', 'services.id', '=', 'service_offers.service_id')
            ->where('services.id', '<>', NULL)
            ->where(['service_offers.deleted_at' => NULL]) 
            ->get();
        //  echo "<pre>";print_r( $usersdata);exit;
        $data['content'] = 'admin.service_offers.list_service_offers';
        return view('layouts.content', compact('data'))->with(['usersdata' => $usersdata]);
    }

    /* Add new Adventure user starts */

    public function addServiceOffers(Request $request)
    {
      // echo"<pre>";print_r($request->all());exit;
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'adventure_name'    => 'required|unique:services',
                'name'              => 'required|unique:service_offers',
                'start_date'        => 'required|date_format:Y-m-d|before:end_date',
                'end_date'          => 'required|date_format:Y-m-d',
                'discount_amount'   => 'required',
                'banner'            => 'required',
                'description'       => 'required'
            ]);
            if ($validator->fails()) {
                $errors = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $errors[$field_name] = $messages[0];
                }
                $data['validation'] = $errors;
            } else {
                $adventureData = DB::table('services')->select(['*' ])->where(['id' => $request->adventure_name])->first();
                $user_data = array(
                    'service_id'        => $request->adventure_name,
                    'name'              => $request->name,
                    'country_id'        => $adventureData->country,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    //'status'          => ($request->status == 2) ? '0' : '1',
                    'discount_type'     => $request->discount_type,
                    'discount_amount'   => $request->discount_amount,
                    'banner'            => $request->banner,
                    'description'       => $request->description,
                    'created_at'        => date('Y-m-d H:i:s'),
                );
                if (DB::table('service_offers')->insert($user_data)) {
                    $user_id = DB::getPdo()->lastInsertId();
                    if ($request->file('banner')) {
                        $file_info = $this->getExtensionSize($_FILES['banner']);
                        if (!in_array($file_info['ext'], $this->allowed_mime())) {
                            $data['validation'] = ['banner' => 'File must be jpeg,jpg,png.'];
                        } else if ($file_info['size'] > 2024) {
                            $data['validation'] = ['banner' => 'File size must be 2 MB maximum'];
                        } else {
                            $filename = time() . '.' . $file_info['ext'];
                            $basepath = "public/offer_image/";
                            $destinationPath = public_path('/offer_image/');
                            if (!is_dir($basepath)) {
                                mkdir($basepath, 0777, true);
                            }
                            $files = $request->banner;
                            $filepath = $files->move($destinationPath, $filename);
                            DB::table('service_offers')
                                ->where(['id' => $user_id])
                                ->update(['banner' => 'offer_image/' . $filename]);
                        }
                    }
                    Session::flash('success', 'Offer has been inserted successfully.');
                     return redirect('/list-service-offers')->with(['status' => 'success', 'message' => 'Offer has been inserted successfully.!']);
                    return back();
                }
            }
        }

        $adv_names = DB::table(
            'services as srvc'
        )
            ->select(['srvc.id', 'srvc.adventure_name'])
            ->where('srvc.adventure_name', '<>', NULL)
            ->orderBy('srvc.id', 'DESC')
            ->get()->toArray();

        $data['content'] = 'admin.service_offers.add_service_offer';
        return view('layouts.content', compact('data'))->with([
            'validation' => $data['validation'] ?? [],
            'adv_names' => $adv_names
        ]);
    }

    /* Add New Adventure User ends */

    /* Update status in db from ajax request starts */
    public function update_offer_status($id)
    {
        $Data = array(
            'id'        => $_GET['id'],
            'status'    => $_GET['status'],
        );
        $edituserData = DB::table('service_offers')
            ->where('id', $id)
            ->update($Data);
        return response()->json(array('msg' => $edituserData), 200);
    }
    /* Update status ends */

    public function deleteServiceOffer(Request $request, $id)
    {
        //echo $id; die;
        $service = Service_offers::find($id);
        if ($service->delete()) {
            //$destroy = Service_offers::destroy($id);
            $request->session()->flash('success', 'Service has been deleted successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
}
