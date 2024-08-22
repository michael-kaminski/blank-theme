<?php
/**
 * ACF: Flexible Content > Layouts > Template Section
 *
 */


//include options vars
include 'section-options.php'; 

//add to $classList
$classList .= ' button_section';

//Content Vars
$button_group = $args['button_group'];
$section_alignment = $button_group['section_alignment'];
$buttons = $button_group['button'];//repeater
?>

<div id="<?php echo $the_id;?>" <?php sectionClasses($inlineClasses); ?> <?php inlineStyles($inlineStyles); ?>>
	<div class="bt_wrapper">
		<div class="<?php echo esc_attr( $container ); ?>">
			<?php if( $buttons ) : ?>
				<!-- cta -->
				<div class="cta_frame  <?php echo esc_attr( $section_alignment ); ?>">
				<?php foreach( $buttons as $button ) :
					$cta_type = $button['cta_type'];
					$cta_video = $button['cta_video'];
					$cta = $button['cta'];
					$cta_url = $cta['url'];
					$cta_title = $cta['title'];
					$cta_target = $cta['target'] ? $cta['target'] : '_self'; ?>  		
					<a class="<?php 
						if( $cta_type == 'btn-primary' ) : echo 'btn btn-primary'; endif;
						if( $cta_type == 'btn-secondary' ) : echo 'btn btn-secondary'; endif;
						if( $cta_type == 'btn-outline-light' ) : echo 'btn btn-outline-light'; endif;
						if( $cta_type == 'btn-outline-dark' ) : echo 'btn btn-outline-dark'; endif;
						if( $cta_type == 'text-link' ) : echo 'link_arrow'; endif; 
						if( $cta_video == 'yes' ) : echo ' video_trigger'; endif; ?>" 
						href="<?php echo esc_url( $cta_url ); ?>" 
						target="<?php echo esc_attr( $cta_target ); ?>"
						title="<?php echo esc_html( $cta_title ); ?>"
						data-bs-toggle="<?php if( $cta_video == 'yes' ) : echo 'modal'; endif; ?>" 
						data-bs-target="<?php if( $cta_video == 'yes' ) : echo '#navbox_videoModal'; endif;?>" 
						data-src="<?php if( $cta_video == 'yes' ) : echo esc_url( $cta_url ); endif; ?>">
							<?php echo esc_html( $cta_title ); ?>
					</a>
				<?php endforeach; ?>
				</div>
			<?php endif ?>
		</div><!--/.container-->
	</div><!--/.kk_wrapper-->
</div><!--/#<?php echo $the_id;?>-->