<% if $NavigationItem.AddTopLinkToSub %>
  <li><a href="$Link" class="$NavigationItem.getMenuLinkClass($LinkingMode)" title="$MenuTitle">$MenuTitle</a></li>
  <% if $NavigationItem.ShowDivider %><li><div class="$NavigationItem.DividerClass"></div></li><% end_if %>
<% end_if %>
<% loop $MainMenuChildren %>
  <li>
    <% if $Up.NavigationItem.MultiLevelSubMenus %>
      <% if not $Up.NavigationItem.MaximumSubMenuLevel || $PageLevel <= $Up.NavigationItem.MaximumSubMenuLevel %>
        <a href="<% if $MainMenuChildren.exists %>#<% else %>$Link<% end_if %>" class="$Up.NavigationItem.getMenuLinkClass($LinkingMode, $MainMenuChildren.exists)" title="$MenuTitle">$MenuTitle</a>
        <% if $MainMenuChildren.exists %>
          <ul class="$Up.ListItem.MenuClass">
            <% include SilverWare\Navigation\Items\NavigationItem\Dropdown NavigationItem=$Up.NavigationItem, ListItem=$Up.ListItem %>
          </ul>
        <% end_if %>
      <% else %>
        <a href="$Link" class="$Up.NavigationItem.getMenuLinkClass($LinkingMode)" title="$MenuTitle">$MenuTitle</a>
      <% end_if %>
    <% else %>
      <a href="$Link" class="$Up.NavigationItem.getMenuLinkClass($LinkingMode)" title="$MenuTitle">$MenuTitle</a>
    <% end_if %>
  </li>
<% end_loop %>
