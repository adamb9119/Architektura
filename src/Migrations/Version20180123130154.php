<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180123130154 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_log (id INT AUTO_INCREMENT NOT NULL, survey_id INT DEFAULT NULL, title VARCHAR(250) NOT NULL, params VARCHAR(250) NOT NULL, added DATETIME DEFAULT NULL, INDEX IDX_A14DDB02B3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_log ADD CONSTRAINT FK_A14DDB02B3FE509D FOREIGN KEY (survey_id) REFERENCES app_survey (id)');
        $this->addSql('DROP TABLE log');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, survey_id INT DEFAULT NULL, title VARCHAR(250) NOT NULL COLLATE utf8_unicode_ci, params VARCHAR(250) NOT NULL COLLATE utf8_unicode_ci, added DATETIME DEFAULT NULL, INDEX IDX_8F3F68C5B3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C5B3FE509D FOREIGN KEY (survey_id) REFERENCES app_survey (id)');
        $this->addSql('DROP TABLE app_log');
    }
}
