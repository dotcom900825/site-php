<?php
//=============================================================//
//
// ! BACKSNAP STACK
// - Timestamp: [[ 2012-12-05 11:45:00 +0000 by Mike Yrabedra (mikeyrab) ]]
// - author: Mike Yrabedra
// - (c)2012 Yabdab Inc. All rights reserved.
//
//  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
//  EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
//  MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL 
//  THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
//  SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT
//  OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) 
//  HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR 
//  TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, 
//  EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
//=============================================================//


//======================================================================//
// ! PHP5 CHECK
//======================================================================//
// Make sure PHP 5 is installed before doing anything
$php_version = phpversion();
if( $php_version < 5 ){
	$php_error = "FormSnap Requires PHP Version 5 ( preferably 5.3+ ) or better<br />".
	"The server this script is hosted on is using PHP Version $php_version.<br />".
	"Upgrade your server to PHP5 and try again.";
	die($php_error);	
}

//======================================================================//
// ! START SESSION
//======================================================================//
session_start();

//======================================================================//
// ! SET PAGE
//======================================================================//
if( isset($_GET['page']) ) { 
	$page = $_GET['page'];
} elseif ( isset($_POST['page']) ){
	$page =  $_POST['page'] ;
}else{
	$page = '' ;
}

//======================================================================//
// ! CGI FIX
//======================================================================//
// Some hosts (was it GoDaddy?) complained without this
@ini_set('cgi.fix_pathinfo', 0);

//======================================================================//
// ! PHP 5.3 will BITCH without this
//======================================================================//
if(ini_get('date.timezone') == '') date_default_timezone_set('GMT');

//======================================================================//
// ! Get Config File (Required)
//======================================================================//
$dir = "../";
$lastMod = 0;
$config_file = '';
if (is_dir($dir)) {
    if ($files = scandir($dir)) {
       foreach ($files as $file)
       {
        	if (preg_match( '/^stacks_page_page[0-9]*\.php$/', $file)) {
        		if(filectime($dir.$entry) > $lastMod)
        		{
        			$lastMod = filectime($file);
        			$config_file = $file;
        		}
        	}
        }
       
    }
}
if (file_exists($dir.$config_file)) {
	@require_once($dir.$config_file);
	
	// Get config
	if(!$page) {
		$config = end($backsnap_config); // get last config item if any
	}else{
		$config = $backsnap_config[$page];
	}	
			
}else{
	exit("Error: Config File Could not be found at path = {$config_file} ");
}

//======================================================================//
// ! Get Class File (Required)
//======================================================================//
$app_file = dirname(__FILE__) . DIRECTORY_SEPARATOR. 'lib'. DIRECTORY_SEPARATOR . 'backsnap.php' ;
if (file_exists($app_file)) {
	@require_once($app_file);
}else{
	exit("Error: App File Could not be found at path = {$app_file} ");
}


//======================================================================//
// ! DEBUG
//======================================================================//
if ( $config['debug'] ) {
	// E_DEPRECATED is a core PHP constant in PHP 5.3. Don't define this yourself.
	// The two statements are equivalent, just one is for 5.3+ and for less than 5.3.
	if ( defined( 'E_DEPRECATED' ) )
		error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );
	else
		error_reporting( E_ALL );

	ini_set( 'display_errors', 1 );

} else {
	error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
}
