<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetails;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LoanDetailsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Response;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loandetails = LoanDetails::all();
        return view('admin.loandetails.index', compact('loandetails')); 
    }

    public function create()
    {
        return view('admin.loandetails.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'loan_id' => 'required|numeric|unique:loan_details,loan_id',
            'bank_name' =>['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9_ .]+$/'],
            'loan_type' => 'required|in:Home Loan,Car Loan,Education Loan,Personal Loan',
            'interest_rate' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'loan_tenure' => 'required|regex:/^\d+$/',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);     

        $bankLogoPath = null;
        if ($request->hasFile('bank_logo')) {
            $bankLogoPath = $request->file('bank_logo')->store('bank_logoes', 'public'); // Save in storage/app/public/bank_logoes
        }


        LoanDetails::create([
             'loan_id' => $request->loan_id,
             'bank_name' => $request->bank_name,
             'loan_type' => $request->loan_type,
             'interest_rate' => $request->interest_rate,
             'loan_tenure' => $request->loan_tenure,
             'bank_logo' => $bankLogoPath
        ]);

        return redirect()->route('admin-panel')->with('success', 'Loan created successfully');
    }

    public function loanDetails()
    {
        $loans = LoanDetails::all(); // Fetch all loans
        return view('loan', ['loans' => $loans]); // Pass loans to the view
    }

    // method for deleting loan
    public function destroy($id)
    {
        $loan = LoanDetails::find($id);

        if ($loan) {
            $loan->delete();
            return redirect()->route('admin-panel')->with('success', 'Loan deleted successfully!');
        } else {
            return redirect()->route('admin-panel')->with('success', 'Loan deleted successfully!');
        }
    }

    // method for edit loans
    public function edit($id)
    {
        $loan = LoanDetails::findOrFail($id);
        return view('admin.loandetails.edit', compact('loan'));
    }
    
    // method for update loans
    public function update(Request $request, $id)
    {
        $loan = LoanDetails::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'loan_type' => 'required|string',
            'interest_rate' => 'required|numeric',
            'loan_tenure' => 'required|integer',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle file upload if a new file is provided
        if ($request->hasFile('bank_logo')) {
            if ($loan->bank_logo) {
                Storage::disk('public')->delete($loan->bank_logo); // Delete the old file
            }

            // Store new logo
            $filePath = $request->file('bank_logo')->store('bank_logoes', 'public');
            $loan->bank_logo = $filePath; // Save new path
        }
        
        // Update fields
        $loan->bank_name = $request->bank_name;
        $loan->loan_type = $request->loan_type;
        $loan->interest_rate = $request->interest_rate;
        $loan->loan_tenure = $request->loan_tenure;

        $loan->save();

        return redirect()->route('admin-panel')->with('success', 'Loan updated successfully!');

    }

    public function show($loan_id)
    {
        // Fetch loan details based on loan_id
        $loan = LoanDetails::where('loan_id', $loan_id)->first();
    
        // If loan is not found, redirect back with an error
        if (!$loan) {
            return redirect()->route('loans.index')->with('error', 'Loan not found.');
        }
    
        // Return loan details view
        return view('loans.show', compact('loan'));
    }
    
    public function bulkUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:2048',
        ]);
    
        try {
             Excel::import(new LoanDetailsImport, $request->file('file'));
            return back()->with('success', 'Loan details uploaded successfully!');
        }catch (ValidationException $e) {
            return back()->with('error', '❌ There is a problem in the file. Please check and try again.');
        }catch (\Throwable $e) {
            return back()->with('error', '❌ There is a problem in the file. Please check and try again.');
        }
    }

    public function downloadDemoCsv()
    {
        $fileName = 'demo_loans.csv';
        $columns = ['loan_id', 'bank_name', 'loan_type', 'interest_rate', 'loan_tenure', 'bank_logo'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Example row (optional)
            fputcsv($file, ['123', 'Example Bank', 'Home Loan', '5.5', '20', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShJmhWEYD5RqWfIRJShYcr97_xXrxqzXBsbQ&s']);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
