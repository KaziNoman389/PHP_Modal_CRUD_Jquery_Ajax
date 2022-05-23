$(document).ready(function() {

    //fetch_table_data 
    $.ajax({
        url: "apis/api_1.php", //the page containing php script
        type: "post", //request type,
        data: { 'req': '1', 'param': '1' },
        dataType: "json",
        success: function(result) {
            $("#employeeData").html(result);
        }
    });

    // --------------------------- INSERT ----------------------- //
    // fetch_modal_view_data
    $("#emp_table").on('click', '#view_id', function(e) {
        var eid = $(this).attr('data-id');
        $("#emp_id").val(eid);
        $("#viewEmptModal").modal('show');
    });

    //View_modal_data
    $("#viewEmptModal").on('show.bs.modal', function(event) {
        var eid = $("#emp_id").val();
        $.ajax({
            url: "apis/api_1.php",
            type: "post",
            data: { 'req': '1', 'param': '2', 'data': 'id = ' + eid },
            dataType: "json",
            success: function(result) {
                $("#modal_det").html(result);
            }
        });
    });

    //insert data to database
    $('#form_data').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $('form').serialize(),
            url: "controller/insert_emp_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result) {
                $.ajax({
                    url: "apis/api_1.php", //the page containing php script
                    type: "post", //request type,
                    data: { 'req': '1', 'param': '1' },
                    dataType: "json",
                    success: function(result) {
                        $("#employeeData").html(result);
                    }
                });
            }
        });
        $("#form_data")[0].reset();
    });


    // ----------------------------EDIT --------------------------------//
    // fetch_modal_update_data
    $("#emp_table").on('click', '#edit_id', function(e) {
        var eid = $(this).attr('data-id');
        $("#edit_emp_id").val(eid);
        $("#updateEmptModal").modal('show');
    });

    //Update_modal_data
    $("#updateEmptModal").on('show.bs.modal', function(event) {
        var eid = $("#edit_emp_id").val();
        $.ajax({
            url: "apis/api_1.php",
            type: "post",
            data: { 'req': '1', 'param': '3', 'data': 'id = ' + eid },
            dataType: "json",
            success: function(result) {
                var record = result[0];

                $("#edit_name").val(record['name']);
                $("#edit_email").val(record['email']);
                $("#edit_phone").val(record['phone']);
                $('[name="edit_gender"]').val([record['gender']]);
                $("#edit_birth_date").val(record['birth_date']);
                $("#edit_occupation").val(record['email']);
                $('[name="edit_marital_status"]').val([record['marital_status']]);
                $("#edit_nationality").val(record['nationality']);
                $("#edit_present_address").val(record['present_address']);
                $("#edit_permanent_address").val(record['permanent_address']);
            }
        });
    });

    //update data to database
    $('#edit_form_data').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $('form').serialize(),
            url: "controller/update_emp_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result) {
                $.ajax({
                    url: "apis/api_1.php", //the page containing php script
                    type: "post", //request type,
                    data: { 'req': '1', 'param': '1' },
                    dataType: "json",
                    success: function(result) {
                        $("#employeeData").html(result);
                        $("#updateEmptModal").modal('hide');
                    }
                });
            }
        });
    });


    // ----------------------------------------DELETE -------------------------------------- //

    $("#emp_table").on('click', '#delele_id', function(e) {
        var deleted = $(this).attr('data-id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to delete this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "controller/delete_emp_data.php",
                    type: "post",
                    data: { 'req_id': deleted },
                    success: function() {
                        $.ajax({
                            url: "apis/api_1.php", //the page containing php script
                            type: "post", //request type,
                            data: { 'req': '1', 'param': '1' },
                            dataType: "json",
                            success: function(result) {
                                $("#employeeData").html(result);
                            }
                        });
                    }
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        });
    });

});