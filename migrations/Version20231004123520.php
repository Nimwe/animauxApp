<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004123520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, especes_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, nom_latin VARCHAR(255) NOT NULL, INDEX IDX_6AAB231F578C3C19 (especes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE continent (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE continent_animal (continent_id INT NOT NULL, animal_id INT NOT NULL, INDEX IDX_E557C2C8921F4C77 (continent_id), INDEX IDX_E557C2C88E962C16 (animal_id), PRIMARY KEY(continent_id, animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F578C3C19 FOREIGN KEY (especes_id) REFERENCES especes (id)');
        $this->addSql('ALTER TABLE continent_animal ADD CONSTRAINT FK_E557C2C8921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE continent_animal ADD CONSTRAINT FK_E557C2C88E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F578C3C19');
        $this->addSql('ALTER TABLE continent_animal DROP FOREIGN KEY FK_E557C2C8921F4C77');
        $this->addSql('ALTER TABLE continent_animal DROP FOREIGN KEY FK_E557C2C88E962C16');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE continent_animal');
    }
}
