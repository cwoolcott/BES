

$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'login.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data === '"Login"') {
            window.location = 'admin.php';
          }
          else {
            alert('Invalid Credentials');
            console.log(data);
          }
       }
   });
 });
});