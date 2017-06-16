<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Calculate minimum, maximum and average vote in VotingResult projection
 */
class Version20170616134552 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Calculate minimum, maximum and average vote in VotingResult projection';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('ALTER TABLE ttree_voting_votingresult ADD minimum INT NOT NULL, ADD maximum INT NOT NULL, ADD average DOUBLE PRECISION NOT NULL');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('ALTER TABLE ttree_voting_votingresult DROP minimum, DROP maximum, DROP average');
    }
}
