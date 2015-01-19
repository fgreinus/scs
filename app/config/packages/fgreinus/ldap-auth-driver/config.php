<?php

/**
 * LDAP configuration fgreinus/ldap-auth-driver
 */

return array(

    'host'                => 'ldap.somesite.com',
    'rdn'                 => 'ou=people,ou=group,ou=parentgroup,dc=somesite,dc=de',
    // rdn used by the user configured below, optional
    'username'            => 'uid uid',
    // optional
    'password'            => 'password',
    // optional
    'version'             => '3',
    // LDAP protocol version (2 or 3)

    'filter'              => '(objectclass=person)',
    'login_attribute'     => 'uid',
    // login attributes for users
    'basedn'              => 'dc=somesite,dc=de',
    // basedn for users
    'user_id_attribute'   => 'uid',
    // the attribute name containg the uid number
    'user_attributes'     => array( // the ldap attributes you want to store in session (ldap_attr => array_field_name)
        'uid'  => 'username',
        'mail' => 'email'
    ),
    'use_db'              => true,
    // set to true if you want to retrieve more information from a database, the next 4 variables are required if this is set to true
    'ldap_field'          => 'uid',
    // the LDAP field we want to compare to the db_field to find our user
    'db_table'            => 'users',
    // the table where we should look for users
    'db_field'            => 'username',
    // the DB field we want to compare to the ldap_field to find our user
    'eloquent'            => true,
    // set to true if you want to return an Eloquent user instead of a GenericUser object
    'eloquent_user_model' => 'User',
    // name of the User model

);
