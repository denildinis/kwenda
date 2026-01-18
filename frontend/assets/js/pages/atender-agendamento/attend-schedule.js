function announcePassword(senha) {
  // Cria mensagem falada
  const msg = new SpeechSynthesisUtterance(`Senha ${senha}, dirija-se ao balcão`)

  // Configura voz (opcional)
  msg.lang = 'pt'
  msg.rate = 0.5 // velocidade normal
  msg.pitch = 1 // tom normal

  // Executa fala
  window.speechSynthesis.speak(msg)
}

async function attendSchedule(id) {
  try {
    const response = await fetch('/kwenda/backend/routes/attendSchedule.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })

    const result = await response.json()

    if (result.success) {
      announcePassword(result.senha)
      loadSchedules()
    } else {
      showAlert(result.message, 'error')
    }
  } catch (err) {
    showAlert('Erro de conexão', 'error')
    console.error(err)
  }
}
