jQuery(document).ready(function ($) {

  var categoriesArray;
  var widgetId;
  var $widget;
  var widgetName;

  // Make categories sortable on widget added
  $( document ).on( 'widget-added', function( event, target ) {
    $(target).find('.sortable').sortable({
      placeholder: "ui-state-highlight"
    });
  });
  
  // Get the selected category
  $(document).on('change', '.cat-index', function() {

    // Get widget, widget id and widget name
    widgetId = $(this).attr('id').replace('cat-index-','');
    $widget = $(this).parents('.widget');
    widgetName = 'widget-myb-category-index-widget[' + widgetId.substring(widgetId.lastIndexOf("-") + 1, widgetId.length) + '][categories]';

    // Get the categories in the select dropdown
    categoriesArray = $widget.find('.category-selection .selected-cat .cat-name').map(function() { return $(this).text(); }).get();

    // Remove the placeholder in the first run
    $widget.find('.no-selection').remove();
    
    // Get the selected value
    var selected = $(this).val();
    var selectedCat = $(this).find("option:selected").text();

    // Now append the selected category (if no in the array yet)
    if(!(categoriesArray.indexOf(selectedCat) > -1)) {

      $widget.find('.category-selection').append('<li><span class="selected-cat"><span class="cat-name">' + selectedCat + '</span><span class="remove dashicons dashicons-no-alt"></span></span><input type="hidden" name="' + widgetName + '[]" value="' + selected + '" class="widefat"/></li>');
       
      categoriesArray.push(selectedCat);

    } else {
       $target = $('.selected-cat .cat-name:contains(' + selectedCat + ')').parents('.selected-cat');

       $target.addClass('highlighted');

      setTimeout(function () {
        $target.removeClass('highlighted');
      }, 500);
    }

  });


  // Remove category from list
  $(document).on('click', '.selected-cat .remove', function() {
       var $category = $(this).parents('li'); 
       $category.remove();

       // Remove from categories array
       var name = $(this).parents('.selected-cat').find('.cat-name').text();

      // Get current widget and category list
      $widget = $(this).parents('.widget');
      categoriesArray = $widget.find('.category-selection .selected-cat .cat-name').map(function() { return $(this).text(); }).get();

       var index = $.inArray(name, categoriesArray);
      if (index >= 0) categoriesArray.splice(index, 1);
   });

});