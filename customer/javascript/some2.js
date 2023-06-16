function getOTP() {
    $("#register").validate({
        errorClass: "error-message",
        rules: {
            email: "required"
                // password: "required"
        },
        messages: {
            email: "Email cannot be empty"
                // password: "Password cannot be empty"
        }
    });

    var val = $("#register").valid();
    if (val) {
        // var email = getElementById('#email');
        var email = $("#email").val();
        // var password = $("#password").val();
        // console.log(email);
        $.ajax({
            url: 'query.php',
            type: 'POST',
            dataType: "json",
            data: { data: email, action: "get_otp" },
            success: function(response) {
                var html = '';
                if (response.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: "OTP successfully sent"
                    });

                    html += '<form id="mobile-number-verification">';

                    html += '<div class="mobile-row form-group col-12">';
                    html += '<label>Enter Your 6-digit OTP number:-</label>';
                    html += '<input type="number"  id="mobileOtp" class="mobile-input form-control" placeholder="Enter the OTP">';
                    html += '</div>';

                    html += '<div class="mobile-row form-group col-12 col-md-6">';
                    html += '<input id="verify" type="button" class="btnVerify btn btn-primary rounded-pill" value="Verify OTP" onClick="verifyOTP();">';
                    html += '</div>';
                    html += '</form>';
                    $(".response").html(html);

                } else if (response.status == 400) {
                    Swal.fire({
                        icon: 'error',
                        text: "Your email is invalid"
                    });

                } else if (response.pre_verified == 200) {
                    // alert("email verified");
                    Swal.fire({
                        icon: 'info',
                        text: "Your email has been already verified",
                        showCancelButton: false,
                        confirmButtonColor: '#189AB4',
                        confirmButtonText: 'ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index';
                        }
                    })
                } else if (response.emailnotfound == 400) {
                    Swal.fire({
                        icon: 'info',
                        text: "Your Entered email is not registered",
                        showCancelButton: false,
                        confirmButtonColor: '#189AB4',
                        confirmButtonText: 'ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index';
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log("An AJAX error occurred: " + status + " - " + error);
            }
        });
    }
}


function verifyOTP() {
    var otp = $("#mobileOtp").val();
    var email = $("#email").val();
    if (otp.length == 6 && otp != null) {
        $.ajax({
            url: 'query.php',
            type: 'POST',
            dataType: "json",
            data: { data: otp, action: "verify_otp", email: email },
            success: function(response) {
                if (response.verified == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: "Email has been verified",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Lets go'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login';
                        }
                    })
                } else if (response.verified == 500) {
                    Swal.fire({
                        icon: 'error',
                        text: "The OTP entered is incorrect",
                        showCancelButton: false,
                        confirmButtonColor: '#FF0000',
                        confirmButtonText: 'Understood'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login';
                        }
                    })
                }
            },
            error: function() {
                alert("Error");
            }
        });
    } else {
        $(".err").html('You have entered wrong OTP.')
        $(".err").show();
    }
}

//Function to set images 
function img(o) {
    let temp = [];

    temp = o.split(" & ");
    temp = temp.filter(Boolean);

    let images = [];
    temp.forEach(image => { images.push("upload/" + image.replace(/[\[\]]/g, "").trim()); });

    return '<img src="../admin/' + images[0] + '" width="100%" height="auto">';
}

// to fetch all the data who are 7 days old
function is_new(created_at) {
    var timestamp = new Date(created_at).getTime() / 1000;
    var cutoff_timestamp = new Date().getTime() / 1000 - (7 * 24 * 60 * 60);

    if (timestamp >= cutoff_timestamp) {
        return true;
    } else {
        return false;
    }
}

//To add into the cart onclick
function add_to_cart(element) {

    var id = element.getAttribute("data-id");
    $.ajax({
        url: 'query.php',
        type: 'post',
        data: { data: id, action: 'addcart' },
        success: function(response) {
            if (response.success == 200) {
                Swal.fire({
                    icon: 'success',
                    text: 'Successfully added to the cart'
                })
            } else if (response.stocks == 400) {
                Swal.fire({
                    icon: 'warning',
                    text: 'This Product is out of stocks'
                })
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + jqXHR.status);
        }
    });
}

