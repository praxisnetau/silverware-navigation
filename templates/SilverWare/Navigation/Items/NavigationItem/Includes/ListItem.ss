<li class="$ListItem.ItemClass">
  <a href="$Link" class="$ListItem.LinkClass" title="$MenuTitle"<% if $ListItem.Dropdown %> id="$ListItem.DropdownID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<% end_if %>>$MenuTitle</a>
  <% if $ListItem.Dropdown %>
    <div class="$ListItem.MenuClass" aria-labelledby="$ListItem.DropdownID">
      <% loop $MainMenuChildren %>
        <a href="$Link" class="$Up.Item.getMenuLinkClass($LinkingMode)" title="$MenuTitle">$MenuTitle</a>
      <% end_loop %>
    </div>
  <% end_if %>
</li>
