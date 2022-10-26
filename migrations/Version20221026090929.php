<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026090929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cleanup database';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_has_option DROP FOREIGN KEY FK_3367E4AA4584665A');
        $this->addSql('ALTER TABLE product_has_option DROP FOREIGN KEY FK_3367E4AAA9BC5ADA');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_has_option');
        $this->addSql('DROP TABLE product_option');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, sku VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(510) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_has_option (product_id INT NOT NULL, product_option_id INT NOT NULL, INDEX IDX_3367E4AA4584665A (product_id), INDEX IDX_3367E4AAA9BC5ADA (product_option_id), PRIMARY KEY(product_id, product_option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, value VARCHAR(510) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, context JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_has_option ADD CONSTRAINT FK_3367E4AA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_has_option ADD CONSTRAINT FK_3367E4AAA9BC5ADA FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
