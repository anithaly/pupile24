jQuery(function(){
  $('div.actions li.specie > a').click(function(event){
    event.preventDefault();
    $(this).parent().find('ul').slideToggle()
  })
});