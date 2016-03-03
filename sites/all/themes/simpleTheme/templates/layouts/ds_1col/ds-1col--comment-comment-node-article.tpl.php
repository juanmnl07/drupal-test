<?php

/**
 * @file
 * Display Suite 1 column template.
 */
module_load_include('inc','amp','amp');
?>
<<?php 
	if(validateAmpFunctionality() != true){
		print $ds_content_wrapper; print $layout_attributes;
	} else {
		print 'div';
	}
?> class="ds-1col <?php print $classes;?> clearfix">

  <?php if(validateAmpFunctionality() != true):
		  if (isset($title_suffix['contextual_links'])): ?>
		  <?php print render($title_suffix['contextual_links']); ?>
	  <?php endif; ?>
  <?php endif; ?>

  <?php print $ds_content; ?>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
