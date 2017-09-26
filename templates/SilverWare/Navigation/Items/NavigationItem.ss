<ul $AttributesHTML>
  <% loop $Menu %>
    <% include SilverWare\Navigation\Items\NavigationItem\ListItem ListItem=$Up.getListItemData($LinkingMode, $URLSegment, $MainMenuChildren.exists), Item=$Up %>
  <% end_loop %>
</ul>
