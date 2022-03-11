<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310105746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP entreprise');
        $this->addSql('ALTER TABLE "user" ALTER adresse SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER city SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER cp SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER logo SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649A4AEAFEA ON "user" (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649A4AEAFEA');
        $this->addSql('DROP INDEX IDX_8D93D649A4AEAFEA');
        $this->addSql('ALTER TABLE "user" ADD entreprise VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP entreprise_id');
        $this->addSql('ALTER TABLE "user" ALTER adresse DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER city DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER cp DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER logo DROP NOT NULL');
    }
}
