/*-------------- AOS --------------*/
AOS.init({
  disable: function() {
    var maxWidth = 800;
    return window.innerWidth < maxWidth;
  }
});


/*-------------- Tooltips --------------*/
$('[data-toggle="tooltip"]').tooltip();

/*-------------- Cookie --------------*/
function cookieAjax(value) {
  $.post(cookieAcceptUrl, {
    "value": value
  }, function (reponse) {
    $('#MessageCookie').empty().append(reponse);
  });
}

$("#ButtonCookie").click(function (e) {
  cookieAjax(1);
});

/*-------------- Navbar --------------*/
// Active
var path = window.location.pathname;
for (var i = 0; i < 4; i++) {
  if (path == $('.navbar-nav').children('li:eq('+i+')').children('a').attr('href')) {
    $('.navbar-nav').children('li:eq('+i+')').toggleClass('active');
  }
}

// Navigation box-shadow on scroll
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  if (scroll >0) {
    $("#navbar").addClass("active");
  }
  else {
    $("#navbar").removeClass("active");
  }
});

/*-------------- Scroll to top --------------*/
$('.js--scroll-to-header').click(function (){
  $('html, body').animate({scrollTop: $('.js--section-header').offset().top}, 1000);
});

/*-------------- Track parcel form --------------*/
function myDisplay() {
  document.getElementById("secondInput").style.display = "block";
}

$(document).on('keypress', '#TrackParcelNumParcel', function(e) {
    var code = e.keyCode || e.which;
    if (code == 32) {
        return false;
    }
});

$(document).ready(function () {
    if ( $('#TrackParcelHomeForm').length > 0 ){

      $('#TrackParcelHomeForm').validate({
        errorPlacement: function(error,element){
          $(element).addClass('is-invalid');
          $(element).removeClass('is-valid');
        },
        success: function (label, element) {
          $(element).addClass('is-valid');
          $(element).removeClass('is-invalid');
        },
        submitHandler: function(form){
          $("#loadMe").modal({
            backdrop: "static", //remove ability to close modal with click
            keyboard: false, //remove option to close with keyboard
            show: true //Display loader!
          });
          $("#loadMe").on("show", function () {
            $("body").addClass("modal-open");
          }).on("hidden", function () {
            $("body").removeClass("modal-open")
          });

          $('#complete-txt').hide(0);
          $('#complete-error').hide(0);

          $.ajax({
              url: detectCarrierUrl + $('#TrackParcelNumParcel').val(),
              success: function(response) {
                  var data = JSON.parse(response)

                  $('.modal-text1').delay(1000).fadeIn("slow").show(0);
                  $('.modal-text2').delay(2000).fadeIn("slow").show(0);
                  $('.modal-text3').delay(3000).fadeIn("slow").show(0);

                  $('#loader-txt').delay(5000).slideToggle();

                  if (typeof data.code !== 'undefined' && typeof data.name !== 'undefined') {
                      $('#complete-carrier-logo').attr('src', carrierLogoUrl.replace('{code}', data.code)).show();
                      $('#complete-carrier-logo').on('error', function() {
                        $(this).hide();
                      });
                      $('#complete-carrier-name').text(data.name);
                  }

                  $('#complete-txt').delay(5500).slideToggle().show(0);

                  setTimeout(function() {
                    if (typeof data.code !== 'undefined' && typeof data.name !== 'undefined') {
                        $('#TrackParcelCarrier').val(JSON.stringify({
                            'code': data.code,
                            'name': data.name
                        }));
                    }
                    form.submit();
                  }, 7500);
              }
          })
        },
        rules:{
          'data[TrackParcel][num_parcel]': {
            required: true,
          },
          'data[Customer][email]': {
            required: true,
            email: true
          },
          'data[Customer][cgv]': {
            required: true
          }
        },
        invalidHandler:	function(form, validator) {

        }
      });

    }
});

/*-------------- Payment form --------------*/
function luhnCheck(value) {
  var sum = 0;
  var numdigits = value.length;
  var parity = numdigits % 2;
  for (var i = 0; i < numdigits; i++) {
    var digit = parseInt(value.charAt(i));
    if (i % 2 == parity) digit *= 2;
    if (digit > 9) digit -= 9;
    sum += digit;
  }

  return (sum % 10) == 0;
};

