/* ------------------------------ Init tooltips ----------------------------- */

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

let dropdownMenuList = [].slice.call(document.querySelectorAll('.drop-menu'));

dropdownMenuList.forEach((dropdown) => {  
   dropdown.addEventListener('click', (e) => {
      dropdown.querySelector('.drop-me').classList.toggle('show');
   });
});

window.onclick = (e) => {
   if(!e.target.matches('.drop-btn') && !e.target.matches('.drop-btn-icon')) {
      document.querySelectorAll('.drop-me').forEach((drop) => {
         if(drop.classList.contains('show'))
            drop.classList.toggle('show');
      });
   }
}