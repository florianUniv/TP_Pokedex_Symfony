<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502185658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon ADD type_1_id INT NOT NULL');
        $this->addSql('ALTER TABLE ref_pokemon ADD CONSTRAINT FK_A6C8C32327DC99F2 FOREIGN KEY (type_1_id) REFERENCES elementary_type (id)');
        $this->addSql('CREATE INDEX IDX_A6C8C32327DC99F2 ON ref_pokemon (type_1_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_pokemon DROP FOREIGN KEY FK_A6C8C32327DC99F2');
        $this->addSql('DROP INDEX IDX_A6C8C32327DC99F2 ON ref_pokemon');
        $this->addSql('ALTER TABLE ref_pokemon DROP type_1_id');
    }
}
