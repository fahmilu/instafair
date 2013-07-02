<div id="main-wrap">
  <div id="menu">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Product</a></li>
      <li><a href="#">Promotions</a></li>
      <li><a href="#">Prove It Station</a></li>
      <li><a href="#">My UV Skin Report</a></li>
    </ul>
  </div>
  <div id="content">
    <form action="<?php echo site_url('instafair/submitorder'); ?>" method="post">
    <div class="left" id="content-left">
      <h1>Pemesanan</h1>
      <p>Isi data dirimu dengan lengkap dan jelas.</p>
      <p><a href="#"><img src="<?php echo base_url();?>assets/images/btBack.png" width="69" height="20"></a></p>
      <h2>Data Pemesan</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%">Nama Pemesan<br/>
          <input type="text" name="name" id="name" /></td>
          <td>E-mail<br/>
              <input type="text" name="email" id="email" /></td>
          <td width="33%">Telepon<br/>
              <input type="text" name="telp" id="telp" /></td>
        </tr>
        <tr>
          <td colspan="2" rowspan="2">Alamat Lengkap<br/>
            <textarea name="address" rows="4" id="address"></textarea></td>
          <td width="33%">Provinsi<br/>
            <label>
            <select name="city" id="city">
              <option selected>Jakarta</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td width="33%">Kode Pos<br/>
              <input type="text" name="kodepos" id="kodepos" /></td>
        </tr>
      </table>
      <p></p>
      <h2>Product yang dipesan</h2>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tab">
        <tr class="header">
          <th>Produk</th>
          <th>Jumlah</th>
          <th>Total Biaya</th>
        </tr>
        <tr>
          <td class="borderR firstTab"><img src="<?php echo base_url();?>assets/images/product/01.png" width="26" height="72" style="float:left; margin-right:15px"> Vaseline Insta Fair<br>
            95 mL</td>
          <td class="borderR">1 Produk</td>
          <td>Rp 10.000</td>
        </tr>
      </table>
      <h2>Pembayaran dapat ditransfer ke: </h2>
      <div class="box"><img src="<?php echo base_url();?>assets/images/mandiri.png" style="float:left; margin-right:20px; vertical-align:middle">Bank Mandiri, KCP Jakarta Iskandarsyah.<br>
        a/n PT. Thinksmart Ide Brajendra<br>
        126-00-0757575-5</div>
      <p align="center"><input name="agree" type="checkbox" value="1"> Saya setuju dengan <a href="#mekanisme" class="login-window">Mekanisme</a> yang berlaku.</p>
      <div class="btn">Submit</div>
    </div>
    <div class="right" id="content-right">
  <div id="submenu">
    <ul>
      <li class="one"><a href="#">UNDANG TEMAN</a></li>
      <li class="twoAct"><a href="#">PEMESANAN</a></li>
      <li class="three"><a href="#">KONFIRMASI</a></li>
    </ul>
  </div>
</div>
<div class="clear"></div>
</form>
  </div>
  <div id="bottom">
    <div class="left"><a href="#mekanisme" class="login-window"><img src="<?php echo base_url();?>assets/images/arrow.png" width="7" height="8"> Mekanisme</a></div>
    <div class="right" style="margin-right:170px">new Vaseline Insta Fair<br/>
      Wujudkan Kulit 4x Lebih Cerah</div>
    <div class="clear"></div>
  </div>