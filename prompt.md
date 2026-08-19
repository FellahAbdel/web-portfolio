Je veux créer une jolie page dans **Admin** permettant de consulter les messages envoyés depuis le formulaire de contact.

Garde le même style visuel que le reste du site : moderne, épuré, professionnel et cohérent avec le design actuel.

### Fonctionnalités

La page doit permettre de :

* Voir la liste de tous les contacts reçus.
* Afficher pour chaque contact :

  * prénom / nom
  * email
  * numéro de téléphone
  * date de réception
  * sujet ou aperçu du message
  * statut : lu / non lu
* Cliquer sur un contact pour ouvrir une vue détaillée avec l'intégralité de son message.
* Marquer un message comme **lu** ou **non lu**.
* Supprimer un message.
* Ajouter une recherche pour retrouver rapidement un contact.
* Ajouter des filtres simples, notamment **Tous / Non lus / Lus**.
* Afficher un compteur du nombre de messages non lus.

### Design

Je veux une interface d'administration moderne, avec par exemple :

* Un titre « Messages de contact »
* Une petite statistique indiquant le nombre total de messages et le nombre de messages non lus.
* Une liste ou un tableau propre des messages.
* Des badges visuels pour distinguer les messages lus et non lus.
* Une vue détaillée agréable lorsqu'on sélectionne un message.
* Une interface responsive.

### Important

Cette page doit être **réellement connectée aux messages envoyés depuis le formulaire Contact**.

Lorsqu'une personne remplit le formulaire de contact et l'envoie, son message doit être enregistré afin qu'il apparaisse automatiquement dans cette interface Admin.

Ne crée donc pas simplement une interface avec des données fictives : mets en place la logique nécessaire pour récupérer et afficher les vrais messages envoyés depuis le formulaire.

Conserve le design général et les composants existants du site afin que la nouvelle page Admin s'intègre naturellement au reste de l'application.
