class curl {
	var $ch, $agent, $error, $info, $cookiefile, $savecookie;	
	function curl() {
		$this->agent = $this->get_agent(rand(0,44));
		$this->ch = curl_init();
		curl_setopt ($this->ch, CURLOPT_USERAGENT, $this->agent);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
//	curl_setopt ($this->ch, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt ($this->ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, 30);
		curl_setopt ($this->ch, CURLOPT_CONNECTTIMEOUT,30);
		}
	function http_code() {
    	return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
  	}
	function timeout($time){
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, $time);
		curl_setopt ($this->ch, CURLOPT_CONNECTTIMEOUT,$time);
	}
	function error() {
        return curl_error($this->ch);
    }
	function ssl($veryfyPeer, $verifyHost){
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, $veryfyPeer);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, $verifyHost);
    }
	function header($header) {
		curl_setopt ($this->ch, CURLOPT_HTTPHEADER, $header);
	}	
	function login($user, $pass) {
		curl_setopt ($this->ch, CURLOPT_USERPWD, "$user:$pass");
	}
	function saveImage($url) {
		$page 	=	$this->getPage($url);
		$path 	=	getcwd() . '/captcha.png';
		$fp 		= fopen($path, 'w');
		fwrite($fp, $page);
		fclose($fp);
	}
	function cookies($cookie_file_path) {
		$this->cookiefile = $cookie_file_path;;
		$fp = fopen($this->cookiefile,'wb');fclose($fp);
		curl_setopt ($this->ch, CURLOPT_COOKIEJAR, $this->cookiefile);
		curl_setopt ($this->ch, CURLOPT_COOKIEFILE, $this->cookiefile);
	}
	function ref($ref) {
		curl_setopt ($this->ch, CURLOPT_REFERER,$ref);
	}	
	function socks($sock) {
		curl_setopt ($this->ch, CURLOPT_HTTPPROXYTUNNEL, true); 
		curl_setopt ($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
		curl_setopt ($this->ch, CURLOPT_PROXY, $sock);
	}
	function post($url, $data) {
		curl_setopt($this->ch, CURLOPT_POST, 1);	
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		return $this->getPage($url);
	}
	function data($url, $data, $hasHeader=true, $hasBody=true) {
		curl_setopt ($this->ch, CURLOPT_POST, 1);
		curl_setopt ($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
		return $this->getPage($url, $hasHeader, $hasBody);
	}
	function get($url, $hasHeader=true, $hasBody=true) {
		curl_setopt ($this->ch, CURLOPT_POST, 0);
		return $this->getPage($url, $hasHeader, $hasBody);
	}	
	function getPage($url, $hasHeader=true, $hasBody=true) {
		curl_setopt($this->ch, CURLOPT_NOBODY, $hasBody ? 0 : 1);
		curl_setopt ($this->ch, CURLOPT_URL, $url);
		$data = curl_exec ($this->ch);
		$this->error = curl_error ($this->ch);
		$this->info = curl_getinfo ($this->ch);
		return $data;
	}	
	function close() {
		unlink($this->cookiefile);
		curl_close ($this->ch);
	}
	function get_agent($z){
		switch ($z){
			case 0:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.5 Mobile/15E148 Safari/604.1";	break;
			case 1:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-A526U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36";	break;
			case 2:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1)";	break;
			case 3:	$agent= "Mozilla/5.0 (Linux; Android 11; moto g power (2022)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Mobile Safari/537.36";	break;
			case 4:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 13_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.5 Mobile/15E148 Safari/604.1";	break;
			case 5:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-G991U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Mobile Safari/537.36";	break;
			case 6:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Mobile/15E148 Safari/604.1";	break;
			case 7:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 14_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Mobile/15E148 Safari/604.1";	break;
			case 8:	$agent= "Mozilla/5.0 (Linux; Android 11; moto g pure) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36";	break;
			case 9:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/103.0.5060.63 Mobile/15E148 Safari/604.1)";	break;
			case 10:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-G990U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Mobile Safari/537.36";	break;
			case 11:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-S908U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.88 Mobile Safari/537.36";	break;
			case 12:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1";	break;
			case 13:	$agent= "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.2 Safari/605.1.15";	break;
			case 14:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-S908U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36";	break;
			case 15:	$agent= "Mozilla/5.0 (Linux; Android 10; Nokia C5 Endi) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Mobile Safari/537.36";	break;
			case 16:	$agent= "Mozilla/5.0 (Linux; Android 10; SM-N960F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Mobile Safari/537.36";	break;
			case 17:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.3 Mobile/15E148 Safari/604.1";	break;
			case 18:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 15_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.3 Mobile/15E148 Safari/604.1";	break;
			case 19:	$agent= "Mozilla/5.0 (Linux; Android 11; EC211001 Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 Mobile Safari/537.36 [FB_IAB/Orca-Android;FBAV/372.0.0.10.112;]";	break;
			case 20:	$agent= "Mozilla/5.0 (Linux; Android 11; SM-A037U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36";	break;
			case 21:	$agent= "Mozilla/5.0 (Linux; Android 12; SM-G990U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Mobile Safari/537.36";	break;
			case 22:	$agent= "Mozilla/5.0 (Linux; Android 12) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 Mobile DuckDuckGo/5 Safari/537.36";	break;
			case 23:	$agent= "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36";	break;
			case 24:	$agent= "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.1 Safari/605.1.15";	break;
			case 25:	$agent= "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36";	break;
			case 26:	$agent= "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";	break;
			case 27:	$agent= "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8";	break;
			case 28:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1";	break;
			case 29:	$agent= "Mozilla/5.0 (Linux; Android 11; SM-A125U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36";	break;
			case 30:	$agent= "Mozilla/5.0 (iPhone; CPU iPhone OS 14_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Mobile/15E148 Safari/604.1";	break;
			case 31: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 32: $agent= "Mozilla/5.0 (Linux; U; Android 2.1-update1; ro-ro; U8300 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17";	break;
			case 33: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; ko-kr; SAMSUNG-SGH-I317 Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 34: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; en-us; SGH-T999 Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 35: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 540 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 36: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 920) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 37: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; Nexus 7 Build/KTU84P) AppleWebKit/537.36 (KHTML like Gecko) Chrome/36.0.1985.135 Safari/537.36";	break;
			case 38: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; W6S Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Safari/537.36";	break;
			case 39: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; de-ch; HTC Sensation Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 40: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; SC7 PRO HD Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36";	break;
			case 41: $agent= "Mozilla/5.0 (Linux; U; Android 3.0.1; fr-fr; A500 Build/HRI66) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13";	break;
			case 42: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 930) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 43: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; fi-fi; SM-G350 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 44: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 435) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 45: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 46: $agent= "Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19";	break;
			case 47: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; en-gb; SAMSUNG SM-T330 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.1500.94 Safari/537.36";	break;
			case 48: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; en-us; sdk Build/MR1) AppleWebKit/536.23 (KHTML, like Gecko) Version/4.3 Mobile Safari/536.23";	break;
			case 49: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 1320) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 50: $agent= "Mozilla/5.0 (Linux; Android 5.1; XT1025 Build/LPC23.13-34.5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.108 Mobile Safari/537.36";	break;
			case 51: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; SCH-I510 4G Build/FP8) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 52: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; MAXTAB Q8 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 53: $agent= "Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 730 Dual SIM) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Mobile Safari/537.36 Edge/12.10512";	break;
			case 54: $agent= "Mozilla/5.0 (Linux; U; Android 4.1; en-us; sdk Build/MR1) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Safari/534.30";	break;
			case 55: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.4; fi-fi; GT-I9305 Build/KTU84P) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 56: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.6; tr-tr; LG-E400 Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 MMS/LG-Android-MMS-V1.2";	break;
			case 57: $agent= "Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 5 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko; googleweblight) Chrome/38.0.1025.166 Mobile Safari/535.19";	break;
			case 58: $agent= "Mozilla/5.0 (Linux; Ubuntu 14.04 like Android 4.4) AppleWebKit/537.36 Chromium/35.0.1870.2 Mobile Safari/537.36";	break;
			case 59: $agent= "Opera/9.80 (Android; Opera Mini/7.5.33361/37.6334; U; en) Presto/2.12.423 Version/12.16";	break;
			case 60: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; LG-D802/V30d Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/34.0.1847.118 Mobile Safari/537.36";	break;
			case 61: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.3; en-us; KFSOWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 62: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; SM-T530NU Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Safari/537.36";	break;
			case 63: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; SAMSUNG SM-T530NU Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.2 Chrome/38.0.2125.102 Safari/537.36";	break;
			case 64: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 65: $agent= "Opera/9.80 (Android; Opera Mini/6.1.27762/26.1849; U; es) Presto/2.8.119 Version/10.54";	break;
			case 66: $agent= "Mozilla/5.0 (Android; Mobile; rv:35.0) Gecko/35.0 Firefox/35.0";	break;
			case 67: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.4; ru-ru; PAP5430 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 68: $agent= "Mozilla/5.0 (Linux; Android 5.0; SM-G900V Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 69: $agent= "Mozilla/5.0 (Android; Mobile; rv:40.0) Gecko/40.0 Firefox/40.0";	break;
			case 70: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.4; en-us; Sprint APA7373KT Build/GRJ22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 71: $agent= "Mozilla/5.0 (Linux; Android 4.1.2; GT-I9105P Build/JZO54K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19";	break;
			case 72: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; Z970 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36";	break;
			case 73: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; LGMS323 Build/KOT49I.MS32310c) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 74: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; en-us; SGH-T999L Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 75: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; en-us; Z730 Build/JLS36C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 76: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; Transformer TF101 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 77: $agent= "Mozilla/5.0 (Linux;U;Android 4.4;es-us;Philips S398 Build/JDQ39) AppleWebkit/534.30 (HTML,like Gecko) Version/4.0 Mobile Safari/534.30;";	break;
			case 78: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Moto G Build/LMY48G; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.90 Mobile Safari/537.36";	break;
			case 79: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; SAMSUNG-SM-N920A Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.4 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 80: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Moto G Build/LMY48G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Mobile Safari/537.36";	break;
			case 81: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG-SM-G870A Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 82: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; MBX reference board (g18ref) Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 83: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; SCH-I800 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 84: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; Lenovo B6000-HV Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36";	break;
			case 85: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; fr-fr; GT-P3113 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 86: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; LG-H443/H44311w Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 87: $agent= "Mozilla/5.0 (Android 5.1.1; Tablet; rv:41.0) Gecko/41.0 Firefox/41.0";	break;
			case 88: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; LGMS323 Build/KOT49I.MS32310c) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36";	break;
			case 89: $agent= "Mozilla/5.0 (Android 4.2.2;) AppleWebKit/1.1 Version/4.0 Mobile Safari/1.1";	break;
			case 90: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 635) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 91: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; XT1032 Build/LXB22.99-36; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.90 Mobile Safari/537.36";	break;
			case 92: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 93: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; SM-T217S Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 94: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; SM-G900F Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36";	break;
			case 95: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-gb; GT-N7100 Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 96: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36";	break;
			case 97: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-au; HTC_SensationXL_Beats_X315b Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 98: $agent= "Mozilla/5.0 (Linux; U; Android 2.0.1; en-us; Droid Build/ESD56) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17";	break;
			case 99: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.4; en-us; 2014817 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Mobile Safari/537.36 XiaoMi/MiuiBrowser/2.1.1";	break;
			case 100: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.2; en-us; Galaxy Nexus Build/ICL53F) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 101: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 430 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 102: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; KFTT Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 103: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; SPH-L900 Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 104: $agent= "Mozilla/5.0 (Linux; Android 4.1.2; C5215 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 105: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; NX505J Build/LMY48G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Mobile Safari/537.36";	break;
			case 106: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; verykool S354 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 107: $agent= "Mozilla/5.0 (Linux; Android 4.3; LT30p Build/9.2.A.1.199) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Mobile Safari/537.36";	break;
			case 108: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; Lenovo A606 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.92 Mobile Safari/537.36";	break;
			case 109: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; XT1068 Build/KXB21.85-24) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Mobile Safari/537.36";	break;
			case 110: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.4; nl-nl; SM-T533 Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Safari/537.16";	break;
			case 111: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.3; en-gb; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 112: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 640 XL Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 113: $agent= "Mozilla/5.0 (Linux; Android 4.3; LT30p Build/9.2.A.1.199) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 114: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; SM-A700FD Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36";	break;
			case 115: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; LGLS740 Build/KOT49I.LS740ZV5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 116: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 820) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 117: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; KFJWI Build/IMM76D) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 118: $agent= "Mozilla/5.0 (Linux; Android 4.1.2; Z796C Build/JZO54K) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.58 Mobile Safari/537.31";	break;
			case 119: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.6; en-gb; GT-S5830i Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 120: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 735) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 121: $agent= "Mozilla/5.0 (Linux; U; Android 4.1.1; en-au; GT-P5100 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 122: $agent= "Mozilla/5.0 (Linux; Android 5.1; LG-F500S Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.90 Mobile Safari/537.36 NAVER(inapp; search; 380; 6.3.3)";	break;
			case 123: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 925) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 124: $agent= "Mozilla/5.0 (Linux; Android 4.2.2; QMV7A Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Safari/537.36";	break;
			case 125: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 126: $agent= "Mozilla/5.0 (Android 4.2; rv:19.0) Gecko/20121129 Firefox/19.0";	break;
			case 127: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 1520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 128: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; GT-S5830 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 129: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-gb; GT-P5110 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 130: $agent= "Mozilla/5.0 (Linux; U; Android 2.1; en-us; sdk Build/ERD79) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17";	break;
			case 131: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; SAMSUNG SM-A500FU Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.2 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 132: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFTT Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Silk/2.1 Mobile Safari/535.19 Silk-Accelerated=true";	break;
			case 133: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; C6802 Build/14.5.A.0.270; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.36";	break;
			case 134: $agent= "Mozilla/5.0 (Linux; Android 5.1; LGLS991 Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 135: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 136: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 635; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 137: $agent= "Mozilla/5.0 (Linux; Android 4.0.3; Sony Tablet S Build/TISU0143) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Safari/537.36";	break;
			case 138: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; SAMSUNG SM-G925T Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.2 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 139: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; en-us; SAMSUNG SM-N900P Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.1500.94 Mobile Safari/537.36";	break;
			case 140: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; GT-N7100 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 141: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-gb; HTC_One_X Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 142: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 635; VIRGIN MOBILE) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 143: $agent= "Opera/9.80 (Android; Opera Mini/10.0.1884/37.6334; U; pl) Presto/2.12.423 Version/12.16";	break;
			case 144: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.1; en-us; ASUS Transformer Pad TF300T Build/JOP40D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 145: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; es-es; SP-6020 QUASAR Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30 MxBrowser/4.5.1.2000";	break;
			case 146: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; LGLS740 Build/KOT49I.LS740ZV5) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.1599.103 Mobile Safari/537.36";	break;
			case 147: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 4 Build/LMY48I) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 148: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; en-gb; SAMSUNG GT-I9195 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.1500.94 Mobile Safari/537.36";	break;
			case 149: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 640 LTE; Vodafone) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 150: $agent= "Mozilla/5.0 (Linux; U; Android 3.2; nl-nl; GT-P7510 Build/HTJ85B) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13";	break;
			case 151: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; SAMSUNG SM-N920T Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.4 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 152: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; A727 Build/JDQ39) AppleWebKit/534.24 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.24 T5/2.0 bdbrowser_i18n/4.0.0.4";	break;
			case 153: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.1; zh-cn; HUAWEI G700-U00 Build/HuaweiG700-U00) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 154: $agent= "Mozilla/5.0 (Linux; U; Android 4.0; en-us; GT-I9300 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 155: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; SCH-I535 Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 156: $agent= "Mozilla/5.0 (Linux; Android 5.0.2; LG-D802 Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.62 Mobile Safari/537.36";	break;
			case 157: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LMY48I) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 158: $agent= "Mozilla/5.0 (Linux; Android 4.2.2; Lenovo A850+ Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 159: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG SM-N900V 4G Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 160: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 7 Build/LMY48G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36";	break;
			case 161: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; BLU STUDIO 5.5 S Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 162: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; SAMSUNG GT-I9515 Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 163: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; KFTT Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 164: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG-SM-G900A Build/LRX21T; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.117 Mobile Safari/537.36";	break;
			case 165: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; Y88X Build/KVT49L) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Safari/537.36";	break;
			case 166: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; GT-P5100 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 167: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; D5803 Build/23.4.A.0.546) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 168: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG-SM-N900A Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 169: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; SM-T230 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36";	break;
			case 170: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; Parallels Virtual Platform Build/KVT49L) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36";	break;
			case 171: $agent= "Mozilla/5.0 (Linux; U; Android 4.1.1; en-ca; SGH-I747M Build/JRO03L) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 172: $agent= "Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 630) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Mobile Safari/537.36 Edge/12.10166";	break;
			case 173: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.3; en-us; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 174: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; VirtualBox Build/KTU84Q) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Safari/537.36";	break;
			case 175: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG SM-G900F Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 176: $agent= "Mozilla/5.0 (Linux; U; Android 4.3; es-es; MediaPad T1 8.0 Build/HuaweiMediaPad) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 177: $agent= "Mozilla/5.0 (Linux; U; Android 2.1-update1; en-us; SGH-T959 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17";	break;
			case 178: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; LGMS345 Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 179: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-ca; KFTT Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36";	break;
			case 180: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; SAMSUNG SM-N910G Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 181: $agent= "Mozilla/5.0 (Linux; Android 4.0.4; GT-S7562 Build/IMM76I) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.58 Mobile Safari/537.31";	break;
			case 182: $agent= "Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 640 XL LTE Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537";	break;
			case 183: $agent= "Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; Panasonic T21 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30 ACHEETAHI/2100501092";	break;
			case 184: $agent= "Mozilla/5.0 (Linux; U; Android 4.1.2; en-US; Panasonic T21 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.6.2.599 U3/0.8.0 Mobile Safari/534.30";	break;
			case 185: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-ca; SGH-I317M-parrot Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 186: $agent= "Mozilla/5.0 (Linux; Android 5.0; SM-G900T Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 187: $agent= "Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; LG-LG870 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 188: $agent= "Mozilla/5.0 (Linux; U; Android 4.0.3; en-us) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Mobile Safari/537.36";	break;
			case 189: $agent= "Mozilla/5.0 (Android; Tablet; rv:39.0) Gecko/39.0 Firefox/39.0";	break;
			case 190: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; SM-N910W8 Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 191: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; GT-P5210 Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 192: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; XT907 Build/KDA20.62-15.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.136 Mobile Safari/537.36";	break;
			case 193: $agent= "Mozilla/5.0 (Linux; U; Android 2.3.6; hu-hu; GT-S5830i Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 194: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; RealPad MA7BX2 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.135 Safari/537.36";	break;
			case 195: $agent= "Mozilla/5.0 (Android; Mobile; rv:29.0) Gecko/29.0 Firefox/39.0";	break;
			case 196: $agent= "Mozilla/5.0 (Android; Mobile; rv:29.0) Gecko/39.0 Firefox/39.0";	break;
			case 197: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.4; Nexus 5 Build/KTU84P) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 198: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.4; Nexus 5 Build/KTU84P) AppleWebkit/534.30 (KHTML, like Gecko) Version/5.0 Mobile Safari/534.30";	break;
			case 199: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; en-us; SAMSUNG-SM-T337A Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.1500.94 Safari/537.36";	break;
			case 200: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; LG-D850 Build/LRX21Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 201: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; en-us; SAMSUNG SGH-M919 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.1500.94 Mobile Safari/537.36";	break;
			case 202: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; SAMSUNG SM-N910H Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.0 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 203: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; SAMSUNG SM-N9200 Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.4 Chrome/38.0.2125.102 Mobile Safari/537.36";	break;
			case 204: $agent= "Mozilla/5.0 (Linux; U; Android 2.2; en-gb; GT-P1000 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 205: $agent= "Mozilla/5.0 (Linux; Android 5.0; ASUS_Z008D Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.93 Mobile Safari/537.36";	break;
			case 206: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48I) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 207: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; C6730 Build/KVT49L) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36";	break;
			case 208: $agent= "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 4 Build/LMY48I; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.117 Mobile Safari/537.36 MicroMessenger/6.2.4.51_rdf8da56.582 NetType/WIFI Language/es";	break;
			case 209: $agent= "Mozilla/5.0 (Linux; Android 4.1.2; Nokia_X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36 NokiaBrowser/1.2.0.12";	break;
			case 210: $agent= "Mozilla/5.0 (Linux; Android 5.0; SAMSUNG SM-G900H Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/2.1 Chrome/34.0.1847.76 Mobile Safari/537.36";	break;
			case 211: $agent= "Mozilla/5.0 (Linux; U; Android 2.2; en-us; DROID2 GLOBAL Build/S273) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1";	break;
			case 212: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; XT1022 Build/KXC21.5-40) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Mobile Safari/537.36";	break;
			case 213: $agent= "Mozilla/5.0 (Linux; Android 5.0.1; HTC_One_M8/4.19.161.2 Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36";	break;
			case 214: $agent= "Mozilla/5.0 (Linux; Android 4.4.4; SM-A700FD Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
			case 215: $agent= "Mozilla/5.0 (Windows Phone 10.0;  Android 4.2.1; Nokia; Lumia 520) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Mobile Safari/537.36 Edge/12.10130";	break;
			case 216: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.1; de-de; Galaxy Nexus Build/JOP40D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 217: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; da-dk; HTC_One_mini Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 218: $agent= "Mozilla/5.0 (Linux; Android 4.4.2; he-il; SAMSUNG SM-G900X Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.6 Chrome/28.0.1500.94 Mobile Safari/537.36";	break;
			case 219: $agent= "Mozilla/5.0 (Linux; U; Android 4.2.2; en-gb; GT-P3110 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30";	break;
			case 220: $agent= "Mozilla/5.0 (Linux; U; Android 4.4.2; zh-CN; SM705 Build/SANFRANCISCO) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";	break;
			case 221: $agent= "Mozilla/5.0 (Linux; Android 4.1.2; HTC Sensation Build/JRO03C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36";	break;
		}
		return $agent;
	}
}
function xflush() {
 
    static $output_handler = null;
 
    if ($output_handler === null) {
 
        $output_handler = @ini_get('output_handler');
 
    }
 
 
 
    if ($output_handler == 'ob_gzhandler') {
 
        return;
 
    }
 
 
 
    flush();
 
    if (function_exists('ob_flush') AND function_exists('ob_get_length') AND ob_get_length() !== false) {
 
        @ob_flush();
 
    } else if (function_exists('ob_end_flush') AND function_exists('ob_start') AND function_exists('ob_get_length') AND ob_get_length() !== FALSE) {
 
        @ob_end_flush();
 
        @ob_start();
 
    }
 
}

function inStr($s, $as){
$s = strtoupper($s);
if(!is_array($as)) $as=array($as);
for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
return false;
}
function getStr($string,$start,$end){
    $str = explode($start,$string);
    $str = explode($end,$str[1]);
    return $str[0];
}
function fetch_value($str,$find_start,$find_end) {
$start = @strpos($str,$find_start);
if ($start === false) {
return "";
}
$length = strlen($find_start);
$end    = strpos(substr($str,$start +$length),$find_end);
return trim(substr($str,$start +$length,$end));
}
