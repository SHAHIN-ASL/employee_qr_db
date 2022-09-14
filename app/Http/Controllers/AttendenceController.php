<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\DataTables\AttendenceDataTable;
use App\Models\Attendence;
use Excel;
use App\Imports\AttendenceImport;
class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $attendence = Attendence::all();

        return view('attendence.index', compact('attendence'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //public function importForm()
   // {

    //   $records = Attendence::all();

       //return view('attendence.index',compact('records'));


   // }

    public function import(Request $request)
    {
        // dd(file_get_contents($request->file->));
        // $file = $request->file('file');
        // print_r('<pre>');
        // $temp = file_get_contents($file->getRealPath());
        // print_r(temp);die();

        Excel::import(new AttendenceImport,$request->file);
        $attendence = Attendence::all();
        return view('attendence.index',compact('attendence'));

    }
  // public function data(AttendenceDataTable $dataTab)
  // {
        //return $dataTab->render('attendence.index');
  // }


}
