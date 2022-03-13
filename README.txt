PROJET MY_QUIZZ par Adesh CANNOU [APP3]

Si vous ne voulez pas installer Symfony 5, j'ai mis le projet sur un server 
voici le lien : https://my-quizzz.herokuapp.com/
Voici les logs pour le compte admin --> e-mail : root@root.fr ; MDP : rootroot
Et enfin le lien vers le repository GitHub afin que vous vérifier qu'il n'y ai pas eu de push après la date de rendu : https://github.com/AdeshCannou/MyQuizz

Le projet utilise une BD MySQL, PHP7.4 sur Symfony5
Si vous voulez instaler symfony 5 sur votre machine je vous renvoie a la documentation : https://symfony.com/doc/current/setup.html

Sinon je peut vous dire ce qu'il faut faire mais selon les environnements vous pourriez rencontrer des bugs/problèmes

	-Télécharger WampServer : https://www.wampserver.com/
	-Téléchager et installer Composer : https://getcomposer.org/  --> c'est un gestionnaire de dépendance PHP comme npm pour Node
		--> taper dans votre terminal "composer -V" pour vérifier l'installation
	
	- Une fois l'installation complété de Composer via ligne de commande se déplacer dans le dossier du projet : cd MyQuizz/
	- Installer les dépendances : composer install
	- Sur votre phpMyAdmin importer la base de donnée : myquiz.sql // ou taper : php bin/console doctrine:migrations:migrate (mais dans ce cas il n'ya aura aucune donnée et il faudra créer un compte avec l'email root@root.fr pour le compte Admin
	- Démarrer le server symfony : php bin/console server:run (si impossible installer le bundle server via : composer require symfony/web-server-bundle --dev)
	- Cliquer sur le lien apparu dans le terminal 
	
	--> Si vous avez quelconque problème pour installer Symfony n'hésitez pas à me contacté : adesh.cannou@universite-paris-saclay.fr 
	--> Il y a toujours ce lien https://my-quizzz.herokuapp.com/ si l'installation pose enormmement de probleme.
	
	
	

