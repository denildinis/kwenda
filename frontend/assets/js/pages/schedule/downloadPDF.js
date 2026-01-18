const downloadBtn = document.getElementById('downloadBtn')
const agendamentoId = downloadBtn.dataset.id

if (agendamentoId) {
  downloadBtn.onclick = () => {
    window.open(`/kwenda/backend/routes/comprovativo.php?id=${agendamentoId}`)
  }
} else {
  downloadBtn.disabled = true
}
