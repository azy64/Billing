<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828192722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, invoice_id INT DEFAULT NULL, item_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2246507B2989F1FD (invoice_id), INDEX IDX_2246507B126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E2989F1FD');
        $this->addSql('DROP INDEX IDX_1F1B251E2989F1FD ON item');
        $this->addSql('ALTER TABLE item DROP invoice_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B2989F1FD');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B126F525E');
        $this->addSql('DROP TABLE basket');
        $this->addSql('ALTER TABLE item ADD invoice_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1F1B251E2989F1FD ON item (invoice_id)');
    }
}
