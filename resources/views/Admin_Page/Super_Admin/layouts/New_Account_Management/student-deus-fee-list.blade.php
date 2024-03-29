@extends('Admin_Page/Super_Admin/admin_template')

@section('style')

<style>
  .dataTables_length,
.dataTables_wrapper {
  font-size: 1.6rem;
  select,input {
    background-color: #f9f9f9;
    border: 1px solid #999;
    border-radius: 4px;
    height: 3rem;
    line-height: 2;
    font-size: 1.8rem;
    color: #333;
  }

  .dataTables_length,
  .dataTables_filter {
    margin-top: 30px;
    margin-right: 20px;
    margin-bottom: 10px;
    display: inline-flex;
  }
}

 
.paginate_button {
  min-width: 4rem;
  display: inline-block;
  text-align: center;
  padding: 1rem 1.6rem;
  margin-top: -1rem;
  border: 2px solid lightblue;
  &:not(.previous) {
    border-left: none;
  }
  &.previous {
    border-radius: 8px 0 0 8px;
    min-width: 7rem;
  }
  &.next {
    border-radius: 0 8px 8px 0;
    min-width: 7rem;
  }

  &:hover {
    cursor: pointer;
    background-color: #eee;
    text-decoration: none;
  }
}

</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
 
@endsection

@section('script')

{{-- Sorting Script  --}}
<script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>

@endsection


@section('contents')

<div class="container mt-4">
  <h2>Sortable Table</h2>
  <div class="table-responsive">
      <table class="table table-striped table-bordered" id="myTable">
          <thead>
              <tr>
                  <th data-column="0">SN.</th>
                  <th data-column="1">Name</th>
                  <th data-column="2">Age</th>
                  <th data-column="3">Country</th>
              </tr>
          </thead>
          <tbody>
              <tr><td>1</td><td>John</td><td>25</td><td>USA</td></tr>
              <tr><td>2</td><td>Doe</td><td>20</td><td>UK</td></tr>
              <tr><td>3</td><td>Alice</td><td>30</td><td>Canada</td></tr>
              <tr><td>4</td><td>Bob</td><td>22</td><td>Australia</td></tr>
          </tbody>
      </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('th').click(function(){
      var table = $(this).parents('table').eq(0);
      var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
      this.asc = !this.asc;
      if (!this.asc){rows = rows.reverse();}
      for (var i = 0; i < rows.length; i++){table.append(rows[i]);}
  });
  function comparer(index) {
      return function(a, b) {
          var valA = getCellValue(a, index), valB = getCellValue(b, index);
          return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
      };
  }
  function getCellValue(row, index){ return $(row).children('td').eq(index).text(); }
});
</script>


@endsection
