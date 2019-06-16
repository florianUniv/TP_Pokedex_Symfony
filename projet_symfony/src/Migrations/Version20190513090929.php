<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513090929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, ref_pokemon_id INT NOT NULL, dresseur_id INT NOT NULL, sexe VARCHAR(1) NOT NULL, xp INT NOT NULL, niveau INT NOT NULL, a_vendre TINYINT(1) NOT NULL, prix INT NOT NULL, date_dernier_entrainement DATETIME NOT NULL, INDEX IDX_62DC90F32922F320 (ref_pokemon_id), INDEX IDX_62DC90F3A1A01CBE (dresseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F32922F320 FOREIGN KEY (ref_pokemon_id) REFERENCES ref_pokemon (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3A1A01CBE FOREIGN KEY (dresseur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pokemon');
    }
}
