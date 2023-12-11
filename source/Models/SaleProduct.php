<?php

namespace Source\Models;

use Source\Core\Connect;

class SaleProduct
{
	private $id;
	private $idSale;
	private $idProduct;
	private $price;
	private $created_at;

	/**
	 * @param mixed $id 
	 * @param mixed $idSale 
	 * @param mixed $idProduct 
	 * @param mixed $price 
	 * @param mixed $created_at 
	 */
	public function __construct(?int $id = NULL, ?int $idSale = NULL, ?int $idProduct = NULL, ?int $price = NULL, ?string $created_at = NULL)
	{
		$this->id = $id;
		$this->idSale = $idSale;
		$this->idProduct = $idProduct;
		$this->price = $price;
		$this->created_at = $created_at;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdSale()
	{
		return $this->idSale;
	}

	/**
	 * @param mixed $idSale 
	 * @return self
	 */
	public function setIdSale($idSale): self
	{
		$this->idSale = $idSale;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdProduct()
	{
		return $this->idProduct;
	}

	/**
	 * @param mixed $idProduct 
	 * @return self
	 */
	public function setIdProduct($idProduct): self
	{
		$this->idProduct = $idProduct;
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
	public function getCreated_at()
	{
		return $this->created_at;
	}

	/**
	 * @param mixed $created_at 
	 * @return self
	 */
	public function setCreated_at($created_at): self
	{
		$this->created_at = $created_at;
		return $this;
	}
	public function getArray(): array
	{
		return ["user" => [
			"id" => $this->getId(),
			"idSale" => $this->getIdSale(),
			"idProduct" => $this->getIdProduct(),
			"price" => $this->getPrice(),
			"created_at" => $this->getCreated_at()
		]];
	}

	public function insertSaleProduct(): bool
	{
		$query = "INSERT INTO sales_products VALUES (NULL, :idSale, :idProduct, :price, NULL, NULL)";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->bindParam(":idSale", $this->idSale);
		$stmt->bindParam(":idProduct", $this->idProduct);
		$stmt->bindParam(":price", $this->price);
		$stmt->execute();

		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function selectAllSalesProducts()
	{
		$query = "SELECT * FROM sales_products";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return $stmt->rowCount();
		} else {
			return false;
		}
	}

	public function selectSaleProduct(int $id)
	{
		$query = "SELECT * FROM sales_products WHERE id = :id";
		$stmt = Connect::getInstance()->prepare($query);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$sale_product = $stmt->fetch();
		if ($stmt->rowCount() == 0) {
			return false;
		} else {

			$this->id = $sale_product->id;
			$this->idSale = $sale_product->idSale;
			$this->idProduct = $sale_product->idProduct;
			$this->price = $sale_product->price;
			$this->created_at = $sale_product->created_at;

			return $sale_product;
		}
	}
}
