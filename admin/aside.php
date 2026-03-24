<aside class="sidebar">
        <a href="https://www.relievv.in" class="d-flex justify-content-start align-items-start"><img src="../assets/images/logo.png" alt="logo"></a>
        <div class="d-block mt-4">
            <a href="addblog" class="addblog__link active">Add Blog</a>
            <a href="editblog" class="addblog__link">Edit Blog</a>
            <button type="button" class="addblog__link border-0 w-100 text-danger text-start" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
               <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>

        </div>
     </aside>

     <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">LogOut</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p class="mb-0">Are you sure you want to logout?</p>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="rounded-0 bg-dark btn text-white rounded-5"  data-bs-dismiss="modal">No Keep it Login</button>
        <button type="button"  class="btn btn-danger rounded-5" onclick="logoutfunction();">Logout</button>
      </div>
    </div>
  </div>
</div>
<script>
function logoutfunction() {
    window.location.href = '../api/logoutapi';
}
</script>
