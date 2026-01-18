async function cancelSchedule(id) {
  try {
    const response = await fetch('/kwenda/backend/routes/cancelSchedule.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })

    const result = await response.json()

    if (result.success) {
      showAlert(result.message, 'success')
      loadSchedules()
    } else {
      showAlert(result.message, 'error')
    }
  } catch (error) {
    showAlert('Erro de conexão', 'error')
    console.error(error)
  }
}
