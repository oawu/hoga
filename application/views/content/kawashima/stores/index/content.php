<?php echo render_cell ('kawashima_cell', 'header', true, 'stores');?>

<div id='banner'></div>

<div class='container'>
<?php
  foreach ($tags as $tag) { ?>
    <div class='tag'>
      <div class='header'>
        <div>
          <span><?php echo $tag->name;?></span>
          <span><?php echo $tag->en_name;?></span>
        </div>
      </div>

<?php if ($tag->stores) { ?>
        <div class='stores'>
    <?php foreach ($tag->stores as $store) { ?>
            <div class='store'>
              <h3><?php echo $store->name;?></h3>
              <span><?php echo $store->phone;?></span>
              <span><?php echo $store->address;?></span>
            </div>
    <?php } ?>
        </div>
<?php } ?>
    </div>
<?php
  } ?>
</div>
<?php echo render_cell ('kawashima_cell', 'up');?>
<?php echo render_cell ('kawashima_cell', 'footer', false);?>
