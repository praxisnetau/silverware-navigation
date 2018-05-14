<nav class="$WrapperClass">
  <% if $Anchors %>
    <ul class="$ListClass">
      <% loop $Anchors %>
        <li>
          {$Up.FontIconTag}<a href="$Link" title="$Text">$Text</a>
        </li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
