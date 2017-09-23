<?php /*%%SmartyHeaderCode:109969359659bd90c16d4c72-81622953%%*/
if (!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array(
    'file_dependency' =>
        array(
            '6c2108a17c7103b6e203f4f0621d4645b56b0114' =>
                array(
                    0 => 'module:ps_imageslider/views/templates/hook/slider.tpl',
                    1 => 1502706660,
                    2 => 'module',
                ),
        ),
    'nocache_hash' => '109969359659bd90c16d4c72-81622953',
    'version' => 'Smarty-3.1.19',
    'unifunc' => 'content_59be5e936c9a06_10101048',
    'has_nocache_code' => false,
    'cache_lifetime' => 31536000,
), true); /*/%%SmartyHeaderCode%%*/ ?>
<?php if ($_valid && !is_callable('content_59be5e936c9a06_10101048')) {
    function content_59be5e936c9a06_10101048($_smarty_tpl)
    { ?>
        <link rel="stylesheet" href="http://localhost/mebooks/themes/classic/assets/css/animation.css">
        <div id="carousel" data-ride="carousel" class="carousel slide" data-interval="5000" data-wrap="true"
             data-pause="hover">
            <div class="row-fluid">
                <div id="my-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <ul class="carousel-inner" role="listbox">
                            <li class="carousel-item active" role="option" aria-hidden="false">
                                <div class="item active" style="background-color: #44546a">
                                    <div class="container-fluid">
                                        <div class="col-sm-12 col-md-7 col-md-offset-1"
                                             align="center">
                                            <!-- Slide 1...-->
                                            <div class="animated fadeInLeftBig text-center">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/mebooks.png"
                                                     alt="sample-1">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-5">
                                            <div class="animated fadeInRightBig text-center">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/mebooks-1.png"
                                                     alt="sample-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="carousel-item " role="option" aria-hidden="true">
                                <div class="item"
                                     style="background-image: url(http://localhost/mebooks/modules/ps_imageslider/images/BG_simple2.jpg)">
                                    <div class="container-fluid">
                                        <!-- Slide 2...-->
                                        <div class="col-sm-12 col-md-6 col-md-offset-1" style="margin-top: 1%">
                                            <div class="img-responsive animated rollIn">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/simple2-1.png"
                                                     alt="sample-1">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="animated fadeInUpBig slide-delay-2" style="margin-top: 2%">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/simple2-2.png"
                                                     alt="sample-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="carousel-item " role="option" aria-hidden="true">
                                <div class="item"
                                     style="background-image: url(http://localhost/mebooks/modules/ps_imageslider/images/BG_simple3.png)">
                                    <div class="container-fluid">
                                        <div class="col-sm-12 col-md-12 col-md-offset-1" align="center">
                                            <!-- Slide 3...-->
                                            <div class="img-responsive animated bounceInDown">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/simple3-1.png"
                                                     style="margin-top: 1%"
                                                     alt="sample-1">
                                            </div>
                                            <div class="img-responsive animated fadeInUpBig slide-delay-2"
                                                 style="width: 50%;margin-top: 2%">
                                                <img src="http://localhost/mebooks/modules/ps_imageslider/images/simple3-2.png"
                                                     alt="sample-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="direction" aria-label="Carousel buttons">
                            <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="icon-prev hidden-xs" aria-hidden="true">
          <i class="material-icons">&#xE5CB;</i>
        </span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true">
          <i class="material-icons">&#xE5CC;</i>
        </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }
} ?>
