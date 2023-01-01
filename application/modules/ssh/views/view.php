
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Standart Satuan Harga</a></li>
                </ul>
                <h4>Standart Satuan Harga</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Data SSH 2022</h4>
            <p>Data SSH 2022 yang  terdaftar.
                <a href="#" class="btn btn-info btn-sm btn-rounded pull-right" onclick="add()"><i class="fa fa-plus"></i> Tambah Data SSH</a>


          </p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">

      
              



      <div class="row row-stat">
          <table id="table" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="1%" style="text-align:center">No</th>
                    <th width="10%" style="text-align:center" >Kode kelompok Barang </th>
                    <th width="15%" style="text-align:center" >Kelompok barang </th>
                    <th width="10%" style="text-align:center">ID SSH</th>
                    <th width="10%" style="text-align:center">Kode Barang</th>
                    <th width="12%" style="text-align:center">Uraian Barang</th>
                    <th width="12%" style="text-align:center">Spesifikasi</th>
                    <th width="10%" style="text-align:center">Satuan</th>
                    <th width="10%" style="text-align:center">Harga</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

      </div><!-- row -->

    </div>

    </div><!-- contentpanel -->
   
</div>

 







<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Extra Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id" id="id"/>

          <!-- <div class="form-group row">
            <label class="col-sm-3 control-label">ssh </label>
            <div class="col-md-5">
              <input name="badge_number" type="text" class="form-control" id="badge_number" >
              <span class="help-block"></span>
            </div>
          </div> -->

          <div class="form-group row">
            <label class="col-sm-3 control-label">Kode kelompok Barang</label>
            <div class="col-md-9">
              <input name="KODE_KEL_BRG" type="text" class="form-control" id="KODE_KEL_BRG" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
              </div>
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Kelompok Barang</label>
            <div class="col-md-9">
              <input name="URAIAN_KEL_BRG" type="text" class="form-control" id="URAIAN_KEL_BRG" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 control-label">ID SSH</label>
            <div class="col-md-9">
              <input name="ID_SSH" type="text" class="form-control" id="ID_SSH" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Kode Barang</label>
            <div class="col-md-9">
              <input name="KODE_BARANG" type="text" class="form-control" id="KODE_BARANG" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>
           
          <!-- <div class="form-group row">
            <label class="col-sm-3 control-label">Kode Barang</label>
            <div class="col-md-9">
              <input name="KODE_BARANG" type="text" class="form-control" id="KODE_BARANG" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div> -->
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Uraian Barang</label>
            <div class="col-md-9">
              <input name="URAIAN_BARANG" type="text" class="form-control" id="URAIAN_BARANG" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Spesifikasi</label>
            <div class="col-md-9">
              <input name="SPESIFIKASI" type="text" class="form-control" id="SPESIFIKASI" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Satuan</label>
            <div class="col-md-9">
              <input name="SATUAN" type="text" class="form-control" id="SATUAN" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 control-label">Harga Satuan</label>
            <div class="col-md-9">
              <input name="HARGA_SATUAN" type="text" class="form-control" id="HARGA_SATUAN" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>



          <!-- <div class="form-group row">
            <label class="col-sm-3 control-label">Department</label>
            <div class="col-md-7">
              <input name="department" type="text" class="form-control" id="department">
            </div>
          </div> -->

          <!-- <div class="form-group row">
            <label class="col-sm-3 control-label">Photo</label>
            <div class="col-md-5">
              <input name="file_foto" type="file" id="file_foto">
            </div>
          </div> -->


          <!-- <div class="form-group row">
            <label class="col-sm-3 control-label">Status</label>
            <div class="col-md-3">
              <select name="status" class="form-control" id="status">
                <option>- pilih -</option>
                <option value="0">Aktif</option>
                <option value="1">Non Aktif</option>
              </select>
            </div>
          </div> -->

                                                  
          </form>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<?php  $this->load->view('template/footer'); ?>

<!-- <link href="https://admin-edu.brosoft.id/theme/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" href="<?php echo base_url('template/custome/lobibox/css/Lobibox.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>template/custome/alert/css/jquery-confirm.min.css">


<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/custome/alert/js/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('template/custome/lobibox/js/Lobibox.js');?>"></script>

<script type="text/javascript">

  var save_method; //for save method string
  var table;
  var url = "<?php echo site_url(); ?>";

  $(document).ready(function() {

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
              "targets" : 8,
              "render": $.fn.dataTable.render.number('.', ',', 2, 'Rp '),
              "className": 'dt-body-right',
              "orderable": false, //set not orderable
          },
          ],

          
      });
      
 

  });

   function add()
   {
      
      // alert("asd");
       save_method = 'add';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal-xl').modal('show'); // show bootstrap modal
       $('.modal-title').text('Tambah SSH'); // Set Title to Bootstrap modal title
   }

   function edit(id)
   {
       save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "<?php echo site_url($data_ref['uri_controllers'].'/ajax_edit/')?>" + id,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
               $('[name="KODE_KEL_BRG"]').val(data.KODE_KEL_BRG);
               $('[name="URAIAN_KEL_BRG"]').val(data.URAIAN_KEL_BRG);
               $('[name="ID_SSH"]').val(data.ID_SSH);
               $('[name="KODE_BARANG"]').val(data.KODE_BARANG);
               $('[name="URAIAN_BARANG"]').val(data.URAIAN_BARANG);
               $('[name="SPESIFIKASI"]').val(data.SPESIFIKASI);
               $('[name="SATUAN"]').val(data.SATUAN);
               $('[name="HARGA_SATUAN"]').val(data.HARGA_SATUAN);
               //$('[name="status"]').val(data.status);
               $('#modal-xl').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Edit SSH'); // Set title to Bootstrap modal title
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

   function reload_table()
   {
      table.ajax.reload(null,false); //reload datatable ajax
   }

   function save()
   {
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;
    
       if(save_method == 'add') {
           url = "<?php echo site_url($data_ref['uri_controllers'].'/ajax_add')?>";
       } else {
           url = "<?php echo site_url($data_ref['uri_controllers'].'/ajax_update')?>";
       }
    
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
                   $('#modal-xl').modal('hide');
                   reload_table();
                   Lobibox.notify('success', {
                       size: 'mini',
                       msg: 'Data berhasil Disimpan'
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

   function hapus(id){
    $.confirm({
      title: 'Confirm!',
      content: 'Apakah anda yakin menghapus data ini ?',
      buttons: {
        confirm: function () {
           $.ajax({
              url : url + "<?php echo $data_ref['uri_controllers']; ?>/ajax_delete/" + id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  //if success reload ajax table
                  reload_table();
                  Lobibox.notify('success', {
                       size: 'mini',
                       msg: 'Data berhasil Dihapus'
                   });
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
        },
        cancel: function () {
          
        }
      }
    });
  }



</script>





