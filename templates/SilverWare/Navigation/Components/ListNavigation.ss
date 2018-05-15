<% if $HeaderContent %>
  <header>
    $HeaderContent
  </header>
<% end_if %>
<nav class="$WrapperClass">
  <% if $EnabledLinks %>
    <ul class="$ListClass">
      <% loop $EnabledLinks %>
        <li class="$LinkingMode">
          <% if $Up.ShowIcons %>
            {$Up.getLinkFontIconTag($FontIcon)}
          <% end_if %>
          <a $LinkAttributesHTML>$MenuTitle</a>
        </li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
<% if $FooterContent %>
  <footer>
    $FooterContent
  </footer>
<% end_if %>
