<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240425124046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Refacto spaceship, military and civilian';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_order_item DROP FOREIGN KEY FK_4F1B4754AD9556B');
        $this->addSql('ALTER TABLE app_spaceships_options DROP FOREIGN KEY FK_70854DBE4AD9556B');
        $this->addSql('ALTER TABLE app_paint_job DROP FOREIGN KEY FK_15F12F664AD9556B');
        $this->addSql('CREATE TABLE app_base_spaceship (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, hull_number VARCHAR(18) NOT NULL, spaceship_type VARCHAR(255) NOT NULL, INDEX IDX_C6A68FFDA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_civilian_spaceship (id INT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_military_classification (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, alias VARCHAR(64) DEFAULT NULL, variant VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_military_spaceship (id INT NOT NULL, classification_id INT NOT NULL, INDEX IDX_C2C8D5E32A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_spaceship_section (id INT AUTO_INCREMENT NOT NULL, spaceship_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_C0CCAB954AD9556B (spaceship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_base_spaceship ADD CONSTRAINT FK_C6A68FFDA23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id)');
        $this->addSql('ALTER TABLE app_civilian_spaceship ADD CONSTRAINT FK_3AD25CABBF396750 FOREIGN KEY (id) REFERENCES app_base_spaceship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_military_spaceship ADD CONSTRAINT FK_C2C8D5E32A86559F FOREIGN KEY (classification_id) REFERENCES app_military_classification (id)');
        $this->addSql('ALTER TABLE app_military_spaceship ADD CONSTRAINT FK_C2C8D5E3BF396750 FOREIGN KEY (id) REFERENCES app_base_spaceship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_spaceship_section ADD CONSTRAINT FK_C0CCAB954AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_base_spaceship (id)');
        $this->addSql('DROP TABLE app_spaceship');
        $this->addSql('ALTER TABLE app_spaceships_options ADD CONSTRAINT FK_70854DBE4AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_base_spaceship (id)');
        $this->addSql('ALTER TABLE app_order_item ADD CONSTRAINT FK_4F1B4754AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_base_spaceship (id)');
        $this->addSql('ALTER TABLE app_order_status RENAME INDEX idx_b88f75c98d9f6d38 TO IDX_7A016F488D9F6D38');
        $this->addSql('ALTER TABLE app_paint_job ADD CONSTRAINT FK_15F12F664AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_base_spaceship (id)');
        $this->addSql('ALTER TABLE app_user RENAME INDEX uniq_8d93d649e7927c74 TO UNIQ_88BDF3E9E7927C74');
    }

    public function down(Schema $schema): void
    {
//        $this->addSql('ALTER TABLE app_spaceships_options DROP FOREIGN KEY FK_70854DBE4AD9556B');
//        $this->addSql('ALTER TABLE app_order_item DROP FOREIGN KEY FK_4F1B4754AD9556B');
//        $this->addSql('ALTER TABLE app_paint_job DROP FOREIGN KEY FK_15F12F664AD9556B');
//        $this->addSql('CREATE TABLE app_spaceship_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, alias VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, variant VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
//        $this->addSql('CREATE TABLE app_spaceship (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, hull_number VARCHAR(18) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_21FD3BBA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
//        $this->addSql('CREATE TABLE app_blueprint (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, role_id INT DEFAULT NULL, class_id INT DEFAULT NULL, INDEX IDX_8E2ABD53A23B42D (manufacturer_id), INDEX IDX_8E2ABD53D60322AC (role_id), INDEX IDX_8E2ABD53EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
//        $this->addSql('ALTER TABLE app_spaceship ADD CONSTRAINT FK_21FD3BBA23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53A23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53D60322AC FOREIGN KEY (role_id) REFERENCES app_spaceship_role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53EA000B10 FOREIGN KEY (class_id) REFERENCES app_spaceship_class (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_base_spaceship DROP FOREIGN KEY FK_C6A68FFDA23B42D');
//        $this->addSql('ALTER TABLE app_civilian_spaceship DROP FOREIGN KEY FK_3AD25CABBF396750');
//        $this->addSql('ALTER TABLE app_military_spaceship DROP FOREIGN KEY FK_C2C8D5E32A86559F');
//        $this->addSql('ALTER TABLE app_military_spaceship DROP FOREIGN KEY FK_C2C8D5E3BF396750');
//        $this->addSql('ALTER TABLE app_spaceship_section DROP FOREIGN KEY FK_C0CCAB954AD9556B');
//        $this->addSql('DROP TABLE app_base_spaceship');
//        $this->addSql('DROP TABLE app_civilian_spaceship');
//        $this->addSql('DROP TABLE app_military_classification');
//        $this->addSql('DROP TABLE app_military_spaceship');
//        $this->addSql('DROP TABLE app_spaceship_section');
//        $this->addSql('ALTER TABLE app_order_item DROP FOREIGN KEY FK_4F1B4754AD9556B');
//        $this->addSql('ALTER TABLE app_order_item ADD CONSTRAINT FK_4F1B4754AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_user RENAME INDEX uniq_88bdf3e9e7927c74 TO UNIQ_8D93D649E7927C74');
//        $this->addSql('ALTER TABLE app_spaceships_options DROP FOREIGN KEY FK_70854DBE4AD9556B');
//        $this->addSql('ALTER TABLE app_spaceships_options ADD CONSTRAINT FK_70854DBE4AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_paint_job DROP FOREIGN KEY FK_15F12F664AD9556B');
//        $this->addSql('ALTER TABLE app_paint_job ADD CONSTRAINT FK_15F12F664AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('ALTER TABLE app_order_status RENAME INDEX idx_7a016f488d9f6d38 TO IDX_B88F75C98D9F6D38');
    }
}
