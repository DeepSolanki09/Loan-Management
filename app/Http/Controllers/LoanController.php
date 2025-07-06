<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        return redirect()->route('loans.index'); // Or return an empty view if needed
    }    

    public function store(Request $request)
    {
        try{
            
            $request->validate([
                'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z][a-zA-Z0-9]*$/'],
                'email' => 'required|email|max:255',
                'phone_number' => 'required|regex:/^\+?[0-9]{10,15}$/',
                'loan_id' => 'required|integer',
                'loan_type' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',    
            ]);
            
            // Check if this user has already applied for the same loan
            $request->merge(['loan_id' => (int) $request->loan_id]);
            $existingApplication = Loan::where('email', $request->email)->where('loan_id', $request->loan_id)->exists();
        
            if ($existingApplication) {
                return back()->with('error', 'You have already applied for this loan.');
            }

            // If no duplicate, create a new loan application
            Loan::create([
                'name' => Auth::user()->name ?? $request->name,
                'email' => Auth::user()->email ?? $request->email,
                'phone_number' => Auth::user()->phone_number ?? $request->phone_number,
                'loan_id' => $request->loan_id,
                'loan_type' => $request->loan_type,
                'bank_name' => $request->bank_name,
                'applied_from_account' => Auth::user()->name ?? 'Guest',
                'status' => 'pending'
            ]);
            return redirect()->back()->with('success', 'Loan application submitted successfully!');

        }catch (\Exception $e) {
             return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    public function UserApplications()
    {
        $UserApplications = Loan::all();  // Get all loans
        return view('UserApplications', compact('UserApplications'));
    }
    
    public function destroy($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return redirect()->back()->with('error', 'Loan application not found.');
        }
        
        $loan->delete();
        
        return redirect()->back()->with('success', 'Loan application deleted successfully.');
    }

    public function edit($id)
    {
        $UserApplication = Loan::find($id);

        if (!$UserApplication) {
            return redirect()->back()->with('error', 'Loan application not found.');
        }

        return view('edit_application', compact('UserApplication'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'loan_type' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
        ]);

        $loan = Loan::find($id);

        if (!$loan) {
            return redirect()->back()->with('error', 'Loan application not found.');
        }

        $loan->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'loan_type' => $request->loan_type,
            'bank_name' => $request->bank_name,
        ]);

        return redirect('/UserApplications')->with('success', 'Loan application updated successfully.');
    }

    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.show', compact('loan'));
    }
}
