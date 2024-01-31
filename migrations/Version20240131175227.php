<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240131175227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add ManufacturerStatistics entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_manufacturer_statistics (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT NOT NULL, customer_satisfaction VARCHAR(60) NOT NULL, ongoing_orders INT NOT NULL, average_lead_time INT NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2530D0CBA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_manufacturer_statistics ADD CONSTRAINT FK_2530D0CBA23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_manufacturer_statistics DROP FOREIGN KEY FK_2530D0CBA23B42D');
        $this->addSql('DROP TABLE app_manufacturer_statistics');
    }
}
