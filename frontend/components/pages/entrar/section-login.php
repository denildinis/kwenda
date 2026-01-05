<section class="login">
  <img src="../../assets/images/logo.svg" alt="logo" class="logo" />
  <h1>Inicie sessão para gerir os atendimentos</h1>
  <form id="form" onsubmit="handleLogin(event)" autocomplete="off" novalidate>
    <div class="field">
      <label for="email">E-mail</label>
      <input type="email" placeholder="exemplo@mail.com" spellcheck="false" autocomplete="off" id="email"
        name="email" />
    </div>
    <div class="field">
      <label for="password">Senha</label>
      <input type="password" placeholder="senha#123" spellcheck="false" autocomplete="new-password" id="password"
        name="password" />
      <svg class="icon-eye">
        <use href="#eye" />
      </svg>
    </div>
    <button type="submit">
      <p>Entrar</p>
      <span></span>
    </button>
  </form>
</section>
