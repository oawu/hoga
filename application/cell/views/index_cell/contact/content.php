<div id='contact_'>
  <form action='<?php echo base_url ('mail');?>' method='post'>
    <header>
      <h2>Contact</h2>
      聯絡我們
      <div>
        <p>如您有任何疑問，請與我們聯繫。「<b>*</b>」為必填項。</p>
        <p>Should you have any questions, please contact us. * is required entry.</p>
      </div>
    </header>

    <div>
      <div>
        <input type='text' name='company' placeholder='公司名稱 / Company Name' />
        <input type='text' name='name' placeholder='您的稱呼 / Your Name *' />
        <input type='text' name='mail' placeholder='電子信箱 / E-mail address *' />
        <input type='text' name='phone' placeholder='連絡電話 / Telephone Number' />
      </div>
      <textarea name='message' placeholder='請輸入您的問題或意見 / Please enter a question or topic here. *'></textarea>
    </div>

    <div>
      <button type='submit'>Send</button>
    </div>
  </form>
</div>
