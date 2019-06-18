<?php

namespace KeithBrink\HelpscoutSpark\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use KeithBrink\HelpscoutSpark\CustomAppData\Items;
use HelpScout\Api\Webhooks\IncomingWebhook;
use HelpScoutApp\DynamicApp;
use KeithBrink\HelpscoutSpark\WebhookRules\Rules;
use Illuminate\Http\Request;

class HelpscoutController extends BaseController
{
    public function getCustomAppData()
    {
        $helpscout = new DynamicApp(config('helpscout-spark.custom_app_secret'));
        if ($helpscout->isSignatureValid()) {
            $customer = $helpscout->getCustomer();

            $list_items = Items::getItems($customer->getEmail());

            $html = '<h4><a href="'.config('app.url').'">'.config('app.name').'</a></h4>
            <ul class="c-sb-list c-sb-list--two-line">
                '.$list_items.'
            </ul>';        

            return response()->json([
                'html' => $html,
            ]);
        } else {
            return response('Unauthorized', 403);
        }
    }

    public function handleWebhooks(Request $request)
    {
        $webhook = IncomingWebhook::makeFromGlobals(config('helpscout-spark.webhook_secret'));
        
        Rules::processRules($webhook);

        return response('Webhook processed');
    }

}
