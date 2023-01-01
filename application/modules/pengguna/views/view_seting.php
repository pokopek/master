
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Pengaturan</a></li>
                </ul>
                <h4>Pengaturan</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pengaturan Aplikasi</h4>
            <p>Memungkinkan untuk mengatur aplikasi, nama site, jenis absensi.
          </p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">


          <form action="#" id="form" class="form-horizontal">

          <input type="hidden"  name="id" id="id" value="<?=$setingan['id_pengaturan'];?>" />


          <div class="form-group row">
            <label class="col-sm-2 control-label">Nama Perusahaan </label>
            <div class="col-md-5">
              <input name="n_perusahaan" type="text" class="form-control" id="n_perusahaan" value="<?=$setingan['n_perusahaan'];?>" >
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">Nama Perusahaan Rekanan</label>
            <div class="col-md-5">
              <input name="n_rekanan" type="text" class="form-control" id="n_rekanan" value="<?=$setingan['n_rekanan'];?>" >
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">Nama Site</label>
            <div class="col-md-5">
              <input name="n_site" type="text" class="form-control" id="n_site" value="<?=$setingan['n_site'];?>" >
              <span class="help-block"></span>
            </div>
          </div>


          <!-- input -->
          <div class="form-group row">
            <label class="col-sm-2 control-label">Jenis Absen</label>
              <div class="col-sm-3">
              <select name="status" class="form-control" id="status">
                <option>- pilih -</option>
                <option value="Breakfast" <?=$a = $setingan['status'] == 'Breakfast'?'selected':'';?>>Breakfast</option>
                <option value="Lunch" <?=$a = $setingan['status'] == 'Lunch'?'selected':'';?>>Lunch</option>
                <option value="Dinner" <?=$a = $setingan['status'] == 'Dinner'?'selected':'';?>>Dinner</option>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-2 control-label"></label>
            <div class="col-md-5">
              <button type="button" id="btnSave" onclick="save_pengaturan()" class="btn btn-primary">Simpan</button>
            </div>
          </div>

                                                  
          </form>

      </div>

    </div>

    </div>

    </div><!-- contentpanel -->
   
</div>







<?php  $this->load->view('template/footer'); ?>

<link href="https://admin-edu.brosoft.id/theme/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('template/custome/lobibox/css/Lobibox.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>template/custome/alert/css/jquery-confirm.min.css">


<script src="https://admin-edu.brosoft.id/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/custome/alert/js/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('template/custome/lobibox/js/Lobibox.js');?>"></script>


<script type="text/javascript">

  var save_method; //for save method string
  var table;
  var url = "<?php echo site_url(); ?>";

  $(document).ready(function() {

      $('#inst').hide();

      //datatables
      table = $('#table').DataTable({

          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": url + "<?php echo $data_ref['uri_controllers']; ?>/ajax_list",
              "type": "POST"
          },

          //Set column definition initialisation properties.
          "columnDefs": [
          {
              "targets": [ -1 ], //last column
              "orderable": false, //set not orderable
          },
          ],

      });


  });

 

   function save_pengaturan()
   {
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;
    

           url = "<?php echo site_url($data_ref['uri_controllers'].'/ajax_update_pengaturan')?>";

    
       // ajax adding data to database
       $.ajax({
           url : url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
    
               if(data.status) //if success close modal and reload ajax table
               {
                   Lobibox.notify('success', {
                       size: 'mini',
                       msg: 'Data berhasil Disimpan....'
                   });
               }
               else
               {
                   for (var i = 0; i < data.inputerror.length; i++) 
                   {
                       $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                       $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                   }
               }
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error adding / update data');
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }

 
</script>





