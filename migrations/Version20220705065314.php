<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705065314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add spaceship entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_spaceship (id INT AUTO_INCREMENT NOT NULL, manufacturer VARCHAR(255) NOT NULL, hull_number VARCHAR(18) NOT NULL, class VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE app_spaceship');
    }
}
