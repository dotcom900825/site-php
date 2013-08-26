<?php 
//======================================================================//
//
// ! BACKSNAP v 1.1.0
// - Timestamp: [[ 07-15-2013 02:26:52 pm by Mike Yrabedra (mikeyrab) ]]
// - author: Mike Yrabedra
// - (c)2013 Yabdab Inc. All rights reserved.
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
//======================================================================//

// ! -- LOAD REQUIRED HELPER CLASSES
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR .'akismet.php'); // Akismet API

class BackSnap {

	//  Set Variables for Class Use...
	private $mysqli;
	private $akismet;
	public $config = array();

			
	//======================================================================//
	// + GET EVERYTHING SETUP
	//======================================================================//  
	
	public function init($config){
		$this->config = $config;
		$this->_sanitize_globals(); // clean anything coming in

		if($this->config['use_akismet']) {
		
			$pageURL = 'http';
			 if (isset($_SERVER["HTTPS"])) {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
			 }
		 
		 if ($urlParts = parse_url($pageURL))
				$baseUrl = $urlParts["scheme"] . "://" . $urlParts["host"];
  
			$this->akismet = new Akismet($baseUrl, $this->config['akismet_api_key']);
			
			if(!$this->akismet->isKeyValid())
				return 'Invalid Akismet API Key';
		
		}

		// Connect to database
		$this->mysqli = new mysqli($this->config['mysql_host'], 
									$this->config['mysql_username'], 
									$this->config['mysql_password'], 
									$this->config['mysql_db']);
									
		
		if ($this->mysqli->connect_error)
		{
			return 'BackSnap was unable to connect to the MySQL database "'.$this->config['mysql_db'].'" on the host located at "'.$this->config['mysql_host'].'" using the username and password provided. Please make sure all the MySQL credentials entered are valid.';
		}				
									
		return $this->_setupBackSnapDatabase();	
	}
	
	
	public function closeConnection()
	{
		$this->mysqli->close();
	}
	
	//======================================================================//
	// + TACO
	//======================================================================//
	public function taco($eval="", $replace="", $select=""){
		 
		$str = '<taconite>'.PHP_EOL;
		if($replace){
			$str .= '<replaceAndFadeIn select="'.$select.'"><![CDATA['.PHP_EOL
			.$replace.PHP_EOL
			.']]>'.PHP_EOL.'</replaceAndFadeIn>'.PHP_EOL;
		}
		
		$eval = trim( preg_replace( '/\s+/', ' ', $eval ) ); // make a 1 liner;
	
		if($eval){
			$str .= '<eval><![CDATA['.PHP_EOL.$eval.PHP_EOL.']]>'.PHP_EOL.'</eval>'.PHP_EOL;
		}
		$str .= '</taconite>';
		
		return $str;
	}


	//======================================================================//
	// + SHOW COMMENTS
	//======================================================================//
	
