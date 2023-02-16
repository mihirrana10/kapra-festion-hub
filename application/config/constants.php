<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);


// $config['encryption_key'] = '026914-69125-034179-72360-345729';


// define('STRIPE_KEY','pk_test_51Lrx5cSF4QyU8JXwef78yn4JXjESleNFcHTcIHPUwlcsAyNNHwAs6C4eDUzMROiHlgxLfqcUZRhuJLK4hssmVj6D00zMpAWPPp');
// define('STRIPE_SECRET','sk_test_51Lrx5cSF4QyU8JXwdH3ophf9iKqoKrYibQHgOEL6Et85To5W2cOwn8uBo187cotHWIV6kuzOrDongnCmjMGlmSnb00YGBO8gSG');

define('RAZOR_KEY_ID', 'rzp_test_WKHV9byNfOPggx');
define('RAZOR_KEY_SECRET', 'W92yExljyDAnpTYAE7B9hk8I');

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */