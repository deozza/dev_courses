<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528133031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__game AS SELECT id, user_id, status, date_creation, last_update_date FROM game');
        $this->addSql('DROP TABLE game');
        $this->addSql('CREATE TABLE game (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, last_update_date DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_232B318CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO game (id, user_id, status, date_creation, last_update_date) SELECT id, user_id, status, date_creation, last_update_date FROM __temp__game');
        $this->addSql('DROP TABLE __temp__game');
        $this->addSql('CREATE INDEX IDX_232B318CA76ED395 ON game (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__turn AS SELECT id, game_id, status, deck, creation_date, last_update_date, player_hand, dealer_hand, wager FROM turn');
        $this->addSql('DROP TABLE turn');
        $this->addSql('CREATE TABLE turn (id VARCHAR(255) NOT NULL, game_id VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, deck CLOB NOT NULL --(DC2Type:object)
        , creation_date DATETIME NOT NULL, last_update_date DATETIME NOT NULL, player_hand CLOB NOT NULL --(DC2Type:object)
        , dealer_hand CLOB NOT NULL --(DC2Type:object)
        , wager INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_20201547E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO turn (id, game_id, status, deck, creation_date, last_update_date, player_hand, dealer_hand, wager) SELECT id, game_id, status, deck, creation_date, last_update_date, player_hand, dealer_hand, wager FROM __temp__turn');
        $this->addSql('DROP TABLE __temp__turn');
        $this->addSql('CREATE INDEX IDX_20201547E48FD905 ON turn (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__game AS SELECT id, user_id, status, date_creation, last_update_date FROM game');
        $this->addSql('DROP TABLE game');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, last_update_date DATETIME NOT NULL, CONSTRAINT FK_232B318CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO game (id, user_id, status, date_creation, last_update_date) SELECT id, user_id, status, date_creation, last_update_date FROM __temp__game');
        $this->addSql('DROP TABLE __temp__game');
        $this->addSql('CREATE INDEX IDX_232B318CA76ED395 ON game (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__turn AS SELECT id, game_id, status, deck, creation_date, last_update_date, wager, player_hand, dealer_hand FROM turn');
        $this->addSql('DROP TABLE turn');
        $this->addSql('CREATE TABLE turn (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, deck CLOB NOT NULL --(DC2Type:json)
        , creation_date DATETIME NOT NULL, last_update_date DATETIME NOT NULL, wager INTEGER DEFAULT NULL, player_hand CLOB NOT NULL --(DC2Type:array)
        , dealer_hand CLOB NOT NULL --(DC2Type:array)
        , CONSTRAINT FK_20201547E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO turn (id, game_id, status, deck, creation_date, last_update_date, wager, player_hand, dealer_hand) SELECT id, game_id, status, deck, creation_date, last_update_date, wager, player_hand, dealer_hand FROM __temp__turn');
        $this->addSql('DROP TABLE __temp__turn');
        $this->addSql('CREATE INDEX IDX_20201547E48FD905 ON turn (game_id)');
    }
}
