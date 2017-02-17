// This file updates the droptown label when the tabs dropdown (in a group) is changed

if( $('.tab-switcher').length < 0)
	return;

var selected = $('#dropdown-id').val();
var $btnChoice = $('.tab-switcher .dropdown-menu a');

$btnChoice.click(function(e) {
  e.preventDefault();

  var $this = $(this);

  changeDropDown( $this );
});


function changeDropDown( $this ){

  var $btnGroup = $this.closest('.tab-switcher');
	var $btnFace = $btnGroup.find('.btn-face');
	var $parent = $this.parent('li');
	var btnText = $this.text();
	var btnVal = $this.attr('href');
  $('#js--field-tab-field').val(btnVal);
  document.cookie = 'dropdown=' + btnVal;

  $('#dropdown-id').val( btnVal );
  $parent.siblings().removeClass('active');
  $btnFace.text(btnText);

}
