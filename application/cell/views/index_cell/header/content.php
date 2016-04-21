<header<?php echo $is_index ? '' : ' class="nf"';?>>
  <div>
    <img src='<?php echo base_url ('resource', 'image', 'logo.png');?>'>
    <nav>
      <a href='<?php echo base_url ('#contact');?>'><span>contact</span><span>聯絡我們</span></a>
      <a href='<?php echo base_url ('#about');?>'><span>About</span><span>關於嘉豪</span></a>
      <a href='<?php echo base_url ('#main');?>'><span>Brand</span><span>品牌專區</span></a>
      <a href='<?php echo base_url ('#main');?>'<?php echo $is_index ? '' : ' class="a"';?>><span>News</span><span>最新消息</span></a>
      <a href='<?php echo base_url ();?>'><span>Home</span><span>首頁</span></a>
    </nav>
  </div>
</header>
