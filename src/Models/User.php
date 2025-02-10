<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class User
{
    protected ?int $id;
    protected ?string $surname;
    protected ?string $name;
    protected ?string $birth_date;
    protected ?string $password;
    protected int|string|null $id_role;
    protected ?string $email;

    public function __construct(?int $id, ?string $surname, ?string $name, ?string $birth_date, ?string $password, int|string|null $id_role, ?string $email)
    {
        $this->id = $id;
        $this->surname = $surname;
        $this->name = $name;
        $this->birth_date = $birth_date;
        $this->password = $password;
        $this->id_role = $id_role;
        $this->email = $email;
    }

    public function save(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO user (surname, name, birth_date, password, id_role, email) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);

        return $statement->execute([
            $this->surname,
            $this->name,
            $this->birth_date,
            $this->password,
            $this->id_role,
            $this->email
        ]);
    }
    public static function findAll(): array
{
    $pdo = DataBase::getConnection(); // Connexion à la base de données
    $sql = "SELECT * FROM user"; // Requête pour récupérer tous les utilisateurs
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats

    // Créer un tableau d'objets User à partir des résultats
    $users = [];
    foreach ($rows as $row) {
        $users[] = new User(
            $row['id'],  
            $row['surname'], 
            $row['name'],
            $row['birth_date'], 
            $row['password'], 
            $row['id_role'], 
            $row['email']
        );
    }
    return $users; // Retourne le tableau des utilisateurs
}


    public static function findByEmail(string $email): ?User
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['id'],  
                $row['surname'], 
                $row['name'],
                $row['birth_date'], 
                $row['password'], 
                $row['id_role'], 
                $row['email']
            );
        }
        return null;
    }
    public static function getClients(): array
{
    $pdo = DataBase::getConnection();
    $sql = "SELECT * FROM user WHERE id_role = 3"; // Supposons que les clients ont un rôle ID de 3
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    $clients = [];
    foreach ($rows as $row) {
        $clients[] = new User(
            $row['id'],  
            $row['surname'], 
            $row['name'],
            $row['birth_date'], 
            $row['password'], 
            $row['id_role'], 
            $row['email']
        );
    }
    return $clients;
}


    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }
    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): void { $this->name = $name; }
    public function getSurname(): ?string { return $this->surname; }
    public function setSurname(?string $surname): void { $this->surname = $surname; }
    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): void { $this->password = $password; }
    public function getBirthDate(): ?string { return $this->birth_date; }
    public function setBirthDate(?string $birth_date): void { $this->birth_date = $birth_date; }
    public function getId_Role(): int|string|null { return $this->id_role; }
    public function setId_Role(int|string|null $id_role): void { $this->id_role = $id_role; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): void { $this->email = $email; }
} 