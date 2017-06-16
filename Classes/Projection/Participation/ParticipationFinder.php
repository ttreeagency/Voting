<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\Participation;

use Neos\EventSourcing\Projection\Doctrine\AbstractDoctrineFinder;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryInterface;

/**
 * @Flow\Scope("singleton")
 */
class ParticipationFinder extends AbstractDoctrineFinder  {

    protected $defaultOrderings = [
        'at' => QueryInterface::ORDER_ASCENDING
    ];

    public function findOnByVoter(string $voter, string $votingIdentifier)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->logicalAnd(
                $query->equals('voter', $voter),
                $query->equals('voting', $votingIdentifier)
            )
        );

        return $query->execute()->getFirst();
    }
}
