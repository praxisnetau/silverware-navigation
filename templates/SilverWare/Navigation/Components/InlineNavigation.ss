<nav class="$WrapperClass">
  <% if $EnabledLinks %>
    <ul class="$ListClass">
      <% loop $EnabledLinks %>
        <li class="$LinkingMode">$render</li>
      <% end_loop %>
    </ul>
  <% end_if %>
</nav>
