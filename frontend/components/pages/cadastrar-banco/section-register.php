<section class="register">
  <form id="form" onsubmit="registerBank(event)" novalidate>
    <div class="fields first-row">
      <div class="upload">
        <input type="file" id="photoInput" accept=".jpg, .jpeg, .png, image/jpeg, image/png" />
        <div class="photo" style="background-image: url('/kwenda/frontend/assets/images/placeholder.png')">
          <img id="photoPreview" alt="" />
          <div class="icon">
            <svg>
              <use href="#camera"></use>
            </svg>
          </div>
        </div>
      </div>
      <div class="field field-name">
        <input type="text" placeholder="Nome do banco" spellcheck="false" autocomplete="off" id="name" name="name" />
      </div>
    </div>
    <div class="fields">
      <div class="field">
        <label for="acronym">Sigla</label>
        <input type="text" placeholder="Ex: BAI" spellcheck="false" autocomplete="off" id="acronym" name="acronym" />
      </div>
    </div>
    <div class="fields">
      <div class="field">
        <label for="email">E-mail</label>
        <input type="email" placeholder="exemplo@mail.com" spellcheck="false" autocomplete="off" id="email"
          name="email" />
      </div>
      <div class="field">
        <label for="password">Senha</label>
        <input type="password" placeholder="senha#123" spellcheck="false" autocomplete="off" id="password"
          name="password" />
        <svg class="icon-eye">
          <use href="#eye" />
        </svg>
      </div>
    </div>
    <div class="buttons">
      <a href="/kwenda/frontend/pages/listar-bancos/index.php" class="btn primary">
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
