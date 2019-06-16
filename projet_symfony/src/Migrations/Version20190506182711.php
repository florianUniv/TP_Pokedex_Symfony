<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506182711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon ADD trainer_id INT NOT NULL');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3FB08EDF6 ON pokemon (trainer_id)');
        $this->addSql('ALTER TABLE trainer ADD starter_id INT NOT NULL');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820AD5A66CC FOREIGN KEY (starter_id) REFERENCES ref_pokemon (id)');
        $this->addSql('CREATE INDEX IDX_C5150820AD5A66CC ON trainer (starter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3FB08EDF6');
        $this->addSql('DROP INDEX IDX_62DC90F3FB08EDF6 ON pokemon');
        $this->addSql('ALTER TABLE pokemon DROP trainer_id');
        $this->addSql('ALTER TABLE trainer DROP FOREIGN KEY FK_C5150820AD5A66CC');
        $this->addSql('DROP INDEX IDX_C5150820AD5A66CC ON trainer');
        $this->addSql('ALTER TABLE trainer DROP starter_id');
    }
}