$( document ).ready(function() {

    // Hide carrier logo if carrier logo image doesn't load/exist
    $('#carrier-logo').on('error', function() {
      $(this).hide();
    });

    if ($('#PaiementIndexForm').length > 0) {
        // NOTE: Redirect to "unavailable service" to cancel payment
        // Remove once we've set up payment

        var cleaveCard = new Cleave('#CardNumber', {
          creditCard: true,
          onCreditCardTypeChanged: function (type) {
            // document.querySelector('.type').innerHTML = type;
            switch (type) {
              case 'visa':
              case 'mastercard':
              case 'amex':
              case 'discover':
              case 'jcb':
              case 'maestro':
                $('#CardNumber').css('background-image', 'url(/img/cards/' + type + '.png)');
                break;
              default:
                $('#CardNumber').css('background-image', 'url(/img/cards/credit-card.png)');
            }
          }
        });

        $('#CardNumber').on('input', function() {
          max_length = cleaveCard.properties.blocks.length-1 + cleaveCard.properties.maxLength;
          if ($(this).val().length == max_length) {
            $('#CardDateExpire').focus();
          }
        });

        var cleave = new Cleave('#CardDateExpire', {
          date: true,
          datePattern: ['m', 'y']
        });

        $('#CardDateExpire').on('input', function() {
          if ($(this).val().length == 5) {
            $('#CardCvv').focus();
          }
        });

        $('#PaiementIndexForm').validate({
          errorPlacement: function (error, element) {
            // error.appendTo( element.parent() );
            if (element.attr('id') == "CustomerCgv") {
              error.appendTo(element.parent());
            }

            $(element).addClass('is-invalid');
            $(element).removeClass('is-valid');
            element.parent('div').addClass('error-validate');
            return false;
          },
          success: function (label, element) {
            $(element).addClass('is-valid');
            $(element).removeClass('is-invalid');
            label.parent('div').find('label.error').remove();
          },
          submitHandler: function (form) {

            var luhn_check = true;
            //luhn_check = luhnCheck($('#Card0Number').val() + $('#Card1Number').val() + $('#Card2Number').val() + $('#Card3Number').val());
            luhn_check = luhnCheck($('#CardNumber').val().replace(/\s/g, ''));
            if (luhn_check == false) {
              //$('.div-input-number').addClass('error');
              alert(cardNumberInvalidMsg);
              return false;
            }
            else {

              $('#PaiementIndexForm button').hide();
              $('.loader').show();

              if (typeof $('#FormSubmit').val() === 'undefined') {
                ga('send', 'event', {
                  eventCategory: 'Payment',
                  eventAction: 'attemptedPayment',
                  eventLabel: 'Attempted Payment',
                });
              }

              form.submit();

            }
          },
          rules: {
            "data[Card][name]": {
              "required": true
            },
            "data[Card][number]": {
              "required": true,
              "minlength": 19,
              "maxlength": 19,
            },
            "data[Card][date_expire]": {
              "required": true,
              "minlength": 5,
              "maxlength": 5,
            },
            "data[Card][cvv]": {
              "required": true,
              "minlength": 3,
              "maxlength": 3,
            }
          }
        });
    }
});


/*-------------- Login form --------------*/
$(document).ready(function () {
    if ( $('#CustomerLoginForm').length > 0 ){

      $('#CustomerLoginForm').validate({
        showErrors: function(errorMap, errorList) {
          this.defaultShowErrors();
        },
        errorPlacement: function(error,element){
          error.appendTo( element.parent() );

          element.parent('div').addClass('error-validate');
        },
        rules:{
          'data[Customer][email]': {
            required: true,
            email: true
          },
          'data[Customer][password]': {
            required: true,
          }
        },
        messages: {
          'data[Customer][email]': {
            required: emailRequiredMsg,
            email: jQuery.validator.format(emailEmailMsg)
          },
          'data[Customer][password]': {
            required: passwordRequiredMsg,
          }
        },
        invalidHandler: function(form, validator) {

        },
        submitHandler: function(form) {

          form.submit();

        }
      });

    }
});

