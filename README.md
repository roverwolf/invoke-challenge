Challenge Submission
====================

This is the code challenge submission.

To install the application

- Clone the git repository
- Run ./bin/setup
- Point a webserver at the web directory or run `./bin/console server:run`

---

Choices made for the code were:

- Using the [Symfony](http://symfony.com) framework
- For ease of setup a sqlite database is used by default
    - MySQL can easily be used instead by:
        - creating a database schema
        - adding the database_* parameters
          from `app/config/parameters.yml.dist` to `app/config/parameters.yml`
          using appropriate values
        - running `./bin/console doctrine:migrate`
- For real-time updates across clients provide [pubnub](http://pubnub.com) publish and subscribe keys in `app/config/parameters.yml`