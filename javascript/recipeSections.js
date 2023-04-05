const recipes = document.querySelectorAll('.recipe'),
    categoryBtns = document.querySelectorAll('#section button')

// Loop through each category button and add a click event listener
categoryBtns.forEach(button => {
  button.addEventListener('click', () => {
    // Get the category name from the button's id
    const category = button.id.toLowerCase()

    // Handles the active class
    categoryBtns.forEach(btns => {
        if (btns.id != button.id) {
            btns.classList.remove('active')
        }
    })
    button.classList.add('active')

    // Loop through each recipe element and hide/show based on category
    recipes.forEach(recipe => {
      if (recipe.querySelector('#category').textContent.toLowerCase() === category || category === 'all') {
        recipe.style.display = 'block'
      } else {
        recipe.style.display = 'none'
      }
    })
  })
})