<?php
  require_once('../private/initialize.php') ;
  $email = '' ;
  $username = '' ;
  $password = '' ;
  $errors = [] ;
  if ( is_post_request () )
  {
       $email =$_POST [ 'email' ] ?? '' ;
       $username = $_POST [ 'username' ] ?? '' ;
       $password = $_POST [ 'password' ] ?? '' ;
       if ( is_blank ( $email ) || !has_valid_email_format ( $email ) )
       {
          $errors[] = "You should submit a valid email !" ;
       }
       if ( is_blank ( $username ) )
       {
          $errors[] .= "You can not leave the username field blank !" ;
       }
       if ( is_blank ( $password ) )
       {
          $errors[] .= "You can not leave the password field blank !" ;
       }
       if ( empty ( $errors ) )
       {
         register_user ( $email , $username , $password ) ;
         redirect_to("http://localhost/Educational_Website/public/index.php?id=2") ;
       }
  }
 ?>
 <?php if ( !empty($errors) )
 {
   print_r ( $errors) ;
 }
?>
<div id="content">
  <h1>Register </h1>

  <form action="" method="post">
    Email:<br />
    <input type="text" name="email" value="<?php $email; ?>" /><br />
    Username:<br />
    <input type="text" name="username" value="<?php $username; ?>" /><br />
    Password: <br />
    <input type="password" name="password" value="<?php $password; ?>" /> <br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>
