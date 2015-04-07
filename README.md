# INAR-Google-ReCaptcha-CI
Personal Library for new Google ReCaptcha to test on CodeIgniter

To add to CodeIgniter just copy googlerecaptcha.php to the libaries folder and on the code:

// load library

$this->load->library('googlerecaptcha'); 


//echos version

$this->googlerecaptcha->version(); 


//returns site key

$this->googlerecaptcha->my_site_key(); 


//check robot - returns true or false

$this->googlerecaptcha->verify_robot($_POST['g-recaptcha-response'],$_SERVER['REMOTE_ADDR']); 
