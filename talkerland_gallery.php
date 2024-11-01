<?php
/**
 * Plugin Name: Talkerland Gallery
 * Plugin URI:  https://www.talkerland.com/talkerland_gallery.zip
 * Description: This is a simple yet versatile image gallery plugin, based on jQuery Blueimp Gallery open source code, for WordPress users.
 * Version:     1.0.0
 * Author:      Howard Chung
 * Author URI:  https://www.talkerland.com
 * Text Domain: talkerland_gallery
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 *
 *
 * Copyright (c) 2017 {Author}, {Author URI}
 *
 * {Plugin Name} is free software: you can redistribute it and/or modify it under the terms of the MIT License.
 *
 * The Blueimp gallery implementation is based on https://blueimp.net, licensed also under the MIT license. The Blueimp
 * gallery also utilizes the Swipe implementation, based on https://github.com/bradbirdsall/Swipe, which is licensed
 * under the MIT license as well.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * You should have received a copy of the GNU General Public License along with {Plugin Name}. If not, see {License URI}.
 */

// No direct file access
! defined( 'ABSPATH' ) AND exit;

define( 'TALKERLAND_GALLERY_VERSION', '1.0.0' );
define( 'TALKERLAND_GALLERY_MINIMUM_WP_VERSION', '4.7.2' );
define( 'TALKERLAND_GALLERY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once(TALKERLAND_GALLERY_PLUGIN_DIR.'talkerland_gallery_options.php');


// Register the gallery activation function
register_activation_hook(__FILE__,'talkerland_gallery_activation');
function talkerland_gallery_activation() {
   
}

// Register the gallery deactivation function
register_deactivation_hook(__FILE__,'talkerland_gallery_deactivation');
function talker_gallery_deactivation() {
   
}

// Register & Enqueue Scripts Into Admin Area
add_action( 'admin_enqueue_scripts', 'talkerland_image_enqueue' );
function talkerland_image_enqueue() {
   global $typenow;
   if( $typenow == 'talkerland_gallery' ) {
      
      // Load all built-in media resources
      wp_enqueue_media();
      
      // Registers and enqueues the required javascript.
      wp_register_script( 'meta-box-image', plugins_url('js/meta-box-image.js',__FILE__), array( 'jquery','wp-color-picker' ) );
      // Tweeks some settings of Media Manager.
      wp_localize_script( 'meta-box-image', 'meta_image',
         array(
            'title' => esc_html__( 'Choose or Upload an Image', 'talkerland_gallery' ),
            'button' => esc_html__( 'Use this image', 'talkerland_gallery' ),
         )
      );
      // Load the script
      wp_enqueue_script( 'meta-box-image' );
   
      wp_register_style('talkerland_gallery_custom_style',plugins_url('css/talkerland_gallery_custom_style.css',__FILE__));
      wp_enqueue_style('talkerland_gallery_custom_style');
      wp_register_style('talkerland_gallery_blueimp_style',plugins_url('css/blueimp-gallery.min.css',__FILE__));
      wp_enqueue_style('talkerland_gallery_blueimp_style');
   
      wp_enqueue_style( 'wp-color-picker' );
      wp_register_script( 'wp-color-picker-script-handle',plugins_url('js/wp-color-picker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
      wp_enqueue_script( 'wp-color-picker-script-handle');
   }
}

// Register & Enqueue Scripts
add_action('wp_enqueue_scripts','talkerland_gallery_scripts');
function talkerland_gallery_scripts() {
   // Load Blueimp Gallery Script
   wp_register_script('talkerland_gallery_script',plugins_url('js/jquery.blueimp-gallery.min.js',__FILE__),array('jquery'),null,true);
   wp_enqueue_script('talkerland_gallery_script');
}

// Register & Enqueue Styles
add_action('wp_enqueue_scripts','talkerland_gallery_styles');
function talkerland_gallery_styles() {
   wp_register_style('talkerland_gallery_blueimp_style',plugins_url('css/blueimp-gallery.min.css',__FILE__));
   wp_enqueue_style('talkerland_gallery_blueimp_style');
   wp_register_style('talkerland_gallery_custom_style',plugins_url('css/talkerland_gallery_custom_style.css',__FILE__));
   wp_enqueue_style('talkerland_gallery_custom_style');
}

// Register a gallery post type
add_action('init','talkerland_gallery_registration');
function talkerland_gallery_registration() {
   
   $labels = array(
      'name'               => esc_html_x( 'Galleries', 'post type general name', 'talkerland_gallery' ),
      'singular_name'      => esc_html_x( 'Gallery', 'post type singular name', 'talkerland_gallery' ),
      'menu_name'          => esc_html_x( 'Galleries', 'admin menu', 'talkerland_gallery' ),
      'name_admin_bar'     => esc_html_x( 'Gallery', 'add new on admin bar', 'talkerland_gallery' ),
      'add_new'            => esc_html_x( 'Add New', 'gallery', 'talkerland_gallery' ),
      'add_new_item'       => esc_html__( 'Add New Gallery', 'talkerland_gallery' ),
      'new_item'           => esc_html__( 'New Gallery', 'talkerland_gallery' ),
      'edit_item'          => esc_html__( 'Edit Gallery', 'talkerland_gallery' ),
      'view_item'          => esc_html__( 'View Gallery', 'talkerland_gallery' ),
      'all_items'          => esc_html__( 'All Galleries', 'talkerland_gallery' ),
      'search_items'       => esc_html__( 'Search Galleries', 'talkerland_gallery' ),
      'parent_item_colon'  => esc_html__( 'Parent Galleries:', 'talkerland_gallery' ),
      'not_found'          => esc_html__( 'No Galleries found.', 'talkerland_gallery' ),
      'not_found_in_trash' => esc_html__( 'No Galleries found in Trash.', 'talkerland_gallery' )
   );
   $args = array(
      'labels'             => $labels,
      'menu_icon'          => 'dashicons-images-alt2',
      'public'             => false,
      'publicly_queryable' => false,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title' ),
   );
   register_post_type('talkerland_gallery',$args);
   
}

// Outputs images to a mata box.
add_action('add_meta_boxes','talkerland_gallery_image_box');
function talkerland_gallery_image_box() {
   add_meta_box('talkerland-gallery-images',__( 'Gallery Images', 'talkerland_gallery' ),'talkerland_gallery_images','talkerland_gallery','normal');
}
function talkerland_gallery_images($post) {
   wp_nonce_field(basename(__FILE__), 'talkerland_gallery_nonce');
   $talkerland_gallery_images = get_post_meta($post->ID,'meta-images',true);
   $talkerland_gallery_image_ids = get_post_meta($post->ID,'meta-image-ids',true);
   ?>
   <p>
      <input type="button" id="meta-image-button" class="button" value="<?php echo esc_html__( 'Choose or Upload an Image', 'talkerland_gallery' ); ?>"/>
      <br/><br/>
      <strong><?php echo esc_html__('HOW TO ADD IMAGES', 'tallkerland_gallery'); ?></strong><br/>
      <?php echo esc_html__('Step 1. Click on the "Choose or Upload an Image" button above. The media library windows will pop up.', 'tallkerland_gallery'); ?><br/>
      <?php echo esc_html__('Step 2. Select images, which you want to include in your gallery. You can select multiple images simultaneously by clicking on images while pressing down the "SHIFT" key.', 'tallkerland_gallery'); ?><br/>
      <?php echo esc_html__('Step 3. Click on the "Use this image" button, located at the right bottom of the media library windows, to add those selected images into your gallery.', 'tallkerland_gallery'); ?><br/>
      <?php echo esc_html__('Step 4. Change the order of images by moving them around. To move an image around, just drag the image which you want to change its position.', 'tallkerland_gallery'); ?><br/><br/>
   </p>
   <div id="gallery-image-container">
      <?php
         for($i = count($talkerland_gallery_images) - 1; $i >= 0; $i--) {
            $image = array_shift($talkerland_gallery_images);
            $image_id = (int) array_shift($talkerland_gallery_image_ids);
           
            if(!empty($image)) {
            ?>
            <div class="gallery-image-frames" id="gallery-image-frames[<?php echo $i; ?>]">
               <img id="gallery-images[<?php echo $i; ?>]" src="<?php echo wp_get_attachment_thumb_url($image_id); ?>">
               <input type="hidden" id="gallery-image-urls[<?php echo $i; ?>]" name="meta-images[<?php echo $i; ?>]" value="<?php echo $image; ?>">
               <input type="hidden" id="gallery-image-ids[<?php echo $i; ?>]" name="meta-image-ids[<?php echo $i; ?>]" value="<?php echo $image_id; ?>">
               <a class="gallery-image-removal"><?php echo esc_html__('REMOVE','talkerland_galllery');?></a>
            </div>
            <?php
            }
         }
      ?>
   </div>
   <script>jQuery(document).ready(function($){$("#gallery-image-container").sortable({placeholder: "gallery-image-frames-placeholder gallery-image-frames"}).disableSelection();});</script>
   <br/><br/>
   <?php
}

// Outputs the shortcode to a side mata box.
add_action('add_meta_boxes','talkerland_gallery_shortcode_meta_box');
function talkerland_gallery_shortcode_meta_box() {
   add_meta_box('talkerland-gallery-shortcode-meta-box-display',__( 'Gallery Shortcode', 'talkerland_gallery' ),'talkerland_gallery_shortcode_meta_box_display','talkerland_gallery','side');
}
function talkerland_gallery_shortcode_meta_box_display($post) {
   echo "<p class='shortcode-display-style'>[talkerland_gallery id='{$post->ID}']</p><br/>";
   echo esc_html__("After publishing this gallery, copy and paste this shortcode into your posts or pages.",'talkerland_gallery');
}

// Outputs the information about a developer to a side mata box.
add_action('add_meta_boxes','talkerland_gallery_about_developer_meta_box');
function talkerland_gallery_about_developer_meta_box() {
   add_meta_box('talkerland-gallery-about-developer-meta-box-display',__( 'Hire Me!', 'talkerland_gallery' ),'talkerland_gallery_about_developer_meta_box_display','talkerland_gallery','side');
}
function talkerland_gallery_about_developer_meta_box_display($post) {
   echo "<H4 class='notice-warning'>".esc_html__('Howdy, Folks!','talkerland_gallery')."</H4>";
   echo  esc_html__("Hi, my name is Howard, and I am a web application developer.",'talkerland_gallery').
         "<br/><br/>".
         esc_html__("A few years ago, I have been working as a project manager and / or quality control manager in other 
         industries. The web application development was just one of many hobbies of mine at that time, even though 
         I had been doing it for more than 10 years for fun.",'talkerland_gallery').
         "<br/><br/>".
         esc_html__("But now to me, it is more than a hobby. I currently feel that the web application development became 
         a part of my life. These days people talk about the YOLO. What it means is that You Only Live Once, so you 
         should do what you love to do. I love the web application development, and this is what I am currently doing 
         for myself.",'talkerland_gallery').
         "<br/><br/>".
         esc_html__("Anyway, long story short! It might be a big help for me if you rate this plugin with 5 stars and 
         good comments, but I won't ask you to do so, because I know there are many gallery plugins which support better 
         functionality than mine. However, I am currently looking for a job as a web developer and / or programmer, 
         preferably full-time job. Thus, if you know someone, who needs a web developer or programmer, send me 
         an email.",'talkerland_gallery').
         "<br/><br/>".
         esc_html__("Thanks & happy blogging, folks! Peace~~!(^_^)/",'talkerland_gallery').
         "<br/><br/><br/>".
         "<strong class='title-words'>".
         esc_html__("Email",'talkerland_gallery').
         ": </strong><a href='mailto:support@talkerland.com' class='email-address'>support@talkerland.com</a><br/><strong class='title-words'>".
         esc_html__("Website",'talkerland_gallery').
         ": </strong><a href='https://www.talkerland.com' class='website-address'>https://www.talkerland.com</a><br/><br/>";
}

// Outputs the information about the project to a side mata box.
add_action('add_meta_boxes','talkerland_gallery_about_project_meta_box');
function talkerland_gallery_about_project_meta_box() {
   add_meta_box('talkerland-gallery-about-project-meta-box-display',__( 'About The Project', 'talkerland_gallery' ),'talkerland_gallery_about_project_meta_box_display','talkerland_gallery','side');
}
function talkerland_gallery_about_project_meta_box_display($post) {
   echo "<H4 class='notice-warning'>".esc_html__('DEVELOPMENT NOTE','talkerland_gallery')."</H4>";
   echo
      "<strong class='title-words'>".esc_html__("Period",'talkerland_gallery').": </strong>".esc_html__("2/2/2017 - 2/8/2017",'talkerland_gallery').
      "<br/><br/>".
      esc_html__("This plugin was developed based on jQuery Blueimp Gallery. What I did was just wrapping the existing open 
      source code with some convenient setting options for WordPress bloggers.",'talkerland_gallery').
      '<br/><br/>'.
      esc_html__("NOTE: The original Blueimp open source code supports the video gallery functions as well. However, due to the limited 
      project time that I had, I didn't implement the support for those video gallery functions in this plugin version. I might include 
      them in the future version.",'talkerland_gallery').
      '<br/><br/>'.
      "<strong class='title-words'>".esc_html__("About Blueimp Gallery",'talkerland_gallery').": </strong>".
      esc_html__("You can find more information about Blueimp Gallery from the following site",'talkerland_gallery').
      ":<br/><br/><a href='https://github.com/blueimp/Gallery' class='website-address'>https://github.com/blueimp/Gallery</a><br/><br/>".
      esc_html__('Blueimp is one of jQuery open source codes, based on the MIT license term, so Talkerland Gallery is.','talkerland_gallery').
      "<br/><br/>".
      "<strong class='title-words'>".esc_html__("About User Manual",'talkerland_gallery').": </strong>".
      esc_html__("I am planning to upload the most up-to-date user manual on my personal site, and here is the website address for your reference",'talkerland_gallery').
      ":<br/><br/><a href='https://www.talkerland.com' class='website-address'>https://www.talkerland.com</a><br/><br/>".
      esc_html__('Happy Blogging! Peace~!').
      "<br/><br/>";
}

// Output settings to a mata box.
add_action('add_meta_boxes','talkerland_gallery_lightbox_setting_box');
function talkerland_gallery_lightbox_setting_box() {
   add_meta_box('talkerland-gallery-lightbox-settings',__('Thunbnail Gallery Settings', 'talkerland_gallery'),'talkerland_gallery_lightbox_settings','talkerland_gallery','normal');
}
function talkerland_gallery_lightbox_settings($post) {
   wp_nonce_field(basename(__FILE__), 'talkerland_gallery_nonce');
   $lightbox_options = get_post_meta($post->ID,'meta-settings-lightbox',true);
   if(empty(get_post_meta($post->ID,'carousel-or-lightbox',true))){
      $lightbox_options["'carousel'"] = 0;
   } else {
      if(isset($lightbox_options["'carousel'"])) unset($lightbox_options["'carousel'"]);
   }
   $lightbox_options = build_talkerland_gallery_options($lightbox_options,$post->ID,true);
   $lightbox_options = is_array($lightbox_options) ? $lightbox_options : get_default_talkerland_lightbox_gallery_options();
   echo "<H4 class='notice-warning'>".esc_html__("Note: Following settings are only for the thumbnail mode. If you want to configure the gallery for the carousel mode, you can skip to the carousel setting section.",'talkerland_gallery')."</H4>";
   echo build_talkerland_gallery_html_options($lightbox_options,$option_id_prefix = 'talkerland-gallery-lightbox-option-',$name_array_suffix = '_lightbox');
}

// Output settings to a mata box.
add_action('add_meta_boxes','talkerland_gallery_carousel_setting_box');
function talkerland_gallery_carousel_setting_box() {
   add_meta_box('talkerland-gallery-carousel-settings',__('Carousel Gallery Settings', 'talkerland_gallery'),'talkerland_gallery_carousel_settings','talkerland_gallery','normal');
}
function talkerland_gallery_carousel_settings($post) {
   wp_nonce_field(basename(__FILE__), 'talkerland_gallery_nonce');
   $options = get_post_meta($post->ID,'meta-settings',true);
   if(!empty(get_post_meta($post->ID,'carousel-or-lightbox',true))){
      $options["'carousel'"] = 1;
   } else {
      if(isset($options["'carousel'"])) unset($options["'carousel'"]);
   }
   $options = build_talkerland_gallery_options($options,$post->ID,false);
   $options = is_array($options) ? $options : get_default_talkerland_gallery_options();
   echo "<H4 class='notice-warning'>".esc_html__("Note: Following settings are only for the carousel mode. If you want to configure the gallery for the thumbnail mode, you can skip to the thumbnail setting section.",'talkerland_gallery')."</H4>";
   echo build_talkerland_gallery_html_options($options,$option_id_prefix = 'talkerland-gallery-option-',$name_array_suffix = '');
}

// Save the gallery post.
add_action('save_post','talkerland_gallery_save');
function talkerland_gallery_save($post_id){
   
   // Checks save status
   $is_autosave = wp_is_post_autosave($post_id);
   $is_revision = wp_is_post_revision($post_id);
   $is_valid_nonce = ( isset($_POST['talkerland_gallery_nonce']) && wp_verify_nonce( $_POST['talkerland_gallery_nonce'],__FILE__) ) ? true : false;
   
   if($is_autosave || $is_revision || $is_valid_nonce) {
      return;
   }

   // Checks for input and saves if needed
   if( isset( $_POST[ 'meta-images' ] ) ) {
      update_post_meta( $post_id, 'meta-images', $_POST[ 'meta-images' ] );
      update_post_meta( $post_id, 'meta-image-ids', $_POST[ 'meta-image-ids' ] );
      update_post_meta( $post_id, 'meta-settings-lightbox',$_POST[ 'talkerland_gallery_settings_lightbox' ]);
      update_post_meta( $post_id, 'meta-settings',$_POST[ 'talkerland_gallery_settings' ]);
      update_post_meta( $post_id, 'carousel-or-lightbox',$_POST[ 'talkerland_gallery_settings' ]["'carousel'"]);
   }
   
}

// Register a shortcode with a ID attribute.
add_shortcode('talkerland_gallery','talkerland_gallery_shortcode');
function talkerland_gallery_shortcode($attr) {
   
   $links = $styles = $html = '';
   extract(shortcode_atts(array('id' => ''),$attr));
   $raw_gallery_images = get_post_meta($id,'meta-images',true);
   $gallery_images = implode("','",$raw_gallery_images);
   $raw_image_ids = get_post_meta($id,'meta-image-ids',true);
   $raw_gallery_options = get_post_meta($id,'meta-settings',true);
   
   if($raw_gallery_options["'carousel'"] == 1) {
      $carousal_show_controls = ($raw_gallery_options["'blueimpGalleryControls'"] == true) ? 'blueimp-gallery-controls ' : '';
      unset($raw_gallery_options["'blueimpGalleryControls'"]);
      $gallery_options = json_encode_talkerland_gallery_options($raw_gallery_options);
      $class = "{$carousal_show_controls}blueimp-gallery-carousel";
      $close = '';
      $script = "blueimp.Gallery(['{$gallery_images}'],{$gallery_options});";
   } else {
      $lightbox_options = sanitize_talkerland_gallery_options(get_post_meta($id,'meta-settings-lightbox',true));
      $full_screen_enabled = ($lightbox_options['fullScreen'] == true) ? 'fullScreen:true, ' : '';
      $autostart_enabled = ($lightbox_options['startSlideshow'] == true) ? 'startSlideshow:true, ' : '';
      $lightbox_show_controls = ($lightbox_options['blueimpGalleryControls'] == true) ? 'blueimp-gallery-controls ' : '';
      $image_stretch = !empty($lightbox_options['stretchImages']) ? $lightbox_options['stretchImages'] : 'false';
      $slideshow_interval = isset($lightbox_options['slideshowInterval']) ? "slideshowInterval:{$lightbox_options['slideshowInterval']}, " : '';
      $transition_speed = isset($lightbox_options['transitionSpeed']) ? "transitionSpeed:{$lightbox_options['transitionSpeed']}, " : '';
      $class = $lightbox_show_controls;
      $close = '<a class="close">×</a>';
      $script = "document.getElementById('links-{$id}').onclick = function (event) {
         event = event || window.event;
         var target = event.target || event.srcElement,
         link = target.src ? target.parentNode : target,
         options = {container: '#blueimp-gallery-{$id}', index: link, stretchImages:'{$image_stretch}', {$transition_speed}{$slideshow_interval}{$autostart_enabled}{$full_screen_enabled}event: event},
         links = this.getElementsByTagName('a');
         blueimp.Gallery(links,options);
      };";
      
      if($lightbox_options['lightboxImageFrameSize'] > 640) {
         $image_size = 'full';
      } elseif($lightbox_options['lightboxImageFrameSize'] > 300) {
         $image_size = 'large';
      } elseif($lightbox_options['lightboxImageFrameSize'] > 150) {
         $image_size = 'medium';
      } else {
         $image_size = 'thumbnail';
      }
      $float_value = ($lightbox_options['lightboxAlignment'] === 'center') ? 'none' : $lightbox_options['lightboxAlignment'];
      $lightbox_wall_size = ($lightbox_options['lightboxWallSize'] == 0) ? '100%' : $lightbox_options['lightboxWallSize'].'px';
      $styles .= "
<style>
   #links-{$id}.lightbox-image-container { text-align: {$lightbox_options['lightboxAlignment']}; } 
   #links-{$id} .lightbox-image-inner-container {
      width: {$lightbox_wall_size}; 
      text-align: {$lightbox_options['lightboxAlignment']};
      font-size: 0;
      letter-spacing: 0;
      word-spacing: 0;
   } 
   #links-{$id} .lightbox-image-frame {
      display: inline-block; 
      float:{$float_value}; 
      width:{$lightbox_options['lightboxImageFrameSize']}px; 
      margin: {$lightbox_options['lightboxImageFrameGutterSize']}px;
      border: {$lightbox_options['lightboxImageFrameBorderSize']}px solid {$lightbox_options['lightboxImageFrameBorderColor']};
   } 
   #links-{$id} .lightbox-image-frame.bright img {   
      -webkit-transition: all 1s ease;
      -moz-transition: all 1s ease;
      -o-transition: all 1s ease;
      -ms-transition: all 1s ease;
      transition: all 1s ease;
   }
   #links-{$id} .lightbox-image-frame.bright img:hover {
      opacity: 0.5;
   }
</style>";
      
      $links .= "<div id='links-{$id}' class='lightbox-image-container'><div class='lightbox-image-inner-container'>";
      
      $temp_array = array();
      foreach ($raw_image_ids as $image_id) {
         $temp_array[] = "<div class='lightbox-image-frame bright'>" . wp_get_attachment_link($image_id,$image_size) . "</div>";
      }
      if($float_value == 'right') { krsort($temp_array); }
      foreach ($temp_array as $cell) {$links .= $cell;}
      
      $links .= "</div></div>";
      
   }
   
   $html .= $styles;
   
   $html .= "<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
            <div id='blueimp-gallery-{$id}' class='blueimp-gallery {$class}'> 
               <div class='slides'></div>
               <h3 class='title'></h3>
               <a class='prev'>‹</a>
               <a class='next'>›</a>
               {$close}
               <a class='play-pause'></a>
               <ol class='indicator'></ol>
            </div>";
   
   $html .= $links;
   
   $html .= "<script>jQuery(document).ready(function($){{$script}});</script>";
   
   return $html;
}

// Register a shortcode column in the galley list table.
add_filter('manage_posts_columns','talkerland_gallery_shortcode_column', 10, 2);
function talkerland_gallery_shortcode_column($columns,$post_type) {
   if($post_type == 'talkerland_gallery') $columns['shortcode_column'] = esc_html__('Shortcode','talkerland_gallery');
 
   return $columns;
}

// Populate the shortcodes in the column.
add_filter('manage_posts_custom_column','talkerland_gallery_custom_column',10,2);
function talkerland_gallery_custom_column($column_name,$post_id) {
   
   $setup = empty($meta_data_setup) ? '' : " setup='{$meta_data_setup}'";
   
   switch($column_name) {
      case 'shortcode_column':
         echo "<div id='shortcode-{$post_id}'>[talkerland_gallery id='{$post_id}'{$setup}]</div>";
         break;
   }
}

// Enable sorting the shortcode column.
add_filter('manage_edit-talkerland_gallery_sortable_columns','talkerland_gallery_sortable_column');
function talkerland_gallery_sortable_column($sortable_columns) {
   $sortable_columns['shortcode_column'] = 'shortcode_column';
   return $sortable_columns;
}

