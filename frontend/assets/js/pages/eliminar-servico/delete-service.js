async function deleteService(id) {
  try {
    const response = await fetch('/kwenda/backend/routes/deleteService.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })

    const result = await response.json()

    if (result.success) {
      showAlert(result.message, 'success')

      services = services.filter((s) => s.id !== id)
      filteredServices = filteredServices.filter((s) => s.id !== id)

      renderTablePage(currentPage)
    } else {
      showAlert(result.message, 'error')
    }
  } catch (error) {
    console.error(error)
    showAlert('Erro de conexão. Tente novamente', 'error')
  }
}

function confirmDeleteService(id) {
  openConfirmModal({
    title: 'Eliminar serviço',
    message: 'Tem certeza que deseja eliminar este banco?',
    onConfirm: () => deleteService(id)
  })
}
