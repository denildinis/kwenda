const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let services = [] // todos os bancos carregados
let filteredServices = [] // resultado da pesquisa ou ordenação
let currentPage = 1
const rowsPerPage = 5 // máximo de bancos por página

// Carrega bancos do backend
async function loadServices() {
  try {
    const response = await fetch('/kwenda/backend/routes/getServices.php')
    if (!response.ok) throw new Error('Erro ao carregar serviços')

    services = await response.json()
    filteredServices = [...services]

    renderTablePage(1)
    renderPagination()
  } catch (error) {
    console.error(error)
    tbody.innerHTML = `<tr><td colspan="3 style="text-align:center;">Erro ao carregar serviços</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 serviços cadastrados'
  }
}

// Renderiza a tabela de acordo com a página
function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredServices.slice(start, end)

  // Contagem (singular/plural)
  const count = filteredServices.length
  const texto = count === 1 ? '1 serviço cadastrado' : `${count} serviços cadastrados`
  document.querySelector('.search-wrapper h3').textContent = texto

  tbody.innerHTML = ''

  if (count === 0) {
    tbody.innerHTML = `<tr><td colspan="3" style="text-align:center;">Nenhum serviço encontrado</td></tr>`
    return
  }

  pageData.forEach((service) => {
    const tr = document.createElement('tr')
    tr.innerHTML = `
    <td>${service.codigo}</td>
    <td>${service.nome}</td>
    <td>
      <div class="actions">
        <button class="open" data-dropdown-toggle="data-${service.id}">
          <svg><use href="#dots" /></svg>
        </button>

        <div class="options" id="data-${service.id}">
          <a href="/kwenda/frontend/pages/visualizar-banco/index.php?id=${service.id}" class="item">
            <svg><use href="#eye" /></svg>
            <span>Visualizar</span>
          </a>
          <a href="/kwenda/frontend/pages/editar-banco/index.php?id=${service.id}" class="item">
            <svg><use href="#pencil" /></svg>
            <span>Editar</span>
          </a>
          <button class="item delete" data-id="${service.id}">
            <svg><use href="#trash" /></svg>
            <span>Excluir</span>
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
  const btn = e.target.closest('.delete')
  if (!btn) return

  const id = parseInt(btn.dataset.id)
  confirmDeleteService(id)
})

// Renderiza botões de paginação com SVG nas setas
function renderPagination() {
  pagination.innerHTML = '' // limpa botões antigos
  const pageCount = Math.ceil(filteredServices.length / rowsPerPage)
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
  filteredServices = data
  renderTablePage(1)
}

// Filtra tabela ao digitar
searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = services.filter((service) => service.codigo.toLowerCase().includes(term) || service.nome.toLowerCase().includes(term))
  updateFiltered(filtered)
  renderPagination()
})

// Ordenação A-Z / Z-A
document.querySelectorAll('.options li').forEach((li) => {
  li.addEventListener('click', () => {
    const order = li.dataset.value
    let sorted = [...filteredServices]

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
loadServices()
