<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\Countrie;
use App\Models\Service_sector;
use App\Models\Service_categorie;
use App\Models\Service_type;
use App\Models\Service_level;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Storage;
use DB;

class ServicesController extends MyController
{

    function __construct()
    {
    }

    public function get(Request $request, $id = null)
    {
        $result = array();
        $url = asset('public');
        $s_img = asset('public/uploads') . '/';
        if ($id) {
            $where = 'srvc.id = ' . $id . ' ';
        } else {
            $where = ' 1 ';
        }
        if ($request->recommended == 1) {
            $where .= " && srvc.recommended =  1";
        }

        if ($request->provider_name) {
            $where .= ' && usr.name LIKE "%' . $request->provider_name . '%"';
        }
        if ($request->sector) {
            $where .= ' && ssec.id = ' . $request->sector;
        }
        if ($request->category) {
            $where .= ' && scat.id = ' . $request->category;
        }
        if ($request->type) {
            $where .= ' && styp.id = ' . $request->type;
        }
        if ($request->aimed) {
            $where .= ' && ssfor.sfor_id = ' . $request->aimed;
        }
        if ($request->level) {
            $where .= ' && slvl.id = ' . $request->level;
        }
        if ($request->duration) {
            $where .= ' && dur.id = ' . $request->duration;
        }
        $recently_added = 'ASC';
        if ($request->recently_added) {
            $recently_added = 'DESC';
        }
        if ($id) {
            $services = DB::table('services as srvc')
                ->select([
                    'srvc.*',
                    'srvc.id as service_id',
                    'usr.name as provided_by',
                    DB::raw("CONCAT('" . $url . "',usr.profile_image) AS provider_profile"),
                    //DB::raw("CONCAT('" . $s_img . "/',simg.image_url) AS image_url"),
                    DB::raw("CONCAT('" . $s_img . "/',simg.thumbnail) AS thumbnail"),
                    DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                    'scat.category as service_category',
                    'ssec.sector as service_sector',
                    'styp.type as service_type',
                    'slvl.level as service_level',
                    'cntri.country',
                    'rgn.region',
                    'srvc.currency',
                    //'srvc.sfor_id as aimed_for', 
                    // DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                    'srvc.cost_inc as including_gerea_and_other_taxes',
                    'srvc.cost_exc as excluding_gerea_and_other_taxes'
                ])
                ->join('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('service_images as simg', 'srvc.id', '=', 'simg.service_id')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
                ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
                ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
                ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
                ->leftJoin('currencies as curr', 'curr.id', '=', 'srvc.currency')
                ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
                ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
                ->where(['srvc.deleted_at' => NULL])
                ->groupBy('ssfor.service_id')
                ->whereRaw($where)
                ->get();



            if (!$services->isEmpty()) {
                $imageData = DB::table('service_images')->where('service_id', $id)->get();
                $services[0]->is_liked = 0;
                if ($request->user_id >= 1) {
                    $is_liked = DB::table('service_likes')
                        ->select(['service_id'])
                        ->where('user_id', $request->user_id)
                        ->first();
                    $services[0]->is_liked = isset($is_liked->service_id) ? 1 : 0;
                }
                $services[0]->baseurl = $s_img;
                $services[0]->images =  $imageData;
                $activities = DB::table('service_activities as s_act')->select([
                    's_act.*',
                    'act.activity'
                ])
                    ->leftJoin('activities as act', 'act.id', '=', 's_act.activity_id')
                    ->where('s_act.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->included_activities = $activities ?? [];
                $dependencies = DB::table('service_dependencies as s_dep')
                    ->select(['dep.*', 'dep.dependency_name'])
                    ->leftJoin('dependency as dep', 'dep.id', '=', 's_dep.dependency_id')
                    ->where('s_dep.service_id', $id)
                    ->get()
                    ->toArray();
                $services[0]->dependencies = $dependencies ?? [];
                $programs = DB::table('service_programs')
                    ->select([
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
                    ->select(
                        [
                            'service_id',
                            DB::raw("AVG(star) AS stars"),
                            DB::raw("COUNT(user_id) AS reviewd_by")
                        ]
                    )
                    ->where('service_id', $id)
                    ->groupBy('service_id')
                    ->first();
                $services[0]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
                $services[0]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
                $booked_seats_qry = DB::table('bookings')
                    ->select(['id'])
                    ->where(['service_id' => $id, 'status' => 1])
                    ->get();
                $booked_seats = $booked_seats_qry->count();
                $services[0]->booked_seats = $booked_seats;
                $aimedforData = DB::table('service_service_for as ssfor')
                    ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                    ->select('sfor.*', 'ssfor.service_id')
                    ->where('ssfor.service_id', $id)
                    ->get();

                $services[0]->aimed_for = $aimedforData;
                $services[0]->remaining_seats = $services[0]->available_seats - $booked_seats;
                return $this->sendResponse(config('constants.DATA_FOUND'), $services[0], 200);
            }
        } else {
            $star_ratings = [];
            $star_ratings_res = DB::table('service_reviews')
                ->select(['service_id', DB::raw("AVG(star) AS stars"), DB::raw("COUNT(user_id) AS reviewd_by")])
                ->groupBy('service_id')
                ->get()->toArray();
            if (count($star_ratings_res)) {
                foreach ($star_ratings_res as $rat) {
                    $star_ratings[$rat->service_id] = (array) $rat;
                }
            }
            $liked_services = [];
            if ($request->user_id >= 1) {
                $liked_services_res = DB::table('service_likes')
                    ->select(['service_id'])
                    ->where(['user_id' => $request->user_id])
                    ->get()->toArray();
                if (count($liked_services_res)) {
                    foreach ($liked_services_res as $res) {
                        $liked_services[] = $res->service_id;
                    }
                }
            }

            $services = DB::table('services as srvc')
                ->select([
                    'srvc.*',
                    'srvc.id as service_id',
                    'usr.name as provided_by',
                    DB::raw("CONCAT('" . $url . "',usr.profile_image) AS provider_profile"),
                    // DB::raw("CONCAT('" . $s_img . "/',simag.image_url) AS image_url"), 
                    DB::raw("CONCAT('" . $s_img . "/',simag.thumbnail) AS thumbnail"),
                    DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                    'scat.category as service_category',
                    'ssec.sector as service_sector',
                    'styp.type as service_type',
                    'slvl.level as service_level',
                    'cntri.country',
                    'rgn.region',
                    'srvc.currency',
                    //'srvc.sfor_id as aimed_for', 
                    DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                    'srvc.cost_inc as including_gerea_and_other_taxes',
                    'srvc.cost_exc as excluding_gerea_and_other_taxes'
                ])
                ->join('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('service_images as simag', 'srvc.id', '=', 'simag.service_id')
                ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
                ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
                ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
                //->leftJoin('currencies as curr', 'curr.id', '=', 'srvc.currency')
                ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
                ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
                ->leftJoin('durations as dur', 'dur.id', '=', 'srvc.duration')
                ->leftJoin('service_images as simg', 'simg.service_id', '=', 'srvc.id')
                ->whereRaw($where)
                ->where(['srvc.deleted_at' => NULL])
                ->groupBy('ssfor.service_id')
                ->orderBy('updated_at', $recently_added)
                ->get();

            foreach ($services as $key => $ser) {

                $service_id = $ser->id;
                $imageData = DB::table('service_images')->where('service_id', $service_id)->get();
                $aimedforData = DB::table('service_service_for as ssfor')
                    ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                    ->select('sfor.*', 'ssfor.service_id')
                    ->where('ssfor.service_id', $service_id)
                    ->get();

                $services[$key]->aimed_for = $aimedforData;
                $services[$key]->stars = isset($star_ratings[$service_id]) ? number_format($star_ratings[$service_id]['stars'], 2, '.', '') : 0;
                $services[$key]->is_liked = in_array($service_id, $liked_services) ? 1 : 0;
                $services[$key]->baseurl = $s_img;
                $services[$key]->images =  $imageData;
            }
        }
        if (!$services->isEmpty()) {
            return $this->sendResponse(config('constants.DATA_FOUND'), $services, 200);
        }
        return $this->sendError('No record found.', [], 404);
    }


    public function get_all(Request $request)
    {

        $result = array();
        $url = asset('public');
        $s_img = asset('public/uploads');

        $service_category = DB::table('service_categories')->where('status', 1)->orderBy('id', 'DESC')->where('deleted_at', NULL)->get();


        $star_ratings = [];
        $star_ratings_res = DB::table('service_reviews')
            ->select(['service_id', DB::raw("AVG(star) AS stars"), DB::raw("COUNT(user_id) AS reviewd_by")])
            ->groupBy('service_id')
            ->get()->toArray();
        if (count($star_ratings_res)) {
            foreach ($star_ratings_res as $rat) {
                $star_ratings[$rat->service_id] = (array) $rat;
            }
        }
        $liked_services = [];
        if ($request->user_id >= 1) {
            $liked_services_res = DB::table('service_likes')
                ->select(['service_id'])
                ->where(['user_id' => $request->user_id])
                ->get()->toArray();
            if (count($liked_services_res)) {
                foreach ($liked_services_res as $res) {
                    $liked_services[] = $res->service_id;
                }
            }
        }

        $serviceCategory = array();
        foreach ($service_category as $category) {
            $service_array = array();
            $services = DB::table('services as srvc')
                ->select([
                    'srvc.*',
                    'srvc.id as service_id',
                    'usr.name as provided_by',
                    DB::raw("CONCAT('" . $url . "',usr.profile_image) AS provider_profile"),
                    DB::raw("CONCAT('" . $s_img . "/',simg.image_url) AS image_url"),
                    DB::raw("CONCAT('" . $s_img . "/',simg.thumbnail) AS thumbnail"),
                    DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                    'scat.category as service_category',
                    'ssec.sector as service_sector',
                    'styp.type as service_type',
                    'slvl.level as service_level',
                    'cntri.country',
                    'rgn.region',
                    'curr.code as currency',
                    //DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                    'srvc.cost_inc as including_gerea_and_other_taxes',
                    'srvc.cost_exc as excluding_gerea_and_other_taxes'
                ])
                ->join('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('service_images as simg', 'srvc.id', '=', 'simg.service_id')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
                ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
                ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
                ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
                ->leftJoin('currencies as curr', 'curr.id', '=', 'srvc.currency')
                ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
                ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
                ->leftJoin('durations as dur', 'dur.id', '=', 'srvc.duration')
                ->where(['srvc.service_category' => $category->id])
                ->where(['srvc.deleted_at' => NULL])
                // ->groupBy('ssfor.service_id')
                ->orderBy('srvc.id',  'DESC')
                ->get();
            //dd($services);        
            foreach ($services as $key => $ser) {
                $service_id = $ser->id;
                $imageData = DB::table('service_images')->where('service_id', $service_id)->get();
                $aimedforData = DB::table('service_service_for as ssfor')
                    ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                    ->select('sfor.*', 'ssfor.service_id')
                    ->where('ssfor.service_id', $service_id)
                    ->get();

                $services[$key]->aimed_for = $aimedforData;
                $services[$key]->stars = isset($star_ratings[$service_id]) ? number_format($star_ratings[$service_id]['stars'], 2, '.', '') : 0;
                $services[$key]->is_liked = in_array($service_id, $liked_services) ? 1 : 0;
                $services[$key]->baseurl = $s_img;
                $services[$key]->images = $imageData;

                //$service_array[]=$ser;
            }
            if (!$services->isEmpty()) {
                $service_array = array(
                    'category' => $category->category,
                    'services' => $services
                );
            }
            if (!empty($service_array)) {
                array_push($serviceCategory, $service_array);
            }
        }
        return $this->sendResponse(config('constants.DATA_FOUND'), $serviceCategory, 200);
    }

    public function myServicereview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            //$liked = DB::table('service_likes')->where(['user_id' => $request->user_id, 'service_id' => $request->service_id])->get();
            $liked = DB::table('users')
                ->leftJoin('service_reviews', 'users.id', '=', 'service_reviews.user_id')
                ->leftJoin('service_likes', 'users.id', '=', 'service_likes.user_id')
                ->get();
            return $this->sendResponse('Liked', $liked, 200);
        }
    }

    public function likeService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'like' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
                //print_r($messages); die;
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $liked = DB::table('service_likes')
                ->where([
                    'user_id' => $request->user_id,
                    'service_id' => $request->service_id
                ])
                ->first();
            //dd($liked);
            if (!empty($liked)) {
                if ($request->like == 0) {
                    DB::table('service_likes')->where(['user_id' => $request->user_id, 'service_id' => $request->service_id])->delete();
                    //DB::table('service_plan_day_date')->where('service_id', '=', $service_id)->delete();
                    return $this->sendResponse('DisLiked', [], 200);
                } elseif ($request->like == 1) {
                    //DB::table('service_likes')->insert(['user_id' => $request->user_id, 'service_id' => $request->service_id, 'is_like' => $request->like]);
                    return $this->sendResponse('Already Liked', [], 200);
                } else {
                    return $this->sendError('First like and then dislike', [], 401);
                }
            } else {
                if ($request->like == 1) {
                    DB::table('service_likes')->insert(['user_id' => $request->user_id, 'service_id' => $request->service_id, 'is_like' => $request->like]);
                    return $this->sendResponse('Liked', [], 200);
                } else {
                    return $this->sendError('Not Liked Please Try again', [], 401);
                }
            }
        }
    }

    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'star' => 'required|numeric|min:1|max:5',
            'remark' => 'required|min:10|max:150',
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            if (DB::table('service_reviews')->insert([
                'user_id' => $request->user_id,
                'service_id' => $request->service_id,
                'star' => $request->star,
                'remark' => $request->remark
            ])) {
                $review_id = DB::getPdo()->lastInsertId();
                $rev_data = DB::table('service_reviews')->where(['id' => $review_id])->first();
                return $this->sendResponse('Review added successfully', $rev_data, 200);
            } else {
                return $this->sendError('Something went wrong', [], 401);
            }
        }
    }

