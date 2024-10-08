@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
@endsection



@section('script')
    <!-- ajax Get All Exam Term -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- ajax print admit card-->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_print_admit_card.js')}}?v={{ time() }}"></script> 


@endsection




 
@section('contents')

    <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Print Admit Cards</h3>
                        </div>
                    </div>

                    <form class="mg-b-20 admit-card-form">
                        <div class="row gutters-8">

                            <div class="col-lg-3 col-12 form-group">
                                <label>Class *</label>
                                <select name="class" required class="select2 class-select" id="class-select" style="height:45px;width:100%; padding:10px;">

                                </select>
                            </div>
                            <div class="col-lg-3 col-12 form-group">
                                <label>Section *</label>
                                <select name="class" required class="select2 section-select"  style="height:45px;width:100%; padding:10px;">

                            </select>
                            </div>
                            <div class="col-lg-3 col-12 form-group">
                                <label>Exam *</label>
                                <select name="class" required class="select2 select-exam-term" style="height:45px;width:100%; padding:10px;">

                                </select>
                            </div>
                            <div class="col-lg-3 col-12 form-group d-flex align-items-end">
                                <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="Print Admit Cards">Print Admit Cards</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <div class="admit-card-box d-none"></div>
@endsection
