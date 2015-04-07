<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * INAR - Google ReCaptcha
 *
 * Apply Google ReCaptcha to your codeigniter apps
 * Secret Key - Get it at https://www.google.com/recaptcha/admin
 * Add to form: <div class="g-recaptcha" data-sitekey="CHANGE THIS WITH YOUR SITE KEY FROM URL ABOVE"></div>
 * Some code copied from https://github.com/google/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package		GoogleReCaptcha
 * @author		Eskiso
 */

class GoogleReCaptcha {

	var $CI;
	var $secret_key = 'CHANGE THIS WITH YOUR SECRET KEY FROM URL ABOVE';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->CI =& get_instance(); //for no reason...
	}

	/**
	 * Gets $_POST['g-recaptcha-response'] and checks if it is confirmed on google recaptcha
	 * @param  string - $_POST['g-recaptcha-response']
	 * @param string - a simple $_SERVER['REMOTE_ADDR'] will do
	 * @return bool - True if success.
	 */
	public function verify_robot($response = NULL, $remoteIP = NULL) {
		
		if(is_null($response)) {
			return false;
		}
		$params = array('secret' => $this->$secret_key, 'response' => $response);
	        if (!is_null($remoteIP)) {
	            $params['remoteip'] = $remoteIP;
	        }
		$params['version'] = 'php_1.1.1';
		$content = http_build_query($params);
		$peer_key = version_compare(PHP_VERSION, '5.6.0', '<') ? 'CN_name' : 'peer_name';
	        $options = array(
	            'http' => array(
	                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
	                'method' => 'POST',
	                'content' => $content,
	                'verify_peer' => true,
	                $peer_key => 'www.google.com',
	            ),
	        );
	        $context = stream_context_create($options);
	        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	        $responseData = json_decode($result, true);
	        if (isset($responseData['success']) && $responseData['success'] === true) {
	        	return true;
	        }
	        else {
	        	return false;
	        }
   
	}
}
