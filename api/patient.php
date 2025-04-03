<?php
include 'user.php';

class Patient {
    
    private $conn;
    private $user;
    public function __construct(){
        
        $db=new Database();
        $this->conn=$db->connect();
        $this->user= new User;
    }

    public function get_patient($column,$value){
        
        if(!isset($column) || empty($column) ){
            $column='nom';
        }

        $stmt=$this->conn->prepare("select *,timestampdiff(year,date_naissance,current_date()) as age from patients p left join users u on p.user_id=u.id where p.$column like :value order by date_naissance");
        // print_r($stmt);
        $stmt->execute([":value"=>"%$value%"]);
        

        $patient = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        if ($patient) {
            return json_encode($patient);
        } else {
            return json_encode(["error"=>"error in fetsh patients",'NoPatient'=>true]);
        }

    }
    public function delet_patient($id){
        $stmt=$this->conn->prepare("delete from users where id=:id ");
        // print_r($stmt);
        $stmt->execute([":id"=> $id]);
     
        if ($stmt) {
            return json_encode(["succuss"=>'user have been ramoved']);
        } else {
            return json_encode(["error"=>"error in delete patient",'NoPatient'=>true]);
        }

    }


    public function update_patient($data){
        
        // print_r($stmt);
        $id=$data['id'];
        $patient = array_filter($data,function($key){
            return $key!='id';
        },ARRAY_FILTER_USE_KEY) ;
        $check=[];
        foreach($patient as $column=>$value){
            if($column=='email'){
                $this->user->update_Email($value,$id);
                $check['email']='email changed';
                continue;
            };

            $stmt=$this->conn->prepare("update patients set $column=:value where user_id = :id  ");
            $stmt->execute([":value"=>$value,":id"=>$id]);

            if ($stmt) {
                $check['succuss update patient']=true;
            } else {
                return json_encode(["error"=>"error in update_patient",'NoPatient'=>true]);
            }

        };
        return json_encode($check);
        
    }

    public function add_patient($data){
        
        $user_id=$this->user->add($data['email'],$data['password'],'patient');
        if(isset($user_id['already'])){
            return json_encode(['error'=>'email already used']);
        }

        $stmt=$this->conn->prepare("select * from patients where cne=:cne");
        $stmt->execute([":cne"=>$data['cne']]);
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$patient){
            $stmt=$this->conn->prepare("insert into patients value(:cne,:nom,:prenom,:date_naissance,:sexe,:adresse,:telephone,:user_id) ");
            $stmt->execute([
                ":cne" => $data['cne'],
                ":nom" => $data['nom'],
                ":prenom" => $data['prenom'],
                ":date_naissance" => $data['date_naissance'],
                ":sexe" => $data['sexe'],
                ":adresse" => $data['adresse'],
                ":telephone" => $data['telephone'],
                ":user_id" => $user_id
            ]);

            if ($stmt->rowCount()>0) {
                return json_encode(["success add patient"=>true]);
            } else {
                return json_encode(["error"=>"error in add patient"]);
            }

        } else{
            return json_encode(["error"=>"error patient already existe"]);
        }

        


    }

}
$patient=new Patient();

?>