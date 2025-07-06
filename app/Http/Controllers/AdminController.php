<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Loan;
use App\Models\UserMessage;
use App\Models\LoanDetails;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalLoanApplications = Loan::count();
        $totalAvailableLoans = LoanDetails::count();
        $totalUserMessages = UserMessage::count();
        
        // dd([
        //     'Users' => $totalUsers,
        //     'Admins' => $totalAdmins,
        //     'Loan Applications' => $totalLoanApplications,
        //     'Available Loans' => $totalAvailableLoans,
        //     'User Messages' => $totalUserMessages,
        // ]);

        return view('Admin.admin-panel', compact(
            'totalUsers', 'totalAdmins', 'totalLoanApplications', 
            'totalAvailableLoans', 'totalUserMessages'
        ));
    }

    public function showRegistrationForm()
    {
        return view('Admin.admin_register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z][a-zA-Z0-9_ ]*$/', 'unique:users,name'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $profilePicPath = $file->store('profile_pics','public');
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'profile_pic' => $profilePicPath, 
            'role' => 'Admin'
        ]);

        return redirect()->back()->with('success', 'Admin added successfully!');
    }

    public function userDetails()
    {
        $users = User::where('role', 'User')->get(); // Get only admins
        return view('admin.UserDetails', compact('users'));
    }

    // Fetch and return the admins page
    public function adminDetails()
    {
        $admins = User::where('role', 'Admin')->get(); // Get only admins
        return view('admin.AdminDetails', compact('admins'));
    }

    // Fetch and return the loan applications page
    public function LoanApplications()
    {
        $loans = Loan::all();  // Get all loans
        return view('admin.LoanApplications', compact('loans'));
    }

    public function LoanDetails()
    {
        $loandetails = LoanDetails::all();
        return view('admin.loandetails.index', compact('loandetails')); 
    }

    // getting message form user
     public function storeUserMessage(Request $request){
        $request->validate([
            'name' =>  ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z][a-zA-Z0-9 ]*$/'],
            'email' => 'required|string|email|max:255',
            'subject' =>  ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z][a-zA-Z0-9 ]*$/'],
            'message' => 'required|string|min:8',  
        ]);
        $name = Auth::check() ? Auth::user()->name : 'GUEST USER';

        UserMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'applied_from_account' => $name,
        ]);

        return redirect()->route('contact')->with('success', 'Message Sended Successfully!');
    }

    public function userMessages()
    {
        $messages = UserMessage::all(); // Assuming you have a Message model
        return view('admin.UserMessage', compact('messages'));
    }
    
    public function dashboard() {
        return view('admin.dashboard');
    }
    
    public function updateStatus(Request $request)
    {
        $loan = Loan::find($request->loan_id);
        
        if (!$loan) {
            // return back()->with('success' => true, 'loan status changed succesfully.');
            return redirect()->back()->with('error', 'loan not found');
        }

        $loan->status = $request->status;
        $loan->save();
        return redirect()->back()->with('success', 'loan status changed successfully');
        // return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);

        // Delete the profile picture from storage if it exists
        if ($admin->profile_pic && Storage::exists('public/' . $admin->profile_pic)) {
            Storage::delete('public/' . $admin->profile_pic);
        }
    
        // Delete the admin record
        $admin->delete();
    
        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }
}
