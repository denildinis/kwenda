const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let banks = [] // todos os bancos carregados
let filteredBanks = [] // resultado da pesquisa ou ordenação
let currentPage = 1
const rowsPerPage = 6 // máximo de bancos por página

// Carrega bancos do backend
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
    tbody.innerHTML = `<tr><td colspan="4">Erro ao carregar bancos</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 bancos cadastrados'
  }
}

// Renderiza a tabela de acordo com a página
function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredBanks.slice(start, end)

  // Contagem de bancos (singular/plural)
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
      <td>${bank.nome}</td>
      <td>${bank.sigla}</td>
      <td>${bank.email}</td>
      <td>
       <div class="actions">
      <button class="open" data-dropdown-toggle="data-${bank.id}">
        <svg>
          <use href="#dots" />
        </svg>
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
        <a href="/kwenda/backend/routes/excluir-banco.php?id=${bank.id}" class="item">
          <svg><use href="#trash" /></svg>
          <span>Excluir</span>
        </a>
      </div>
    </div>
      </td>
    `
    tbody.appendChild(tr)
  })

  // Atualiza a paginação
  renderPagination()
}

// Renderiza botões de paginação com SVG nas setas
function renderPagination() {
  pagination.innerHTML = '' // limpa botões antigos
  const pageCount = Math.ceil(filteredBanks.length / rowsPerPage)
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
  filteredBanks = data
  renderTablePage(1)
}

// Filtra tabela ao digitar
searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = banks.filter((bank) => bank.nome.toLowerCase().includes(term) || bank.sigla.toLowerCase().includes(term) || bank.email.toLowerCase().includes(term))
  updateFiltered(filtered)
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
loadBanks()
