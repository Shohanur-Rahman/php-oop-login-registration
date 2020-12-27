<?php

namespace App\Classes\Modules;

use App\Classes\Config\Config;
use App\Classes\Config\Cookie;
use App\Classes\Config\DB;
use App\Classes\Config\Hash;
use App\Classes\Config\Session;

class User
{

    private $_db, $_data, $_sessionName, $_isLoggedIn, $_cookieName;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    //Process logout
                }
            }
        }
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new \Exception('There are some errors on creating an account. Please check your database connection.');
        }
    }

    public function find($username = null)
    {
        if ($username) {
            $field = (is_numeric($username)) ? 'id' : 'email';
            $data = $this->_db->get('users', array(
                $field,
                '=',
                $username
            ));
            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }

        }
        return false;
    }

    public function login($username = null, $password = null, $remember = false)
    {
        if (!$username && !$password && $this->exists()) {
            // Session Exist
            Session::put($this->_sessionName, $this->data()->id);

        } else {
            $user = $this->find($username);
            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt_password)) {
                    Session::put($this->_sessionName, $this->data()->id);


                    if ($remember) {
                        $hash = Hash::unique();
                        $hasCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

                        if (!$hasCheck->count()) {
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash,
                                'login_date' => date('Y-m-d H:i:s')
                            ));
                        } else {
                            $hash = $hasCheck->first()->hash;
                        }

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

                    }
                    return true;
                }
            }
        }

        return false;
    }

    private function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout()
    {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}