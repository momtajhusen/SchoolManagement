@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">

    <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>
 
@endsection

@section('script')
    <!-- ajax CheckClassFee -->
    <script src="{{ asset('../admin_lang/fees/ajax-CheckClassFee.js')}}?v={{ time() }}"></script>
    
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/SuperAdminDashboard/ajax-SuperAdminDashobard.js')}}?v={{ time() }}"></script>

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
@endsection


@section('contents')
                    <!-- Sidebar Area End Here -->
                    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area d-flex justify-content-between p-0">
                   <div class="py-3">
                        <ul>
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>Dashboard</li>
                        </ul>
                   </div>
                   <span class="material-symbols-outlined" id="eye" style="cursor: pointer">visibility</span>

                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Students</div>
                                        <div class="item-number">
                                            <span class="total-astudent-count number-icon">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">New Students</div>
                                        <div class="item-number"><span class="new-astudent-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Leaved Students</div>
                                        <div class="item-number"><span class="kickout-astudent-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-yellow">
                                        <i class="flaticon-couple text-orange"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Parents</div>
                                        <div class="item-number"><span class="parents-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Teachers</div>
                                        <div class="item-number"><span class="techer-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">New Teachers</div>
                                        <div class="item-number"><span class="techer-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20" style="overflow: hidden;">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-money text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Earning</div>
                                        <div class="item-number"><span>₹ </span><span class="total-earning number-icon" >0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Notification</div>
                                        <div class="item-number"><span class="techer-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Login Devices</div>
                                        <div class="item-number"><span class="techer-count number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-money text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Advance</div>
                                        <div class="item-number"><span class="total-advance-payment number-icon">0</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
 
                <!-- Dashboard summery End Here -->
                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-12 col-xl-8 col-6-xxxl">
                        <div class="card dashboard-card-one pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Earning History</h3>
                                    </div>
                                </div>
                                <div class="earning-report">
                                    <div class="item-content w-100 d-flex justify-content-between">
                                        <div>
                                            <span class="m-0" style="color: #ab9fa8;">Total Collection</span>
                                            <div class="d-flex">
                                                <span class="mr-2">₹ </span><h3 class="p-0 m-0 number-icon" id="collection-amount" style="font-size:bold;">0</h3>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="m-0" style="color: #ab9fa8;">Total History</span>
                                            <div class="d-flex">
                                                 <h3 class="p-0 m-0 number-icon" id="total-history" style="font-size:bold;">0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-5" style="height:350px; width:100%;">
                                    <canvas id="month-earning-chart" style="height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 col-3-xxxl">
                        <div class="card dashboard-card-two pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Expenses</h3>
                                    </div>
                                </div>
                                <div class="expense-report d-flex justify-content-between">
                                    {{-- <div class="monthly-expense pseudo-bg-Aquamarine">
                                        <div class="expense-date">Jan 2019</div>
                                        <div class="expense-amount"><span>₹ </span> 15,000</div>
                                    </div>
                                    <div class="monthly-expense pseudo-bg-blue">
                                        <div class="expense-date">Feb 2019</div>
                                        <div class="expense-amount"><span>₹ </span> 10,000</div>
                                    </div> --}}
                                    <div>
                                        <span class="m-0" style="color: #ab9fa8;">Total Expenses</span>
                                        <div class="d-flex">
                                            <span class="mr-2">₹ </span><h3 class="p-0 m-0 number-icon" id="exp-amount" style="font-size:bold;">0</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="m-0" style="color: #ab9fa8;">History</span>
                                        <div class="d-flex">
                                             <h3 class="p-0 m-0 number-icon" id="total-exp-history" style="font-size:bold;">0</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="expense-chart" style="height:350px; width:100%;">
                                    <canvas id="expense-chart" style="height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 col-3-xxxl">
                        <div class="card dashboard-card-three pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Students</h3>
                                    </div>
                                </div>
                                
                                {{-- <div class="doughnut-chart-wrap">
                                    <canvas id="student-doughnut-chart" width="100" height="300"></canvas>
                                </div> --}}

                                 <div class="mb-5 d-flex justify-content-center align-items-center" style="height:350px;">
                                    <canvas id="gender-chart" width="300" height="300"></canvas>
                                  </div>


                                <div class="student-report">
                                    <div class="student-count pseudo-bg-yellow">
                                        <h4 class="item-title">Male Students</h4>
                                        <div class="item-number number-icon" id="male-number">0</div>
                                    </div>
                                    <div class="student-count pseudo-bg-blue">
                                        <h4 class="item-title">Female Students</h4>
                                        <div class="item-number number-icon" id="female-number">0</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 col-4-xxxl">
                        <div class="card dashboard-card-four pd-b-20">
                            <div class="card-body">
                                {{-- <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Event Calender</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

 
                                    </div>
                                </div> --}}
                                {{-- <div class="calender-wrap">
                                    <div id="fc-calender" class="fc-calender"></div>
                                </div> --}}
 
                            </div>
                        </div>
                    </div>
                    <div class="d-none col-lg-6 col-xl-6 col-4-xxxl">
                        <div class="card dashboard-card-five pd-b-20">
                            <div class="card-body pd-b-14">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Website Traffic</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="traffic-title">Unique Visitors</h6>
                                <div class="traffic-number">2,590</div>
                                <div class="traffic-bar">
                                    <div class="direct" data-toggle="tooltip" data-placement="top" title="Direct">
                                    </div>
                                    <div class="search" data-toggle="tooltip" data-placement="top" title="Search">
                                    </div>
                                    <div class="referrals" data-toggle="tooltip" data-placement="top" title="Referrals">
                                    </div>
                                    <div class="social" data-toggle="tooltip" data-placement="top" title="Social">
                                    </div>
                                </div>
                                <div class="traffic-table table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="t-title pseudo-bg-Aquamarine">Direct</td>
                                                <td>12,890</td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td class="t-title pseudo-bg-blue">Search</td>
                                                <td>7,245</td>
                                                <td>27%</td>
                                            </tr>
                                            <tr>
                                                <td class="t-title pseudo-bg-yellow">Referrals</td>
                                                <td>4,256</td>
                                                <td>8%</td>
                                            </tr>
                                            <tr>
                                                <td class="t-title pseudo-bg-red">Social</td>
                                                <td>500</td>
                                                <td>7%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none col-lg-6 col-xl-6 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1 mg-b-17">
                                    <div class="item-title">
                                        <h3>Notice Board</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="notice-box-wrap">
                                    <div class="notice-list">
                                        <div class="post-date bg-skyblue">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                                printing.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                    <div class="notice-list">
                                        <div class="post-date bg-yellow">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                    <div class="notice-list">
                                        <div class="post-date bg-pink">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                    <div class="notice-list">
                                        <div class="post-date bg-skyblue">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                                printing.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                    <div class="notice-list">
                                        <div class="post-date bg-yellow">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                    <div class="notice-list">
                                        <div class="post-date bg-pink">16 June, 2019</div>
                                        <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Content End Here -->
 
    
            </div>
        </div>
        <!-- Page Area End Here -->



        <script
src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
type="text/javascript"></script>
<script type="text/javascript">
window.onload = function() {
var mainInput = document.getElementById("nepali-datepicker");
mainInput.nepaliDatePicker();
};

$(document).ready(function(){
    var visibilityState = localStorage.getItem('dashboard-visibility');
    // alert(visibilityState);
    if(visibilityState == 'hidden'){
        $("#eye").html('visibility_off');
        $(".number-icon").addClass('d-none');
        $('.number-icon').parent().append('<span class="disible-number">xxxx</span>');
    }


    $("#eye").click(function(){
        var iconhtml = $(this).html();
        if(iconhtml == 'visibility'){
            $(this).html('visibility_off');
            $(".number-icon").addClass('d-none');
            $('.number-icon').parent().append('<span class="disible-number">xxxx</span>');
            localStorage.setItem('dashboard-visibility', 'hidden');
            
        }
        if(iconhtml == 'visibility_off'){
            $(this).html('visibility');
            $(".disible-number").remove();  
            $(".number-icon").removeClass('d-none');
            localStorage.setItem('dashboard-visibility', 'show');
        }
    });
});


</script>
@endsection