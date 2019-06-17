<?php

namespace KeithBrink\HelpscoutSpark\Data;

interface DataContract {

    /**
     * The title of the data, such as "Subscription"
     */
    public function getName();

    /**
     * The value of the data, such as "Enterprise".
     */
    public function getValue();

}