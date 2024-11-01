/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){

   blueimp.Gallery(
      document.getElementById('links').getElementsByTagName('a'),
      {
         container: '#blueimp-gallery-carousel',
         carousel: true
      }
   );

   document.getElementById('links').onclick = function (event) {
      event = event || window.event;
      var target = event.target || event.srcElement,
         link = target.src ? target.parentNode : target,
         options = {index: link, event: event},
         links = this.getElementsByTagName('a');
      blueimp.Gallery(links, options);
   };

});