<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126111342 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_session ADD survey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_session ADD CONSTRAINT FK_3D195599B3FE509D FOREIGN KEY (survey_id) REFERENCES app_survey (id)');
        $this->addSql('CREATE INDEX IDX_3D195599B3FE509D ON app_session (survey_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_session DROP FOREIGN KEY FK_3D195599B3FE509D');
        $this->addSql('DROP INDEX IDX_3D195599B3FE509D ON app_session');
        $this->addSql('ALTER TABLE app_session DROP survey_id');
    }
}
