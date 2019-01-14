var upper_new_data = {};
var upper_new_illness = {};
var question_accum = [];
var result_accumulator = [];
var order_look_up = [];
var tested_result = [];
var ass_acc = "";
var ass_check = [];
var createDiv = "<div class='list-item'>";
ass_acc += "<div class='slide' id='end'>" + Sub_division("What other symptoms do you feel", "", "") + "</div>";
var a = 1;
var pointer_counter = {};
var pointer_name = {};

pointer_name["name_fives"] = [];
pointer_name["name_fours"] = [];
//pointer_name["name_threes"] = [];
//pointer_name["name_twos"] = [];
//pointer_name["name_ones"] = [];
pointer_counter["fives"] = [];
pointer_counter["fours"] = [];
//pointer_counter["threes"] = [];
//pointer_counter["twos"] = [];
//pointer_counter["ones"] = [];
var illness_symptom_name_acc = {};
illness_symptom_name_acc["name"] = [];
illness_symptom_name_acc["symptom"] = [];
illness_symptom_name_acc["illness"] = [];
illness_symptom_name_acc["pointer"] = [];
var selected = []; // for all selected symptoms

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.get("http://localhost/CollaborativeFilteringHealthSystem/index/symptoms", function (data) {
        upper_new_data = JSON.parse(data);
    });
    $(document).on("click", ".select-sym li", function (e) {
        var val = $(this).find("a").text();
        var id = $(this).find("a").attr("rel_");
        if ($.inArray(val, selected) < 0) {
            selected.push(val);
            $(".symtoms_list").append(addSymptom(val, id, $.inArray(val, selected)));
        }
        e.preventDefault();
    });
    $(".nav-a-z ol li a").click(function (e) {
        $(".opt_div").empty();
        var val = $(this).text().toLowerCase();
        var divRight = "<div class='select-sym'><ul class='list-group'>";
        $.each(upper_new_data[0], function (key, new_data2) {
            if (val === new_data2["name"].substring(0, 1).toLowerCase()) {
                divRight += "<li class='list-group-item dis animated fadeIn'><a class='li-t'  rel_='" + new_data2["id"] + "'>" + new_data2["name"] + "</a></li>";
            }
        });
        if (divRight === "<div class='select-sym'><ul class='list-group'>") {
            divRight += "<div class='no-content'>No match symptoms</div>";
        }
        divRight += "</ul></div>";
        $(".select-sym").replaceWith(divRight);
        e.preventDefault();
    });
    $(document).on("click", ".zoom a", function (e) {
        var val = $(this).attr("href").toLowerCase();
        append_div(val);
        e.preventDefault();
    });
    function append_div(val) {
        $(".opt_div").empty();
        var divRight = "<div class='select-sym'><ul class='list-group'>";
        if (val) {
            $.each(upper_new_data[0], function (key, new_data2) {
                if (new_data2["body_location"].indexOf(val) > -1 || new_data2["name"].indexOf(val) > -1) {
                    divRight += "<li class='list-group-item dis animated fadeIn'><a rel_='" + new_data2["id"] + "'>" + new_data2["name"] + "</a></li>";
                }
            });
        }
        if (divRight === "<div class='select-sym'><ul class='list-group'>") {
            divRight += "<div class='no-content'>No match symptoms</div>";
        }
        ;
        divRight += "</ul></div>";
        $(".select-sym").replaceWith(divRight);
    }

    $(document).on("keyup", "#search_part", function (e) {
        var val = $("#search_part").val();
        //        console.log(val);
        append_div(val);
    });
    $(".cont").click(function (e) {
        if ($(".symtoms_list").children().length === 0) {
            //    alert("Select at least a symptom to proceed");
            return;
        }
        createDiv = "<div class='list-item'>";
        $.each(selected, function (key, data) {
            step(data, key);
        });
        createDiv += "</div> ";
        $(".list-item").replaceWith(createDiv);
        if ($(".list-item").text().length === 0) {
            act = 1;
        }
        setTimeout(function () {
            $('.init').addClass("animated bounceOutLeft").fadeOut(500);
        }, 100);
        clearTimeout();
        setTimeout(function () {
            $('.que').addClass("animated bounceInLeft").fadeIn();
        }, 600);
        clearTimeout();
        $(".next").trigger("click");
        e.preventDefault();
    });
    $(document).on("click", ".list-item input[name*='opt_check'], .list-item input[name*='opt_radio']", function (e) {
        var name = $(this).attr("name");
        $("input[name='" + name + "']").parent().parent().children(".opt_div").remove();
        var name_tag = name + "_" + $(this).attr("rel_");
        var name_id = name_tag.replace("opt_radio", "").replace("opt_check", "");
        var value = $(this).attr("value");
        var top_text = $(".slide.active .sym-sub, .slide.a .sym-sub").text();
        var parent_id = $(".sym-head").text();
        var sym = "(" + parent_id + ")(" + top_text + ")(" + value + ")";
        var ill_ponter = [];
        var str_name = name_tag.split("_")[0] + "_" + name_tag.split("_")[1] + "_" + name_tag.split("_")[2];
        if ($(".slide").attr("id").toLowerCase() === "end") {
            name_id = $(this).attr("rel_");
        }

        if (((illness_symptom_name_acc.name.indexOf(name_tag) > -1) && (name.indexOf("opt_check") > -1))) {
            var index = illness_symptom_name_acc.name.indexOf(name_tag);
            delete   illness_symptom_name_acc["name"][index];
            delete  illness_symptom_name_acc["pointer"][index];
            delete  illness_symptom_name_acc["symptom"][index];
            delete    illness_symptom_name_acc["illness"][index];
            return;
        }
        if ((illness_symptom_name_acc.pointer.indexOf(str_name) > -1) && (name.indexOf("opt_radio") > -1)) {
            var index = illness_symptom_name_acc.pointer.indexOf(str_name);
            delete   illness_symptom_name_acc["name"][index];
            delete  illness_symptom_name_acc["pointer"][index];
            delete  illness_symptom_name_acc["symptom"][index];
            delete    illness_symptom_name_acc["illness"][index];
        }
        illness_symptom_name_acc["name"].push(name_tag);
        illness_symptom_name_acc["pointer"].push(str_name);
        illness_symptom_name_acc["symptom"].push(sym);
        var ill = "|%" + name_id.replace(/\_/g, '%|%') + "%";
        $.each(upper_new_data[7], function (key, new_data2) {
            if (new_data2.sym_id_group === ill) {
                if (((name.indexOf("opt_radio") > -1) && value.toLowerCase() !== "no") || (name.indexOf("opt_check") > -1)) {
                    ill_ponter.push(new_data2.ill_id + " " + new_data2.point);
                } else {
                    ill_ponter.push(new_data2.ill_id + " " + "-1");
                }
            }
        });
        //       }
        illness_symptom_name_acc["illness"].push(ill_ponter);
        //        console.log("1" + JSON.stringify(illness_symptom_name_acc.illness));
        //        console.log("2" + JSON.stringify(illness_symptom_name_acc.symptom));
        //        console.log("3" + JSON.stringify(illness_symptom_name_acc.name));
        //        console.log("4" + JSON.stringify(illness_symptom_name_acc.pointer));
        $(".next").focus();
        $(".next").select();
    });
    $(document).on("click", ".list-item input[name*='opt_check'], .list-item input[name*='opt_radio']", function () {
        if ($(this).is(':checked')) {
            var id = $(this).attr("rel_");
            if ($(this).attr("type").trim() === "radio" && $(".i-" + id + " > .opt_div").html()) {
                return;
            }

            var name = $(this).attr("value");
            var up = $(this).attr("name").replace("opt_check", "").replace("opt_radio", "");
            var up_id = (up.split("_"))[1];
            var up_up_id = (up.split("_"))[0];
            if ("273" === $(this).attr("rel_")) {
                $("div[id=352]").addClass("hide");
                return;
            } else if (($(this).attr("name") === "opt_check140") || ($(this).attr("name") === "opt_check210") || ($(this).attr("name") === "opt_check58") || ($(this).attr("name") === "opt_check19") || ($(this).attr("name") === "opt_check7") || ($(this).attr("name") === "opt_check5") || ($(this).attr("name") === "opt_check11") || ($(this).attr("name") === "opt_check18") || ($(this).attr("name") === "opt_check54")) {
                step2(up_up_id, id);
                return;
            } else if ($(this).attr("name") === "opt_check18_77_589" || $(this).attr("name") === "  opt_check100_493_678" || $(this).attr("name") === "opt_radio5_13_576") {

                step4("", up_up_id, up_id, id);
                return;
            }
            step3(up_up_id, up_id, id);
            if (($(this).attr("type").trim() === "radio" || $(this).attr("type").trim() === "checkbox") && $(".i-" + id + " > .opt_div").html()) {
                $(this).parent().parent().parent().children().find(".radio-inline").not(".checked").parent().find(".opt_div").remove();
                return;
            }
        } else if ("273" === $(this).attr("rel_")) {
            $("div[id=352]").removeClass("hide");
        } else {
            var id = $(this).attr("rel_");
            $(".i-" + id + " > .opt_div").remove();
        }
    });
    $(document).on("click", ".cl", function (e) {
        var parent_text = $.trim($(this).parent().text().toLowerCase());
        var parent_text = parent_text.substring(0, parent_text.length - 1);
        //        alert(parent_text);
        var index = $.inArray(parent_text, selected);
        //        alert(index)
        delete selected[index];
        $(this).parent().remove();
        e.preventDefault();
    });
