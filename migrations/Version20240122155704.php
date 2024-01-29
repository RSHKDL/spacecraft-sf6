<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240122155704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '[order] add orderStatus to order';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_order_status (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B88F75C98D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_order_status ADD CONSTRAINT FK_B88F75C98D9F6D38 FOREIGN KEY (order_id) REFERENCES app_order (id)');
        $this->addSql('ALTER TABLE app_order DROP status');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_order_status DROP FOREIGN KEY FK_B88F75C98D9F6D38');
        $this->addSql('DROP TABLE app_order_status');
        $this->addSql('ALTER TABLE app_order ADD status VARCHAR(255) NOT NULL');
    }
}
