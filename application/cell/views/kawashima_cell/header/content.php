<header class='<?php echo $is_fix ? 'ff' : 'x';?>'>
  <div>
    <a href='<?php echo base_url ('kawashima');?>'>
      <img src='<?php echo base_url ('resource', 'image', 'kawashima', 'navLogo.jpg');?>'>
    </a>
    <a href='<?php echo base_url ('kawashima#abouts');?>'>
      <span>關於川嶋</span>
      <span>About</span>
    </a>
    <a href='<?php echo base_url ('kawashima#product');?>'>
      <span>產品系列</span>
      <span>Product Series</span>
    </a>
    <a href='<?php echo base_url ('kawashima#press');?>'>
      <span>媒體露出</span>
      <span>Press</span>
    </a>
    <a <?php echo $key == 'stores' ? 'class="a" ': '';?>href='<?php echo base_url ('kawashima', 'stores');?>'>
      <span>全省代理商</span>
      <span>Store</span>
    </a>
    <a href='mailto:info@hogaoptical.com.tw'>
      <span>聯絡我們</span>
      <span>Contact</span>
    </a>
    <a href='https://www.facebook.com/kawashimaoptical/' target='_blank'>
      <span>川嶋粉絲團</span>
      <span>Facebook</span>
    </a>
  </div>
</header>