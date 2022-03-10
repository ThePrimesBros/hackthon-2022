<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310104624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ALTER logo TYPE TEXT');
        $this->addSql('ALTER TABLE entreprise ALTER logo DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d649a4aeafea');
        $this->addSql('DROP INDEX idx_8d93d649a4aeafea');
        $this->addSql('ALTER TABLE "user" ADD entreprise VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP entreprise_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP entreprise');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649a4aeafea FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8d93d649a4aeafea ON "user" (entreprise_id)');
        $this->addSql('ALTER TABLE entreprise ALTER logo TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE entreprise ALTER logo DROP DEFAULT');
    }
}
