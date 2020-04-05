<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405102543 extends AbstractMigration
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
        $this->addSql('ALTER TABLE coupable ADD suspect_id INT DEFAULT NULL, CHANGE couvre_chef_id couvre_chef_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coupable ADD CONSTRAINT FK_D8DC06D471812EB2 FOREIGN KEY (suspect_id) REFERENCES suspect (id)');
        $this->addSql('CREATE INDEX IDX_D8DC06D471812EB2 ON coupable (suspect_id)');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE suspect DROP FOREIGN KEY FK_99EA37B335FE617D');
        $this->addSql('DROP INDEX IDX_99EA37B335FE617D ON suspect');
        $this->addSql('ALTER TABLE suspect DROP coupable_id, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE genre genre VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement CHANGE nom nom VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couleur CHANGE color_name color_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE coupable DROP FOREIGN KEY FK_D8DC06D471812EB2');
        $this->addSql('DROP INDEX IDX_D8DC06D471812EB2 ON coupable');
        $this->addSql('ALTER TABLE coupable DROP suspect_id, CHANGE couvre_chef_id couvre_chef_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE suspect ADD coupable_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE genre genre VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE suspect ADD CONSTRAINT FK_99EA37B335FE617D FOREIGN KEY (coupable_id) REFERENCES coupable (id)');
        $this->addSql('CREATE INDEX IDX_99EA37B335FE617D ON suspect (coupable_id)');
        $this->addSql('ALTER TABLE vetement CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
