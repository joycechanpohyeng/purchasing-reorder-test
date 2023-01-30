function generate(data_len){
    document.writeln(data_len);
    // var btn_document = document.querySelector("button.btn-primary");
    // document.write(btn_document);
   
    
    if (Number(data_len) > 0){
        
        for (let i = 0; i<data_len; i++){
            var n = i+1;
            var radio_name = 'message-check-box_'+ n;
            
            // var radiobtn = Array.prototype.slice.call(document.querySelectorAll(`input[name= ${radio_name}]`))
            // var radio_value = Array.from(radiobtn, radio=>radio.value)
            // document.writeln(radio_name, ',');
            // document.writeln('radio_value: ', radio_value);

            // radiobtn.forEach(function(btn){
            //     // Set each button to have a click event handler
            //     btn.addEventListener("click", function(){
            //       // Set the radio button's value as the id of the submit button
            //     sub.setAttribute(radio_name, btn.value);
                  
            //     // Just for testing:
            //     document.write(sub);
            //     });
            // });

            // var elements = document.getElementsByName(radio_name);
            // var cross_id = elements.getAttribute('cross_radio') 
            
            var element = document.getElementsByName(radio_name);
            var tick_id = element[0].id;
            var cross_id = element[1].id;
            
            // wrong
            // if (element.getElementById(tick_id).checked){
            //     element.getElementById('true').disable = true;
            // }
        }
    }
    
}


$(document).on('click', '#generateMsg', function(event){
    event.preventDefault();
    let href = $(this).attr('data-attr');
    $.ajax({
        url:href,
        beforeSend: function(){
            $('#loader').show();
        },

        // return result
        success: function($result){
            $('#modalLongReorder').modal("show");
            $('#modal_body').html(result).show();
        },
        complete:function(){
            $('loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    })
});



function showImage(){
    var modal = document.getElementById("imgModal");
    var img = document.getElementById("skuImg");
    var modalImg = document.getElementById("modalImg");
    var captionText = document.getElementById('caption');

    img.onclick = function(){
        modal.style.display="block";
        modalImg.src = this.src;
        caotionText.innerHTML = this.alt;
    }

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function(){
        modal.style.display = "none";
    }
}


