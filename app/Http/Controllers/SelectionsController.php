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

class SelectionsController extends MyController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    /* Service Functions start */

    public function get(Request $request, $id = 1)
    {
        $result = array();
        $active_tab = '';
        switch ($id) {
            case 1:
                $result = Service_sector::select([
                    'id',
                    'sector as name',
                    DB::raw("'Service Sector' as under"),
                    'created_at'
                ])
                ->get()
                ->toArray();
                $active_tab = 'service_sector';
                break;
            case 2:
                $result =Service_categorie::select([
                    'id',
                    'category as name',
                    DB::raw("'Service Category' as under"),
                    'created_at'
                ])
                ->get()
                ->toArray();
                $active_tab = 'service_category';
                break;
            case 3:
                $result = Service_type::select([
                    'id',
                    'type as name',
                    DB::raw("'Service Type' as under"),
                    'created_at'
                ])
                ->get()
                ->toArray();
                $active_tab = 'service_type';
                break;
            case 4:
                $result = Service_level::select([
                    'id',
                    'level as name',
                    DB::raw("'Service Level' as under"), 
                    'created_at'
                ])
                ->get()
                ->toArray();
                $active_tab = 'service_level';
                break;
            case 5:
                $response = DB::table('durations')
                ->select(
                    'id',
                    'duration as name',
                    DB::raw("'Duration' as under"),
                    'created_at'
                )
                ->get()
                ->toArray();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'duration';
                break;
            case 6:
                $response = DB::table('activities')
                ->select(
                    'id',
                    'activity as name',
                    DB::raw("'Activities' as under"),
                    'created_at'
                )
                ->get()
                ->toArray();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'activities';
                break;
            case 7:
                $response = DB::table('aimed')
                ->select(
                    'id',
                    'AimedName as name',
                    DB::raw("'Aimed' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'aimed';
                break;
            case 8:
                $response = DB::table('dependency')->select(
                    'id',
                    'dependency_name as name',
                    DB::raw("'Dependency' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'dependency';
                break;
            // case 9:
            //     $response = DB::table('currencies')->select('id','name',DB::raw("'Currency' as under"),'created_at')->get();
            //     $resss = [];
            //     foreach ($response as $res) {
            //         $resss[] = (array) $res;
            //     }
            //     $result = $resss;
            //     $active_tab = 'currency';
            //     break;

            case 10:
                $response = DB::table('health_conditions')->select(
                    'id',
                    'name',
                    DB::raw("'name' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'healthconditionName';
                break;

            case 11:
                $response = DB::table('heights')->select(
                    'id',
                    'heightName as name',
                    DB::raw("'heightName' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'height';
                break;

            case 12:
                $response = DB::table('weights')->select(
                    'id',
                    'weightName as name',
                    DB::raw("'weightName' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'weight';
                break;

            case 13:
                $response = DB::table('contactuspurposes')->select(
                    'id',
                    'contactuspurposeName as name',
                    DB::raw("'contactuspurposeName' as under"),
                    'created_at'
                )
                ->get();
                $resss = [];
                foreach ($response as $res) {
                    $resss[] = (array) $res;
                }
                $result = $resss;
                $active_tab = 'contactuspurposes';
                break;
            default:
        }
        //        $this->prx($result);
        $data['content'] = 'admin.selections.selections';
        return view('layouts.content', compact('data'))->with([
            'records' => (array) $result, 'active_tab' => $active_tab
        ]);
    }

    public function add(Request $request)
    {
        //dd($request->all());
        $under = array(
            1 => 'Service Sectors',
            2 => 'Service Category',
            3 => 'Service Type',
            4 => 'Service Level',
            5 => 'Duration',
            6 => 'Activity',
            7 => 'Aimed',
            8 => 'Dependency',
            9 => 'Currency',
            10 => 'Health Condition',
            11 => 'Hieght',
            12 => 'Weight',
            13 => 'Contact Us Purpose'

        );
        if ($request->post()) {
            //unique:posts,title,{$this->post->id} // |digits:1
            $validator = Validator::make($request->all(), [
                'selection_name' => 'required|min:3|max:50',
                'comes_under' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $validation = array();
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $validation[$field_name] = $messages[0];
                }
            } else {
                switch ($request->comes_under) {
                    case 1:
                        $sector = new Service_sector();
                        $sector->sector = $request->selection_name;
                        $sector->created_at = date("Y-m-d H:i:s");
                        $sector->updated_at = date("Y-m-d H:i:s");
                        if ($sector->save()) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/1');
                        break;
                    case 2:
                        $sector = new Service_categorie();
                        $sector->category = $request->selection_name;
                        $sector->created_at = date("Y-m-d H:i:s");
                        $sector->updated_at = date("Y-m-d H:i:s");
                        if ($sector->save()) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/2');
                        break;
                    case 3:
                        $sector = new Service_type();
                        $sector->type = $request->selection_name;
                        $sector->created_at = date("Y-m-d H:i:s");
                        $sector->updated_at = date("Y-m-d H:i:s");
                        if ($sector->save()) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/3');
                        break;
                    case 4:
                        $sector = new Service_level();
                        $sector->level = $request->selection_name;
                        $sector->created_at = date("Y-m-d H:i:s");
                        $sector->updated_at = date("Y-m-d H:i:s");
                        if ($sector->save()) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/4');
                        break;
                    case 5:

                        if (DB::table('durations')->insert([
                            'duration' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/5');
                        break;
                    case 6:
                        if (DB::table('activities')->insert([
                            'activity' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/6');
                        break;
                    case 7:
                        if (DB::table('aimed')->insert([
                            'AimedName' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/7');
                        break;
                    case 8:
                        if (DB::table('dependency')->insert([
                            'dependency_name' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/8');
                        break;
                    case 9:
                        // if (DB::table('currencies')->insert([
                        //     'name' => $request->selection_name,
                        //     'created_at' => date("Y-m-d H:i:s"),
                        //     'updated_at' => date("Y-m-d H:i:s")
                        // ])) {
                        //     $request->session()->flash('success', "Record has been added successfully.");
                        // } else {
                        //     $request->session()->flash('error', 'Something went wrong. Please try again.');
                        // }
                        return redirect('/selections/9');
                        break;


                    case 10:
                        if (DB::table('health_conditions')->insert([
                            'name' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/10');
                        break;

                    case 11:
                        if (DB::table('heights')->insert([
                            'heightname' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/11');
                        break;

                    case 12:
                        if (DB::table('weights')->insert([
                            'weightName' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/12');
                        break;

                    case 13:
                        if (DB::table('contactuspurposes')->insert([
                            'contactuspurposeName' => $request->selection_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ])) {
                            $request->session()->flash('success', "Record has been added successfully.");
                        } else {
                            $request->session()->flash('error', 'Something went wrong. Please try again.');
                        }
                        return redirect('/selections/13');
                        break;
                    default:
                }
            }
        }
        $data['content'] = 'admin.selections.update_selections';
        return view('layouts.content', compact('data'))->with([
            'under' => $under, 'validation' => $validation ?? []
        ]);
    }

    public function delete(Request $request, $tab_id = 1, $item_id)
    {
        switch ($tab_id) {
            case 1:
                $sector = Service_sector::find($item_id);
                if ($sector) {
                    if ($sector->delete()) {
                        $request->session()->flash('success', "Record has been deleted successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                }
                break;
            case 2:
                $sector = Service_categorie::find($item_id);
                if ($sector) {
                    if ($sector->delete()) {
                        $request->session()->flash('success', "Record has been deleted successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                }
                break;
            case 3:
                $sector = Service_type::find($item_id);
                if ($sector) {
                    if ($sector->delete()) {
                        $request->session()->flash('success', "Record has been deleted successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                }
                break;
            case 4:
                $sector = Service_level::find($item_id);
                if ($sector) {
                    if ($sector->delete()) {
                        $request->session()->flash('success', "Record has been deleted successfully.");
                    } else {
                        $request->session()->flash('error', 'Something went wrong. Please try again.');
                    }
                }
                break;
            case 5:
                if (DB::table('durations')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;
            case 6:
                if (DB::table('activities')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;
            case 7:
                if (DB::table('aimed')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;
            case 8:
                if (DB::table('dependency')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;
            case 9:
                // if (DB::table('currencies')->where('id', '=', $item_id)->delete()) {
                //     $request->session()->flash('success', "Record has been deleted successfully.");
                // } else {
                //     $request->session()->flash('error', 'Something went wrong. Please try again.');
                // }
                break;

            case 10:
                if (DB::table('health_conditions')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;

            case 11:
                if (DB::table('heights')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;

            case 12:
                if (DB::table('weights')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;

            case 13:
                if (DB::table('contactuspurposes')->where('id', '=', $item_id)->delete()) {
                    $request->session()->flash('success', "Record has been deleted successfully.");
                } else {
                    $request->session()->flash('error', 'Something went wrong. Please try again.');
                }
                break;

            default:
        }
        return redirect('/selections/' . $tab_id);
    }
}
