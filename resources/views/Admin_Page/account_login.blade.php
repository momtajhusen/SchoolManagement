<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACCOUNT LOGIN</title>
        <!-- Main CSS -->
        <link rel="stylesheet" href="admin_template_assets/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="admin_template_assets/css/bootstrap.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="admin_template_assets/style.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Ajax CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>


         <!-- ajax  -->
        <script src="{{ asset('admin_lang/accountLogin/ajax-login.js')}}?v={{ time() }}"></script> 

        {{-- Google Ico Cdn  --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        

 
    <style>
        body{
            background-color: #042954;
        }

        .sigin_box{
        width:300px;
        height:550px;
        box-sizing: border-box;
        border-radius:10px;
        /* box-shadow:0px 0px 10px 10px rgb(20, 17, 17); */
        overflow: hidden;
    }
    .card-container{
       background: #03162c;
    }

    .login-accourding-btn{
        cursor: pointer;
        background-color: #042954;
        color: aliceblue;
    }
    .login-accourding{
        overflow: hidden;
    }

 
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 1,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}
 
    </style>
</head>
<body>

        <div class="d-flex justify-content-center align-items-center" style="width:100vw; height:100vh;">
             <div class="sigin_box">
                <div class="card ui-tab-card h-100 p-0" >
                    <div class="card-body py-5 card-container">

                        <div class="border-nav-tab">
                            {{-- <div class="accordion" id="accordionExample">
                                <div class="card p-0">
                                    <div class="card-header p-0" id="headingTwo">
                                        <div class="collapsed w-100 login-accourding-btn p-3 d-flex justify-content-center" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="login-accourding-btn-text">SUPER ADMIN</span>
                                            <span class="material-symbols-outlined">arrow_right</span>
                                        </div>
                                    </div>
                                
                                    <div id="collapseTwo" class="collapse position-absolute" aria-labelledby="headingTwo" data-parent="#accordionExample" style="top:47px;z-index:1000;">
                                      <div class="card-body shadow-none p-0" style="background-color: #042954;">
                                        <ul class="nav nav-tabs border-0 px-0" role="tablist">
                                            <li class="nav-item border w-100 active shadow-none" id="super_admin">
                                                <a class="nav-link text-light" data-toggle="tab" href="#tab7" role="tab" aria-selected="false">SUPER ADMIN</a>
                                            </li>
                                            <li class="nav-item border w-100">
                                                <a class="nav-link text-light shadow-none" data-toggle="tab" href="#tab8" role="tab" aria-selected="true">
                                                    STUDENT MANAGEMENT
                                                </a>
                                            </li>
                                            <li class="nav-item border w-100 shadow-none" id="account_management">
                                                <a class="nav-link text-light" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">ACCOUNT MANAGEMENT</a>
                                            </li>
                                            <li class="nav-item border w-100 shadow-none">
                                                <a class="nav-link text-light" data-toggle="tab" href="#tab10" role="tab" aria-selected="false">SCHOOL MANAGEMENT</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                            </div> --}}

                            <div class="tab-content pt-2 d-flex flex-column align-items-center justify-content-start" style="height:500px;">
                                {{-- super admin panel  --}}
                                <div class="tab-pane fade show p-3  w-100" id="tab7" role="tabpanel">
                                    <div class="p-3 my-5 d-flex flex-column justify-content-between align-items-center">
                                        <span class="material-symbols-outlined text-light" style="font-size:30px;">admin_panel_settings</span>
                                        <b class="text-center text-light">SUPER ADMIN</b>
                                    </div>
                        
                                    <form class="super-admin-form" style="height:300px;">
                                    <div class="form-group">
                                        <label class="text-light">Username</label>
                                        <input type="email" required name="email" id="super-admin-user" placeholder="Username" class="form-control w-100">
                                    </div>
                                    <div class="form-group position-relative">
                                        <label class="text-light">Password</label>
                                        <input type="password" required name="password" id="super-admin-psd" placeholder="Password" class="form-control w-100">
                                        <span class="material-symbols-outlined position-absolute" id="eye-icon" style="cursor:pointer;top:45px;right:10px;font-size:20px;">visibility_off</span>
                                    </div>
                                    <br>
                                    <div class="form-group submit-btn">
                                        <input type="submit" name="capacity" placeholder="Username" class="form-control w-100">
                                    </div>
                                    {{-- Login alert  --}}
                                        <div class="alert alert-success align-items-center alert-info d-none" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                            <b>Login Success</b>
                                        </div>
                                        <div class="alert alert-danger align-items-center alert-info d-none" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        <b class="alert-text">Login Success</b>
                                    </div>
                                    </form>
                                </div>
                                {{-- student management panel  --}}
                                <div class="tab-pane fade p-3 show w-100" id="tab8" role="tabpanel">

                                    <div class="p-3 my-5 d-flex flex-column justify-content-between align-items-center">
                                        <span class="material-symbols-outlined text-light" style="font-size:30px;">group</span>
                                        <b class="text-center text-light">STUDENT MANAGEMENT</b>
                                    </div>
                      
                                    <form class="student-management-form" style="height:300px;">
                                    <div class="form-group">
                                        <label class="text-light">Username</label>
                                        <input type="email" required name="email" placeholder="Username" class="form-control w-100">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-light">Password</label>
                                        <input type="password" required name="password" placeholder="Password" class="form-control w-100">
                                    </div>
                                    <br>
                                    <div class="form-group submit-btn">
                                        <input type="submit" name="capacity" placeholder="Username" class="form-control w-100">
                                    </div>
                                    {{-- Login alert  --}}
                                     <div class="alert alert-success align-items-center alert-info d-none" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                          <b>Login Success</b>
                                      </div>
                                      <div class="alert alert-danger align-items-center alert-info d-none" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                      <b class="alert-text">Login Success</b>
                                    </div>
                                   </form>
                                </div>
                                {{-- account management panel  --}}
                                <div class="tab-pane fade show p-3  w-100" id="tab9" role="tabpanel">

                                    <div class="p-3 my-5 d-flex flex-column justify-content-between align-items-center">
                                        <span class="material-symbols-outlined text-light" style="font-size:30px;">account_balance</span>
                                        <b class="text-center text-light">ACCOUNT MANAGEMENT</b>
                                    </div>
                      
                                    <form class="account-management-form" style="height:300px;">
                                    <div class="form-group">
                                        <label class="text-light">Username</label>
                                        <input type="email" required name="email" placeholder="Username" class="form-control w-100">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-light">Password</label>
                                        <input type="password" required name="password" placeholder="Password" class="form-control w-100">
                                    </div>
                                    <br>
                                    <div class="form-group submit-btn">
                                        <input type="submit" name="capacity" placeholder="Username" class="form-control w-100">
                                    </div>
                                    {{-- Login alert  --}}
                                     <div class="alert alert-success align-items-center alert-info d-none" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                          <b>Login Success</b>
                                      </div>
                                      <div class="alert alert-danger align-items-center alert-info d-none" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                      <b class="alert-text">Login Success</b>
                                    </div>
                                   </form>
                                </div>
                                {{-- school management panel  --}}
                                <div class="tab-pane fade p-3 show w-100" id="tab10" role="tabpanel">
                                    <div class="p-3 my-5 d-flex flex-column justify-content-between align-items-center">
                                        <span class="material-symbols-outlined text-light" style="font-size:30px;">apartment</span>
                                        <b class="text-center text-light">SCHOOL MANAGEMENT</b>
                                    </div>
                      
                                    <form class="school-management-form" style="height:300px;">
                                    <div class="form-group">
                                        <label class="text-light">Username</label>
                                        <input type="email" required name="email" placeholder="Username" class="form-control w-100">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-light">Password</label>
                                        <input type="password" required name="password" placeholder="Password" class="form-control w-100">
                                    </div>
                                    <br>
                                    <div class="form-group submit-btn">
                                        <input type="submit" name="capacity" placeholder="Username" class="form-control w-100">
                                    </div>
                                    {{-- Login alert  --}}
                                     <div class="alert alert-success align-items-center alert-info d-none" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                          <b>Login Success</b>
                                      </div>
                                      <div class="alert alert-danger align-items-center alert-info d-none" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                      <b class="alert-text">Login Success</b>
                                    </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>

       <!-- jquery-->
       <script src="admin_template_assets/js/jquery-3.3.1.min.js"></script>
       <!-- Bootstrap js -->
       <script src="admin_template_assets/js/bootstrap.min.js"></script>

      <script>
        // Select Account Toggle 
        $(document).ready(function(){
            var lastActiveToggle = localStorage.getItem('lastActiveToggle');

            if(lastActiveToggle)
            {
                $(".login-accourding-btn-text").html(lastActiveToggle);

            }
            $("#account_management").click();
            $(".nav-item").each(function(){
                $(this).click(function(){
                $(".login-accourding-btn").click();
                $(".login-accourding-btn-text").html($(this).find("a").html());
                localStorage.setItem('lastActiveToggle', $(this).find("a").html());

                });
            });
        });

        // Last Select Tab Auto Atuto Select
        $(document).ready(function(){
            // Get the last active tab content from local storage
            var lastActiveTabContent = localStorage.getItem('lastActiveTabContent');

            // If there was a last active tab content, select it
            if (lastActiveTabContent) 
            {
            $('#' + lastActiveTabContent).addClass('active show');
            }
            else{
            $('#tab7').addClass('active show');
            }
 
            $(".nav-item").each(function(){ 
                 $(this).click(function(){
                    var select_tab = $(this).find("a").attr("href").substr(1);
                    localStorage.setItem('lastActiveTabContent', select_tab);
                 });    
            });
    });

        // Eye icon password 
        $(document).ready(function(){
            $('#eye-icon').click(function(){
            var eyehtml = $(this).html();
            if(eyehtml == 'visibility_off'){
                $(this).html('visibility');
                $('#super-admin-psd').attr('type', 'text');
            }
            if(eyehtml == 'visibility'){
                $(this).html('visibility_off');
                $('#super-admin-psd').attr('type', 'password');
            }
            });
        });
      </script>
 
</body>
</html>