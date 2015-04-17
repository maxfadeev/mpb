<?php


namespace Application\Modules\Users\Components;


use Application\Modules\Users\Models\FailedLogins;
use Application\Modules\Users\Models\SuccessLogins;
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
        $user = Users::findFirstByLogin($credentials['login']);
        if ($user == false) {
            $this->registerUserThrottling(0);
            throw new AuthException('Wrong login/password combination');
        }

        if ($this->security->checkHash($credentials['password'], $user->password) == false) {
            $this->registerUserThrottling($user->id);
            throw new AuthException('Wrong login/password combination');
        }

        // check whether the user is banned/inactive/suspended
        $this->checkUserFlags($user);

        // register the successful login
        $this->registerSuccessLogin($user);

        $this->session->set('auth-identity', [
            'id' => $user->id,
            'login' => $user->login
        ]);
    }

    /**
     * Implements login throttling
     * Reduces the effectiveness of brute force attacks
     *
     * @param integer $uid - user id
     */
    public function registerUserThrottling($uid)
    {
        $failedLogin = new FailedLogins();
        $failedLogin->uid = $uid;
        $failedLogin->ip = $this->request->getClientAddress();
        $failedLogin->attempted = time();

        $failedLogin->save();

        $attempts = FailedLogins::count([
            'ip = ?0 AND attempted >= ?1',
            'bind' => [
                $this->request->getClientAddress(),
                time() - 3600 * 6
            ]
        ]);

        switch ($attempts) {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    /**
     * Checks whether the user is banned/inactive/suspended
     *
     * @param \Application\Modules\Users\Models\Users $user
     * @throws AuthException
     */
    public function checkUserFlags(Users $user)
    {
        if ($user->active != true) {
            throw new AuthException('The user is inactive');
        }

        if ($user->banned == true) {
            throw new AuthException('The user is banned');
        }

        if ($user->suspended == true) {
            throw new AuthException('The user is suspended');
        }
    }

    /**
     * Registers a success login
     *
     * @param \Application\Modules\Users\Models\Users $user
     * @throws AuthException
     */
    public function registerSuccessLogin(Users $user)
    {
        $successLogin = new SuccessLogins();
        $successLogin->uid = $user->id;
        $successLogin->ip = $this->request->getClientAddress();
        $successLogin->user_agent = $this->request->getUserAgent();
        if ($successLogin->save() == false) {
            $message = $successLogin->getMessages();
            throw new AuthException($message[0]);
        }
    }
}