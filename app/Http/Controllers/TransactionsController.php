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
use App\Transaction;
use App\Question_report;
use App\Announcement;
use DB;
use Hash;
use Auth;

class TransactionsController extends MyController
{
    public function __construct()
    {
        //dd(Auth::id());
        $this->middleware('auth');
        $this->middleware('role');
    }
    /* transactions Listing Starts */

    function list_transactions()
    {
        $usersdata          =  DB::table('transactions')->orderBy('id', 'DESC')->get();
        $data['content']    = 'admin.transactions.list_transaction_users';
        return view('layouts.content', compact('data'))->with(['usersdata' => $usersdata]);
    }

    function list_questionreport()
    {
        $usersdata = DB::table('contact_us')->orderBy('id', 'DESC')->get();
        $data['content'] = 'admin.transactions.question_report';
        return view('layouts.content', compact('data'))->with(['usersdata' => $usersdata]);
    }

    function list_announcement()
    {
        $usersdata = DB::table('announcements')->get();
        $data['content'] = 'admin.transactions.announcement';
        return view('layouts.content', compact('data'))->with(['usersdata' => $usersdata]);
    }

    /* Adventure Users listing ends */

    /* Add new Adventure user starts */

    public function add_admin_user(Request $request)
    {  //echo"<pre>";print_r($request->all());exit;
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'name'              => 'required|min:3|max:50|unique:users',
                'mobile_code'       => 'required|numeric',
                'mobile'            => 'required|numeric|digits:10|unique:users',
                'email'             => 'required|email:filter|unique:users',
                'country'           => 'required|numeric',
                'region'            => 'required|numeric',
                'dob'               => 'required|date_format:Y-m-d',
                'health_condition'  => 'required',
                'height'            => 'required',
                'weight'            => 'required',
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
                    'city_id'           => $request->region,
                    'dob'               => date('Y-m-d', strtotime($request->dob)),
                    'weight'            => $request->weight,
                    'height'            => $request->height,
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
                            DB::table('users')->where(['id' => $user_id])->update(['profile_image' => 'profile_image/' . $filename]);
                        }
                    }
                    Session::flash('success', 'User has been successfully.');
                    return back();
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
            ->select(['users.*', 'countries.country', 'regions.region'])
            ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
            ->leftJoin('regions', 'users.country_id', '=', 'regions.country_id')
            ->where('users.id', $id)->first();


        $data['content'] = 'admin.admin_users.view_admin_user';
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

    function transaction_delete($id)
    {
        $delete = DB::table('transactions')->where('id', $id)->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return back();
    }

    function questionreport_delete($id)
    {
        $delete = DB::table('contact_us')->where('id', $id)->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return back();
    }

    function announcement_delete($id)
    {
        $delete = DB::table('announcements')->where('id', $id)->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return back();
    }

    public function addAnnouncement(Request $request)
    {
        // dd(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'title'              => 'required',
            'country'       => 'required',
            'licensed'            => 'required',
            'messages'            => 'required',
            'gender'             => 'required'
        ]);
        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errors[$field_name] = $messages[0];
            }
            $data['validation'] = $errors;
            //return back();
        } else {
            if ($request->country) {
                $where = 'usr.country_id = ' . $request->country . ' ';
            } else {
                $where = '1';
            }
            if ($request->gender) {
                if ($request->gender == '0') {
                    $gender = '"female"';
                    $where .= ' && usr.gender = ' . $gender;
                } elseif ($request->gender == '1') {
                    $gender = '"male"';
                    $where .= ' && usr.gender = ' . $gender;
                }
            }
            if ($request->licensed) {
                if ($request->licensed == '0') {
                    $license = '"No"';
                    $where .= ' && bp.license = ' .  $license;
                } elseif ($request->licensed == '1') {
                    $license = '"Yes"';
                    $where .= ' && bp.license = ' .  $license;
                }
            }
            if ($request->licensed) {
                $usersData = DB::table('users as usr')
                    ->select([
                        'usr.*'
                    ])
                    ->join('become_partner as bp', 'bp.user_id', '=', 'usr.id')
                    ->where(['usr.deleted_at' => NULL])
                    ->groupBy('usr.id')
                    ->whereRaw($where)
                    ->get();
            } else {
                $usersData = DB::table('users as usr')
                    ->select([
                        'usr.*'
                    ])
                    ->where(['usr.deleted_at' => NULL])
                    ->groupBy('usr.id')
                    ->whereRaw($where)
                    ->get();
            }

            foreach ($usersData as $user) {
                DB::table('announcements')->insert([
                    'user_id'=>$user->id,
                    'sender_id'=>Auth::user()->id,
                    'title'=>$request->title,
                    'content'=>$request->messages,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            }


            Session::flash('success', 'User has been successfully.');
            return redirect('/announcement')->with(array(
                'status' => 'success',
                'message' => 'announcement sent successfully.!'
            ));
        }
    }
}
