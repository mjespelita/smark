<?php

namespace Smark\Smark;

use App\Models\Activities;

class Logging
{
    public static function log($userid, $name, $activity)
    {
        return Activities::create([
            'userid' => $userid,
            'name' => $name,
            'activity' => $activity
        ]);
    }
}
