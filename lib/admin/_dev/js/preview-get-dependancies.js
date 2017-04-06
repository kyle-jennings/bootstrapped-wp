function getDependancies(deps)
{

  var depFields = [];


  deps = deps.split(',');
  deps.forEach(function(e,i,a){
    // if the dep has is prefixed with a !# then we knot the exact element,
    // AND the jquery chain has been provided
    if(e.indexOf('$') >-1){

      var tmpName = e;
      var value = eval(e);
    }
    // else the dep might just be prefixed with a hashtag, in that case we
    // dont need to search for the field
    else if(e.indexOf('#') >-1){
      var tmpName = e;
      var $elm = $(tmpName);
      var value = $elm.val();
    }
    // otherwise, we might need to search for the field, we should probably
    // jsut be specific from the onset
    else{
      var tmpName = '#'+group+'-'+tab+'-'+e;
      var $elm = $(tmpName);
      var value = $elm.val();

    }

    depFields.push({
      name: tmpName,
      value: value
    });
  });


  return depFields;

}
