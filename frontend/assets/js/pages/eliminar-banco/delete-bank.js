async function deleteBank(id) {

  try {
    const response = await fetch('/kwenda/backend/routes/deleteBank.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })

    const result = await response.json()

    if (result.success) {
      showAlert(result.message, 'success')

      banks = banks.filter((b) => b.id !== id)
      filteredBanks = filteredBanks.filter((b) => b.id !== id)

      renderTablePage(currentPage)
    } else {
      showAlert(result.message, 'error')
    }
  } catch (error) {
    console.error(error)
    showAlert('Erro de conexão', 'error')
  }
}
function confirmDeleteBank(id) {
  openConfirmModal({
    title: 'Eliminar banco',
    message: 'Tem certeza que deseja eliminar este banco?',
    onConfirm: () => deleteBank(id)
  })
}
