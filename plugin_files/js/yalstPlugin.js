(function($)
{
var yalst =
{
	init: function()
	{
		this.toggleTestenForm();
		this.toggleIntegrationForm();
		this.addIntegrationCodeValidation();
	},

	// Form zur Bestellung des Testzuganges
	toggleTestenForm: function()
	{
		var toggleTestenForm = function()
		{
			if ($('#testen_1').is(':checked'))
			{
				$('#yalst_testzugang').hide();
			}
			else if ($('#testen_0').is(':checked'))
			{
				$('#yalst_testzugang').show();
			}
		};

		toggleTestenForm();
		$('#testen input').click(toggleTestenForm);
	},
	
	// Form zur Auswahl bei der Integration
	toggleIntegrationForm: function()
	{
		var toggleIntegrationForm = function()
		{
			if ($('#integration_0').is(':checked'))
			{
				$('#deactiveIntegration').show();
				$('#reiterIntegration').hide();
				$('#reiterWidgetIntegration').hide();
				$('#widgetIntegration').hide();
			}
			else if ($('#integration_1').is(':checked'))
			{
				$('#deactiveIntegration').hide();
				$('#reiterIntegration').show();
				$('#reiterWidgetIntegration').hide();
				$('#widgetIntegration').hide();
			}
			else if ($('#integration_2').is(':checked'))
			{
				$('#deactiveIntegration').hide();
				$('#reiterIntegration').hide();
				$('#reiterWidgetIntegration').show();
				$('#widgetIntegration').hide();
			}
			else if ($('#integration_3').is(':checked'))
			{
				$('#deactiveIntegration').hide();
				$('#reiterIntegration').hide();
				$('#reiterWidgetIntegration').hide();
				$('#widgetIntegration').show();
			}
		};

		toggleIntegrationForm();
		$('#integration input').click(toggleIntegrationForm);
	},
	
	// Textarea Validation for Integration Code
	
	addIntegrationCodeValidation: function()
	{
		Array.prototype.forEach.call(document.querySelectorAll("#yalstReiterIntegration, #yalstReiterWidgetIntegration"),
		function(textArea)
			{
				textArea.addEventListener('change', function()
				{
					if (/\bscript\.src\s*=\s*.+\.php.+(site=\d+-\d+)/im.test(this.value)){
					  this.setCustomValidity('');
					}
					else if (this.value.length==0){
					  this.setCustomValidity("Ist erforderlich!");
					}
					else {
					  this.setCustomValidity("Falsche Zeichenkette!");
					}	
				}, false);
			}
		);
	}

};

$(document).ready(function()
{
	yalst.init();
});
})(jQuery);