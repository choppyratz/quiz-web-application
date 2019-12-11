$(document).ready(function(){
    let opened = false;
    $('.knp').on('click',function(){
      if (opened){
        $('ul').slideUp();
        opened = false;  
      }else{
        $('ul').slideDown();
        opened = true;
      }
    });
  });