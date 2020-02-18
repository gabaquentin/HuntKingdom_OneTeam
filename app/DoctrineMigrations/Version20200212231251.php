<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200212231251 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urgence DROP FOREIGN KEY FK_737D6BCD692907E');
        $this->addSql('DROP TABLE expedition');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE expedition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, statut VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dateDebut VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dateFin VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, date VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, message VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, lieux VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, expedition INT DEFAULT NULL, Utilisateur VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, latitude VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, adresse VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, plus VARCHAR(255) DEFAULT \'\'0\'\' NOT NULL COLLATE utf8_unicode_ci, longitude VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, place_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, date VARCHAR(255) DEFAULT \'current_timestamp()\' NOT NULL COLLATE utf8_unicode_ci, etat VARCHAR(255) DEFAULT \'\'0\'\' NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_737D6BCD692907E (expedition), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE urgence ADD CONSTRAINT FK_737D6BCD692907E FOREIGN KEY (expedition) REFERENCES expedition (id)');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
    }
}
