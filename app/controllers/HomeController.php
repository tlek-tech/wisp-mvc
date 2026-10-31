<?php

class HomeController extends Controller {
    public function index($req) {
        return $this->view('home', [
            'title' => 't-lek tech. | นวัตกรรม ประสิทธิภาพ ความทันสมัย AI-technologies'
        ]);
    }
}
