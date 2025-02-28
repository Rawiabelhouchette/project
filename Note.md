- mettre sweet alert en local


Prochainement:
-[ok]  creer une table qui va garder les horaires

La description d'entreprise ne marche pas


# 03/12/2023






# Annonce implementation procedure
- Create files
- Edit migration
- Edit model
- Create views
- Create livewire

- Add route
- Edit controller file
- Edit create view
- Edit livewire create 


# 12-12-2023
- [ok] Put conditions on min and max price



# Next step : 23/12/2023
- 1 page pour le detail de l'entreprise
- 1 pages pour le resultat de la recherche
- 1 page pour le detail de l'annonce

- Ajouter une photo a l'entrepise




# Liste de taches a faire
## Utilisateur public authentifié
-  [ok] Concevoir le model pour les utilisateurs publiques
- [ok] Editer l'affichage court des annonces
- [ok] Permettre la creation de compte client
- [ok] Concevoir les pages d'affichage détaillé des annonces
- [ok] Ajouter les facettes sur la page de recherche
- [ok] Ajouter les options de partage sur les annonces
- [ok] Ajouter l'option de favoris sur les annonces
- [ok] Fonction visualisation des annonces favoris
- [ok] Visualisation des mes informations
- [ok] Changement de mot de passe (par mail)
- [...] Faire une verification du compte par mail
- [ok] [notPossible] Faire des recherches sur la connexion via google account (pas possible pour le momennt apres recherche )
- [ok] Chercher si possible pourquoi les images font genre ne s'affiche pas parfois
  [raison] Donner les bonnes permission sur les dossiers
- [ok] Trouver une maniere des faire le deploiement automatique
  [solution] Via Github, avec une branche dédiée


# verifier et gerer la suppression des fichiers






Avant d'attaquer la partie détail des comptes, je pense qu'il faudrait avancer sur : 

- les facettes ( faire afficher toutes) 
- gérer la partie compte (pro et usager en respectant la maquette) 
- gérer aussi les actions ( partage, favoris etc)



# NEXT
- [ok] Ajouter l'option de type de compte lors de la creation de compte (niveau public)
- [ok] Interface de visulasation des informations
  

## 28/01/2024
  MAIL_MAILER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

a configurer dans le .env

https://aide.lws.fr/base/Email/outllook-thunderbird-iphone/Quels-ports-utiliser-pour-la-configuration-dune-adresse-email





cle site

6LfwoF8pAAAAAClgwAb7VRDlrPh-x5c0AyZ520R_

cle secrete
6LfwoF8pAAAAACHHninimPCRav9bsQawUt4bGquQ

https://developers.google.com/recaptcha/docs/v3

https://www.youtube.com/watch?v=NsFSA-MQjeY&ab_channel=CodeWithTony


# 30/01/2024
## a faire
- chercher comment afficher une image rectangle dans un carré de sorte a ce que ce soit centrer

## A continuer
- [ok] Rechecher de favoris et de commentaire
- Suppression d'un commentaire [attendre] 
- Dans Favoris le render (ne pas l'executer) 

380

download default pics


# 03/02/2024
- [ok] Faire une operation sur les stats quand on met en favoris

Home, location vehicule, le bon type n'est pas pris




- Pour la creation de compte
  - Juste creer un compte classique (usager)
  - Avoir un bouton pour passer pro


# [ok] 16/02/2024
- Essayer de mettre la page d'affichage de recheche en petit composant




- [ok] Enlever le nice-select
- [ok] Revoir la couleur des options de localisation
- [ok] on filter , changer l'url de sort a mettre correction les attributs (Le but c'est d'eviter les caracteres speciaux dans l'url)



- [ok] update url on launch using attributes


## 26/02/2024
- [ok] Lors de la copie du lien , les caracteres speciaux sont retiré , arranger cela
- [ok] Apres suppression de filtre par fois le rendu ne fait pas disparaitre l'element arranger cela



## 13/03/2024
- [ok] Pour la galerie vous vous etes basé sur le template ?
- [ok] Pour les details (equipement de vie nocture) quand il y en a plusieurs , qu'est ce qui se passe ?

## 23/03/2024
- Revoir l'affichage des etoiles sur l'affichage court des recherches
- [ok] [removed] Se pencher plus sur la ce qui vient apres les etoiles
- Ajouter l'affichage avec k pour les vues
- [ok] Afficher un message avoir avoir envoyer un commentaire
- [ok] Implementer favoris sur la page des details
- [ok] Ajouter le bouton de partage sur l'affichage des details

