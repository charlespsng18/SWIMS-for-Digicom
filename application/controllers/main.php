<?php

    class main extends CI_Controller {

        public function __construct() {
            parent:: __construct();
            $this->load->model("swimsdb");
            $this->load->library('session');
        }

        public function login() {
            $this->load->view("login");
        }

        public function logout() {
            session_destroy();
            header("Location: login");
        }

        public function get_users() {
            header("Content-type: application/json");
            $res = $this->swimsdb->get_users();
            echo json_encode($res);
        }

        public function validate() {								//changed to hash and salt
            header("Content-type: application/json");
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $res = $this->swimsdb->validate($username, $password);

            if ($res) {
                echo json_encode($res);

                $this->load->library('session');

                foreach ($res as $row) {
                    $position = $row["position_no"];
                    if ($position == 1) {
                        $data = array(
                            "username" => $username,
                            "position" => $position
                        );
						$this->session->set_userdata($data);
                    }
                    else if ($position ==6) {
                        $data = array(
                            "username" => $username,
                            "position" => $position
                        );
						$this->session->set_userdata($data);
                    }
					else if($position ==7){
						$data = array(
                            "username" => $username,
                            "position" => $position
                        );
						$this->session->set_userdata($data);
						}
					}
				}
					
            else
                echo 0;            
        }

        public function display_products(){
            header("Content-type: application/json");

            $res = $this->swimsdb->display_products();
            echo json_encode($res);
        }

        public function admin() {
            if ($this->session->position != 1) {
                header("Location: login");
            }
            else {
                $this->load->view("admin");
            }
        }

        public function user() {
            if ($this->session->position != 1) { // needs to be changed
                header("Location: login");
            }
            else {
                $this->load->view("user");
            }
        }

        public function products() {
			$isadmin=$this->session->position==1;
			$isprojhead=$this->session->position==2;
			$isinvman=$this->session->position==5;

            if ($isadmin || $isprojhead || $isinvman) { 
				$this->load->view("products");
            }
            else {
                header("Location: login"); 
            }
        }

        public function packages() {
            $isadmin=$this->session->position==1;
			$isprojhead=$this->session->position==2;
			$isinvman=$this->session->position==5;

            if ($isadmin || $isprojhead || $isinvman) { 
               $this->load->view("packages");    
            }
            else {
				header("Location: login");
            }
        }

        public function shipper() {
            if ($this->session->position != 6) {
                header("Location: login");
            }
            else {
                $this->load->view("shipper");
            }
        }

        public function add_user() {				//changed to hash and salt
            if ($this->session->position != 1) {  //changed
                header("Location: login");
            }
            $username = $this->input->post("username");
            $firstname = $this->input->post("firstname");
            $lastname = $this->input->post("lastname");
            $password = $this->input->post("password");
            $position = $this->input->post("position");
            $email = $this->input->post("email");

            switch($position) {
                case "Admin": $posno = 1; break;
                case "Project Head": $posno = 2; break;
                case "Sales Head": $posno = 3; break;
                case "Financial Officer": $posno = 4; break;
                case "Inventory Manager": $posno = 5; break;
                case "Shipper": $posno = 6; break;
				case "Supplier": $posno = 7; break;
            }

            $this->swimsdb->add_user($username, $firstname,$lastname,$email,$position,$posno,$password);
        }

        public function get_categories() {
            if(($this->session->position >= 1) && ($this->session-> position <=6)){ 
				header("Content-type: application/json");
				$res = $this->swimsdb->get_categories();

				echo json_encode($res);
			}
			else{
				header("Location: login");
			}
        }

        public function inventory(){
            $isadmin=$this->session->position==1;
			$isinvman=$this->session->position==5;   
            if ($isadmin || $isinvman) {
                $this->load->view("inventory");
			}
            else {
                header("Location: login");
            }
        }

        public function get_packages() {
            if(($this->session->position >= 1) && ($this->session-> position <=6)){ //changed
				header("Content-type: application/json");
				$res = $this->swimsdb->get_packages();
				echo json_encode($res);               
			}
			else{
				header("Location: login");
			}
        }

        public function get_suppliers() {
            if(($this->session->position >= 1) && ($this->session-> position <=6)){
				header("Content-type: application/json");
				$res = $this->swimsdb->get_suppliers();

				echo json_encode($res);
			}
			else{
				header("Location: login");
			}
        }

        public function get_warehouses() {
            if(($this->session->position >= 1) && ($this->session-> position <=6)){
				header("Content-type: application/json");
				$res = $this->swimsdb->get_warehouses();

				echo json_encode($res);
			}
			else{
				header("Location: login");
			}
        }

        public function delete_user() {

            $notadmin=$this->session->position!=1;
			if ($notadmin) {
                header("Location: login");
            }
			else {
				$user = $this->input->post("username");
				$this->swimsdb->delete_user($user);
			}
        }

        public function edit_user() {			//changed	//changed to hash and salt
            $notadmin=$this->session->position!=1;
            if ($notadmin) {
                header("Location: login");
            }
            else{
                $username = $this->input->post("username");
                $password = $this->input->post("password");
                $firstname = $this->input->post("firstname");
                $lastname = $this->input->post("lastname");
                $email = $this->input->post("email");
                $position = $this->input->post("position");

                switch($position) {
                    case "Admin": $posno = 1; break;
                    case "Project Head": $posno = 2; break;
                    case "Sales Head": $posno = 3; break;
                    case "Financial Officer": $posno = 4; break;
                    case "Inventory Manager": $posno = 5; break;
                    case "Warehouse Manager": $posno = 6; break;
                    case "Shipper": $posno = 7; break;
                }

                $this->swimsdb->edit_user($username, $firstname,$lastname,$email,$position,$posno,$password);
            }

        }
		public function notify_supplier(){ 				//changed
			$notadmin=$this->session->position!=1;
			if ($notadmin) {
                header("Location: login");
            }
			else{
				$product_id = $this -> input -> post("product_id");
				$quantity = $this -> input -> post("quantity");
				$supplier_name = $this -> input -> post("supplier_name");
				$get_specific_supplier = $this -> swimsdb -> get_suppliers_details($supplier_name);
				$supplier=$get_specific_supplier[0];
				$supplier_id=$supplier["supplier_id"];
				return $this->swimsdb -> add_pending_supply($product_id, $quantity, $supplier_id);
			}
		}
        public function add_product() {

            $name = $this->input->post("name");
            $desc = $this->input->post("desc");
            $category = $this->input->post("category");
            $price = $this->input->post("price");
            $reorder = $this->input->post("reorder");

            $product = array(
                "product_name" => $name,
                "product_description" => $desc,
                "category_no" => $category,
                "quantity_in_stock" => 0,
                "buy_price" => $price,
                "reorder_level" => $reorder,
            );

            $this->swimsdb->add_product($product);
        }

        public function get_last_product(){
            header("Content-type: application/json");
            $res = $this->swimsdb->get_last_product();

            echo json_encode($res);
        }

        public function get_last_order(){
            header("Content-type: application/json");
            $res = $this->swimsdb->get_last_order();

            echo json_encode($res);
        }

        public function add_product_to() {
            $isadmin=$this->session->position==1;
			$isprojhead=$this->session->position==2;
			$isinvman=$this->session->position==5;
            if ($isadmin || isprojhead || $isinvman) {
            $warehouse = $this->input->post("warehouse");
            $package = $this->input->post("pack");
            $supplier = $this->input->post("supplier");
            $product = $this->input->post("product_id");


            $this->swimsdb->add_product_to($product, $warehouse, $package, $supplier);
			}
			else{
				header("Location: login");
			}
        }

        public function orders(){
            $isadmin=$this->session->position==1;
			$issaleshead=$this->session->position==3;
			$isfinoff=$this->session->position==4;
			$isprojhead=$this->session->position==2;
			$isshipper=$this->session->position==6;
            if ($isadmin || $issaleshead || $isfinoff || $isprojhead || $isshipper) { // changed
                $this->load->view("orders");
            }
            else {
               header("Location: login"); 
            }
        }

        public function get_individual_products() {
            header("Content-type: application/json");
            $res = $this->swimsdb->get_individual_products();

            echo json_encode($res);
        }

        public function get_date(){
            header("Content-type: application/json");
            date_default_timezone_set("Asia/Manila");
            $dateCreated = date("m/d/Y");
            $d = strtotime("+3 Days");

            $dates = array(
                "order_created" => $dateCreated,
                "order_deliver" => date("m/d/Y", $d));

            echo json_encode($dates);
        }
		public function get_prod_low(){
			header("Content-type: application/json");
			$prod_low_list = $this -> swimsdb -> get_prod_low();

			echo json_encode($prod_low_list);
		}
		public function supplier($username){					//changed for supplier
			$issupplierposition=$this->session->position==7;
			$issupplier=$this->session->username==$username;
			if($issupplierposition && $issupplier){
				$supplies=$this->swimsdb->get_all_product_of_supplier($username);
				$this->load->view("supplier", array (
					"username" => $username,
					"supplies" => $supplies));
			}
			else{
				header("Location: http://localhost/index.php/main/login"); 
			}
		}
		public function confirm_transfer(){    //changed
			$product_name = $this->input->post("prodname");
            $supplier_name = $this->input->post("supplier_name");
			return $this -> swimsdb -> confirm_transfer_product($product_name, $supplier_name);
		}		
        public function add_order(){
            header("Content-type: application/json");
            date_default_timezone_set("Asia/Manila");
            $order = $this->input->post("order");


            $o = array(
                "invoice_no" => "I-".$order[0]["invoice"],
                "required_date" => date("Y-m-d H:i:s", strtotime($order[0]["required_date"])),
                "date_created" => date("Y-m-d H:i:s", strtotime($order[0]["create_date"])),
                "terms" => $order[0]["terms"],
                "status" => "Items in Warehouse",
                "customer_name" => $order[0]["customer"],
                "username" => $order[0]["username"],
                "business_name" => $order[0]["business_name"],
                "ship_to" => $order[0]["address"]
            );

            echo $this->swimsdb->add_order($o);
        }

        public function get_orders(){
            header("Content-type: application/json");
            echo json_encode($this->swimsdb->get_orders());
        }

        public function add_order_details() {
            $cart = $this->input->post("cart");
            $order = $this->input->post("order");

            for ($i = 0; $i < count($cart); $i++) {
                $d = array(
                    "order_no" => $order,
                    "product_id" => $cart[$i]["id"],
                    "quantity" => $cart[$i]["quantity"],
                    "price" => $cart[$i]["price"]
                );

                $this->swimsdb->add_order_details($d);
            }
        }

        public function get_full_orders() {
            header("Content-type: application/json");
            $res= $this->swimsdb->get_full_orders();
            echo json_encode($res);
        }

        public function invoice() {
            $this->load->view("invoice");
        }

        public function get_full_order() {
            header("Content-type: application/json");
            $order = $this->input->post("order");
            $res = $this->swimsdb->get_full_order($order);

            echo json_encode($res);
        }

        public function pull_out() {
            $this->load->view("pull-out-slip");
        }

        public function pull_out_order() {
            header("Content-type: application/json");
            $order = $this->input->get("order");
            $wh = $this->input->get("warehouse");

            $res = $this->swimsdb->pull_out_order($order, $wh);
            echo json_encode($res);

        }

        public function add_pullout() {
            $order = $this->input->post("order");
            $pon = $this->input->post("pon");
            $date = $this->input->post("date");

            $data = array(
                "order_no" => $order,
                "pull_out_slip_no" => $pon,
                "create_date" => date("Y-m-d H:i:s", strtotime($date))
            );

            return $this->swimsdb->add_pullout($data);
        }

        public function get_pullouts() {
            header("Content-type: application/json");
            $res = $this->swimsdb->get_pullouts();
            echo json_encode($res);
        }

        public function update_status() {
            $order = $this->input->post("order");
            $status = $this->input->post("status");

            $this->swimsdb->update_status($status, $order);
        }

        public function get_products_order() {
            $order = $this->input->post("order");

            echo json_encode($this->swimsdb->get_products_order($order));
        }

        public function get_product() {
            header("Content-type: application/json");
            $product = $this->input->post("product");
            $qo = $this->input->post("quantity_O");
            $res = $this->swimsdb->get_product($product);

            $array = array($res, $qo);

            echo json_encode($array);
        }

        public function update_inventory() {
            $product = $this->input->post("product");
            $quantity = $this->input->post("quantity");

            //echo var_dump($product);
            echo $this->swimsdb->update_inventory($quantity,$product);
        }

        public function delivery_receipt() {
            $this->load->view("delivery_receipt");
        }

        public function checkPOS() {
            $order = $this->input->post("order");

            echo json_encode(
                $this->swimsdb->check_POS($order)
            );
        }

        public function deliver() {

            $order = $this->input->post("order");
            $drno = $this->input->post("drno");
            $date = $this->input->post("date");
            $f = date("Y-m-d H:i:s", strtotime($date));

            $this->swimsdb->deliver($drno, $f, $order);
        }

        public function official_receipt() {
            $this->load->view("official_receipt");
        }

        public function get_ORs() {
            header("Content-type: application/json");

            echo json_encode($this->swimsdb->get_ORs());
        }

        public function receive_payment() {
            $order = $this->input->post("order");
            $date = $this->input->post("date");
            $receipt = $this->input->post("receipt");
            $f = date("Y-m-d H:i:s", strtotime($date));

            $data = array(
                "order_no" => $order,
                "date_generated" => $f,
                "official_receipt_no" => $receipt
            );

            $this->swimsdb->receive_payment($data, $order);
        }
    }
?>