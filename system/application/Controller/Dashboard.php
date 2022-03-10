<?php

namespace Controller;

use Inphinit\Viewing\View;

class Dashboard
{
    public function messages()
    {
        View::render('layout.dashboard', array(
            "title" => "Messages",
            "view" => "dashboard/messages",
            "data" => [
                "title" => "",
                "selected-tab" => "messages",
                "max-vh" => true,
                "full-screen" => true,
                "show-header" => false
            ]
        ));
    }

    public function newmessage()
    {
        View::render('layout.dashboard', array(
            "title" => "Compose message",
            "view" => "dashboard/compose",
            "data" => [
                "title" => "Compose message",
                "selected-tab" => "new-message",
                "max-vh" => true,
                "full-screen" => true,
                "show-header" => false
            ]
        ));
    }

    public function validate()
    {
        View::render('layout.dashboard', array(
            "title" => "Validate Transactions",
            "view" => "dashboard/view-transactions",
            "data" => [
                "selected-tab" => ""
            ]
        ));
    }

    public function publicInfo()
    {
        View::render('layout.dashboard', array(
            "title" => "Public Information",
            "view" => "dashboard/config/public-info",
            "data" => [
                "selected-tab" => "settings.public-info"
            ]
        ));
    }

    public function keys()
    {
        View::render('layout.dashboard', array(
            "title" => "My Keys",
            "view" => "dashboard/config/keys",
            "data" => [
                "selected-tab" => "settings.keys"
            ]
        ));
    }
}
