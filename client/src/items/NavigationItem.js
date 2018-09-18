/* Navigation Item
===================================================================================================================== */

import $ from 'jquery';

$(function() {
  
  // Handle Multi-Level Navigation Items:
  
  $('.navigationitem.multi-level').each(function() {
    
    var $self = $(this);
    
    // Handle Click Event:
    
    $self.find('.dropdown-menu a.dropdown-toggle').on('click', function() {
      
      var $self   = $(this);
      var $parent = $self.offsetParent('.dropdown-menu');
      
      if (!$self.next().hasClass('show')) {
        $self.parents('.dropdown-menu').first().find('.show').removeClass('show');
      }
      
      var $subMenu = $self.next('.dropdown-menu');
      
      $subMenu.toggleClass('show');
      
      $self.parent('li').toggleClass('show');
      
      $self.parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function() {
        $('.dropdown-menu .show').removeClass('show');
      });
      
      if (!$parent.parent().hasClass('navigationitem')) {
        
        // Offset Submenus:
        
        $self.next().css({
          'top': ($self[0].offsetTop - 8),
          'left': ($parent.outerWidth() - 5)
        });
        
      }
      
      return false;
      
    });
    
  });
  
});