## 02/04/2024
- [ok] Rendre les liens cliquables dans l'affichage des informations de l'entreprise


## 11/04/2024
- AJouter attribut date de debut a annonce avec default la date de creation de l'annonce
- Ajouter aussi l'option de desactivation de l'annonce sur la liste des annonces avec une confirmatio d'action quand on clique dessus

## 13/04/2024
- Ajouter les with() au modele necessaire pour eviter les requetes supplementaires

## 14/04/2024
Etape de creation d'un nouvel abonnement
- [ok] Creer une entreprise
- [ok] Lier l'entreprise a un l'utilisateur
- [ok] Creer un abonnement
- [ok] Lier l'abonnement a l'entreprise

- [ok] Ajouter l'option d'abonnement

## 15/04/2024
- Implementer la recherche sur la page d'abonnement

## 21/04/2024
- Add a loader when loading annonce images
- Demande a MOnsieur de definir le nombre d'image a uploader et la taille max


## 24/04/2024
- Demander a Monsieur de definir les options des abonnements

## 26/04/2024
- [ok] Ajouter le mask de saisi sur le numero de telephone lors de la creation d'enreprise
- Gerer l'envoi de mail de rappel pour les abonnements


## 01/05/2024
- Desactiver le hide du modal quand l'utilisateur clique en dehors du modal lors du processus de connexion et de creation de compte


PAIEMENT
- [NN] url de notification doit être une chaine cryptee qui doit changer tout les jours
- 


NOTIFY
- [notNeed] Creer une table qui va contenir le hash de la notification
- [envoi] generer le hash a fois qu'il y a paiement et le supprimer (apres 24h)
- [NN]Verifier si le hash existe deja et que ca correspond a l'utilisateur connecte


## [ok] 11/05/2024
Make sure to generate an unique transaction id

Payment status
+ PENDING : 0
+ ERROR : -1
+ COMPLETED : 1

- Receive a post request from CinetPay
- Compare transaction_id and site_id (CinetPay - Our DB)
- Do a request on transaction to ensure that it exists
- Check the amount using the "offre->prix" value
- Check transaction status
  - OK : Make the user become a "Professionnel" and create entreprise
  - Nok : Do nothing

## 13/05/2024 : MAILING


## 18/05/2024
- [ok] Ajouter le montant a la table abonnements car les valeurs d'une offre peuvent changer

 - [ok] remove mailingservice


 - [ok] Ajouter entreprise_id dans transaction

## 23/05/2024
NN : No Need
- [NN] Ajouter le bouton de reabonnement
- Ajouter la page de reabonnement

## 24/05/2024
- Uniformiser les noms des pages (sur les pages : Abonnement / Liste)
- [ok] Cote backoffice, l'icon semble avoir diminue de taille
- [ok] Reparcourir toutes les pages
- Definir les options d'abonnement et les noms
- Detacher les recherches de la searchbox (Affichage des elements rechechés)
- Revoir le message de reinitalisation de mot de passe

## 29/05/2024
- Empecher le modal de se retirer en pleine connexion ou enregistrement



- ajouter la date de l'abonnement a la liste des abonnements


## 19/11/2024
- Pourvoir suppimer une reference valeur
- Dans l'affichage detaillé d'une annonce, quand on clique sur whatsapp ou facebook , il faut y ajouter le lien de l'annonce ainsi que le titre de l'annonce

SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE reference_valeurs;
INSERT INTO reference_valeurs (valeur, reference_id, created_at, updated_at, created_by, updated_by) VALUES
('Piscine', 1, NOW(), NOW(), 1, 1),
('Salle de sport', 1, NOW(), NOW(), 1, 1),
('Balcon/terrasse', 1, NOW(), NOW(), 1, 1),
('Jardin ou barbecue', 1, NOW(), NOW(), 1, 1),
('Jeux et divertissements', 1, NOW(), NOW(), 1, 1),
('Nettoyage d''entrée/sortie', 2, NOW(), NOW(), 1, 1),
('Conciergerie', 2, NOW(), NOW(), 1, 1),
('Gardiennage', 2, NOW(), NOW(), 1, 1),
('Petit déjeuner compris', 2, NOW(), NOW(), 1, 1),
('Lit simple', 3, NOW(), NOW(), 1, 1),
('Lit double', 3, NOW(), NOW(), 1, 1),
('Queen size', 3, NOW(), NOW(), 1, 1),
('Lit bébé', 3, NOW(), NOW(), 1, 1),
('Lits superposés', 3, NOW(), NOW(), 1, 1),
('Placards, commodes, armoires', 4, NOW(), NOW(), 1, 1),
('Système de sécurité (caméras, alarmes)', 4, NOW(), NOW(), 1, 1),
('Connexion internet', 4, NOW(), NOW(), 1, 1),
('Détecteurs de fumée et de monoxyde de carbone', 4, NOW(), NOW(), 1, 1),
('Aspirateur ', 4, NOW(), NOW(), 1, 1),
('Multiprises et chargeurs', 4, NOW(), NOW(), 1, 1),
('Canapé', 4, NOW(), NOW(), 1, 1),
('Lave-linge.', 4, NOW(), NOW(), 1, 1),
('Sèche-linge (ou étendoir)', 4, NOW(), NOW(), 1, 1),
('Table et fer à repasser', 4, NOW(), NOW(), 1, 1),
('Kit de premiers secours', 4, NOW(), NOW(), 1, 1),
('Jeux ou jouets', 4, NOW(), NOW(), 1, 1),
('Climatisée', 4, NOW(), NOW(), 1, 1),
('Ventilée', 4, NOW(), NOW(), 1, 1),
('Téléviseur', 4, NOW(), NOW(), 1, 1),
('Imprimante', 4, NOW(), NOW(), 1, 1),
('Ordinateur', 4, NOW(), NOW(), 1, 1),
('Lavabo ou Vasque', 5, NOW(), NOW(), 1, 1),
('Cabine de douche', 5, NOW(), NOW(), 1, 1),
('Baignoire', 5, NOW(), NOW(), 1, 1),
('WC intégré salle de bain', 5, NOW(), NOW(), 1, 1),
('WC séparé', 5, NOW(), NOW(), 1, 1),
('Panier à linge', 5, NOW(), NOW(), 1, 1),
('Armoire de toilette', 5, NOW(), NOW(), 1, 1),
('Colonnes de rangement', 5, NOW(), NOW(), 1, 1),
('Eau chaude', 5, NOW(), NOW(), 1, 1),
('Tapis de bain', 5, NOW(), NOW(), 1, 1),
('Four', 6, NOW(), NOW(), 1, 1),
('Plaques de cuissons', 6, NOW(), NOW(), 1, 1),
('Plan de travail', 6, NOW(), NOW(), 1, 1),
('Réfrigérateur', 6, NOW(), NOW(), 1, 1),
('Lave-vaisselle', 6, NOW(), NOW(), 1, 1),
('Hotte aspirante', 6, NOW(), NOW(), 1, 1),
('Poubelle intégrée', 6, NOW(), NOW(), 1, 1),
('Micro-ondes', 6, NOW(), NOW(), 1, 1),
('Bouilloire', 6, NOW(), NOW(), 1, 1),
('Blendeur/mixeur', 6, NOW(), NOW(), 1, 1),
('Machine à café', 6, NOW(), NOW(), 1, 1),
('Grille-pain', 6, NOW(), NOW(), 1, 1),
('Friteuse', 6, NOW(), NOW(), 1, 1),
('Verres à vin', 6, NOW(), NOW(), 1, 1),
('Couverts', 6, NOW(), NOW(), 1, 1),
('Maison T4 (3 chambres salon)', 7, NOW(), NOW(), 1, 1),
('Maison T3 (2 chambres salon)', 7, NOW(), NOW(), 1, 1),
('Maison T2 (chambre salon)', 7, NOW(), NOW(), 1, 1),
('T1 ou Studio', 7, NOW(), NOW(), 1, 1),
('Appartement T4 (3 chambres)', 7, NOW(), NOW(), 1, 1),
('Appartement T3 (2 chambres)', 7, NOW(), NOW(), 1, 1),
('Appartement T2 (Chambre salon)', 7, NOW(), NOW(), 1, 1),
('Utilitaire ( Camion )', 8, NOW(), NOW(), 1, 1),
('Citadine', 8, NOW(), NOW(), 1, 1),
('Berline', 8, NOW(), NOW(), 1, 1),
('Familiale ( 7 places ) ', 8, NOW(), NOW(), 1, 1),
('4x4', 8, NOW(), NOW(), 1, 1),
('SUV', 8, NOW(), NOW(), 1, 1),
('Minibus', 8, NOW(), NOW(), 1 , 1),
('Climatisation', 9, NOW(), NOW(), 1, 1),
('Sièges réglables ', 9, NOW(), NOW(), 1, 1),
('Accoudoir central', 9, NOW(), NOW(), 1, 1),
('Pare-soleil avec miroir éclairé', 9, NOW(), NOW(), 1, 1),
('Airbags (frontaux, latéraux, rideaux)', 9, NOW(), NOW(), 1, 1),
('Caméra de recul', 9, NOW(), NOW(), 1, 1),
('Freinage automatique d’urgence', 9, NOW(), NOW(), 1, 1),
('Navigation GPS', 9, NOW(), NOW(), 1, 1),
('Commandes vocales', 9, NOW(), NOW(), 1, 1),
('Connectivité Bluetooth et USB', 9, NOW(), NOW(), 1, 1),
('Apple CarPlay / Android Auto', 9, NOW(), NOW(), 1, 1),
('Pare-soleil intégrés', 9, NOW(), NOW(), 1, 1),
('Régulateur de vitesse', 9, NOW(), NOW(), 1, 1),
('Limiteur de vitesse', 9, NOW(), NOW(), 1, 1),
('Caméra 360°', 9, NOW(), NOW(), 1, 1),
('Toit ouvrant ou panoramique', 9, NOW(), NOW(), 1, 1),
('Feux antibrouillard', 9, NOW(), NOW(), 1, 1),
('Siège bébé ou fixation ISOFIX', 9, NOW(), NOW(), 1, 1),
('Espace de rangement sous le coffre', 9, NOW(), NOW(), 1, 1),
('Minimum 3 jours', 11, NOW(), NOW(), 1, 1),
('18 ans minimum', 11, NOW(), NOW(), 1, 1),
('Ancienneté de 2 ans de permis', 11, NOW(), NOW(), 1, 1),
('Ancienneté de plus de 3 ans de permis', 11, NOW(), NOW(), 1, 1),
('Ne doit pas traverser une frontière', 11, NOW(), NOW(), 1, 1);







