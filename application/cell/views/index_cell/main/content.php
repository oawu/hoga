<div id='main_'>
  <img src='<?php echo base_url ('resource', 'image', 'inbg02.jpg');?>'>

  <div>
    <div class='l'>
      <header>
        <h2>NEWS</h2>
        最新消息
      </header>
  <?php foreach ($anns as $ann) { ?>
          <a href='<?php echo base_url ('ann', $ann->id);?>'>
            <div><?php echo $ann->mini_content ();?></div>
            <div><?php echo $ann->created_at->format ('Y.m.d');?> <?php echo $ann->brand ? $ann->brand->name : 'info';?></div>
          </a>
  <?php } ?>

      <a href='<?php echo base_url ('anns');?>'>
        <span>MORE</span>
      </a>

    </div>
    <div class='r'>
      <header>
        <h2>BRAND</h2>
        品牌專區
      </header>
<?php foreach ($brands as $brand) { ?>
        <div>
          <img width='319' height='195' src='<?php echo $brand->cover->url ('319x195c');?>' />
          <div class='rr'>
            <h3><?php echo $brand->name;?></h3>
            <div><?php echo $brand->mini_content ();?></div>
            <a href='<?php echo $brand->link;?>' target='_blank'>VISIT SITE</a>
          </div>
        </div>
<?php } ?>
    </div>
  </div>
</div>
