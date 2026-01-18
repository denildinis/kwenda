;(() => {
  document.addEventListener('click', (e) => {
    const toggle = e.target.closest('[data-dropdown-toggle]')
    const optionItem = e.target.closest('.options .item')
    const insideOptions = e.target.closest('.options')

    if (toggle) {
      e.stopPropagation()

      const dropdownId = toggle.dataset.dropdownToggle
      const dropdown = document.getElementById(dropdownId)
      if (!dropdown) return

      // Fecha outros dropdowns
      document.querySelectorAll('.options').forEach((d) => {
        if (d !== dropdown) d.classList.remove('active')
      })
      document.querySelectorAll('[data-dropdown-toggle]').forEach((t) => t !== toggle && t.classList.remove('active'))

      // Abre/fecha o atual
      const isActive = toggle.classList.toggle('active')
      dropdown.classList.toggle('active', isActive)
      return
    }

    // Clique num item (fecha dropdown)
    if (optionItem) {
      const dropdown = optionItem.closest('.options')
      const toggle = document.querySelector(`[data-dropdown-toggle="${dropdown.id}"]`)

      dropdown.classList.remove('active')
      toggle?.classList.remove('active')
      return
    }

    // Clique dentro do dropdown (input, scroll, search)
    if (insideOptions) {
      return // NÃO FECHA
    }

    // Clique fora de tudo
    document.querySelectorAll('.options').forEach((d) => d.classList.remove('active'))
    document.querySelectorAll('[data-dropdown-toggle]').forEach((t) => t.classList.remove('active'))
  })
})()
