<?php echo render_cell ('look_cell', 'header', true, 'stores');?>

<div id='banner'>
  <img src='<?php echo base_url ('resource', 'image', 'storetopbg.jpg');?>'>
  <div>
    <div class='t'>
      <img src='<?php echo base_url ('resource', 'image', 'stortopicon.png');?>'>
      <span>STORE</span>
      <span>全省代理商</span>
    </div>
  </div>
</div>
<?php 
  foreach ($tags as $tag) { ?>
    <div class='tag'>
      <div>
        <div class='ent'><span><?php echo $tag->en_name;?></span>asdasdsd</div>
        <div class='t'><img src='<?php echo base_url ('resource', 'image', 'storesmallicon.png');?>' /><?php echo $tag->name;?></div>
        <div class='ss'>
    <?php foreach ($tag->stores as $store) { ?>
            <div>
              <span><?php echo $store->name;?></span>
              <div><div><img src='<?php echo base_url ('resource', 'image', 'phone.png');?>'/></div><?php echo $store->phone;?></span></div>
              <div><div><img src='<?php echo base_url ('resource', 'image', 'map.png');?>'/></div><?php echo $store->address;?></span></div>
              <div class='map' data-address='<?php echo $store->address;?>'></div>
            </div>
    <?php } ?>
        </div>
      </div>
    </div>
<?php
  } ?>

<nav>
  <div>
    HMOE > Store
  </div>
</nav>
<?php echo render_cell ('look_cell', 'footer', false);?>
