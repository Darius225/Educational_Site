<?php

    function display_problem_array ( $problems = [ ] )
    {
      ?>
      <style>
      <?php
         include_once (ABSOLUTEPATH . '/public/stylesheets/table.css') ;
       ?>
       </style>
       <a href = "#" onclick='display(1) ;'  > Show/hide problems <br/></a>
      <table class ='flat-table' id = 'table1' >
        <tbody>
      <tr>
        <th> Problem name </th>
        <?php if ( isset ( $_SESSION [ 'solver_id' ] ) )
        { ?>
        <th> Maximum score </th>
      <?php } ?>
      </tr>
      <?php
        while ( $problem = mysqli_fetch_assoc( $problems ) )
        {
          ?>
          <tr>
           <td>
             <?php $url = CURRENT_URL . "problem_id=" . $problem ['problem_id'] . "&topic_id=" . $problem[ 'page_id' ] ; ?>
             <a href = <?php echo $url ; ?> >
               <?php echo $problem [ 'name' ] . "<br>" ; ?>
            </a>
          </td>
          <?php if ( isset ( $_SESSION [ 'solver_id' ] ) )
          { ?>
         <td> <?php echo get_maximum_score ( $_SESSION [ 'solver_id' ] , $problem [ 'problem_id' ] ) ?> / <?php echo 5 * $problem [ 'no_tests'] ?> </td>
         <?php } ?>
         <?php
        }
        ?>
      </tbody>
      </table>
      <?php
    }
    function display_tutorial_array ( $tutorials = [ ] )
    {
      ?>
      <a href = "#" onclick='display(2) ;'  > Show/hide tutorials <br/> </a>
      <table class = 'flat-table' id = 'table2' >
        <tr>
          <th> Tutorial name </th>
        </tr>
        <?php
        while ( $tutorial = mysqli_fetch_assoc( $tutorials ) )
        {
          ?>
          <tr>
            <td>
           <?php $url = CURRENT_URL . "tutorial_id=" . $tutorial ['tutorial_id'] ; ?>
           <a href = <?php echo $url ; ?> >
           <?php echo $tutorial [ 'name' ] . "<br>" ; ?>
           </a>
         </td>
         </tr>
         <?php
        }
    }

    function is_post_request()
    {
       return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function is_get_request()
    {
       return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function redirect_to( $location )
    {
       header ("Location: " . $location ) ;
       exit ;
    }

     function compare_files ( $file1 , $file2 )
     {
       while ( !feof($file1) )
       {
         if( fread ( $file1 , 262144 * 64 ) != fread( $file2 , 262144 * 64 ) )
         {
           return false ;
         }
       }
       return true ;
    }

    function get_Domain ( $bad_url )
    {
       $new_url = '' ;
       for ( $i = 0 ; $bad_url [ $i ] !== '?' ; $i ++ )
       {
         $new_url .= $bad_url [ $i ] ;
       }
       return $new_url ;
    }


 ?>
