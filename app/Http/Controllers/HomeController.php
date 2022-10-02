<?php

namespace App\Http\Controllers;

use App\Models\Users;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {  
        if(auth()->user()->status == 'active')
            {  
                return view('admin');
            }
        elseif(auth()->user()->status == 'blocked')
            {  
                return view('blocked_user');
            }
        elseif(auth()->user()->status == 'notice_period')
            {  
                return view('notice_period');
            }
    }
    public function manager()
    {   
        if(auth()->user()->status == 'active')
        {  
            return view('manager');
        }
        elseif(auth()->user()->status == 'blocked')
            {  
                return view('blocked_user');
            }
        elseif(auth()->user()->status == 'notice_period')
        {  
            return view('notice_period');
        }
        
    }
    public function employee()
    {  
        if(auth()->user()->status == 'active')
        {  
            return view('employee');
        }
        elseif(auth()->user()->status == 'blocked')
            {  
                return view('blocked_user');
            }
        elseif(auth()->user()->status == 'notice_period')
        {  
            return view('notice_period');
        }      
       
    }
    public function sales_employee()
    {   
        if(auth()->user()->status == 'active')
        {  
            return view('sales_employee');
        }
        elseif(auth()->user()->status == 'blocked')
            {  
                return view('blocked_user');
            }
        elseif(auth()->user()->status == 'notice_period')
        {  
            return view('notice_period');
        }  
      
    }
}