    public function bookService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'adult' => 'required|numeric',
            'kids' => 'required|numeric',
            'message' => 'required',
            'points' => 'numeric',
            'coupon_applied' => 'required|numeric',
            'promo_code' => '',
            'booking_date' => 'required|date_format:Y-m-d'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $service_detail = DB::table('services')->where(['id' => $request->service_id])->first();
            if (!$service_detail) {
                return $this->sendError('Adventure not found.', [], 401);
            }
            $service_exc_amt = $service_detail->cost_exc;
            $service_inc_amt = $service_detail->cost_inc;
            $total_amt = $service_inc_amt * ($request->adult + $request->kids);
            $service_disc_amt = $total_amt;
            $disc_typ = '';
            $disc_amt = '';
            $flag = false;
            if ($request->promo_code) {
                $promocode = DB::table('promocode')->where(['code' => $request->promo_code])->first();
                if ($promocode) {
                    if ($promocode->discount_type == '1') {
                        $disc_typ = 1; //Direct amount
                        $disc_amt = $promocode->discount_amount;
                        $service_disc_amt = $total_amt - $disc_amt;
                    } elseif ($promocode->discount_type == '2') {
                        $disc_typ = 2; // Percentage discount
                        $disc_amt = $promocode->discount_amount;
                        $service_disc_amt = $total_amt - (($total_amt * $disc_amt) / 100);
                    }
                    $flag = true;
                }
            }

