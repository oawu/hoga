<form action='<?php echo base_url ('admin', $uri_1);?>' method='get' class="search<?php echo $has_search = array_filter (column_array ($columns, 'value')) ? ' show' : '';?>">
<?php 
  if ($columns) { ?>
    <div class='l i<?php echo count ($columns);?> n1'>
<?php foreach ($columns as $column) {
        if (isset ($column['select']) && $column['select']) { ?>
          <select name='<?php echo $column['key'];?>'>
            <option value=''>請選擇 <?php echo $column['title'];?>..</option>
      <?php foreach ($column['select'] as $option) { ?>
              <option value='<?php echo $option['value'];?>'<?php echo $option['value'] === $column['value'] ? ' selected' : '';?>><?php echo $option['text'];?></option>
      <?php } ?>
          </select>
  <?php } else { ?>
          <input type='text' name='<?php echo $column['key'];?>' value='<?php echo $column['value'];?>' placeholder='請輸入 <?php echo $column['title'];?>..' />
<?php   }
      }?>
    </div>
    <button type='submit'>尋找</button>
<?php 
  } else { ?>
    <div class='l i0 n1'></div>
<?php 
  }?>
  <a href='<?php echo base_url ('admin', $uri_1, 'add');?>'>新增</a>
</form>
<button type='button' onClick="if (!$(this).prev ().is (':visible')) $(this).attr ('class', 'icon-chevron-left').prev ().addClass ('show'); else $(this).attr ('class', 'icon-chevron-right').prev ().removeClass ('show');" class='icon-chevron-<?php echo $has_search ? 'left' : 'right';?>'></button>

  <table class='table-list-rwd'>
    <tbody>
<?php if ($anns) {
        foreach ($anns as $ann) { ?>
          <tr>
            <td data-title='標題' width='150'><?php echo $ann->title;?></td>
            <td data-title='描述' width='' class='left'><?php echo $ann->mini_content ();?></td>
            <td data-title='品牌' width='' class='left'><?php echo $ann->brand ? $ann->brand->name : 'info';?></td>
            <td data-title='是否啟用' width='90'>
              <label class='index_checkbox'>
                <input type='checkbox' data-id='<?php echo $ann->id;?>'<?php echo $ann->is_enabled == Ann::IS_ENABLED ? ' checked' : '';?>>
                <span></span><div><?php echo Ann::$isIsEnabledNames[$ann->is_enabled];?></div>
              </label>
            </td>
            <td data-title='編輯' width='80'>
              <a href='<?php echo base_url ('admin', $uri_1, $ann->id, 'edit');?>' class='icon-pencil2'></a>
              <a href='<?php echo base_url ('admin', $uri_1, $ann->id);?>' data-method='delete' class='icon-bin destroy'></a>
            </td>
          </tr>
  <?php }
      } else { ?>
        <tr><td colspan>目前沒有任何資料。</td></tr>
<?php }?>
    </tbody>
  </table>

<?php echo render_cell ('frame_cell', 'pagination', $pagination);?>

