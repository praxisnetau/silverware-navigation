{$CustomCSSPrefix} {
<% if $ButtonMargin %>  margin: {$ButtonMargin}px;<% end_if %>
<% if $ButtonPaddingX %>
  padding-left: {$ButtonPaddingX}px;
  padding-right: {$ButtonPaddingX}px;
<% end_if %>
<% if $ButtonPaddingY %>
  padding-top: {$ButtonPaddingY}px;
  padding-bottom: {$ButtonPaddingY}px;
<% end_if %>
}