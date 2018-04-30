<?php declare(strict_types = 1);

namespace Javier\Cineja\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180430194223 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_seat_film (id INT AUTO_INCREMENT NOT NULL, seat_id INT NOT NULL, film_room_id INT NOT NULL, user_id INT NOT NULL, code_qr VARCHAR(50) DEFAULT \'None\' NOT NULL, UNIQUE INDEX UNIQ_13FDF9275115D31F (code_qr), INDEX IDX_13FDF927C1DAFE35 (seat_id), INDEX IDX_13FDF927B4A96BB0 (film_room_id), INDEX IDX_13FDF927A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_seat_film ADD CONSTRAINT FK_13FDF927C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seat (id)');
        $this->addSql('ALTER TABLE user_seat_film ADD CONSTRAINT FK_13FDF927B4A96BB0 FOREIGN KEY (film_room_id) REFERENCES film_room (id)');
        $this->addSql('ALTER TABLE user_seat_film ADD CONSTRAINT FK_13FDF927A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE seat_film');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE seat_film (id INT AUTO_INCREMENT NOT NULL, seat_id INT NOT NULL, film_room_id INT NOT NULL, user_id INT NOT NULL, code_qr VARCHAR(50) DEFAULT \'None\' NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_131D74C35115D31F (code_qr), INDEX IDX_131D74C3C1DAFE35 (seat_id), INDEX IDX_131D74C3A76ED395 (user_id), INDEX IDX_131D74C3B4A96BB0 (film_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3B4A96BB0 FOREIGN KEY (film_room_id) REFERENCES film_room (id)');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seat (id)');
        $this->addSql('DROP TABLE user_seat_film');
    }
}
