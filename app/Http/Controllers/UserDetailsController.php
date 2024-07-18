<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Billing;
use App\Models\UserDetails;
use Illuminate\Http\RedirectResponse;

class UserDetailsController extends Controller
{
    public function index()
    {
        //getting auth user details
        $user = User::with('user_datail')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id ?? "Not Found";
        $billing = Billing::where('id',$billing_id)->first();

        return view('userDetails.index',['user'=>$user,'billing'=>$billing]);
    }

    //show create page
    public function create()
    {
        return view('userDetails.create');
    }

    //store details
    public function store(Request $request) :RedirectResponse
    {
        $user_id = Auth::user()->id;
        
        $request->validate([
            'phone' => ['required','integer','digits:5'],
            'adress' => ['required','string'],
            'pay_type' => ['required', 'in:visa,paypal'] ,
            'card_number'=> ['required','integer','digits:5']
        ]);

        $billing = Billing::create([
            'type'=>$request->pay_type,
            'number' => $request->card_number
        ]);        
 
        $user_details = UserDetails::create([
            'phone' => $request->phone,
            'billing_id' => $billing->id,
            'adress' => $request->adress,
            'user_id' => $user_id
        ]);
        
        
        
        return redirect()->route('welcome');
    }

    public function edit()
    { //getting auth user details
        $user = User::with('user_datail')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        return view('userDetails.create',['user'=>$user,'billing'=>$billing]);
    }


    public function update(Request $request)
    {
        $user = User::with('user_datail')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $user_details = $user->user_datail;
        

        $request->validate([
            'phone' => ['required','integer','digits:5'],
            'adress' => ['required','string'],
            'pay_type' => ['required', 'in:visa,paypal']  ,
            'card_number'=> ['required','integer','digits:5']
        ]);

        $user_details->update([
            'phone' => $request->phone,
            'adress' => $request->adress,
        ]);
      
        
        $billing->update([
            'type'=>$request->pay_type,
            'number' => $request->card_number
        ]);

        
        return redirect()->route('welcome');
    }

    
    public function destroy(Request $request)
    { 
        $user = User::with('user_datail')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $user_details = $user->user_datail;

        $user_details->delete();
        $billing->delete();

        return redirect()->route('welcome');
        
    }
}
