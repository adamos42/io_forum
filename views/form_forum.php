<form id="forum_form_forum" class="forum form" action="" onsubmit="return false;">
	<h4> <?=lang('forum_form')?> </h4>
	
	<div class="row">
		<div class="large-7 column">
			
			<div class="row">
				<div class="large-4 column">
				
					<label for="form_forum_title"> <?=lang('forum_title')?>: </label>
					
				</div>
				<div class="large-8 column">
				
					<input type="text" name="title" id="form_forum_title" min="3" value="" />
					
				</div>
			</div>
			
			<div class="row">
				<div class="large-4 column">
				
					<label for="form_forum_url"> <?=lang('forum_url')?>: </label>
					
				</div>
				<div class="large-8 column">
				
					<input type="text" name="url" id="form_forum_url" min="3" value="" />
					
				</div>
			</div>
			
			<div class="row">
				<div class="large-4 column">
				
					<label for="form_forum_preview"> <?=lang('forum_preview')?>: </label>
					
				</div>
				<div class="large-8 column">
				
					<input type="text" name="preview" id="form_forum_preview" min="3" value="" />
					
				</div>
			</div>
			
			<div class="row">
				<div class="large-4 column">
				
					<label for="form_forum_description"> <?=lang('forum_description')?>: </label>
					
				</div>
				<div class="large-8 column">
				
					<textarea id="form_forum_description" name="description" rows="4"></textarea>
					
				</div>
			</div>
			
			<div class="row">
				<div class="large-5 column">
					
					<label for="form_forum_parent"> <?=lang('forum_parent')?>: </label>
						
				</div>
				<div class="large-7 column">
					
					<select id="form_forum_parent" name="id_parent">
							
					</select>
						
				</div>
			</div>
			
		</div>
		<div class="large-5 column">		
			<div class="forum form options">
			
				
				
				<div class="row">
					<div class="large-7 column">
					
						<label for="form_forum_level_read"> <?=lang('forum_read_level')?>: </label>
						
					</div>
					<div class="large-5 column">
					
						<input type="number" name="level_read" id="form_forum_level_read" min="0" max="10000" value="10" />
						
					</div>
				</div>
				
				<div class="row">
					<div class="large-7 column">
					
						<label for="form_forum_level_open"> <?=lang('forum_topic_open_level')?>: </label>
						
					</div>
					<div class="large-5 column">
					
						<input type="number" name="level_open" id="form_forum_level_open" min="0" max="10000" value="100" />
						
					</div>
				</div>
				
				<div class="row">
					<div class="large-7 column">
					
						<label for="form_forum_level_write"> <?=lang('forum_write_level')?>: </label>
						
					</div>
					<div class="large-5 column">
					
						<input type="number" name="level_write" id="form_forum_level_write" min="0" max="10000" value="100" />
						
					</div>
				</div>
				
				<div class="row">
					<div class="large-7 column">
					
						<label for="form_forum_level_moderator"> <?=lang('forum_moderator_level')?>: </label>
						
					</div>
					<div class="large-5 column">
					
						<input type="number" name="level_moderator" id="form_forum_level_moderator" min="0" max="10000" value="1000" />
						
					</div>
				</div>
				
			</div>		
		</div>
	</div>
	
	<div class="row">
		<div class="large-3 column right">
			
			<button class="tiny"> <?=lang('save')?> </button>
			<button class="tiny secondary" onclick="Forum.forum_form.slideUp();"> <?=lang('cancel')?> </button>
			
		</div>
	</div>
	<div class="clearfix"></div>

</form>