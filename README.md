# HelpscoutSpark

An Helpscout integration package for [Laravel Spark](https://spark.laravel.com/) that allows you to add information about tickets created by customers in Helpscout. 

It includes two separate functions:
1. It adds an endpoint for a [Helpscout Dynamic App](https://developer.helpscout.com/custom-apps/dynamic/) to display information about the user's billing plan and historical data.
2. It accepts webhooks from Helpscout and processes them based on rules that you set up. By default, it will tag each new ticket with the user's current billing plan.

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

```HS_SPARK_CUSTOM_APP_SECRET=xxxxxx```

## Configuration - Webhook Rules

Create a new app in Helpscout (under My Apps), and add the following keys in your .env file:

```
HS_AUTH_TYPE=client_credentials
HS_APP_ID=xxx 
HS_APP_SECRET=xxx
```

Then, create a new webhook for the endpoint:

```/helpscout-spark-app/webhooks```

and add your secret key in your .env file:

```
HS_SPARK_WEBHOOK_SECRET=xxx
```

## Usage

Out of the box, you will have a custom app with the user's current billing plan and other customer data on each ticket, and the webhook will add a tag for the user's current billing plan to each ticket that is created.

It is simple to add your own information to either the custom app or new rules to handle Helpscout webhooks.

## Add Custom App Items

To add more items to the custom app, simply copy the `KeithBrink/HelpscoutSpark/CustomAppData/Items/Plan`, including extending the `BaseItem` and implementing the `ItemContract`. 

Change the `getValue` and `getName` function to whatever you like.

Then, add your rule in your `AppServiceProvider` register function:

```
\KeithBrink\HelpscoutSpark\CustomAppData\Items::$items[] = YourItem::class;
```

## Add Webhook Rule

To add another webhook rule, simply copy the `KeithBrink/HelpscoutSpark/WebhookRules/Rules/TagConversationWithPlan`, including extending the BaseRule and implementing the RuleContract. 

The `parseWebhook` function accepts the webhook, here you should set any properties that you will need from the webhook.

Then, handle the webhook, including interacting with the Helpscout API if necessary, in the `handle` function.

Then, add your rule in your `AppServiceProvider` register function:

```
\KeithBrink\HelpscoutSpark\WebhookRules\Rules::$rules[] = YourRule::class;
```

## License

HelpscoutSpark is licensed under [The MIT License (MIT)](LICENSE).
