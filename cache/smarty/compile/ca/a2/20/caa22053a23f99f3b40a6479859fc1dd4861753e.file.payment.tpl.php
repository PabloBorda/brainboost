<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:34:33
         compiled from "/home/brainboo/public_html/modules/stripe_official/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7738670615923839930d622-22688227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'caa22053a23f99f3b40a6479859fc1dd4861753e' => 
    array (
      0 => '/home/brainboo/public_html/modules/stripe_official/views/templates/hook/payment.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7738670615923839930d622-22688227',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stripe_mode' => 0,
    'module_dir' => 0,
    'stripe_save_tokens_ask' => 0,
    'stripe_credit_card' => 0,
    'publishableKey' => 0,
    'customer_name' => 0,
    'mode' => 0,
    'ps_version15' => 0,
    'currency' => 0,
    'amount_ttl' => 0,
    'secure_mode' => 0,
    'baseDir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_592383993e5346_41806154',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592383993e5346_41806154')) {function content_592383993e5346_41806154($_smarty_tpl) {?>
<script type="text/javascript">
    var mode = <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['stripe_mode']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;
</script>
<div class="row">
	<div class="col-xs-12">
		<div class="payment_module" style="border: 1px solid #d6d4d4; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding-left: 15px; padding-right: 15px;">

			
            <input type="hidden" id="stripe-incorrect_number" value="<?php echo smartyTranslate(array('s'=>'The card number is incorrect.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-invalid_number" value="<?php echo smartyTranslate(array('s'=>'The card number is not a valid credit card number.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-invalid_expiry_month" value="<?php echo smartyTranslate(array('s'=>'The card\'s expiration month is invalid.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-invalid_expiry_year" value="<?php echo smartyTranslate(array('s'=>'The card\'s expiration year is invalid.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-invalid_cvc" value="<?php echo smartyTranslate(array('s'=>'The card\'s security code is invalid.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-expired_card" value="<?php echo smartyTranslate(array('s'=>'The card has expired.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-incorrect_cvc" value="<?php echo smartyTranslate(array('s'=>'The card\'s security code is incorrect.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-incorrect_zip" value="<?php echo smartyTranslate(array('s'=>'The card\'s zip code failed validation.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-card_declined" value="<?php echo smartyTranslate(array('s'=>'The card was declined.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-missing" value="<?php echo smartyTranslate(array('s'=>'There is no card on a customer that is being charged.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-processing_error" value="<?php echo smartyTranslate(array('s'=>'An error occurred while processing the car.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-rate_limit" value="<?php echo smartyTranslate(array('s'=>'An error occurred due to requests hitting the API too quickly. Please let us know if you\'re consistently running into this error.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-3d_declined" value="<?php echo smartyTranslate(array('s'=>'The card doesn\'t support 3DS.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
            <input type="hidden" id="stripe-no_api_key" value="<?php echo smartyTranslate(array('s'=>'There\'s an error with your API keys. If you\'re the administrator of this website, please go on the "Connection" tab of your plugin.','mod'=>'stripe_official'),$_smarty_tpl);?>
">
			<div id="stripe-ajax-loader"><img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/ajax-loader.gif" alt="" />&nbsp; <?php echo smartyTranslate(array('s'=>'Transaction in progress, please wait.','mod'=>'stripe_official'),$_smarty_tpl);?>
</div>
			<form action="#" id="stripe-payment-form"<?php if (isset($_smarty_tpl->tpl_vars['stripe_save_tokens_ask']->value)&&$_smarty_tpl->tpl_vars['stripe_save_tokens_ask']->value&&isset($_smarty_tpl->tpl_vars['stripe_credit_card']->value)) {?> style="display: none;"<?php }?>>
                <h3 class="stripe_title"><?php echo smartyTranslate(array('s'=>'Pay by card','mod'=>'stripe_official'),$_smarty_tpl);?>
</h3>
                <div class="stripe-payment-errors"><?php if (isset($_GET['stripe_error'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_GET['stripe_error'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?></div><a name="stripe_error" style="display:none"></a>
        <input type="hidden" id="stripe-publishable-key" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['publishableKey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>

                <div>
				<label><?php echo smartyTranslate(array('s'=>'Cardholder\'s Name','mod'=>'stripe_official'),$_smarty_tpl);?>
</label>  <label class="required"> </label><br />
        <input type="text"  autocomplete="off" class="stripe-name" data-stripe="name" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['customer_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
                <img class="payment-ok" src="/img/admin/enabled.gif">
                <img class="payment-ko" src="/img/admin/disabled.gif">
                </div>
                <div>
                    <label><?php echo smartyTranslate(array('s'=>'Card Number','mod'=>'stripe_official'),$_smarty_tpl);?>
</label>  <label class="required"> </label><br />
                    <input type="text" size="20" autocomplete="off" class="stripe-card-number" id="card_number" data-stripe="number" placeholder="&#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679;"/>
                    <img style="margin-left: -57px;" class="payment-ok" src="/img/admin/enabled.gif">
                    <img style="margin-left: -57px;" class="payment-ko" src="/img/admin/disabled.gif">
                </div>
				<!--<div class="block-left">
					<label><?php echo smartyTranslate(array('s'=>'Card Type','mod'=>'stripe_official'),$_smarty_tpl);?>
</label><br />
					<?php if ($_smarty_tpl->tpl_vars['mode']->value==1) {?>
						<p><?php echo smartyTranslate(array('s'=>'Click on any of the credit card buttons below in order to fill automatically the required fields to submit a test payment.','mod'=>'stripe_official'),$_smarty_tpl);?>
</p>
					<?php }?>
					<img class="cc-icon disable"  id="visa"       rel="Visa"       alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-visa.png" />
					<img class="cc-icon disable"  id="mastercard" rel="MasterCard" alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-mastercard.png" />
					<img class="cc-icon disable"  id="discover"   rel="Discover"   alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-discover.png" />
					<img class="cc-icon disable"  id="amex"       rel="Amex"       alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-amex.png" />
					<img class="cc-icon disable"  id="jcb"        rel="Jcb"        alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-jcb.png" />
					<img class="cc-icon disable"  id="diners"     rel="Diners"     alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/cc-diners.png" />
				</div>
                <br />-->
                <div class="block-left">
                <label><?php echo smartyTranslate(array('s'=>'Expiry date','mod'=>'stripe_official'),$_smarty_tpl);?>
</label>  <label class="required"> </label><br />
                <input type="text" size="7" autocomplete="off" id="card_expiry" class="stripe-card-expiry" maxlength = 5 placeholder="MM/YY"/>


                </div>
				<div>
					<label><?php echo smartyTranslate(array('s'=>'CVC/CVV','mod'=>'stripe_official'),$_smarty_tpl);?>
</label>  <label class="required"> </label><br />
					<input type="text" size="7" autocomplete="off" data-stripe="cvc" class="stripe-card-cvc" placeholder="&#9679;&#9679;&#9679;"/>
                    <img class="payment-ok" src="/img/admin/enabled.gif">
                    <img class="payment-ko" src="/img/admin/disabled.gif">
                    <a href="javascript:void(0)" class="stripe-card-cvc-info" style="border: none;">
						<div class="cvc-info">
						<?php echo smartyTranslate(array('s'=>'The CVC (Card Validation Code) is a 3 or 4 digit code on the reverse side of Visa, MasterCard and Discover cards and on the front of American Express cards.','mod'=>'stripe_official'),$_smarty_tpl);?>

						</div>
					</a>
				</div>
				<div class="clear"></div>

				<button type="submit" class="stripe-submit-button">
                    <img alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/lock-locked.png"/>
                    <?php echo smartyTranslate(array('s'=>'Buy now','mod'=>'stripe_official'),$_smarty_tpl);?>

                </button>

                <div class="clear"></div>
                <img class="powered_stripe" alt="" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/img/powered_by_stripe.png"/>
			</form>
			<div id="stripe-translations">
				<span id="stripe-wrong-cvc"><?php echo smartyTranslate(array('s'=>'Wrong CVC.','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
				<span id="stripe-wrong-expiry"><?php echo smartyTranslate(array('s'=>'Wrong Credit Card Expiry date.','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
				<span id="stripe-wrong-card"><?php echo smartyTranslate(array('s'=>'Wrong Credit Card number.','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
				<span id="stripe-please-fix"><?php echo smartyTranslate(array('s'=>'Please fix it and submit your payment again.','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
				<span id="stripe-card-del"><?php echo smartyTranslate(array('s'=>'Your Credit Card has been successfully deleted, please enter a new Credit Card:','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
				<span id="stripe-card-del-error"><?php echo smartyTranslate(array('s'=>'An error occured while trying to delete this Credit card. Please contact us.','mod'=>'stripe_official'),$_smarty_tpl);?>
</span>
			</div>
		</div>
	</div>
</div>
<div id="modal_stripe"  class="modal" style="display: none">
            <div id="result_3d"> </div></div>


<script type="text/javascript" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/js/jquery.the-modal.js"></script>
<link rel="stylesheet" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
views/css/the-modal.css" type="text/css" media="all">
<script type="text/javascript">
var ps_version = <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['ps_version15']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;
var currency = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
var amount_ttl = <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['amount_ttl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;
var secure_mode = <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['secure_mode']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;
if (ps_version) {
    var baseDir = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['baseDir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
}

function lookupCardType(number)
{
  if (number.match(new RegExp('^4')) !== null) {
    return 'Visa';
  }
  if (number.match(new RegExp('^(34|37)')) !== null) {
    return 'Amex';
  }
  if (number.match(new RegExp('^5[1-5]')) !== null) {
    return 'MasterCard';
  }
  if (number.match(new RegExp('^6011')) !== null) {
    return 'Discover';
  }
  if (number.match(new RegExp('^(?:2131|1800|35[0-9]{3})[0-9]{3,}')) !== null) {
    return 'Jcb';
  }
  if (number.match(new RegExp('^3(?:0[0-5]|[68][0-9])[0-9]{4,}')) !== null) {
    return 'Diners';
  }
}
function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    var matches = v.match(/\d{4,16}/g);
    var match = matches && matches[0] || '';
    var parts = [];
    for (i=0, len=match.length; i<len; i+=4) {
        parts.push(match.substring(i, i+4));
    }
    if (parts.length) {
        return parts.join(' ');
    } else {
        return value;
    }
}



$(document).ready(function() {

    //Put our input DOM element into a jQuery Object
    var jqDate = document.getElementById('card_expiry');

    //Bind keyup/keydown to the input
    $(jqDate).bind('keyup','keydown', function(e){
        var value_exp = $(jqDate).val();
        var v = value_exp.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        var matches = v.match(/\d{2,4}/g);

        //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
        if(e.which !== 8) {
            var numChars = value_exp.length;
            if(numChars === 2){
                var thisVal = value_exp;
                thisVal += '/';
                $(jqDate).val(thisVal);
            }
            if (numChars === 5)
                return false;
        }
    });


    document.getElementById('card_number').oninput = function() {
        this.value = cc_format(this.value);

        cardNmb = Stripe.card.validateCardNumber($('.stripe-card-number').val());

        var cardType = Stripe.card.cardType(this.value);
        if (cardType != "Unknown") {
            if (cardType == "American Express")
                cardType = "amex";
            if (cardType == "Diners Club")
                cardType = "diners";
            if ($('.img-card').length > 0) {
                if ($('#img-'+cardType).length > 0) {
                    return false;
                } else {
                    $('.img-card').remove();
                }
            }

            var card_logo = document.createElement('img');
            card_logo.src = baseDir + 'modules/stripe_official/views/img/cc-' + cardType.toLowerCase() +'.png';
            card_logo.id = "img-"+cardType;
            card_logo.className = "img-card";
            $(card_logo).insertAfter('.stripe-card-number');
            $('#img-'+cardType).css({'margin-left': '-34px'});
            if (ps_version) {
                $('#img-'+cardType).css({
                    float: 'none',
                    'margin-bottom': '-5px'
                });
            }

        } else {
            if ($('.img-card').length > 0) {
                $('.img-card').remove();
            }

        }
    }


    // Get Stripe public key
    var StripePubKey = $('#stripe-publishable-key').val();
    if (StripePubKey) {
        Stripe.setPublishableKey(StripePubKey);
    }



    $('#stripe-payment-form').submit(function (event) {

        var $form = $(this);
        if (!StripePubKey) {
            $('.stripe-payment-errors').show();
            $form.find('.stripe-payment-errors').text($('#stripe-no_api_key').val()).fadeIn(1000);
            return false;
        }
        var cardNmb = Stripe.card.validateCardNumber($('.stripe-card-number').val());
        var cvcNmb = Stripe.card.validateCVC($('.stripe-card-cvc').val());
        if (cvcNmb == false) {
            $('.stripe-payment-errors').show();
            $form.find('.stripe-payment-errors').text($('#stripe-invalid_cvc').val()).fadeIn(1000);
            return false;
        }
        if (cardNmb == false) {
            $('.stripe-payment-errors').show();
            $form.find('.stripe-payment-errors').text($('#stripe-incorrect_number').val()).fadeIn(1000);
            return false;
        }
        /* Disable the submit button to prevent repeated clicks */
        $('.stripe-submit-button').attr('disabled', 'disabled');
        $('.stripe-payment-errors').hide();
        $('#stripe-payment-form').hide();
        $('#stripe-ajax-loader').show();

        exp_month = $('.stripe-card-expiry').val();
        exp_month_calc = exp_month.substring(0, 2);
        exp_year = $('.stripe-card-expiry').val();
        exp_year_calc = "20" + exp_year.substring(3);

        Stripe.card.createToken({
            number: $('.stripe-card-number').val(),
            cvc: $('.stripe-card-cvc').val(),
            exp_month: exp_month_calc,
            exp_year: exp_year_calc,
            name: $('.stripe-name').val()
        }, function (status, response) {
            var $form = $('#stripe-payment-form');

            if (response.error) {
                // Show error on the form
                $('#stripe-ajax-loader').hide();
                $('#stripe-payment-form').show();
                $('.stripe-submit-button').removeAttr('disabled');

                var err_msg = $('#stripe-'+response.error.code).val();
                if (!err_msg || err_msg == "undefined" || err_msg == '')
                    err_msg = response.error.message;
                $form.find('.stripe-payment-errors').text(err_msg).fadeIn(1000);
            } else {
                if (secure_mode || response.card.three_d_secure.supported == "required") {
                    Stripe.threeDSecure.create({
                        card: response.id,
                        amount: amount_ttl,
                        currency: currency,
                    }, function (status, response) {
                        if (response.status == "redirect_pending") {
                            $('#modal_stripe').modal({cloning: false, closeOnOverlayClick: false, closeOnEsc: false}).open();
                            Stripe.threeDSecure.createIframe(response.redirect_url, result_3d, callbackFunction3D);
                            $('#result_3d iframe').css({
                                height: '400px',
                                width: '100%'
                            });
                        } else if (response.status == "succeeded") {
                            createCharge(response);
                        } else if (response.status == "failed") {
                            var cardType = Stripe.card.cardType($('.stripe-card-number').val());
                            if (cardType == "American Express") {
                                createCharge();
                            } else {
                                $('#stripe-ajax-loader').hide();
                                $('#stripe-payment-form').show();
                                $('.stripe-payment-errors').show();
                                $form.find('.stripe-payment-errors').text($('#stripe-3d_declined').val()).fadeIn(1000);
                                $('.stripe-submit-button').removeAttr('disabled');
                            }
                        }
                        //return false; exit;
                    });
                    function callbackFunction3D(result) {
                        $('#modal_stripe').modal().close();
                        if (result.status == "succeeded") {
                            // Send the token back to the server so that it can charge the card
                            createCharge(result);
                        } else {
                            $('#stripe-ajax-loader').hide();
                            $('#stripe-payment-form').show();
                            $('.stripe-payment-errors').show();
                            $form.find('.stripe-payment-errors').text($('#stripe-card_declined').val()).fadeIn(1000);
                            $('.stripe-submit-button').removeAttr('disabled');
                        }
                    }
                } else {
                    createCharge();
                }

                function createCharge(result) {
                    if (typeof(result) == "undefined") {
                        result = response;
                    }
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: baseDir + 'modules/stripe_official/ajax.php',
                        data: {
                            stripeToken: result.id,
                            cardType: lookupCardType($('.stripe-card-number').val()),
                            cardHolderName: $('.stripe-name').val(),
                        },
                        success: function(data) {
                            if (data.code == '1') {
                                // Charge ok : redirect the customer to order confirmation page
                                location.replace(data.url);
                            } else {
                                //  Charge ko
                                $('#stripe-ajax-loader').hide();
                                $('#stripe-payment-form').show();
                                $('.stripe-payment-errors').show();
                                $('.stripe-payment-errors').text(data.msg).fadeIn(1000);
                                $('.stripe-submit-button').removeAttr('disabled');
                            }
                        },
                        error: function(err) {
                            // AJAX ko
                            $('#stripe-ajax-loader').hide();
                            $('#stripe-payment-form').show();
                            $('.stripe-payment-errors').show();
                            $('.stripe-payment-errors').text('An error occured during the request. Please contact us').fadeIn(1000);
                            $('.stripe-submit-button').removeAttr('disabled');
                        }
                    });
                }
            }
        });
        return false;
    });

  /* Cards mode */
  var cards_numbers = {
    "visa" : "4242424242424242",
    "mastercard" : "5555555555554444",
    "discover" : "378282246310005",
    "amex" : "6011111111111117",
    "jcb" : "30569309025904" ,
    "diners" : "3530111333300000"
  };

  /* Test Mode All Card enable */
  var cards = ["visa", "mastercard", "discover", "amex", "jcb", "diners"];
  if (mode == 1) {
    $.each(cards, function(data) {
      $('#' + cards[data]).addClass('enable');
    });

    /* Auto Fill in Test Mode */
    $.each(cards_numbers, function(key, value) {
      $('#' + key).click(function()  {
        $('.stripe-card-number').val(value);
        $('.stripe-name').val('Joe Smith');
        $('.stripe-card-cvc').val(131);
        $('.stripe-card-expiry-year').val('2023');
      });
    });

  }

  /* Determine the Credit Card Type */
  $('.stripe-card-number').keyup(function () {
    if ($(this).val().length >= 2) {
      stripe_card_type = lookupCardType($('.stripe-card-number').val());
      $('.cc-icon').removeClass('enable');
      $('.cc-icon').removeClass('disable');
      $('.cc-icon').each(function() {
        if ($(this).attr('rel') == stripe_card_type) {
          $(this).addClass('enable');
        } else {
          $(this).addClass('disable');
        }
      });
    } else {
      $('.cc-icon').removeClass('enable');
      $('.cc-icon:not(.disable)').addClass('disable');
    }
  });

  // TODO : Seems useless ...
  /*$('#stripe-payment-form-cc').submit(function (event) {
    $('.stripe-payment-errors').hide();
    $('#stripe-payment-form-cc').hide();
    $('#stripe-ajax-loader').show();
    $('.stripe-submit-button-cc').attr('disabled', 'disabled'); /* Disable the submit button to prevent repeated clicks */
  /*});

  /* Catch callback errors */
  if ($('.stripe-payment-errors').text()) {
    $('.stripe-payment-errors').fadeIn(1000);
  }

  $('#stripe-payment-form input').keypress(function () {
    $('.stripe-payment-errors').fadeOut(500); 
  });
});
</script>


<?php }} ?>
