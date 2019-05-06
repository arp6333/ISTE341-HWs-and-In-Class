<?php
    require_once "RestService.class.php";
    require_once "Product.class.php";

    class MyService extends RestService{
        // normally would use a db
        private $products;

        public function __construct($request, $origin){
            parent::__construct($request);
            // create dummy data
            for($i = 0; $i < 5; $i++){
                $this->products[] = new Product("Product $i", $i);
            }
        }

        protected function product($args){
            // if having issues: var_dump($args)
            if(count($args) == 0 && $this->method == "GET"){
                // /product path, normally db query
                $prods = array();
                foreach($this->products as $prod){
                    $prods[] = array(
                        "name" => $prod->getName(),
                        "id" => $prod->getId()
                    );
                }
                return $prods;
            }
            else if(count($args) == 1 && $this->method == "GET"){
                // /product/{id} path
                $p = $this->getProduct(intval($args[0])); // normally call to db
                if($p){
                    $prod = array(
                        "name" => $pd->getName(),
                        "id" => $p->getId()
                    );
                    return $prod;
                }
                else{
                    return parent::_response("Requested Resource Doesn't Exist", 404);
                }
            }
            else if(count($args) == 1 && $this->method == "PUT"){
                // same /product/{id} path but with PUT
                // info for PUT comes in as a string so parse accordingly
                $p =$this->getProduct(intval($args[0])); // normally call to db
                if($p){
                    // normally validate and update
                    return "Product {$args[0]} updated";
                }
                else{
                    return parent::_response("Requested Resource Doesn't Exist", 404);
                }
            }
            else if($this->method == "POST"){
                // post information comes in as array with index for each field
                // normally validate and insert
                return "Product {$this->request['name']} added";
            }
        }

        private function getProduct($id){
            $p = null;
            for($i = 0; $i < count($this->products); $i++){
                if($this->products[$i]->getId() == $id){
                    $p = $this->products[$i];
                    break;
                }
            }
            return $p;
        }
    }
    
    // create the service
    try{
        $API;
        if(isset($_SERVER['HTTP_ORIGIN'])){
            $API = new MyService($_REQUEST['request'],
                                 $_SERVER['HTTP_ORIGIN']);
        }
        else{
            $API = new MyService($_REQUEST['request'],
                                 "");
        }
        echo $API->processAPI();
    }
    catch(Exception $e){
        echo json_encode(array("error" => $e->getMessage()));
    }
?>