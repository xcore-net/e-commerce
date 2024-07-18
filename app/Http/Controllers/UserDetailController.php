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
        $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
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
        $user = User::with('userdetails')->where('id', $user_id)->first(); 
        
        $request->validate([
            'phone' => ['required','integer','digits:5'],
            'address' => ['required','string'],
            'pay_type' => ['required', 'in:visa,paypal']  ,
            'card_number'=> ['required','integer','digits:5']
        ]);

        $billing = Billing::create([
            'type'=>$request->pay_type,
            'number' => $request->card_number
        ]);        
 
        $user_details = UserDetails::create([
            'phone' => $request->phone,
            'billing_id' => $billing->id,
            'address' => $request->address,
            'user_id' => $user_id
        ]);
        
        
        
        return redirect(route('/', absolute: false));
    }

    public function edit()
    {
        return view('userDetails.create',['user'=>Auth::user()->id]);
    }


    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::with('userdetails')->where('id', $user_id)->first(); 
        $billing_id = $user->user_datail->billing_id;

        $request->validate([
            'phone' => ['required','integer','digits:5'],
            'address' => ['required','string'],
            'pay_type' => ['required', 'in:visa,paypal']  ,
            'card_number'=> ['required','integer','digits:5']
        ]);

        $billing = Billing::where('id',$billing_id)->first();
        $billing->update([
            'type'=>$request->pay_type,
            'number' => $request->card_number
        ]);

        $user_details = UserDetails::where('user_id', $user_id)->first();
        $user_details->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        return redirect(route('/', absolute: false));
    }


    public function destroy(Request $request)
    { 
        $user_id = Auth::user()->id;
        $user = User::with('userdetails')->where('id', $user_id)->first(); 
        
        
        $user_details = UserDetails::where('user_id', $user_id)->first();
        
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $user_details->delete();
        $billing->delete();
        
    }
}
