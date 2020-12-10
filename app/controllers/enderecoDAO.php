<?php
require_once ("conexao.php");
class EnderecoDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Endereco $entEnd) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO enderecos VALUES ('', :end_cli_cod, :end_cep, :end_rua, :end_numero, :end_bairro, :end_complemento)");
            $param = array(
                ":end_cli_cod" => $entEnd->getEnd_cli_cod(),
                ":end_cep" => $entEnd->getEnd_cep(),
                ":end_rua" => $entEnd->getEnd_rua(),
                ":end_numero" => $entEnd->getEnd_numero(),
                ":end_bairro" => $entEnd->getEnd_bairro(),
                ":end_complemento" => $entEnd->getEnd_complemento()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function contarEnderecosUsuario($end_cli_cod) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM enderecos WHERE end_cli_cod = :end_cli_cod");
            $param = array(":end_cli_cod" => $end_cli_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                return $stmt->rowCount();
            }else{
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function pegarInfos($end_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM enderecos WHERE end_cod = :end_cod");
            $param = array(":end_cod" => $end_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta;
            }else{
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function atualizarEndereco(Endereco $entEnd){
        try {
            $stmt = $this->pdo->prepare("UPDATE enderecos SET end_cep = :end_cep, end_rua = :end_rua, end_numero = :end_numero WHERE end_cod = :end_cod");
            $param = array(
                ":end_cep" => $entEnd->getEnd_cep(),
                ":end_rua" => $entEnd->getEnd_rua(),
                ":end_numero" => $entEnd->getEnd_numero(),
                ":end_cod" => $entEnd->getEnd_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO 204: {$ex->getMessage()}";
        }
    }

    function excluirEndereco(Endereco $entEnd){
        try {
            $stmt = $this->pdo->prepare("DELETE FROM enderecos WHERE end_cod = :end_cod");
            $param = array(
                ":end_cod" => $entEnd->getEnd_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function selectEnderecos($end_cli_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT end_cod, end_cli_cod, end_cep, end_rua, end_numero, end_bairro, end_complemento FROM enderecos WHERE end_cli_cod = :end_cli_cod ORDER BY end_rua");
            $param = array(":end_cli_cod" => $end_cli_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                echo '<select name="endereco" id="endereco" class="form-control">';
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $txtEnd = $dados['end_rua'] . ', ' . $dados['end_numero'] . ', ' . $dados['end_complemento'] . ' - ' . $dados['end_bairro'];
                    echo '<option value="' . $dados['end_cod'] . ';' . $txtEnd . '">' . $txtEnd . '</option>';
                }
            echo '</select>';
            }else{
                echo '<a class="btn btn-outline-warning" href="index.php?&pg=cadastroendereco">Cadastrar Endereço</a>';
            }
        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
    
    function pegarTodosEnderecos($pesquisa, $limite, $quantpag, $end_cli_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT end_cod, end_cli_cod, end_cep, end_rua, end_numero, end_bairro, end_complemento FROM enderecos WHERE end_cli_cod = :end_cli_cod ORDER BY end_rua DESC LIMIT :limite, :quantpag");
            $param = array(":limite" => $limite, ":quantpag" => $quantpag, ":end_cli_cod" => $end_cli_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantpag;
                $celconstruida = 0;
                $colConstruida = 0;
                $contador = 1;
                echo '<table class="table table-striped" required><thead class="thead-dark"><th></th><th>CEP</th><th>Rua</th><th>Número</th><th>Bairro</th><th>Complemento</th><th></th></tr></thead><tbody>';   
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($_GET['pg'] == 'pedido'){
                                echo '<td><input type="radio" name="endereco" id="endereco" value="' . $dados['end_cod'] . '"></td>';
                            }else{
                                echo '<td>' . $contador . '</td>';
                                $contador++;
                            }
                            echo '<td>' . $dados['end_cep'] . '</td>';
                            echo '<td>' . $dados['end_rua'] . '</td>';
                            echo '<td>' . $dados['end_numero'] . '</td>';
                            echo '<td>' . $dados['end_bairro'] . '</td>';
                            if(is_null($dados['end_complemento'])){
                                echo '<td></td>';
                            }else{
                                echo '<td>' . $dados['end_complemento'] . '</td>';
                            }
                            echo '<td><a class="text-uppercase font-weight-bold text-dark" href="index.php?&pg=editarendereco&id=' . $dados['end_cod'] . '">Editar</a></td>';
                            echo '</tr>';

                            $colConstruida++;
                            if($colConstruida == $qtdcol){
                                $colConstruida = 0;
                            }
                        }
                    }
                }
            echo '</tbody></table>';
            }else{
                echo '<a class="btn btn-outline-vermelho-claro" href="index.php?&pg=cadastroendereco">Cadastrar Endereço</a>';
            }
        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}