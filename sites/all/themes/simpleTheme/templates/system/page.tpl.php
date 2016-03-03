<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 */
module_load_include('inc','amp','amp');
?>
<header class="header">
  
  <?php if (!validateAmpFunctionality()):?>

    <div class="grid content-top">

      <?php if ($messages): ?>
        <div class="messages-wrapper">
          <div class="messages-content">
            <?php print $messages; ?>
          </div>
        </div>
        <?php endif; ?>

      <div class="site-logo-slogan">

        <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>"/>
          </a>
        <?php endif; ?>

      </div>
      
      <?php print render($page['header']); ?>

    </div>

  <?php else: ?>
    <div class="brand-logo">
      <?php if($site_name): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</header>

<div class="main-content">

    <div class="main" role="main">

      <?php print render($page['content']); ?>

    </div>

  <?php if ($page['sidebar_first']): ?>
    <div id="sidebar-first" class="">
      <?php print render($page['sidebar_first']); ?>
    </div> <!-- /.section, /#sidebar-first -->
  <?php endif; ?>

  <?php if ($page['sidebar_second']): ?>
    <div id="sidebar-second" class="">
      <?php print render($page['sidebar_second']); ?>
    </div> <!-- /.section, /#sidebar-second -->
  <?php endif; ?>
</div>

<footer class="footer" role="contentinfo">

  <div>
    <?php print render($page['footer']); ?>
  </div>  
  
</footer>