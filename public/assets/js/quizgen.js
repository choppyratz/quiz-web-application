$(document).ready(function(){
    let quiz_info;
    let que_info;
    let true_ans;
    $('.add_que_t').on('click',function(){
      true_ans = $('.tr_ans_val').val();
      $('.quiz_body').append("<div class='question'><h4 contenteditable='true'>" + $('.que_name').val() + "</h4><div class='questions_body'>" + $('.questions').html() + "</div><p class='true_answer' contenteditable='true'>" + true_ans + "</p></div>");
      $('.questions').html('');
      que_num++;
    });
    
    let que_num = 1;
    let opt = 1;
    $('.add_que_type').on('click', function(){
      let rd_name = '<label for="opt' + opt + '" class="radio"><input type="radio" name="rdo' + que_num + '" id="opt' + opt + '" class="hidden"/><span class="label"></span>'+$('.que_name_ans').val()+'</label>';
      $('.questions').append(rd_name); 
      opt++;
    });
    
    let obj = {};
    
    $('.add_que').on('click',function(){
      obj['name'] = $('.quiz_name').html();
      obj['quiz_body'] = {};
      $('.question').each(function(index){
        let que_variants = [];
        $(this).find('input').each(function(index){
          que_variants[index] = $(this).parent().text();       
        });
        obj['quiz_body'][index] = {
          'que_name' : $(this).find('h4').html(),
          'que_variants' : que_variants,
          'true_answer' : $(this).find('p').html() - 1 
        };   
      });
      $('.quiz_generator').append(JSON.stringify(obj));
    });
  });