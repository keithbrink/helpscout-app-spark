# HelpscoutSpark

An Helpscout integration package for [Laravel Spark](https://spark.laravel.com/) that allows you to add information about tickets created by customers in Helpscout. 

It includes two separate functions:
1. It adds an endpoint for a [Helpscout Dynamic App](https://developer.helpscout.com/custom-apps/dynamic/) to display information about the user's billing plan and historical data.
2. It accepts webhooks from Helpscout to add custom tags to tickets based on rules that you set up.

## Installation

This version requires [PHP](https://php.net) 7, and supports Laravel 5.5+ and Spark 5+.

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

```
$ composer require keithbrink/helpscout-app-spark
```

## Configuration - Custom App

Create a custom app in Helpscout, and point the callback URL to your app URL + the following endpoint:

```/helpscout-spark-app/custom-app```

Add the secret key for the custom app in your .env file:

```HELPSCOUT_SPARK_API_KEY=xxxxxx```

## Usage

TODO

## License

HelpscoutSpark is licensed under [The MIT License (MIT)](LICENSE).
