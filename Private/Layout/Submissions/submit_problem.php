<?php
   if(isset($_FILES['solution']))
   {
      $error = array();
      $file_name = $_FILES['solution']['name'];
      $file_size =$_FILES['solution']['size'];
      $file_tmp =$_FILES['solution']['tmp_name'];
      $file_type=$_FILES['solution']['type'];


      $ext = pathinfo ( $file_name , PATHINFO_EXTENSION ) ;

      if( strcmp ( $ext , "cpp" ) !== 0 ) {
         $error[]="You can only upload C++ ";
      }
      if($file_size > 4194304*32 ){
         $error[] .='File size must be equal or less than 4 MB' ;
      }

      if(empty($error)==true){
         move_uploaded_file($file_tmp,UPLOAD_DIR. '/' . $file_name);
         echo "Success";
      }
   }
?>
<html>
   <body>

      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="solution" />
         <input type="submit"/>
      </form>

   </body>
</html>
