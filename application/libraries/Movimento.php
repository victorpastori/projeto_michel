<?php

class Movimento
{

 function __construct()
 {
   # code...
 	/* 	Status para saque:  	0 -> Aguardando efetivação (Já sai da conta)
 								1 -> Efetivado (Foi debitado na conta saque do cliente)
 	   	Status para deposito:  	1 -> Efetivado (Foi aplicado no investimento)  */
 }
 
 public $idmovimento;
 public $valor;
 public $data;
 public $status;
 public $conta_idconta;
 public $tipo_movimento_idtipo_movimento;
 

}


?>