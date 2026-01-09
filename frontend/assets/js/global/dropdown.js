document.addEventListener('DOMContentLoaded', () => {
  const dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]')

  dropdownToggles.forEach((toggle) => {
    const dropdownId = toggle.getAttribute('data-dropdown-toggle')
    const dropdown = document.getElementById(dropdownId)
    if (!dropdown) return

    toggle.addEventListener('click', (e) => {
      e.stopPropagation()
      closeAllDropdowns(dropdown)
      toggle.classList.toggle('active')
      dropdown.classList.toggle('active')
    })

    dropdown.addEventListener('click', (e) => {
      e.stopPropagation()
      const item = e.target.closest('.item')
      if (!item) return
      toggle.classList.remove('active')
      dropdown.classList.remove('active')
    })
  })

  document.addEventListener('click', () => closeAllDropdowns())

  function closeAllDropdowns(exceptDropdown = null) {
    document.querySelectorAll('.options').forEach((dropdown) => {
      if (dropdown !== exceptDropdown) dropdown.classList.remove('active')
    })
    document.querySelectorAll('[data-dropdown-toggle]').forEach((toggle) => {
      if (!exceptDropdown || toggle.getAttribute('data-dropdown-toggle') !== exceptDropdown.id) {
        toggle.classList.remove('active')
      }
    })
  }
})
