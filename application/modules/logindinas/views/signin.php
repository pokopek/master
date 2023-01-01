<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>LOGIN :: Pengaduan </title>

        <link href="<?=base_url('template/');?>css/style.default.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="signin">
        
        
        <section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?=base_url('template/');?>images/Balikpapan.jpg" alt="Chain Logo" width="100px">
                    </div>
                    <br />
                    <h4 class="text-center mb5">LOGIN INSTANSI</h4>
                   
                    <div class="mb10"></div>
                    
                    <form action="<?=base_url('logindinas/instansi');?>" method="post">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="pass">
                        </div><!-- input-group -->
                        
                        <div class="clearfix">

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Login <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>                      
                    </form>
                    
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <center>Powered By Heru Hidayat 2021</center>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>


        <script src="<?=base_url('template/');?>js/jquery-1.11.1.min.js"></script>
        <script src="<?=base_url('template/');?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?=base_url('template/');?>js/bootstrap.min.js"></script>
        <script src="<?=base_url('template/');?>js/modernizr.min.js"></script>
        <script src="<?=base_url('template/');?>js/pace.min.js"></script>
        <script src="<?=base_url('template/');?>js/retina.min.js"></script>
        <script src="<?=base_url('template/');?>js/jquery.cookies.js"></script>

        <script src="<?=base_url('template/');?>js/custom.js"></script>

    </body>
</html>
