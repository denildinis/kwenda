;(async () => {
  try {
    const response = await fetch('/kwenda/backend/functions/sessions/getRole.php')
    const result = await response.json()

    const nav = document.getElementById('nav-options')
    if (!nav) return

    nav.innerHTML = ''

    if (result.role === 'admin') {
      nav.innerHTML = `
        <a href="/kwenda/frontend/pages/cadastrar-banco/index.php">Bancos</a>
      `
    } else if (result.role === 'banco') {
      nav.innerHTML = `
        <a href="/kwenda/frontend/pages/dashboard/index.php">Dashboard</a>
        <a href="/kwenda/frontend/pages/cadastrar-agencia/index.php">Agências</a>
        <a href="/kwenda/frontend/pages/cadastrar-servico/index.php">Serviços</a>
        <a href="/kwenda/frontend/pages/agendamentos/index.php">Agendamentos</a>
      `
    }
  } catch (error) {
    console.error('Erro ao carregar menu:', error)
  }
})()
