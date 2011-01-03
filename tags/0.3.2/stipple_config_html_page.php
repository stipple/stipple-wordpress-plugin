<?php
  /*
    Copyright 2010-2011  Stipple  (email : stippletech@stippleit.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
          value="<?php _e($opts['site_id']); ?>" <?php disabled(Array('1', '2'), $opts['custom_stipple_load']); ?> />
          (e.g. 2XnALR)
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><input id="stipple-use-custom-load" name="stipple_options[custom_stipple_load]" type="radio" value="1" <?php checked('1', $opts['custom_stipple_load']); ?> onclick="document.getElementById('stipple_site_id').disabled = true;document.getElementById('stipple_custom_load_data').disabled = false;"/> <label for="stipple-use-custom-load">Use Custom <code>STIPPLE.load</code>:</label></th>
        <td>
          <textarea id="stipple_custom_load_data" rows="8" cols="26" name="stipple_options[custom_stipple_load_data]" <?php disabled(Array('0', '2'), $opts['custom_stipple_load']); ?>><?php _e($stipple_load); ?></textarea>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><input id="stipple-no-load" name="stipple_options[custom_stipple_load]" type="radio" value="2" <?php checked('2', $opts['custom_stipple_load']); ?> onclick="document.getElementById('stipple_site_id').disabled = true;document.getElementById('stipple_custom_load_data').disabled = true;"/> <label for="stipple-no-load">Install Stipple, but don't call <code>STIPPLE.load</code>. I will add <code>stippleit-sid</code> classes to my images.</label></th>
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
