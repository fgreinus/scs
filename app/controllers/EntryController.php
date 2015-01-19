<?php

class EntryController extends BaseController
{
	public function overview()
	{
        $queries = Entry::with('category', 'database')
            ->orderBy('id', 'desc');

        // limit to own entries if no permission to view all entries
        if (!Auth::user()->can('entry_view')) {
            $queries = $queries->where( 'user_id', Auth::user()->id );
        }

        $queries = $queries->paginate(15);

		return View::make('pages.entry.overview', [
            'queries' => $queries
		]);
	}

    public function detail($id)
    {
        $entry = Entry::where('id', $id)
            ->with('category', 'database')
            ->firstOrFail();

        // entry created by user or user has permission to view all entries - otherwise we say no
        if (!Auth::user()->can('entry_view') && $entry->user->id != Auth::user()->id)
            App::abort(403, 'No access to this entry.');

        // get all available states
        $states = EntryState::all();
        $userList = User::all();
        $databases = EntryDatabase::orderBy( 'name', 'asc' )->get();
        $categories = EntryCategory::orderBy( 'name', 'asc' )->get();

        $types = [ ];
        // group databases by type
        foreach ($databases as $database) {
            if (!array_key_exists( $database->type, $types )) {
                $types[$database->type] = [ ];
            }

            $types[$database->type][] = $database;
        }

        $olderEntry = Entry::where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();
        $newerEntry = Entry::where('id', '>', $id)
           ->orderBy('id', 'asc')
           ->first();

        return View::make('pages.entry.detail', [
            'redmineInfoEnabled' => true,
            'entry' => $entry,
            'states' => $states,
            'userList' => $userList,
            'databasesByType' => $types,
            'categories' => $categories,
            'olderUrl' => $olderEntry ? route('entry_detail', $olderEntry->id) : '',
            'newerUrl' => $newerEntry ? route('entry_detail', $newerEntry->id) : '',
            'canEdit' => (Auth::user()->id == $entry->user->id) || Auth::user()->can('entry_edit'),
            'canManage' => Auth::user()->can('entry_manage') ,
            'canDelete' => (Auth::user()->id == $entry->user->id) || Auth::user()->can('entry_delete')
        ]);
    }

	public function create()
	{
        if (!Auth::user()->can('entry_create'))
            App::abort(403, 'Not allowed to create new entries.');

        $databases = EntryDatabase::orderBy('name', 'asc')->get();
        $categories = EntryCategory::orderBy('name', 'asc')->get();
        $authors = User::orderBy('username', 'asc')->get();

        $types = [];
        // group databases by type
        foreach ($databases as $database)
        {
            if (!array_key_exists($database->type, $types))
                $types[$database->type] = [];

            $types[$database->type][] = $database;
        }

		return View::make('pages.entry.create', [
            'databasesByType' => $types,
            'categories' => $categories,
            'authors' => $authors
        ]);
	}

    public function doCreate()
    {
        if (!Auth::user()->can('entry_create')) {
            App::abort(403, 'Not allowed to create new entries.');
        }

        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        $data['state_id'] = EntryState::where('code', 'new')->firstOrFail()->id;

        $validator = Validator::make($data, Entry::$rules);
        if ($validator->fails())
        {
            return Redirect::route('entry_create')->withErrors($validator->messages());
        }

        /** @var Entry $entry */
        $entry = Entry::create($data);

        EntryLog::create( [
            'action_id'      => EntryAction::where( 'code', 'create' )->first()->id,
            'note'           => 'Entry has been created.',
            'database_id'    => $entry->database->id,
            'category_id'    => $entry->category->id,
            'queries'        => $entry->queries,
            'revert_queries' => $entry->revert_queries,
            'user_id'        => Auth::user()->id,
            'entry_id'       => $entry->id
        ] );

        return Redirect::route('entry_detail', $entry->id)->withErrors(['success' => 'Entry has been successfully created.']);
    }

