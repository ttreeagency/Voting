<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\VotingResult;

use Neos\EventSourcing\Projection\Doctrine\AbstractDoctrineProjector;
use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Event\VoteRecorded;
use Ttree\Voting\Domain\Aggregate\Voting\Model\VotingIdentifier;

class VotingResultProjector extends AbstractDoctrineProjector  {

    public function whenVoteRecorded(VoteRecorded $event): void
    {
        $update = true;
        $votingIdentifier = VotingIdentifier::toString($event->getFor(), $event->getTag());
        $result = $this->get($votingIdentifier);
        if ($result === null) {
            $result = new VotingResult($votingIdentifier);
            $update = false;
        }

        $result->record($event->getVote());

        if ($update) {
            $this->update($result);
        } else {
            $this->add($result);
        }
    }

}
