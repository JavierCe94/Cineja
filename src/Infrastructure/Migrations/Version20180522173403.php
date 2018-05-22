<?php declare(strict_types=1);

namespace Javier\Cineja\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180522173403 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(50) NOT NULL, password VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film CHANGE state_film state_film VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE room CHANGE state_room state_room VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE seat CHANGE type_space type_space TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE film CHANGE state_film state_film VARCHAR(50) DEFAULT \'VISIBLE\' NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE room CHANGE state_room state_room VARCHAR(50) DEFAULT \'OPEN\' NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE seat CHANGE type_space type_space TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
