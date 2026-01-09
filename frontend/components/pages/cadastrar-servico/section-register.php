<section class="register">
  <form id="form" onsubmit="registerService(event)" novalidate>

    <div class="fields">
      <div class="field">
        <label for="service_code">Código</label>
        <input type="text" id="service_code" name="service_code" placeholder="Ex: A" spellcheck="false"
          autocomplete="off" required />
      </div>

      <div class="field">
        <label for="service_name">Nome do serviço</label>
        <input type="text" id="service_name" name="service_name" placeholder="Ex: Extracto bancário"
          spellcheck="false" autocomplete="off" required />
      </div>
    </div>

    <div class="buttons">
      <a href="/stagely/frontend/pages/listar-empresa/index.php" class="btn primary">
        <svg>
          <use href="#arrow-left" />
        </svg>
        <p>Voltar</p>
      </a>

      <button type="submit" class="btn">
        <svg>
          <use href="#success" />
        </svg>
        <p>Salvar</p>
        <span></span>
      </button>
    </div>

  </form>
</section>
