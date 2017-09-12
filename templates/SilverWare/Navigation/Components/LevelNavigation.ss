<nav class="$WrapperClass">
  <% if $CurrentLevel %>
    <ul class="$ListClass">
      <% loop $CurrentLevel %>
        <li class="$LinkingMode">
          {$Up.FontIconTag}<a href="$Link" title="$MenuTitle">$MenuTitle</a>
          <% if $Up.ShowCount %>
            <span class="count">($AllChildren.Count)</span>
          <% end_if %>
        </li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
