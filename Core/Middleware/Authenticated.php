<?php

namespace Core\Middleware;

class Authenticated {
    public function handle()
    {
        //handle() determines if a request can further continue to the core of the application
        if(! $_SESSION['user'] ?? false){
            redirect('/');
        }
    }
}

?>
