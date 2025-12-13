<?php
$pdo = new PDO("mysql:host=localhost;dbname=stagely", "root", "");
if (!$pdo) {
  die();
}
