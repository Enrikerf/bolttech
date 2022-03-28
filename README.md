# BOLTTECH technical test

## setup environment

* make build
* docker-compose up -d
* make shell php
* composer install
* php vendor/bin/phpunit


edit etc/host and add api.bolttech.dev to /etc/hosts or call to 127.0.0.1

the available endpoints are:
* POST /booking to create and persist a new booking to a client
* POST /booking-options to create the current available booking options


I let a postman collection on the root of the proyect to call the api

## Notes


Previous considerations:
* I won't implement the adapters with a database. That don't show anything interesting, I will mock and annotate the considerations that I think are relevant to.
* I won't dedicate much time in other adapters like api or others that will needed
* my priorities will be:
  * domain
    * design
  * application
    * usecases and tests
  * setup of the proyect
    * docker, makefiles and doc
  * adapters


Progress:

1. first I am going to design the domain. to have a good idea of the problem, because I am going to center my efforts in have a rich Domain, I let the TDD for the application, we could have a micro-integration tests that will call unit, using the domain instead of mocks, that will check almost every part of the code, for a MPV It's a good balance between quality and speed. I am going to set a goal of 2 hours to think about the domain, then with the result I am going to implement a solution beside I know that the solution won't satisfy me enough. 

2. With the domain designed and implemented I can see:
   1. the point that requires more complex algorithm:
      1. Car/Price/Price&PriceCollection
         1. we need to check that all the intervals sum the whole year exactly on the construct
         2. we need to implement the algorithm to get the average price on a range
         3. If I have more time I think better the price format: int for fromMonth and fromDay don't like me enough
      2. I won't implement them because are quite particular, and I want to show more architecture than algorithmic
   2. Drawbacks of the design
      1. I saw the userLicense requirement after the design. to don't implement more domain I will design a Port interface that return a boolean always true, the adapter will make the queries to the database to check that
      2. for simplicity, I use autoincrement ids, I rather prefer uuids and have ids only on the adapterModel of the database for performance
      3. I am not sure about the enums in carModels because if you need to add other car model you wil need to do it by code in the other hand you need to write the models and brands names quite often and if we don't do it we need to hardcode somewhere, We should think more in this issue
      4. I notice calling car to our model will be a problem, because are not car ar carStocks. when you want to have variables to each particular car will need the name car. So I'm going to refactor to carStock
3. Implementing the tests of the use cases and then the use cases
   1. I use quite specific ports to simplify the logic. we should make them more generic, for example in searches we could implement filters to use a generic search motor
   2. I can see other core problems
      1. CreateBooking
         1. In the use case we check that the client don't have more bookings for that dates and the available stock for that dates but we will need to take care on the adapter to lock the tables before create a new booking because concurrency. we could have problems, so we could lock booking table, check the stock, create the booking and unlock the tables