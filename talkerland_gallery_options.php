<?php

// No direct file access
! defined( 'ABSPATH' ) AND exit;

// Default Talkerland Gallery Options (Lightbox Mode Only)
function get_default_talkerland_lightbox_gallery_options() {
   return $options = array(
      'carousel' => array(
         'option_type' => 'radio',
         'option_label' => esc_html__('Enable Thumbnail Gallery Mode','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to enable the thumbnail gallery mode. The carousel gallery mode will be automatically disabled once selected.',
            'talkerland_gallery'
         ),
         'option_name' => 'carousel',
         'option_value' => 0,
         'option_checked' => 'checked="checked"'
      ),
      'lightboxAlignment' => array(
         'option_type' => 'select',
         'option_label' => esc_html__('Thumbnail Gallery Alignment','talkerland_gallery'),
         'option_description' => esc_html__(
            'Change the position of the thumbnail gallery to the left, right, or center.',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxAlignment',
         'option_value' => array('left','center','right'),
         'option_checked' => 'center'
      ),
      'lightboxImageFrameSize' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Thumbnail Image Frame Size','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the thumbnail image frame size. It controls the width of thumbnail image frame. The unit is "px".',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxImageFrameSize',
         'option_value' => 100,
         'option_checked' => ''
      ),
      'lightboxImageFrameGutterSize' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Thumbnail Image Frame Gutter Size','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the gutter size of thumbnail images. With this option, you can adjust the space between thumbnail images.
             It must be greater or equal to zero. The unit is "px" here.',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxImageFrameGutterSize',
         'option_value' => 0,
         'option_checked' => ''
      ),
      'lightboxWallSize' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Thumbnail Gallery Wall Size','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the thumbnail gallery wall size. With this setting, you can control how many thumbnail images can 
            be displayed in a row. For an example, if you previously set the thumbnail image frame size as 80px and 
            gutter size as 10px, the total width per image will be 80px + (10px * 2) = 100px. If you want to display 
            5 images per row, you can set the wall size as 500px here. If you want to set the gallery wall size to 100%,
            simply set it to 0. Please note that the unit will be the percentage (%) if you set this option to 0. Otherwise,
            the unit for this option will be the pixel (px).',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxWallSize',
         'option_value' => 0,
         'option_checked' => ''
      ),
      'blueimpGalleryControls' => array(
         'option_type' => 'checkbox',
         'option_label' => esc_html__('Make Slideshow Controls Visible','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to show the slideshow controls. This option works only in the modal screen or fullscreen mode.',
            'talkerland_gallery'
         ),
         'option_name' => 'blueimpGalleryControls',
         'option_value' => true,
         'option_checked' => 'checked="checked"'
      ),
      'fullScreen' => array(
         'option_type' => 'checkbox',
         'option_label' => esc_html__('Fullscreen Mode','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to enable the fullscreen mode. When a thumbnail image gets clicked, it will enter the fullscreen mode instead of the modal screen display.',
            'talkerland_gallery'
         ),
         'option_name' => 'fullScreen',
         'option_value' => true,
         'option_checked' => 'checked="checked"'
      ),
      'startSlideshow' => array(
         'option_type' => 'checkbox',
         'option_label' => esc_html__('Start Slideshow Automatically','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to start the slideshow automatically in the modal or fullscreen mode.',
            'talkerland_gallery'
         ),
         'option_name' => 'startSlideshow',
         'option_value' => true,
         'option_checked' => 'checked="checked"'
      ),
      'stretchImages' => array(
         'option_type' => 'select',
         'option_label' => esc_html__('Stretch Images','talkerland_gallery'),
         'option_description' => esc_html__(
            'This option works only in the modal or fullscreen mode. Set to "contain" to make images stretched, 
            while maintaining their aspect ratio. (The option "contain" will only be enabled for browsers supporting 
            background-size="contain", which excludes ID < 9.) Set to "cover" to make images cover all available space. 
            (The option "cover" will only be enabled for browsers supporting background-size="cover", which excludes IE < 9.)',
            'talkerland_gallery'
         ),
         'option_name' => 'stretchImages',
         'option_value' => array('false','contain','cover'),
         'option_checked' => 'false'
      ),
      'slideshowInterval' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Slideshow Interval','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the time delay in milliseconds between slides. This setting option is enabled only when the gallery is 
            in the automatic slideshow mode and in either fullscreen or modal display.',
            'talkerland_gallery'
         ),
         'option_name' => 'slideshowInterval',
         'option_value' => 5000,
         'option_checked' => ''
      ),
      'transitionSpeed' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Slide Transition Speed','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the slide transition speed in milliseconds. This setting option is enabled  only when the gallery is 
            in the automatic slideshow mode and in either fullscreen or modal display.',
            'talkerland_gallery'
         ),
         'option_name' => 'transitionSpeed',
         'option_value' => 400,
         'option_checked' => ''
      ),
      'lightboxImageFrameBorderColor' => array(
         'option_type' => 'text',
         'option_label' => esc_html__('Thumbnail Image Frame Border Color','talkerland_gallery'),
         'option_description' => esc_html__(
            'You can set the thumbnail image frame border color.',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxImageFrameBorderColor',
         'option_value' => '#000000',
         'option_checked' => ''
      ),
      'lightboxImageFrameBorderSize' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Thumbnail Image Frame Border Size','talkerland_gallery'),
         'option_description' => esc_html__(
            'You can set the thumbnail image frame border size.',
            'talkerland_gallery'
         ),
         'option_name' => 'lightboxImageFrameBorderSize',
         'option_value' => 0,
         'option_checked' => ''
      )
   );
}

