<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;
use Mail;

class ContactController extends Controller
{
    public function show(){
        return view('contact');
    }
    public function sendMail(){
        $validated = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'message'=>['required','max:200']
        ]);
               
        Mail::to(env('CONTACT_MAIL_TO_ADDRESS'))->send(new Contact($validated));
        return redirect()->back()->with('message','Mail received');
    }
}
