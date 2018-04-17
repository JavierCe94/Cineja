<?php declare(strict_types = 1);

namespace Javier\Cineja\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416192007 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(75) NOT NULL, name VARCHAR(60) NOT NULL, description TEXT NOT NULL, min_description VARCHAR(100) NOT NULL, duration SMALLINT NOT NULL, min_age SMALLINT NOT NULL, UNIQUE INDEX UNIQ_8244BE225E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_genre (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1A3CCDA8567F5183 (film_id), INDEX IDX_1A3CCDA84296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_835033F85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_room (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, room_id INT NOT NULL, release_date INT NOT NULL, INDEX IDX_1730BB98567F5183 (film_id), INDEX IDX_1730BB9854177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_729F519B5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, section_room_id INT NOT NULL, price NUMERIC(10, 0) NOT NULL, row SMALLINT NOT NULL, `column` SMALLINT NOT NULL, INDEX IDX_3D5C366654177093 (room_id), INDEX IDX_3D5C36668650BD9C (section_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat_film (id INT AUTO_INCREMENT NOT NULL, seat_id INT NOT NULL, film_id INT NOT NULL, user_id INT NOT NULL, code_qr VARCHAR(50) DEFAULT \'None\' NOT NULL, UNIQUE INDEX UNIQ_131D74C35115D31F (code_qr), INDEX IDX_131D74C3C1DAFE35 (seat_id), INDEX IDX_131D74C3567F5183 (film_id), INDEX IDX_131D74C3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_room (id INT AUTO_INCREMENT NOT NULL, position_section VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_F721BD90BE826B1C (position_section), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(60) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, password VARCHAR(75) NOT NULL, credit_card VARCHAR(16) NOT NULL, UNIQUE INDEX UNIQ_8D93D6495126AC48 (mail), UNIQUE INDEX UNIQ_8D93D64911D627EE (credit_card), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA8567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA84296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE film_room ADD CONSTRAINT FK_1730BB98567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE film_room ADD CONSTRAINT FK_1730BB9854177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE seat ADD CONSTRAINT FK_3D5C366654177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE seat ADD CONSTRAINT FK_3D5C36668650BD9C FOREIGN KEY (section_room_id) REFERENCES section_room (id)');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seat (id)');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE seat_film ADD CONSTRAINT FK_131D74C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA8567F5183');
        $this->addSql('ALTER TABLE film_room DROP FOREIGN KEY FK_1730BB98567F5183');
        $this->addSql('ALTER TABLE seat_film DROP FOREIGN KEY FK_131D74C3567F5183');
        $this->addSql('ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA84296D31F');
        $this->addSql('ALTER TABLE film_room DROP FOREIGN KEY FK_1730BB9854177093');
        $this->addSql('ALTER TABLE seat DROP FOREIGN KEY FK_3D5C366654177093');
        $this->addSql('ALTER TABLE seat_film DROP FOREIGN KEY FK_131D74C3C1DAFE35');
        $this->addSql('ALTER TABLE seat DROP FOREIGN KEY FK_3D5C36668650BD9C');
        $this->addSql('ALTER TABLE seat_film DROP FOREIGN KEY FK_131D74C3A76ED395');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_genre');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE film_room');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE seat');
        $this->addSql('DROP TABLE seat_film');
        $this->addSql('DROP TABLE section_room');
        $this->addSql('DROP TABLE user');
    }
}
