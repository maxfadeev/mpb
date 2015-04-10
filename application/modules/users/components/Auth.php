<?php


namespace Application\Modules\Users\Components;


use Application\Modules\Users\Models\Users;
use Phalcon\Mvc\User\Component;

class Auth extends Component
{
    /**
     * Checks user credentials and logs in the user
     *
     * @param array $credentials
     * @throws AuthException
     */
    public function login(array $credentials)
    {
        $user = Users::findFirstByEmail($credentials['email']);
        if ($user == false) {
            $this->registerUserThrottling(0);
            throw new AuthException('Wrong email/password combination');
        }

        if ($this->security->checkHash($credentials['password'], $user->password) == false) {
            $this->registerUserThrottling($user->id);
            throw new AuthException('Wrong email/password combination');
        }
    }

    /**
     * Implements login throttling
     * Reduces the effectiveness of brute force attacks
     *
     * @param integer $uid - user id
     */
    public function registerUserThrottling($uid)
    {

    }
}