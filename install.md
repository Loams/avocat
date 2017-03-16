installation de laravel

faire un clone du repository https://github.com/Loams/avocat.git

faire un coup de composer update

executer php artisan migrate

ElasticSearch pour windows

curl -L -O https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.2.2.zip
extraire le dossier puis dans un terminale 

cd elasticsearch-5.2.2/bin 

elasticsearch.bat  pour lancer le serveur elasticsearch

si probleme suivre le tuto https://www.elastic.co/guide/en/elasticsearch/reference/current/_installation.html 

dans le .env de laravel mettre 
 
PLASTIC_INDEX=plastic

PLASTIC_HOST=127.0.0.1:9200

 
une fois le serveur lancé, exécuter dans une console dans le dossier du projet 

curl -XPUT http://PLASTIC_HOST/PLASTIC_INDEX/ -d '{"settings":{"index":{"number_of_shards":3,"number_of_replicas":1}}}'

si la commande génere une erreur essayer de passer par postman chrome 

puis exécuté php artisan mapping:run

pour charger toutes les données du json dans la base de données se rendre a l'adresse localhost/avocat/public/import
(à terme il est prévu d'avoir un chargement du fichier téléchargeable sur le site du gouv et de l'importer directement)


si problème ne pas hésiter à me contacter 


