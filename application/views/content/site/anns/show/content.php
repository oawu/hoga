<?php echo render_cell ('index_cell', 'header', false);?>
<img src='<?php echo base_url ('resource', 'image', 'pagebg.jpg');?>'>

<h1>NEWS</h1>
<h2>最新消息</h2>

<div id='ann'>
  <header>
    <h2><?php echo $ann->title;?></h2>
    <span><?php echo $ann->created_at->format ('Y.m.t');?> <?php echo $ann->brand ? $ann->brand->name : 'info';?></span>
  </header>
  <article><?php echo $ann->content;?></article>
</div>

<div id='bottom'>
  <div>
    <?php
    if ($next) { ?>
      <a class='n' href='<?php echo base_url ('ann', $next->id);?>'>NEXT</a>
    <?php
    }
    if ($prev) { ?>
      <a class='p' href='<?php echo base_url ('ann', $prev->id);?>'>PREV</a>
    <?php
    }?>
    <a class='a icon-menu' href='<?php echo base_url ('anns');?>'>VIEW ALL</a>
  </div>
</div>
<?php echo render_cell ('index_cell', 'footer');?>
