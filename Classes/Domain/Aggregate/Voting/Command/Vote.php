<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting\Command;

use Neos\Flow\Annotations as Flow;
use Ttree\Voting\Domain\Aggregate\Voting\Model\Voter;
use Ttree\Voting\Domain\Aggregate\Voting\Voting;

final class Vote {

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
     * @var string
     */
    private $tag;

    /**
     * @var \DateTimeImmutable
     */
    private $at;

    public function __construct(string $for, Voter $by, int $vote, \DateTimeImmutable $at, string $tag = Voting::DEFAULT_TAG)
    {
        $this->for = $for;
        $this->by = $by;
        $this->vote = $vote;
        $this->at = $at;
        $this->tag = $tag;
    }

    public static function register(string $for, Voter $by, int $vote, \DateTimeImmutable $at, string $tag = Voting::DEFAULT_TAG)
    {
        return new static($for, $by, $vote, $at, $tag);
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
