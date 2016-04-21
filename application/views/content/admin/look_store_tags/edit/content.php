<form id='fm' action='<?php echo base_url (array ('admin', $uri_1, $tag->id));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='_method' value='put' />
  <input type='hidden' name='user_id' value='<?php echo User::current ()->id;?>'>

  <table class='table-form'>
    <tbody>

      <tr>
        <th>中文名稱：</th>
        <td>
          <input type='text' name='name' value='<?php echo isset ($posts['name']) ? $posts['name'] : $tag->name;?>' placeholder='請輸入中文名稱..' maxlength='200' pattern='.{1,200}' required title='輸入中文名稱!' autofocus />
        </td>
      </tr>

      <tr>
        <th>英文名稱：</th>
        <td>
          <input type='text' name='en_name' value='<?php echo isset ($posts['en_name']) ? $posts['en_name'] : $tag->en_name;?>' placeholder='請輸入英文名稱..' maxlength='200' pattern='.{1,200}' required title='輸入英文名稱!'  />
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
