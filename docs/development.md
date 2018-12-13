# How to develop?

You will need PHP 7.2, composer, node & yarn and some relational database (for example: PostgresSQL).

There are prepared containers for docker if don't want to setup the environment.

## Preparation

- git pull the current version of app
- go to `src/` folder
- copy `.env.dist` to `.env` and change default values

## Starting docker containers (optional)

- `docker-compose -f develop.yml up` or `docker-compose -f develop.yml -d` to run docker containers in background

## Install dependencies & build

- `composer install`
- `yarn encore dev --watch`
- `bin/console server:run` (just in case you are not using docker containers)

## Running command via docker

- `docker-compose -f app.yml exec app bin/console do:da:cr`
