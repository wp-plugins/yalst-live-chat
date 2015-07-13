<?php

require_once('yalstGeneral.class.php');

final class yalstAdmin extends yalstGeneral
{
	/* Version des Plugins  */
	protected $plugin_version = null;

	/* Plugin starten */
	
	protected function __construct()
	{
		parent::__construct();

		add_action('init', array($this, 'load_scripts'));
		add_action('admin_menu', array($this, 'admin_menu'));
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->update_options($_POST);
		}
	}

	public static function get_instance()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/* Ausgabe der Version des Plugins */
	
	public function get_plugin_version()
	{
		if (is_null($this->plugin_version))
		{
			if (!function_exists('get_plugins'))
			{
				require_once(ABSPATH.'wp-admin/includes/plugin.php');
			}

			$plugin_folder = get_plugins('/'.plugin_basename(dirname(__FILE__).'/..'));
			$this->plugin_version = $plugin_folder['wp-yalst-live-chat-software.php']['Version'];
		}

		return $this->plugin_version;
	}
	
	/* Laden des Javascriptes und des CSS-Skriptes */

	public function load_scripts()
	{
		wp_enqueue_script('yalst', $this->get_plugin_url().'/js/yalstPlugin.js', 'jquery', $this->get_plugin_version(), true);
		wp_enqueue_style('yalst', $this->get_plugin_url().'/css/yalstPlugin.css', false, $this->get_plugin_version());
	}
	
	/* Menü mit Registration und Integration als Unterpunkten */

	public function admin_menu()
	{
		add_menu_page(
			'yalst Live Chat',
			'Yalst',
			'administrator',
			'yalst',
			array($this, 'yalst_settings_page'),
			$this->get_plugin_url().'/images/favicon.png'
		);

		add_submenu_page(
			'yalst',
			'Registration',
			__('Registration', 'yalst_text'),
			'administrator',
			'yalst_registration',
			array($this, 'yalst_registration_page')
		);
		
		add_submenu_page(
			'yalst',
			'Integration',
			__('Integration', 'yalst_text'),
			'administrator',
			'yalst_integration',
			array($this, 'yalst_integration_page')
		);

		/* Entfernung des automatischen Untermenüs */
		if (function_exists('remove_submenu_page'))
		{
			remove_submenu_page('yalst', 'yalst');			
		}

		/* Registration- und Integration-Link zur Plugins-Page hinzufügen */
		add_filter('plugin_action_links', array($this, 'yalst_plugin_links'), 10, 2);		

	}

	/* Anzeige der Registrationseite */
	
	public function yalst_registration_page()
	{
		$this->get_helper('Registration');
	}
	
	/* Anzeige der Integrationsseite */
	
	public function yalst_integration_page()
	{
		$this->get_helper('Integration');
	}


	/* Registration- und Integration-Link zur Plugins-Page hinzufügen */

	public function yalst_plugin_links($links, $file)
	{
		if (basename($file) !== 'wp-yalst-live-chat-software.php')
		{
			return $links;
		}

		$registration_link = sprintf('<a href="admin.php?page=yalst_registration">%s</a>', __('Registration', 'yalst_text'));
		$integration_link = sprintf('<a href="admin.php?page=yalst_integration">%s</a>', __('Integration', 'yalst_text'));
		
		array_unshift ($links, $integration_link);
		array_unshift ($links, $registration_link);
		
		return $links;
	}
	
	/* Hinzufügen des Reiters, wenn keiner im gespeicherten Einbindungscode vorhanden */
	
	private function addReiterIfNecessary ($code)
	{
		if (preg_match('/\bscript\.src\s*=\s*.+\.php.+(?<site_entry>site=\d+-\d+).+(?<tab_entry>tab=.+?(?:\\x26|\&|$))/im', $code) === 1)
		{
		    return $code;
		}
		
		return preg_replace('/(\bscript\.src\s*=\s*.+\.php.+)(site=\d+-\d+)/im', '\1\2\\x26tab=bottom_right_30px', $code);
	}

	/* Speichern der beiden Einbindungscodes und der gewählten Tabauswahl */
	
	protected function update_options($data)
	{
	
		if (isset($data['yalstDeactiveIntegration']) || isset($data['yalstReiterIntegration']) || isset($data['yalstReiterWidgetIntegration']) || isset($data['yalstWidgetIntegration']))
		{			
			$tabIndex = isset($data['tabIndex']) ? $data['tabIndex'] : "0";			

			if (isset($data['yalstReiterIntegration']))
			{
				$yalstReiterIntegrationInputCleaned = ini_get('magic_quotes_gpc')
					? stripslashes ($data['yalstReiterIntegrationInput'])
					: $data['yalstReiterIntegrationInput'];
				
				$yalstReiterIntegrationInput = $this->addReiterIfNecessary($yalstReiterIntegrationInputCleaned);
		
				update_option('yalstReiterIntegrationInput', $yalstReiterIntegrationInput);
				
				update_option('isAddedReiter', strcmp($yalstReiterIntegrationInput, $yalstReiterIntegrationInputCleaned) );
			}
			else if (isset($data['yalstReiterWidgetIntegration']))
			{
				$yalstReiterWidgetIntegrationInputCleaned = ini_get('magic_quotes_gpc')
					? stripslashes ($data['yalstReiterWidgetIntegrationInput'])
					: $data['yalstReiterWidgetIntegrationInput'];
				
				$yalstReiterWidgetIntegrationInput = $this->addReiterIfNecessary($yalstReiterWidgetIntegrationInputCleaned);
				
				update_option('yalstReiterWidgetIntegrationInput', $yalstReiterWidgetIntegrationInput);
				
				update_option('isAddedReiterWidget', strcmp($yalstReiterWidgetIntegrationInput, $yalstReiterWidgetIntegrationInputCleaned) );
			}
			update_option('tabIndex', $tabIndex);
				
			
		}

	}
}