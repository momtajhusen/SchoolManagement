@extends('Admin_Page/Super_Admin/admin_template')

@section('style')

    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <!-- Include jquery.table2excel.js if available (if not, use Blob.js and FileSaver.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-table2excel/1.0.3/jquery.table2excel.min.js"></script>

    <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/Blob.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- Include SheetJS library for .xlsx export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <style>
.select-dropdown {
	position: relative;
	background-color: #E6E6E6;
	border-radius: 4px;
}
.select-dropdown select {
	font-size: 12px;
	font-weight: normal;
	max-width: 100%;
	padding: 8px 24px 8px 10px;
	border: none;
	background-color: transparent;
		-webkit-appearance: none;
		-moz-appearance: none;
	appearance: none;
}
.select-dropdown select:active, .select-dropdown select:focus {
	outline: none;
	box-shadow: none;
}
.select-dropdown:after {
	content: "";
	position: absolute;
	top: 50%;
	right: 8px;
	width: 0;
	height: 0;
	margin-top: -2px;
	border-top: 5px solid #aaa;
	border-right: 5px solid transparent;
	border-left: 5px solid transparent;
}

.monthBox{
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    background:white;
    padding:10px;
    width:100%;
}
    </style>
@endsection

@section('script')
 
    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/report/fee-collection-months.js')}}?v={{ time() }}"></script> 
 
@endsection


@section('contents')
 
        <b>Collection Months</b>
        <div class="row border p-3" id="monthsBox">

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_1">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_2">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_3">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_4">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_5">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_6">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_7">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_8">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_9">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_10">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_11">000</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="my-2 mx-1 monthBox">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <span class="material-symbols-outlined">calendar_month</span> 
                            <b>Baishk</b>
                        </div>
                        <img src="/front_template_assets/assets/images/money.png" alt="money" style="height: 30px;">
                    </div>
                    <div class="d-flex mt-2">
                        <span class="material-symbols-outlined">currency_rupee</span>
                        <span class="month_12">000</span>
                    </div>
                </div>
            </div>
        </div>
@endsection