// Default Talkerland Gallery Options (Carousel Mode)
function get_default_talkerland_gallery_options() {
   return $options = array(
      'carousel' => array(
         'option_type' => 'radio',
         'option_label' => esc_html__('Enable Carousel Gallery Mode','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to enable the carousel mode. The thumbnail image gallery mode will be automatically disabled once selected.',
            'talkerland_gallery'
         ),
         'option_name' => 'carousel',
         'option_value' => 1,
         'option_checked' => ''
      ),
      'stretchImages' => array(
         'option_type' => 'select',
         'option_label' => esc_html__('Stretch Images','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set to "contain" to make images stretched, while maintaining their aspect ratio. (The option "contain" will 
            only be enabled for browsers supporting background-size="contain", which excludes ID < 9.) Set to "cover" 
            to make images cover all available space. (The option "cover" will only be enabled for browsers supporting
            background-size="cover", which excludes IE < 9.)',
            'talkerland_gallery'
         ),
         'option_name' => 'stretchImages',
         'option_value' => array('false','contain','cover'),
         'option_checked' => 'false'
      ),
      'slideshowInterval' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Slideshow Interval','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the time delay in milliseconds between slides. This setting gets enabled only with the automatic slideshow start option enabled',
            'talkerland_gallery'
         ),
         'option_name' => 'slideshowInterval',
         'option_value' => 5000,
         'option_checked' => ''
      ),
      'transitionSpeed' => array(
         'option_type' => 'number',
         'option_label' => esc_html__('Slide Transition Speed','talkerland_gallery'),
         'option_description' => esc_html__(
            'Set the slide transition speed in milliseconds. This setting get enabled only with the automatic slideshow start option enabled.',
            'talkerland_gallery'
         ),
         'option_name' => 'transitionSpeed',
         'option_value' => 400,
         'option_checked' => ''
      ),
      'blueimpGalleryControls' => array(
         'option_type' => 'checkbox',
         'option_label' => esc_html__('Make Slideshow Controls Visible','talkerland_gallery'),
         'option_description' => esc_html__(
            'Select to show the slideshow controls.',
            'talkerland_gallery'
         ),
         'option_name' => 'blueimpGalleryControls',
         'option_value' => true,
         'option_checked' => 'checked="checked"'
      ),
      'container' => array(
         'option_type' => 'text',
         'option_label' => esc_html__('Gallery Container ID','talkerland_gallery'),
         'option_description' => esc_html__(
            'This is the gallery container ID for this gallery, which you are currently working on, and it is 
            automatically set by the system. You can use this ID when styling this gallery.',
            'talkerland_gallery'
         ),
         'option_name' => 'container',
         'option_value' => '#blueimp-gallery-',
         'option_checked' => ''
      ),
   );
}

// Build an array of the gallery options.
function build_talkerland_gallery_options($bare_options = array(), $id = null, $light_box_mode = false) {
   $full_options = $duplicated_options = ($light_box_mode == false) ? get_default_talkerland_gallery_options() : get_default_talkerland_lightbox_gallery_options();
   if(!empty($bare_options)) {
      foreach($bare_options as $key => $value) {
         $key = str_replace("'", "", $key);
         $option_type = $full_options[ $key ]['option_type'];
         if ($option_type == 'checkbox') {
            $full_options[ $key ]['option_checked'] = $value ?'checked="checked"':'';
            unset($duplicated_options[ $key ]);
         } elseif ($option_type == 'radio') {
            $full_options[ $key ]['option_checked']= 'checked="checked"';
            unset($duplicated_options[ $key ]);
         } elseif ($option_type == 'number') {
            $full_options[ $key ]['option_value'] = absint($value);
            unset($duplicated_options[ $key ]);
         } elseif ($option_type == 'text') {
            $full_options[ $key ]['option_value'] = ($key == 'container') ? '#blueimp-gallery-'.$id : sanitize_text_field($value);
            unset($duplicated_options[ $key ]);
         } elseif ($option_type === 'select') {
            $full_options[ $key ]['option_checked'] = $value;
            unset($duplicated_options[ $key ]);
         }
      }
      foreach ($duplicated_options as $key => $option) {
         $option_type = $full_options[ $key ]['option_type'];
         if ($option_type == 'checkbox') {
            $full_options[ $key ]['option_checked'] = '';
         } elseif ($option_type == 'radio') {
            $full_options[ $key ]['option_checked']= '';
         } elseif ($option_type == 'number') {
            $full_options[ $key ]['option_value'] = absint($option['option_value']);
         } elseif ($option_type == 'text') {
            $full_options[ $key ]['option_value'] = ($key == 'container') ? '#blueimp-gallery-'.$id : sanitize_text_field($option);
         } elseif ($option_type === 'select') {
            $full_options[ $key ]['option_checked'] = $option['option_checked'];
         }
      }
   } else {
      $full_options[ 'container' ]['option_value'] = '#blueimp-gallery-'.$id;
   }
   return $full_options;
}

