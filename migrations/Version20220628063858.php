<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628063858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change relation between Product and ProductOption';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product_has_option (product_id INT NOT NULL, product_option_id INT NOT NULL, INDEX IDX_3367E4AA4584665A (product_id), INDEX IDX_3367E4AAA9BC5ADA (product_option_id), PRIMARY KEY(product_id, product_option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_has_option ADD CONSTRAINT FK_3367E4AA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_has_option ADD CONSTRAINT FK_3367E4AAA9BC5ADA FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_option DROP FOREIGN KEY FK_1ECE1374584665A');
        $this->addSql('DROP INDEX IDX_1ECE1374584665A ON product_option');
        $this->addSql('ALTER TABLE product_option DROP product_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product_has_option');
        $this->addSql('ALTER TABLE product_option ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_option ADD CONSTRAINT FK_1ECE1374584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1ECE1374584665A ON product_option (product_id)');
    }
}
