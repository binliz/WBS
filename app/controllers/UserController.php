<?php
declare(strict_types=1);

class UserController extends ControllerAuthentificated
{
    public $excludeActions = ['login', 'register'];

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password', 'string');
            $user = Users::findByEmail($email);
            if ($user && $user->checkHash($password)) {
                EventFacade::fire('auth:login', $user);
                $this->response->redirect(['for' => 'home']);
            }

            $this->flash->error("Incorrect credentials");
        }
    }

    public function logoutAction()
    {
        EventFacade::fire('auth:logout', $this);
        $this->response->redirect(['for' => 'login']);
    }


    public function registerAction()
    {
        $name = null;
        $email = null;
        $form = new RegisterForm();
        if ($this->request->isPost()) {
            $user = new Users();
            $form->bind($this->request->getPost(), $user);
            if ($form->isValid()) {
                $user->active = 1;
                $result = $user->save();
                if ($result) {
                    $this->flash->success('U are registred');
                    $this->response->redirect(['for' => 'login']);
                }

                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }
            }
        }

        $messages = $form->getMessages();
        foreach ($messages as $message) {
            $this->flash->error((string)$message);
        }
        $this->view->setVar('registerForm', $form);

    }

}

