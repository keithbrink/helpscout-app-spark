<?php

namespace KeithBrink\HelpscoutSpark\WebhookRules\Rules;

use KeithBrink\HelpscoutSpark\WebhookRules\BaseRule;
use KeithBrink\HelpscoutSpark\WebhookRules\RuleContract;
use HelpScout\Api\Tags\Tag;
use Laravel\Spark\Spark;

class TagConversationWithPlan extends BaseRule implements RuleContract {

    public $conversation_id;

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
    }

    public function handle()
    {
        $client = app('helpscout');
        $conversation = $client->conversations()->get($this->conversation_id);
        $customer = $conversation->getPrimaryCustomer();
        $user = Spark::user()->where('email', $customer->getEmail())->first();
        if($user) {
            $tag_name = ucfirst($this->removeInterval($user->current_billing_plan));
            $tag = new Tag;
            $tag->setName($tag_name);
            $conversation->addTag($tag);
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