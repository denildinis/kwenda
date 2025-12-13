<!doctype html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../assets/favicons/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../../assets/css/pages/entrar/index.css" />
    <title>Entrar na Aplicação | Stagely</title>
  </head>
  <body>
    <?php include "../../components/global/icons/icons.php"; ?>
    <?php include "../../components/global/alert/alert.php"; ?>
    <section class="form-container">
      <img src="../../assets/images/logo.svg" alt="logo" class="logo" />
      <h1>Inicie sessão para gerir os atendimentos</h1>
      <form onsubmit="handleLogin(event)" novalidate>
        <div class="field">
          <div class="icon">
            <svg>
              <use href="#search" />
            </svg>
          </div>
          <label for="email">E-mail</label>
          <input type="email" placeholder="exemplo@mail.com" spellcheck="false" autocomplete="off" id="email" name="email" />
        </div>
        <div class="field">
          <div class="icon">
            <svg>
              <use href="#lock" />
            </svg>
          </div>
          <label for="password">Senha</label>
          <input type="password" placeholder="senha#123" spellcheck="false" autocomplete="off" id="password" name="password" />
          <div class="icon icon-eye">
            <svg>
              <use href="#eye" />
            </svg>
          </div>
        </div>
        <button type="submit">
          Entrar
          <span></span>
        </button>
      </form>
    </section>
  </body>
  <script src="../../assets/js/global/alert.js"></script>
  <script src="../../assets/js/pages/entrar/login.js"></script>
  <script src="../../assets/js/pages/entrar/toogle-password.js"></script>
</html>
