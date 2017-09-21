<?php
require_once('../private/initialize.php') ;
$username = '' ;
$password = '' ;
$errors = [] ;
if(is_post_request())
{

       $username = $_POST['username']  ;
       $password = $_POST['password']  ;

       if  ( is_blank ( $username ) )
       {
          $errors[] = "Username field can not be left blank ! " ;
       }
       if ( is_blank ( $password ) )
       {
          $errors[] .= "Password field can not be left blank !" ;
       }

       if ( empty ( $errors ) )
       {
       $solver = find_solver_by_username($username) ;


       if( $solver )
       {
          if ( password_verify ( $password , $solver [ 'hashed_password' ] ) )
          {
            log_in_solver ( $solver ) ;
            redirect_to( CURRENT_URL . 'id=3' ) ;
          }
          else
          {
            $errors[] .= "The login was unsuccesful" ;
          }
        }
      }
    }

?>
<?php if ( ! empty ( $errors ) )
      {
        print_r( $errors ) ;
      }
 ?>
<?php $page_title = 'Log in'; ?>
<div id="content">
  <h1>Log in</h1>

  <form action="" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php $username; ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>
