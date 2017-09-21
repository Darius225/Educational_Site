<?php
echo strip_tags ( $new_page['content'] , $allowed_tags ) ."<br/>";
if ( ( $page_id == 3 || $page_id == 4 ) || $page_id == 5 )
{
     if ( isset ( $_SESSION [ 'type' ] ) )
     {
           if ( $_SESSION [ 'type' ] === 'Admin' )
           {
           ?>
           <a href = "<?php echo CURRENT_URL . "id=8&topic_id=" . $page_id ?> "  >
            + Add a problem </br>
           </a>
           <?php
           }
     }
     $problem_set = find_all_problems_by_page_id ( $page_id ) ;
     display_problem_array ( $problem_set ) ;
     echo strip_tags ( $new_page ['content2'] , $allowed_tags ) . "<br/>" ;
     if ( isset ( $_SESSION [ 'type' ] ) && ( $page_id == 3 || $page_id == 4 || $page_id == 5) )
     {
         if ( $_SESSION [ 'type' ] === 'Admin' )
         {
           ?>
            <a href = " <?php echo CURRENT_URL . "id=9&topic_id=" .$page_id ?> "  >
            + Add a tutorial <br/>
            </a>
            <?php
         }
     }
     $tutorial_set = find_all_tutorials_by_page_id ( $page_id ) ;
     display_tutorial_array ( $tutorial_set ) ;
}
?>
