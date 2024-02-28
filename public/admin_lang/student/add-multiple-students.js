$(document).ready(function () {
    $('#fileInput').on('change', function (e) {
        var file = e.target.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var csvContent = e.target.result;
                var rows = csvContent.split('\n');

 
                // Process each row
                rows.forEach(function (row) {
                    var columns = row.split(',');

                    // Create a table row
                    var tr = $('<tr></tr>');

                    // Process each column and append input fields to the row
                    columns.forEach(function (column) {
                        var input = $('<input type="text">').val(column);
                        var td = $('<td></td>').append(input);
                        tr.append(td);
                    });

                    // Append the row to the table
                    $('table').append(tr);
                });

     
            };

            reader.readAsText(file);
        }
    });

    // Add input fields for column data
    $('#add-row-button').on('click', function () {
        var inputFields = $('#column-inputs input').map(function () {
            return $(this).val();
        }).get();

        // Create a table row
        var tr = $('<tr></tr>');

        // Process each column input and append input fields to the row
        inputFields.forEach(function (column) {
            var input = $('<input type="text">').val(column);
            var td = $('<td></td>').append(input);
            tr.append(td);
        });

        // Append the row to the table
        $('#table-box table').append(tr);
    });
});