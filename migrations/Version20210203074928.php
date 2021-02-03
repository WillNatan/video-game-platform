<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203074928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_key DROP FOREIGN KEY FK_91CAB86CE48FD905');
        $this->addSql('DROP INDEX IDX_91CAB86CE48FD905 ON game_key');
        $this->addSql('ALTER TABLE game_key CHANGE game_id video_game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game_key ADD CONSTRAINT FK_91CAB86C16230A8 FOREIGN KEY (video_game_id) REFERENCES video_game (id)');
        $this->addSql('CREATE INDEX IDX_91CAB86C16230A8 ON game_key (video_game_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_key DROP FOREIGN KEY FK_91CAB86C16230A8');
        $this->addSql('DROP INDEX IDX_91CAB86C16230A8 ON game_key');
        $this->addSql('ALTER TABLE game_key CHANGE video_game_id game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game_key ADD CONSTRAINT FK_91CAB86CE48FD905 FOREIGN KEY (game_id) REFERENCES video_game (id)');
        $this->addSql('CREATE INDEX IDX_91CAB86CE48FD905 ON game_key (game_id)');
    }
}
