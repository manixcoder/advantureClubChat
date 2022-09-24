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
use Session;
use Response;
use App\Category;
use App\Brand;
use App\User;
use DB;
use Hash;
use Auth;

class AdminUsersController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    /* Users Listing Starts */

    function list_admin_users()
    {
        $usersdata = DB::table('users')
            ->select(['users.*', 'countries.country'])
            ->leftjoin('countries', 'countries.id', '=', 'users.country_id')
            ->where('users.users_role', '=', 1)
            ->get();
        $data['content'] = 'admin.admin_users.list_admin_users';
        return view('layouts.content', compact('data'))
            ->with([
                'usersdata' => $usersdata
            ]);
    }

    /* Adventure Users listing ends */

    /* Add new Adventure user starts */

    public function add_admin_user(Request $request)
    {
       // echo"<pre>";print_r($request->all());exit;
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'name'              => 'required|min:3|max:50|unique:users',
                'email'             => 'required|email:filter|unique:users',
                'mobile_code'       => 'required|numeric',
                'mobile'            => 'required|numeric|digits:10|unique:users',
                'country'           => 'required|numeric',
                'region'            => 'required|numeric',
                'cities'            => 'required|numeric',
                'dob'               => 'required|date_format:Y-m-d',
                'health_condition'  => 'required',
                'height'            => 'required',
                'weight'            => 'required',
                'status'            => 'required|numeric|min:1|max:2',
                'password'          => 'required',
                'natinality'        => 'required',
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
                    'users_role'        => 1,
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
                            DB::table('users')
                                ->where(['id' => $user_id])
                                ->update([
                                    'profile_image' => 'profile_image/' . $filename
                                ]);
                        }
                    }
                    Session::flash('success', 'User has been successfully.');
                    return redirect('/list-admin-users')->with(array(
                        'status' => 'success',
                        'message' => 'User has been successfully.!'
                    ));
                   // return back();
                }
            }
        }
        $health_conditions = DB::table('health_conditions')->get();
        $countries = DB::table('countries')->where(['deleted_at' => NULL])->get();

        $data['content'] = 'admin.admin_users.add_admin_users';
        return view('layouts.content', compact('data'))->with([
            'validation' => $data['validation'] ?? [],
            'health_conditions' => $health_conditions,
            'countries' => $countries
        ]);
    }

    /* Add New Adventure User ends */

    /* View Adventure users starts */

    public function view_admin_user($id)
    {
        // echo $id.'---------'; die;
        $editdata = DB::table('users')
            ->select([
                'users.*',
                'countries.country',
                'regions.region'
            ])
            ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
            ->leftJoin('regions', 'users.country_id', '=', 'regions.country_id')
            ->where('users.id', $id)
            ->first();


        $data['content'] = 'admin.admin_users.view_admin_user';
        return view('layouts.content', compact('data'))->with(['editdata' => $editdata]);
    }

    /* View Adventure users ends */
    /* Update status in db from ajax request starts */
    public function update_user_status($id)
    {
        $Data = array(
            'id'        => $_GET['id'],
            'status'    => $_GET['status'],
        );
        $edituserData = DB::table('users')
            ->where('id', $id)
            ->update($Data);
        return response()->json(array(
            'msg' => $edituserData
        ), 200);
    }
    /* Update status ends */

    function adminuser_delete($id)
    {
        $delete = DB::table('users')
        ->where('id', $id)
        ->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return back();
    }
}
