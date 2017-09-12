<% loop $LogoDimensions %>
  
  <% if $Breakpoint %>@media (min-width: {$Breakpoint}) {<% end_if %>
    
    {$CSSID} img.navbar-brand-logo {
      width: {$Width}px;
      height: {$Height}px;
    }
    
  <% if $Breakpoint %>}<% end_if %>
  
<% end_loop %>
