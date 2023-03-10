@extends('Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/jquery.dataTables.min.css')}}">
    <!-- Common CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_lang/common/style.css')}}">
@endsection

@section('script')
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/student/ajax-student-details.js')}}"></script> 

 
@endsection

@section('contents')
<input type="hidden" value="{{$id}}" class="student_id" >
                     <!-- Breadcubs Area Start Here -->
                     <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Student Details </li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Student Details Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>About Me</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-info-details">
                            <div class="item-content">
                            <div class="row">
                             <div class="col-xl-5 col-lg-6 col-12 form-group border">
                                <div class="item-img">
                                    <img class="student_image" src="#" alt="student" style="width:200px;">
                                </div>
                                <div class="header-inline item-header">
 
                                    <div class="header-elements">
                                        <ul>
                                            <li><a href="#"><i class="far fa-edit"></i></a></li>
                                            <li><a href="#"><i class="fas fa-print"></i></a></li>
                                            <li><a href="#"><i class="fas fa-download"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
 
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="font-medium text-dark-medium name"> </td>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td class="font-medium text-dark-medium class"> </td>
                                            </tr>
                                            <tr>
                                                <td>Section:</td>
                                                <td class="font-medium text-dark-medium section"> </td>
                                            </tr>
                                            <tr>
                                                <td>Roll:</td>
                                                <td class="font-medium text-dark-medium roll"> </td>
                                            </tr>
                                            <tr>
                                                <td>Admission Date:</td>
                                                <td class="font-medium text-dark-medium admission_date"> </td>
                                            </tr>
                                            <tr>
                                                <td>Religion:</td>
                                                <td class="font-medium text-dark-medium religion"> </td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td class="font-medium text-dark-medium gender"> </td>
                                            </tr>
                                            <tr>
                                                <td>Date Of Birth:</td>
                                                <td class="font-medium text-dark-medium dob"> </td>
                                            </tr>
                                            <tr>
                                                <td>Father Name:</td>
                                                <td class="font-medium text-dark-medium rfather"> </td>
                                            </tr>
                                            <tr>
                                                <td>Mother Name:</td>
                                                <td class="font-medium text-dark-medium mother"> </td>
                                            </tr>
                    
                   
                                            <tr>
                                                <td>Father Occupation:</td>
                                                <td class="font-medium text-dark-medium father_occupation"> </td>
                                            </tr>
                                            <tr>
                                                <td>E-mail:</td>
                                                <td class="font-medium text-dark-medium email"> </td>
                                            </tr>
             
                 
                                            <tr>
                                                <td>Address:</td>
                                                <td class="font-medium text-dark-medium address">House #10, Road #6, Australia</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td class="font-medium text-dark-medium phone">+ 88 98568888418</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </div>

                             <div class="col-xl-7 col-lg-6 col-12 form-group border">

                                    <div class="card ui-tab-card">
                    <div class="card-body">
                        <div class="heading-layout1 mg-b-25">
                    
 
                        <div class="custom-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab4" role="tab" aria-selected="true">Check Fee</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab5" role="tab" aria-selected="false">Payment Bills</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                     <div class="weekDays-selector">
                                        <div class="row px-4">
                                                <input type="checkbox" value="month_0" id="0" class="month-btn" />
                                                <label for="0">Baisakh</label>
                                 
                                                <input type="checkbox" value="month_1" id="1" class="month-btn" />
                                                <label for="1">Jestha</label>
                          
                                                <input type="checkbox" value="month_2" id="2" class="month-btn" />
                                                <label for="2">Ashar</label>
                               
                                                <input type="checkbox" value="month_3" id="3" class="month-btn" />
                                                <label for="3">Shrawan</label>
                              
                                               <input type="checkbox" value="month_4" id="4" class="month-btn" />
                                                <label for="4">Bhadra</label>
                                    
                                                <input type="checkbox" value="month_5" id="5" class="month-btn" />
                                                <label for="5">Ashoj</label>
                                
                                                <input type="checkbox" value="month_6" id="6" class="month-btn" />
                                                <label for="6">Kartik</label>
                         
                                                <input type="checkbox" value="month_7" id="7" class="month-btn" />
                                                <label for="7">Mangsir</label>
                          
                                                <input type="checkbox" value="month_8" id="8" class="month-btn" />
                                                <label for="8">Poush</label>
                     
                                                <input type="checkbox" value="month_9" id="9" class="month-btn" />
                                                <label for="9">Magh</label>
                                  
                                                <input type="checkbox" value="month_10" id="10" class="month-btn" />
                                                <label for="10">Falgun</label>
                                  
                                                <input type="checkbox" value="month_11" id="11" class="month-btn" />
                                                <label for="11">Chaitra</label> 
                                            
                                        </div>
                                    </div>
                                 
                                <div class="p-5" style="background:#f3b38f;">
                                    <table class="table" style=";width:90%;">
                                        <div class="mb-2" style="border-top:1px solid black;border-bottom:1px solid black;height:100px;">
                                            <h3 class="my-3"><b>INVOICE</b><h3>
                                            <span class="name"><snan>
                                        <div>
                                        <thead class="border-dark text-dark font-weight-bold">
                                            <tr>
                                                <td class="border-dark" scope="col">Fee Type</td>
                                                <td class="border-dark" scope="col">Amount</td>
                                            </tr>
                                        </thead>
                                        <tbody class="fee_stracture">
            

                                        </tbody>
                                        <tbody>
                                        <tr>
                                                <td class="text-center" colspan="1">Total Fee :</td>
                                                <td class="total_amount">@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                          
          
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel">
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                    and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                    alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries, but also</p>
                                </div>
                                <div class="tab-pane fade" id="tab6" role="tabpanel">
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                    and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                    alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries, but also</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

     
                             </div>


                            
                             </div>






                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Details Area End Here -->
@endsection
