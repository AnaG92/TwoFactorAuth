## Context

The premisses for this project are:
- The user exists in the database
- The user has a unique username

The project is a set of four views, where you will be able to create a TOTP secret key and use it as part of a two-factor authentication process.

The first view will allow you to set a label against your username, if this username is not set in database or is not correct, the view won't let you continue to the next step.

From there we will generate the TOTP secret, combine this with the label and the username into a QR code that the user can scan for a TOTP 6 digit code.  
When the user is ready to insert the code, the next page can be accessed where the username and code can be entered, the user will be verified based on the username and the code will be verified.

Validation success will result in the success page, indicating success. Otherwise the view will warn the user that the code entered is not correct.


## Implementation  

I have implemented this feature by using the Fortify package from the Laravel ecosystem.

In terms of styles I've added Boostrap 5 to be able to add some basic styling as it's the one I have the most experience with.

I chose the Laravel Fortify package to implement the two-factor authentication over the alternatives because it's part of Laravel's ecosystem.  

The drawback of installing this package is that I haven't used all it's features or potential, because I have not built the full user registration and login systems.  
If I had more time I would have added a full login system with two-factor authentication, which would have used more elements of the package.

I've kept the database logic in a repository, this means if this project is extended in the future and I decide to use a different database I would be able to make the changes in just one place.  

To keep the business logic separated from the controller, I have put all interactions with the Fortify package in a service. This also helps to be able to fake some data for the tests.

I have added some feature tests to check the request cycle responds as expected.  
And added some unit tests for the things that could not be tested with a feature test.

## Setup  

#### Requirements
You will need the following in order to run this project:
- Git
- PHP8
- Composer
- Node
- NPM

#### Clone the repository and setup env file
- Run `git clone git@github.com:AnaGema/upmind.git`
- Copy `.env.example` to `.env`
- Ensure the `DB_CONNECTION` is set to `sqlite`
- Ensure the `DB_DATABASE` is the full path to the sqlite file

#### Install dependencies
- Run `composer install` to install all composer packages and dependencies.
- Run `npm install` to install all JavaScript packages and dependencies.

#### Run  migrations and seed data
- Run `php artisan migrate:fresh --seed` this will make sure all your migrations are in place and the seeders are ran.

#### Running the tests
- Run `php artisan test`

#### Serve the application
- Run `npm run build` this will compile the frontend.
- Run `php artisan serve` this will start the server and tell you where is running.
- Visit the URL shown in the terminal.

#### Using the application
A valid username to use is `upmind-user`.
