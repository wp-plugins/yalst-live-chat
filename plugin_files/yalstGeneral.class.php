<?php

class yalstGeneral
{
	protected static $instance;

	/* Absoluter Pfad zum Plugin  */
	protected $plugin_url = null;

	/* Integrationscode an den Footer hängen  */
	
	protected function __construct()
	{
		add_action ('wp_footer', array($this, 'integration_code'));		
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

	/* Ausgabe des absoluen Pfades des Plugins */
	
	public function get_plugin_url()
	{
		if (is_null($this->plugin_url))
		{
			$this->plugin_url = WP_PLUGIN_URL.'/wp-yalst-live-chat-software/plugin_files';
		}

		return $this->plugin_url;
	}

	/*  Ausgabe des Tab Codes */
	 
	public function integration_code()
	{
		$this->get_helper('IntegrationCode');
	}

	/* Ausgabe der Helper Klassen */
	
	public static function get_helper($class, $echo=true)
	{
		$class .= 'Helper';

		if (class_exists($class) == false)
		{
			$path = dirname(__FILE__).'/classes/'.$class.'.class.php';
			if (file_exists($path) !== true)
			{
				echo "File not found";
				return false;
			}

			require_once($path);
		}

		$c = new $class;
		
		if ($echo)
		{
			echo $c->render();
			return true;
		}
		else
		{
			return $c->render();
		}
	}
}