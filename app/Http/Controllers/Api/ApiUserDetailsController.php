<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Billing;
use App\Models\UserDetails;
use Illuminate\Http\RedirectResponse;


class ApiUserDetailsController 
{
    public function index($user_id)
    {
        
        //getting auth user details
        $user = User::with('user_datail')->where('id', $user_id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id ?? "Not Found";
        $billing = Billing::where('id',$billing_id)->first();

        return response()->json([
            'user' => $user,
            'billing' => $billing
        ]);
    }

    //store details
    public function store(Request $request,$user_id)
    {
       
        
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
        
    if($user_details){
        return response()->json([
            'status' => 'success',
            'message' => 'Data fetched successfully',
        ], 200);}
        else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Failed to store data'
            ], 500);
        }
    }




    public function update(Request $request,$user_id)
    {
        $user = User::with('user_datail')->where('id',$user_id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $user_details = $user->user_datail;
        

        $data = $request->all();
        $user = $data['user'];
        $user_detail = $user['user_datail'];
        

        $user_details->update([
            'phone' => $user_detail['phone'],
            'adress' => $user_detail['adress'],
        ]);
      
        
        $billing->update([
            'type'=>$data['billing']['type'],
            'number' => $data['billing']['number'],
        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'details updated successfuly' 
    ],200);
    }

    
    public function destroy($user_id)
    { 
        $user = User::with('user_datail')->where('id', $user_id)->first();

        //getting his billing details
        $billing_id = $user->user_datail->billing_id;
        $billing = Billing::where('id',$billing_id)->first();

        $user_details = $user->user_datail;

        $user_details->delete();
        $billing->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'details deleted successfuly' 
    ],200);
        
    }
}
