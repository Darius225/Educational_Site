
<?php
  require_once('../private/initialize.php') ;

  $page_Set = false ;
  if ( isset ( $_GET [ 'id' ] ) )
  {
       $page_id = $_GET [ 'id' ] ;
       $new_page = find_page_by_id( $page_id ) ;
       $page_Set = true ;
  }
  if ( isset ( $_GET [ 'problem_id' ] ) )
  {
       $problem_id = $_GET [ 'problem_id' ] ;
       $new_problem = find_problem_by_id ( $problem_id ) ;
  }
  elseif ( isset ($_GET [ 'tutorial_id' ] ) )
  {
        $tutorial_id =$_GET [ 'tutorial_id' ] ;
        $new_tutorial = find_tutorial_by_id ( $tutorial_id ) ;
  }
?>
<?php
$user = $_SESSION [ 'username' ]  ??  '';
if ( isset ( $_SESSION [ 'username' ] ) )
 {
   echo "Hello " . ucfirst( $_SESSION [ 'username' ] ) . " . " ."Solve some challenges today ! ";
 }
include( LAYOUTPATH  . '/public_navigation.php' ) ;

?>
<style>
<?php
include  ABSOLUTEPATH . '/public/stylesheets/background.css' ;
?>
</style>
<body>
  <?php
  $allowed_tags = '<code><div><img><h1><h2><p><br><strong><em><ul><li><a>';
  if (isset ( $new_problem ) )
  {

    include ( LAYOUTPATH . '/problem.php' ) ;

  }
  elseif ( isset ( $new_tutorial ) )
  {
    include ( LAYOUTPATH . '/tutorial.php' ) ;
  }
  elseif ( $page_Set === true  )
  {
          if ( $page_id == 8 )
          {
            include ( LAYOUTPATH . "/submissions/add_problem.php" ) ;
          }
          elseif ( $page_id == 9 )
          {
            include ( LAYOUTPATH . "/submissions/add_tutorial.php" ) ;
          }
          elseif ( $new_page ['name'] == 'LOGIN' )
          {
            include ( ABSOLUTEPATH . "/public/login.php") ;
          }
          elseif ( $new_page ['name'] == 'LOGOUT' )
          {
            include ( ABSOLUTEPATH . "/public/logout.php") ;
          }
          elseif ( $new_page ['name'] == 'REGISTER' )
          {
            include ( ABSOLUTEPATH . '/public/register.php' ) ;
          }
          else
          {
            $previous_page = $page_id ;
            include ( LAYOUTPATH . '/topic.php' ) ;
          }
   }
   else
  {
     redirect_to ( CURRENT_URL . 'id=1' ) ;
  }
   ?>
 </body>
