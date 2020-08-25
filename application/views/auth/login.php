<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $this->config->item("titleku"); ?></title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo $this->config->item("iconku"); ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/albichenko.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/aos.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?= $domainku; ?>assets/css/ace-ie.min.css" />
    <script src="<?= $domainku; ?>assets/js/jquery.min.js"></script>
    <script src="<?= $domainku; ?>assets/js/ace-extra.min.js"></script>
    <script src="<?= $domainku; ?>assets/js/html5shiv.min.js"></script>
    <script src="<?= $domainku; ?>assets/js/respond.min.js"></script>
    <script src="<?= $domainku; ?>assets/js/jquery.alphanum.js"></script>
    <noscript>
        <meta http-equiv="refresh" content="3; URL=<?php echo $domainku; ?>no-js">
    </noscript>
    <script type="text/javascript">
        if (navigator.userAgent.indexOf('MSIE') != -1)
            var detectIEregexp = /MSIE (\d+\.\d+);/ //test for MSIE x.x
        else // if no "MSIE" string in userAgent
            var detectIEregexp = /Trident.*rv[ :]*(\d+\.\d+)/ //test for rv:x.x or rv x.x where Trident string exists

        if (detectIEregexp.test(navigator.userAgent)){ //if some form of IE
            var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
            if (ieversion>=11){
                //alert('This is IE 11 or above');
                //window.location = '<?php $domainku; ?>check-compatibility-browser';
                //document.write("You're using IE11 or above")
            }else{
                alert('Your browser is IE under 11 were its not compitable');
                window.location = '<?php $domainku; ?>check-compatibility-browser';
            }
            /*}else{
             document.write("n/a")
            */
        }
    </script>
</head>

