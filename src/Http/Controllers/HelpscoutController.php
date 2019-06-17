<?php

namespace KeithBrink\HelpscoutSpark\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use KeithBrink\HelpscoutSpark\Data\Items;
use HelpScoutApp\DynamicApp;

class HelpscoutController extends BaseController
{
    public function getTicketData()
    {
        $helpscout = new DynamicApp(config('helpscout-spark.api_key'));
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

}
