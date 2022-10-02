<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Session;


class LeaveTypeController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leavetype = LeaveType::all();
        return view('index', compact('LeaveType/leavetype'));
    }

    function viewLeaveType(Request $request) //This is for showing the data in manage page
    {
        
        
            $data = LeaveType::orderBy('id', 'desc')->Paginate(15);        
       // return view('manageleavetype');
        return view('LeaveType/manageleavetype', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('LeaveType/leavetype'); // Returns to Add view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // this function is used to store the data to database
    {
        $leavetype = $request->validate([       //This will be the form validation
            'type'=>'required',
            'days'=>'required',            
        ]);

                                           
        $leavetype = new LeaveType;                 
        $leavetype->type=$request->type;         
        $leavetype->days=$request->days;              
        
        $leavetype->save();   
        Session::Flash('success', 'Leave type successfully added.');      // This data will store
        
        return redirect('/'); 
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
    public function edit($id)       //for edit
    {
        //print_r($id); exit();
        $leavetype = LeaveType::findOrFail($id);
        
        return view('LeaveType/editleavetype', compact('leavetype'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function update(Request $request)        //This query for updating the Leave type
    {
        $request->validate([       //This will be the form validation
            'type'=>'required',
            'days'=>'required',            
        ]);
          //  $update_by_id = Auth::id();
            $updateData=LeaveType::find($request->id);
            $updateData->type=$request->type;
            $updateData->days=$request->days;
            $updateData->save();
            Session::Flash('success', 'Leave type has been updated.');       
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // for deleting
    {
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->delete();
        Session::Flash('success', 'Leave type has been deleted.');
        return redirect('/');
    }
}
