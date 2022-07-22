<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722153857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Order and OrderItem entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_order (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_order_item (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, spaceship_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4F1B4758D9F6D38 (order_id), UNIQUE INDEX UNIQ_4F1B4754AD9556B (spaceship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_order_item ADD CONSTRAINT FK_4F1B4758D9F6D38 FOREIGN KEY (order_id) REFERENCES app_order (id)');
        $this->addSql('ALTER TABLE app_order_item ADD CONSTRAINT FK_4F1B4754AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_order_item DROP FOREIGN KEY FK_4F1B4758D9F6D38');
        $this->addSql('DROP TABLE app_order');
        $this->addSql('DROP TABLE app_order_item');
    }
}
