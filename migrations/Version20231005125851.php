<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005125851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE possede (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, personne_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_3D0B15088E962C16 (animal_id), INDEX IDX_3D0B1508A21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B15088E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B1508A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE animal CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE especes CHANGE description description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B15088E962C16');
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B1508A21BD112');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE possede');
        $this->addSql('ALTER TABLE animal CHANGE description description VARCHAR(600) NOT NULL');
        $this->addSql('ALTER TABLE especes CHANGE description description VARCHAR(600) NOT NULL');
    }
}
