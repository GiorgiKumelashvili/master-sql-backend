<?php

namespace app\core\Http;

class Http {
    public static Http $app;
    private Request $request;
    private Response $response;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();

        self::$app = $this;
    }

    public function request(): Request {
        return $this->request;
    }

    public function response(): Response {
        return $this->response;
    }
}