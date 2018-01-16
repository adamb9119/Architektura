<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180116134613 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users ADD meta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C250282439FCA6F9 FOREIGN KEY (meta_id) REFERENCES app_users_meta (id)');
        $this->addSql('CREATE INDEX IDX_C250282439FCA6F9 ON app_users (meta_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C250282439FCA6F9');
        $this->addSql('DROP INDEX IDX_C250282439FCA6F9 ON app_users');
        $this->addSql('ALTER TABLE app_users DROP meta_id');
    }
}
