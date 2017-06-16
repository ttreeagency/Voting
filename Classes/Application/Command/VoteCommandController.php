<?php
declare(strict_types=1);

namespace Ttree\Voting\Application\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Ttree\Voting\Domain\Aggregate\Voting\Command\Vote;
use Ttree\Voting\Domain\Aggregate\Voting\Model\Voter;
use Ttree\Voting\Domain\Aggregate\Voting\Voting;
use Ttree\Voting\Domain\Aggregate\Voting\VotingCommandHandler;

final class VoteCommandController extends CommandController {

    /**
     * @var VotingCommandHandler
     * @Flow\Inject
     */
    protected $votingCommandHandler;

    /**
     * Register a vote
     *
     * @param string $for the subject of the vote
     * @param string $by the voter identifier
     * @param int $vote the vote value
     * @param string $tag the vote tag value
     */
    public function registerCommand(string $for, string $by, int $vote, string $tag = Voting::DEFAULT_TAG)
    {
        $voter = Voter::createWithClientIpAddress($by, '127.0.0.1');

        $this->votingCommandHandler->handleVote(
            Vote::register($for, $voter, $vote, new \DateTimeImmutable('now'), $tag)
        );

        $this->outputLine('Vote registred');
    }

}
