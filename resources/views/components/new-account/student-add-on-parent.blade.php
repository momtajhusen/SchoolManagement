 
     <!-- ajax-add-student-change-parent.js --> 
     <script src="{{ asset('../admin_lang/parents/ajax-add-student-change-parent.js')}}?v={{ time() }}"></script> 


 
    <!-- Modal All Students For Parents -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="d-flex">
                <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 0%; box-shadow:none;">
            </div>
            <div class="table-responsive" style="height:600px;">
            <table class="table table-striped sortable-table">
                <thead>
                <tr>
                    <th data-column="0">#</th>
                    <th data-column="1">Image</th>
                    <th data-column="1">Students</th>
                    <th data-column="2">St_id</th>
                    <th data-column="3">Class</th>
                    <th data-column="4">Father</th>
                </tr>
                </thead>
                <tbody class="all-student sortable-bordy">
                    {{-- Students  --}}
                </tbody>
            </table>
            </div>
           </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary p-3 modal-close-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>