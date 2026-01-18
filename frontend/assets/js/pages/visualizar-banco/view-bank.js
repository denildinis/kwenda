function getBankIdFromURL() {
  const params = new URLSearchParams(window.location.search)
  return params.get('id')
}

async function viewBank() {
  const bankId = getBankIdFromURL()
  if (!bankId) return

  try {
    const response = await fetch('/kwenda/backend/routes/getBanks.php')
    if (!response.ok) throw new Error('Erro ao carregar bancos')

    const banks = await response.json()
    const bank = banks.find((b) => b.id == bankId)

    if (!bank) {
      showAlert('Banco não encontrado!')
      return
    }

    document.getElementById('name').textContent = bank.nome
    document.getElementById('acronym').textContent = bank.sigla
    document.getElementById('email').textContent = bank.email

    const photo = document.getElementById('photo')
    if (bank.logo) {
      photo.style.backgroundImage = `url('/kwenda/frontend/assets/uploads/banks/${bank.logo}')`
    } else {
      photo.style.backgroundImage = `url('/kwenda/frontend/assets/images/placeholder.png')`
    }

    document.getElementById('password').textContent = '••••••••'
  } catch (error) {
    console.error(error)
    showAlert('Erro de conexão. Tente novamente', 'error')
  }
}

// Executa ao carregar a página
document.addEventListener('DOMContentLoaded', viewBank)
