jQuery(document).ready(function($){

   var i = $('.gallery-image-frames').length;

   // Runs when the image button is clicked.
   $('#meta-image-button').click(function(e){

      // Instantiates the variable that holds the media library frame.
      var meta_image_frame, div, img, input;

      // Prevents the default action from occurring.
      e.preventDefault();

      // If the frame already exists, re-open it.
      if ( meta_image_frame ) {
         meta_image_frame.open();
         return;
      }

      // Sets up the media library frame
      meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
         title: meta_image.title,
         button: { text:  meta_image.button },
         multiple: true,
         library: { type: 'image' }
      });

      // Runs when an image is selected.
      meta_image_frame.on('select', function(){

         // Grabs the attachment selection and creates a JSON representation of the model.
         var media_attachment = meta_image_frame.state().get('selection').toJSON(),
            ma_length = media_attachment.length;
         for (var j = 0; j < ma_length; j++) {
            console.log(media_attachment[j]);
            div = $(
               '<div class="gallery-image-frames" id="gallery-image-frames[' + i + ']">' +
               '<img id="gallery-images[' + i + ']" src="' + media_attachment[j].sizes.thumbnail.url + '">' +
               '<input id="gallery-image-urls[' + i + ']" type="hidden" name="meta-images[' + i + ']" value="' + media_attachment[j].url + '">' +
               '<input id="gallery-image-ids[' + i + ']" type="hidden" name="meta-image-ids[' + i + ']" value="' + media_attachment[j].id + '">' +
               '<a class="gallery-image-removal">REMOVE</a>' +
               '</div>'
            );
            div.prependTo('#gallery-image-container');
            i++;
         }
      });

      // Opens the media library frame.
      meta_image_frame.open();

   });

   // Runs when the gallery image removal button is clicked.
   $('#gallery-image-container').on('click','a.gallery-image-removal',function(e){

      // Prevents the default action from occurring.
      e.preventDefault();

      $(this).closest('.gallery-image-frames').remove();

   });

});