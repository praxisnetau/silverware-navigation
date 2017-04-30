<nav class="$WrapperClass">
  <button $ButtonAttributesHTML>
    <span class="$ButtonIconClass"></span>
  </button>
  <% if $BrandText %>
    <a href="$BrandURL" class="$BrandClass">$BrandText</a>
  <% end_if %>
  <div id="$CollapseID" class="$CollapseClass">
    <% loop $EnabledItems %>
      $render
    <% end_loop %>
  </div>
</nav>
