const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let schedules = [] // todos os bancos carregados
let filteredSchedules = [] // resultado da pesquisa ou ordenação
let currentPage = 1
const rowsPerPage = 5 // máximo de bancos por página

// Carrega bancos do backend
async function loadSchedules() {
  try {
    const response = await fetch('/kwenda/backend/routes/getSchedules.php')
    if (!response.ok) throw new Error('Erro ao carregar bancos')

    schedules = await response.json()
    filteredSchedules = [...schedules]

    renderTablePage(1)
    renderPagination()
  } catch (error) {
    console.error(error)
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center>Erro ao carregar agendamentos</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 agendamentos'
  }
}

// Renderiza a tabela de acordo com a página
function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredSchedules.slice(start, end)

  // Contagem de bancos (singular/plural)
  const count = filteredSchedules.length
  const texto = count === 1 ? '1 agendamento' : `${count} agendamentos`
  document.querySelector('.search-wrapper h3').textContent = texto

  tbody.innerHTML = ''

  if (count === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Nenhum agendamento encontrado</td></tr>`
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
      <td><span class="status ${ag.status === 'pendente' ? 'pending' : 'inactive'}">${ag.status}</span></td>
      <td>
      <div class="actions">
        <button class="open" data-dropdown-toggle="data-${ag.id}">
          <svg><use href="#dots" /></svg>
        </button>

        <div class="options" id="data-${ag.id}">
          <a href="/kwenda/frontend/pages/visualizar-banco/index.php?id=${ag.id}" class="item">
            <svg><use href="#eye" /></svg>
            <span>Visualizar</span>
          </a>
          <button class="item attend-btn" data-id="${ag.id}">
            <svg><use href="#success"/></svg>
            <span>Atender</span>
          </button>
          <button class="item cancel-btn" data-id="${ag.id}">
            <svg><use href="#close" /></svg>
            <span>Cancelar</span>
          </button>
        </div>
      </div>
    </td>
  `
    tbody.appendChild(tr)
  })

  // Atualiza a paginação
  renderPagination()
}

tbody.addEventListener('click', (e) => {
  const attendBtn = e.target.closest('.attend-btn')
  const cancelBtn = e.target.closest('.cancel-btn')

  if (attendBtn) {
    const id = parseInt(attendBtn.dataset.id)
    attendSchedule(id)
    return
  }

  if (cancelBtn) {
    const id = parseInt(cancelBtn.dataset.id)
    cancelSchedule(id)
    return
  }
})

// Renderiza botões de paginação com SVG nas setas
function renderPagination() {
  pagination.innerHTML = '' // limpa botões antigos
  const pageCount = Math.ceil(filteredSchedules.length / rowsPerPage)
  if (pageCount <= 1) return // não mostra se só tiver 1 página

  // Botão "Anterior" com SVG
  const prevBtn = document.createElement('button')
  prevBtn.disabled = currentPage === 1
  prevBtn.innerHTML = `
    <svg>
      <use href="#arrow-left" />
    </svg>
  `
  prevBtn.addEventListener('click', () => renderTablePage(currentPage - 1))
  pagination.appendChild(prevBtn)

  // Botões de páginas
  for (let i = 1; i <= pageCount; i++) {
    const btn = document.createElement('button')
    btn.textContent = i
    if (i === currentPage) btn.classList.add('active')
    btn.addEventListener('click', () => renderTablePage(i))
    pagination.appendChild(btn)
  }

  // Botão "Próximo" com SVG
  const nextBtn = document.createElement('button')
  nextBtn.disabled = currentPage === pageCount
  nextBtn.innerHTML = `
    <svg>
      <use href="#arrow-right" />
    </svg>
  `
  nextBtn.addEventListener('click', () => renderTablePage(currentPage + 1))
  pagination.appendChild(nextBtn)
}

// Atualiza tabela após filtro ou ordenação
function updateFiltered(data) {
  filteredSchedules = data
  renderTablePage(1)
}

// Filtra tabela ao digitar
searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = schedules.filter((ag) => ag.senha.toLowerCase().includes(term) || ag.cliente_nome.toLowerCase().includes(term) || ag.servico_nome.toLowerCase().includes(term) || ag.agencia_nome.toLowerCase().includes(term))
  updateFiltered(filtered)
})

// Ordenação A-Z / Z-A
document.querySelectorAll('.options li').forEach((li) => {
  li.addEventListener('click', () => {
    const order = li.dataset.value
    let sorted = [...filteredSchedules]

    sorted.sort((a, b) => {
      if (order === 'az') return a.nome.localeCompare(b.nome)
      else return b.nome.localeCompare(a.nome)
    })

    updateFiltered(sorted)
  })
})

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

// Inicializa
loadSchedules()
