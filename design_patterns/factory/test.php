<?php

include_once 'load.php';

new Test();

Class Test {

    private $load;

    public function __construct() {
        $this->load = new Load();

        $user = $this->load->controller('user');
        $user->hola('Carlos');
        print '<br>';
        $post = $this->load->controller('post');
        $post->post();
    }

}
