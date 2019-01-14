<?php
ob_start();
session_start();
$ip = gethostbyname("");

//if (isset($_GET['user'])) {
require_once 'model/preview.php';
//} else {
    if (!isset($_SESSION["username"]) && !isset($_POST['doc'])) {
        header("Location: index/index.php");
    }
//    require_once 'model/dbcontent.php';
//}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Collaborative Algorithm : Expert</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link rel="apple-touch-icon-precomposed" href="http:\\localhost\CollaborativeFilteringHealthSystem\expert\apple-touch-icon-precomposed.png">
        <link href="http:\\localhost\CollaborativeFilteringHealthSystem\expert\bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="http:\\localhost\CollaborativeFilteringHealthSystem\expert\font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="http:\\localhost\CollaborativeFilteringHealthSystem\expert\css/normalize.min.css">
        <link rel="stylesheet" href="http:\\localhost\CollaborativeFilteringHealthSystem\expert\css/main.css">
        <script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/vendor/jquery-1.10.1.min.js"></script>
        <script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/vendor/jquery.hashchange.min.js"></script>
        <script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/vendor/jquery.easytabs.min.js"></script>
        <script type="text/javascript" src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/qrcode.js"></script>


        <script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/main.js"></script>
        <!--[if lt IE 9]>
            <script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\js/vendor/html5shiv.js"><\/script>')</script>
            <![endif]-->
    </head>
    <body class="bg-fixed bg-1">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
            <![endif]--> 

        <div class="main-container">

            <div class="main wrapper clearfix" style="padding: 2px; width: 95%;margin: auto;">


                <!-- End Tab Container -->

                <div>

                    <?php
                    $regiser = $aboutyou;
                    $i = 0;
                    foreach ($regiser as $key => $value) {
                        ?>
                        <?php if ($i % 9)  ?>
                        <div class="col-xs-offset-3 col-xs-6" style=" width: 45%; height: 450px;padding: 1px;">

                            <div class="col-xs-12" style="padding: 0;height: 70%;border: #1c94c4 thin;border-radius:12.5px 12.5px 0 0;padding: 5%;padding-bottom: 0">
                                <img src="http:\\localhost\CollaborativeFilteringHealthSystem\expert\uploads/<?php echo $value["pix"]; ?>"
                                     onerror='this.src="uploads/usr_profile/default.png"'
                                     alt="<?php echo $value["name"]; ?>" style="width: 100%;height: 100%;border-radius:12.5px 12.5px 0px 0px;"/>
                            </div>
                            <div class="col-xs-12 bg-fixed" style="border-radius:0 0 12.5px 12.5px ;height: 30%;border: #1c94c4 solid 2px;padding: 3px;font-family: sans-serif; font-size: 12px;text-align: left;">
                                <span>
                                    <div style=" background: url(image/yctcu.jpg) no-repeat center center transparent  ; background-size: 90%;position: absolute;opacity: .2; min-width: 100%;min-height: 100%" ></div>
                                    <b>NAME: <span style="text-transform: uppercase; color: #000"><?php echo $value["name"]; ?></span> </b></span>
                                <br/><b>SPECIALTY: <span style="color: #000">
                                        <?php
//                                    $age = $d - $mydate;
                                        echo $value["occupation"];
                                        ?>
                                    </span></b> <br/>
                                <b>FIELD NAME: </b><span>
                                    <?php
                                    echo "<b style='text-transform:capitalize;color:#000'>{$value['facebook']}</b>";
                                    ?>
                                </span><br/>
                                <b>EXPERIENCE: </b><span>
                                    <?php
                                    echo "<b style='text-transform:capitalize;color:#000'>{$value['company']} {$value['position']}</b>";
                                    ?>
                                </span><br/>
                                <b>MOBILE NO: <span style="color:#000"> 
                                        <?php
                                        echo "{$value['phone']}";
                                        ?>
                                    </span></b><br/>
                                <b>COMPANY </b><span>
                                    <?php
                                    echo "<span style='text-transform:capitalize;color:#000'><b>{$value['address']}</b></span>";
                                    ?>
                                </span ><br/>  
                                <div >
                                    <b>EMAIL: </b>
                                    <b style="word-break: break-all;color: #000">
                                        <?php
                                        echo "{$value['email']}";
                                        ?>

                                    </b>
                                </div>  <b>TIMELINE: </b>  <span style="color:#000"><b>
                                        <?php
                                        $small = substr($value['about'], 1);
                                        $big = substr($value['about'], 0, 1);

                                        echo "<span style='text-transform:capitalize'>$big</span>$small";
                                        ?>
                                    </b></span><br/>
    <!--                                <span>
                                <?php
                                echo "<b>{$value['id']}</b>";
                                ?>
                                    </span><br/>-->
                            </div>   

                        </div>    
                        <?php
                    }
                    ?>

                </div>




                <script>

                    $(document).ready(function () {
                        var table = $('table').DataTable();
                    });
                </script>
                <style>
                    table, td, th {
                        border: 1px solid #337ab7;
                    }

                    th {
                        background-color: #337ab7 !important;
                        color: white;
                        text-align: center
                    }
                    td {
                        padding: 5px;
                    }
                    td {

                        vertical-align: bottom;
                    }
                    tr:hover + td {
                        color: #eee;
                    }
                    .main-links.sidebar img{
                        margin: auto;
                    }
                </style>



                <!--                <footer>
                
                                    <div id="logout">Logout</div>
                
                                </footer>-->

            </div><!-- #main -->
        </div><!-- #main-container -->

    </body>
</html>