//    var lt="";
//    for(var i=0;i<5;i++){
//        a=[1,2,3,4,5,6,7.8,9,0,];
//        var b=a[parseInt(Math.random()*a.length)];
//        lt+=b;
//       } 
//       alert(lt);
});
function Label(data, id) {

}
function Division(data) {
    return "<div class='sym-name' name='opt_label'>" + data + "</div>";
}
function addSymptom(data, rel, id) {
    return "<div rel_='" + id + "' val='" + rel + "' class='symptoms' name='opt_label'>" + data + "<span data-toggle='tooltip' title='delete' data-placement='right' class='pull-right cl'>X</span></div>";
}
function Sub_division(data, id) {
    return "<div class='sym-sub' name='sub_opt_label" + id + "'>" + data + "</div>";
}
function results(data, id) {
    //    return "<div class='result-list'>" + data + "</div>";
    return "<div class='panel panel-primary'>\n\
            <div class='panel-heading'>\n\
            <h4 class='panel-title'><a class='result-list' data-toggle='collapse' data-parent='#accordion' href='#" + id + "'>" + data + "</a></h4>\n\
            </div>\n\
            <div id='" + id + "' class='panel-collapse collapse in'>\n\
            <div class='panel-body'>\n\
            <div class='details'><div></div>\n\
             </div> </div>";
}
function CheckBox(data, id, formid) {
    return  "<div class='checkdiv i-" + formid + "'><label for='checkbox" + formid + "' class='checkbox-inline'><input id='check" + formid + "' rel_='" + formid + "' type='checkbox' class='radiob' name='opt_check" + id + "'" + "value='" + data + "'>&nbsp;&nbsp;" + data + " </label><br /></div>";
}
function RadioButton(data, id, formid) {
  
    if (data === "yes" || data === "no") {
        return "<div class='radiodiv i-" + formid + "'><label class='w3-checkbox " + data + "' for='radio" + formid + data.replace(" ", "_") + "' ><input id='radio" + formid + data.replace(" ", "_") + "' rel_='" + formid + "'  type='radio' class='radiob' name='opt_radio" + id +"_"+"' value='" + data + "'><div class='w3-checkmark'></div>&nbsp;&nbsp;" + data + " </label><br /></div>";

    } else {
        return "<div class='radiodiv i-" + formid + "'><label for='radio" + formid + "' class='w3-checkbox'  " + data + " ><input id='radio" + formid + "' rel_='" + formid + "'  type='radio' class='radiob' name='opt_radio" + id +"_"+"' value='" + data + "'><div class='w3-checkmark'></div>&nbsp;&nbsp;" + data + " </label><br /></div>";

    }
}
function Instruction(data, id) {
    return "<div name='opt_instruct" + id + "'>" + data + " </div>";
}
function keeper(data, id) {
    return "<div name='instruct_label'>" + data + "</div>";
}
function step(mydata, id) {
    $.each(upper_new_data[0], function (key, new_data2) {
        if (new_data2["name"] === mydata) {
            step1(new_data2["id"], id);
        }
    });
}
function step1(id, parent_id) {
    $.each(upper_new_data[1], function (key, new_data2) {
        //  alert(id+new_data2["id"])
        if (new_data2["sym_id"].trim() === id.trim()) {
            if ((id === "1" && new_data2["id"] === "5") || id === "4" || id === "304"|| id === "199"|| id === "330"||( id === "193" && (new_data2["id"] ==="840"|| new_data2["id"] ==="844"|| (new_data2["id"]==="843"))) || id === "337" ||  id === "345" || id === "335" || id === "332" ||( id === "321" && (parseInt(new_data2["id"])===810 )) ||( id === "214" && (parseInt(new_data2["id"])===758 )) ||( id === "299" && (parseInt(new_data2["id"])>784 ))  ||( id === "324" && (new_data2["id"]==="814" || new_data2["id"]==="818") || new_data2["id"]==="816")|| id === "198" || (id === "3" && new_data2["id"] !== "703") || (parseInt(id) > 70 && parseInt(id) < 86 && new_data2["id"] !== "377" && new_data2["id"] !== "382" && new_data2["id"] !== "383" && new_data2["id"] !== "385" && new_data2["id"] !== "391" && new_data2["id"] !== "413" && new_data2["id"] !== "400") ||
                (parseInt(id) > 87 && parseInt(id) < 99 && new_data2["id"] !== "458" && new_data2["id"] !== "462" && new_data2["id"] !== "466" && new_data2["id"] !== "468" && new_data2["id"] !== "491" && new_data2["id"] !== "482" && new_data2["id"] !== "483" && new_data2["id"] !== "467" && id !== "98" && id !== "96" && id !== "93")
                || (parseInt(id) > 99 && parseInt(id) < 113 && (new_data2["id"] !== "493" && new_data2["id"] !== "502" && new_data2["id"] !== "544" && new_data2["id"] !== "541" && new_data2["id"] !== "511" && new_data2["id"] !== "504" && new_data2["id"] !== "505" && new_data2["id"] !== "536" && new_data2["id"] !== "506" && new_data2["id"] !== "507" && new_data2["id"] !== "508" && new_data2["id"] !== "513") && new_data2["id"] !== "510") || new_data2["id"] === "9" || id === "19" || id === "7" || id === "37" || id === "32" || id === "42" || id === "44" || (id === "11" && new_data2["id"] !== "40" && new_data2["id"] !== "34" && new_data2["id"] !== "42" && new_data2["id"] !== "47") || id === "51" || id === "12" || id === "13" || id === "26" || id === "55" || id === "61" || id === "65" ||
                (((parseInt(id) > 112 && parseInt(id) < 130 && (parseInt(id) !== 126)) || (parseInt(id) === 205 && parseInt(id))) && new_data2["id"] !== "545" && new_data2["id"] !== "549" && new_data2["id"] !== "554" && new_data2["id"] !== "555" && new_data2["id"] !== "560" && new_data2["id"] !== "563" && new_data2["id"] !== "569")
                || ((parseInt(id) > 129 && parseInt(id) < 158) && new_data2["id"] !== "578" && new_data2["id"] !== "563" && new_data2["id"] !== "587" && new_data2["id"] !== "588" && new_data2["id"] !== "600" && new_data2["id"] !== "605" && new_data2["id"] !== "613" && new_data2["id"] !== "614" && new_data2["id"] !== "615" && new_data2["id"] !== "618" && new_data2["id"] !== "621" && new_data2["id"] !== "618" && new_data2["id"] !== "609" && new_data2["id"] !== "606" && id !== "134")
                || (((parseInt(id) > 157 && (parseInt(id) < 183))) && new_data2["id"] !== "628" && new_data2["id"] !== "723" && new_data2["id"] !== "628" && new_data2["id"] !== "749" && new_data2["id"] !== "733" && new_data2["id"] !== "625" && new_data2["id"] !== "688" && new_data2["id"] !== "624" && new_data2["id"] !== "642" && new_data2["id"] !== "645" && new_data2["id"] !== "665" && new_data2["id"] !== "668")
                || (id === "188" && new_data2["id"] === "699") || (id === "194" && new_data2["id"] === "723") || (id === "196" && new_data2["id"] !== "730") || (id === "202" && new_data2["id"] !== "750")
                || ((id === "210" || id === "206" || id === "208") && (new_data2["id"] !== "629" && new_data2["id"] !== "630")) || (id === "185" && (new_data2["id"] === "677" || new_data2["id"] === "678")) || (id === "183" && (new_data2["id"] === "671" || new_data2["id"] === "672"))
                || (id === "20" && new_data2["id"] !== "364") || (id === "40" && new_data2["id"] === "177") || (id === "28" && new_data2["id"] !== "132") || (id === "45" && new_data2["id"] !== "193") || (id === "46" && new_data2["id"] !== "213") || (id === "47" && new_data2["id"] !== "217") || (id === "50" && new_data2["id"] !== "219") || (id === "53" && (new_data2["id"] !== "231" && new_data2["id"] !== "236"))
                || (id === "17" && (new_data2["id"] !== "67" && new_data2["id"] !== "69" && new_data2["id"] !== "75")) || (id === "18" && new_data2["id"] !== "76" && new_data2["id"] !== "77") || (id === "21" && new_data2["id"] === "89") || (id === "30" && new_data2["id"] === "143") || (id === "54" && new_data2["id"] !== "240" && new_data2["id"] !== "246" && new_data2["id"] !== "247") ||
                (id === "22" && new_data2["id"] !== "93" && new_data2["id"] !== "94") || id === "14" || (id === "24" && new_data2["id"] !== "106") || (id === "56" && new_data2["id"] !== "265") || (id === "57" && (new_data2["id"] !== "276" && new_data2["id"] !== "274")) || (id === "23" && (new_data2["id"] === "770" ||new_data2["id"] === "103" || new_data2["id"] === "104") || (id === "59" && new_data2["id"] !== "290") || (id === "30" && (151 > parseInt(new_data2["id"]) && parseInt(new_data2["id"]) > 145))
                    || (id === "31" && ("152" !== new_data2["id"])) || (id === "38" && new_data2["id"] !== "168") || (id === "39" && (new_data2["id"] === "175" || new_data2["id"] === "879")) || (id === "43" && new_data2["id"] === "183")) || (id === "66" && new_data2["id"] !== "340") || (id === "68" && new_data2["id"] !== "342" && new_data2["id"] !== "341")
                || (id === "58" && (new_data2["id"] !== "280" && new_data2["id"] !== "277" && new_data2["id"] !== "279" && new_data2["id"] !== "278" && new_data2["id"] !== "282")) || (id === "64" && new_data2["id"] !== "319" && new_data2["id"] !== "321" && new_data2["id"] !== "316") || (id === "70" && new_data2["id"] === "351")
                || (id === "27" && (parseInt(new_data2["id"]) > 760 && parseInt(new_data2["id"]) < 765) || (parseInt(new_data2["id"]) > 765 && parseInt(new_data2["id"]) < 769)) || id === "340"|| id === "269" ||(id==="25" && (new_data2["id"]==="877" ||new_data2["id"]==="878" ||new_data2["id"]==="876")) || (id==="48" && new_data2["id"]==="852")
                )
                {
                if ($.inArray(new_data2["name"], question_accum) < 0) {
                    //alert("am here")
                    createDiv += "<div class='slide' id='" + new_data2["id"] + "' rel_='" + parent_id + "'>" + Sub_division(new_data2["name"], id);
                    createDiv += "<div id='" + new_data2["id"] + "' rel_='" + parent_id + "'>" + RadioButton("yes", id, new_data2["id"]) + "</div>";
                    createDiv += "<div id='" + new_data2["id"] + "' rel_='" + parent_id + "'>" + RadioButton("no", id, new_data2["id"]) + "</div></div>";
                    question_accum.push(new_data2["name"]);
                }

            } else if ((id === "39" && (new_data2["id"] === "103" || new_data2["id"] === "104"))) {
                if ($.inArray(new_data2["name"], question_accum) < 0) {
                    createDiv += "<div class='slide' id='" + new_data2["id"] + "' rel_='" + parent_id + "'>" + RadioButton(new_data2["name"], id, new_data2["id"]) + "</div>";
                    question_accum.push(new_data2["name"]);
                }
            }
            else {
                if ("associated with" === new_data2["name"].toLowerCase() || "associating factor" === new_data2["name"].toLowerCase() || "other symptoms present:" === new_data2["name"].toLowerCase() || "What other symptoms present?" === new_data2["name"].toLowerCase() || "accompanied by" === new_data2["name"].toLowerCase()) {
                    ass(new_data2["id"], new_data2["name"]);
                } else {
                    createDiv += "<div class='slide' id='" + new_data2["id"] + "' rel_='" + parent_id + "'>" + Sub_division(new_data2["name"], id);
                    step2(id, new_data2["id"]);
                    createDiv += "</div>";
                }

            }

        }
    });
}
function ass(id, name) {
    //    console.log(id);
    $.each(upper_new_data[2], function (key2, new_data) {
        $.each(upper_new_data[0], function (key, new_data2) {
            if ((new_data2["id"].toLowerCase() === new_data["name"].toLowerCase() && id === new_data["sub_id"])) {
                if (ass_check.indexOf(new_data.name) === -1) {
                    ass_check.push(new_data.name);
                    ass_acc += CheckBox(new_data2["name"], new_data["id"], new_data["name"]);
                }

            }
        });
    });
}
function step2(up_id, id, hint) {

    var create_opt = "<div class='opt_div'>";
    $.each(upper_new_data[2], function (key, new_data2) {
        if (new_data2["sub_id"] === id) {
            if ((up_id === "54" && id === "245")) {
                create_opt += RadioButton(new_data2["name"], up_id + "_" + id, new_data2["id"]);
            } else if (up_id === "7" || (up_id === "18" && id === "79") || (up_id === "210" && id === "631") || (up_id === "140" && id === "598") || (up_id === "19" && id === "363") || (id === "49" && new_data2["id"] !== "141")) {
                create_opt += CheckBox(new_data2["name"], up_id + "_" + id, new_data2["id"]);
            }
            else if (new_data2["name"].indexOf("choice") > -1) {
                createDiv += "<div id='" + new_data2["id"] + "'>";
                step3(up_id, id, new_data2["id"]);
                createDiv += "</div>";
            }
            else if (hint === "1" || (up_id === "66" && id === "340") || (up_id === "75" && id === "391") || (up_id === "29" && id === "141") || id === "8" || (id === "588") || (id === "668" && up_id === "160") || id === "10" || up_id === "6" || (up_id === "23" && (id === "100" || id === "99" || id === "105")) || (up_id === "29" && (id === "138" || id === "139")) || ((up_id === "15") && (new_data2["id"] !== "131" && new_data2["id"] !== "130"))
                || (up_id === "11" && id !== "34") || (up_id === "30" && id === "145") || (up_id === "39" && id === "176")) {
                createDiv += CheckBox(new_data2["name"], up_id + "_" + id, new_data2["id"]);
            } else {
                createDiv += RadioButton(new_data2["name"], up_id + "_" + id, new_data2["id"]);
            }

        }
    });
    create_opt += "</div>";
    $(".i-" + id).append(create_opt);
}
function step3(up_up_id, up_id, id) {

    var create_opt = "<div class='opt_div'>";
    $.each(upper_new_data[3], function (key, new_data2) {
        if (new_data2["sub_id"] === id) {
            if ((up_id === "8" && up_up_id === "1") || (up_id === "359") || (up_id === "63" && up_up_id === "15") || (up_id === "92" && up_up_id === "21") || (up_id === "77" && id === "589") || (up_id === "363" && id === "606") || (up_id === "467" && (id === "656" || id === "657"))
                || (up_id === "493" && (id === "679" || id === "678"))) {
                create_opt += CheckBox(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
            } else if ((up_id === "173")) {
                create_opt += Sub_division(new_data2["name"], id, new_data2["id"]);
                create_opt += step4(up_up_id, up_id, id, new_data2["id"]);
            }
            else if ((up_id === "76" && id === "166") || (up_id === "13" && id === "576")) {
               
                if ("associated with" === new_data2["name"].toLowerCase() || "associating factor" === new_data2["name"].toLowerCase() || "other symptoms present:" === new_data2["name"].toLowerCase() || "What other symptoms present?" === new_data2["name"].toLowerCase() || "what other symptoms do you have" === new_data2["name"].toLowerCase() || "accompanied by" === new_data2["name"].toLowerCase()) {
                    ass_acc += "<div class='slide' id='end' rel_='" + up_id + "'>" + Sub_division(new_data2["name"], id, new_data2["id"]) + "</div>";
                    ass(new_data2["name"]);
                    ass_acc += "</div>";
                } else {
                    create_opt += RadioButton(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
                }
            }
            else {
                createDiv += RadioButton(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
            // step3(new_data2["id"]);
            }
        }
    });
    create_opt += "</div>";
    $(".i-" + id).append(create_opt);
}
function step4(up_up_up_id, up_up_id, up_id, id) {

    var more_opt = "<div class='more-on'>";
    var create_opt = "<div class='opt_div'>";
    $.each(upper_new_data[4], function (key, new_data2) {
        if (new_data2["sub_id"] === id) {
            alert($.trim(up_up_id));
            if ((up_id === "77" && id === "137") || (up_id === "678" && id === "173") || (up_id === "13" && id === "151")) {
                create_opt += RadioButton(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
            } else if (($.trim(up_id) === "576" && id === "151") || ($.trim(up_up_id)  === "173")) {
                       
                more_opt += RadioButton(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
            } else {
                createDiv += RadioButton(new_data2["name"], up_up_id + "_" + up_id + "_" + id, new_data2["id"]);
            // step3(new_data2["id"]);
            }
        }
    });
    if (up_up_up_id.length === 0) {
        create_opt += "</div>";
        $(".i-" + id).append(create_opt);
    } else {
        return   more_opt += "</div>";
    }

}
function result() {
    var result_filter = [];
    var result_key = [];
    var result = "";
    var res_id_acc = "";
    // alert(JSON.stringify(illness_symptom_name_acc["illness"]));

    $.each(illness_symptom_name_acc["illness"], function (key, new_data2) {
        if (new_data2) {
            $.each(new_data2, function (id, value) {
                if (value.length !== 0) {
                    if (parseInt(result_filter[value.split(" ")[0]]) >= 0) {
                        order_look_up.push(value.split(" ")[0] + "=>" + parseInt(value.split(" ")[1]));
                        result_filter[value.split(" ")[0]] = parseInt(result_filter[value.split(" ")[0]]) + parseInt(value.split(" ")[1]);
                        //                        console.log("old: " + value.split(" ")[0] + "=>" + result_filter[value.split(" ")[0]]);
                        if (parseInt(value.split(" ")[1]) === 5) {
                            pointer_name["name_fives"].push(value.split(" ")[0]);
                            pointer_counter["fives"].push(result_filter[value.split(" ")[0]]);
                        }
                        if (parseInt(value.split(" ")[1]) === 4) {
                            pointer_name["name_fours"].push(value.split(" ")[0]);
                            pointer_counter["fours"].push(result_filter[value.split(" ")[0]]);
                        }
                    //                        if (parseInt(value.split(" ")[1]) === 3) {
                    //                            pointer_name["name_threes"].push(value.split(" ")[0]);
                    //                            pointer_counter["threes"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    //                        if (parseInt(value.split(" ")[1]) === 2) {
                    //                            pointer_name["name_twos"].push(value.split(" ")[0]);
                    //                            pointer_counter["twos"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    //                        if (parseInt(value.split(" ")[1]) === 1) {
                    //                            pointer_name["name_ones"].push(value.split(" ")[0]);
                    //                            pointer_counter["ones"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    } else {
                        order_look_up.push(value.split(" ")[0] + "=>" + parseInt(value.split(" ")[1]));
                        result_filter[value.split(" ")[0]] = parseInt(value.split(" ")[1]);
                        //                        console.log("new: " + value.split(" ")[0] + "=>" + result_filter[value.split(" ")[0]]);
                        if (parseInt(value.split(" ")[1]) === 5) {
                            pointer_name["name_fives"].push(value.split(" ")[0]);
                            pointer_counter["fives"].push(result_filter[value.split(" ")[0]]);
                        }
                        if (parseInt(value.split(" ")[1]) === 4) {
                            pointer_name["name_fours"].push(value.split(" ")[0]);
                            pointer_counter["fours"].push(result_filter[value.split(" ")[0]]);
                        }
                    //                        if (parseInt(value.split(" ")[1]) === 3) {
                    //                            pointer_name["name_threes"].push(value.split(" ")[0]);
                    //                            pointer_counter["threes"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    //                        if (parseInt(value.split(" ")[1]) === 2) {
                    //                            pointer_name["name_twos"].push(value.split(" ")[0]);
                    //                            pointer_counter["twos"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    //                        if (parseInt(value.split(" ")[1]) === 1) {
                    //                            pointer_name["name_ones"].push(value.split(" ")[0]);
                    //                            pointer_counter["ones"].push(result_filter[value.split(" ")[0]]);
                    //                        }
                    }
                }
            });
        }
    });

    //    console.log(pointer_counter);
    $.each(pointer_counter, function (key, data) {
        $.each(data, function (key2, new_data2) {
            //            if (new_data2 > 5) {
            console.log("name" + key + "  " + key2);
            result_accumulator.push(pointer_name["name_" + key][key2]);
        //            }
        });
    });
    console.log(result_accumulator);
    //    console.log(order_look_up);
    $.each(result_accumulator, function (key2, new_data) {
        $.each(upper_new_data[8], function (key, new_data2) {
            if ((new_data2.id.toLowerCase() === new_data.toLowerCase()) && res_id_acc.indexOf("," + new_data2.id + ",") === -1) {
                res_id_acc += "," + new_data2.id + ",";
                result_key[new_data2.id] = new_data2.name;
                tested_result.push(new_data2.name);
            }
        });
    });

    //    console.log(" result_key" + result_key);
    ////    for (var i = 5; i >= 1; i--) {
    //    var i = 5;
    //    $.each(result_key, function (key, new_data2) {
    //        tested_result.push(new_data2);
    //    });
    //    }

    console.log("tested result   " + tested_result);
    res_id_acc = "";
    $.each(tested_result, function (id, value) {

        if (res_id_acc.indexOf("," + value + ",") === -1 && value) {
            res_id_acc += "," + value + ",";
            result += Sub_division(value, "");
        }
    //                });
    //            }
    });
    //    alert(result);
    if (result.length === 0) {
        result = "the selected symptoms is not enough for diagnose, please select more comprehensive question, try to select up to there(3) symptom that is associated with your symptoms for better result. ";
        $(".list-item").replaceWith("<div class='list-item'>" + result + "<div>");
    } else {

        $(".list-item").replaceWith("<div class='list-item'>" + result + "<div class='col-xs-12' style='text-align:center'><button class='btn btn-lg btn-success savedb' style='width:100%'>OK</button></div><div>");
       // $(".q").before("<div  style='  width: 100%; font-size: 100px; text-align: center;'>Possible Causes</div>");
    }


    $(".sym-head").fadeOut();
    $(".next").fadeOut();
    $(".back").fadeOut();
}
function confirm_quest() {
    $(".symptoms").each(function (data1) {
        symptoms_comp($(this).attr("val"), $(this).text(), $(this).attr("name"));
    });
}
function symptoms_comp(val1, name, sym) {
    var ill_ponter = [];
    var ill = "|%" + val1 + "%";
    name = name.substring(0, name.length - 1);
    $.each(upper_new_data[7], function (key, new_data2) {
        if (new_data2.sym_id_group === ill) {
            ill_ponter.push(new_data2.ill_id + " " + new_data2.point);
        }
    });
    illness_symptom_name_acc["illness"].push(ill_ponter);
    illness_symptom_name_acc["name"].push(sym);
    illness_symptom_name_acc["symptom"].push(name);

//test if option is applied
//    console.log("1" + JSON.stringify(illness_symptom_name_acc.illness));
//    console.log("2" + JSON.stringify(illness_symptom_name_acc.symptom));
//    console.log("3" + JSON.stringify(illness_symptom_name_acc.name));
//    console.log("jjj" + JSON.stringify(ill));
}

$(document).ready(function () {
    var animation = 'animated bounceIn';
    var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    $(document).on('click', '.img', function () {
        $('.zoom').children().hide();
        var part = $(this).attr('data-imgid');
        $('#' + part).addClass(animation).fadeIn().one(animationend, function () {
            $(this).removeClass(animation);
        });
    });
    $(document).on('click', 'input[type=radio]', function () {
        $('input[type=radio]').closest('.slide').find('.w3-checkbox, .radio').removeClass('checked');
        $(this).closest('.w3-checkbox, .radio').addClass('checked');
    });
    $(document).on('click', 'input[type=checkbox]', function () {
        $(this).closest('.w3-checkbox, .checkbox').toggleClass('checked');
    });
    //    $(document).on('click', ".savedb", function () {
    //
    //        var ill = JSON.stringify(result_accumulator);
    //        var sym = JSON.stringify(illness_symptom_name_acc["symptom"]);
    //        $.post("http://localhost/CollaborativeFilteringHealthSystem/index/saveSymptoms", {ill: ill, sym: sym, id: 5}, function (response) {
    //            alert(response);
    //        });
    //    });
    $(document).on('click', ".savedb", function () {
        $(location).attr('href', '');
    });
});
