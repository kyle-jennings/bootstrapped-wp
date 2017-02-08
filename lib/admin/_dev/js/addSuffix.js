$('.js--add-suffix').on('change', function(e){

  var $this = $(this);
  var thisVal = $this.val();
  var valLength = thisVal.length;
  pxPos = thisVal.indexOf('px');

  if(pxPos < 0){
    thisVal += 'px';
  }

  if(pxPos > -1 && pxPos !== (valLength-2) ){
    thisVal = thisVal.replace('px','');
    thisVal += 'px';
  }


  if(isNaN(parseFloat(thisVal))){
    thisVal = 0;
  }
  $this.val(thisVal);

});
