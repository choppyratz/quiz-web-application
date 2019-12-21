$(window).on('load',function(){
    //let url = navigator.
    //$.ajax({
    //    url:
    //});
    let url = window.location.toString();
    let slashCount = 0;
    let uri = '';
    let id = '';
    for (let i = 0; i < url.length; i++) {
        if (slashCount  >= 4) {
            id +=  url[i];
        }
        if (url[i] == '/') {
            slashCount++;
        }

        if (slashCount >= 3) {
            uri += url[i];
        }


    }
    //alert(id);
    let obj;
    let curr_ques;
    let ques_count;
    $.ajax({
        url: uri,
        method: 'POST',
        success: function(data) {
            obj = data;
            console.log(obj);
            //curr_ques = 0;
            for (let i = 0; i < data['curr_res'][0].length; i++) {
                if (data['curr_res'][0][i] == "not") {
                    curr_ques = i;
                    break;
                }
            }
            console.log(curr_ques);
            
            ques_count = Object.keys(obj['quiz_body']).length - 1; 
            if (ques_count == curr_ques)
                $('.ans_btn').html('Узнать результаты');
            console.log(ques_count);
            let opt = curr_ques + 1; 
            let rdo = curr_ques + 1;
            $('.quiz_name').html(data['name']);
            //console.log(curr_ques);
            for (let i = curr_ques; i < data['quiz_body'].length; i++) {
                let labels = '';
                for (let j = 0; j < data['quiz_body'][i]['que_variants'].length; j++) {
                    labels += '<label for="opt' + opt + '" class="radio"><input type="radio" name="rdo' + rdo+ '" id="opt' + opt + '" class="hidden"><span class="label"></span>' + data['quiz_body'][i]['que_variants'][j] + '</label>';
                    opt++;
                }
                if (i == curr_ques)
                    $('.quiz_body').append('<div class="question current_question" id="que'+Number(rdo-1)+'"><div class="question_name">' + data['quiz_body'][i]['que_name'] + '</div><div class="answers">'+labels+'</div></div>');
                else    
                $('.quiz_body').append('<div class="question" id="que'+Number(rdo-1)+'"><div class="question_name">' + data['quiz_body'][i]['que_name'] + '</div><div class="answers">'+labels+'</div></div>');

                rdo++;   
            }
        }
    });

    function sleepFor( sleepDuration ){
        var now = new Date().getTime();
        while(new Date().getTime() < now + sleepDuration){ /* do nothing */ } 
    }

    function redirect() {
        $('#que' + curr_ques).removeClass('current_question');
        curr_ques++;
        $('#que' + curr_ques).addClass('current_question');
        $('.radio').removeClass('red');
        $('.radio').removeClass('green');
        if (ques_count == curr_ques) {
            $('.ans_btn').html('Узнать результаты');
        }
    }
    //alert(ques_count);
    $('.ans_btn').on('click', function(){
    let isTrueAns = "false";
    //console.log(obj['quiz_body'][curr_ques]['true_answer']);
    if (ques_count == curr_ques) {
        //$('.ans_btn').html('Узнать результаты');
        $('.current_question').find('.answers').find('.radio').each(function(index){
            if ($(this).find('input').prop("checked")){
                //alert($(this).find('input').prop("checked"));
                if (index == obj['quiz_body'][curr_ques]['true_answer']) {
                    $('.radio').addClass('red');
                    $(this).addClass('green');
                    isTrueAns = "true"; 
                    //sleepFor(1000);
                    //alert();
                    //return;
                }else {
                    $('.current_question').find('.answers').find('.radio').addClass('red'); 
                    $('.current_question').find('.answers').find('.radio').eq(obj['quiz_body'][curr_ques]['true_answer']).addClass('green');      
                }
            }
        });
        //$('#que' + curr_ques).removeClass('current_question');
        curr_ques++;
        //$('#que' + curr_ques).addClass('current_question');
    }

      if (ques_count > curr_ques) {
        $('.current_question').find('.answers').find('.radio').each(function(index){
            if ($(this).find('input').prop("checked")){
                if (index == obj['quiz_body'][curr_ques]['true_answer']) {
                    $('.radio').addClass('red');
                    $(this).addClass('green'); 
                    isTrueAns = "true";
                    //sleepFor(3000);
                    //alert(); 
                    //return;
                }else {
                    $('.current_question').find('.answers').find('.radio').addClass('red'); 
                    $('.current_question').find('.answers').find('.radio').eq(obj['quiz_body'][curr_ques]['true_answer']).addClass('green');   
                }
            }
        });
        $.ajax({
            url: uri,
            method: 'POST',
            async:true,
            data: JSON.stringify([isTrueAns, curr_ques, id, ques_count]),
            success: function(data) {
                console.log(data);
            }
        });
        //sleepFor(3000);
        setTimeout(redirect,1000);
        //sleepFor(3000);
      }
  
    });
    
});

