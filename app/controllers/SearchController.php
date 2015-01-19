<?php

class SearchController extends BaseController {

    public function index() {

        if (Input::has('user')) {

            // dat eager loading :3
            $user = User::where('username', Input::get('user'))
                ->with('entries', 'entrylogs', 'entries.database', 'entries.category', 'entrylogs.entry.database', 'entrylogs.entry.category')
                ->orderBy('updated_at', 'DESC')
                ->firstOrFail();
            $entries = $user->entries;
            $entryLogs = $user->entrylogs;
            $query = 'user:'.Input::get('user');

        } else {
            $query = Input::get('q');
            $entries = Entry::with('database', 'category')
                ->where('queries', 'like', '%'.$query.'%')
                ->orWhere('revert_queries', 'like', '%'.$query.'%')
                ->orWhere('title', 'like', '%'.$query.'%')
                ->orWhere('ticket_id', $query)
                ->orderBy('updated_at', 'DESC')
                ->get();

            $entryLogs = EntryLog::with('entry', 'entry.database', 'entry.category')
                ->where('entrylogs.note', 'like', '%'.$query.'%')
                ->orWhere('entrylogs.queries', 'like', '%' . $query . '%')
                ->orWhere('entrylogs.revert_queries', 'like', '%' . $query . '%')
                ->orderBy('entrylogs.updated_at', 'DESC')
                ->get();

        }

        return View::make('pages.search.index', [
            'entries' => $entries,
            'entryLogs' => $entryLogs,
            'query' => $query,
            'success' => (count($entries) > 0 || count($entryLogs) > 0)
        ]);
    }

}