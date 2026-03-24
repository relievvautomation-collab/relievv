<?php 
session_start();
require("../config/connection.php");
if(isset($_SESSION['admin_id'])){
    header('Location: login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />
    <link rel="shortcut icon" href="../favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />
    <link rel="manifest" href="../favicon/site.webmanifest" />
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .form-control {
    display: block;
    width: 100%;
    padding: .85rem .79rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--bs-body-color);
    background-color: #004698;
    background-clip: padding-box;
    border: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .form-control:focus {
            box-shadow: none;  background-color: #004698;
        }
        label{font-size: 1rem; font-weight: 500; color: #1a1a1a; margin: 0.5rem 0;  }
    </style>
</head>
<body>
        <!-- Login System Start  -->
        <main class="login-system-main d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xs-12">
                        <div class="login-system-box rounded-0">
                            <a href="https://www.relievv.in"><img src="../assets/images/logo.png" alt="logo" class="img-fluid" style="width: 170px;"></a>
                            <div class="d-flex flex-column w-100 align-items-center justify-content-center">
                                <form action="javascript:void(0)" method="post" id="login-form" enctype="multipart/form-data" class="w-100">
                                    <div class="form-group">
                                        <label for="adminemailid">Email </label>
                                        <input type="email" name="adminemail" id="adminemailid" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminpasswordid">Password</label>
                                        <input type="password" name="adminpassword" id="adminpasswordid" class="form-control">
                                    </div>
                                    <div class="form-group d-flex justify-content-center align-items-center mt-4">
                                        <button type="button" class="btn btn-primary w-auto px-4 submitbtn-color-vl text-white py-2 rounded-5" onclick="loginfunction();">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> 
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/toast.js"></script>


    <script>
       function loginfunction(){
        var $submitBtn = $(".submitbtn-color-vl");
        var originalText = $submitBtn.html();
        var adminemail = $("#adminemailid").val();
        var adminpassword = $("#adminpasswordid").val();
        if(adminemail == ""){
            toaster("Error", "Please enter your email", "error");
            return false;
        }
        if(adminpassword == ""){
            toaster("Error", "Please enter your password", "error");
            return false;
        }
        if(adminemail == "" || adminpassword == ""){
            toaster("Error", "Please enter your email and password", "error");
            return false;
        }
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');
       var formdata = new FormData();
       formdata.append("adminemail", adminemail);
       formdata.append("adminpassword", adminpassword);
       formdata.append("action", "login");
       $.ajax({
        url: "../api/loginapi",
        type: "POST",
        data: formdata,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            try {
                if(response.statusCode === 200){
                    toaster("Success", response.message, "success");
                    setTimeout(function(){
                    window.location.href = response.redirecturl;
                    }, 500);
                    return false;
                }else{
                    toaster("Error", response.message, "error");
                    return false;
                }
            }catch(error){
                toaster("Error", "Invalid response from server", "error");
            }
        },
        error: function(xhr, status, error) {
            var msg = "Invalid response from server";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            toaster("Error", msg, "error");
        },
        complete: function() {
            $submitBtn.prop('disabled', false).html(originalText);
        }
        });
}
    </script>
</body>
</html>
