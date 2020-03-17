<?php

namespace KeithBrink\HelpscoutSpark\CustomAppData\Items;

use KeithBrink\HelpscoutSpark\CustomAppData\BaseItem;
use KeithBrink\HelpscoutSpark\CustomAppData\ItemContract;
use Laravel\Spark\Spark;

class StripeLink extends BaseItem implements ItemContract
{
    public function getName()
    {
        return 'Stripe Link';
    }

    public function getValue()
    {
        $user = Spark::user()->where('email', $this->user_email)->first();
        if (Spark::$billsTeams) {
            $stripe_id = $user->currentTeam()->stripe_id;
        } else {
            $stripe_id = $user->stripe_id;
        }

        if ($user) {
            return '<a href="https://dashboard.stripe.com/customers/'.$stripe_id.'">'.$stripe_id.'</a>';
        } else {
            return 'Unknown';
        }
    }
}
