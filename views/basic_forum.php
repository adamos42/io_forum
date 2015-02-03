<ion:forum tag="section" id="forum" class="forum-container">

	<ion:toolbar class="forum-toolbar right" tag="div" buttons_class="tiny" />	
	<div class="clearfix"></div>
	
	<ion:breadcrumb class="forum-breadcrumb" tag="div" home="true" home_icon="home" separator="/" topic="true" />

	<ion:forums tag="div">
	
		<h4 class="forum title">
			<ion:title />
			<ion:open_topic />
			<ion:edit_forum />
		</h4>

		<table class="forum topics" width="100%" border="0" cellpadding="0" cellspacing="2">
			<thead>
				<th align="center" width="32">&nbsp;</th>
				<th><ion:lang key="topic_title" /></th>
				<th align="center" width="128"><ion:lang key="topic_posts" /></th>
				<th align="center" width="32"><ion:lang key="topic_last_post" /></th>
			</thead>
			<tbody>
				<ion:topics>
					<tr>
						<td align="center">&nbsp;</td>
						<td><a href="<ion:link  />"> <ion:title /> </a></td>
						<td align="center"><ion:posts /></td>
						<td align="center"><ion:last_posted /></td>
					</tr>
				</ion:topics>

				<ion:empty>
					<tr>
						<td colspan="4" align="center">
							<div style="padding: 30px 120px;">
								<ion:lang key="no_topics_in_this_forum" tag="div" class="alert-box" />
							</div>
						</td>
					</tr>
				</ion:empty>
			</tbody>
		</table>
	</ion:forums>	
	
	<ion:topic tag="div">
	
		<h4 class="topic title">
			<ion:title />
			<ion:edit_topic />
			<ion:post_reply />
		</h4>
		
		<table class="forum posts" width="100%" border="0" cellpadding="0" cellspacing="2">
		<ion:posts>
			<ion:post>
			<tr id="post<ion:id/>" class="post">
				<td class="post info">			
					<ion:id tag="div" class="id" pattern="#{id}" />
									
					<ion:poster tag="div" class="poster">
						<ion:screen_name tag="span" class="name" />				
						<ion:role_name tag="span" class="role" />
						<ion:avatar tag="span" class="avatar" />
						
						<ion:registered tag="span" class="registered" label="registered" />
						<ion:post_count tag="span" class="post_count" label="forum_posts" />
					</ion:poster>
					
					<ion:posted tag="div" class="posted" />
					
				</td>
				<td class="post content">			
					<ion:posted tag="div" class="posted" format="Y.m.d H:i" />
					
					<ion:content tag="div" class="content" />
					
					<ion:edited tag="div" class="edited">
						<ion:editor tag="span" class="editor" label="forum_editor" />
						<ion:time tag="span" class="time" label="forum_edited" format="Y.m.d H:i" />
					</ion:edited>
				</td>
			</tr>
			</ion:post>
		</ion:posts>
		</table>
		
	</ion:topic>

	<div class="row">
		<div class="large-12 column" style="font-size: 60%; text-align: right;">
			<ion:lang key="forum_version" />: <ion:version /> &nbsp;
		</div>
	</div>
</ion:forum>