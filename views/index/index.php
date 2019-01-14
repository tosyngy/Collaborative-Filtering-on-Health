<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Collaborative Filtering Algorithm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/css/animate.css"/>
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/css/w3.css"/>
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/css/dia_app.css"/>
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/css/reponsiveness.css"/>
    </head>
    <body>
        <div class="container init">
            <div class="row">
                <div class="col-xs-4 click-point ">

<!--      <p>
    <input value="+" onclick="$('#imagezoom').zoomable({method: 'zoomIn'})" title="Zoom in" class="btn btn-default" type="button">
    <input value="Reset" onclick="$('#imagezoom').zoomable({method: 'reset'})" class="btn btn-default" type="button">
   <input value=""  title="Zoom out" class="btn btn-primary" type="button">

 x1,y1,x2,y2	Specifies the coordinates of the left, top, right, bottom corner of the rectangle (for shape="rect")
    x,y,radius	Specifies the coordinates of the circle center and the radius (for shape="circle")
    x1,y1,x2,y2,..,xn,yn	Specifies the coordinates of the edges of the polygon. If the first and last coordinate pairs are not the same, the browser will add the last coordinate pair to close the polygon (for shape="poly")

</p>
<div style="overflow: hidden; width: 300px; height: 570px; position: relative; border: medium solid  #f0f0f0;"> 
    <img class="ui-draggable ui-draggable-handle front-img" style="position: relative; margin: 0px; display: inline-block; transition: none"  src="<?php echo URL; ?>views/index/body_image/full_body_use.png" usemap="#map" id="imagezoom" alt="diag-img" >
    <map id="map" name="map">
        <area shape="rect" coords="90,5,90,20" alt="Area 1"  onmouseover="alert('good')">
        <area shape="rect" coords="43,38,68,91" alt="Area 2" href="javascript:alert('Area 2');">
    </map>
