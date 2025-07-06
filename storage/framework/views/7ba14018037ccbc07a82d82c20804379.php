<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
 
    <!-- Bootstrap 5 CSS -->
    <link href="<?php echo e(asset('css\new\bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <!-- <link href="<?php echo e(asset('css\new\all.min.css')); ?>" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AdminLTE CSS (Use this if file exists, otherwise use CDN) -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset('adminlte/css/adminlte.min.css')); ?>"> -->
    <!-- Alternative: Uncomment the line below if file is missing -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.2/dist/css/adminlte.min.css"> -->

      <style>
      body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6f9;
      }
      .wrapper {
        display: flex;
        height: 100vh;
        overflow: hidden;
      }
      .content-wrapper {
          min-height: 100vh; /* Ensure the content takes full height */
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }
      .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
        padding: 20px;
      }
      .sidebar h3 {
        margin-bottom: 20px;
        font-size: 1.5rem;
      }
      .sidebar a {
        display: block;
        color: #adb5bd;
        text-decoration: none;
        margin: 10px 0;
        padding: 10px 15px;
        border-radius: 4px;
      }
      .sidebar a:hover, .sidebar a.active {
        background-color: #495057;
        color: #fff;
      }
      .main-content {
        flex-grow: 1;
        background-color: #f4f6f9;
        padding: 0 20px 20px;
        overflow-y: auto;
      }
      .dashboard-navbar {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }
      .dashboard-navbar .nav-links a {
        margin-right: 25px;
        color: #343a40;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
      }
      .dashboard-navbar .nav-links a:hover {
        color: #007bff;
      }
      .dashboard-navbar .user-profile {
        display: flex;
        align-items: center;
      }
      .dashboard-navbar .user-profile span {
        margin-right: 10px;
        font-weight: 500;
        font-size: 0.95rem;
      }
      .dashboard-navbar .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
      }
      .dashboard-cards {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          margin-top: 20px;
      }
      /* Styled Info Cards */
      .info-card {
        color: #fff;
        padding: 20px;
        border-radius: 12px;
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
        height: 160px;
        position: relative;
        overflow: hidden;
      }
      .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
      }
      .info-card h5 {
        font-size: 2rem;
        font-weight: bold;
        margin: 0;
      }
      .info-card p {
        font-size: 1.1rem;
        margin: 5px 0;
        opacity: 0.9;
      }
      .info-card .icon {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 3.5rem;
        opacity: 0.2;
      }

      /* Footer with More Info */
      .card-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.15);
        padding: 10px;
        text-align: center;
        font-size: 1rem;
        font-weight: 500;
      }
      .card-footer a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
      }
      .card-footer a:hover {
        text-decoration: underline;
      }
      a {
          cursor: pointer;
      }

      /* Card Gradient Colors */
      .bg-blue { background: linear-gradient(135deg, #007bff, #0056b3); }
      .bg-green { background: linear-gradient(135deg, #28a745, #1e7e34); }
      .bg-yellow { background: linear-gradient(135deg, #ffc107, #d39e00); color: #333; }
      .bg-red { background: linear-gradient(135deg, #dc3545, #a71d2a); }

      .wrapper { display: flex; height: 100vh; }
      .sidebar { width: 250px; background-color: #343a40; color: #fff; padding: 20px; }
      .sidebar a { display: block; color: #adb5bd; text-decoration: none; padding: 10px 15px; cursor: pointer; }
      .sidebar a:hover, .sidebar a.active { background-color: #495057; color: #fff; }
      .main-content { flex-grow: 1; padding: 20px; }

    </style>
</head>
<body>
<?php if(session('success')): ?>
    <script>
        alert("<?php echo e(session('success')); ?>");
    </script> 
<?php endif; ?>
<?php if(session('error')): ?>
    <script>
        alert("<?php echo e(session('error')); ?>");
    </script> 
<?php endif; ?>
<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="site-logo">
            <a href="/admin-panel"><img src="<?php echo e(asset('Images/logo.png')); ?>" alt="Logo"></a>
        </a>
        <div style="margin-top : 50px;">
            <a onclick="loadContent('/admin/UserDetails', this)">Users</a>
            <a onclick="loadContent('/admin/AdminDetails', this)">Admins</a>
            <a onclick="loadContent('/admin/LoanApplications', this)">Loan Applications</a>
            <a onclick="loadContent('/admin/LoanDetails', this)">Loans</a>
            <a onclick="loadContent('/admin/UserMessage', this)">User Messages</a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-navbar">
            <div class="nav-links">
                <a href="\home">Home</a>
                <a href="\about-us">About Us</a>
                <a href="\loan">Loans</a>
                <a href="\contact">Contact</a>
            </div>
            <div class="user-profile">
                <a href="<?php echo e(route('profile')); ?>">
                    <img src="<?php echo e(asset(Auth::user()->profile_pic ? 'storage/' . Auth::user()->profile_pic : 'default-profile.png')); ?>">
                </a>&nbsp;&nbsp;&nbsp;
                <span><?php echo e(Auth::user()->name); ?></span>
            </div>
        </div>

        <div id="componentContent">
          <!-- Dynamic content will be loaded here -->
        </div>


        <div id="dashboard-section" style="margin-top: 50px;">
          <h1>Dashboard</h1>
          <div class="row" style="margin-top: 50px;">
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="info-card bg-primary">
                    <h5><?php echo e($totalUsers); ?></h5>
                    <p>Users</p>
                    <i class="fas fa-users icon"></i>
                    <div class="card-footer">
                        <a onclick="loadContent('/admin/UserDetails', this)">More Info</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="info-card bg-success">
                    <h5><?php echo e($totalAdmins); ?></h5>
                    <p>Admins</p>
                    <i class="fas fa-user-shield icon"></i>
                    <div class="card-footer">
                        <a onclick="loadContent('/admin/AdminDetails', this)">More Info</a>
                    </div>
                </div>
            </div>
      
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="info-card bg-yellow">
                    <h5><?php echo e($totalLoanApplications); ?></h5>
                    <p>Loan Applications</p>
                    <i class="fas fa-file-invoice-dollar icon"></i>
                    <div class="card-footer">
                        <a onclick="loadContent('/admin/LoanApplications', this)">More Info</a>
                    </div>
                </div>
            </div>

          <div class="col-md-4 col-sm-6 mb-3">
              <div class="info-card bg-secondary">
                  <h5><?php echo e($totalAvailableLoans); ?></h5>
                  <p>Available Loans</p>
                  <i class="fas fa-hand-holding-usd icon"></i>
                  <div class="card-footer">
                      <a onclick="loadContent('/admin/LoanDetails', this)">More Info</a>
                  </div>
              </div>
          </div>

          <div class="col-md-4 col-sm-6 mb-3">
              <div class="info-card bg-danger">
                  <h5><?php echo e($totalUserMessages); ?></h5>
                  <p>User Messages</p>
                  <i class="fas fa-envelope icon"></i>
                  <div class="card-footer">
                      <a onclick="loadContent('/admin/UserMessage', this)">More Info</a>
                  </div>
              </div>
          </div>
      </div>


<!-- JavaScript -->
<script>
  function loadContent(url, element) {
      let contentDiv = document.getElementById("componentContent");
      let dashboardSection = document.getElementById("dashboard-section");

      if (!contentDiv || !dashboardSection) {
          console.error("Element with ID 'componentContent' or 'dashboard-section' not found.");
          return;
      }

      // Remove active class from all links, then add it to the clicked one
      document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
      if (element) element.classList.add("active");

      // Hide dashboard cards when clicking on sidebar links
      dashboardSection.style.display = "none";

      fetch(url)
          .then(response => {
              if (!response.ok) {
                  console.error(`HTTP error! Status: ${response.status}`);
                  return response.text().then(text => { throw new Error(text); });
              }
              return response.text();
          })
          .then(html => {
              contentDiv.innerHTML = html; // Update content dynamically

              // Ensure AdminLTE layout refreshes properly
              setTimeout(() => {
                  window.dispatchEvent(new Event("resize"));
              }, 500);
          })
          .catch(error => console.error("Error loading content:", error));
    }

  // Show dashboard when visiting the admin panel directly
  document.addEventListener("DOMContentLoaded", function () {
        let dashboardSection = document.getElementById("dashboard-section");
        let contentDiv = document.getElementById("componentContent");

        if (dashboardSection && contentDiv.innerHTML.trim() === "") {
            dashboardSection.style.display = "block"; // Show dashboard when no other content is loaded
        }
    });


</script>

</body>
</html>
<?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/Admin/admin-panel.blade.php ENDPATH**/ ?>