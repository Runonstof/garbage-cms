<?php

return [
    "name_en" => "English",
    "name" => "English",
    "code" => "nl",
    "strings" => [

        //=============================
        //
        //
        //=============================
        "install.title" => "Garbage CMS Installation",
        "install.text" => [
            "Garbage CMS has not been configured, let's go do that.",
        ],

        //General message
        "install.error.title" => "Something went wrong.",
        "install.error.text" => [
            "Please try again later, if you're still experiencing problems, contact the admin."
        ],

        //Database not exists
        "install.error.database.not_exists.title" => "Database not found",
        "install.error.database.not_exists.text" => [
            "No database found with name '{0}'.",
            "To fix this please create a new database with this name",
            "Or configure another name"
        ],

        //Create admin account install page
        "install.text.email" => [
            "To begin we need to create an admin account, you can add more later.",
            "Which email do you want to use?"
        ],
        "install.input.email" => "Email: ",
        "install.input.email.placeholder" => "someone@example.com",
        "install.text.password" => "Choose a password.",
        "install.input.password" => "Password: ",
        "install.text.database" => [
            "We need to install the database structure",
            "Click install to start the initialization"
        ],
        "install.text.database.submit" => "Install"
    ]
];