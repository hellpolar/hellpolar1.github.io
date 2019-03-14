
<?php if ( is_active_sidebar( 'before-content-sidebar-wrap' ) ) : ?>
	<div class="before-content-sidebar-wrap">
		<div class="wrap">
		    <?php dynamic_sidebar( 'before-content-sidebar-wrap' ); ?>
		</div>
	</div>
<?php endif; ?>
