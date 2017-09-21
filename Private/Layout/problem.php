<?php
echo "<h2> Introduction to the problem </h2> <br>" ;
echo $new_problem [ 'about_task' ] . " <br> ";
echo "<h2> The task </h2> <br> " ;
echo $new_problem [ 'question' ] . "<br>" ;
echo "<h2> Constraints </h2> <br>" ;
echo $new_problem [ 'constraints' ] . "<br>" ;
echo "<h2> Further Exercise </h2> <br>" ;
echo $new_problem [ 'additional_exercise'] . "<br>" ;
if ( isset ($_SESSION [ 'username' ] ) )
{
   echo "<h2> Submit solution </h2> <br> " ;
   include ( LAYOUTPATH . '/Submissions/submit_problem.php' ) ;
   $id = $new_problem [ 'problem_id' ] ;
   $tests = $new_problem [ 'no_tests' ] ;
   $topic_id = $new_problem [ 'page_id' ] ;
   if ( isset ($_FILES [ 'solution'] ) )
   {
     if ( compile ( ) === true )
     {
        $score = run ($topic_id , $id , $tests )  ;
        if ( file_exists('C:/xampp/htdocs/Educational_Website/Solutions/main.cpp') )
        {
        unlink('C:/xampp/htdocs/Educational_Website/Solutions/main.cpp' ) ;
        }
        if ( file_exists('C:/xampp/htdocs/Educational_Website/Solutions/main.exe') )
        {
        unlink('C:/xampp/htdocs/Educational_Website/Solutions/main.exe' ) ;
        }
        add_submission ( $_SESSION [ 'solver_id' ] , $score , $id ) ;
     }
     else
     {
        echo "The file was not compiled succesfully or the file you uploaded was not a suppoted format . <br/>" ;
     }
   }
   if ( $_SESSION [ 'type' ] === 'Admin' )
   {
        echo "<h2> Add tests to the problem </h2> <br>" ;
        include ( LAYOUTPATH . '/Submissions/submit_test.php' ) ;
        if ( isset ( $_FILES [ 'input' ] ) )
        {
            $no_tests = $tests + 1 ;
            if ( file_exists( 'C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $new_problem ['page_id'] . '/' . $id . '/' . $no_tests . '.in' ) )
            {
              generate_out_file ( $topic_id , $id , $no_tests ) ;
              update_problem_tests( $topic_id , $id , $no_tests ) ;
            }
            else
            {
               echo "You can only upload .in files <br/>" ;
            }
        }
   }
}
?>
