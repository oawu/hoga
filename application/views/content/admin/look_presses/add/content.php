<form id='fm' action='<?php echo base_url (array ('admin', $uri_1));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='user_id' value='<?php echo User::current ()->id;?>'>
  <table class='table-form'>
    <tbody>

      <tr>
        <th>年 份：</th>
        <td>
          <select name='year'>
      <?php for ($i = date ('Y'); $i > 2011; $i--) { ?>
              <option value='<?php echo $i;?>'<?php echo (isset ($posts['year']) ? $posts['year'] : date ('Y')) == $i ? ' selected': '';?>><?php echo $i;?>年</option>
      <?php }?>
          </select>
        </td>
      </tr>

      <tr>
        <th>小 圖：</th>
        <td>
          <input type='file' name='big' value='' />
        </td>
      </tr>

      <tr>
        <th>大 圖：</th>
        <td>
          <input type='file' name='small' value='' />
        </td>
      </tr>

      <tr>
        <th>是否啟用：</th>
        <td>
          <select name='is_enabled'>
      <?php if ($isIsEnabledNames = LookPress::$isIsEnabledNames) {
              foreach ($isIsEnabledNames as $key => $name) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : LookPress::NO_ENABLED) == $key ? ' selected': '';?>><?php echo $name;?></option>
        <?php }
            }?>
          </select>
        </td>
      </tr>

      <tr>
        <td colspan='2'>
          <a href='<?php echo base_url ('admin', $uri_1);?>'>回列表</a>
          <button type='reset' class='button'>重填</button>
          <button type='submit' class='button'>確定</button>
        </td>
      </tr>
    </tbody>
  </table>
</form>
