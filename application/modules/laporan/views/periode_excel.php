
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
                <h4>Waktu Detail Periode Excel</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Laporan Detail Periode Excel</h4>
            <p>Laporan detail per jenis dan berdasarkan tanggal .</p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">



      <div class="row row-stat">
          
          <form action="<?=base_url('laporan/cetak_periode_excel');?>" id="form" class="form-horizontal" target="_blank" method="POST">
          <input type="hidden" value="" name="id" id="id"/>

          <div class="form-group row">
            <label class="col-sm-3 control-label">Waktu Makan</label>
            <div class="col-md-3">
              <select name="jenis" class="form-control" id="jenis">
                <option>- pilih -</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Dinner">Dinner</option>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3 control-label">Tanggal </label>
            <div class="col-md-5">
              <input name="tanggal" type="date" class="form-control" id="tanggal" value="">
              <span class="help-block"></span>
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
