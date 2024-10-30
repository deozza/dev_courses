<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527223540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_update_date DATETIME NOT NULL, wallet INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$hnp.m9rUf0RGS0rG5pG66Oh.LQVXMLm7WZzBsyX9f71uZR8./qk9a');
        $admin->setUsername('admin');
        $admin->setWallet(1000);
        $admin->setCreationDate(new \DateTimeImmutable());
        $admin->setLastUpdateDate(new \DateTimeImmutable());


        $this->addSql('INSERT INTO user (id, email, roles, password, username, wallet, creation_date, last_update_date) VALUES (:id, :email, :roles, :password, :username, :wallet, :creation_date, :last_update_date)', [
            'id' => $admin->getId(),
            'email' => $admin->getEmail(),
            'roles' => json_encode($admin->getRoles()),
            'password' => $admin->getPassword(),
            'username' => $admin->getUsername(),
            'wallet' => $admin->getWallet(),
            'creation_date' => $admin->getCreationDate()->format('Y-m-d H:i:s'),
            'last_update_date' => $admin->getLastUpdateDate()->format('Y-m-d H:i:s')
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
