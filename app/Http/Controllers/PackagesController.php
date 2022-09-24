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
use Illuminate\Support\MessageBag;
use App\Models\Packages;
use Session;
use DB;
use Hash;
use Auth;

class PackagesController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function get(Request $request)
    {
        $packages = DB::table('packages')
            ->where(['packages.deleted_at' => NULL])
            ->get();
        // dd($packages);
        if ($packages->isEmpty()) {
            $packages = [];
        }
        $data['content'] = 'admin.pages.packages';
        return view('layouts.content', compact('data'))->with(['packages' => $packages]);
    }

    public function add(Request $request)
    {
       
       // dd($request->all());
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'title'         => 'required|min:3|max:200',
                'duration'      => 'required|numeric',
                'package_cost'          => 'required|numeric',
                'offer_cost'=> 'required|numeric',
                'includes.*'    => 'required|string|distinct|min:1|max:200',
                'excludes.*'    => 'string|distinct|min:1|max:200',
            ], [], [
                'includes.*' => 'include',
                'excludes.*' => 'exclude',
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                if (DB::table('packages')->insert([
                    'title'         => $request->title,
                    'duration'      => $request->duration,
                    //'days'          => $request->days,
                    'symbol'        => '$',
                    'cost'          => $request->package_cost,
                    'offer_cost'    => $request->offer_cost
                ])) {
                    $package_id = DB::getPdo()->lastInsertId();
                    DB::table('package_detail')
                        ->where(['package_id' => $package_id])
                        ->delete();
                    $pkg_det = [];
                    foreach ($request->includes as $val) {
                        $pkg_det[] = [
                            'package_id'    => $package_id,
                            'title'         => $val,
                            'detail_type'   => 1
                        ];
                    }
                    foreach ($request->excludes as $val) {
                        $pkg_det[] = [
                            'package_id'    => $package_id,
                            'title'         => $val,
                            'detail_type'   => 0
                        ];
                    }
                    DB::table('package_detail')->insert($pkg_det);
                    $request->session()->flash('success', 'Record has been added successfully.');
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                return redirect('/sub-packages/add');
            }
        }
        $packages = DB::table('packages')->get();
        $data['content'] = 'admin.pages.update_packages';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? [],
                'packages' => $packages
            ]);
    }

    public function privacyPolicies(Request $request)
    {
        $terms = DB::table('privacy_policy')
            ->get();
        if ($terms->isEmpty()) {
            $terms = [];
        }
        $data['content'] = 'admin.pages.privacy_policy_list';
        return view('layouts.content', compact('data'))->with(['terms' => $terms]);
    }

    public function addPrivacyPolicy(Request $request)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'title.*' => 'required|string|distinct|min:15|max:200',
                'description.*' => 'required|string|distinct|min:15|max:500',
            ], [], [
                'title.*' => 'title',
                'description.*' => 'description',
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                $term_data = [];
                foreach ($request->title as $key => $val) {
                    $term_data[] = array(
                        'title' => $request->title[$key],
                        'description' => $request->description[$key]
                    );
                }
                DB::table('privacy_policy')
                    ->truncate();
                if (DB::table('privacy_policy')
                    ->insert($term_data)
                ) {
                    $request->session()->flash('success', 'Record has been added successfully.');
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                return redirect('/privacy-policy/add');
            }
        }
        $terms = DB::table('privacy_policy')
            ->get();
        $data['content'] = 'admin.pages.update_privacy_policies';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? [],
                'terms' => $terms
            ]);
    }

    public function aboutUs(Request $request)
    {
        $terms = DB::table('about_us')
            ->first();
        $data['content'] = 'admin.pages.about_us_list';
        return view('layouts.content', compact('data'))
            ->with([
                'terms' => $terms
            ]);
    }

    public function addAboutUs(Request $request)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string|min:15|max:1000',
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                DB::table('about_us')->truncate();
                if (DB::table('about_us')
                    ->insert([
                        'content' => $request->description
                    ])
                ) {
                    $request->session()->flash('success', 'Record has been added successfully.');
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                return redirect('/about-us/add');
            }
        }
        $terms = DB::table('about_us')->first();
        $data['content'] = 'admin.pages.update_about_us';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? [],
                'terms' => $terms
            ]);
    }

    public function transactions()
    {
        $result = DB::table('payments as pmt')
            ->select(['pmt.*', 'usr.name'])
            ->leftJoin('users as usr', 'usr.id', '=', 'pmt.user_id')
            ->get();
        $data['content'] = 'admin.pages.transactions';
        return view('layouts.content', compact('data'))->with(['result' => $result]);
    }

    /* Update status in db from ajax request starts */
    public function update_pkg_status($id)
    {
        $Data = array(
            'id'        => $_GET['id'],
            'status'    => $_GET['status'],
        );
        $edituserData = DB::table('packages')
            ->where('id', $id)
            ->update($Data);
        return response()->json(array('msg' => $edituserData), 200);
    }
    /* Update status ends */

    /* soft delete starts */
    public function delete_sub_pkg(Request $request, $id)
    {
        $pkg = Packages::find($id);
        if ($pkg) {
            $destroy = Packages::destroy($id);
            $request->session()->flash(
                'success',
                'Package has been deleted successfully.'
            );
        } else {
            $request->session()->flash('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    /* soft delete ends */
}
