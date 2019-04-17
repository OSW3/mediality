<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417151122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande_users (commande_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_2DEB7A2A82EA2E54 (commande_id), INDEX IDX_2DEB7A2A67B3B43D (users_id), PRIMARY KEY(commande_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_users ADD CONSTRAINT FK_2DEB7A2A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_users ADD CONSTRAINT FK_2DEB7A2A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE users_commande');
        $this->addSql('ALTER TABLE evenement CHANGE category category VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_commande (users_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_15AB8DA767B3B43D (users_id), INDEX IDX_15AB8DA782EA2E54 (commande_id), PRIMARY KEY(users_id, commande_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_commande ADD CONSTRAINT FK_15AB8DA767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_commande ADD CONSTRAINT FK_15AB8DA782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE commande_users');
        $this->addSql('ALTER TABLE evenement CHANGE category category VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
