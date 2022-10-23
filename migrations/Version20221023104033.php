<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023104033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery ADD user_params_id INT NOT NULL');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A337C47EB FOREIGN KEY (user_params_id) REFERENCES user_params (id)');
        $this->addSql('CREATE INDEX IDX_472B783A337C47EB ON gallery (user_params_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A337C47EB');
        $this->addSql('DROP INDEX IDX_472B783A337C47EB ON gallery');
        $this->addSql('ALTER TABLE gallery DROP user_params_id');
    }
}
