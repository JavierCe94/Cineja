<?php declare(strict_types=1);

namespace Javier\Cineja\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180510202158 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film DROP min_description');
        $this->addSql('ALTER TABLE film_room CHANGE release_date release_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_seat_film CHANGE code_qr code_qr VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film ADD min_description VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE film_room CHANGE release_date release_date INT NOT NULL');
        $this->addSql('ALTER TABLE user_seat_film CHANGE code_qr code_qr VARCHAR(50) DEFAULT \'None\' NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
