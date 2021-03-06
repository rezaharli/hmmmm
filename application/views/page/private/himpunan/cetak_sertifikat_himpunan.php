<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Kegiatan Himpunan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Kegiatan</a></li>
            <li class="active">Daftar Kegiatan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Tempat Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Deskripsi Acara</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($acaras as $acara) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $acara['nama_acara']; ?></td>
                                    <td><?php echo $acara['tempat_acara']; ?></td>  
                                    <td><?php echo $acara['tanggal_acara']; ?></td>
                                    <td><?php echo $acara['deskripsi_acara']; ?></td>
                                    <td>
                                      <!-- <a href="<?php echo base_url('kegiatan_himpunan/do_cetak_sertifikat')."/".$id_acara; ?>">
                                        <button class="btn btn-info pull-left"><i class="fa fa-print"></i>&nbsp;Cetak Sertifikat</button>
                                      </a> -->
                                    </td>
                                  </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable({
            "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true

        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>