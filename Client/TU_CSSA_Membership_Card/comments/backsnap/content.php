<?php 
// Timestamp: [[ 2013-06-04 07:54:16 +0000 by Mike Yrabedra (mikeyrab) ]]
//======================================================================//
// GRAB CONTROL FILE
//======================================================================//
$control_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'control.php' ;
if (file_exists($control_file)) {
	@require_once($control_file);
}else{
	exit("Error: Config File Could not be found at path = {$control_file} ");
}
//======================================================================//
// INIT
//======================================================================//
$backsnap = new BackSnap;
$init = $backsnap->init($config);

if($init != 'good')
	exit("Error: {$init}");

$id = $config['page_id'];
$limit_votes = $config['limit_votes'];
$vote_limit = $config['vote_limit']; 	
$captcha_question = $config['captcha_question'];
// Get average rate based on votes
$average_rating = ($config['allow_rating']) ? $backsnap->getRatingAverage($id) : 0;
// allowed to vote?
$vote_count = $backsnap->getVoteCount($id);
$can_vote = ($limit_votes && $vote_count > $vote_limit) ? 'false' : 'true' ;
$pretty_date = ($config['date_format'] == 'timeago') ? 'true' : 'false' ;


?><!doctype html>
<html>
<head>
<title><?php echo $config['main_header'];?></title>

<!-- BackSnap v 1.1.0 | (c) 2013 Yabdab Inc. -->

<!-- Styles -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
<!--[if IE 7]>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css" rel="stylesheet">
<![endif]-->
<link href="assets/css/comments.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="assets/js/lib.js"></script>
<script src="assets/js/backsnap-remote.js"></script>
<script src="assets/js/backsnap-comment.js"></script>
<!-- <script src="assets/js/paginate.js"></script> -->

<!--[if lte IE 9]>
<script src="jquery.defaulttext.min.js"></script>
<script>jQuery('textarea,input').defaulttext();</script>
<![endif]-->

<!-- Custom Styling -->
<style>
html * { font-family: <?php echo $config['font']; ?>; font-size: <?php echo $config['font_size']; ?>px; }
body { background: <?php echo $config['body_bg_color']; ?>; font-family: <?php echo $config['font']; ?>; color: <?php echo $config['font_color']; ?>; }
.btn { font-size: <?php echo $config['font_size']; ?>px; }
.btn-group > .btn-small { font-size: <?php echo ( $config['font_size'] - 1 ); ?>px;}
a, .btn-link { color: <?php echo $config['link_color']; ?>; }
h3 { color: <?php echo $config['header_color']; ?>; font-size: <?php echo ( $config['font_size'] + 5 ); ?>px; }
label, label.control-label { color: <?php echo $config['label_color']; ?>; font-size: <?php echo ( $config['font_size'] - 1 ); ?>px; }
.comment-wrap { border-color: <?php echo $config['comment_border_color']; ?>; background: <?php echo $config['comment_bg_color']; ?>; }
.comment-label { border-color: <?php echo $config['comment_border_color']; ?>; background-color: <?php echo $config['reply_bg_color']; ?>; }
.comment-wrap .comment-wrap { background-color: <?php echo $config['reply_bg_color']; ?>; }
.reply-wrap .comment-label { background: <?php echo $config['label_bg_color']; ?>; }
.commenter { color: <?php echo $config['author_color']; ?>; }
div.comment-date { color: <?php echo $config['date_color']; ?>; font-size: <?php echo ( $config['font_size'] - 2 ); ?>px; }
.wrap { border-color: <?php echo $config['wrap_border_color']; ?>; background-color: <?php echo $config['wrap_bg_color']; ?>; }
.comment-wrap .followup { color: <?php echo $config['followup_color']; ?>; border: 1px solid <?php echo $config['followup_border_color']; ?>; background: <?php echo $config['followup_bg_color']; ?>; }
#page_navigation { margin: 0 }
.pagination ul { background-color: <?php echo $config['comment_bg_color']; ?>; }
.pagination ul>li>a, .pagination ul>li>span { background-color: <?php echo $config['comment_bg_color']; ?>; border-color: <?php echo $config['comment_border_color']; ?>; color: <?php echo $config['link_color']; ?>; }
.pagination ul>.active>a, .pagination ul>.active>span {color: <?php echo $config['comment_bg_color']; ?>;}
.pagination ul>li>a:hover, .pagination ul>li>a:focus, .pagination ul>.active>a, .pagination ul>.active>span { background-color: <?php echo $config['link_color']; ?>; color: <?php echo $config['comment_bg_color']; ?>;}
.pagination ul>.disabled>span, .pagination ul>.disabled>a, .pagination ul>.disabled>a:hover, .pagination ul>.disabled>a:focus { color: <?php echo $config['comment_border_color']; ?>; }
</style>