    public function changeState($id, $state)
    {
        if (!Auth::user()->can('entry_manage')) {
            App::abort(403, 'Not allowed to change state of an entry');
        }

        /** @var Entry $entry */
        $entry = Entry::findOrFail($id);
        $state = EntryState::findOrFail($state);

        if (!Auth::user()->can('entry_edit') && Auth::user()->id != $entry->user->id)
            App::abort( 403, 'Not allowed to edit this entry.' );

        $oldState = $entry->state->name;

        $entry->state_id = $state->id;
        $entry->save();

        EntryLog::create([
            'action_id' => $state->action->id,
            'note' => 'Set state from '.$oldState.' to '.$state->name,
            'database_id' => $entry->database->id,
            'category_id' => $entry->category->id,
            'queries' => $entry->queries,
            'revert_queries' => $entry->revert_queries,
            'user_id' => Auth::user()->id,
            'entry_id' => $entry->id
        ]);

        return Redirect::route('entry_detail', $id);
    }

    public function save($id)
    {
        /** @var Entry $entry */
        $entry = Entry::findOrFail($id);
        if (!Auth::user()->can('entry_edit') && Auth::user()->id != $entry->user->id)
            App::abort( 403, 'Not allowed to edit this entry.' );

        $title = Input::get('title');
        /** @var User $author */
        $author = User::findOrFail(Input::get('author'));
        $database = EntryDatabase::findOrFail(Input::get('database_id'));
        $category = EntryCategory::findOrFail(Input::get('category_id'));
        $ticket_id = Input::get('ticket_id');
        $queries = Input::get('queries');
        $revert_queries = Input::get('revert_queries');

        $oldQueries = $entry->queries;
        $oldRevertQueries = $entry->revert_queries;
        $oldDatabaseId = $entry->database->id;
        $oldCategoryId = $entry->category->id;

        $updated = [];

        list($entry, $updated) = $this->updateField($entry, $updated, "ticket_id", $ticket_id, "ticket");
        list($entry, $updated) = $this->updateField($entry, $updated, "title", $title, "title");
        list( $entry, $updated ) = $this->updateField( $entry, $updated, "user_id", $author->id, "author" );
        list( $entry, $updated ) = $this->updateField( $entry, $updated, "database_id", $database->id, "database" );
        list( $entry, $updated ) = $this->updateField( $entry, $updated, "category_id", $category->id, "category" );
        list( $entry, $updated ) = $this->updateField( $entry, $updated, "queries", $queries, "queries" );
        list( $entry, $updated ) = $this->updateField( $entry, $updated, "revert_queries", $revert_queries, "revert-queries" );

        if (count($updated) > 0)
        {
            EntryLog::create( [
                'action_id'    => EntryAction::where( 'code', 'edit' )->first()->id,
                'note'         => 'Entry information has been updated (' . implode(", ", $updated) . ')',
                'database_id' => $oldDatabaseId,
                'category_id' => $oldCategoryId,
                'queries'        => $oldQueries,
                'revert_queries' => $oldRevertQueries,
                'user_id'      => Auth::user()->id,
                'entry_id'     => $entry->id
            ] );
            $entry->save();
        }

        return Redirect::route('entry_detail', $id);
    }

    public function remove($id)
    {
        /** @var Entry $entry */
        $entry = Entry::findOrFail($id);
        if (!Auth::user()->can( 'entry_edit' ) && Auth::user()->id != $entry->user->id)
            App::abort( 403, 'Not allowed to remove this entry.' );

        EntryLog::create([
            'action_id'    => EntryAction::where('code', 'delete')->first()->id,
            'note'         => 'Entry has been deleted',
            'database_id' => $entry->database->id,
            'category_id' => $entry->category->id,
            'queries'        => $entry->queries,
            'revert_queries' => $entry->revert_queries,
            'user_id'      => Auth::user()->id,
            'entry_id'     => $entry->id
        ]);
        $entry->delete();

        return Redirect::route('overview');
    }

    private function updateField($object, $updatedList, $keyName, $value, $updatedString)
    {
        if (!is_null($value) && $object->$keyName != $value)
        {
            $object->$keyName = $value;
            $updatedList[] = $updatedString;
        }

        return [$object, $updatedList];
    }
}
