<?php
function insert_caterory( $caterory){
  global $db;

  $sql = "INSERT INTO Caterory ";
  $sql .= "(CateroryName, CateroryIMG) ";
  $sql .= "VALUES (";
  $sql .= "'" . $caterory['CateroryName'] . "',";
  $sql .= "'" . $caterory['CateroryIMG'] . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if($result) {
      return true;
  } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }
}
function find_all_caterory() {
  global $db;

  $sql = "SELECT * FROM Caterory ";
  $sql .= "ORDER BY CateroryName";

  $result = mysqli_query($db,$sql);

  return $result;
}
function find_all_caterory_paginate() {
  global $db;

  $sql = "SELECT * FROM Caterory ";
  $sql .= "ORDER BY CateroryName";

  $result = mysqli_query($db,$sql);

  return $result;
}
function find_caterory_by_id($id) {
  global $db;
  $sql = "SELECT * FROM Caterory ";
  $sql .= "WHERE CateroryID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Caterory = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Caterory;
}
function update_caterory($Caterory) {
  global $db;
  $sql = "UPDATE Caterory SET ";
  $sql .= "CateroryName='" . $Caterory['CateroryName'] . "', ";
  $sql .= "CateroryIMG='" . $Caterory['CateroryIMG'] . "' ";
  $sql .= "WHERE CateroryID='" . $Caterory['CateroryID'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function delete_caterory($id) {
  global $db;
  $sql = "DELETE FROM Caterory ";
  $sql .= "WHERE CateroryID='" . $id . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  if($result) {
      return true;
  } else {
      $sql = "DELETE FROM food ";
      $sql .= "WHERE CateroryID='" . $id . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
  }if($result) {
      $sql = "DELETE FROM Caterory ";
      $sql .= "WHERE CateroryID='" . $id . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      return true;
  } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }
}

function insert_food($Food){
  global $db;
  $sql = "INSERT INTO food ";
  $sql .= "(CateroryID,`Name`,Size,Price,FoodIMG,FoodIMG_mt,`Describe`) ";
  $sql .= "VALUES (";
  $sql .= "'" . $Food['CateroryID'] . "',";
  $sql .= "'" . $Food['Name'] . "',";
  $sql .= "'" . $Food['Size'] . "',";
  $sql .= "'" . $Food['Price'] . "',";
  $sql .= "'" . $Food['FoodIMG'] . "',";
  $sql .= "'" . $Food['FoodIMG_mt'] . "',";
  $sql .= "'" . $Food['Describe'] . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if($result) {
      return true;
  } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }
}
function find_all_food() {
  global $db;

  $sql = "SELECT * FROM food ";
  $sql .= "ORDER BY Name";

  $result = mysqli_query($db,$sql);

  return $result;
}
function find_food_by_id($id) {
  global $db;

  $sql = "SELECT * FROM food ";
  $sql .= "WHERE FoodID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Food = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Food;
}
function update_food($Food) {
  global $db;
  $sql = "UPDATE food SET ";
  $sql .= "CateroryID='" . $Food['CateroryID'] . "', ";
  $sql .= "Name='" . $Food['Name'] . "', ";
  $sql .= "Size='" . $Food['Size'] . "', ";
  $sql .= "Price='" . $Food['Price'] . "', ";
  $sql .= "FoodIMG='" . $Food['FoodIMG'] . "',";
  $sql .= "FoodIMG_mt='" . $Food['FoodIMG_mt'] . "',";
  $sql .= "`Describe`='" . $Food['Describe'] . "' ";
  $sql .= "WHERE FoodID='" . $Food['FoodID'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function delete_food($id) {
  global $db;
  $sql = "DELETE FROM food ";
  $sql .= "WHERE FoodID='" . $id . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}




function insert_feedback($Feedback){
  global $db;

  $sql = "INSERT INTO Feedback ";
  $sql .= "(FullName,FoodID,`Point`,`Date`,`visible`,Email,`Comment`,) ";
  $sql .= "VALUES (";
  $sql .= "'" . $Feedback['FullName'] . "',";
  $sql .= "'" . $Feedback['FoodID'] . "',";
  $sql .= "'" . $Feedback['Point'] . "',";
  $sql .= " CURDATE() ,";
  $sql .= "'" . $Feedback['visible'] . "',";
  $sql .= "'" . $Feedback['Email'] . "',";
  $sql .= "'" . $Feedback['Comment'] . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if($result) {
      return true;
  } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }
}
function find_all_feedback() {
  global $db;

  $sql = "SELECT * FROM Feedback ";
  $sql .= "ORDER BY FullName";

  $result = mysqli_query($db,$sql);

  return $result;
}
function find_feedback_by_id($id) {
  global $db;

  $sql = "SELECT * FROM Feedback ";
  $sql .= "WHERE FeedbackID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Feedback = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Feedback;
}
function find_feedback_by_id_visible($id) {
  global $db;
  $sql = "SELECT visible,FeedbackID FROM Feedback ";
  $sql .= "WHERE FeedbackID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Feedback = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Feedback;
}
function update_feedback_visible($Feedback) {
  global $db;
  $sql = "UPDATE Feedback SET ";
  $sql .= "visible='" . $Feedback['visible'] . "' ";
  $sql .= "WHERE FeedbackID='" . $Feedback['FeedbackID'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function update_feedback($Feedback) {
  global $db;
  $sql = "UPDATE Feedback SET ";
  $sql .= "Fullname='" . $Feedback['Fullname'] . "', ";
  $sql .= "FoodID='" . $Feedback['FoodID'] . "', ";
  $sql .= "Point='" . $Feedback['Point'] . "', ";
  $sql .= "`Date`= CURDATE(), ";
  $sql .= "visible='" . $Feedback['visible'] . "', ";
  $sql .= "Fullname='" . $Feedback['Fullname'] . "', ";
  $sql .= "Email='" . $Feedback['Email'] . "' ";
  $sql .= "WHERE FeedbackID='" . $Feedback['FeedbackID'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function delete_feedback($id) {
  global $db;
  $sql = "DELETE FROM Feedback ";
  $sql .= "WHERE FeedbackID='" . $id . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}   







function insert_admin($Admin){
  global $db;

  $sql = "INSERT INTO Admins ";
  $sql .= "(Username,Password_Hash,FullName,Phone,Gmail) ";
  $sql .= "VALUES (";
  $sql .= "'" . $Admin['Username'] . "',";
  $sql .= "'" . $Admin['Password_Hash'] . "',";
  $sql .= "'" . $Admin['FullName'] . "',";
  $sql .= "'" . $Admin['Phone'] . "',";
  $sql .= "'" . $Admin['Gmail'] . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if($result) {
      return true;
  } else {
      echo "Ten Nguoi Dung Da Ton Tai";
      db_disconnect($db);
      exit;
  }
}

function find_admin_by_id($Username) {
  global $db;
  $sql = "SELECT * FROM Admins ";
  $sql .= "WHERE Username='" . $Username . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Admin = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Admin;
}
function update_admin($Admin) {
  global $db;
  $sql = "UPDATE Admins SET ";
  $sql .= "Username='" . $Admin['Username'] . "', ";
  $sql .= "Password_Hash='" . $Admin['Password_Hash'] . "', ";
  $sql .= "FullName='" . $Admin['FullName'] . "', ";
  $sql .= "Phone='" . $Admin['Phone'] . "', ";
  $sql .= "Gmail='" . $Admin['Gmail'] . "' ";
  $sql .= "WHERE Username='" . $Admin['USE'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function delete_admin($Username) {
  global $db;
  $sql = "DELETE FROM Admins ";
  $sql .= "WHERE Username='" . $Username . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function find_login_by_username($Username) {
  global $db;

  $sql = "SELECT Password_Hash FROM Admins ";
  $sql .= "WHERE Username='" . $Username . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Login = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Login;
}
function find_all_admin() {
  global $db;

  $sql = "SELECT * FROM Admins ";
  $sql .= "ORDER BY Username";

  $result = mysqli_query($db,$sql);

  return $result;
}
function find_feedback_avg() {
  global $db;
  $sql = "SELECT AVG(`Point`) as avg FROM feedback";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $avg = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $avg;
}
function find_ADMIN_by_USE($id) {
  global $db;
  $sql = "SELECT Username FROM Admins ";
  $sql .= "WHERE Username='" . $id . "' ";
  $result = mysqli_query($db,$sql);
  return $result;
}
function find_caterory_by_cateroryname($ID) {
  global $db;

  $sql = "SELECT CateroryName FROM Caterory ";
  $sql .= "WHERE CateroryID='" . $ID . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $Caterory = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $Caterory;
}
function find_feedback_by_point_avg() {
  global $db;
  $sql = "SELECT AVG(`Point`) AS avg FROM feedback";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $avg = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $avg;
}
function find_all_contact() {
  global $db;

  $sql = "SELECT * FROM Contact ";
  $sql .= "ORDER BY FullName";

  $result = mysqli_query($db,$sql);

  return $result;
}
function delete_Contact($id) {
  global $db;
  $sql = "DELETE FROM Contact ";
  $sql .= "WHERE ContactID='" . $id . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function find_contact_by_id($id) {
  global $db;
  $sql = "SELECT * FROM Contact ";
  $sql .= "WHERE ContactID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_query_result($result);
  $contact = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $contact;
}
function update_contact($Contact) {
  global $db;
  $sql = "UPDATE Contact SET ";
  $sql .= "Reply='" . $Contact['Reply'] . "' ";
  $sql .= "WHERE ContactID='" . $Contact['ContactID'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  return confirm_query_result($result);
}
function find_all_food_by_cateroryid($id){
  global $db;
  $sql = "SELECT * FROM food ";
  $sql .= "WHERE CateroryID='" . $id . "'";
  $sql .= "GROUP BY `Name`;";
  $result = mysqli_query($db,$sql);
  return $result;
}
function find_search_name_caterory($search) {
  global $db;
  $sql = "SELECT * FROM caterory ";
  $sql .= "WHERE CateroryName LIKE '%" . $search . "%'";
  $result = mysqli_query($db,$sql);
  return $result;
}

?>

?>