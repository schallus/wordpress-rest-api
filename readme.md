# WordPress REST API 
## Initialisation du projet
1. Installer et configurer un serveur [__MySQL__](https://dev.mysql.com/doc/mysql-getting-started/en/)
2. Connectez-vous au serveur MySQL
```sql
shell> mysql -h host -u user -p
Enter password: ********
```
3. Créé une nouvelle base de données
```sql
mysql> CREATE DATABASE myDbName;
```
4. Créé un nouvel utilisateur MySQL
```sql
mysql> CREATE USER 'MyUserName'@'localhost' IDENTIFIED BY 'password';
mysql> GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP
    ->     ON myDbName.*
    ->     TO 'MyUserName'@'localhost';
```
5. Importer les données à partir du fichier suivant `WordPress_db_dump.sql`
```
shell> mysql -u MyUserName -p myDbName < WordPress_db_dump.sql
```
6. Renommer le fichier `config-sample.php` en `config.php`
7. Configurer les informations de connexion à la base de données

## Les bases de WordPress REST API
L'API REST de WordPress fournit des `endpoints` pour tous les types de contenus WordPress qui permettent aux développeurs d'interagir avec des sites à distance en envoyant et en recevant du _JSON_.

L'URL suivante vous permet de voir tous les `endpoints` disponible par défaut sur WordPress :
```
http://oursite.com/wp-json/
```

Voici un aperçu des données avec lesquelles nous pouvons intéragir depuis l'API REST WordpPress 

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

### Create A custom API endpoints
```php
<?php
/**
 * Grab latest post by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post for the latest,  * or null if none.
 */
function my_awesome_func( $data ) {
  $posts = get_posts( array(
    'author' => $data['id'],
  ) );
 
  if ( empty( $posts ) ) {
    return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 422 ) );
  }
 
  return $posts[0];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'custom/v1', '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
  ) );
} );
```