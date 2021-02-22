<?php
require_once("Question.class.php");
require_once("questions.inc.php");
Question::$affichageSolution = Question::SOLUTION_INTERACTIF;
$affichage = '';
$affichage .= Question::html_questionnaire($questions);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
		<title>Exercices SQL - SELECT</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="Viewport" content="width=device-width; height=device-height"/>
		<link rel="stylesheet" type="text/css" href="page.css" />
		<link rel="stylesheet" type="text/css" href="exercice.css" />
	</head>
	<body>
		<div class="interface"><h1>Exercices SQL - SELECT</h1>
			<!-- <p>Installer la base de données &laquo; pays &raquo; sur votre poste (localhost) et faire afficher les données suivantes dans phpMyAdmin.</p> -->
			<p>Ouvrir la base de données <a href="monde.sqlite" download="monde.sqlite">&dArr;<code>monde.sqlite</code></a> dans SQLite browser et faire afficher les données suivantes en utilisant la bonne commande SQL.</p>
			<hr/>
				<?php echo $affichage; ?></div>
	</body>
</html>