<?php
namespace Selectrum;

class Theme
{
    private static ?self $instance = null;

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    final private function __construct()
    {
        add_action('init', [$this, 'reset_wordpress']);
        add_action('after_setup_theme', [$this, 'setup_theme']);
        add_action('wp_head', [$this, 'add_fonts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 100);
        add_action('init', [$this, 'config_acf']);
        add_action('init', [$this, 'config_emails']);
        add_action('init', [$this, 'add_svg_support']);
        add_action('wp_loaded', [$this, 'config_session']);
        add_filter( 'auth_cookie_expiration', [$this, 'auth_cookie_expiration'] );
	    add_action( 'wp_ajax_newsletter_form', [$this, 'ajax_newsletter_form'] );
	    add_action( 'wp_ajax_nopriv_newsletter_form', [$this, 'ajax_newsletter_form'] );
    }

    final public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    final public static function init(): void
    {
        self::getInstance();
    }

    public function reset_wordpress(): void
    {
        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

        add_action( 'wp_enqueue_scripts', function() {
            wp_dequeue_style( 'classic-theme-styles' );
        }, 20 );

        add_action( 'wp_print_styles', function () {
            wp_dequeue_style( 'wp-block-library' );
        }, 100 );

        // Disable REST API link tag
        remove_action('wp_head', 'rest_output_link_wp_head');

        // Disable oEmbed Discovery Links
        remove_action('wp_head', 'wp_oembed_add_discovery_links');

        // Disable REST API link in HTTP headers
        remove_action('template_redirect', 'rest_output_link_header', 11);

        //Remove inline css of the wordpress admin bar
        add_action('admin_bar_init', function () {
            remove_action('wp_head', '_admin_bar_bump_cb');
        });

        //Remove Emoji
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        //Hide Admin Bar
        add_filter('show_admin_bar', '__return_false');

	    add_filter("mce_css", "__return_false");
    }

    public function setup_theme(): void
    {
        // Make theme available for translation
        load_theme_textdomain('selectrum', get_template_directory() . '/languages');

        // Register wp_nav_menu() menus
        register_nav_menus(array(
            'primary_menu' => __('Primary Navigation', 'selectrum'),
            //'secondary_menu' => __('Secondary Navigation', 'selectrum'),
            //'footer_menu' => __('Footer Navigation', 'selectrum')
        ));

        // Add post thumbnails
        // http://codex.wordpress.org/Post_Thumbnails
        // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
        // http://codex.wordpress.org/Function_Reference/add_image_size
        //add_theme_support('post-thumbnails');

        // Add post formats
        // http://codex.wordpress.org/Post_Formats
        //add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

        // Add HTML5 markup for captions
        // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
        add_theme_support('html5', ['script', 'style']);

        // Tell the TinyMCE editor to use a custom stylesheet
        add_editor_style('/assets/css/editor-style.css');

        /*
         * Custom Sizes of Images
         */
        //add_image_size( 'employer_thumb1', 440, 510, true );
    }

    public function add_fonts(): void
    {
        $fonts = array(
            //'family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800',
            //'family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900',
            //'family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
            //'family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
            //'family=Oswald:wght@200;300;400;500;600;700',
            //'family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
            //'family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
            //'family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
            //'family=Lexend:wght@100..900'
	        'family=Manrope:wght@200..800'
        );
        if ( !empty( $fonts ) ) :
            echo '
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?'.implode('&', $fonts).'&display=swap" rel="stylesheet">';
        endif;
    }

    public function enqueue_scripts(): void
    {
        $css_uri = '/assets/css/';
        $js_uri = '/assets/js/';
        $vendor_uri = '/assets/vendor/';
        $css_url = get_template_directory_uri() . $css_uri;
        $js_url = get_template_directory_uri() . $js_uri;
        $css_path = get_template_directory() . $css_uri;
        $js_path = get_template_directory() . $js_uri;
        $vendor_url = get_template_directory_uri() . $vendor_uri;

        // STYLESHEETS
        //wp_enqueue_style('owl-carousel', $vendor_url . '/owl.carousel-2.3.4/assets/owl.carousel.min.css', false, null);
        wp_enqueue_style('fancybox', $vendor_url . '/fancybox-3.5.7/jquery.fancybox.min.css', false, null);
        //wp_enqueue_style('perfect-scrollbar', $vendor_url . '/perfect-scrollbar-1.5.5/perfect-scrollbar.min.css', false, null);
        //wp_enqueue_style('videojs', '//vjs.zencdn.net/5.11.6/video-js.css', false, null);
        //wp_enqueue_style('animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false, null);
        //wp_enqueue_style('select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false, null);
        wp_enqueue_style('tiny-slider', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css', false, null);
        wp_enqueue_style('aos', '//unpkg.com/aos@next/dist/aos.css', false, null);
        //wp_enqueue_style('daterangepicker', '//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css', false, null);
        //wp_enqueue_style('datatables', '//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css', false, null);
        //wp_enqueue_style('datatables-responsive', '//cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css', false, null);
        //wp_enqueue_style('lenis', '//unpkg.com/lenis@1.3.8/dist/lenis.css', false, null);

        wp_enqueue_style('styles', $css_url . 'styles.css', [], filemtime( $css_path . 'styles.css' ), null);
        wp_enqueue_style('changes', $css_url . 'changes.css', [], filemtime( $css_path . 'changes.css' ), null);

        //SCRIPTS
        if ( is_single() && comments_open() && get_option('thread_comments') ) {
            wp_enqueue_script('comment-reply');
        }

        //wp_enqueue_script("jquery-effects-core");
        //wp_enqueue_script("jquery-ui-widget");
        wp_enqueue_script('jquery-ui-tabs');
        //wp_enqueue_script('jquery-ui-tooltip');
        wp_enqueue_script('jquery-ui-accordion');
        //wp_enqueue_script('jquery-ui-datepicker');
        //wp_enqueue_script('jquery-ui-slider');
        //wp_enqueue_script('jquery-touch-punch');

        //wp_enqueue_script('owl-carousel', $vendor_url . '/owl.carousel-2.3.4/owl.carousel.min.js', array('jquery'), null, true);
        wp_enqueue_script('fancybox', $vendor_url . '/fancybox-3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
        //wp_enqueue_script('jquery-validation', '//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js', array('jquery'), null, false);
        //wp_enqueue_script('jquery-validation-additional-methods', '//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js', array('jquery-validation'), null, false);
        //wp_enqueue_script('jquery-validation-messages-fr', '//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/localization/messages_fr.min.js', array('jquery-validation'), null, false);
        //wp_enqueue_script('filestyle', $vendor_url . '/jquery-filestyle-2.1.0/jquery-filestyle.min.js', array('jquery'), null, true);
        //wp_enqueue_script('masonry', '//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), null, true);
        wp_enqueue_script('isotope', '//unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'), null, true);
        //wp_enqueue_script('imagesloaded', '//unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js', array('jquery'), null, true);
        //wp_enqueue_script('perfect-scrollbar', $vendor_url . '/perfect-scrollbar-1.5.5/js/perfect-scrollbar.min.js', array(), null, true);
        //wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key='.GOOGLE_MAPS_API_KEY, array(), null, false);
        //wp_enqueue_script('google-maps-infobox', $vendor_url . '/googlemaps/infobox.min.js', array('google-maps'), null, false);
        //wp_enqueue_script('google-maps-markerwithlabel', $vendor_url . '/googlemaps/markerwithlabel_packed.js', array('google-maps'), null, false);
        //wp_enqueue_script('youtube-player-api', '//www.youtube.com/player_api', array(), null, true);
        //wp_enqueue_script('select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array(), null, true);
        wp_enqueue_script('tiny-slider', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', array(), null, true);
        wp_enqueue_script('aos', '//unpkg.com/aos@next/dist/aos.js', array(), null, true);
        //wp_enqueue_script('cookie', '//cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js', array(), null, true);
        //wp_enqueue_script('match-height', $vendor_url . '/jquery.matchHeight.js', array('jquery'), null, true);
        //wp_enqueue_script('smooth-scrollbar', '//cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.8.4/smooth-scrollbar.min.js', ['jquery'], null, true);
        //wp_enqueue_script('moment', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js', ['jquery'], null, true);
        //wp_enqueue_script('daterangepicker', '//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', ['moment'], null, true);
        //wp_enqueue_script('dropzone-pkg', '//unpkg.com/dropzone@5/dist/min/dropzone.min.js', [], null, true);
        //wp_enqueue_script('datatables', '//cdn.datatables.net/2.3.1/js/dataTables.min.js', array('jquery'), null, true);
        //wp_enqueue_script('datatables-buttons', '//cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js', ['datatables'], null, true);
        //wp_enqueue_script('datatables-buttons-styling', '//cdn.datatables.net/buttons/3.2.3/js/buttons.dataTables.js', ['datatables'], null, true);
        //wp_enqueue_script('datatables-buttons-html5', '//cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js', ['datatables'], null, true);
        //wp_enqueue_script('datatables-responsive', '//cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js', ['datatables'], null, true);
        //wp_enqueue_script('datatables-responsive-styling', '//cdn.datatables.net/responsive/3.0.4/js/responsive.dataTables.js', ['datatables'], null, true);
        //wp_enqueue_script('datatables-select', '//cdn.datatables.net/select/3.0.1/js/dataTables.select.js', ['datatables'], null, true);
        //wp_enqueue_script('select-datatables', '//cdn.datatables.net/select/3.0.1/js/select.dataTables.js', ['datatables'], null, true);
        //wp_enqueue_script('lenis', '//unpkg.com/lenis@1.3.8/dist/lenis.min.js', [], null, true);

	    wp_enqueue_script('scripts', $js_url . 'scripts.js', [], filemtime( $js_path . 'scripts.js' ), true);
        wp_localize_script('scripts', 'selectrum', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'ajax_nonce' => wp_create_nonce('ajax_nonce'),
            'theme_uri' => get_stylesheet_directory_uri(),
            'default_error_message' => __('An error occurred. Please try again later.', 'selectrum'),
        ]);
    }

    public function config_acf(): void
    {
        /**
         * Add Google Maps API Key to ACF
         */
        if (defined('GOOGLE_MAPS_API_KEY')) {
            add_action('acf/init', static function () {
                acf_update_setting('google_api_key', GOOGLE_MAPS_API_KEY);
            });
        }


        /**
         * Enable ACF Pro Options Admin Page
         */
        if ( function_exists('acf_add_options_page') ) {
            acf_add_options_page();
        }
    }

    public function config_emails(): void
    {
        //Change default mail content type to HTML
        add_filter( 'wp_mail_content_type', static function () {
            return "text/html";
        });

        add_filter( 'wpcf7_mail_components', static function( $components ) {
            $components['body'] = apply_filters( 'the_content', $components['body'] );
            return $components;
        });
    }

    public function config_session(): void
    {
        add_action('init', static function () {
            if(!session_id()) {
                session_start();
            }
        }, 1);

        add_action('wp_logout', static function () {
            session_destroy();
            wp_redirect( home_url() );
            exit();
        });
    }

    public function add_svg_support(): void
    {
        // Allow SVG
        add_filter( 'wp_check_filetype_and_ext', static function($data, $file, $filename, $mimes) {

            global $wp_version;
            if ( $wp_version !== '4.7.1' ) {
                return $data;
            }

            $filetype = wp_check_filetype( $filename, $mimes );

            return [
                'ext'             => $filetype['ext'],
                'type'            => $filetype['type'],
                'proper_filename' => $data['proper_filename']
            ];

        }, 10, 4 );


        add_filter( 'upload_mimes', static function ( $mimes ){
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        } );
    }

	public function auth_cookie_expiration(): int {
		return 1209600; // 2 weeks in seconds
	}

	public function ajax_newsletter_form(): void {
		try {
			//$full_name = isset( $_POST['full_name'] ) ? $_POST['full_name'] : false;
			$email  = isset( $_POST['email'] ) ? $_POST['email'] : false;

			if ( empty( $email ) ) {
				throw new Exception( __( 'Please enter your email.', 'selectrum' ) );
			}

			/*
			$MailChimp = new \DrewM\MailChimp\MailChimp(MAILCHIMP_API_KEY);
			$subscriber_hash = $MailChimp->subscriberHash($email);
			$result = $MailChimp->get("lists/".MAILCHIMP_LIST_ID."/members/".$subscriber_hash);
			//error_log( print_r( $result, true ) );
			switch ($result['status'] ) :
				case '404':
					$MailChimp->post("lists/".MAILCHIMP_LIST_ID."/members", [
						'email_address' => $email,
						'status'        => 'subscribed',
						'tags'          => $_POST['tags'],
						'merge_fields'  => array(
							'FNAME' => $_POST['fullName'],
							'MMERGE4' => $_POST['phone']
						)
					]);
					//$message = __('Please check your email for confirmation.', 'selectrum');
					break;
				case 'subscribed':
					$tags = array();
					foreach ( $_POST['tags'] as $tag ) :
						$tags[] = array(
							'name' => $tag,
							'status' => 'active'
						);
					endforeach;
					$MailChimp->post("lists/".MAILCHIMP_LIST_ID."/members/".$subscriber_hash."/tags", [
						'tags' => $tags,
					]);
					break;
			endswitch;

			//error_log( print_r($MailChimp->getLastResponse(), true) );

			if ( !$MailChimp->success() ) :
				$response = $MailChimp->getLastResponse();
				$response_body = json_decode( $response['body'] );
				switch ( $response_body->title ) :
					case 'Member Exists':
						$message = __('You are subscribed already, thank you!', 'selectrum');
						break;
					case 'Invalid Resource':
						$message = __('Entered email looks fake or invalid, please enter a real email address.', 'selectrum');
						break;
					default:
						$message = __('Something went wrong. Please contact us and describe your problem.', 'selectrum');
						break;
				endswitch;
				throw new Exception( $message );
			endif;
			*/

			$message = __('This is to notify you that a new user has registered for the newsletter.', 'selectrum').'<br>';
			$message .= '<br>';
			//$message .= __('Name:', 'selectrum').' '.$full_name.'<br>';
			$message .= __('Email:', 'selectrum').' '.$email.'<br>';

			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
			if ( !wp_mail( get_option('admin_email'), __('Newsletter Registration Notification', 'selectrum'), $message, $headers) ) {
				throw new Exception( __('Something went wrong. Please contact us and describe your problem.', 'selectrum') );
			}

			$response['content'] = __('Your subscription to our newsletter has been successfully received; thank you for your interest.', 'selectrum');
			wp_send_json_success($response);
		} catch ( Exception $e ) {
			wp_send_json_error(['content'=>$e->getMessage()]);
		}
	}
}