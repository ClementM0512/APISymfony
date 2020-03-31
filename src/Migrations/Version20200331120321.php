<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331120321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coupable (id INT AUTO_INCREMENT NOT NULL, couvre_chef_id INT DEFAULT NULL, session_token INT NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_D8DC06D442D255A1 (couvre_chef_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupable_vetement (coupable_id INT NOT NULL, vetement_id INT NOT NULL, INDEX IDX_FFEED6E35FE617D (coupable_id), INDEX IDX_FFEED6E969D8B67 (vetement_id), PRIMARY KEY(coupable_id, vetement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coupable ADD CONSTRAINT FK_D8DC06D442D255A1 FOREIGN KEY (couvre_chef_id) REFERENCES couvre_chef (id)');
        $this->addSql('ALTER TABLE coupable_vetement ADD CONSTRAINT FK_FFEED6E35FE617D FOREIGN KEY (coupable_id) REFERENCES coupable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupable_vetement ADD CONSTRAINT FK_FFEED6E969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE couleur CHANGE color_name color_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE suspect ADD coupable_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE genre genre VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE suspect ADD CONSTRAINT FK_99EA37B335FE617D FOREIGN KEY (coupable_id) REFERENCES coupable (id)');
        $this->addSql('CREATE INDEX IDX_99EA37B335FE617D ON suspect (coupable_id)');
        $this->addSql('ALTER TABLE vetement CHANGE nom nom VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coupable_vetement DROP FOREIGN KEY FK_FFEED6E35FE617D');
        $this->addSql('ALTER TABLE suspect DROP FOREIGN KEY FK_99EA37B335FE617D');
        $this->addSql('DROP TABLE coupable');
        $this->addSql('DROP TABLE coupable_vetement');
        $this->addSql('ALTER TABLE couleur CHANGE color_name color_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE couvre_chef CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_99EA37B335FE617D ON suspect');
        $this->addSql('ALTER TABLE suspect DROP coupable_id, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE genre genre VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vetement CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
