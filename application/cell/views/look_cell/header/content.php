<header class='<?php echo $is_fix ? 'ff' : 'x';?>'>
  <div>
    <a href='<?php echo base_url ('look');?>'>
      <img src='<?php echo base_url ('resource', 'image', 'looklogo.png');?>'>
    </a>
    <a <?php echo $key == 'abouts' ? 'class="a" ': '';?>href='<?php echo base_url ('look', 'abouts');?>'>
      <span>關於Look</span>
      <span>About</span>
    </a>
    <a href='<?php echo base_url ('look#product');?>'>
      <span>產品系列</span>
      <span>Product Series</span>
    </a>
    <a href='<?php echo base_url ('look#press');?>'>
      <span>媒體露出</span>
      <span>Press</span>
    </a>
    <a <?php echo $key == 'stores' ? 'class="a" ': '';?>href='<?php echo base_url ('look', 'stores');?>'>
      <span>全省代理商</span>
      <span>Store</span>
    </a>
    <a href=''>
      <span>聯絡我們</span>
      <span>Contact</span>
    </a>
    <a href=''>
      <span>Look粉絲團</span>
      <span>Facebook</span>
    </a>
  </div>
</header>