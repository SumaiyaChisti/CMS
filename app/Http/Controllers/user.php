<?php

namespace App\Http\Controllers;
use App\Mail\Sendmail;
use App\Models\users as US;
use Illuminate\Http\Request;
use App\Models\List1 as l1;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class user extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $users= DB::select('select * from list');
    return view('table',['users'=>$users]);
    //return json_encode($users);
    
    }
    public function api_index()
    {
       $users= DB::select('select * from list');
    
    return json_encode($users);
    
    }
    public function home()
    {
        return view('home');
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function forogot()
    {
        return view('forgot');
    }
    public function navbar()
    {
        return view('navbar');
    }


    function sendmail(){
        $otp= random_int(1111,9999);
        
        Mail::to('example@gmail.com')->send(new Sendmail($otp));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user=new l1;
        $user->Name=$request->Name;
        $user->Rollno=$request->Rollno;
        $user->Class=$request->Class;
        $user->Parentage=$request->Parentage;
        $user->Address=$request->Address;
        $user->Phone=$request->Phone;
       
        $user->save();
        return redirect('form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           
       
            $this->validate($request,[
                'name' =>  'required',
                'email'=>'required',
                'password'=>'required'
            ]);



        $flag=false;
        $input = $request->email;
        $todo=US::all(); 
        foreach($todo as $td)
        {
            if($td['email']==$input)
            {
                $flag=true;
            }
        }
    //-------------------------------------------//
       
       if($flag==true)
            {
                 return redirect('register')->with("status","email exist");                
            }

    else{
      
        //  Store data in database
        $user=new US;
        $user->name=$request->name;
        $user->Roll=$request->Roll;
        $user->Status=$request->Status;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();




        $otp= random_int(1111,9999);
        session(['otp_pin'=>$otp]);
        session(['email'=>$request->email]);
        Mail::to($request->email)->send(new Sendmail($otp));
        return redirect('active');
    //    return redirect('register')->with("status","registered successfully");
    }
    }
    public function active(Request $request){
        $email = $request->email;
        $otp= $request->otp;

        if($otp==session()->get('otp_pin')){
            $user = new US;
            $user::where ('email',$email)->update(['Status'=> 1]);
            session()->forget('otp_pin');
            session()->forget('email');
            return redirect('login');
        }
        else{
            return redirect('active');
        }
    }

    public function setpassword(Request $request){
        $email = $request->email3;
        $password= $request->pass;

       
            $user = new US;
            $user::where ('email',$email)->update(['password'=> $password]);
            session()->forget('otp_2');
            session()->forget('email2');
            return redirect('login');

    }







    public function forgot(Request $request){
      
        $flag=false;
        $input = $request->email;
        $todo=US::all(); 
        foreach($todo as $td)
        {
            if($td['email']==$input)
            {
                $flag=true;
            }
        }
    //-------------------------------------------//
       
       if($flag==true)
            {
                $otp= random_int(1111,9999);
                session(['otp_2'=>$otp]);
                session(['email2'=>$request->email]);
                Mail::to($request->email)->send(new Sendmail($otp));
                return redirect('otp2');
                       
            }
            else{
                
             return redirect('forgot')->with("msg2","email not found");            
            }

    }
    
    public function confirm(Request $request){
        $otp= $request->otp2;

        if($otp==session()->get('otp_2')){
            return redirect('new');
        }
        else{
            return redirect('otp2');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=US::find($id);
        return view('update',['user'=>$user]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $user = new US;
        $user->Name = $request->Name;
        $user->Rollno = $request->Rollno;
        $user->Class = $request->Class;
        $user->Parentage = $request->Parentage;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;
        $user::where ('id',$id)->update(['Name'=> $user->Name],['Rollno'=>$user->Rollno],['Class'=>$user->Class],['Parentage'=>$user->Parentage],['Address'=>$user->Address],['Phone'=>$user->Phone]);
        
        return redirect("table");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //US::where('id',$id)->delete();
        //return redirect('table');
        DB::delete('delete from list where id=?',[$id]);
        echo"deleted successfully";
        return redirect('table');
        

    }
}
