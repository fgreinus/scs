<?php

class RedmineAPI {

    private $client;

    public function __construct() {
        $this->client = new Redmine\Client(Config::get('redmine.url'), Config::get('redmine.apikey'));
    }

    public function getTicket($ticketId) {

        $ticket = Cache::remember('redmine_ticket_'.$ticketId, Config::get('redmine.cache_duration'), function() use($ticketId) {
            $ticket = $this->client->api('issue')->show($ticketId);
            if (!is_array($ticket) || !array_key_exists('issue', $ticket))
                return null;
            else {
                $betterUpdateTimestamp = \Carbon\Carbon::createFromFormat("Y-m-d?H:i:s?", $ticket["issue"]["updated_on"]);
                $ticket["issue"]["updated_on_date"] = $betterUpdateTimestamp->format('Y-m-d H:i:s');
                $betterCreateTimestamp = \Carbon\Carbon::createFromFormat("Y-m-d?H:i:s?", $ticket["issue"]["created_on"]);
                $ticket["issue"]["created_on_date"] = $betterCreateTimestamp->format('Y-m-d H:i:s');
                return $ticket;
            }
        });
        return $ticket["issue"];
    }
}