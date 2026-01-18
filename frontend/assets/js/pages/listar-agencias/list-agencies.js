const tbody = document.getElementById('tableBody')
const searchInput = document.getElementById('searchInput')
const pagination = document.querySelector('.pagination')

let agencies = [] // todos os bancos carregados
let filteredAgencies = [] // resultado da pesquisa ou ordenação
let currentPage = 1
const rowsPerPage = 8 // máximo de bancos por página

// Carrega bancos do backend
async function loadAgencies() {
  try {
    const response = await fetch('/kwenda/backend/routes/getAgencies.php')
    if (!response.ok) throw new Error('Erro ao carregar bancos')

    agencies = await response.json()
    filteredAgencies = [...agencies]

    renderTablePage(1)
    renderPagination()
  } catch (error) {
    console.error(error)
    tbody.innerHTML = `<tr><td colspan="4" style="text-align:center>Erro ao carregar agências</td></tr>`
    document.querySelector('.search-wrapper h3').textContent = '0 agências cadastrados'
  }
}

// Renderiza a tabela de acordo com a página
function renderTablePage(page) {
  currentPage = page
  const start = (page - 1) * rowsPerPage
  const end = start + rowsPerPage
  const pageData = filteredAgencies.slice(start, end)

  // Contagem de bancos (singular/plural)
  const count = filteredAgencies.length
  const texto = count === 1 ? '1 agência cadastrado' : `${count} agências cadastrados`
  document.querySelector('.search-wrapper h3').textContent = texto

  tbody.innerHTML = ''

  if (count === 0) {
    tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;">Nenhum agência encontrado</td></tr>`
    return
  }

  pageData.forEach((agencie) => {
    const tr = document.createElement('tr')
    tr.innerHTML = `
    <td>${agencie.nome}</td>
    <td>${agencie.provincia}</td>
    <td>${agencie.municipio}</td>
    <td>${agencie.bairro}</td>
    <td>
      <div class="actions">
        <button class="open" data-dropdown-toggle="data-${agencie.id}">
          <svg><use href="#dots" /></svg>
        </button>

        <div class="options" id="data-${agencie.id}">
          <a href="/kwenda/frontend/pages/visualizar-banco/index.php?id=${agencie.id}" class="item">
            <svg><use href="#eye" /></svg>
            <span>Visualizar</span>
          </a>
          <a href="/kwenda/frontend/pages/editar-banco/index.php?id=${agencie.id}" class="item">
            <svg><use href="#pencil" /></svg>
            <span>Editar</span>
          </a>
          <a href="/kwenda/backend/routes/excluir-banco.php?id=${agencie.id}" class="item delete">
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
  const pageCount = Math.ceil(filteredAgencies.length / rowsPerPage)
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
  filteredAgencies = data
  renderTablePage(1)
}

// Filtra tabela ao digitar
searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase()
  const filtered = agencies.filter((agencie) => agencie.nome.toLowerCase().includes(term) || agencie.provincia.toLowerCase().includes(term) || agencie.municipio.toLowerCase().includes(term) || agencie.bairro.toLowerCase().includes(term))
  updateFiltered(filtered)
})

// Ordenação A-Z / Z-A
document.querySelectorAll('.options li').forEach((li) => {
  li.addEventListener('click', () => {
    const order = li.dataset.value
    let sorted = [...filteredAgencies]

    sorted.sort((a, b) => {
      if (order === 'az') return a.nome.localeCompare(b.nome)
      else return b.nome.localeCompare(a.nome)
    })

    updateFiltered(sorted)
  })
})

// Inicializa
loadAgencies()
