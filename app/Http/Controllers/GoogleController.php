<?php  

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;  

class GoogleController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToGoogle()

    {
        
        return Socialite::driver('google')->redirect(); //This will return the view to google varification

    }

        

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback() //This will for login through process

    {
        

       // try {     

                $user = Socialite::driver('google')->stateless()->user(); //this will create the user
                $is_user = User::where('email', $user->getEmail())->first();           //This will check for email already exists
                if($is_user){               //this block will run if user already exists
                    Auth::login($is_user);
                    if((auth()->user()->user_group_id == 1)&&(auth()->user()->status == 'active')) {
                        return redirect()->intended('/');}

                        elseif((auth()->user()->user_group_id == 1)&&(auth()->user()->status == 'notice_period')) { 
                            return redirect()->intended('notice_period');}

                        elseif((auth()->user()->user_group_id == 2)&&(auth()->user()->status == 'active')) {
                            return redirect()->intended('manager');}

                            elseif((auth()->user()->user_group_id == 2)&&(auth()->user()->status == 'notice_period')) { 
                                return redirect()->intended('notice_period');}

                                elseif((auth()->user()->user_group_id == 4)&&(auth()->user()->status == 'active')){
                                    return redirect()->intended('employee');}

                                    elseif((auth()->user()->user_group_id == 4)&&(auth()->user()->status == 'notice_period')) { 
                                        return redirect()->intended('notice_period');}

                                        elseif((auth()->user()->user_group_id == 5)&&(auth()->user()->status == 'active')){
                                        //  print_r("hicall"); exit;
                                            return redirect('dashboard');}

                                            elseif((auth()->user()->user_group_id == 5)&&(auth()->user()->status == 'notice_period')) { 
                                                return redirect()->intended('notice_period');}
                                                elseif(auth()->user()->status == 'blocked') { 
                                                    return view('blocked_user');}
                            
                    // return redirect()->intended('dashboard'); //this will redirect to dashboard
                }
                else{           //This block will run if user(email) does not  exists
                        $newUser = User::create([
                            'name' => $user->name,
                            'email' => $user->email,
                            'google_id'=> $user->id,
                            'password' => encrypt('')//this is required since it is fillable and password generated will be unique
                        ]);
                        Auth::login($newUser);
                        return redirect()->intended('employee');
                    }
     //   } catch (Exception $e) {
        //         dd($e->getMessage());
         //       }

    }   

    public function login(Request $request)
    
    {  
        $inputVal = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){
            if(auth()->user()->user_group_id == 1) {
                return redirect()->intended('admin');}
                elseif(auth()->user()->user_group_id == 2) {
                    return redirect()->intended('manager');}
                    elseif(auth()->user()->user_group_id == 4){
                        return redirect()->intended('employee');}
                        elseif(auth()->user()->user_group_id == 5){
                           // print_R('hilog');exit;
                            return redirect()->intended('/dashboard');}
        }

    
    }
    public function logout(Request $request){
    $request->session()->flush();
    return redirect()->intended('login');
    }
}