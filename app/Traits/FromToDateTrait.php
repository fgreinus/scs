<?php
namespace App\Traits;


use Carbon\Carbon;

trait FromToDateTrait
{

    public function getToAttribute($value)
    {
        $timestamp = strtotime($value);
        if($timestamp > 0) {
            return date('d.m.Y', $timestamp);
        }
        return '';
    }

    public function getFromAttribute($value)
    {
        $timestamp = strtotime($value);
        if($timestamp > 0) {
            return date('d.m.Y', $timestamp);
        }
        return '';
    }

    public function setToAttribute($value)
    {
        $this->attributes['to'] = date('Y-m-d', strtotime($value));
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = date('Y-m-d', strtotime($value));
    }

    public function getDateDiffAttribute()
    {
        if (empty($this->to))
            return '';

        $from = Carbon::createFromFormat('d.m.Y', $this->from);
        $to = Carbon::createFromFormat('d.m.Y', $this->to);

        return $from->diff($to)->days;
    }

}