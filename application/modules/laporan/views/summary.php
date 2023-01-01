
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Laporan</a></li>
                </ul>
                <h4>Waktu Makan </h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Laporan Jenis</h4>
            <p>Laporan Berdasarkan .</p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">



      <div class="row row-stat">
          
          <form action="<?=base_url('laporan/summary_tampil');?>" id="form" class="form-horizontal" method="POST">
          <input type="hidden" value="" name="id" id="id"/>

<!--           <div class="form-group row">
            <label class="col-sm-3 control-label">Waktu Makan</label>
            <div class="col-md-3">
              <select name="jenis" class="form-control" id="jenis">
                <option>- pilih -</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Luch">Luch</option>
                <option value="Dinner">Dinner</option>
              </select>
            </div>
          </div> -->




          

          <!-- input -->
          <div class="form-group row">
            <label class="col-sm-3 control-label">Bulan</label>
              <div class="col-sm-3">
              <select name="bulan" class="form-control" id="bulan">
                <option>- pilih -</option>
                <option value="01">Januari</option>
                <option value="02">Febrari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 control-label">Tahun</label>
              <div class="col-sm-3">
              <select name="tahun" class="form-control" id="tahun">
                <option>- pilih -</option>
                <option value="2021">2021</option>
              </select>
            </div>
          </div>

          <!-- input -->
          <div class="form-group row">
            <label class="col-sm-3 control-label"></label>
              <div class="col-sm-3">
              <button type="submit" class="btn btn-sm btn-primary"> Proses</button>
            </div>
          </div>

                                                  
          </form>


      </div><!-- row -->

    </div>

    </div><!-- contentpanel -->
   
</div>





<?php  $this->load->view('template/footer'); ?>
