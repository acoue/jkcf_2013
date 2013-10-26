<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="fr">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>JKCF</title>
	<link rel="stylesheet" media="all" href=style/base.css>
	<link rel="stylesheet" media="all" href="style/grid.css">
	<link rel="stylesheet" media="all" href="style/menu.css">
	<script type="text/javascript" src="libs/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
	        selector: "textarea",
	        plugins: [
	                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
	                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
	        ],
	
	        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
	        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
	        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
	
	        menubar: false,
	        toolbar_items_size: 'small',
	
	        style_formats: [
	                {title: 'Bold text', inline: 'b'},
	                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	                {title: 'Example 1', inline: 'span', classes: 'example1'},
	                {title: 'Example 2', inline: 'span', classes: 'example2'},
	                {title: 'Table styles'},
	                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	        ],
	
	        templates: [
	                {title: 'Test template 1', content: 'Test 1'},
	                {title: 'Test template 2', content: 'Test 2'}
	        ]
	});
	</script>
	
	<!-- Photo : lightbox -->
	<script src="libs/lightbox/js/jquery-1.10.2.min.js"></script>
	<script src="libs/lightbox/js/lightbox-2.6.min.js"></script>
	<link href="libs/lightbox/css/lightbox.css" rel="stylesheet" />
</head>
<body>
	<header>
		<h1>Judo Kendo Club Fontenay-le-Comte</h1>
		<div class="site-description">Le Judo Kendo Club Fontenaisien est un Dojo Vend&eacute;en retranch&eacute; &agrave; Fontenay-le-Comte, o&ugrave; l'on pratique 7 disciplines d'arts martiaux : Judo, Kendo, A&iuml;kido, Ia&iuml;do, Ju-jitsu, Ta&iuml;so et Babydo</div>
	</header>
<?php require CHEMIN_VUE.'menu.php'; ?>	
	<div class="row">
		<div class="span2"><p></p></div>
		<div class="span8 blue"><p>Retrouvez le blablablara&iuml; au dojo ou en version num&eacute;rique sur le site.</span><span class="lienNoir"> 
				<a href="<?php echo CHEMIN_DOC.'blabla.pdf'?>" target="_blank">T&eacute;l&eacute;chargez le ici</a></span></p></div>
	</div>
	<div class="row">
<?php if (utilisateurConnected() !== '1') {?>
		<div role="main" class="span8">
<?php } else {?>
		<div role="main" class="span12">
<?php } ?>

<!-- #contenu -->
<?php echo $contenu ?>				
		</div>
<?php if (utilisateurConnected() !== '1') {?>
		<aside class="span4">
			<h2>Professeurs</h2>
			<p>
				Phasellus non tempus ante. Nunc luctus accumsan est sit amet bibendum. Vestibulum
				ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris
				ornare adipiscing porta. Curabitur sit amet felis lacus. Nulla eros metus, vestibulum
				nec mollis ac, rutrum et tortor. Fusce non metus metus, nec blandit felis. Donec
				sagittis lacinia leo sit amet pharetra. Nullam eget purus vitae turpis aliquam commodo
				vitae et neque. Pellentesque habitant morbi tristique senectus et netus et malesuada
				fames ac turpis egestas. In ac lectus sit amet magna egestas fringilla vitae at
				diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames
				ac turpis egestas. Fusce vehicula leo quis enim laoreet in accumsan leo porttitor.
			</p>
			<hr/>
			<h2>Venir au Club</h2>
			<p align='justify'>Le Dojo se situe &agrave; la Plaine des sports de Fontenay-le-Comte, en face du coll&egrave;ge Fran&ccedil;ois Vi&egrave;tes. On y acc&egrave;de par la rocade.</p>			
			<p align='center'>
			<iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+85200+Fontenay-le-Comte&amp;sll=46.75984,1.738281&amp;sspn=8.354699,14.128418&amp;ie=UTF8&amp;hq=&amp;hnear=Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+85200+Fontenay-le-Comte,+Vend%C3%A9e,+Pays+de+la+Loire&amp;t=h&amp;ll=46.462871,-0.817108&amp;spn=0.017737,0.025749&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+85200+Fontenay-le-Comte&amp;sll=46.75984,1.738281&amp;sspn=8.354699,14.128418&amp;ie=UTF8&amp;hq=&amp;hnear=Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+85200+Fontenay-le-Comte,+Vend%C3%A9e,+Pays+de+la+Loire&amp;t=h&amp;ll=46.462871,-0.817108&amp;spn=0.017737,0.025749&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Agrandir le plan</a></small>
			
			</p>
<?php } ?>
<?php 
if (utilisateurConnected() !== '1') {
	echo "<hr/><h2>Se connecter</h2>
				<p>
				<form action='index.php?action=connexion' method='post'>
					<table width='90%' align='center'>
						<tr>
							<td width='50%'><label for='nom_utilisateur'>Login</strong></label></td>
							<td><input type='text' name='nom_utilisateur' id='nom_utilisateur' size='30px'/></td>
						</tr>
						<tr>
							<td><label for='mot_de_passe'>Password</strong></label></td>
							<td><input type='password' name='mot_de_passe' id='mot_de_passe' size='30px'/></td>
						</tr>
						<tr>
							<td colspan='2' align='center'><input type='submit' name='connexion' value='Se connecter'/></td>
						</tr>
					</table>				
				</form>
			</p>";
			} 
?>
		</aside>
	</div>
	<footer>
		&copy; Judo Kendo Club Fontenay-le-Comte
	</footer>
</body>
</html>
			
