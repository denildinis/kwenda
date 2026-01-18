<section class="register">
  <form id="form" onsubmit="registerAgency(event)" novalidate>

    <div class="fields">
      <div class="field">
        <label for="agency_name">Nome da agência</label>
        <input type="text" id="agency_name" name="agency_name" placeholder="Agência Palanca" spellcheck="false"
          autocomplete="off" required />
      </div>
    </div>

    <div class="fields">
      <div class="field">
        <label for="province">Província</label>
        <div class="select">
          <div class="selected" data-dropdown-toggle="data-province">
            <span class="text">Selecionar</span>
            <svg>
              <use href="#chevron-down"></use>
            </svg>
          </div>
          <div class="options" id="data-province">
            <div class="search">
              <svg>
                <use href="#search"></use>
              </svg>
              <input type="text" placeholder="Buscar..." />
            </div>
            <ul class="list">
              <li class="item" data-value="Bengo">Bengo</li>
              <li class="item" data-value="Benguela">Benguela</li>
              <li class="item" data-value="Bié">Bié</li>
              <li class="item" data-value="Cabinda">Cabinda</li>
              <li class="item" data-value="Cuando Cubango">Cuando Cubango</li>
              <li class="item" data-value="Cuanza Norte">Cuanza Norte</li>
              <li class="item" data-value="Cuanza Sul">Cuanza Sul</li>
              <li class="item" data-value="Cunene">Cunene</li>
              <li class="item" data-value="Huambo">Huambo</li>
              <li class="item" data-value="Huíla">Huíla</li>
              <li class="item" data-value="Luanda">Luanda</li>
              <li class="item" data-value="Lunda Norte">Lunda Norte</li>
              <li class="item" data-value="Lunda Sul">Lunda Sul</li>
              <li class="item" data-value="Malanje">Malanje</li>
              <li class="item" data-value="Moxico">Moxico</li>
              <li class="item" data-value="Namibe">Namibe</li>
              <li class="item" data-value="Uíge">Uíge</li>
              <li class="item" data-value="Zaire">Zaire</li>
            </ul>
          </div>
          <input type="hidden" name="province" id="province">
        </div>
      </div>
      <div class="field">
        <label for="municipality">Município</label>
        <input type="text" id="municipality" name="municipality" placeholder="Ex: Talatona" spellcheck="false"
          autocomplete="off" required />
      </div>

      <div class="field">
        <label for="neighborhood">Bairro</label>
        <input type="text" id="neighborhood" name="neighborhood" placeholder="Ex: Benfica" spellcheck="false"
          autocomplete="off" required />
      </div>
    </div>

    <div class="fields">
      <div class="field">
        <label for="street">Rua</label>
        <input type="text" id="street" name="street" placeholder="Ex: Rua 21 de Janeiro" spellcheck="false"
          autocomplete="off" required />
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
