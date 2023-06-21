<% if $FeatureImage %>
    <% if $Title && $ShowTitle %><h2 class="element__title">$Title</h2><% end_if %>
    <figure class="feature-image">
        <% if $UseResponsiveImages %>
            $FeatureImage.ImageElemental
        <% else %>
            $FeatureImage.ScaleMaxWidth(920)
        <% end_if %>
        <% if $Caption %>
            <figcaption>$Caption</figcaption>
        <% end_if %>
    </figure>
<% end_if %>
