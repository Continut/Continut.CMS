/*
SQLyog Community v12.04 (64 bit)
MySQL - 5.5.46-0ubuntu0.12.04.2 : Database - continutcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ext_news` */

DROP TABLE IF EXISTS `ext_news`;

CREATE TABLE `ext_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'news uid',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `author` int(11) unsigned DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ext_news` */

LOCK TABLES `ext_news` WRITE;

insert  into `ext_news`(`id`,`title`,`description`,`author`,`is_visible`) values (1,'<font color=\"FF0000\">Dakar 2016:</font> Un baiat de 10 ani si tatal sau, grav raniti in prologul competitiei','<strong>Un baiat in varsta de 10 ani si tatal sau de 34 de ani au fost grav raniti intr-un accident produs la prologul Dakar-2016, sambata, la Buenos Aires, cand o masina a iesit de pe carosabil si i-a lovit, incidentul ducand la intreruperea cursei, informeaza Mediafax.<br></strong><br>In total, zece persoane au fost ranite in accident, conform organizatorilor.<br><br>Accidentul s-a produs cand masina in care se aflau pilotul chinez Guo Meiling si copilotul Min Liao a iesit de pe drum si a lovit un grup de spectatori, la nivelul kilometrului 6,6 al probei speciale din prolog, pe distanta dintre Buenos Aires si Rosario.<br><br>Autoritatile locale au deschis o ancheta, echipajul chinez urmand sa fie audiat de politie.<br><br>In prologul Dakar-2016, romanul Emanuel Gyenes a ocupat locul 26 la clasa moto.',NULL,1),(2,'Uber a starnit noi controverse dupa ce a avut si tarife de zece ori mai mari in noaptea de Revelion ','<strong>&#8203;Uber a starnit noi controverse, mai ales in SUA, dar si in Romania, dupa ce in noaptea de Revelion preturile calatoriilor au fost chiar si de 7-10 ori mai mari decat tarifele standard. Trebuie spus ca Uber are o optiune de preturi dinamice si tarifele cresc in perioadele de varf ale fiecarei zile, insa clientii s-au suparat acum fiindca s-au trezit dupa cursa cu costuri exceptional de mari. Uber a publicat pe 31 decembrie <a target=\"Alta pagina\" href=\"https://newsroom.uber.com/romania/ro/ghid-pentru-revelion/\" rel=\"nofollow\">un ghid</a> in care isi avertiza clientii ca tarifele vor creste puternic in noaptea de Revelion. Urmarea a fost ca o cursa care cu un taxi normal ar fi costat sub 10 lei a ajuns sa fie 62 de lei cu Uber.<br></strong><br>Aplicatia Uber are probleme cu legea in multe tari si controversele se tin lant. Acum, publicul din SUA a criticat masiv compania dupa ce tarifele in noaptea de anul nou au ajuns sa fie atat de mari incat unele persoane au efectuat curse care au costat si peste 300 dolari, cand tariful standard era de sub 50 de dolari.<br><br>Si in Bucuresti tarifele au crescut puternic si <a target=\"Alta pagina\" href=\"http://www.cristianscutariu.ro/uber-facut-revelion-tarife-7-mari-11-5-81-pana-centrul-vechi/\" rel=\"nofollow\">puteti citi aici</a> despre cum au evoluat pe parcursul noptii, iar<a target=\"Alta pagina\" href=\"https://www.facebook.com/photo.php?fbid=1199228186758159&amp;set=a.264555060225481.81496.100000129683046&amp;type=3&amp;theater\" rel=\"nofollow\"> aici</a> despre povestea unei persoane care a paltit 190 lei pentru o calatorie de 11 km in Bucuresti.<br><br>Un alt exemplu tine de o persoana careia i s-au luat de pe card 62 de lei pentru o cursa de 5 km care ar fi costat sub 10 lei cu un taxi clasic. Problema cea mare in cazul de fata este ca estimarea Uber de dinainte de cursa indica 38 de lei, cu 40% mai putin decat utilizatorul a fost nevoit sa plateasca.<br><br>Uber are tarife mai mari decat taxiurile in Bucuresti si este preferata de multi oameni care au avut neplaceri cu taximetristii. Cum imaginea acestora nu este prea grozava in Bucuresti, Uber este vazut ca fiind o alternativa civilizata cu soferi amabili care nu fumeaza in timp ce conduc si nu pun manele.<br><br>',NULL,1),(3,'<font color=\"FF0000\">RETROSPECTIVA</font> Anul 2015 in tehnologie - De la gadget-uri indelung asteptate, pana la automobile mestesugit atacate',NULL,NULL,0),(4,'Lălăială cu accente și diacritice','<strong>Se incheie un an plin de evenimente in tehnologie, un an in care s-au lansat gadget-uri despre care se vorbeste de mult timp si un an in care s-au parafat tranzactii de zeci de miliarde de dolari. Se termina un an in care unele ompanii gigantice au facut schimbari mari si au intrat pe noi teritorii, in timp ce altele fac concedieri. 2015 a fost marcat si de atacuri informatice extrem de sensibile, dar si de batalii legislative ce pot modifica viitorul internetului. In articol puteti citi un scurt rezumat al lui 2015 in tehnologie.</strong><br><br><strong>Gadget-uri</strong><br><br>2015 a fost plin de lansari foarte asteptate, lansari despre care s-a speculat in ultimii doi-trei ani. Apple a tinut capul de afis, iar inceputul anului a fost marcat de zvonuri despre <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-19599567-video-apple-watch-marea-lansare-reactii-diverse-internet-elogii-dispret.htm\">ceasul inteligent</a> care s-a lansat in primavara. Dupa lansare au urmat intrebarile: este cu adevarat util, se va vinde, nu e o nebunie sa existe si o varianta de peste 10.000 de dolari?. Ceasul si-a gasit peste 10 milioane de cumparatori pana in prezent.<br><br>Tot de la Apple a venit si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20411843-live-text-apple-prezinta-cel-mai-mare-ipad-pana-acum-12-9-inci.htm\">cel mai mare iPad de pana acum</a>, modelul Pro cu ecran de 12,9 inci, insa de baza ramane iPhone-ul care genereaza 60% din cifra de afaceri a companiei si care a venit si in 2015 cu o noua generatie. Si Samsung a lansat noua generatie Galaxy S6 edge si noul ceas Gear (S2), insa toti marii producatori au venit cu noi generatii ale smartphone-urilor de varf de gama si piata devine tot mai aglomerata.<br><br>La capitolul terminale despre care s-a discutat mult, <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-19335963-samsung-admite-discret-urile-sale-smart-comenzi-vocale-pot-inregistra-conversatiile-personale-ale-privitorilor.htm\">Samsung a tinut prim-plan-ul</a> in februarie cand revista Daily Beast a descoperit faptul ca grupul coreean isi previne cumparatorii in politicile de confidentialitate ca trebuie sa aiba grija sa nu vorbeasca lucruri personale sensibile in fata unui televizor smart cu comenzi vocale. Asta fiindca cele spuse ar putea fi trimise catre o terta parte daca sistemul de recunoastere vocala este activat. Compania a fost criticata pe motiv ca isi spioneaza clientii, insa Samsung a venit cu o clarificare in care spune ca este total transparenta si oricand comenzile vocale pot fi dezactivate, iar utilizatorii pot vedea usor daca microfonul este pornit sau nu<br><br>Anul acesta a crescut enorm oferta la drone, acestea ieftinindu-se si devenind totodata si mai controversate in ceea ce priveste modul in care pot fi utilizate. Insa dronele reprezinta viitorul curieratului, iar retailerul Amazon a anuntat cum vede impartirea spatiului aerian pentru dronele ce fac livrari si a publicat si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20632544-video-amazon-jeremy-clarkson-prezinta-noi-imagini-dronele-care-vor-face-livrari.htm\">noi imagini</a> cu aceste drone pe care le testeaza.<br><br><strong>Ce au facut gigantii</strong><br><br>Evenimentul software al anului a fost <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20326872-windows-10-este-disponibil-miercuri-atat-upgrade-cat-preinstalat-uri-tablete.htm\">lansarea sistemului de operare Windows 10</a>, la final de iulie. Acum ruleaza pe mai bine de 100 milioane de dispozitive, iar compania isi pune toate sperantele in noul sistem, dupa ce Windows 8 a fost un esec. Compania spune ca este cel mai bun si sigur Windows pe care l-a creat. iar printre noutati se numara asistentul vocal Cortana, browserul Edge si aplicatia integrata Xbox.<br><br>Google a venit cu multe noutati, insa cea mai surprinzatoare a fost anuntata in vara cand s-a anuntat ca Google <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20476441-google-implementeaza-schimbarile-operationale-anuntate-august-devine-alphabet-inc-renunta-motto-don-39-evil.htm\">se va numi Alphabet</a> si va functiona precum un holding format din mai multe divizii cu independenta sporita. Schimbarea este vizibila pentru actionari, nu pentru utilizatorii motorului de cautare. Compania continua sa testeze masinile autonome si cauta un partener din industria auto pentru a le produce in serie si a lansat si proeictul prin care baloane speciale aduc internetul in zone sarace.<br><br>Facebook a avut un an plin, numarul de user depasind 1,5 miliarde, iar afacerile au atins un nivel record. Insa departe de a spune ca Facebook a avut un an ideal, mai ales ca in octombrie Curtea de Justitie a UE a invalidat un acord vechi de 15 ani si parafat de SUA si UE. Acordul Safe Harbour permitea companiilor americane de tehnologie sa transfere in SUA date despre utilizatorii europeni, insa acest lucru a fost contestat de un austriac in varsta de 28 de ani, Max Schrems. El sustinea ca transferarea unui volum atat de mare de date despre europeni in SUA ii expune pe cetatenii europeni spionajului american si programelor ilegale de monitorizare dezvoltate de NSA.<br><br>Insa la Facebook au mai existat o serie de dezvoltari pozitive, Messenger devenind dintr-o simpla aplicatie de chat, o platforma de aplicatii prin care poti face direct rezervari la unele restaurante sau poti chema un Uber, Pentru moment, o serie de functionalitati sunt in test, inclusiv asistetul virtual, insa Messenger va deveni o forta, avand peste 700 milioane de useri.<br><br>Nu toate companiile americane au avut vesti bune de comunicat. <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20428468-hewlett-packard-renunta-peste-25-000-angajati.htm\">Hewlett Packard</a>, care este pe cale sa se scindeze, va reduce cu 25-30.000 numarul de angajati la una dintre cele doua noi societati create. HP a renuntat la 54.000 de angajati in ultimii trei ani, ca parte a unuia dintre cele mai drastice programe de restructurare din sectorul tehnologic.<br><br>Insa tot din America vine si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20498405-dell-anunta-cea-mai-mare-tranzactie-din-tehnologie-cumpara-compania-stocare-datelor-emc-pentru-67-miliarde-dolari.htm\">cea mai mare tranzactie</a> din istoria tehnologiei. &#8203;Dell a anuntat in octombrie ca a ajuns la un acord si va cumpara cu 67 miliarde dolari compania specializata in stocarea datelor EMC Corporation, parafand cea mai mare tranzactie realizata intre doua companii de tehnologie. Daca cele dpua parti vor obtine toate aprobarile, tranzactia va fi completata intre mai si octombrie 2016.<br><br>Michael Dell a cautat noi domenii in care sa-si extinda compania, dincolo de piata PC-urilor, care este in scadere. Marele pariu tine de stocarea si gestionarea datelor. EMC are afaceri anuale de 24 miliarde dolari si efectivele pe plan mondial sunt de 70.000 de angajati.<br><br><strong>Amenintarile informatice</strong><br><br>Anul a adus in prim plan si amenintari informatice neobisnuite si ingrijoratoare. De ani buni auzim despre atacuri informatice indreptate impotriva unor state sau corporatii, insa incet incet atacurile vor ajunge sa vizeze lucruri mult mai obisnuite, cum ar fi automobilele. In aceasta vara au fost cateva exemple care arata ca masinile sunt vulnerabile, Cel mai mediatizat a fost cazul unui Jeep la care doi specialisti de securitate informatica au preluat controlul de la cativa kilometri distanta, actionand si franele si directia, fara ca cel de la volan sa poata sa schimbe ceva. A fost un test si controlul masinii a fost preluat datorita unor vulnerabilitati in soft-ul sistemului de infotainment al masinii<br><br>Un alt episod a constat in interventia asupra une<a target=\"Alta pagina\" href=\"http://0-100.hotnews.ro/2015/08/06/doi-cercetatori-au-preluat-de-la-distanta-controlul-unei-masini-tesla-pe-care-au-reusit-sa-o-opreasca-din-mers/\">i masini Tesla</a> care a putut fi oprita din mers, insa doar la viteze foarte mici, de sub 10 km/h. Hackerii au avut mai intai acces in interiorul masinii, putand s-o infecteze cu malware, astfel ca episodul nu a fost considerat unul grav.<br><br>Cei doi cercetatori au trimis comenzi masinii de la distanta, de pe un iPhone, reusind sa deschida usile, portbagajul si sa faca astfel incat toate ecranele din bord sa se inchida. Deocamdata aceste atacuri nu reprezinta un pericol fiindca este infim numarul de masini ce pot fi astfel controlate, insa concluzia este ca industria auto mai are mult de lucru la securitatea informatica si nu va putea sa ofere servicii sigure fara a apela la companii si specialisti din securitate IT.<br><br>Un atac informatic sensibil prin efectele sale intime a fost anuntat in iulie si se refera la un site numit Ashley Madison care se adreseaza oamenilor casatoriti care isi cauta o relatie extra-conjugala. Datele a 33 de milioane de useri au ajuns pe mana hackerilor si milioane de utilizatori ai acestui site s-au temut ca sotul/sotia va afla despre relatiile gasite prin intermediul site-ului. Incidentul a declansat o uriasa polemica legata de moralitatea acestui site care incurajeaza useri sa-si insele partenerul de viata, fiindca viata oricum este scurta (n. r sloganul site-ului este Life is short, have an affair). Cei mai radicali au spus ca oamenii ale caror date au ajuns pe mana hackerilor nu sunt victime, ci isi meritau soarta.<br><br>Doua evenimente importante sunt legate de doua voturi in Parlamentul European, ambele avand legatura cu internetul si viitorul acestuia: unul este legat de <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20535642-votul-din-parlamentul-european-pune-neutralitatea-internetului-pericol-amendamentele-gandite-protejeze-fost-respinse-serie-portite-permit-existenta-internetului-doua-viteze.htm\">neutralitate</a>, iar altul, de o <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20651840-prima-lege-comuna-securittate-cibernetica-nivelul-fost-agreata-dupa-negocieri-dure.htm\">strategie comuna</a> in fata amenintarilor informatice.<br><br><strong>Legi pentru viitorul internetului</strong><br><br>1. La final de octombrie Parlamentul European a votat legea ce obliga companiile care ofera acces la internet sa trateze tot traficul in mod egal, insa vestea rea este ca o serie de amendamente gandite sa elimine ambiguitatile din lege au fost respinse. Furnizorii au libertatea de a da prioritate anumitor tipuri de trafic si unele servicii vor fi clar avantajate in raport cu altele, ceea ce va dezavantaja companiile mici. Legea contine multe portite ce vor duce la crearea internetului \"cu doua viteze\" exact opusul ideii de neutralitate.<br><br>Legea a fost intens discutata in ultimii patru ani si existenta ei este considerata ca foarte buna. Supararea tine insa de faptul ca, in forma actuala, exista o serie de pasaje interpretabile care dau furnizorilor multa putere de a incetini anumite tipuri de trafic si de a permite viteze mai mari companiilor care platesc pentru asta. Cei mai vehementi spun chiar ca legea va da mana libera la abuzuri.<br><br>2. In decembrie, Parlamentul European, Consiliul UE si Comisia Europeana au cazut de acordul asupra primului pachet legislativ comun la nivelul Uniunii pe domeniul securitatii cibernetice, legile fiind prezentate ca un moment de referinta. Marile companii de tehnologie vor fi obligate sa raporteze autoritatilor nationale cand sistemele le-au fost atacate si pot fi sanctionate daca nu comunica. Nu au fost agreate toate detaliile, insa este un prim pas. Estimarile agentiei europene Enisa arata ca, din cauza breselor de securitate, pierderile anuale sunt intre 260 so 340 miliarde euro.<br><br>Acordul a fost parafat dupa cinci ore de negocieri intre Parlamentul European si reprezentantii tarilor UE, fiind un raspuns la amenintarile cibernetice care sunt, de la zi la zi, tot mai mari.',NULL,1),(5,'Fără titlu? Nu cred...',NULL,NULL,1),(6,'Pas de place en crèche? Les nonnas et les nounous sont fidèles au poste','<div class=\"inner-module\">\r\n						Malgré les efforts entrepris ces 15 dernières années, l\'offre en crèche reste insuffisante. Que peuvent faire les parents si la famille proche ne répond pas à l\'appel? Etat des lieux en Suisse romande.\r\n					</div>\r\n<h3>Encore de nombreuses mères au foyer</h3>\r\n<p>Malgré les progrès constatés, seuls 18% des petits enfants sont pris en charge exclusivement dans des institutions (structures d\'accueil en milieu collectif ou familial). A contrario, 35% des petits bénéficient exclusivement d\'une garde non institutionnelle (famille proche ou particulier), et ceci pas forcément par choix. En effet, des centaines d\'entre eux sont sur la liste d\'attente d\'une structure subventionnée.</p>\r\n<p>En même temps, tous les parents ne souhaitent pas forcément confier leurs bambins à des tiers: 26% des moins de 4 ans sont gardés exclusivement par leurs parents (ce taux serait plus bas en Suisse romande, avec 21% dans le canton de Vaud par exemple).</p>',NULL,0),(7,'\r\nQuatre Tremplins: Peter Prevc s\'envole à Innsbruck et au général, Ammann décevant\r\n','<div class=\"inner-module\">\r\n						Déjà vainqueur à Garmisch-Partenkirchen il y a deux jours, le Slovène Peter Prevc a remporté le concours d\'Innsbruck devant l\'Allemand Severin Freud. Prevc possède désormais 19.7 points d\'avance sur son dauphin du jour avant l\'ultime concours de Bischofshofen. Simon Ammann a dû, lui, se contenter d\'une décevante 22e place dans le Tyrol. \r\n					</div>',NULL,1),(8,'Voile: Spindrift 2 ne battra pas le record du tour du monde sans escale','<p>La météo a tranché, entre un anticyclone des Açores campé en travers de la route et de violentes tempêtes à suivre avec une mer déchaînée les conditions qui règnent sur l’Atlantique sont particulièrement défavorables pour conclure dans les temps ce tour du monde. Dès aujourd\'hui, les marins de Spindrift 2 vont lever le pied et cesser de naviguer en mode record selon un communiqué du team. </p>',NULL,0),(9,'Sport-Première','Le foot, le hockey, le ski, l’athlétisme et tous les autres sports ont rendez-vous dans Sport-Première.\r\n\r\nAu menu, beaucoup de direct des stades, mais aussi des interviews, des reportages et des commentaires pour mettre les compétitions en perspective.\r\n\r\nOn y parle également sport et argent, santé, modes et nouveautés.',NULL,0),(10,'L\'homme qui a foncé sur des soldats inculpé pour tentative d\'homicide',NULL,NULL,1),(11,'Le juge d\'instruction s\'est déplacé à l\'hôpital pour la mise en examen (inculpation) car le forcené est toujours hospitalisé\", a déclaré à l\'AFP le procureur de Valence, Alex Perrin',NULL,NULL,0);

