<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311143125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE demande ADD sujet VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE raport ALTER price TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE raport ALTER price DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE demande DROP type');
        $this->addSql('ALTER TABLE demande DROP sujet');
        $this->addSql('ALTER TABLE raport ALTER price TYPE INT');
        $this->addSql('ALTER TABLE raport ALTER price DROP DEFAULT');
    }
}
