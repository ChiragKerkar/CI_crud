<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealers Details</title>
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
            background-color: #f9f9f9; /* Light background color */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row centered-form">
        <div class="col-md-6">
        <div id="saveAlert" class="alert d-none" role="alert"></div>
            <div class="text-center mb-4">
                <h2 class="font-weight-bold">Dealers Details</h2>
            </div>
            <form id="dealersForm" class="g-3">
            <input type="hidden" id="user_id" name="user_id" value="<?= $id ?>">
            <input type="hidden" id="url" value="<?= base_url() ?>">
                <div class="mb-3">
                    <label for="City" class="form-label">City</label>
                    <input type="City" class="form-control" id="City" name="City" required>
                </div>
                <div class="mb-3">
                    <label for="State" class="form-label">State</label>
                    <input type="State" class="form-control" id="State" name="State" required>
                </div>
                <div class="mb-3">
                    <label for="Zip code" class="form-label">Zip code</label>
                    <input type="Zip code" class="form-control" id="Zip code" name="Zip_code" required>
                </div>
                <div class="text-center">
                    <button type="button" id="addBtn" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('js/form_submission/form_submit.js') ?>"></script>
</body>
</html>
