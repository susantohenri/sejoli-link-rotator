<?php

/**
 * Sejoli Link Rotator
 *
 * @package     SejoliLinkRotator
 * @author      Henri Susanto
 * @copyright   2022 Henri Susanto
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Sejoli Link Rotator
 * Plugin URI:  https://github.com/susantohenri/sejoli-link-rotator
 * Description: WordPress Plugin to Rotate Affiliate Link of Sejoli
 * Version:     1.0.0
 * Author:      Henri Susanto
 * Author URI:  https://github.com/susantohenri/
 * Text Domain: SejoliLinkRotator
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action('init', function () {
    add_rewrite_endpoint('sample-link-rotator', EP_PERMALINK);
});

add_action('template_redirect', function () {
    global $wp_query;
    if ($wp_query->query_vars['name'] == 'sample-link-rotator') {
        echo 'test new page';
        exit;
    }
});

add_action('admin_menu', function () {
    add_menu_page('Sejoli Rotator', 'Sejoli Rotator', 'administrator', __FILE__, function () {
        if (isset($_POST['sejoli-link-rotator-update-config'])) {
            foreach ([
                'sejoli-link-rotator-product-id',
                'sejoli-link-rotator-harga-klik',
                'sejoli-link-rotator-master-link'
            ] as $option) {
                if (isset($_POST[$option])) update_option($option, $_POST[$option]);
            }
        }
?>
        <div class="wrap">
            <h1>Sejoli Link Rotator Add-on</h1>
            <div id="dashboard-widgets-wrap">
                <div id="dashboard-widgets" class="metabox-holder">
                    <div class="">
                        <div class="meta-box-sortables">
                            <div id="dashboard_quick_press" class="postbox ">
                                <div class="postbox-header">
                                    <h2 class="hndle ui-sortable-handle">
                                        <span>Sejoli Link Rotator Configuration</span>
                                    </h2>
                                </div>
                                <div class="inside">
                                    <form method="POST" action="">
                                        <table>
                                            <tr>
                                                <td><label><b>Product ID:</b></label></td>
                                                <td><input type="text" name="sejoli-link-rotator-product-id" value="<?= get_option('sejoli-link-rotator-product-id') ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><label><b>Harga Klik:</b></label></td>
                                                <td><input type="text" name="sejoli-link-rotator-harga-klik" value="<?= get_option('sejoli-link-rotator-harga-klik') ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label><b>Master Link:</b></label>
                                                </td>
                                                <td>
                                                    <textarea cols="35" rows="5" name="sejoli-link-rotator-master-link"><?= get_option('sejoli-link-rotator-master-link') ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><small><b>* pisahkan dengan baris, misal: <br>https://app.lisenza.com/sample-link-rotator <br>https://app.lisenza.com/anti-spam</b></small></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" value="simpan" name="sejoli-link-rotator-update-config"></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }, '');
});
