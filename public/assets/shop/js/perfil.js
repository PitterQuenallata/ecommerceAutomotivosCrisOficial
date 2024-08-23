$(document).ready(function() {
  var $menuItems = $('.listaPerfilSelect');
  var $sections = $('.account__wrapper > div');

  $menuItems.on('click', function(event) {
      event.preventDefault();

      // Remove active class from all menu items
      $menuItems.removeClass('active');

      // Add active class to the clicked menu item
      $(this).addClass('active');

      // Hide all sections
      $sections.hide();

      // Show the clicked section based on the index
      var index = $(this).index('.listaPerfilSelect');
      $sections.eq(index).show();
  });

  // Optionally, show the first section by default
  $sections.hide().first().show();
});
