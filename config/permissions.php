<?php

$permisssions = [
    //User
    ["permissions_manage", "web", "Manage Permissions"],
    ["roles_manage", "web", "Manage Roles"],
    ["users_manage", "web", "Manage Users"],
    ["user_profile", "web", "Update User Profile"],

    //Master
    ["master_configurations_write", "web", "Manage Configurations"],
    ["master_configurations_read", "web", "Read Configurations"],

];

return $permisssions;
