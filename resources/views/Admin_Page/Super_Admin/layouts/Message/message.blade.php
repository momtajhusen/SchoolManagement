@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
  <style>
  .form-check{
    cursor: pointer;
    z-index: 1;
    background: #000000;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #434343, #000000);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #434343, #000000); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color: aliceblue;
    user-select: none;
  }
 

    .form-check-input[type="checkbox"] {
        width: 1.5em;
        height: 1.5em;
    }
  </style>
@endsection

@section('script')
  <script src="{{ asset('../admin_lang/MessageSend/meaasgeSend.js')}}?v={{ time() }}"></script>
@endsection


@section('contents')
 
           <div class="row">
            <!-- Add Notice Area Start Here -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Compose New Message</h3>
                            </div>
                        </div>
                        <form class="new-added-form" id="send-mail-form">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Subject</label>
                                    <input type="text" required name="subject" placeholder="Subject" class="form-control">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Message</label>
                                    <textarea class="textarea form-control py-4" required placeholder="Compose Your Message" name="message" id="form-message" cols="10"
                                    rows="9"></textarea>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" id="message_send_btn" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark d-flex">
                                        Message Send
                                    </button>

                                    <div class=" w-50 border d-none">
                                        Message Sending
                                        <span class="material-symbols-outlined fa-spin">restart_alt</span>
                                    </div>
        

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Notice Area End Here -->

            <!-- All Notice Area Start Here -->
            <div class="col-xl-4">
                <div class="card message-box-wrap height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Select For Message Send</h3>
                            </div>
                        </div>

                        <form class="d-flex flex-column">
                          <div class="form-check form-check-inline border p-3 mb-2 d-flex justify-content-between">
                            <input class="form-check-input message-checkbox" name="teachers" value="off" type="checkbox" id="inlineCheckbox1">
                            <label class="form-check-label text-light" for="inlineCheckbox1"><b>Teachers</b></label>
                            <span class="material-symbols-outlined mx-2 icon d-none">send</span>
                          </div>

                          <div class="form-check form-check-inline p-3 d-flex justify-content-between">
                            <input class="form-check-input message-checkbox" name="parents" value="off" type="checkbox" id="inlineCheckbox2">
                            <label class="form-check-label text-light" for="inlineCheckbox2"><b>Parents</b></label>
                            <span class="material-symbols-outlined mx-2 icon d-none">send</span>
                          </div>

                        </form>
 
                    </div>
                </div>
                <div class="card message-box-wrap height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Select Class Message</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- All Notice Area End Here -->

        </div>

        <script>
          $(document).ready(function() {
            // Add a click event listener to all checkboxes with class "form-check-input"
            $(".form-check").each(function() {
                $(this).click(function(){
                    if($(this).find("input").is(":checked"))
                    {
                        $(this).find("input").prop("checked", false)
                        $(this).find("input").val("off");
                        $(this).find(".icon").addClass("d-none");

                    }
                    else{
                        $(this).find("input").prop("checked", true)
                        $(this).find("input").val("message");
                        $(this).find(".icon").removeClass("d-none");
                    }
                });
            });
          });
        </script>

@endsection
