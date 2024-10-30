<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527230203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE turn (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, deck CLOB NOT NULL --(DC2Type:json)
        , creation_date DATETIME NOT NULL, last_update_date DATETIME NOT NULL, player_hand CLOB NOT NULL --(DC2Type:array)
        , dealer_hand CLOB NOT NULL --(DC2Type:array)
        , wager INTEGER DEFAULT NULL, CONSTRAINT FK_20201547E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_20201547E48FD905 ON turn (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE turn');
    }
}
