<?php

/**
 * LDAP configuration for ymo/l4-openldap
 */

return [

    'host' => env('LDAP_HOST'),
    'rdn' => env('LDAP_RDN'), // rdn used by the user configured below, optional
    'username' => env('LDAP_USERNAME'), // optional
    'password' => env('LDAP_PASSWORD'), // optional
    'version'  => env('LDAP_PROTOCOL_VERSION', '3'),   // LDAP protocol version (2 or 3)

    'filter' => env('LDAP_FILTER', '(objectclass=person)'), // optional

    'login_attribute' => 'uid', // login attributes for users
    'basedn' => env('LDAP_BASEDN'), // basedn for users
    'user_id_attribute' => 'uidNumber', // the attribute name containig the uid number
    'user_attributes' => [ // the ldap attributes you want to store in session (ldap_attr => array_field_name)
        'uid' => 'username', // example: this stores the ldap uid attribute as username in GenericUser
        'mail' => 'email', // example: this stores the ldap uid attribute as username in GenericUser
    ],

    'use_db' => true, // set to true if you want to retrieve more information from a database, the next 4 variables are required if this is set to true
    'ldap_field' => 'uid', // the LDAP field we want to compare to the db_field to find our user
    'db_table' => 'users', // the table where we should look for users
    'db_field' => 'username', // the DB field we want to compare to the ldap_field to find our user
    'eloquent' => true, // set to true if you want to return an Eloquent user instead of a GenericUser object
    'eloquent_user_model' => \App\Entities\User::class, // name of the User model

];
