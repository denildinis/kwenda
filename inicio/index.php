<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../frontend/assets/favicons/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/kwenda/frontend/assets/css/pages/inicio/index.css">
  <title>Inicio | Kwenda</title>
</head>

<body>
  <?php include "../frontend/components/global/icons/icons.php"; ?>
  <?php include "../frontend/components/global/nav/nav.php"; ?>
  <?php include "../frontend/components/pages/inicio/section-hero.php"; ?>
  <?php include "../frontend/components/pages/inicio/section-benefits.php"; ?>
  <?php include "../frontend/components/pages/inicio/section-process.php"; ?>
  <?php include "../frontend/components/pages/inicio/section-schedule.php"; ?>
  <?php include "../frontend/components/global/footer/footer.php"; ?>
</body>
<script>
  const year = new Date().getFullYear();
  document.querySelector('#current-year span').textContent = year;
</script>
<script src="/kwenda/frontend/assets/js/global/dropdown.js"></script>
<script src="/kwenda/frontend/assets/js/global/select.js"></script>
<script src="/kwenda/frontend/assets/js/pages/schedule/fill.js"></script>
</html>
