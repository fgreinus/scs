<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 15:51
 */

class UserController extends BaseController
{
    public function showLogin() {
        return View::make('pages.user.login');
    }

    public function doLogin() {

        try {
            if (Auth::attempt(['username' => Input::get('inputUsername'), 'password' => Input::get('inputPassword'), ])) {

                // TODO: Not really pretty - should solve cleaner
                if (count(Auth::user()->roles) < 1) {
                    $guestRole = Role::where('name', 'guest')->first();
                    Auth::user()->attachRole($guestRole->id);
                }

                return Redirect::route( 'overview' );
            }
            else {
                return Redirect::route( 'doLogin' )->withErrors( array( 'error' => 'Failed signing in' ) );
            }
        } catch (ErrorException $e) {
            return Redirect::route( 'doLogin' )->withErrors( array( 'error' => 'Failed signing in (LDAP-Error)' ) );
        }
    }

    public function doLogout() {
        Auth::logout();
        return Redirect::to('login');
    }
}
