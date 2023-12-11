<?php

namespace Source\Models;

use Source\Core\Connect;

class Address
{
    private $street;
    private $number;
    private $complement;
    private $city;
    private $state;
    private $zipCode;
    private $idUser;
    /**
     * @param $street mixed 
     * @param $number mixed 
     * @param $complement mixed 
     * @param $city mixed 
     * @param $state mixed 
     * @param $zipCode mixed 
     * @param $idUser mixed 
     */
    function __construct(
        ?string $street = NULL,
        ?string $number = NULL,
        ?string $complement = NULL,
        ?string $city = NULL,
        ?string $state = NULL,
        ?string $zipCode = NULL,
        ?int $idUser = NULL
    ) {
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->idUser = $idUser;
    }

    public function insertAddress(): bool
    {
        $query = "INSERT INTO addresses VALUES (NULL, :street, :number, :complement, :city, :state, :zipCode, :idUser, NULL, NULL)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":number", $this->number);
        $stmt->bindParam(":complement", $this->complement);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":zipCode", $this->zipCode);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
