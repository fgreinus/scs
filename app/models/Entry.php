<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 17:23
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Entry extends Eloquent
{
    use SoftDeletingTrait;

    protected $fillable = ['title', 'queries', 'revert_queries', 'ticket_id', 'database_id', 'category_id', 'state_id', 'user_id'];

    protected $dates = ['deleted_at'];

    protected $table = 'entries';

    public static $rules = [
        'title' => 'required|max:100',
        'queries' => 'required',
        'ticket_id' => 'numeric',
        'database_id' => 'required|numeric|exists:entrydatabases,id',
        'category_id' => 'required|numeric|exists:entrycategories,id',
        'state_id' => 'required|numeric|exists:entrystates,id',
        'user_id' => 'required|numeric|exists:users,id'
    ];

    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function entryLogs()
    {
        return $this->hasMany( 'EntryLog', 'id', 'entry_id' );
    }

    public function state()
    {
        return $this->belongsTo( 'EntryState', 'state_id', 'id' );
    }

    public function category()
    {
        return $this->belongsTo( 'EntryCategory', 'category_id', 'id' );
    }

    public function database()
    {
        return $this->belongsTo( 'EntryDatabase', 'database_id', 'id' );
    }
}
