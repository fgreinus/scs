<?php
HTML::macro('menu_active', function($routeName) {

    if (Route::current()->getName() == $routeName)
        return ' class="active"';
    else
        return '';

});

HTML::macro('time_elapsed', function($timestamp) {

    $ago = DateTime::createFromFormat('Y-m-d H:i:s', $timestamp);
    $now = new DateTime("now");

    $output = "<span data-toggle='tooltip' data-original-title='".$timestamp."'>";

    $time_diff = ( $now->format( "U" ) - $ago->format( "U" ) );
    if ( $time_diff > 86400 ) {
        $days = round( $time_diff / 86400 );

        $output .= $days . ( $days != 1 ? " days" : " day" );
    } else if ( $time_diff > 3600 ) {
        $months = round( $time_diff / 3600 );

        $output .= $months . ( $months != 1 ? " hours" : " hour" );
    } else {
        $days = round( $time_diff / 60 );

        $output .= $days . ( $days != 1 ? " minutes" : " minute" );
    }

    return $output . "</span>";

});

HTML::macro('username', function ($userId, $userName = null, $userColor = null) {

    if (is_null($userName) || is_null($userColor)) {
        /** @var User $user */
        $user = Cache::remember('user_'.$userId, 60, function () use ($userId) {
            return User::where('id', $userId)->with('roles')->first();
        });

        if ($user) {
            $userName = $user->username;
            if (count($user->roles) > 0) {
                $role = $user->roles[0];
                if ($role) {
                    $userColor = $role->color;
                }
            }
        }
    }

    return "<a href='".URL::route('search', ['user' => $userName])."' style='color:".$userColor."'>".$userName."</a>";
});

HTML::macro('actionLabel', function($actionId) {

    $action = Cache::remember('action_'.$actionId, 60, function() use ($actionId) {
        return EntryAction::find($actionId);
    });

    return '<span class="label label-'.$action->color.'">'.$action->name.'</span>';
});

HTML::macro('stateLabel', function ($stateId) {

    $state = Cache::remember('state_' . $stateId, 60, function () use ($stateId) {
        return EntryState::find($stateId);
    });

    return '<span class="label label-' . $state->color . '">' . $state->name . '</span>';
});