function cartplus(element) {
    var id = element.getAttribute("data-id");
    var val = document.getElementById("quantity").value;
    // alert(val);
    $.ajax({
        url: 'query.php',
        type: 'post',
        data: { data: id, action: 'addcart' },
        success: function(response) {
            if (response.success == 200) {
                Swal.fire({
                    position: 'bottom',
                    toast: true,
                    icon: 'success',
                    text: 'You have changed the quantity'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            } else if (response.stocks == 400) {
                Swal.fire({
                    icon: 'warning',
                    text: 'This Product is out of stocks'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + errorThrown);
        }
    });
}

//To decrease one quantity from the cart onclick
function cartminus(element) {
    var id = element.getAttribute("data-id");
    // alert("yo");
    $.ajax({
        url: 'query.php',
        type: 'post',
        data: { data: id, action: 'subtractcart' },
        success: function(response) {
            if (response.success == 200) {
                Swal.fire({
                    position: 'bottom',
                    toast: true,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    text: 'You have changed the quantity'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })

            } else if (response.stocks == 400) {
                Swal.fire({
                    icon: 'warning',
                    text: 'This Product is out of stocks'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + jqXHR.status);
        }
    });
}

//To show the modal of the product
function modal(element) {
    var productid = element.getAttribute("data-id");
    // alert(productid);
    $.ajax({
        url: "query.php",
        type: "post",
        datatype: 'json',
        data: { action: 'modal', data: productid },
        success: function(response) {
            if (response[0].status == "200") {
                //Function to set images 
                function img(o) {
                    let temp = [];

                    temp = o.split(" & ");
                    temp = temp.filter(Boolean);

                    let images = [];
                    temp.forEach(image => { images.push("../admin/upload/" + image.replace(/[\[\]]/g, "").trim()); });

                    return images;
                }

                //Function To set New price based on discount

                var data = response[0].data;
                var html = "";
                var images = img(data['image']);

                html += '<div class="row">';
                //Left side of the modal to show images
                html += '<div class="col-12 col-md-7 col-lg-6">';
                html += '<div class="tt-mobile-product-slider arrow-location-center sliders">';

                html += '<div class="slides-show">';
                for (var i = 0; i < images.length; i++) {
                    html += '<div>'
                    html += '<img src = "' + images[i] + '" style="width:100%; height:auto;" alt = "images">';
                    html += '</div>';
                }
                html += '</div>';

                html += '</div>';
                html += '</div>';


                //Right side of the modal to show tha datas
                html += '<div class="col-12 col-md-7 col-lg-6">';
                html += '<div class="tt-product-single-info">';
                html += '<div class="tt-add-info">';
                html += '<ul>';
                html += '<li><span>Availability:</span> ' + data['inventory'] + ' in Stock</li>';
                html += '</ul>';
                html += '</div>';
                html += '<h2 class="tt-title">' + data['name'] + '</h2>';

                //This section is for price Showing 
                if (data['discount'] == 0) {
                    html += '<div class="tt-price">';
                    html += '<span class="new-price">$' + data['price'] + '</span> ';
                    html += '</div>';
                } else {
                    html += '<div class="tt-price">';
                    html += '<span class="old-price">$' + data['price'] + '</span> ';
                    html += '<span class="new-price">$' + data['finalprice'] + '</span></span> ';
                    html += '</div>';
                }
                //END of this section is for price Showing 

                if (data['discount'] == 0) {
                    html += '<span class="">Discount is not avalible on this product</span><br>';
                } else {
                    html += '<span class="">Discount:- ' + data['discount'] + ' % OFF || </span></span>';
                }

                if (data['deliverycharges'] == 0) {
                    html += '';
                } else {
                    html += '<span class="">Delivery Charges:- $' + data['deliverycharges'] + '</span></span>';
                }

                //Start Of the review DIV
                html += '<div class="tt-review">';
                html += '<div class="tt-rating">';
                html += '<i class="icon-star"></i>';
                html += '<i class="icon-star"></i>';
                html += '<i class="icon-star"></i>';
                html += '<i class="icon-star-half"></i>';
                html += '<i class="icon-star-empty"></i>';
                html += '</div>';
                html += '</div>';

                //Description of the product
                html += '<div class="tt-wrapper">' + data['description'] + '</div>';

                // To enter the required amount
                html += '<div class="tt-wrapper">';
                html += '<div class="tt-row-custom-01">';
                html += '<div class="col-item">';
                html += '<div class="tt-input-counter style-01">';
                html += '<span class="minus-btn"></span>';
                html += '<input type="text" value="1" size="5">';
                html += '<span class="plus-btn"></span>';
                html += '</div>';
                html += '</div>';

                html += '<div class="col-item">';
                html += '<a href="#" class="btn btn-lg" data-id="' + data['id'] + '" onclick = "add_to_cart(this);" ><i class="icon-f-39"></i>ADD TO CART</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                // End of this 

                html += '</div>';
                html += '</div>';
                //End of the review DIV

                $(".tt-modal-quickview ").html(html);
                $('.slides-show').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    dots: true,
                    adaptiveHeight: true
                });

            }
        }
    });
}