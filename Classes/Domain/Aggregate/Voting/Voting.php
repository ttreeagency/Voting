<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting;

use Neos\EventSourcing\Domain\AbstractEventSourcedAggregateRoot;
use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Event\VoteRecorded;
use Ttree\Voting\Domain\Aggregate\Voting\Event\VotingCreated;
use Ttree\Voting\Domain\Aggregate\Voting\Model\Voter;

final class Voting extends AbstractEventSourcedAggregateRoot {

    public const DEFAULT_TAG = 'vote';

    /**
     * @var string
     */
    protected $for;

    /**
     * @var \DateTimeImmutable
     */
    protected $createdAt;

    /**
     * @var \DateTimeImmutable
     */
    protected $updatedAt;

    /**
     * @var int
     */
    protected $voteCount;

    /**
     * @var string[]
     */
    protected $tags = [];

    protected function __construct(string $for)
    {
        $this->for = $for;
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public static function create(string $for): Voting
    {
        return new static($for);
    }

    public function vote(int $vote, \DateTimeImmutable $at, string $tag, Voter $by): void
    {
        $this->recordThat(new VoteRecorded($this->for, $by, $vote, $at, $tag));
    }

    protected function whenVoteRecorded(VoteRecorded $event): void
    {
        $this->updatedAt = new \DateTimeImmutable('now');
        $this->tags[$event->getTag()] = true;
    }

    public function getIdentifier(): string
    {
        return $this->for;
    }

}
