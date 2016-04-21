<form id='fm' action='<?php echo base_url (array ('admin', $uri_1, $ann->id));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='_method' value='put' />

  <table class='table-form'>
    <tbody>

      <tr>
        <th>標 題：</th>
        <td>
          <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : $ann->title;?>' placeholder='請輸入標題..' maxlength='200' pattern='.{1,200}' required title='輸入標題!' autofocus />
        </td>
      </tr>

      <tr>
        <th>品 牌：</th>
        <td>
          <select name='brand_id'>
            <option value='0' selected>info</option>
      <?php if ($brands = Brand::all ()) {
              foreach ($brands as $brand) { ?>
                <option value='<?php echo $brand->id;?>'<?php echo (isset ($posts['brand_id']) ? $posts['brand_id'] : $ann->brand_id) == $brand->id ? ' selected': '';?>><?php echo $brand->name;?></option>
        <?php }
            }?>
          </select>
        </td>
      </tr>

      <tr>
        <th>內 容：</th>
        <td>
          <textarea name='content' class='cke' placeholder='請輸入描述..'><?php echo isset ($posts['content']) ? $posts['content'] : $ann->content;?></textarea>
        </td>
      </tr>

      <tr>
        <th>是否啟用：</th>
        <td>
          <select name='is_enabled'>
      <?php if ($isIsEnabledNames = Brand::$isIsEnabledNames) {
              foreach ($isIsEnabledNames as $key => $name) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : $ann->is_enabled) == $key ? ' selected': '';?>><?php echo $name;?></option>
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
