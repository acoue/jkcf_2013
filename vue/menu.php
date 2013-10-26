	<nav>
		<ul class="menu"> 
			<li><a href="index.php?action=accueil">Accueil</a></li>
			<li><a href="#">Disciplines</a>			 
				<ul>
					<li><a href="index.php?action=afficherDiscipline&id=1">Judo</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=2">Kendo</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=3">A&iuml;kido</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=4">Ia&iuml;do</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=5">Ju Jitsu</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=6">Ta&iuml;so</a></li>
					<li><a href="index.php?action=afficherDiscipline&id=7">Babydo</a></li>
				</ul>			 
			</li>				
			<li><a href="index.php?action=afficherListeResultat">R&eacute;sultats</a></li>
			<li><a href="index.php?action=afficherPhoto">Photos</a></li>
			<li><a href="index.php?action=afficherHoraire">Horaires</a></li>
			<li><a href="index.php?action=afficherCotisation">Cotisations</a></li>
			<li><a href="index.php?action=afficherListeCeinture">Ceintures Noires</a></li>
			<li><a href="index.php?action=afficherLien">Liens</a></li>
			<li><a href="#">Newsletter</a>
				<ul>
					<li><a href="index.php?action=afficherNewsletter">En cours</a></li>
					<li><a href="index.php?action=afficherListeNewsletter">Archive</a></li>
					<li><a href="index.php?action=inscrireNewsletterFormulaire">S'inscrire</a></li>
				</ul>
			</li>
			<li><a href="index.php?action=afficherContact">Nous contacter</a></li>	
<?php   
if($_SESSION['isAdmin'] == "1") echo "   <li><a href='#'>Administration</a>";	 
if($_SESSION['isAdmin'] == "1") echo "   	<ul>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionArticle'>Article</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionCeinture'>Ceintures</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionContact'>Contact</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionCotisation'>Cotisations</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionDiscipline'>Discipline</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionDocument'>Document</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionHoraire'>Horaires</a></li>";
//if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionPhoto'>Photo</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionLien'>Liens</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionNewsletter'>Newsletter</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionPassword'>Password</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionResultat'>R&eacute;sultat</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   		<li><a href='index.php?action=gestionUtilisateur'>Utilisateur</a></li>";
if($_SESSION['isAdmin'] == "1") echo "   	</ul>";
if($_SESSION['isAdmin'] == "1") echo "   </li>";
if($_SESSION['isAdmin'] == "1") echo "   <li><a href='index.php?action=deconnexion'>D&eacute;connexion</a></li>";
?>
		</ul>
	</nav>	
