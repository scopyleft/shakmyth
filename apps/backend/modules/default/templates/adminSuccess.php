<h1>NOTICE</h1>
<br />
<h2>Gestion mail :</h2>
<br />
<strong>Lecteur mail : Mail, Outlook, Thunderbird</strong><br />
<br />
SMTP: votre provider ex. smtp.orange.fr<br />
POP: 91.121.24.110<br />
Utilisateur: contact@shakmyth.org<br />
Password: xxxxxxxx
<br />
<strong>Par WebMail</strong><br />
http://mail.shakmyth.org<br />
<br />
<h2>Application shakmyth</h2>
<br />
<strong>Nouveaux modules dans le backend</strong><br />
- Menu : Gestion des rubriques principales du menu en frontend (colonne de gauche)<br />
- News : Gestion des actualités affichées en 3ème colonne sur la homepage et sur les pages d'actualités <br />
- Media : Gestion et organisation des fichiers téléchargés ex. PDF - jpg - gif  -- Fiches Myths, photos des contributeurs<br />
<br />
<strong>Nouvelles fonctionnalités</strong>
<br />
<strong>Menu</strong><br />
- Le module Menu du backend permet de modifier les intitulés des 10 rubriques de niveau supérieur du menu de navigation à gauche sur le frontend <br />
- Ces rubriques sont nommées item1 à item10
- Les rubriques ne sont affichées que si au moins une page est active avec le heading correspondant.<br />
<br />
<strong>Pages</strong><br />
- Le champ Heading détermine la rubrique dans laquelle sera affichée le titre de la page dans le menu gauche du frontend.<br />
- En mode List la colonne Heading affiche les rubriques en format générique : ex. item1, item5, ...<br />
- En Edition, le menu -select- Heading reprend dynamiquement les rubriques présentes dans le module Menu<br />
<br />
- 2 nouveaux champs ont été ajoutés : <br />
1- Priority pour gérer l'ordre d'affichage des sous-rubriques dans le menu du frontend<br />
2- Special Page : pour gérer les pages complexes - ex. dictionary - homepage - contributors-list<br />
<br />
- L'ordre d'affichage des sous-rubriques dans une rubrique dépend du champs priority. Ce champ contient un chiffre entre 1 et 99 qui détermine son "poids".<br />
- Si aucune option du menu -select- Special-page n'est sauvegardée une page simple est créée.<br />
<br />
<strong>News</strong><br />
- Sur le Frontend, les news sont affichées en colonne de droite de la page spéciale Home-page - (et pour l'affichage des news)<br />
- Le texte de la news est coupée à 60 caractères, le lien read-more permet d'afficher la news.<br />
<br />
<strong>Media</strong><br />
<strong>Télécharger une image</strong>
<ul>
	<ol>- préparer le visuel - optimisation - taille - nom (minuscule "_" pour remplacer les espaces)</ol>
	<ol>- sélectionner le menu média dans le back-office</ol>
	<ol>- dans un des dossiers de la médiathèque télécharger l'image avec upload a file</ol>
</ul>
<strong>Placer un visuel dans une page</strong>
<ul>
	<ol>- chercher le visuel dans la médiathèque</ol>
	<ol>- clic bouton droit (ctrl+click) demander "copier l'adresse du lien" dans le menu contextuel</ol>
	<ol>- dans l'éditeur de la page cliquer sur l'icone d'insertion d'image et 'coller'</ol>
	<ol>- pour optimiser vous pouvez supprimer la partie de l'adresse correspondant à http://shakmyth.org/ et ne garder que /upload/dossier/1.jpg'</ol>
</ul>

<strong>Autres</strong>
- Les photos des contributeurs affichées en Frontend doivent être téléchargées avec le module Media<br />
- La photo est téléchargée dans le dossier -identities- et doit porter le nom du contributeur en minuscule et l'extension .jpg - ex: delord.jpg<br />
- Le format doit être de 250x325 en 72dpi - .jpg sans l'optimisation spécifique de photoshop<br />
- Les pdfs des fiches Myths doivent être téléchargés à la racine avec le nom suivant : myth_category - ex: apollo_analysis.pdf<br />
- Les espaces doivent être remplacés par des tirets.<br />
<br />
<h2>Autres améliorations fonctionnelles</h2>
<br />
- Les autres corrections ou améliorations fonctionnelles sont précisées sur : http://shakmyth.org/user-test/<br />
- Voir les fiches dont le titre est suivi d'un - OK<br />
