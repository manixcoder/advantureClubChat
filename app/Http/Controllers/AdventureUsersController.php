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
use Carbon\Carbon;

class AdventureUsersController extends MyController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');

        $usersdata = DB::table('users')->where('email', '=', NULL)->where('name', '=', NULL)->get();
        foreach ($usersdata as $key => $users) {
              $last_date = $users->created_at;
              $current_date = Carbon::now()->toDateTimeString();
               //NUMBER DAYS BETWEEN TWO DATES CALCULATOR
              $start_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last_date);
              $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $current_date);
              $different_minutes = $start_date->diffInMinutes($end_date);
               //dd($different_minutes);
               if($different_minutes > 30 ){
                DB::table('users')->where('id',$users->id)->delete();
                //dd("Hello");
               }
              // dd($users);
        }
    }
    /* Users Listing Starts */
    function list_adventure_users()
    {
        $usersdata = DB::table('users')
            ->select(['users.*', 'countries.country'])
            ->leftjoin('countries', 'countries.id', '=', 'users.country_id')
            ->where('users.users_role', '=', 3)
            ->where('users.email', '<>', NULL)
            ->where('users.name', '<>', NULL)
            ->where(['users.deleted_at' => NULL])
            ->orderBy('users.id', 'desc')
            ->get();
        $newData=array();
        foreach($usersdata as $userData){
            $bookingsData = DB::table('bookings')
            ->where('user_id', $userData->id)
            ->whereRaw('DATE_FORMAT(booking_date, "%Y-%m-%d") < "' . date('Y-m-d') . '"')
            ->get()
            ->count();
            $userData->bookingscount=$bookingsData;
            array_push($newData, $userData);
        }
        $data['content'] = 'admin.adventure_users.list_adventure_users';
        return view('layouts.content', compact('data'))->with(['usersdata' => $newData]);
    }
    /* Adventure Users listing ends */

    /* Add new Adventure user starts */

    public function add_adventure_user(Request $request)
    {
        // echo"<pre>";print_r($request->all());exit;
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'name'              => 'required|min:3|max:50|unique:users',
                'mobile_code'       => 'required|numeric',
                'mobile'            => 'required|min:3|max:15|unique:users',
                'email'             => 'required|email:filter|unique:users',
                'country'           => 'required|numeric',
                'region'            => 'required|numeric',
                'cities'            => 'required|numeric',
                'gender'            => 'required',
                'dob'               => 'required|date_format:Y-m-d',
                'health_condition'  => 'required',
                'height'            => 'required',
                'weight'            => 'required',
                'password'          => 'required',
                'natinality'        =>'required',
                'status'            => 'required|numeric|min:1|max:2',
                'image'             => 'required'
            ]);
            if ($validator->fails()) {
                $errors = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $errors[$field_name] = $messages[0];
                }
                $data['validation'] = $errors;
            } else {
                $user_data = array(
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'mobile'            => $request->mobile,
                    'mobile_code'       => $request->mobile_code,
                    'status'            => ($request->status == 2) ? '0' : '1',
                    'country_id'        => $request->country,
                    'region_id'         => $request->region,
                    'city_id'           => $request->cities,
                    'gender'            => $request->gender,
                    'dob'               => date('Y-m-d', strtotime($request->dob)),
                    'weight'            => $request->weight,
                    'height'            => $request->height,
                    'password'          => bcrypt($request->password),
                    'nationality_id'     => $request->natinality,
                    'health_conditions' => implode(',', (array) $request->health_condition),
                    'users_role'        => 3,
                );
                if (DB::table('users')->insert($user_data)) {
                    $user_id = DB::getPdo()->lastInsertId();
                    if ($request->file('image')) {
                        $file_info = $this->getExtensionSize($_FILES['image']);
                        if (!in_array($file_info['ext'], $this->allowed_mime())) {
                            $data['validation'] = ['banner' => 'File must be jpeg,jpg,png.'];
                        } else if ($file_info['size'] > 2024) {
                            $data['validation'] = ['banner' => 'File size must be 2 MB maximum'];
                        } else {
                            $filename = time() . '.' . $file_info['ext'];
                            $basepath = "public/profile_image/";
                            $destinationPath = public_path('/profile_image/');
                            if (!is_dir($basepath)) {
                                mkdir($basepath, 0777, true);
                            }
                            $files = $request->image;
                            $filepath = $files->move($destinationPath, $filename);
                            DB::table('users')->where(['id' => $user_id])->update([
                                'profile_image' => 'profile_image/' . $filename
                            ]);
                        }
                    }
                    Session::flash('success', 'User has been successfully.');
                    return redirect('/list-adventure-users')->with(array(
                        'status' => 'success',
                        'message' => 'User has been successfully.!'
                    ));
                }
            }
        }
        $health_conditions = DB::table('health_conditions')->get();
        $countries = DB::table('countries')->where(['deleted_at' => NULL])->get();
        $data['content'] = 'admin.adventure_users.add_adventure_users';
        return view('layouts.content', compact('data'))
        ->with([
            'validation' => $data['validation'] ?? [],
            'health_conditions' => $health_conditions,
            'countries' => $countries
        ]);
    }

    /* Add New Adventure User ends */

    /* View Adventure users starts */

    public function view_adventure_user($id) 
    {
        $editdata = DB::table('users as u')
        ->select(['u.*', 'ctr.country', 're.region','ctri.short_name'])
        ->leftJoin('countries as ctr', 'u.country_id', '=', 'ctr.id')
        ->leftJoin('countries as ctri', 'u.country_id', '=', 'ctri.id')
        ->leftJoin('regions as re', 'u.country_id', '=', 're.country_id')
        ->where('u.id', $id)
        ->first();


        $bookingsData = DB::table('bookings')
         ->where('user_id', $editdata->id)
         ->whereRaw('DATE_FORMAT(booking_date, "%Y-%m-%d") < "' . date('Y-m-d') . '"')
         ->get()
         ->count();
         $editdata->bookingscount=$bookingsData;
        //dd($editdata);

        $health_conditions = $editdata->health_conditions ? explode(',', $editdata->health_conditions) : [];
        if (count($health_conditions)) {
            $cond = DB::table('health_conditions')
                ->select(['name'])
                ->whereIn('id', $health_conditions)->get();
            $editdata->health_conditions = $cond;
        }

        $data['content'] = 'admin.adventure_users.view_adventure_user';
        return view('layouts.content', compact('data'))->with(['editdata' => $editdata]);
    }

    /* View Adventure users ends */
    /* Update status in db from ajax request starts */
    public function update_user_status($id)
    {

        $Data = array(
            'id' => $_GET['id'],
            'status' => $_GET['status'],
        );
        $edituserData = DB::table('users')->where('id', $id)->update($Data);
        return response()->json(array('msg' => $edituserData), 200);
    }
    /* Update status ends */

    /* soft delete starts */
    public function deleteUser(Request $request, $id)
    {
        $user = Users::find($id);
        if ($user) {
            $destroy = Users::destroy($id);
            $request->session()->flash('success', 'User has been deleted successfully.');
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    /* soft delete ends */
}
