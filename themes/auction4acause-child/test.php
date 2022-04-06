<?php 
/* Template Name: Test */
get_header();
?>
  <p class="register-message" style="display:none"></p>
    <form action="#" method="POST" name="register-form" class="register-form">
      <fieldset> 
          <label><i class="fa fa-file-text-o"></i> Register Form</label>
          <input type="text"  name="new_user_name" placeholder="Username" id="new-username">
          <input type="email"  name="new_user_email" placeholder="Email address" id="new-useremail">
          <input type="password"  name="new_user_password" placeholder="Password" id="new-userpassword">
          <input type="password"  name="re-pwd" placeholder="Re-enter Password" id="re-pwd">
          <input type="submit"  class="button" id="register-button" value="Register" >
      </fieldset>
    </form> 
     <script type="text/javascript">
      jQuery('#register-button').on('click',function(e){
        e.preventDefault();
        var newUserName = jQuery('#new-username').val();
        var newUserEmail = jQuery('#new-useremail').val();
        var newUserPassword = jQuery('#new-userpassword').val();
        jQuery.ajax({
          type:"POST",
          url:"<?php echo admin_url('admin-ajax.php'); ?>",
          data: {
            action: "register_user_front_end",
            new_user_name : newUserName,
            new_user_email : newUserEmail,
            new_user_password : newUserPassword
          },
          success: function(results){
            console.log(results);
            jQuery('.register-message').text(results).show();
          },
          error: function(results) {

          }
        });
      });
    </script>
<?php get_footer();
 ?>