<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Billing;
use App\Models\UserDetail;
use Illuminate\Http\RedirectResponse;

class UserDetailController extends Controller
{
    public function index()
    {
        //getting auth user details
        $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->userdetails->billing_id ?? "Not Found";
        $billing = Billing::where('id',$billing_id)->first();

        return view('userDetails.index',['user'=>$user,'billing'=>$billing]);
    }

    //show create page
    public function create()
    {
        return view('userDetails.create');
    }

    //store details
    public function store(Request $request) 
    {
        $user_id = Auth::user()->id;
        
        $request->validate([
            'phone' => ['required','integer'],
            'address' => ['required','string'],
            'type' => ['required', 'in:visa,pypal'],
            'number'=> ['required','integer']
        ]);

        $billing = Billing::create([
            'type'=>$request->type,
            'number' => $request->number
        ]);        
 
        $userdetails = UserDetail::create([
            'phone' => $request->phone,
            'billing_id' => $billing->id,
            'address' => $request->address,
            'user_id' => $user_id
        ]);
        
        $user = User::with('userdetails')->where('id', $user_id)->first(); // Added this line
        
        return view('userDetails.index',['user' => $user,'billing'=>$billing,'userdetails'=>$userdetails]); // Pass user and billing data
    }

    public function edit()
    {
        //getting auth user details
        $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

        // Check if user and userdetails exist
        if (!$user || !$user->userdetails) {
            return view('userDetails.index',['message'=> 'User details not found.']);
        }

        //getting his billing details
        $billing_id = $user->userdetails->billing_id;
        $billing = Billing::where('id', $billing_id)->first();

        return view('userDetails.create', ['user' => $user, 'billing' => $billing]);
    }


    public function update(Request $request)
    {
        $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->userdetails->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $userdetails = $user->userdetails;
        

        $request->validate([
            'phone' => ['required','integer'],
            'address' => ['required','string'],
            'type' => ['required', 'in:visa,pypal']  ,
            'number'=> ['required','integer',]
        ]);

        $userdetails->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
      
        
        $billing->update([
            'type'=>$request->type,
            'number' => $request->number
        ]);

        
        return view('userDetails.index',['billing'=>$billing,'userdetails'=>$userdetails,'user'=>$user]);
    }

    
    public function destroy(Request $request)
    { 
        $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

        //getting his billing details
        $billing_id = $user->userdetails->billing_id ?? null; // Use null coalescing
        $billing = Billing::where('id', $billing_id)->first();

        $userdetails = $user->userdetails;

        // Check if user details and billing exist before deleting
        if ($userdetails) {
            $userdetails->delete();
        }
        if ($billing) {
            $billing->delete();
        }

        return view('userDetails.index');
        
    }
}