<?php
/* Template Name: Jquery Form validation
Post Type: post, page, event */
echo custom_var;
echo die();
if($flag){
	echo $domain;
}else{
   echo 'variable is false';
}
echo '<br>';
echo "My Global Variable: " . getenv('MY_GLOBAL_VARIABLE'). '<br>';
echo "Another Global Variable: " . getenv('ANOTHER_GLOBAL_VARIABLE');
?>

<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro&family=Work+Sans:wght@600&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro&family=Work+Sans&display=swap" rel="stylesheet">

   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
   <style>
      li.parsley-required {
         color: red
      }

      .description-back {
         font-size: 18px;
         font-weight: 800;
      }

      ul.parsley-errors-list {
         padding-left: 2px;
         list-style: none;
      }

      .parsley-pattern {
         color: red !important;
      }

      .input-title {
         font-size: 14px;
         font-weight: 600;
         color: #586d39;
         margin-bottom: 7px;
      }

      .br-three {
         border-radius: 0px;
      }

      .lbl-card-detail {
         padding-left: 36px;
      }

      .hero-banner {
         background-color: #586D39;
         display: flex;
         justify-content: space-between;
         align-items: flex-start;
         flex-direction: column;
      }

      .demo-one {
         height: 100vh;
         padding: 82.5px 150px 80px 80px;
         /* padding: 83px 150px 80px 80px; */
         /* padding: 80px 150px 80px 80px; */
         background-color: #586d39;
         width: 35%;
         position: fixed;
         left: 0;
      }

      .demo-two {
         margin-left: 35%;
         width: 65%;
         padding: 90px 120px 40px 120px;
         /* padding: 180px 120px 40px 120px; */
      }

      .hero-banner h2 {
         color: white;

      }

      .hero-banner-text {
         margin-top: 127px !important;
         /* margin-top: 126px !important; */
         /* margin-top: 119px !important; */
      }

      .hero-banner-text h3 {
         font-family: 'Work Sans';
         color: #fff;
         font-size: 20px;
         text-transform: none;
         /*margin: 0px;*/
         margin-top: 38px !important;
         /* margin-top: 40px !important; */
         line-height: 24px;
      }

      .hero-banner-left-content {
         display: flex;
         justify-content: left;
         align-items: start;
         flex-direction: column;
         margin-top: 119px;
      }

      .hero-banner-left-content .as-s1-img--top {
         height: 95px;
      }

      .mobile-content-set a {
         letter-spacing: -1px;
         font-size: 20px !important;
         color: #fff;
         display: inline-flex;
         align-items: center;
         font-weight: 400;
         font-family: 'Work Sans';
      }

      .mobile-content-set a:hover {
         text-decoration: none;
      }

      .mobile-content-set img {
         margin-right: 15px;
      }

      .hero-banner h2 {
         color: white;
         font-size: 80px;
         margin: 0px;
         font-weight: 400;
         font-family: 'Work Sans';
      }

      .hero-banner h3 {
         font-weight: 400 !important;
         font-size: 20px;
      }

      .banner-header-border {
         border-bottom: 1px solid #fff;
         margin-top: 48px !important;
         width: 80px;
      }

      .main-result .hero-banner {
         height: 100%;
      }

      .rounded-text-box {
         padding: 0px 10px;
         border: 1px solid #ced4da;
         border-radius: 15px;
      }

      .result-ssl-text {
         font-size: 14px;
         font-weight: 600;
         color: #586d39;
         margin-bottom: 7px;
         float: right;
         display: flex;
      }

      img.sll-icon {
         height: 20px;
         padding-top: 0px;
         padding-right: 3px;
      }

      @media screen and (max-width: 1440px) and (max-height: 900px) {
         .main-result .hero-banner-left-content {
            margin-top: 50px !important;
         }

         .main-result .hero-banner-text {
            margin-top: 50px !important;
         }
      }

      @media screen and (min-width: 1441px) and (max-height: 900px) {
         .main-result .hero-banner-left-content {
            margin-top: 50px !important;
         }

         .main-result .hero-banner-text {
            margin-top: 50px !important;
         }
      }

      @media(max-width: 991px) {
         .demo-one {
            width: 100%;
            height: auto;
            position: relative;
            padding: 65px 20px 65px 20px !important;
         }

         .demo-two {
            margin-left: 0%;
            width: 100%;
            padding: 28px 20px 40px 20px !important;
         }

         .main-result .hero-banner {
            height: auto !important;
         }

         .main-result .hero-banner-left-content {
            margin-top: 0px !important;
         }

         .main-result .hero-banner-text {
            margin-top: 50px !important;
         }

      }

      @media(max-width: 576px) {
         .hero-banner h2 {
            font-size: 40px !important;
         }

         .hero-banner h3 {
            font-size: 16px !important;
            margin: 0px !important;
            line-height: 19.2px;
         }

         .banner-header-border {
            margin-top: 24px !important;
            margin-bottom: 24px !important;
         }
      }

      .loader {
         display: none;
         color: red;
      }

      #idname {
         color: red;
      }

      /**Hide jquery validation error message & red border on inputbox [START] */
      /* .error {
         border-color: red;
         color: red !important;
      }

      #result_page_form label.error {
         display: none !important;
      } */

      /**Hide jquery validation error message & red border on inputbox [END] */
   </style>
