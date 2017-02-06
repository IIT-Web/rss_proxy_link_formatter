<?php

/**
 * @file ajax-rss-proxy-link.tpl.php
 * Default template implementation to display the value of a link field with
 * Ajax Proxy of RSS Link formatter.
 *
 * Available variables:
 * - $variables: Array of variables passed to the template
 *   - id: Number representing the index of this field starting at 1
 *   - element: An associative array containing the properties of the element
 *   - field: An associative array containing the properties of the field
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['url']: The entity to which the field is attached.
 * - $element['title']: View mode, e.g. 'full', 'teaser'...
 * - $element['attributes']: The field name.
 * - $element['attributes']['target']: The field type.
 * - $element['html']: The field language.
 * - $element['display_url']: Whether the field is translatable or not.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>

<div id="rss_id_<?php print $variables['id']; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="rss-feed-title"><?php print $element['title']; ?></div>
  <div class="rss-feed-contents"></div>
  <div class="rss-feed-button"></div>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      var proxy_url = "<?php print $variables['proxy_url']; ?>";
      var jqxhr = $.ajax(proxy_url).done(function(data){
        //console.log(data);
        if (data.channel) {
          var html = '<ul>';
          for (var i = 0; i < data.channel.item.length; i++) {
            var title = data.channel.item[i].title;
            var link = data.channel.item[i].link;;
            html += '<li><a target="_blank" href="' + link + '" title="' + title + '">' + title + '</a></li>';
          };
          html += '</ul>';
          $("#rss_id_<?php print $variables['id']; ?> .rss-feed-contents").append(html);
          var button = '<a target="_blank" href="' + data.channel.link + '" title="<?php print $element['title']; ?>">Go to <?php print $element['title']; ?></a>';
          $("#rss_id_<?php print $variables['id']; ?> .rss-feed-button").append(button);
        } else {
          var RSS_link = '<?php print $element['url']; ?>';
          $("#rss_id_<?php print $variables['id']; ?> .rss-feed-contents").append('<a href="' + RSS_link + '">' + RSS_link + '</a>');
        }
      }).fail(function(jqXHR, textStatus, err){
        console.log('Feed Load Error Status: ' + textStatus + ': ' + err);
      });
    });
  </script>
</div>
