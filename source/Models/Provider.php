<?php

namespace Source\Models;

use Source\Core\Connect;

class Provider
{
    private $name;
    private $phoneNumber;
    private $linkInstagram;
    private $typeProduct;
    /**
     * @param $name mixed 
     * @param $phoneNumber mixed 
     * @param $linkInstagram mixed 
     * @param $typeProduct mixed 
     */
    function __construct(string $name = NULL, string $phoneNumber = NULL, string $linkInstagram = NULL, string $typeProduct = NULL)
    {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->linkInstagram = $linkInstagram;
        $this->typeProduct = $typeProduct;
    }

    public function insertProvider(): bool
    {
        $query = "INSERT INTO providers VALUES (NULL, :name, :phoneNumber, :linkInstagram, :typeProduct, NULL, NULL)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt->bindParam(":linkInstagram", $this->linkInstagram);
        $stmt->bindParam(":typeProduct", $this->typeProduct);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function selectAllProviders()
    {
        $query = "SELECT * FROM providers";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function updateProvider(int $id, string $name, string $phoneNumber, string $linkInstagram, string $typeProduct)
    {
        $query = "UPDATE providers SET name = :name, phoneNumber = :phoneNumber, linkInstagram = :linkInstagram, typeProduct = :typeProduct WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phoneNumber", $phoneNumber);
        $stmt->bindParam(":linkInstagram", $linkInstagram);
        $stmt->bindParam(":typeProduct", $typeProduct);
        $stmt->execute();
        $products = $stmt->fetchAll();
        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return $products;
        }
    }

    public function selectProvider(int $idProvider)
    {
        $query = "SELECT * FROM providers WHERE id = :idProvider";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idProvider", $idProvider);
        $stmt->execute();
        $provider = $stmt->fetch();
        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            $this->name = $provider->name;
            $this->phoneNumber = $provider->phoneNumber;
            $this->linkInstagram = $provider->linkInstagram;
            $this->typeProduct = $provider->typeProduct;

            return $provider;
        }
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
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber 
     * @return self
     */
    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinkInstagram()
    {
        return $this->linkInstagram;
    }

    /**
     * @param mixed $linkInstagram 
     * @return self
     */
    public function setLinkInstagram($linkInstagram): self
    {
        $this->linkInstagram = $linkInstagram;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeProduct()
    {
        return $this->typeProduct;
    }

    /**
     * @param mixed $typeProduct 
     * @return self
     */
    public function setTypeProduct($typeProduct): self
    {
        $this->typeProduct = $typeProduct;
        return $this;
    }

    public function getArray(): array
    {
        return ["product" => [
            "name" => $this->getName(),
            "phoneNumber" => $this->getPhoneNumber(),
            "linkInstagram" => $this->getLinkInstagram(),
            "typeProduct" => $this->getTypeProduct()
        ]];
    }
}
