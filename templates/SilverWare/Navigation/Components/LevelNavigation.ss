<nav class="$WrapperClass">
  <% if $CurrentLevel %>
    <ul class="$ListClass">
      <% loop $CurrentLevel %>
        <li class="$LinkingMode">{$Up.FontIconTag}<a href="$Link" title="$MenuTitle">$MenuTitle</a></li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
