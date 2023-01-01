<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Nusambatu berkah</title>

        <link href="<?=base_url('template/');?>css/style.default.css" rel="stylesheet">
        <link href="<?=base_url('template/');?>css/morris.css" rel="stylesheet">
        <link href="<?=base_url('template/');?>css/select2.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        
        <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="#" class="logo">
                        <img src="<?=base_url('template/images/logo.png');?>" alt="" /> 
                    </a>
                    <div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    
                    <div class="pull-right">
                        
                        
                        
                       
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <?php if($this->encryption->decrypt($this->session->userdata('role')) == 'Admin'){
                                    echo '<li><a href="'.base_url('pengguna').'"><i class="glyphicon glyphicon-user"></i> Profile</a></li>';
                                }else{
                                    echo '<li><a href="'.base_url('pengguna/profile').'"><i class="glyphicon glyphicon-user"></i> Profile</a></li>';
                                }
                              ?>
                              <li><a href="#"><i class="glyphicon glyphicon-star"></i> Log Aktifitas</a></li>
                              <li class="divider"></li>
                              <li><a href="<?=base_url('loginadmin/logout');?>"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                        
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>


        
<section>
<div class="mainwrapper">
    <div class="leftpanel">
        <div class="media profile-left">
            <a class="pull-left profile-thumb" href="profile.html">
                <img class="img-circle" src="<?=base_url('template/');?>images/photos/keluarga3.jpg" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">
                    <?php
                if($this->encryption->decrypt($this->session->userdata('role')) == 'Admin'){
                    // echo $this->encryption->decrypt($this->session->userdata('role'));
                    echo infoUser('surname');
                //     echo '</h4>
                // <small class="text-muted">'.infoUser('role').'</small>';
                }else{
                    echo infoUser('short_name');
                }?>
                    
                
            </div>
        </div><!-- media -->
        
        <ul class="nav nav-pills nav-stacked">

            <?php
            $menu = $this->uri->segment(1);
            $a = ($menu == 'dashboard')?'class="active"':'';
            $b = ($menu == 'manual')?'class="active"':'';
            $c = ($menu == 'pesan_masuk')?'class="active"':'';
            $d = ($menu == 'pesan_kirim')?'class="active parent"':'class="parent"';

            ?>

            <li <?=$a?>><a href="<?=base_url('dashboard');?>"><i class="fa fa-home"></i> 
                <span>Dashboard</span></a>
            </li>



            <!-- <li <?=$b?>><a href="<?=base_url('pegawai');?>"><i class="fa fa-map-marker"></i> 
                <span>Data Karyawan</span></a>
            </li> -->
            
            <li <?=$b?>><a href="<?=base_url('ssh');?>"><i class="fa fa-map-marker"></i> 
                <span>ssh</span></a>
            </li>
            <li <?=$b?>><a href="<?=base_url('asb');?>"><i class="fa fa-university"></i> 
                <span>asb</span></a>
            </li>
            
            <li <?=$b?>><a href="<?=base_url('sbu');?>"><i class="fa fa-tachometer"></i> 
                <span>sbu</span></a>
            </li>

            <li <?=$b?>><a href="<?=base_url('pembelian');?>"><i class="fa fa-tachometer"></i> 
                <span>pembelian</span></a>
            </li>

            <!-- <li class="parent" ><a href=""><i class="fa fa-edit"></i> <span>Laporan</span></a>
                <ul class="children">
                    <li><a href="<?=base_url('laporan/summary');?>">Summary</a></li>
                    <li><a href="<?=base_url('laporan/periode');?>">Detail PDF</a></li>
                    <li><a href="<?=base_url('laporan/periode_excel');?>">Detail Excel</a></li>
                </ul>
            </li> -->


            <!-- <li class="parent"><a href=""><i class="fa fa-bars"></i> <span>Pengaturan</span></a>
                <ul class="children">
                    <li><a href="<?=base_url('pengguna/setingabsen');?>">Setting Absen</a></li>
                    <li><a href="<?=base_url('pengguna');?>">Pengguna</a></li>
                    <li><a href="<?=base_url();?>">Log Aktifitas</a></li>
                </ul>
            </li> -->

            <!-- <li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Bantuan</span></a></li> -->

        </ul>
        
    </div><!-- leftpanel -->
                
              