<?php

namespace Source\Models;

use Source\Core\Connect;

class Sale
{
    private $id;
    private $total;
    private $idUser;
    private $created_at;

    /**
     * @param mixed $id 
     * @param mixed $total 
     * @param mixed $idUser 
     */
    public function __construct(?int $id = NULL, ?int $total = NULL, ?int $idUser = NULL)
    {
        $this->id = $id;
        $this->total = $total;
        $this->idUser = $idUser;
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
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total 
     * @return self
     */
    public function setTotal($total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser 
     * @return self
     */
    public function setIdUser($idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }

    public function getCreated()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at 
     * @return self
     */
    public function setCreated($created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function insertSale(): int
    {
        $query = "INSERT INTO sales VALUES (NULL, :total, :idUser, NULL, NULL)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();
        $idSale = Connect::getInstance()->lastInsertId();

        if ($stmt->rowCount() == 1) {
            return $idSale;
        } else {
            return false;
        }
    }

    public function selectAllSales()
    {
        $query = "SELECT * FROM sales";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function selectSale(int $id)
    {
        $query = "SELECT * FROM sales WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $sale = $stmt->fetch();
        if ($stmt->rowCount() == 0) {
            return false;
        } else {

            $this->id = $sale->id;
            $this->total = $sale->total;
            $this->idUser = $sale->idUser;
            $this->created_at = $sale->created_at;

            return $sale;
        }
    }

    public function getArray(): array
    {
        return ["user" => [
            "id" => $this->getId(),
            "total" => $this->getTotal(),
            "idUser" => $this->getIdUser(),
            "created" => $this->getCreated()
        ]];
    }
}
