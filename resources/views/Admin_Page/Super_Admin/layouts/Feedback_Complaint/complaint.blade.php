@extends('Admin_Page/Super_Admin/admin_template')

@section('script')

    <!-- complain audio record-->
    <script src="{{ asset('../admin_lang/complain_feedBack/complain_audio_record.js')}}?v={{ time() }}"></script> 

    <!-- ajax_compalin_audio -->
    <script src="{{ asset('../admin_lang/complain_feedBack/ajax_compalin_audio.js')}}?v={{ time() }}"></script> 

    <!-- audio-player.js -->
    <script src="{{ asset('../admin_lang/complain_feedBack/audio-player.js')}}?v={{ time() }}"></script> 


@endsection

@section('style')

    <!-- Audio Player Style -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/complaint_style/audio_player.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <style>

ol.stepper {
  --default-b: lightgrey;
  --default-c: black;
  --active-b: rgb(36, 128, 0);
  --active-c: white;
  --circle: 3.5em; /* size of circle */
  --b: 5px; /* line thickness */
  
  display: flex;
  list-style: none;
  justify-content: space-between;
  background: 
    linear-gradient(var(--default-b) 0 0) no-repeat
    50% calc((var(--circle) - var(--b))/2)/100% var(--b);
  counter-reset: step;
  margin: 0px;
  padding: 0;
  font-size: 10px;
  font-weight: bold;
  counter-reset: step;
  overflow: hidden;
}
ol.stepper li {
  display: grid;
  place-items: center;
  gap: 5px;
  font-family: sans-serif;
  position: relative;
}
ol.stepper li::before {
  content: counter(step) " ";
  counter-increment: step;
  display: grid;
  place-content: center;
  aspect-ratio: 1;
  height: var(--circle);
  border: 5px solid #fff;
  box-sizing: border-box;
  background: var(--active-b);
  color: var(--active-c);
  border-radius: 50%;
  font-family: monospace;
  z-index: 1;
}
ol.stepper li.active ~ li::before{
  background: var(--default-b);
  color: var(--default-c);
}
ol.stepper li.active::after {
  content: "";
  position: absolute;
  height: var(--b);
  right: 100%;
  top: calc((var(--circle) - var(--b))/2);
  width: 100vw;
  background: var(--active-b);
}

/* recorder  */
.button {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 22px;
    gap: 8px;
    height: 40px;
    border: none;
    background: #1b1b1cde;
    color: #ffff;
    cursor: pointer;
}


.button:hover {
    background: #1b1b1c;
}

.button:hover .svg-icon {
    animation: scale 1s linear infinite;
}
@keyframes scale {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05) rotate(10deg);
    }

    100% {
        transform: scale(1);
    }
}

     </style>
@endsection


@section('contents')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active d-flex align-items-center" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            <span class="material-symbols-outlined mr-2">comment</span>
            {{-- <span>Complaint</span>   --}}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
            <span class="material-symbols-outlined">mic</span>
            {{-- <span>Complaint</span>   --}}
          </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <ul class="list-group mt-4">
                <li class="list-group-item">
                    <div class="input-group">
                        <textarea class="form-control shadow-none message-input" aria-label="With textarea" style="height:100px;"></textarea>
                    </div>
                     <button class="button mt-1 send-message">Send</button>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <ul class="list-group mt-4">
                <li class="list-group-item">
                     <div class="p-3 border d-flex align-items-center" style="height:100px;">
                         <div>
                            <div class="container">
                                <audio id="recorder" muted hidden></audio>
                                <div>
                                   
                                    {{-- <button id="stop">Stop Recording</button> --}}

                                    <button class="button" id="start">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none" class="svg-icon"><g stroke-width="2" stroke-linecap="round" stroke="#ff342b"><rect y="3" x="9" width="6" rx="3" height="11"></rect><path d="m12 18v3"></path><path d="m8 21h8"></path><path d="m19 11c0 3.866-3.134 7-7 7-3.86599 0-7-3.134-7-7"></path></g></svg>
                                        <span class="label">Record</span>
                                    </button>
                                    <button class="button d-none" id="stop">&#x23F9; Stop</button>

                                </div>
                                <div class="recording-result d-none">
                                    <div class="d-flex flex-column">
                                        <audio id="player" controls class="complain-audio"></audio>
                                        <div class="d-flex">
                                            <button class="button mx-2" id="send">Send</button>
                                            <button class="button mx-2" id="cancle">Cancle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                         {{-- <div class="border">
                            Hi
                         </div> --}}
                     </div>
                </li>
            </ul>
        </div>
    </div>




      <div class="card height-auto mt-3">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Complain List</h3>
                </div>
            </div>
            <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th scope="col">SN.</th>
                    <th scope="col">Complaint</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody class="complain-list">
                
                </tbody>
              </table>
        </div>
        </div>

@endsection