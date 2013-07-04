<script type="text/javascript">
  $(document).ready(function() {
    $('#confirm_btn').click(function(){
      $("#confirm").submit();
    });

    $("#confirm").validate({
      rules: {
        no_rek: "required",
        name_no_rek: "required",
      },
      messages: {
        no_rek: "Harap isi Nomor Rekening",
        name_no_rek: "Harap isi Nama Pemilik Nomor Rekening"
      }
    });

  });
</script>
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
  <h1>Konfirmasi</h1>
  <p>Data dirimu sudah tersimpan. Mohon segera melakukan pembayaran.</p>
  <div class="box2">
    <div class="left" style="width:60%">Gabung di Facebook Fanpage Vaseline untuk mendapatkan tips dan info seputar kulit serta produk Vaseline.</div>
    <div class="right"><a href="#"><img src="<?php echo base_url();?>assets/images/fbLike.png"></a></div>
    <div class="clear"></div>
  </div>
  <h2 style="float:left; width:50%; margin-bottom:5px">Tagihan Anda</h2>
  <div class="right" style="width:50%"><a href="<?php echo site_url('instafair/orderdetail/'.$order->id); ?>" style="text-decoration:none; font-size:12px"><img src="<?php echo base_url();?>assets/images/arrow.png"> LIHAT SELENGKAPNYA</a></div>
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
          }else if($order->order_status == 2){
            echo "Menunggu Approval";
          }else if($order->order_status == 3){
            echo "Sudah Dibayar";
          }
        ?>
      </td>
    </tr>
  </table>
  <h2>Konfirmasi Pembayaran</h2>
  <p>Jika sudah membayar, silahkan isi konfirmasi pembayaran.<br>
  </p>
  <form method="post" action="<?php echo site_url('instafair/submitconfirm'); ?>" id="confirm">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Nomor Rekening</td>
        <td width="5%" align="center">:</td>
        <td><label>
          <input type="text" name="no_rek" id="no_rek">
        </label></td>
      </tr>
      <tr>
        <td>Nama Pemilik Nomor Rekening</td>
        <td width="5%" align="center">:</td>
        <td><input type="text" name="name_no_rek" id="name_no_rek"></td>
      </tr>
    </table>
    <input type="hidden" name="order_id" value="<?php echo $order->id; ?>" />
    <input type="hidden" name="name" value="<?php echo $order->fullname; ?>" />
    <p align="center">Jika sudah membayar, silahkan isi konfirmasi pembayaran.</p>
    <div class="btn" id="confirm_btn" style="cursor:pointer;">Konfirmasi Pembayaran</div>
  </form>
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