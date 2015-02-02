<div id="maincolumn" class="forum">
 
    <h2 class="main forum">
      <?php echo lang('module_forum_title'); ?>
      
      <div style="float: right">
      
         <span class="forum-version"> v<?=$config['version']?> </span>
      
         <a href="https://github.com/adamos42/io_forum" target="_blank">
            <span class="github-icon"></span>
         </a>
      </div>
    </h2>
    
    <!-- Tabs -->
	 <div id="forumTab" class="mainTabs">
		<ul class="tab-menu">
			<li><a><?php echo lang('module_forum_overview'); ?></a></li>
			<li><a><?php echo lang('module_forum_settings'); ?></a></li>
		</ul>
		<div class="clear"></div>
	 </div>
    
    <div id="forumTabContent">

		<!-- Theme views -->
		<div class="tabcontent">
		
		</div>
		
		<div class="tabcontent">
		
		</div>
		
   </div>
    
</div>
 
<script type="text/javascript">
 
    // Init the panel toolbox is mandatory
    ION.initToolbox('empty_toolbox');
    
    // Tabs
	new TabSwapper({tabsContainer: 'forumTab', sectionsContainer: 'forumTabContent', selectedClass: 'selected', deselectedClass: '', tabs: 'li', clickers: 'li a', sections: 'div.tabcontent', cookieName: 'forumTab' });
 
</script>
