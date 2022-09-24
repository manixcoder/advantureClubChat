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
use App\Models\Banner;
use Illuminate\Support\MessageBag;
use Session;
use DB;
use Hash;
use Auth;

//
class BannersController extends MyController
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    public function index(Request $request, $id = null)
    {

        $result = array();
        $usersdata = DB::table('users')
            ->rightjoin('countries', 'users.country_id', '=', 'countries.id')
            ->where('users.users_role', 3)
            ->get();
        $where = array(
            'banners.deleted_at' => NULL
        );
        $banners = Banner::where($where)
            ->select('banners.id', 'banners.banner as banner_name', 'banners.title', 'banners.status', 'thumbnail')
            ->orderBy('banners.id', 'desc')
            ->get();
        if (!empty($banners)) {
            foreach ($banners as $banner) {
                $result[] = $banner->attributesToArray();
            }
        }

        //        $data['data'] = $result;
        $data['content'] = 'admin.banners.banners';
        return view('layouts.content', compact('data'))->with(['usersdata' => $result]);
    }

    public function add(Request $request, $id = null)
    {
        $postRequest = $request->all();
        $banners = array();
        if ($request->post()) {
            $banner_rule = 'required';
            $result = array();
            if ($id) {
                $result = Banner::find($id);
                if (!empty($result)) {
                    $banner_rule = 'nullable';
                }
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:15|max:100',
                'banner' => $banner_rule
            ]);
            if ($validator->fails()) {
                $errors = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $errors[$field_name] = $messages[0];
                }
                $data['validation'] = $errors;
            } else {
                $file_info = $this->getExtensionSize($_FILES['banner']);
                if (!in_array($file_info['ext'], $this->allowed_mime())) {
                    $data['validation'] = ['banner' => 'File must be jpeg,jpg,png.'];
                } else if ($file_info['size'] > 2024) {
                    $data['validation'] = ['banner' => 'File size must be 2 MB maximum'];
                } else {
                    $msg = config('constants.BANNER_ADDED');
                    if ($request->file('banner')) {
                        if (isset($result['banner']) && $result['banner'] != '') {
                            Storage::disk('public')->delete($result['banner']);
                        }
                        $filename = time() . '.jpg';
                        $basepath = "public/uploads/banners/thumbs/";
                        if (!is_dir($basepath)) {
                            mkdir($basepath, 0777, true);
                        }
                        $filepath = Storage::disk('public')->putFileAs('banners', $request->file('banner'), $filename);
                        $this->resize_crop_image($this->image_path() . '/' . $filepath, $this->image_path() . '/banners/thumbs/' . $filename);
                    }
                    $banner = new Banner();
                    if ($id) {
                        if (!empty($result)) {
                            $banner = $result;
                            $msg = config('constants.BANNER_UPDATED');
                        } else {
                            $msg = config('constants.DATA_NOT_FOUND');
                        }
                    }
                    $banner->title = $request->title;
                    if ($request->file('banner')) {
                        $banner->banner = $filepath;
                        $banner->thumbnail = '/banners/thumbs/' . $filename;
                    }

                    if ($banner->save()) {
                        $request->session()->flash('success', $msg);
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                    if ($id) {
                        return redirect('/banners/add/' . $id);
                    }
                    return redirect('/banners');
                }
            }
        }

        $data['content'] = 'admin.banners.update_banner';
        return view('layouts.content', compact('data'))->with(['validation' => $data['validation'] ?? []]);
    }

    public function update(Request $request, $id = null)
    {
        if (!$request->session()->has('user_data')) {
            return redirect('app/login');
        }
        $postRequest = $request->all();
        $user_data = $request->session()->get('user_data');
        $user_id = $user_data['id'];
        $data = array(
            'title' => 'Banners',
            'active_tab' => 'banners',
            'admin_data' => $this->getAppUser($user_id)
        );
        if ($user_data['role'] != 1) {
            return $this->sendError('Access not allowed');
        }
        $postRequest['role'] = $user_data['role'];

        $banners = array();
        if ($id) {
            $where = array(
                'banners.deleted_at' => NULL,
                'banners.id' => $id
            );

            $banner_res = Banner::where($where)
                ->select('banners.id', 'banners.banner as banner_name', 'banners.title', 'banners.link', 'banners.status')->orderBy('banners.id', 'desc')
                ->get();
            if (!empty($banner_res)) {
                foreach ($banner_res as $banner) {
                    $banners = $banner->attributesToArray();
                }
            }
        }
        if ($request->post()) {

            $banner_rule = 'required|image|mimes:jpeg,jpg,png|max:2048';
            $result = array();
            if ($id) {
                $result = Banner::find($id);
                if (!empty($result)) {
                    $banner_rule = 'nullable|mimes:jpeg,jpg,png|max:2048';
                }
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:15|max:100',
                'link' => 'required|url',
                'banner' => $banner_rule
            ]);
            if ($validator->fails()) {
                $errors = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $errors[$field_name] = $messages[0];
                }
                $data['validation'] = $errors;
            } else {
                $msg = config('custom.BANNER_ADDED');
                if ($request->file('banner')) {
                    if (isset($result['banner']) && $result['banner'] != '') {
                        Storage::disk('public')->delete($result['banner']);
                    }
                    $extension = $request->file('banner')->extension();
                    $filename = time() . '.' . $extension;
                    $filepath = Storage::disk('public')->putFileAs('banners', $request->file('banner'), $filename);
                    resize_crop_image(image_path() . '/' . $filepath, image_path() . '/banners/thumbs/' . $filename);
                }
                $banner = new Banner();
                if ($id) {
                    if (!empty($result)) {
                        $banner = $result;
                        $msg = config('custom.BANNER_UPDATED');
                    } else {
                        $msg = config('custom.DATA_NOT_FOUND');
                    }
                }

                $banner->link = $request->post('link');
                $banner->title = $request->post('title');
                if ($request->file('banner')) {
                    $banner->banner = $filepath;
                    $banner->thumbnail = '/banners/thumbs/' . $filename;
                }

                if ($banner->save()) {
                    $request->session()->flash('success', $msg);
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                if ($id) {
                    return redirect('/app/banners/update/' . $id);
                }
                return redirect('/app/banners/update');
            }
        }
        $data['banners_detail'] = $banners;
        return view('admin/update_banner', $data);
    }

    public function delete(Request $request, $id)
    {
        if (!$request->session()->has('user_data')) {
            return redirect('app/login');
        }
        $postRequest = $request->all();
        $user_data = $request->session()->get('user_data');
        if ($user_data['role'] != 1) {
            $request->session()->flash('error', config('custom.ACCESS_NOT_ALLOWED'));
            return redirect('app/banners');
        }
        $postRequest['role'] = $user_data['role'];
        $url = url('/api') . '/banners/delete/' . $user_data['role'] . '/' . $id;
        $c_init = curl_init($url);
        curl_setopt($c_init, CURLOPT_RETURNTRANSFER, true);
        if ($apiResponse = curl_exec($c_init)) {
            $response = json_decode($apiResponse, true);
            if ($response['success'] == true) {
                curl_close($c_init);
                $request->session()->flash('success', $response['message']);
                return redirect('app/banners');
            } else {
                curl_close($c_init);
                $request->session()->flash('error', $response['message']);
                return redirect('app/banners');
            }
        } else {
            curl_close($c_init);
            $request->session()->flash('error', 'cURL execution error.');
            return redirect('app/banners');
        }
    }
}
