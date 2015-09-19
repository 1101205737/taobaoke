<?php
require_once(dirname(__FILE__) . '/../AndroidNotification.php');

class AndroidUnicast extends AndroidNotification {
	protected $appkey           = array('53ffe6e8fd98c5028b02a65f','5405a25ffd98c5be9805335e');
	protected $masterSecret     = array('ch23rqksfk8hfggp8oapv8h6hxmn5zi3','2zqlng7i5wyewcqteroe1ssbr0h5q21t');
	protected $timestamp        = NULL;
	protected $validation_token = NULL;

	
	function __construct($ticker,$title,$text,$device_tokens,$type=0,$param=''){
		parent::__construct();
		$this->timestamp = strval(time());
		$this->validation_token = md5(strtolower($this->appkey[$type]) . strtolower($this->masterSecret[$type]) . strtolower($this->timestamp));
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
		$this->setPredefinedKeyValue("appkey",           $this->appkey[$type]);
		$this->setPredefinedKeyValue("timestamp",        $this->timestamp);
		$this->setPredefinedKeyValue("validation_token", $this->validation_token);
		$this->setPredefinedKeyValue("device_tokens",    $device_tokens);
		$this->setPredefinedKeyValue("ticker",           $ticker);
		$this->setPredefinedKeyValue("title",            $title);
		$this->setPredefinedKeyValue("text",             $text);
		$this->setPredefinedKeyValue("after_open",       "go_custom");
		$this->setPredefinedKeyValue("custom",       	 $param);
		$this->setPredefinedKeyValue("production_mode", "true");
	}
}