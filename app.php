<?php

//class Dashbord
class Dashboard
{
    private $data_inicio;
    private $data_final;
    private $numeroVendas;
    private $totalVendas;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

}

//class Conexao 
class Conexao
{
    private $host = 'localhost';
    private $dbname = 'dashbord';
    private $user = 'root';
    private $pass = '';

    public function conectar(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );
          

            $conexao->exec('set charset set utf8');
            return $conexao;
        }catch(PDOException $erro)
        {
            echo '<p>'.$erro->getMessage().'</p>';
        }
    }
}

//class bd
class BD
{
 private $conexao;
 private $dashboard;

 public function __construct(Conexao $conectar, Dashboard $dashboard)
 {
    $this->conexao = $conectar->conectar();
    $this->dashboard = $dashboard;
 }

 public function getNumeroVendas()
 {
     $query ='select count(*) as numero_vendas from tb_vendas where data_venda between :data_inicio and :data_final';

     $stmt = $this->conexao->prepare($query);
     $stmt->bindvalue(':data_inicio',$this->dashboard->__get('data_inicio'));
     $stmt->bindvalue(':data_final', $this->dashboard->__get('data_final'));
     $stmt->execute();

     return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;


 }

 
 public function getTotalVendas()
 {
     $query ='select SUM(total) as total_vendas from tb_vendas where data_venda between :data_inicio and :data_final';

     $stmt = $this->conexao->prepare($query);
     $stmt->bindvalue(':data_inicio',$this->dashboard->__get('data_inicio'));
     $stmt->bindvalue(':data_final', $this->dashboard->__get('data_final'));
     $stmt->execute();

     return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;


 }

}

$conexao = new Conexao();

$dashboard = new Dashboard();


$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];

$dia_do_mes = cal_days_in_month(CAL_GREGORIAN,$mes, $ano);

$dashboard->__set('data_inicio',$ano.'-'.$mes.'-'.'-01');
$dashboard->__set('data_final', $ano.'-'.$mes.'-'.$dia_do_mes);

$bd = new Bd($conexao, $dashboard);
$dashboard->__set('numeroVendas', $bd->getNumeroVendas());
$dashboard->__set('totalVendas', $bd->getTotalVendas());

$json = json_encode($dashboard);
echo $json;