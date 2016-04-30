<?php echo render_cell ('look_cell', 'header', true, 'abouts');?>

<div id='banner'>
  <img src='<?php echo base_url ('resource', 'image', 'abouttopbg.jpg');?>'>
  <div>
    <div class='t'>
      <img src='<?php echo base_url ('resource', 'image', 'stortopicon.png');?>'>
      <span>ABOUT LOOK</span>
      <span>關於 ▪ LOOK</span>
    </div>
  </div>
</div>

<div id='tab'>
  <div>
    <a href="<?php echo base_url ('look', 'abouts');?>" class='a'><span>品牌理念</span>．Philosophy</a>
    <a href="<?php echo base_url ('look', 'abouts', 2);?>"><span>品牌故事</span>．Brand Story</a>
  </div>
</div>

<div id='lo'>
  <div>
    <div class='l'><img src='<?php echo base_url ('resource', 'image', 'ablogo.png');?>'></div>
    <div class='r'>
      <div>不會大作廣告，但以產品取勝。</div>
      <div>將藝術、日常生活、技術經驗與傳統手工完美結合。</div>
      <div>將人性及客戶的滿意度作為價值的核心。</div>
      <div>通過調查及事先察覺未來的需求、預期及習慣，以創新的方式製作領先潮流的產品。</div>
    </div>
  </div>
</div>

<div class='title'>
  <div>您所購買的標有「意大利製造」標籤的眼鏡，真的是意大利製造嗎？</div>
</div>

<div class='value'>
  <div>現時，在光學領域，標有「意大利製造」標籤的鏡框比比皆是，儘管他們完全是在其他成本低廉的國家所生產。LOOK不會批准此做法，因為這侵犯了消費者對所購買產品產地適當的知情權。</div>
  <div>購買LOOK任何產品，即擁有意大利長久工藝的品質承諾。意大利產品的工藝幾個世紀以來不斷完善，融合創造天賦與前衛風格，具有鮮明的社會特色。</div>
</div>


<div class='title'>
  <div>您將獲得遠超想像的體驗！您將獲得遠超想像的體驗！</div>
</div>

<div class='value'>
  <div>確保我們的產品真實可靠，由傳統意大利製造業及滿懷熱忱的工人製造，質量上乘，可滿足客戶的更高要求。 我們知悉新客戶想了解更多有關所購買產品資訊的需要。 Look概念工廠的產品產自意大利，這一點毫無疑問。</div>
</div>


<div id='say'>
  <div>
    <span>設計師這麼說</span>
    <span>Designer Say</span>
  </div>
</div>

<div class='bl'>
  <div>
    <div class='l'>
      <span>創意是直覺行動，是形體與和諧的表達；是內在視野不斷演進的表現。</span>
      <span>Augusto Valentini</span>
    </div>
    <div class='r'>
      <img src='<?php echo base_url ('resource', 'image', 'design01.jpg');?>'>
    </div>
  </div>
</div>

<div class='bl'>
  <div>
    <div class='l'>
      <span>我四處觀察人們的行為，並且喜歡揣測他們的偏好變化。<br/><br/>對我而言，這是靈感與情緒的源泉，一種生活體驗。</span>
      <span>Giuseppe De Riva</span>
    </div>
    <div class='r'>
      <img src='<?php echo base_url ('resource', 'image', 'design02.jpg');?>'>
    </div>
  </div>
</div>

<br/>
<br/>
<nav>
  <div>
    <a href='<?php echo base_url ('look');?>'>HMOE</a> > <a href='<?php echo base_url ('look', 'abouts');?>' class='s'>About</a>
  </div>
</nav>
<?php echo render_cell ('look_cell', 'footer', false);?>
