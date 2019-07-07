<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707172243 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon ADD terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_pokemon ADD CONSTRAINT FK_A6C8C3238A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_A6C8C3238A2D8B41 ON ref_pokemon (terrain_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon DROP FOREIGN KEY FK_A6C8C3238A2D8B41');
        $this->addSql('DROP INDEX IDX_A6C8C3238A2D8B41 ON ref_pokemon');
        $this->addSql('ALTER TABLE ref_pokemon DROP terrain_id');
    }
}
