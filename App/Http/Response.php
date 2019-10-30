<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tightenco\Collect\Support\Collection;

//Garbage CMS response using Symfonys response class
class Response extends SymfonyResponse {

    public function __construct($content = '', $status = 200, $headers = []) {
        parent::__construct($content, $status, $headers);
    }

    public function blade($name, $vars=[]) {
        $this->headers->set('content-type', 'text/html');
        $this->setContent(blade($name, $vars)->render());

        return $this;
    }
    
    public function json($json) {
        $this->headers->set('content-type', 'application/json');
        $this->setContent(json_encode($json));

        return $this;
    }

    public function send() {
        if(count($_POST) > 0) {
            session()->flash('_POST_OLD', collect($_POST)->except(['password','_token','_method'])->toArray());
        }
        return parent::send();
    }
}