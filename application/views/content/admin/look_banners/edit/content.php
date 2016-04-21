<form id='fm' action='<?php echo base_url (array ('admin', $uri_1, $banner->id));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='_method' value='put' />
  <input type='hidden' name='user_id' value='<?php echo User::current ()->id;?>'>

  <table class='table-form'>
    <tbody>

      <tr>
        <th>照 片：</th>
        <td>
          <?php echo (string)$banner->name ? img ($banner->name->url ('100x100c'), false, 'class="name"') : '';?>
          <input type='file' name='name' value='' />
        </td>
      </tr>

      <tr>
        <th>是否啟用：</th>
        <td>
          <select name='is_enabled'>
      <?php if ($isIsEnabledNames = LookBanner::$isIsEnabledNames) {
              foreach ($isIsEnabledNames as $key => $name) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : $banner->is_enabled) == $key ? ' selected': '';?>><?php echo $name;?></option>
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
