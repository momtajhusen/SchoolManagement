retriveComplainList();

function retriveComplainList(){

    $.ajax({
        url: "/get-all-retrive-complain-list",
        method: 'GET',
         // Success 
        success:function(response)
        {

            console.log(response);

            if(response.data){
               $('.complain-list').html('');

               var length = response.data.length;
               response.data.forEach(element => {
               var sn = length--;

                  var complains = '';
                  if(element.type == 'audio'){
                    complains = `
                      <div class="aWrap" data-src="/storage/${element.record_path}">
                      <button class="aPlay" disabled><span class="aPlayIco d-flex align-items-center" style="color: #fff !important;"><i class="material-icons">play_arrow</i></span></button>
                      <div class="range">
                        <span class="under-ranger"></span>
                        <input class="aSeek" type="range" min="0" value="0" step="1" disabled><span class="change-range"></span>
                      </div>
                      <div class="aCron">
                        <span class="aNow"></span> / <span class="aTime"></span>
                      </div>
                      <div class="volume-container">
                        <span class="aVolIco"><i class="material-icons">volume_up</i></span>
                        <div class="range-volume">
                          <span class="under-ranger"></span>
                          <input class="aVolume" type="range" min="0" max="1" value="1" step="0.1" disabled><span class="change-range"></span>
                        </div>
                      </div>
                    </div>
                    `;
                  }
                  if(element.type == 'message'){
                    complains = `
                       <sapn>${element.message}</span>
                    `;
                  }

                  $('.complain-list').append(`
                    <tr>
                        <th scope="row" style="width:80px;">${sn}</th>
                        <td>
                          <div>
                              ${complains}
                              <div>
                                    <ol class="stepper">
                                        <li>view</li>
                                        <li class="active">work start</li>
                                        <li>testing</li>
                                        <li>complit</li>
                                    </ol>
                              </div>
                          </div>
                        </td>
                        <td style="width:200px;">${element.send_by}</td>
                        <td style="width:80px;">
                          status
                        </td>
                        <td style="width:100px;">${element.date}</td>
                    </tr>
                  `);
               });

               
            }
        

        },
        error: function (xhr, status, error) 
        {
            console.log(JSON.parse(xhr.responseText));
        },
    });

}

$(document).ready(function(){
    $('.send-message').click(function(){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var message = $('.message-input').val();
        if(message == ''){
           alert('enter your message');
           return false;
        }

        $.ajax({
            url: "/complaint-message",
            method: 'POST',
            data:{
                message:message,
                current_date:current_date,

            },
             // Success 
            success:function(response)
            {

                if(response.success == true){
                     retriveComplainList();


                    Swal.fire({
                        title: "Complain Send Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                }
    
            },
            error: function (xhr, status, error) 
            {
                console.log(JSON.parse(xhr.responseText));
            },
        });
    });
});