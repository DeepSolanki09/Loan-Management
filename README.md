## Loan Management System

This is a Laravel-based Loan Management System (LOAN2GO) that helps manage loan applications, approvals, repayments, and customer records.

## Features
# User side
- Login/Registration
- Check and apply for loans
- Filter loans by bank name or loan type
- Calculate EMI as per loan interest
- Add and remove Loans in wishlist 
- Message to admin for any query or furthur information
- Check status of applied loan applications
- Edit Profile
  
# Admin side
- See number of Users, Admins, Loan applications by users, Available loans from bank, User messages
- Add and remove any admin
- Approve or reject user's loans application
- Add a new loan, update and delete the existing loan, upload multiple loans in bulk with CSV or Excel file, Download CSV file Demo
- See Users, User messages
- Export user details, admin details,user loan application details, and available loan details in excel format

## Built with
- Laravel 
- Bootstrap
- PHP 8+
- MySQL (via XAMPP)

## Follow these steps to set up the project locally:
# Prerequisites
- PHP (8.0+)
- Composer
- XAMPP (Apache & MySQL)
- Git (to clone the project)

# Installation
1. clone the repository git clone
https://github.com/your-username/loan-management-system.git

2. Navigate into the project folder
cd loan-management-system

3. Install dependencies
composer install

4. Copy the example env file
cp .env.example .env

5. Genrate application key
php artisan key:generate

6. Set up database in .env file
In your .env file, 

DB_DATABASE=your_db_name
DB_PASSWORD=your_db_password_or_blank

Change your_db_name into your database name like LoanDB
Change your_db_password_or_blank into your password if you want to add a password otherwise remove it 

7. Run this command
php artisan storage:link

8. Run migration
php artisan migrate (if it asks you somthing , then reply 'yes')

9. Open in browser
https://127.0.0.1:8000

## Usage
- Start Aparche and MySQL from XAMPP
- Run the laravel server:
    php artisan serve
- Open in browser
https://127.0.0.1:8000

## Author
Deep Solanki
@DeepSolanki09

## License
This project is licensed under the MIT License.
- See the License file for details

## IF YOU ARE FACING ANY ISSUE TO SET UP THE PROJECT YOU CAN CONTACT ME ON GMAIL 
    - deepajaysolanki@gmail.com
