<?php  
require("../config/connection.php"); 
require("../middleware/auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
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
    
</head>
<body>
   
  <!-- relievv dashboard start  -->
   <main class="dashboard">
   <?php include "aside.php"; ?>
     <div class="right-section">
        <div class="container-fluid px-3 py-4">
            <div class="row ">
                <div class="col-12 mb-4">
                   <h4 class="linkfooter-gradvl mb-0">Add Blog</h4>
                </div>
                <form action="javascript:void(0)" method="post" id="addblog__form">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="blogtitleid">Blog Title</label>
                                <input type="text" name="blogtitle" id="blogtitleid" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="blogsubtitleid">Blog Subtitle</label>
                                <input type="text" name="blogsubtitle" id="blogsubtitleid" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-12 my-4">
                            <div class="form-group">
                                <label for="shortdescriptionaddid">Short Description</label>
                                <textarea name="shortdescriptionadd" id="shortdescriptionaddid" class="form-control" style="height: 200px; resize: none;"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="thumbnailimagesid">Thumbnail Images</label>
                                <input type="file" name="thumbimageadd" id="thumbnailimagesid" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="innerimagesid">Inner Images</label>
                                <input type="file" name="innerimageadd" id="innerimagesid" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <label class="mb-2">Full Description</label>
                                <textarea name="fulldescriptionadd" id="fulldescriptionaddid" class="form-control" style="height: 200px; resize: none;"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div>
                        <button type="button" class="btn-class" onclick="addblog()">Add Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        var addBlogFullDescriptionEditor = null;
        ClassicEditor
            .create(document.querySelector('#fulldescriptionaddid'))
            .then(function (editor) {
                addBlogFullDescriptionEditor = editor;
            })
            .catch(function (error) {
                console.error(error);
            });
    </script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/toast.js"></script>


    <script>
        function addblog(){
             var blogtitleid = $("#blogtitleid").val();
             var blogsubtitleid = $("#blogsubtitleid").val();
             var shortdescriptionaddid = $("#shortdescriptionaddid").val();
             var thumbFileInput = document.getElementById("thumbnailimagesid");
             var innerFileInput = document.getElementById("innerimagesid");
             var thumbFile = thumbFileInput && thumbFileInput.files && thumbFileInput.files[0];
             var innerFile = innerFileInput && innerFileInput.files && innerFileInput.files[0];
             var fulldescriptionaddid = addBlogFullDescriptionEditor
                 ? addBlogFullDescriptionEditor.getData()
                 : ($("#fulldescriptionaddid").val() || "");
             var fullDescText = fulldescriptionaddid.replace(/<[^>]+>/g, " ").replace(/&nbsp;/g, " ").trim();

            if(blogtitleid == ""){
                toaster("Error", "Please enter a blog title", "error");
                return false;
            }else if(blogsubtitleid == ""){
                toaster("Error", "Please enter a blog subtitle", "error");
                return false;
            }else if(shortdescriptionaddid == ""){
                toaster("Error", "Please enter a short description", "error");
                return false;
            }else if(!thumbFile){
                toaster("Error", "Please select a thumbnail image", "error");
                return false;
            }else if(!innerFile){
                toaster("Error", "Please select a inner image", "error");
                return false;
            }else if(fullDescText === ""){
                toaster("Error", "Please enter a full description", "error");
                return false;
            }


             var formdata = new FormData();
             formdata.append("blogtitle", blogtitleid);
             formdata.append("blogsubtitle", blogsubtitleid);
             formdata.append("shortdescriptionadd", shortdescriptionaddid);
             formdata.append("thumbimageadd", thumbFile);
             formdata.append("innerimageadd", innerFile);
             formdata.append("fulldescriptionadd", fulldescriptionaddid);
             formdata.append("action", "addblog");
             $.ajax({
                url: "../api/addblogapi",
                type: "POST",
                data: formdata,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    try {
                        let blogpar = response;
                        if (blogpar && blogpar.statusCode === 200) {
                            toaster("Success", blogpar.message, "success");
                            $("#addblog__form")[0].reset();
                            if (addBlogFullDescriptionEditor) {
                                addBlogFullDescriptionEditor.setData("");
                            }
                        } else {
                            toaster("Error", (blogpar && blogpar.message) ? blogpar.message : "Failed to add blog", "error");
                        }
                    } catch (e) {
                        toaster("Error", "Invalid response from server", "error");
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = "An error occurred while adding the blog";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            var errObj = JSON.parse(xhr.responseText);
                            if (errObj && errObj.message) {
                                errorMessage = errObj.message;
                            }
                        } catch (e) {}
                    }
                    toaster("Error", errorMessage, "error");
                }
             });
        }

    </script>
</body>
</html>