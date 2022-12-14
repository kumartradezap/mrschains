<script>
	/**
	* Define Admin Form validation rules and messages
	*
	* @param object rule
	* @return object validation
	*/
	jQuery.validator.addMethod("dollarscent", function(value,element) {
		return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
	}, "You must include Two Decimal Places");
	function gethallmarkValidationRules(rule) {
		return validation = {
			"admin" : {
				"rate" : {
					"required": {
						"value": true,
						"message": "Please enter the rate"
					},
					"range": {
						"value": [0.01,100.00],
						"message": "Please enter the value between Greater than 0 and less than or Equal to 100"
					},
					"dollarscent":{
						"value": true
					}
				},
            },
        };
    }

	/**
	* Validate the input whenever the input value is changed
	*/
	$(document).on('blur', '.pos_validate', function() {
		var rule_type 		= $(this).data('rule');
		var rule 			= fieldRule[rule_type];
		var validation 		= gethallmarkValidationRules(rule);
		var input_name 		= $(this).attr('name');
		var name 			= "";
		var inputArray 		= input_name.match(/(.*?)\[(.*?)\]/);
		if(inputArray != null) {
			name = inputArray[1];
		}else {
			name = input_name;
		}

		var validator 		= validation[rule_type][name];
		var input_value 	= $(this).val();
		var error_message 	= formValidation.doValidate(input_value, validator);

		if($(this).next().hasClass('validation_error')) {
			if(error_message.length == 0) {
				$(this).next().html(error_message);
				$(this).removeClass('error_border');
			} else {
				$(this).next().html(error_message);
				$(this).addClass('error_border');
			}
		}
	});

	/**
	* Create/Update the hallmark form
	*/
	$('#hallmark-submit').click(function(event){
		event.preventDefault();	
		var form         = "admin-form";
		var rule         = fieldRule.admin;
		var validation   = gethallmarkValidationRules(rule);
		var data         = $('#'+form).serializeArray();
		var validator    = validation.admin;
		formValidation.clearFormInputs(form, data);
		var formResponse = formValidation.doFormValidation(data, validator);
		if (formResponse.valid) {
			if (path.indexOf('localhost') != -1) {
			}
			else{
				if (grecaptcha.getResponse()) {
					

				} else {
					toastr.error('Please confirm captcha to proceed');
					return false;
				}
			}
			$(".corona-preloader-backdrop").show();
			$( "#admin-form" ).submit();
		}
		else {
			formValidation.renderFormErrorMessages(form, formResponse.errorMessages);
			return false;
		}
	});
	function isurlcheck(str)
	{
		regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
		if (regexp.test(str))
		{
			if(Number.isInteger(str))
			{
				return false;
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}

</script>
