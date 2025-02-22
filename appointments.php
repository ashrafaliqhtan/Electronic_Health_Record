<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - EHR Dashboard</title>
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
                        <a class="nav-link" href="reception.php">
                            <i class="fa fa-user-friends"></i> Reception
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="appointments.php">
                            <i class="fa fa-calendar-check"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="patient_list.php">
                            <i class="fa fa-users"></i> Patients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">
                            <i class="fa fa-search"></i> Search
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
                        </div>
                    </nav>
                </header>

                <!-- Appointments Page Content -->
                <header class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Manage Appointments</h1>
                    <p class="text-muted">Add, View, and Edit Appointments</p>
                </header>

                <!-- Add Appointment Form -->
                <section class="mb-5">
                    <h2>Add New Appointment</h2>
                    <form method="POST" action="appointments.php" class="row g-3">
                        <div class="col-md-6">
                            <label for="patientName" class="form-label">Patient Name</label>
                            <input type="text" name="patient_name" id="patientName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="doctorName" class="form-label">Doctor Name</label>
                            <input type="text" name="doctor_name" id="doctorName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="appointmentDate" class="form-label">Appointment Date</label>
                            <input type="datetime-local" name="appointment_date" id="appointmentDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="reason" id="reason" class="form-control" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="add_appointment" class="btn btn-primary">Add Appointment</button>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['add_appointment'])) {
                        $patient_name = $_POST['patient_name'];
                        $doctor_name = $_POST['doctor_name'];
                        $appointment_date = $_POST['appointment_date'];
                        $reason = $_POST['reason'];

                        // Prepared statement to avoid SQL injection
                        $stmt = $conn->prepare("INSERT INTO appointments (patient_name, doctor_name, appointment_date, reason) 
                                                VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $patient_name, $doctor_name, $appointment_date, $reason);

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success mt-3'>Appointment added successfully!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
                        }

                        $stmt->close();
                    }
                    ?>
                </section>

                <!-- Appointment List -->
                <section>
                    <h2>Upcoming Appointments</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Appointment Date</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch appointments from database
                            $result = $conn->query("SELECT * FROM appointments ORDER BY appointment_date ASC");
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['patient_name']}</td>
                                        <td>{$row['doctor_name']}</td>
                                        <td>{$row['appointment_date']}</td>
                                        <td>{$row['reason']}</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
