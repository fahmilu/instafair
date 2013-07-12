<div id="main-wrap">
    <div id="menu">
      <ul>
        <li><a href="http://www.vaselineamazingskin.com/home">Home</a></li>
        <li><a href="http://www.vaselineamazingskin.com/products/detail/201">Product</a></li>
        <li><a href="http://www.vaselineamazingskin.com/promo">Promotions</a></li>
        <li><a href="http://www.vaselineamazingskin.com/myuvskinreport">Skin Expert</a></li>
        <li><a href="http://www.vaselineamazingskin.com/instafair">Instafair</a></li>
      </ul>
    </div>
  <div id="content">
    <div class="left" id="content-left">
      <h1>Konfirmasi</h1>
      <p>Data dirimu sudah tersimpan. Mohon segera melakukan pembayaran.</p>
      <p><a href="<?php echo site_url('instafair/confirmation'); ?>"><img src="<?php echo base_url();?>assets/images/btBack.png" width="69" height="20"></a></p>
      <h2>Data Pemesan</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Nama Pemesan</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->fullname; ?></td>
        </tr>
        <tr>
          <td>E-mail</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->email; ?></td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->phone_number; ?></td>
        </tr>
        <tr>
          <td>Alamat Lengkap</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->address; ?></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->provinsi; ?></td>
        </tr>
        <tr>
          <td>Kode Pos</td>
          <td width="5%" align="center">:</td>
          <td><?php echo $order->zip_code; ?></td>
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
      <p align="center">Jika sudah membayar, silahkan isi konfirmasi pembayaran.</p>
      <a href="<?php echo site_url('instafair/confirmation'); ?>"><div class="btn">Konfirmasi Pembayaran</div></a>
    </div>
    <div class="right" id="content-right">
  <div id="submenu">
    <ul>
      <li class="one"><a href="#">UNDANG TEMAN</a></li>
      <li class="two"><a href="#">PEMESANAN</a></li>
      <li class="threeAct"><a href="#">KONFIRMASI</a></li>
    </ul>
  </div>
</div>
<div class="clear"></div>
  </div>
  <div id="bottom">
    <div class="left"><a href="#mekanisme" class="login-window"><img src="<?php echo base_url();?>assets/images/arrow.png" width="7" height="8"> Mekanisme</a></div>
    <div class="right" style="margin-right:170px">new Vaseline Insta Fair<br/>
      Wujudkan Kulit 4x Lebih Cerah</div>
    <div class="clear"></div>
  </div>