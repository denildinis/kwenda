;(() => {
  const emailInput = document.getElementById('email')
  const passwordInput = document.getElementById('password')
  const submitButton = document.querySelector('button[type="submit"]')

  function checkFormFields() {
    const emailFilled = emailInput.value.trim() !== ''
    const passwordFilled = passwordInput.value.trim() !== ''
    return emailFilled && passwordFilled
  }

  function isValidEmail() {
    const email = emailInput.value.trim()
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailPattern.test(email)
  }

  function getLoaderDelay(startTime, minimum = 500) {
    const elapsed = Date.now() - startTime
    return elapsed < minimum ? minimum - elapsed : 0
  }

  async function handleLogin(event) {
    event.preventDefault()

    if (!checkFormFields()) {
      showAlert('Por favor, preencha todos os campos', 'error')
      return
    }

    if (!isValidEmail()) {
      showAlert('Formato de e-mail inválido', 'error')
      return
    }

    submitButton.disabled = true
    submitButton.classList.add('loading')

    const startTime = Date.now()

    const loginPayload = {
      email: emailInput.value.trim(),
      password: passwordInput.value.trim()
    }

    try {
      const response = await fetch('../../../backend/routes/authentication.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(loginPayload)
      })

      const result = await response.json()

      const waitTime = getLoaderDelay(startTime)

      if (!result.success) {
        setTimeout(() => {
          submitButton.disabled = false
          submitButton.classList.remove('loading')
          showAlert('Email ou senha inválidos', 'error')
        }, waitTime)
        return
      }

      setTimeout(() => {
        if (result.role === 'Escola') {
          window.location.href += '/admin-dashboard'
        } else {
          window.location.href += '/user-dashboard'
        }
      }, waitTime)
    } catch (error) {
      console.error('Erro ao fazer login', error)
      const waitTime = getLoaderDelay(startTime)

      setTimeout(() => {
        submitButton.disabled = false
        submitButton.classList.remove('loading')
        showAlert('Erro de conexão. Tente novamente', 'error')
      }, waitTime)
    }
  }

  window.handleLogin = handleLogin
})()
