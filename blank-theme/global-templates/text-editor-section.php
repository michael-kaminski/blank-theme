<?php
/**
 * ACF: Flexible Content > Layouts > Text Editor Section
 *
 */

//include options vars
include 'section-options.php'; 
//add to $classList
$classList .= ' text_editor_section';
//Content Fields
$text_editor = $args['text_editor'];

?>
<div id="<?php echo $the_id;?>" <?php sectionClasses($inlineClasses); ?> <?php inlineStyles($inlineStyles); ?>>
	<div class="kk_wrapper">
		<div class="<?php echo esc_attr( $container ); ?>">
			<?php echo $text_editor;?>
		</div><!--/.container-->
	</div><!--/.kk_wrapper-->
</div><!--/#<?php echo $the_id;?>-->