Amazon Notifier
===============

Provides [Amazon SNS](https://aws.amazon.com/en/sns/) integration for Symfony Notifier.

DSN example
-----------

```
AMAZON_SNS_DSN=sns://ACCESS_ID:ACCESS_KEY@default?region=REGION
```

Adding Options to a Chat Message
--------------------------------

With an Amazon SNS Chat Message, you can use the `AmazonSnsOptions` class to add
message options.

```php
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Bridge\AmazonSns\AmazonSnsOptions;

$chatMessage = new ChatMessage('Contribute To Symfony');

$options = (new AmazonSnsOptions('topic_arn'))
    ->subject('subject')
    ->messageStructure('json')
    // ...
    ;

// Add the custom options to the chat message and send the message
$chatMessage->options($options);

$chatter->send($chatMessage);
```

Resources
---------

 * [Contributing](https://symfony.com/doc/current/contributing/index.html)
 * [Report issues](https://github.com/symfony/symfony/issues) and
   [send Pull Requests](https://github.com/symfony/symfony/pulls)
   in the [main Symfony repository](https://github.com/symfony/symfony)
