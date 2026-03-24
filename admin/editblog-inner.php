<?php
require("../config/connection.php");
require("../middleware/auth.php");

$editKey = isset($_GET['edit']) ? trim($_GET['edit']) : '';
$editBlogData = null;
if ($editKey !== '') {
    $safeKey = mysqli_real_escape_string($con, $editKey);
    $fetchEdit = mysqli_query($con, "SELECT id, encrytiduniq, title, subtitle, shortdescription, fulldescription FROM tblblog WHERE encrytiduniq = '$safeKey' OR id = '$safeKey' LIMIT 1");
    if ($fetchEdit && mysqli_num_rows($fetchEdit) === 1) {
        $editBlogData = mysqli_fetch_assoc($fetchEdit);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit  Blog</title>
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
                   <h4 class="linkfooter-gradvl mb-0">Edit Blog</h4>
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
                                <label >Full Description</label>
                                <textarea name="fulldescriptionadd" id="fulldescriptionaddid" class="form-control" style="height: 200px; resize: none;"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div>
                        <button type="button" class="btn-class" onclick="editbloginner()">Edit Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        var addBlogFullDescriptionEditor = null;
        var currentEditBlog = <?php echo json_encode($editBlogData); ?>;
        ClassicEditor
            .create(document.querySelector('#fulldescriptionaddid'))
            .then(function (editor) {
                addBlogFullDescriptionEditor = editor;
                if (currentEditBlog && currentEditBlog.fulldescription) {
                    addBlogFullDescriptionEditor.setData(currentEditBlog.fulldescription);
                }
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
       

        function editbloginner(){
             var blogtitleid = $("#blogtitleid").val();
             var blogsubtitleid = $("#blogsubtitleid").val();
             var shortdescriptionaddid = $("#shortdescriptionaddid").val();
             // If user doesn't change these fields, keep existing values from fetched edit row.
             if (!blogtitleid && currentEditBlog) blogtitleid = currentEditBlog.title || "";
             if (!blogsubtitleid && currentEditBlog) blogsubtitleid = currentEditBlog.subtitle || "";
             if (!shortdescriptionaddid && currentEditBlog) shortdescriptionaddid = currentEditBlog.shortdescription || "";
             // Ensure fields are not empty in UI after update (even if user didn't type).
             $("#blogtitleid").val(blogtitleid);
             $("#blogsubtitleid").val(blogsubtitleid);
             $("#shortdescriptionaddid").val(shortdescriptionaddid);
             var thumbFileInput = document.getElementById("thumbnailimagesid");
             var innerFileInput = document.getElementById("innerimagesid");
             var thumbFile = thumbFileInput && thumbFileInput.files && thumbFileInput.files[0];
             var innerFile = innerFileInput && innerFileInput.files && innerFileInput.files[0];
             var fulldescriptionaddid = addBlogFullDescriptionEditor
                 ? addBlogFullDescriptionEditor.getData()
                 : ($("#fulldescriptionaddid").val() || "");
             var fullDescText = fulldescriptionaddid.replace(/<[^>]+>/g, " ").replace(/&nbsp;/g, " ").trim();

            if(!currentEditBlog || (!currentEditBlog.encrytiduniq && !currentEditBlog.id)){
                toaster("Error", "Invalid blog id for update", "error");
                return false;
            }

             var formdata = new FormData();
             formdata.append("blogtitle", blogtitleid);
             formdata.append("blogsubtitle", blogsubtitleid);
             formdata.append("shortdescriptionadd", shortdescriptionaddid);
             if (thumbFile) {
                formdata.append("thumbimageadd", thumbFile);
             }
             if (innerFile) {
                formdata.append("innerimageadd", innerFile);
             }
             formdata.append("fulldescriptionadd", fulldescriptionaddid);
             formdata.append("action", "updateblog");
             formdata.append("blogid", currentEditBlog.encrytiduniq ? currentEditBlog.encrytiduniq : currentEditBlog.id);
             $.ajax({
                url: "../api/editbloginnerapi",
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
                            if (currentEditBlog) {
                                currentEditBlog.title = blogtitleid;
                                currentEditBlog.subtitle = blogsubtitleid;
                                currentEditBlog.shortdescription = shortdescriptionaddid;
                            }
                        } else {
                            toaster("Error", (blogpar && blogpar.message) ? blogpar.message : "Failed to add blog", "error");
                        }
                    } catch (e) {
                        toaster("Error", "Invalid response from server", "error");
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = "An error occurred while editing the blog";
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

        $(document).ready(function () {
            if (currentEditBlog) {
                $("#blogtitleid").val(currentEditBlog.title || "");
                $("#blogsubtitleid").val(currentEditBlog.subtitle || "");
                $("#shortdescriptionaddid").val(currentEditBlog.shortdescription || "");
            } else {
                toaster("Error", "Blog not found for edit", "error");
            }
        });

    </script>
</body>
</html>