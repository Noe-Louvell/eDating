<?php
namespace src\Model;

Class User  {
    private $Id;
    private $Mail;
    private $Password;

    public function SqlLogin(\PDO $bdd)
    {
        $requete = $bdd->prepare('SELECT * FROM T_UTILISATEUR where U_EMAIL = :mail');
        $requete->execute([
            'mail' => $_POST['mail'],
        ]);

        $datas = $requete->fetch();
        $passwordHash = $datas['password'];

        //https://www.php.net/manual/fr/function.password-verify.php
        return password_verify($_POST['pass'], $passwordHash);


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     * @return User
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->Mail;
    }

    /**
     * @param mixed $Mail
     * @return User
     */
    public function setMail($Mail)
    {
        $this->Mail = $Mail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     * @return User
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }





}