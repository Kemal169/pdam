<!-- Menggunakan path absolut dari root (localhost/panel/) -->
<script src="/panel/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/panel/assets/js/off-canvas.js"></script>
<script src="/panel/assets/js/hoverable-collapse.js"></script>
<script src="/panel/assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="/panel/assets/js/file-upload.js"></script>
<!-- End custom js for this page -->



<!-- Tambahan validasi JavaScript -->
<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        var name = document.getElementsByName('name')[0].value;
        var username = document.getElementsByName('username')[0].value;
        var email = document.getElementsByName('email')[0].value;
        var password = document.getElementsByName('password')[0].value;
        var cpassword = document.getElementsByName('cpassword')[0].value;

        if (!name || !username || !email || !password || !cpassword) {
            event.preventDefault();
            alert('Please fill in all fields before submitting the form.');
        }
    });
</script>

<script>
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var passwordIcon = document.getElementById("togglePasswordIcon");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    passwordIcon.classList.remove("mdi-eye");
    passwordIcon.classList.add("mdi-eye-off");
  } else {
    passwordField.type = "password";
    passwordIcon.classList.remove("mdi-eye-off");
    passwordIcon.classList.add("mdi-eye");
  }
}
</script>