<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\VotingResult;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 * @ORM\Table(name="ttree_voting_votingresult")
 */
class VotingResult
{
    /**
     * @ORM\Id
     * @var string
     */
    public $voting;

    /**
     * @var int
     */
    public $voters;

    /**
     * @var int
     */
    public $votes;

    public function __construct(string $voting)
    {
        $this->voting = $voting;
        $this->voters = 0;
        $this->votes = 0;
    }

    public function record($value)
    {
        $this->voters++;
        $this->votes += (int)$value;
    }
}