/*-------------- Contact form --------------*/
function formSubmitContact(response) {
  $("#ContactIndexForm").submit();
}

$(document).ready(function () {
    if ( $('#ContactIndexForm').length > 0 ){

      $('#ContactIndexForm').validate({
        showErrors: function(errorMap, errorList) {
          this.defaultShowErrors();
        },
        errorPlacement: function(error,element){
          error.appendTo( element.parent() );
          $(element).addClass('is-invalid');
          $(element).removeClass('is-valid');
        },
        success: function (label, element) {
          $(element).addClass('is-valid');
          $(element).removeClass('is-invalid');
          label.parent('div').find('label.error').remove();
        },
        rules:{
          'data[Contact][first_name]': {
            required: true
          },
          'data[Contact][last_name]': {
            required: true
          },
          'data[Contact][email]': {
            required: true,
            email: true
          },
          'data[Contact][subject]': {
            required: true,
            minlength: 2
          },
          'data[Contact][message]': {
            required: true,
            minlength: 10
          },
          'data[Contact][policy]': {
            required: true
          }
        },
        messages: {
          'data[Contact][first_name]': {
            required: firstnameRequiredMsg,
          },
          'data[Contact][last_name]': {
            required: lastnameRequiredMsg,
          },
          'data[Contact][email]': {
            required: emailRequiredMsg,
            email: jQuery.validator.format(emailEmailMsg)
          },
          'data[Contact][subject]': {
            required: subjectRequiredMsg,
            minlength: jQuery.validator.format(subjectMinMsg)
          },
          'data[Contact][message]': {
            required: messageRequiredMsg,
            minlength: jQuery.validator.format(messagetMinMsg)
          },
          'data[Contact][policy]': {
            required: policyRequiredMsg
          }
        },
        invalidHandler: function(form, validator) {

        },
        submitHandler: function(form) {

          if (grecaptcha.getResponse()) {
            form.submit();
          }else{
            grecaptcha.reset();
            grecaptcha.execute();
          }

        }
      });

    }
});

/*-------------- Complaint form --------------*/
function formSubmitClaim(response) {
  $("#ClaimClaimForm").submit();
}

$(document).ready(function () {
    if ( $('#ClaimClaimForm').length > 0 ){

      $('#ClaimClaimForm').validate({
        showErrors: function(errorMap, errorList) {
          this.defaultShowErrors();
        },
        errorPlacement: function(error,element){
          error.appendTo( element.parent() );
          $(element).addClass('is-invalid');
          $(element).removeClass('is-valid');
        },
        success: function (label, element) {
          $(element).addClass('is-valid');
          $(element).removeClass('is-invalid');
          label.parent('div').find('label.error').remove();
        },
        rules:{
          'data[Claim][first_name]': {
            required: true,
          },
          'data[Claim][last_name]': {
            required: true,
          },
          'data[Claim][email]': {
            required: true,
            email: true
          },
          'data[Claim][message]': {
            required: true,
            minlength: 10
          },
          'data[Claim][policy]': {
            required: true
          }
        },
        messages: {
          'data[Claim][first_name]': {
            required: firstnameRequiredMsg,
          },
          'data[Claim][last_name]': {
            required: lastnameRequiredMsg,
          },
          'data[Claim][email]': {
            required: emailRequiredMsg,
            email: jQuery.validator.format(emailEmailMsg)
          },
          'data[Claim][message]': {
            required: messageRequiredMsg,
            minlength: jQuery.validator.format(messagetMinMsg)
          },
          'data[Claim][policy]': {
            required: policyRequiredMsg
          }
        },
        invalidHandler: function(form, validator) {

        },
        submitHandler: function(form) {

          if (grecaptcha.getResponse()) {
            form.submit();
          }else{
            grecaptcha.reset();
            grecaptcha.execute();
          }

        }
      });

    }
});

