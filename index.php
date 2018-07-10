<?php
//function trim enlève les espace en début et en fin de chaînes
//stripslashes enlève les backslashes
//Convertit les caractères spéciaux en entités HTML (style & ->	&amp;)
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$objetMail = array();

$prenom = $nom = $email = $pays = $message = $sexe = $service = "";

$prenonErr = $nomErr = $emailErr = $paysErr = $messageErr = $sexeErr = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
  if (empty($_POST["prenom"])) {
    $prenomErr = "Veuillez indiquer un prénom <br>";
    echo $prenomErr . '<br>';
  }elseif (empty($_POST["nom"])) {
    $nomErr = "Veuillez indiquer un nom <br>";
    echo $nomErr . '<br>';
  }elseif (empty($_POST["email"])) {
    $emailErr = "Veuillez indiquer une adresse email valide <br>";
    echo $emailErr . '<br>';
  }elseif (empty($_POST["message"])) {
      $messageErr = "Veuillez inscrire un message d'accompagnement <br>";
      echo $messageErr;
      echo '<br>';
  }
  else {
    //Créer un tableau contenant les filtres
    $filterOption = array(
      'prenom' => FILTER_SANITIZE_STRING,
      'nom' => FILTER_SANITIZE_STRING,
      'email' => FILTER_SANITIZE_EMAIL,
      'message' => FILTER_SANITIZE_STRING
    );
    // Crée une variable $objetMail avec la fonction filter_input_array. Comme son nom l'indique, la fonction va également retourner un Array() qui sera associatif. Cette fonction doit recevoir au moins deux arguments: ici INPUT_POST pour récupérer les valeurs encodées dans le champs et la variable $filterOption pour appliquer les filtres.
    $objetMail = filter_input_array(INPUT_POST, $filterOption);
    //   Et voilà, tous vos champs ont été sanitisés ! En cas de problème, la fonction retourne un NULL si la variable est vide et un FALSE s'il y a eu une erreur.
    if ($objetMail != null AND $objetMail != FALSE) {
    	echo "Tous les champs ont été nettoyés !<br>";
    } else {
    	echo "Un champ est vide ou n'est pas correct! <br>";
    }
  }
  if (empty($_POST["pays"])) {
    $paysErr = "Veuillez sélectionner un choix de pays <br>";
    echo $paysErr;
    echo '<br>';
  }
  else {
    $pays = $_POST["pays"];
    $objetMail += ['pays' => $pays];
  }
  if (empty($_POST["genre"])) {
    $sexeErr = "Veuillez indiquer de quel sexe vous êtes<br>";
    echo $sexeErr;
    echo '<br>';
  }
  {
    $sexe = $_POST["genre"];
    $objetMail += ['sexe' => $sexe];
  }
  if (empty($_POST["service"])) {
    $serviceErr = "Veuillez faire un choix <br>";
    echo $serviceErr;
    echo '<br>';
  }
  else
  {
    $service = $_POST["service"];
    $objetMail += ['service' => $service];
  }
  foreach($filterOption as $key => $value)
  {
     $objetMail[$key]=test_input($objetMail[$key]);
  }
  $mail_origin = $objetMail['email'];
  $mail_to  = 'd4nz0r@gmail.com';
  $mail_subject = $objetMail['service'];
  $headers = "From: HackersPoulette.com\r\n";
  $headers .= "MIME-Version: 1.0 \r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
  $mail_msg = '
                <html>
                <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <title>HackersPoulette.com</title>
                </head>
                <body style="background-color : #303030; font-family: Arial, Helvetica, sans-serif; color : #15c5bd;">

                  <tabl>
                    <tr>
                      <th><h1 style="color: #15c5bd;">HackersPoulette.com - Mail</h1></th>
                    </tr>
                    <tr>
                      <td>Nom :</td>
                      <td style="color: #FFF;"><strong>' . $objetMail['nom'] . '</strong></td>
                    </tr>
                    <tr>
                      <td>Prénom :</td>
                      <td style="color: #FFF;">' . $objetMail['prenom'] . '</td>
                    </tr>
                    <tr>
                      <td>Pays :</td>
                      <td style="color: #FFF;">' . $objetMail['pays'] . '</td>
                    </tr>
                    <tr>
                      <td>Sexe :</td>
                      <td style="color: #FFF;">' . $objetMail['sexe'] . '</td>
                    </tr>
                    <tr>
                      <td>Service :</td>
                      <td style="color: #FFF;">' . $objetMail['service'] . '</td>
                    </tr>
                    <tr>
                      <td colspan="2">Message :</td>
                    </tr>
                    <tr>
                      <td colspan="2" style="color: #FFF;">' . $objetMail['message'] . '</td>
                    </tr>
                  </table>
                </body>
                </html>
              ';
  if(mail($mail_to, $mail_subject, $mail_msg, $headers)) {
    echo "le message à été envoyé";
  }else{
  echo "le message n'a pas été envoyé et donc mail n'est pas installé";
  }
}
 ?>

	<!DOCTYPE html>
	<html lang="fr" xml:lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Hackers Poulette</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/HackersPoulette.css">
		<!-- Github follow button -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>

		<!--Header-->
		<header>
			<img src="images/hackers-poulette-logo.png" class="img-responsive imgcenter" alt="logo hackers poulette">
			<h1 class="titreglob text-center">Hackers Poulette</h1>
			<h2 class="text-center">Combining chickens & technology</h2>
			<div class="jumbotron text-center">
				<img src="images/raspberry.JPG" class="img-responsive imgcenter" alt="raspberry">
			</div>
		</header>
		<!--Section-->
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h2>Nous contacter</h2>
				</div>
				<div class="well well-lg">
					<form class="form-horizontal" method="post" action="index.php">

						<div class="form-group">
							<label class="control-label col-sm-2" for="prenom">Prénom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-lg" placeholder="Entrez un prénom" id="prenom" name="prenom">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="nom">Nom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-lg" placeholder="Entrez un nom" id="nom" name="nom">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-lg" placeholder="Entrez un email" id="email" name="email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="pays">Pays</label>
							<div class="col-sm-10">
								<select class="form-control" name="pays">
									<option value="" selected="selected">Choisissez un pays</option>
									<option value="0">Aucun</option>
									<option value="AF">AFGHANISTAN</option>
									<option value="ZA">AFRIQUE DU SUD</option>
									<option value="AX">ÅLAND, ÎLES</option>
									<option value="AL">ALBANIE</option>
									<option value="DZ">ALGÉRIE</option>
									<option value="DE">ALLEMAGNE</option>
									<option value="AD">ANDORRE</option>
									<option value="AO">ANGOLA</option>
									<option value="AI">ANGUILLA</option>
									<option value="AQ">ANTARCTIQUE</option>
									<option value="AG">ANTIGUA-ET-BARBUDA</option>
									<option value="AN">ANTILLES NÉERLANDAISES</option>
									<option value="SA">ARABIE SAOUDITE</option>
									<option value="AR">ARGENTINE</option>
									<option value="AM">ARMÉNIE</option>
									<option value="AW">ARUBA</option>
									<option value="AU">AUSTRALIE</option>
									<option value="AT">AUTRICHE</option>
									<option value="AZ">AZERBAÏDJAN</option>
									<option value="BS">BAHAMAS</option>
									<option value="BH">BAHREÏN</option>
									<option value="BD">BANGLADESH</option>
									<option value="BB">BARBADE</option>
									<option value="BY">BÉLARUS</option>
									<option value="BE">BELGIQUE</option>
									<option value="BZ">BELIZE</option>
									<option value="BJ">BÉNIN</option>
									<option value="BM">BERMUDES</option>
									<option value="BT">BHOUTAN</option>
									<option value="BO">BOLIVIE</option>
									<option value="BA">BOSNIE-HERZÉGOVINE</option>
									<option value="BW">BOTSWANA</option>
									<option value="BV">BOUVET, ÎLE</option>
									<option value="BR">BRÉSIL</option>
									<option value="BN">BRUNÉI DARUSSALAM</option>
									<option value="BG">BULGARIE</option>
									<option value="BF">BURKINA FASO</option>
									<option value="BI">BURUNDI</option>
									<option value="KY">CAÏMANES, ÎLES</option>
									<option value="KH">CAMBODGE</option>
									<option value="CM">CAMEROUN</option>
									<option value="CA">CANADA</option>
									<option value="CV">CAP-VERT</option>
									<option value="CF">CENTRAFRICAINE, RÉPUBLIQUE</option>
									<option value="CL">CHILI</option>
									<option value="CN">CHINE</option>
									<option value="CX">CHRISTMAS, ÎLE</option>
									<option value="CY">CHYPRE</option>
									<option value="CC">COCOS (KEELING), ÎLES</option>
									<option value="CO">COLOMBIE</option>
									<option value="KM">COMORES</option>
									<option value="CG">CONGO</option>
									<option value="CD">CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU</option>
									<option value="CK">COOK, ÎLES</option>
									<option value="KR">CORÉE, RÉPUBLIQUE DE</option>
									<option value="KP">CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE</option>
									<option value="CR">COSTA RICA</option>
									<option value="CI">CÔTE D'IVOIRE</option>
									<option value="HR">CROATIE</option>
									<option value="CU">CUBA</option>
									<option value="DK">DANEMARK</option>
									<option value="DJ">DJIBOUTI</option>
									<option value="DO">DOMINICAINE, RÉPUBLIQUE</option>
									<option value="DM">DOMINIQUE</option>
									<option value="EG">ÉGYPTE</option>
									<option value="SV">EL SALVADOR</option>
									<option value="AE">ÉMIRATS ARABES UNIS</option>
									<option value="EC">ÉQUATEUR</option>
									<option value="ER">ÉRYTHRÉE</option>
									<option value="ES">ESPAGNE</option>
									<option value="EE">ESTONIE</option>
									<option value="US">ÉTATS-UNIS</option>
									<option value="ET">ÉTHIOPIE</option>
									<option value="FK">FALKLAND, ÎLES (MALVINAS)</option>
									<option value="FO">FÉROÉ, ÎLES</option>
									<option value="FJ">FIDJI</option>
									<option value="FI">FINLANDE</option>
									<option value="FR">FRANCE</option>
									<option value="GA">GABON</option>
									<option value="GM">GAMBIE</option>
									<option value="GE">GÉORGIE</option>
									<option value="GS">GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD</option>
									<option value="GH">GHANA</option>
									<option value="GI">GIBRALTAR</option>
									<option value="GR">GRÈCE</option>
									<option value="GD">GRENADE</option>
									<option value="GL">GROENLAND</option>
									<option value="GP">GUADELOUPE</option>
									<option value="GU">GUAM</option>
									<option value="GT">GUATEMALA</option>
									<option value="GG">GUERNESEY</option>
									<option value="GN">GUINÉE</option>
									<option value="GW">GUINÉE-BISSAU</option>
									<option value="GQ">GUINÉE ÉQUATORIALE</option>
									<option value="GY">GUYANA</option>
									<option value="GF">GUYANE FRANÇAISE</option>
									<option value="HT">HAÏTI</option>
									<option value="HM">HEARD, ÎLE ET MCDONALD, ÎLES</option>
									<option value="HN">HONDURAS</option>
									<option value="HK">HONG-KONG</option>
									<option value="HU">HONGRIE</option>
									<option value="IM">ÎLE DE MAN</option>
									<option value="UM">ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS</option>
									<option value="VG">ÎLES VIERGES BRITANNIQUES</option>
									<option value="VI">ÎLES VIERGES DES ÉTATS-UNIS</option>
									<option value="IN">INDE</option>
									<option value="ID">INDONÉSIE</option>
									<option value="IR">IRAN, RÉPUBLIQUE ISLAMIQUE D'</option>
									<option value="IQ">IRAQ</option>
									<option value="IE">IRLANDE</option>
									<option value="IS">ISLANDE</option>
									<option value="IL">ISRAËL</option>
									<option value="IT">ITALIE</option>
									<option value="JM">JAMAÏQUE</option>
									<option value="JP">JAPON</option>
									<option value="JE">JERSEY</option>
									<option value="JO">JORDANIE</option>
									<option value="KZ">KAZAKHSTAN</option>
									<option value="KE">KENYA</option>
									<option value="KG">KIRGHIZISTAN</option>
									<option value="KI">KIRIBATI</option>
									<option value="KW">KOWEÏT</option>
									<option value="LA">LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE</option>
									<option value="LS">LESOTHO</option>
									<option value="LV">LETTONIE</option>
									<option value="LB">LIBAN</option>
									<option value="LR">LIBÉRIA</option>
									<option value="LY">LIBYENNE, JAMAHIRIYA ARABE</option>
									<option value="LI">LIECHTENSTEIN</option>
									<option value="LT">LITUANIE</option>
									<option value="LU">LUXEMBOURG</option>
									<option value="MO">MACAO</option>
									<option value="MK">MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE</option>
									<option value="MG">MADAGASCAR</option>
									<option value="MY">MALAISIE</option>
									<option value="MW">MALAWI</option>
									<option value="MV">MALDIVES</option>
									<option value="ML">MALI</option>
									<option value="MT">MALTE</option>
									<option value="MP">MARIANNES DU NORD, ÎLES</option>
									<option value="MA">MAROC</option>
									<option value="MH">MARSHALL, ÎLES</option>
									<option value="MQ">MARTINIQUE</option>
									<option value="MU">MAURICE</option>
									<option value="MR">MAURITANIE</option>
									<option value="YT">MAYOTTE</option>
									<option value="MX">MEXIQUE</option>
									<option value="FM">MICRONÉSIE, ÉTATS FÉDÉRÉS DE</option>
									<option value="MD">MOLDOVA, RÉPUBLIQUE DE</option>
									<option value="MC">MONACO</option>
									<option value="MN">MONGOLIE</option>
									<option value="MS">MONTSERRAT</option>
									<option value="MZ">MOZAMBIQUE</option>
									<option value="MM">MYANMAR</option>
									<option value="NA">NAMIBIE</option>
									<option value="NR">NAURU</option>
									<option value="NP">NÉPAL</option>
									<option value="NI">NICARAGUA</option>
									<option value="NE">NIGER</option>
									<option value="NG">NIGÉRIA</option>
									<option value="NU">NIUÉ</option>
									<option value="NF">NORFOLK, ÎLE</option>
									<option value="NO">NORVÈGE</option>
									<option value="NC">NOUVELLE-CALÉDONIE</option>
									<option value="NZ">NOUVELLE-ZÉLANDE</option>
									<option value="IO">OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L'</option>
									<option value="OM">OMAN</option>
									<option value="UG">OUGANDA</option>
									<option value="UZ">OUZBÉKISTAN</option>
									<option value="PK">PAKISTAN</option>
									<option value="PW">PALAOS</option>
									<option value="PS">PALESTINIEN OCCUPÉ, TERRITOIRE</option>
									<option value="PA">PANAMA</option>
									<option value="PG">PAPOUASIE-NOUVELLE-GUINÉE</option>
									<option value="PY">PARAGUAY</option>
									<option value="NL">PAYS-BAS</option>
									<option value="PE">PÉROU</option>
									<option value="PH">PHILIPPINES</option>
									<option value="PN">PITCAIRN</option>
									<option value="PL">POLOGNE</option>
									<option value="PF">POLYNÉSIE FRANÇAISE</option>
									<option value="PR">PORTO RICO</option>
									<option value="PT">PORTUGAL</option>
									<option value="QA">QATAR</option>
									<option value="RE">RÉUNION</option>
									<option value="RO">ROUMANIE</option>
									<option value="GB">ROYAUME-UNI</option>
									<option value="RU">RUSSIE, FÉDÉRATION DE</option>
									<option value="RW">RWANDA</option>
									<option value="EH">SAHARA OCCIDENTAL</option>
									<option value="SH">SAINTE-HÉLÈNE</option>
									<option value="LC">SAINTE-LUCIE</option>
									<option value="KN">SAINT-KITTS-ET-NEVIS</option>
									<option value="SM">SAINT-MARIN</option>
									<option value="PM">SAINT-PIERRE-ET-MIQUELON</option>
									<option value="VA">SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)</option>
									<option value="VC">SAINT-VINCENT-ET-LES GRENADINES</option>
									<option value="SB">SALOMON, ÎLES</option>
									<option value="WS">SAMOA</option>
									<option value="AS">SAMOA AMÉRICAINES</option>
									<option value="ST">SAO TOMÉ-ET-PRINCIPE</option>
									<option value="SN">SÉNÉGAL</option>
									<option value="CS">SERBIE-ET-MONTÉNÉGRO</option>
									<option value="SC">SEYCHELLES</option>
									<option value="SL">SIERRA LEONE</option>
									<option value="SG">SINGAPOUR</option>
									<option value="SK">SLOVAQUIE</option>
									<option value="SI">SLOVÉNIE</option>
									<option value="SO">SOMALIE</option>
									<option value="SD">SOUDAN</option>
									<option value="LK">SRI LANKA</option>
									<option value="SE">SUÈDE</option>
									<option value="CH">SUISSE</option>
									<option value="SR">SURINAME</option>
									<option value="SJ">SVALBARD ET ÎLE JAN MAYEN</option>
									<option value="SZ">SWAZILAND</option>
									<option value="SY">SYRIENNE, RÉPUBLIQUE ARABE</option>
									<option value="TJ">TADJIKISTAN</option>
									<option value="TW">TAÏWAN, PROVINCE DE CHINE</option>
									<option value="TZ">TANZANIE, RÉPUBLIQUE-UNIE DE</option>
									<option value="TD">TCHAD</option>
									<option value="CZ">TCHÈQUE, RÉPUBLIQUE</option>
									<option value="TF">TERRES AUSTRALES FRANÇAISES</option>
									<option value="TH">THAÏLANDE</option>
									<option value="TL">TIMOR-LESTE</option>
									<option value="TG">TOGO</option>
									<option value="TK">TOKELAU</option>
									<option value="TO">TONGA</option>
									<option value="TT">TRINITÉ-ET-TOBAGO</option>
									<option value="TN">TUNISIE</option>
									<option value="TM">TURKMÉNISTAN</option>
									<option value="TC">TURKS ET CAÏQUES, ÎLES</option>
									<option value="TR">TURQUIE</option>
									<option value="TV">TUVALU</option>
									<option value="UA">UKRAINE</option>
									<option value="UY">URUGUAY</option>
									<option value="VU">VANUATU</option>
									<option value="VE">VENEZUELA</option>
									<option value="VN">VIET NAM</option>
									<option value="WF">WALLIS ET FUTUNA</option>
									<option value="YE">YÉMEN</option>
									<option value="ZM">ZAMBIE</option>
									<option value="ZW">ZIMBABWE</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="message">Message</label>
							<div class="col-sm-10">
								<textarea class="form-control input-lg" placeholder="Ecrivez ici votre message" id="message" name="message"></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
							</div>
							<div class="col-sm-10">
								<div class="radio">
									<label>
									<input type="radio" value="femme" id="femme" name="genre">Femme</label>
								</div>
								<div class="radio">
								<label>
								<input type="radio" value="homme" id="homme" name="genre">Homme</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="service">Service</label>
							<div class="col-sm-10">
								<select class="form-control" name="service">
									<option value="" selecter="selecter">Veuillez faire un choix</option>
									<option value="devis">Demande de devis</option>
									<option value="pasdevis">Pas une demande de devis</option>
									<option value="autre">Autre</option>
								</select>
							</div>
						</div>

						<div class="text-center">
							<div class="form-group btn-group btn-group-lg">
								<input type="submit" value="Envoyer" class="btn btn-info">
								<input type="reset" value="Réinitialiser le formulaire" class="btn btn-info">
							</div>
						</div>
					</form>
				</div>

			</section>
			<!--Footer-->
			<footer class="well well-lg text-center">
				<h3>Développé par :</h3>
				<p>
					<a href="https://github.com/dmshd">Daniel Muyshond</a>
					<br>
					<a class="github-button" href="https://github.com/dmshd" data-size="large" aria-label="Follow @dmshd on GitHub">Follow @dmshd</a>
					<br>
					<a href="https://github.com/Cervant3s">Arnaud Duchemin</a>
					<br>
					<a class="github-button" href="https://github.com/Cervant3s" data-size="large" aria-label="Follow @Cervant3s on GitHub">Follow @Cervant3s</a>
				</p>
			</footer>
		</div>
	</body>

	</html>
