<?php
   function compile ( )
   {
        system('C:/TDM-GCC-64/bin/g++ C:/xampp/htdocs/Educational_Website/Solutions/main.cpp -O3 -o C:/xampp/htdocs/Educational_Website/Solutions/main.exe');
        if ( file_exists ( 'C:/xampp/htdocs/Educational_Website/Solutions/main.exe' ) )
        {
          return true ;
        }
        return false ;
   }
   function compile_official_solution ( $topic_id , $problem_id )
   {
     $dir = 'C:/xampp/htdocs/Educational_Website/Official/' . $topic_id . '/' . $problem_id ;
     $cmd = 'C:/TDM-GCC-64/bin/g++ ' ;
     $cmd .= $dir . '/main.cpp -O3 -o ' . $dir . '/main.exe' ;
     system( $cmd );
     unlink ( $dir . '/main.cpp' ) ;
     if ( file_exists ( $dir . '/main.exe' ) )
     {
       return true ;
     }
     return false ;
   }


   function run ( $topic_id ,$problem_id , $problem_no_tests )
   {
     $score = 0 ;
     $limit_exec = 0.5 ;
     for ( $i = 1 ; $i <= $problem_no_tests ; $i ++ )
     {

        $in_file_location = 'C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $topic_id . '/' . $problem_id . '/' . $i . '.in ' ;
        $out_file_location = 'C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $topic_id . '/' . $problem_id . '/' . $i . '.out ' ;
        $in_file = fopen( $in_file_location , "r") or die( "Unable to open input file ! " ) ;
        $out_file = fopen ( $out_file_location , "r" ) or die ( "Unable to open output file ! " ) ;
        $produced_out_file_location = 'C:/xampp/htdocs/Educational_Website/Solutions/ans.out' ;
        $input = NULL ;
        while ( !feof ( $in_file ) )
        {
          $input .=  fgets ( $in_file ) ;
        }
        $descriptorspec = array(
                       0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
                       1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
                       2 => array("file", 'C:\xampp\htdocs\Educational_Website\Solutions\errors\error_output.txt', "a") // stderr is a file to write to
        );

        $process = proc_open('C:\xampp\htdocs\Educational_Website\Solutions\main.exe', $descriptorspec, $pipes );

        if (is_resource($process))
        {
         $time_start = microtime( true ) ;
         fwrite ( $pipes[0] , $input ) ;
         fclose ( $pipes[0] ) ;
         $produced_out_file = fopen ( $produced_out_file_location , "w" ) ;
         while ( !feof ( $pipes [ 1 ] ) )
         {
             fwrite ( $produced_out_file , fgets ( $pipes [ 1 ]  ) ) ;
         }
         fclose ( $produced_out_file ) ;
         $time_end = microtime ( true ) ;
         $execution_time = $time_end - $time_start ;
         $produced_out_file = fopen ( $produced_out_file_location , "r" ) or die ( "Unable to display produced output file ! " ) ;
         if ( filesize ( $produced_out_file_location ) === filesize ( $out_file_location ) )
         {
               if ( compare_files ( $produced_out_file , $out_file ) === true && $execution_time <= $limit_exec )
               {
                   $score += 5 ;
               }
          }
         fclose ( $produced_out_file ) ;
         fclose ( $pipes [ 1 ]  ) ;
         fclose ( $in_file ) ;
         fclose ( $out_file ) ;

         $return_value = proc_close( $process ) ;
        }
      }
      echo "Your score is " . $score . " out of " . 5 * $problem_no_tests . "<br/>" ;
      return $score ;
      }
      function generate_out_file ( $topic_id , $problem_id , $problem_no_tests )
      {
            $in_file_location ='C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $topic_id . '/' . $problem_id . '/' . $problem_no_tests . ".in" ;
            $in_file = fopen( $in_file_location , "r") or die( "Unable to open input file ! " ) ;
            $produced_out_file_location = 'C:/xampp/htdocs/Educational_Website/Solutions/tests/' . $topic_id . '/' . $problem_id . '/' . $problem_no_tests . ".out"  ;
            $input = NULL ;
            while ( !feof ( $in_file ) )
            {
              $input .=  fgets ( $in_file ) ;
            }
            $descriptorspec = array(
                           0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
                           1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
                           2 => array("file", 'C:\xampp\htdocs\Educational_Website\Solutions\errors\error_output.txt', "a") // stderr is a file to write to
            );
            $process = proc_open('C:/xampp/htdocs/Educational_Website/Official/'. $topic_id . '/' . $problem_id  . '/main.exe' , $descriptorspec, $pipes );

            if (is_resource($process))
            {

             fwrite ( $pipes[0] , $input ) ;
             fclose ( $pipes[0] ) ;
             $produced_out_file = fopen ( $produced_out_file_location , "w" ) ;
             while ( !feof ( $pipes [ 1 ] ) )
             {
                 fwrite ( $produced_out_file , fgets ( $pipes [ 1 ]  ) ) ;
             }
             fclose ( $pipes [ 1 ]  ) ;


             fclose ( $in_file ) ;
             fclose ( $produced_out_file ) ;
             $return_value = proc_close( $process ) ;
            }
        }
 ?>
