jQuery(document).ready(function ($) {

   $(document).off('click', '.upload_image').on('click', '.upload_image', function(e) {
      e.preventDefault();
      openFileModal(this);
   });
   
});


function openFileModal(button) {
      
      var $button = jQuery(button);

      //console.log($button);
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () {
         // We set multiple to false so only get one image from the uploader
 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url).change();

         $button.siblings('.preview').attr('src', attachment.url).change();
 
      });
 
      // Finally, open the modal
      file_frame.open();

   }