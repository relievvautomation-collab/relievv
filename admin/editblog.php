<?php
session_start();
require("../config/connection.php");
require("../middleware/auth.php");

if (isset($_POST['delete_blog_id'])) {
    $deleteId = (int) $_POST['delete_blog_id'];
    $fetchDelete = mysqli_query($con, "SELECT thumbimages, innerimages FROM tblblog WHERE id = $deleteId LIMIT 1");
    if ($fetchDelete && mysqli_num_rows($fetchDelete) === 1) {
        $deleteRow = mysqli_fetch_assoc($fetchDelete);
        $deleteTargets = [];

        if (!empty($deleteRow['thumbimages'])) {
            $deleteTargets[] = __DIR__ . '/../uploads/' . $deleteRow['thumbimages'];
        }
        if (!empty($deleteRow['innerimages'])) {
            $deleteTargets[] = __DIR__ . '/../uploads/' . $deleteRow['innerimages'];
        }

        foreach ($deleteTargets as $target) {
            if (file_exists($target)) {
                @unlink($target);
            }
        }
    }

    mysqli_query($con, "DELETE FROM tblblog WHERE id = $deleteId");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
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
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="blogTable" class="table table-bordered table-striped align-middle mb-0 pt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumb</th>
                                    <th>Title</th>
                                    <th>Inner Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $blogQuery = mysqli_query($con, "SELECT id, encrytiduniq, thumbimages, title, innerimages FROM tblblog ORDER BY id DESC");
                                $sno = 1;
                                if ($blogQuery) {
                                    while ($row = mysqli_fetch_assoc($blogQuery)) {
                                        $thumbPath = '';
                                       
                                        if (!empty($row['thumbimages']) && file_exists(__DIR__ . '/../uploads/' . $row['thumbimages'])) {
                                            $thumbPath = '../uploads/' . $row['thumbimages'];
                                        }

                                        $innerPath = '';
                                        if (!empty($row['innerimages']) && file_exists(__DIR__ . '/../uploads/' . $row['innerimages'])) {
                                            $innerPath = '../uploads/' . $row['innerimages'];
                                        }
                                        $editKey = !empty($row['encrytiduniq']) ? $row['encrytiduniq'] : (string) ((int) $row['id']);
                                        ?>
                                        <tr>
                                            <td><?=   $sno++; ?></td>
                                            <td>
                                                <?php if ($thumbPath !== ''): ?>
                                                    <img src="<?= htmlspecialchars($thumbPath); ?>" alt="thumb" style="width:60px;height:60px;object-fit:cover;border-radius:0px;">
                                                <?php else: ?>
                                                    <span class="text-danger">No image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['title']); ?></td>
                                            <td>
                                                <?php if ($innerPath !== ''): ?>
                                                    <img src="<?= htmlspecialchars($innerPath); ?>" alt="inner" style="width:60px;height:60px;object-fit:cover;border-radius:0px;">
                                                <?php else: ?>
                                                    <span class="text-danger">No image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="editblog-inner?edit=<?= urlencode($editKey); ?>" class="text-success"><i class="fa-regular fa-pen-to-square"></i></a>
                                                <form method="post" class="d-inline-block delete-blog-form">
                                                    <input type="hidden" name="delete_blog_id" value="<?= (int) $row['id']; ?>">
                                                    <button type="submit" class="text-danger bg-transparent border-0"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
   
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/toast.js"></script>
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This blog will be deleted permanently. Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded-0 bg-dark btn text-white rounded-5" data-bs-dismiss="modal">No Keep It</button>
                    <button type="button" class="btn btn-danger rounded-5" id="confirmDeleteBtn">Yes Delete It</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#blogTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']]
            });

            var selectedDeleteForm = null;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

            $(document).on('submit', '.delete-blog-form', function (e) {
                e.preventDefault();
                selectedDeleteForm = this;
                deleteModal.show();
            });

            $('#confirmDeleteBtn').on('click', function () {
                if (selectedDeleteForm) {
                    selectedDeleteForm.submit();
                }
            });
        });
    </script>


  
</body>
</html>
