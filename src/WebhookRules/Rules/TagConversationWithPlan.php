<?php

namespace KeithBrink\HelpscoutSpark\WebhookRules\Rules;

use KeithBrink\HelpscoutSpark\WebhookRules\BaseRule;
use KeithBrink\HelpscoutSpark\WebhookRules\RuleContract;
use HelpScout\Api\Tags\Tag;
use Laravel\Spark\Spark;

class TagConversationWithPlan extends BaseRule implements RuleContract {

    public $conversation_id;
    public $customer_email;
    public $tags;

    public function __construct()
    {
        $this->webhook_types = [
            'convo.created',
        ];
    }

    public function parseWebhook($webhook)
    {
        $obj = $webhook->getDataObject();
        $this->conversation_id = $obj->id;
        $this->customer_email = $obj->customer->email;
        $this->tags = $obj->tags;
    }

    public function handle()
    {
        $client = app('helpscout');
        $conversation = $client->conversations()->get($this->conversation_id);
        $user = Spark::user()->where('email', $this->customer_email)->first();
        if($user) {
            $tag_name = $this->removeInterval($user->current_billing_plan);
            
            $tags = $this->tags;
            $tags[] = $tag_name;

            $client->conversations()->updateTags($this->conversation_id, $tags);
        }            
    }

    public function removeInterval($plan_name)
    {
        $plan_name = str_replace('-monthly', '', $plan_name);
        $plan_name = str_replace('-yearly', '', $plan_name);
        $plan_name = str_replace('-annual', '', $plan_name);
        return $plan_name;
    }
}