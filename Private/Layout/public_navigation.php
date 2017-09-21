<nav>
<style>
<?php
   include  ABSOLUTEPATH . '/public/stylesheets/design.css' ;
 ?>
 </style>
<?php
   $pages = get_pages ( ) ;
?>
<ul >

    <?php
        while ($page = mysqli_fetch_assoc ( $pages ))
        {
     ?>
         <?php $url = CURRENT_URL . "id=" . $page ['id'] ?>
         <?php if ( ( isset ( $_SESSION [ 'username' ] ) &&  ( $page [ 'name' ] != "LOGIN" && $page [ 'name' ] != "REGISTER" ) )   || ( !isset ( $_SESSION [ 'username' ] ) && $page [ 'name' ] != "LOGOUT" ) )
               { ?>
                 <a href = <?php echo $url ; ?> >
                 <li>     <?php echo $page ['name' ] ; ?>  </li>
                 </a>
        <?php
               }
         ?>
    <?php
         }
     ?>
</ul >
   <?php
        mysqli_free_result( $pages ) ;
    ?>

</nav>
