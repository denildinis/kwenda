;(() => {
  const areFieldsFilled = (...fields) => fields.every((field) => field !== '')

  const getLoaderDelay = (startTime, minimum = 500) => {
    const elapsed = Date.now() - startTime
    return elapsed < minimum ? minimum - elapsed : 0
  }

  // Validação completa da data
  const isValidDate = (dateValue) => {
    const selectedDate = new Date(dateValue)
    const today = new Date()

    // Normalizar horas
    today.setHours(0, 0, 0, 0)
    selectedDate.setHours(0, 0, 0, 0)

    const currentYear = today.getFullYear()
    const selectedYear = selectedDate.getFullYear()
    const dayOfWeek = selectedDate.getDay() // 0 = Domingo | 6 = Sábado

    // Ano diferente
    if (selectedYear !== currentYear) return false

    // Data passada
    if (selectedDate < today) return false

    // Sábado ou Domingo
    if (dayOfWeek === 0 || dayOfWeek === 6) return false

    return true
  }

  async function schedule(event) {
    event.preventDefault()

    const form = event.target
    const submitButton = form.querySelector('button[type="submit"]')

    const bank = form.bank.value.trim()
    const agency = form.agency.value.trim()
    const service = form.service.value.trim()
    const date = form.date.value.trim()
    const name = form.name.value.trim()

    if (!areFieldsFilled(bank, agency, service, date, name)) {
      showAlert('Preencha todos os campos', 'error')
      return
    }

    if (!isValidDate(date)) {
      showAlert('Escolha um dia útil do ano actual (segunda a sexta)', 'error')
      return
    }

    submitButton.disabled = true
    submitButton.classList.add('loading')

    const startTime = Date.now()

    const payload = {
      bank,
      agency,
      service,
      date,
      name
    }

    try {
      const response = await fetch('/kwenda/backend/routes/schedule.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })

      const result = await response.json()
      const waitTime = getLoaderDelay(startTime)

      setTimeout(() => {
        submitButton.disabled = false
        submitButton.classList.remove('loading')

        if (result.success) {
          window.location.href = `/kwenda/frontend/pages/sucesso/index.php?id=${result.id}`
          form.reset()
        } else {
          showAlert(result.message, 'error')
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

  // Bloqueia sábado e domingo ao escolher a data
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form')
    const submitButton = form?.querySelector('button[type="submit"]')
    const dateInput = document.getElementById('date')

    if (form && typeof form.reset === 'function') form.reset()

    if (submitButton) {
      submitButton.disabled = false
      submitButton.classList.remove('loading')
    }
  })

  // Evita cache ao voltar no navegador
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      window.location.reload()
    }
  })

  window.schedule = schedule
})()
