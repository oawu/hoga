<?php
  foreach ($products as $product) { ?>
    <div>
      <img src='<?php echo $product->small->url ();?>' />
      <div>
        <span><?php echo $product->title;?></span>
        <span><?php echo $product->desc;?></span>
      </div>
      <a data-id='<?php echo $product->id;?>' data-src='<?php echo $product->big->url ();?>'>> 詳細介紹</a>
    </div>
<?php
  }
