<?php

namespace App\Http\Controllers;
use App\Models\Loan;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApplicationController extends Controller
{
    public function placeApplication(Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())->where('loan_id', $request->loan_id)->first();
                
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Loan not found in cart.');
        }
        //  Check if the user has already applied for this loan
        $existingApplication = Loan::where('email', auth()->user()->email)->where('loan_id', $cartItem->loan_id)->exists();

        if ($existingApplication) {
           return back()->with('error', 'You have already applied for this loan.');
        }
            
        try {
            // ✅ Save loan application in the `loans` table
            Loan::create([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone_number' => auth()->user()->phone_number,
                'loan_id' => $cartItem->loan_id,
                'loan_type' => $cartItem->loan_type,
                'bank_name' => $cartItem->bank_name,
                'applied_from_account' => auth()->user()->name,
                'status' => 'pending'
            ]);
    
            //  Remove only the applied loan from the cart (database)
            $cartItem->delete();
    
            return redirect()->route('application.thankyou')->with('success', 'Application placed successfully!');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    public function thankYou()
    {
        return view('application.thankyou');
    }

}