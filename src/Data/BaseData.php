<?php

namespace KeithBrink\HelpscoutSpark\Data;

class BaseData
{
    public $user_email;
    public $is_badge = false;
    public $colour = '';

    public function __construct(string $user_email)
    {
        $this->user_email = $user_email;
    }

    public function setAsBadge()
    {
        $this->is_badge = true;
    }

    public function getHtml()
    {
        $span_class = 'c-sb-list-item__text';
        if($this->is_badge) {
            $span_class .= ' badge';
        }
        if($this->colour) {
            $span_class .= ' ' . $this->colour;
        }
        $html = '<li class="c-sb-list-item">
            <span class="c-sb-list-item__label">
            '.$this->getTitle().'
            <span class="'.$span_class.'">'.$this->getValue().'</span>
            </span>
        </li>';
        return $html;
    }
}