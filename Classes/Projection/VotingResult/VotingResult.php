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
    public $identifier;

    /**
     * @var string
     */
    public $voting;

    /**
     * @var string
     */
    public $tag;

    /**
     * @var int
     */
    public $voters;

    /**
     * @var int
     */
    public $votes;

    /**
     * @var int
     */
    public $minimum;

    /**
     * @var int
     */
    public $maximum;

    /**
     * @var float
     */
    public $average;

    public function __construct(string $voting)
    {
        $this->identifier = $voting;
        list($voting, $tag) = \explode('@', $voting);
        $this->voting = $voting;
        $this->tag = $tag;

        $this->voters = 0;
        $this->votes = 0;

        $this->minimum = null;
        $this->maximum = null;
        $this->average = null;
    }

    public function record($value)
    {
        $this->voters++;
        $value = (int)$value;
        $this->votes += (int)$value;
        if ($this->minimum === null || $value < $this->minimum) {
            $this->minimum = $value;
        }
        if ($this->maximum === null || $value > $this->maximum) {
            $this->maximum = $value;
        }
        $this->average = $this->votes / $this->voters;
    }
}