            if (DB::table('bookings')->insert([
                'user_id' => $request->user_id,
                'service_id' => $request->service_id,
                'adult' => $request->adult,
                'kids' => $request->kids,
                'message' => $request->message,
                'booking_date' => $request->booking_date,
                'currency' => $service_detail->currency,
                'coupon_applied' => $flag,
                'unit_amount' => $service_inc_amt,
                'total_amount' => $total_amt,
                'discounted_amount' => $service_disc_amt,
                'created_at' => date('Y-m-d H:i:s'),
            ])) {
                $booking_id = DB::getPdo()->lastInsertId();
                $booking_data = DB::table('bookings')->select(['*', 'id as booking_id'])->where(['id' => $booking_id])->first();
                if ($flag) {
                    DB::table('promocode_users')->insert([
                        'booking_id' => $booking_id,
                        'user_id' => $request->user_id,
                        'service_id' => $request->service_id,
                        'promocode_id' => $promocode->id,
                        'promocode' => $promocode->code,
                        'disc_type' => $promocode->discount_type,
                        'disc_amt' => $disc_amt,
                        'service_amt_befor_disc' => $total_amt,
                        'service_amt_after_disc' => $service_disc_amt,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }

                return $this->sendResponse('Booking has been successfull.', $booking_data, 200);
            } else {
                return $this->sendError('Something went wrong', [], 401);
            }
        }
    }

