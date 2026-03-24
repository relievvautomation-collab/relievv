<?php
if(!isset($_SESSION['admin_id'])){
    header('Location: ../admin/login');
    exit;
}
?>
