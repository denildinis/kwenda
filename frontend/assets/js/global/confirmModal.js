let confirmCallback = null

function openConfirmModal({ title = 'Confirmação', message = 'Tem certeza que deseja continuar?', onConfirm }) {
  confirmCallback = onConfirm

  document.getElementById('confirmTitle').textContent = title
  document.getElementById('confirmMessage').textContent = message

  document.getElementById('confirmModal').classList.remove('hidden')
}

function closeConfirmModal() {
  confirmCallback = null
  document.getElementById('confirmModal').classList.add('hidden')
}

// Botões
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('confirmCancel').addEventListener('click', closeConfirmModal)

  document.getElementById('confirmOk').addEventListener('click', () => {
    if (typeof confirmCallback === 'function') {
      confirmCallback()
    }
    closeConfirmModal()
  })
})
