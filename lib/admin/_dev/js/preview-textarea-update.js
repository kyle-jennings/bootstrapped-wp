
// Was needed a timeout since RTE is not initialized when this code run.
setTimeout(function () {
    for (var i = 0; i < tinymce.editors.length; i++) {
        tinymce.editors[i].onChange.add(function (ed, e) {
          var $this = $(this);
          var value = $($this[0].iframeElement).contents().find('body').html();

          var hiddenField = '#'+$this[0].id+'--hidden';
          var $hiddenField = $(hiddenField);
          var field = $hiddenField.attr('name');


    			var parts = field.split('[');
          var section = parts[0];
          section = section.replace('bswp_','');
          var deps = $hiddenField.attr('data-preview_deps');

          ajax_preview.init(section, field, value, deps);
        });
    }
}, 2000);