// Build the gallery options in html for the setting display.
function build_talkerland_gallery_html_options($options = array(), $option_id_prefix = 'talkerland-gallery-option-',$name_array_suffix = null) {
   $html_options = "<div class=\"{$option_id_prefix}container\">";
   foreach($options as $option) {
      $html_options .= talkerland_gallery_html_option_presets($option,$option_id_prefix,$name_array_suffix);
   }
   $html_options .= "</div>";
   return empty($options) ? '': $html_options;
}

// HTML option presets, which will be used during building the html gallery options.
function talkerland_gallery_html_option_presets($option, $option_id_prefix, $name_array_suffix = null){
   
   switch($option['option_type']) {
      case 'radio':
         $suffix = ($option['option_name'] == 'carousel')? '': $name_array_suffix;
         $some_value = ($option['option_name'] == 'carousel')? (empty($option['option_value'])?0:1) : $option['option_value'];
         $tag = "<input type=\"{$option['option_type']}\" id=\"{$option_id_prefix}{$option['option_name']}\" name=\"talkerland_gallery_settings{$suffix}['{$option['option_name']}']\" value=\"{$some_value}\" {$option['option_checked']}>";
         break;
      case 'checkbox':
      case 'number':
         $tag = "<input type=\"{$option['option_type']}\" min=\"0\" max=\"600000\" step=\"1\" id=\"{$option_id_prefix}{$option['option_name']}\" name=\"talkerland_gallery_settings{$name_array_suffix}['{$option['option_name']}']\" value=\"{$option['option_value']}\" {$option['option_checked']} {$readonly}>";
         break;
      case 'text':
         $readonly = (($option['option_name'] == 'container')||($option['option_name'] == 'lightboxImageFrameBorderColor'))? 'readonly' : '';
         $color_picker = ($option['option_name'] == 'lightboxImageFrameBorderColor') ? ' class="talkerland-gallery-color-field" data-default-color="#000000"' : '';
         $tag = "<input type=\"{$option['option_type']}\" id=\"{$option_id_prefix}{$option['option_name']}\" name=\"talkerland_gallery_settings{$name_array_suffix}['{$option['option_name']}']\" value=\"{$option['option_value']}\"{$color_picker} {$option['option_checked']} {$readonly}>";
         break;
      case 'select':
         $option_value = $select_options = '';
         if(is_array($option['option_value'])) {
            foreach($option['option_value'] as $value) {
               $option_check = ($value !== $option['option_checked']) ? '': "selected=\"selected\"";
               $option_value .=  "<option value=\"{$value}\" {$option_check}>$value</option>";
            }
            $select_options = "<select id=\"{$option_id_prefix}{$option['option_name']}\" name=\"talkerland_gallery_settings{$name_array_suffix}['{$option['option_name']}']\">{$option_value}</select>";
         }
         $tag = empty($option_value) ? '': $select_options;
         break;
      default:
         $tag ='';
   }
   
   $tags =
      "<div>".
         "<label for=\"{$option_id_prefix}{$option['option_name']}\">{$option['option_label']}: </label>".
         $tag.
         "<p>{$option['option_description']}</p>".
      "</div>";
   
   return empty($tag) ? '' : $tags;
}

// JSON encode the basic options from the database after sanitizing the keys.
function json_encode_talkerland_gallery_options($bare_options = array()) {
   return json_encode(sanitize_talkerland_gallery_options($bare_options));
}

// Sanitize the option keys obtained from the database. They are double single-quoted.
function sanitize_talkerland_gallery_options($bare_options = array()) {
   $options = array();
   foreach ($bare_options as $key => $value) { $options[str_replace("'", "", $key)] = $value ; }
   return $options;
}

