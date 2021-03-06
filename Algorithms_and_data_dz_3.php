
<?php

	//Урок 3. Рекурсия
// 1. Реализовать вывод меню на основе Clojure table.
// 2. Дано слово, состоящее только из строчных латинских букв. Проверить, является ли это слово палиндромом. 
// При решении этой задачи нельзя пользоваться циклами.
// 3. *Рассмотреть структуру данных Nested Sets. По возможности реализовать ее хранение и вывод меню.

	$check_palindrome ='';

	if (isset($_POST['check_palindrome'])) {
	$check_palindrome = (string) $_POST['check_palindrome'];
	}

	function checking_for_palindrome($check_palindrome)
	{
		if ($check_palindrome != null) {
			$l = strlen($check_palindrome);
			Check($check_palindrome, $l);
		}
	}

	function Check($check_palindrome, $l)	// ! ! ! php 7.1 ! ! !
	{
		if ($l > 0 && $check_palindrome[$l-1] !== $check_palindrome[$l*(-1)]) 
		{
			return print "No! It`s not a palindrome! &#9785;";
		} 
		elseif ($l > 0) 
		{
			return Check($check_palindrome, $l-1);
		}
		return print "Yes! It`s a palindrome!!! &#9786;";
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
			<label for="check_palindrome">Enter a word to check:</label>
			<input type="text" name="check_palindrome" id="check_palindrome" value="<?php echo $check_palindrome; ?>" tabindex="1" placeholder="<?php echo $check_palindrome; ?>" style="width: 60%;"/>
			<input type="submit" value="Check" style="float: right; margin: 0 5%;"/>
		</div>
		<br>
		<div style="width: 200px; margin: 0 auto;">
			<p>
				<?php echo checking_for_palindrome($check_palindrome); ?>
			</p>
		</div>
		
	</form>

</body>
</html>

<?php // - - - - Closure Table - - - - -

	function get_data($sql)
	{
		$database = 'algorithms_and_data';
  		$user = 'root';
  		$pass = '';
  		$host = 'localhost';
  		$charset = 'utf8';
  		$options = [
        	\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
     	];
     	$dsn = "mysql:host=$host;dbname=$database;charset=$charset";

     	$pdo = new PDO($dsn, $user, $pass, $options);

     	// $sql = 'SELECT * FROM categories AS c JOIN category_links AS cl ON c.id_category = cl.child_id WHERE cl.parent_id = 1';
     	// $sql = 'SELECT * FROM categories AS c JOIN category_links AS cl ON c.id_category = cl.child_id';

		$get_data = $pdo->query($sql);
		$pdo = null;

		$data = $get_data->fetchAll();

		// echo "<pre>";
		// echo "get_data";
		// var_dump($data);
		// echo "</pre>";

		return $data;
	}

	function get_closure()
	{
		$sql = 'SELECT * FROM categories AS c JOIN category_links AS cl ON c.id_category = cl.child_id';
		return get_data($sql);
	}

	function get_nested()
	{
		$sql = 'SELECT * FROM nested_sets';
		return get_data($sql);
	}

	function rebuildArray($categories) {
   	$result = [];

   	foreach ($categories as $category) {
   	   if(!isset($result[$category['level']]))
   	   {
   	      $result[$category['level']] = [];
   	   }
   	   $result[$category['level']][$category['child_id']] = $category;
   	}

   	// echo "<pre>";
   	// echo "rebuildArray result ";
   	// var_dump($result);
   	// echo "</pre>";
   	return $result;
	}
	
	function buildTree($categories, $lvl = 0) {
		if (isset($categories[$lvl])) 
		{
   		$html = '<ul>';

   		foreach ($categories[$lvl] as $category) {

      		$html .= '<li>' . $category['category_name'];

      		if($category['parent_id'] == $category['child_id'])
      		{
      	      $html .= buildTree($categories, $category['level']+1);
      		}
      		$html .= '</li>';
   		}

   		$html .= '</ul>';


   		// echo "<pre>";
   		// echo "html";
   		// var_dump($html);
   		// echo "</pre>";
   		return $html;
   	}
	}

	function getTree($categories) {
   	return buildTree(rebuildArray($categories));
	}
	echo getTree(get_closure());

?>

<?php // - - - - - Nested sets - - - - -
	echo "<pre>";
	// var_dump(get_nested());
	// var_dump(rebuildNnestedArray(get_nested()));
	var_dump(buildNnestedTree(rebuildNnestedArray(get_nested())));
	// var_dump(buildNnestedTree());
	echo "</pre>";

	function rebuildNnestedArray($categories) {
   	$result = [];

   	foreach ($categories as $category) {
   	   if(!isset($result[$category['level']]))
   	   {
   	      $result[$category['level']] = [];
   	   }
   	   $result[$category['level']][$category['nleft']] = $category;
   	}
   	return $result;
	}

	function buildNnestedTree($categories, $lvl = 1) 
	{
		if (isset($categories[$lvl]))
		{
   		$html = '<ul>';

   		foreach ($categories[$lvl] as $category) {
   			
      		$html .= '<li>' . $category['id'];

      		if($category['nright'] !== $category['nleft']+1)
      		{
      			$html .= buildNnestedTree($categories, $category['level']+1);
      		}
      		//$html .= buildNnestedTree($categories, $category['nleft']+1);
      		$html .= '</li>';
   		}

   		$html .= '</ul>';


   		// echo "<pre>";
   		// echo "html";
   		// var_dump($html);
   		// echo "</pre>";
   		return $html;
   	}
	}
?>