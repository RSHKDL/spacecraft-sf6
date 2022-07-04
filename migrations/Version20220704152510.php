<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704152510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add color entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, code VARCHAR(128) NOT NULL, red INT NOT NULL, green INT NOT NULL, blue INT NOT NULL, UNIQUE INDEX UNIQ_B085C52477153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE app_color');
    }
}
