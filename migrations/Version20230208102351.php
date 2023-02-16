<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230208102351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Blueprint: add relation between spaceship blueprint, role and class';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_blueprint ADD role_id INT DEFAULT NULL, ADD class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53D60322AC FOREIGN KEY (role_id) REFERENCES app_spaceship_role (id)');
        $this->addSql('ALTER TABLE app_blueprint ADD CONSTRAINT FK_8E2ABD53EA000B10 FOREIGN KEY (class_id) REFERENCES app_spaceship_class (id)');
        $this->addSql('CREATE INDEX IDX_8E2ABD53D60322AC ON app_blueprint (role_id)');
        $this->addSql('CREATE INDEX IDX_8E2ABD53EA000B10 ON app_blueprint (class_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_blueprint DROP FOREIGN KEY FK_8E2ABD53D60322AC');
        $this->addSql('ALTER TABLE app_blueprint DROP FOREIGN KEY FK_8E2ABD53EA000B10');
        $this->addSql('DROP INDEX IDX_8E2ABD53D60322AC ON app_blueprint');
        $this->addSql('DROP INDEX IDX_8E2ABD53EA000B10 ON app_blueprint');
        $this->addSql('ALTER TABLE app_blueprint DROP role_id, DROP class_id');
    }
}
