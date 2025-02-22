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
         header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
        }

        header p {
            font-size: 1.2rem;
            color: #555;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .card p {
            font-size: 1rem;
            color: #777;
            margin-bottom: 1.5rem;
        }

        .button {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            header p {
                font-size: 1rem;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 1.5rem;
            }
        } 
        
        
       
.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h1, h2 {
    color: #343a40;
}

.nav .button {
    text-decoration: none;
    padding: 10px 20px;
    margin-right: 10px;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
}

.form .form-group {
    margin-bottom: 15px;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ced4da;
}

th, td {
    padding: 10px;
    text-align: left;
}

.success {
    color: green;
}

.error {
    color: red;
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
                            <i class="fa fa-search"></i> search
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">
                            <i class="fa fa-cog"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
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
                                        <a class="nav-link" href="reception.php">Reception</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pharmacy_dashboard.php">Pharmacy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="appointments.php">Appointments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="search.php">search</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>

            <!-- Main Content -->

                           <header class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Reception</h1>
                    <p class="text-muted">Manage Receptions of Patients </p>
                </header>

                <!-- Add Patient Form -->
<section class="mb-5">
    <h2>Add New Patient</h2>
    <form method="POST" action="reception.php" class="row g-3">
        <div class="col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="first_name" id="firstName" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="lastName" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="contact" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" id="contact" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="createdAt" class="form-label">Date of Registration</label>
            <input type="text" name="created_at" id="createdAt" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" disabled>
        </div>
        <div class="col-12">
            <button type="submit" name="add_patient" class="btn btn-primary">Add Patient</button>
        </div>
    </form>

    <?php
    if (isset($_POST['add_patient'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $created_at = date('Y-m-d H:i:s');  // Set current timestamp for created_at

        // Using the correct column names (dob, contact_number, created_at, etc.)
        $query = "INSERT INTO patients (first_name, last_name, gender, dob, contact_number, email, address, created_at)
                  VALUES ('$first_name', '$last_name', '$gender', '$dob', '$contact_number', '$email', '$address', '$created_at')";
        if ($conn->query($query) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Patient added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</section>

<section>
    <h2>Patient List</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM patients ORDER BY created_at DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['dob']}</td>
                            <td>{$row['contact_number']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='edit_patient.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='delete_patient.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No patients found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
