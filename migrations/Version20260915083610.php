<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260915083610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listen_history ADD track_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE listen_history ADD CONSTRAINT FK_76651E5D5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id)');
        $this->addSql('CREATE INDEX IDX_76651E5D5ED23C43 ON listen_history (track_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listen_history DROP FOREIGN KEY FK_76651E5D5ED23C43');
        $this->addSql('DROP INDEX IDX_76651E5D5ED23C43 ON listen_history');
        $this->addSql('ALTER TABLE listen_history DROP track_id');
    }
}
