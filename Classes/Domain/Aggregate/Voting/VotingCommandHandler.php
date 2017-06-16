<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting;

use Neos\EventSourcing\Domain\Exception\AggregateRootNotFoundException;
use Neos\EventSourcing\EventStore\Exception\EventStreamNotFoundException;
use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Command\Vote;
use Ttree\Voting\Domain\Aggregate\Voting\Exception\VotePreviouslyRecordedException;
use Ttree\Voting\Projection\Participation\ParticipationFinder;

/**
 * @Flow\Scope("singleton")
 */
final class VotingCommandHandler {

    /**
     * @var VotingRepository
     * @Flow\Inject
     */
    protected $votingRepository;

    /**
     * @var ParticipationFinder
     * @Flow\Inject
     */
    protected $participationFinder;

    public function handleVote(Vote $vote): void
    {
        try {
        $voting = $this->votingRepository->get($vote->getFor());
        } catch (EventStreamNotFoundException $exception) {
            $voting = Voting::create($vote->getFor());
        }

        $participation = $this->participationFinder->findOnByVoter($vote->getBy()->getName(), $vote->getFor(), $vote->getTag());

        if ($participation !== null) {
            throw new VotePreviouslyRecordedException('Double vote is not allowed', 1497603333);
        }
        $voting->vote($vote->getVote(), $vote->getAt(), $vote->getTag(), $vote->getBy());
        $this->votingRepository->save($voting);
    }

}
