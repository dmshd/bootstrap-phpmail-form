## Notes prises durant la réalisation du projet

### Lexique

`honeypot`  
Dans le jargon de la sécurité informatique, un **honeypot** (en français pot de miel) est *une méthode de défense active* qui consiste à attirer, sur des ressources (serveur, programme, service), des adversaires déclarés ou potentiels afin de les identifier et éventuellement de les neutraliser.  
exemple de technique honeypot :  
>To implement the Honeypot technique, all that’s required is adding a hidden form field to  the form in question.  The form field can have any name or id associated to it, but make sure to add a display: none CSS rule on it (or some other means to hide it from users).  Here’s a brief example: Note that I have 2 email fields, real_email and test_email.  test_email is hidden via display: none, so it’s not visible and likely can’t/won’t be submitted by real users.  
And that’s what gives away whether the form submission is spam or not.  Real users don’t see the hidden field so they won’t submit it with any value. Spam bots, however, will still see the field in the form’s markup, auto-populate it with something, and submit it with the rest of the form.  
So from there all that’s needed is to test whether the hidden field was submitted with a value or not.  If it was, the submission can be treated as spam.  

`UML`  
*Système visuel simple* basé sur des rectangles, des flèches et des losanges, pour représenter un flux d'information, d'un état initial à un état final. On appelle ces schémas des diagrammes d'activité.  
[en savoir plus](https://fr.wikipedia.org/wiki/UML_(informatique))  
[Trouver le chemin logique : notions UML](https://github.com/becodeorg/BeCode/wiki/Trouver-le-chemin-logique-:-notions-d'UML)  

`W3C`  
Le **World Wide Web Consortium**, abrégé par le sigle <abbr title="World Wide Web Consortium">W3C</abbr>, est un organisme de standardisation à but non lucratif, fondé en octobre 1994 chargé de promouvoir la compatibilité des technologies du World Wide Web telles que HTML5, HTML, XHTML, XML, RDF, SPARQL, CSS, XSL, PNG, SVG et SOAP. Fonctionnant comme un consortium international, il regroupe au 26 février 2013, 383 entreprises partenaires.  
[en savoir plus](https://fr.wikipedia.org/wiki/World_Wide_Web_Consortium)  
[wwww.w3c.org](https://www.w3.org/)  
Le leitmotiv du W3C est « Un seul web partout et pour tous ».  

`Amélioration progressive`  
Commencer par la version de base, puis ajouter des améliorations pour ceux qui peuvent les gérer.Pour un site, cela veut dire partir de la base (HTML)et enrichir ensuite avec CSS, JS, APIs, etc.  
source : [https://www.nicolas-hoffmann.net/amelioration-progressive-codeurs-en-seine-2017/#/13](présentation de Nicolas Hoffmann, codeurs en seine 2017.  
  > L’**amélioration progressive** est une manière de concevoir un site web qui prend très largement en  compte l'accessibilité, la sémantique et le référencement. En séparant strictement le fond (le contenu proposé à l'utilisateur) et la forme (l'enjolivement et les interactions avancées), cette technique permet de présenter un contenu simple et de rendre un service minimum à tous les utilisateurs, quel que soit le débit de leur connexion ou leur navigateur, tout en améliorant progressivement l'affichage proposé en fonction de l'équipement de l'internaute.  
  [en savoir plus](https://fr.wikipedia.org/wiki/Am%C3%A9lioration_progressive)

### Critères d'accessibilité pour les non-voyants
  http://www.aphvbsl.org/site-accessible  
  https://openclassrooms.com/courses/faire-un-site-web-accessible  

  ## Compétences travaillées
- groupe: Maitriser Git (renforcement)
- frontend: css frameworks (initiation)
- backend: PHP programming (initiation aux structures logiques)
- Méthodo: expression d'une solution en chemin logique, via UML (initiation)
- frontend: html sémantique (renforcement)
- frontend: html accessibilité (initiation)
- frontend: Amélioration progressive (initiation)

## Situation-problème
La société *Hackers Poulette* ™ vend des kits et accessoires pour Rasperri Pi à monter soi-même. Elle souhaite permettre à ses utilisateurs de contacter son support technique.
Ta mission: développer un script en php, permettant d'afficher un formulaire de contact et de traiter sa réponse: sanitisation, validation, puis envoi et feedback à l'utilisateur.

![Hackers Poulette Logo](./hackers-poulette-logo.png "Logo Hackers Poulette (via Hipster Logo Generator")


## Critères de performance
- Le formulaire sera du html sémantique, validé par le W3C, et accessible aux non-voyants.
- Si l'utilisateur commet une erreur, lui retourner le formulaire, avec les réponses valides remises dans leurs inputs respectifs.
- Idéalement: afficher les messages d'erreurs à proximité de leur champ respectif.
- Le formulaire effectuera un nettoyage (*sanitization*) et une validation *serverside*
- Si la validation est ok, il enverra le contenu du message par email à une adresse spécifiée.
- implémentation de la technique antispam du *honeypot*
- Les messages d'erreur sont bien formulés, de manière à aider l'utilisateur. (lire [The Four H of Writing Error Messages](http://uxmas.com/2012/the-4-hs-of-writing-error-messages) )
- Ton code est publié sur un repository intitulé "`projet-1-formulaire`"

## Critères de perfectionnement (à implémenter dans un second temps)
- Expérience-utilisateur (UX) soignée (clarté, pertinence, correction (pas de bugs, orthographe correcte...)).

## Découpage de la difficulté en séquences pédagogiques
### Séquence 0: Planifier le travail à effectuer
Etude de la demande, UML, prototypage, Git.

**Champs du formulaire**: prénom & nom + email + pays + message + genre (H/F) + sujet (3 sujets possibles, plusieurs choix possibles)
Tous les champs sont obligatoires, sauf le sujet (dans ce cas, valeur = "Autre")

### Séquence 1: le formulaire de contact (html)
objectif 1: html sémantique, préparer l' **amélioration progressive**  
objectif 2: html accessible aux non-voyants

### Séquence 2: formulaire de contact (css, via framework css)
Utiliser le framework [CSS Bootstrap](http://getbootstrap.com/) pour améliorer rapidement le rendu visuel et l'ergonomie de ton formulaire.

**Charte Graphique du client**

font: https://www.fontsquirrel.com/fonts/bellota 
couleurs: #15c5bd + #FFF + #303030


### Séquence 3: formulaire de contact (php)
- présentation: architecture serveur/client (transmissif, 10")
- tester un script PHP en local
- **afficher les données brut** reçues du formulaire (utiliser la fonction php `print_r();` ([voir la doc php](http://php.net/manual/en/function.print-r.php) )
### Séquence 4: traiter les données du formulaire (php)
- [Parcours-tutoriel](php-introduction.md): "structures logiques de la programmation en PHP"    
	- variables
	- manipulation: concaténation, addition, quelques exemples de fonctions utiles...
	- conditions
	- Boucles
- [sanitization](https://github.com/becodeorg/Turing-promo-4/tree/master/parcours/2-PHP/Doc/Sanitisation-en-PHP): neutraliser tout encodage nocif (`<script>`)
- validation: champs obligatoires + Email valide
- Envoi + Feedback
