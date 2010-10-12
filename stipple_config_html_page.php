<?php
  /*
   * stipple_config_html_page.php
   * The markup for the Stipple plugin's configuration page
   * stipple - 11 Oct, 2010
   */

  function stipple_config_html_page() {

    $opts = get_option('stipple_options');
    $stipple_load = "";
    $site_id = $opts['site_id'];
    if(!$site_id)
      $site_id = 'SITE_ID_HERE';

    if($opts['custom_stipple_load_data']) {
      $stipple_load = $opts['custom_stipple_load_data'];
    } else {
      $stipple_load = <<<EOS
STIPPLE.load('{$site_id}', {
  selector: 'img',
  afterAll: null,
  minWidth: 400,
  minHeight: 200
});
EOS;
    }
?>

<div>
  <h2>Stipple Options</h2>

  <form method="post" action="options.php">
    <?php settings_fields('stipple-options'); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><input id="stipple-no-custom-load" name="stipple_options[custom_stipple_load]" type="radio" value="0" <?php checked('0', $opts['custom_stipple_load']); ?> onclick="document.getElementById('stipple_site_id').disabled = false;document.getElementById('stipple_custom_load_data').disabled = true;" /> <label for="stipple-no-custom-load">Load Stipple with Site ID:</label></th>
        <td>
          <input name="stipple_options[site_id]" type="text" id="stipple_site_id"
          value="<?php _e($opts['site_id']); ?>" <?php disabled('1', $opts['custom_stipple_load']); ?> />
          (e.g. 2XnALR)
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><input id="stipple-use-custom-load" name="stipple_options[custom_stipple_load]" type="radio" value="1" <?php checked('1', $opts['custom_stipple_load']); ?> onclick="document.getElementById('stipple_site_id').disabled = true;document.getElementById('stipple_custom_load_data').disabled = false;"/> <label for="stipple-use-custom-load">Use Custom <code>STIPPLE.load</code>:</label></th>
        <td>
          <textarea id="stipple_custom_load_data" rows="8" cols="26" name="stipple_options[custom_stipple_load_data]" <?php disabled('0', $opts['custom_stipple_load']); ?>><?php _e($stipple_load); ?></textarea>
        </td>
      </tr>

    </table>


    <p>
      <input type="submit" value="<?php _e('Save Changes') ?>" />
    </p>

  </form>
</div>


<?php

  }

?>
