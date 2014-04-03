<?php
function shuffle_string($str = null)
{
	if (!is_null($str))
	{
		$str_array = str_split(trim($str));
		shuffle($str_array);
		foreach ($str_array as $key => $char)
		{
			if (empty($char) || $char == ' ')
			{
				unset($str_array[$key]);
			}
		}
		$str = implode('', $str_array);
		return $str;
	}
	else
	{
		return FALSE;
	}
}
function strToHex($string)
{
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}
if (isset($_POST['stringToEncrypt']))
{
	$results = array(
		'Encryption' => array(
			'MD5 Hash' => md5($_POST['stringToEncrypt']),
			'SHA1 Hash' => sha1($_POST['stringToEncrypt']),
			'Base64 Encode' => base64_encode($_POST['stringToEncrypt']),
			'Hex Encode' => strToHex($_POST['stringToEncrypt']),
			),
		'Formats' => array(
			'Shuffled' => shuffle_string($_POST['stringToEncrypt']),
			'Uppercase' => strtoupper($_POST['stringToEncrypt']),
			'Lowercase' => strtolower($_POST['stringToEncrypt']),
			)
		);
}
?>
<html>
<head>
	<title>String Functions - JamieHoward.co </title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		.encrypt-form-button {margin-top: 15px;}
		.panel-body {overflow: scroll; font-size: .85em;}
		.panel-content {margin-right: 15px;}
	</style>
</head>
<body>
	<div class="container">
		<div class="row-fluid">
			<h1 class="header">String functions</h1> 
			<form action="./index.php" class="form-horizontal" method="POST">
				<div class="control-group">
					<label for="string-to-encrypt" class="control-label">String to transform</label>
					<textarea id="string-to-encrypt" name="stringToEncrypt" class="form-control"><?php if ($_POST['stringToEncrypt']) { echo $_POST['stringToEncrypt']; } ?></textarea>
				</div>
				<div class="control-group">
					<input id="encrypt-submit-button" type="submit" value="Transform!" class="btn btn-primary encrypt-form-button"/>
					<a href="./index.php" target="_self" class="btn btn-warning encrypt-form-button">Reset</a>
				</div>
			</form>
		</div>
		<?php if (!empty($_POST)): ?>
		<div class="row-fluid">
			<h2>Results</h2>
			<?php foreach ($results as $category => $items): ?>
			<div class="col-lg-12">
				<h3><?php echo $category;?></h3>
				<?php $i = 1;
				foreach ($items as $title => $value): ?>
					<div class="col-lg-3">
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo $title;?></div>
							<div class="panel-body">
								<p class="panel-content"><?php if (!is_array($value)) { echo $value; } else { print_r($value); } ?></p>
							</div>
						</div>
					</div>
				<?php $i++; endforeach;?>
			</div>
		<?php endforeach;?>
		</div>
		<?php endif;?>
		<footer class="row-fluid">
			<hr />
			<p>
				Thrown together by <a href="http://github.com/blackairplane">Jamie Howard</a>
			 	<a href="https://twitter.com/share" class="twitter-share-button" data-via="JamieHoward">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</p>
		</footer>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>