## 22/11/2024
- Erreur lors de : Filtre + tri


## 08/12/2024
- Mettre des attributs dans Search.php de sorte qu'en mettant "se loger dans la sesstion" que le filtre selon les types lies se fasse



## 10/12/2024
Code pour generer les noms et types de references
```php
private function generateCode($name)
{
    // Découper les mots du nom
    $words = preg_split('/\s+/', $name);
    
    // Prendre les initiales des mots (au moins 3 caractères)
    $code = strtoupper(implode('', array_map(fn($word) => $word[0], $words)));
    
    // Si le code généré est inférieur à 3 caractères, compléter avec des lettres des mots
    if (strlen($code) < 3) {
        foreach ($words as $word) {
            $code .= strtoupper(substr($word, 1, 1)); // Ajouter la deuxième lettre de chaque mot
            if (strlen($code) >= 3) break; // Stop si le code atteint 3 caractères
        }
    }

    // Limiter à 5 caractères maximum
    return substr($code, 0, 5);
}
```

## 26/12/2024
dev-2, c'est mes modifications avant de faire un merge avec la branche design


## 07/01/2025 
Restaurant partie publique
Il serait bien que quand on clique sur le bouton le off-canvas sorte

## 08/01/2025
- Apres un echec de validation, les entrees generees automiquement disparraissent

## 09/01/2025
https://www.youtube.com/watch?v=Zs0BVTmT9AY&t=120s&ab_channel=WebTechKnowledge


## 12/01/2025
- Redesigner la page d'enregistrement


## 20/02/2025
- Apres connexion renvoyer sur la derniere url


## 28/02/2025
```sql
update annonce_reference_valeur set titre = "Accessoires de cuisine" where titre = "Accessoires de cuisines";
update annonce_reference_valeur set slug = "accessoires-de-cuisine" where slug = "accessoires-de-cuisines";
```

```sql
update `references` set slug_nom = 'accessoires-de-cuisine' where nom = 'Accessoires de cuisines';
update `references` set nom = 'Accessoires de cuisine' where nom = 'Accessoires de cuisines';
```



revoir les buttons de edit (la modification des annonces)