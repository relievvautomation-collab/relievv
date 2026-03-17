<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relievv</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
  <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <style>
        .form-control:focus {  box-shadow: none !important;    }
        .form-control{height: 40px;}
        textarea.form-control{height: 130px; resize: none;}
        .file-upload-wrapper {
            position: relative;
            margin: 11px 0px;
        }
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: #f8f9fa;
            border: 1px dashed rgba(26, 136, 195, 0.39);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-upload-label:hover {
            background: #e9ecef;
            border-color: #0d6efd;
        }
        .file-upload-label i {
            font-size: 24px;
            color: #1a87c3;
        }
        .file-list {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            display: none;
        }
        .file-list.show {
            display: block;
        }
        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 5px;
            margin-bottom: 5px;
            border: 1px solid #dee2e6;
        }
        .file-item:last-child {
            margin-bottom: 0;
        }
        .file-item .file-name {
            flex: 1;
            font-size: 14px;
            color: #333;
        }
        .file-item .file-size {
            font-size: 12px;
            color: #6c757d;
            margin-right: 10px;
        }
        .file-item .remove-file {
            color: #dc3545;
            cursor: pointer;
            padding: 0 5px;
        }
        .file-item .remove-file:hover {
            color: #bb2d3b;
        }
        .allowed-formats {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
     <?php include 'header.php'; ?>

    <!-- Contact Section Start  -->
    <section class="why-choose">
        <div class="container">
           <div class="text-center w-100 d-flex flex-column align-items-center justify-content-center mb-5">
             <h2 class="section-title">Get in Touch</h2>
            <p class="section-subtitle col-md-7 text-center mb-4">Built with professionals in mind, our platform delivers the performance and reliability you need</p>
           </div>
            
            <div class="row position-relative align-items-center">
                <div class="col-lg-6 d-lg-block d-none">
                    <img src="./assets/images/contact-left-img.png" alt="contact-img" class="img-fluid  w-100 h-100 object-fit-cover">
                </div>
                <div class="d-lg-block d-none h-100" style="width: .5px; border-radius: 100%;  background: linear-gradient(332deg, #1a87c3 0%, #01020346 100%); position: absolute; top: 50%; left: 51.2%; transform: translate(-50% , -50%); padding: 0;"></div>
                <div class="col-lg-6 ps-lg-5">
                    <form action="javascript:void(0)" id="contact-form" class="contact-form border p-4 rounded-3 shadow" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="contactname" placeholder="Enter your name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="contactemail" placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-3 ">
                            <label for="phoneid">Phone No. (Optional)</label>
                            <input type="tel" class="form-control" id="phoneid" name="contactphone" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="contactmessage" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <!-- Optional share image, json, word, pdf and excel -->
                        <div class="form-group mb-4">
                            <label>Attach Files (Optional)</label>
                            <div class="file-upload-wrapper">
                                <input type="file" class="file-upload-input" id="file-upload" name="attachments[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.json,.txt">
                                <div class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <div>
                                        <strong>Choose files</strong> or drag and drop
                                        <div class="allowed-formats">
                                            Supports: Images, PDF, Word, Excel, JSON, Text (Max 10MB each)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="file-list" class="file-list"></div>
                        </div>

                        <div class="col-lg-2">
                            <button type="button" class="btn w-100 submitbtn-color-vl text-white py-2 rounded-5" onclick="submitcontactform();">
                                <i class="fa-regular fa-paper-plane"></i> Send 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Contact Section End  -->

    <?php include 'footer.php'; ?>
    <!-- footer section End --> 
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/toast.js"></script>
    
    <script>
    // File upload handling
    $(document).ready(function() {
        $('#file-upload').on('change', function() {
            var files = this.files;
            var fileList = $('#file-list');
            fileList.empty();
            
            if (files.length > 0) {
                fileList.addClass('show');
                
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var fileSize = (file.size / 1024).toFixed(2) + ' KB';
                    if (file.size > 1024 * 1024) {
                        fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    }
                    
                    var fileItem = $('<div class="file-item">' +
                        '<span class="file-name"><i class="fas fa-file me-2"></i>' + file.name + '</span>' +
                        '<span class="file-size">' + fileSize + '</span>' +
                        '<span class="remove-file" data-index="' + i + '"><i class="fas fa-times"></i></span>' +
                        '</div>');
                    
                    fileList.append(fileItem);
                }
                
                // Remove file handler
                $('.remove-file').on('click', function() {
                    var index = $(this).data('index');
                    var dt = new DataTransfer();
                    var input = $('#file-upload')[0];
                    
                    for (var j = 0; j < input.files.length; j++) {
                        if (j !== index) {
                            dt.items.add(input.files[j]);
                        }
                    }
                    
                    input.files = dt.files;
                    $('#file-upload').trigger('change');
                });
            } else {
                fileList.removeClass('show');
            }
        });
    });

    function submitcontactform() {
        var contactname = $("#name").val();
        var contactemail = $("#email").val();  
        var contactphone = $("#phoneid").val();
        var contactmessage = $("#message").val();
        var attachments = $('#file-upload')[0].files;
        
        // Validation
        if (contactname === '') {
            toaster('error', 'Please enter your name', 'error');
            return;
        }
        
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(contactemail)) {
            toaster('error', 'Please enter a valid email address', 'error');
            return;
        }
        
        // const phoneDigits = contactphone.replace(/\D/g, '');
        // if (!/^\d{10}$/.test(phoneDigits)) {
        //     toaster('error', 'Please enter a valid 10-digit phone number', 'error');
        //     return;
        // }
        
        const letterCount = (contactmessage.match(/[a-zA-Z]/g) || []).length;
        if (letterCount <= 10) {
            toaster('error', 'Please enter a message with more than 10 letters (current: ' + letterCount + ' letters)', 'error');
            return;
        }

        // Validate file sizes (max 10MB each)
        for (var i = 0; i < attachments.length; i++) {
            if (attachments[i].size > 10 * 1024 * 1024) {
                toaster('error', 'File ' + attachments[i].name + ' exceeds 10MB limit', 'error');
                return;
            }
        }

        var $submitBtn = $(".submitbtn-color-vl");
        var originalText = $submitBtn.html();
        
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');

        var contactformdata = new FormData();
        contactformdata.append('action', 'contactform');
        contactformdata.append('contactname', contactname);
        contactformdata.append('contactemail', contactemail);
        contactformdata.append('contactphone', contactphone);
        contactformdata.append('contactmessage', contactmessage);
        
        // Append all files
        for (var i = 0; i < attachments.length; i++) {
            contactformdata.append('attachments[]', attachments[i]);
        }

        $.ajax({
            type: "POST",
            url: "api/contactapi",  
            data: contactformdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            
            success: function(response) {
                try {
                    if (response.statusCode === 200) {
                        toaster('success', response.message, 'success'); 
                        $("#contact-form")[0].reset();
                        $('#file-list').empty().removeClass('show');
                    } else {
                        toaster('error', response.message, 'error');
                    }
                } catch (error) {
                    toaster('error', "Invalid server response.", 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
                console.log("Response:", xhr.responseText);
                toaster('error', "An error occurred while sending your message. Please try again later.", 'error');
            },
            complete: function() { 
                $submitBtn.prop('disabled', false).html(originalText);
            }
        });
    }
    </script>
</body>
</html>
