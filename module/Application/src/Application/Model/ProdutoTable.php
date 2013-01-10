<?php
namespace Application\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class ProdutoTable extends AbstractTableGateway
{
    protected $table = 'produtos';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Produto());
        $this->initialize();
    }

    public function fetchAll()
    {
        return $this->select();
    }

    public function getProduto($id)
    {
        $id = (int)$id;
        $rowSet = $this->select(array('id' => $id));
        $row = $rowSet->current();

        if (!$row) {
            throw new \Exception("Registro de ID $id não encontrado.");
        }

        return $row;
    }

    public function save(Produto $produto)
    {
        $data = array(
            'nome' => $produto->nome,
        );

        $id = (int)$produto->id;

        if (!$id) {
            $this->insert($data);
        } else {
            if ($this->getProduto($id)) {
                $this->update(array('id' => $id));
            } else {
                throw new \Exception("Registro de ID $id não encontrado.");
            }
        }
    }

    public function delete($id)
    {
        $id = (int)$id;

        if ($this->getProduto($id)) {
            $this->delete(array('id' => $id));
        }
    }
}
