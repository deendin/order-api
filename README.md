# An API system to manage orders and product as a customer service admin and as a developer. 

### Problem Statement.

Provided that we have an XML file that contains orders and its products, the following are the implemented functionalities:

1. As a customer service admin, I need to be able view orders
2. As a developer, I need to be able to view and amend a specific order or all orders.

### Solution Notes.

To manage orders, this solution exposes three API endpoints which helps in managing the basic requirement of the problem statement:

- [x] `/orders` - `GET`
- [x] `/order/:id` - `GET`
- [x] `/order/:id` - `PUT`

1. Orders: `/orders` - To fetch all orders, a `GET` request is expected to be made to the orders endpoint which is simply a Rest API that returns a JSON response of all of the orders and products in the XML file. The below screenshot represents what the request and response data looks like when tested in postman.

<img width="1293" alt="image" src="https://github.com/deendin/order-api/assets/118926333/af01d11e-d37f-4aaf-86f8-b6ce6b8e8b2a">

2. Order Details: `/order/:orderID` - `GET`: In order to fetch a specific order details, this api endpoint returns a specific order with its own associated product data. The screenshot below shows the order object.

<img width="1276" alt="image" src="https://github.com/deendin/order-api/assets/118926333/9a6147cb-f69b-4723-a6a0-52d67f0cb2f5">

3. - Order Update: `PUT` To allow a developer to amend an order, this API endpoint (`/order/:orderID`) gives the ability to update order details such as the currency, amount and the product. The screenshot below is an example of what the request and response looks like with the request method been a PUT request.    

<img width="1307" alt="image" src="https://github.com/deendin/order-api/assets/118926333/031b482f-3d5e-469a-9ea3-081cab23dd24">

### How has this been done?

- I have leveraged on the use of PHP Object Oriented Programming which helps in abstracting, encapsulating and reusability of the business logic. For example, I have defined a dedicated class to handle the endpoints called `Route`. The Route class is the second entry point of the application after the index page.
- The index.php file is simply where the routes are defined which is then mapped to the Route file. From the route file, URL is accepted with the expected method and a closure which is used in mapping the route to the expected logic/repository method/action.
- For example, when a user wants to see all orders, the xml file is been read and handled using the built-in php `simplexml_load_file()` function. For every instance of the order object, the data/value is then parsed into a dedicated Order Model and Product model for ease of use.
- When the result is fetched, a JSON response is returned with the appropriate status code.

## Getting started and Tooling

Before setting up this repository, the following are the dependencies that needs to be available on your machine:

### Tooling

- [Composer] for dependency management.
- PHP (I have PHP 8.3.0 installed on my machine)


## Setup & Instruction for the backend:
1. Clone the repository: `git clone https://github.com/deendin/order-api.git`
2. Assuming that the Dependencies listed above are satisfied, you can ```cd``` into the directory called ```order-api.git```
4. Run `composer install` to install the project dependencies.
5. In the `order-api` directory run `php -S localhost:8000` to start the application.

## Instruction and testing for the frontend:

1. Navigate to the served url `http://localhost:8000/orders` or `http://localhost:{port}/orders` as the case may be.
2. You should automatically see the orders response in the browser since this is GET request. A postman may be required to interact with the ammendment (`PUT`) endpoint

## Example Input
<img width="1312" alt="image" src="https://github.com/deendin/order-api/assets/118926333/588509ba-4c91-41bc-95a0-12037ac2bdc8">


## Example Output

<img width="1335" alt="image" src="https://github.com/deendin/order-api/assets/118926333/8833891c-d16a-4733-a986-cfcde9d1965c">


## What I could have done better if I had more time (Mostly out of the task specification):

1. Extend the logic to be able to fetch and read data from a data provider or repository.
2. Lint to lint the files.
3. Handle validation to validate order exist before updating.
4. Dockerize the system for environment compatibility and ease of use/setup.
5. Have a dedicated class for Transformers to transform HTTP responses with a consistent response object accross the endpoints.