<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LoanDetails;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        return view('cart.cart',compact('cartItems'));
    }

    public function addToCart(Request $request)
    {

        $loanId = $request->input('loan_id');
        $loan = DB::table('loan_details')->where('loan_id', $loanId)->first();
    
        if (!$loan) {
            return redirect()->back()->with('error', 'Loan not found.');
        }
    
        // Check if loan is already in cart
        $existingCartItem = Cart::where('user_id', auth()->id())->where('loan_id', $loanId)->exists();
    
        if ($existingCartItem) {
            return redirect()->back()->with('error', 'Loan is already in your wishlist.');
        }
    
        // Add loan to database cart
        Cart::create([
            'user_id' => auth()->id(),
            'loan_id' => $loan->loan_id,
            'loan_type' => $loan->loan_type,
            'interest_rate' => $loan->interest_rate,
            'loan_tenure' => $loan->loan_tenure,
            'bank_name' => $loan->bank_name,
        ]);
    
        return redirect()->back()->with('success', 'Loan added to wishlist.');

    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Loan not found in wishlist.');
        }

        $cartItem->delete(); // Remove the loan from the database

        return redirect()->back()->with('success', 'Loan removed from wishlist.');

    }
}