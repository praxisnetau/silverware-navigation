<nav class="$WrapperClass">
  <% loop $Crumbs %>
    <% if $Last %>
      <span class="$Up.ActiveClass">$MenuTitle</span>
    <% else %>
      <% if $Up.Unlinked %>
        <span class="$Up.ItemClass">$MenuTitle</span>
      <% else %>
        <a href="$Link" class="$Up.ItemClass">$MenuTitle</a>
      <% end_if %>
    <% end_if %>
  <% end_loop %>
</nav>
