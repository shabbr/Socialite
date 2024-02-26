<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
class MailController extends Controller
{
    public function __construct(){
        $this->middleware('checkVerification');
    }
    public function form(){
        return view('form');
    }
    public function send(){
        $user_id=auth()->user()->id;
       $user=User::find($user_id);
       Mail::to($user->email)->send(new EmailVerification($user));
       return view('mail_sent');
    }
    public function verified($id){
     $user=User::find($id);
      $user->email_verified_at=time();
      $user->update();
      return view('dashboard');
    }

 public function newUser(Request $request){
  $user=new User;
  $user->name=$request->name;
  $user->email=$request->email;
  $user->password=$request->password;
  $user->save();
  return view('verify',['user'=>$user]);
 }
}
