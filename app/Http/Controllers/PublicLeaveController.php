<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PublicLeave;
use Illuminate\Support\Facades\Session;

class PublicLeaveController extends Controller


{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicleave = PublicLeave::all();
        return view('index', compact('publicleave'));
    }

    function viewPublicLeave(Request $request) //This is for showing the data in manage page
    {
        
        
            $data = PublicLeave::orderBy('id', 'desc')->Paginate(25);        
       // return view('manageleavetype');
        return view('PublicLeave/managepublicleave', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('PublicLeave/addpublicleave'); // Returns to Add view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // this function is used to store the data to database
    {
        $publicleave = $request->validate([       //This will be the form validation
            'name'=>'required',
            'date'=>'required',
            'type'=>'required',            
        ]);

                                           
        $publicleave = new PublicLeave;                 
        $publicleave->name=$request->name;         
        $publicleave->date=$request->date;
        $publicleave->type=$request->type;               
        
        $publicleave->save();         // This data will store
      
        Session::Flash('success', 'Public holiday has been added.');
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
        $publicleave = PublicLeave::findOrFail($id);
        
        return view('PublicLeave/editpublicleave', compact('publicleave'));
        
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
            'name'=>'required',
            'date'=>'required',  
            'type'=>'required',          
        ]);
          //  $update_by_id = Auth::id();
            $updateData=PublicLeave::find($request->id);
            $updateData->name=$request->name;
            $updateData->date=$request->date;
            $updateData->type=$request->type;
            $updateData->save();       
       
        Session::Flash('success', 'Public holiday has been updated.');
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
        $publicleave = PublicLeave::findOrFail($id);
        $publicleave->delete();
        Session::Flash('success', 'Public leave has been deleted.');
        return redirect('/');
    }
}
