<?php
/*
Plugin Name: JetForm Progress Bar
Plugin URI: https://github.com/marcosarcu/JetFormBuilder-Progress-Bar
Description: Add a customizable progress bar to JetFormBuilder multi-step forms.
Version: 1.0.0
Author: Marcos Arcusin
Author URI: https://arcuweb.com
Text Domain: jfb-progress-bar
Domain Path: /languages
License: GPL v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

// Prevenir acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('JFB_PROGRESS_BAR_VERSION', '1.1.0');
define('JFB_PROGRESS_BAR_PATH', plugin_dir_path(__FILE__));
define('JFB_PROGRESS_BAR_URL', plugin_dir_url(__FILE__));

// Verificar dependencia de JetFormBuilder
function jfb_progress_bar_check_dependencies() {
    if (!class_exists('Jet_Form_Builder\\Plugin')) {
        add_action('admin_notices', 'jfb_progress_bar_missing_jetformbuilder_notice');
        return false;
    }
    return true;
}

function jfb_progress_bar_missing_jetformbuilder_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php _e('JetForm Progress Bar requires JetFormBuilder to be installed and activated.', 'jfb-progress-bar'); ?></p>
    </div>
    <?php
}

// Agregar metabox en post types de JetFormBuilder
function jfb_add_custom_meta_box() {
    if (!jfb_progress_bar_check_dependencies()) {
        return;
    }
    
    add_meta_box(
        'jfb_shortcode_meta_box',
        __('Progress Bar Shortcode', 'jfb-progress-bar'),
        'jfb_display_meta_box',
        'jet-form-builder',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'jfb_add_custom_meta_box');

// Mostrar contenido de la metabox
function jfb_display_meta_box($post) {
    wp_nonce_field('jfb_progress_bar_nonce', 'jfb_progress_bar_nonce');
    
    $shortcode = '[jfb_progress_bar id="' . esc_attr($post->ID) . '"]';
    ?>
    <p><?php _e('Use the following shortcode to display the progress bar:', 'jfb-progress-bar'); ?></p>
    <input type="text" 
           id="jfb_shortcode" 
           value="<?php echo esc_attr($shortcode); ?>" 
           readonly 
           class="widefat">
    <button type="button" 
            id="copy_shortcode_button" 
            class="button button-secondary" 
            style="margin-top: 10px;">
        <?php _e('Copy Shortcode', 'jfb-progress-bar'); ?>
    </button>
    
    <script>
        jQuery(document).ready(function($) {
            $('#copy_shortcode_button').on('click', function() {
                const shortcodeInput = document.getElementById('jfb_shortcode');
                shortcodeInput.select();
                document.execCommand('copy');
                $(this).text('<?php _e('Copied!', 'jfb-progress-bar'); ?>');
                setTimeout(() => $(this).text('<?php _e('Copy Shortcode', 'jfb-progress-bar'); ?>'), 2000);
            });
        });
    </script>
    <?php
}

// Shortcode para mostrar la barra de progreso
function jfb_progress_bar_shortcode($atts) {
    if (!jfb_progress_bar_check_dependencies()) {
        return '';
    }

    // Sanitizar y validar atributos
    $atts = shortcode_atts(
        array(
            'id' => '',
            'color' => '#4caf50',
            'background' => '#f3f3f3',
            'height' => '20px',
        ), 
        $atts, 
        'jfb_progress_bar'
    );

    // Validar ID
    if (empty($atts['id']) || !get_post($atts['id'])) {
        return '';
    }

    // Sanitizar valores
    $form_id = absint($atts['id']);
    $color = sanitize_hex_color($atts['color']);
    $background = sanitize_hex_color($atts['background']);
    $height = sanitize_text_field($atts['height']);

    ob_start();
    ?>
    <div class="jfb-progress-container">
        <div id="jfb-progress-bar-<?php echo esc_attr($form_id); ?>" class="jfb-progress-bar"></div>
    </div>

    <style>
        .jfb-progress-container {
            width: 100%;
            background-color: <?php echo esc_attr($background); ?>;
            border-radius: 5px;
            overflow: hidden;
            height: <?php echo esc_attr($height); ?>;
            margin-bottom: 20px;
        }

        .jfb-progress-bar {
            height: 100%;
            width: 0;
            background-color: <?php echo esc_attr($color); ?>;
            transition: width 0.3s ease;
        }
    </style>

    <script>
        (function($) {
            'use strict';
            
            $(document).ready(function() {
                const checkJetFormBuilder = setInterval(() => {
                    if (typeof JetFormBuilder !== 'undefined' && 
                        JetFormBuilder[<?php echo $form_id; ?>] && 
                        JetFormBuilder[<?php echo $form_id; ?>].multistep) {
                        
                        clearInterval(checkJetFormBuilder);
                        
                        const progressBar = document.getElementById('jfb-progress-bar-<?php echo esc_js($form_id); ?>');
                        const form = JetFormBuilder[<?php echo $form_id; ?>];
                        
                        const updateProgressBar = () => {
                            const currentPageIndex = form.multistep.getCurrentPage().index;
                            const totalPages = form.multistep.getPages().length;
                            const progress = ((currentPageIndex + 1) / totalPages) * 100;
                            progressBar.style.width = progress + '%';
                        };

                        $(document).on('click', '.jet-form-builder__next-page, .jet-form-builder__prev-page', updateProgressBar);
                        updateProgressBar();
                    }
                }, 100);
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('jfb_progress_bar', 'jfb_progress_bar_shortcode');

// Cargar traducciones
function jfb_progress_bar_load_textdomain() {
    load_plugin_textdomain('jfb-progress-bar', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'jfb_progress_bar_load_textdomain');

// Registrar assets
function jfb_progress_bar_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'jfb_progress_bar_enqueue_scripts');
