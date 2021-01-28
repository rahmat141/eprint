<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">

				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('Barang/index/'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Data Konsumen</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<div class="content">

		<div class="container-fluid ml-3">
			<table id="example" class="ui celled table" style="width:100%;">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Aalamat</th>
						<th>Jenis Kelamin</th>
						<th>Gambar</th>



					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($vendor as $v) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $v['username'] ?></td>
							<td><?= $v['nama_lengkap_vendor'] ?></td>
							<td><?= $v['alamat'] ?></td>
							<td><?= $v['jenis_kelamin'] ?></td>
							<td>
								<center>
									<img src="<?php echo base_url('assets/foto/') . $v['gambar'] ?>" alt="" width="100">
								</center>
							</td>




						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>

						<th>No</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Aalamat</th>
						<th>Jenis Kelamin</th>
						<th>Gambar</th>




					</tr>
				</tfoot>
			</table>
		</div>


	</div>

</div>

<!-- Modal -->
