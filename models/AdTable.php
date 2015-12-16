<?php
	require_once "../../utils/Log.php";
	require_once '../../database/private.php';

	class AdTable 
	{
		protected $user;
		protected function database()
		{
			$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
			$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbc;
		}
		public function setUser($username)
		{
			$this->users = $username;
		}
		public function loadAds($offset, $amount)
		{
			$logger = new Log("AdTable", "loadAds", "logs");
			$logger->info("user is set to: {$this->user}");
			$dbc = $this->database();
			$query = "SELECT id, owner, title, description, email, phone, price, location, images, categories FROM ads LIMIT :limit OFFSET :offset";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":limit", $amount, PDO::PARAM_INT);
			$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			unset($logger);
			return json_encode($data); // return the data as a json string
		}
		public function addAd($json)
		{
			$logger = new Log("AdTable", "addAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$dbc = $this->database();
			$data = json_decode($json);
			$query = "INSERT into ads (owner, title, description, email, phone, price, location, images, categories) VALUES (:owner, :title, :description, :email, :phone, :price, :location, :images, :categories)";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":owner", $data["owner"], PDO::PARAM_STR);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_INT);
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
			$query = "DELETE from ads WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$stmt->execute();
			unset($logger);
		}
		public function editAd($json)
		{
			$logger = new Log("AdTable", "editAd", "logs");
			$logger->info("owner is set to: {$this->user}");
			$dbc = $this->database();
			$data = json_decode($json);
			$query = "UPDATE ads SET title=:title, description=:description, email=:email, phone=:phone, price=:price, location=:location, images=:images, categories=:categories WHERE id = :adId AND owner=:user";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":user", $this->user, PDO::PARAM_STR);
				$stmt->bindValue(":adId", $id, PDO::PARAM_INT);
				$stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
				$stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
				$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
				$stmt->bindValue(":phone", $data["phone"], PDO::PARAM_INT);
				$stmt->bindValue(":price", $data["price"], PDO::PARAM_INT);
				$stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);
				$stmt->bindValue(":images", $data["images"], PDO::PARAM_STR);
				$stmt->bindValue(":categories", $data["categories"], PDO::PARAM_STR);
				$stmt->execute();
			unset($logger);
		}

	}
?>