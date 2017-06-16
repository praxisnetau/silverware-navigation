/* Inline Navigation
===================================================================================================================== */

import $ from 'jquery';

$.entwine('silverware.inlinenavigation', function($) {
  
  // Handle Inline Navigation Fields:
  
  $('.tabset.silverware-navigation-components-inlinenavigation').entwine({
    
    onmatch: function() {
      this.handleLinkMode();
      this._super();
    },
    
    onchange: function(e) {
      this.handleLinkMode();
      this._super(e);
    },
    
    handleLinkMode: function() {
      var mode = this.getLinkModeField().val();
      if (mode == 'pages') {
        this.getPagesHolder().show();
      } else {
        this.getPagesHolder().hide();
      }
    },
    
    getLinkModeField: function() {
      return $(this).find('#Form_EditForm_LinkMode');
    },
    
    getPagesHolder: function() {
      return $(this).find('#Form_EditForm_LinkedPages_Holder');
    }
    
  });
  
});
