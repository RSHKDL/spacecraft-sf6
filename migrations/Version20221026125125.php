<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221026125125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Options: first pass at spaceship options';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_option_base (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, option_type VARCHAR(255) NOT NULL, INDEX IDX_715F723EA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_option_defense (id INT NOT NULL, defense INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_option_power_supply (id INT NOT NULL, power INT NOT NULL, storage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_spaceships_options (spaceship_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_70854DBE4AD9556B (spaceship_id), INDEX IDX_70854DBEA7C41D6F (option_id), PRIMARY KEY(spaceship_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_option_base ADD CONSTRAINT FK_715F723EA23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id)');
        $this->addSql('ALTER TABLE app_option_defense ADD CONSTRAINT FK_1CAB70FEBF396750 FOREIGN KEY (id) REFERENCES app_option_base (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_option_power_supply ADD CONSTRAINT FK_5475EEFABF396750 FOREIGN KEY (id) REFERENCES app_option_base (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_spaceships_options ADD CONSTRAINT FK_70854DBE4AD9556B FOREIGN KEY (spaceship_id) REFERENCES app_spaceship (id)');
        $this->addSql('ALTER TABLE app_spaceships_options ADD CONSTRAINT FK_70854DBEA7C41D6F FOREIGN KEY (option_id) REFERENCES app_option_base (id)');
        $this->addSql('ALTER TABLE app_spaceship ADD manufacturer_id INT DEFAULT NULL, DROP manufacturer, DROP class, DROP type, DROP model');
        $this->addSql('ALTER TABLE app_spaceship ADD CONSTRAINT FK_21FD3BBA23B42D FOREIGN KEY (manufacturer_id) REFERENCES app_manufacturer (id)');
        $this->addSql('CREATE INDEX IDX_21FD3BBA23B42D ON app_spaceship (manufacturer_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_option_defense DROP FOREIGN KEY FK_1CAB70FEBF396750');
        $this->addSql('ALTER TABLE app_option_power_supply DROP FOREIGN KEY FK_5475EEFABF396750');
        $this->addSql('ALTER TABLE app_spaceships_options DROP FOREIGN KEY FK_70854DBEA7C41D6F');
        $this->addSql('DROP TABLE app_option_base');
        $this->addSql('DROP TABLE app_option_defense');
        $this->addSql('DROP TABLE app_option_power_supply');
        $this->addSql('DROP TABLE app_spaceships_options');
        $this->addSql('ALTER TABLE app_spaceship DROP FOREIGN KEY FK_21FD3BBA23B42D');
        $this->addSql('DROP INDEX IDX_21FD3BBA23B42D ON app_spaceship');
        $this->addSql('ALTER TABLE app_spaceship ADD manufacturer VARCHAR(255) NOT NULL, ADD class VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD model VARCHAR(255) NOT NULL, DROP manufacturer_id');
    }
}
