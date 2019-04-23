<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423125419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, name_applicant VARCHAR(255) NOT NULL, date_request DATETIME NOT NULL, observation LONGTEXT NOT NULL, date_delivery DATETIME NOT NULL, date_diffusion DATETIME NOT NULL, INDEX IDX_6EEAA67D71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_users (commande_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_2DEB7A2A82EA2E54 (commande_id), INDEX IDX_2DEB7A2A67B3B43D (users_id), PRIMARY KEY(commande_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, category VARCHAR(255) DEFAULT NULL, place VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, name_contact VARCHAR(255) DEFAULT NULL, mail_contact VARCHAR(255) DEFAULT NULL, phone_contact VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, upload VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_team (users_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_B69E81167B3B43D (users_id), INDEX IDX_B69E811296CD8AE (team_id), PRIMARY KEY(users_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE commande_users ADD CONSTRAINT FK_2DEB7A2A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_users ADD CONSTRAINT FK_2DEB7A2A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_team ADD CONSTRAINT FK_B69E81167B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_team ADD CONSTRAINT FK_B69E811296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande_users DROP FOREIGN KEY FK_2DEB7A2A82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D71F7E88B');
        $this->addSql('ALTER TABLE commande_users DROP FOREIGN KEY FK_2DEB7A2A67B3B43D');
        $this->addSql('ALTER TABLE users_team DROP FOREIGN KEY FK_B69E81167B3B43D');
        $this->addSql('ALTER TABLE users_team DROP FOREIGN KEY FK_B69E811296CD8AE');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_users');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_team');
        $this->addSql('DROP TABLE team');
    }
}
