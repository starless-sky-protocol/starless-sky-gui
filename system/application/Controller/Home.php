<?php
namespace Controller;

use Inphinit\Viewing\View;

class Home
{
    public function index()
    {
        View::render('layout.main-card', array(
            "title" => "Welcome",
            "view" => "index",
            "data" => [
                "card.title" => "Let's connect to an network"
            ]
        ));
    }

    public function identity()
    {
        View::render('layout.main-card', array(
            "title" => "Welcome",
            "view" => "identity",
            "data" => [
                "card.title" => "Import your identity below to use on this network"
            ]
        ));
    }

    public function createidentity()
    {
        View::render('layout.main-card', array(
            "title" => "Create Identity",
            "view" => "create-identity",
            "data" => [
                "card.title" => "Create a new identity",
                "card.size" => 8
            ]
        ));
    }

    public function importidentity()
    {
        View::render('layout.main-card', array(
            "title" => "Import Identity",
            "view" => "import-identity",
            "data" => [
                "card.title" => "Import your existing identity",
                "card.size" => 8
            ]
        ));
    }
}
