<div id="forum-form-forum" style="display: none;"> <?=$forum_form?> </div>
<div id="forum-form-topic" style="display: none;"> <?=$topic_form?> </div>
<div id="forum-form-post" style="display: none;"> <?=$post_form?> </div>

<script>
var Forum = new (function()
{
	var $private = {}; var $public = {}; var $this = {};

	// Creating public variables
	$public.id_forum = null;
	$public.request = null;

	$public.forum_form = $("#forum-form-forum");
	$public.topic_form = $("#forum-form-topic");
	$public.post_form = $("#forum-form-post");
	
	// Checking the jquery library is exists
	if(typeof jQuery == "undefined") alert('jQuery is required for the Forum module, please implement the jquery script!');

	// Creating public functions
	$public.create = function($type)
	{
		console.log("Forum.create('"+$type+"') executed");
		switch($type) {
		case "forum":

			$public.forum_form.slideDown();
			
			break;
		}
	};

	// Rerturning public functions
	console.log("Forum object created", $public);
	return $public;
});
</script>

<style>

.forum.button.create, .forum.button.edit, .topic.button.open,
.topic.button.edit, .reply.button.post {
	margin: 2px 4px; padding: 5px 10px;
	position: relative; top: -3px;
}

.forum.posts {
	margin-top: 30px;
}

.forum.posts td {
	padding: 3px 8px;
}

.forum.posts .post.info, .forum.form.options {
	background: #eee;
}

.forum.form.options {
	border: 1px solid #ddd;
}

.forum.form.options {
	padding: 20px;
}

form.forum.form {
	padding: 20px; border: 1px dashed #ccc; background: #fafafa;
}

form.forum.form h4 {
	margin-bottom: 30px;
}

form.forum.form input, form.forum.form textarea {
	margin: 2px; padding: 4px 6px;
}

form.forum.form textarea {
	resize: none;
}

form.forum.form label {
	line-height: 37px;
}

</style>

