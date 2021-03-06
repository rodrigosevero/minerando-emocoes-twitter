<?php

/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */
 
require('http.php');
require('oauth_client.php');
require('config.php');

//require('config.php');

$client = new oauth_client_class;
$client->debug = 1;
$client->debug_http = 1;
$client->redirect_uri = REDIRECT_URL;
//$client->redirect_uri = 'oob';

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = SECRET_KEY;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to Twitter Apps page https://dev.twitter.com/apps/new , ' .
          'create an application, and in the line ' . $application_line .
          ' set the client_id to Consumer key and client_secret with Consumer secret. ' .
          'The Callback URL must be ' . $client->redirect_uri . ' If you want to post to ' .
          'the user timeline, make sure the application you create has write permissions');

if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->access_token)) {
      $success = $client->CallAPI(
              'https://api.twitter.com/1.1/account/verify_credentials.json', 'GET', array(), array('FailOnAccessError' => true), $user);
    }
  }
  $success = $client->Finalize($success);
}
if ($client->exit)
  exit;
if ($success) {
  // Now check if user exist with same email ID
  $sql = "SELECT COUNT(*) AS count from users_twitter where twitter_id = :id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":id", $user->id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      // User Exist 

      $_SESSION["name"] = $user->name;
      $_SESSION["id"] = $user->id;
      $_SESSION["new_user"] = "no";
    } else {
      // New user, Insert in database
      $sql = "INSERT INTO `users_twitter` (`name`, `twitter_id`) VALUES " . "( :name, :id)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $user->name);
      $stmt->bindValue(":id", $user->id);
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["name"] = $user->name;
        $_SESSION["id"] = $user->id;
        $_SESSION["new_user"] = "yes";
        $_SESSION["e_msg"] = "";
      }
    }
  } catch (Exception $ex) {
    $_SESSION["e_msg"] = $ex->getMessage();
  }

  $_SESSION["user_id"] = $user->id;
} else {
  $_SESSION["e_msg"] = $client->error;
}
header("location:../");
exit;
?>