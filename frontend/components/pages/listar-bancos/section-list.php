<section class="list">
  <div class="header">
    <div class="search-wrapper">
      <h3></h3>
      <div class="search">
        <div class="field">
          <div class="icon">
            <svg>
              <use href="#search" />
            </svg>
          </div>
          <input type="text" placeholder="Buscar empresa" id="searchInput" />
        </div>
      </div>
    </div>
    <div class="buttons">
      <div class="filter">
        <button class="btn primary" data-dropdown-toggle="data-filter">
          <svg>
            <use href="#filter"></use>
          </svg>
          <span>Filtrar</span>
        </button>

        <div class="options" id="data-filter">
          <ul class="list">
            <li class="item" data-type="order" data-value="az">Alfabética A–Z</li>
            <li class="item" data-type="order" data-value="za">Alfabética Z–A</li>
          </ul>
        </div>
        <input type="hidden" id="order">
      </div>

      <a href="/kwenda/frontend/pages/cadastrar-banco/index.php" class="btn">
        <svg>
          <use href="#plus" />
        </svg>
        <span>Nova empresa</span>
      </a>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Sigla</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <!-- Linhas serão preenchidas via JS -->
    </tbody>
  </table>

  <div class="pagination">
  </div>
</section>
