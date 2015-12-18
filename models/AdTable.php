<?php
	require_once "../utils/Log.php";
	require_once '../database/private.php';

	class AdTable 
	{
		public $user;
		protected function database()
		{
			$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
			$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbc;
		}
		public function loadAds($offset, $amount)
		{
			$logger = new Log("AdTable", "loadAds", "logs");
			$logger->info("Offset: {$offset} Amount: {$amount}");
			$dbc = $this->database();
			$query = "SELECT id, owner, title, description, email, phone, price, location, images, categories FROM ads LIMIT :limit OFFSET :offset";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":limit", $amount, PDO::PARAM_INT);
			$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $key => $value) 
			{
				$data[$key]["images"] = explode("|", $data[$key]["images"]);
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
		public function addAd($data)
		{
			$logger = new Log("AdTable", "addAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$data = $this->parse($data);
			$dbc = $this->database();
			$query = "INSERT into ads (owner, title, description, email, phone, price, location, images, categories) VALUES (:owner, :title, :description, :email, :phone, :price, :location, :images, :categories)";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":owner", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt->bindValue(":price", $data["price"], PDO::PARAM_INT);
				$stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);
				$stmt->bindValue(":images", $data["images"], PDO::PARAM_STR);
				$stmt->bindValue(":categories", $data["categories"], PDO::PARAM_STR);
				$stmt->execute();
			unset($logger);
		}
		public function deleteAd($id)
		{
			$logger = new Log("AdTable", "deleteAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$dbc = $this->database();
			$imgQuery = "SELECT images FROM ads WHERE id = :adimgId AND user=:username";
				$imgStmt = $dbc->prepare($imgQuery);
				$imgstmt->bindValue(":username", $this->user, PDO::PARAM_STR);
				$imgstmt->bindValue(":adimgId", $id, PDO::PARAM_INT);
				$imgstmt->execute();
				$imgdata = $stmt->fetch(PDO::FETCH_ASSOC);
				$imgs = explode("|", $imgdata["images"]);
				$this->delImg($imgs);
			$query = "DELETE from ads WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$stmt->execute();
			unset($logger);
		}
		public function editAd($data, $id)
		{
			$logger = new Log("AdTable", "editAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$data = parse($data);
			$dbc = $this->database();
			$imgQuery = "SELECT images FROM ads WHERE id = :adimgId AND user=:username";
				$imgStmt = $dbc->prepare($imgQuery);
				$imgstmt->bindValue(":username", $this->user, PDO::PARAM_STR);
				$imgstmt->bindValue(":adimgId", $id, PDO::PARAM_INT);
				$imgstmt->execute();
				$imgdata = $stmt->fetch(PDO::FETCH_ASSOC);
				$imgs = explode("|", $imgdata["images"]);
				foreach ($imgs as $key => $value)
				{
					$nonKey = array_search($value ,$imgdata["images"]);
					if ($nonKey)
					{
						$this->delImg($imgdata["images"][$nonKey]);
					}
				}
			$query = "UPDATE ads SET title=:title, description=:description, email=:email, phone=:phone, price=:price, location=:location, images=:images, categories=:categories WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt->bindValue(":price", $data["price"], PDO::PARAM_INT);
				$stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);
				$stmt->bindValue(":images", $data["images"], PDO::PARAM_STR);
				$stmt->bindValue(":categories", $data["categories"], PDO::PARAM_STR);
				$stmt->execute();
			unset($logger);
		}
		public function loadAd($id)
		{
			$logger = new Log("AdTable", "loadAd", "logs");
			$dbc = $this->database();
			$query = "SELECT id, owner, title, description, email, phone, price, location, images, categories FROM ads WHERE id=:id";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$data["images"] = explode("|", $data["images"]);
			unset($logger);
			return $data;
		}
		public function delImg($imgs, $id)
		{
			$logger = new Log("AdTable", "delimg", "logs");
			$dbc = $this->database();
			$query = "SELECT images FROM ads WHERE owner=:owner AND id = :adId";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":owner", $this->user, PDO::PARAM_STR);
			$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$data["images"] = explode("|", $data["images"]);
			foreach ($imgs as $imgkey => $imgvalue)
			{
				foreach ($data["images"] as $key => $value)
				{
					if ($imgvalue == $value)
					{
						unlink($imgvalue);
						unset($data["images"][$key]);
						$logger->info("image $value deleted");
					}
				}
			}
			$images = implode("|", $data["images"]);
			$changeQuery = "UPDATE ads SET images=:images owner=:owner AND id = :adId";
			$changeStmt = $dbc->prepare($changeQuery);
			$changeStmt->bindValue(":images", $images, PDO::PARAM_INT);
			$changeStmt->bindValue(":owner", $this->user, PDO::PARAM_STR);
			$changeStmt->bindValue(":adId", $id, PDO::PARAM_INT);
			$changeStmt->execute();
			unset($logger);
		}
	}
?>