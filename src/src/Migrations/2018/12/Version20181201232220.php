<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181201232220 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE file (id INT NOT NULL, article_id INT NOT NULL, path VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8C9F36107294869C ON file (article_id)');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, team TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON article (author_id)');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C892FC23A8 ON author (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C8A0D96FBF ON author (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C8C05FB297 ON author (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN author.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36107294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F36107294869C');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66F675F31B');
        $this->addSql('DROP SEQUENCE file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d64992fc23a8 ON "user" (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649a0d96fbf ON "user" (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649c05fb297 ON "user" (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:array)\'');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE author');
    }
}
