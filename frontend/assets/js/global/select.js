;(() => {
  const normalizeText = (text) =>
    text
      .toLowerCase()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .trim()

  const selects = document.querySelectorAll('.select')

  selects.forEach((select) => {
    const selected = select.querySelector('.selected')
    const selectedText = selected.querySelector('.text')
    const optionsWrapper = select.querySelector('.options')
    const list = optionsWrapper.querySelector('.list')
    const options = Array.from(list.querySelectorAll('.item'))
    const hiddenInput = select.querySelector('input[type="hidden"]')
    const searchInput = optionsWrapper.querySelector('.search input')

    /* Selecionar opção */
    options.forEach((option) => {
      option.addEventListener('click', () => {
        selectedText.textContent = option.textContent
        hiddenInput.value = option.dataset.value

        selected.classList.add('filled')
        selected.classList.remove('active')
        optionsWrapper.classList.remove('active')

        if (searchInput) searchInput.value = ''

        options.forEach((opt) => (opt.style.display = ''))
        const noRes = list.querySelector('.no-results')
        if (noRes) noRes.remove()
      })
    })

    /* Pesquisa */
    if (searchInput) {
      searchInput.addEventListener('input', () => {
        const filter = normalizeText(searchInput.value)
        let visibleCount = 0

        options.forEach((option) => {
          const optionText = normalizeText(option.textContent)
          const match = optionText.includes(filter)

          option.style.display = match ? '' : 'none'
          if (match) visibleCount++
        })

        let noRes = list.querySelector('.no-results')
        if (noRes) noRes.remove()

        if (visibleCount === 0) {
          const li = document.createElement('li')
          li.className = 'no-results'
          li.textContent = 'Sem resultados'
          list.appendChild(li)
        }
      })
    }
  })
})()
