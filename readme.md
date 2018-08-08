## About this project

This application is a reach calculator for tweets.

Given a tweet with X retweets, each of those retweets retweeted by people with A,B,C.. followers, reach will be:
reach = X + A,B,C.. 

For instance if a tweet has been retweeted 3 times.

The first time by someone with 2 followers.

The second time by someone with 3 followers.

The third time by someone with 4 followers.

Then the expected reach is 12.

## Usage

1. Clone
2. Composer install
3. Copy .env.example to .env
4. Fill twitter credentials
5. Execute the command

The command is available in artisan. Syntax:

    php artisan reach:calculate <url>
    
The url is expected to be from a twitter's tweet. For example:
https://twitter.com/Subnautica/status/956243254122442752

## Testing

There are 27 tests with 24 assertions, all green.

## To dos

This project could be extended in many ways, the most significant adding pagination to the repositories and the client so they can handle requests with higher amout of followers and retweeters than the twitter api offers in a single request. 
