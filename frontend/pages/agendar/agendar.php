<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../assets/favicons/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../../../frontend/assets/css/pages/agendar/index.css">
    <title>Agende seu atendimento | Kwenda</title>
  </head>
  <body>
  <?php include "../../components/global/icons/icons.php"; ?>
  <?php include "../../components/global/nav/nav.php"; ?>
  <section class="form-container">
    <form>
        <div class="field">
          <label for="email">Nome completo<span>*</span></label>
          <input type="email" placeholder="Ex: Denil Dinis" spellcheck="false" autocomplete="off" id="email" name="email" />
        </div>
        <div class="field">
          <label for="email">Seu contacto<span>*</span></label>
          <input type="email" placeholder="Ex: 9xx xxx xxx" spellcheck="false" autocomplete="off" id="email" name="email" />
        </div>
        <div class="field">
          <label for="banco">Banco<span>*</span></label>
          <select id="banco" name="banco" required>
            <option value="">Selecione um banco</option>
            <option value="BAI">Banco Angolano de Investimentos (BAI)</option>
            <option value="BFA">Banco de Fomento Angola (BFA)</option>
            <option value="BIC">Banco BIC</option>
            <option value="BPC">Banco de Poupança e Crédito (BPC)</option>
            <option value="BMA">Banco Millennium Atlântico</option>
            <option value="SOL">Banco SOL</option>
            <option value="BCA">Banco Comercial Angolano</option>
            <option value="BIR">Banco de Investimento Rural (BIR)</option>
            <option value="BMF">Banco Microfinança (BMF)</option>
            <option value="VBA">Banco Valor</option>
            <option value="BKI">Banco Kwanza Invest</option>
            <option value="BCI">Banco de Comércio e Indústria (BCI)</option>
          </select>
        </div>
      <div class="field">
        <label for="agencia">Agência Bancária<span>*</span></label>
        <select id="agencia" name="agencia" required>
          <option value="">Selecione a agência</option>
          <option value="central">Agência Central</option>
          <option value="luanda">Agência Luanda</option>
          <option value="viana">Agência Viana</option>
          <option value="talatona">Agência Talatona</option>
          <option value="kilamba">Agência Kilamba</option>
          <option value="cacuaco">Agência Cacuaco</option>
          <option value="benfica">Agência Benfica</option>
          <option value="maianga">Agência Maianga</option>
        </select>
      </div>
      <div class="field">
        <label for="data">Data<span>*</span></label>
        <input type="date" id="data" name="data" required>
      </div>
      <button type="submit">
        Agendar
        <span></span>
      </button>
    </form>
  </section>
  <?php include "../../components/global/footer/footer.php"; ?>
  </body>
</html>
