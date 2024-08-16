
function showCard(url){
    var classes = $(".class-select").val();
    var section = $(".section-select").val();


    if(classes != "" && section != "")
    {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({

            url: url,
            method: "GET",
            data: {
                classes: classes,
                section: section,
            },
            success: function (response) {



                console.log(response);

                // console.log(response);

                // show pagination number 
                var start = response.data.from;

                var links = response.data.links.length-2;

                var i; 
                var ul = document.createElement("UL");
                ul.className = "pagination";
                for(i=start;i<=links;i++)
                {
                    $(".card-pagnation").html("");

                   var li = document.createElement("LI");
                   li.className = "page-item";
                   $(ul).append(li);

                   var a = document.createElement("a");
                   a.className = "page-link";
                   a.innerHTML = i;
                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                   a.href =  currentDomainWithProtocol+"/get-student-for-id?page=" + i + "&classes=1ST&section=A";
                   $(li).append(a);

                //    get data on click 

                $(a).click(function(e){
                   e.preventDefault();
                   $(this).attr("href");
                   showCard($(this).attr("href"));
                });
                   
                }

                

                if($(".card-pagnation").html() == "")
                {
                    $(".card-pagnation").html("");
                    $(".card-pagnation").append(ul);
                }




                // return false;

                $(".print-section").removeClass("d-none");

                $(".print-section").html(``);
             if(response.message != "data not found"){
                var count = 0;
                response.data.data.forEach(function(data){
                 var increase = count++
                 var id = response.data.data[increase].id;
                 var student_image = response.data.data[increase].student_image;
                 var first_name = response.data.data[increase].first_name;
                 var middle_name = response.data.data[increase].middle_name;
                 var last_name = response.data.data[increase].last_name;
                 var gender = response.data.data[increase].gender;
                 var dob = response.data.data[increase].dob;
                 var st_phone = response.data.data[increase].phone;
                 var village = response.data.data[increase].village;
                 var municipality = response.data.data[increase].municipality;
                 var district = response.data.data[increase].district;
                 var ward_no = response.data.data[increase].ward_no;
                 var classes = response.data.data[increase].class;
                 var section = response.data.data[increase].section;

                 var school_logo = response.data.school_details[0].logo_img;
                 var school_name = response.data.school_details[0].school_name;
                 var address = response.data.school_details[0].address;
                 var website = response.data.school_details[0].website;
                 var phone = response.data.school_details[0].phone;





                 console.log(school_logo);

                //   Parents Data 
                var father_name = response.data.data[increase].parent_data.father_name;
                var father_mobile = response.data.data[increase].parent_data.father_mobile;

                var min = 10000; // Minimum five-digit number (inclusive)
                var max = 99999; // Maximum five-digit number (inclusive)
                // Generate random number
                var randomNumber = Math.floor(Math.random() * (max - min + 1) + min);
                

   
                 var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                $(".print-section").append(`
                <div class="bill-box mt-0 mr-4 mb-3" id="my-element" style="float:left;color:white;background:white; width: 54mm; height: 85.6mm; overflow: hidden; ">
                <div style="width: 100%; height: 100%;overflow: hidden;box-sizing: border-box;position: relative; background-image: url('`+currentDomainWithProtocol+`/storage/Idcard/id1.jpg'); background-size: 100% 100%;">
                
                
                   <div class="w-100 p-2 d-flex" style="background: rgb(0,84,160);
                   background: linear-gradient(90deg, rgba(0,84,160,1) 11%, rgba(42,5,151,1) 53%, rgba(0,84,160,1) 96%); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height:60px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                       <div class="d-flex align-items-center justify-content-center" style="width:20%;">
                           <img src="`+currentDomainWithProtocol+`/storage/`+school_logo+`" alt="student"> 
                       </div>
                       <div class="p-2 d-flex align-items-center justify-content-center" style="width:80%;">
                           <h6 class="p-0 m-0 text-center text-light font-weight-bold" style="font-family: 'Aoboshi One', serif;">`+school_name+`</h6>
                       </div>
                   </div>


                     <div class="student-details" style="padding-left:12px;width:100%; position: absolute;top:23%; line-height: 1.4;">
                     

                        <center>
                        <div style="border-radius:5px;overflow:hidden;width:70px;height:70px; border:3px solid #2a0597; ">
                           <img src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="student">
                        </div>
                        </center>
                        
                        <div style="width:100%;text-align:center;">
                           <span style="font-size:17px; font-weight:bold; ">`+first_name+` `+last_name+`</span> 
                        </div>

                      
                        <div style="font-size:13px;">
                            <span>F/Name :</span>
                            <span>`+father_name+`</span>
                        </div>
                        <div style="font-size:13px;">
                            <span>Class/Sec :</span>
                            <span>`+classes+' '+section+`</span>
                        </div>
                        <div style="font-size:13px;">
                            <span>Address :</span>
                            <span>`+village+` - `+ward_no+`</span>
                        </div>
                        <div style="font-size:13px;">
                            <span>Contact :</span>
                            <span>9815759505</span>
                        </div>

                        <div class="w-100 d-flex justify-content-between" style="font-size:13px; position:relative;">
                           <div class="barcode">AU`+randomNumber+`</div>
                           <span class="d-flex justify-content-center flex-column" style="position:absolute;bottom:1px; right:20px;">
                               <img src="https://www.sdmodelkarnal.com/images/bg/principal-sign.png" style="width:50px;" alt="student"> 
                               <u style="font-size:10px;">Principal</u>
                           </span>
                       </div>
                     </div>


                     <div class="w-100 text-center px-2 py-2 d-flex flex-column" style="background: rgb(0,84,160);
                     background: linear-gradient(90deg, rgba(0,84,160,1) 11%, rgba(42,5,151,1) 53%, rgba(0,84,160,1) 96%); position: absolute; bottom: 0; left: 0; line-height: 1.5; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <span style="font-size: 10px;">`+address+`</span>
                        <span style="font-size: 10px;">Contact : `+phone+`</span>
                   </div>
                   

                  </div>
                </div>
                `);


                });
             }
             else{
                alert("Student Not Found");
             }

            //  $(".pdf-download-btn").removeClass("d-none");
            //     $(".print-section").removeClass("d-none");
            
            //     // empty the print sections
            //     $(".print-section").html("");
            //     $(".print-section-2").html("");

            //     if (response.message != "data not found") {
            //         var count = 0;
            //         response.data.forEach(function(data) {
            //           var increase = count++;
            //           var id = response.data[increase].id;
            //           var student_image = response.data[increase].student_image;
            //           var first_name = response.data[increase].first_name;
            //           var middle_name = response.data[increase].middle_name;
            //           var last_name = response.data[increase].last_name;
            //           var gender = response.data[increase].gender;
            //           var dob = response.data[increase].dob;
            //           var phone = response.data[increase].phone;
            //           var village = response.data[increase].village;
            //           var municipality = response.data[increase].municipality;
            //           var district = response.data[increase].district;
            //           var ward_no = response.data[increase].ward_no;
            //           var classes = response.data[increase].class;
            //           var section = response.data[increase].section;
                  
            //           var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
                  
            //           if (increase % 10 == 0) {
            //             $(".print-section").after(`<div class="dynamic-section row" id="print-section-${Math.floor(increase / 10) + 1}"></div>`);
            //           }
                  
            //           $(`#print-section-${Math.floor(increase / 10) + 1}`).append(`
            //             <div class="bill-box mx-1 my-1" id="my-element" style="color:white;background:white; margin-bottom:10px; padding-top:5px; width: 54mm; height: 85.6mm; padding: 0px; margin: 0px; overflow: hidden; ">
            //               <div style="width: 100%; height: 100%;overflow: hidden;box-sizing: border-box;position: relative; background-image: url(currentDomainWithProtocol+'/storage/Idcard/id1.jpg'); background-size:cover;">
            //                 <div class="student-details" style="padding-left:12px;width:100%; position: absolute;top:20%;">
            //                   <center>
            //                     <div style="border-radius:100px;overflow:hidden;width:80px;height:80px; border:3px solid #888; ">
            //                       <img src="${currentDomainWithProtocol}/storage/${student_image}" alt="student">
            //                     </div>
            //                   </center>
            //                   <div style="width:100%;text-align:center;">
            //                     <span style="font-size:20px; font-weight:bold; ">${first_name} ${last_name}</span> 
            //                   </div>
            //                   <div style="font-size:15px;">
            //                     <span>Father :</span>
            //                     <span>Momtaj Husen  ${id}</span>
            //                   </div>
            //                   <div style="font-size:15px;">
            //                     <span>Class :</span>
            //                     <span>${classes} ${section}</span>
            //                   </div>
            //                   <div style="font-size:15px;">
            //                     <span>Address :</span>
            //                     <span>${village} ${ward_no}, ${municipality}</span>
            //                   </div>
            //                   <div style="font-size:15px;">
            //                     <span>Mobile :</span>
            //                     <span>9815759505</span>
            //                   </div>
            //                 </div>
            //               </div>
            //             </div>
            //           `);
            //         });
            //       } else {
            //         alert("Student Not Found");
            //       }
                  
            },
            error: function(xhr, status, error) {
                var errors = JSON.parse(xhr.responseText);
                console.log(errors.ErrorMessage);
            }


        });

    }
    else{
        alert("please select class or section");
    }
};




$(document).ready(function(){
    $(".search-btn").click(function(){

        var classes = $(".class-select").val();
        var section = $(".section-select").val();
        
        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

        showCard(currentDomainWithProtocol+"/get-student-for-id?page=1&classes=" + classes + "&section=" + section);

    });
});
 

