<form id='fm' action='<?php echo base_url (array ('admin', $uri_1));?>' method='post' enctype='multipart/form-data'>

  <table class='table-form'>
    <tbody>

      <tr>
        <th>名 稱：</th>
        <td>
          <input type='text' name='name' value='<?php echo isset ($posts['name']) ? $posts['name'] : '';?>' placeholder='請輸入名稱..' maxlength='200' pattern='.{1,200}' required title='輸入名稱!' autofocus />
        </td>
      </tr>

      <tr>
        <th>封 面：</th>
        <td>
          <input type='file' name='cover' value='' />
        </td>
      </tr>

      <tr>
        <th>鏈 結：</th>
        <td>
          <input type='text' name='link' value='<?php echo isset ($posts['link']) ? $posts['link'] : '';?>' placeholder='請輸入標題..' maxlength='200' pattern='.{1,200}' required title='輸入鏈結!' />
        </td>
      </tr>

      <tr>
        <th>內 容：</th>
        <td>
          <textarea name='content' class='pure' placeholder='請輸入描述..'><?php echo isset ($posts['content']) ? $posts['content'] : '';?></textarea>
        </td>
      </tr>


      <tr>
        <th>是否啟用：</th>
        <td>
          <select name='is_enabled'>
      <?php if ($isIsEnabledNames = Brand::$isIsEnabledNames) {
              foreach ($isIsEnabledNames as $key => $name) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : Brand::NO_ENABLED) == $key ? ' selected': '';?>><?php echo $name;?></option>
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
