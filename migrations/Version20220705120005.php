<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705120005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add paintJob entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_paint_job (id INT AUTO_INCREMENT NOT NULL, spaceship_id INT DEFAULT NULL, color_id INT NOT NULL, region VARCHAR(255) NOT NULL, INDEX IDX_15F12F664AD9556B (spaceship_id), INDEX IDX_15F12F667ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_paint_job ADD CONSTRAINT FK_15F12F664AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id)');
        $this->addSql('ALTER TABLE app_paint_job ADD CONSTRAINT FK_15F12F667ADA1FB5 FOREIGN KEY (color_id) REFERENCES app_color (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE app_paint_job');
    }
}
