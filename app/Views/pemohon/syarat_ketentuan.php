<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Syarat & Ketentuan</h1>

</div>
<div class="card border-left-info shadow h-100">
	<div class="card-body">
		<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="modal-body">
					<p><strong></strong><strong>SYARAT DAN KETENTUAN</strong></p>
					<p align="justify">Untuk melanjutkan proses berikutnya, Anda terlebih dahulu membaca dan memahami syarat dan ketentuan yang berlaku dalam proses pengajuan ini. Dengan mengakses atau menggunakan Situs Aplikasi SipKe-Mas, informasi yang disediakan oleh atau dalam Situs, berarti Anda telah memahami dan menyetujui serta terikat dan tunduk dengan segala syarat dan ketentuan yang berlaku dalam Situs ini.</p>
					<p>&nbsp;</p>
					<p><strong>ATURAN </strong><strong>PENGAJUAN</strong></p>
					<p>&nbsp;</p>
					<p>Sebelum melakukan input ajuan, Anda diwajibkan membaca, memahami, dan mematuhi Syarat dan Ketentuan serta Kebijakan yang berlaku di Situs ini.</p>
					<ol>
						<li align="justify">Anda bisa mengajukan diri untuk mendapatkan layanan program dari SipKe-Mas seperti yang ditampilkan dalam Situs ini. Anda sepenuhnya bertanggung jawab atas pilihan Layanan program yang SipKe-Mas telah sediakan.</li>
						<li align="justify">Anda diharuskan memberi data informasi pribadi yang sebenarnya dan tidak memberikan informasi menyimpang dan/atau informasi yang tidak relevan dalam melakukan proses input. Selain itu Anda juga diharuskan memberi kontak telepon dan email yang benar dan valid.</li>
						<li align="justify">Pengelola SipKe-Mas berhak untuk tidak memproses pengajuan yang tidak memenuhi persyaratan ataupun tidak memberikan informasi yang benar dan valid atau jika ditemukan hal-hal yang melanggar ketentuan dari Pengelola SipKe-Mas.</li>
						<li align="justify">Pengaju yang telah sukses melakukan proses input, dapat melakukan akses tracking ajuan kapan pun melalui Situs inidengan cara memasukkan kode unik dikolom pencarian.</li>
						<li align="justify">Dengan memilih setuju dengan Syarat dan ketentuan ini.Maka anda bertanggung jawab untuk &nbsp;memastikan bahwa Anda setuju dengan syarat dan kondisi sebelum mengisikelengkapan administrasi yang diperlukan.</li>
					</ol>
					<p>&nbsp;</p>
					<p><strong>UMUM</strong></p>
					<ol>
						<li align="justify">Pengaju yang telah suskes melakukan input ajuan dalam situs ini, berarti telah sepakat dan menyetujui bahwa data yang telah diinput dalam pengajuan ini sepenuhnya menjadi milik Pengelola SipKe-Mas.</li>
						<li align="justify">Pengelola SipKe-Mas berhak untuk menutup atau mengubah atau memperbaharui Syarat dan Ketentuan ini setiap saat tanpa pemberitahuan, dan berhak untuk membuat keputusan akhir jika tidak ada ketidakcocokan. Pengelola tidak bertanggung jawab atas kerugian dalam bentuk apa pun yang timbul akibat perubahan pada Syarat dan Ketentuan.</li>
						<li align="justify">Anda dapat menghubungi Pengelola SipKe-Mas perihal status pengajuan yang telah disubmit di kolom Tanya dengan menyertakan kode unik yang telah Aplikasi SipKe-Mas berikan sebelumnya.</li>
					</ol>
					<p>&nbsp;</p>
				</div>
				<?= form_open("/pemohon/form_ajuan", ['class' => 'formPernyataan']); ?>
				<?= csrf_field(); ?>
				<div class="modal-footer">
					<div class="row mb-0">
						<div class="col checkbox">
							<label for="persetujuan"><input type="checkbox" name="persetujuan" id="persetujuan" required="">
								Saya setuju dengan syarat dan ketentuan
							</label>
							<p style="border-radius: 5px;" class="text-center text-white small bg-info p-1">*Silahkan checklist setuju untuk melanjutkan</p>
						</div>
					</div>
					<br>
					<div class="row mt-0">
						<div class="col text-center">
							<button type="submit" class="btn btn-success btn-md btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text">Lanjutkan</span></button>
							<!-- <a href="/pemohon/form_ajuan" class="btn btn-success btn-md btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text">Lanjutkan</span></a>&nbsp;&nbsp; -->
						</div>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>