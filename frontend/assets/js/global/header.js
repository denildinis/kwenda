;(async () => {
  try {
    const response = await fetch('/kwenda/backend/functions/sessions/getRole.php')
    const result = await response.json()

    const nav = document.getElementById('nav-options')
    if (!nav) return

    nav.innerHTML = ''

    if (result.role === 'admin') {
      nav.innerHTML = `
        <a href="/kwenda/frontend/pages/listar-bancos/index.php">Bancos</a>
      `
    } else if (result.role === 'banco') {
      nav.innerHTML = `
        <a href="/kwenda/frontend/pages/listar-agencias/index.php">Agências</a>
        <a href="/kwenda/frontend/pages/listar-servicos/index.php">Serviços</a>
        <a href="/kwenda/frontend/pages/listar-agendamentos/index.php">Agendamentos</a>
      `
    }
  } catch (error) {
    console.error('Erro ao carregar menu:', error)
  }
})()

// Hamburger menu toggle
const hamburger = document.getElementById('hamburger')
const navOptions = document.getElementById('nav-options')

if (hamburger && navOptions) {
  hamburger.addEventListener('click', () => {
    navOptions.classList.toggle('open')
  })

  // Fechar menu automaticamente ao redimensionar para telas maiores
  window.addEventListener('resize', () => {
    if (window.innerWidth > 1024 && navOptions.classList.contains('open')) {
      navOptions.classList.remove('open')
    }
  })
}
