<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use App\Models\CookieData;

class AuthController extends Controller
{

     // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    // Handle registration logic
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z][a-zA-Z0-9_ ]*$/', 'unique:users,name'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle Profile Picture Upload (if any)
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $profilePicPath = $file->store('profile_pics','public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'profile_pic' => $profilePicPath, 
            'role' => 'User'
        ]);
        

        Auth::login($user);
        return redirect()->route('register')->with('js_alert','User registered succesfully'); 
    }

    // show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    
    // Handle login logic
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Check if the email exists
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            // If email does not exist
            return back()->withErrors(['email' => 'User does not exist.']);
        }

        if ($request->has('is_admin') && $user->role !== 'Admin') {
            return back()->with(['error' => 'You are not authorized to log in as Admin.']);
        }

        if (!$request->has('is_admin') && $user->role === 'Admin') {
            return back()->with('error', 'Admins must check the "Login as Admin" checkbox.');
        }

        // Check if the password matches
        if (!\Hash::check($validatedData['password'], $user->password)) {
            // If password is incorrect
            return back()->withErrors(['password' => 'Invalid password.']);
        }
        
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate(); // Security best practice
            return redirect()->intended('home'); // Redirect triggers the save login popup
        }

         return back()->withErrors(['password' => 'Invalid password.']);
    }

    public function profile()
    {
        // Get the logged-in user
        $user = Auth::user();
        
        return view('profile', compact('user'));
    }

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
     
    
    // edit and update user profile
    public function editProfile()
    {
        $user = auth()->user(); // Get the logged-in user
        return view('edit_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user(); // Get logged-in user
    
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }
    
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
    
        // Update password if a new one is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {

            // Delete old profile picture if exists
            if ($user->profile_pic) {
                Storage::delete('public/' . $user->profile_pic);
            }
            // Store new profile picture
            $path = $request->file('profile_pic')->store('profile_pictures', 'public');
            $user->profile_pic = $path;
        }

        $user->save(); // Save changes
    
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
