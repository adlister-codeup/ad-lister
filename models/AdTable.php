<?php
	require_once "image.php";

	class AdTable extends Image
	{
		public $user;

		public function loadAds($offset, $amount)
		{
			$logger = new Log("AdTable", "loadAds", "logs");
			$logger->info("Offset: {$offset} Amount: {$amount}");
			$dbc = $this->database();
			$query = "SELECT id, owner, title, description, email, phone, price, location, categories FROM ads LIMIT :limit OFFSET :offset";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":limit", $amount, PDO::PARAM_INT);
			$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $key => $value) 
			{
				$data[$key]["images"] = $this->loadImg($value["id"]);
			}
			unset($logger);
			return json_encode($data); // return the data as a json string
		}
		protected function parse($data)
		{
			$data["phone"] = preg_replace("/[^0-9]/", "", $data["phone"]);
			$a =preg_replace('/[^a-z0-9]+/', ',', strtolower($data["categories"]));
			$data["categories"] = trim($a, ',');
			return $data;
		}
		protected function format($data)
		{
			if (strlen($data["phone"]) == 7 )
			{
				$data["phone"] = substr($data["phone"], 0, 3)."-".substr($data["phone"], 3, 4);
			}
			elseif (strlen($data["phone"]) == 10)
			{
				$data["phone"] = "(".substr($data["phone"], 0, 3).")".substr($data["phone"], 3, 3)."-".substr($data["phone"], 6, 4);
			}
			elseif (strlen($data["phone"]) == 11)
			{
				$data["phone"] = substr($data["phone"], 0, 1)."+ (".substr($data["phone"], 1, 3).")".substr($data["phone"], 4, 3)."-".substr($data["phone"], 7, 4);
			}
			return $data;
		}
		public function addAd($data)
		{
			$logger = new Log("AdTable", "addAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$data = $this->parse($data);
			$dbc = $this->database();
			$query = "INSERT into ads (owner, title, description, email, phone, price, location, categories) VALUES (:owner, :title, :description, :email, :phone, :price, :location, :categories)";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":owner", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt->bindValue(":price", $data["price"], PDO::PARAM_INT);
				$stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);
				$stmt->bindValue(":categories", $data["categories"], PDO::PARAM_STR);
				$stmt->execute();
			if (isset($data["images"]))
			{	
				$adid = $dbc->lastInsertId();
				$this->saveImg($data["images"], $adid);
			}
			unset($logger);
		}
		public function deleteAd($id)
		{
			$logger = new Log("AdTable", "deleteAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$dbc = $this->database();
			$query = "DELETE from ads WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$check = $stmt->execute();
			if ($check == 1)
			{
				$this->deleteImg($id);
			}
			else
			{
				$logger->error("Nothing deleted.");
			}
			unset($logger);
		}
		public function editAd($data, $id)
		{
			$logger = new Log("AdTable", "editAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$data = $this->parse($data);
			$dbc = $this->database();
			$query = "UPDATE ads SET title=:title, description=:description, email=:email, phone=:phone, price=:price, location=:location, categories=:categories WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt->bindValue(":price", $data["price"], PDO::PARAM_INT);
				$stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);
				$stmt->bindValue(":categories", $data["categories"], PDO::PARAM_STR);
				$stmt->execute();
			$logger->info("ad updated");
			unset($logger);
		}
		public function loadAd($id)
		{
			$logger = new Log("AdTable", "loadAd", "logs");
			$dbc = $this->database();
			$query = "SELECT id, owner, title, description, email, phone, price, location, categories FROM ads WHERE id=:id";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($data)
			{
				$data = $this->format($data);
				$data["images"]= $this->loadImg($id);
			}
			else
			{
				throw new Exception('$id is an invalid Ad ID.');
			}
			unset($logger);
			return $data;
		}
		public function searchAll($offset, $amount, $search) 
		{
			$dbc = $this->database();
			$search = "%" . $search . "%";
			$query = "SELECT * FROM ads WHERE title LIKE :search LIMIT :limit OFFSET :offset";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":limit", $amount, PDO::PARAM_INT);
			$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        	$stmt->bindValue(':search', $search, PDO::PARAM_STR);
        	$stmt->execute();
        	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$instance = null;

        	if ($result)
        	{
        		foreach ($result as $key => $value) 
				{
					$result[$key]["images"] = $this->loadImg($value["id"]);
				}
        	}
        	return json_encode($result);
		}
	}
?>