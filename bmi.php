<?php
/**
 * Plugin Name: Calculadora IMC
 * Description: Calculadora de Índice de Massa Corporal e Taxa Metabólica Basal.
 * Version: 1.3
 * Author: Fernando Campos
 * License: MIT
 */
//The css and the js will be loaded only on the page where shortcode is used - start
add_action('init', 'bmibmr_register');
add_action('wp_footer', 'bmibmr_append_scripts');

function bmibmr_register() {
    wp_register_script('bmibmr_script', plugins_url() . '/calculadora-imc/fitness_body_calculator.js');
    wp_register_script('modernizr', plugins_url() . '/calculadora-imc/includes/js/modernizr.js');
    wp_register_script('bootstrapjs', plugins_url() . '/calculadora-imc/assets/bootstrap/js/bootstrap.js');

    wp_register_style('bmibmr_style', plugins_url('style_bmi.css', __FILE__));
    wp_register_style('typicons', plugins_url('assets/icons/typicons.min.css', __FILE__));
    wp_register_style('bootstrapcss', plugins_url('assets/bootstrap/css/bootstrap.css', __FILE__));
}

function bmibmr_append_scripts() {
    global $add_my_script;

    if (!$add_my_script)
        return;

    wp_print_scripts('modernizr');
    wp_print_scripts('bootstrapjs');
    wp_enqueue_style('bmibmr_style');
    wp_enqueue_style('typicons');
    wp_enqueue_style('bootstrapcss');
    wp_print_scripts('bmibmr_script');
}

add_shortcode('bmibmr', 'bmibmr_init');

function bmibmr_init($atts) {
    global $add_my_script;
    $add_my_script = true;
    include('bmi_calc.php');
}

//The css and the js will be loaded only on the page where shortcode is used - end
//Admin settings
function bmibmr_register_settings() {
    add_option('bmibmr_use_api', '1');
    add_option('bmibmr_api_callback', 'alpha');
    register_setting('default', 'bmibmr_use_api');
    register_setting('default', 'bmibmr_api_callback');
}

add_action('admin_init', 'bmibmr_register_settings');

function bmibmr_register_options_page() {
    add_options_page('Calculadora IMC', 'Calculadora IMC', 'manage_options', 'wphub-options', 'bmibmr_options_page');
}

add_action('admin_menu', 'bmibmr_register_options_page');

function bmibmr_options_page() {
    ?>
    <div class="wrap">
        <h2>Calculadora IMC</h2>
        <h3>Informações</h3>
        <p>O <i>css</i> e o <i>js</i> será carregado apenas na página / publicação onde o código abreviado é usado.</p>
        <p>Use <code>[bmibmr]</code> shortcode na postagem ou na página para exibir os formulários IMC e BMR.</p>
        <br>
        <hr>
        <footer>
            Para perguntas técnicas sobre o plugin, contate:  <a href="mailto:fernando@odesenvolvedor.net">fernando@odesenvolvedor.net</a>
        </footer>
    </div>
<?php
}

//Admin settings
function bmibmr_custom_head() {
    echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
}