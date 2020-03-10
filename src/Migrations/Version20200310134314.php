<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310134314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couleur CHANGE color_name color_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE suspect ADD genre VARCHAR(1) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD id_color_id INT NOT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF2A01F320 FOREIGN KEY (id_color_id) REFERENCES couleur (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CF2A01F320 ON vetement (id_color_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couleur CHANGE color_name color_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE suspect DROP genre, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF2A01F320');
        $this->addSql('DROP INDEX IDX_3CB446CF2A01F320 ON vetement');
        $this->addSql('ALTER TABLE vetement DROP id_color_id, CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
