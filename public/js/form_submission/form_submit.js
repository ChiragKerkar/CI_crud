$(document).ready(function() {
    $("#registerBtn").click(function() {
        // Serialize form data

        var email = $("#email").val();

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            // If email format is invalid, show alert and return
            $("#registrationAlert").removeClass("d-none").addClass("alert-danger").html("Invalid email format");
            return;
        }


        var siteurl = $("#url").val();
        var formData = $("#registrationForm").serialize();


        // Send Ajax request
        $.ajax({
            url: siteurl + 'register_user',
            type: "POST",
            data: formData,
            success: function(response) {
                var responseData = JSON.parse(response);
                // Handle success response
                $('#registrationAlert').removeClass('d-none');
                $('#registrationAlert').addClass(responseData.class);
                $('#registrationAlert').html(responseData.message);

                setTimeout(function() {
                    $('#registrationAlert').addClass('d-none');
                    if(responseData.status == 'success') {
                        window.location.href = siteurl + 'login';
                    }}, 3000);
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', errorThrown);
            }
        });
    });


    $("#loginBtn").click(function() {
        // Serialize form data
        var siteurl = $("#url").val();
        var formData = $("#loginForm").serialize();
        sessionStorage.setItem("siteurl", siteurl);
        // Send Ajax request
        $.ajax({
            url: siteurl + 'login_user',
            type: "POST",
            data: formData,
            success: function(response) {
                // Handle success response
                var responseData = JSON.parse(response);
                if(responseData.first_login) {
                    window.location.href = siteurl + 'dealer_data/' + responseData.user_id;
                } else {
                    $('#loginAlert').removeClass('d-none');
                    $('#loginAlert').addClass(responseData.class);
                    $('#loginAlert').html(responseData.status);

                    setTimeout(function() {
                        $('#loginAlert').addClass('d-none');
                        window.location.href = siteurl + 'dashboard'; // Hide the alert
                    }, 3000);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', errorThrown);
            }
        });
    });

    $("#addBtn").click(function() {
        // Serialize form data
        var siteurl = $("#url").val();
        var formData = $("#dealersForm").serialize();
        // Send Ajax request
        $.ajax({
            url: siteurl + 'add_dealer_data',
            type: "POST",
            data: formData,
            success: function(response) {
                // Handle success response
                var responseData = JSON.parse(response);
                $('#saveAlert').removeClass('d-none');
                $('#saveAlert').addClass(responseData.class);
                $('#saveAlert').html(responseData.status);

                setTimeout(function() {
                    $('#saveAlert').addClass('d-none'); // Hide the alert
                    // Redirect to the login page after timeout
                    window.location.href = siteurl + 'login';
                }, 5000);
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', errorThrown);
            }
        });
    });

    $('.editLink').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var userId = $(this).data('id');
        var siteurl = $("#url").val();
        $.ajax({
            url: siteurl + 'getDealerData/' + userId,
            type: "GET",
            success: function(response) {
                // Handle success response
                var responseData = JSON.parse(response);
                // console.log(responseData.data.city);
                if(responseData) {
                    $('#editCity').val(responseData.data.city);
                    $('#editState').val(responseData.data.state);
                    $('#editZipCode').val(responseData.data.zip_code);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', errorThrown);
            }
        });
        $('#editModal').modal('show');
        $("#user_id").val(userId);
    });

    $("#saveChangesBtn").click(function() {
        // Serialize form data
        var siteurl = $("#url").val();
        var formData = $("#editForm").serialize();
        var userId = $("#user_id").val();
        // Send Ajax request
        $.ajax({
            url: siteurl + 'add_dealer_data',
            type: "POST",
            data: formData,
            success: function(response) {
                // Handle success response
                var responseData = JSON.parse(response);
                $('#saveAlert').removeClass('d-none');
                $('#saveAlert').addClass(responseData.class);
                $('#saveAlert').html(responseData.status);

                setTimeout(function() {
                    $('#saveAlert').addClass('d-none'); // Hide the alert
                    // Redirect to the login page after timeout
                    window.location.href = siteurl + 'dashboard';
                }, 5000);
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', errorThrown);
            }
        });
    });

    var path = window.location.pathname;

    // Split the path into segments using '/'
    var segments = path.split('/');

    // Get the last segment (excluding any trailing '/')
    var lastSegment = segments[segments.length - 1];

    if(lastSegment == 'dashboard') {
        var table = $('#dealerTable').DataTable();
        // Add custom filter for zip code column
        $('#dealerTable tfoot th').each(function() {
            var title = $(this).text();
            if (title === 'Zip Code') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });
        // Apply the custom search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }

        $(".logout-btn").click(function() {
            var siteurl = sessionStorage.getItem("siteurl");
            window.location.href = siteurl + 'login';
            sessionStorage.clear();
        });
});