<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../assets/favicons/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../../assets/css/pages/sucesso/index.css" />
  <title>Sucesso | Kwenda</title>
</head>

<body>
  <?php include "../../components/global/icons/icons.php"; ?>
  <?php include "../../components/global/nav/nav.php"; ?>
  <?php include "../../components/pages/sucesso/section-success.php"; ?>
  <?php include "../../components/global/footer/footer.php"; ?>
</body>
<script>
  const year = new Date().getFullYear();
  document.querySelector('#current-year span').textContent = year;
</script>
<script src="../../assets/js/pages/schedule/downloadPDF.js" ></script>
</html>
