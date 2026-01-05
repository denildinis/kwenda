<section class="schedule" id="schedule">
  <div class="title">
    <h2>Hora de fazer seu agendamento</h2>
  </div>
  <form onsubmit="schedule(event)" novalidate>
    <div class="fields">
      <div class="field">
        <label for="bank">Banco</label>
        <div class="select">
          <div class="selected" data-dropdown-toggle="data-bank">
            <span class="text">Selecionar</span>
            <svg>
              <use href="#chevron-down"></use>
            </svg>
          </div>
          <div class="options" id="data-bank">
            <div class="search">
              <svg>
                <use href="#search"></use>
              </svg>
              <input type="text" placeholder="Buscar..." />
            </div>
            <ul class="list">
            </ul>
          </div>
          <input type="hidden" name="bank" id="bank">
        </div>
      </div>
      <div class="field">
        <label for="agency">Agência</label>
        <div class="select">
          <div class="selected" data-dropdown-toggle="data-agency">
            <span class="text">Selecionar</span>
            <svg>
              <use href="#chevron-down"></use>
            </svg>
          </div>
          <div class="options" id="data-agency">
            <div class="search">
              <svg>
                <use href="#search"></use>
              </svg>
              <input type="text" placeholder="Buscar..." />
            </div>
            <ul class="list">
              <li class="item">Selecione primeiro o banco</li>
            </ul>
          </div>
          <input type="hidden" name="agency" id="agency">
        </div>
      </div>
      <div class="field">
        <label for="service">Servço</label>
        <div class="select">
          <div class="selected" data-dropdown-toggle="data-service">
            <span class="text">Selecionar</span>
            <svg>
              <use href="#chevron-down"></use>
            </svg>
          </div>
          <div class="options" id="data-service">
            <div class="search">
              <svg>
                <use href="#search"></use>
              </svg>
              <input type="text" placeholder="Buscar..." />
            </div>
            <ul class="list">
              <li class="item">Selecione primeiro o banco</li>
            </ul>
          </div>
          <input type="hidden" name="service" id="service">
        </div>
      </div>
    </div>
    <div class="fields">
      <div class="field">
        <label for="data">Data</label>
        <input type="date" id="data" name="data">
      </div>
    </div>
    <div class="fields">
      <div class="field">
        <label for="email">Nome</label>
        <input type="email" placeholder="Ex: Denil Dinis" spellcheck="false" autocomplete="off" id="email"
          name="email" />
      </div>
    </div>
    <div class="buttons">
      <button type="submit" class="btn">
        <p>Agendar</p>
        <span></span>
      </button>
    </div>
  </form>
</section>