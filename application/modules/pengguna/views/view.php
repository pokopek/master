
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Pengguna</a></li>
                </ul>
                <h4>Pengguna</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pengaturan pengguna</h4>
            <p>Memungkinkan untuk menambah, mengedit dan menghapus pengguna.
                <a href="#" class="btn btn-info btn-sm btn-rounded pull-right" onclick="add()"><i class="fa fa-plus"></i> Tambah Pengguna</a>


          </p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">



      <div class="row row-stat">
          
          <table id="table" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Lengkap</th>
                    <th width="15%">Username</th>
                    <th width="20%">Email</th>
                    <th width="15%">No. Telp</th>
                    <th width="20%">Action</th>
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


          <div class="form-group row">
            <label class="col-sm-3 control-label">Nama Lengkap </label>
            <div class="col-md-5">
              <input name="surname" type="text" class="form-control" id="surname" value="<?php if(isset($_GET['id'])){ echo $em['title']; } ?>">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-md-5">
              <input name="username" type="text" class="form-control" id="username" autocomplete="OFF">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-md-5">
              <input name="password" type="password" class="form-control" id="password">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-md-5">
              <input name="email" type="text" class="form-control" id="email">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3 control-label">No. Telp</label>
            <div class="col-md-5">
              <input name="no_hp" type="text" class="form-control" id="no_hp">
            </div>
          </div>


          

          <!-- input -->
          <div class="form-group row">
            <label class="col-sm-3 control-label">Status Pengguna</label>
              <div class="col-sm-3">
              <select name="status" class="form-control" id="status">
                <option>- pilih -</option>
                <option value="AKTIF">AKTIF</option>
                <option value="BLOKIR">BLOKIR</option>
              </select>
            </div>
          </div>

                                                  
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

  function inst(){
    var isi = document.getElementById("role").value;
    if(isi == 'Instansi'){
      $('#inst').show();
    }else{
      $('#inst').hide();
    }

  }

   function add()
   {
      
      // alert("asd");
       save_method = 'add';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal-xl').modal('show'); // show bootstrap modal
       $('.modal-title').text('Tambah Pengguna'); // Set Title to Bootstrap modal title
   }

   function edit(id)
   {
       save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "<?php echo site_url($data_ref['uri_controllers'].'/ajax_edit/')?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
               $('[name="id"]').val(data.id);
               $('[name="surname"]').val(data.surname);
               $('[name="username"]').val(data.username);
               $('[name="email"]').val(data.email);
               $('[name="no_hp"]').val(data.no_hp);
               $('[name="role"]').val(data.role);
               $('[name="status"]').val(data.status);
               $('#modal-xl').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Edit Pengguna'); // Set title to Bootstrap modal title
    
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





