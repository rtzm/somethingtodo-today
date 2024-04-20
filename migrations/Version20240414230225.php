<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414230225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration to set up prompt table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE prompt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE prompt (id INT NOT NULL, text TEXT NOT NULL, use_date DATE DEFAULT NULL, created_timestamp TIMESTAMP(0) WITH TIME ZONE DEFAULT current_timestamp NOT NULL, updated_timestamp TIMESTAMP(0) WITH TIME ZONE DEFAULT current_timestamp NOT NULL, PRIMARY KEY(id))');
        $this->addSql(
            "CREATE OR REPLACE FUNCTION update_updated_timestamp_column()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.updated_timestamp = now(); 
                RETURN NEW;
            END;
            $$ language 'plpgsql';"
        );
        $this->addSql(
            "CREATE TRIGGER update_prompt_updated_timestamp BEFORE UPDATE
            ON prompt FOR EACH ROW EXECUTE PROCEDURE 
            update_updated_timestamp_column()"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE prompt_id_seq CASCADE');
        $this->addSql('DROP FUNCTION update_updated_timestamp_column');
        $this->addSql('DROP TRIGGER update_prompt_updated_timestamp');
        $this->addSql('DROP TABLE prompt');

    }
}
