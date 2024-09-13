<?php
/*
Plugin Name: WhatsApp AGY
Description: Adiciona um ícone do WhatsApp no rodapé do site.
Version: 1.0
Author: Agencia Yes - Lennon Oliveira
Author URI: https://www.agenciayes.com.br
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: WhatsApp AGY
Domain Path: /languages
*/

// Adiciona o item de menu no painel administrativo
add_action('admin_menu', 'whatsapp_footer_menu');

function whatsapp_footer_menu() {
    add_menu_page(
        'WhatsApp AGY Settings',     // Título da página
        'WhatsApp AGY',              // Título do menu
        'manage_options',               // Capacidade
        'whatsapp-footer-settings',     // Slug
        'whatsapp_footer_settings_page',// Função de callback
        'dashicons-whatsapp',           // Ícone do menu
        100                             // Posição
    );
}

// Cria a página de configurações do plugin
function whatsapp_footer_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do WhatsApp AGY</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('whatsapp-footer-settings-group');
            do_settings_sections('whatsapp-footer-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Número do WhatsApp</th>
                    <td>
                        <input type="text" name="whatsapp_footer_number" value="<?php echo esc_attr(get_option('whatsapp_footer_number')); ?>" />
                        <p>Digite o código do seu país Ex: 55</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Registra as configurações do plugin
add_action('admin_init', 'whatsapp_footer_settings');

function whatsapp_footer_settings() {
    register_setting('whatsapp-footer-settings-group', 'whatsapp_footer_number');
}

// Adiciona o ícone do WhatsApp no rodapé do site
add_action('wp_footer', 'add_whatsapp_footer');

function add_whatsapp_footer() {
    $whatsapp_number = get_option('whatsapp_footer_number');
    if ($whatsapp_number) {
        echo '<div style="position:fixed;bottom:10px;right:10px;z-index:1000;">
                <a href="https://wa.me/' . esc_attr($whatsapp_number) . '" target="_blank">
                    <img src="https://agenciayes.com.br/pluginwhatsapp/whatsapp.png" alt="WhatsApp" style="width:60px;height:60px;">
                </a>
              </div>';
    }
}
?>
