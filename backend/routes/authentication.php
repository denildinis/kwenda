<?php
require_once "../controller/userAutenticator.php";
$user = json_decode(file_get_contents("php://input"), true);
echo authenticateUser($user["email"], $user["password"]);
