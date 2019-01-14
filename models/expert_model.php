<?php

class Expert_model extends Model {

    public function __construct() {
        parent::__construct();
    }

//    function symptoms() {
//        $big_data = array();
//        $data = $this->db->select("Select * from diagnosis.symptoms where status=0");
//        $data2 = $this->db->select("Select * from diagnosis.symptoms_sub where status=0");
//        $data3 = $this->db->select("Select * from diagnosis.symptoms_sub_sub where status=0");
//        $data4 = $this->db->select("Select * from diagnosis.symptoms_sub_sub_sub where status=0 ");
//        $data5 = $this->db->select("Select * from diagnosis.symptoms_sub_sub_sub_sub where status=0 ");
//        $data6 = $this->db->select("Select * from diagnosis.symptoms_sub_sub_sub_sub_sub where status=0");
//        $data7 = $this->db->select("Select illness.name as illname,symptoms.name as symname from ill_map_symptoms,illness,symptoms where symptoms.id=ill_map_symptoms.sym_id and illness.id=ill_map_symptoms.ill_id where status=0");
//        $data8 = $this->db->select("select ill_id,sym_id_group,point  FROM `piority_map`  where status=0 order by point desc");
//        $data9 = $this->db->select("select id,name FROM `illness` where status=0 ");
//
//        array_push($big_data, $data);
//        array_push($big_data, $data2);
//        array_push($big_data, $data3);
//        array_push($big_data, $data4);
//        array_push($big_data, $data5);
//        array_push($big_data, $data6);
//        array_push($big_data, $data7);
//        array_push($big_data, $data8);
//        array_push($big_data, $data9);
//
//        echo json_encode($big_data);
//    }
//
//    function saveSymptoms($data) {
//        $data1=json_decode($data["ill"]);
//        $data2=json_decode($data["sym"]);
//        $sql = "";
//        $sql2 = "";
//        $date = date("Y-m-d");
//        $time = date("h:i:s");
//        $param = array("uid" => $data["id"], "act_date" => $date, "act_time" => $time);
//        $id = $this->db->insert("user_diagnosis", $param);
////        $sym = strtok(",", $data2[0]);
////        $ill = strtok(",", $data1[0]);
//   
//        foreach ($data2 as $key => $value) {
//            if(isset($value)){
//                $sql2.=",('$id','$value')";
//            }
//        }
//        foreach ($data1 as $key=>$value) {
//               if(isset($value)){
//            $sql.=",('$id','$value')";
//               }
//        }
//        $sql = substr($sql, 1);
//        $sql2 = substr($sql2, 1);
//        $query=("INSERT INTO user_symptoms (dia_id,symptoms) VALUES $sql2;INSERT INTO user_illness (dia_id,ill_id) VALUES $sql;");
//        $sth = $this->db->prepare($query);
//        $sth->execute();
////                print_r($query) ;
//    }
//
//    function illness() {
//        $big_data = array();
//        $data = $this->db->select("select id,name FROM `illness` where status=0 and id<1870");
////        $data2 = $this->db->select("select id,name FROM `illness` where status=0 and id>701");
//        array_push($big_data, $data);
////                               array_push($big_data, $data2);
//        echo json_encode($big_data);
//    }

}
