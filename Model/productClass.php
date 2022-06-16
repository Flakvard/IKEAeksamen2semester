<?php
	
	class eventClass
	{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}	

	
        // select record     
		public function selectRecord($id)
		{
			try
			{
                $this->open_db();
                if($id>0)
				{	
					$query=$this->condb->prepare("SELECT * FROM product.ProductID WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM ikea_hacks_db.vw_product_info_with_photo");	}	
				
				$query->execute();
				$res=$query->get_result();	//Sets query in a variable
				$query->close();		//closes query
				$this->close_db();      //closes datebase
                return $res;	//Returns list of products from the query variable 
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}


	}

?>