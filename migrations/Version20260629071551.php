<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260629071551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE internship ADD date DATE NOT NULL, ADD resume LONGTEXT NOT NULL, ADD annee VARCHAR(10) NOT NULL, ADD entreprise_id INT NOT NULL, ADD formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE internship ADD CONSTRAINT FK_10D1B00CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE internship ADD CONSTRAINT FK_10D1B00C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_10D1B00CA4AEAFEA ON internship (entreprise_id)');
        $this->addSql('CREATE INDEX IDX_10D1B00C5200282E ON internship (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE formation');
        $this->addSql('ALTER TABLE internship DROP FOREIGN KEY FK_10D1B00CA4AEAFEA');
        $this->addSql('ALTER TABLE internship DROP FOREIGN KEY FK_10D1B00C5200282E');
        $this->addSql('DROP INDEX IDX_10D1B00CA4AEAFEA ON internship');
        $this->addSql('DROP INDEX IDX_10D1B00C5200282E ON internship');
        $this->addSql('ALTER TABLE internship DROP date, DROP resume, DROP annee, DROP entreprise_id, DROP formation_id');
    }
}
