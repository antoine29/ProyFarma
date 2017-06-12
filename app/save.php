<?php
require_once "../models/User.php";
if (empty($_POST['submit']))
{
      header("Location:" . User::baseurl() . "app/list.php");
      exit;
}

$args = array(
	'id'		=> FILTER_VALIDATE_INT,
    'username'  => FILTER_SANITIZE_STRING,
    'password'  => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$user = new User($db);
$user->setId($post->id);
$user->setUsername($post->username);
$user->setPassword($post->password);
$user->save();
header("Location:" . User::baseurl() . "app/list.php");