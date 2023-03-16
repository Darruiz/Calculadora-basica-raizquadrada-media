<!DOCTYPE html>
<html>
<head>
	<title>Calculadora em PHP</title>
</head>
<body>

	<form method="post">
		<label>Valores:</label>
		<input type="text" name="valores" required><br><br>

		<label>Operação:</label>
		<select name="operacao" required>
			<option value="+">Adição</option>
			<option value="-">Subtração</option>
			<option value="*">Multiplicação</option>
			<option value="/">Divisão</option>
			<option value="sqrt">Raiz quadrada</option>
			<option value="media">Média</option>
		</select><br><br>

		<input type="submit" value="Calcular">
	</form>

	<?php 

		// Verifica se os valores foram enviados via POST
		if(isset($_POST['valores']) && isset($_POST['operacao'])){
			$valores = explode(",", $_POST['valores']);
			$operacao = $_POST['operacao'];

			// Verifica se os valores são numéricos
			foreach ($valores as $valor) {
				if(!is_numeric($valor)){
					echo "Valores inválidos. Por favor, insira apenas números.";
					exit;
				}
			}

			switch ($operacao) {
				case '+':
					$resultado = array_sum($valores);
					break;

				case '-':
					$resultado = $valores[0];
					for ($i=1; $i < count($valores); $i++) { 
						$resultado -= $valores[$i];
					}
					break;

				case '*':
					$resultado = array_product($valores);
					break;

				case '/':
					if(in_array(0, $valores)){
						$resultado = "Erro: divisão por zero.";
					}
					else{
						$resultado = $valores[0];
						for ($i=1; $i < count($valores); $i++) { 
							$resultado /= $valores[$i];
						}
					}
					break;

				case 'sqrt':
					if(count($valores) > 1){
						echo "Operação inválida para múltiplos valores.";
						exit;
					}
					elseif($valores[0] < 0){
						echo "Operação inválida para valores negativos.";
						exit;
					}
					else{
						$resultado = sqrt($valores[0]);
					}
					break;

				case 'media':
					$resultado = array_sum($valores)/count($valores);
					break;
					
				default:
					$resultado = "";
					break;
			}

			// Armazena o resultado no histórico de cálculos
			$historico = date('d/m/Y H:i:s')." - ".implode(" ".$operacao." ", $valores)." = ".$resultado."\n";
			file_put_contents('historico.txt', $historico, FILE_APPEND);

			echo "Resultado: ".$resultado;
		}
	?>

	
	<h3>Histórico de cálculos:</h3>
	<pre>
		<?php 
			// Exibe o histórico de cálculos
			$historico = file_get_contents('historico.txt');
			echo $historico;
		?>
	</pre>

</body>
</html>
