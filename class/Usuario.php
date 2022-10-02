<?php
    require_once('Crud.php');

    class Usuario extends Crud{
        protected string $tabela="cadastro";

        function __construct(
            public string $nome,
            private string $email,
            private string $senha, 
            private string $repete_senha="", 
            private string $token="", 
            public array $erro=[]){
       
        }

        public function set_repeticao($repete_senha){
            $this->repete_senha = $repete_senha;
        }

        public function validar_cadastro(){
            //validação do nome
            if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$this->nome)) {
                $this->erro["erro_nome"]="Por favor, informe um nome válido";
            }

            //verificar se email é válido
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $this->erro["erro_email"]="Formato de e-mail inválido";
            }

            //verificar se a senha tem mais de 6 digitos
            if(strlen($this->senha)<6){
                $this->erro["erro_senha"]="Senha deve ter 6 caracteres ou mais";
            }

            if($this->senha !== $this->repete_senha){
                $this->erro["erro_repete"]= "Senha e repetição de senha diferente";
            }
        }

        public function insert(){
            //verificar se este email já está cadastrado no banco
            $sql = "SELECT * FROM cadastro WHERE email=? LIMIT 1";
            $sql = DB::prepare($sql);
            $sql->execute(array($this->email));
            $usuario = $sql->fetch();

            //se não existir usuario - adicionar no banco
            if(!$usuario){
                $data_cadastro=date('d/m/Y');
                $senha_cripto=sha1($this->senha);

                $sql = "INSERT INTO $this->tabela VALUES (null, ?,?,?,?,?)";
                $sql = DB::prepare($sql);
                return $sql->execute(array($this->nome,$this->email,$senha_cripto,$this->token,$data_cadastro));
            }else{
                $this->erro["erro_geral"]= "Usuario já cadastrado!";
            }
        }

        public function update($id){
            $sql = "UPDATE $this->tabela SET token=? WHERE id=?";
            $sql=DB::prepare($sql);
            return $sql->execute(array($token,$id));
        }
    }

?>