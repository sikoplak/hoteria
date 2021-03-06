<section class="content-header">
    <h1>
        Pelanggan
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li><a href="<?php echo base_url("web/customer");?>">Pelanggan</a></li>
        <li class="active">Tambah Baru</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php $this->load->view("layouts/alert"); ?>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Pelanggan</h3>
                </div><!-- /.box-header -->
                <?php echo form_open("web/customer/store", ["class"=>"form-horizontal", "enctype"=>"multipart/form-data"]); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Jenis Identitas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="identity_type" id="identity_type" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nomor Identitas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="identity_number" id="identity_number" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="" >
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" value="" >
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Alamat Lengkap</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="address" rows="6"></textarea>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div><!-- /.box-footer -->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>