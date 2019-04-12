<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412124234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, categorie VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) DEFAULT NULL, mail_contact VARCHAR(255) DEFAULT NULL, phone_contact VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, upload VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_commande (users_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_15AB8DA767B3B43D (users_id), INDEX IDX_15AB8DA782EA2E54 (commande_id), PRIMARY KEY(users_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_commande ADD CONSTRAINT FK_15AB8DA767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_commande ADD CONSTRAINT FK_15AB8DA782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFD02F13 ON commande (evenement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFD02F13');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE users_commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DFD02F13 ON commande');
        $this->addSql('ALTER TABLE commande DROP evenement_id');
    }
}
