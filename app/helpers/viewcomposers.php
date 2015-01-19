<?php

View::composer( 'includes.sidebar', function ( $view ) {

    if (Route::getCurrentRoute()->getName() == 'entry_detail')
        $limit = 4;
    else
        $limit = 7;

    $query = EntryLog::with('user', 'entry', 'action')->orderBy( 'id', 'desc' )->limit($limit);

    // limit changelog to own entries if no permission to see all entries
    if (!Auth::user()->can('entry_view')) {
        $query = $query->whereHas('entry', function($q) {
            $q->where('user_id', Auth::user()->id);
        });
    }

    // when in entry detail view, we only show actions related to that single item
    if (Route::getCurrentRoute()->getName() == 'entry_detail') {
        $viewData = $view->getData();
        $query->where( 'entry_id', $viewData['entry']->id );
    }

    return $view->with( 'logEntries', $query->get() );
} );

View::composer('includes.redmineInfo', function ($view) {

    $redmine = new RedmineAPI();
    $ticketId = $view->entry->ticket_id;
    if (is_null($ticketId) || empty($ticketId))
        return $view->with('ticketInfo', null);
    else
        return $view->with('ticketInfo', $redmine->getTicket($ticketId));
});