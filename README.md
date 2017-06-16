# Voting API

**This package is under development and API can change / break without notice, please don't use this package in production currently.**

This package provide some Voting API helps developers who want to use a standardized API and schema for storing, retrieving, and tabulating 
votes for Flow Framework application or Neos CMS content.

Note that this package does NOT directly expose any voting mechanisms to end users. It's a framework designed to make life easier for 
other developers, and to standardize voting data for consumption by other modules.

This package use EventSourcing and generate projections to make it really fast to query the vote results (average, number of votes, ...).

Install the package
-------------------

    composer require ttree/voting
    ./flow eventstore:setup Ttree.Voting:EventStream
    ./flow doctrine:migrate
    
You can test the system by voting for something:

    ./flow vote:register --for subject --by johndoe --vote 3 --tag vote

Features
--------

- [x] Vote for any subject
- [x] Every voting subject support tags (so you can vote for multiple tag in the same subject)
- [x] Duplicate voting is forbidden (based on the user identifier)
- [ ] Allow to update a vote
- [ ] Flexible configuration to enable/disable features (dupliate vote, allow update, ...)
- [ ] Flexible voting configuration (start date, closing date, vote value interval, thumbs up/down, percent, ...)

Acknowledgments
---------------

Development sponsored by [ttree ltd - neos solution provider](http://ttree.ch).

We try our best to craft this package with a lots of love, we are open to
sponsoring, support request, ... just contact us.

License
-------

Licensed under MIT, see [LICENSE](LICENSE)