</head>

<div class="row">
   <div class="free-trial-card-titla">
      <form id="result_page_form">
         <div class="col-md-6 ">
            <input class="result_payment_firstname" name="firstname" type="hidden" value="">
            <input class="result_payment_email" name="email" type="hidden" value="">
            <div class="form-group">
               <div class="payment-title">
                  Payment information

               </div>
               <div class="name-on-card">
                  Name on card:
                  <input class="result_payment_name form-control form-control-lg work_sans_400" name="cardname" type="text" placeholder="JAKE MORGON" data-parsley-id="5" />
               </div>

            </div>
         </div>


         <div class="col-sm-6">
            <div class="form-group">
             Card Details:
               <div class="row ex-div-two">
                  <div class="col-md-5 card-numer-feild">

                     <input class="result_payment_cardno form-control form-control-lg card-number work_sans_400" style="margin-top: 10px;" name="cardnumber" size="20" type="text" placeholder="8435 5324 5843 5849" data-parsley-id="7">
                  </div>
                  <div class="col-md-3 month-field">
                     <div class="form-group">

                        <input class="result_payment_exmonth form-control w-100 form-control-lg card-expiry-month work_sans_400" style="margin-top: 10px; width: 100%;" name="mmexpiry" size="4" type="text" placeholder="04" data-parsley-id="9">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-3 form-group expiration required">
                     <input class="result_payment_exyear form-control form-control-lg w-100 card-expiry-year work_sans_400" style="margin-top: 10px; width: 100%;" name="yyexpiry" size="4" type="text" placeholder="2024 " data-parsley-id="11">
                  </div>
                  <div class="col-md-3 cvv-sectio">
                     <div class="form-group">

                        <input class="result_payment_cvv form-control form-control-lg w-100 card-cvc work_sans_400" style="margin-top: 10px; width: 100%;" name="cvv" type="text" placeholder="431" data-parsley-id="13">
                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="form-group ">
                        <input type="text" class="form-control form-control-lg  work_sans_400 br-three" name="firstname" id="firstname" aria-describedby="firstname" placeholder="First Name">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-lg  work_sans_400 br-three" name="lastname" id="lastname" aria-describedby="lastname" placeholder="Last Name">
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <div class="btn-center start-program-now-btn">
            <button id="resuult_payment_btnn" class="" name="submit">
               <span class="bold-start-text">START PROGRAM NOW </span>
               <div class="will-not-be">
                  YOU WILL NOT BE CHARGED FOR THE FIRST 7 DAYS
               </div>
            </button>
         </div>
         <div class="payment-term"> To start your free trial, we require your payment information but you will <span class="f-700 color-black">not be charged</span> until your 7 days trial ends. <span class="f-700 color-black">Cancel anytime.</span>
         </div>
         <div class="loader">
            <center>
               <div class="loading loader loading-image"><h1>Please Wait...</h1></div>
            </center>
         </div>
      </form>
      <div id="landingerror"></div>
   </div>
