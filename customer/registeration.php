
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/create-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:55:30 GMT -->
<head>
		<meta charset="utf-8">
	<title>Wokiee - Responsive HTML5 Template</title>
	<meta name="keywords" content="HTML5 Template">
	<meta name="description" content="Wokiee - Responsive HTML5 Template">
	<meta name="author" content="wokiee">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/style.css">
    <!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- jquery validation -->
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- Sweet alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>\
	<style>
		 .error-message{
            color: red;
        }
	</style>
</head>
<body>
<div id="loader-wrapper">
	<div id="loader">
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
	</div>
</div>

<?php require 'majors/header.php' ?>

<div class="tt-breadcrumb">
	<div class="container">
		<ul>
			<li><a href="index">Home</a></li>
			<li>Create An Account</li>
		</ul>
	</div>
</div>


<div id="tt-pageContent">
	<div class="container-indent">
		<div class="container">
			<h1 class="tt-title-subpages noborder">CREATE AN ACCOUNT</h1>
			<div class="tt-login-form">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="tt-item">
							<h2 class="tt-title">PERSONAL INFORMATION</h2>
							<div class="">

								<form id="register" method="post">
                                    <div class="row">
										<div class="form-group col-12 col-md-6">
											<label for="firstname">First Name *</label>
											<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter First Name">
										</div>

										<div class="form-group col-12 col-md-6">
											<label for="lastname">LAST NAME *</label>
											<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter Last Name">
										</div>
                                    </div>

                                    <div class="row ">
										<div class="form-group col-12 col-md-6">
											<label for="email">E-MAIL *</label>
											<input type="email" name="email" class="form-control" id="email" placeholder="Enter E-mail">
										</div>

										<div class="form-group col-12 col-md-6">
											<label for="password">PASSWORD *</label>
											<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
										</div>
                                    </div>

                                    <div class="row ">
                                   		<div class="form-group col-12 col-md-6">
											<label for="phoneno">Phone no *</label>
											<input type="text" name="phoneno" class="form-control" id="phoneno" placeholder="Enter your phone no">
										</div>
                                    	<div class="form-group col-12 col-md-6">
											<label for="address">Address *</label>
											<input type="text" name="address" class="form-control" id="address" placeholder="Enter your Address">
										</div>
                                	</div>

                                	<div class="row ">
                                    	<div class="form-group col-12 col-md-6">
											<label for="postcode">Post Code *</label>
											<input type="number" name="postcode" class="form-control" id="postcode" placeholder="Enter your Post Code">
										</div>

                                    	<div class="form-group col-12 col-md-6">
                                        	<label for="state">State *</label>
                                        	<input type="text" name="state" class="form-control" id="state" placeholder="Enter your State">
                                    	</div>
                                    </div>

                                	<div class="form-group col-12 px-0">
										<label for="country">Country *</label>
										<input type="text" name="country" class="form-control" id="country" placeholder="Enter your Country">
									</div>

									<div class="row">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<button class="btn btn-border" type="submit" id="add">CREATE</button>
											</div>
										</div>
										<div class="col-12 col-md-6 align-self-center">
											<div class="form-group">
												<ul class="additional-links">
													<li>or <a href="index">Return to Store</a></li>
												</ul>
											</div>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "majors/footer.php" ?>

<script>
    $(document).on('click', '#add', function(e) {
		
		e.preventDefault();
		/*$("#register").validate({
			errorClass: "error-message",
			rules:{
				firstname: "required",
				lastname: "required",
				email: "required",
				password: "required",
                phoneno: "required",
                address: "required",
                state: "required",
                postcode: "required",
                country: "required"
			},
			messages:{
				firstname: "Firstname cannot be empty",
				lastname: "lastname cannot be empty",
				email: "Email cannot be empty",
				password: "Passwaord cannot be empty",
                phoneno: "Phone No cannot be empty",
                address: "Address cannot be empty",
                state: "State cannot be empty",
                postcode: "Post Code cannot be empty",
                country: "Contact No cannot be empty"
			}
		});
		var val = $("#register").valid();*/

       /*	if(val){*/
			var data1 = $("#register").serialize();
			var find = new login();
			var data = find.register(data1);
			
			$.ajax({
				type: 'post',
				url: 'query.php',
				data: data,
				datatype: 'json',
				success: function(response){
					if(response.success == 200){
						Swal.fire({
                             icon: 'success',
                             title: 'Success',
                             text: 'Welcome',
                             showCancelButton: false,
                             confirmButtonColor: '#3085d6',
                             confirmButtonText: 'Lets go'
                        }).then((result) => {
                           if (result.isConfirmed) {
                            window.location.href = 'login';
                           }
                        })
					}else if(response.sameemail == 400){
						Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Email aready exists"
                        })
					}else if(response.samephoneno == 400){
						Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: "Phone no already Exists"
                        })
					}else if(response.failed == 400){
						Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: "It appears that there was some problem from our end. Pls try again."
                        })
					}else if(response.empty == 400){
						Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: "You have to fill all the form fields"
                        })
					}else if(response.error_empty == 400){
						message = "";
						$.each(response.error_list,function(i,value){
							message += value + '\n';
						})
						
						// $.each(response.errors, function(field, message) {
                		// 	var error_message = $('<div>').addClass('error').text(message);
						// 	console.log(field);
                		// //$('input[firstname="' + field + '"]').after(error_message);
						// });	
						//var yo =jQuery.type( arr);	
						//console.log(yo);
						// var data = JSON.parse(response.error_list);
						// var data = response.error_list;
						// var message = "";
						// for (var i = 0; i < data.length; i++) {
                		// 	message += data[i] + '\n';
            			// }

						// console.log(message);
						Swal.fire({
                         icon: 'error',
                         title: 'There are some problems with your registration',
                         text: message
                        })
                    }
				}
			});
		//}
	});

	function login() {
        this.register = function(data) {
            return {
            action: 'register',
            data: data
            };
        };
    }
</script>





<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>


<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/create-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:55:30 GMT -->
</html>