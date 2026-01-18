const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let appointments = [] // todos os agendamentos carregados
let filteredAppointments = [] // resultado da pesquisa ou ordenação
let currentPage = 1
const rowsPerPage = 8 // máximo de linhas por página

// Carrega agendamentos do backend
async function loadAppointments() {
  try {
    const response = await fetch('/kwenda/backend/routes/getSchedules.php') // seu endpoint de agendamentos
    if (!response.ok) throw new Error('Erro ao carregar agendamentos')

    appointments = await response.json()
    filteredAppointments = [...appointments]

    renderTablePage(1)
    renderPagination()
  } catch (error) {
    console.error(error)
    tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Erro ao carregar agendamentos</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 agendamentos'
  }
}

// Renderiza a tabela de acordo com a página
function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredAppointments.slice(start, end)

  const count = filteredAppointments.length
  const texto = count === 1 ? '1 agendamento' : `${count} agendamentos`
  document.querySelector('.search-wrapper h3').textContent = texto

  tbody.innerHTML = ''

  if (count === 0) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Nenhum agendamento encontrado</td></tr>`
    return
  }

  pageData.forEach((ag) => {
    const tr = document.createElement('tr')
    tr.innerHTML = `
      <td>${ag.senha}</td>
      <td>${ag.cliente_nome}</td>
      <td>${ag.servico_nome}</td>
      <td>${ag.agencia_nome}</td>
      <td>${ag.data_agendamento}</td>
      <td>${ag.status}</td>
    `
    tbody.appendChild(tr)
  })

  renderPagination()
}

// Renderiza botões de paginação
function renderPagination() {
  pagination.innerHTML = ''
  const pageCount = Math.ceil(filteredAppointments.length / rowsPerPage)
  if (pageCount <= 1) return

  const prevBtn = document.createElement('button')
  prevBtn.disabled = currentPage === 1
  prevBtn.textContent = '<'
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
  nextBtn.textContent = '>'
  nextBtn.addEventListener('click', () => renderTablePage(currentPage + 1))
  pagination.appendChild(nextBtn)
}

// Filtro ao digitar (pesquisa por senha, cliente, serviço ou agência)
searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = appointments.filter((ag) => ag.senha.toLowerCase().includes(term) || ag.cliente_nome.toLowerCase().includes(term) || ag.servico_nome.toLowerCase().includes(term) || ag.agencia_nome.toLowerCase().includes(term))
  filteredAppointments = filtered
  renderTablePage(1)
  renderPagination()
})

// Ordenação A-Z / Z-A
document.querySelectorAll('.options li').forEach((li) => {
  li.addEventListener('click', () => {
    const order = li.dataset.value
    let sorted = [...filteredBanks]

    sorted.sort((a, b) => {
      if (order === 'az') return a.nome.localeCompare(b.nome)
      else return b.nome.localeCompare(a.nome)
    })

    updateFiltered(sorted)
  })
})

// Inicializa
loadAppointments()
