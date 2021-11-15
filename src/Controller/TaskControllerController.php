<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TaskController Controller
 *
 * @method \App\Model\Entity\TaskController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskControllerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $taskController = $this->paginate($this->TaskController);

        $this->set(compact('taskController'));
    }

    /**
     * View method
     *
     * @param string|null $id Task Controller id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taskController = $this->TaskController->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('taskController'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taskController = $this->TaskController->newEmptyEntity();
        if ($this->request->is('post')) {
            $taskController = $this->TaskController->patchEntity($taskController, $this->request->getData());
            if ($this->TaskController->save($taskController)) {
                $this->Flash->success(__('The task controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task controller could not be saved. Please, try again.'));
        }
        $this->set(compact('taskController'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task Controller id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taskController = $this->TaskController->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taskController = $this->TaskController->patchEntity($taskController, $this->request->getData());
            if ($this->TaskController->save($taskController)) {
                $this->Flash->success(__('The task controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task controller could not be saved. Please, try again.'));
        }
        $this->set(compact('taskController'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task Controller id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taskController = $this->TaskController->get($id);
        if ($this->TaskController->delete($taskController)) {
            $this->Flash->success(__('The task controller has been deleted.'));
        } else {
            $this->Flash->error(__('The task controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
