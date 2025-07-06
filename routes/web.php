<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ApplicationController;
use App\Exports\UsersExport;
use App\Exports\AdminsExport;
use App\Exports\LoanApplicationsExport;
use App\Exports\LoanDetailsExport;
use App\Exports\UserMessagesExport;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/', function () {
    return view('home');
});

// show home page
Route::get('/home', function () {
    return view('home');
});

//show about-us page
Route::get('/about-us', function () {
    return view('about-us');
});

//show news page
Route::get('/news', function () {
    return view('news');
});

//show contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//all routes of admin panel which are accesessable by admin only
Route::middleware(['auth', 'admin.only'])->group(function () {

    // show admin page
    Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin-panel');
    
    // add admin
    Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.store');

    // showing details in admin panel 
    Route::get('/admin/UserDetails', [AdminController::class, 'userDetails']);
    Route::get('/admin/AdminDetails', [AdminController::class, 'adminDetails']);
    Route::get('/admin/LoanApplications', [AdminController::class, 'LoanApplications']);
    Route::get('/admin/LoanDetails', [AdminController::class, 'LoanDetails']);
    Route::get('/admin/UserMessage', [AdminController::class, 'userMessages'])->name('admin.userMessages');
    Route::post('/update-loan-status', [AdminController::class, 'updateStatus'])->name('update.loan.status');
    
    // loan details management
    Route::get('/admin/LoanDetails', [LoanDetailsController::class, 'index'])->name('admin.loandetails.index');
    // Route::get('/admin/loandetails', [LoanDetailsController::class, 'index'])->name('admin.loandetails.index');
    Route::get('/admin/loandetails/{id}/edit', [LoanDetailsController::class, 'edit'])->name('admin.loandetails.edit');
    Route::put('/admin/loandetails/{id}', [LoanDetailsController::class, 'update'])->name('admin.loandetails.update');
    Route::delete('/admin/loandetails/{id}', [LoanDetailsController::class, 'destroy'])->name('admin.loandetails.delete');
    Route::get('/admin/loandetails/create', [LoanDetailsController::class, 'create'])->name('admin.loandetails.create');
    Route::post('/admin/loandetails/store', [LoanDetailsController::class, 'store'])->name('admin.loandetails.store');
});


// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Handle login form submission
Route::post('/login', [AuthController::class, 'login']);

// Show registration form
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Handle registration form submission
Route::post('register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return view('home');
    })->name('home');
});


// Profile Route
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth')->name('profile');

// Handle logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// add loan details into database
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

// Show applications to user
Route::get('/UserApplications', [LoanController::class, 'UserApplications']);

// add a route for update loan applications
Route::get('/applications/{id}/edit', [LoanController::class, 'edit'])->name('applications.edit');
Route::put('/applications/{id}', [LoanController::class, 'update'])->name('applications.update');

// add a route for delete applications
Route::delete('/applications/{id}', [LoanController::class, 'destroy'])->name('applications.destroy');

// update user profile
Route::middleware(['auth'])->group(function () {
    Route::get('edit_profile', [AuthController::class, 'editProfile'])->name('edit');
    Route::put('update_profile', [AuthController::class, 'updateProfile'])->name('update');
});
// Route::middleware(['auth'])->group(function () {
//     Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
//     Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
// });

// Route::resource('loandetails', LoanDetailsController::class); 
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('loandetails', LoanDetailsController::class);
// });

// create,update and delete loan applications
Route::resource('loans', LoanController::class); 


// getting loans details from database
Route::get('/loan', [LoanDetailsController::class, 'loanDetails'])->name('loan.details');

// delete loan from the database
Route::delete('/admin/loandetails/{id}', [LoanDetailsController::class, 'destroy'])->name('admin.loandetails.delete');

// getting message form user
Route::post('/user-message', [AdminController::class, 'storeUserMessage'])->name('userMessage');

// showing more about loan
Route::get('/loan-details/{loan_id}', [LoanDetailsController::class, 'show'])->name('loan.details.show');

# admin - panel
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/loan/{id}', [LoanController::class, 'show'])->name('Loan.show');

// add to cart
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// submit loan applications (place applications)
Route::post('/application/place', [ApplicationController::class, 'placeApplication'])->name('application.place');
Route::get('/application/thank-you', [ApplicationController::class, 'thankYou'])->name('application.thankyou');  

// Export all details

Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
});
Route::get('/export-admins', function () {
    return Excel::download(new AdminsExport, 'admins.xlsx');
});
Route::get('/export-loan-details', function () {
    return Excel::download(new LoanDetailsExport, 'loan-details.xlsx');
});
Route::get('/export-user-messages', function () {
    return Excel::download(new UserMessagesExport, 'user-messages.xlsx');
});
Route::get('/export-loan-application', function () {
    return Excel::download(new LoanApplicationsExport, 'loan-applications.xlsx');
});

 // upload loan details in bulk
 Route::post('/admin/loans/bulk-upload', [LoanDetailsController::class, 'bulkUpload'])->name('loans.bulkUpload');

// route for download demo file
Route::get('/download-demo-csv', [LoanDetailsController::class, 'downloadDemoCsv'])->name('loans.downloadDemoCsv');

// route for delete admin
Route::delete('/admin/{id}', [AdminController::class, 'destroyAdmin'])->name('admin.destroy');