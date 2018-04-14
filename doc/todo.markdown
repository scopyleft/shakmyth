-- Réaliser un module en BE pour gérer les catégories
- creer le module
- ajouter le menu
- lire le fichier de conf yaml
- réaliser un form
- enregistrer le form
- label + css
- menu select à partir du BO
- menu en FE dynamique
- régler l'enregistrement des pages avec heading

7

- fixtures -> tests
- tests menu
- mail - point sur nouvelle fn()
- reprise des tests corrections
- 3eme col. uniquement en home

5

- Actu
- slugify
- Afficher une news
- upload files

3

Nomenclature :
*B => bugs
*F => Factorisation

- *B BO-admin/page/new => select virer le 0 optgroup du select
- *F méthode pour récupérer les items de left nav
- *F Tools refactoriser la partie Page 
- *F enlever /media/icone_pdf.gif
- *T FO-component third-column verify si pas de news
- *T Titre dynamique pour les pages statiques

# routing : backend :: obliger d'ajouter backend sinon 404
# backend :: page :: edit :: profile => nom prenom (cf. jobeet author nom-prenom)

# backend :: page :: list :: myth :: name
# backend :: page :: list :: content

BE :
ok- backend :: page :: new :: sauver un titre automatique (cf. jobeet save symfony )

- Mettre les fiches en fixtures

- frontend :: dict_entries :: 
* récupérer juste les section + id par myth_id
* afficher les sections


SESSION OBJECT :
http://www.symfony-project.org/doctrine/1_2/en/04-Schema-Files

<?php echo link_to(image_tag('/media/icone_pdf.gif', array('id' => 'icon-pdf')), '/uploads/apollo-analysis.pdf') ?>



