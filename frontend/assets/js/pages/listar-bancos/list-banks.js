const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let banks = []
let filteredBanks = []
let currentPage = 1
const rowsPerPage = 5

async function loadBanks() {
  try {
    const response = await fetch('/kwenda/backend/routes/getBanks.php')
    if (!response.ok) throw new Error('Erro ao carregar bancos')

    banks = await response.json()
    filteredBanks = [...banks]

    renderTablePage(1)
    renderPagination()
  } catch (error) {
    console.error(error)
    tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;">Erro ao carregar bancos</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 bancos cadastrados'
  }
}

function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredBanks.slice(start, end)

  const count = filteredBanks.length
  const texto = count === 1 ? '1 banco cadastrado' : `${count} bancos cadastrados`
  document.querySelector('.search-wrapper h3').textContent = texto

  tbody.innerHTML = ''

  if (count === 0) {
    tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;">Nenhum banco encontrado</td></tr>`
    return
  }

  pageData.forEach((bank) => {
    const tr = document.createElement('tr')

    tr.innerHTML = `
      <td>
        <div style="display:flex;align-items:center;gap:10px;">
          <img
            class="photo"
            src="/kwenda/frontend/assets/uploads/banks/${bank.logo}"
            alt="${bank.nome}"
          >
          ${bank.nome}
        </div>
      </td>
      <td>${bank.sigla}</td>
      <td>${bank.email}</td>
      <td>
        <div class="actions">
          <button class="open" data-dropdown-toggle="data-${bank.id}">
            <svg><use href="#dots" /></svg>
          </button>

          <div class="options" id="data-${bank.id}">
            <a href="/kwenda/frontend/pages/visualizar-banco/index.php?id=${bank.id}" class="item">
              <svg><use href="#eye" /></svg>
              <span>Visualizar</span>
            </a>

            <a href="/kwenda/frontend/pages/editar-banco/index.php?id=${bank.id}" class="item">
              <svg><use href="#pencil" /></svg>
              <span>Editar</span>
            </a>

            <button class="item delete" data-id="${bank.id}">
              <svg><use href="#trash" /></svg>
              <span>Excluir</span>
            </button>
          </div>
        </div>
      </td>
    `

    tbody.appendChild(tr)
  })

  renderPagination()
}

tbody.addEventListener('click', (e) => {
  const btn = e.target.closest('.delete')
  if (!btn) return

  const id = parseInt(btn.dataset.id)
  confirmDeleteBank(id)
})

function renderPagination() {
  pagination.innerHTML = ''
  const pageCount = Math.ceil(filteredBanks.length / rowsPerPage)
  if (pageCount <= 1) return

  const prevBtn = document.createElement('button')
  prevBtn.disabled = currentPage === 1
  prevBtn.innerHTML = `<svg><use href="#arrow-left" /></svg>`
  prevBtn.addEventListener('click', () => renderTablePage(currentPage - 1))
  pagination.appendChild(prevBtn)

  for (let i = 1; i <= pageCount; i++) {
    const btn = document.createElement('button')
    btn.textContent = i
    if (i === currentPage) btn.classList.add('active')
    btn.addEventListener('click', () => renderTablePage(i))
    pagination.appendChild(btn)
  }

  const nextBtn = document.createElement('button')
  nextBtn.disabled = currentPage === pageCount
  nextBtn.innerHTML = `<svg><use href="#arrow-right" /></svg>`
  nextBtn.addEventListener('click', () => renderTablePage(currentPage + 1))
  pagination.appendChild(nextBtn)
}

searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = banks.filter((bank) => bank.nome.toLowerCase().includes(term) || bank.sigla.toLowerCase().includes(term) || bank.email.toLowerCase().includes(term))

  filteredBanks = filtered
  renderTablePage(1)
})

function confirmDeleteBank(id) {
  openConfirmModal({
    title: 'Eliminar banco',
    message: 'Tem certeza que deseja eliminar este banco?',
    onConfirm: () => deleteBank(id)
  })
}

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

document.addEventListener('click', (e) => {
  const actionBtn = e.target.closest('.actions .open')

  if (!actionBtn) {
    document.querySelectorAll('tbody tr.selected').forEach((tr) => tr.classList.remove('selected'))
    return
  }

  const tr = actionBtn.closest('tr')

  document.querySelectorAll('tbody tr.selected').forEach((row) => {
    if (row !== tr) row.classList.remove('selected')
  })

  tr.classList.toggle('selected')
})

loadBanks()
