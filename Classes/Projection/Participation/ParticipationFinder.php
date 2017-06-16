<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\Participation;

use Neos\EventSourcing\Projection\Doctrine\AbstractDoctrineFinder;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryInterface;
use Ttree\Voting\Domain\Aggregate\Voting\Event\VoteRecorded;
use Ttree\Voting\Domain\Aggregate\Voting\Model\VotingIdentifier;

/**
 * @Flow\Scope("singleton")
 */
class ParticipationFinder extends AbstractDoctrineFinder  {

    protected $defaultOrderings = [
        'at' => QueryInterface::ORDER_ASCENDING
    ];

    public function findOnByVoter(string $voter, string $voting, string $tag)
    {
        $query = $this->createQuery();

        $votingIdentifier = new VotingIdentifier($voting, $tag);

        $query->matching(
            $query->logicalAnd(
                $query->equals('voter', $voter),
                $query->equals('voting', (string)$votingIdentifier)
            )
        );

        return $query->execute()->getFirst();
    }
}
