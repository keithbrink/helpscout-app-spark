<?php

namespace KeithBrink\HelpscoutSpark\Data\Items;

use Laravel\Spark\Spark;
use KeithBrink\HelpscoutSpark\Data\DataContract;
use KeithBrink\HelpscoutSpark\Data\BaseData;

class Plan extends BaseData implements DataContract {
    
    public function getName()
    {
        return 'Plan';
    }

    public function getValue()
    {
        $user = Spark::user()->where('email', $this->user_email)->first();
        if($user) {
            return ucfirst($this->removeInterval($user->current_billing_plan));
        } else {
            return 'Unknown';
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