</div>-->

                    <div class="alpha-switch">
                        <div class="panel panel-danger" style="border: none;">
                            <div class="panel-heading" id="p1">
                                <h3 class="panel-title">Select by letter or Search (Stage 1)</h3>
                            </div><!--end panel-heading-->
                            <div class="input-group" style="width: 100%">
                                <input type="text" class="form-control" placeholder="Search " id="search_part"/>
                                <span class="input-group-addon glyphicon glyphicon-search btn-success" style="top:0 !important"></span>
                            </div>
                            <!--                             <div class="but">
                                                            <button type="button" id="image" class="btn btn-danger top">Image</button>
                                                            <button type="button" id="letter" class="btn btn-danger top">SEARCH</button>
                                                        </div>-->
                            <!--end but-->
                            <div class="panel-body" style="padding: 0px">
                                <div class="nav-a-z">
                                    <ol class="alpha">
                                        <li class="selected"><a href="#">A</a></li>
                                        <li><a href="#">B</a></li>
                                        <li><a href="#">C</a></li>
                                        <li><a href="#">D</a></li>
                                        <li><a href="#">E</a></li>
                                        <li><a href="#">F</a></li>
                                        <li><a href="#">G</a></li>
                                        <li><a href="#">H</a></li>
                                        <li><a href="#">I</a></li>
                                        <li><a href="#">J</a></li>
                                        <li><a href="#">K</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">N</a></li>
                                        <li><a href="#">O</a></li>
                                        <li><a href="#">P</a></li>
                                        <li><a href="#">Q</a></li>
                                        <li><a href="#">R</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">T</a></li>
                                        <li><a href="#">U</a></li>
                                        <li><a href="#">V</a></li>
                                        <li><a href="#">W</a></li>
                                        <li><a href="#">X</a></li>
                                        <li><a href="#">Y</a></li>
                                        <li><a href="#">Z</a></li>
                                    </ol>
                                </div><!--end nav-a-z-->
                            </div><!--end panel-body-->
                        </div><!--end panel-->
                    </div><!--end alpha-switch-->

                </div>
                <div class="col-xs-8">
                    <div class="col-xs-12 click-more" style="padding-top: 40px;">
            <!--    <p class="zum">Zoomed area (stage 2)</p>
                <div class="zoom">
                    <span id="head" class="parts">
                        <img alt="diag-img" class="front-img" src="<?php echo URL; ?>views/index/img/body_outline1.png"/>
                        <a data-toggle="tooltip" title="head" data-placement="right" href="head" class="part-head"></a>
                    </span>
                    <span id="neck" class="parts">
                        <img alt="neck-part" src="<?php echo URL; ?>views/index/img/neck.png" class="mg" />
                    </span>
                    <span id="shoulder" class="parts">
                        <img alt="shoulder-part" src="<?php echo URL; ?>views/index/img/" class="mg"/>
                    </span>
                    <span id="chest" class="parts">
                        <img alt="chest-part" src="<?php echo URL; ?>views/index/img/chest.png" class="mg"/>
                    </span>
                    <span id="abdomen" class="parts">
                        <img alt="abdomen-part" src="<?php echo URL; ?>views/index/img/abdomen.png" class="mg"/>
                    </span>
                </div>end zoom-->
                        <div class="panel panel-info" style="border: none; ">
                            <div class="panel-heading" id="p2">
                                <h3 class="panel-title">Select Symptoms  (stage 2)</h3>
                            </div>


                            <div class="panel-body symmm" style="padding:5px 0px 0px 0px;">
                                <div class="to-select">
                                    <div class="col-xs-12" style="padding: 0px 1px;">
                                        <div class="select-sym">

                                        </div><!--end select-sym-->
                                    </div>
                                </div><!--end to-select-->
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 side-right">
                        <div class="symp-list">
                            <div class="panel panel-primary" style="border: none; top: 15px;position: relative">
                                <div class="panel-heading" id="p3">
                                    <h3 class="panel-title">Selected Symptom List (stage 3)</h3>
                                </div><!--end panel-heading-->
                                <div class="panel-body" style="padding: 0px;">
                                    <div class="symtoms_list">

                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg btn-block bottom cont">Continue</button>
                                </div><!--end panel-body-->
                            </div><!--end panel-->
                        </div><!--end symp-list-->
                        <!-- <div class="ad">
                             Advert here
                         </div>end ad-->
                    </div>
                </div><!--end row-->

            </div><!--end container-->
        </div>



        <!--    Question Session    -->
        <div class="container que">
            <div class="q">
                <p class="sym-head"></p>
                <div class="qt">
                    <div class="list-item">

                    </div>
                    <div class="opt_div">  

                    </div><!--end opt_div-->
                </div><!--end qt-->
                <div class="nt-pv">
                    <button type="button" class="btn btn-danger btn-lg col-xs-6 back"><i class="glyphicon glyphicon-chevron-left"></i>Previous</button>
                    <button type="button" class="btn btn-info btn-lg col-xs-6 next">Next<i class="glyphicon glyphicon-chevron-right"></i></button>
                </div><!--end nt-py-->
            </div><!--end q-->
        </div><!--end container-->

        <!--    end session -->
        <div class="container pda">
            <!--            <div class="pda-in">
                            <p class="qs">Possible Disease and Advice</p>
                            <div class="qt">
                                <div class="advice"></div>
                            </div>end qt
                        </div>end pda-in-->
            <a href="http://localhost/collaborativefilteringhealthsystem/expert/save.php" type="button" class="btn btn-danger">I will Love to Join the Expert Crew</a>

            <button type="button" class="btn btn-info btn-sm openmo" data-toggle="modal" data-target="#myModal"></button>  

            <div class="modal fade" id="myModal" role="dialog">
                <div  style="width:50%; margin:auto">
                    <div class="modal-content" style="z-index: 4000">
                        <div class="modal-header" style="background-color:red;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color:white;" class="btn btn-danger">Doctor Profile</h4>
                        </div>
                        <div class="modal-body" style="height:80%;">
                            <div class="suggest-doc">
                                <p class="rec">Recommender Experts you can consult</p>
                                <div class="row" data-toggle="modal" data-target="#myModal">

                                </div><!--end row-->
                            </div><!--end suggest-doc-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end container-->


        <link rel="stylesheet" href="<?php echo URL; ?>views/index/js/jqueryUI/jquery-ui.min.css"/>
        <link rel="stylesheet" href="<?php echo URL; ?>views/index/js/jqueryUI/jquery-ui.theme.min.css"/>
        <script src="<?php echo URL; ?>views/index/js/jquery2.1.3.min.js"></script>
        <script src="<?php echo URL; ?>views/index/js/jqueryUI/jquery-ui.min.js"></script>
        <script src="<?php echo URL; ?>views/index/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>views/index/js/index.js"></script>
        <script src="<?php echo URL; ?>views/index/js/script.js"></script>
        <script src="<?php echo URL; ?>views/index/js/zoom.js"></script>
        <script src="<?php echo URL; ?>views/index/js/diag_app.js"></script>
    </body>


</html>
