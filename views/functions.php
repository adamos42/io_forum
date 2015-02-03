<div id="forum-form-create-forum" style="display: none;"> <?=$create_forum_form?> </div>
<div id="forum-form-create-topic" style="display: none;"> <?=$create_topic_form?> </div>
<div id="forum-form-create-post" style="display: none;"> <?=$create_post_form?> </div>

<script>
var Forum = new (function()
{
	var $private = {}; var $public = {}; var $this = {};

	// Creating public variables
	$public.id_forum = null;
	$public.request = null;
	
	// Checking the jquery library is exists
	if(typeof jQuery == "undefined") alert('jQuery is required for the Forum module, please implement the jquery script!');

	// Creating public functions
	$public.create = function($type)
	{
		console.log("Forum.create('"+$type+"') executed");
	};

	// Rerturning public functions
	console.log("Forum object created", $public);
	return $public;
});
</script>

<style>

.forum.button.edit, .topic.button.open,
.topic.button.edit, .reply.button.post {
	margin: 2px 4px; padding: 5px 10px;
	position: relative; top: -3px;
}

</style>

