jQuery( document ).ready(function() {
    // console.log( "ready!" );
    var wpcf7Elm = document.querySelector( '.wpcf7' );

    var popup_msg_text = popup_message.popup_text;

    wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
        var currentformid = event.detail.contactFormId;
        var custome = event.detail.apiResponse.status;
        var popup_message = event.detail.apiResponse.message;

        if(popup_msg_text == ''){
            popup_text = popup_message;
        }else{
            popup_text = popup_msg_text;
        }

        //swal("Oops" ,  event.detail.apiResponse.message ,  "error");
        // console.log(event);

        if(custome == 'validation_failed' || custome == 'mail_failed'){
            swal("Oops" ,  popup_message ,  "error",{
                buttons: "OK",
                timer: 5000,
            });
        }else{
            swal({
                title: "Success",
                text: popup_text,
                icon: "success",
                buttons: "OK",
                timer: 5000,
            });
        }
    });
        
});