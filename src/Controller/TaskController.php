<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Task Controller
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index()
    {
        // $cookies = $this->request->getCookieParams();
        // $cookie = Hash::get($cookies, $this->_config['cookieName']);
        // $post = Hash::get($this->request->getParsedBody(), $this->_config['field']);
        // $header = $this->request->getHeaderLine('X-CSRF-Token');
        // echo "<pre>";
        // print_r($cookies);
        // echo "</pre>";
        // exit;
        // $loguser = $this->request->session();
        $user_id = $_SESSION['Auth']->id;
        // $this->Authentication->logout();
        // echo "<pre>";
        // print_r($this->Authentication);
        // echo "</pre>";
        // exit;
        $task = $this->paginate($this->Task);
        echo json_encode(array(
            'message' => 'Your tasks are successfully fetch.',
            'data' => $task
        ));
        exit;
        // $this->autoRender = false;
        $this->set(compact('task'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => [],
        ]);
        echo json_encode(array(
            'message' => 'Your task fetch successfully.',
            'data' => $task
        ));

        exit;
        $this->set(compact('task'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // echo "running";
        // exit;
        // $cookies = $this->request->getCookieParams();
        $task = $this->Task->newEmptyEntity();
        if ($this->request->is('post')) {
            $task = $this->Task->patchEntity($task, $this->request->getData());
            if ($this->Task->save($task)) {
                // $this->Flash->success(__('The task has been saved.'));
                echo json_encode(array(
                    'message' => 'Your task created successfully.',
                    'data' => $task
                ), 201);
            } else {
                echo json_encode(array(
                    'message' => 'The task could not be saved. Please, try again.'

                ), 410);
            }
            // $this->Flash->error(__('The task could not be saved. Please, try again.'));

        }
        // echo "running";
        exit;
        $this->set(compact('task'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['put'])) {
            $task = $this->Task->patchEntity($task, $this->request->getData());
            // echo "<pre>";
            // print_r($this->request->getData());
            // echo "</pre>";
            // exit;
            if ($this->Task->save($task)) {
                // $this->Flash->success(__('The task has been saved.'));
                echo json_encode(array(
                    'message' => 'Your task updated successfully.',
                    'data' => $task
                ), 201);
                // return $this->redirect(['action' => 'index']);
            }else {
                echo json_encode(array(
                    'message' => 'The task could not be updated. Please, try again.'

                ), 410);
            }
            // $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        exit;
        $this->set(compact('task'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Task->get($id);
        if ($this->Task->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    // public function token()
    // {
    //     $user = $this->Auth->identify();
    //     if (!$user) {
    //         throw new UnauthorizedException('Invalid username or password');
    //     }

    //     $this->set([
    //         'success' => true,
    //         'data' => [
    //             'token' => JWT::encode(
    //                 [
    //                     'sub' => $user['id'],
    //                     'exp' =>  time() + 604800
    //                 ],
    //                 Security::salt()
    //             )
    //         ],
    //         '_serialize' => ['success', 'data']
    //     ]);
    // }
}
