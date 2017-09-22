<nav class="$WrapperClass">
  <% if $EnabledButtons %>
    <ul class="$ListClass">
      <% loop $EnabledButtons %>
        <li>$render</li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
