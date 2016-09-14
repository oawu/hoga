<?php
foreach ($presses as $press) { ?>
  <div>
    <img src='<?php echo $press->small->url ();?>' />
    <span><?php echo $press->title;?></span>
    <a data-id='<?php echo $press->id;?>' data-src='<?php echo $press->big->url ();?>'>> 詳細介紹</a>
  </div>
<?php
}
