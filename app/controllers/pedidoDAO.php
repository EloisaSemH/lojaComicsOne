<?php
require_once ("conexao.php");
class PedidoDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Pedido $entPed) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO pedidos VALUES ('', :ped_cli_cod, :ped_end_cod, :ped_pedido, :ped_total, :ped_dataHora)");
            $param = array(
                ":ped_cli_cod" => $entPed->getPed_cli_cod(),
                ":ped_end_cod" => $entPed->getPed_end_cod(),
                ":ped_pedido" => $entPed->getPed_pedido(),
                ":ped_total" => $entPed->getPed_total(),
                ":ped_dataHora" => $entPed->getPed_dataHora()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 301: {$ex->getMessage()}";
        }
    }

    function pegarInfos($ped_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE ped_cod = :ped_cod");
            $param = array(":ped_cod" => $ped_cod);
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

    function contarPedidos() {
        try {
            $stmt = $this->pdo->prepare("SELECT ped_cod FROM pedidos");
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return $stmt->rowCount();
            }else{
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function tabelaPedidos($limite, $quantPag, $cliente){
        try {
            if(is_null($cliente)){
                $stmt = $this->pdo->prepare("SELECT * FROM pedidos ORDER BY ped_dataHora DESC LIMIT :limite, :quantPag");
                $param = array(":limite" => $limite, ":quantPag" => $quantPag);
            }else{
                $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE ped_cli_cod = :ped_cli_cod ORDER BY ped_dataHora DESC LIMIT :limite, :quantPag");
                $param = array(":limite" => $limite, ":quantPag" => $quantPag, ":ped_cli_cod" => $cliente);
            }
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantPag;
                $celconstruida = 0;
                $colConstruida = 0;
                echo '<table class="table table-striped" required><thead class="thead-dark"><th class="align-middle text-center">Código</th><th class="align-middle text-center">Código cliente</th><th class="align-middle text-center">Código endereço</th><th class="align-middle text-center">Pedido</th><th class="align-middle text-center">Valor total</th><th class="align-middle text-center">Data e hora</th><th class="align-middle text-center"></th></tr></thead><tbody>';   
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $pedido = str_replace(';', '&#10', $dados['ped_pedido']);
                            $pedido = str_replace($array = ['?', '*'], '', $pedido);

                            $datahora = DateTime::createFromFormat('Y-m-d H:i:s', $dados['ped_dataHora']);
                            $dataHoraFormatada = $datahora->format('d/m/Y H:i');

                            echo '<td class="align-middle text-center">' . $dados['ped_cod'] . '</td>';
                            echo '<td class="align-middle text-center">' . $dados['ped_cli_cod'] . '</td>';
                            echo '<td class="align-middle text-center">' . $dados['ped_end_cod'] . '</td>';
                            echo '<td class="align-middle text-center"><textarea class="form-control" readonly>' . $pedido . '</textarea></td>';
                            echo '<td class="align-middle text-center">' . $dados['ped_total'] . '</td>';
                            echo '<td class="align-middle text-center">' . $dataHoraFormatada . '</td>';
                            echo '<td class="align-middle text-center"><a class="text-uppercase font-weight-bold text-dark" href="index.php?&pg=pedido&cod=' . $dados['ped_cod'] . '">Visualizar</a></td>';
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
                echo '<p>Você ainda não tem nenhum pedido registrado :(</p>';
            }
        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

}