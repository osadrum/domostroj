<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_id;

    public $login;

    const ERROR_EMAIL_INVALID = 10;


    /**
     * Constructor.
     * @param string $username username
     * @param string $password password
     */
    public function __construct($login,$password)
    {
        $this->login=$login;
        $this->password=$password;
    }

    /**
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {

        $record = User::model()->findByAttributes(array('login'=>$this->login));

        if ( null === $record ) {
            $this->errorCode = self::ERROR_EMAIL_INVALID;
        } elseif (crypt($this->password, 567657) !== $record->password ) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else {

            $this->_id = $record->id;
            $this->setState('id', $record->id);
            $this->setState('login', $record->login);
            $this->setState('name', $record->name);
            $this->setState('email', $record->email);
            $this->setState('role', $record->role->name);
            $this->setState('roleTitle', $record->role->title);
            if ( $record->last_visit != null ) {
                $this->setState('last_visit', $record->last_visit);
            } else {
                $this->setState('last_visit', date('Y-m-d H:i:s'));
            }
            $this->errorCode=self::ERROR_NONE;
            $record->last_visit = date('Y-m-d H:i:s');
            $record->save();
        }

        return $this->errorCode == self::ERROR_NONE;

    }

    public function getId() {
        return $this->_id;
    }

    public function getLogin() {
        return $this->login;
    }

}