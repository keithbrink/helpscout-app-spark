<?php

namespace KeithBrink\HelpscoutSpark\WebhookRules;

use KeithBrink\HelpscoutSpark\WebhookRules\Rules\TagConversationWithPlan;

class Rules {

    public static $rules = [
        TagConversationWithPlan::class,
    ];

    public static function processRules($webhook)
    {
        foreach(self::$rules as $rule_class) {
            $rule = new $rule_class();
            if(in_array($webhook->getEventType(), $rule->webhook_types)) {
                $rule->parseWebhook($webhook);
                $rule->handle();
            }
        }
    }
}