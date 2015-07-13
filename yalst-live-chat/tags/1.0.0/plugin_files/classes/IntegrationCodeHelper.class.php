<?php

require_once('yalstHelper.class.php');

class IntegrationCodeHelper extends yalstHelper
{
	public function render()
	{
		switch (get_option("tabIndex", 0))
		{
			case 0:
				return "";
			case 1:
				return get_option("yalstReiterIntegrationInput", '<!-- yalstReiterIntegrationInput not in wp db! -->');
			case 2:
				return get_option("yalstReiterWidgetIntegrationInput", '<!-- yalstReiterWidgetIntegrationInput not in wp db! -->');
			case 3:
				return "";
		}
	}
}