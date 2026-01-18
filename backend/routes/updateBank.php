<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../controller/bankController.php';

echo updateBank($_POST, $_FILES);
