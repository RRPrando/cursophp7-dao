<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 23/08/2017
 * Time: 21:38
 */

class Usuario
{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    /**
     * @return mixed
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    /**
     * @param mixed $idusuario
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }
    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }
    /**
     * @param mixed $deslogin
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }
    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }
    /**
     * @param mixed $dessenha
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }
    /**
     * @return mixed
     */
    public function getDtcadastro():DateTime
    {
        return $this->dtcadastro;
    }
    /**
     * @param mixed $dtcadastro
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;
    }

    public function loadById($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
        if (count($results) > 0) {
            $row = $results[0];
            $this->setIdusuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));
        }
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}