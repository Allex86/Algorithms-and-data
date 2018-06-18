
<?php 
	$dir_way ='';
	if (isset($_POST['dir_name'])) {
		$dir_way = (string) $_POST['dir_name'];
	}

	$text ='';
	if (isset($_POST['textarea'])) {
		$text = (string) $_POST['textarea'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<form action="#" method="post">
		<div>
			<label for="dir_name">Enter directory name:</label>
			<input type="text" name="dir_name" id="dir_name" value="<?php echo $dir_way; ?>" tabindex="1" placeholder="<?php echo $dir_way; ?>" style="width: 60%;"/>
			<input type="submit" value="Go" style="float: right; margin: 0 5%;"/>
		</div>
	</form>

	<br>

	<form action="#" method="post">
		<div>
			<label for="textarea">Checking brackets in the text:</label>
			<br>
			<textarea cols="40" rows="8" name="textarea" id="textarea" value="<?php echo $text; ?>"></textarea>
			<input type="submit" value="Check"/>
		</div>
	</form>

</body>
</html>

<?php 
	// 1. Написать аналог «Проводника» в Windows для директорий на сервере при помощи итераторов.
	// 
	// var_dump($_POST);
	// $dir_way = $_POST['dir_name'];
	if ($dir_way) 
	{
		if (file_exists($dir_way))
		{
			$dir = new DirectoryIterator($dir_way); // C:\
			// var_dump($dir->getPath());
			foreach ($dir as $item) 
			{
				if (!$item->isDot()) 
				{
					echo "<pre>";
					var_dump($item->getType() ." : ". $item->getFilename());
					echo "</pre>";
				}
			}
		} else {
			echo "Enter the correct directory name!";
		}
	} else {
		// echo "Enter directory name!";
	}

	// 2.5 Написать класс, содержащий метод проверки правильности расстановки скобочек с помощью стека.

	// $text =  '{Какой-то[текст]со (скобками)}';
	$open_brackets = ["{", "(", "["];
	$close_brackets = ["}", ")", "]"];

	if ($text) 
	{
		$errors = 0;
		$check_this = str_split($text);
		$stack = new SplStack();

		foreach ($check_this as $value) 
		{
			if (in_array($value, $open_brackets)) {
				$stack->push($value);
			} elseif (in_array($value, $close_brackets) && !$stack->isEmpty()) {
				$stack->pop();
			} elseif (in_array($value, $close_brackets) && $stack->isEmpty()) {
				echo "Warning! There are unopened brackets in the text.";
				$errors = 1;
			}
		}

		if (!$stack->isEmpty() && $errors == 0) {
			echo "! ! ! The text has open brackets ! ! !";
		} elseif ($stack->isEmpty() && $errors == 0) {
			echo "That is all right. Open brackets none.";
		}
	}
?>