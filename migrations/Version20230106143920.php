<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230106143920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Blueprint: add spaceship blueprint, role and class';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_blueprint (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, INDEX IDX_8E2ABD53A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_spaceship_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, alias VARCHAR(64) DEFAULT NULL, variant VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_spaceship_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53A23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE app_blueprint');
        $this->addSql('DROP TABLE app_spaceship_class');
        $this->addSql('DROP TABLE app_spaceship_role');
    }
}
