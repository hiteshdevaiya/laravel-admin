jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z. \s]+$/i.test(value);
}, "Only alphabetical characters");

//create user
$("#form-user").validate({
    rules: {
        role_id: {
            required: true,
        },
        name: {
            required: true,
            lettersonly:true
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
        },
        // company: {
        //     required: true,
        // },
        // phone: {
        //     required: true,
        // }
    },
    messages: {
        role_id: {
            required: "<p style='color: red;'>Please select role</p>"
        },
        name: {
            required: "<p style='color: red;'>Please enter name</p>"
        },
        email: {
            required: "<p style='color: red;'>Please enter valid email</p>",
            email: "<p style='color: red;'>Please enter valid email</p>"
        },
        password: {
            required: "<p style='color: red;'>Please enter password</p>"
        },
        // company: {
        //     required: "<p style='color: red;'>Please enter company name</p>"
        // },
        // phone: {
        //     required: "<p style='color: red;'>Please enter mobile number</p>",
        // }
    }
});

function check() {
     $( "select option:selected").each(function(){
         //console.log($(this).attr('value'));
         if($(this).attr("value")=="1" || $(this).attr("value")=="2" )  {
             $(".phone").hide();
             $(".address").hide();
             $(".address2").hide();
             $(".city").hide();
             $(".state").hide();
             $(".country").hide();
             $(".zipcode").hide();
             $('#phone').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter phone number' }
             });
             $('#address').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter address' }
             });
             $('#city').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter city' }
             });
             $('#state').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter state' }
             });
             $('#country').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter country' }
             });
             $('#zipcode').rules('remove',  {
                 required : true,
                 messages : { required : 'Please enter zipcode' }
             });
         } else {
             var user_role = $('#get_user_role').val();
             $(".phone").show();
             $(".address").show();
             $(".address2").show();
             $(".city").show();
             $(".state").show();
             $(".country").show();
             $(".zipcode").show();
             
                 $('#phone').validate();
                 $('#address').validate();
                 $('#city').validate();
                 $('#state').validate();
                 $('#country').validate();
                 $('#zipcode').validate();
                 $('#phone').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter phone number' }
                 });
                 $('#address').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter address' }
                 });
                 $('#city').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter city' }
                 });
                 $('#state').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter state' }
                 });
                 $('#country').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter country' }
                 });
                 $('#zipcode').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter zipcode' }
                 });
             
         }
     });
}


//edit-user
$("#edit-user").validate({
    rules: {
        name: {
            required: true,
            lettersonly:true
        },
        email: {
            required: true,
            email: true
        },
        company: {
            required: true
        }
    },
    messages: {
        name: {
            required: "<p style='color: red;'>Please enter name</p>"
        },
        email: {
            required: "<p style='color: red;'>Please enter valid email</p>",
            email: "<p style='color: red;'>Please enter valid email</p>"
        },
        company: {
            required: "<p style='color: red;'>Please enter company name</p>"
        }
    }
});

function check1() {
    $( "select option:selected").each(function(){
        if($(this).attr("value")=="1" || $(this).attr("value")=="2" )  {
            $(".phone").hide();
            $(".address").hide();
            $(".address2").hide();
            $(".city").hide();
            $(".state").hide();
            $(".country").hide();
            $(".zipcode").hide();
            $('#phone').rules('remove',  'required');
            $('#address').rules('remove',  'required');
            $('#city').rules('remove',  'required');
            $('#state').rules('remove',  'required');
            $('#country').rules('remove',  'required');
            $('#zipcode').rules('remove',  'required');
        } else {
            var user_role = $('#get_user_role').val();
            $(".phone").show();
            $(".address").show();
            $(".address2").show();
            $(".city").show();
            $(".state").show();
            $(".country").show();
            $(".zipcode").show();
            
                $('#phone').validate();
                $('#address').validate();
                $('#city').validate();
                $('#state').validate();
                $('#country').validate();
                $('#zipcode').validate();
                 $('#phone').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter phone number' }
                 });
                 $('#address').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter address' }
                 });
                 $('#city').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter city' }
                 });
                 $('#state').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter state' }
                 });
                 $('#country').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter country' }
                 });
                 $('#zipcode').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter zipcode' }
                 });
            
        }
    });
}

