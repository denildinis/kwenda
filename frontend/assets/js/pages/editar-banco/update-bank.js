;(function () {
  const params = new URLSearchParams(window.location.search)
  const bankId = params.get('id')

  if (!bankId) {
    window.location.href = '/kwenda/frontend/pages/listar-bancos/index.php'
    return
  }

  const form = document.querySelector('form')
  const bankIdInput = document.getElementById('bank_id')
  const photoBox = document.querySelector('#bankPhoto')

  bankIdInput.value = bankId

  /* =========================
    CARREGAR DADOS DO BANCO
  ========================= */
  async function loadBank() {
    try {
      const response = await fetch(`/kwenda/backend/routes/getBank.php?id=${bankId}`)
      const bank = await response.json()

      if (!bank || !bank.id) {
        window.location.href = '/kwenda/frontend/pages/listar-bancos/index.php'
        return
      }

      document.getElementById('name').value = bank.nome
      document.getElementById('acronym').value = bank.sigla
      document.getElementById('email').value = bank.email
      // deixar password vazio por segurança
      document.getElementById('password').value = ''
      document.getElementById('current_logo').value = bank.logo || ''

      if (photoBox && bank.logo) {
        photoBox.style.backgroundImage = `url('/kwenda/frontend/assets/uploads/banks/${bank.logo}')`
      }
    } catch (error) {
      console.error(error)
      try {
        showAlert('Erro ao carregar dados do banco', 'error')
      } catch (e) {
        console.error('Alert error:', e)
      }
    }
  }

  loadBank()

  const button = document.querySelector('button[type="submit"]')
  button.addEventListener('click', async (event) => {
    event.preventDefault()

    const email = document.getElementById('email').value
    const password = document.getElementById('password').value

    // Validação de e-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(email)) {
      try {
        showAlert('E-mail inválido', 'error')
      } catch (e) {
        console.error('Alert error:', e)
      }
      return
    }

    // Validação de senha (se fornecida)
    if (password && password.length < 8) {
      try {
        showAlert('Senha deve ter pelo menos 8 caracteres', 'error')
      } catch (e) {
        console.error('Alert error:', e)
      }
      return
    }

    try {
      const formData = new FormData(form)

      const response = await fetch('/kwenda/backend/routes/updateBank.php', {
        method: 'POST',
        body: formData
      })

      const result = await response.json()

      if (result.success) {
        showAlert('Banco atualizado com sucesso', 'success')
        setTimeout(() => {
          window.location.href = '/kwenda/frontend/pages/listar-bancos/index.php'
        }, 800)
      } else {
        showAlert(result.message || 'Erro ao atualizar banco', 'error')
      }
    } catch (error) {
      console.error(error)
      try {
        showAlert('Erro de comunicação com o servidor', 'error')
      } catch (e) {
        console.error('Alert error:', e)
      }
    }
  })
})()
