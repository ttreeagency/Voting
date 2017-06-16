<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\Participation;

use Neos\EventSourcing\Projection\Doctrine\AbstractDoctrineProjector;
use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Event\VoteRecorded;
use Ttree\Voting\Domain\Aggregate\Voting\Model\VotingIdentifier;

class ParticipationProjector extends AbstractDoctrineProjector  {

    public function whenVoteRecorded(VoteRecorded $event): void
    {
        $votingIdentifier = VotingIdentifier::toString($event->getFor(), $event->getTag());
        $this->add(
            new Participation($event->getBy()->getName(), $votingIdentifier, $event->getVote(), $event->getAt())
        );
    }

}
