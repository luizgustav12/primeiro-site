<?php

	# DATABASE DATA
	define('DB_SERVER',   '127.0.0.1:3306');
	define('DB_USER',     'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME',     'Local');
	define('DB_DRIVER',   'sqlsrv');

	# FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS
	function db_conectar(){
		global $db_conexao;
	
		if(file_exists("banco_de_dados/config.xml"))
			$xmlBancos = simplexml_load_file("banco_de_dados/config.xml");
		else
			$xmlBancos = simplexml_load_file("../banco_de_dados/config.xml");
		
			
		$banco = $xmlBancos -> xpath("//site");
		if(count($banco) == 0)
			db_erro("", "O banco de dados não foi localizado");
		
		try{
			$db_conexao = new PDO("mysql:dbname=" . $banco[0] -> banco . ";host=" . $banco[0] -> server, $banco[0] -> usuario, $banco[0] -> senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
			//$db_conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$db_conexao -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			db_query("SET session wait_timeout=200000", array());
			
		}
		catch(PDOException $erro){
			db_erro("Falha ao conectar-se no banco de dados", "", $erro -> getMessage());
		}
		
		return $db_conexao;
	}
	
	# FUNÇÃO PARA DESCONECTAR DO BANCO DE DADOS
	function db_desconectar(){
		global $db_conexao;
		
		$db_conexao  = NULL;
	}
	
	# FUNÇÃO PARA EXUBIR ERRO DE CONEXÃO OU DE QUERY
	function db_erro($sql, $erro){
		die('<table border="1" cellpadding="10" style="margin: 20px auto; width: 95%;"><thead><tr><th>SQL</th><th>ERRO</th></tr></thead><tbody><tr><td>' . $sql . '</td><td>' . $erro . '</td></tr></tbody></table>');
	}
	
	function db_query_log($sql, $arrayParametros, &$log){
	    global $db_conexao;
	    $db_conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	    $query = $db_conexao->prepare($sql);
	    
        if(empty($arrayParametros)) {
           $query->execute();
        } else{
           unset($arrayParametros[0]);
           $arrayParametros = array_values($arrayParametros);
           $query->execute($arrayParametros);
        }
        
        $qtdRows = $query->rowCount();
        if($qtdRows == 0) {
            $msg = "Registro não atualizado. SQL: " . $sql;
            foreach($arrayParametros as $valor) {
                $msg .= " - Valor: " . $valor;
            }
            throw new Exception($msg);
        }
        
	    return $query;
	}
	
	# FUNÇÃO PARA EXECUTAR UMA QUERY
	function db_query($sql, $arrayParametros){
		global $db_conexao;
		
		try{
			$query = $db_conexao -> prepare($sql);
		}
		catch(Exception $erro){
			db_erro($sql, $erro -> getMessage());
		}
		
		try{
			if(empty($arrayParametros))
				$query -> execute();
			else{
				
				$query -> execute($arrayParametros);
			}
		}
		catch(Exception $erro){
			db_erro($sql, $erro -> getMessage());
		}
		
		return $query;
	}
	
	# FUNÇÃO PARA EXECUTAR MÚLTIPLAS QUERYS
	function db_multiquery($sql){
		db_query($sql, array());
	}
	
	# FUNÇÃO PARA RETORNAR O ÚLTIMO ID INSERIDO NO BANCO
	function db_id(){
		global $db_conexao;
		
		return $db_conexao -> lastInsertId();
	}
	
	# FUNÇÃO PARA RETORNAR A QUANTIDADE DE LINHAS DE UMA CONSULTA
	function db_linhas($query){
		return $query -> rowCount();
	}
	
	# FUNÇÃO PARA MONTAR UM ARRAY COM OS RESULTADOS DE UMA QUERY
	function db_lista($sql, $arrayParametros){
		global $db_conexao;
		
		try{
			$query = $db_conexao -> prepare($sql);
		}
		catch(Exception $erro){
			db_erro($sql, $erro -> getMessage());
		}
		
		try{
			if(empty($arrayParametros))
				$query -> execute();
			else{
				unset($arrayParametros[0]);
				$arrayParametros = array_values($arrayParametros);
				$query -> execute($arrayParametros);
			}
		}
		catch(Exception $erro){
			db_erro($sql, $erro -> getMessage());
		}
		
		$dados = array();

	
		if(db_linhas($query) > 0){
			$i = 0;
			while($linha = $query -> fetch(PDO::FETCH_ASSOC)){
				foreach($linha as $coluna => $valor){
					$dados[$i][$coluna] = $valor;
				}
				$i++;
			}
		}
		
		return $dados;
	}
	
	# FUNÇÃO PARA PADRONIZAR A INSERÇÃO DE NULL, INT, FLOAT OU STRING
	function db_vazio($valor, $statusNumero){
		$valor = trim($valor);
		if($valor == "")
			return NULL;
		else{
			if($statusNumero == true)
				return str_replace(",", ".", str_replace(".", "", $valor));
			else
				return $valor;
		}
	}
	
	# FUNÇÃO PARA PADRONIZAR A INSERÇÃO DE DATAS
	function db_data($data){
		$data = trim($data);
		if($data == "")
			return NULL;
		else
			return substr($data, 6, 4) . "-" . substr($data, 3, 2) . "-" . substr($data, 0, 2);
	}
	
	# FUNÇÃO PARA SALVAR OS REGISTROS DE QUALQUER TABELA NO BANCO DE DADOS
	function db_salvar($campos, $tabela){
		$dados = db_lista("SHOW COLUMNS FROM " . $tabela, array());
		foreach($dados as $dado){
			//echo $dado["Field"] . " ==>" . $dado["Type"] . "</br>"; 
			$arrayTipos[$dado["Field"]] = $dado["Type"];
			if($dado["Key"] == "PRI")
				$pk = $dado["Field"];
		}
		
		$i = 0;
		$arrayParametros[0] = "";
		if($campos[$pk] == ""){
			$inicioSql = "INSERT INTO " . $tabela . "(";
			$values = "";
			foreach($campos as $campo => $valor){
				if($campo != $pk){
					$inicioSql .= $campo . ", ";
					switch($arrayTipos[$campo]){
						case "text":
							$i++;
							$arrayValores[$i] = db_vazio($valor, false);
							$arrayParametros[0] .= "s";
							$values .= "?";
							break;
						
						case "date":
							$i++;
							$arrayValores[$i] = db_data($valor);
							$arrayParametros[0] .= "s";
							$values .= "?";
							break;
						
						case "float":
						case "double":
							$i++;
							$arrayValores[$i] = db_vazio($valor, true);
							$arrayParametros[0] .= "d";
							$values .= "?";
							break;
						
						case "datetime":
							if($valor == "CURRENT_TIMESTAMP")
								$values .= $valor;
							else{
								$i++;
								$arrayValores[$i] = db_vazio($valor, false);
								$arrayParametros[0] .= "s";
								$values .= "?";
							}
							
							break;
						
						default:
							if(strripos($arrayTipos[$campo], "int") !== false){
								$i++;
								$arrayValores[$i] = db_vazio($valor, true);
								$arrayParametros[0] .= "i";
								$values .= "?";
							}
							elseif(strripos($arrayTipos[$campo], "char") !== false){
								$i++;
								$arrayValores[$i] = db_vazio($valor, false);
								$arrayParametros[0] .= "s";
								$values .= "?";
							}
							
							break;
					}
					
					$values .= ", ";
				}
			}
			
			$sql = rtrim($inicioSql, ", ") . ") VALUES(" . rtrim($values, ", ") . ")";
		
			foreach($arrayValores as $i => $valor){
				$arrayParametros[$i] = & $arrayValores[$i];
			}
			
			db_query($sql, $arrayParametros);
			return db_id();
		}
		else{
			$i = 0;
			$arrayParametros[0] = $values = "";
			foreach($campos as $campo => $valor){
				if($campo == $pk){
					$where = " WHERE " . $campo . " = ?";
					if(is_numeric($valor))
						$valorPk = $valor;
					else
						$valorPk = descriptografarValor($valor);
				}
				else{
					switch($arrayTipos[$campo]){
						case "text":
							$i++;
							$arrayValores[$i] = db_vazio($valor, false);
							$arrayParametros[0] .= "s";
							break;
						
						case "date":
							$i++;
							$arrayValores[$i] = db_data($valor);
							$arrayParametros[0] .= "s";
							$values .= $campo . " = ?";
							break;
						
						case "float":
						case "double":
							$i++;
							$arrayValores[$i] = db_vazio($valor, true);
							$arrayParametros[0] .= "d";
							$values .= $campo . " = ?";
							break;
						
						case "datetime":
							if($valor == "CURRENT_TIMESTAMP")
								$values .= $campo . " = CURRENT_TIMESTAMP";
							else{
								$i++;
								$arrayValores[$i] = db_vazio($valor, false);
								$arrayParametros[0] .= "s";
								$values .= "'" . $campo . " = ?";
							}
							
							break;
						
						default:
							if(strripos($arrayTipos[$campo], "int") !== false){
								$i++;
								$arrayValores[$i] = db_vazio($valor, true);
								$arrayParametros[0] .= "i";
								$values .= $campo . " = ?";
							}
							elseif(strripos($arrayTipos[$campo], "char") !== false){
								$i++;
								$arrayValores[$i] = db_vazio($valor, false);
								$arrayParametros[0] .= "s";
								$values .= $campo . " = ?";
							}
							
							break;
					}
					
					$values .= ", ";
				}
			}
			
			$sql = "UPDATE " . $tabela . " SET " . rtrim($values, ", ") . $where;
			
			foreach($arrayValores as $i => $valor){
				$arrayParametros[$i] = & $arrayValores[$i];
			}
			
			$arrayParametros[0] .= "i";
			$arrayParametros[] = & $valorPk;
			
			db_query($sql, $arrayParametros);
			return $valorPk;
		}
	}
?>