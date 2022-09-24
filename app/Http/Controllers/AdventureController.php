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
use App\User;
use DB;
use Hash;
use Auth;

class AdventureController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role');
  }
  /* Shop adventure program Functions start */
  public function manage_adventure_program()
  {
    $adventure_program = DB::table('adventure_programs')
      ->orderBy('id', 'Desc')
      ->get();
    $data['content'] = 'admin.adventure_program.manage_adventure_program';
    return view('layouts.content', compact('data'))->with(['adventure_program' => $adventure_program]);
  }

  public function add_adventure_program()
  {
    $data['content'] = 'admin.adventure_program.add_adventure_program';
    return view('layouts.content', compact('data'));
  }

  public function add_adventures_program(Request $request)
  {

    /*print_r($request->all()); die;*/

    if ($request->adventure_program_editid) {
      foreach ($request->program_titles ?? '' as $item) {
        $imageinsert = DB::table('programs')
          ->where('id', $request->program_titles)
          ->update([
            'title' => $item,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
          ]);
      }

      $insertdata = DB::table('adventure_programs')
        ->where('id', $request->adventure_program_editid)
        ->update([
          'title' => $request->adventure_title_desc,
          'description' => $request->adventure_title_desc,
          'start_datetime' => $request->start_datetime,
          'end_datetime' => $request->end_datetime,
          'status' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      session()->flash('success', 'Data Update Successfully..!');
    } else {
      foreach ($request->program_titles ?? '' as $item) {
        $imageinsert = DB::table('programs')
          ->insertGetId([
            'title' => $item,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        $array[] = $imageinsert;
      }

      $programsIds = implode(',', $array);

      $insertdata = DB::table('adventure_programs')
        ->insert([
          'title' => $request->adventure_title_desc,
          'description' => $request->adventure_title_desc,
          'program_ids' => $programsIds,
          'start_datetime' => $request->start_datetime,
          'end_datetime' => $request->end_datetime,
          'status' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      session()->flash('success', 'Data Insert Successfully..!');
    }


    return redirect('manage-adventure-program');
  }

  public function view_adventure_program($id)
  {
    $view_adventure_program = DB::table('adventure_programs')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.adventure_program.view_adventure_program';
    return view('layouts.content', compact('data'))
      ->with([
        'view_adventure_program' => $view_adventure_program
      ]);
  }

  public function edit_adventure_program($id)
  {
    $edit_adventure_program = DB::table('adventure_programs')
      ->where('id', $id)
      ->first();

    $data['content'] = 'admin.adventure_program.edit_adventure_program';
    return view('layouts.content', compact('data'))
      ->with([
        'edit_adventure_program' => $edit_adventure_program
      ]);
  }

  public function delete_adventure_program($id)
  {
    $data = DB::table('adventure_programs')
      ->where('id', $id)
      ->first();
    $explodedata = explode(',', $data->program_ids ?? '');
    if ($explodedata != '') {
      foreach ($explodedata as $key => $value) {
        $delete = DB::table('programs')
          ->where('id', $value)
          ->delete();
      }
    }

    $delete = DB::table('adventure_programs')
      ->where('id', $id)
      ->delete();
    session()->flash('error', 'Deleted Successfully..!');
    return redirect()->back();
  }
  /* Shop adventure program Functions End */
}
