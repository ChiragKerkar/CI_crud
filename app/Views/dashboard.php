<!-- dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

   <style>
        /* Custom CSS */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .logout-btn {
            position: fixed;
            top: 10px;
            right: 10px;
        }

    </style>
</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-4 mb-3">Dealers</h2>
            </div>
            <div class="col-md-6 text-right">
                <!-- Logout button -->
                <a href="<?= base_url('login') ?>" class="btn btn-danger logout-btn">Logout</a>
            </div>
        </div>
    <input type="hidden" id="url" value="<?= base_url() ?>">
    <!-- Table to display dealer data -->
    <table class="table" id="dealerTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dealer as $dealerItem): ?>
                <tr>
                    <td><?= $dealerItem['dealer_id'] ?></td>
                    <td><?= $dealerItem['full_name'] ?></td>
                    <td><?= $dealerItem['city'] ?: 'N/A' ?></td>
                    <td><?= $dealerItem['state'] ?: 'N/A' ?></td>
                    <td><?= $dealerItem['zip_code'] ?: 'N/A' ?></td>
                    <td>
                        <a href="#" class="btn btn-primary editLink" data-id="<?= $dealerItem['user_id'] ?>">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Dealer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div id="saveAlert" class="alert d-none" role="alert"></div>
                <form id="editForm">
                <input type="hidden" id="user_id" name="user_id" value="">
                <input type="hidden" id="url" value="<?= base_url() ?>">
                    <div class="mb-3">
                        <label for="editCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="editCity" name="City">
                    </div>
                    <div class="mb-3">
                        <label for="editState" class="form-label">State</label>
                        <input type="text" class="form-control" id="editState" name="State">
                    </div>
                    <div class="mb-3">
                        <label for="editZipCode" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="editZipCode" name="Zip_code">
                    </div>
                    <input type="hidden" id="dealerId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('js/form_submission/form_submit.js') ?>"></script>
</body>
</html>
