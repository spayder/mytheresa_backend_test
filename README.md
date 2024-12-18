## Simple API endpoint to show /products

### How to run the project on local environment (docker dependency):
1. Build and run the project
   ``make run``
2. Generate secret key
   ``make key-generate``
3. copy .env.example .env in ``src`` directory


The application is listening on port ``8085`` so the app full url is: ``localhost:8085``

The only endpoint is ``/products`` url, and we can paginate and apply some filters like:
``/products?category=boots&priceLessThan=100&page=2`` although by default there is 5 items per page

To run the tests, just execute:
``make test``