<header>
  <button class="hamburger" id="hamburger">
    <svg>
      <use href="#menu"></use>
    </svg>
  </button>

  <a href="#" class="logo"><img src="/kwenda/frontend/assets/images/logo-2.svg" alt="logo" /></a>

  <nav class="nav-options" id="nav-options">
    <!-- Links serão preenchidos pelo JS -->
  </nav>

  <div class="profile">
    <button class="open" data-dropdown-toggle="profile">
      <svg>
        <use href="#chevron-down"></use>
      </svg>
      <div class="photo" style="background-image: url('/kwenda/frontend/assets/images/placeholder.png');"></div>
    </button>

    <div class="options" id="profile">
      <a href="#" class="item">
        <svg>
          <use href="#pencil"></use>
        </svg>
        <span>Editar perfil</span>
      </a>
      <a href="#" class="item">
        <svg>
          <use href="#lock"></use>
        </svg>
        <span>Alterar senha</span>
      </a>
      <a href="/kwenda/backend/pages/logout.php" class="item logout">
        <svg>
          <use href="#power"></use>
        </svg>
        <span>Terminar sessão</span>
      </a>
    </div>
  </div>
</header>
