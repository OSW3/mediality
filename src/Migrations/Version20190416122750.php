<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416122750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_team (users_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_B69E81167B3B43D (users_id), INDEX IDX_B69E811296CD8AE (team_id), PRIMARY KEY(users_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_team ADD CONSTRAINT FK_B69E81167B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_team ADD CONSTRAINT FK_B69E811296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFD02F13');
        $this->addSql('DROP INDEX IDX_6EEAA67DFD02F13 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE evenement_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D71F7E88B ON commande (event_id)');
        $this->addSql('ALTER TABLE evenement CHANGE category category VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_team DROP FOREIGN KEY FK_B69E811296CD8AE');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE users_team');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D71F7E88B');
        $this->addSql('DROP INDEX IDX_6EEAA67D71F7E88B ON commande');
        $this->addSql('ALTER TABLE commande CHANGE event_id evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFD02F13 ON commande (evenement_id)');
        $this->addSql('ALTER TABLE evenement CHANGE category category VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
