<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180330081820 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE code (id INT AUTO_INCREMENT NOT NULL, collection_id INT DEFAULT NULL, value VARCHAR(256) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_77153098514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, auction_id INT DEFAULT NULL, client_id INT DEFAULT NULL, message_id INT DEFAULT NULL, number VARCHAR(16) NOT NULL, count INT NOT NULL, value DOUBLE PRECISION NOT NULL, status INT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_723705D157B8F0DE (auction_id), INDEX IDX_723705D119EB6921 (client_id), UNIQUE INDEX UNIQ_723705D1537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitor (id INT AUTO_INCREMENT NOT NULL, collection_id INT DEFAULT NULL, auction_id INT DEFAULT NULL, name VARCHAR(256) NOT NULL, email_title VARCHAR(128) NOT NULL, email_body LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E1159985514956FD (collection_id), UNIQUE INDEX UNIQ_E115998557B8F0DE (auction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, code_id INT DEFAULT NULL, transaction_id INT DEFAULT NULL, body LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B6BD307F27DAFE17 (code_id), UNIQUE INDEX UNIQ_B6BD307F2FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction (id INT AUTO_INCREMENT NOT NULL, monitor_id INT DEFAULT NULL, number VARCHAR(16) NOT NULL, title VARCHAR(64) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DEE4F5934CE1C902 (monitor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(16) NOT NULL, first_name VARCHAR(32) NOT NULL, sur_name VARCHAR(32) NOT NULL, nick_name VARCHAR(32) NOT NULL, email VARCHAR(64) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code ADD CONSTRAINT FK_77153098514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D157B8F0DE FOREIGN KEY (auction_id) REFERENCES auction (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE monitor ADD CONSTRAINT FK_E1159985514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
        $this->addSql('ALTER TABLE monitor ADD CONSTRAINT FK_E115998557B8F0DE FOREIGN KEY (auction_id) REFERENCES auction (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F27DAFE17 FOREIGN KEY (code_id) REFERENCES code (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id)');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F5934CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id)');
        $this->addSql('DROP TABLE product');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F27DAFE17');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F2FC0CB0F');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F5934CE1C902');
        $this->addSql('ALTER TABLE code DROP FOREIGN KEY FK_77153098514956FD');
        $this->addSql('ALTER TABLE monitor DROP FOREIGN KEY FK_E1159985514956FD');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1537A1329');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D157B8F0DE');
        $this->addSql('ALTER TABLE monitor DROP FOREIGN KEY FK_E115998557B8F0DE');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D119EB6921');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE code');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE monitor');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE auction');
        $this->addSql('DROP TABLE client');
    }
}
