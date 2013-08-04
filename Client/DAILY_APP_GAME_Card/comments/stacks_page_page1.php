<?php

//======================================================================//
// + REQUIREMENTS
//======================================================================//

// Make sure requirements are met.
if( PHP_VERSION < 5 ){
	die( "BackSnap Requires PHP Version 5 or better<br />".
	"The server this script is hosted on is using PHP Version ".PHP_VERSION.".<br />".
	"Upgrade your server to PHP5 and try again." );	
}

//======================================================================//
// + BACKSNAP CONFIG FILE
// - Timestamp: [[ 06-04-2013 09:54:32 am by Mike Yrabedra (mikeyrab) ]]
//======================================================================//
$backsnap_config['DailyFreeApp'] = array(
	// Base Settings
	'asset_path' 			=> rtrim('../files', '/'),
	'page_id' 				=> 'DailyFreeApp',
	'date_format' 			=> 'timeago',
	'admin_username' 		=> 'admin',
	'admin_password' 		=> 'wangfute95536',
	'hide_form'				=> '1',
	'allow_rating'			=> 1,
	'allow_comments'		=> 1,
	'show_comments'			=> 1,
	'comments_per_page'		=> 0,
	'allow_replies'			=> 1,
	'show_email_input'		=> 1,
	'require_email'			=> 1,
	'sort_chrono'			=> 0,
	'debug' 				=> 0,
	'hide_admin_btn' 		=> 0,
	// MySQL Settings
	'mysql_username' 		=> 'admin_wangfute',
	'mysql_password' 		=> 'wangfute95536',
	'mysql_db' 				=> 'admin_comment',
	'mysql_host' 			=> 'localhost',
	// Email Alerts
	'email_alerts' 			=> 0,
	'alert_email' 			=> '',
	'only_error_alerts' 	=> 1,
	'allow_reports' 		=> 1,
	'primary_button_style'	=> ' ',
	'secondary_button_style'=> ' ',
	'button_size'			=> ' ',
	'add_comment_button' 	=> 'Add Review',
	'add_reply_button' 		=> 'Add Reply',
	'report_button'			=> 'Report',
	'reply_button'			=> 'Reply',
	'send_report_button'	=> 'Send Report',
	'cancel_button'			=> 'Cancel',
	// Rating
	'limit_votes' 			=> 1,
	'vote_limit' 			=> 1,
	// Labels
	'reply_label'	 		=> 'Reply',
	'report_label' 			=> 'Report',
	'name_label' 			=> 'Your Name',
	'email_label' 			=> 'Your Email',
	'rate_label' 			=> 'Rating',
	'comment_label' 		=> 'Enter your review here...',
	'average_rating_label' 	=> 'Average Rating',
	'form_toggle_label'		=> 'Write a Review',
	'anonymous_author'		=> 'Anonymous',
	'no_results'			=> 'Be the first to place a comment.',
	// Headers
	'main_header'			=> 'Reviews',
	'add_comment_header' 	=> 'Add Review',
	'error_header'			=> 'Error!',
	'success_header'		=> 'Success!',
	'report_confirmation'	=> 'Your report has been submitted.',
	// Anti Spam
	'use_captcha' 			=> 1,
	'captcha_fail' 			=> 'Wrong Answer',
	'captcha_question' 		=> 'What color is a banana? (Spam Filter)',
	'captcha_answer' 		=> 'yellow',
	// Akismet Support
	'use_akismet'			=> 0,
	'akismet_api_key'		=> '',
	'spam_test_fail'		=> 'Your Comment was identified as SPAM.',
	// Styles
	'body_bg_color'			=> '#FFFFFF',
	'font'					=> '"Helvetica Neue", Helvetica, Arial, sans-serif',
	'font_size'				=> '13',
	'font_color'			=> '#222222',
	'link_color'			=> '#336699',
	'header_color'			=> '#000000',
	'label_color'			=> '#888888',
	'comment_border_color'	=> '#CCCCCC',
	'comment_bg_color'		=> '#FFFFFF',
	'reply_bg_color'		=> '#F5F5F5',
	'author_color'			=> '#888888',
	'date_color'			=> '#CCCCCC',
	'wrap_border_color'		=> '#CCCCCC',
	'wrap_bg_color'			=> '#F1F1F1',
	'followup_color'		=> '#3E88C6',
	'followup_border_color'	=> '#BDE8F0',
	'followup_bg_color'		=> '#DAEDF6',
	);
?>