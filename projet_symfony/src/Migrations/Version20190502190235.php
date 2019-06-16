<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502190235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon ADD type_2_id INT NOT NULL');
        $this->addSql('ALTER TABLE ref_pokemon ADD CONSTRAINT FK_A6C8C3233569361C FOREIGN KEY (type_2_id) REFERENCES elementary_type (id)');
        $this->addSql('CREATE INDEX IDX_A6C8C3233569361C ON ref_pokemon (type_2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon DROP FOREIGN KEY FK_A6C8C3233569361C');
        $this->addSql('DROP INDEX IDX_A6C8C3233569361C ON ref_pokemon');
        $this->addSql('ALTER TABLE ref_pokemon DROP type_2_id');
    }
}
