<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Licence
{
    //PAaramtre ou valeurs
    protected ?int $id;
    protected ?string $title;
    protected ?string $description;
    protected ?bool $availability; 
    protected ?string $picture;
    protected ?float $price;
    protected ?int $id_user;

    public function __construct(?int $id, ?string $title, ?string $description,?bool $availability, ?string $picture, ?float $price,  ?int $id_user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
         $this->availability = $availability; 
        $this->picture = $picture;
        $this->price = $price;
        $this->id_user = $id_user;
    }

    public function addLicence(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `licence` (`id`, `title`, `description`, `availability`, `picture`,`price`, `id_user`) VALUES (?,?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id, $this->title, $this->description,  $this->availability,$this->picture,$this->price, $this->id_user]);
    }

    public function getLicenceById()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `licence`.`id`, `licence`.`title`, `licence`.`description`, `licence`.`availability`, `licence`.`picture`, `licence`.`price`, `licence`.`id_user` FROM `licence` WHERE `licence`.`id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Licence($row['id'], $row['title'], $row['description'], $row['availability'], $row['picture'], $row['price'], $row['id_user']);
        } else {
            return null;
        }
    }

    public function updateLicence()
    {
        $pdo = DataBase::getConnection();
        $sql = "UPDATE `licence` SET `title` = ?, `description` = ?,` availability` = ?, =`picture` = ?,`price`  = ? WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->title, $this->description, $this->availability, $this->picture, $this->price, $this->id]);
    }

    public function deleteLicence()
    {
        $pdo = DataBase::getConnection();
        $sql = 'DELETE FROM `licence` WHERE `id` = ?';
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(?bool $availability): static
    {
        $this->availability = $availability;
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;
        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): static
    {
        $this->id_user = $id_user;
        return $this;
    }
}
