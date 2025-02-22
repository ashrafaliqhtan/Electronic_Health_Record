<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EHR Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
        }

        .sidebar {
            background-color: #007bff;
            color: #fff;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar h3 {
            font-size: 1.75rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .nav-link {
            color: #fff;
            font-size: 1.1rem;
            padding: 0.75rem 1.25rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: background 0.3s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #0056b3;
        }

        .sidebar .nav-link.active {
            background-color: #0056b3;
            font-weight: bold;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            background-color: #fff;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e1e4e8;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            font-weight: bold;
            color: #007bff;
        }

        .navbar .navbar-nav .nav-link {
            font-size: 1.1rem;
            color: #333;
        }

        .navbar-toggler-icon {
            background-color: #007bff;
        }

        footer {
            margin-top: 3rem;
            text-align: center;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 15px;
            }

            .sidebar h3 {
                font-size: 1.5rem;
            }

            .main-content {
                margin-left: 0;
            }

            .navbar .navbar-toggler {
                display: block;
            }

            .navbar-nav {
                display: none;
            }

            .navbar-collapse.show .navbar-nav {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <h3>EHR System</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="reception.php">
                            <i class="fa fa-user-friends"></i> Reception
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pharmacy_dashboard.php">
                            <i class="fa fa-pills"></i> Pharmacy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="patient_list.php">
                            <i class="fa fa-users"></i> Patients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointments.php">
                            <i class="fa fa-calendar-check"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">
                            <i class="fa fa-search"></i> Search
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="billing.php">
                            <i class="fa fa-bill"></i> billing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <!-- Header with Navigation -->
                <header>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">EHR Dashboard</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="reception.php">
                            <i class="fa fa-user-friends"></i> Reception
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pharmacy_dashboard.php">
                            <i class="fa fa-pills"></i> Pharmacy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="patient_list.php">
                            <i class="fa fa-users"></i> Patients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointments.php">
                            <i class="fa fa-calendar-check"></i> Appointments
                        </a>
                    </li>
                            
                                             <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fa fa-search"></i> Search
                        </a>
                    </li>         
                            
                            
                                    <li class="nav-item">
                                    </li>
                                    
                   <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fa fa-user"></i> Login
                        </a>
                    </li>                
                                    
                              
         
                                    

                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>

                <!-- Page Content -->
                <div class="container">
                    <h1>Welcome to EHR Dashboard</h1>
                    <p>Manage hospital operations efficiently</p>

                    <!-- Overview Cards -->
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Patients</h5>
                                    <p class="card-text">
                                        <?php
                                        $result = $conn->query("SELECT COUNT(*) AS total FROM patients");
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Medications</h5>
                                    <p class="card-text">
                                        <?php
                                        $result = $conn->query("SELECT COUNT(*) AS total FROM medications");
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Active Appointments</h5>
                                    <p class="card-text">
                                        <?php
                                        $result = $conn->query("SELECT COUNT(*) AS total FROM appointments WHERE status='active'");
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Prescriptions</h5>
                                    <p class="card-text">
                                        <?php
                                        $result = $conn->query("SELECT COUNT(*) AS total FROM prescriptions");
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered recent-activity-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Activity</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10:15 AM</td>
                                    <td>Patient Ahmed  checked in</td>
                                    <td>Receptionist</td>
                                </tr>
                                <tr>
                                    <td>10:30 AM</td>
                                    <td>Prescription filled for Aml </td>
                                    <td>Pharmacy</td>
                                </tr>
                                <tr>
                                    <td>11:00 AM</td>
                                    <td>Appointment scheduled for Manal</td>
                                    <td>Receptionist</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Progress Bars -->
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Hospital Resources Utilization</h5>
                            </div>
                            <div class="card-body">
                                <p>Medicine Stock</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Doctors Available</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Prescriptions</h5>
                            </div>
                            <div class="card-body">
                                <p>Pending Prescriptions</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Completed Prescriptions</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Your Profile</h5>
                    </div>
                    <div class="card-body text-center profile-card">
                        <img src="9322127.png" alt="User Profile">
                        <div class="profile-info">
                            <h5>Admin</h5>
                            <p>Role: Admin</p>
                            <p>Email:admin.doe@example.com</p>
                            <button class="btn btn-primary">Edit Profile</button>
                        </div>
                    </div>
                </div>





                <!-- Footer -->
                <footer>
                    <p>&copy; 2024 EHR Management System</p>
                </footer>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
