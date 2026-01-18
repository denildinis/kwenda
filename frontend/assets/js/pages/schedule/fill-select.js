document.addEventListener('DOMContentLoaded', async () => {
  const bankInput = document.getElementById('bank')
  const agencyInput = document.getElementById('agency')
  const serviceInput = document.getElementById('service')

  const bankList = document.querySelector('#data-bank .list')
  const agencyList = document.querySelector('#data-agency .list')
  const serviceList = document.querySelector('#data-service .list')

  const banks = await fetch('/kwenda/backend/routes/getBanks.php')
    .then((res) => res.json())
    .catch(() => [])

  bankList.innerHTML = banks.length ? banks.map((b) => `<li class="item" data-value="${b.id}">${b.sigla}</li>`).join('') : `<li class="item disabled">Nenhum banco disponível</li>`

  document.querySelector('#data-bank').addEventListener('click', async (e) => {
    if (!e.target.classList.contains('item')) return

    const bankId = e.target.dataset.value
    bankInput.value = bankId
    e.target.closest('.select').querySelector('.selected .text').textContent = e.target.textContent
    const agencies = await fetch(`/kwenda/backend/routes/fillAgencies.php?bank_id=${bankId}`)
      .then((res) => res.json())
      .catch(() => [])

    agencyList.innerHTML = agencies.length ? agencies.map((a) => `<li class="item" data-value="${a.id}">${a.nome}</li>`).join('') : `<li class="item disabled">Nenhuma agência disponível</li>`

    const services = await fetch(`/kwenda/backend/routes/fillServices.php?bank_id=${bankId}`)
      .then((res) => res.json())
      .catch(() => [])

    serviceList.innerHTML = services.length ? services.map((s) => `<li class="item" data-value="${s.id}">${s.nome}</li>`).join('') : `<li class="item disabled">Nenhum serviço disponível</li>`
  })

  document.querySelector('#data-agency').addEventListener('click', (e) => {
    if (!e.target.classList.contains('item')) return

    agencyInput.value = e.target.dataset.value
    e.target.closest('.select').querySelector('.selected .text').textContent = e.target.textContent
  })

  document.querySelector('#data-service').addEventListener('click', (e) => {
    if (!e.target.classList.contains('item')) return

    serviceInput.value = e.target.dataset.value
    e.target.closest('.select').querySelector('.selected .text').textContent = e.target.textContent
  })
})
