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
            $this->bdd = mysqli_connect('localhost', 'root', '', 'classes');
            
        }
    

        public function register(){
            $requete = mysqli_query($this->bdd,"INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')");
            $request = mysqli_query($this->bdd,"SELECT*FROM utilisateurs WHERE login = '$this->login'");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
            
        }

        public function connect(){
            $request = mysqli_query($this->bdd,"SELECT*FROM utilisateurs WHERE login = '$this->login' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            $_SESSION['user'] = $result;
        }

        public function disconnect(){
            session_destroy();
        }

        public function delete(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"DELETE FROM utilisateurs WHERE id = '$this->id' ");
            session_destroy();
        }

        public function update(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"UPDATE utilisateurs SET  login = '$this->login', email = '$this->email', password = '$this->password', firstname = '$this->firstname', lastname = '$this->lastname' WHERE id = $this->id");
            var_dump($request);
        }

        public function isConnected(){
            if(isset($_SESSION['user'])){
                echo 'Utilisateur Connecté';
            }else{echo 'Utilisateur non connecté';}
        }

        public function getAllInfos(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"SELECT*FROM utilisateurs WHERE id = '$this->id' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
        }

        public function getLogin(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"SELECT login FROM utilisateurs WHERE id = '$this->id' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
        }

        public function getEmail(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"SELECT email FROM utilisateurs WHERE id = '$this->id' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
        }

        public function getFirstName(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"SELECT firstname FROM utilisateurs WHERE id = '$this->id' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
        }

        public function getLastname(){
            $this->id = $_SESSION['user']['id'];
            $request = mysqli_query($this->bdd,"SELECT lastname FROM utilisateurs WHERE id = '$this->id' ");
            $result = $request->fetch_array(MYSQLI_ASSOC);
            var_dump($result);
        }

        
    }


    $user = new user('ZoZo', 'raphaeldiop78@gm','azer', 'raph', 'diop');
    $user ->getLastname();
    // var_dump($_SESSION['user']);

    
?>