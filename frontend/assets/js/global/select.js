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
    const hiddenInput = select.querySelector('input[type="hidden"]')
    const searchInput = optionsWrapper.querySelector('.search input')


    list.addEventListener('click', (e) => {
      const option = e.target.closest('.item')
      if (!option) return

      selectedText.textContent = option.textContent
      hiddenInput.value = option.dataset.value || option.textContent

      selected.classList.add('filled')
      selected.classList.remove('active')
      optionsWrapper.classList.remove('active')

      if (searchInput) searchInput.value = ''

      list.querySelectorAll('.item').forEach((opt) => (opt.style.display = ''))

      const noRes = list.querySelector('.no-results')
      if (noRes) noRes.remove()
    })

    // Pesquisa
    if (searchInput) {
      searchInput.addEventListener('input', () => {
        const filter = normalizeText(searchInput.value)
        let visibleCount = 0

        const options = Array.from(list.querySelectorAll('.item'))

        options.forEach((option) => {
          const optionText = normalizeText(option.textContent)
          const match = optionText.includes(filter)

          option.style.display = match ? '' : 'none'
          if (match) visibleCount++
        })

        const oldNoRes = list.querySelector('.no-results')
        if (oldNoRes) oldNoRes.remove()

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
