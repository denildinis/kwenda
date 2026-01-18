<section class="success" id="success">
  <div class="card">
    <svg>
      <use href="#confirmed" />
    </svg>
    <h2>Agendamento foi realizado com sucesso!</h2>
    <button id="downloadBtn" data-id="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
      <svg>
        <use href="#download" />
      </svg>
      <span>Baixar Comprovativo</span>
    </button>
  </div>
</section>