</head>
<body>

<?php $comments = $backsnap->getComments($id); //print_r($comments); ?>



<!--
*******************************************************************
                        Templates!
*******************************************************************
-->
<!-- template: page layout -->
<script type="text/x-handlebars-template" id="pageTemplate">
{{#if config.allowRating}}
<div id=average-rating>
<?php echo $config['average_rating_label']; ?> <span class=stars>{{#loop config.averageRating }}
<i class="icon-star icon-large"></i>
{{/loop}}</span>
</div>
{{/if}}
<div id="initialComment">
<button id=commentFormToggle class="btn <?php echo $config['button_size']; ?> <?php echo $config['primary_button_style']; ?>"><i class="icon-comment"></i> <?php echo $config['form_toggle_label']; ?></button>
</div>
{{#if config.showComments}}
<div class="page-header">
<div class="pull-right">
<!-- An empty div which will be populated using jQuery -->
<div id='page_navigation' class="pagination pagination-small" ></div>
</div>
<h3><?php echo $config['main_header']; ?>
 <button id=sort class="btn btn-mini btn-link" data-sort="{{#if config.sortChrono}}true{{else}}false{{/if}}" >
	{{#if config.sortChrono}}<i class="icon-caret-up"></i>{{else}}<i class="icon-caret-down"></i>{{/if}}
</button>
</h3>
</div>
<div id="commentList">{{{commentList this}}}</div>
{{/if}}
</script>

<!-- template: list of comments and replies -->
<script type="text/x-handlebars-template" id="commentRenderTemplate">
{{#each comments}}
<div class=comment-wrap data-comment-id="{{id}}">
    <div class="reportReplyButtons btn-toolbar"><div class=btn-group>
        {{#if ../config.allowReplies}}<button class="reply btn btn-link btn-small"  data-comment-id="{{id}}"><i class="icon-comment"></i> <?php echo $config['reply_button']; ?></button>{{/if}}
        {{#if ../config.allowReports}}<button class="report btn btn-link btn-small" data-comment-id="{{id}}"><i class="icon-bullhorn"></i> <?php echo $config['report_button']; ?></button>{{/if}}
    </div></div>
    <div class=comment-avatar><img src={{avatar}} title="{{name}}" class="img-polaroid" width=30 height=30></div>
    <div class=comment-label>
    <div class=commenter>{{name}}
	    {{#if ../config.allowRating}}
    <span class=user-rating>
       {{#loop rating }}
       		<i class="icon-star"></i>
    	{{/loop}}
    </span>
    {{/if}}
    </div>
    </div>
    <div class=comment-date data-comment-timestamp="{{timestamp}}">{{postdate}}</div>
    {{#if ../config.allowComments}}
    <div class=comment>{{{comment}}}</div>
    {{#if followup}}
    <div class="followup">{{{followup}}}</div>
    {{/if}}
    {{/if}}
    {{#if ../config.allowReplies}}
    <div class=comment-replies>
        {{#each replies}}
        {{{reply this}}}
        {{/each}}
    </div>
    {{/if}}
</div>
{{else}}
<div><?php echo $config['no_results']; ?></div>
{{/each}}
</script>


<!-- template: comment reply -->
<script type="text/x-handlebars-template" id="replyTemplate">
<div class=reply-wrap>
    <div class=comment-wrap>
        <div class=comment-avatar><img src={{avatar}} title="{{name}}" class="img-polaroid" width=30 height=30></div>
        <div class=comment-label>
        <div class=commenter>{{name}}</div>
        </div>
        <div class=comment-date data-comment-timestamp="{{timestamp}}">{{postdate}}</div>
        <div class=comment>{{{comment}}}</div>
        {{#if followup}}
        <div class="followup">{{{followup}}}</div>
        {{/if}}
    </div>
</div>
</script>


<!-- template: form to add a new comment -->
<script type="text/x-handlebars-template" id="commentAddTemplate">
<form action="action.php" class="comment-form form-inline" method=post {{#if config.hideInitialCommentForm}}style="display:none"{{/if}}>
 <input type="hidden" name="url" class="parent-url" value="">
<h3><?php echo $config['add_comment_header']; ?></h3>
<div class=row>
{{#if config.canVote}}
	{{#if config.showComments}}
	<div class=span3>
		<div class="control-group">
		<label class="control-label"><?php echo $config['name_label']; ?></label>
			<div class="controls">
	        <input name=backsnap-name type=text autocomplete=off class="input-medium required" tabindex=1 >
			</div>
		</div>
	</div>
	{{/if}}
    {{#if config.showEmailInput}}
    <div class=span3>
	    <div class="control-group">
		<label class="control-label"><?php echo $config['email_label']; ?></label>
			<div class="controls">
	        <input name=backsnap-email type=text autocomplete=off class="email input-medium{{#if config.requireEmail}} required{{/if}}" tabindex=2 >
			</div>
	    </div>
    </div>
    {{/if}}
    {{#if config.allowRating}}
    <div class=span3>
	   <div class="control-group">
	   	<label class="control-label"><?php echo $config['rate_label']; ?></label>
		     <div class=controls> 
			     <div class="input-prepend">
				    &nbsp;<span class="add-on"><i class="icon-star-empty"></i></span>
			     	<span class="input-small uneditable-input rate-input" tabindex=3>
				     	<div class="rating">
					    <input type="radio" id="star5" class=rate name=backsnap-rating value="5" /><label for="star5"></label>
					    <input type="radio" id="star4" class=rate name=backsnap-rating value="4" /><label for="star4"></label>
					    <input type="radio" id="star3" class=rate name=backsnap-rating value="3" /><label for="star3"></label>
					    <input type="radio" id="star2" class=rate name=backsnap-rating value="2" /><label for="star2"></label>
					    <input type="radio" id="star1" class=rate name=backsnap-rating value="1" /><label for="star1"></label>
				     	</div>
			     	</span>
			     </div>
	    	</div>
	    </div>
    </div>
    {{/if}}
</div><!--row-->
    {{#if config.allowComments}}
     <div class="control-group">
	     <label class="control-label"><?php echo $config['comment_label']; ?></label>
	     <div class=controls>
		     <textarea name=backsnap-comment class="input-xxlarge required" tabindex=4></textarea>
	     </div>
    </div>
    {{/if}}

    {{#if config.captcha}}
        <div class="control-group">
        	<label class="control-label"><?php echo $captcha_question; ?></label>
            <div class="controls">
                <input type="text" class="input-xxlarge required" name="captcha_answer" id="captcha_answer" tabindex=5 required>
            </div>
        </div>
    {{/if}}
    <button id="cancelMainForm" class="btn <?php echo $config['button_size']; ?> <?php echo $config['secondary_button_style']; ?>" type=button><?php echo $config['cancel_button']; ?></button>
    <button class="btn <?php echo $config['button_size']; ?> <?php echo $config['primary_button_style']; ?>" type=submit><i class="icon-comment"></i> <?php echo $config['add_comment_button']; ?></button>
{{/if}}
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="page" value="<?php echo $id ?>" />
</form>
</script>


<!-- template: form to reply to a comment -->
<script type="text/x-handlebars-template" id="replyFormTemplate">
<div class="wrap">
    <form action="action.php" class=reply-form method=post data-comment-id="{{commentId}}">
        <input type=hidden name=postid value="{{commentId}}">
        <input type="hidden" name="url" class="parent-url" value="">
        <div class=row>
        <div class=span3>
	        <div class=control-group>
	        	<label class="control-label"><?php echo $config['name_label']; ?></label>
	        	<div class=controls>
	            	<input name=backsnap-name type=text autocomplete=off class="input-medium required">
	        	</div>
	        </div>
        </div>
        {{#if config.showEmailInput}}
        <div class=span3>
	        <div class=control-group>
	        	<label class="control-label"><?php echo $config['email_label']; ?></label>
	        	<div class=controls>
	            	<input name=backsnap-email type=text autocomplete=off class="email input-medium{{#if config.requireEmail}} required{{/if}}">
	        	</div>
	        </div>
        </div>
        {{/if}}
        </div><!--row-->
        <div class=control-group>
        	<label class="control-label"><?php echo $config['reply_label']; ?></label>
        	<div class=controls>
	        	<textarea name=backsnap-comment class="input-xxlarge required"></textarea>
        	</div>
        </div>
         {{#if config.captcha}}
	        <div class="control-group">
	        	<label class="control-label"><?php echo $captcha_question; ?></label>
	            <div class="controls">
	                <input type="text" name="captcha_answer" id="captcha_answer" size="30" class="input-xxlarge required" required>
	            </div>
	        </div>
	    {{/if}}
        <div class=commentButtons>
        	<button class="btn cancel <?php echo $config['button_size']; ?> <?php echo $config['secondary_button_style']; ?>" type=button><?php echo $config['cancel_button']; ?></button>
            <button class="btn <?php echo $config['button_size']; ?> <?php echo $config['primary_button_style']; ?>" type=submit><i class="icon-comment icon-white"></i> <?php echo $config['add_reply_button']; ?></button>
        </div>
        <input type="hidden" name="type" value="reply" />
        <input type="hidden" name="page" value="<?php echo $id ?>" />
    </form>
</div>
</script>

<!-- template: form to report a comment -->
<script type="text/x-handlebars-template" id="reportFormTemplate">
<div class=wrap>
    <form action="action.php" class=report-form method=post data-comment-id="{{id}}">
    <input type="hidden" name="url" class="parent-url" value="">
        <input type=hidden name=postid value="{{id}}">
        <div class=control-group>
	        <label class="control-label"><?php echo $config['report_label']; ?></label>
	        <div class="controls">
	            <textarea name=backsnap-report class="input-xxlarge required"></textarea>
	        </div>
        </div>
        {{#if config.captcha}}
	        <div class="control-group">
	        	<label class="control-label"><?php echo $captcha_question; ?></label>
	            <div class="controls">
	                <input type="text" name="captcha_answer" id="captcha_answer" class="input-xxlarge required" required>
	            </div>
	        </div>
	    {{/if}}
        <div class=commentButtons>
        	<button class="btn cancel <?php echo $config['button_size']; ?> <?php echo $config['secondary_button_style']; ?>" type=button><?php echo $config['cancel_button']; ?></button>
            <button class="btn <?php echo $config['button_size']; ?> <?php echo $config['primary_button_style']; ?>" type=submit><i class="icon-envelope icon-white"></i> <?php echo $config['send_report_button']; ?></button>
        </div>
        <input type="hidden" name="type" value="report" />
        <input type="hidden" name="page" value="<?php echo $id ?>" />
    </form>
</div>
</script>

<!-- template: comment/reply/report error -->
<script type="text/x-handlebars-template" id="submitErrorTemplate">
<div class="alert alert-error">
  <span class="close" data-dismiss="alert" href="#">&times;</span>
  <b><?php echo $config['error_header']; ?></b><br>
  {{msg}}
</div>
</script>


<!-- template: reported comment response -->
<script type="text/x-handlebars-template" id="reportedMessageTemplate">
<div class="alert alert-success">
<span class="close" data-dismiss="alert" href="#">&times;</span>
<b><?php echo $config['success_header']; ?></b><br>
{{msg}}
</div>
</script>

<!-- template: spinner -->
<script type="text/x-handlebars-template" id="spinnerTemplate">
<div class=modal><div class=modal-body>
<div class="progress progress-striped active">
  <div class="bar" style="width: 100%;"></div>
</div>
</div></div>
</script>

<!-- template: list of comments and replies -->
<script type="text/x-handlebars-template" id="starsTemplate">
</script>

<script type="text/data" id="comments">
{
    "config": {
        "hideInitialCommentForm": <?php echo $config['hide_form'] ?>,
        "averageRating": <?php echo $average_rating ?>,
        "canVote": <?php echo $can_vote ?>,
        "allowRating": <?php echo $config['allow_rating'] ?>,
        "allowComments": <?php echo $config['allow_comments'] ?>,
        "showComments": <?php echo $config['show_comments'] ?>,
        "allowReplies": <?php echo $config['allow_replies'] ?>,
        "allowReports": <?php echo $config['allow_reports'] ?>,
        "showEmailInput": <?php echo $config['show_email_input'] ?>,
        "requireEmail": <?php echo $config['require_email'] ?>,
        "sortChrono": <?php echo $config['sort_chrono'] ?>,
        "captcha": <?php echo $config['use_captcha'] ?>,
        "usePrettyDate": <?php echo $pretty_date ?>,
        "commentsPerPage": <?php echo $config['comments_per_page'] ?>
    },
    "comments": <?php echo json_encode($comments); ?>
}
</script>


<?php if(!$config['hide_admin_btn']): ?>
<a href="admin.php" target="_blank" class="btn btn-danger backsnap-admin"><i class="icon-key"></i> ADMIN LOGIN</a>
<?php endif; ?>
</body>
</html>