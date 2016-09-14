<form id='fm' action='<?php echo base_url (array ('admin', $uri_1));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='user_id' value='<?php echo User::current ()->id;?>'>
  <table class='table-form'>
    <tbody>

      <tr>
        <th>名 稱：</th>
        <td>
          <input type='text' name='name' value='<?php echo isset ($posts['name']) ? $posts['name'] : '';?>' placeholder='請輸入名稱..' maxlength='200' pattern='.{1,200}' required title='輸入名稱!' autofocus />
        </td>
      </tr>

      <tr>
        <th>電 話：</th>
        <td>
          <input type='text' name='phone' value='<?php echo isset ($posts['phone']) ? $posts['phone'] : '';?>' placeholder='請輸入電話..' maxlength='200' pattern='.{1,200}' required title='輸入電話!' />
        </td>
      </tr>

      <tr>
        <th>地 址：</th>
        <td>
          <input type='text' name='address' value='<?php echo isset ($posts['address']) ? $posts['address'] : '';?>' placeholder='請輸入地址..' maxlength='200' pattern='.{1,200}' required title='輸入地址!' />
        </td>
      </tr>

      <tr>
        <th>分 類：</th>
        <td>
          <select name='kawashima_store_tag_id'>
      <?php if ($tags = KawashimaStoreTag::all ()) {
              foreach ($tags as $tag) { ?>
                <option value='<?php echo $tag->id;?>'<?php echo (isset ($posts['kawashima_store_tag_id']) ? $posts['kawashima_store_tag_id'] : 0) == $tag->id ? ' selected': '';?>><?php echo $tag->name;?>(<?php echo $tag->en_name;?>)</option>
        <?php }
            } else { ?>
              <a href='<?php echo base_url ('admin', 'kawashima_store_tags', 'add');?>'>新增分類</a>
      <?php } ?>
          </select>
        </td>
      </tr>

      <tr>
        <th>是否啟用：</th>
        <td>
          <select name='is_enabled'>
      <?php if ($isIsEnabledNames = KawashimaStore::$isIsEnabledNames) {
              foreach ($isIsEnabledNames as $key => $name) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : KawashimaStore::NO_ENABLED) == $key ? ' selected': '';?>><?php echo $name;?></option>
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
