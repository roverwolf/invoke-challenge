<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140620211937 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
INSERT INTO player
  (name, points)
VALUES
  ('Nikola Tesla', 0),
  ('Ada Lovelace', 0),
  ('Claude Shannon', 0),
  ('Marie Curie', 0),
  ('Grace Hopper', 0),
  ('Carl Friedrich Gauss', 0)
;
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DELETE FROM player;");
    }
}
