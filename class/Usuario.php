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
     * Usuario constructor.
     * @param $deslogin
     * @param $dessenha
     */
    public function __construct($deslogin = "", $dessenha = "")
    {
        $this->deslogin = $deslogin;
        $this->dessenha = $dessenha;
    }

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
        $results = $sql->select(
            "SELECT * FROM tb_usuarios ".
            "WHERE idusuario = :ID",
            array(
                ":ID"=>$id
            ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public static function getList()
    {
        $sql = new Sql();
        return $sql->select(
            "SELECT * FROM tb_usuarios ".
            "ORDER BY deslogin");
    }

    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select(
            "SELECT * FROM tb_usuarios ".
            "WHERE deslogin LIKE :LOGIN ".
            "ORDER BY deslogin",
            array(
                ":LOGIN"=>"%".$login."%"
            ));
    }

    public function login($login, $senha)
    {
        $sql = new Sql();
        $results = $sql->select(
            "SELECT * FROM tb_usuarios ".
            "WHERE deslogin = :LOGIN AND dessenha = :SENHA",
            array(
                ":LOGIN"=>$login,":SENHA"=>$senha
            ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Login e/ou Senha inválidos");
        }
    }

    public function insert()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",
            array(
                ":LOGIN"=>$this->getDeslogin(),
                ":SENHA"=>$this->getDessenha()
            ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function setData($data)
    {
        $this->setIdusuario($data["idusuario"]);
        $this->setDeslogin($data["deslogin"]);
        $this->setDessenha($data["dessenha"]);
        $this->setDtcadastro(new DateTime($data["dtcadastro"]));
    }

    public function update($login,$senha)
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        $sql = new Sql();
        $sql->query(
            "UPDATE tb_usuarios SET ".
            "deslogin = :LOGIN, dessenha = :SENHA ".
            "WHERE idusuario = :ID",
            array(
                ":LOGIN"=>$this->getDeslogin(),
                ":SENHA"=>$this->getDessenha(),
                ":ID"=>$this->getIdusuario()
            ));
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->query(
            "DELETE FROM tb_usuarios ".
            "WHERE idusuario = :ID",
            array(
                ":ID"=>$this->getIdusuario()
            ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
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