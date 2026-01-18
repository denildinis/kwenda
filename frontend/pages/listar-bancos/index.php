<?php
require_once __DIR__ . "/../../../backend/functions/sessions/session.php";
verifySession();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../assets/favicons/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../../assets/css/pages/listar-bancos/index.css" />
  <title>Bancos | Kwenda</title>
</head>

<body>
  <?php include "../../components/global/icons/icons.php"; ?>
  <?php include "../../components/global/alert/alert.php"; ?>
  <?php include "../../components/global/modal/modal.php"; ?>
  <?php include "../../components/global/top/top.php"; ?>
  <?php include "../../components/pages/listar-bancos/section-list.php"; ?>
</body>
<script src="../../assets/js/global/alert.js"></script>
<script src="../../assets/js/global/confirmModal.js"></script>
<script src="../../assets/js/global/header.js"></script>
<script src="../../assets/js/global/dropdown.js"></script>
<script src="../../assets/js/pages/listar-bancos/list-banks.js"></script>
<script src="../../assets/js/pages/eliminar-banco/delete-bank.js"></script>

</html>
