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
use App\Models\Countrie;
use Illuminate\Validation\Rule;
use Session;
use Response;
use App\Category;
use App\Brand;
use App\User;
use DB;
use Hash;
use Auth;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function getCountries(Request $request, $id = null)
    {
        $countries = DB::table('countries as c')
        ->join('users as u','c.created_by','=','u.id')
        ->select(['c.*', 'u.name'])
            ->where(['c.deleted_at' => NULL])
            ->get();
        $data['content'] = 'admin.locations.country_list';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? [],
                'countries' => $countries
            ]);
    }

    public function addCountry(Request $request, $id = null)
    {
        if ($request->post()) {
            $country = DB::table('countries')
                ->where('code', $request->code)
                ->get();
            if (count($country) > 0) {
                if ($files = $request->flag) {
                    $destinationPath    = public_path('/uploads/flag/');
                    $flagImage          = date('YmdHis') . "-" . $files->getClientOriginalName();
                    $path               = $files->move($destinationPath, $flagImage);
                    $flag               = $insert['photo'] = "uploads/flag/" . "$flagImage";
                } else {
                    $flag               = $insert['photo'] = "";
                }
                DB::table('countries')
                    ->where('id', $country[0]->id)
                    ->update([
                        'country' => $request->country,
                        'short_name' => $request->short_name,
                        'code' => $request->code,
                        'currency' => $request->currency,
                        'flag' => $flag,
                        'created_by'=>Auth::user()->id,
                        'deleted_at' => NULL
                    ]);
                $request->session()->flash('success', "Record has been added successfully.");
            } else {
                $validator = Validator::make($request->all(), [
                    'country'       => 'required|unique:countries|min:3|max:50',
                    'code'          => 'required|regex:/^\+\d{1,3}$/|unique:countries',
                    'short_name'    => 'required|min:2|max:50|unique:countries',
                    'currency'      => 'required',
                    'flag'          => 'required',
                ]);
                if ($validator->fails()) {
                    $validation = array();
                    foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                        $validation[$field_name] = $messages[0];
                    }
                } else {
                    if ($files = $request->flag) {
                        $destinationPath    = public_path('/uploads/flag/');
                        $flagImage          = date('YmdHis') . "-" . $files->getClientOriginalName();
                        $path               = $files->move($destinationPath, $flagImage);
                        $flag               = $insert['photo'] = "$flagImage";
                    } else {
                        $flag               = $insert['photo'] = "";
                    }


                    $countries                  = new Countrie();
                    $countries->country         = strtoupper($request->country);
                    $countries->code            = $request->code;
                    $countries->short_name      = strtoupper($request->short_name);
                    $countries->currency        = $request->currency;
                    $countries->description     = $request->description;
                    $countries->created_by      = Auth::user()->id;
                    $countries->flag            = 'uploads/flag/' . $flag;
                    if ($countries->save()) {
                        $request->session()->flash('success', "Record has been added successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                    return redirect()->back();
                }
                // dd($request->all());

            }
        }
        $data['content'] = 'admin.locations.add_country';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? []
            ]);
    }

    public function deleteCountries($id)
    {
        $delete = DB::table('countries')
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        session()->flash('error', 'Deleted Successfully..!');
        return redirect()->back();
    }

    public function getCities(Request $request, $id = null)
    {
        $result = DB::table('cities as ct')
            ->select(['ct.*', 're.region'])
            ->leftJoin('regions as re', 're.id', '=', 'ct.region_id')
            ->where(['ct.deleted_at' => NULL])
            ->get();
        $data['content'] = 'admin.locations.city_list';
        return view('layouts.content', compact('data'))
            ->with([
                'validation' => $validation ?? [],
                'cities' => $result
            ]);
    }

    public function addCities(Request $request, $id = null)
    {

        if ($request->post()) {
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'country' => 'required|numeric',
                'city' => 'required|min:2|max:20'
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                $city_exist = DB::table('cities')
                    ->where('city', $request->city)
                    ->where('country_id', $request->country)
                    ->where('region_id', $request->region)
                    ->get();
                if (!$city_exist->isEmpty()) {
                    $validation = array('city' => 'This city already created.');
                } else {
                    if (DB::table('cities')->insert([
                        'country_id' => $request->country,
                        'region_id' => $request->region,
                        'city' => $request->city,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ])) {
                        $request->session()->flash('success', "Record has been added successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                    return redirect()->back();
                }
            }
        }
        $countries = DB::table('countries')->where(['deleted_at' => NULL])->get();
        $regions = DB::table('regions')->where(['deleted_at' => NULL])->get();
        $data['content'] = 'admin.locations.add_city';
        return view('layouts.content', compact('data'))->with([
            'validation' => $validation ?? [],
            'countries' => $countries,
            'regions' => $regions
        ]);
    }

    public function deleteCities($id)
    {
        $delete = DB::table('cities')
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        session()->flash('error', 'Deleted Successfully..!');
        return redirect()->back();
    }

    public function getRegions(Request $request, $id = null)
    {
        $result = DB::table('regions as rg')
            ->select(['rg.*', 'cntry.country'])
            ->leftJoin('countries as cntry', 'cntry.id', '=', 'rg.country_id')
            ->where(['rg.deleted_at' => NULL])->get();
        $data['content'] = 'admin.locations.region_list';
        return view('layouts.content', compact('data'))->with([
            'validation' => $validation ?? [],
            'regions' => $result
        ]);
    }

    public function addRegions(Request $request, $id = null)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'country' => 'required|numeric',
                'region' => 'required|min:2|max:20'
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                $region_exist = DB::table('regions')
                    ->where('region', $request->region)
                    ->where('country_id', $request->country)
                    ->get();
                if (!$region_exist->isEmpty()) {
                    $validation = array(
                        'region' => 'This region already created.'
                    );
                } else {
                    if (DB::table('regions')
                        ->insert([
                            'country_id'    => $request->country,
                            'region'        => $request->region,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        ])
                    ) {
                        $request->session()->flash('success', "Record has been added successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                    return redirect()->back();
                }
            }
        }
        $countries = DB::table('countries')
            ->where(['deleted_at' => NULL])
            ->get();
        $data['content'] = 'admin.locations.add_region';
        return view('layouts.content', compact('data'))->with(['validation' => $validation ?? [], 'countries' => $countries]);
    }

    public function deleteRegions($id)
    {
        $delete = DB::table('regions')
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        session()->flash('error', 'Deleted Successfully..!');
        return redirect()->back();
    }
}
