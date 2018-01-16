<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180116141352 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users_meta DROP INDEX UNIQ_4E60F147A76ED395, ADD INDEX IDX_4E60F147A76ED395 (user_id)');
        $this->addSql('ALTER TABLE app_users_meta CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users_meta ADD CONSTRAINT FK_4E60F147A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users_meta DROP INDEX IDX_4E60F147A76ED395, ADD UNIQUE INDEX UNIQ_4E60F147A76ED395 (user_id)');
        $this->addSql('ALTER TABLE app_users_meta DROP FOREIGN KEY FK_4E60F147A76ED395');
        $this->addSql('ALTER TABLE app_users_meta CHANGE user_id user_id VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci');
    }
}
