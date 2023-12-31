// Class definition
var FormControls = function () {
	// Private functions
	var _submitForms = function () {

		if ($('#form_content').length) {

			FormValidation.formValidation(
				document.getElementById('form_content'),
				{
					fields: {
						content_title: {
							validators: {
								notEmpty: {
									message: 'Le titre du contenu est un champs requis'
								},
							}
						},

						content_url: {
							validators: {
								notEmpty: {
									message: 'L\'url du contenu est un champs requis'
								},
								uri: {
									message: 'L\'url du contenu ne possède pas un format valide'
								}
							}
						},

						content_youtube: {
							validators: {
								uri: {
									message: 'L\'url de l\'embed Youtube ne possède pas un format valide'
								}
							}
						},

						content_template: {
							validators: {
								notEmpty: {
									message: 'Le modèle de page du contenu est un champs requis'
								},
							}
						},

						email: {
							validators: {
								notEmpty: {
									message: 'Email is required'
								},
								emailAddress: {
									message: 'The value is not a valid email address'
								}
							}
						},

						digits: {
							validators: {
								notEmpty: {
									message: 'Digits is required'
								},
								digits: {
									message: 'The velue is not a valid digits'
								}
							}
						},

						creditcard: {
							validators: {
								notEmpty: {
									message: 'Credit card number is required'
								},
								creditCard: {
									message: 'The credit card number is not valid'
								}
							}
						},

						phone: {
							validators: {
								notEmpty: {
									message: 'US phone number is required'
								},
								phone: {
									country: 'US',
									message: 'The value is not a valid US phone number'
								}
							}
						},

						option: {
							validators: {
								notEmpty: {
									message: 'Please select an option'
								}
							}
						},

						options: {
							validators: {
								choice: {
									min:2,
									max:5,
									message: 'Please select at least 2 and maximum 5 options'
								}
							}
						},

						memo: {
							validators: {
								notEmpty: {
									message: 'Please enter memo text'
								},
								stringLength: {
									min:50,
									max:100,
									message: 'Please enter a menu within text length range 50 and 100'
								}
							}
						},

						checkbox: {
							validators: {
								choice: {
									min:1,
									message: 'Please kindly check this'
								}
							}
						},

						checkboxes: {
							validators: {
								choice: {
									min:2,
									max:5,
									message: 'Please check at least 1 and maximum 2 options'
								}
							}
						},

						radios: {
							validators: {
								choice: {
									min:1,
									message: 'Please kindly check this'
								}
							}
						},
					},

					plugins: { //Learn more: https://formvalidation.io/guide/plugins
						trigger: new FormValidation.plugins.Trigger(),
						// Bootstrap Framework Integration
						bootstrap: new FormValidation.plugins.Bootstrap(),
						// Validate fields when clicking the Submit button
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		// Submit the form when all fields are valid
	            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					}
				}
			);

		}
	}

	return {
		// public functions
		init: function() {
			_submitForms();
		}
	};
}();

jQuery(document).ready(function() {
	FormControls.init();
});
