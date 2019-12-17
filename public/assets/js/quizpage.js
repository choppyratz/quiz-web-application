$(window).on('load',function(){
    //let url = navigator.
    //$.ajax({
    //    url:
    //});
    let url = window.location.toString();
    let slashCount = 0;
    let uri = '';
    for (let i = 0; i < url.length; i++) {
        if (url[i] == '/') {
            slashCount++;
        }

        if (slashCount >= 3) {
            uri += url[i];
        }

    }
    let obj;
    let curr_ques;
    let ques_count;
    $.ajax({
        url: uri,
        method: 'POST',
        success: function(data) {
            obj = data;
            console.log(obj);
            curr_ques = 0;
            ques_count = Object.keys(obj['quiz_body']).length - 1; 
            if (ques_count == curr_ques)
                $('.ans_btn').html('Узнать результаты');
            console.log(ques_count);
            let opt = 1; 
            let rdo = 1;
            $('.quiz_name').html(data['name']);
            for (let i = 0; i < data['quiz_body'].length; i++) {
                let labels = '';
                for (let j = 0; j < data['quiz_body'][i]['que_variants'].length; j++) {
                    labels += '<label for="opt' + opt + '" class="radio"><input type="radio" name="rdo' + rdo+ '" id="opt' + opt + '" class="hidden"><span class="label"></span>' + data['quiz_body'][i]['que_variants'][j] + '</label>';
                    opt++;
                }
                if (i == 0)
                    $('.quiz_body').append('<div class="question current_question" id="que'+Number(rdo-1)+'"><div class="question_name">' + data['quiz_body'][i]['que_name'] + '</div><div class="answers">'+labels+'</div></div>');
                else    
                $('.quiz_body').append('<div class="question" id="que'+Number(rdo-1)+'"><div class="question_name">' + data['quiz_body'][i]['que_name'] + '</div><div class="answers">'+labels+'</div></div>');

                rdo++;   
            }
        }
    });

    //alert(ques_count);
    $('.ans_btn').on('click', function(){
    if (ques_count == curr_ques)
        $('.ans_btn').html('Узнать результаты');
      if (ques_count > curr_ques) {
        $('#que' + curr_ques).removeClass('current_question');
        curr_ques++;
        $('#que' + curr_ques).addClass('current_question');
        if (ques_count == curr_ques)
          $('.ans_btn').html('Узнать результаты');
      }
  
    });
    
});

