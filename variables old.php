<?php
    include 'index.php';
  //  include 'p.php';
//    include 'dbService.php';
  
class Identification{

	private static function get_user_agent() {
		return  $_SERVER['HTTP_USER_AGENT'];
	}
  public function city(){
    require_once('geoplugin.class.php');
    $geoplugin = new geoPlugin();
    $geoplugin->locate();

    echo "Geolocation results for {$geoplugin->ip}: <br />\n".
        "City: {$geoplugin->city} <br />\n".
        "Region: {$geoplugin->region} <br />\n".
        "Area Code: {$geoplugin->areaCode} <br />\n".
        "DMA Code: {$geoplugin->dmaCode} <br />\n".
        "Country Name: {$geoplugin->countryName} <br />\n".
        "Country Code: {$geoplugin->countryCode} <br />\n".
        "Longitude: {$geoplugin->longitude} <br />\n".
        "Latitude: {$geoplugin->latitude} <br />\n".
    "Currency Code: {$geoplugin->currencyCode} <br />\n".
    "Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
    "Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
  }
  
	public  function get_ip() {
		$mainIp = '';
		if (getenv('HTTP_CLIENT_IP'))
			$mainIp = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$mainIp = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))		$mainIp = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$mainIp = getenv('REMOTE_ADDR');
		else{
      $mainIp = 'UNKNOWN';
  }
    return $mainIp;
  	}
	  
  public static function  get_device(){

	$tablet_browser = 0;
	$mobile_browser = 0;

	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}

	$mobile_ua = strtolower(substr(self:: get_user_agent(), 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}

	if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
		$mobile_browser++;
			//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
			$tablet_browser++;
		}
	}

	if ($tablet_browser > 0) {
		   // do something for tablet devices
		return 'Tablet';
	}
	else if ($mobile_browser > 0) {
		   // do something for mobile devices
		return 'Mobile';
	}
	else {
		   // do something for everything else
		return 'Computer';
		echo 'we';
	}   
}
}
$get = new Identification;
$insert = "INSERT INTO `howmeny`(`id`, `address`) VALUES (null,$mainIp)";
mysql_query($insert);
