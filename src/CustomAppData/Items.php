<?php

namespace KeithBrink\HelpscoutSpark\CustomAppData;

use KeithBrink\HelpscoutSpark\CustomAppData\Items\Plan;

class Items {

    public static $items = [
        Plan::class,
    ];
    
    public static function getItems($user_email) {
        $html = '';
        foreach(self::$items as $item_class) {
            $item = new $item_class($user_email);
            $html .= $item->getHtml();
        }
        return $html;
    }
}