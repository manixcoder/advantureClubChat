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

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function update_user_password($id)
    {
        $data = DB::table('users')->Where('id', $id)->first();
        return Response::json($data);
    }

    public function update_user_newpassword(Request $request)
    {
        $updatedata = DB::table('users')->where('id', $request->ids)
            ->update(['password' => Hash::make($request->new_password)]);
        Session::flash('success', 'Password Update successfully..!');
        return back();
    }

    /* User, Vendor profile image update start */

    public function update_user_profile_image(Request $request)
    {
        if ($files = $request->image) {
            $destinationPath = public_path('/profile_image/');
            $profileImage = date('YmdHis') . "-" . $files->getClientOriginalName();
            $path = $files->move($destinationPath, $profileImage);
            $image = $insert['photo'] = "$profileImage";
        }

        $updatedata = DB::table('users')
            ->where('id', $request->ids)
            ->update(['profile_image' => $image]);
        Session::flash('success', 'Image Update successfully..!');
        return back();
    }

    public function update_profile_image($id)
    {
        $data = DB::table('users')
            ->Where('id', $id)
            ->first();
        return Response::json($data);
    }

    /* User, Vendor profile image update End */

    public function vendor_requests()
    {
        $userdata = DB::table('users')
            ->rightjoin('vendors_details', 'users.id', '=', 'vendors_details.user_id')
            ->where('users.users_role', '2')
            ->where('users.status', '0')
            ->get();

        $data['content'] = 'admin.user.vendor_requests';
        return view('layouts.content', compact('data'))
            ->with(['userdata' => $userdata]);
    }

    public function vendor_approve($id)
    {
        $approvedata = User::where('id', $id)
            ->update([
                'status' => '1',
                'users_role' => '2'
            ]);
        Session::flash('success', 'Vendor approved successfully..!');
        return back();
    }

    public function vendor_notapprove($id)
    {
        $approvedata = User::where('id', $id)
            ->update([
                'status' => '2'
            ]);
        Session::flash('error', 'Vendor Declined ..!');
        return back();
    }

    public function UpdateProfile(Request $request)
    {
        if ($request->password) {
            $this->validate($request, [
                'password' => 'required',
                'new_password' => 'required|min:8',
            ]);
            $data = $request->all();
            if (!\Hash::check($data['password'], auth()->user()->password)) {
                Session::flash('error', 'Please Enter valid Current password');
                return back();
            } else {
                if ($request->u_ids != '') {
                    if ($request->name) {
                        $udata['name'] = $request->name;
                    }
                    $udata['password'] = Hash::make($request->new_password);
                    User::where('id', $request->u_ids)
                        ->update($udata);
                }
                Session::flash('success', 'Profile updated successfully');
                return back();
            }
        } else {
            $data = $request->all();
            if ($request->name) {
                $udata['name'] = $request->name;
            }
            User::where('id', $request->u_ids)
                ->update($udata);
            Session::flash('success', 'Profile updated successfully');
            return back();
        }
    }

    public function UserProfile(Request $request)
    {
        $companydata = User::where('id', Session::get('user_id'))
            ->first();
        $profileData = Auth()
            ->user();

        $data['content'] = 'admin.user.user-profile';
        return view('layouts.content', compact('data'))->with(['companydata' => $companydata]);
    }

    public function Dashboard(Request $request)
    {

        $userRole = Session::get('userRole');
        $id = Session::get('user_id');
        $OrgData = DB::table('users')
            ->where('id', $id)
            ->first();

        if ($userRole == '1') {
            $usredata = DB::table('users')
                ->where('users_role', 2)
                ->count();
            $customerdata = DB::table('users')
                ->where('users_role', 3)
                ->count();
            //      $categorydata = DB::table('home_categories')->count();
            $vendor_requests = DB::table('users')->Where('status', '0')->Where('users_role', '3')->count();
            $countrydata = DB::table('countries')->count();
            $adventure_programdata = DB::table('service_programs')->orderBy('id', 'Desc')->count();
            //      $productdata = DB::table('home_products')->orderBy('id', 'desc')->count();

            $data['content'] = 'admin.home';
            return view('layouts.content', compact('data'))
                ->with([
                    'usredata' => $usredata,
                    'customerdata' => $customerdata,
                    'vendor_requests' => $vendor_requests,
                    'countrydata' => $countrydata,
                    'adventure_programdata' => $adventure_programdata
                ]);
        } elseif ($userRole == '2') {
            $usredata = DB::table('users')->count();
            $data['content'] = 'admin.home';
            return view('layouts.content', compact('data'))
                ->with(['usredata' => $usredata]);
        } else {
            echo "customer login not allowed";
            die;
        }
    }

    public function index()
    {
        Session::flash('success', 'login successfully..!');
        return Redirect::action('HomeController@Dashboard');
    }

    /* User routr Start */

    public function total_users(Request $request)
    {
        $total_users = User::all();

        $data['content'] = 'admin.user';
        return view('layouts.content', compact('data'))->with([
            'usredata' => $usredata
        ]);
    }

    public function user_view()
    {
        $usredata = User::where('users_role', 2)->get();

        $data['content'] = 'admin.user.user';
        return view('layouts.content', compact('data'))->with([
            'usredata' => $usredata
        ]);
    }

    public function add_user(Request $request)
    {
        if ($files = $request->image) {
            $destinationPath = public_path('/profile_image/');
            $profileImage = date('YmdHis') . "-" . $files->getClientOriginalName();
            $path = $files->move($destinationPath, $profileImage);
            $image = $insert['photo'] = "$profileImage";
        }
        if ($request->image != '') {
            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'profile_image' => $image,
                'status' => $request->status,
                'created_at' => date('Y-m-d H:i:s'),
                'users_role' => 2,
            );
        } else {
            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'created_at' => date('Y-m-d H:i:s'),
                'users_role' => 2,
            );
        }
        if ($request->ids != '') {
            Session::flash('success', 'Updated successfully..!');
            $updateData = DB::table('users')
                ->where('id', $request->ids)
                ->update($data);
            return redirect('users');
        } else {
            Session::flash('success', 'Inserted successfully..!');
            $insertData = DB::table('users')->insert($data);
            return back();
        }
    }

    public function user_edit($id)
    {
        $editdata = User::where('id', $id)->first();
        $data['content'] = 'admin.user.edit_user';
        return view('layouts.content', compact('data'))
            ->with([
                'editdata' => $editdata
            ]);
    }

    public function view_user($id)
    {
        $editdata = User::where('id', $id)->first();
        $data['content'] = 'admin.user.view_user';
        return view('layouts.content', compact('data'))->with(['editdata' => $editdata]);
    }

    public function user_delete($id)
    {
        $customerdata_delete = User::where('id', $id)->delete();
        Session::flash('error', 'User delete successfully.!');
        return back();
    }

    /* User routr End */

    /* Country section Start */

    public function view_countries()
    {
        $countrydata = DB::table('countries')->get();
        $data['content'] = 'admin.countries.manage_country';
        return view('layouts.content', compact('data'))->with(['countrydata' => $countrydata]);
    }

    public function add_countries(Request $request)
    {
        $data = array(
            'short_name' => $request->short_name,
            'code' => $request->code,
            'country' => $request->country,
            'description' => $request->description,
        );
        if ($request->ids != '') {
            Session::flash('success', 'Updated successfully..!');
            $updateData = DB::table('countries')->where('id', $request->ids)->update($data);
            return back();
        } else {
            Session::flash('success', 'Inserted successfully..!');
            $insertData = DB::table('countries')->insert($data);
            return back();
        }
    }

    public function countries_edit($id)
    {
        $data = DB::table('countries')->where('id', $id)->first();
        return Response::json($data);
    }

    public function delete_countries($id)
    {
        $delete = DB::table('countries')->where('id', $id)->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return redirect()->back();
    }

    /* Country section End */
    /* Customers section start */

    function customer_view()
    {
        $customersdata = User::where('users_role', 3)->get();

        $data['content'] = 'admin.customer.manage_customer';
        return view('layouts.content', compact('data'))->with(['customersdata' => $customersdata]);
    }

    function customer_delete($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        session()->flash('error', 'Deleted Successfully..!');
        return back();
    }

    /* Customers section End */
}
