<script type="text/template" id="mscore-liteTemplateLibrary_templates">
	<div id="liteTemplateLibrary_toolbar">
		<div id="liteTemplateLibrary_toolbar-search">
			<label for="liteTemplateLibrary_search" class="elementor-screen-only"><?php esc_html_e('Search Templates:', 'mscore'); ?></label>
			<input id="liteTemplateLibrary_search" placeholder="<?php esc_attr_e('Search', 'mscore'); ?>">
			<i class="eicon-search"></i>
		</div>
		<div id="liteTemplateLibrary_toolbar-counter"></div>
		
		<div id="liteTemplateLibrary_toolbar-filter" class="liteTemplateLibrary_toolbar-filter">
			<# if (mscore.library.getTypeTags()) { var selectedTag = mscore.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="liteTemplateLibrary_filter-btn">{{{ mscore.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="liteTemplateLibrary_filter-btn"><?php esc_html_e('Filter', 'mscore'); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="liteTemplateLibrary_filter-tags" class="liteTemplateLibrary_filter-tags">
					<li data-tag="">All</li>
					<# _.each(mscore.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ mscore.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
	</div>

	<div class="liteTemplateLibrary_templates-window">
		<div id="liteTemplateLibrary_templates-list"></div>
	</div>
</script>