<body class="login-layout">
<div>
    <div style="width: 50%; float:left; height: 100vh; background-color:#134B91; margin:0; padding:0">
        <div style="position: absolute;top: 45%; right: 50%;color:#FFFFFF; width:50%" align="center">
            <img src="<?php echo base_url(); ?>assets/images/logo_footer.png" class="msg-photo" alt="APA">
        </div>
        <div style="position: absolute;bottom: 5%; right: 50%;color:#FFFFFF; width:50%" align="center"><?= $this->config->item("copyright").' '.$this->config->item("copyright_by"); ?></div>
    </div>

    <div style="width: 50%; float:right; height: 100vh; background-color:#2A2B2A; margin:0; padding:0">
        <div style="position: absolute;top: 30%; left: 50%;color:#FFFFFF; width:50%" align="center">
            <div style="width:60%">
                <div id="login-box" class="visible widget-box no-border">
                    <div align="left" style="margin-bottom:30px;" class="textsubtitle2">MASUK</div>
                    <form id="form" class="login-form" action="<?php echo $domainku; ?>login" method="post">
                        <input name="ses-id" type="hidden" value="<?php echo $this->input->ip_address(); ?>">
                        <?php echo $this->session->flashdata('alert'); ?>

                        <div class="labelfieldset">
								<span class="block input-icon input-icon-right">
									<div class="titlefieldset"><span class="ttlefieldset"> &nbsp; Email &nbsp; </span></div>
									<input class="form-control" type="text" autocomplete="off" id="email" name="email" value="" placeholder="Email" required=""  maxlength="100" style="text-transform:lowercase">
									<i class="ace-icon fa fa-envelope"></i>
								</span>
                        </div>

                        <div class="labelfieldset">
								<span class="block input-icon input-icon-right">
									<div class="titlefieldset"><span class="ttlefieldset"> &nbsp; Sandi &nbsp; </span></div>
									<input class="form-control" type="password" autocomplete="off" id="sandi" name="sandi" value="" placeholder="Sandi" required="" maxlength="50">
									<i class="ace-icon fa fa-lock"></i>
								</span>
                        </div>

                        <!--<div class="row" style="margin-top:10px; margin-bottom:10px; ">
                            <div class="col-xs-6" align="left"><input name="sesid" type="checkbox" value="Y" required=""> Ingat saya</div>
                            <div class="col-xs-6" align="right">
                                <div class="row toolbar">
                                    <a href="#" data-target="#forgot-box" title="Atur ulang sandi">
                                        Lupa Sandi?
                                    </a>
                                </div>
                            </div>
                        </div>-->
                        <div class="clearfix">
                            <div class="pull-right" id="loading-main-form" style="display:none;"><img src="<?= $domainku; ?>assets/images/loading1.gif" alt=""/>.: On Process :.</div>
                            <button type="submit" id="submitx" name="submitx" value="Submit" class="btn btn-primary pull-right btn btn-sm" style="border-radius:3px; width:100%"> MASUK SEKARANG </button>
                            <script language="javascript" type="text/javascript" src="<?= $domainku; ?>assets/js/submitloading_button1.js"></script>
                        </div>
                    </form>
                    <div style="margin:20px 0px">Atau Masuk Dengan</div>
                    <div>
                        <a href="<?= base_url('oauth/google') ?>"><img src="<?php echo base_url(); ?>assets/images/sosmed_google.png" alt="APA Google" title="APA Google" width="25"></a>
                        <a href="<?= base_url('oauth/facebook') ?>" style="margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/sosmed_fb.png" alt="APA Google" title="APA Facebook" width="25"></a>
                        <a href="<?= base_url('oauth/instagram') ?>" style="margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/sosmed_ig.png" alt="APA Google" title="APA Instagram" width="25"></a>
                    </div>
                </div>
            </div>

            <div style="width:60%">
                <div id="forgot-box" class="widget-box no-border">
                    <div align="left" style="margin-bottom:30px;" class="textsubtitle2">ATUR ULANG SANDI</div>
                    <div align="left" class="textcontent1">Lupa password? Silakan masukkan alamat email untuk mengganti password kamu.</div>
                    <form id="form1" class="login-form" action="<?php echo $domainku; ?>retrievepass" method="post">
                        <input name="ses-id" type="hidden" value="<?php echo $this->input->ip_address(); ?>">

                        <div class="labelfieldset">
								<span class="block input-icon input-icon-right">
									<div class="titlefieldset"><span class="ttlefieldset"> &nbsp; Email &nbsp; </span></div>
									<input class="form-control" type="text" autocomplete="off" id="GuID" name="GuID" value="" placeholder="Email" required=""  maxlength="100">
									<i class="ace-icon fa fa-envelope"></i>
								</span>
                        </div>

                        <div class="row" style="margin-top:10px; margin-bottom:10px; ">
                            <div class="col-xs-12" align="right">
                                <div class="row toolbar">
                                    <a href="#" data-target="#login-box" class="back-to-login-link" style="text-decoration:none">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="pull-right" id="loading-main-form" style="display:none;"><img src="<?= $domainku; ?>assets/images/loading1.gif" alt=""/>.: On Process :.</div>
                            <button type="submit" id="submitx" name="submitx" value="Submit" class="btn btn-info btn btn-sm" style="border-radius:3px; width:100%"> KIRIM </button>
                            <script language="javascript" type="text/javascript" src="<?= $domainku; ?>assets/js/submitloading_button1.js"></script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="position: absolute;bottom: 5%; width:50%">
            <div class="row" style="padding:0px; margin:0px;">
                <div class="col-xs-6">Belum punya akun? <span onClick="window.location=('<?= $this->config->item("domainku"); ?>daftar')" style="cursor:pointer ">Daftar sekarang</span></div>
                <div class="col-xs-6" align="right"><span onClick="window.location=('<?= $this->config->item("domainku"); ?>')" style="cursor:pointer ">Lewati Langkah ini >> </span></div>
            </div>
        </div>
    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });



    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });

    });
</script>
<script>
    $('#email').alphanum({
        allow:'-_.@'
    });
    $('#sandi').alphanum({
        allow:''
    });
</script>
<script>
    $("#tooltip-alert").fadeTo(3000, 500).slideUp(500, function(){
        $("#tooltip-alert").slideUp(500);
    });
</script>
<script src="<?php echo $domainku; ?>assets/js/disable_rightclick.js"></script>
</body>
</html>
