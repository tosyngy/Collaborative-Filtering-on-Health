<?php
//ob_start();
session_start();
$ip = gethostbyname("");

if (!isset($_SESSION["username"])) {
    header("Location: index/index.php");
}
require_once 'model/dbcontent.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Your Resume <?php echo $_SESSION["username"]; ?></title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">


        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="file_upload/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="datetimepicker/build/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="input-tag/dist/bootstrap-tagsinput.css">
        <script src="js/jquery2.1.3.min.js"></script>
        <script src="jqueryUI/jquery-ui.min.js"></script>
        <script src="file_upload/js/fileinput.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/moment.js"></script>
        <script src="datetimepicker/src/js/bootstrap-datetimepicker.js"></script>

        <script type="text/javascript" src="js/qrcode.js"></script>

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <!--<script src="js/vendor/jquery.hashchange.min.js"></script>-->
        <script src="js/vendor/jquery.easytabs.min.js"></script>

        <script src="js/main.js"></script>
        <script src="input-tag/dist/bootstrap-tagsinput.min.js"></script>
      <!--<script src="input-tag/dist/bootstrap-tagsinput-angular.min.js"></script>-->
    </head>
    <body class="bg-fixed bg-1">

        <div id="tab-container" class="tab-container" style="width: 60%; margin: auto">
            <div class="kv-main">
                <div class="title bg-danger" style="padding: 5px; margin-top: 5px;text-align: center;">

                    <h2>Set Up Your Resume</h2>
                    <a href="index.php"><h4>Preview Your Resume</h4></a>

                    <div id="qrcode" style="width:100px; position: absolute;top: 20px;"></div>

                </div>
            </div>
            <!-- Tab List -->
            <ul class='etabs'>
                <li class='tab' id="tab-about">
                    <a href="#about"><i class="glyphicon glyphicon-user"></i><span> About Me</span></a>
                </li>
                <li class='tab'>
                    <a href="#resume"><i class="glyphicon glyphicon-file"></i><span> Resume</span></a>
                </li>
                <li class='tab'>
                    <a href="#contact"><i class="glyphicon glyphicon-envelope"></i><span> Contact</span></a>
                </li>
            </ul>
            <!-- End Tab List -->
            <div id="tab-data-wrap">
                <!-- About Tab Data -->
                <div id="about">
                    <form enctype="multipart/form-data" id="post_form4">
                        <section class="clearfix">
                            <div class="form-group">
                                <label for="name">FullName</label>
                                <input type="text" class="form-control" id="name" placeholder="FullName" value="<?php echo $aboutyou[0]["name"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="occupation">Specialty</label>
                                <input type="text" class="form-control" id="occupation" placeholder="Specialty" value="<?php echo $aboutyou[0]["occupation"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address" value="<?php echo $aboutyou[0]["email"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="facebook">Field Name</label>
                                <input type="text" class="form-control" id="facebook" placeholder="Field Name" value="<?php echo $aboutyou[0]["facebook"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="aboutyou">Timeline</label>
                                <textarea class="form-control"  id="status"rows="3" placeholder="Timeline"><?php echo $aboutyou[0]["my_status"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="test-upload">Your Picture</label>
                                <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1" data-max-file-count="1">
                            </div>

                        </section><!-- content -->  
                        <button type="button" class="btn btn-default btn-lg  btn-success" id="save_about" style="width: 100%">Save</button>

                    </form>

                </div>
                <!-- End About Tab Data -->
                <!-- Resume Tab Data -->
                <div id="resume">
                    <form enctype="multipart/form-data" id="post_form3">
                        <section class="clearfix">
                            <fieldset class="text-warning bg-warning text-bold" style="margin-top: 20px;font-weight: 900">Work Experience</fieldset>
                            <div class="experience hidden" id="exp0" hidden="true">

                                <div class="form-group">
                                    <label for="organization">Organization Name</label>
                                    <input type="text" class="form-control work" id="work" placeholder="Organization Name" value="">
                                </div>
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text" class="form-control position" id="position" placeholder="Position" value="">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control description"  id="description"rows="3" placeholder="Description">

                                    </textarea>
                                </div>
                                <div class="form-group" style="width: 100%">
                                    <label for="dateFrom" style="width: 10%;  float: left">Year:</label>
                                    <input type="text" class="form-control dateFrom" id="dateFrom"  style="width: 30%;float: left; margin-left: 2%" placeholder="From" list="datalist" value="">
                                    <input type="text" class="form-control dateTo" id="dateTo" style="width: 30%; margin-right: 2%" placeholder="To" list="datalist" value="">
                                </div>

                            </div> 
                            <?php
                            $experience = explode(",", $aboutyou[0]['company']);
                            $position = explode(",", $aboutyou[0]['position']);
                            $description = explode(",", $aboutyou[0]['description']);
                            $year2 = explode(",", $aboutyou[0]['year']);

                            foreach ($experience as $key => $value) {
                                $i = 1;
                                ?>
                                <div class="experience" id="exp<?php echo $i++; ?>">

                                    <div class="form-group">
                                        <label for="organization">Organization Name</label>
                                        <input type="text" class="form-control work" id="work" placeholder="Organization Name" value="<?php echo $experience[$key]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control position" id="position" placeholder="Position" value="<?php echo $position[$key]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control description"  id="description"rows="3" placeholder="Description"><?php echo $description[$key]; ?></textarea>
                                    </div>
                                    <div class="form-group" style="width: 100%">
                                        <label for="dateFrom" style="width: 10%;  float: left">Year:</label>
                                        <input type="text" class="form-control dateFrom" id="dateFrom"  style="width: 30%;float: left; margin-left: 2%" placeholder="From" list="datalist" value="<?php
                            $d = explode(" - ", $year2[$key]);
                            echo $d[0];
                                ?>">
                                        <input type="text" class="form-control dateTo" id="dateTo" style="width: 30%; margin-right: 2%" placeholder="To" list="datalist" value="<?php
                                           $d = explode(" - ", $year2[$key]);
                                           echo $d[1];
                                ?>">
                                    </div>

                                </div> 


                            <?php } ?>

                            <button type="button" style="float: right; "class="btn btn-success glyphicon glyphicon-plus right" id="new_experience"></button>
                            <div style="clear: both"></div>
                            <hr />
                            <!--                            <div class="form-group">
                                                            <label for="education"></label>
                                                            <input type="text" class="form-control" id="education" placeholder="Education Background" value="">
                                                        </div>-->

                            <!--                            <fieldset class="text-warning bg-warning text-bold" style="margin-top: 50px;font-weight: 900">Educational Background</fieldset>
                            
                            
                                                        <div class="education hidden" id="edu0" hidden="true">
                                                            <div class="form-group">
                                                                <label for="school">School Name</label>
                                                                <input type="text" class="form-control school" id="school" placeholder="School Name" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="degree">Degree Awarded</label>
                                                                <input type="text" class="form-control degree" id="degree" placeholder="Degree Awarded" value="">
                                                            </div>
                                                            <div class="form-group" style="width: 100%">
                                                                <label for="fromYr" style="width: 10%;  float: left">Year:</label>
                                                                <input type="text" class="form-control dateFrom2" id="dateFrom2"  style="width: 30%;float: left; margin-left: 2%" placeholder="From" list="datalist" value="">
                                                                <input type="text" class="form-control dateTo2" id="dateTo2" style="width: 30%; margin-right: 2%" placeholder="To" list="datalist" value="">
                                                            </div>
                                                        </div> 
                            <?php
                            $education = explode(",", $aboutyou[0]['school']);
                            $degree = explode(",", $aboutyou[0]['degree']);
                            $year = explode(",", $aboutyou[0]['year']);
                            foreach ($education as $key => $value) {
                                $i = 1;
                                ?>
                                                                <div class="education" id="edu<?php echo $i++; ?>">
                                                                    <div class="form-group">
                                                                        <label for="school">School Name</label>
                                                                        <input type="text" class="form-control school" id="school" placeholder="School Name" value="<?php echo $education[$key]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="degree">Degree Awarded</label>
                                                                        <input type="text" class="form-control degree" id="degree" placeholder="Degree Awarded" value="<?php echo $degree[$key]; ?>">
                                                                    </div>
                                                                    <div class="form-group" style="width: 100%">
                                                                        <label for="fromYr" style="width: 10%;  float: left">Year:</label>
                                                                        <input type="text" class="form-control dateFrom2" id="dateFrom2"  style="width: 30%;float: left; margin-left: 2%" placeholder="From" list="datalist" value="<?php
                            $d = explode(" - ", $year[$key]);
                            echo $d[0];
                                ?>">
                                                                        <input type="text" class="form-control dateTo2" id="dateTo2" style="width: 30%; margin-right: 2%" placeholder="To" list="datalist" value="<?php
                            $d = explode(" - ", $year[$key]);
                            echo $d[1];
                                ?>">
                                                                    </div>
                                                                </div>   
                                
                            <?php } ?>
                            
                                                        <button type="button" style="float: right"class="btn btn-success glyphicon glyphicon-plus right" id="new_education"></button>
                                                        <div style="clear: both"></div>
                                                        <hr />-->
                            <div class="form-group">
                                <label for="skill">Branch of works</label>
                                <input type="text" class="form-control" id="skill" placeholder="Your skills" data-role="tagsinput"  value="<?php echo $skill; ?>"/>

                            </div>
                            <button type="button" class="btn btn-default btn-lg  btn-success" id="save_experience" style="width: 100%">Save</button>

                        </section>
                    </form>
                </div>
                <!-- End Resume Tab Data -->

                <!-- Contact Tab Data -->
                <div id="contact">
                    <form enctype="multipart/form-data" id="post_form">
                        <section class="clearfix">
                            <div class="form-group">
                                <label for="aboutyou">Review</label>
                                <textarea class="form-control"  id="aboutyou"rows="3" placeholder="About You"><?php echo $aboutyou[0]["about"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Office Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Home Address" value="<?php echo $aboutyou[0]["address"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Mobile No</label>
                                <input type="text" class="form-control" id="phone" placeholder="Mobile No" value="<?php echo $aboutyou[0]["phone"]; ?>">
                            </div>
                            <button type="button" class="btn btn-default btn-lg  btn-success" id="save_contact" style="width: 100%">Save</button>        

                        </section>
                    </form>
                </div>
                <!-- End Contact Data -->
            </div>
        </div>
    <ccc aaa="<?php echo $_SESSION["id"] ?>" ></ccc>
    <!--<input type="hidden"  id="code" value="http://inatia.org/mybiodata/index.php?user=<?php echo $_SESSION["id"] ?>">-->
    <input type="hidden"  id="code" value="http://<?php echo $ip; ?>/electronicbiodataidentity/index.php?user=<?php echo $_SESSION["id"] ?>">

    <footer>
        <div id="logout">Logout</div>
    </footer>

    <datalist id="datalist">
        <option value="2001">2001</option>   
        <option value="2002">2002</option>   
        <option value="2003">2003</option>   
        <option value="2004">2004</option>   
        <option value="2005">2005</option>   
        <option value="2006">2006</option>   
        <option value="2007">2007</option>   
        <option value="2008">2008</option> 
        <option value="2009">2009</option> 
        <option value="2010">2010</option> 
        <option value="2011">2011</option>   
        <option value="2012">2012</option>   
        <option value="2013">2013</option>   
        <option value="2014">2014</option>   
        <option value="2015">2015</option>   
        <option value="2016">2016</option>   
        <option value="2016">2017</option>   
        <option value="Till Date">Till Date</option>  
    </datalist>

    <script>
        $(function () {
            $("#save_about,#save_contact,#save_experience").click(function(e){
                e.preventDefault();
                var img=$("#post_form4 pre").text().replace("upload/","");
                var work="";
                var position="";
                var description="";
                var year="";
                var skill=$("#skill").val();
               
                var i=1;
                e.preventDefault();
                $(".experience").each(function(id,data){
                    if(!$(this).hasClass("hidden")){
                        i=$(this).attr("id");
                        work+=$(this).find("#work").val()+"__"; 
                        position+=$(this).find("#position").val()+"__"; 
                        description+=$(this).find("#description").val()+"__"; 
                        year+=$(this).find("#dateFrom").val()+" - "+$(this).find("#dateTo").val()+"__";   
                    }
            
                })
                   
                $.post("model/main.php?save=biodata",
                {
                    name:$("#name").val(),
                    occupation:$("#occupation").val(),
                    email:$("#email").val(),
                    facebook:$("#facebook").val(),
                    twitter:$("#twitter").val(),
                    status:$("#status").val(),
                    img:img,
                    aboutyou:$("#aboutyou").val(),
                    address:$("#address").val(),
                    phone:$("#phone").val(),
                    work:work,
                    position:position,
                    description:description,
                    year:year,
                    skill:skill
                },
                function(data){
                    alert("information updated successfully")
                })
            })
              
            //            $("#save_contact").click(function(e){
            //                e.preventDefault();
            //                $.post("model/main.php?save=contact",
            //                {
            //                    aboutyou:$("#aboutyou").val(),
            //                    address:$("#address").val(),
            //                    phone:$("#phone").val()
            //                },
            //                function(data){
            //                    alert("information updated successfully")
            //                })
            //            })
            //            $("#save_port").click(function(e){
            //                var img=$("#post_form2 pre").text().replace("upload/","");
            //                e.preventDefault();
            //                $.post("model/main.php?save=port",
            //                {
            //                    img:img
            //                },
            //                function(data){
            //                    alert("information updated successfully")
            //                })
            //            })
          
            //            $("#save_experience").click(function(e){
            //                var work="";
            //                var position="";
            //                var description="";
            //                var year="";
            //               
            //                var i=1;
            //                e.preventDefault();
            //                $(".experience").each(function(id,data){
            //                    if(!$(this).hasClass("hidden")){
            //                        i=$(this).attr("id");
            //                        work+=$(this).find("#work").val()+"__"; 
            //                        position+=$(this).find("#position").val()+"__"; 
            //                        description+=$(this).find("#description").val()+"__"; 
            //                        year+=$(this).find("#dateFrom").val()+" - "+$(this).find("#dateTo").val()+"__";   
            //                    }
            //            
            //                })
            //                var school="";
            //                var degree="";
            //                var year2="";
            //                var skill=$("#skill").val();
            //                $(".education").each(function(id,data){
            //                    if(!$(this).hasClass("hidden")){
            //                        i=$(this).attr("id");
            //                        school+=$(this).find("#school").val()+"__"; 
            //                        degree+=$(this).find("#degree").val()+"__"; 
            //                        year2+=$(this).find("#dateFrom2").val()+" - "+$(this).find("#dateTo2").val()+"__"; 
            //                    }
            //                })
            //                    
            //                // alert("")
            //                $.post("model/main.php?save=experience",
            //                {
            //                    work:work,
            //                    position:position,
            //                    description:description,
            //                    year:year,
            //                    school:school,
            //                    degree:degree,
            //                    year2:year2,
            //                    skill:skill
            //                },
            //                function(data){
            //                    alert("information updated successfully")
            //                })
            //            })
            $("#logout").click(function(e){
                e.preventDefault();
                $.post("model/login.php?login=logout",
                {
                },
                function(data){
                    $(location).attr("href","index/index.php");
                })
            })
        })
        
        
  
    </script>

</body>
<style>
    .file-error-message, .kv-fileinput-caption{
        display: none !important;
    }
    label{
        background: #fff;
        padding: 10px;
    }
</style>
<script>
    $(document).on('click',"#new_experience",function(){
           
        var id= $(".experience").last().attr("id").replace("exp", "");
        id=parseInt(id);
        $(".experience").last().after("<div class='experience' id='exp"+ ++id +"'>"+$(".experience").html()+"</div>"); 
          
    })
    $(document).on('click',"#new_education",function(){
            
        var id= $(".education").last().attr("id").replace("edu", "");
        id=parseInt(id);
        $(".education").last().after("<div class='education' id='edu"+ ++id +"'>"+$(".education").html()+"</div>"); 
       
    })
        
        
        
    ;
    
    $("#file-1").fileinput({
        uploadUrl: 'uploads/uploads.php?file_name='+ $("ccc").attr("aaa")+'&dir=1', 
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10, 
        allowedFileTypes: ['image'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    $("#file-2").fileinput({
        uploadUrl: 'uploads/uploads.php', 
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10, 
        allowedFileTypes: ['image'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    function alerty(id){
        $(id).after(' <div style="display: block; background:#dff0d8;color:#3c763d;font-size:30px" class="kv-fileinput-error text-center text-success"><span class="close kv-success-close small">×</span>Page setup successfully</div>');
           
    }
</script>

</html>