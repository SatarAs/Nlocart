<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012000006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE artist_website artist_website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE artwork CHANGE artwork_height artwork_height DOUBLE PRECISION DEFAULT NULL, CHANGE artwork_width artwork_width DOUBLE PRECISION DEFAULT NULL, CHANGE artwork_depth artwork_depth DOUBLE PRECISION DEFAULT NULL, CHANGE artwork_weight artwork_weight DOUBLE PRECISION DEFAULT NULL, CHANGE artwork_sale_price artwork_sale_price DOUBLE PRECISION DEFAULT NULL, CHANGE artwork_rental_price artwork_rental_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE customer_phone_home customer_phone_home VARCHAR(45) DEFAULT NULL, CHANGE customer_company customer_company VARCHAR(255) DEFAULT NULL, CHANGE customer_siret_company customer_siret_company BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordered CHANGE order_type order_type TINYINT(1) DEFAULT NULL, CHANGE order_reservation_start_date order_reservation_start_date DATETIME DEFAULT NULL, CHANGE order_reservation_end_date order_reservation_end_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE artist_website artist_website VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE artwork CHANGE artwork_height artwork_height DOUBLE PRECISION DEFAULT \'NULL\', CHANGE artwork_width artwork_width DOUBLE PRECISION DEFAULT \'NULL\', CHANGE artwork_depth artwork_depth DOUBLE PRECISION DEFAULT \'NULL\', CHANGE artwork_weight artwork_weight DOUBLE PRECISION DEFAULT \'NULL\', CHANGE artwork_sale_price artwork_sale_price DOUBLE PRECISION DEFAULT \'NULL\', CHANGE artwork_rental_price artwork_rental_price DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE customer CHANGE customer_phone_home customer_phone_home VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE customer_company customer_company VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE customer_siret_company customer_siret_company BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordered CHANGE order_type order_type TINYINT(1) DEFAULT \'NULL\', CHANGE order_reservation_start_date order_reservation_start_date DATETIME DEFAULT \'NULL\', CHANGE order_reservation_end_date order_reservation_end_date DATETIME DEFAULT \'NULL\'');
    }
}
