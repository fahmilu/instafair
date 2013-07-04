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
    <div class="left" id="content-left">
      <h1>Terima Kasih Telah Melakukan Pembayaran</h1>
      <h2 style="float:left; width:50%; margin-bottom:5px">Tagihan Anda</h2>
      <div class="right" style="width:50%"><a href="#" style="text-decoration:none; font-size:12px"><img src="<?php echo base_url();?>assets/images/arrow.png"> LIHAT SELENGKAPNYA</a></div>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tab">
        <tr class="header">
          <th>Tanggal Tagihan</th>
          <th>Jatuh Tempo</th>
          <th>Total Biaya</th>
          <th>Status</th>
        </tr>
    <tr>
      <td class="borderR"><?php echo $orderdate; ?></td>
      <td class="borderR"><?php echo $enddate; ?></td>
      <td class="borderR">Rp 10.000</td>
      <td>
        <?php
          if($order->order_status == 1){
            echo "Belum Dibayar";
          }else if($order->order_status == 2 && $confirm_status == 1){
            echo "Menunggu Approval";
          }else if($confirm_status == 2){
            echo "Sudah Dibayar";
          }
        ?>
      </td>
    </tr>
      </table>
      <div class="box"><img src="<?php echo base_url();?>assets/images/check.png" style="float:left; margin-right:20px; margin-left:75px; vertical-align:middle"><span style="font-size:16px"> Terima kasih telah membeli produk Vaseline</span><br>
        Produk yang telah dibeli akan dikirimkan 7 hari dari sekarang.</div>
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