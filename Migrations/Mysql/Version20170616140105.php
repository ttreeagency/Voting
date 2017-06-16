<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Add VotingResult and Participant projection
 */
class Version20170616140105 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Add VotingResult and Participant projection';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE ttree_voting_participation (voter VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, voting VARCHAR(255) NOT NULL, tag VARCHAR(255) NOT NULL, value INT NOT NULL, at DATETIME NOT NULL, PRIMARY KEY(voter, identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttree_voting_votingresult (identifier VARCHAR(255) NOT NULL, voting VARCHAR(255) NOT NULL, tag VARCHAR(255) NOT NULL, voters INT NOT NULL, votes INT NOT NULL, minimum INT NOT NULL, maximum INT NOT NULL, average DOUBLE PRECISION NOT NULL, PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('DROP TABLE ttree_voting_participation');
        $this->addSql('DROP TABLE ttree_voting_votingresult');
    }
}