UNLOCK TABLES;

/*Table structure for table `sys_backend_usergroups` */

DROP TABLE IF EXISTS `sys_backend_usergroups`;

CREATE TABLE `sys_backend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Backend usergroup name',
  `access` text COLLATE utf8_unicode_ci COMMENT 'json group permissions',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the usergroup deleted?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_backend_usergroups` */

LOCK TABLES `sys_backend_usergroups` WRITE;

UNLOCK TABLES;

/*Table structure for table `sys_backend_users` */

DROP TABLE IF EXISTS `sys_backend_users`;

CREATE TABLE `sys_backend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend username',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend encrypted password',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is the user deleted or not',
  `is_active` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the user active?',
  `usergroup_id` int(10) unsigned DEFAULT NULL COMMENT 'Backend usergroup id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user fullname',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_backend_users` */

LOCK TABLES `sys_backend_users` WRITE;

insert  into `sys_backend_users`(`id`,`username`,`password`,`is_deleted`,`is_active`,`usergroup_id`,`name`) values (1,'admin','admin',0,1,NULL,'Amazing Sniperman');

UNLOCK TABLES;

/*Table structure for table `sys_cache` */

DROP TABLE IF EXISTS `sys_cache`;

CREATE TABLE `sys_cache` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `value` text COLLATE utf8_unicode_ci,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_at` int(11) unsigned DEFAULT NULL,
  `record_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_cache` */

LOCK TABLES `sys_cache` WRITE;

UNLOCK TABLES;

/*Table structure for table `sys_configuration` */

DROP TABLE IF EXISTS `sys_configuration`;

CREATE TABLE `sys_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the domain to which this setting belongs to',
  `language_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the language to which it belongs',
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_configuration` */

