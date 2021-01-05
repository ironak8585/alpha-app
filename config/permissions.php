<?php

$permisssions = [

    //Master
    ["master_diamonds_properties", "web", "Manage Diamond Properties"],
    ["master_countries_write", "web", "Manage Countries"],
    ["master_countries_read", "web", "Read Countries"],
    ["master_categories_write", "web", "Manage Categories"],
    ["master_categories_read", "web", "Read Categories"],
    ["master_configurations_write", "web", "Manage Configurations"],
    ["master_configurations_read", "web", "Read Configurations"],

    //User
    ["permissions_manage", "web", "Manage Permissions"],
    ["roles_manage", "web", "Manage Roles"],
    ["users_manage", "web", "Manage Users"],
    ["user_profile", "web", "Update User Profile"],

];

return $permisssions;
