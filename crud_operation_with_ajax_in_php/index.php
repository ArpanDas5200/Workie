<html>

<head>
    <title>How to Read Mysql Data by using PHP PDO with Ajax - PHP PDO CRUD with Ajax</title>
    <!-- For jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- For bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- for validatioon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- for PASSWORD ICON -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            overflow: auto;
        }
        .box {
            width: 100%;
            padding: 20px;
            background-color: black;
            color:white;
            border: 1px solid #ccc;
        } 

        .error {
            color: #FF0000;
        }

        input {
            margin: auto;
            border: 2px solid green !important;
        }
        #result,
        #flip {
            padding: 5px;
            text-align: center;
            background-color: #e5eecc;
            border: solid 1px #c3c3c3;
        }

        /* PASWORD SHOW CSS */
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -27px;
            position: relative;
            z-index: 2;
            font-size: 20px;
        }


    </style>
</head>

<body>
    <div class="container box">
        <h1 align="center">CRUD OPERATION WITH AJAX IN PHP</h1>
        <br />
        <div align="left" style="float:left">
            <input type="text" placeholder="search" name="tsearch" id="isearch" class="btn btn-success">
            <button type="button" name="search" id="search" class="btn btn-info" data-dismiss=" modal">search</button>
        </div>

        <div align="right">
            <button type="button" id="modal_button" class="btn btn-info">Create Records</button>
            <!-- It will show Modal for Create new Records !-->
        </div>
    </div>
    <br />
    <div id="result" class="table-responsive">
        <!-- Data will load under this tag!-->
    </div>
