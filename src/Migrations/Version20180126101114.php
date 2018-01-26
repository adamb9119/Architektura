<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126101114 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_response (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, value TEXT NOT NULL, params TEXT DEFAULT NULL, INDEX IDX_36FB6B56613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_session (id INT AUTO_INCREMENT NOT NULL, ip TINYTEXT NOT NULL, client TEXT NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_response ADD CONSTRAINT FK_36FB6B56613FECDF FOREIGN KEY (session_id) REFERENCES app_session (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_response DROP FOREIGN KEY FK_36FB6B56613FECDF');
        $this->addSql('DROP TABLE app_response');
        $this->addSql('DROP TABLE app_session');
    }
}
