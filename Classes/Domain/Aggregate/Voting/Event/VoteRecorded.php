<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting\Event;

use Neos\EventSourcing\Event\EventInterface;
use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Model\Voter;

final class VoteRecorded implements EventInterface {

    /**
     * @var string
     */
    private $for;

    /**
     * @var Voter
     */
    private $by;

    /**
     * @var int
     */
    private $vote;

    /**
     * @var \DateTimeImmutable
     */
    private $at;

    /**
     * @var string
     */
    private $tag;

    public function __construct(string $for, Voter $by, int $vote, \DateTimeImmutable $at, string $tag)
    {
        $this->for = $for;
        $this->by = $by;
        $this->vote = $vote;
        $this->at = $at;
        $this->tag = $tag;
    }

    public function getFor(): string
    {
        return $this->for;
    }

    public function getBy(): Voter
    {
        return $this->by;
    }

    public function getVote(): int
    {
        return $this->vote;
    }

    public function getAt(): \DateTimeImmutable
    {
        return $this->at;
    }

    public function getTag(): string
    {
        return $this->tag;
    }
}
