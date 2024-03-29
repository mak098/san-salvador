<?php
    namespace Root\App\Controllers;
    use Root\App\Models\investmentModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    use Exception;
    session_start();
    class investmentController extends Controller{
        static function create(){
            try{
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name=htmlspecialchars($_POST['investmentName']);
                $color=htmlspecialchars($_POST['investmentColor']);
                $currency=htmlspecialchars($_POST['investmentCurrency']);
                $adminId=$_SESSION['admin']['adminId'];
                $validation=new Validator();
                if($adminId){
                    if($validation->isString($name) && $name !=""){
                        if($validation->isString($color) && $color !=""){
                            if($validation->isFloat($currency) && $currency !=""){
                                $invest=new InvestmentModel();
                                while($invest->checkId([$id])!=0){
                                    $id= $uuid->uuid();
                                }
                                $invest->insert([
                                    $id,
                                    $name,
                                    "now()",
                                    "now()",
                                    $color,
                                    $adminId,
                                    $currency 
                                ]);
                                 echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]);                                
                            }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}
                        }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}                    
                    }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Vous n'etait pas habilité a éffectuer cette operation"]);}            
            
            }
            catch(Exception $e){
                echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
            }
        } 
                  
    }
    
?>