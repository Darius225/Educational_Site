<?php
     require_once('../private/initialize.php') ;
     $nume = '' ;
     $content_tutorial = '' ;
     $errors = [] ;
     if ( is_post_request ( ) )
     {
       $nume =  $_POST [ 'nume' ] ;
       $content_tutorial = $_POST [ 'content_tutorial' ] ;
       if ( is_blank ( $nume ) )
       {
         $errors [] = "You can not leave the name field blank!<br/>" ;
       }
       if ( is_blank ( $content_tutorial ) )
       {
         $errors [] .="You can not leave the content field blank!<br/>" ;
       }
       if ( empty( $errors ) )
       {
           $topic_id = $_GET [ 'topic_id' ] ;
           insert_tutorial( $topic_id , $nume , $content_tutorial ) ;
           redirect_to ( CURRENT_URL . "id=". $topic_id ) ;
       }
     }
  ?>
  <?php
       if ( !empty ( $errors ) )
       {
           print_r ( $errors ) ;
       }
  ?>
<h1> Set up a new tutorial  </h1>

<form action="" method="post" id="set_tutorial" >
  Name : <br/>
  <input type="text" name="nume" value="<?php $nume; ?>" /> <br/>
</form>
  Tutorial content : <br/>
<textarea name= "content_tutorial" value="<?php $content_tutorial ; ?>" form = "set_tutorial" /> </textarea>
<br/>
<input type="submit" name="submit" value="Submit" form="set_tutorial"  />
<br/>
