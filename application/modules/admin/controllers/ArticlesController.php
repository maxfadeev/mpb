<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Articles\AddForm;
use Application\Modules\Admin\Forms\Articles\EditForm;
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

    /**
     * Update the article by its id
     *
     * @param integer $id the id of the article to be edited
     */
    public function editAction($id)
    {
        $article = Articles::findFirstById((int) $id);

        if ($article == false) {
            $this->flash->error('User was not found');
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        $form = new EditForm($article);

        if ($this->request->isPost()) {
            // check if form data are valid and CSRF token is right
            if ($form->isValid($this->request->getPost()) && $this->security->checkToken()) {
                $article->assign([
                    'uid' => $this->auth->getIdentity()['id'],
                    'title' => $this->request->getPost('title', 'striptags'),
                    'text' => $this->request->getPost('text')
                ]);

                if ($article->save() == true) {
                    $this->flash->success("Article has been updated");
                    $this->dispatcher->forward(['action' => 'index']);
                    return;
                }
            }
        }

        $this->view->setVar('form', $form);
    }

    /**
     * Deletes the article by its id
     * If the article is not found, forwards a request to the index action
     *
     * @param integer $id the id of the article to be deleted
     * @param string $token csrf token value
     */
    public function deleteAction($id, $token)
    {
        // verify if csrf token is right
        if ($token !== $this->security->getSessionToken()) {
            $this->flash->error("CSRF verification error");
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        $article = Articles::findFirstById((int) $id);

        if ($article == false) {
            $this->flash->error('Article was not found');
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        if ($article->delete() == false) {
            $this->flash->error($article->getMessages());
        } else {
            $this->flash->success('Article has been deleted successfully');
        }

        // anyway forward to the index action
        $this->dispatcher->forward(['action' => 'index']);
    }
} 