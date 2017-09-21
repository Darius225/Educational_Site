<?php
function log_in_solver ( $solver )
{
    session_regenerate_id();
    $_SESSION['solver_id'] = $solver [ 'solver_id' ] ;
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $solver [ 'username' ] ;
    $_SESSION['type'] = $solver[ 'type' ] ;
    return true;
}
  function log_out_solver ( )
   {
       unset ( $_SESSION [ 'solver_id' ] ) ;
       unset ( $_SESSION [ 'last_login' ] ) ;
       unset ( $_SESSION [ 'username' ] ) ;
       unset ( $_SESSION [ 'type' ] ) ;
       return true ;
   }
?>
