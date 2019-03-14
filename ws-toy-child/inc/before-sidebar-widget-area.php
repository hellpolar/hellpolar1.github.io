<?php if ( is_active_sidebar( 'before-sidebar-widget-area' ) ) : ?>
	<div class="before-sidebar-widget-area">
		<div class="wrap">
		    <?php dynamic_sidebar( 'before-sidebar-widget-area' ); ?>
		</div>
	</div>
<?php endif; ?>
