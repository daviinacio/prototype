function updateAbasSelection(){
  document.querySelectorAll('.AbaSelection').forEach(selection => {
    selection.parentElement.className = 
      selection.classList.contains("active") ? "active" : "";
  })
}

setInterval(updateAbasSelection, 100)
document.addEventListener('DOMContentLoaded', updateAbasSelection)