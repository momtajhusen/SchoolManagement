@extends('Admin_Page/Super_Admin/admin_template')

@section('script')
    <!-- ajax set class subject -->
    <script src="{{ asset('../admin_lang/TeachersSalary/ajax-salaryGenerat.js')}}?v={{ time() }}"></script> 
 
@endsection


@section('contents')
<div class="card height-auto">
    <div class="card-body" style="overflow: scroll">

      <div class="d-flex justify-content-between">
        <div class="d-flex mb-2">
          <select class="p-2" id="attendance-year" style="outline:none;border-radius:none;">
            <option value="2079">2079</option>
            <option value="2080">2080</option>
            <option value="2081">2081</option>
            <option value="2082">2082</option>
            <option value="2083">2083</option>
            <option value="2084">2084</option>
            <option value="2085">2085</option>
          </select>
          <select class="p-2" id="attendance-month" style="outline:none;border-radius:none;">
            <option value="1">Baishakh</option>
            <option value="2">Jestha</option>
            <option value="3">Ashadh</option>
            <option value="4">Shrawan</option>
            <option value="5">Bhadau</option>
            <option value="6">Asoj</option>
            <option value="7">Kartik</option>
            <option value="8">Mangsir</option>
            <option value="9">Poush</option>
            <option value="10">Magh</option>
            <option value="11">Falgun</option>
            <option value="12">Chaitra</option>
          </select>
          <input class="search-btn" type="submit" value="Search">
        </div>

        <div>
          <b class="year-notice">2080</b>
          <b class="month-notice">SHRAWAN</b>
       </div>
       <span></span>
      </div>
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class='d-flex'>Teachers Name</th>
            <th scope="col">Total</th>
            <th scope="col">Percent</th>
            <th scope="col">Salary</th>
            <th scope="col">Generate Salary</th>
            <th scope="col">Bonus</th>
            <th scope="col">Total Amount</th>
          </tr>
        </thead>
        <tbody class="attendance-table" style=" height:100px !important; overflow:scroll;">
 
        </tbody>
      </table>

    </div>
</div>

@endsection

