<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
   <head>
       
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SI Tutorial</title>
	
	
	<style>
		.hr {
		border-bottom: double 2px #999;
		padding: 10px 0;
		width: 87%;
		margin-left:auto;margin-right:auto;
}
	
	</style>
	</head>
 <body > 
				
				<table border ='0' width="750"  cellpadding="0" cellspacing="0" style="border:0px solid black;margin-left:auto;margin-right:auto;">      
								
				<tr><th rowspan=3 width="80" style="text-align:center" ><img width="40" src="<?= base_url(); ?>/assets/img/logo_pms.png"></th><th style="text-align:left"><p style="font-family: times"><font size="4">Sekretariat Daerah Bidang Kesejahteraan Rakyat</font></p></th></tr>
				<tr><th style="text-align:left"><p style="font-family: times"><font size="3"><b>Pemerintah Kota Surakarta</b></font></p></th>
				</tr>
				<tr><th style="text-align:left"><p style="font-family: times"><font size="2">Komp. Balai Kota, JL. Jend. Sudirman, No. 2Kp. Baru, Kec. Ps. Kliwon Kota Surakarta, Jawa Tengah 57133</font></p></th>
				</tr>	
				</table>				
				<div class="hr"></div>
				
				<h3 align='center'><?php echo $judul?></h3>
					<table align='left' cellpadding="0" cellspacing="0" >      
				<tr align="left"><td rowspan=5 width='150'><td><font size="3"><b>Kode </b></td><td> : &nbsp;</td><td colspan=4 ><font size="3"><?php echo $program['kodeBantuan']; ?></td></font></tr>
				<tr align="left"><td><font size="3"><b>Nama Program</b></td><td> :&nbsp; </td><td colspan=4 ><font size="3"><?php echo $program['namaProgram'];?></td></font></tr>					
				<tr align="left"><td><font size="3"><b>Jenis Bantuan</b></td><td> : &nbsp;</td><td colspan=4 ><font size="3"><?php echo $program['JnsBantuan'];?></td></font></tr>	
				<?php
						setlocale(LC_TIME, 'id_ID.utf8');
						$tgl =  strftime('%A %d %B %Y', strtotime($program['tgInput'])); //2020-11-02//$jurnal_->ftgl;
						
										
				?>
				<tr align="left"><td><font size="3"><b>Tanggal Input</b></td><td> : &nbsp;</td><td colspan=4 ><font size="3"><?php echo $tgl;?></td></font></tr>	
				
				</table>
				<br>
				
				<?php 
				$no=1;
				
				 ?>
				<table  border="1" cellpadding="1" cellspacing="0" width="90%" align='center'>				
				
				<tr>
					<th width="40"><font size="3">No</th>
					<th width="120"><font size="3">NIK</th>
					<th width="250"><font size="3">Nama</th>  
					<th width="350"><font size="3">Alamat</th>
					<th width="100"><font size="3">Status</th>
					<th width="100"><font size="3">Ajuan</th>
					<th width="100"><font size="3">Tanggal</th>
					   
				</tr>
						<?php	
					
					
					 foreach($ajuan_all as $jurnal_)					
					{
					?>
					<tr>
						<td align='center'><font size="2"><?= $no;?>.</font></td>
						<td align='center'><font size="2"><?php echo $jurnal_['NIK']; ?></font></td>
						<td align='left'><font size="2"><?php echo $jurnal_['Nama'];  ?></font></td>
						<td align='left'><font size="2"><?php echo $jurnal_['Alamat'];  ?></font></td>
						<td align='center'><font size="2"><?php  echo $jurnal_['StatusAjuan'];  ?></font></td>
						<td><font size="2"><?php $ajuan = "Rp " . number_format($jurnal_['Kebutuhan'],2,',','.'); echo $ajuan;  ?></font></td>
						<td align='center' ><font size="2"><?php echo strftime('%d %B %Y', strtotime($jurnal_['tgAjuan'])) ;  ?></font></td>
						
						
						<?php $no++; ?>
					</tr>						
						<?php
						}						
						?>		
					
					
				</table> 
				
				 
				<br><br>
				<table align='right'>      
				<tr align='center'><th><font size="3"> Surakarta,................</th><th rowspan='3' width='200'></th></tr>
				<tr><td height='50'>&nbsp;</td></tr>
				<tr align='center'><th><font size="3"><?php //echo $pendamping ;?></th></tr>
				</table>
	     


	
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
 
			
 </body>
 
</html>

