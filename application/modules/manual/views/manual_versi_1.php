    <div class="pageheader">
        <div class="media">
          <div class="row">
                <div class="col-md-10">

            <div class="media-body">
              
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Pengguna</a></li>
                </ul>
                <h4>Absensi Karyawan Tanggal <?=tgl_indo(tgl_now());?></h4>

            </div>
                </div>
                <div class="col-md-2">
                
                <div class="form-grou12 row">
                  <div class="col-md-12">
                    <input name="jenis" class="form-control" id="jenis"  value="Breakfast" type="hidden">
                    <input name="badge_number" id="badge_number" type="text" onkeypress="onEnter(event)" class="form-control" >
                    <span class="help-block"></span>
                  </div>
                </div>
                </div>
                
              </div>


            
        </div><!-- media -->
    </div><!-- pageheader -->

     <div class="row">
      <div class="col-md-12">
        
         <div class="contentpanel">
          <div class="panel panel-default">

            <div class="panel-body">

              <div class="row row-stat">
          
               <div class="contentpanel" id="detail"></div>


                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




<?php  $this->load->view('template/footer'); ?>

<link href="https://admin-edu.brosoft.id/theme/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('template/custome/lobibox/css/Lobibox.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>template/custome/alert/css/jquery-confirm.min.css">


<script src="https://admin-edu.brosoft.id/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/custome/alert/js/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('template/custome/lobibox/js/Lobibox.js');?>"></script>




<script type="text/javascript">
  
  var j = document.getElementById("jenis").value; 

  $('#badge_number').focus();
  $("#detail").load("<?php echo base_url('manual/tampil/');?>" + j);
  var url_apps = '<?=base_url();?>';

$( document.body ).mouseup(function() {
    $('#badge_number').focus();
});


function tampilulang(){
    $("#detail").load("<?php echo base_url('manual/tampil/');?>" + j);
}


function onEnter(e){// => Digunakan untuk membaca karakter enter
    var key=e.keyCode || e.which;
    if(key==13){// => Karakter enter dikenali sebagai angka 13  

        var x = document.getElementById("badge_number").value; 
        var j = document.getElementById("jenis").value; 

          $.ajax({
            url: url_apps + 'manual/get/' + x + '/' + j,
            type: 'GET',
            dataType: 'json',
            success: function(data)
           {
    
               if(data.status) //if success close modal and reload ajax table
               {
                   
                   Lobibox.notify('success', {
                       size: 'mini',
                       msg: 'Data berhasil Disimpan'
                   });
                   $("#detail").load("<?php echo base_url('manual/tampil/');?>" + j);
                   $('#badge_number').val('');
                   $('#badge_number').focus();
               }
               else
               {
                  $('#badge_number').val('');
                  $('#badge_number').focus();
                  Lobibox.notify('error', {
                       size: 'mini',
                       msg: 'Data tidak dapat diproses'
                   });
               }
    
           },
           error: function ()
           {
              $('#badge_number').val('');
              $('#badge_number').focus();
              Lobibox.notify('error', {
                       size: 'mini',
                       msg: 'Data tidak dikenali'
                   });
    
           }

          })
    }
}


</script>


