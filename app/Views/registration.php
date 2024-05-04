<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Custom CSS */
        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            border: 2px solid #eee; /* Light border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Add some padding */
            background-color: #f9f9f9; /* Light background color */
        }
        .centered-form form {
            width: 100%; /* Full width */
        }
        .centered-form button {
            display: block; /* Make the button a block element */
            margin: 0 auto; /* Center horizontally */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row centered-form">
        <div class="col-md-6">
            <h2 class="text-center font-weight-bold mb-4">Registration</h2>
            <form id="registrationForm" class="g-3">
            <div id="registrationAlert" class="alert d-none" role="alert"></div>
                <input type="hidden" id="url" value="<?= base_url() ?>">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="userType" class="form-label">Type of User</label>
                    <select class="form-select" id="userType" name="userType" required>
                        <option value="Employee">Employee</option>
                        <option value="Dealer">Dealer</option>
                    </select>
                </div>
                <button type="button" id="registerBtn" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('js/form_submission/form_submit.js') ?>"></script>
</body>
</html>
