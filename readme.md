# WordPress REST API

Dans le cadre du cours approfondissement média (AppMed), j'ai décidé d'approfondir mes compétences dans le Framework WordPress. Je me suis notamment intéressé a l'API REST disponible depuis la version 4.7 de WordPress

Table des matières
=================
* [Démarrer un projet WordPress](#démarrer-un-projet-wordpress)
* [Les bases de WordPress REST API](#les-bases-de-wordpress-rest-api)
  * [Liste des routes disponibles](#rest-api-developer-endpoint-reference)
  * [Authentification](#authentification)
  * [Créer un API endpoint personnalisé](#créer-un-api-endpoint-personnalisé)

## Démarrer un projet WordPress
1. Installer et configurer un serveur [__MySQL__](https://dev.mysql.com/doc/mysql-getting-started/en/)
2. Connectez-vous au serveur MySQL
```
shell> mysql -h host -u user -p
Enter password: ********
```
3. Créer une nouvelle base de données
```sql
mysql> CREATE DATABASE myDbName;
```
4. Créer un nouvel utilisateur MySQL
```sql
mysql> CREATE USER 'MyUserName'@'localhost' IDENTIFIED BY 'password';
mysql> GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP
    ->     ON myDbName.*
    ->     TO 'MyUserName'@'localhost';
```
5. Installer un serveur de développement Apache si vous n'en avez pas encore (ex: [WampServer](http://www.wampserver.com/))
6. Installer WordPress
```
bash> cd C:\WampServer\www
bash> git clone https://github.com/WordPress/WordPress.git
```
7. Accéder à votre serveur depuis votre navigateur préféré (par exemple: http://localhost/wordpress)
8. Configurer les informations de connexion à la base de données ainsi que les informations relatives au site.

## Les bases de WordPress REST API
L'API REST de WordPress fournit des `endpoints` pour tous les types de contenus WordPress qui permettent aux développeurs d'interagir avec des sites à distance en envoyant et en recevant du *JSON*.

L'URL suivante vous permet de voir tous les `endpoints` disponibles par défaut sur WordPress :
```
http://oursite.com/wp-json/
```

Voici un aperçu des données avec lesquelles nous pouvons interagir depuis l'API REST WordpPress 

### [REST API Developer Endpoint Reference](https://developer.wordpress.org/rest-api/reference/#rest-api-developer-endpoint-reference)
|Resource                                                                               |Base Route|
|---                                                                                    |---|
|[Posts](https://developer.wordpress.org/rest-api/reference/posts/)                     |/wp/v2/posts|
|[Post Revisions](https://developer.wordpress.org/rest-api/reference/post-revisions/)   |/wp/v2/revisions|
|[Categories](https://developer.wordpress.org/rest-api/reference/categories/)           |/wp/v2/categories|
|[Tags](https://developer.wordpress.org/rest-api/reference/tags/)                       |/wp/v2/tags|
|[Pages](https://developer.wordpress.org/rest-api/reference/pages/)                     |/wp/v2/pages|
|[Comments](https://developer.wordpress.org/rest-api/reference/comments/)               |/wp/v2/comments|
|[Taxonomies](https://developer.wordpress.org/rest-api/reference/taxonomies/)           |/wp/v2/taxonomies|
|[Media](https://developer.wordpress.org/rest-api/reference/media/)                     |/wp/v2/media|
|[Users](https://developer.wordpress.org/rest-api/reference/users/)                     |/wp/v2/users|
|[Post Types](https://developer.wordpress.org/rest-api/reference/post-types/)           |/wp/v2/types|
|[Post Statuses](https://developer.wordpress.org/rest-api/reference/post-statuses/)     |/wp/v2/statuses|
|[Settings](https://developer.wordpress.org/rest-api/reference/settings/)               |/wp/v2/settings|

### Authentification

Pour effectuer des requêtes GET, il n'est pas nécessaire de vous authentifié. Cependant, si vous voulez ajouter, modifier ou supprimer du contenu WordPress via l'API, il est nécessaire de s'authentifier.

La seule méthode d'authentification disponible nativement sur WordPress est l'authentification par Cookie. Lorsque nous nous connectons au Dashboard, cela va enregistrer un cookie que nous allons pouvoir utiliser pour faire des requêtes.

Il est important de garder à l'esprit que cette méthode d'authentification repose sur les cookies WordPress. Par conséquent, cette méthode n'est applicable que lorsque l'API REST est utilisée dans WordPress et que l'utilisateur actuel est connecté.

Si vous désirez utilisez l'API REST en dehors de votre application WordPress, il va falloir installer l'un des plug-ins suivant:

* [OAuth 1.0a Server](https://wordpress.org/plugins/rest-api-oauth1/)
* [Application Passwords](https://wordpress.org/plugins/application-passwords/)
* [JSON Web Tokens](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)
* [Basic Authentication](https://github.com/WP-API/Basic-Auth)

Je vous recommande d'utiliser la première méthode `Oauth`. Celle-ci est assez complexe à mettre en place mais garanti une bonne sécurité.

Dans mon projet Angular, j'ai utilisé la méthode `Basic Authentication` car celle-ci est très facile à mettre en place.
Notez que cette méthode nécessite l'envoi de votre nom d'utilisateur et mot de passe à chaque requête, et ne doit être utilisé que pour le développement et les tests.

### Créer un API endpoint personnalisé

Comme nous avons pu le voir, il existe par défaut de nombreux endpoints disponibles sur WordPress. Cependant, si ceux-ci ne suffisent pas, il est possible de créer vos propres endpoints.

Pour ce faire, il suffit de faire appel à la fonction `register_rest_route`.

```php
<?php
/**
 * Retourne le dernier article par auteur
 *
 * @param array $data Options pour la fonction contenant l'id de l'auteur.
 * @return string|null Dernier article de l'auteur ou null si l'auteur n'en a aucun.
 */
function get_latest_post_by_author( $data ) {
  $posts = get_posts( array(
    'author' => $data['id'],
  ) );
 
  if ( empty( $posts ) ) {
    return new WP_Error( 'no_author', 'Auteur invalide', array( 'status' => 422 ) );
  }
 
  return $posts[0];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'custom/v1', '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_latest_post_by_author',
  ) );
} );
```