# Drift PHP

## Installation
The SDK can be installed with Composer by adding this library as a dependency to your composer.json file:

```json
{
    "require": {
        "typhonius/drift-php": "^0.0.1"
    }
}
```

Alternatively on the command line by using:

`composer require typhonius/drift-php`

## Simple usage
Basic usage examples for the SDK.

```php
<?php

require 'vendor/autoload.php';

use Drift\Client\Client;
use Drift\Endpoints\Accounts;
use Drift\Endpoints\Contacts;
use Drift\Endpoints\Conversations;
use Drift\Endpoints\Users;
use Drift\Models\MessageModel;

$token = 'D5UfO/4FfNBWn4+0cUwpLOoFzfP7Qqib4AoY+wYGsKE=';
$client = new Client($token);

$account      = new Accounts($client);
$contact      = new Contacts($client);
$conversation = new Conversations($client);
$user         = new Users($client);

// Get all accounts.
$accounts = $account->getAll();

// Get a specific contact by contact ID.
$specific = $contact->get($contactId);

// Create a new message for a conversation
$rawMessage = [
    'userId' => 12345,
    'body' => 'o hai',
    'type' => 'chat',
];
$message = new MessageModel((object) $rawMessage);
$conversation->sendMessage($conversationId, $message);

// Get all meetings between now and 30 days from now
$now = round(microtime(true) * 1000);
$future = round(microtime(true) * 1000) + 2592000000;
$meetings = $user->getMeetings($now, $future)

// Create a timeline event
$microtime = round(microtime(true) * 1000);
$event = [
    'event' => 'New External Event from <your app>',
    'createdAt' => $microtime,
    'contactId' => 1115142980
];
$contacts = new Contacts($client);
$contacts->createTimelineEvent($event);
```


## Detailed usage
TBC