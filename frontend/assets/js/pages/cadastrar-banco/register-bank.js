;(() => {
  const areFieldsFilled = (...fields) => fields.every((field) => field !== '')
  const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
  const isPasswordValid = (password) => password.length >= 8
  const getLoaderDelay = (startTime, minimum = 500) => {
    const elapsed = Date.now() - startTime
    return elapsed < minimum ? minimum - elapsed : 0
  }

  async function registerBank(event) {
    event.preventDefault()

    const form = event.target
  
    const fileInput = form.querySelector('#photoInput')
    const submitButton = form.querySelector('button[type="submit"]')

    const name = form.querySelector('#name').value.trim()
    const acronym = form.querySelector('#acronym').value.trim()
    const email = form.querySelector('#email').value.trim().toLowerCase()
    const password = form.querySelector('#password').value.trim()

    if (!areFieldsFilled(name, acronym, email, password)) {
      showAlert('Preencha todos os campos', 'error')
      return
    }
    if (!isValidEmail(email)) {
      showAlert('Formato de e-mail inválido', 'error')
      return
    }
    if (!isPasswordValid(password)) {
      showAlert('Senha mínima 8 caracteres', 'error')
      return
    }

    submitButton.disabled = true
    submitButton.classList.add('loading')

    const startTime = Date.now()

    const formData = new FormData()
    formData.append('name', name)
    formData.append('acronym', acronym)
    formData.append('email', email)
    formData.append('password', password)
    if (fileInput?.files?.length > 0) {
      formData.append('photo', fileInput.files[0])
    }

    try {
      const response = await fetch('../../../backend/routes/registerBank.php', {
        method: 'POST',
        body: formData
      })

      const result = await response.json()
      const waitTime = getLoaderDelay(startTime)

      setTimeout(() => {
        submitButton.disabled = false
        submitButton.classList.remove('loading')

        if (result.success) {
          showAlert('Banco cadastrado com sucesso', 'success')
          form.reset()
          const photo = form.querySelector('.photo')
          const photoPreview = form.querySelector('#photoPreview')

          if (photo) {
            photo.style.backgroundImage = "url('/kwenda/frontend/assets/images/placeholder.png')"
          }

          if (photoPreview) {
            photoPreview.src = ''
          }
        } else {
          setTimeout(() => {
            submitButton.disabled = false
            submitButton.classList.remove('loading')
            showAlert(result.message, 'error')
          }, waitTime)
        }
      }, waitTime)
    } catch (error) {
      console.error(error)
      const waitTime = getLoaderDelay(startTime)
      setTimeout(() => {
        submitButton.disabled = false
        submitButton.classList.remove('loading')
        showAlert('Erro de conexão. Tente novamente', 'error')
      }, waitTime)
    }
  }

  // Limpa o formulário e desativa o loader quando a página carrega
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form')
    const submitButton = form?.querySelector('button[type="submit"]')

    if (form && typeof form.reset === 'function') form.reset()

    if (submitButton) {
      submitButton.disabled = false
      submitButton.classList.remove('loading')
    }
  })

  // Evita cache e recarrega se a página voltar do histórico
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      window.location.reload()
    }
  })

  window.registerBank = registerBank
})()
