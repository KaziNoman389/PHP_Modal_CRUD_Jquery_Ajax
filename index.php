<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">

    <title>EMS</title>

    <style>
    .swal2-confirm.btn.btn-danger {
        margin-left: 20px !important;
    }
    </style>
</head>

<body>
    <!-- Add Modal -->
    <div class="modal fade" id="employee_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="exampleModalLabel">Add Employee</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="form_data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="error-message">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control name" name="name" id="name">
                            </div>

                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control email" name="email" id="email">
                            </div>

                            <div class="col-md-6">
                                <label for="">Phone</label>
                                <input type="text" class="form-control phone" name="phone" id="phone">
                            </div>

                            <div class="col-md-4">
                                <label for="">Gender</label>
                                <br />
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="gender"
                                        value="male">
                                    <label class="form-check-label" for="male">male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="gender"
                                        value="female">
                                    <label class="form-check-label" for="female">female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="gender"
                                        value="transgender">
                                    <label class="form-check-label" for="transgender">transgender</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="">Date Of Birth</label>
                                <input type="date" class="form-control birth_date" name="birth_date" id="birth_date">
                            </div>

                            <div class="col-md-4">
                                <label for="">Marital Status</label>
                                <br />
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input marital_status" type="radio" name="marital_status"
                                        id="marital_status" value="married">
                                    <label class="form-check-label" for="marital_status">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input marital_status" type="radio" name="marital_status"
                                        id="marital_status" value="unmarried">
                                    <label class="form-check-label" for="marital_status">No</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="">Occupation</label>
                                <input type="text" class="form-control occupation" name="occupation" id="occupation">
                            </div>

                            <div class="col-md-6">
                                <label for="">Nationality</label>
                                <input type="text" class="form-control nationality" name="nationality" id="nationality">
                            </div>

                            <div class="col-md-6">
                                <label for="">Present Address</label>
                                <input type="text" class="form-control present_address" name="present_address"
                                    id="present_address">
                            </div>

                            <div class="col-md-6">
                                <label for="">Permanent Address</label>
                                <input type="text" class="form-control permanent_address" name="permanent_address"
                                    id="permanent_address">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                        <button type="submit" id="employee_add_ajax"
                            class="btn btn-primary btn-md employee_add_ajax">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewEmptModal" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newClientModalLabel">View Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<input type="text" id="emp_id" class="form-control empID" name="emp_id" value="0">-->

                    <input type="hidden" id="emp_id">
                    <div id="modal_det">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <span class="align-middle">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateEmptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Employee Information</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="edit_form_data">
                    <div class="modal-body">
                        <input type="hidden" id="edit_emp_id" name="edit_emp_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="error-message">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control name" name="edit_name" id="edit_name">
                            </div>

                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control email" name="edit_email" id="edit_email">
                            </div>

                            <div class="col-md-6">
                                <label for="">Phone</label>
                                <input type="text" class="form-control phone" name="edit_phone" id="edit_phone">
                            </div>

                            <div class="col-md-4">
                                <label for="">Gender</label>
                                <br />
                                <div class="form-check form-check-inline edit_gender">
                                    <input class="form-check-input" type="radio" name="edit_gender" id="edit_gender1"
                                        value="male">
                                    <label class="form-check-label" for="male">male</label>
                                </div>
                                <div class="form-check form-check-inline edit_gender">
                                    <input class="form-check-input" type="radio" name="edit_gender" id="edit_gender2"
                                        value="female">
                                    <label class="form-check-label" for="female">female</label>
                                </div>
                                <div class="form-check form-check-inline edit_gender">
                                    <input class="form-check-input" type="radio" name="edit_gender" id="edit_gender3"
                                        value="transgender">
                                    <label class="form-check-label" for="transgender">transgender</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="">Date Of Birth</label>
                                <input type="date" class="form-control birth_date" name="edit_birth_date"
                                    id="edit_birth_date">
                            </div>

                            <div class="col-md-4">
                                <label for="">Marital Status</label>
                                <br />
                                <div class="form-check form-check-inline edit_marital_status">
                                    <input class="form-check-input" type="radio" name="edit_marital_status"
                                        id="edit_marital_status_1" value="married">
                                    <label class="form-check-label" for="marital_status">Yes</label>
                                </div>
                                <div class="form-check form-check-inline edit_marital_status">
                                    <input class="form-check-input" type="radio" name="edit_marital_status"
                                        id="edit_marital_status_2" value="unmarried">
                                    <label class="form-check-label" for="marital_status">No</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="">Occupation</label>
                                <input type="text" class="form-control occupation" name="edit_occupation"
                                    id="edit_occupation">
                            </div>

                            <div class="col-md-6">
                                <label for="">Nationality</label>
                                <input type="text" class="form-control nationality" name="edit_nationality"
                                    id="edit_nationality">
                            </div>

                            <div class="col-md-6">
                                <label for="">Present Address</label>
                                <input type="text" class="form-control present_address" name="edit_present_address"
                                    id="edit_present_address">
                            </div>

                            <div class="col-md-6">
                                <label for="">Permanent Address</label>
                                <input type="text" class="form-control permanent_address" name="edit_permanent_address"
                                    id="edit_permanent_address">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-md ">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Container for table data in the view -->
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h2><span class="float-left mt-2">Employee Information</span></h2>
                        <div class="float-right mb-2">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#employee_addModal">
                                Add New Employee
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-message">

                        </div>
                        <table class="table table-bordered table-striped" id="emp_table">
                            <thead>
                                <tr class="text-center m-2" style="text-transform:uppercase">
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Date Of Birth</th>
                                    <th scope="col">Occupation</th>
                                    <th scope="col">Martial Status</th>
                                    <th scope="col">Nationality</th>
                                    <th scope="col">Present Address</th>
                                    <th scope="col">Permanent Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="employeeData">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    $(document).ready(function () {
    $('#example').DataTable();
    });

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Sweet Alert cdn -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Data Table cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <script src="assets/pagejs/employee.js"></script>

</body>

</html>