	public function getComments($page=null){

		$posts = array();
		$output = '';
		$rate_sum = 0;
		$rate = 0;
		$replies = array();
			
		//$sort = ( $this->config['reverse_sort'] == 'true') ? 'DESC' : 'ASC' ;
		$sql = "SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND parent = '0' ORDER BY timestamp DESC";
		$comments = $this->mysqli->query($sql);
		unset($sql);

		// Get replies ...
		$sql = "SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND parent <> '0' ORDER BY timestamp DESC";
		$rs = $this->mysqli->query($sql);
		
		if($rs)
			while($replies[]=$rs->fetch_array(MYSQLI_ASSOC));
			
		array_pop($replies);
		$rs->free();
		unset($sql);
		
		
		if ($this->mysqli->error) { 
		  	return  'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		 }
		 
		while($comment = $comments->fetch_object())
		{
			$reply_list = array();
			
			$hash = md5(strtolower(trim($comment->email)));
			$gravatar = $this->_gravatarFromHash($hash);
			$rate_sum+=$comment->rating;
			
			$post = array(); // init
			$post['id'] = $comment->id;
			$post['name'] = $comment->author;
			$post['avatar'] = $gravatar;
			$post['timestamp'] = (int)$comment->timestamp;
			$post['postdate'] = $this->_getPostDate((int)$comment->timestamp);
			$post['comment'] = $this->_emoticonFormat($comment->message);
			$post['rating'] = $comment->rating;
			$post['followup'] = $this->_emoticonFormat($comment->followup);
			
					
			// Get any replies ...
			if(count($replies))
			{
				
				// Loop through replies and see if any stick ...
				foreach($replies as $reply)
				{
					if($comment->id == $reply['parent']) {
					
						$hash = md5(strtolower(trim($reply['email'])));
						$gravatar = $this->_gravatarFromHash($hash);
						
						$r = array(); // init
						$r['name'] = $reply['author'];
						$r['avatar'] = $gravatar;
						$r['timestamp'] = (int)$reply['timestamp'];
						$r['postdate'] = $this->_getPostDate((int)$reply['timestamp']);
						$r['comment'] = $this->_emoticonFormat($reply['message']);
						$r['followup'] = $this->_emoticonFormat($reply['followup']);
						$reply_list[] = $r;

					}
				}
			}
			
			// Add Replies if any
			if(count($reply_list))
				$post['replies'] = $reply_list;
				
			// Add post into posts array
			$posts[] = $post;
				
		} //while
		
		$comments->free();
		
		return $posts;
			
	}
	
	
	//======================================================================//
	// + PROCESS
	//======================================================================//
	
	public function process($p)
	{	
		
		if($this->config['use_captcha'])
		{

			if(!isset($this->config['captcha_answer']) || strtolower(trim($this->config['captcha_answer'])) !== strtolower(trim($p['captcha_answer'])) )
				return $this->config['captcha_fail'];
		}
		
		
		if($this->config['use_akismet'])
		{
			if($this->_akismet_spamcheck($p))
				return $this->config['spam_test_fail'];
			
		}
		
/*
		if($this->config['restrict_votes'] == 'true' && !$post['allow_posts'])
		{
			$vote_cnt = $this->getVoteCount($p['page']);
			if($this->config['vote_limit'] < $vote_cnt)
				return 'Vote limit of '.$this->config['vote_limit'].' already reached.';
		}
*/
		
		$rs = $this->_saveChanges($p);
		if(!is_numeric($rs))
			return $rs;		
		
		return $rs;				
	}
		
	//======================================================================//
	// + REPORT
	//======================================================================//
	
	public function report($p)
	{	

		if($this->config['use_captcha'])
		{
			if(!isset($this->config['captcha_answer']) || !isset($p['captcha_answer']) || strtolower(trim($this->config['captcha_answer'])) !== strtolower(trim($p['captcha_answer'])) ) {
				return $this->config['captcha_fail'];
			}
		}
		
		// Get comment details ...
		
		$report = $this->getCommentDetails($p['page'], $p['postid']);
		$report['url'] = $p['url']; // add the url from parent
		
		if(array_key_exists('error', $report))
			return $report['error'];
		
		$msg = $p['backsnap-report'];
		
		$this->_notify($report, 'report', $msg);	
		
		return 'good';				
	}
		

	//======================================================================//
	// + DISPLAY ERRORS
	//======================================================================//
	
	public function displayErrors($errors)
	{
		$output = '';
		$output .= '<div class="alert alert-danger">';
		$output .= '<ul>';
		foreach($errors as $error)
			$output .= '<li><strong>Error:</strong>'.$error.'</li>';
		$output .= '</ul></div>';
		
		return $output;
	}
	
	//======================================================================//
	// - SAVE CHANGES
	//=============================================================//
	
	private function _saveChanges($p) {
	
		if(  isset($p['page']) ){
		
			$page = (isset($p['page']))?$p['page']:'fail';
			$name = (isset($p['backsnap-name']))?$p['backsnap-name']:'Anonymous';
			$email = (isset($p['backsnap-email']))?$p['backsnap-email']:'';
			$comment = (isset($p['backsnap-comment']))?$p['backsnap-comment']:'';
			$parent = (isset($p['postid']))?$p['postid']:0;
			$rating = (isset($p['backsnap-rating']))?$p['backsnap-rating']:0;
			$url = (isset($p['url']))?$p['url']:'';	
			
		
			$rs = $this->_saveCommentToDatabase( $page, $name, $email, $comment, $parent, $rating, $url );
			
			if(is_numeric($rs)){
			
				// Send email alert ...
				if($this->config['email_alerts'] && !$this->config['only_error_alerts']) {
					
					$notify = $this->getCommentDetails($p['page'], $rs);
					$notify['url'] = $url; // append url from request
					$type = (empty($parent))?'add':'reply';
					$this->_notify( $notify, $type ); 
				}
				
				return $rs;
			
			}else{
				
				$notify_error = $rs;
				// don't want spammer know why it was blocked.
				$error = '<b>An Error Occured (002)</b><br>' .$rs. PHP_EOL;
				
				// Send email alert ...
				if($this->config['email_alerts'] == 'true')
					$this->_notify( $p, 'error', $notify_error ); 

					
				return $error;
				
				
			} // if good
			
		} else {	
		
			// Send email alert ...
			if($this->config['email_alerts'] == 'true')
				$this->_notify( $msg, 'error','No comment entered' ); 
		
			return 'Error occurred when saving comment.';
		}
			
		
	}
	
	
	
	//======================================================================//
	// ! + ADMIN FUNCTIONS
	//======================================================================//
	
	public function dashboardView()
	{
		
        $sql = " SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts`
        			WHERE id IN (SELECT MAX(id) FROM `".$this->config['mysql_db']."`.`backsnap_posts` GROUP BY page) 
        			ORDER BY timestamp DESC";                
		
		$pages = $this->mysqli->query($sql);
		
		$str = '<table class="table table-striped table-bordered table-hover" id="dashboard-table">'.PHP_EOL;
		$str .= '<thead><tr><th>Page ID</th><th>Last Activity</th><th>Count</th><th>Average Rating</th><th></th></tr></thead>'.PHP_EOL;
		$str .= '<tbody>'.PHP_EOL;
		
		while($row = $pages->fetch_object())
		{
			 if($row->page)
			 {
			 	$count = $this->_getPostCount($row->page);
			 	$rating = $this->getRatingAverage($row->page);
			 	
			 	$average_rating = '';
			 	
			 	if($rating) {
			 		for($i = 1; $i <= $rating; $i++) { $average_rating .= '<i class="icon-star"></i> '; }
			 		    
			 	}else{
				 	$average_rating = '<em>no rating</em>';
			 	}
			 	
			 	$timestamp = $this->_getLastActivity($row->page);
			 	$email = ($row->email)?$row->email:'--';
			 	$url = ($row->url)?$row->url:'#';
			 	$hash = md5(strtolower(trim($row->email)));
			 	$gravatar = $this->_gravatarFromHash($hash);
			 	
			 	$str .= '<tr>'.PHP_EOL;
			 	$str .= '<td><a href="'.$url.'" target="_blank">'.$row->page.'</a></td>'.PHP_EOL;
			 	$str .= '<td>';
			 	$str .= '<img title="'.$row->author.'" src="'.$gravatar.'"  width="30" height="30" class="img-polaroid" onload="this.style.visibility=\'visible\'" style="visibility: visible; " />'.PHP_EOL;
			 	$str .= '<b>'.$row->author.'</b> <em>( <a href="mailto:'.$email.'">'.$email.'</a> )</em><br>';
			 	$str .= '<div class="alert alert-info" style="margin:6px">&quot;'.$this->_emoticonFormat($row->message).'&quot;</div>';
			 	$str .= '<em style="color:#ccc"><i class="icon-time"></i> '.$this->_timeAgo( (int)$timestamp ).'</em></td>'.PHP_EOL;
			 	$str .= '<td><span class="badge">'.$count.'</span></td>'.PHP_EOL;
			 	$str .= '<td>'.$average_rating.'</td>'.PHP_EOL;
			 	$str .= '<td><a href="?page='.$row->page.'" class="btn"><i class="icon-edit"></i> Edit</a></td>'.PHP_EOL;
			 	$str .= '</tr>'.PHP_EOL;
			 }
		}
		
		$pages->free();
		
		$str .= '</tbody>'.PHP_EOL;
		$str .= '</table>'.PHP_EOL;
		
		return $str;
	
	}
	
	public function editPostsForm($page=null){
	
		if(!$page)
			return '<div class="alert alert-block"><h4 class="alert-heading">Attention!</h4><p>Please choose a page from the list on the left.</p></div>';

		$entries = '<form action="?page='.$page.'" method="post" class="form-horizontal" id="admin-form">'.PHP_EOL;
		$entries .= '<input type="hidden" name="page" value="'.$page.'" />'.PHP_EOL;
		$entries .= '<input type="hidden" name="backsnap_action"" value="edit_posts" />'.PHP_EOL;
		$output = '';
		$rate_sum = 0;
		$rate = 0;
			
	
		$sql = "SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND parent = '0' ORDER BY timestamp";
		$comments = $this->mysqli->query($sql);
		unset($sql);
		

		// Get replies ...
		$sql = "SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND parent <> '0' ORDER BY timestamp";
		$rs = $this->mysqli->query($sql);
		while($replies[]=$rs->fetch_array(MYSQLI_ASSOC));
		array_pop($replies);
		$rs->free();
		unset($sql);
		
		if ($this->mysqli->error) { 
		  	return  'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		 }

		 
		while($comment = $comments->fetch_object())
		{
			$reply_count = 0;
			
			$postdate = $this->_getPostDate( (int)$comment->timestamp );
			
			$hash = md5(strtolower(trim($comment->email)));
			$gravatar = $this->_gravatarFromHash($hash);
			$rate_sum+=$comment->rating;
			
			$entries .= '<div class="post" id="'.$comment->id.'">'.PHP_EOL;
			//$entries .= '<div class="post-inner">'.PHP_EOL;
			$entries .= '<div class="avatar"><img title="'.$comment->author.'" src="'.$gravatar.'"  width="30" height="30" class="img-polaroid" onload="this.style.visibility=\'visible\'" style="visibility: visible; " /></div>'.PHP_EOL;
			$entries .= '<div class="comment">'.PHP_EOL;
			//$entries .= '<div class="comment-inner">'.PHP_EOL;
			$entries .= '<div class="date"><i class="icon-time"></i> '.$postdate.'</div>'.PHP_EOL;
			$entries .= '<div class="ip"><i class="icon-map-marker"></i> '.$comment->ipaddress.'</div>'.PHP_EOL;
			//$entries .= '<div class="edit">'.PHP_EOL;
			$entries .= '<div class="control-group">'.PHP_EOL;
			$entries .= '<label class="control-label">Name</label>'.PHP_EOL;
			$entries .= '<div class="controls">'.PHP_EOL;
			$entries .= '<input type="text" class="span6" name="author['.$comment->id.']" value="'.$comment->author.'" />'.PHP_EOL;
			$entries .= '</div></div>'.PHP_EOL;
			$entries .= '<div class="control-group">'.PHP_EOL;
			$entries .= '<label class="control-label">Email</label>'.PHP_EOL;
			$entries .= '<div class="controls">'.PHP_EOL;
			$entries .= '<input type="text" class="span6" name="email['.$comment->id.']" value="'.$comment->email.'" />'.PHP_EOL;
			$entries .= '</div></div>'.PHP_EOL;
			$entries .= '<div class="control-group">'.PHP_EOL;
			$entries .= '<label class="control-label">Message</label>'.PHP_EOL;
			$entries .= '<div class="controls">'.PHP_EOL;
			$entries .= '<textarea class="span6" name="message['.$comment->id.']">'.$this->_emoticonFormat($comment->message, true).'</textarea>'.PHP_EOL;
			$entries .= '</div></div>'.PHP_EOL;
			$entries .= '<div class="control-group">'.PHP_EOL;
			$entries .= '<label class="control-label">Follow Up</label>'.PHP_EOL;
			$entries .= '<div class="controls">'.PHP_EOL;
			$entries .= '<textarea class="followup span6" name="followup['.$comment->id.']">'.$this->_emoticonFormat($comment->followup, true).'</textarea>'.PHP_EOL;
			$entries .= '</div></div>'.PHP_EOL;
			$entries .= '<div class="control-group">'.PHP_EOL;
			$entries .= '<label class="control-label">Rating</label>'.PHP_EOL;
			$entries .= '<div class="controls">'.PHP_EOL;
			$entries .= '<input type="text" class="input-mini" name="rating['.$comment->id.']" value="'.$comment->rating.'">'.PHP_EOL;
			$entries .= '</div></div>'.PHP_EOL;
			$entries .= '<input type="hidden" name="post['.$comment->id.']" value="'.$comment->id.'" />'.PHP_EOL;
			
			// Get any replies ...
			if(count($replies))
			{
				
				//$reply_entries = '<h4>Replies</h4>'.PHP_EOL;
				$reply_entries = '<div class="reply-posts">'.PHP_EOL;
				
				// Loop through replies and see if any stick ...
				foreach($replies as $reply)
				{
					
					if($comment->id == $reply['parent']) {
					
						$hash = md5(strtolower(trim($reply['email'])));
						$gravatar = $this->_gravatarFromHash($hash);
					
						$reply_entries .= '<div class="reply" id="'.$reply['id'].'">'.PHP_EOL;
						$reply_entries .= '<div class="avatar"><img src="'.$gravatar.'"  width="30" height="30" class="img-polaroid" onload="this.style.visibility=\'visible\'" style="visibility: visible; " /></div>'.PHP_EOL;
						
						$reply_entries .= '<div class="date"><i class="icon-time"></i> '.$postdate.'</div>'.PHP_EOL;
						$reply_entries .= '<div class="control-group">'.PHP_EOL;
						$reply_entries .= '<label class="control-label">Name</label>'.PHP_EOL;
						$reply_entries .= '<div class="controls">'.PHP_EOL;
						$reply_entries .= '<input type="text" class="span6" name="author['.$reply['id'].']" value="'.$reply['author'].'" />'.PHP_EOL;
						$reply_entries .= '</div></div>'.PHP_EOL;
						$reply_entries .= '<div class="control-group">'.PHP_EOL;
						$reply_entries .= '<label class="control-label">Email</label>'.PHP_EOL;
						$reply_entries .= '<div class="controls">'.PHP_EOL;
						$reply_entries .= '<input type="text" class="span6" name="email['.$reply['id'].']" value="'.$reply['email'].'" /><br />'.PHP_EOL;
						$reply_entries .= '</div></div>'.PHP_EOL;
						$reply_entries .= '<div class="control-group">'.PHP_EOL;
						$reply_entries .= '<label class="control-label">Message</label>'.PHP_EOL;
						$reply_entries .= '<div class="controls">'.PHP_EOL;
						$reply_entries .= '<textarea class="span6" name="message['.$reply['id'].']">'.$this->_emoticonFormat($reply['message'], true).'</textarea>'.PHP_EOL;
						$reply_entries .= '</div></div>'.PHP_EOL;
						$reply_entries .= '<div class="control-group">'.PHP_EOL;
						$reply_entries .= '<label class="control-label">Follow Up</label>'.PHP_EOL;
						$reply_entries .= '<div class="controls">'.PHP_EOL;
						$reply_entries .= '<textarea class="followup span6" name="followup['.$reply['id'].']">'.$this->_emoticonFormat($reply['followup'], true).'</textarea>'.PHP_EOL;
						$reply_entries .= '</div></div>'.PHP_EOL;
						//$reply_entries .= '<div class="control-group">'.PHP_EOL;
						//$reply_entries .= '<label class="control-label">Delete</label>'.PHP_EOL;
						//$reply_entries .= '<div class="controls">'.PHP_EOL;
						$reply_entries .= '<div class="alert alert-well"><label class="checkbox inline"><input type="checkbox" class="delete" name="delete['.$reply['id'].'] value="1" /> Delete this Reply.</label>'.PHP_EOL;
						if($this->config['use_akismet'])
							$reply_entries .= '<label class="checkbox inline"><input type="checkbox" class="spam" name="spam['.$reply['id'].'] value="1" /> Report as SPAM.</label>'.PHP_EOL;
						$reply_entries .= '</div>'.PHP_EOL;
						//$reply_entries .= '</div></div>'.PHP_EOL;
						$reply_entries .= '<input type="hidden" name="post['.$reply['id'].']" value="'.$reply['id'].'" />'.PHP_EOL;
						$reply_entries .= '</div>'.PHP_EOL; //. reply
						
						$reply_count++;
					
					}
				}
				$reply_entries .= '</div>'.PHP_EOL; // .reply-posts
			}
			
			if($reply_count)
				$entries .= $reply_entries;
			unset($reply_entries);
						
			$entries .= '<div class="alert alert-well"><label class="checkbox inline"><input type="checkbox" name="delete['.$comment->id.'] value="1" />Delete this Comment.</label>'.PHP_EOL;
			if($this->config['use_akismet'])
							$entries .= '<label class="checkbox inline"><input type="checkbox" class="spam" name="spam['.$comment->id.'] value="1" /> Report as SPAM.</label>'.PHP_EOL;
			$entries .= '</div>'.PHP_EOL;		
			$entries .= '</div>'.PHP_EOL; // .comment
			$entries .= '</div>'.PHP_EOL; // .post
	
		} //while
		
		// is this needed?
		$rate_class = $this->_getRateClass($rate);
		
		// Remove All checkbox
		$entries .= '<div class="alert alert-danger">'.PHP_EOL;
		$entries .= '<label class="checkbox"><input type="checkbox" name="delete_all" value="yes" id="delete_all"> <b>Remove All</b> Comments and Replies.</label>'.PHP_EOL;
		$entries .= '</div>'.PHP_EOL;
		
		$entries .= '<p class="well" style="text-align:center;"><input type="submit" class="btn btn-primary btn-large" style="width:80%;" value="Process Changes" /><br><em style="color:#ccc">All changes will be saved recursively on all comments listed on this page.</e></p>'.PHP_EOL;
		$entries .= '</form>'.PHP_EOL;
		
		$comments->free();
		  	  
		return $entries;
			
	}
	
	//======================================================================//
	// + SUBMIT SPAM TO AKISMET
	//======================================================================//
	public function akismetSubmitSpam($name, $email, $comment)
	{
		$this->akismet->setCommentAuthor($name);
		$this->akismet->setCommentAuthorEmail($email);
		//$this->akismet->setCommentAuthorURL($url);
		$this->akismet->setCommentContent($comment);
		$this->akismet->submitSpam();
	}
	
	
	//======================================================================//
	// + GET AVERAGE RATE
	//======================================================================//
	
	public function getRatingAverage($page=null)
	{
		
		if(!$page)
			return 0;
			
		$rate_sum = 0;
		$rate = 0;
		
		$sql = "SELECT rating FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND parent = '0'";
		$comments = $this->mysqli->query($sql);
		unset($sql);
		
		while($row = $comments->fetch_object())
		{
			$rate_sum+=$row->rating;
		}
		
		if($comments && $rate_sum > 0)
			$rate = ceil(number_format(($rate_sum/$comments->num_rows), 2, '.', '')); // does not use reply count
			
		return $rate;
			
	}
	
	//======================================================================//
	// + GET VOTE COUNT
	//======================================================================//
	
	public function getVoteCount($page=null)
	{
		if(!$page)
			return 0;
			
		$sql = "SELECT rating FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND ipaddress = '".$_SERVER['REMOTE_ADDR']."'";
		$rs = $this->mysqli->query($sql);
		unset($sql);
		
		return ($rs) ? $rs->num_rows : 0;		 			 
	
	}
	
	//======================================================================//
	//  + GET PAGES
	//======================================================================//

	public function getPages($page=null)
	{
		$str ='';
		
		$sql = "SELECT DISTINCT page FROM `".$this->config['mysql_db']."`.`backsnap_posts`";
		//$sql = "SELECT DISTINCT posts.page, config.title FROM `".$this->config['mysql_db']."`.`backsnap_posts` posts INNER JOIN `".$this->config['mysql_db']."`.`backsnap_config` config ON config.id = posts.page";
		
		$pages = $this->mysqli->query($sql);
		
		while($row = $pages->fetch_object())
		{
			 if($row->page)
			 {
			 	$count = $this->_getPostCount($row->page);
			 	$active = ($page == $row->page) ? ' class="active"' : '' ;
			 	$str .= '<li'.$active.'><a href="?page='.$row->page.'"><i class="icon-comments-alt icon-large"></i> ('.$count.') '.$row->page.'</a></li>'.PHP_EOL;
			 }
		}
		
		$pages->free();
		
		return $str;
	
	}
	
	//======================================================================//
	//  + DELETE POST
	//======================================================================//
	
	public function deletePost($id)
	{
	
		$sql = "DELETE FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE id = {$id} OR parent = {$id} ";
		$rs = $this->mysqli->query($sql);
		
		if ($this->mysqli->error) { 
		  	return  'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		}else{
			return 'good';
		}
	
	}
	//======================================================================//
	//  + DELETE ALL
	//======================================================================//
	
	public function deleteAll($page=null)
	{
	
		if(!$page)
			return 'No Page Specified';
	
		$sql = "DELETE FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '{$page}' ";
		$rs = $this->mysqli->query($sql);
		
		if ($this->mysqli->error) { 
		  	return  'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		}else{
			return 'good';
		}
	
	}
	
	//======================================================================//
	//  + UPDATE POST
	//======================================================================//
	
	public function updatePost($id, $page, $author = 'Anonymous', $email, $message, $rating=0, $followup='', $url='')
	{

		$author = htmlspecialchars($author);
		$email = htmlspecialchars($email);
		$message = nl2br(htmlspecialchars($message));
		$followup = nl2br(htmlspecialchars($followup));
		
		$sql = "UPDATE `".$this->config['mysql_db']."`.`backsnap_posts` SET author = '".$this->mysqli->real_escape_string($author)."', 
																					email = '".$this->mysqli->real_escape_string($email)."', 
																					message = '".$this->mysqli->real_escape_string($message)."',
																					followup = '".$this->mysqli->real_escape_string($followup)."',
																					rating = ".$rating."
																					WHERE id = {$id} AND page = '{$page}'";
		$rs = $this->mysqli->query($sql);
		
		if ($this->mysqli->error) { 
		  	return  'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		}else{
			return 'good';
		}
		 
	}
	
	//======================================================================//
	//  + LOGIN
	//======================================================================//
	
	public function login($user, $pass)
	{
	
		if($user == $this->config['admin_username'] && $pass == $this->config['admin_password'] )
			return true;
			
		return false;
	
	}
	
		
	//======================================================================//
	// + GET COMMENT DETAILS
	//=============================================================/
	
	public function getCommentDetails($page, $id)
	{
		$row = array();
		sleep(1);
		
		$sql = "SELECT author, email, message, rating, timestamp FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' AND id = '".$id."' LIMIT 1";
		$rs = $this->mysqli->query($sql);
		unset($sql);
		
		if ($rs->num_rows > 0) {
				list($author, $email, $message, $rating, $timestamp ) = $rs->fetch_array(MYSQLI_NUM);
				$rs->free();
		}
		
		if ($this->mysqli->error) { 
		  	return  $report['error'] = 'MySQL error '.$this->mysqli->error.' When executing:'.$sql;  
		 }
		 
		$hash = md5(strtolower(trim($email)));
		$gravatar = $this->_gravatarFromHash($hash);
	
		$row['backsnap-name'] = $author;
		$row['backsnap-email'] = $email;
		$row['backsnap-comment'] = $this->_emoticonFormat($message);
		$row['backsnap-rating'] = $rating;
		$row['timestamp'] = $timestamp;
		$row['postdate']  = $this->_getPostDate( (int)$timestamp );
		$row['avatar'] = $gravatar;
		
		return $row;		 
				 
	
	}
	
	public function getStackUrl($id)
	{
		 $pageURL = 'http';
		 if (isset($_SERVER["HTTPS"])) {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
		 }
		 
		 $pageURL = str_replace('index.php', 'comments.php?id='.$id, $pageURL);
		 
		 return $pageURL;
	}
	
	//======================================================================//
	// ! PRIVATE FUNCTIONS
	//======================================================================//
	
	
	private function _akismet_spamcheck($p)
	{
		 
		$name = (isset($p['backsnap-name']))?$p['backsnap-name']:$this->config['anonymous_author'];
		$email = (isset($p['backsnap-email']))?$p['backsnap-email']:'';
		$comment = (isset($p['backsnap-comment']))?$p['backsnap-comment']:'';
		$rating = (isset($p['backsnap-rating']))?$p['backsnap-rating']:0; // used in notify
		$url = (isset($p['url']))?$p['url']:''; 
		
		$this->akismet->setCommentAuthor($name);
		$this->akismet->setCommentAuthorEmail($email);
		//$this->akismet->setCommentAuthorURL($url);
		$this->akismet->setCommentContent($comment);

 		if($this->akismet->isCommentSpam())
 		{
 			// notify and block
 			$notify = array('backsnap-name'=>$name, 'backsnap-email'=>$email, 'backsnap-comment'=>$comment, 'backsnap-rating'=>$rating );
 			$notify['url'] = $url;
 			$this->_notify( $notify, 'error', 'SPAM Detected ( Powered by Akismet )' ); 
 			return true;
	 		
	 	}else{
	 	
	 		return false;
	 	
 		}
 		
 		
 		return true; // assume all comments are spam
 
 
	}
	
	
	
	//======================================================================//
	// - SET UP DATABASE
	//======================================================================//
	
	// This function only called the first time the page is loaded.
	
	private function _setupBackSnapDatabase() {
	
		$result = $this->mysqli->query("SHOW TABLES LIKE 'backsnap_posts'");
	
		if(!$result->num_rows)
		{
		   $sql = "CREATE TABLE  `".$this->config['mysql_db']."`.`backsnap_posts` (
		   `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		   `active` TINYINT( 1 ) NOT NULL default '0',
		   `parent` INT NOT NULL ,
		   `page` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `author` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `rating` decimal(4,2) NOT NULL,
		   `email` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `timestamp` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `ipaddress` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		   `followup` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
		   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci COMMENT='Table for BackSnap.'";
		   
		   $this->mysqli->query($sql);
		   
		   if ($this->mysqli->error) { 
		     	return 'MySQL error '.$$this->mysqli->error.' When executing: '.$sql;  
		    }else{
		    	return 'good';
		    }
		}

		unset($result);
		
		// Add active column if not already present
		$result = $this->mysqli->query("SELECT active FROM `".$this->config['mysql_db']."`.`backsnap_posts`");
		if(!$result)
		{	
			$this->mysqli->query("ALTER TABLE `".$this->config['mysql_db']."`.`backsnap_posts` ADD `active` TINYINT(1) NOT NULL AFTER `id`");  
		}
		
		return 'good';
   
	}
	
	//======================================================================//
	// - SAVE COMMENT
	//======================================================================//
	
	private function _saveCommentToDatabase($page, $name, $email, $comment, $parent=0, $rate=0, $url='')
	{
		
		if(!$name){ $name = 'Anonymous'; }
				
		
		$name = nl2br(htmlspecialchars($name));
		$email = nl2br(htmlspecialchars($email));
		$comment = nl2br(htmlspecialchars($comment));
		$active = 1;
		
		$sql = "INSERT INTO `".$this->config['mysql_db']."`.`backsnap_posts` ( active,
																			page,
																			parent,
																			url,
																			author,
																			email,
																			rating,
																			message,
																			ipaddress,
																			followup,
																			timestamp) values( {$active}, '".$page."',
																								 '".$this->mysqli->real_escape_string($parent)."',
																								 '".$this->mysqli->real_escape_string($url)."',
																								 '".$this->mysqli->real_escape_string($name)."',
																								 '".$this->mysqli->real_escape_string($email)."',
																								 '".$this->mysqli->real_escape_string($rate)."',
																								 '".$this->mysqli->real_escape_string($comment)."',
																								 '".$_SERVER['REMOTE_ADDR']."', '',  '".time()."')";
		
		$this->mysqli->query($sql);
		
		if ($this->mysqli->error) {
			$error = 'MySQL error '.$this->mysqli->error.' When executing: '.$sql; 
		  	return $error;  
		 }else{
		 	return $this->mysqli->insert_id;
		 }
				
		
	}

	
	//======================================================================//
	// - GET POST COUNT
	//======================================================================//
	
	private function _getPostCount($page=null)
	{
		if(!$page)
			return 0;
		
		$sql = "SELECT id FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."'";
		$rs = $this->mysqli->query($sql);
		unset($sql);
		
		$count = ($rs) ? $rs->num_rows: 0;
		
		$rs->free();
		
		return $count;		 			 
	
	}
	
	//======================================================================//
	// - GET POST COUNT
	//======================================================================//
	
	private function _getLastActivity($page=null)
	{
		if(!$page)
			return 0;
		
		$sql = "SELECT * FROM `".$this->config['mysql_db']."`.`backsnap_posts` WHERE page = '".$page."' ORDER BY timestamp DESC";
		$rs = $this->mysqli->query($sql);
		unset($sql);
		
		if($rs) {
			while($results[] = $rs->fetch_array(MYSQLI_ASSOC));
			$rs->free();
		}
		
		return $results[0]['timestamp'];		 			 
	
	}
	
	
	//======================================================================//
	// - GRAVATAR FROM HASH
	//======================================================================//
	
	private function _gravatarFromHash($hash, $size=30)
	{
			return 'http://www.gravatar.com/avatar/'.$hash.'?size='.$size.'&amp;default='.
					urlencode('http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?size='.$size);
		
	}
	
	
	
	//======================================================================//
	// - EMOTICON FORMAT
	//======================================================================//
	
	private function _emoticonFormat($str, $reverse=null)
	{
		// Credit:
		// idea to put emoticon values into array borrowed from esoTalk plugin
		// http://esotalk.com/plugins/
		
		// The emoticons themselves are available in SVG format under a Creative Commons Attribution license.
		// http://commons.wikimedia.org/wiki/File:EsoTalk_emoticon_pack_v1.0.svg
		
		$emoticons = array();
		$asset_path = $this->config['asset_path'];
		
		// Define the emoticons.
		$emoticons["&gt;:("] = "<img src='assets/img/x.gif' style='background-position:0 -480px' class='emoticon'/>";
		$emoticons["&gt;:)"] = "<img src='assets/img/x.gif' style='background-position:0 -640px' class='emoticon'/>";
		//$emoticons["&gt;:D"] = "<img src='assets/img/x.gif' style='background-position:0 -640px' class='emoticon'/>";
		$emoticons[":)"] = "<img src='assets/img/x.gif' style='background-position:0 0' alt=':)' class='emoticon'/>";
		$emoticons[":-)"] = "<img src='assets/img/x.gif' style='background-position:0 0' alt=':-)' class='emoticon'/>";
		//$emoticons["=)"] = "<img src='assets/img/x.gif' style='background-position:0 0' alt='=)' class='emoticon'/>";
		$emoticons[":D"] = "<img src='assets/img/x.gif' style='background-position:0 -20px' alt=':D' class='emoticon'/>";
		//$emoticons["=D"] = "<img src='assets/img/x.gif' style='background-position:0 -20px' alt='=D' class='emoticon'/>";
		$emoticons["^_^"] = "<img src='assets/img/x.gif' style='background-position:0 -40px' alt='^_^' class='emoticon'/>";
		$emoticons["^^"] = "<img src='assets/img/x.gif' style='background-position:0 -40px' alt='^^' class='emoticon'/>";
		$emoticons[":("] = "<img src='assets/img/x.gif' style='background-position:0 -60px' alt=':(' class='emoticon'/>";
		//$emoticons["=("] = "<img src='assets/img/x.gif' style='background-position:0 -60px' alt='=(' class='emoticon'/>";
		$emoticons["-_-"] = "<img src='assets/img/x.gif' style='background-position:0 -80px' alt='-_-' class='emoticon'/>";
		$emoticons[";)"] = "<img src='assets/img/x.gif' style='background-position:0 -100px' alt=';)' class='emoticon'/>";
		$emoticons[">_<"] = "<img src='assets/img/x.gif' style='background-position:0 -140px' alt='&gt;_&lt;' class='emoticon'/>";
		//$emoticons["=/"] = "<img src='assets/img/x.gif' style='background-position:0 -160px' alt='=/' class='emoticon'/>";
		$emoticons[":\\"] = "<img src='assets/img/x.gif' style='background-position:0 -160px' alt=':&#92;' class='emoticon'/>";
		//$emoticons["=\\"] = "<img src='assets/img/x.gif' style='background-position:0 -160px' alt='=&#92;' class='emoticon'/>";
		$emoticons[":x"] = "<img src='assets/img/x.gif' style='background-position:0 -180px' alt=':x' class='emoticon'/>";
		//$emoticons["=x"] = "<img src='assets/img/x.gif' style='background-position:0 -180px' alt='=x' class='emoticon'/>";
		$emoticons[":|"] = "<img src='assets/img/x.gif' style='background-position:0 -180px' alt=':|' class='emoticon'/>";
		//$emoticons["=|"] = "<img src='assets/img/x.gif' style='background-position:0 -180px' alt='=|' class='emoticon'/>";
		$emoticons["'_'"] = "<img src='assets/img/x.gif' style='background-position:0 -180px' alt='&#39;_&#39;' class='emoticon'/>";
		$emoticons["<_<"] = "<img src='assets/img/x.gif' style='background-position:0 -200px' alt='&lt;_&lt;' class='emoticon'/>";
		$emoticons[">_>"] = "<img src='assets/img/x.gif' style='background-position:0 -220px' alt='&gt;_&gt;' class='emoticon'/>";
		$emoticons["x_x"] = "<img src='assets/img/x.gif' style='background-position:0 -240px' alt='x_x' class='emoticon'/>";
		$emoticons["o_O"] = "<img src='assets/img/x.gif' style='background-position:0 -260px' alt='o_O' class='emoticon'/>";
		$emoticons["O_o"] = "<img src='assets/img/x.gif' style='background-position:0 -260px' alt='O_o' class='emoticon'/>";
		$emoticons["o_0"] = "<img src='assets/img/x.gif' style='background-position:0 -260px' alt='o_0' class='emoticon'/>";
		$emoticons["0_o"] = "<img src='assets/img/x.gif' style='background-position:0 -260px' alt='0_o' class='emoticon'/>";
		$emoticons[";_;"] = "<img src='assets/img/x.gif' style='background-position:0 -280px' alt=';_;' class='emoticon'/>";
		$emoticons[":'("] = "<img src='assets/img/x.gif' style='background-position:0 -280px' alt=':&#39;(' class='emoticon'/>";
		$emoticons[":O"] = "<img src='assets/img/x.gif' style='background-position:0 -300px' alt=':O' class='emoticon'/>";
		//$emoticons["=O"] = "<img src='assets/img/x.gif' style='background-position:0 -300px' alt='=O' class='emoticon'/>";
		$emoticons[":o"] = "<img src='assets/img/x.gif' style='background-position:0 -300px' alt=':o' class='emoticon'/>";
		//$emoticons["=o"] = "<img src='assets/img/x.gif' style='background-position:0 -300px' alt='=o' class='emoticon'/>";
		$emoticons[":P"] = "<img src='assets/img/x.gif' style='background-position:0 -320px' alt=':P' class='emoticon'/>";
		$emoticons[":p"] = "<img src='assets/img/x.gif' style='background-position:0 -320px' alt=':p' class='emoticon'/>";
		//$emoticons["=P"] = "<img src='assets/img/x.gif' style='background-position:0 -320px' alt='=P' class='emoticon'/>";
		$emoticons[";P"] = "<img src='assets/img/x.gif' style='background-position:0 -320px' alt=';P' class='emoticon'/>";
		$emoticons[":["] = "<img src='assets/img/x.gif' style='background-position:0 -340px' alt=':[' class='emoticon'/>";
		//$emoticons["=["] = "<img src='assets/img/x.gif' style='background-position:0 -340px' alt='=[' class='emoticon'/>";
		$emoticons["._.;"] = "<img src='assets/img/x.gif' style='background-position:0 -380px; width:18px' alt='._.;' class='emoticon'/>";
		$emoticons["._."] = "<img src='assets/img/x.gif' style='background-position:0 -500px' alt='._.' class='emoticon'/>";
		$emoticons["T_T"] = "<img src='assets/img/x.gif' style='background-position:0 -520px' alt='T_T' class='emoticon'/>";
		$emoticons["XD"] = "<img src='assets/img/x.gif' style='background-position:0 -540px' alt='XD' class='emoticon'/>";
		$emoticons["B)"] = "<img src='assets/img/x.gif' style='background-position:0 -580px' alt='B)' class='emoticon'/>";
		$emoticons["XP"] = "<img src='assets/img/x.gif' style='background-position:0 -600px' alt='XP' class='emoticon'/>";
		$emoticons[":S"] = "<img src='assets/img/x.gif' style='background-position:0 -620px' alt=':S' class='emoticon'/>";
		//$emoticons["=S"] = "<img src='assets/img/x.gif' style='background-position:0 -620px' alt='=S' class='emoticon'/>";
		
		foreach ($emoticons as $k => $v){
			if($reverse) {
				$str = str_replace($v, $k, $str);
				$str = str_replace(array('<br>','<br />','<br/>', '&lt;br /&gt;'), '', $str);
			}else{
				$str = str_replace($k, $v, $str);
			}
		}
		
		return $str;
	
	}
	
	//======================================================================//
	// - TIME AGO
	//======================================================================//
	
	private function _timeAgo($date,$granularity=2) {
	    $difference = time() - $date;
	    $retval='';
	    $periods = array('decade' => 315360000,
	        'year' => 31536000,
	        'month' => 2628000,
	        'week' => 604800, 
	        'day' => 86400,
	        'hour' => 3600,
	        'minute' => 60,
	        'second' => 1);
	                                 
	    foreach ($periods as $key => $value) {
	        if ($difference >= $value) {
	            $time = floor($difference/$value);
	            $difference %= $value;
	            $retval .= ($retval ? ' ' : '').$time.' ';
	            $retval .= (($time > 1) ? $key.'s' : $key);
	            $granularity--;
	        }
	        if ($granularity == '0') { break; }
	    }
	    
	    if(!$retval){
	    	return ' '; 
	    }
	    
	    return ' Posted '.$retval.' ago';
	         
	}

	//======================================================================//
	// - GET RATE CLASS
	//======================================================================//	
	
	private function _getRateClass($rate)
	{
		
		if($rate <= 0)
			return 'rate0';
		
		return 'rate'.trim(number_format($rate, 2, '', ''), '0');
	
	}
	
	
	//======================================================================//
	// - NOTIFY
	//======================================================================//
	
	private function _notify($p, $type='', $details='') 
	{
		$body = ''; // init	
		$msg = ''; // init	
		$from = $this->config['alert_email'];
		$to = $this->config['alert_email'];
		$subject = '[BackSnap] Notification';	
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$parent = $_SERVER['HTTP_REFERER'];
		$parent = str_replace($this->config['asset_path'].'/backsnap/content.php', '', $parent);
		$page = (isset($p['url']))?$p['url']:$parent;
		$date = date('r');
		
		$details = htmlspecialchars_decode($details);
		
		// build what was submitted ...
		$msg .= '-----------------------------------------------'.PHP_EOL;
		$msg .= PHP_EOL.$this->config['comment_label'].': '.PHP_EOL.PHP_EOL.$this->_emoticonFormat($p['backsnap-comment'], true).PHP_EOL.PHP_EOL;
		$msg .= $this->config['name_label'].': '.$p['backsnap-name'].PHP_EOL;
		$msg .= $this->config['email_label'].': '.$p['backsnap-email'];
		
		if($this->config['allow_rating'])
			$msg .= PHP_EOL. $this->config['rate_label'] . ': ' . $p['backsnap-rating'];
		
		
		// build body
		if($type == 'add'){
			$subject = '[BackSnap] Comment Added';
		}
		
		if($type == 'reply'){
		 $subject = '[BackSnap] Comment Reply';
		}
		
		if($type == 'error'){
		 $body .= $details.PHP_EOL;
		 $subject = '[BackSnap] Error!';
		}
		
		if($type == 'report'){
		 $body .= $details.PHP_EOL;
		 $subject = '[BackSnap] Report';
		}
		
		$body .= PHP_EOL . $msg . PHP_EOL;
		$body .= PHP_EOL . '-----------------------------------------------'.PHP_EOL;
		$body .= ' Page: ' . $page . PHP_EOL;
		$body .= ' IP Address: ' . $ipaddress . PHP_EOL;
		$body .= ' Date: ' . $date . PHP_EOL;
		$body .= PHP_EOL . '~ Powered by BackSnap | http://yabdab.com/backsnap/ ~' . PHP_EOL;
		
		//build headers
		$headers = '';
		$headers .= 'From: ' . $from  . PHP_EOL;
		$headers .= 'Reply-To: ' . $from  . PHP_EOL;
		$headers .= 'Return-Path: ' . $from  . PHP_EOL;
		$headers .= "Message-ID: <" . time() . $to . ">" . PHP_EOL;
		$headers .= 'X-Sender-IP: ' . $ipaddress . PHP_EOL;
		$headers .= 'MIME-Version: 1.0' . PHP_EOL;
		$headers .= 'Content-type: text/plain; charset="utf-8"' . PHP_EOL;
		$headers .= 'Content-transfer-encoding: 8bit' . PHP_EOL;
		
		
		// send
		if( mail($to, $subject, trim($body), $headers) ) { return 'good'; } else {  return 'fail'; }
			
	
	}
	
	
	private function _sanitize_globals()
	{
	
		// Clean $_GET Data
		if (is_array($_GET) AND count($_GET) > 0)
		{
			foreach ($_GET as $key => $val)
			{
				$_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
		}
	
		// Clean $_POST Data
		if (is_array($_POST) AND count($_POST) > 0)
		{
			foreach ($_POST as $key => $val)
			{
				$_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
		}
	
	}
	
	private function _clean_input_data($str)
	{
		if (is_array($str))
		{
			$new_array = array();
			foreach ($str as $key => $val)
			{
				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
			}
			return $new_array;
		}
	
		/* We strip slashes if magic quotes is on to keep things consistent
	
		   NOTE: In PHP 5.4 get_magic_quotes_gpc() will always return 0 and
			 it will probably not exist in future versions at all.
		*/
		if ( ! $this->_is_php('5.4') && get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
	
		// Clean UTF-8 if supported
		$str = $this->_clean_string($str);
	
		// Remove control characters
		$str = $this->_remove_invisible_characters($str);
	
		return $str;
	}
	
	private function _clean_input_keys($str)
	{
		if ( ! preg_match("/^[a-z0-9:_\/-]+$/i", $str))
		{
			exit('Disallowed Key Characters.');
		}
	
		// Clean UTF-8 if supported
		$str = $this->_clean_string($str);
	
		return $str;
	}
	
	private function _clean_string($str)
	{
		if ($this->_is_ascii($str) === FALSE)
		{
			$str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
		}
	
		return $str;
	}
	
	private function _is_ascii($str)
	{
		return (preg_match('/[^\x00-\x7F]/S', $str) == 0);
	}
	
	private function _is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string)$version;
	
		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}
	
		return $_is_php[$version];
	}
	
	private function _remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127
	
		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);
	
		return $str;
	}
	
	private function _getPostDate($timestamp)
	{
		if($this->config['date_format'] == 'timeago'){
			return $this->_timeAgo( (int)$timestamp );
		}else{
			$format = ($this->config['date_format'])?$this->config['date_format']:'r';
			return date( $format, (int)$timestamp );
		}
		
		return date( 'r', (int)$timestamp );
		
	}
	
	
} // end of BackSnap Class