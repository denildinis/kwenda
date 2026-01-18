<?php
$pdo = new PDO("mysql:host=localhost;dbname=kwenda", "root", "");
if (!$pdo) {
  die();
}
