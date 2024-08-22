<?php
/**
 * ACF: Flexible Content > Layouts > Content Section
 *
 */

//include options vars
include 'section-options.php'; 

//add to $classList
$classList .= ' content_section';

//Content
$enable_headline = $args['section_headline']['enable_section_headline'];
$headline = $args['section_headline']['headline'];
$custom_post_group = $args['custom_post_group'];
$layout_class = $custom_post_group['layout_class'];
$custom_posts = $custom_post_group['custom_post_repeater'];

?>
<div id="<?php echo $the_id;?>" <?php sectionClasses($inlineClasses); ?> <?php inlineStyles($inlineStyles); ?>>

	<?php if( $enable_headline == 'yes' ) : ?>
	<div class="<?php echo esc_attr( $container ); ?> text-center">
		<h3><?php echo $headline; ?></h3>
	</div>
	<?php endif; ?>

	<?php if( $custom_posts ) : ?>
    <div class="<?php echo esc_attr( $container ); ?>">
    	<div class="row row-cols-sm-1 <?php echo esc_attr( $layout_class ); ?> card-row">
		<?php foreach( $custom_posts as $custom_post ) :
				$pdg = $custom_post['post_details_group'];
				$cp_img = $pdg['custom_post_image'];
				$cpc = $pdg['custom_post_content'];
				$cp_title = $cpc['custom_post_title'];
				$cp_link = $cpc['post_link']['custom_post_link'];
				$cp_link_text = $cpc['post_link']['custom_post_link_text'];
				$cp_link_target = $cpc['post_link']['open_in_new_tab'];
				$cp_tag = $cpc['post_tag_group']['custom_post_tag'];
				$cp_tag_color = $cpc['post_tag_group']['tag_color_group']['custom_post_tag_color'];
				
				$enable_industry_tag = $cpc['industry_tag_group']['enable_industry_tag'];
				$cp_industry = $cpc['industry_tag_group']['custom_post_industry'];
				$cp_industry_name = '';
				if ( $cp_industry == 'energy-utilities' ) :  $cp_industry_name = 'Energy &amp; Utilities';
				elseif ( $cp_industry == 'financial-services' ) : $cp_industry_name = 'Financial Services';
				elseif ( $cp_industry == 'healthcare' ) : $cp_industry_name = 'Healthcare';
				elseif ( $cp_industry == 'public-sector' ) : $cp_industry_name = 'Public Sector';
				elseif ( $cp_industry == 'retail' ) : $cp_industry_name = 'Retail';
				else : //no match
				endif; ?>
			<?php if( $custom_post ): ?>
			<!-- Custom Featured Post : START -->
			<div class="col">
				<div class="card h-100 mini_card">
					<div style="background-image: url(<?php echo esc_url( $cp_img ); ?>);" class="card-img-top mini_card_image" alt=""></div>
					<div class="card-body">
						<div class="mini_card_info">
							<div class="flags">
								<?php if( $cp_tag ) : ?>
									<span class="badge <?php echo $cp_tag_color; ?>"><?php echo $cp_tag; ?></span>
								<?php endif;?>
								<?php if( $enable_industry_tag == 'yes' ) : ?>
									<span class="badge sa-bg-color-night sa-color-white"><?php echo $cp_industry_name; ?></span>
								<?php endif; ?>
							</div>
							<?php if( $cp_title ) : ?>
								<div class="mini_card_title">
									<h5><?php echo  $cp_title; ?></h5>
								</div> 
							<?php endif; ?>
						</div>
						<div class="mini_card_link">
							<?php if( $cp_link ) : ?>
								<a class="card-link link_arrow" target="<?php echo $cp_link_target; ?>" href="<?php echo esc_url( $cp_link ) ?>"><?php echo  $cp_link_text; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Custom Featured Post : END -->
			<?php endif; ?>
		<?php endforeach; ?>
		
		</div><!-- /.card-row -->
	</div><!-- /$container -->
	<?php endif; ?>

</div><!-- /.sa_wrapper -->
