<?php
   if( isset( $_FILES['input'] ) )
   {
      $error = array();
      $input_name = $_FILES['input']['name'];
      $input_size =$_FILES['input']['size'];
      $input_tmp =$_FILES['input']['tmp_name'];
      $input_type=$_FILES['input']['type'];


      $input_text = $ext = pathinfo ( $input_name , PATHINFO_EXTENSION ) ; ;

      if( strcmp( $input_text , "in" ) !== 0 )
      {
         $error[]="The first file has to be a .in file .";
      }
      if( $input_size > 4194304 * 32   )
      {

         $error[] .= 'The file must be smaller than 128 MB' ;
      }
      if( empty($error) === true )
      {
        $dir = 'C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $new_problem ['page_id'] . '/' . $new_problem[ 'problem_id' ] ;

         if ( is_dir ($dir) === false )
         {
             mkdir($dir) ;
         }
         $name = $new_problem [ 'no_tests' ] + 1 ;
         move_uploaded_file($input_tmp , $dir . '/' . $name . ".in" ) ;
      }
     }
?>
<html>
   <body>
      Input file
      <form action ="" method="POST" enctype="multipart/form-data">
         <input type="file" name = "input" />
         <input type ="submit" /> <br/>
      </form>
   </body>
</html>
