<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427111834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, ncin INT DEFAULT NULL, numerotelephone INT DEFAULT NULL, age INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE docteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, ncin INT DEFAULT NULL, numerotelephone INT DEFAULT NULL, age INT DEFAULT NULL, motdepasse VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ncin INT DEFAULT NULL, numerotelephone INT DEFAULT NULL, age INT DEFAULT NULL, motdepasse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, temps DATE NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE docteur');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE rendez_vous');
    }
}
