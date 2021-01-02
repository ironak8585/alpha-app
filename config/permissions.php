<?php

$permisssions = [


    //Master
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
