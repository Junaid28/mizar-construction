jQuery(document).ready(function($) {

  var selectedIds = [];

  var existing = $('#property_gallery_input').val();
  if ( existing ) {
    selectedIds = existing.split(',').filter(Boolean);
  }

  $('#publish, #save-post').on('click', function() {
    $('#property_gallery_input').val(selectedIds.join(','));
  });

  $('form#post').on('submit', function() {
    $('#property_gallery_input').val(selectedIds.join(','));
  });

  $('#add-gallery-images').on('click', function(e) {
    e.preventDefault();

    var frame = wp.media({
      title:    'Select Gallery Images',
      button:   { text: 'Add to Gallery' },
      multiple: true,
      library:  { type: 'image' }
    });

    frame.on('select insert', function() {
      var state     = frame.state();
      var selection = state && state.get('selection');
      if ( ! selection ) return;

      selection.each(function(attachment) {
        var id  = String(attachment.get('id'));
        var att = attachment.toJSON();
        if ( selectedIds.indexOf(id) !== -1 ) return;
        selectedIds.push(id);

        var thumbUrl = att.url;
        if ( att.sizes && att.sizes.thumbnail ) thumbUrl = att.sizes.thumbnail.url;
        else if ( att.sizes && att.sizes.medium ) thumbUrl = att.sizes.medium.url;

        $('#property-gallery-wrap').append(
          '<div class="gallery-img-preview" style="position:relative;display:inline-block;margin:4px;">' +
          '<img src="' + thumbUrl + '" style="width:100px;height:100px;object-fit:cover;border-radius:6px;border:1px solid #ddd;" />' +
          '<button type="button" class="remove-gallery-img" data-id="' + id + '" ' +
          'style="position:absolute;top:-6px;right:-6px;background:#e8292a;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:1;padding:0;">✕</button>' +
          '</div>'
        );
      });

      $('#property_gallery_input').val(selectedIds.join(','));
    });

    frame.open();
  });

  $(document).on('click', '.remove-gallery-img', function() {
    var id = String($(this).data('id'));
    selectedIds = selectedIds.filter(function(i) { return i !== id; });
    $('#property_gallery_input').val(selectedIds.join(','));
    $(this).closest('.gallery-img-preview').remove();
  });

});