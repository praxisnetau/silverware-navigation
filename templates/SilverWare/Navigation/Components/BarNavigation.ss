<nav class="$WrapperClass">
  <% if $IsButtonLeftAligned %>
    <button $ButtonAttributesHTML>
      <span class="$ButtonIconClass"></span>
    </button>
  <% end_if %>
  <% if $HasBrandLogo %>
    <a href="$BrandURL" class="$BrandClass" title="$BrandText"><img src="$BrandLogo.URL" class="$BrandLogoClass" alt="$BrandText"></a>
  <% else_if $BrandText %>
    <a href="$BrandURL" class="$BrandClass">$BrandText</a>
  <% end_if %>
  <% if $IsButtonRightAligned %>
    <button $ButtonAttributesHTML>
      <span class="$ButtonIconClass"></span>
    </button>
  <% end_if %>
  <div id="$CollapseID" class="$CollapseClass">
    <% loop $EnabledItems %>
      $render
    <% end_loop %>
  </div>
</nav>
