<?php
class Securimage
{
	const SI_IMAGE_JPEG = 1;
	const SI_IMAGE_PNG = 2;
	const SI_IMAGE_GIF = 3;
	const SI_CAPTCHA_STRING = 0;
	const SI_CAPTCHA_MATHEMATIC = 1;
	const SI_CAPTCHA_WORDS = 2;
	const SI_DRIVER_MYSQL = 'mysql';
	const SI_DRIVER_PGSQL = 'pgsql';
	const SI_DRIVER_SQLITE3 = 'sqlite';
	public $image_width = 150;
	public $image_height = 30;
	public $font_ratio = 0.6;
	public $image_type = self::SI_IMAGE_PNG;
	public $image_bg_color = '#000000';
	public $text_color = '#ffffff';
	public $line_color = '#ffffff';
	public $noise_color = '#dddddd';
	public $text_transparency_percentage = 0;
	public $use_transparent_text = false;
	public $code_length = 5;
	public $case_sensitive = false;
	public $charset = 'ABCDGHKLMNPRTWYZbcdghkprstwyz2346789';
	public $expiry_time = 900;
	public $session_name = null;
	public $perturbation = 0.9;
	public $num_lines = 0;
	public $noise_level = 1;
	public $image_signature = '';
	public $signature_color = '#707070';
	public $signature_font;
	public $use_sqlite_db = false;
	public $skip_table_check = false;
	public $captcha_type = self::SI_CAPTCHA_STRING; // or self::SI_CAPTCHA_MATHEMATIC, or self::SI_CAPTCHA_WORDS;
	public $namespace;
	public $ttf_file;
	public $securimage_path = null;
	public $display_value;
	protected static $_captchaId = null;
	protected $im;
	protected $tmpimg;
	protected $bgimg;
	protected $iscale = 5;
	protected $code;
	protected $code_display;
	protected $captcha_code;
	protected $_timeToSolve = 0;
	protected $no_exit;
	protected $no_session;
	protected $send_headers;
	protected $pdo_conn;
	protected $gdbgcolor;
	protected $gdtextcolor;
	protected $gdlinecolor;
	protected $gdsignaturecolor;
	/**
	* Create a new securimage object, pass options to set in the constructor.
	*
	* The object can then be used to display a captcha, play an audible captcha, or validate a submission.
	*
	* @param array $options Options to initialize the class. May be any class property.
	*
	* $options = array(
	* 'text_color' => new Securimage_Color('#013020'),
	* 'code_length' => 5,
	* 'num_lines' => 5,
	* 'noise_level' => 3,
	* 'font_file' => Securimage::getPath() . '/custom.ttf'
	* );
	*
	* $img = new Securimage($options);
	*
	*/
	public function __construct($options = array())
	{
		$this->securimage_path = dirname(__FILE__);
		if (is_array($options) && sizeof($options) > 0) {
			foreach($options as $prop => $val) {
				if ($prop == 'captchaId') {
					Securimage::$_captchaId = $val;
				} else {
					$this->$prop = $val;
				}
			}
		}
		$this->image_bg_color = $this->initColor($this->image_bg_color, '#ffffff');
		$this->text_color = $this->initColor($this->text_color, '#616161');
		$this->line_color = $this->initColor($this->line_color, '#616161');
		$this->noise_color = $this->initColor($this->noise_color, '#616161');
		$this->signature_color = $this->initColor($this->signature_color, '#616161');
		if (is_null($this->ttf_file)) {
			$this->ttf_file = $this->securimage_path . '/AHGBold.ttf';
		}
		$this->signature_font = $this->ttf_file;
		if (is_null($this->code_length) || (int)$this->code_length < 1) {
			$this->code_length = 6;
		}
		if (is_null($this->perturbation) || !is_numeric($this->perturbation)) {
			$this->perturbation = 0.75;
		}
		if (is_null($this->namespace) || !is_string($this->namespace)) {
			$this->namespace = 'default';
		}
		if (is_null($this->no_exit)) {
			$this->no_exit = false;
		}
		if (is_null($this->no_session)) {
			$this->no_session = false;
		}
		if (is_null($this->send_headers)) {
			$this->send_headers = true;
		}
		if ($this->no_session != true) {
			// Initialize session or attach to existing
			if ( session_id() == '' || (function_exists('session_status') && PHP_SESSION_NONE == session_status()) ) { // no session has been started yet (or it was previousy closed), which is needed for validation
				if (!is_null($this->session_name) && trim($this->session_name) != '') {
					session_name(trim($this->session_name)); // set session name if provided
				}
				require('../private/includes/params.php');
				session_name(md5($_SERVER['HTTP_USER_AGENT'].$uniqueKey));
				session_cache_expire(60);
				session_start();
			}
		}
	}
	/**
	* Return the absolute path to the Securimage directory.
	*
	* @return string The path to the securimage base directory
	*/
	public static function getPath()
	{
		return dirname(__FILE__);
	}
	/**
	* Generate a new captcha ID or retrieve the current ID (if exists).
	*
	* @param bool $new If true, generates a new challenge and returns and ID. If false, the existing captcha ID is returned, or null if none exists.
	* @param array $options Additional options to be passed to Securimage.
	*
	* @return null|string Returns null if no captcha id set and new was false, or the captcha ID
	*/
	public static function getCaptchaId($new = true)
	{
		return Securimage::$_captchaId;
	}
	/**
	* Generates a new challenge and serves a captcha image.
	*
	* Appropriate headers will be sent to the browser unless the *send_headers* option is false.
	*
	* @param string $background_image The absolute or relative path to the background image to use as the background of the captcha image.
	*
	* $img = new Securimage();
	* $img->code_length = 6;
	* $img->num_lines = 5;
	* $img->noise_level = 5;
	*
	* $img->show(); // sends the image and appropriate headers to browser
	* exit;
	*/
	public function show($background_image = '')
	{
		set_error_handler(array(&$this, 'errorHandler'));
		if($background_image != '' && is_readable($background_image)) {
			$this->bgimg = $background_image;
		}
		$this->doImage();
	}
	/**
	* Checks a given code against the correct value from the session.
	*
	* @param string $code The captcha code to check
	*
	* $code = $_POST['code'];
	* $img = new Securimage();
	* if ($img->check($code) == true) {
	* $captcha_valid = true;
	* } else {
	* $captcha_valid = false;
	* }
	*
	* @return bool true if the given code was correct, false if not.
	*/
	public function check($code)
	{
		$this->code_entered = $code;
		$this->validate();
		return $this->correct_code;
	}
	/**
	* Set the namespace for the captcha being stored in the session.
	*
	* Namespaces are useful when multiple captchas need to be displayed on a single page.
	*
	* @param string $namespace Namespace value, String consisting of characters "a-zA-Z0-9_-"
	*/
	public function setNamespace($namespace)
	{
		$namespace = preg_replace('/[^a-z0-9-_]/i', '', $namespace);
		$namespace = substr($namespace, 0, 64);
		if (!empty($namespace)) {
			$this->namespace = $namespace;
		} else {
			$this->namespace = 'default';
		}
	}
	/**
	* Return the code from the session. If none exists or was found, an empty string is returned.
	*
	* @param bool $array true to receive an array containing the code and properties, false to receive just the code.
	* @param bool $returnExisting If true, and the class property *code* is set, it will be returned instead of getting the code from the session.
	* @return array|string Return is an array if $array = true, otherwise a string containing the code
	*/
	public function getCode($array = false, $returnExisting = false)
	{
		$code = array();
		$time = 0;
		$disp = 'error';
		if ($returnExisting && strlen($this->code) > 0) {
			if ($array) {
				return array(
				'code' => $this->code,
				'display' => $this->code_display,
				'code_display' => $this->code_display,
				'time' => 0);
			} else {
				return $this->code;
			}
		}
		if ($this->no_session != true) {
			if (isset($_SESSION['securimage_code_value'][$this->namespace]) &&
			trim($_SESSION['securimage_code_value'][$this->namespace]) != '') {
				if ($this->isCodeExpired(
				$_SESSION['securimage_code_ctime'][$this->namespace]) == false) {
					$code['code'] = $_SESSION['securimage_code_value'][$this->namespace];
					$code['time'] = $_SESSION['securimage_code_ctime'][$this->namespace];
					$code['display'] = $_SESSION['securimage_code_disp'] [$this->namespace];
				}
			}
		}
		if ($array == true) {
			return $code;
		} else {
			return $code['code'];
		}
	}
	/**
	* The main image drawing routing, responsible for constructing the entire image and serving it
	*/
	protected function doImage()
	{
		if( ($this->use_transparent_text == true || $this->bgimg != '') && function_exists('imagecreatetruecolor')) {
			$imagecreate = 'imagecreatetruecolor';
		} else {
			$imagecreate = 'imagecreate';
		}
		$this->im = $imagecreate($this->image_width, $this->image_height);
		$this->tmpimg = $imagecreate($this->image_width * $this->iscale, $this->image_height * $this->iscale);
		$this->allocateColors();
		imagepalettecopy($this->tmpimg, $this->im);
		$code = '';
		if ($this->getCaptchaId(false) !== null) {
			// a captcha Id was supplied
			// check to see if a display_value for the captcha image was set
			if (is_string($this->display_value) && strlen($this->display_value) > 0) {
				$this->code_display = $this->display_value;
				$this->code = ($this->case_sensitive) ?
				$this->display_value :
				strtolower($this->display_value);
				$code = $this->code;
			}
		}
		if ($code == '') {
			$this->createCode();
		}
		if ($this->noise_level > 0) {
			$this->drawNoise();
		}
		$this->drawWord();
		if ($this->perturbation > 0 && is_readable($this->ttf_file)) {
			$this->distortedCopy();
		}
		if ($this->num_lines > 0) {
			$this->drawLines();
		}
		if (trim($this->image_signature) != '') {
			$this->addSignature();
		}
		$this->output();
	}
	/**
	* Allocate the colors to be used for the image
	*/
	protected function allocateColors()
	{
		// allocate bg color first for imagecreate
		$this->gdbgcolor = imagecolorallocate($this->im,
		$this->image_bg_color->r,
		$this->image_bg_color->g,
		$this->image_bg_color->b);
		$alpha = intval($this->text_transparency_percentage / 100 * 127);
		if ($this->use_transparent_text == true) {
			$this->gdtextcolor = imagecolorallocatealpha($this->im,
			$this->text_color->r,
			$this->text_color->g,
			$this->text_color->b,
			$alpha);
			$this->gdlinecolor = imagecolorallocatealpha($this->im,
			$this->line_color->r,
			$this->line_color->g,
			$this->line_color->b,
			$alpha);
			$this->gdnoisecolor = imagecolorallocatealpha($this->im,
			$this->noise_color->r,
			$this->noise_color->g,
			$this->noise_color->b,
			$alpha);
		} else {
			$this->gdtextcolor = imagecolorallocate($this->im,
			$this->text_color->r,
			$this->text_color->g,
			$this->text_color->b);
			$this->gdlinecolor = imagecolorallocate($this->im,
			$this->line_color->r,
			$this->line_color->g,
			$this->line_color->b);
			$this->gdnoisecolor = imagecolorallocate($this->im,
			$this->noise_color->r,
			$this->noise_color->g,
			$this->noise_color->b);
		}
		$this->gdsignaturecolor = imagecolorallocate($this->im,
		$this->signature_color->r,
		$this->signature_color->g,
		$this->signature_color->b);
	}
	/**
	* This method generates a new captcha code.
	*
	* Generates a random captcha code based on *charset*, math problem, or captcha from the wordlist and saves the value to the session.
	*/
	public function createCode()
	{
		$this->code = false;
		switch($this->captcha_type) {
			case self::SI_CAPTCHA_MATHEMATIC:
			{
				do {
					$signs = array('+', '-', 'x');
					$left = mt_rand(1, 10);
					$right = mt_rand(1, 5);
					$sign = $signs[mt_rand(0, 2)];
					switch($sign) {
						case 'x': $c = $left * $right; break;
						case '-': $c = $left - $right; break;
						default: $c = $left + $right; break;
					}
				} while ($c <= 0); // no negative #'s or 0
				$this->code = $c;
				$this->code_display = "$left $sign $right";
				break;
			}
			default:
			{
				if ($this->code == false) {
					$this->code = $this->generateCode($this->code_length);
				}
				$this->code_display = $this->code;
				$this->code = ($this->case_sensitive) ? $this->code : strtolower($this->code);
			}
		}
		$this->saveData();
	}
	/**
	* Draws the captcha code on the image
	*/
	protected function drawWord()
	{
		$width2 = $this->image_width * $this->iscale;
		$height2 = $this->image_height * $this->iscale;
		$ratio = ($this->font_ratio) ? $this->font_ratio : 0.4;
		if ((float)$ratio < 0.1 || (float)$ratio >= 1) {
			$ratio = 0.4;
		}
		if (!is_readable($this->ttf_file)) {
			imagestring($this->im, 4, 10, ($this->image_height / 2) - 5, 'Failed to load TTF font file!', $this->gdtextcolor);
		} else {
			if ($this->perturbation > 0) {
				$font_size = $height2 * $ratio;
				$bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
				$tx = $bb[4] - $bb[0];
				$ty = $bb[5] - $bb[1];
				$x = floor($width2 / 2 - $tx / 2 - $bb[0]);
				$y = round($height2 / 2 - $ty / 2 - $bb[1]);
				imagettftext($this->tmpimg, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
			} else {
				$font_size = $this->image_height * $ratio;
				$bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
				$tx = $bb[4] - $bb[0];
				$ty = $bb[5] - $bb[1];
				$x = floor($this->image_width / 2 - $tx / 2 - $bb[0]);
				$y = round($this->image_height / 2 - $ty / 2 - $bb[1]);
				imagettftext($this->im, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
			}
		}
		// DEBUG
		//$this->im = $this->tmpimg;
		//$this->output();
	}
	/**
	* Copies the captcha image to the final image with distortion applied
	*/
	protected function distortedCopy()
	{
		$numpoles = 3; // distortion factor
		// make array of poles AKA attractor points
		for ($i = 0; $i < $numpoles; ++ $i) {
			$px[$i] = mt_rand($this->image_width * 0.2, $this->image_width * 0.8);
			$py[$i] = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
			$rad[$i] = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
			$tmp = ((- $this->frand()) * 0.15) - .15;
			$amp[$i] = $this->perturbation * $tmp;
		}
		$bgCol = imagecolorat($this->tmpimg, 0, 0);
		$width2 = $this->iscale * $this->image_width;
		$height2 = $this->iscale * $this->image_height;
		imagepalettecopy($this->im, $this->tmpimg); // copy palette to final image so text colors come across
		// loop over $img pixels, take pixels from $tmpimg with distortion field
		for ($ix = 0; $ix < $this->image_width; ++ $ix) {
			for ($iy = 0; $iy < $this->image_height; ++ $iy) {
				$x = $ix;
				$y = $iy;
				for ($i = 0; $i < $numpoles; ++ $i) {
					$dx = $ix - $px[$i];
					$dy = $iy - $py[$i];
					if ($dx == 0 && $dy == 0) {
						continue;
					}
					$r = sqrt($dx * $dx + $dy * $dy);
					if ($r > $rad[$i]) {
						continue;
					}
					$rscale = $amp[$i] * sin(3.14 * $r / $rad[$i]);
					$x += $dx * $rscale;
					$y += $dy * $rscale;
				}
				$c = $bgCol;
				$x *= $this->iscale;
				$y *= $this->iscale;
				if ($x >= 0 && $x < $width2 && $y >= 0 && $y < $height2) {
					$c = imagecolorat($this->tmpimg, $x, $y);
				}
				if ($c != $bgCol) { // only copy pixels of letters to preserve any background image
					imagesetpixel($this->im, $ix, $iy, $c);
				}
			}
		}
	}
	/**
	* Draws distorted lines on the image
	*/
	protected function drawLines()
	{
		for ($line = 0; $line < $this->num_lines; ++ $line) {
			$x = $this->image_width * (1 + $line) / ($this->num_lines + 1);
			$x += (0.5 - $this->frand()) * $this->image_width / $this->num_lines;
			$y = mt_rand($this->image_height * 0.1, $this->image_height * 0.9);
			$theta = ($this->frand() - 0.5) * M_PI * 0.7;
			$w = $this->image_width;
			$len = mt_rand($w * 0.4, $w * 0.7);
			$lwid = mt_rand(0, 2);
			$k = $this->frand() * 0.6 + 0.2;
			$k = $k * $k * 0.5;
			$phi = $this->frand() * 6.28;
			$step = 0.5;
			$dx = $step * cos($theta);
			$dy = $step * sin($theta);
			$n = $len / $step;
			$amp = 1.5 * $this->frand() / ($k + 5.0 / $len);
			$x0 = $x - 0.5 * $len * cos($theta);
			$y0 = $y - 0.5 * $len * sin($theta);
			$ldx = round(- $dy * $lwid);
			$ldy = round($dx * $lwid);
			for ($i = 0; $i < $n; ++ $i) {
				$x = $x0 + $i * $dx + $amp * $dy * sin($k * $i * $step + $phi);
				$y = $y0 + $i * $dy - $amp * $dx * sin($k * $i * $step + $phi);
				imagefilledrectangle($this->im, $x, $y, $x + $lwid, $y + $lwid, $this->gdlinecolor);
			}
		}
	}
	/**
	* Draws random noise on the image
	*/
	protected function drawNoise()
	{
		if ($this->noise_level > 10) {
			$noise_level = 10;
		} else {
			$noise_level = $this->noise_level;
		}
		$t0 = microtime(true);
		$noise_level *= 125; // an arbitrary number that works well on a 1-10 scale
		$points = $this->image_width * $this->image_height * $this->iscale;
		$height = $this->image_height * $this->iscale;
		$width = $this->image_width * $this->iscale;
		for ($i = 0; $i < $noise_level; ++$i) {
			$x = mt_rand(10, $width);
			$y = mt_rand(10, $height);
			$size = mt_rand(7, 10);
			if ($x - $size <= 0 && $y - $size <= 0) continue; // dont cover 0,0 since it is used by imagedistortedcopy
			imagefilledarc($this->tmpimg, $x, $y, $size, $size, 0, 360, $this->gdnoisecolor, IMG_ARC_PIE);
		}
		$t1 = microtime(true);
		$t = $t1 - $t0;
		/*
		// DEBUG
		imagestring($this->tmpimg, 5, 25, 30, "$t", $this->gdnoisecolor);
		header('content-type: image/png');
		imagepng($this->tmpimg);
		exit;
		*/
	}
	/**
	* Print signature text on image
	*/
	protected function addSignature()
	{
		$bbox = imagettfbbox(10, 0, $this->signature_font, $this->image_signature);
		$textlen = $bbox[2] - $bbox[0];
		$x = $this->image_width - $textlen - 5;
		$y = $this->image_height - 3;
		imagettftext($this->im, 10, 0, $x, $y, $this->gdsignaturecolor, $this->signature_font, $this->image_signature);
	}
	/**
	* Sends the appropriate image and cache headers and outputs image to the browser
	*/
	protected function output()
	{
		if ($this->canSendHeaders() || $this->send_headers == false) {
			if ($this->send_headers) {
				// only send the content-type headers if no headers have been output
				// this will ease debugging on misconfigured servers where warnings
				// may have been output which break the image and prevent easily viewing
				// source to see the error.
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
			}
			switch ($this->image_type) {
				case self::SI_IMAGE_JPEG:
				if ($this->send_headers) header("Content-Type: image/jpeg");
				imagejpeg($this->im, null, 90);
				break;
				case self::SI_IMAGE_GIF:
				if ($this->send_headers) header("Content-Type: image/gif");
				imagegif($this->im);
				break;
				default:
				if ($this->send_headers) header("Content-Type: image/png");
				imagepng($this->im);
				break;
			}
		} else {
			echo '<hr /><strong>'
			.'Failed to generate captcha image, content has already been '
			.'output.<br />This is most likely due to misconfiguration or '
			.'a PHP error was sent to the browser.</strong>';
		}
		imagedestroy($this->im);
		restore_error_handler();
		if (!$this->no_exit) exit;
	}
	/**
	* Generates a random captcha code from the set character set
	*
	* @see Securimage::$charset Charset option
	* @return string A randomly generated CAPTCHA code
	*/
	protected function generateCode()
	{
		$code = '';
		if (function_exists('mb_strlen')) {
			for($i = 1, $cslen = mb_strlen($this->charset); $i <= $this->code_length; ++$i) {
				$code .= mb_substr($this->charset, mt_rand(0, $cslen - 1), 1, 'UTF-8');
			}
		} else {
			for($i = 1, $cslen = strlen($this->charset); $i <= $this->code_length; ++$i) {
				$code .= substr($this->charset, mt_rand(0, $cslen - 1), 1);
			}
		}
		return $code;
	}
	/**
	* Validate a code supplied by the user
	*
	* Checks the entered code against the value stored in the session. Handles case sensitivity.
	* Also removes the code from session if the code was entered correctly to prevent re-use attack.
	*
	* This function does not return a value.
	*
	* @see Securimage::$correct_code 'correct_code' property
	*/
	protected function validate()
	{
		if (!is_string($this->code) || strlen($this->code) == 0) {
			$code = $this->getCode(true);
			// returns stored code, or an empty string if no stored code was found
			// checks the session
		} else {
			$code = $this->code;
		}
		if (is_array($code)) {
			if (!empty($code)) {
				$ctime = $code['time'];
				$code = $code['code'];
				$this->_timeToSolve = time() - $ctime;
			} else {
				$code = '';
			}
		}
		if ($this->case_sensitive == false && preg_match('/[A-Z]/', $code)) {
			// case sensitive was set from securimage_show.php but not in class
			// the code saved in the session has capitals so set case sensitive to true
			$this->case_sensitive = true;
		}
		$code_entered = trim( (($this->case_sensitive) ? $this->code_entered
		: strtolower($this->code_entered))
		);
		$this->correct_code = false;
		if ($code != '') {
			if (strpos($code, ' ') !== false) {
				// for multi word captchas, remove more than once space from input
				$code_entered = preg_replace('/\s+/', ' ', $code_entered);
				$code_entered = strtolower($code_entered);
			}
			if ((string)$code === (string)$code_entered) {
				$this->correct_code = true;
				if ($this->no_session != true) {
					$_SESSION['securimage_code_disp'] [$this->namespace] = '';
					$_SESSION['securimage_code_value'][$this->namespace] = '';
					$_SESSION['securimage_code_ctime'][$this->namespace] = '';
				}
			}
		}
	}
	/**
	* Save CAPTCHA data to session
	*/
	protected function saveData()
	{
		if ($this->no_session != true) {
			if (isset($_SESSION['securimage_code_value']) && is_scalar($_SESSION['securimage_code_value'])) {
				// fix for migration from v2 - v3
				unset($_SESSION['securimage_code_value']);
				unset($_SESSION['securimage_code_ctime']);
			}
			$_SESSION['securimage_code_disp'] [$this->namespace] = $this->code_display;
			$_SESSION['securimage_code_value'][$this->namespace] = $this->code;
			$_SESSION['securimage_code_ctime'][$this->namespace] = time();
		}
	}
	/**
	* Checks to see if the captcha code has expired and can no longer be used.
	*
	* @see Securimage::$expiry_time expiry_time
	* @param int $creation_time The Unix timestamp of when the captcha code was created
	* @return bool true if the code is expired, false if it is still valid
	*/
	protected function isCodeExpired($creation_time)
	{
		$expired = true;
		if (!is_numeric($this->expiry_time) || $this->expiry_time < 1) {
			$expired = false;
		} else if (time() - $creation_time < $this->expiry_time) {
			$expired = false;
		}
		return $expired;
	}
	/**
	* Checks to see if headers can be sent and if any error has been output
	* to the browser
	*
	* @return bool true if it is safe to send headers, false if not
	*/
	protected function canSendHeaders()
	{
		if (headers_sent()) {
			// output has been flushed and headers have already been sent
			return false;
		} else if (strlen((string)ob_get_contents()) > 0) {
			// headers haven't been sent, but there is data in the buffer that will break image data
			return false;
		}
		return true;
	}
	/**
	* Return a random float between 0 and 0.9999
	*
	* @return float Random float between 0 and 0.9999
	*/
	function frand()
	{
		return 0.0001 * mt_rand(0,9999);
	}
	/**
	* Convert an html color code to a Securimage_Color
	* @param string $color
	* @param Securimage_Color $default The defalt color to use if $color is invalid
	*/
	protected function initColor($color, $default)
	{
		if ($color == null) {
			return new Securimage_Color($default);
		} else if (is_string($color)) {
			try {
				return new Securimage_Color($color);
			} catch(Exception $e) {
				return new Securimage_Color($default);
			}
		} else if (is_array($color) && sizeof($color) == 3) {
			return new Securimage_Color($color[0], $color[1], $color[2]);
		} else {
			return new Securimage_Color($default);
		}
	}
	/**
	* The error handling function used when outputting captcha image or audio.
	*
	* This error handler helps determine if any errors raised would
	* prevent captcha image or audio from displaying. If they have
	* no effect on the output buffer or headers, true is returned so
	* the script can continue processing.
	*
	* See https://github.com/dapphp/securimage/issues/15
	*
	* @param int $errno PHP error number
	* @param string $errstr String description of the error
	* @param string $errfile File error occurred in
	* @param int $errline Line the error occurred on in file
	* @param array $errcontext Additional context information
	* @return boolean true if the error was handled, false if PHP should handle the error
	*/
	public function errorHandler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = array())
	{
		// get the current error reporting level
		$level = error_reporting();
		// if error was supressed or $errno not set in current error level
		if ($level == 0 || ($level & $errno) == 0) {
			return true;
		}
		return false;
	}
}
/**
* Color object for Securimage CAPTCHA
*
* @version 3.0
* @since 2.0
* @package Securimage
* @subpackage classes
*
*/
class Securimage_Color
{
	/**
	* Red value (0-255)
	* @var int
	*/
	public $r;
	/**
	* Gree value (0-255)
	* @var int
	*/
	public $g;
	/**
	* Blue value (0-255)
	* @var int
	*/
	public $b;
	/**
	* Create a new Securimage_Color object.
	*
	* Constructor expects 1 or 3 arguments.
	*
	* When passing a single argument, specify the color using HTML hex format.
	*
	* When passing 3 arguments, specify each RGB component (from 0-255)
	* individually.
	*
	* Examples:
	*
	* $color = new Securimage_Color('#0080FF');
	* $color = new Securimage_Color(0, 128, 255);
	*
	* @param string $color The html color code to use
	* @throws Exception If any color value is not valid
	*/
	public function __construct($color = '#ffffff')
	{
		$args = func_get_args();
		if (sizeof($args) == 0) {
			$this->r = 255;
			$this->g = 255;
			$this->b = 255;
		} else if (sizeof($args) == 1) {
			// set based on html code
			if (substr($color, 0, 1) == '#') {
				$color = substr($color, 1);
			}
			if (strlen($color) != 3 && strlen($color) != 6) {
				throw new InvalidArgumentException(
				'Invalid HTML color code passed to Securimage_Color'
				);
			}
			$this->constructHTML($color);
		} else if (sizeof($args) == 3) {
			$this->constructRGB($args[0], $args[1], $args[2]);
		} else {
			throw new InvalidArgumentException(
			'Securimage_Color constructor expects 0, 1 or 3 arguments; ' . sizeof($args) . ' given'
			);
		}
	}
	/**
	* Construct from an rgb triplet
	*
	* @param int $red The red component, 0-255
	* @param int $green The green component, 0-255
	* @param int $blue The blue component, 0-255
	*/
	protected function constructRGB($red, $green, $blue)
	{
		if ($red < 0) $red = 0;
		if ($red > 255) $red = 255;
		if ($green < 0) $green = 0;
		if ($green > 255) $green = 255;
		if ($blue < 0) $blue = 0;
		if ($blue > 255) $blue = 255;
		$this->r = $red;
		$this->g = $green;
		$this->b = $blue;
	}
	/**
	* Construct from an html hex color code
	*
	* @param string $color
	*/
	protected function constructHTML($color)
	{
		if (strlen($color) == 3) {
			$red = str_repeat(substr($color, 0, 1), 2);
			$green = str_repeat(substr($color, 1, 1), 2);
			$blue = str_repeat(substr($color, 2, 1), 2);
		} else {
			$red = substr($color, 0, 2);
			$green = substr($color, 2, 2);
			$blue = substr($color, 4, 2);
		}
		$this->r = hexdec($red);
		$this->g = hexdec($green);
		$this->b = hexdec($blue);
	}
}
