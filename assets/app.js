
// Ajouter la classe à la nav au scroll
const navbar = document.querySelector("nav");

window.onscroll = () => {
  window.scrollY > 20 ? navbar.classList.add("navScroll") : navbar.classList.remove("navScroll");
}
// Toggle du menu burger
burger.addEventListener("click", () => {
  navbar.classList.toggle("active")
})


// Agrandir/Rétrécir la carte service onClick
window.toggleExpand = function(e) {
  let triggerService = e.closest('.service');
  let allServices = document.querySelectorAll('.service');

  allServices.forEach(function(service) {

    if (service !== triggerService) {
      service.classList.remove('expanded');
      service.classList.add('minimized');
    } else {
      service.classList.toggle('expanded')
      service.classList.remove('minimized')
      service.querySelector('.showMore').textContent = service.classList.contains('expanded') ? 'Réduire' : 'En apprendre plus';
    }

  });

  if (!Array.from(allServices).some(service => service.classList.contains('expanded'))) {
    allServices.forEach(function(service) {
      service.classList.remove('minimized');
    });
  }
};

// Ajouter une classe invalid pour le formulaire
document.querySelectorAll('.formDefault input, .formDefault textarea').forEach(input => {
  input.addEventListener('blur', function() {
      if (!input.checkValidity() && input.value.trim() !== '') {
        input.classList.add('invalid');
        input.classList.remove('valid')
      } 
      else if (input.classList.contains('invalid') && input.checkValidity()){
        input.classList.remove('invalid');
        input.classList.add('valid')
      }
      else if (input.checkValidity() && !input.classList.contains('invalid')){
        input.classList.add('valid')
      } else {
        input.classList.remove('valid');
    }
  });
});
