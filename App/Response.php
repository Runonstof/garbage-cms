<?php

namespace App;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

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
}