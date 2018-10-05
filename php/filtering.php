<?php

/**
 * Returns all the location without filtering
 *
 * @return bool|mysqli_result
 */
function unfiltered(){
   $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (!$link) {
        die("Connection failed");
    }

    $query = "SELECT lat, lng, name, url , status , host , location , description , domain , contact , ric , coordcountry , type FROM mark";
    mysqli_set_charset($link, "utf8");
    $results = mysqli_query($link, $query);
    return $results;
}

/**
 * Executes the given query
 *
 * @param $query string the query to be executed
 * @return bool|mysqli_result the results of the query
 */
function executeQuery($query){

   $servername = "r";
    $username = "";
    $password = "";
    $dbname = "";

  $link = mysqli_connect($servername, $username, $password, $dbname);

  if (!$link) {
    die("Connection failed");
  }

  mysqli_set_charset($link, "utf8");
  $results = mysqli_query($link, $query);
  return $results;
}

/**
 * Gets the available distinct options for the specific columns
 *
 * @param $column string the name of the column
 * @return array an array with the options
 */
function getOptionsFor($column){
   $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

  $link = mysqli_connect($servername, $username, $password, $dbname);

  $query = "SELECT DISTINCT $column FROM `mark` ORDER BY $column ASC ";
  mysqli_set_charset($link, "utf8");
  $results = mysqli_query($link, $query);
  $options = array();
  array_push($options,'Any');
  if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_row($results)) {
      if($row[0] != ""){
        array_push($options,$row[0]);
      }
    }
  }//end if results are not empty
  return $options;
}

/**
 * Returns the query based on the filters given
 *
 * @param $filters array in a format of key => value where key is the name of the column and value is the values to be queried
 *                  If the query should contain multiple values for a column, the value is an array
 *
 * @return string with the query
 */
function getQuery($filters){
  $query = "SELECT lat, lng, name, url , status , host , location , description , domain , contact , ric , coordcountry , type  FROM `mark`";
  if(!empty($filters)){
    $query.= " WHERE";   //adds where clause
    foreach ($filters as $category => $filter){
        if(getLastWord($query) != 'WHERE' && getLastWord($query) != 'AND'){
            $query .= " AND";  //adds AND
        }   //end if the last word of the query is not WHERE

      if(is_array($filter) && !in_array('Any',$filter)){
        foreach ($filter as $subfilter){
          if(getLastWord($query) != 'WHERE' && getLastWord($query) != 'AND'){
            $query .= "AND";  //adds AND
          }   //end if the last word of the query is not WHERE
          $query .= " `$category` = '$subfilter'";
        }   //end for each subfilter ( in case of multiple values ex. countries)
}
      elseif (!in_array('Any',$filter)){
        $query.= " `$category` = '$filter'";
      }   //end if subfilters do not exist
    }   //end for each filter
  }   //end if filters array is not empty
    $query = clearQuery($query);
  return $query;
}

function clearQuery($query){
    $lastWord = getLastWord($query);
    if($lastWord == 'WHERE' || $lastWord == 'AND'){
        $query = removeLastWord($query);
    }
    return $query;
}

function removeLastWord($query){
    return preg_replace('/\W\w+\s*(\W*)$/', '$1', $query);
}

/**
 * Returns the last word of a given phrase
 *
 * @param $phrase string the phrase to be checked
 * @return string the last word
 */
function getLastWord($phrase){
  $tokens = preg_split('/\s+/', $phrase);   //breaks the phrase into tokens

  if(empty(($tokens))){
    return '';
  }
  else{
    return $tokens[sizeof($tokens)-1];  //return the last word
  }
}

?>