<?php

namespace Source\Models;

use Source\Core\Connect;

class Product
{
	private $image;
	private $name;
	private $price;
	private $description;
	private $available;
	/**
	 * @param $image mixed 
	 * @param $name mixed 
	 * @param $price mixed 
	 * @param $description mixed 
	 * @param $available mixed 
	 */
	function __construct(
		?string $image = NULL,
		?string $name = NULL,
		?string $price = NULL,
		?string $description = NULL,
		?string $available = NULL
	) {
		$this->image = $image;
		$this->name = $name;
		$this->price = $price;
		$this->description = $description;
		$this->available = $available;
	}

	public function insertProduct(): bool
	{
		$query = "INSERT INTO products VALUES (NULL, :image, :name, :price, :description, :available, NULL, NULL)";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":available", $this->available);
		$stmt->execute();

		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function selectAllProducts()
	{
		$query = "SELECT * FROM products";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectProduct(int $idProduct)
	{
		$query = "SELECT * FROM products WHERE id = :idProduct";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->bindParam(":idProduct", $idProduct);
		$stmt->execute();
		$product = $stmt->fetch();
		if ($stmt->rowCount() == 0) {
			return false;
		} else {

			$this->image = $product->image;
			$this->name = $product->name;
			$this->price = $product->price;
			$this->description = $product->description;
			$this->available = $product->available;

			return $product;
		}
	}

	public function updateProduct(int $id)
	{
		$query = "UPDATE products SET image = :image, name = :name, price = :price, description = :description, available = :available WHERE id = :id";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":available", $this->available);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$products = $stmt->fetchAll();
		if ($stmt->rowCount() == 0) {
			return false;
		} else {
			return $products;
		}
	}

	/**
	 * @return mixed
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param mixed $image 
	 * @return self
	 */
	public function setImage($image): self
	{
		$this->image = $image;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name 
	 * @return self
	 */
	public function setName($name): self
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param mixed $price 
	 * @return self
	 */
	public function setPrice($price): self
	{
		$this->price = $price;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description 
	 * @return self
	 */
	public function setDescription($description): self
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAvailable()
	{
		return $this->available;
	}

	/**
	 * @param mixed $available 
	 * @return self
	 */
	public function setAvailable($available): self
	{
		$this->available = $available;
		return $this;
	}

	public function getArray(): array
	{
		return ["product" => [
			"image" => $this->getImage(),
			"name" => $this->getName(),
			"price" => $this->getPrice(),
			"description" => $this->getDescription(),
			"available" => $this->getAvailable()
		]];
	}
}
