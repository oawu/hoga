<?php if (!$banners) return;?>

<div id='banner_'>
  <a><span class='icon-chevron-thin-left'></span></a>
  <div class='n<?php echo count ($banners);?>'>
<?php 
    foreach ($banners as $banner) { ?>
      <img src="<?php echo $banner->name->url ();?>">
<?php 
    }?>
  </div>
  <a><span class='icon-chevron-thin-right'></span></a>
</div>
