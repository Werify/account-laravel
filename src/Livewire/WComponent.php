<?php

namespace Werify\Account\Laravel\Livewire;

use Livewire\Component as BaseComponent;

class WComponent extends BaseComponent
{
    public $user = [];

    public $user_id = null;

    public function mount(...$args)
    {
        $this->user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
        if ($this->user != null && array_key_exists('id', $this->user)) {
            $this->user_id = $this->user['id'];
        }
    }
}