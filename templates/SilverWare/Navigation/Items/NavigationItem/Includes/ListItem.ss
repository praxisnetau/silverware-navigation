<li class="$ListItem.ItemClass">
  <a href="<% if $ListItem.HashLink %>#<% else %>$Link<% end_if %>" class="$ListItem.LinkClass" title="$MenuTitle"<% if $ListItem.Dropdown %> id="$ListItem.DropdownID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<% end_if %>>$MenuTitle</a>
  <% if $ListItem.Dropdown %>
    <ul class="$ListItem.MenuClass" aria-labelledby="$ListItem.DropdownID">
      <% include SilverWare\Navigation\Items\NavigationItem\Dropdown NavigationItem=$NavigationItem, ListItem=$ListItem %>
    </ul>
  <% end_if %>
</li>
