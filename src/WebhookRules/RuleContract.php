<?php

namespace KeithBrink\HelpscoutSpark\WebhookRules;

interface RuleContract {
    public function handle();
    public function parseWebhook($webhook);
}