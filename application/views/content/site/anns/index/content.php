<?php echo render_cell ('index_cell', 'header', false);?>
<img src='<?php echo base_url ('resource', 'image', 'pagebg.jpg');?>'>

<h1>NEWS</h1>
<h2>最新消息</h2>

<form id='fm' method='get' action=''>
  <div id='year'>
    <div>
      <a<?php echo $year == 2016 ? ' class="a"' : '';?> data-val='2016'>2016</a>
      <a<?php echo $year == 2015 ? ' class="a"' : '';?>  data-val='2015'>2015</a>
    </div>
  </div>

  <div id='brand'>
    <div>
      <a<?php echo $brand_id == '' ? ' class="a"' : '';?> data-val=''>All</a>
<?php foreach (Brand::find ('all', array ('select' => 'id, name', 'conditions' => array ('is_enabled = ?', Brand::IS_ENABLED))) as $brand) { ?>
        <a<?php echo $brand_id == $brand->id ? ' class="a"' : '';?> data-val='<?php echo $brand->id;?>'><?php echo $brand->name;?></a>
<?php } ?>
    </div>
  </div>
</form>

<div id='anns'>
  <?php
  if ($anns) {
    foreach ($anns as $ann) { ?>
      <a href='<?php echo base_url ('ann', $ann->id);?>'>
        <header>
          <h2><?php echo $ann->title;?></h2>
          <span><?php echo $ann->created_at->format ('Y.m.t');?> / <?php echo $ann->brand ? $ann->brand->name : 'info';?></span>
        </header>
        <article><?php echo $ann->mini_content (300);?></article>
      </a>
<?php
    }
  } else { ?>
    <div class='no'>沒有任何最新消息。</div>
<?php
  } ?>
  <div><?php echo $pagination;?></div>
</div>

<?php echo render_cell ('index_cell', 'footer');?>