//edit-userprofile
$("#edit-user-admin").validate({
    rules: {
        name: {
            required: true,
            lettersonly:true
        },
        email: {
            required: true,
            email: true
        },
        company: {
            required: true
        }
    },
    messages: {
        name: {
            required: "<p style='color: red;'>Please enter name</p>"
        },
        email: {
            required: "<p style='color: red;'>Please enter valid email</p>",
            email: "<p style='color: red;'>Please enter valid email</p>"
        },
        company: {
            required: "<p style='color: red;'>Please enter company name</p>"
        }
    }
});

function check3() {
$( "select option:selected").each(function(){
    if($(this).attr("value")=="1" || $(this).attr("value")=="2" )  {
        $(".phone").hide();
        $(".user-role-id").hide();
        $(".address").hide();
        $(".address2").hide();
        $(".city").hide();
        $(".state").hide();
        $(".country").hide();
        $(".zipcode").hide();
        $('#phone').rules('remove',  'required');
        $('#user_role_id').rules('remove',  'required');
        $('#address').rules('remove',  'required');
        $('#city').rules('remove',  'required');
        $('#state').rules('remove',  'required');
        $('#country').rules('remove',  'required');
        $('#zipcode').rules('remove',  'required');
    } else {
        var user_role = $('#get_user_role').val();
        $(".user-role-id").hide();
        $(".phone").show();
        $(".address").show();
        $(".address2").show();
        $(".city").show();
        $(".state").show();
        $(".country").show();
        $(".zipcode").show();
        if(user_role == 1 || user_role == 2){
        } else {
            $('#phone').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter phone number' }
                 });
                 $('#address').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter address' }
                 });
                 $('#city').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter city' }
                 });
                 $('#state').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter state' }
                 });
                 $('#country').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter country' }
                 });
                 $('#zipcode').rules('add',  {
                     required : true,
                     messages : { required : 'Please enter zipcode' }
                 });        }
    }
});
}

//user-index
$("#commissionFrom").validate({
        rules: {
            commission: {
                required: true,
                number: true,
                range: [0, 100],
            }
        },
        messages: {
            commission: {
                required: "<p style='color: red;'>Please enter commission</p>",
                number: "<p style='color: red;'>Please enter only number</p>",
                range: "<p style='color: red;'>Please enter 0 to 100 range</p>"
            }
        }
});
//create-vendor-contact
$("#create-vendor-contact").validate({
    rules: {
        'firstname[]': {
            required: true,
        },
        'lastname[]': {
            required: true,
        },
        'email[]': {
            required: true,
            email:true,
        },
    },
    messages: {
        'firstname[]': {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        'lastname[]': {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        'email[]': {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        },
    }
});

//edit-vendor-contact
$("#edit-vendor-contact").validate({
    rules: {
        firstname_edit: {
            required: true,
        },
        lastname_edit: {
            required: true,
        },
        email_edit: {
            required: true,
            email:true
        }


    },
    messages: {
        firstname_edit: {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        lastname_edit: {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        email_edit: {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        }
    }
});

//blackout-date setting vendor

$(document).on('click','.single',function(){
    $("#settings-blackoutdate").validate({
        rules: {
            'blackout_date_single': {
                required: true,
            },
            'reason_single': {
                required: true,
            },
        },
        messages: {
            'blackout_date_single': {
                required: "<p style='color: red;'>Please enter blackoute date</p>"
            },
            'reason_single': {
                required: "<p style='color: red;'>Please enter reason</p>"
            },
        }
    });    
});
$(document).on('click','.daterange',function(){
    $("#settings-blackoutdate").validate({
        rules: {
            'blackout_date_multiple_start': {
                required: true,
            },
            'blackout_date_multiple_end': {
                required: true,
            },
            'reason_multiple': {
                required: true,
            },
        },
        messages: {
            'blackout_date_multiple_start': {
                required: "<p style='color: red;'>Please enter blackoute from date</p>"
            },
            'blackout_date_multiple_end': {
                required: "<p style='color: red;'>Please enter blackoute to date</p>"
            },
            'reason_multiple': {
                required: "<p style='color: red;'>Please enter reason</p>"
            },
        }
    });
});

//edit vendor setting blackout date
$("#edit-vendor_blackoute_date").validate({
    rules: {
        'blackout_date': {
            required: true,
        },
        'reason': {
            required: true,
        }
    },
    messages: {
        'blackout_date': {
            required: "<p style='color: red;'>Please enter blackoute date</p>"
        },
        'reason': {
            required: "<p style='color: red;'>Please enter reason</p>"
        }
    }
});

//vendor-setting inside
$("#vendor-setting-create").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
        order_volume: {
            required: true,
            maxlength: 3,
        },
        quantity_discount: {
            required: true,
            maxlength: 3,
        },
        moq: {
            required: true,
            maxlength: 3,
        },
        shipping: {
            required: true,
        },
        cbm_per_container: {
            required: true,
            maxlength: 3,
        },
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        order_volume: {
            required: "<p style='color: red;'>Please enter order volume</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        quantity_discount: {
            required: "<p style='color: red;'>Please enter quantity discount</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        moq: {
            required: "<p style='color: red;'>Please enter moq</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        shipping: {
            required: "<p style='color: red;'>Please select shipping</p>"
        },
        cbm_per_container: {
            required: "<p style='color: red;'>Please enter cbm per container</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        
    }
});

//setting vendor outside
$("#vendor-setting").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
        order_volume: {
            required: true,
            maxlength: 3,
        },
        quantity_discount: {
            required: true,
            maxlength: 3,
        },
        moq: {
            required: true,
            maxlength: 3,
        },
        shipping: {
            required: true,
        },
        cbm_per_container: {
            required: true,
            maxlength: 3,
        },
        ship_to_warehouse: {
            required: true
            
        }
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        order_volume: {
            required: "<p style='color: red;'>Please enter order volume</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        quantity_discount: {
            required: "<p style='color: red;'>Please enter quantity discount</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        moq: {
            required: "<p style='color: red;'>Please enter moq</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        shipping: {
            required: "<p style='color: red;'>Please select shipping</p>"
        },
         ship_to_warehouse: {
            required: "<p style='color: red;'>Please select warehouse</p>",
        },
        cbm_per_container: {
            required: "<p style='color: red;'>Please enter cbm per container</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        
    }
});

