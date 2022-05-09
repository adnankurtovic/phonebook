<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509225727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_contact (contact_source INT NOT NULL, contact_target INT NOT NULL, INDEX IDX_D64DC7B9CF1848F2 (contact_source), INDEX IDX_D64DC7B9D6FD187D (contact_target), PRIMARY KEY(contact_source, contact_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_contact ADD CONSTRAINT FK_D64DC7B9CF1848F2 FOREIGN KEY (contact_source) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_contact ADD CONSTRAINT FK_D64DC7B9D6FD187D FOREIGN KEY (contact_target) REFERENCES contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact_contact');
    }
}
