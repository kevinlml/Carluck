<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612050124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carcategory (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carmakers (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carmodels (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carsad (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT NOT NULL, model_id INT NOT NULL, category_id INT NOT NULL, status VARCHAR(100) NOT NULL, year INT NOT NULL, engine INT NOT NULL, kilometres NUMERIC(10, 0) NOT NULL, cylender INT NOT NULL, transmission VARCHAR(50) NOT NULL, drivertrain VARCHAR(50) NOT NULL, outcolour VARCHAR(50) NOT NULL, incolour VARCHAR(50) NOT NULL, passengers INT NOT NULL, doors INT NOT NULL, fueltype VARCHAR(50) NOT NULL, fueltank INT NOT NULL, price NUMERIC(10, 0) NOT NULL, oldprice NUMERIC(10, 0) NOT NULL, features TEXT NOT NULL, otherparams TEXT NOT NULL, safety TEXT NOT NULL, comfort TEXT NOT NULL, INDEX IDX_3A48C313A23B42D (manufacturer_id), INDEX IDX_3A48C3137975B7E7 (model_id), INDEX IDX_3A48C31312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carsad ADD CONSTRAINT FK_3A48C313A23B42D FOREIGN KEY (manufacturer_id) REFERENCES carmakers (id)');
        $this->addSql('ALTER TABLE carsad ADD CONSTRAINT FK_3A48C3137975B7E7 FOREIGN KEY (model_id) REFERENCES carmodels (id)');
        $this->addSql('ALTER TABLE carsad ADD CONSTRAINT FK_3A48C31312469DE2 FOREIGN KEY (category_id) REFERENCES carcategory (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carsad DROP FOREIGN KEY FK_3A48C31312469DE2');
        $this->addSql('ALTER TABLE carsad DROP FOREIGN KEY FK_3A48C313A23B42D');
        $this->addSql('ALTER TABLE carsad DROP FOREIGN KEY FK_3A48C3137975B7E7');
        $this->addSql('DROP TABLE carcategory');
        $this->addSql('DROP TABLE carmakers');
        $this->addSql('DROP TABLE carmodels');
        $this->addSql('DROP TABLE carsad');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