//create vendors
$("#create-vendor").validate({
    rules: {
        vendor_name: {
            required: true,
            lettersonly:true
        },
        address_line1: {
            required: true,
        },
        country: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        'firstname[]': {
            required: true,
        },
        'lastname[]': {
            required: true,
        },
        'email[]': {
            required: true,
            email:true,
        },


    },
    messages: {
        vendor_name: {
            required: "<p style='color: red;'>Please enter name</p>",
            lettersonly:"<p style='color: red;'>Enter only latters</p>",
        },
        address_line1: {
            required: "<p style='color: red;'>Please enter valid address</p>"
        },
        country: {
            required: "<p style='color: red;'>Please select country</p>"
        },
        city: {
            required: "<p style='color: red;'>Please select city</p>"
        },
        state: {
            required: "<p style='color: red;'>Please select states</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter zipcode</p>"
        },
        'firstname[]': {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        'lastname[]': {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        'email[]': {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        },
    }
});

//edit-vendor-perticular
$("#edit-vendor").validate({
    rules: {
        vendor_name: {
            required: true,
            lettersonly:true
        },
        address_line1: {
            required: true,
        },
        country: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        marketplace_id: {
            required: true,
        },
        firstname_edit: {
            required: true,
        },
        lastname_edit: {
            required: true,
        },
        email_edit: {
            required: true,
            email:true,
        }
    },
    messages: {
        vendor_name: {
            required: "<p style='color: red;'>Please enter name</p>",
            lettersonly:"<p style='color: red;'>Enter only latters</p>",
        },
        address_line1: {
            required: "<p style='color: red;'>Please enter valid address</p>"
        },
        country: {
            required: "<p style='color: red;'>Please select country</p>"
        },
        city: {
            required: "<p style='color: red;'>Please select city</p>"
        },
        state: {
            required: "<p style='color: red;'>Please select states</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter zipcode</p>"
        },
        marketplace_id: {
            required: "<p style='color: red;'>Please enter marketplace</p>"
        },
        firstname_edit: {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        lastname_edit: {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        email_edit: {
            required: "<p style='color: red;'>Please enter email</p>",
            email:"<p style='color: red;'>Enter valid email</p>",
        }
    }
});

//create-supplier-contact
$("#create-supplier-contact").validate({
    rules: {
        'firstname[]': {
            required: true,
        },
        'lastname[]': {
            required: true,
        },
        'email[]': {
            required: true,
            email:true,
        }
    },
    messages: {
        'firstname[]': {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        'lastname[]': {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        'email[]': {
            required: "<p style='color: red;'>Please enter email</p>"
        },
        'contact[]': {
            required: "<p style='color: red;'>Please enter contact</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        },
    }
});

//edit-supplier contact
$("#edit-supplier-contact").validate({
    rules: {
        firstname_edit: {
            required: true,
        },
        lastname_edit: {
            required: true,
        },
        email_edit: {
            required: true,
            email:true,
        }

    },
    messages: {
        firstname_edit: {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        lastname_edit: {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        email_edit: {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        }
    }
});

//edit supplier setting inside
$("#setting-supplier-inside").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
        order_volume: {
            required: true,
            maxlength: 3,
        },
        quantity_discount: {
            required: true,
            maxlength: 3,
        },
        moq: {
            required: true,
            maxlength: 3,
        },
        CBM_Per_Container: {
            required: true,
            maxlength: 3,
        },
        Production_Time: {
            required: true,
            maxlength: 3,
        },
        Boat_To_Port: {
            required: true,
            maxlength: 3,
        },
        Port_To_Warehouse: {
            required: true,
            maxlength: 3,
        },
        Ship_To_Specific_Warehouse: {
            required: true
        
        }
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        order_volume: {
            required: "<p style='color: red;'>Please enter order volume</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        quantity_discount: {
            required: "<p style='color: red;'>Please enter quantity discount</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        moq: {
            required: "<p style='color: red;'>Please enter moq</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        CBM_Per_Container: {
            required: "<p style='color: red;'>Please enter cbm per container</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        Production_Time: {
            required: "<p style='color: red;'>Please enter Production time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        Boat_To_Port: {
            required: "<p style='color: red;'>Please enter boat to port</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
       Port_To_Warehouse: {
            required: "<p style='color: red;'>Please enter port to warehouse</p>",
           maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        Ship_To_Specific_Warehouse: {
            required: "<p style='color: red;'>Please select warehouse</p>",
    
        }
        
    }
});

//supplier setting inside
$("#setting-supplier").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
        order_volume: {
            required: true,
            maxlength: 3,
        },
        quantity_discount: {
            required: true,
            maxlength: 3,
        },
        moq: {
            required: true,
            maxlength: 3,
        },
        CBM_Per_Container: {
            required: true,
            maxlength: 3,
        },
        Production_Time: {
            required: true,
            maxlength: 3,
        },
        Boat_To_Port: {
            required: true,
            maxlength: 3,
        },
        Port_To_Warehouse: {
            required: true,
            maxlength: 3,
        },
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        order_volume: {
            required: "<p style='color: red;'>Please enter order volume</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        quantity_discount: {
            required: "<p style='color: red;'>Please enter quantity discount</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        moq: {
            required: "<p style='color: red;'>Please enter moq</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        CBM_Per_Container: {
            required: "<p style='color: red;'>Please enter cbm per container</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        Production_Time: {
            required: "<p style='color: red;'>Please enter Production time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
        Boat_To_Port: {
            required: "<p style='color: red;'>Please enter boat to port</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
       Port_To_Warehouse: {
            required: "<p style='color: red;'>Please enter port to warehouse</p>",
           maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        }
        
    }
});

//create supplier
$("#create-supplier").validate({
    rules: {
            supplier_name: {
            required: true,
            lettersonly:true
        },
        address_line1: {
            required: true,
        },
        country: {
            required: true,
        },
        city: {
            required: true,
        },
        states: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        marketplace_id: {
            required: true,
        },
        'firstname[]': {
            required: true,
        },
        'lastname[]': {
            required: true,
        },
        'email[]': {
            required: true,
            email:true
        }
    },
    messages: {
            supplier_name: {
            required: "<p style='color: red;'>Please enter name</p>",
            lettersonly:"<p style='color: red;'>Enter only latters</p>",
        },
        address_line1: {
            required: "<p style='color: red;'>Please enter valid address</p>"
        },
        country: {
            required: "<p style='color: red;'>Please select country</p>"
        },
        city: {
            required: "<p style='color: red;'>Please select city</p>"
        },
        states: {
            required: "<p style='color: red;'>Please select states</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter zipcode</p>"
        },
        marketplace_id: {
            required: "<p style='color: red;'>Please enter marketplace</p>"
        },
        'firstname[]': {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        'lastname[]': {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        'email[]': {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        }
    }
});

//edit supplier
$("#edit-supplier").validate({
    rules: {
        supplier_name: {
            required: true,
            lettersonly:true
        },
        address_line1: {
            required: true,
        },
        country: {
            required: true,
        },
        city: {
            required: true,
        },
        states: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        marketplace_id: {
            required: true,
        },
        firstname_edit: {
            required: true,
        },
        lastname_edit: {
            required: true,
        },
        email_edit: {
            required: true,
            email:true
        },
    },
    messages: {
        supplier_name: {
            required: "<p style='color: red;'>Please enter name</p>",
            lettersonly:"<p style='color: red;'>Enter only latters</p>",
        },
        address_line1: {
            required: "<p style='color: red;'>Please enter valid address</p>"
        },
        country: {
            required: "<p style='color: red;'>Please select country</p>"
        },
        city: {
            required: "<p style='color: red;'>Please select city</p>"
        },
        states: {
            required: "<p style='color: red;'>Please select states</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter zipcode</p>"
        },
        marketplace_id: {
            required: "<p style='color: red;'>Please enter marketplace</p>"
        },
        firstname_edit: {
            required: "<p style='color: red;'>Please enter firstname</p>"
        },
        lastname_edit: {
            required: "<p style='color: red;'>Please enter lastname</p>"
        },
        email_edit: {
            required: "<p style='color: red;'>Please enter email</p>",
            email: "<p style='color: red;'>Enter valid email</p>"
        }
    }
});

//blackout-date setting supplier
$(document).on('click','.single',function(){
    $("#settings-supplier_blackoutdate").validate({
        rules: {
            'blackout_date_single': {
                required: true,
            },
            'reason_single': {
                required: true,
            },
        },
        messages: {
            'blackout_date_single': {
                required: "<p style='color: red;'>Please enter blackoute date</p>"
            },
            'reason_single': {
                required: "<p style='color: red;'>Please enter reason</p>"
            },
        }
    });    
});
$(document).on('click','.daterange',function(){
    $("#settings-supplier_blackoutdate").validate({
        rules: {
            'blackout_date_multiple_start': {
                required: true,
            },
            'blackout_date_multiple_end': {
                required: true,
            },
            'reason_multiple': {
                required: true,
            },
        },
        messages: {
            'blackout_date_multiple_start': {
                required: "<p style='color: red;'>Please enter blackoute from date</p>"
            },
            'blackout_date_multiple_end': {
                required: "<p style='color: red;'>Please enter blackoute to date</p>"
            },
            'reason_multiple': {
                required: "<p style='color: red;'>Please enter reason</p>"
            },
        }
    });
});

//edit supplier setting blackout date
$("#edit-supplier_blackoute_date").validate({
    rules: {
        'blackout_date': {
            required: true,
        },
        'reason': {
            required: true,
        }
    },
    messages: {
        'blackout_date': {
            required: "<p style='color: red;'>Please enter blackoute date</p>"
        },
        'reason': {
            required: "<p style='color: red;'>Please enter reason</p>"
        }
    }
});

//create roles
if ($("#create-role").length > 0) {
    $("#create-role").validate({
        rules: {
            role: {
                required: true
            }
        },
        messages: {
            role: {
                required: "<p style='color: red;'>Please enter role</p>"
            }
        }
    })
}

//edit roles
if ($("#edit-role").length > 0) {
    $("#edit-role").validate({
        rules: {
            role: {
                required: true
            }
        },
        messages: {
            role: {
                required: "<p style='color: red;'>Please enter role</p>"
            }
        }
    })
}

//view replnish
$("#view-replenish").validate({
    rules: {
        quantity: {
            required: true
        
        },
    },
    messages: {
        quantity: {
            required: "Please enter quantity"
        },

    }
});

//create perchase instance
$("#create-puraches_instances").validate({
    rules: {'product_id[]': {required: true},
            'projected_units[]': { required: true},
            'items_per_cartoons[]': {required: true},
            'containers[]': {required: true},
            'cbm[]': {required: true},
            'subtotal[]': {required: true},
           },
    messages: {'product_id[]': {required: "<p style='color: red;'>Please select product</p>"},
               'projected_units[]': {required: "<p style='color: red;'>Please enter projected units</p>"},
               'items_per_cartoons[]': {required: "<p style='color: red;'>Please enter items per cartoons</p>"},
               'containers[]': {required: "<p style='color: red;'>Please enter containers</p>"},
               'cbm[]': {required: "<p style='color: red;'>Please enter cbm</p>"},
               'subtotal[]': {required: "<p style='color: red;'>Please enter subtotal</p>"}
            }
});

//edit perchase instance
$("#edit-puraches_instances").validate({
    rules: {
        product_id: {required: true},
        warehouse: {required: true},
        projected_units: {required: true},
        items_per_cartoons: {required: true},
        containers: {required: true},
        cbm: {required: true},
        subtotal: {required: true},
    },
    messages: {
        product_id: {required: "<p style='color: red;'>Please select product</p>"},
        warehouse: {required: "<p style='color: red;'>Please select warehouse</p>"},
        projected_units: {required: "<p style='color: red;'>Enter projected units</p>"},
        items_per_cartoons: {required: "<p style='color: red;'>Please enter items/cartoons</p>"},
        containers: {required: "<p style='color: red;'>Please enter containers</p>"},
        cbm: {required: "<p style='color: red;'>Please enter CBM</p>"},
        subtotal: {required: "<p style='color: red;'>Please enter subtotal</p>"},

    }
});

//confirm purchase order
$("#confirm-purchase_order").validate({
    rules: {
        date_of_ship: {required: true},
        date_arrieved: {required: true},
        reorder_date: {required: true},
        day_rate: {required: true},
        days_of_supply: {required: true},
        blakoute_days: {required: true}
    },
    messages: {
        date_of_ship: {required: "<p style='color: red;'>Please select date of ship</p>"},
        date_arrieved: {required: "<p style='color: red;'>Please select date of arrived</p>"},
        reorder_date: {required: "<p style='color: red;'>PLease select reorder date</p>"},
        day_rate: {required: "<p style='color: red;'>Please enter day rate</p>"},
        days_of_supply: {required: "<p style='color: red;'>Please enter days of supply</p>"},
        blakoute_days: {required: "<p style='color: red;'>Please enter blackout date</p>"},
    }
});

//product setting assign
$(document).on('click','.vendors',function(){
    $("#settings-product-assign").validate({
        rules: {
            vendors_id:{
                required:true
            },
            lead_time: {
                required: true,
                maxlength: 3,
            },
            order_volume: {
                required: true,
                maxlength: 3,
            },
            quantity_discount: {
                required: true,
                maxlength: 3,
            },
            moq: {
                required: true,
                maxlength: 3,
            },
            shipping: {
                required: true,
            },
            CBM_Per_Container:{
                required: true,
                maxlength: 9,
            },
            Cost: {
                required: true,
            },
            Cost_Expenses:{
                required: true,
            },
            Qty_per_Carton:{
                required: true,
                maxlength: 9
            },
            Cartons_per_pallet:{
                required: true,
                 maxlength: 9
            },
            Box_Domensions_Height:{
                required: true,},
            Box_Domensions_Width:{
                required: true,
                 maxlength: 9
            },
            Box_Domensions_Weight:{
                required: true,
                 maxlength: 9
            },
            ship_to_warehouse:{
                required:true,
            }
        },
        messages: {
            vendors_id:{required: "<p style='color: red;'>Please select vendors</p>",},
            lead_time: {
                required: "<p style='color: red;'>Please enter lead time</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            order_volume: {
                required: "<p style='color: red;'>Please enter order volume</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            quantity_discount: {
                required: "<p style='color: red;'>Please enter quantity discount</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            moq: {
                required: "<p style='color: red;'>Please enter moq</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            shipping: {
                required: "<p style='color: red;'>Please select shipping</p>"
            },
            CBM_Per_Container:{
                required: "<p style='color: red;'>Please enter crm_per_container</p>",
                maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Cost: {
                required: "<p style='color: red;'>Please enter cost </p>",
            },
            Cost_Expenses: {
                required: "<p style='color: red;'>Please enter cost + expenses</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            Qty_per_Carton: {
                required: "<p style='color: red;'>Please enter qty_per_carton</p>",
            },
            Cartons_per_pallet: {
            required: "<p style='color: red;'>Please enter cartons_per_pallet</p>",
             maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Height: {
                required: "<p style='color: red;'>Please enter height</p>",
                 maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Width: {
                required: "<p style='color: red;'>Please enter width</p>",
                 maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Weight: {
                required: "<p style='color: red;'>Please enter weight</p>",
                maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            ship_to_warehouse:{
                required: "<p style='color: red;'>Please select warehouse</p>",
            }
        }
    });
});
$(document).on('click','.suppliers',function(){
    $("#settings-product-assign").validate({
        rules: {
            suppliers_id: {required:true},
            lead_times: {
                required: true,
                maxlength: 3,
            },
            order_volumes: {
                required: true,
                maxlength: 3,
            },
            quantity_discounts: {
                required: true,
                maxlength: 3,
            },
            moqs: {
                required: true,
                maxlength: 3,
            },
            CBM_Per_Containers: {
                required: true,
                maxlength: 3,
            },
            Production_Times: {
                required: true,
                maxlength: 3,
            },
            Boat_To_Ports: {
                required: true,
                maxlength: 3,
            },
            Port_To_Warehouses: {
                required: true,
                maxlength: 3,
            },
            Costs: {
                required: true,
            },
            Qty_per_Cartons:{
              required: true,
               maxlength: 9
            },
            Cartons_per_pallets:{
                required: true,
                 maxlength: 9
            },
            Box_Domensions_Heights:{
                required: true,
                maxlength: 9
            },
            Box_Domensions_Widths:{
                required: true,
                maxlength: 9
            },
            Box_Domensions_Weights:{
                required: true,
                maxlength: 9
            },
            Cost_Expensess:{
                required: true,
            },
            Ship_To_Specific_Warehouses:{
              required:true,
            }
        },
        messages: {
            suppliers_id:{required: "<p style='color: red;'>Please select supplier</p>",},
            lead_times: {
                required: "<p style='color: red;'>Please enter lead time</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            order_volumes: {
                required: "<p style='color: red;'>Please enter order volume</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            quantity_discounts: {
                required: "<p style='color: red;'>Please enter quantity discount</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            moqs: {
                required: "<p style='color: red;'>Please enter moq</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            CBM_Per_Containers: {
                required: "<p style='color: red;'>Please enter cbm per container</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            Production_Times: {
                required: "<p style='color: red;'>Please enter Production time</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            Boat_To_Ports: {
                required: "<p style='color: red;'>Please enter boat to port</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            Port_To_Warehouses: {
                required: "<p style='color: red;'>Please enter port to warehouse</p>",
                maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
            },
            Costs: {
                required: "<p style='color: red;'>Please enter cost </p>",
            },
            Cost_Expensess: {
                required: "<p style='color: red;'>Please enter cost + expenses</p>",
            },
            Qty_per_Cartons: {
                required: "<p style='color: red;'>Please enter qty_per_carton</p>",
                 maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Cartons_per_pallets: {
            required: "<p style='color: red;'>Please enter cartons_per_pallet</p>",
             maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Heights: {
            required: "<p style='color: red;'>Please enter height</p>",
            maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Widths: {
            required: "<p style='color: red;'>Please enter width</p>",
            maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Box_Domensions_Weights: {
            required: "<p style='color: red;'>Please enter weight</p>",
            maxlength: "<p style='color: red;'>Maximum length 9 character</p>"
            },
            Ship_To_Specific_Warehouses:{
                required:"<p style='color: red;'>Please select warehouse</p>",
            }
        }
    });
});

//warehouse setting in product
$("#product-warehouse-set").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
        warehouses_id: {
            required: true,
        },
         qty: {
            required: true,
        },
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        },
         warehouses_id: {
            required: "<p style='color: red;'>Please Select Warhouse</p>"
        },
        qty: {
            required: "<p style='color: red;'>Please enter Qty</p>"
        },    
    }
});

//create module
if ($("#create-module").length > 0) {
    $("#create-module").validate({
        rules: {
            module:{required: true},
           
            
        },
        messages: {
            module: {
                required: "<p style='color: red;'>Please enter  Module</p>"
            },
            
        }
    })
}

//edit module
if ($("#edit-modules").length > 0) {
    $("#edit-modules").validate({
        rules: {
            module: {
                required: true
            }
        },
        messages: {
            role: {
                required: "<p style='color: red;'>Please enter Modules</p>"
            }
        }
    })
}

//fba setting
$("#fba-setting").validate({
    rules: {
        supply_days: {
            required: true,
            maxlength: 2,
        },
    },
    messages: {
        supply_days: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 2 character</p>"
        }
    }
});

//create blackout main
$(document).on('click','.single',function(){
    $("#main-settings-blackout-create").validate({
    rules: {
        'blackout_date_single': {
            required: true,
        },
        'reason_single': {
            required: true,
        },
    },
    messages: {
        'blackout_date_single': {
            required: "<p style='color: red;'>Please enter blackoute date</p>"
        },
        'reason_single': {
            required: "<p style='color: red;'>Please enter reason</p>"
        },
    }
});    
});
$(document).on('click','.daterange',function(){
    $("#main-settings-blackout-create").validate({
        rules: {
            'blackout_date_multiple_start': {
                required: true,
            },
            'blackout_date_multiple_end': {
                required: true,
            },
            'reason_multiple': {
                required: true,
            },
        },
        messages: {
            'blackout_date_multiple_start': {
                required: "<p style='color: red;'>Please enter blackoute from date</p>"
            },
            'blackout_date_multiple_end': {
                required: "<p style='color: red;'>Please enter blackoute to date</p>"
            },
            'reason_multiple': {
                required: "<p style='color: red;'>Please enter reason</p>"
            },
        }
    });
});

//edit blackout main
$("#main-edit-balckoutdate").validate({
    rules: {
        'blackout_date': {
            required: true,
        },
        'reason': {
            required: true,
        },
    },
    messages: {
        'blackout_date': {
            required: "<p style='color: red;'>Please enter blackoute date</p>"
        },
        'reason': {
            required: "<p style='color: red;'>Please enter reason</p>"
        },
    }
});

//create warehouse
$("#create-warehouse").validate({
    rules: {
        type: {
            required: true,
        },
        warehouse_name: {
            required: true,
        },
        address_line_1: {
            required: true,
        },
        city: {
            required: true,
        },
        country: {
            required: true,
        },
        state: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        marketplace_id:{
            required: true,
        },
         primary_first_name:{
            required: true,
        },
         primary_last_name:{
            required: true,
        },
         primary_email:{
            required: true,
        },
    },
    messages: {
        type: {
            required: "<p style='color: red;'>Please Select User type</p>"
        },
        warehouse_name: {
            required: "<p style='color: red;'>Please enter warehouse name</p>"
        },
        address_line_1: {
            required: "<p style='color: red;'>Please enter Address</p>"
        },
        country: {
            required: "<p style='color: red;'>Please enter Country</p>"
        },
        city: {
            required: "<p style='color: red;'>Please enter City</p>",
        },
        state: {
            required: "<p style='color: red;'>Please enter State</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter Zipcode</p>"
        },
        marketplace_id:{
            required: "<p style='color: red;'>Please Select marketplace id</p>"
        },
        primary_first_name:{
            required: "<p style='color: red;'>Please enter Firstname</p>" 
        },
        primary_last_name:{
            required: "<p style='color: red;'>Please enter Lastname</p>" 
        },
        primary_email:{
            required: "<p style='color: red;'>Please enter Email</p>"
        },
    }
});

//edit warehouse
$("#edit-warhouse").validate({
    rules: {
        type: {
            required: true,
        },
        warehouse_name: {
            required: true,
        },
        address_line_1: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        marketplace_id:{
            required: true,
        },
         primary_first_name:{
            required: true,
        },
         primary_last_name:{
            required: true,
        },
         primary_email:{
            required: true,
        },
    },
    messages: {
        type: {
            required: "<p style='color: red;'>Please Select User type</p>"
        },
        warehouse_name: {
            required: "<p style='color: red;'>Please enter warehouse name</p>"
        },
        address_line_1: {
            required: "<p style='color: red;'>Please enter Address</p>"
        },
        city: {
            required: "<p style='color: red;'>Please enter City</p>",
        },
        state: {
            required: "<p style='color: red;'>Please enter State</p>"
        },
        zipcode: {
            required: "<p style='color: red;'>Please enter Zipcode</p>"
        },
        marketplace_id:{
            required: "<p style='color: red;'>Please Select marketplace id</p>"
        },
        primary_first_name:{
            required: "<p style='color: red;'>Please enter Firstname</p>" 
        },
        primary_last_name:{
            required: "<p style='color: red;'>Please enter Lastname</p>" 
        },
        primary_email:{
            required: "<p style='color: red;'>Please enter Email</p>"
        },
    }
});

//import csv warehouse
$(document).on('click','.import_csv',function () {
    $("#import_csv_warehouse").validate({
        rules: {
            csvfile: {
                required: true,
                extension: 'csv',
            }
        },
        messages:{
            csvfile:{
                required:"please required file",
                extension:"This file format is not allowed, allow only CSV file",
            }
        },
    });
});

//main warehouse setting outside
$("#main-warehouse-settings").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        }        
    }
});

//warehouse setting inside
$("#warehouse-setting-inside").validate({
    rules: {
        lead_time: {
            required: true,
            maxlength: 3,
        },
    },
    messages: {
        lead_time: {
            required: "<p style='color: red;'>Please enter lead time</p>",
            maxlength: "<p style='color: red;'>Maximum length 3 character</p>"
        }
        
    }
});

//report
$("#main-report-create").validate({
    rules: {
        'report_type': {
            required: true,
        },
        'marketplace_id': {
            required: true,
        },
        'start_date': {
            required: true,
        },
        'end_date': {
            required: true
        },
    },
    messages: {
        'report_type': {
            required: "<p style='color: red;'>Please select report type</p>"
        },
        'marketplace_id': {
            required: "<p style='color: red;'>Please select marketplace</p>"
        },
        'start_date': {
            required: "<p style='color: red;'>Please enter start date</p>"
        },
        'end_date': {
            required: "<p style='color: red;'>Please enter end date</p>"
        },
    }
});