<!-- This is Customer Modal. It will be use for Create new Records and Update Existing Records!-->
<div id="customerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Records</h4>
            </div>
            <div class="modal-body">
                <form id="show">
                    <label>Enter First Name<span class="error">*</label>
                    <input type="text" name="tfirst_name" placeholder="First Name" maxlength="15" id="ifname" class="form-control" />
                    <br />
                    <label>Enter Last Name<span class="error">*</label>
                    <input type="text" name="tlast_name" placeholder="Last Name" maxlength="15" id="ilname" class="form-control" />
                    <br />
                    <label>Enter Email<span id="invalid_email" class="error">*</label>
                    <input type="email" name="temail" maxlength="30" placeholder="Email" id="iemail" class="form-control" />
                    <br />
                    <label>Enter Password<span class="error">*</label>
                    <input type="password" name="tpassword" placeholder="Password" maxlength="15" id="ipassword" class="form-control" />
                    <span toggle="#ipassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <br />
                    <label>Confirm Password<span class="error">*</label>
                    <input type="password" name="tcpassword" placeholder="Confirm Password" maxlength="15" id="icpassword" class="form-control" />
                    <span toggle="#icpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <br />
                    <label>Enter Mobile-No<span class="error">*</label>
                    <input type="tel" name="tmobileno" id="imobileno" placeholder="Mobile Number" maxlength="10" class="form-control" />
                    <br />
                    <input type="submit" name="action" id="action" class="btn btn-success" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="customer_id" id="customer_id" />
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        load_data();
            //For Password Field
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
     
         //######################-----Function For display All Data-----#########################//
        function load_data(query) {
            $.ajax({
                url: "operation.php",
                method: "POST",
                data: {
                    query: query,
                    action: "Search"
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        //######################----- Function For Search -----#########################//
        $('#isearch').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
        $("#isearch").focus(function() {
            $(this).css("background-color", "yellow");
            $(this).css("color", "black");
        });
        $("#isearch").blur(function() {
            $(this).css("background-color", "green");
        });
        //######################-----For Show Pop-Up-----#########################//
        $('#modal_button').click(function() {
            $('#customerModal').modal('show');
            $('#ifname').val('');
            $('#ilname').val('');
            $('#iemail').val('');
            $('#ipassword').val('');
            $('#icpassword').val('');
            $('#imobileno').val('');
            $('.modal-title').text("Create New Records");
            $('#action').val('Create');
        });
        //######################-----For Validation-----#########################//
        var value = $("#ipassword").val();
        $.validator.addMethod("checklower", function(value) {
            return /[a-z]/.test(value);
        });
        $.validator.addMethod("checkupper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
        $.validator.addMethod("checksym", function(value) {
            return /[\-@~`!#$%^&*_(){}[|/+="':;<,>.?._]/.test(value);
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[A-Z]/.test(value);
        });
        $.validator.addMethod("fullmail", function(value) {
            return /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        });
        $('#show').validate({
            rules: {
                tfirst_name: {
                    required: true,
                    // alphabet: true
                },
                tlast_name: {
                    required: true
                },
                temail: {
                    required: true,
                    email: true,
                    fullmail: true,
                },
                tpassword: {
                    required: true,
                    minlength: 8,
                    // pwcheck: true
                    checklower: true,
                    checkupper: true,
                    checkdigit: true,
                    checksym: true
                },
                tcpassword: {
                    required: true,
                    equalTo: "#ipassword"
                },
                tmobileno: {
                    required: true,
                    minlength: 10,
                    number: true
                }
            },
            messages: {
                tfirst_name: 'Please enter Name.',
                tlast_name: 'Please enter Name.',
                temail: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                    required: 'please enter valid email',
                    fullmail: "please enter valid email"
                },

                tpassword: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8 characters long.',
                    pwcheck: "Password mast be one (uppercase,lower case,number and symbol",
                    checklower: "Need atleast 1 lowercase alphabet",
                    checkupper: "Need atleast 1 uppercase alphabet",
                    checkdigit: "Need atleast 1 digit",
                    checksym: "Need atleast 1 symbol ",
                },
                tcpassword: {
                    required: 'Please enter Confirm Password.',
                    equalTo: 'Confirm Password do not match with Password.',
                },
                tmobileno: {
                    required: 'Please enter Contact.',
                    minlength: 'Contact should be 10 digit number.'
                }
            }, //######################-----For Insert new Records-----#########################//
            submitHandler: function(form) {
                var vfname = $('#ifname').val();
                var vlname = $('#ilname').val();
                var vemail = $('#iemail').val();
                var vpassword = $('#ipassword').val();
                var vcpassword = $('#icpassword').val();
                var vmobileno = $('#imobileno').val();
                var id = $('#customer_id').val();
                var action = $('#action').val();
                $.ajax({
                    url: "operation.php",
                    method: "POST",
                    data: {
                        nfname: vfname,
                        nlname: vlname,
                        nemail: vemail,
                        npassword: vpassword,
                        ncpassword: vcpassword,
                        nmobileno: vmobileno,
                        id: id,
                        action: action
                    },
                    success: function(data) {
                        alert(data);
                        $('#customerModal').modal('hide');
                        load_data();
                    }
                });
            }
        });
        //######################-----For Update Record-----#########################//
        $(document).on('click', '.update', function() {
            var id = $(this).attr("id");
            var action = "Select";
            $.ajax({
                url: "operation.php",
                method: "POST",
                data: {
                    id: id,
                    action: action
                },
                dataType: "json",
                success: function(data) {
                    $('#customerModal').modal('show');
                    $('.modal-title').text("Update Records");
                    $('#action').val("Update");
                    $('#customer_id').val(id);
                    $('#ifname').val(data.first_name);
                    $('#ilname').val(data.last_name);
                    $('#iemail').val(data.email);
                    $('#ipassword').val(data.password);
                    $('#icpassword').val(data.cpassword);
                    $('#imobileno').val(data.mobileno);
                

                }
            });
        });
        //######################-----For Delete Data-----#########################//
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to remove this data?")) {
                var action = "Delete";
                $.ajax({
                    url: "operation.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: action
                    },
                    success: function(data) {
                        load_data();
                        alert(data);
                    }
                })
            } else {
                return false;
            }
        });
    });
</script>
</body>
</html>