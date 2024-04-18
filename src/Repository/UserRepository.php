<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Repository;

use BasoMAlif\PerpustakaanDigitalUkk\Domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO user (id_user, Username, Password, Email, Alamat, level) VALUES(null,?,?,?,?,?)");
        $statement->execute([
            $user->username,
            $user->password,
            $user->email,
            $user->alamat,
            $user->level
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE `user` SET `Username` = ?, `Password` = ?, `Email` = ?, `Alamat` = ?, `level` = ? WHERE `user`.`id_user` = ?");
        $statement->execute([
            $user->username,
            $user->password,
            $user->email,
            $user->alamat,
            $user->level,
            $user->id
        ]);
        return $user;
    }

    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id_user, Username, Password ,Email , Alamat , level FROM user WHERE id_user = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id_user'];
                $user->username = $row['Username'];
                $user->password = $row['Password'];
                $user->email = $row['Email'];
                $user->alamat = $row['Alamat'];
                $user->level = $row['level'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT id_user, Username, Password ,Email , Alamat , level FROM user WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id_user'];
                $user->username = $row['Username'];
                $user->password = $row['Password'];
                $user->email = $row['Email'];
                $user->alamat = $row['Alamat'];
                $user->level = $row['level'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): array
    {
        $users = [];
        $statement = $this->connection->prepare("SELECT id_user, Username, Password, Email, Alamat, level FROM user");
        $statement->execute();

        try {
            while ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id_user'];
                $user->username = $row['Username'];
                $user->password = $row['Password'];
                $user->email = $row['Email'];
                $user->alamat = $row['Alamat'];
                $user->level = $row['level'];
                $users[] = $user;
            }
        } finally {
            $statement->closeCursor();
        }

        return $users;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM user WHERE id_user = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM user");
    }
}