/*-------------- Requests form --------------*/
$(document).ready(function () {
    if ( $('#ReqTicketFormRequestForm').length > 0 ){

      $('#ReqTicketFormRequestForm').validate({
        showErrors: function(errorMap, errorList) {
          this.defaultShowErrors();
        },
        errorPlacement: function(error,element){
          error.appendTo( element.parent() );
          $(element).addClass('is-invalid');
          $(element).removeClass('is-valid');
        },
        success: function (label, element) {
          $(element).addClass('is-valid');
          $(element).removeClass('is-invalid');
          label.parent('div').find('label.error').remove();
        },
        submitHandler: function(form){
          $('#ReqTicketFormRequestForm button[type="submit"]').hide();
          $('#ReqTicketFormRequestForm .loader').show();
          form.submit();
        },
        rules:{
          'data[ReqTicket][categorie_id]': {
            required: true,
          },
          'data[ReqTicket][subject]': {
            required: true,
          },
          'data[ReqTicket][content]': {
            required: true,
          }
        },
        messages: {
          'data[ReqTicket][categorie_id]': {
            required: categoryRequiredMsg,
          },
          'data[ReqTicket][subject]': {
            required: subjectRequiredMsg,
          },
          'data[ReqTicket][content]': {
            required: messageRequiredMsg,
          }
        },
        invalidHandler:	function(form, validator) {

        }
      });

    }

    if ( $('#ReqMessageDetailRequestForm').length > 0 ){

      $('#ReqMessageDetailRequestForm').validate({
        showErrors: function(errorMap, errorList) {
          this.defaultShowErrors();
        },
        errorPlacement: function(error,element){
          error.appendTo( element.parent() );
          $(element).addClass('is-invalid');
          $(element).removeClass('is-valid');
        },
        submitHandler: function(form){
          $('#ReqMessageDetailRequestForm button[type="submit"]').hide();
          $('#ReqMessageDetailRequestForm .loader').show();
          form.submit();
        },
        success: function (label, element) {
          $(element).addClass('is-valid');
          $(element).removeClass('is-invalid');
          label.parent('div').find('label.error').remove();
        },
        rules:{
          'data[ReqMessage][content]': {
            required: true,
          }
        },
        messages: {
          'data[ReqMessage][content]': {
            required: messageRequiredMsg,
          }
        },
        invalidHandler:	function(form, validator) {

        }
      });

    }
});

/*-------------- Dashboard --------------*/

$('.panel-collapse').on('show.bs.collapse', function () {
  $(this).siblings('.panel-heading').addClass('active');
});

$('.panel-collapse').on('hide.bs.collapse', function () {
  $(this).siblings('.panel-heading').removeClass('active');
});

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


if ( $('#TrackParcelDashboardForm').length > 0 ){

  $('#TrackParcelDashboardForm').validate({
    errorPlacement: function(error,element){
      $(element).addClass('is-invalid');
      $(element).removeClass('is-valid');
    },
    success: function (label, element) {
      $(element).addClass('is-valid');
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(form){

        $.ajax({
            method: 'POST',
            url: newParcelUrl + $('#TrackParcelNumParcel').val(),
            beforeSend: function() {
                $('.panel-group').prepend($('.panel-loading').first().clone().show().removeClass('panel-loading-system'));
            },
            success: function(response, status, xhr) {
                if (isJson(response)) {
                    alert(JSON.parse(response).message);
                }
                else {
                    $('.panel-group').find('.panel-loading').first().remove();
                    $('.panel-group').prepend(response);
                }
            }
        });

        return false;
    },
    rules:{
      'data[TrackParcel][num_parcel]': {
        required: true,
      }
    },
    invalidHandler:	function(form, validator) {

    }
  });

}

$('.identifier').click(function (e) {
  $('.nav-custom').each(function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
  }
  });

  $(this).closest('.nav-custom').addClass('active');

  var theStatusTheUserClicked = $(this).attr('identifier');

  $('.panel-group .panel').each(function () {
    if ( ($(this).hasClass(theStatusTheUserClicked) || theStatusTheUserClicked == 'all') && !$(this).hasClass('panel-loading-system')) {
        $(this).show()
    }
    else {
        $(this).hide()
    }
  })
});


/*----------- Tabs ------------*/
