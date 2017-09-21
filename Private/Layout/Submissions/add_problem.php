<?php
require_once('../private/initialize.php') ;
$about_task = '' ;
$question = '' ;
$constraints = '' ;
$further_exercise = '' ;

$official_solution_name = '' ;
$official_solution_size = '' ;
$official_solution_tmp = '' ;
$official_solution_type= '' ;

$errors = [] ;
if ( is_post_request () )
{
     $about_task =$_POST [ 'about_task' ] ;
     $question = $_POST [ 'question' ] ;
     $constraints = $_POST [ 'constraints' ] ;
     $further_exercise = $_POST [ 'further_exercise' ] ;
     $nume = $_POST [ 'nume' ] ;

     if ( is_blank ( $about_task ) )
     {
         $errors[] = "You left the description field blank <br/>" ;
     }
     if ( is_blank ( $question )  )
     {
         $errors[] .="You left the question field blank <br/>" ;
     }
     if ( is_blank ( $constraints ) )
     {
        $errors[] .="You left the constraints field blank <br/>" ;
     }
     if ( is_blank ( $further_exercise ) )
     {
        $errors[] .="You left the additional exercise field blank <br/>" ;
     }
     if ( is_blank ( $nume ) )
     {
        $errors[] .="You left the name field blank <br/>" ;
     }
     if( isset ($_FILES ['official_solution'] ) && empty ( $errors ))
     {
     $official_solution_name = $_FILES [ 'official_solution' ] [ 'name' ] ;
     $official_solution_size = $_FILES [ 'official_solution' ] [ 'size' ] ;
     $official_solution_tmp = $_FILES [ 'official_solution' ] [ 'tmp_name' ] ;
     $official_solution_type = $_FILES[ 'official_solution' ][ 'type' ] ;

     $ext = pathinfo ( $official_solution_name , PATHINFO_EXTENSION ) ;
     if ( strcmp ( $ext , "cpp") === 0 || strcmp ( $ext , "java") === 0 || strcmp ( $ext , "php") === 0 )
     {
         $topic_id = $_GET [ 'topic_id' ] ;
         $problem_id = count_problems( ) + 1  ;
         $upload = 'C:/xampp/htdocs/Educational_Website/Official/' . $topic_id . '/' . $problem_id ;
         if ( ! is_dir ( $upload ) )
         {
               mkdir ( $upload ) ;
         }
         move_uploaded_file ( $official_solution_tmp , $upload . '/main.cpp' ) ;
         if ( compile_official_solution ( $topic_id , $problem_id ) === true )
         {
              insert_problem ( $problem_id , $topic_id , $about_task , $question , $constraints , $further_exercise , $nume ) ;
              redirect_to ( CURRENT_URL . "id=" . $topic_id ) ;
         }
     }
     else
     {
       $errors[] .= "You can only upload .java ,.cpp or .php files" ;
     }
    }
}
 ?>
<?php if (  !empty ( $errors ) )
      {
            print_r ( $errors ) ;
      }
?>
 <h1> Set up a new problem  </h1>

 <form action="" method="post" id="set_problem" enctype = "multipart/form-data" >
   Name : <br/>
   <input type="text" name="nume" value="<?php $nume; ?>" /> <br/>
   Official solution : <br/>
   <input type="file"  name="official_solution" /> <br/>
 </form>
   Description of the task :<br>
  <textarea name = "about_task" value="<?php $about_task; ?>" form = "set_problem" ></textarea> <br>
   The question: <br/>
  <textarea name= "question" value="<?php $question; ?>" form = "set_problem" /></textarea> <br/>
   Constraints: <br/>
  <textarea name= "constraints" value="<?php $constraints; ?>" form = "set_problem" /></textarea> <br/>
   Further exercise : <br/>
  <textarea name= "further_exercise" value="<?php $further_exercise; ?>" form = "set_problem" /></textarea>
  <br />
  <input type="submit" name="submit" value="Submit" form="set_problem"  />
<br/>
