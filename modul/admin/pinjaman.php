
<script>
function kembali() {
    window.history.back();
}
</script>

<?php 
// pinjaman dan angsuran 
	
	$m = $_GET['act'];
	
	if($m =='input'){?>
		
	 <div class="row">
            <div class="col-md-12">
				<div class="widget wgreen">
				<div class="widget-content">
                  <div class="padd">
                    <br />
					<?php 
						$getID = $_GET['idAnggota'];
						$getList = mysql_query("select * from anggota where idAnggota = '$getID'");
						
						$row = mysql_fetch_object($getList);
					?>
                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="POST" action="?modul=simpan&act=proses">
                               <div class="col-md-6">
							  
							  <div class="form-group">
                                  <label class="col-lg-3 control-label">No Rekening</label>
                                  <div class="col-lg-8">
				<input type="hidden" name="idAnggota" value="<?php echo $row->idAnggota;?>">
			
                                    <input type="text" name="norekening" class="form-control"  value="<?php echo $row->noRekening;?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Nama Lengkap</label>
                                  <div class="col-lg-8">
                                    <input type="text" name="nama" class="form-control"  value="<?php echo $row->nama;?>" readonly>
                                  </div>
                                </div>
								
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label"></label>
                                  <div class="col-lg-5">
                                    <?php
										$result = mysql_query("SELECT * from layanan WHERE tipe='simpan'");  
										$jsArray = "var prdName = new Array();\n"; 
										echo '<select name="idLayanan" id="idLayanan" class ="form-control" required onchange="document.getElementById(\'jasa\').value = prdName[this.value]" onclick="fresh()">';  
										echo '<option value="" selected >JENIS SIMPANAN</option>';  
										while ($row = mysql_fetch_array($result)) {  
											 echo '<option value="' . $row['idLayanan'] . '">' . $row['namaLayanan'] . '</option>';  
											 $jsArray .= "prdName['" . $row['idLayanan'] . "'] = '" . addslashes($row['jasa']) . "';\n";  
										}  
										echo '</select>'; 
									?>
														  </div>
								  <div class="col-lg-3">
                                    <input type="text" name ="jasa" class="form-control" name="jasa" id="jasa" readonly value="<?php echo $data[jasa]?>">
									<script type="text/javascript">  
										<?php echo $jsArray; ?>  
									</script>
                                  </div>
                                </div> 
								
								 <div class="form-group">
                                  <label class="col-lg-3 control-label"></label>
                                  <div class="col-lg-5">
                                    <select name="jenis_transaksi" class="form-control" required>
										<option value="">JENIS TRANSAKSI</option>
										<option value="SETOR">SETOR</option>
										<option value="TARIK">TARIK</option>
									</select>
								</div>
								
								
								<div class="col-lg-3">
                                    <input type="text" name="tgl_simpan" id="tgl_simpan" required class="form-control" placeholder="Tgl Simpan">
                                  </div>
								
                                </div> 
								
								
							   </div>
							   
							    <div class="col-md-6">
							   <div class="form-group">
                                  <label class="col-lg-2 control-label">Jumlah</label>
                                  <div class="col-lg-10">
                                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Simpanan" required>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Keterangan</label>
                                  <div class="col-lg-10">
                                    <textarea name="ket" class="form-control" rows="3" placeholder="Keterangan Simpanan - Bisa di kosongkan"></textarea>
                                  </div>
								
								   
                                </div>  
								  <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-6">
                                   
                               
                                    <button type="submit" class="btn btn-sm btn-success">Proses</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="goBack();" >Reset</button>
                         
                                  </div>
                                </div>
							   </div>
							   
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-6">
                                    <div class="col-lg-offset-2 col-lg-6">
                                   
                                  </div>
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>
                  
              </div>  

            </div>

          </div>

  	<?php }
	
	elseif($m =='proses'){
		 $tglpinjam = $_POST['tgl_pinjaman'];
		 $idpemohon = $_POST['idpemohon'];
		 $idp	= $_SESSION['idPetugas'];
		 $kodeanggota = $_POST['kode_anggota'];
		 $besarpinjaman = $_POST['besar_pinjaman'];
		 $bunga =$_POST['bunga'];
		 $lamapinjaman =$_POST['lama_pinjaman'];
		 $ket =$_POST['keterangan'];
		 $totalpinjaman =$_POST['total_pinjaman'];
		 $angsuran =$_POST['angsuran'];
	
		 $idm = '0';
		 

	$a = mysql_fetch_array(mysql_query("select * from anggota where idAnggota  = '$idpemohon'"));
			
		$idkop = $a[kodeKoperasi];

		 
		 $sv = mysql_query("INSERT INTO pinjamawal VALUES(
		  '', 
		  '$idpemohon',
		  '$idp', 
		  '$idkop', 
		  '$tglpinjam', 
		  '$besarpinjaman',
		  '$bunga',
		  '$lamapinjaman', 
		  '$angsuran',
		  '$totalpinjaman',
		  '$ket',
		  '$idm', 
		  'Tunda',
		  '0', 
		  '0', 
		  '0')");
		 if($sv){
			 echo '<div class="alert alert-warning"><h4>DATA SUDAH DI PROSES UNTUK DI AKTIFKAN Max 3 x 24 Jam</h4>
                    </div>';
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=?modul=home">';
		 }
		 else{
			 echo '<div class="alert alert-warning"><h4>Upsss... Proses gagal - silahkan kontak Support!</h4>
                    </div>';
		 }
	}
	
	elseif($m =='pengajuan'){?>
	      <div class="row">
            <div class="col-lg-10">
              <div class="widget wgreen">

                

                <div class="widget-content">
                  <div class="padd">

                    <br />
					<?php  
						$ida = $_GET['idAnggota'];
						$x=mysql_fetch_array(mysql_query("SELECT * FROM anggota where idAnggota='$ida'"));
						
					?>
                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="POST" action="?modul=pinjam&act=proses">
 
			   <div class="form-group">
					<label class="col-lg-2 control-label">Tanggal Pinjaman</label>
						<div class="col-lg-4">
							<input placeholder="Tanggal Pinjaman" class="form-control" type="text" name="tgl_pinjaman" id="tgl_pinjaman" required>
							<input  type="hidden" name="idpemohon" value="<?php echo $x[idAnggota];?>">
						</div>
						<div class="col-lg-3">
						<input value="<?php echo $x[nama];?>"  id="kode_anggota" class="form-control" type="text" name="kode_anggota" id="tgl_pinjaman" readonly>
						
						</div>
						
						
				</div>
				
							
				<div class="form-group">
					<label class="col-lg-2 control-label">Besar Pinjaman</label>
						<div class="col-lg-4">
							<input placeholder="Besar Pinjaman" type="text" class="form-control"  name="besar_pinjaman" id="besar_pinjaman" onkeypress="return hrz_angka(event)" onchange="hitung()" required>
						</div>
						<div class="col-lg-1">
						<?php 
							$quer	=mysql_query("select * from layanan WHERE idLayanan = 'PINJAMAN'");
							$datar	=mysql_fetch_array($quer);
						?>
						<input type="text" class="form-control"  name="bunga" id="bunga" required size="5" value="<?php echo $datar['jasa'];?>" readonly="readonly">
						</div>
						
						<div class="col-lg-2">
						<input class="form-control" disabled placeholder="% (Persen)">
						</div>
				</div>
			
				
				<div class="form-group">
					<label class="col-lg-2 control-label">Lama Peminjaman</label>
						<div class="col-lg-4">
							<input placeholder="Lama Pinjaman" type="text" class="form-control"  name="lama_pinjaman" id="lama_pinjaman" required size="10" onkeypress="return hrz_angka(event)" onchange="hitung()">
							
						</div>
						<div class ="col-lg-3">
						<input class="form-control" placeholder="Bulan (Satuan Bulan)" disabled>
						</div>
				</div>
					<div class="form-group">
					<label class="col-lg-2 control-label">Keterangan</label>
						<div class="col-lg-7">
						  <textarea name="keterangan" id="keterangan" class="form-control" rows="2" placeholder="Informasi tambahan"></textarea>
					
						</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Angsuran Pinjaman</label>
						<div class="col-lg-4">
							<input readonly type="text" class="form-control"  name="angsuran" id="angsuran" required>
						</div>
						<label class="col-lg-1 control-label">Total</label>
							<div class="col-lg-2">
							<input readonly type="text" class="form-control"  name="total_pinjaman" id="total_pinjaman" required >
						</div>
				</div>
				
										
                                <div class="form-group">
                                  <div class="col-lg-offset-4 col-lg-12">
                                    <button type="submit" class="btn btn-sm btn-default">Proses Peminjaman</button>
                                    <button type="reset" class="btn btn-sm btn-danger" onclick="kembali()">Batal</button>
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>

              </div>  

            </div>

          </div>

	<?php }
	
	elseif($m =='prosespinjaman'){
		// proses pinjam ini merupakan proses yang di lakukan oleh manager atau admin untuk
		// melakukan persetujuan agar taller bisa melakukan pembayaran pinjaman.
		
		$tglproses = date("Y-m-d");
		$a = rand(11111,9999);
		$b = date("dmY");
		$nokontrak = $a ."". $b;
		$idp = $_SESSION['idPetugas'];
		$id = $_GET['idAnggota'];
	
			$ida = mysql_fetch_array(mysql_query("select * from pinjamawal where idAnggota = '$id'"));
		
			$proses = mysql_query("UPDATE pinjamawal SET
					idManager = '$idp',
					status = 'Setuju', 
					tglproses = '$tglproses', 
					tglkontrak = '$tglproses', 
					nokontrak = '$nokontrak'
						WHERE idpinjaman = '$ida[idpinjaman]';");
		
		
			if($proses){
				$c = mysql_fetch_object(mysql_query("select * from pinjamawal ORDER BY idpinjaman DESC LIMIT 1"));		
					$idAwal = $c->idpinjaman;
					$idAnggota=$c->idAnggota;
					$idKoperasi=$c->idKoperasi;
					$totalPinjam=$c->totalpinjaman;
					$sisaCicilan=$totalPinjam;
					$besarPinjam=$c->besarpinjaman;
					$angsuran=$c->angsuran;
					$bunga=$c->bunga;
					$lamaPinjam=$c->lamapinjaman;
					$keterangan=$c->keterangan;
					$tglPinjam=$c->tglpinjaman;
					$nokontrak=$c->nokontrak;
					$detailwaktu=date("Y-m-d H:i:s");
					$notransaksi			=rand(10000,99999);
					
						
				$simpan = mysql_query("INSERT INTO pinjaman VALUES('','$idAwal','$idAnggota','$idp','$idKoperasi','$totalPinjam','$sisaCicilan','$besarPinjam','$angsuran','0','$bunga','$lamaPinjam','$keterangan','$tglPinjam','$detailwaktu','$nokontrak')");
				
						$q		=mysql_query("SELECT * FROM anggota WHERE idAnggota='$idanggota'");
						$rc		=mysql_fetch_array($q);

				$kas=mysql_query("INSERT INTO kas VALUES ('','P - $notransaksi','$tglPinjam','Pinjaman an $rc[nama]','$idp','$idAnggota','$idKoperasi','PINJAMAN','',$besarPinjam,'$detailwaktu')"); 					
				
				// FITUR KONTRAK
					// $datakontrak = mysql_query("select * from anggta, pinjaman where anggota.idAnggota = pinjaman.idAnggota and pinjaman.idAnggota = '$idAnggota'");
					// $d = mysql_fetch_array($datakontrak);
						// $namaanggota = $data['nama'];
						// $pekerjaananggota = $data['pekerjaan'];
						// $alamat = $data['alamat'];
						// $kecamatan = $data['kec'];
						// $desa = $data['desa'];
						// $provinsi = $data['provinsi'];
						// $provinsi = $data['provinsi'];
				
				// $kontrak = mysql_query("INSER INTO kontrak VALUES(
				// '',
				// '$nokontrak',
				// '$namaanggota',
				
				// )");

								
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=?modul=home">';
									
			}
	}
		
	elseif($m =='prosesbatal'){
		$tglproses = date("d-m-Y");
		$a = rand(11111,9999);
		$b = date("dmY");
		$nokontrak = $a ."". $b;
		$idp = $_SESSION['idPetugas'];
		
		
		$id = $_GET['idAnggota'];
		$ida = mysql_fetch_array(mysql_query("select * from pinjamawal where idAnggota = '$id'"));
		
		$proses = mysql_query("UPDATE pinjamawal SET
		idManager = '$idp',
		status = 'Batal', 
		tglproses = '$tglproses', 
		tglkontrak = '$tglproses', 
		nokontrak = '$nokontrak'
			WHERE idpinjaman = '$ida[idpinjaman]';
		");
		if($proses){
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=?modul=home">';
		}
	
	}
	
	elseif($m =='hapus'){
			      mysql_query("DELETE FROM pinjamawal WHERE idAnggota ='$_GET[idAnggota]'");
				  echo '<div class="alert alert-warning"><h4>DATA PEMINJAMAN KOPERASI  BERHASIL DI HAPUS!!!</h4>
                    </div>';
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=?modul=home">';
		
	}
	
	elseif($m =='angsuran'){?>
	
          <div class="row">
            <div class="col-md-6">
			<div class="widget wgreen">
               <div class="widget-content">
                  <div class="padd">

                    <br />
                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="POST" action="?modul=pinjam&act=proses_angsuran">
					  <?php 
						$ida = $_GET['idAnggota'];
						$idalist = mysql_fetch_array(mysql_query("select 
							pinjaman.idAwal as pinjamanid,
							pinjaman.angsuran as angsuran,
							pinjaman.nokontrak as nokontrak,
							pinjaman.totalPinjam as totalpinjaman,
							pinjaman.bunga as bunga,
							anggota.idAnggota as anggotaid,
							anggota.kodeKoperasi as koperasiid,
							anggota.nama as namaanggota,
							anggota.noRekening as norek
							from anggota inner join pinjaman on anggota.idAnggota = pinjaman.idAnggota where anggota.idAnggota = '$ida'"));

	
								// listing data 
								$pinjamanid 	= $idalist[pinjamanid]; // kodepinjaman anggota
								$koperasiid 	= $idalist[koperasiid]; // kodepinjaman anggota
								$anggotaid 		= $idalist[anggotaid]; // nama anggota koperasi yang pinjam
								$namaanggota 	= $idalist[namaanggota]; // nama anggota koperasi yang pinjam
								$norek 			= rek($idalist[norek]); // no rekening anggota / koperasi
								$totalpinjaman 	= $idalist[totalpinjaman]; // no rekening anggota / koperasi
								$bunga 			= $idalist[bunga]; // no rekening anggota / koperasi
								$angsuran 		= $idalist[angsuran]; // no rekening anggota / koperasi
								
								
							$qAngsur		=mysql_query("SELECT * FROM angsur WHERE idPinjaman='$pinjamanid'");
								$angsuran_ke	=mysql_num_rows($qAngsur);
				

							  ?>
                             
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Nama Anggota</label>
                                  <div class="col-lg-8">
                                    <input type="hidden"  name="pinjamanid" class="form-control" value="<?php echo $pinjamanid; ?>">
                                    <input type="hidden"  name="anggotaid" class="form-control" value="<?php echo $anggotaid; ?>">
                                    <input type="hidden"  name="koperasiid" class="form-control" value="<?php echo $koperasiid; ?>">
                                   

								   <input type="text" class="form-control" value="<?php echo $namaanggota; ?>" readonly>
                                  </div>
                                </div>
                                
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Rek. Koperasi</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="koperasiid" value="<?php echo $norek; ?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Total Pinjaman</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="total" value="<?php echo $totalpinjaman; ?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Angsuran Ke -</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="angsuranke" value="<?php echo $angsuran_ke+1;  ?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Jumlah Angsuran</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" name="jumlangsuran" value="<?php echo $angsuran; ?>" readonly>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-3 control-label">Tgl Angsuran</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control"  name="tgl_angsuran" id="tgl_angsuran" placeholder="Tanggal Setor Angsuran">
                                  </div>
                                </div>
							  
                                
                                <div class="form-group">
                                  <div class="col-lg-offset-3 col-lg-8">
                                    <button type="submit" class="btn btn-sm btn-info">Setor Angsuran</button>
                                    <button type="reset" class="btn btn-sm btn-danger" onclick="kembali()">Batal Proses</button>
                                   
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>
                 
              </div>  

            </div>

          </div>

        
		
	<?php }
	elseif($m=='proses_angsuran'){
	 $idp = $_SESSION['idPetugas'];
	 $pinjamanid 	= $_POST['pinjamanid'];
	 $petugas 		= $_SESSION['idPetugas'];
	 $anggotaid		= $_POST['anggotaid'];
	 $koperasiid		= $_POST['koperasiid'];
	 $total	= $_POST['total'];
	 $jumlangsuran	= $_POST['jumlangsuran'];
	 $angsuranke		= $_POST['angsuranke'];
	 $tgl_angsuran	= $_POST['tgl_angsuran'];
	 $detil_waktu	=date("Y-m-d H:i:s");	
		$notransaksi			=rand(10000,99999);	
	
	$simpan = mysql_query("INSERT INTO angsur VALUES('','$pinjamanid','$petugas','$anggotaid','$koperasiid','$total','$jumlangsuran','$angsuranke','$tgl_angsuran','$detil_waktu')"); 	
			
		
			$qPinjaman	=mysql_query("SELECT * FROM pinjaman WHERE idAwal='$pinjamanid'");
			
			$pinjaman	=mysql_fetch_array($qPinjaman);
			$bayar_lama	=$pinjaman[pembayaran];
			$sisa_lama	=$pinjaman[sisaCicilan];

			$bayar_baru	=$bayar_lama+$pinjaman[angsuran];
			$sisa_baru	=$sisa_lama-$pinjaman[angsuran];
		
						$q		=mysql_query("SELECT * FROM anggota WHERE idAnggota='$anggotaid'");
						$rc		=mysql_fetch_array($q);
						
		
			$sql2		=mysql_query("UPDATE pinjaman SET pembayaran='$bayar_baru',sisaCicilan='$sisa_baru' WHERE idAwal='$pinjamanid' ");

	$kas=mysql_query("INSERT INTO kas VALUES ('','A - $notransaksi','$tgl_angsuran','Angsuran an. $rc[nama]','$idp','$rc[idAnggota]','$rc[kodeKoperasi]','PINJAMAN',$jumlangsuran,'','$detil_waktu')"); 	

		
			 echo '<div class="alert alert-success"><h4>Data Berhasil di Proses</h4></div>';
			 echo '<META HTTP-EQUIV="Refresh" Content="2; URL=?modul=home">';
	
							
	}
	
	
	else{?>
	

		<div class="row">
            <div class="col-md-12">

              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">LIST PERMOHONAN PINJAMAN</div>
                  <div class="widget-icons pull-right">
					<a href="?modul=anggota&act=input" title="Hanya jika belum terdaftar">Tambah Permohonan</a>
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    
							<!-- Table Page -->
							<div class="page-tables">
								<!-- Table -->
								<div class="table-responsive">
									<table class="table table-striped table-hover table-responsive table-bordered">
										<thead>
											<tr>
												<th>No Rekening</th>
												<th>Nama Anggota</th>
												<th>No KTP</th>
												<th>No Telepon</th>
												<th>Saldo</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
					<?php 
					// SELECT * FROM nama_tabel_1 WHERE nama_kolom_di_tabel_1 NOT IN ( SELECT nama_kolom_di_tabel_2 FROM nama_tabel_2 )
						$anggota = mysql_query("select * from anggota");
						while ($r = mysql_fetch_array($anggota)){
							$saldo = rupiah($r[saldo]);
							echo "<tr>
									<td>$r[noRekening]</td>
									<td>$r[nama]</td>
									<td>$r[nik]</td>
									<td>$r[tlp]</td>
									<td>$saldo</td>";
						$listpinjam = mysql_fetch_array(mysql_query("select * from pinjamawal where idAnggota = '$r[idAnggota]'"));
						$listok = mysql_fetch_array(mysql_query("select * from pinjaman where idAnggota = '$r[idAnggota]'"));
						if($listpinjam > 0 && $listok > 0){
							
							
							echo "<td>
							<span class='label label-info'>PROSES</span>
							<a href='?modul=pinjam&act=angsuran&idAnggota=$r[idAnggota]'>
							<span class='label label-success'>ANGSURAN</span></a>
							</td>";
						}
						elseif($listpinjam > 0 ){
							
								echo "<td>
							<a href='#myModal' data-toggle='modal'>
							<span class=\"label label-warning\">ON PROSES</span></a>
							
							</td>";
						}						
						else{
							echo "<td><a href='?modul=pinjam&act=pengajuan&idAnggota=$r[idAnggota]'>
							<span class='label label-info'>PENGAJUAN</span></a></td>";
						}
						
									echo "</tr>";
									
							}
					?>
					</table>
									<div class="clearfix"></div>
								</div>
								</div>
							</div>

					
                  </div>
                 
                </div>
              </div>  
              
            </div>
			       <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Pesan Pengajuan Pinjaman</h4>
                      </div>
                      <div class="modal-body">
                        <p>Salam. Pengajuan pinjaman sudah di informasikan kepada Admin, saat ini tim analisa sedang bekerja atau Dalam pertimbangan 
						Manager akan pengajuan pinjaman, untuk itu harap bersabar.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>

                      </div>
                    </div>
					</div>
					</div>
	<?php }

?>
             