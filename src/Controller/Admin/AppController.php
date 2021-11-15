<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        // Add this line to check authentication result and lock your site
        $this->loadComponent('Authentication.Authentication');
        // $this->loadComponent('Auth', [
        //     'storage' => 'Memory',
        //     'authenticate' => [
        //         'Form' => [
        //             'scope' => ['Users.active' => 1]
        //         ],
        //         'ADmad/JwtAuth.Jwt' => [
        //             'parameter' => 'token',
        //             'userModel' => 'Users',
        //             'scope' => ['Users.active' => 1],
        //             'fields' => [
        //                 'username' => 'id'
        //             ],
        //             'queryDatasource' => true
        //         ]
        //     ],
        //     'unauthorizedRedirect' => false,
        //     'checkAuthIn' => 'Controller.initialize'
        // ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }
}
