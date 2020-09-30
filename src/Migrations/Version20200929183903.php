<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929183903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_D4E6F819395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, artist_biography LONGTEXT DEFAULT NULL, artist_website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_15996879395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artwork (id INT AUTO_INCREMENT NOT NULL, artwork_category_id INT NOT NULL, artist_id INT NOT NULL, artwork_support_id INT NOT NULL, artwork_name VARCHAR(255) NOT NULL, artwork_picture VARCHAR(255) NOT NULL, artwork_creation_date DATE NOT NULL, artwork_height DOUBLE PRECISION DEFAULT NULL, artwork_width DOUBLE PRECISION DEFAULT NULL, artwork_depth DOUBLE PRECISION DEFAULT NULL, artwork_weight DOUBLE PRECISION DEFAULT NULL, artwork_sale_price DOUBLE PRECISION DEFAULT NULL, artwork_rental_price DOUBLE PRECISION DEFAULT NULL, artwork_description LONGTEXT DEFAULT NULL, artwork_availability TINYINT(1) NOT NULL, artwork_special TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_881FC5765C5AF308 (artwork_category_id), INDEX IDX_881FC576B7970CF8 (artist_id), INDEX IDX_881FC5761BF80AE7 (artwork_support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artwork_category (id INT AUTO_INCREMENT NOT NULL, artwork_category_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artwork_support (id INT AUTO_INCREMENT NOT NULL, artwork_support_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artwork_technical (id INT AUTO_INCREMENT NOT NULL, artwork_technical_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, customer_category_id INT NOT NULL, customer_last_name VARCHAR(255) NOT NULL, customer_first_name VARCHAR(255) NOT NULL, customer_nickname VARCHAR(255) NOT NULL, customer_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, customer_phone_home VARCHAR(45) DEFAULT NULL, customer_cell_phone VARCHAR(45) NOT NULL, customer_company VARCHAR(255) DEFAULT NULL, customer_siret_company BIGINT DEFAULT NULL, INDEX IDX_81398E09110DB6EA (customer_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_category (id INT AUTO_INCREMENT NOT NULL, customer_category_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, artwork_id INT NOT NULL, order_number INT NOT NULL, order_type TINYINT(1) DEFAULT NULL, order_reservation_start_date DATETIME DEFAULT NULL, order_reservation_end_date DATETIME DEFAULT NULL, order_date DATETIME NOT NULL, order_status TINYINT(1) NOT NULL, order_rental TINYINT(1) NOT NULL, INDEX IDX_C3121F999395C3F3 (customer_id), INDEX IDX_C3121F99DB8FFA4 (artwork_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tech_artwork (id INT AUTO_INCREMENT NOT NULL, artwork_id INT NOT NULL, artwork_technical_id INT NOT NULL, INDEX IDX_39042133DB8FFA4 (artwork_id), INDEX IDX_39042133F96D0176 (artwork_technical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F819395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996879395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC5765C5AF308 FOREIGN KEY (artwork_category_id) REFERENCES artwork_category (id)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC576B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC5761BF80AE7 FOREIGN KEY (artwork_support_id) REFERENCES artwork_support (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09110DB6EA FOREIGN KEY (customer_category_id) REFERENCES customer_category (id)');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F999395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F99DB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id)');
        $this->addSql('ALTER TABLE tech_artwork ADD CONSTRAINT FK_39042133DB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id)');
        $this->addSql('ALTER TABLE tech_artwork ADD CONSTRAINT FK_39042133F96D0176 FOREIGN KEY (artwork_technical_id) REFERENCES artwork_technical (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC576B7970CF8');
        $this->addSql('ALTER TABLE ordered DROP FOREIGN KEY FK_C3121F99DB8FFA4');
        $this->addSql('ALTER TABLE tech_artwork DROP FOREIGN KEY FK_39042133DB8FFA4');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC5765C5AF308');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC5761BF80AE7');
        $this->addSql('ALTER TABLE tech_artwork DROP FOREIGN KEY FK_39042133F96D0176');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F819395C3F3');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996879395C3F3');
        $this->addSql('ALTER TABLE ordered DROP FOREIGN KEY FK_C3121F999395C3F3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09110DB6EA');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artwork');
        $this->addSql('DROP TABLE artwork_category');
        $this->addSql('DROP TABLE artwork_support');
        $this->addSql('DROP TABLE artwork_technical');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_category');
        $this->addSql('DROP TABLE ordered');
        $this->addSql('DROP TABLE tech_artwork');
    }
}
