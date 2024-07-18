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
        $userDetails = UserDetails::all();

        $userDetails = $userDetails->map(function ($detail) {
            $billing = Billing::find($detail->billing_id);
            $detail->billing_type = $billing->type;
            $detail->billing_number = $billing->number;
            return $detail;
        });

        return view('userDetails.index', ['userDetails' => $userDetails]);
    }

    //show create page
    public function create()
    {
        return view('userDetails.create');
    }

    //store details
    public function store(Request $request): RedirectResponse
    {
        $user_id = Auth::user()->getAuthIdentifier();
        $user = User::with('userDetails')->where('id', $user_id)->first();

        // $request->validate([
        //     'phone' => ['required','integer','digits:5'],
        //     'address' => ['required','string'],
        //     'pay_type' => ['required', 'in:visa,paypal']  ,
        //     'card_number'=> ['required','integer','digits:5']
        // ]);

        // dd(Auth::user()->getAuthIdentifier());
        $billing = Billing::create([
            'type' => $request->pay_type,
            'number' => $request->card_number
        ]);

        $user_details = UserDetails::create([
            'phone' => $request->phone,
            'billing_id' => $billing->id,
            'address' => $request->address,
            'user_id' => 21
        ]);

        return redirect(route('Usedetails.index', absolute: false));
    }

    public function edit($id)
    {

        $userDetail = UserDetails::where('user_id',$id)->first();

        $billing = $userDetail->billing;
        if ($billing) {
            $userDetail->billing_type = $billing->type;
            $userDetail->billing_number = $billing->number;
        }

        return view('userDetails.create', ['userDetail' => $userDetail]);
    }

    public function update($id,Request $request)
    {
        $userDetails = UserDetails::where('user_id', $id)->first();

        $billing = $userDetails->billing;

        $request->validate([
            'phone' => ['required', 'integer', 'digits:5'],
            'adress' => ['required', 'string'],
            'pay_type' => ['required', 'in:visa,paypal'],
            'card_number' => ['required', 'integer', 'digits:5']
        ]);

        $billing->update([
            'type' => $request->pay_type,
            'number' => $request->card_number
        ]);

        $userDetails->update([
            'phone' => $request->phone,
            'adress' => $request->adress,
        ]);

        return redirect(route('/', absolute: false));
    }
    public function destroy($id)
    {
        $userDetails = UserDetails::where('user_id', $id)->first();

        $billing = $userDetails->billing;

        $userDetails->delete();
        $billing->delete();
    }
}
