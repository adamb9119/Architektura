<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126101722 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_response ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_response ADD CONSTRAINT FK_36FB6B561E27F6BF FOREIGN KEY (question_id) REFERENCES app_question (id)');
        $this->addSql('CREATE INDEX IDX_36FB6B561E27F6BF ON app_response (question_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_response DROP FOREIGN KEY FK_36FB6B561E27F6BF');
        $this->addSql('DROP INDEX IDX_36FB6B561E27F6BF ON app_response');
        $this->addSql('ALTER TABLE app_response DROP question_id');
    }
}
