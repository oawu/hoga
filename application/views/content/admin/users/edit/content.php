<form action='<?php echo base_url (array ('admin', 'users', $user->id));?>' method='post' enctype='multipart/form-data'>
  <input type='hidden' name='_method' value='put' />
  <table class='table-form'>
    <tbody>

      <tr>
        <th>名 稱：</th>
        <td>
          <input type='text' name='name' value='<?php echo isset ($posts['name']) ? $posts['name'] : $user->name;?>' placeholder='請輸入名稱..' maxlength='200' pattern='.{1,200}' required title='輸入名稱!' autofocus />
        </td>
      </tr>
      
      <tr>
        <th>電子郵件：</th>
        <td>
          <input type='text' name='email' value='<?php echo isset ($posts['email']) ? $posts['email'] : $user->email;?>' placeholder='請輸入電子郵件..' maxlength='200' pattern='.{1,200}' required title='輸入電子郵件!' />
        </td>
      </tr>

      <tr>
        <th>管理身份：</th>
        <td>
          <select name='role'>
            <option value='admin'<?php echo (isset ($posts['role']) ? $posts['role'] : $user->role) == 'admin' ? ' selected': '';?>>管理員</option>
            <option value=''<?php echo (isset ($posts['role']) ? $posts['role'] : $user->role) == '' ? ' selected': '';?>>非管理員</option>
          </select>
        </td>
      </tr>

      <tr>
        <td colspan='2'>
          <a href='<?php echo base_url ('admin', 'users');?>'>回列表</a>
          <button type='reset' class='button'>重填</button>
          <button type='submit' class='button'>確定</button>
        </td>
      </tr>
    </tbody>
  </table>
</form>
