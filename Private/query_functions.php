<?php
  function count_problems ( )
  {
       global $db ;
       $sql = "SELECT * FROM probleme " ;
       $result = mysqli_query( $db , $sql ) ;
       $num_problems = mysqli_num_rows ( $result ) ;
       return $num_problems ;
  }

  function get_maximum_score ( $user_id , $problem_id )
  {
    global $db ;
    $sql = "SELECT MAX(score) AS max_score FROM submisii " ;
    $sql .="WHERE user_id = '" . $user_id ."' AND " ;
    $sql .="problem_id = '" . $problem_id ."' " ;
    $sql .= "LIMIT 1" ;
    $result = mysqli_query ( $db , $sql ) ;
    $row = mysqli_fetch_array( $result ) ;
    if ( isset ( $row [ 'max_score' ] ) )
    {
        return $row [ 'max_score' ] ;
    }
    return 0 ;
  }

  function get_pages ( )
  {
    global $db ;
    $sql = "SELECT * FROM pages " ;
    $sql .= "ORDER BY id ASC" ;
    $result = mysqli_query( $db , $sql ) ;
    return $result ;
  }
  function get_problems ( )
  {
    global $db ;
    $sql = "SELECT * FROM probleme " ;
    $sql .="ORDER BY id ASC" ;
    $result = mysqli_query( $db , $sql ) ;
    return $result ;
  }
  function find_page_by_id( $id )
  {
    global $db ;
    $sql = "SELECT * FROM pages " ;
    $sql .="WHERE id ='" . $id . "' " ;
    $result = mysqli_query ( $db , $sql ) ;
    $page = mysqli_fetch_assoc( $result ) ;
    mysqli_free_result( $result ) ;
    return $page ;
  }
  function find_problem_by_id ( $problem_id )
  {
    global $db ;
    $sql = "SELECT * FROM probleme " ;
    $sql .="WHERE problem_id = '" .$problem_id ."' " ;
    $result = mysqli_query ( $db , $sql ) ;
    $problem = mysqli_fetch_assoc ( $result ) ;
    mysqli_free_result( $result ) ;
    return $problem ;
  }
  function find_tutorial_by_id ( $tutorial_id )
  {
    global $db ;
    $sql = "SELECT * FROM tutoriale " ;
    $sql .="WHERE tutorial_id = '" . $tutorial_id ."' " ;
    $result = mysqli_query ( $db , $sql ) ;
    $tutorial = mysqli_fetch_assoc ( $result ) ;
    mysqli_free_result( $result ) ;
    return $tutorial ;
  }
  function find_all_problems_by_page_id ( $page_id )
  {
    global $db ;
    $sql = "SELECT * FROM probleme " ;
    $sql .= "WHERE page_id ='" . $page_id ."' " ;
    $result = mysqli_query( $db , $sql ) ;
    return $result ;
  }
  function find_all_tutorials_by_page_id ( $page_id )
  {
    global $db ;
    $sql = "SELECT * FROM tutoriale " ;
    $sql .= "WHERE page_id ='" . $page_id ."' " ;
    $result = mysqli_query ( $db , $sql ) ;
    return $result ;
  }
  function find_solver_by_username ( $username )
  {
    global $db ;
    $sql = "SELECT * FROM rezolvitori " ;
    $sql .= "WHERE username = '" . $username ."' " ;
    $sql .= "LIMIT 1" ;
    $result = mysqli_query( $db , $sql ) ;
    $solver = mysqli_fetch_assoc( $result ) ;
    return $solver ;
  }

  function insert_problem ( $problem_id , $page_id , $about_task , $question , $constraints , $further_exercise , $nume )
  {
    global $db ;
    $sql = "INSERT INTO probleme ( problem_id , about_task , question , constraints , additional_exercise , page_id , name ) " ;
    $sql .= "VALUES ( " ;
    $sql .= " '" . $problem_id . "' , " ;
    $sql .= " '" . $about_task . "' , " ;
    $sql .= " '" . $question . "' , " ;
    $sql .= " '" . $constraints . "' , " ;
    $sql .= " '" . $further_exercise . "' , " ;
    $sql .= " '" . $page_id . "' , " ;
    $sql .= " '" . $nume . "' " ;
    $sql .= " )" ;
    $result = mysqli_query($db, $sql);
    if($result)
    {
       return true;
    }
    else
    {
       echo mysqli_error($db);
       db_disconnect($db);
       exit;
    }
  }
  function insert_tutorial ( $page_id , $nume , $content_tutorial )
  {
    global $db ;
    $sql = "INSERT INTO tutoriale ( page_id , content_tutorial , name ) " ;
    $sql .= "VALUES ( " ;
    $sql .= " '" . $page_id . "' , " ;
    $sql .= " '" . $content_tutorial. "' , " ;
    $sql .= " '" . $nume . "'  " ;
    $sql .= " )" ;
    $result = mysqli_query($db, $sql);
    if($result)
    {
       return true;
    }
    else
    {
       echo mysqli_error($db);
       db_disconnect($db);
       exit;
    }
  }
  function register_user ( $email , $username , $password )
  {
      global $db ;
      $type= 'User' ;
      $hashed_password = password_hash ( $password , PASSWORD_BCRYPT ) ;
      $sql = "INSERT INTO rezolvitori ( email , username , hashed_password , type ) " ;
      $sql .= "VALUES ( " ;
      $sql .= " '" . $email . "' , " ;
      $sql .= " '" . $username ."' , " ;
      $sql .= " '" . $hashed_password . "' , " ;
      $sql .= " '" . $type ."' " ;
      $sql .= " )" ;
      $result = mysqli_query($db, $sql);
      if($result)
      {
         return true;
      }
      else
      {
         echo mysqli_error($db);
         db_disconnect($db);
         exit;
      }
  }

  function add_submission ( $user_id , $score , $problem_id )
  {
       global $db ;
       $sql = "INSERT INTO submisii ( user_id , score , problem_id ) " ;
       $sql .="VALUES ( " ;
       $sql .= " '" . $user_id  . "' , " ;
       $sql .= " '" . $score ."', " ;
       $sql .= " '" . $problem_id ."' " ;
       $sql .= " )" ;
       $result = mysqli_query($db, $sql);
       if($result)
       {
          return true;
       }
       else
       {
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
       }
  }

  function update_problem_tests ( $topic_id , $problem_id , $problem_no_tests )
  {
      global $db ;
      $sql = "UPDATE probleme " ;
      $sql .= "SET no_tests ='" .$problem_no_tests ."' " ;
      $sql .= "WHERE problem_id = '" .$problem_id ."' AND page_id = '" . $topic_id . "' " ;
      $result = mysqli_query( $db , $sql ) ;
  }
?>
