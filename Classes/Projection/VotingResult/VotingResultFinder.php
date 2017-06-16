<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\VotingResult;

use Neos\EventSourcing\Projection\Doctrine\AbstractDoctrineFinder;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryInterface;

/**
 * @Flow\Scope("singleton")
 */
class VotingResultFinder extends AbstractDoctrineFinder  {

    public function findOneByVoting(string $votingIdentifier)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals('voting', $votingIdentifier)
        );

        return $query->execute()->getFirst();
    }
}
