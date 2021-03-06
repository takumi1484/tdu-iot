<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;


class ContactController extends Controller
{
    public function index(){
        return view('support');
    }

    public function confirm(ContactRequest $request){
      
        $contact = $request->all();

        $request->session()->regenerateToken();

        return view('confirm',$contact);
    }
    
    public function sent(ContactRequest $request){
      
        $contact = $request->all();
        if($request->action === 'back') {
            return redirect()->route('contact')->withInput($contact);
        }

        $request->session()->regenerateToken();
        \Mail::to('tdu.smartcontroller@gmail.com')->send(new ContactMail($contact));

        return view('thanks');
    }
}
