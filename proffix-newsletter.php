<?php
/**
 * @link              https://www.pitw.ch
 * @since             1.0
 * @package           E-Newsletter Plugin für PROFFIX
 *
 * @wordpress-plugin
 * Plugin Name:       E-Newsletter Plugin für PROFFIX
 * Plugin URI:        https://www.pitw.ch
 * Description:       Plugin für die Nutzung des PROFFIX E-Newsletters in Wordpress
 * Version:           1.0.1
 * Author:            Pedrett IT+Web AG
 * Author URI:        https://www.pitw.ch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       proffixnewsletter
 * Domain Path:       /languages
 */

require('class_enewsletter.php');

if(!class_exists('proffixNewsletter')) {

class proffixNewsletter {

    public function __construct()
    {
        add_action( 'admin_menu', array(&$this,'settings'));
        add_action( 'wp_enqueue_scripts', array(&$this,'scripts' ));
        add_action( 'admin_print_styles', array(&$this,'admin_styles' ));


        if(isset($_POST['proffixnewsletter']))
        {
            add_action('after_setup_theme', array(&$this, 'generateForm'));
        }



        add_shortcode('proffixnewsletter', array(&$this,'generateForm'));
    }


    /** Render Submenu */
    public function settings()
    {
        add_options_page( '', 'PROFFIX E-Newsletter', 'manage_options', 'proffixnewsletter-admin', array( &$this, 'settings_page' ) );
    }

    /** Enqueue Scripts on site */

    public function scripts()
    {
        wp_enqueue_script( 'proffixnewsletter', plugins_url('js/widget.js', __FILE__), array('jquery'));
    }

    /** Enque Admin Styles on site */

    public function admin_styles()
    {
        wp_enqueue_style( 'proffixnewsletter', plugins_url('css/widget_settings.css', __FILE__));

    }

    public function settings_page()
    {
        if (!empty($_POST)) {
            foreach ($_POST as $name => $value) {
                if ($name == 'proffix_newsletter_default_url' && !filter_var($value, FILTER_VALIDATE_URL)) {
                    add_settings_error('proffix_newsletter_default_url', 'proffix_newsletter_default_url',
                        'Sind Sie sicher, dass die URL korrekt ist?'
                    );
                }

                $value = sanitize_text_field($value);
                update_option($name, $value);

            }

            add_settings_error(
                'newsletterSaveSettings',
                esc_attr('settings_updated'),
                'Konfiguration aktualisiert',
                'updated'
            );
        }

        include('views/admin_settings.php');
    }

    /** Create Form */
    public function generateForm( $attr )
    {
        $enewsletter = new controllerENewsletter();



        $errors = array();

        $attr = shortcode_atts(
            array(
                'url' => get_option("proffix_newsletter_default_url"),
                'db' => get_option("proffix_newsletter_default_db"),
                'list' => get_option("proffix_newsletter_default_list")
            ), $attr, 'proffixnewsletter'
        );

        if(isset($_POST['proffixnewsletter']) )
        {
            $enewsletter->insert($_POST['proffixnewsletter']);
            $errors = $enewsletter->errors;
            $this->ajaxResponse($errors, get_option("proffix_newsletter_settings_success"));
        }

        if( isset( $errors ) || empty( $_POST['proffixnewsletter'] ) )
        {
            foreach( $errors as $field => $error )
            {
                echo "<span class='error'>$error</p>";
            }
            $this->render_form( $attr );
        }
    }

    public function render_form($attr)
    {
        include ('views/widget.php');
    }


    /** * Activate the plugin */
    public static function activate() {
        add_option("proffix_newsletter_default_show_name", "1", null, "no");
        add_option("proffix_newsletter_default_description", "Melden Sie sich für den Newsletter an", null, "no");
        add_option("proffix_newsletter_settings_success", "Anmeldung erfolgreich", null, "no");
        add_option("proffix_newsletter_settings_error", "Zurzeit gibt es technische Probleme mit dem Newsletter. Kontaktieren Sie uns doch einfach.", null, "no");
        add_option("proffix_newsletter_default_url", "", null, "no");
        add_option("proffix_newsletter_default_db", "", null, "no");
        add_option("proffix_newsletter_default_list", "", null, "no");
    }

    /** * Deactivate the plugin */
    public static function deactivate() {
        delete_option("proffix_newsletter_default_show_name");
        delete_option("proffix_newsletter_default_description");
        delete_option("proffix_newsletter_settings_success");
        delete_option("proffix_newsletter_settings_error");
        delete_option("proffix_newsletter_default_url");
        delete_option("proffix_newsletter_default_db");
        delete_option("proffix_newsletter_default_list");
    }

    public function ajaxResponse($errors, $success_message)
    {
        //check if is ajax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            if(!empty($errors))
            {
                echo json_encode( array( 'success' => '0', 'message' => $errors ) );
            }else{
                echo json_encode( array( 'success' => '1', 'message' => $success_message ) );
            }
            exit;
        }

        return true;
    }

}
}

if(class_exists("proffixNewsletter")){

register_activation_hook(__FILE__, array('proffixNewsletter', 'activate'));
register_deactivation_hook(__FILE__, array('proffixNewsletter', 'deactivate'));
$proffixNewsletter = new proffixNewsletter;
add_action( 'widgets_init', 'proffixnewsletter_register_widgets' );
}

class widgetPROFFIXNewsletter extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'PROFFIX Newsletter', array('description' => __('Zeigt E-Newsletter Anmeldung als Widget an', 'proffix-newsletter')) );
    }

    function widget( $args, $instance ) {
        ?>
        <aside id="proffixnewsletter-widget" class="widget">
            <h2 class="widget-title">
                <?php echo $instance['px_title']; ?>
            </h2>

            <p><?php if (!empty($instance['px_description'])) echo $instance['px_description'] ; ?></p>
            <?php do_shortcode('[proffixnewsletter url='.$instance['px_url'].' db='.$instance['px_db'].' list='.$instance['px_list'].']'); ?>
        </aside>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['px_title'] = ( ! empty( $new_instance['px_title'] ) ) ? strip_tags( $new_instance['px_title'] ) : '';
        $instance['px_description'] = ( ! empty( $new_instance['px_description'] ) ) ? strip_tags( $new_instance['px_description'] ) : '';
        $instance['px_url'] = ( ! empty( $new_instance['px_url'] ) ) ? strip_tags( $new_instance['px_url'] ) : '';
        $instance['px_db'] = ( ! empty( $new_instance['px_db'] ) ) ? strip_tags( $new_instance['px_db'] ) : '';
        $instance['px_list'] = ( ! empty( $new_instance['px_list'] ) ) ? strip_tags( $new_instance['px_list'] ) : '';

        return $instance;
    }

    function form( $instance ) {
        $px_title = !empty( $instance['px_title'] ) ? $instance['px_title'] : 'Newsletter';
        $px_description = !empty( $instance['px_description'] ) ? $instance['px_description'] : get_option("proffix_newsletter_default_description");
        $px_url = !empty( $instance['px_url'] ) ? $instance['px_url'] : get_option("proffix_newsletter_default_url");
        $px_db = !empty( $instance['px_db'] ) ? $instance['px_db'] : get_option("proffix_newsletter_default_db");
        $px_list = !empty( $instance['px_list'] ) ? $instance['px_list'] : get_option("proffix_newsletter_default_list");

        include(plugin_dir_path(__FILE__) . 'views/widget_settings.php');
    }
}

function proffixnewsletter_register_widgets() {
    register_widget( 'widgetPROFFIXNewsletter' );
}