<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427193158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A105F20E7');
        $this->addSql('DROP INDEX IDX_65E8AA0A105F20E7 ON rendez_vous');
        $this->addSql('ALTER TABLE rendez_vous ADD etat VARCHAR(255) NOT NULL, DROP adminrendezvous_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous ADD adminrendezvous_id INT NOT NULL, DROP etat');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A105F20E7 FOREIGN KEY (adminrendezvous_id) REFERENCES `admin` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_65E8AA0A105F20E7 ON rendez_vous (adminrendezvous_id)');
    }
}
