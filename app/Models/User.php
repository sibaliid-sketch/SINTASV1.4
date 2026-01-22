<?php

namespace App\Models;

/**
 * User Model Proxy
 * 
 * This file serves as a proxy to the actual User model located in
 * App\Models\General\User to maintain compatibility with Laravel's
 * default User model location expected in config/auth.php
 * 
 * All functionality is handled by General\User
 */

use App\Models\General\User as BaseUser;

class User extends BaseUser
{
    // This class inherits all functionality from General\User
    // No additional code needed - it's a transparent proxy
}