LOCK TABLES `sys_configuration` WRITE;

insert  into `sys_configuration`(`id`,`domain_id`,`language_id`,`key`,`value`) values (1,1,0,'System/Locale','ro_RO');

UNLOCK TABLES;

/*Table structure for table `sys_content` */

DROP TABLE IF EXISTS `sys_content`;

CREATE TABLE `sys_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `page_id` int(11) unsigned DEFAULT NULL COMMENT 'id of page where content is stored',
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'element type: plugin or content',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title of the content element',
  `column_id` int(11) unsigned DEFAULT NULL COMMENT 'id of column where template and fields are stored',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT 'currently only used for containers, for recursivity, stores the uid of the parent container it belongs to',
  `value` text COLLATE utf8_unicode_ci COMMENT 'value of the content element',
  `reference_id` int(11) unsigned DEFAULT NULL COMMENT 'reference to another content element',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is content visible on page?',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is content deleted on the page? (user for history purposes)',
  `created_at` int(11) unsigned DEFAULT NULL COMMENT 'creation utc date',
  `modified_at` int(11) unsigned DEFAULT NULL COMMENT 'modification utc date',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting of elements',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_content` */

LOCK TABLES `sys_content` WRITE;

insert  into `sys_content`(`id`,`page_id`,`type`,`title`,`column_id`,`parent_id`,`value`,`reference_id`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (1,1,'content','Fully Responsive',4,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-desktop fa-3x\",\"link\":\"4\",\"content\":\"<p>Blablabla, hope it works.<br>Now, on to the second paragraph :)<br>\\u015ei acum s\\u0103 \\u00eencerc\\u0103m ni\\u015fte caractere scrise \\u00een limba rom\\u00e2n\\u0103 cu diacritice.<br>Se pare ca merge<br><\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(2,4,'plugin','',1,0,'{\"plugin\":{\"extension\":\"News\",\"identifier\":\"news\",\"controller\":\"Index\",\"template\":\"show\",\"action\":\"index\",\"data\":{\"limit\":\"12\",\"order\":\"asc\"}}}',NULL,1,0,NULL,NULL,13),(3,1,'container','Awesome title',2,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"formatColumns\":\"1\"}}}',NULL,1,0,NULL,NULL,12),(4,1,'content','公募プログラムガイドライン',5,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-pagelines fa-3x\",\"link\":\"4\",\"content\":\"<p>\\u306b\\u3064\\u3044\\u3066\\u4e8b\\u696d\\u3092\\u884c\\u3063\\u3066\\u3044\\u307e\\u3059\\u3002\\u3053\\u308c\\u3089\\u306e\\u5206\\u91ce\\u306b\\u306f\\u3001\\u305d\\u308c\\u305e\\u308c\\u516c\\u52df\\u30d7\\u30ed\\u30b0\\u30e9\\u30e0\\u304c\\u3042\\u308a\\u3001\\u56fd\\u969b\\u4ea4\\u6d41\\u4e8b\\u696d\\u3092\\u4f01\\u753b\\u3092\\u5b9f\\u65bd\\u3059\\u308b\\u500b\\u4eba\\u3084\\u56e3\\u4f53\\u306b\\u5bfe\\u3057\\u3066\\u3001\\u52a9\\u6210\\u91d1\\u3001\\u7814\\u7a76\\u5968\\u5b66\\u91d1\\uff08\\u30d5\\u30a7\\u30ed\\u30fc\\u30b7\\u30c3\\u30d7 \\u300c\\u306f\\u3058\\u3081\\u3066\\u7533\\u8acb\\u3055\\u308c\\u308b\\u65b9\\u3078\\u300d\\u3092\\u304a\\u8aad\\u307f\\u304f\\u3060\\u3055\\u3044\\u3002<\\/p>\"}}}',NULL,1,0,NULL,NULL,4),(5,1,'container','50% stanga, 50% dreapta',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,29),(6,1,'content','Lovely day',7,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(7,1,'container','4 elements',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"formatColumns\":\"1\"}}}',NULL,1,0,NULL,NULL,28),(8,2,'plugin','Afişare ultimele articole',4,17,'{\"plugin\":{\"extension\":\"News\",\"template\":\"show\",\"controller\":\"Index\",\"identifier\":\"news\",\"action\":\"show\",\"data\":{\"limit\":\"3\",\"order\":\"asc\"}}}',NULL,1,0,NULL,NULL,1),(9,1,'container','Container cu 1 coloană',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"1column\",\"data\":[]}}',NULL,1,0,NULL,NULL,33),(10,1,'content','2 elements follow now :)',4,9,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<div class=\\\"repository-meta js-details-container \\\">\\n    <div class=\\\"repository-description\\\">\\n      Tiny bootstrap-compatible WISWYG rich text editor\\n    </div>\\n\\n\\n\\n</div>\\n\\n<div class=\\\"overall-summary overall-summary-bottomless\\\">\\n\\n  <div class=\\\"stats-switcher-viewport js-stats-switcher-viewport\\\">\\n    <div class=\\\"stats-switcher-wrapper\\\">\\n    <ul class=\\\"numbers-summary\\\">\\n      <li class=\\\"commits\\\">\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/commits/master\\\">\\n            <span class=\\\"octicon octicon-history\\\"></span>\\n            <span class=\\\"num text-emphasized\\\">\\n              67\\n            </span>\\n            commits\\n        </a>\\n      </li>\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/branches\\\">\\n          <span class=\\\"octicon octicon-git-branch\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            2\\n          </span>\\n          branches\\n        </a>\\n      </li>\\n\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/releases\\\">\\n          <span class=\\\"octicon octicon-tag\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            0\\n          </span>\\n          releases\\n        </a>\\n      </li>\\n\\n      <li>\\n        \\n  <a href=\\\"/mindmup/bootstrap-wysiwyg/graphs/contributors\\\">\\n    <span class=\\\"octicon octicon-organization\\\"></span>\\n    <span class=\\\"num text-emphasized\\\">\\n      8\\n    </span>\\n    contributors\\n  </a>\\n      </li>\\n    </ul>\\n\\n      <div class=\\\"repository-lang-stats\\\">\\n        <ol class=\\\"repository-lang-stats-numbers\\\">\\n          <li>\\n              <a href=\\\"/mindmup/bootstrap-wysiwyg/search?l=javascript\\\">\\n                <span class=\\\"color-block language-color\\\" style=\\\"background-color:#f1e05a;\\\"></span>\\n                <span class=\\\"lang\\\">JavaScript</span>\\n                <span class=\\\"percent\\\">99.3%</span>\\n              </a>\\n          </li>\\n        </ol>\\n      </div>\\n    </div>\\n  </div>\\n\\n</div>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,2),(11,1,'content','Lorem ipsum',6,7,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"Box\",\r\n    \"data\": {\r\n      \"content\": \"<p>Lorem ipsum <strong>dolor sit amec</strong> and all the rest of the latin phrases used for text formating should just follow along.<br/>Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.</p>\",\r\n      \"icon\": \"fa fa-edit fa-3x\",\r\n      \"link\": \"3\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,1),(12,1,'content','Moderna',2,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"CallAction\",\"data\":{\"subheader\":\"A starting theme for Continut CMS\"}}}',NULL,1,0,NULL,NULL,14),(13,2,'container','Container 3 coloane, care si merge :)',4,28,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"3columns\",\"data\":{\"limit\":4}}}',NULL,1,0,NULL,NULL,2),(14,2,'content','',4,13,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading<u><\\/u> style<u><\\/u><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6><br>\"}}}',NULL,1,0,NULL,NULL,8),(15,2,'content',NULL,5,13,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<table><tr><td>Cell1</td><td> Cell 2</td></tr></table><h4>Example of paragraph</h4><p><strong>Lorem ipsum dolor sit amet</strong>, consetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p><p class=\\\"lead\\\">At vero eos et accusam et justo duo dolores et eabum.</p><p><em>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </em>\\n\\t\\t\\t\\t</p>\\n\\t\\t\\t\\t<p>\\n\\t\\t\\t\\t\\t<small>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </small></p>\\t\\t\\t\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,11),(16,2,'content','Separator de linie',4,31,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"SolidLine\",\"data\":{\"lineType\":\"solid\"}}}',NULL,1,0,NULL,NULL,1),(17,2,'container','',4,31,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,2),(18,2,'reference',NULL,5,17,NULL,6,1,0,NULL,NULL,20),(19,2,'reference',NULL,4,28,NULL,5,1,0,NULL,NULL,1),(20,1,'content','',4,5,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading style (modified in parent)<br><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6>\"}}}',NULL,1,0,NULL,NULL,7),(21,1,'content',NULL,6,13,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<h4>H1-H6 Heading style</h4><h1>Heading H1</h1><h2>HeadingH2</h2><h3>Heading H3</h3><h4>Heading H4</h4><h5>Heading H5</h5><h6>Heading H6</h6>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,1),(22,17,'content','Showing off from another domain :) Sweeeet',1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(23,19,'content',NULL,1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(28,2,'container','test',1,0,'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"features\",\"type\":\"container\",\"template\":\"features\",\"data\":{\"title\":\"test\"}}}',NULL,1,0,NULL,NULL,1),(31,2,'container',NULL,1,0,'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"about\",\"type\":\"container\",\"template\":\"about\",\"data\":{\"title\":\"\"}}}',NULL,1,0,NULL,NULL,1),(32,2,'content',NULL,4,28,'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"featureImage\",\"type\":\"content\",\"template\":\"FeatureImage\",\"data\":{\"image\":\"\\/Media\\/DSCF4216.JPG\"}}}',NULL,1,0,NULL,NULL,3);

UNLOCK TABLES;

/*Table structure for table `sys_domain_urls` */

DROP TABLE IF EXISTS `sys_domain_urls`;

CREATE TABLE `sys_domain_urls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_id` int(11) DEFAULT NULL COMMENT 'parent domain url, if an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  `domain_id` int(10) unsigned NOT NULL COMMENT 'uid of main domain',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'iso2 code for the flag',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title to be displayed in the frontend/backend',
  `sorting` int(10) unsigned NOT NULL COMMENT 'backend sorting order',
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'language locale',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_domain_urls` */

LOCK TABLES `sys_domain_urls` WRITE;

insert  into `sys_domain_urls`(`id`,`parent_id`,`url`,`is_alias`,`domain_id`,`flag`,`title`,`sorting`,`locale`) values (1,NULL,'cms.dev',0,1,'ro','Română',0,'ro_RO'),(2,NULL,'fim-live.fr',0,1,'fr','Français',1,'fr_FR'),(3,NULL,'d2.test',0,2,'ro','Limba română',0,'ro_RO');

UNLOCK TABLES;

/*Table structure for table `sys_domains` */

DROP TABLE IF EXISTS `sys_domains`;

CREATE TABLE `sys_domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url used by default by the domain',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the domain active?',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting order of the domains',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_domains` */

LOCK TABLES `sys_domains` WRITE;

insert  into `sys_domains`(`id`,`title`,`url`,`is_visible`,`sorting`) values (1,'Test Website','fim-live.com',1,0),(2,'Federation de la Haute Horlogerie','d2.test',1,1),(3,'TAG Aviation','tag.test',1,2);

UNLOCK TABLES;

/*Table structure for table `sys_file_mounts` */

DROP TABLE IF EXISTS `sys_file_mounts`;

CREATE TABLE `sys_file_mounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mount storage title',
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'starting mount folder, or path',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'file' COMMENT 'mount storage type ("file", "aws", "dropbox", etc). by default it should be "file"',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'username for remote access',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'password for remote access',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url for remote access',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_file_mounts` */

LOCK TABLES `sys_file_mounts` WRITE;

insert  into `sys_file_mounts`(`id`,`title`,`folder`,`type`,`username`,`password`,`url`) values (1,'Main local mount','/','file',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `sys_file_references` */

DROP TABLE IF EXISTS `sys_file_references`;

CREATE TABLE `sys_file_references` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'uid for this reference',
  `file_id` int(11) unsigned DEFAULT NULL COMMENT 'the id of the record in sys_file table',
  `foreign_id` int(11) unsigned DEFAULT NULL COMMENT 'the id of the record holding this image',
  `is_visible` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `tablename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name of the table that references this file',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Image title',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Alt text',
  `description` text COLLATE utf8_unicode_ci COMMENT 'Image description/caption',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_file_references` */

LOCK TABLES `sys_file_references` WRITE;

insert  into `sys_file_references`(`id`,`file_id`,`foreign_id`,`is_visible`,`is_deleted`,`tablename`,`title`,`alt`,`description`) values (1,1,5,1,0,'ext_news','Additional title',NULL,'And blabla description'),(2,2,7,1,0,'ext_news',NULL,NULL,NULL),(3,5,5,1,0,'ext_news',NULL,NULL,NULL),(4,4,4,1,0,'ext_news',NULL,NULL,NULL),(5,1,3,1,0,'ext_news',NULL,NULL,NULL),(6,5,2,1,0,'ext_news',NULL,NULL,NULL),(7,6,1,1,0,'ext_news',NULL,NULL,NULL),(8,7,6,1,0,'ext_news',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `sys_files` */

DROP TABLE IF EXISTS `sys_files`;

CREATE TABLE `sys_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'file unique id',
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'filename',
  `filesize` int(11) unsigned DEFAULT NULL COMMENT 'filesize in bytes',
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file physical location',
  `mime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file mime type',
  `created_at` int(11) DEFAULT NULL COMMENT 'utc creation time',
  `modified_at` int(11) DEFAULT NULL COMMENT 'utc modification time',
  `mount_id` int(11) DEFAULT NULL COMMENT 'file storage mount id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_files` */

LOCK TABLES `sys_files` WRITE;

insert  into `sys_files`(`id`,`filename`,`filesize`,`location`,`mime`,`created_at`,`modified_at`,`mount_id`) values (1,'DSCF4261.JPG',796745,'Media/','image/jpeg',NULL,NULL,1),(2,'DSCF4268.JPG',19859,'Media/','image/jpeg',NULL,NULL,1),(3,'DSCF4258.JPG',2295217,'Media/','image/jpeg',NULL,NULL,1),(4,'DSCF4216.JPG',78911,'Media/','image/jpeg',NULL,NULL,1),(5,'DSCF4247.JPG',3103874,'Media/','image/jpeg',NULL,NULL,1),(6,'DSCF4260.JPG',NULL,'Media/','image/png',NULL,NULL,1),(7,'DSCF4218.JPG',NULL,'Media/','image/png',NULL,NULL,1);

UNLOCK TABLES;

/*Table structure for table `sys_frontend_usergroups` */

DROP TABLE IF EXISTS `sys_frontend_usergroups`;

CREATE TABLE `sys_frontend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_frontend_usergroups` */

LOCK TABLES `sys_frontend_usergroups` WRITE;

insert  into `sys_frontend_usergroups`(`id`,`title`,`access`,`is_deleted`) values (1,'Test FE usergroup',NULL,0);

UNLOCK TABLES;

/*Table structure for table `sys_frontend_users` */

DROP TABLE IF EXISTS `sys_frontend_users`;

CREATE TABLE `sys_frontend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  `is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_frontend_users` */

LOCK TABLES `sys_frontend_users` WRITE;

insert  into `sys_frontend_users`(`id`,`username`,`password`,`usergroup_id`,`is_deleted`,`is_active`) values (1,'ramo','pass311',1,0,1);

UNLOCK TABLES;

/*Table structure for table `sys_languages` */

DROP TABLE IF EXISTS `sys_languages`;

CREATE TABLE `sys_languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `domain_id` int(11) unsigned NOT NULL COMMENT 'the domain this language belongs to',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code of the language',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title shown in the dropdowns',
  `sorting` int(11) unsigned DEFAULT NULL COMMENT 'display order of languages',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'country flag to use in the backend',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_languages` */

LOCK TABLES `sys_languages` WRITE;

insert  into `sys_languages`(`id`,`domain_id`,`language_iso3`,`title`,`sorting`,`flag`) values (1,1,'rou','Română',0,'ro'),(2,1,'fra','Français',1,'fr'),(3,2,'rou','Română',0,'ro'),(4,2,'eng','English',1,'gb'),(5,3,'eng','English',0,'gb');

UNLOCK TABLES;

/*Table structure for table `sys_pages` */

DROP TABLE IF EXISTS `sys_pages`;

CREATE TABLE `sys_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'page unique id',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'the parent page uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page title',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code for the language',
  `original_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'uid of the original page, if this is a translated page',
  `is_in_menu` tinyint(1) DEFAULT '1' COMMENT 'is the page shown in the frontend menu?',
  `is_visible` tinyint(1) DEFAULT '0' COMMENT 'is the page visible?',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the page deleted?',
  `domain_url_id` int(11) DEFAULT NULL COMMENT 'the domain url this page belongs to',
  `layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the layout to use',
  `layout_recursive` tinyint(1) DEFAULT '0' COMMENT 'will this layout be inherited by any subpage created inside it',
  `frontend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout template to be used by this page - cached',
  `backend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout used in the backend - cached',
  `cached_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cached breadcrumb path',
  `sorting` int(11) unsigned DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page slug',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Meta keywords',
  `meta_description` text COLLATE utf8_unicode_ci COMMENT 'Meta description',
  `start_date` datetime DEFAULT NULL COMMENT 'starting date when page will be visible',
  `end_date` datetime DEFAULT NULL COMMENT 'page will be visible until this date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_pages` */

LOCK TABLES `sys_pages` WRITE;

insert  into `sys_pages`(`id`,`parent_id`,`title`,`language_iso3`,`original_id`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_id`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (1,0,'Comics HAC!BD remodif','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','',2,'comics-hac-bd','comics,hac,benzi desenate,revista hac','Meta descrierea paginii vine aici.\r\nBlablabla','2015-12-30 18:00:00','0000-00-00 00:00:00'),(2,0,'Revista HAC!','rou',0,1,1,0,1,'ThemeAtlas.default',0,'/Extensions/Local/ThemeAtlas/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeAtlas/Resources/Private/Backend/Layouts/Default.layout.php','1',1,'revista-hac','meta keywords for this page','test meta description','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,0,'Albume HAC!BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',3,'albumele-hac',NULL,NULL,NULL,NULL),(4,0,'Abonamente HAC!BD','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','1',5,'abonamente-hacbd','','vrei sa scrii ceva\r\nnu poti. sau poate ca poti\r\n\r\nincredibil...',NULL,NULL),(5,0,'Alt BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','12,4,1',7,'alt-bd',NULL,NULL,NULL,NULL),(6,5,'The Walking Dead RO','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',41,'the-walking-dead-ro',NULL,NULL,NULL,NULL),(7,5,'Albume BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',42,'albume-bd',NULL,NULL,NULL,NULL),(8,5,'Indie Comics','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',43,'indie-comics',NULL,NULL,NULL,NULL),(9,0,'Haine','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',14,'haine',NULL,NULL,NULL,NULL),(10,9,'Tricouri Fete','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',61,'tricouri-fete',NULL,NULL,NULL,NULL),(11,9,'Tricouri Băieţi','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',62,'tricouri-baieti',NULL,NULL,NULL,NULL),(12,3,'De-ale capului','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','4,1',66,'de-ale-capului',NULL,NULL,NULL,NULL),(13,0,'Postere','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',6,'postere',NULL,NULL,NULL,NULL),(14,13,'Postere HAC!BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','13',55,'postere-hacbd',NULL,NULL,NULL,NULL),(15,0,'Cărţi','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',15,'carti',NULL,NULL,NULL,NULL),(16,5,'Altele','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',44,'altele',NULL,NULL,NULL,NULL),(17,0,'Test homepage','rou',0,1,1,0,3,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','',58,'test-homepage',NULL,NULL,NULL,NULL),(18,17,'Test subpage','rou',0,1,1,0,3,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','17',59,'test-subpage',NULL,NULL,NULL,NULL),(19,0,'Les comics HAC!BD','',1,1,1,0,2,NULL,0,NULL,NULL,'',0,'comics-hac-fr','comics,francais stuff','description de la page française',NULL,NULL),(20,28,'test1','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,65,'title1','','',NULL,NULL),(21,4,'test2','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,0,'title2','','',NULL,NULL),(22,4,'test12','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,0,'title3',NULL,NULL,NULL,NULL),(23,4,'test23','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,0,'title4',NULL,NULL,NULL,NULL),(24,20,'subpage1','rou',0,1,1,0,0,NULL,0,NULL,NULL,NULL,NULL,'subpage1',NULL,NULL,NULL,NULL),(25,20,'subpage2','rou',0,1,1,0,0,NULL,0,NULL,NULL,NULL,NULL,'subpage2',NULL,NULL,NULL,NULL),(26,28,'root1','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,63,'root1','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,28,'root2','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,64,'root2',NULL,NULL,NULL,NULL),(28,0,'root3','rou',0,1,1,0,1,'ThemeBootstrapModerna.default',1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',NULL,NULL,'root3','root, test page','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,26,'subroot1 has changed it\'s title','rou',0,1,1,0,1,'',1,NULL,NULL,NULL,NULL,'subroot1','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,26,'gringo','rou',0,1,1,0,1,'',0,NULL,NULL,NULL,NULL,'gringo','','','0000-00-00 00:00:00','0000-00-00 00:00:00');

UNLOCK TABLES;

/*Table structure for table `sys_registry` */

DROP TABLE IF EXISTS `sys_registry`;

CREATE TABLE `sys_registry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT '0',
  `domain_url_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_registry` */

LOCK TABLES `sys_registry` WRITE;

insert  into `sys_registry`(`id`,`key`,`value`,`domain_id`,`domain_url_id`) values (1,'System/Locale','ro_RO',0,0),(2,'Settings/Session/FeuserExpire','360',0,0),(3,'Settings/Session/BeuserExpire','260',0,0);

UNLOCK TABLES;

/*Table structure for table `sys_user_sessions` */

DROP TABLE IF EXISTS `sys_user_sessions`;

CREATE TABLE `sys_user_sessions` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique php session id',
  `session_data` text COLLATE utf8_unicode_ci COMMENT 'session data',
  `session_expires` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of user, BackendUser or FrontendUser',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_user_sessions` */

LOCK TABLES `sys_user_sessions` WRITE;

insert  into `sys_user_sessions`(`session_id`,`session_data`,`session_expires`,`user_id`,`user_type`) values ('nb0unqkvgchokbit4aco9grj57','user_id|s:1:\"1\";fullname|s:17:\"Amazing Sniperman\";',1454251412,NULL,NULL),('nmas3b9ej9gcvpdvkar9ohq5h4','',1454251534,NULL,NULL),('p6gktti6s286n3k9glfndde003','',1454251393,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
