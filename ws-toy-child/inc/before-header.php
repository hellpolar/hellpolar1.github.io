<div class="before-header">
	<div class="wrap">
		<?php if ( is_active_sidebar( 'before-left-header' ) ) : ?>
			<div class="before-left-header">
				<?php dynamic_sidebar( 'before-left-header' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'before-center-header' ) ) : ?>
			<div class="before-center-header">
				<?php dynamic_sidebar( 'before-center-header' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'before-right-header' ) ) : ?>
			<div class="before-right-header">
				<?php dynamic_sidebar( 'before-right-header' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
