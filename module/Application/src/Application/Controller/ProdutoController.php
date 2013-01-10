<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Produto;

class ProdutoController extends AbstractActionController
{
    protected $table;

    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('Application\Model\ProdutoTable');
        }

        return $this->table;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'produtos' => $this->getTable()->fetchAll(),
        ));
    }

    public function visualizarAction()
    {
        $id = (int)$this->params()->fromRoute('id');

        return new ViewModel(array(
            'dados' => $this->getTable()->getProduto($id),
        ));
    }

    public function novoAction()
    {
    }

    public function salvarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $produto = new Produto();
            $produto->exchangeArray($request->getPost());
            $this->getTable()->save($produto);

            return $this->redirect()->toUrl('http://skeleton/produto');
        }
    }
}
