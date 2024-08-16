$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-teachers-for-setperiods",
        method: "GET",
        success: function (response) {
            console.log(response);

            response.TeachersPeriods.forEach(function (data) {
                var TeacherPeriod = '';
                var PeriodTH = '';
                var TotalsPeriods = response.ClassPeriods.length;

                // Initialize formData as a FormData object
                var formData = new FormData();

                for (let i = 0; i < TotalsPeriods; i++) {
                    var prValue = data['period_' + (i + 1)];

                    TeacherPeriod += `
                        <td>
                            <div class="input-group-text border mx-1">
                                <input type="checkbox" ${prValue === 1 ? 'checked' : ''} name="period_${i + 1}" value="${prValue}">
                            </div>
                        </td>`;

                    PeriodTH += `<th>
                               Period_${i + 1}<br>
                              `+response.ClassPeriods[i].start_time+`
                            </th>`;
                }

                var header = `
                    <tr class="period-time">
                        <th>Teachers Name<br>Times</th>
                        ${PeriodTH}
                        <th>Action</th>
                    </tr>
                `;

                $(".period_hearder").html(header);

                $(".teachers-periods-table").append(`
                    <tr>
                        <td style="width:250px;">${data.teacher_name}</td>
                        ${TeacherPeriod}
                        <td>
                            <button tch_id="${data.tch_id}" class="save-btn" style="cursor:pointer;">Save</button>
                        </td>
                    </tr>
                `);

                // Handle click event for the "Save" button in each row
                $(".save-btn").off().click(function () {
                    // Clear formData before appending new data
                    formData = new FormData();

                    // Find checkboxes in the same row
                    $(this).closest("tr").find('input[type="checkbox"]').each(function () {
                        formData.append($(this).attr('name'), $(this).prop('checked') ? 1 : 0);
                    });

                    // Append tch_id to formData
                    var tch_id = $(this).attr("tch_id");
                    formData.append("tch_id", tch_id);

                    // AJAX request to update data
                    $.ajax({
                        url: "/teachers-period-for-update", // Replace with your update endpoint
                        method: "POST", // Use the appropriate HTTP method
                        data: formData,
                        contentType: false, // Important for FormData
                        processData: false, // Important for FormData
                        success: function (response) {
                            console.log(response);

                            iziToast.success({
                                title: 'OK',
                                message: 'Successfully inserted record!',
                                position: 'topRight', 
                                timeout: 2000,
                            });
                        },
                        error: function (xhr, status, error) {
                            // Handle error, if needed
                            console.log(xhr.responseText);
                        },
                    });
                });
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });
});
