<?php
/**
 * @file
 * HTML template functions.
 */

/**
 * Implements hook_preprocess_html().
 * Meta tags https://drupal.org/node/1468582#comment-5698732
 */
module_load_include('inc','amp','amp');

function simpleTheme_preprocess_html(&$variables) {
  $meta_charset = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'charset' => 'utf-8',
    ),
  );
  drupal_add_html_head($meta_charset, 'meta_charset');

  global $base_url;
  $link_canonical = array(
    '#tag' => 'link',
    '#attributes' => array(
      'rel' => 'canonical',
      'href' => $base_url.'/'.current_path(),
    ),
  );
  drupal_add_html_head($link_canonical, 'link_canonical');

  $meta_viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, minimum-scale=1, initial-scale=1',
    ),
  );
  drupal_add_html_head($meta_viewport, 'meta_viewport');

}

/**
 *
 * Implements hook_preprocess_imgage()
 *
 */
function simpleTheme_preprocess_image(&$vars){
  //dpm($vars);
  if(validateAmpFunctionality()){
    unset($vars['attributes']['typeof']);
  }
}

/**
 *
 * Implements hook_image_style()
 *
 */
function simpleTheme_image_style(&$vars){
  if(validateAmpFunctionality()){
    $uri = $vars['path'];
    $path = file_create_url($uri);
    //unset($vars['attributes']['typeof']);
    $imageTheme = '<amp-img layout="responsive" src="'. $path .'" width='. $vars['width'] .' height='. $vars['height'] .'></amp-img>';
  } else {
    $vars['path'] = image_style_url($vars['style_name'], $vars['path']);
    $imageTheme = theme('image', $vars);
  }
  return $imageTheme;
}


/**
 *
 * Implements hook_preprocess_field()
 */
function simpleTheme_preprocess_field(&$vars){
  if(validateAmpFunctionality()){
    if($vars['element']['#title'] == 'Image'){
      for ($i=0; $i < count($vars['item_attributes_array']); $i++) {
        foreach ($vars['item_attributes_array'][$i] as $key => $value) {
          if($key == 'rel'){
            unset($vars['item_attributes_array'][$i]);
          }
        }
      }
    }else if(($vars['element']['#title'] == 'Body') || ($vars['element']['#title'] == 'Title') || ($vars['element']['#title'] == 'Comment')){
      for ($i=0; $i < count($vars['item_attributes_array']); $i++) {
        foreach ($vars['item_attributes_array'][$i] as $key => $value) {
          if($key == 'property'){
            unset($vars['item_attributes_array'][$i]);
          }
        }
      }
    }
  }
}

/**
 *  Implements hook_css_alter().
 */
function simpleTheme_css_alter(&$css) {
  //remove core css

  if(validateAmpFunctionality()){
    $css = array();
  }
}

/**
 *
 * Implements hook_js_alter()
 *
 */
function simpleTheme_js_alter(&$javascript) {
  //remover todos los javascript
  if(validateAmpFunctionality()){
    $javascript = array();
  }
}

/**
 *
 * Implements hook_html_head_alter
 */
function simpleTheme_html_head_alter(&$head_elements){
  //eliminar elementos del head
  unset($head_elements['system_meta_generator']);
  unset($head_elements['system_meta_content_type']);
}