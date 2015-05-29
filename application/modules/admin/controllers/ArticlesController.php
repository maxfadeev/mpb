<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Articles\AddForm;
use Application\Modules\Articles\Models\Articles;
use Phalcon\Mvc\Controller;

/**
 * @property \Application\Modules\Users\Components\Auth auth
 */
class ArticlesController extends Controller
{
    /**
     * Shows articles
     */
    public function indexAction()
    {
        $articles = Articles::find();

        $this->view->setVars([
            'articles' => $articles,
            'token' => $this->security->getToken()
        ]);
    }

    /**
     * Adds a new article
     * If the article is added, forwards a request to the index action
     */
    public function addAction()
    {
        $form = new AddForm();

        if ($this->request->isPost() == true) {
            // check if form data are valid and CSRF token is right
            if ($form->isValid($this->request->getPost()) && $this->security->checkToken()) {
                $articles = new Articles();

                $articles->assign([
                    'uid' => $this->auth->getIdentity()['id'],
                    'title' => $this->request->getPost('title', 'striptags'),
                    'text' => $this->request->getPost('text')
                ]);

                if ($articles->save() == true) {
                    $this->flash->success("Article has been created");
                    $this->dispatcher->forward(['action' => 'index']);
                    return;
                }

                $this->flash->error($articles->getMessages());
            }
        }

        $this->view->setVar('form', $form);
    }
} 