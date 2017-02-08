// This file updates the droptown label when the tabs dropdown (in a group) is changed

if( $('.btn-group').length < 0)
	return;

var selected = $('#dropdown-id').val();


// if( document.cookie ){
//   selected = getCookie('dropdown');
// }

// this will selected the remmeberd tab pane in a group
// $('.btn-group .dropdown-menu a').each(function(){
//   $this = $(this);
//   if( $this.attr('href') == selected ){
//
//     $this.trigger('click', changeDropDown($this));
//   }
// });


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
