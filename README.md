# INAR-Google-ReCaptcha-CI
Personal Library for new Google ReCaptcha to test on CodeIgniter

To add to CodeIgniter just copy googlerecaptcha.php to the libaries folder and on the code:

  $this->load->library('googlerecaptcha'); // load library
	$this->googlerecaptcha->version(); //echos version
  $this->googlerecaptcha->my_site_key(); //returns site key
  $this->googlerecaptcha->verify_robot($_POST['g-recaptcha-response'],$_SERVER['REMOTE_ADDR']); //check robot - returns true or false