</div>
<script>
   jQuery(document).on('click', '#resuult_payment_btnn', function(e) {
      alert('here');
      jQuery("#result_page_form").validate({
       
         rules: {
            firstname: {
               required: true
            },
            lastname: {
               required: true
            },
            cardname: {
               required: true
            },
            cardnumber: {
               required: true,
               digits: true,
               maxlength: 16,
               minlength: 16
            },
            mmexpiry: {
               required: true,
               digits: true,
               maxlength: 2,
               minlength: 2
            },
            yyexpiry: {
               required: true,
               digits: true,
               maxlength: 4,
               minlength: 4
            },
            cvv: {
               required: true,
               digits: true,
               maxlength: 3,
               minlength: 3
            },
            terms: {
               required: true
            },
         },
         messages: {
            firstname: {
               required: 'Please enter first name & lastname'
            },
            lastname: {
               required: 'Please enter first name & lastname'
            },
            cardname: {
               required: 'Please enter card name'
            },
            cardnumber: {
               required: 'Please enter card number',
               minlength: "Please enter 16 digit Number.",
               maxlength: "Please enter 16 digit Number."
            },
            mmexpiry: {
               required: 'Required',
               minlength: "Please enter 2 digit Number.",
               maxlength: "Please enter 2 digit Number."
            },
            yyexpiry: {
               required: 'Required',
               minlength: "Please enter 4 digit Number.",
               maxlength: "Please enter 4 digit Number."
            },
            cvv: {
               required: 'Required',
               minlength: "Please enter 3 digit Number.",
               maxlength: "Please enter 3 digit Number."
            },
            terms: {
               required: 'Please accept the Terms and Conditions before continuing'

            }
         },
         groups: {
            onemsg: "firstname lastname"//validate multiple fields with one error
        },
       
         submitHandler: function(form) {
            console.log("ResultAjax");
            jQuery('#resuult_payment_btnn').attr('disabled', 'disabled')
            //var PlanId = 'price_1LjcEAGSLZI5qKJBf5SZk6ZZ';
            //sessionStorage.setItem('plan_id', PlanId);
            //var review_result_payment = jQuery('.review_result_payment').val();
            var resultcardname = jQuery('.result_payment_name').val();
            var resultcardnumber = jQuery('.result_payment_cardno').val();
            var resultexmonth = jQuery('.result_payment_exmonth').val();
            var resultexyear = jQuery('.result_payment_exyear').val();
            var resultcvv = jQuery('.result_payment_cvv').val();
            //var resultemail = jQuery('.result_payment_email').val();
            //var resultfirstname = jQuery('.result_payment_firstname').val();
           // var coupon_code = jQuery('#result_payment_coupon').val();

            jQuery.ajax({
               type: 'POST',
               dataType: 'json',
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               data: {
                  'action': 'result_page_sub',
                  'cardname': resultcardname,
                  'cardnumber': resultcardnumber,
                  'exmonth': resultexmonth,
                  'exyear': resultexyear,
                  'cvv': resultcvv,
                  //'plan': PlanId,
                 // 'resultemail': resultemail,
                 // 'resultfirstname': resultfirstname,
                  //'resultcoupon': coupon_code,
               },
               beforeSend: function() {
                  jQuery('.loader').show()
               },
               success: function() {
                  alert('success');
                  // // console.log(response);
                  // if (response === false) {
                  // 	jQuery("#landingerror").html("Invalid card details");
                  // 	jQuery('.loader').hide();
                  // 	jQuery('#resuult_payment_btnn').removeAttr('disabled')
                  // } else {
                  // 	jQuery('#resuult_payment_btnn').removeAttr('disabled')
                  // 	var result_id = response.result_id;
                  // 	var result_PurchaseDate = response.result_PurchaseDate;
                  // 	var result_ExpiredDate = response.result_ExpiredDate;
                  // 	var assessment_id = response.assessment_id;
                  // 	sessionStorage.setItem('result_id', result_id);
                  // 	sessionStorage.setItem('result_PurchaseDate', result_PurchaseDate);
                  // 	sessionStorage.setItem('result_ExpiredDate', result_ExpiredDate);
                  // 	setTimeout(function() {
                  // 		window.location.href = "https://transdirect.plutustec.in/your-results-003?assessment_id=" + assessment_id;
                  // 	}, 2000);
                  // }
               }
            });
         }
      });
   });
</script>