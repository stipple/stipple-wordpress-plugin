<?php
  /*
    Plugin Name: Stipple
    Plugin URI: http://stippleit.com/s/wordpress
    Description: Stipple is the fastest way to label your pictures.
    Version: 0.1
    Author: Stipple Team - stippletech@stippleit.com
    Author URI: http://stippleit.com
    License: GPL2
  */

  include 'stipple_config_html_page.php';

  register_deactivation_hook( __FILE__, 'stipple_deactivate' );
  add_action('wp_footer', 'stipple_enable');

  /* admin settings setup */
  if ( is_admin() ) {
    add_action('admin_menu', 'stipple_admin_menu');
    add_action('admin_init', 'stipple_register_options');
  }

  function stipple_deactivate() {
    delete_option('stipple_options');
  }

  function stipple_enable() {
?>

    <script type="text/javascript" src="http://stippleit.com/stipple.js"></script>
<?php
    $opts = get_option('stipple_options');

    if($opts['custom_stipple_load']) {
?>
      <script type="text/javascript"><?php _e($opts['custom_stipple_load_data']); ?></script>

<?php
    } else if($opts['site_id']) {
?>
      <script type="text/javascript">STIPPLE.load('<?php _e($opts['site_id']); ?>');</script>
<?php
    }

  }

  function stipple_admin_menu() {
    add_options_page('Stipple', 'Stipple', 'administrator',
    'stipple', 'stipple_config_html_page');
  }

  function stipple_register_options() {
    register_setting('stipple-options', 'stipple_options', 'stipple_validate');
  }

  function stipple_validate($v) {
    $v['site_id'] =  wp_filter_nohtml_kses($v['site_id']);
    $v['custom_stipple_load'] = ($v['custom_stipple_load'] == 1 ? 1 : 0);

    return $v;
  }

?>
