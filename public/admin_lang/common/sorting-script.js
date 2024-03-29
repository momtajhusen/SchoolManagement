$(document).ready(function(){
    $('th[data-column]').click(function(){
        var table = $(this).closest('table');
        var columnIndex = parseInt($(this).attr('data-column'));
        var sortOrder = $(this).hasClass('asc') ? 'desc' : 'asc';

        table.find('th').removeClass('asc').removeClass('desc').find('i').remove();
        $(this).addClass(sortOrder).append('<i class="ml-2 fa fa-sort-amount-' + (sortOrder == 'asc' ? 'asc' : 'desc') + '" aria-hidden="true"></i>');

        var rows = table.find('tbody.studnt-table tr').toArray().sort(comparer(columnIndex, sortOrder));
        if (sortOrder === 'desc') { rows = rows.reverse(); }
        for (var i = 0; i < rows.length; i++){ table.find('tbody.studnt-table').append(rows[i]); }
    });
    
    function comparer(index, order) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
        };
    }
    
    function getCellValue(row, index) {
        return $(row).children('td').eq(index).text();
    }
});