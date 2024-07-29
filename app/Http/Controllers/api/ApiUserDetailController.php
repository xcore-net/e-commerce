<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Billing;
use App\Models\UserDetail;
use Illuminate\Http\RedirectResponse;

class ApiUserDetailController extends Controller
{
//     public function index()
//     {
//         //getting auth user details
//         $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

//         //getting his billing details
//         $billing_id = $user->userdetails->billing_id ?? "Not Found";
//         $billing = Billing::where('id',$billing_id)->first();
//         return response()->json(['billing' => $billing, 'user' => $user]);
//         // return view('userDetails.index',['user'=>$user,'billing'=>$billing]);
//     }

 
   

//     //store details
//     public function store(Request $request) 
//     {
//         $user_id = Auth::user()->id;
        
//         $request->validate([
//             'phone' => ['required','integer'],
//             'address' => ['required','string'],
//             'type' => ['required', 'in:visa,pypal'] ,
//             'number'=> ['required','integer']
//         ]);

//         $billing = Billing::create([
//             'type'=>$request->type,
//             'number' => $request->number
//         ]);        
 
//         $userdetails = UserDetail::create([
//             'phone' => $request->phone,
//             'billing_id' => $billing->id,
//             'address' => $request->address,
//             'user_id' => $user_id
//         ]);
        
        
        
//         return response()->json(['message'=>'stored succesfuly'],201);
//     }

    


//     public function update(Request $request)
//     {
//         $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

//         //getting his billing details
//         $billing_id = $user->userdetails->billing_id;
//         $billing = Billing::where('id',$billing_id)->first();

//         $userdetails = $user->userdetails;
        

//         $request->validate([
//             'phone' => ['required','integer'],
//             'address' => ['required','string'],
//             'type' => ['required', 'in:visa,pypal']  ,
//             'number'=> ['required','integer',]
//         ]);

//         $userdetails->update([
//             'phone' => $request->phone,
//             'address' => $request->address,
//         ]);
      
        
//         $billing->update([
//             'type'=>$request->type,
//             'number' => $request->number
//         ]);

        
//         return response()->json(['message'=>'updated succesfuly']);
//     }

    
//     public function destroy(Request $request)
//     { 
//         $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

//         //getting his billing details
//         $billing_id = $user->userdetails->billing_id;
//         $billing = Billing::where('id',$billing_id)->first();

//         $userdetails = $user->userdetails;

//         $userdetails->delete();
//         $billing->delete();

//         return response()->json(['message'=>'deleted succesfuly']);
        
//     }
// }

public function index()
{
    //getting auth user details
    $user = User::with('userdetails')->where('id', Auth::user()->id)->first();

    //getting his billing details
    $billing_id = $user->userdetails->billing_id ?? "Not Found";
    $billing = Billing::where('id',$billing_id)->first();

    return response()->json(['billing' => $billing, 'user' => $user]);
}

//show create page


//store details
public function store(Request $request) 
{
    $user_id = Auth::user()->id;
    
    $request->validate([
        'phone' => ['required','integer'],
        'address' => ['required','string'],
        'type' => ['required', 'in:visa,pypal'] ,
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

    return response()->json(['message'=>'stored succesfuly','billing' => $billing, 'user' => $user,'userdetails'=>$userdetails],201);
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
    $userdetails = $user['userdetails'];
    $userdetails->update([
        'phone' => $request->phone,
        'address' => $request->address,
    ]);
  
    
    $billing->update([
        'type'=>$request->type,
        'number' => $request->number
    ]);

            return response()->json(['message'=>'updated succesfuly','billing'=>$billing,'userdetails'=>$userdetails,'user'=>$user]);

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

    return response()->json(['message'=>'deleted succesfuly']);    
}
}