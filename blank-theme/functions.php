<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'blank-theme', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

function add_google_fonts() {
	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap', false );
}

add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

//Secure Auth Options Pages
  
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

}

// Add Job Title to User Profile
add_action( 'show_user_profile', 'sa_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'sa_show_extra_profile_fields' );

function sa_show_extra_profile_fields( $user ) { ?>

	<h3>Extra information</h3>

	<table class="form-table">

		<tr>
			<th><label for="job_title">Job Title</label></th>

			<td>
				<input type="text" name="job_title" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Job Title.</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'sa_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'sa_save_extra_profile_fields' );

function sa_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'job_title' to the field ID. */
	update_usermeta( $user_id, 'job_title', $_POST['job_title'] );
}

function display_job_title() { 
	if ( get_the_author_meta( 'job_title' ) ) { ?>
			<span class="job_title">
				<?php the_author_meta( 'job_title' ); ?>
			</span>
		<?php } 
}


function add_social_share_buttons() {
	$url = esc_url(get_permalink());
	$title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
	$social_networks = array(
        'Facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
        'Twitter' => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
        'LinkedIn' => 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title,
        'Pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $url . '&description=' . $title,
    );
    $share_buttons = '<div class="social-share-wrap"><div class="social-share-buttons">';
	foreach ($social_networks as $network => $share_url) {
        $share_buttons .= '<a href="' . $share_url . '" target="_blank" rel="noopener">' . $network . '</a>';
    }
    $share_buttons .= '</div></div>';
    return $share_buttons;
}

// Add the social share buttons after the content
 add_filter('social_share_buttons', 'add_social_share_buttons');


/**
* Allow additional MIME types
*/

function add_upload_mimes( $types ) { 
	$types['json'] = 'text/plain';
	$types['lottie'] = 'application/lottie+zip'; // Adds .lottie extension for dotLottie files
	$types['application/lottie+zip'][0] = 'Lottie (dotLottie)';
	$types['svg'] = 'image/svg+xml';
	return $types;
}
add_filter( 'upload_mimes', 'add_upload_mimes' );

function fix_svg_preview($response, $attachment, $meta) {
    if ($response['mime'] === 'image/svg+xml') {
        $response['sizes'] = [
            'thumbnail' => [
                'url' => $response['url'],
                'width' => $response['width'],
                'height' => $response['height'],
            ],
        ];
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'fix_svg_preview', 10, 3);

add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
    ?>
    <style type="text/css">
        /* Admin CSS. */
        :root {
	        --bt-night: #06223B;
			--bt-night-rgb: 6,34,59;
			--bt-white: #FFFFFF;
			--bt-white-rgb: 255,255,255;
			--bt-sky: #2898FF;
			--bt-sky-rgb: 40, 152, 255;
			--bt-sky-dark: #0075E2;
			--bt-sky-dark-rgb: 0,117,226;
			--bt-sky-light: #6CB9FF;
			--bt-sky-light-rgb: 108, 185, 255;
			--bt-pear: #9EE345;
			--bt-pear-rgb: 158, 227, 69;
			--bt-pear-dark: #5DA400;
			--bt-pear-dark-rgb: 133, 183, 70;
			--bt-pear-light: #C1F87C;
			--bt-pear-light-rgb: 193, 248, 124;
			--bt-lemon: #FCDA27;
			--bt-lemon-rgb: 252, 218, 39;
			--bt-lemon-dark: #EEB628;
			--bt-lemon-dark-rgb: 238, 182, 40;
			--bt-lemon-light: #FFEB3C;
			--bt-lemon-light-rgb: 255, 235, 60;
			--bt-tangelo: #FC6727;
			--bt-tangelo-rgb: 252, 103, 39;
			--bt-tangelo-dark: #D45823;
			--bt-tangelo-dark-rgb: 212, 88, 36;
			--bt-tangelo-light: #FF823C;
			--bt-tangelo-light-rgb: 255, 130, 60;
			--bt-plum: #D48DFF;
			--bt-plum-rgb: 189, 81, 255;
			--bt-plum-dark: #9E47D3;
			--bt-plum-dark-rgb: 158, 71, 211;
			--bt-plum-light: #D48DFF;
			--bt-plum-light-rgb: 212, 141, 255;
			--bt-rose: #FF4466;
			--bt-rose-rgb: 255, 68, 102;
			--bt-rose-dark: #E03251;
			--bt-rose-dark-rgb: 224, 50, 81;
			--bt-rose-light: #FF5876;
			--bt-rose-light-rgb: 255, 88, 118;
			--bt-slate: #213D55;
			--bt-slate-rgb: 33, 61, 85;
			--bt-concrete: #909EAA;
			--bt-concrete-rgb: 144, 158, 170;
			--bt-cement: #BFC7CE;
			--bt-cement-rgb: 191, 199, 206;
			--bt-clay: #DCE0E4;
			--bt-clay-rgb: 220, 224, 228;
			--bt-chalk: #F6F7F8;
			--bt-chalk-rgb: 246, 247, 248;
			--light: var(--bt-white);
			--dark: var(--bt-slate);
			--bt-tag-event-bg-color: rgba(var(--bt-rose-light-rgb), 0.55);
			--bt-tag-video-bg-color: rgba(var(--bt-plum-light-rgb), 0.6);
			--bt-tag-webcast-bg-color: rgba(var(--bt-lemon-rgb), 0.6);
			--bt-tag-customer-story-bg-color: rgba(var(--bt-sky-light-rgb), 0.7);
			--bt-tag-report-bg-color: rgba(var(--bt-tangelo-light-rgb), 0.6);
			--bt-tag-article-bg-color: rgba(var(--bt-cement-rgb), 0.7);
			--bt-border-radius-small: 16px;
		  	--bt-border-radius: 24px;
		  	--bt-border-radius-inner: 23px;
		  	--bt-border-width: 1px;
		  	--bt-p-small: 14px;
		  	--bt-p-medium: 15px;
		  	--bt-p-large: 16px;
		  	--bt-p-xlarge: 18px;
		  	--bt-box-padding: 30px;
		  	--bt-box-padding-medium: 24px;
			--bt-transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1.5) !important;
			--bt-transition-secondary: all 0.4s ease-out !important;
			--bt-font-stack: 'Ubuntu', sans-serif;
			--bt-btn-font-size: 13px;
			--bt-fluid-calc-one: min(max(36px, calc(2.25rem + ((1vw - 3.2px) * 2.25))), 72px);
			--bt-fluid-calc-two: min(max(32px, calc(2rem + ((1vw - 3.2px) * 1.75))), 60px);
			--bt-fluid-calc-three: min(max(26px, calc(1.625rem + ((1vw - 3.2px) * 1.375))), 48px);
			--bt-fluid-calc-four: min(max(23px, calc(1.4375rem + ((1vw - 3.2px) * 0.8125))), 36px);
			--bt-fluid-calc-five: min(max(20px, calc(1.25rem + ((1vw - 3.2px) * 0.5))), 28px);
			--bt-fluid-calc-six: min(max(12px, calc(0.75rem + ((1vw - 3.2px) * 0.75))), 24px);
			--bt-fluid-calc-one-large: min(max(38px, calc(2.375rem + ((1vw - 3.2px) * 2.5))), 78px);
			--bt-platinum-gradient: linear-gradient(0deg, var(--bt-concrete) 0%, var(--bt-cement) 100%);
			--bt-gold-gradient: linear-gradient(0deg, var(--bt-lemon-dark) 0%, var(--bt-lemon) 100%);
			--bt-silver-gradient: linear-gradient(0deg, var(--bt-cement) 0%, var(--bt-clay) 100%);
			--bt-global-gradient: linear-gradient(0deg, var(--bt-sky-dark) 0%, var(--bt-pear-dark) 100%);
			--bt-hero-gradient: linear-gradient(148deg, rgba(40, 152, 255, 0.95) 0%, rgba(40, 152, 255, 0.80) 30.5%, rgba(193, 248, 124, 0.90) 100%);
			--bt-cap-gradient: linear-gradient(123deg, rgba(108, 185, 255, 0.70) 30.14%, #C1F87C 75.35%), #C1F87C !important;
			--bt-uc-gradient: linear-gradient(108deg, rgba(108, 185, 255, 0.60) 0.8%, #F5823C 100.15%), #FFF !important;
			--bt-sc-gradient: linear-gradient(123deg, rgba(108, 185, 255, 0.70) 30.14%, rgba(255, 235, 60, 0.90) 86.92%), #FFF !important;
			--bt-pear-sky_light-gradient: linear-gradient(123deg, rgba(193, 248, 124, 0.80) 30.14%, #96D8BF 59.58%, #6CB9FF 100.23%), #FFF !important;
			--bt-sky-pear_light-gradient: linear-gradient(117deg, #6CB9FF 24.46%, #96D8BF 57.39%, rgba(193, 248, 124, 0.80) 100.2%), #FFF;
			--bt-sky-sky_light-gradient: linear-gradient(92deg, #6CB9FF 0%, rgba(40, 152, 255, 0.90) 100%);
		}
		
    </style>
    <script type="text/javascript">
    (function( $ ){
        // Javascript here.
    })(jQuery);
    </script>
    <?php
}

