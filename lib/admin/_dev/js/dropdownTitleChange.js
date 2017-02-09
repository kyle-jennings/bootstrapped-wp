// This file updates the droptown label when the tabs dropdown (in a group) is changed

if( $('.btn-group').length < 0)
	return;

var selected = $('#dropdown-id').val();


var $btnChoice = $('.btn-group .dropdown-menu a');

$btnChoice.click(function(e) {
  e.preventDefault();

  var $this = $(this);

  changeDropDown( $this );
});


function changeDropDown( $this ){

  var $btnGroup = $this.closest('.btn-group');
	var $btnFace = $btnGroup.find('.btn-face');
	var $parent = $this.parent('li');
	var btnText = $this.text();
	var btnVal = $this.attr('href');

  document.cookie = 'dropdown=' + btnVal;

  $('#dropdown-id').val( btnVal );
  $parent.siblings().removeClass('active');
  $btnFace.text(btnText);

}
