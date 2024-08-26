$(document).ready(function() {
  var $menuItems = $('.listaPerfilSelect');

  $menuItems.on('click', function(event) {
      //event.preventDefault();

      // Remove active class from all menu items
      $menuItems.removeClass('active');

      // Add active class to the clicked menu item
      $(this).addClass('active');
  });

  // Detect if the URL contains a specific section (e.g., "orden")
  if (window.location.href.includes('orden')) {
      $menuItems.removeClass('active'); // Remove active from all
      $('.listaPerfilSelect:contains("Ordenes")').addClass('active'); // Add active to the correct item
  } else if (window.location.href.includes('perfil')) {
      $menuItems.removeClass('active'); // Remove active from all
      $('.listaPerfilSelect:contains("Cuenta")').addClass('active'); // Add active to the correct item
  } else if (window.location.href.includes('direcciones')) {
      $menuItems.removeClass('active'); // Remove active from all
      $('.listaPerfilSelect:contains("direcciones")').addClass('active'); // Add active to the correct item
  }
});