    public function checkPromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'promo_code' => 'required'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $promocode = DB::table('promocode')->select(['*', DB::raw("IF(discount_type = '1','Amount','Percentage') AS discount_type")])
                ->where('code' ,'=', $request->promo_code)
                ->first();
              //  dd(time());
              //  dd(strtotime($promocode->start_date));
            if ($promocode) {
                return $this->sendResponse('Valid code', $promocode, 200);
                if (strtotime($promocode->start_date) <= time() && strtotime($promocode->end_date) >= time()) {
                    return $this->sendResponse('Valid code', $promocode, 200);
                } else {
                    return $this->sendError('Expired code', [], 401);
                }
            } else {
                return $this->sendError('Invalid code', [], 401);
            }
        }
    }

    public function updatePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'booking_id' => 'required|numeric',
            'payment_method' => 'required',
            'amount' => 'required|numeric',
            'transaction_id' => 'required',
            'transaction_date' => 'required',
            'transaction_date' => 'required',
            'account_name' => 'required',
            'status' => 'required|numeric',
            'points' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $booking = DB::table('bookings')->where([
                'id' => $request->booking_id, 'status' => 0
            ])->first();
            if ($booking) {
                if (DB::table('payments')->insert([
                    'user_id' => $request->user_id,
                    'service_id' => $request->service_id,
                    'booking_id' => $request->booking_id,
                    'payment_method' => $request->payment_method,
                    'amount' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'transaction_date' => $request->transaction_date,
                    'account_name' => $request->account_name,
                    'status' => $request->status,
                    'created_at' => date('Y-m-d H:i:s'),
                ])) {
                    $payment_id = DB::getPdo()->lastInsertId();
                    DB::table('bookings')->where([
                        'id' => $request->booking_id
                    ])
                        ->update([
                            'payment_status' => $request->status
                        ]);
                    $this->updateWallet($request, $payment_id);
                    return $this->sendResponse('Payment updated successfully', [], 200);
                } else {
                    return $this->sendError('Something went wrong.', [], 401);
                }
            } else {
                return $this->sendError('No booking found or already paid. Create a new booking.', [], 401);
            }
        }
    }

    public function updateWallet($request, $payment_id, $transaction_type = 1)
    {
        $user_id = $request->user_id;
        $wallet = DB::table('wallets')->where('user_id', $user_id)->orderBy('id', 'DESC')->first();
        if ($wallet) {
            $last_wallet_amt = $wallet->current_amt;
        } else {
            $last_wallet_amt = 0;
        }

        $service_detail = Service::select(['points'])->where(['id' => $request->service_id])->first();
        $earn_points = $service_detail->points;

        if ($transaction_type == 1 && $earn_points > 0) {
            $wallet_data = array(
                'user_id' => $request->user_id,
                'booking_id' => $request->booking_id,
                'payment_id' => $payment_id,
                'amount_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $wallet_data['credit_amt'] = $earn_points;
            $new_balance = $last_wallet_amt + $earn_points;
            $wallet_data['current_amt'] = $new_balance;
            DB::table('wallets')->insert($wallet_data);
        }

        $wallet_new = DB::table('wallets')->where('user_id', $user_id)->orderBy('id', 'DESC')->first();
        if ($wallet_new) {
            $last_wallet_amt = $wallet_new->current_amt;
        } else {
            $last_wallet_amt = 0;
        }
        if ($request->points > 0) {
            $wallet_data = array(
                'user_id' => $request->user_id,
                'booking_id' => $request->booking_id,
                'payment_id' => $payment_id,
                'amount_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            if ($last_wallet_amt > $request->points) {
                $wallet_data['debit_amt'] = $request->points;
                $new_balance = $last_wallet_amt - $request->points;
                $wallet_data['current_amt'] = $new_balance;
            } else {
                $wallet_data['debit_amt'] = 0;
                $new_balance = $last_wallet_amt - 0;
                $wallet_data['current_amt'] = $new_balance;
                $wallet_data['note'] = 'You have not insufficient points';
            }
            DB::table('wallets')->insert($wallet_data);
        }
    }

    public function addFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $favourite = DB::table('favourites')->where(['user_id' => $request->user_id, 'service_id' => $request->service_id])->first();
            if ($favourite) {
                if (DB::table('favourites')->where([
                    'user_id' => $request->user_id,
                    'service_id' => $request->service_id
                ])->update(['updated_at' => date('Y-m-d H:i:s')])) {
                    return $this->sendResponse('Added to favourite', [], 200);
                } else {
                    return $this->sendError('Something went wrong.', [], 401);
                }
            } else {
                if (DB::table('favourites')->insert([
                    'user_id' => $request->user_id,
                    'service_id' => $request->service_id,
                    'created_at' => date('Y-m-d H:i:s')
                ])) {
                    return $this->sendResponse('Added to favourite', [], 200);
                } else {
                    return $this->sendError('Something went wrong.', [], 401);
                }
            }
        }
    }

    public function removeFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric'

        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            //if ($request->remove == 1) {
            if (DB::table('favourites')->where([
                'user_id' => $request->user_id,
                'service_id' => $request->service_id
            ])->delete()) {



                return $this->sendResponse('Remove from favourite', [], 200);
            } else {

                return $this->sendError('No record found to delete.', [], 401);
                //  }
            }
            return $this->sendError('No record found to delete.', [], 401);
        }
    }

    public function getFavourite(Request $request)
    {
        $url = asset('public/profile_image/');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $star_ratings = [];
            $star_ratings_res = DB::table('service_reviews')
                ->select(['service_id', DB::raw("AVG(star) AS stars"), DB::raw("COUNT(user_id) AS reviewd_by")])
                ->groupBy('service_id')
                ->get()->toArray();
            if (count($star_ratings_res)) {
                foreach ($star_ratings_res as $rat) {
                    $star_ratings[$rat->service_id] = (array) $rat;
                }
            }
            //echo $request->user_id; die('-----------');
            $liked_services = [];
            if ($request->user_id >= 1) {
                $liked_services_res = DB::table('service_likes')
                    ->select(['service_id'])
                    ->where(['user_id' => $request->user_id])
                    ->get()->toArray();
                if (count($liked_services_res)) {
                    foreach ($liked_services_res as $res) {
                        $liked_services[] = $res->service_id;
                    }
                }
            }
            //print_r($liked_services);die('-----------');
            $services = DB::table('services as srvc')
                ->select([
                    'srvc.id',
                    'srvc.adventure_name',
                    'srvc.cost_inc',
                    'srvc.cost_exc',
                    'srvc.image',
                    'srvc.descreption',
                    'srvc.favourite_image',
                    'srvc.created_at',
                    'srvc.updated_at',
                    'usr.name as provided_by',
                    DB::raw("CONCAT('" . $url . "/',usr.profile_image) AS provider_profile"),
                    DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                    'scat.category as service_category',
                    'ssec.sector as service_sector',
                    'styp.type as service_type',
                    'slvl.level as service_level',
                    'cntri.country',
                    'curr.code as currency',
                    // DB::raw("GROUP_CONCAT(sfor.sfor ) as aimed_for"),
                    DB::raw(
                        "dur.duration as duration",
                        DB::raw("IF(slike.is_like=1,slike.is_like,0) AS is_liked")
                    )
                ])
                ->join('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
                ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
                ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
                ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
                ->leftJoin('currencies as curr', 'curr.id', '=', 'srvc.currency')
                ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
                ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
                ->leftJoin('durations as dur', 'dur.id', '=', 'srvc.duration')
                ->leftJoin('service_likes as slike', 'slike.service_id', '=', 'srvc.id')
                ->leftJoin('favourites as fav', 'fav.service_id', '=', 'srvc.id')
                ->where('fav.user_id', $request->user_id)
                ->groupBy('ssfor.service_id')
                ->get();

            if (!$services->isEmpty()) {
                foreach ($services as $key => $ser) {
                    $service_id = $ser->id;
                    $aimedforData = DB::table('service_service_for as ssfor')
                        ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                        ->select('sfor.*', 'ssfor.service_id')
                        ->where('ssfor.service_id', $service_id)
                        ->get();

                    $services[$key]->aimed_for = $aimedforData;
                    $services[$key]->stars = isset($star_ratings[$service_id]) ? number_format($star_ratings[$service_id]['stars'], 2, '.', '') : 0;
                    $services[$key]->is_liked = in_array($service_id, $liked_services) ? 1 : 0;
                }
                return $this->sendResponse(config('constants.DATA_FOUND'), $services, 200);
            }
            return $this->sendError('No record found.', [], 404);
        }
    }


    public function servicesFilter(Request $request)
    {
        //dd($request->all());
        $url = asset('public');
        $s_img = asset('public/uploads') . '/';
        if ($request->service_id) {
            $where = 'srvc.id = ' . $request->service_id . ' ';
        } else {
            $where = '1';
        }

        if ($request->type) {
            $where .= ' && styp.id = ' . $request->type;
        }
        if ($request->aimed) {
            $where .= ' && ssfor.sfor_id = ' . $request->aimed;
        }
        if ($request->level) {
            $where .= ' && slvl.id = ' . $request->level;
        }
        if ($request->duration) {
            $where .= ' && dur.id = ' . $request->duration;
        }

        $services = DB::table('services as srvc')
            ->select([
                'srvc.*',
                'srvc.id as service_id',
                'usr.name as provided_by',
                DB::raw("CONCAT('" . $url . "',usr.profile_image) AS provider_profile"),
                //DB::raw("CONCAT('" . $s_img . "/',simg.image_url) AS image_url"),
                DB::raw("CONCAT('" . $s_img . "/',simg.thumbnail) AS thumbnail"),
                DB::raw("CONCAT(srvc.duration,' Min') AS duration"),
                'scat.category as service_category',
                'ssec.sector as service_sector',
                'styp.type as service_type',
                'slvl.level as service_level',
                'cntri.country',
                'rgn.region',
                'srvc.currency',
                //'srvc.sfor_id as aimed_for', 
                // DB::raw("GROUP_CONCAT(sfor.sfor) as aimed_for"),
                'srvc.cost_inc as including_gerea_and_other_taxes',
                'srvc.cost_exc as excluding_gerea_and_other_taxes'
            ])
            ->join('users as usr', 'usr.id', '=', 'srvc.owner')
            ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
            ->leftJoin('service_images as simg', 'srvc.id', '=', 'simg.service_id')
            ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
            ->leftJoin('service_categories as scat', 'scat.id', '=', 'srvc.service_category')
            ->leftJoin('service_sectors as ssec', 'ssec.id', '=', 'srvc.service_sector')
            ->leftJoin('service_types as styp', 'styp.id', '=', 'srvc.service_type')
            ->leftJoin('service_levels as slvl', 'slvl.id', '=', 'srvc.service_level')
            ->leftJoin('currencies as curr', 'curr.id', '=', 'srvc.currency')
            ->leftJoin('service_service_for as ssfor', 'ssfor.service_id', '=', 'srvc.id')
            ->leftJoin('service_for as sfor', 'sfor.id', '=', 'ssfor.sfor_id')
            ->where(['srvc.deleted_at' => NULL])
            ->groupBy('ssfor.service_id')
            ->whereRaw($where)
            ->get();
        //dd($services);


        if (!$services->isEmpty()) {
            foreach ($services as $key => $ser) {
                $service_id = $ser->id;
                $imageData = DB::table('service_images')->where('service_id', $service_id)->get();
                $services[$key]->is_liked = 0;
                if ($request->user_id >= 1) {
                    $is_liked = DB::table('service_likes')
                        ->select(['service_id'])
                        ->where('user_id', $request->user_id)
                        ->first();
                    $services[$key]->is_liked = isset($is_liked->service_id) ? 1 : 0;
                }
                $services[$key]->baseurl = $s_img;
                $services[$key]->images =  $imageData;
                $activities = DB::table('service_activities as s_act')->select([
                    's_act.*',
                    'act.activity'
                ])
                    ->leftJoin('activities as act', 'act.id', '=', 's_act.activity_id')
                    ->where('s_act.service_id', $service_id)
                    ->get()
                    ->toArray();
                $services[$key]->included_activities = $activities ?? [];
                // $dependencies = DB::table('service_dependencies as s_dep')
                //     ->select(['dep.*', 'dep.dependency_name'])
                //     ->leftJoin('dependency as dep', 'dep.id', '=', 's_dep.dependency_id')
                //     ->where('s_dep.service_id', $service_id)
                //     ->get()
                //     ->toArray();
                // $services[$key]->dependencies = $dependencies ?? [];
                // $programs = DB::table('service_programs')
                //     ->select([
                //         'id',
                //         'service_id',
                //         'title',
                //         'start_datetime',
                //         'end_datetime',
                //         'description'
                //     ])
                //     ->where('service_id', $service_id)
                //     ->get();
                // $services[$key]->programs = $programs;
                if ($services[$key]->service_plan == 1) {
                    $availability = DB::table('service_plan_day_date as spdd')
                        ->select(['spdd.id', 'wkd.day'])
                        ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                        ->where('spdd.service_id', $service_id)
                        ->get()
                        ->toArray();
                    $services[$key]->availability = $availability ?? [];
                } else if ($services[$key]->service_plan == 2) {
                    $availability = DB::table('service_plan_day_date as spdd')
                        ->select(['spdd.id', 'spdd.date'])
                        ->where('spdd.service_id', $service_id)
                        ->get()
                        ->toArray();
                    $services[$key]->availability = $availability ?? [];
                }
                $star_ratings_res = DB::table('service_reviews')
                    ->select(
                        [
                            'service_id',
                            DB::raw("AVG(star) AS stars"),
                            DB::raw("COUNT(user_id) AS reviewd_by")
                        ]
                    )
                    ->where('service_id', $service_id)
                    ->groupBy('service_id')
                    ->first();
                $services[$key]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
                $services[$key]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
                $booked_seats_qry = DB::table('bookings')
                    ->select(['id'])
                    ->where(['service_id' => $service_id, 'status' => 1])
                    ->get();
                $booked_seats = $booked_seats_qry->count();
                $services[$key]->booked_seats = $booked_seats;
                $aimedforData = DB::table('service_service_for as ssfor')
                    ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                    ->select('sfor.*', 'ssfor.service_id')
                    ->where('ssfor.service_id', $service_id)
                    ->get();

                $services[$key]->aimed_for = $aimedforData;
                $services[$key]->remaining_seats = $services[0]->available_seats - $booked_seats;





                /*-------------*/
            }
            return $this->sendResponse(config('constants.DATA_FOUND'), $services, 200);
        }
    }

    public function getPoints(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $wallet = DB::table('wallets')
                ->where('user_id', $request->user_id)
                ->orderBy('id', 'DESC')
                ->first();
            if ($wallet) {
                $last_wallet_amt = $wallet->current_amt;
            } else {
                $last_wallet_amt = '0.00';
            }
        }
        return $this->sendResponse("Points in your account.", [
            'points' => $last_wallet_amt
        ], 200);
    }

    public function getPurpose()
    {
        $purpose = DB::table('contact_us_purpose')
            ->where(['status' => 1])
            ->orderBy('purpose', 'ASC')
            ->get();
        if ($purpose) {
            return $this->sendResponse("Purpose list", $purpose, 200);
        } else {
            return $this->sendError('No record found', [], 401);
        }
    }

    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'mobile_code' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
            'email' => 'required|email:filter',
            'purpose' => 'required',
            'subject' => 'required|min:3|max:200',
            'message' => 'required|min:3|max:500'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $data = [
                'name' => $request->name,
                'mobile_code' => $request->mobile_code,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'purpose' => $request->purpose,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if (DB::table('contact_us')->insert($data)) {
                return $this->sendResponse("Query has been sent.", [], 200);
            } else {
                return $this->sendError('Something went wrong. Try again.', $data, 401);
            }
        }
    }

    public function getRequests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'type' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $type = $request->type;
            $where = ' bkng.booking_date >= CURDATE() and bkng.status !=2 ';
            if ($type == 1) {
                $where = ' bkng.booking_date < CURDATE() and bkng.status !=2 ';
            };
            $booking = DB::table('bookings as bkng')
                ->select([
                    'bkng.id as booking_id',
                    'srvc.id as service_id',
                    'cntri.country',
                    'rgn.region',
                    'srvc.adventure_name',
                    'usr.name as provider_name',
                    'usr.height as height',
                    'usr.weight as weight',
                    'usr.health_conditions as health_conditions',
                    DB::raw('DATE_FORMAT(bkng.created_at, "%Y-%m-%d") as booking_date'),
                    'bkng.booking_date as activity_date',
                    'bkng.adult',
                    'bkng.kids',
                    'bkng.unit_amount as unit_cost',
                    'bkng.total_amount as total_cost',
                    'pmnt.payment_method as payment_channel',
                    DB::raw("IF(bkng.status = 1,'Confirmed', IF(bkng.status=3,'Accepted','Requested')) as booking_status"),
                    DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status"),
                    'srvc.points',
                    'srvc.write_information as description',
                    'simg.image_url',
                    DB::raw('CONCAT(adult," Adults, ",kids," Kids") as registrations'),
                ])
                ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
                ->leftJoin('service_images as simg', function ($join) {
                    $join->on('simg.service_id', '=', 'srvc.id')
                        ->where('simg.is_default', '=', 1);
                })
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('payments as pmnt', function ($join) {
                    $join->on('pmnt.booking_id', '=', 'bkng.id')
                        ->where('pmnt.status', '=', 1);
                })
                ->where(['bkng.user_id' => $request->user_id])
                ->whereRaw($where)
                ->get();
            //echo '';print_r($booking);die;

            if ($booking) {
                //$booking;
                //return $this->sendResponse("Request list", 'Booking Cancelled!', 200);
                return $this->sendResponse("Request list", $booking, 200);
            } else {
                return $this->sendError('No record found', [], 401);
            }
        }
    }

    public function scheduledSession(Request $request)
    {

        $url = asset('public');
        $s_img = asset('public/uploads') . '/';
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {

            $liked_services = [];
            if ($request->user_id >= 1) {
                $liked_services_res = DB::table('service_likes')
                    ->select(['service_id'])
                    ->where(['user_id' => $request->user_id])
                    ->get()->toArray();
                if (count($liked_services_res)) {
                    foreach ($liked_services_res as $res) {
                        $liked_services[] = $res->service_id;
                    }
                }
            }
            $where = " bkng.booking_date = '" . date('Y-m-d', strtotime($request->date)) . "'";
            $booking = DB::table('bookings as bkng')
                ->select([
                    'bkng.id as booking_id',
                    'srvc.id as service_id',
                    'bkng.currency',
                    'cntri.country',
                    'rgn.region',
                    'srvc.adventure_name',
                    'srvc.service_plan',
                    'srvc.service_level',
                    'usr.name as provider_name',
                    DB::raw("CONCAT('" . $url . "/',usr.profile_image) AS provider_profile"),
                    'bkng.booking_date',
                    'bkng.adult',
                    'bkng.kids',
                    'bkng.unit_amount as unit_cost',
                    'bkng.total_amount as total_cost',
                    'pmnt.payment_method as payment_channel',
                    'simg.image_url',
                    'srvc.points',
                    'bkng.message',
                    DB::raw("IF(bkng.status = 1,'Confirmed',IF(bkng.status=2,'Cancelled','Requested')) as booking_status"),
                    DB::raw("IF(bkng.payment_status = 1,'Success',IF(bkng.payment_status=2,'Failed','Pending')) as payment_status"),
                    'srvc.points',
                    'srvc.write_information as description',
                    'simg.image_url'
                ])
                ->leftJoin('services as srvc', 'srvc.id', '=', 'bkng.service_id')
                ->leftJoin('service_images as simg', function ($join) {
                    $join->on('simg.service_id', '=', 'srvc.id')
                        ->where('simg.is_default', '=', 1);
                })
                ->leftJoin('countries as cntri', 'cntri.id', '=', 'srvc.country')
                ->leftJoin('regions as rgn', 'rgn.id', '=', 'srvc.region')
                ->leftJoin('users as usr', 'usr.id', '=', 'srvc.owner')
                ->leftJoin('payments as pmnt', 'pmnt.booking_id', '=', 'bkng.id')
                ->where(['bkng.user_id' => $request->user_id])
                ->whereRaw($where)
                ->get();
            if (!$booking->isEmpty()) {
                foreach ($booking as $key => $ser) {
                    $service_id = $ser->service_id;
                    $aimedforData = DB::table('service_service_for as ssfor')
                        ->join('service_for as sfor', 'ssfor.sfor_id', '=', 'sfor.id')
                        ->select('sfor.*', 'ssfor.service_id')
                        ->where('ssfor.service_id', $service_id)
                        ->get();

                    $booking[$key]->aimed_for = $aimedforData;
                    $booking[$key]->is_liked = in_array($service_id, $liked_services) ? 1 : 0;

                    $imageData = DB::table('service_images')->where('service_id', $service_id)->get();
                    $booking[$key]->is_liked = 0;
                    if ($request->user_id >= 1) {
                        $is_liked = DB::table('service_likes')
                            ->select(['service_id'])
                            ->where('user_id', $request->user_id)
                            ->first();
                        $booking[$key]->is_liked = isset($is_liked->service_id) ? 1 : 0;
                    }
                    $booking[$key]->baseurl = $s_img;
                    $booking[$key]->images =  $imageData;
                    $activities = DB::table('service_activities as s_act')->select([
                        's_act.*',
                        'act.activity'
                    ])
                        ->leftJoin('activities as act', 'act.id', '=', 's_act.activity_id')
                        ->where('s_act.service_id', $service_id)
                        ->get()
                        ->toArray();
                    $booking[$key]->included_activities = $activities ?? [];
                }

                if ($booking[$key]->service_plan == 1) {
                    $availability = DB::table('service_plan_day_date as spdd')
                        ->select(['spdd.id', 'wkd.day'])
                        ->join('weekdays as wkd', 'wkd.id', '=', 'spdd.day')
                        ->where('spdd.service_id', $service_id)
                        ->get()
                        ->toArray();
                    $booking[$key]->availability = $availability ?? [];
                } else if ($booking[$key]->service_plan == 2) {
                    $availability = DB::table('service_plan_day_date as spdd')
                        ->select(['spdd.id', 'spdd.date'])
                        ->where('spdd.service_id', $service_id)
                        ->get()
                        ->toArray();
                    $booking[$key]->availability = $availability ?? [];
                }
                $star_ratings_res = DB::table('service_reviews')
                    ->select(
                        [
                            'service_id',
                            DB::raw("AVG(star) AS stars"),
                            DB::raw("COUNT(user_id) AS reviewd_by")
                        ]
                    )
                    ->where('service_id', $service_id)
                    ->groupBy('service_id')
                    ->first();
                $booking[$key]->stars = $star_ratings_res ? number_format($star_ratings_res->stars, 2, '.', '') : 0;
                $booking[$key]->reviewd_by = $star_ratings_res ? $star_ratings_res->reviewd_by : 0;
                $booked_seats_qry = DB::table('bookings')
                    ->select(['id'])
                    ->where(['service_id' => $service_id, 'status' => 1])
                    ->get();
                $booked_seats = $booked_seats_qry->count();
                $booking[$key]->booked_seats = $booked_seats;
                return $this->sendResponse("Request list", $booking, 200);
            } else {
                return $this->sendError('No record found', [], 401);
            }
        }
    }

    public function planForFuture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'adult' => 'required|numeric',
            'kids' => 'required|numeric',
            'message' => 'required',
            'points' => 'numeric',
            'coupon_applied' => 'required|numeric',
            'promo_code' => '',
            'desired_date' => 'required|date_format:Y-m-d|after:today'
        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $service_detail = DB::table('services')->where(['id' => $request->service_id])->first();
            if (!$service_detail) {
                return $this->sendError('Adventure not found.', [], 401);
            }
            $service_exc_amt = $service_detail->cost_exc;
            $service_inc_amt = $service_detail->cost_inc;
            $total_amt = $service_inc_amt * ($request->adult + $request->kids);
            $service_disc_amt = $total_amt;
            $disc_typ = '';
            $disc_amt = '';
            $flag = false;
            if ($request->promo_code) {
                $promocode = DB::table('promocode')->where(['code' => $request->promo_code])->first();
                if ($promocode) {
                    if ($promocode->discount_type == '1') {
                        $disc_typ = 1; //Direct amount
                        $disc_amt = $promocode->discount_amount;
                        $service_disc_amt = $total_amt - $disc_amt;
                    } elseif ($promocode->discount_type == '2') {
                        $disc_typ = 2; // Percentage discount
                        $disc_amt = $promocode->discount_amount;
                        $service_disc_amt = $total_amt - (($total_amt * $disc_amt) / 100);
                    }
                    $flag = true;
                }
            }

            if (DB::table('bookings')->insert([
                'user_id' => $request->user_id,
                'service_id' => $request->service_id,
                'adult' => $request->adult,
                'kids' => $request->kids,
                'message' => $request->message,
                'future_plan' => 1,
                'booking_date' => $request->desired_date,
                'currency' => $service_detail->currency,
                'coupon_applied' => $flag,
                'unit_amount' => $service_inc_amt,
                'total_amount' => $total_amt,
                'discounted_amount' => $service_disc_amt,
                'created_at' => date('Y-m-d H:i:s'),
            ])) {
                $booking_id = DB::getPdo()->lastInsertId();
                $booking_data = DB::table('bookings')->select(['*', 'id as booking_id'])->where(['id' => $booking_id])->first();
                if ($flag) {
                    DB::table('promocode_users')->insert([
                        'booking_id' => $booking_id,
                        'user_id' => $request->user_id,
                        'service_id' => $request->service_id,
                        'promocode_id' => $promocode->id,
                        'promocode' => $promocode->code,
                        'disc_type' => $promocode->discount_type,
                        'disc_amt' => $disc_amt,
                        'service_amt_befor_disc' => $total_amt,
                        'service_amt_after_disc' => $service_disc_amt,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }

                return $this->sendResponse('Request has been sent successfull.', $booking_data, 200);
            } else {
                return $this->sendError('Something went wrong', [], 401);
            }
        }
    }

    public function cancelrequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'id' => 'required|numeric'

        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $user_id    = $request->post('user_id');
            $service_id = $request->post('service_id');
            $id         = $request->post('id');
            $user_res = DB::select('select * from bookings where user_id ="' . $user_id . '" AND  service_id = "' . $service_id . '" AND  id = "' . $id . '" AND status !=2');
            //print_r($user_res);die;
            //$arrayres=array();
            if ($user_res) {
                DB::update('update bookings set status = 2 where user_id ="' . $user_id . '" AND  service_id = "' . $service_id . '" AND  id = "' . $id . '"');
                $arrayres = $this->sendResponse('Booking has been Cancelled successfully.', [], 200);
                return $arrayres;

                /*if ($u_data->save()) {
                    return $this->sendResponse('Record has been updated successfully.', $request->post(), 200);
                } else {
                    return $this->sendError('Something went wrong. Please try again.', array('error' => 'Something went wrong. Please try again.', 422));
                }
                return $this->sendError('Something went wrong. Please try again.', array('error' => 'Something went wrong. Please try again.'), 422);*/
            } else {
                return $this->sendError('Service not found or Alredy Deleted', [], 422);
            }
        }
    }

    public function acceptrequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'id' => 'required|numeric'

        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $user_id    = $request->post('user_id');
            $service_id = $request->post('service_id');
            $id         = $request->post('id');
            $user_res = DB::select('select * from bookings where user_id ="' . $user_id . '" AND  service_id = "' . $service_id . '" AND  id = "' . $id . '" AND status !=2');
            //print_r($user_res);die;
            //$arrayres=array();
            if ($user_res) {
                DB::update('update bookings set status = 3 where user_id ="' . $user_id . '" AND  service_id = "' . $service_id . '" AND  id = "' . $id . '"');
                $arrayres = $this->sendResponse('Booking has been Accepted successfully.', [], 200);
                return $arrayres;
            } else {
                return $this->sendError('Service not found or Alredy Accepted', [], 422);
            }
        }
    }

    public function myserviceapi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner' => 'required|numeric',

        ]);
        if ($validator->fails()) {
            $validation = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $validation[$field_name] = $messages[0];
                //print_r($messages); die;
            }
            return $this->sendError(implode(',', array_values($validation)), [], 401);
        } else {
            $services = DB::table('services')->where('owner', $request->owner)->where('deleted_at', NULL)->orderBy('id', 'desc')->get();
            $servicesimages = array();
            $serviceprograms = array();
            $servicesreview = array();
            $servicedependencies = array();
            $serviceactivities = array();
            $serviceservice_for = array();
            $servicesname = array();
            $countryname = array();
            $servicesname1 = array();
            foreach ($services as $key => $val) {
                //dd($val);
                $images = DB::table('service_images')->where('service_id', $val->id)->get();
                foreach ($images as $image) {
                    $servicesimages['is_default'] = $image->is_default;
                    $servicesimages['image_url'] = "https://adventuresclub.net/admin/public/uploads/" . $image->image_url;
                    $servicesimages['thumbnail'] = "https://adventuresclub.net/admin/public/uploads" . $image->thumbnail;
                }
                $serviceac = DB::table('service_activities')->where('service_id', $val->id)->get();
                foreach ($serviceac as $serviceactivit) {
                    $serviceactivities['activities'] = $serviceactivit->activity_id;
                }
                $serviceservicefor = DB::table('service_service_for')->where('service_id', $val->id)->get();
                foreach ($serviceservicefor as $serviceservice) {
                    $serviceservice_for['service_for'] = $serviceservice->sfor_id;
                }
                $dependencies = DB::table('service_dependencies')->where('service_id', $val->id)->get();
                foreach ($dependencies as $dependency) {
                    $servicedependencies['dependency'] = $dependency->dependency_id;
                }
                $reviews = DB::table('service_reviews')->where('service_id', $val->id)->get();
                foreach ($reviews as $review) {
                    $servicesreview['star'] = $review->star;
                    $servicesreview['remark'] = $review->remark;
                }
                $countries = DB::table('countries')->where('id', $val->country)->first();
                if ($countries) {
                    $country = $countries->country;
                } else {
                    $country = 'null';
                }
                $regions = DB::table('regions')->where('id', $val->region)->first();
                if ($regions) {
                    $region = $regions->region;
                } else {
                    $region = 'null';
                }
                $categories = DB::table('service_categories')->where('id', $val->service_category)->first();
                if ($categories) {
                    $categories = $categories->category;
                } else {
                    $categories = 'null';
                }
                $sectors = DB::table('service_sectors')->where('id', $val->service_sector)->first();
                //dd($sectors);
                if (!empty($sectors)) {
                    $sectors = @$sectors->sector;
                } else {
                    $sectors = 'null';
                }
                $type = DB::table('service_types')->where('id', $val->service_type)->first();
                if ($type) {
                    $type = $type->type;
                } else {
                    $type = 'null';
                }
                $service_levels = DB::table('service_levels')->where('id', $val->service_level)->first();
                if ($service_levels) {
                    $levels = $service_levels->level;
                } else {
                    $levels = 'null';
                }
                $serviceprogra = DB::table('service_programs')->where('service_id', $val->id)->get();
                foreach ($serviceprogra as $serviceprogram) {
                    $serviceprograms['gathering_start_date'] = $serviceprogram->start_datetime;
                    $serviceprograms['gathering_end_date'] = $serviceprogram->end_datetime;
                }
                $serviceuser = DB::table('users')->where('id', $val->owner)->first();
                $servicesname['id'] = $val->id;
                $servicesname['adventure_name'] = $val->adventure_name;
                $servicesname['cost_incclude'] = $val->cost_inc;
                $servicesname['cost_exclude'] = $val->cost_exc;
                $servicesname['currency'] = $val->currency;
                $servicesname['country'] = $country;
                $servicesname['region'] = $region;
                $servicesname['available_seats'] = $val->available_seats;
                $servicesname['specific_address'] = $val->specific_address;
                $servicesname['categories'] = $categories;
                $servicesname['sectors'] = $sectors;
                $servicesname['type'] = $type;
                $servicesname['levels'] = $levels;
                $servicesname['duration'] = $val->duration;
                $servicesname['start_date'] = $val->start_date;
                $servicesname['end_date'] = $val->end_date;
                $servicesname['write_information'] = $val->write_information;
                $servicesname['terms_conditions'] = $val->terms_conditions;
                $servicesname['pre_requisites'] = $val->pre_requisites;
                $servicesname['minimum_requirements'] = $val->minimum_requirements;
                $servicesname['descreption'] = $val->descreption;
                $servicesname['provider_image'] = "https://adventuresclub.net/admin/public" . $serviceuser->profile_image;
                $servicesname['status'] = $val->status;

                $servicesname1[] = array_merge($servicesname, $servicesimages, $servicesreview, $servicedependencies, $serviceactivities, $serviceservice_for, $serviceprograms);
            }

            return $this->sendResponse('Services', $servicesname1, 200);
        }
    }
    public function hillclimblingdelete(Request $request)
    {
        $customerdata_delete = Service::where('id', $request->id)->delete();
        return $this->sendResponse('Deleted Successfully!', 200);
    }

    public function create_service(Request $request)
    {
        if ($request->post()) {

            if ($request->service_plan == 1) {
                $validator = Validator::make($request->all(), [
                    'customer_id' => 'required|numeric',
                    'banners' => 'required'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'customer_id' => 'required|numeric',
                    'banners' => 'required'
                ]);
            }
            $flag = true;
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
                return $this->sendError(implode(',', array_values($validation)), [], 401);
                $flag = false;
            } elseif (1 == 1) {

                $validation = array();
                $gathering_date = $request->gathering_date;
                /*foreach ($gathering_date as $ki => $gd) {
                    if ($gd) {
                        $day = date('d', strtotime($gathering_date[$ki]));
                        $mon = date('m', strtotime($gathering_date[$ki]));
                        $year = date('Y', strtotime($gathering_date[$ki]));
                        if (!checkdate($mon, $day, $year)) {
                            return $this->sendError('The gathering date field should be valid date', [], 401);
                            $flag = false;
                        }
                    } else {
                        return $this->sendError('The gathering date field is required', [], 401);
                        $flag = false;
                    }
                }*/
                $start_time = $request->gathering_start_time;
                $end_time = $request->gathering_end_time;
                /*foreach ($start_time as $k => $st) {
                    if (strtotime($start_time[$k]) >= strtotime($end_time[$k])) {
                        return $this->sendError('End time should be greater that to start time', [], 401);
                        $flag = false;
                    }
                }*/

                if ($flag == true) {
                    $adventure_exist = DB::table('services')
                        ->where('adventure_name', $request->adventure_name)
                        ->where('owner', $request->customer_id)
                        ->get();
                    if (!$adventure_exist->isEmpty()) {
                        return $this->sendError('Adventure name already taken for selected owner', [], 401);
                    } else {
                        $service = new Service();
                        $service->owner = $request->customer_id;
                        $service->adventure_name = $request->adventure_name;
                        $service->geo_location = $request->geo_location;
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
                        $service->recommended = 1;
                        /*
                        if ($request->recommended == 1) {
                            $service->recommended = 1;
                        } elseif ($request->recommended == 2) {
                            $service->recommended = 0;
                        }*/

                        if ($service->save()) {

                            // prx($request->file('banners'));
                            $service_id = $service->id;
                            $banner_data = [];
                            if (count($request->file('banners'))) {
                                foreach ($request->file('banners') as $key => $banner) {

                                    $banner->type = $banner->getClientMimeType();
                                    $file_info = $this->getExtensionSize((array) $banner);
                                    /*
                                    if (!in_array($file_info['ext'], $this->allowed_mime())) {
                                        return $this->sendError('All file must be jpeg,jpg,png.', [], 401);
                                    } else if ($file_info['size'] > 2024) {
                                        return $this->sendError('All file size must be 2 MB maximum', [], 401);
                                    } else {
                                    */
                                    $msg = config('constants.BANNER_ADDED');
                                    if ($banner) {
                                        if (isset($result['banner']) && $result['banner'] != '') {
                                            Storage::disk('public')->delete($result['banner']);
                                        }
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
                                            'thumbnail' => '/services/thumbs/' . $filename
                                        );
                                    }
                                    //}
                                }
                                DB::table('service_images')->insert($banner_data);
                            }
                            $ssfor = array();
                            if (isset($request->service_for)) {
                                DB::table('service_service_for')->where('service_id', '=', $service_id)->delete();
                                $myArray = explode(',', $request->service_for);
                                foreach ($myArray as $sfor) {
                                    $ssfor[] = array('service_id' => $service_id, 'sfor_id' => $sfor);
                                }
                                DB::table('service_service_for')->insert($ssfor);
                            }
                            $sdep = [];
                            if (isset($request->dependency)) {
                                DB::table('service_dependencies')->where('service_id', '=', $service_id)->delete();
                                $myArray = explode(',', $request->dependency);
                                foreach ($myArray as $dep) {
                                    if ($dep != "") {
                                        $sdep[] = array('service_id' => $service_id, 'dependency_id' => $dep);
                                    }
                                }
                                DB::table('service_dependencies')->insert($sdep);
                            }
                            $activitiess = [];
                            if (isset($request->activities)) {
                                DB::table('service_activities')->where('service_id', '=', $service_id)->delete();
                                $myArray = explode(',', $request->activities);
                                foreach ($myArray as $act) {
                                    $activitiess[] = array('service_id' => $service_id, 'activity_id' => $act);
                                }
                                DB::table('service_activities')->insert($activitiess);
                            }
                            $serv_programs = [];
                            if (count($request->schedule_title)) {
                                $s_title = $request->schedule_title;
                                $g_date = $request->gathering_date;
                                $g_stime = $request->gathering_start_time;
                                $g_etime = $request->gathering_end_time;
                                $p_desc = $request->program_description;
                                DB::table('service_programs')->where('service_id', '=', $service_id)->delete();
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
                                $myArray = explode(',', $request->service_plan_days);
                                foreach ($myArray as $spd) {
                                    $spd_data[] = array('service_id' => $service_id, 'day' => $spd);
                                }
                                DB::table('service_plan_day_date')->insert($spd_data);
                            }
                            if ($request->service_plan == 2) {
                                $pd_data = [];
                                DB::table('service_plan_day_date')->where('service_id', '=', $service_id)->delete();
                                foreach (explode(',', $request->particular_date) as $p_date) {
                                    $pd_data[] = array('service_id' => $service_id, 'date' => date('Y-m-d', strtotime($p_date)));
                                }
                                DB::table('service_plan_day_date')->insert($pd_data);
                            }
                            return $this->sendResponse('Service Created Successfully!', 200);
                        } else {
                            return $this->sendResponse('Something went wrong. Please try again', 422);
                        }
                    }
                }
            }
        }
    }
    //You have made no changes to save.
    public function getservice_sector(Request $request)
    {
        $sectors = Service_sector::get();

        return $this->sendResponse($sectors, 200);
    }
    public function getservice_categories(Request $request)
    {
        $categories = Service_categorie::get();

        return $this->sendResponse($categories, 200);
    }
    public function getservice_type(Request $request)
    {
        $service = Service_type::get();

        return $this->sendResponse($service, 200);
    }
    public function getservice_level(Request $request)
    {
        $service = Service_level::get();

        return $this->sendResponse($service, 200);
    }
    public function get_regions(Request $request)
    {
        $service = DB::table('regions')->select('id', 'region')->get();

        return $this->sendResponse($service, 200);
    }
}
