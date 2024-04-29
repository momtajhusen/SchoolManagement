//  Retrive Fee Structer aftre class option select 
$(document).ready(function() {
    $('.select-class').change(function() {
      var selectedOption = $(this).children('option:selected').val();

      if(selectedOption != "")
      {
        $.ajax({
            url: "/retrive-fees-stracture",
            method: 'GET',
            data:{
                class: selectedOption,
            },
            beforeSend: function() 
            {
             // setting a timeout
               $(".submit-btn").addClass('d-none');
               $(".progress").removeClass('d-none');
            },
            // Progress 
                 xhr: function(){
                     var xhr = new window.XMLHttpRequest();
                     xhr.upload.addEventListener("progress", function(evt) {
                         if (evt.lengthComputable) {
                             var percentComplete = (evt.loaded / evt.total) * 100;
                             var percentComplete =  percentComplete.toFixed(2);
                             $(".progress-bar").width(percentComplete+"%");
                             $(".progress-bar").html(percentComplete+" %");
     
                         }
                     }, false);
                     return xhr;
                 },
             // Success 
            success:function(response)
            {


                $(".fee-stracture-body").html('');
                if(response.message != "data not found"){
                    console.log(response.data);
                    console.log(response.data[0].fee_type);
                    $(".fee-stracture-body").append(`
                    <tr>
                        <th>S No</th></th><th>Fee Type</th><th>₹ Baishakh </th><th>₹ Jestha</th><th>₹ Ashadh</th><th>₹ Shrawan</th>
                        <th>₹ Bhadau</th><th>₹ Asoj</th><th>₹ Kartik</th><th>₹ Mangsir</th><th>₹ Poush</th><th>₹ Magh</th><th>₹ Falgun</th><th>₹ Chaitra</th>
                    </tr>
                    `);
                    var count = 0;
                    var sncount = 1;
                    response.data.forEach(function(data){
                    var index = count++
                    var sn = sncount++;
                        $(".fee-stracture-body").append(`
                        <tr>
                            <td>`+sn+`</td>
                            <td><input type="text" disabled required name="fee-type[]" value="`+response.data[index].fee_type+`" class="px-2 no-spinners" style="width:150px;"></td>
                            <td><input type="number" disabled name="month_0[]"  value="`+response.data[index].month_0+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_1[]"  value="`+response.data[index].month_1+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_2[]"  value="`+response.data[index].month_2+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_3[]"  value="`+response.data[index].month_3+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_4[]"  value="`+response.data[index].month_4+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_5[]"  value="`+response.data[index].month_5+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_6[]"  value="`+response.data[index].month_6+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_7[]"  value="`+response.data[index].month_7+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_8[]"  value="`+response.data[index].month_8+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_9[]"  value="`+response.data[index].month_9+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_10[]" value="`+response.data[index].month_10+`" class="px-2 no-spinners" style="width:80px;"></td>
                            <td><input type="number" disabled name="month_11[]" value="`+response.data[index].month_11+`" class="px-2 no-spinners" style="width:80px;"></td>
                        </tr>
                        `);
                    });  
                    $(".fee-stracture-body").append(`
                    <tr>
                        <th></th><th class="text-center">Total : </th><th>`+response.MonthTotalFee.month_0+`</th><th>`+response.MonthTotalFee.month_1+`</th><th>`+response.MonthTotalFee.month_2+`</th><th>`+response.MonthTotalFee.month_3+`</th>
                        <th>`+response.MonthTotalFee.month_4+`</th><th>`+response.MonthTotalFee.month_5+`</th><th>`+response.MonthTotalFee.month_6+`</th><th>`+response.MonthTotalFee.month_7+`</th><th>`+response.MonthTotalFee.month_8+`</th><th>`+response.MonthTotalFee.month_9+`</th><th>`+response.MonthTotalFee.month_10+`</th><th>`+response.MonthTotalFee.month_11+`</th>
                    </tr>
                    `);
                }

            else{
                $(".fee-stracture-body").append(`
                <tr>
                   <th>S No</th><th>Action</th><th>Fee Type</th><th>₹ Baishakh </th><th>₹ Jestha</th><th>₹ Ashadh</th><th>₹ Shrawan</th>
                   <th>₹ Bhadau</th><th>₹ Asoj</th><th>₹ Kartik</th><th>₹ Mangsir</th><th>₹ Poush</th><th>₹ Magh</th><th>₹ Falgun</th><th>₹ Chaitra</th>
                </tr>
                <tr class="not-fee-tr">
                  <td class="text-center p-4" colspan = "14">Fee stracture not created for this class ! Cerete Now</td>
                </tr>
                `);
               }

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
      }

      else{
        alert("empty");
      }
    

    });
  });