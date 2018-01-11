<li class="$ListItem.ItemClass">
  <a href="<% if $ListItem.HashLink %>#<% else %>$Link<% end_if %>" class="$ListItem.LinkClass" title="$MenuTitle"<% if $ListItem.Dropdown %> id="$ListItem.DropdownID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<% end_if %>>$MenuTitle</a>
  <% if $ListItem.Dropdown %>
    <div class="$ListItem.MenuClass" aria-labelledby="$ListItem.DropdownID">
      <% if $Item.AddTopLinkToSub %>
        <a href="$Link" class="$Item.getMenuLinkClass($LinkingMode, true)" title="$MenuTitle">$MenuTitle</a>
        <% if $Item.ShowDivider %><div class="$Item.DividerClass"></div><% end_if %>
      <% end_if %>
      <% loop $MainMenuChildren %>
        <a href="$Link" class="$Up.Item.getMenuLinkClass($LinkingMode)" title="$MenuTitle">$MenuTitle</a>
      <% end_loop %>
    </div>
  <% end_if %>
</li>
