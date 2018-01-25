jQuery(function($) {

  var file_frame;

  $(document).on('click', '#ed-logo-carousel-metabox a.ed-logo-carousel-add', function(e) {

    e.preventDefault();

    if (file_frame) file_frame.close();

    file_frame = wp.media.frames.file_frame = wp.media({
      title: $(this).data('uploader-title'),
      button: {
        text: $(this).data('uploader-button-text'),
      },
      multiple: true
    });

    file_frame.on('select', function() {
      var listIndex = $('#ed-logo-carousel-metabox-list li').index($('#ed-logo-carousel-metabox-list li:last')),
          selection = file_frame.state().get('selection');

      selection.map(function(attachment, i) {
        attachment = attachment.toJSON(),
        index      = listIndex + (i + 1);

     
		
		$('#ed-logo-carousel-metabox-list').append('<li>'+
		'<input type="hidden" name="ed_logo_id[' + index + ']" value="' + attachment.id + '">'+
		'<img class="image-preview" src="' + attachment.url + '">'+
		'<div class="ed-pull-right">'+
		'<input type="text" name="ed_logo_link[' + index + ']" size="120" placeholder="Logo link" class="wdith-70" />'+
		'<select name="ed_logo_target[' + index + ']" class="wdith-30">'+
		'<option value="_blank">Blank</option>'+
		'<option value="_parent">Parent</option>'+
		'<option value="_self">Self</option>'+
		'<option value="_top">Top</option>'+
		'</select>'+
		'<input type="text" name="ed_logo_tooltip[' + index + ']"  size="120" placeholder="Tooltip Text (pro features)" readonly="readonly" />'+
		'</div>'+
		'<div  style="clear:both; height:10px;"></div>'+
		'<a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change Logo</a>'+
		'<small><a class="remove-image  button button-small" href="#">Remove Logo</a></small>'+
		'</li>');
	 console.log(attachment.url);
	  });
    });

    makeSortable();
    
    file_frame.open();

  });

  $(document).on('click', '#ed-logo-carousel-metabox a.change-image', function(e) {

    e.preventDefault();

    var that = $(this);

    if (file_frame) file_frame.close();

    file_frame = wp.media.frames.file_frame = wp.media({
      title: $(this).data('uploader-title'),
      button: {
        text: $(this).data('uploader-button-text'),
      },
      multiple: false
    });

    file_frame.on( 'select', function() {
      attachment = file_frame.state().get('selection').first().toJSON();

      that.parent().find('input:hidden').attr('value', attachment.id);
      that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
    });

    file_frame.open();

  });

  function resetIndex() {
    $('#ed-logo-carousel-metabox-list li').each(function(i) {
      $(this).find('input:hidden').attr('name', 'ed_logo_id[' + i + ']');
	  $(this).find('input:text').attr('name', 'ed_logo_link[' + i + ']');
	  $(this).find('select').attr('name', 'ed_logo_target[' + i + ']');
	  $(this).find('input:text').attr('name', 'ed_logo_tooltip[' + i + ']');
    });
  }

  function makeSortable() {
    $('#ed-logo-carousel-metabox-list').sortable({
      opacity: 0.6,
      stop: function() {
        resetIndex();
      }
    });
  }

  $(document).on('click', '#ed-logo-carousel-metabox a.remove-image', function(e) {
    e.preventDefault();

    $(this).parents('li').animate({ opacity: 0 }, 200, function() {
      $(this).remove();
      resetIndex();
    });
  });

  makeSortable();
	$('.ed_color_field').each(function(){
		$(this).wpColorPicker();
	});
});