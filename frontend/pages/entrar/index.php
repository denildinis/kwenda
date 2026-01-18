<?php
require_once __DIR__ . "/../../../backend/functions/cache/cleanCache.php";
require_once __DIR__ . "/../../../backend/functions/sessions/session.php";
redirectIfLogged()
?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../../assets/favicons/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../../assets/css/pages/entrar/index.css" />
  <title>Entrar na Plataforma | Kwenda</title>
</head>

<body>
  <?php include "../../components/global/icons/icons.php"; ?>
  <?php include "../../components/global/alert/alert.php"; ?>
  <?php include "../../components/pages/entrar/section-login.php"; ?>
</body>
<script src="../../assets/js/global/alert.js"></script>
<script src="../../assets/js/pages/entrar/login.js"></script>
<script src="../../assets/js/global/toogle-password.js"></script>

</html>
