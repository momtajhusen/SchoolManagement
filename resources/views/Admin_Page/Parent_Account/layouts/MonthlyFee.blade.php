@extends('Admin_Page/Parent_Account/parent_template')



    @section('script')

        <!-- ajax Get Monthly Fee -->
        <script src="{{ asset('../admin_lang/Parent_Account/monthly_fee/ajax-monthly-fee.js')}}?v={{ time() }}"></script> 
 

    @endsection   




@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Monthly Fee</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Monthly Fee</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

 


    <div>
        <div class="w-100 mx-4" style="overflow:scroll;">
            <table class="table table-dark table-hover">
            <thead>
                <tr style="background-color: #000">
                    <th scope="col">SN:</th>
                    <th scope="col">Month</th>
                    <th scope="col">Total</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Dues</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody class="last-year-payment-table">

            </tbody>
            <tbody class="payment-table" id="payment-table">

            </tbody>
            <tbody class="total-table" id="payment-table">
                <tr style="background-color: #000">
                    <th scope="row" style="width:10px;">#</th>
                    <th scope="row" style="width:10px;">Total</th>
                    <th scope="row" id="totalClassFee" style="width:10px;"></th>
                    <th scope="row" id="totalClassPay" style="width:10px;"></th>
                    <th scope="row" id="totalClassDis" style="width:10px;"></th>
                    <th scope="row" id="totalClassDue" style="width:10px;"></th>
                    <th colspan="3">
                         <div class="w-100 d-flex justify-content-end">
                            <button class="bg-info take-multi-pay border-0 text-light rounded p-2 px-4 d-none" id="take-multi-pay" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer">Multi Payment</button>
                         </div>
                    </th>
                   </tr>
            </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>






@endsection
