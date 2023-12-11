<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
    private $id;
    private $email;
    private $name;
    private $phoneNumber;
    private $password;
    private $dtBorn;
    private $document;
    public $photo;
    private $adm;
    /**
     * @param $email mixed 
     * @param $name mixed 
     * @param $phoneNumber mixed 
     * @param $password mixed 
     * @param $dtBorn mixed 
     * @param $document mixed 
     */
    function __construct(
        ?string $email = NULL,
        ?string $name = NULL,
        ?string $phoneNumber = NULL,
        ?string $password = NULL,
        ?string $dtBorn = NULL,
        ?string $document = NULL,
        ?string $photo = NULL
    ) {

        $this->email = $email;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->dtBorn = $dtBorn;
        $this->document = $document;
        $this->photo = $photo;
    }

    public function insertUser(): bool
    {
        $query = "INSERT INTO users VALUES (NULL, :email, :name, :phoneNumber, :password, :dtBorn, :document, NULL, 'false', NULL, NULL, NULL)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->bindParam(":dtBorn", $this->dtBorn);
        $stmt->bindParam(":document", $this->document);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $arrayUser = [
                "id" => Connect::getInstance()->lastInsertId(),
                "name" => $this->name,
                "email" => $this->email
            ];
            $_SESSION["user"] = $arrayUser;

            return true;
        } else {
            return false;
        }
    }

    public function validateUser(string $email, string $password, bool $remember)
    {
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            if (password_verify($password, $user->password)) {
                $arrayUser = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $email,
                    "photo" => $user->photo
                ];
                $_SESSION["user"] = $arrayUser;

                if ($remember == true) {
                    setcookie("userId", $user->id, time() + 60 * 60 * 24, "/");
                    setcookie("userName", $user->name, time() + 60 * 60 * 24, "/");
                }

                $this->id = $user->id;
                $this->email = $user->email;
                $this->name = $user->name;
                $this->phoneNumber = $user->phoneNumber;
                $this->password = $user->phoneNumber;
                $this->dtBorn = $user->dtBorn;
                $this->document = $user->document;
                $this->photo = $user->photo;
                $this->adm = $user->adm;

                return 'SUCCESS';
            }
            return 'ERROR_PASSWORD';
        } else {
            return 'ERROR_EMAIL';
        }
    }

    public function validateUserSub(string $sub, bool $remember): bool
    {
        $query = "SELECT * FROM users WHERE sub LIKE :sub";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":sub", $sub);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();

            if ($remember == true) {
                setcookie("userId", $user->id, time() + 60 * 60 * 24, "/");
                setcookie("userName", $user->name, time() + 60 * 60 * 24, "/");
            }

            $this->id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            $this->phoneNumber = $user->phoneNumber;
            $this->password = $user->phoneNumber;
            $this->dtBorn = $user->dtBorn;
            $this->document = $user->document;
            $this->photo = $user->photo;
            $this->adm = $user->adm;

            return true;

        } else {
            return false;
        }
    }

    public function updateUser(int $id)
    {
        $query = "UPDATE users SET email = :email, name = :name, phoneNumber = :phoneNumber, dtBorn = :dtBorn, document = :document, photo = :photo WHERE id = :id";

        $stmt1 = Connect::getInstance()->prepare($query);
        $stmt1->bindParam(":email", $this->email);
        $stmt1->bindParam(":name", $this->name);
        $stmt1->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt1->bindParam(":dtBorn", $this->dtBorn);
        $stmt1->bindParam(":document", $this->document);
        $stmt1->bindParam(":photo", $this->photo);
        $stmt1->bindParam(":id", $id);
        $stmt1->execute();

        if ($stmt1->rowCount() == 1) {
            $arrayUser = [
                "id" => $id,
                "name" => $this->name,
                "email" => $this->email,
                "photo" => $this->photo
            ];
            $_SESSION["user"] = $arrayUser;
            return true;
        } else {
            return false;
        }
    }

    public function selectUser(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($stmt->rowCount() == 1) {

            $this->id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            $this->phoneNumber = $user->phoneNumber;
            $this->dtBorn = $user->dtBorn;
            $this->document = $user->document;
            $this->photo = $user->photo;
            $this->adm = $user->adm;

            return $user;
        } else {
            return false;
        }
    }

    public function selectAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function updatePhotoUser(string $photo, int $id)
    {
        $query = "UPDATE users SET photo = :photo WHERE id = :id";

        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdmUser(string $adm, int $id)
    {
        $query = "UPDATE users SET adm = :adm WHERE id = :id";

        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":adm", $adm);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function validateAdmUser(int $id)
    {
        $query = "SELECT adm FROM users WHERE adm LIKE 'true' AND id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION["user"]["adm"] = true;
            return true;
        } else {
            $_SESSION["user"]["adm"] = false;
            return false;
        }
    }

    public function updatePassword(string $email)
    {
        $query = "UPDATE users SET password = :password WHERE email = :email";

        $stmt = Connect::getInstance()->prepare($query);
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getDtBorn()
    {
        return $this->dtBorn;
    }

    public function setDtBorn($dtBorn): self
    {
        $this->dtBorn = $dtBorn;
        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($document)
    {
        $this->document = $document;
        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdm()
    {
        return $this->adm;
    }

    /**
     * @param mixed $adm 
     * @return self
     */
    public function setAdm($adm): self
    {
        $this->adm = $adm;
        return $this;
    }

    public function getArray(): array
    {
        return [
            "user" => [
                "id" => $this->getId(),
                "name" => $this->getName(),
                "email" => $this->getEmail(),
                "dtBorn" => $this->getDtBorn(),
                "document" => $this->getDocument(),
                "photo" => $this->getPhoto(),
                "adm" => $this->getAdm()
            ]
        ];
    }
}