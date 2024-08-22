<?php
/**
 * Template Name: Flexible Content
 *
 * Template for displaying all elements.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$wrapper_id = 'flex-content';

?>

<div class="" id="<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?>">
	<div class="page_frame">
		<?php
			echo '<!-- ';
			var_dump(get_field('sections'));
			echo ' -->';
		?>
		<!-- FLEX CONTENT : START -->	
		<?php 
			 // ACF - Flex Fields
		    $sections = get_field( 'sections' );
		    function sectionClasses($inlineClasses) {
			   	echo $inlineClasses;
			}
			function inlineStyles($inlineStyles) {
				echo $inlineStyles;
			}
		    if ( $sections ) :
		        foreach ( $sections as $section ) :
		            $template = str_replace( '_', '-', $section['acf_fc_layout'] );
		            get_template_part( 'global-templates/' . $template, '', $section );
		        endforeach;
		    endif;
		?>

		<!-- Modal -->
		<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>        
						<!-- 16:9 aspect ratio -->
						<div style="padding:56.25% 0 0 0;position:relative;" class="embed-responsive-wrap">
							<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" ></iframe>
						</div>
					</div>
				</div>
			</div>
		</div> 
	
		<!-- FLEX CONTENT : END -->	
		
	</div><!-- .page_frame -->

</div><!-- #<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?> -->
<?php
get_footer();
