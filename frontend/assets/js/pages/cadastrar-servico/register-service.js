;(() => {
  // Função para verificar se todos os campos estão preenchidos
  const areFieldsFilled = (...fields) => fields.every((field) => field !== '')

  // Função para calcular delay mínimo do loader
  const getLoaderDelay = (startTime, minimum = 500) => {
    const elapsed = Date.now() - startTime
    return elapsed < minimum ? minimum - elapsed : 0
  }

  // Função principal para registrar o serviço
  async function registerService(event) {
    event.preventDefault()

    const form = event.target
    const submitButton = form.querySelector('button[type="submit"]')

    const service_code = form.service_code.value.trim()
    const service_name = form.service_name.value.trim()

    if (!areFieldsFilled(service_code, service_name)) {
      showAlert('Preencha todos os campos', 'error')
      return
    }

    submitButton.disabled = true
    submitButton.classList.add('loading')

    const startTime = Date.now()

    const payload = {
      service_code,
      service_name
    }

    try {
      const response = await fetch('/kwenda/backend/routes/registerService.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })

      const result = await response.json()
      const waitTime = getLoaderDelay(startTime)

      if (result.success) {
        setTimeout(() => {
          submitButton.disabled = false
          submitButton.classList.remove('loading')
          showAlert('Serviço cadastrado com sucesso', 'success')
         form.reset()
        }, waitTime)
      } else {
        setTimeout(() => {
          submitButton.disabled = false
          submitButton.classList.remove('loading')
          showAlert(result.message, 'error')
        }, waitTime)
      }
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

  // Expõe a função globalmente para usar no onsubmit
  window.registerService = registerService
})()
