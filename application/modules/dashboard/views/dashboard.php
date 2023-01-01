
                
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Dashboard</li>
                                </ul>
                                <h4>Dashboard</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">


                            <div class="alert alert-info">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <strong>Selamat datang!</strong> gunakan aplikasi dengan bijak.
                        </div>


                        
                        <div class="row row-stat">
                            
                            Nama :  <?=$this->encryption->decrypt($this->session->userdata('surname'));?><br>
                            Username : <?=$this->encryption->decrypt($this->session->userdata('username'));?><br>
                            ID User : <?=$this->encryption->decrypt($this->session->userdata('id'));?><br>
                            Role : <?=$this->encryption->decrypt($this->session->userdata('role'));?><br>
                            <?php 
                            if($this->encryption->decrypt($this->session->userdata('role')) == 'Instansi'){
                                echo 'ID Instansi : '.instansi($this->encryption->decrypt($this->session->userdata('id')))['nama_instansi'].'<br>';
                            }
                            ?>
                            

                        </div><!-- row -->
                        
                    

                        
                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->