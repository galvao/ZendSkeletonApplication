<?php
namespace Application\Model;

class Produto
{
    public $id, $nome;

    public function exchangeArray($data) 
    {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : NULL;
    }
}
