<?php
	
	$user      = $this->db->get('tb_users');
    $suplier   = $this->db->get('tb_suplier');

?>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Laporan Pembelian Barang</h4>
    </div>
    <div class="panel-body">
        <h4>Menu ini digunakan untuk melihat laporan pembelian barang dari suplier</h4>
        <?php echo $this->apotek->message();?>
        <hr/>
        <?php echo form_open('laporan/pembelian/print', 'class="form-horizontal"');?>
        <div class="form-group">
            <label class="col-md-4 control-label">Tgl Transaksi Pembelian</label>
            <div class="col-md-8">
                <div class="input-group">
                    <input class="form-control" name="start" placeholder="Tgl awal" type="text" id="kalender_start">
                    <span class="input-group-addon">s/d</span>
                    <input class="form-control" name="end" placeholder="Tgl akhir" type="text" id="kalender_end">
                </div>
            </div>
        </div>

        <div class="form-group">
			<label class="control-label col-md-4">Jenis Transaksi</label>
			<div class="col-md-8">
			    <select name="jenis_transaksi" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                    <option value="ALL" selected="">Semua Transaksi</option>
                    <option value="TUNAI">CASH TUNAI</option>
                    <option value="HUTANG">HUTANG</option>
                </select>
			</div>
		</div>

        <div class="form-group">
            <label class="control-label col-md-4">Suplier</label>
            <div class="col-md-8">
                <select name="suplier" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                    <option value="ALL" selected="">Semua Suplier</option>
                <?php if ($suplier->num_rows() > 0):?>
                <?php foreach ($suplier->result() as $supliers):?>
                    <option value="<?=$supliers->id_suplier;?>"><?= $supliers->suplier;?></option>
                <?php endforeach;?>
                <?php endif;?>
                </select>
            </div>
        </div>

		<div class="form-group">
			<label class="control-label col-md-4">User</label>
			<div class="col-md-8">
			    <select name="user" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                    <?php  if ($this->session->userdata('access') === 'ADMINISTRATOR'):?>
                    <option value="ALL" selected="">Semua User</option>
                    <?php if ($user->num_rows() > 0):?>
                        <?php foreach ($user->result() as $users):?>
                            <option value="<?=$users->id_users;?>"><?= $users->username;?></option>
                        <?php endforeach;?>
                    <?php endif;?>

                    <?php else:?>
                        <?php foreach ($user->result() as $users):?>
                            <?php if ($this->apotek->users()->id_users !== $users->id_users) {
                                continue;
                            }
                            else
                            {
                                ?>
                            <option value="<?=$users->id_users;?>"><?= $users->username;?></option>
                        <?php
                            }
                             endforeach;?>
                    <?php endif;?>
                </select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success pull-right">Cetak</button>
			</div>
		</div>

		<?php echo form_close();?>
	</div>
</div>