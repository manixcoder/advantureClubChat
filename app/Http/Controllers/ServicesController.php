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

class ServicesController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function get(Request $request, $type = 1)
    {
        if ($type == 2) { //Booking list
            $service = DB::table('bookings as bkng')
                ->select([
                    'bkng.id as booking_id',
                    'srvc.id as service_id',
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
                    'cntri.country',
                    'bkng.status', 'bkng.payment_status',
                    DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Pending')) as booking_status_text"),
                    DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status_text"),
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
                'services' => $service
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
                ->where(['srvc.deleted_at' => NULL])
                ->orderBy('srvc.id', 'DESC')
                ->get();
            $service_ids = array_column($services->toArray(), 'id');
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
                $services[$key]->participants = $parti_array[$ser->id] ?? 0;
            }
            $data['content'] = 'admin.services.services';
            return view('layouts.content', compact('data'))->with([
                'services' => $services
            ]);
        }
    }

    public function add(Request $request)
    {


        if ($request->post()) {
            if ($request->service_plan == 1) {
                $validator = Validator::make($request->all(), [
                    'owner'                 => 'required|numeric',
                    'adventure_name'        => 'required',
                    'country'               => 'required|numeric',
                    'region'                => 'required|numeric',
                    'service_sector'        => 'required|numeric',
                    'service_category'      => 'required|numeric',
                    'service_type'          => 'required|numeric',
                    'service_level'         => 'required|numeric',
                    'duration'              => 'required|numeric',
                    'available_seats'       => 'required|numeric',

                    'write_information'     => 'required|max:500',
                    'service_plan'          => 'required|numeric',
                    'service_plan_days'     => 'required',
                    'service_for'           => 'required',
                    'dependency'            => 'required',
                    'schedule_title'        => 'required',
                    'gathering_date'        => 'required',
                    'gathering_start_time'  => 'required',
                    'gathering_end_time'    => 'required',
                    'program_description'   => 'required',
                    'activities'            => 'required',
                    'specific_address'      => 'required|min:20',
                    'cost_inc'              => 'required|numeric',
                    'cost_exc'              => 'required|numeric',
                    'currency'              => 'required|numeric',
                    'pre_requisites'        => 'required|max:500',
                    'minimum_requirements'  => 'required|max:500',
                    'terms_conditions'      => 'required|max:500',
                    'recommended'           => 'required|numeric',
                    'banners' => 'required'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'owner' => 'required|numeric',
                    'adventure_name' => 'required',
                    'country' => 'required|numeric',
                    'region' => 'required|numeric',
                    'service_sector' => 'required|numeric',
                    'service_category' => 'required|numeric',
                    'service_type' => 'required|numeric',
                    'service_level' => 'required|numeric',
                    'duration' => 'required|numeric',
                    'available_seats' => 'required|numeric',
                    'start_date' => 'required|date_format:Y-m-d|before:end_date',
                    'end_date' => 'required|date_format:Y-m-d',
                    'write_information' => 'required|max:500',
                    'service_plan' => 'required|numeric',
                    'start_date'            => 'required|date_format:Y-m-d|before:end_date',
                    'end_date'              => 'required|date_format:Y-m-d',
                    //'particular_date' => 'required',
                    'service_for' => 'required',
                    'dependency' => 'required',
                    'schedule_title' => 'required',
                    'gathering_date' => 'required',
                    'gathering_start_time' => 'required',
                    'gathering_end_time' => 'required',
                    'program_description' => 'required',
                    'activities' => 'required',
                    'specific_address' => 'required|min:20',
                    'cost_inc' => 'required|numeric',
                    'cost_exc' => 'required|numeric',
                    'currency' => 'required|numeric',
                    'pre_requisites' => 'required|max:500',
                    'minimum_requirements' => 'required|max:500',
                    'terms_conditions' => 'required|max:500',
                    'recommended' => 'required|numeric',
                    'banners' => 'required'
                ]);
            }

            $flag = true;
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
                $flag = false;
            } elseif (1 == 1) {
                $validation = array();
                $gathering_date = $request->gathering_date;
                foreach ($gathering_date as $ki => $gd) {
                    if ($gd) {
                        $day = date('d', strtotime($gathering_date[$ki]));
                        $mon = date('m', strtotime($gathering_date[$ki]));
                        $year = date('Y', strtotime($gathering_date[$ki]));

                        if (!checkdate($mon, $day, $year)) {
                            $validation['gathering_date'] = 'The gathering date field should be valid date.';
                            $flag = false;
                        }
                    } else {
                        $validation['gathering_date'] = 'The gathering date field is required.';
                        $flag = false;
                    }
                }
                $start_time = $request->gathering_start_time;
                $end_time = $request->gathering_end_time;
                foreach ($start_time as $k => $st) {
                    if (strtotime($start_time[$k]) >= strtotime($end_time[$k])) {
                        $validation['gathering_end_time'] = 'End time should be greater that to start time';
                        $flag = false;
                    }
                }
            }
            if ($flag == true) {
                $adventure_exist = DB::table('services')
                    ->where('adventure_name', $request->adventure_name)
                    ->where('owner', $request->owner)
                    ->get();
                if (!$adventure_exist->isEmpty()) {
                    $validation = array('adventure_name' => 'This name already taken for selected owner.');
                } else {
                    $service = new Service();
                    $service->owner = $request->owner;
                    $service->adventure_name = $request->adventure_name;
                    $service->country = $request->country;
                    $service->region = $request->region;
                    $service->service_sector = $request->service_sector;
                    $service->service_category = $request->service_category;
                    $service->service_type = $request->service_type;
                    $service->service_level = $request->service_level;
                    $service->duration = $request->duration;
                    $service->available_seats = $request->available_seats;
                    $service->start_date = date('Y-m-d', strtotime($request->start_date));
                    $service->end_date = date('Y-m-d', strtotime($request->end_date));
                    $service->write_information = $request->write_information;
                    $service->specific_address = $request->specific_address;
                    $service->service_plan = $request->service_plan;
                    $service->cost_inc = $request->cost_inc;
                    $service->cost_exc = $request->cost_exc;
                    $service->currency = $request->currency;
                    $service->pre_requisites = $request->pre_requisites;
                    $service->minimum_requirements = $request->minimum_requirements;
                    $service->terms_conditions = $request->terms_conditions;
                    if ($request->recommended == 1) {
                        $service->recommended = 1;
                    } elseif ($request->recommended == 2) {
                        $service->recommended = 0;
                    }

                    if ($service->save()) {
                        //                        prx($request->file('banners')); 
                        $service_id = $service->id;
                        $banner_data = [];
                        DB::table('service_images')->where('service_id', '=', $service_id)->delete();
                        if (count($request->file('banners'))) {
                            foreach ($request->file('banners') as $key => $banner) {

                                $banner->type = $banner->getClientMimeType();
                                $file_info = $this->getExtensionSize((array) $banner);
                                if (!in_array($file_info['ext'], $this->allowed_mime())) {
                                    $data['validation'] = ['banners' => 'All file must be jpeg,jpg,png.'];
                                } else if ($file_info['size'] > 2024) {
                                    $data['validation'] = ['banners' => 'All file size must be 2 MB maximum'];
                                } else {
                                    $msg = config('constants.BANNER_ADDED');
                                    if ($banner) {
                                        $filename = time() . '-' . $key . '.jpg';
                                        $basepath = "public/uploads/services/thumbs/";
                                        if (!is_dir($basepath)) {
                                            mkdir($basepath, 0777, true);
                                        }
                                        $filepath = Storage::disk('public')->putFileAs('services', $banner, $filename);
                                        $this->resize_crop_image($this->image_path() . '/' . $filepath, $this->image_path() . '/services/thumbs/' . $filename);
                                        $banner_data[] = array(
                                            'service_id' => $service_id,
                                            'is_default' => $key == 0 ? 1 : 0,
                                            'image_url' => $filepath,
                                            'thumbnail' => 'services/thumbs/' . $filename
                                        );
                                    }
                                }
                            }

                            DB::table('service_images')->insert($banner_data);
                        }
                        $ssfor = array();
                        if (count($request->service_for)) {
                            DB::table('service_service_for')
                                ->where('service_id', '=', $service_id)
                                ->delete();
                            foreach ($request->service_for as $sfor) {
                                $ssfor[] = array(
                                    'service_id' => $service_id,
                                    'sfor_id' => $sfor
                                );
                            }
                            DB::table('service_service_for')
                                ->insert($ssfor);
                        }
                        $sdep = [];
                        if (count($request->dependency)) {
                            DB::table('service_dependencies')
                                ->where('service_id', '=', $service_id)
                                ->delete();
                            foreach ($request->dependency as $dep) {
                                $sdep[] = array('service_id' => $service_id, 'dependency_id' => $dep);
                            }
                            DB::table('service_dependencies')
                                ->insert($sdep);
                        }
                        $activitiess = [];
                        if (count($request->activities)) {
                            DB::table('service_activities')
                                ->where('service_id', '=', $service_id)
                                ->delete();
                            foreach ($request->activities as $act) {
                                $activitiess[] = array('service_id' => $service_id, 'activity_id' => $act);
                            }
                            DB::table('service_activities')
                                ->insert($activitiess);
                        }
                        $serv_programs = [];
                        if (count($request->schedule_title)) {
                            $s_title = $request->schedule_title;
                            $g_date = $request->gathering_date;
                            $g_stime = $request->gathering_start_time;
                            $g_etime = $request->gathering_end_time;
                            $p_desc = $request->program_description;
                            DB::table('service_programs')
                                ->where('service_id', '=', $service_id)
                                ->delete();
                            foreach ($request->schedule_title as $key => $act) {
                                $serv_programs[] = array(
                                    'service_id' => $service_id,
                                    'title' => $s_title[$key],
                                    'start_datetime' => $g_date[$key] . ' ' . $g_stime[$key] . ':00',
                                    'end_datetime' => $g_date[$key] . ' ' . $g_etime[$key] . ':00',
                                    'description' => $p_desc[$key]
                                );
                            }
                            DB::table('service_programs')->insert($serv_programs);
                        }
                        if ($request->service_plan == 1) {
                            $spd_data = [];
                            DB::table('service_plan_day_date')->where('service_id', '=', $service_id)->delete();
                            foreach ($request->service_plan_days as $spd) {
                                $spd_data[] = array(
                                    'service_id' => $service_id,
                                    'day' => $spd
                                );
                            }
                            DB::table('service_plan_day_date')->insert($spd_data);
                        }
                        if ($request->service_plan == 2) {
                            $pd_data = [];
                            DB::table('service_plan_day_date')
                                ->where('service_id', '=', $service_id)
                                ->delete();
                            foreach (explode(',', $request->particular_date) as $p_date) {
                                $pd_data[] = array('service_id' => $service_id, 'date' => date('Y-m-d', strtotime($p_date)));
                            }
                            DB::table('service_plan_day_date')
                                ->insert($pd_data);
                        }
                        $notiData = array(
                            'sender_id' => '1',
                            'user_id' => $service->owner,
                            'title' => 'Activities',
                            'message' => 'Your service has Been approved',
                            'notification_type' => '1',

                        );
                        DB::table('notifications')->insert($notiData);
                        $request->session()->flash('success', 'Service has been added successfully.');
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                    return redirect('/services');
                }
            }
        }
        $vendors = User::where(['deleted_at' => NULL])
            ->whereIn('users_role', [1, 2])
            ->get();
        if (!empty($vendors)) {
            foreach ($vendors as $vendor) {
                $result[] = $vendor->attributesToArray();
            }
        }
        $countries = Countrie::where(['deleted_at' => NULL])->get();
        if (!empty($countries)) {
            foreach ($countries as $countrie) {
                $countries_res[] = $countrie->attributesToArray();
            }
        }
        $sectors = Service_sector::get();
        if (!empty($sectors)) {
            foreach ($sectors as $sector) {
                $sectors_res[] = $sector->attributesToArray();
            }
        }
        $categories = Service_categorie::get();
        if (!empty($categories)) {
            foreach ($categories as $categorie) {
                $categories_res[] = $categorie->attributesToArray();
            }
        }
        $types = Service_type::get();
        if (!empty($types)) {
            foreach ($types as $type) {
                $types_res[] = $type->attributesToArray();
            }
        }
        $levels = Service_level::get();
        if (!empty($levels)) {
            foreach ($levels as $level) {
                $levels_res[] = $level->attributesToArray();
            }
        }
        $dependencies = DB::table('dependency')->select('id', 'dependency_name')->get();
        $service_for = DB::table('service_for')->select('id', 'sfor')->get();
        $service_plans = DB::table('service_plan')->select('id', 'plan', 'title')->get();
        $currencies = DB::table('countries')->select('*')->get();
        $weekdays = DB::table('weekdays')->select('id', 'day')->get();
        $activities_list = DB::table('activities')->select('id', 'activity')->get();
        $durations_list = DB::table('durations')->select('id', 'duration')->get();
        $region_list = DB::table('regions')->select('id', 'region')->get();
        $data['content'] = 'admin.services.update_services';
        return view('layouts.content', compact('data'))->with([
            'validation'        => $validation ?? [],
            'vendors'           => $result ?? [],
            'countries'         => $countries_res,
            'sectors'           => $sectors_res,
            'categories'        => $categories_res,
            'types'             => $types_res,
            'levels'            => $levels_res,
            'dependencies'      => $dependencies,
            'service_for'       => $service_for,
            'currencies'        => $currencies,
            'service_plans'     => $service_plans,
            'weekdays'          => $weekdays,
            'activities_list'   => $activities_list,
            'durations'         => $durations_list,
            'regions_list'      => $region_list
        ]);
    }

    public function viewService(Request $request, $id)
    {
        $url = asset('public/profile_image/');
        $where = 'srvc.id = ' . $id . ' ';
        $services = DB::table('services as srvc')
            ->select([
                'srvc.*',
                'srvc.id as service_id',
                'usr.name as provider_name',
                DB::raw("CONCAT('" . $url . "/',usr.profile_image) AS provider_profile"),
                DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                'scat.category as service_category',
                'ssec.sector as service_sector',
                'styp.type as service_type',
                'slvl.level as service_level',
                'cntri.country',
                'rgn.region',
                'cntri.currency as currency',
                DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                'slike.is_like'
            ])
            ->join('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
            ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
            ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
            ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
            ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
            ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
            ->leftJoin('service_likes as slike', 'slike.service_id', '=', 'srvc.id')
            ->groupBy('ssfor.service_id')
            ->whereRaw($where)
            ->get();
        if (!$services->isEmpty()) {
            $activities = DB::table('service_activities as s_act')
                ->select(['act.id', 'act.activity'])
                ->leftJoin('activities as act', 'act.id', '=', 's_act.activity_id')
                ->where('s_act.service_id', $id)
                ->get()
                ->toArray();
            $services[0]->included_activities = $activities ?? [];
            $dependencies = DB::table('service_dependencies as s_dep')
                ->select(['dep.id', 'dep.dependency_name'])
                ->leftJoin('dependency as dep', 'dep.id', '=', 's_dep.dependency_id')
                ->where('s_dep.service_id', $id)
                ->get()
                ->toArray();
            $services[0]->dependencies = $dependencies ?? [];
            $programs = DB::table('service_programs')->select([
                'id',
                'service_id',
                'title',
                'start_datetime',
                'end_datetime',
                'description'
            ])
                ->where('service_id', $id)
                ->get();
            $services[0]->programs = $programs;
            if ($services[0]->service_plan == 1) {
                $availability = DB::table('service_plan_day_date as spdd')
                    ->select(['spdd.id', 'wkd.day'])
                    ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                    ->where('spdd.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->availability = $availability ?? [];
            } else if ($services[0]->service_plan == 2) {
                $availability = DB::table('service_plan_day_date as spdd')
                    ->select(['spdd.id', 'spdd.date'])
                    ->where('spdd.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->availability = $availability ?? [];
            }
            $star_ratings_res = DB::table('service_reviews')
                ->select([
                    'service_id',
                    DB::raw("AVG(star) AS stars"),
                    DB::raw("COUNT(user_id) AS reviewd_by")
                ])
                ->where('service_id', $id)
                ->groupBy('service_id')
                ->first();
            $services[0]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
            $services[0]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
        }
        $bookings = DB::table('bookings as bkng')
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
                'bkng.status', 'bkng.payment_status',
                DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status_text"),
                DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status_text")
            ])
            ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('users as client', 'client.id', '=', 'bkng.user_id')
            ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
            ->where('bkng.service_id', $id)
            ->orderBy('bkng.id', 'DESC')
            ->get();
        $data['content'] = 'admin.services.service_detail';
        return view('layouts.content', compact('data'))->with([
            'service' => $services[0],
            'bookings' => $bookings
        ]);
    }
    public function viewPartnerRequests(Request $request, $id)
    {
        $services = DB::table('become_partner as bp')
            ->select(
                'bp.*',
                'cntri.country',
                'pk.title',
                'bp.created_at as request_date',
                'u.name',
                'u.id as user_id',
                'u.profile_image as profile_image',
                'u.email'
            )
            ->leftJoin('users as u', 'bp.user_id', '=', 'u.id')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'u.country_id')
            ->leftJoin('packages as pk', 'pk.id', '=', 'bp.packages_id')
            ->where([
                'u.deleted_at' => NULL,
                'u.status' => '1'
            ])
            ->where('bp.id', $id)
            ->first();
        $data['content'] = 'admin.adventureRequests.adventureRequestsDetails';
        return view('layouts.content', compact('data'))->with([
            'service' => $services,
        ]);
    }
    public function viewRequests(Request $request, $id)
    {
        $url = asset('public/profile_image/');
        $where = 'srvc.id = ' . $id . ' ';
        $services = DB::table('services as srvc')
            ->select([
                'srvc.*',
                'srvc.id as service_id',
                'usr.name as provider_name',
                DB::raw("CONCAT('" . $url . "/',usr.profile_image) AS provider_profile"),
                DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                'scat.category as service_category',
                'ssec.sector as service_sector',
                'styp.type as service_type',
                'slvl.level as service_level',
                'cntri.country',
                'rgn.region',
                'cntri.currency as currency',
                DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                'slike.is_like'
            ])
            ->join('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
            ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
            ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
            ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')

            ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
            ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
            ->leftJoin('service_likes as slike', 'slike.service_id', '=', 'srvc.id')
            ->groupBy('ssfor.service_id')
            ->whereRaw($where)
            ->get();
        if (!$services->isEmpty()) {
            $activities = DB::table('service_activities as s_act')
                ->select(['act.id', 'act.activity'])
                ->leftJoin('activities as act', 'act.id', '=', 's_act.activity_id')
                ->where('s_act.service_id', $id)
                ->get()
                ->toArray();
            $services[0]->included_activities = $activities ?? [];
            $dependencies = DB::table('service_dependencies as s_dep')
                ->select(['dep.id', 'dep.dependency_name'])
                ->leftJoin('dependency as dep', 'dep.id', '=', 's_dep.dependency_id')
                ->where('s_dep.service_id', $id)
                ->get()
                ->toArray();
            $services[0]->dependencies = $dependencies ?? [];
            $programs = DB::table('service_programs')
                ->select(['id', 'service_id', 'title', 'start_datetime', 'end_datetime', 'description'])
                ->where('service_id', $id)
                ->get();
            $services[0]->programs = $programs;
            if ($services[0]->service_plan == 1) {
                $availability = DB::table('service_plan_day_date as spdd')
                    ->select(['spdd.id', 'wkd.day'])
                    ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                    ->where('spdd.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->availability = $availability ?? [];
            } else if ($services[0]->service_plan == 2) {
                $availability = DB::table('service_plan_day_date as spdd')
                    ->select(['spdd.id', 'spdd.date'])
                    ->where('spdd.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->availability = $availability ?? [];
            }
            $star_ratings_res = DB::table('service_reviews')
                ->select(['service_id', DB::raw("AVG(star) AS stars"), DB::raw("COUNT(user_id) AS reviewd_by")])
                ->where('service_id', $id)
                ->groupBy('service_id')
                ->first();
            $services[0]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
            $services[0]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
        }
        //$data['content'] = 'admin.services.service_detail';
        $data['content'] = 'admin.adventureRequests.requests_detail';
        return view('layouts.content', compact('data'))->with([
            'service' => $services[0],
        ]);
    }
    public function deleteService(Request $request, $id)
    {
        $service = Service::find($id);
        if ($service) {
            $destroy = Service::destroy($id);
            DB::table('service_plan_day_date')->where('service_id', '=', $id)->delete();
            DB::table('service_plan_day_date')->where('service_id', '=', $id)->delete();
            DB::table('service_activities')->where('service_id', '=', $id)->delete();
            DB::table('service_dependencies')->where('service_id', '=', $id)->delete();
            DB::table('service_service_for')->where('service_id', '=', $id)->delete();
            DB::table('service_images')->where('service_id', '=', $id)->delete();
            $request->session()->flash('success', 'Service has been deleted successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    public function acceptService(Request $request, $id)
    {
        $service = Service::find($id);
        // dd($service);
        if ($service) {
            $service->status = '1';
            $service->save();

            $notiData = array(
                'sender_id' => '1',
                'user_id' => $service->owner,
                'title' => 'Activities',
                'message' => "Your Service: " . $service->adventure_name . " has been approved.",
                'notification_type' => '1',
            );
            DB::table('notifications')->insert($notiData);
            $request->session()->flash('success', 'Service has been accepted successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    public function declineService(Request $request, $id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->status = '2';
            $service->save();
            $notiData = array(
                'sender_id' => '1',
                'user_id' => $service->owner,
                'title' => 'Activities',
                'message' => "Your service: " . $service->adventure_name . " has been rejected.",
                'notification_type' => '1',
            );
            DB::table('notifications')->insert($notiData);
            $request->session()->flash('error', 'Service has been rejected successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()
            ->back();
    }
    public function participant(Request $request, $id)
    {
        $service = DB::table('bookings as bkng')
            ->select([
                'bkng.id as booking_id',
                'srvc.id',
                'srvc.id as service_id',
                'cntri.country',
                'rgn.region',
                'srvc.adventure_name',
                'usr.name as provider_name',
                'client.name as customer',
                'client.profile_image',
                'bkng.booking_date as service_date',
                'bkng.created_at as booked_on',
                'bkng.adult',
                'bkng.kids',
                'bkng.unit_amount as unit_cost',
                'bkng.total_amount as total_cost',
                'pmnt.payment_method as payment_channel',
                'cntri.currency as currency',
                'client.dob',
                'client.Height',
                'client.Weight',
                'client.profile_image',
                'bkng.message',
                'bkng.status', 'bkng.payment_status',
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
            ->where('bkng.id', $id)
            ->orderBy('bkng.id', 'DESC')
            ->first();
        $service_id = $service->service_id;
        $dependencies = DB::table('service_dependencies as s_dep')
            ->select(['dep.id', 'dep.dependency_name'])
            ->leftJoin('dependency as dep', 'dep.id', '=', 's_dep.dependency_id')
            ->where('s_dep.service_id', $service_id)
            ->get()
            ->toArray();
        $service->dependencies = $dependencies ?? [];
        $data['content'] = 'admin.services.booked_client_view';
        return view('layouts.content', compact('data'))
            ->with([
                'service' => $service
            ]);
    }
    public function adventures(Request $request, $id = null)
    {
        $where = '1';
        if ($id) {
            $where .= ' && srvc.id = ' . $id;
        }
        $services = DB::table('services as srvc')
            ->select([
                'srvc.*',
                'usr.name as provider_name',
                'usr.id as user_id',
                DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                'scat.category as service_category',
                'ssec.sector as service_sector',
                'styp.type as service_type',
                'slvl.level as service_level',
                'cntri.country',
                'cntri.currency as currency_sign',
                'rgns.region'
            ])
            ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('regions as rgns', 'rgns.id', '=', 'srvc.region')
            ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
            ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
            ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
            ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
            ->where([
                'srvc.deleted_at' => NULL,

            ])
            ->where('srvc.status', '!=', '1')
            ->where('srvc.status', '!=', '2')
            // ->whereRaw($where)
            ->orderBy('srvc.id', 'DESC')
            ->get();
        //dd($services);
        $data['content'] = 'admin.services.adventure_request';
        return view('layouts.content', compact('data'))->with(['services' => $services]);
    }
    public function getRegions(Request $request, $id)
    {
        $result = array();
        $regions = DB::table('regions as rg')
            ->select(
                'cnt.id as country_id',
                'cnt.country',
                'rg.id as region_id',
                'rg.region'
            )
            ->leftJoin('countries as cnt', 'cnt.id', '=', 'rg.country_id')
            ->where('rg.country_id', $id)
            ->orderBy('rg.region', 'ASC')
            ->get();
        $options = '';
        if (!$regions->isEmpty()) {
            $options .= '<option value="">Select</option>';
            foreach ($regions as $reg) {
                $sel = '';
                if ($request->region && $request->region == $reg->region_id) {
                    $sel = 'selected';
                }
                $options .= '<option value="' . $reg->region_id . '" ' . $sel . '>' . $reg->region . '</option>';
            }
        } else {
            $options = '<option value="">No record found.</option>';
        }
        echo $options;
    }
    public function getCity(Request $request, $id)
    {
        // dd($request->all());
        $result = array();
        $regions = DB::table('cities as rg')
            ->select('rg.*')
            ->where('rg.region_id', $id)
            ->orderBy('rg.city', 'ASC')
            ->get();
        // dd($regions);
        $options = '';
        if (!$regions->isEmpty()) {
            $options .= '<option value="">Select</option>';
            foreach ($regions as $reg) {
                // dd($reg);
                $sel = '';
                if ($request->count && $request->count == $reg->id) {
                    $sel = 'selected';
                }
                $options .= '<option value="' . $reg->id . '" ' . $sel . '>' . $reg->city . '</option>';
            }
        } else {
            $options = '<option value="">No record found.</option>';
        }
        echo $options;
    }
    public function listServiceReviews(Request $request)
    {
        $services = DB::table('service_reviews as rev')
            ->select([
                'srvc.*',
                'srvc.id as service_id',
                'rev.user_id as user_id',
                'rev.star',
                'rev.remark'
            ])
            ->join('services as srvc', 'rev.service_id', '=', 'srvc.id')
            // ->groupBy('rev.service_id')
            ->get()
            ->toArray();
        // dd($services);
        $url = asset('public');
        $s_img = asset('public/uploads') . '/';
        if ($services) {
            foreach ($services as $key => $ser) {
                // dd($ser);
                $service_id = $ser->id;
                $services[$key]->is_liked = 0;
                if ($request->user_id >= 1) {
                    $is_liked = DB::table('service_likes')
                        ->select(['service_id'])
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    $services[$key]->is_liked = isset($is_liked->service_id) ? 1 : 0;
                }

                $countriesData = DB::table('countries')->where('id', $ser->country)->first();
                $services[$key]->countries = $countriesData->country;


                $countriesData = DB::table('countries')->where('id', $ser->country)->first();
                $services[$key]->countries = $countriesData->country;

                $serCatData = DB::table('service_categories')->where('id', $ser->service_category)->first();
                $services[$key]->category = $serCatData->category;

                $serTypesData = DB::table('service_types')->where('id', $ser->service_category)->first();
                $services[$key]->service_types = $serTypesData->type;

                $serSectorsData = DB::table('service_sectors')->where('id', $ser->service_sector)->first();
                $services[$key]->sector = $serSectorsData->sector;
                $usersData = DB::table('users')->where('id', $ser->user_id)->first();
                $services[$key]->users_name = $usersData->name;


                // if ($services[$key]->service_plan == 1) {
                //     $availability = DB::table('service_plan_day_date as spdd')
                //         ->select(['spdd.id', 'wkd.day'])
                //         ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                //         ->where('spdd.service_id', $service_id)
                //         ->get()
                //         ->toArray();
                //     $services[$key]->availability = $availability ?? [];
                // } else if ($services[$key]->service_plan == 2) {
                //     $availability = DB::table('service_plan_day_date as spdd')
                //         ->select(['spdd.id', 'spdd.date'])
                //         ->where('spdd.service_id', $service_id)
                //         ->get()
                //         ->toArray();
                //     $services[$key]->availability = $availability ?? [];
                // }
                // $star_ratings_res = DB::table('service_reviews')->select(['service_id',DB::raw("AVG(star) AS stars"),DB::raw("COUNT(user_id) AS reviewd_by")])->where('service_id', $service_id)->groupBy('service_id')->first();

                // if ($services[$key]->service_plan == 1) {
                //     $availability = DB::table('service_plan_day_date as spdd')
                //         ->select(['spdd.id', 'wkd.day'])
                //         ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                //         ->where('spdd.service_id', $service_id)
                //         ->get()
                //         ->toArray();
                //     $services[$key]->availability = $availability ?? [];
                // } else if ($services[$key]->service_plan == 2) {

                //     $availability = DB::table('services as srvc')->select(['srvc.start_date', 'srvc.end_date'])->where('srvc.id', $service_id)->get()->toArray();
                //     $services[$key]->availability = $availability ?? [];
                // }

                // $services[$key]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
                // $services[$key]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
                // $booked_seats_qry = DB::table('bookings')->select(['id'])->where(['service_id' => $service_id, 'status' => 1])->get();
                // $booked_seats = $booked_seats_qry->count();
                // $services[$key]->booked_seats = $booked_seats;
                // $aimedforData = DB::table('service_service_for as ssfor')
                //     ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                //     ->select('sfor.*', 'ssfor.service_id')
                //     ->where('ssfor.service_id', $service_id)
                //     ->get();
                // $services[$key]->aimed_for = $aimedforData;
                // $programsData = DB::table('service_programs')
                //     ->where('service_id', $service_id)
                //     ->get();
                // $services[$key]->programs = $programsData;
                // $services[$key]->remaining_seats = $services[0]->available_seats - $booked_seats;
            }

            //dd($services);
            /* 
       $reviewData = DB::table('services as srvc')
            ->select([
                'srvc.id',
                'usr.id as user_id',
                'srvc.adventure_name',
                'sercat.category',
                'sersec.sector',
                'sertype.type',
                'rev.service_id',
                'rev.user_id',
                'rev.star',
                DB::raw("AVG(star) AS stars"),
                DB::raw("COUNT(user_id) AS reviewd_by"),
                DB::raw("COUNT(service_id) AS likes"),
                'rev.remark',
                'usr.name',
                'usr.users_role',
                'cntri.country',
                DB::raw("MAX(srvc.updated_at)as date")
            ])
            ->join('service_reviews as rev', 'rev.service_id', '=', 'srvc.id')
            ->join('service_categories as sercat', 'srvc.service_category', '=', 'sercat.id')
            ->join('service_sectors as sersec', 'srvc.service_sector', '=', 'sersec.id')
            ->join('service_types as sertype', 'srvc.service_type', '=', 'sertype.id')
            ->join('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->groupBy('rev.service_id')
            ->get()
            ->toArray();
            */
            //   dd($services);
            $likesData = DB::table('service_likes as srvclks')
                ->select(['rev.*', 'srvclks.is_like'])
                ->join('service_reviews as rev', 'rev.service_id', '=', 'srvclks.service_id')
                ->groupBy('rev.service_id')
                ->get()
                ->toArray();
            //  echo "<pre>";print_r( $services);exit;
            $data['content'] = 'admin.services.list_reviews';
            return view('layouts.content', compact('data'))
                ->with([
                    'reviewdata' => $services,
                    'likesData' => $likesData
                ]);
        }
    }
    public function deleteServiceReviews(Request $request, $id)
    {
        $service = Service::find($id);
        if ($service) {
            $destroy = Service::destroy($id);
            $request->session()->flash('success', 'Service Review has been blocked successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    public function update_like_status($id)
    {
        $Data = array(
            'id' => $_GET['id'],
            'status' => $_GET['status'],
        );
        $edituserData = DB::table('service_likes')->insert($Data);
        return response()->json(array('msg' => $edituserData), 200);
    }
}
