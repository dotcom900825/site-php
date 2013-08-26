<?php
// Timestamp: [[ 2012-12-11 14:09:48 +0000 by Mike Yrabedra (mikeyrab) ]]
//======================================================================//
//  GRAB CONTROL FILE
//======================================================================//
$control_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'control.php' ;
if (file_exists($control_file)) {
	@require_once($control_file);
}else{
	exit("Error: Config File Could not be found at path = {$control_file} ");
}

//======================================================================//
//  INIT
//======================================================================//
$backsnap = new BackSnap;
$rs = $backsnap->init($config);
if($rs != 'good')
	exit("Error: {$rs} ");
	
if(!isset($_POST['type'])) {
	exit("Error: No Action Type Specified. ");
}

//======================================================================//
//  LET'S GO
//======================================================================//

$type = $_POST['type'];

switch($type)
{

	// ! Add 
	case 'add' :
	
	$postid = $backsnap->process($_POST);
	
	if(!is_numeric($postid)){ // not a number, must be an error
		echo json_encode(array('status'=>'error','msg'=>$postid));
		exit;
	}
		
	
	$c = $backsnap->getCommentDetails($_POST['page'], $postid);

	$average = $backsnap->getRatingAverage($_POST['page']);
	$vote_count = $backsnap->getVoteCount($_POST['page']);
	$can_vote = ($config['limit_votes'] && $vote_count > $config['vote_limit']) ? 'false' : 'true' ;
    
    $comment = array('id'=>$postid,
     					'name'=>$c['backsnap-name'],
     					 'email'=>$c['backsnap-email'],
     					 'comment'=>$c['backsnap-comment'],
     					 'rating'=>$c['backsnap-rating'],
     					'timestamp'=>$c['timestamp'],
     					'postdate' =>$c['postdate'],
     					'avatar'=>$c['avatar']);
     echo json_encode(array('status'=>'good', 'config'=>array('averageRating'=>$average, 'canVote'=> $can_vote), 'comment'=> $comment));   
     
	
	break;
	
	// ! Reply
	case 'reply' : 

	$postid = $backsnap->process($_POST);
	
	if(!is_numeric($postid)){ // not a number, must be an error
		echo json_encode(array('status'=>'error','msg'=>$postid));
		exit;
	}
	
	$c = $backsnap->getCommentDetails($_POST['page'], $postid);
	$comment = array('id'=>$postid,
						'name'=>$c['backsnap-name'],
     					'email'=>$c['backsnap-email'],
     					'comment'=>$c['backsnap-comment'],
     					'rating'=>$c['backsnap-rating'],
     					'timestamp'=>$c['timestamp'],
     					'postdate' =>$c['postdate'],
     					'avatar'=>$c['avatar']);
	echo json_encode($comment);	
	break;
	
	
	// ! Report
	case 'report' :
	$rs = $backsnap->report($_POST);
	if($rs != 'good'){ 
		echo json_encode(array('status'=>'error','msg'=>$rs));
		exit;
	}
	echo json_encode(array('status'=>'good', 'msg'=>$config['report_confirmation']));
	break;




	default:
	// do nothing
	break;




}
