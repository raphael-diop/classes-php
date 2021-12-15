<?php
session_start();

    class user{
        protected $bdd;
        private $id;
        public $login;
        public $email;
        protected $password;
        public $firstname;
        public $lastname;
        
        public function __construct($login, $email, $password, $firstname, $lastname){
            $this->login = $login;
            $this->email = $email;
            $this->password = $password;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->bdd = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
            
        }
    

        public function register(){
            $requetesql1 = "INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')";
            $requetesql2 = "SELECT*FROM utilisateurs WHERE login = '$this->login'";
            $calcul1 = $this->bdd->prepare($requetesql1);
            $calcul1 -> execute();
            $calcul2 = $this->bdd->prepare($requetesql2);
            $calcul2 -> execute();
            $result2 = $calcul2->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result2);
            
        }

        public function connect(){
            $request = "SELECT*FROM utilisateurs WHERE login = '$this->login' ";
            $calcul = $this->bdd->prepare($request);
            $calcul -> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $result;
            var_dump($result);
        }

        public function disconnect(){
            session_destroy();
        }

        public function delete(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "DELETE FROM `utilisateurs` WHERE id = '$this->id' ";
            $calcul = $this->bdd->prepare($request);
            $calcul -> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            session_destroy();
            var_dump($result);
        }

        public function update(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "UPDATE utilisateurs SET  login = '$this->login', email = '$this->email', password = '$this->password', firstname = '$this->firstname', lastname = '$this->lastname' WHERE id = $this->id";
            $calcul = $this->bdd->prepare($request);
            $calcul -> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($request);
        }

        public function isConnected(){
            if(isset($_SESSION['user'])){
                echo 'Utilisateur Connecté';
            }else{echo 'Utilisateur non connecté';}
        }

        public function getAllInfos(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "SELECT*FROM utilisateurs WHERE id = '$this->id' ";
            $calcul =$this->bdd->prepare($request);
            $calcul->execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);
        }

        public function getLogin(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "SELECT login FROM utilisateurs WHERE id = '$this->id'";
            $calcul = $this->bdd->prepare($request);
            $calcul-> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);
        }

        public function getEmail(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "SELECT email FROM utilisateurs WHERE id = '$this->id'";
            $calcul = $this->bdd->prepare($request);
            $calcul-> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);
        }

        public function getFirstName(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "SELECT firstname FROM utilisateurs WHERE id = '$this->id'";
            $calcul = $this->bdd->prepare($request);
            $calcul-> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);
        }

        public function getLastname(){
            $this->id = $_SESSION['user']['0']['id'];
            $request = "SELECT lastname FROM utilisateurs WHERE id = '$this->id'";
            $calcul = $this->bdd->prepare($request);
            $calcul-> execute();
            $result = $calcul->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);
        }

        
    }


    $user = new user('ZEZE', 'raphaeldiop78@gm','azer', 'raph', 'diop');
    $user ->getLastname();
    // var_dump($_SESSION['user']);

    
?>