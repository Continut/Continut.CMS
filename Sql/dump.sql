-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ext_news`;
CREATE TABLE `ext_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'news uid',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `author` int(11) unsigned DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ext_news` (`id`, `title`, `description`, `author`, `is_visible`, `created_at`) VALUES
(1,	'<font color=\"FF0000\">Dakar 2016:</font> Un baiat de 10 ani si tatal sau, grav raniti in prologul competitiei',	'<strong>Un baiat in varsta de 10 ani si tatal sau de 34 de ani au fost grav raniti intr-un accident produs la prologul Dakar-2016, sambata, la Buenos Aires, cand o masina a iesit de pe carosabil si i-a lovit, incidentul ducand la intreruperea cursei, informeaza Mediafax.<br></strong><br>In total, zece persoane au fost ranite in accident, conform organizatorilor.<br><br>Accidentul s-a produs cand masina in care se aflau pilotul chinez Guo Meiling si copilotul Min Liao a iesit de pe drum si a lovit un grup de spectatori, la nivelul kilometrului 6,6 al probei speciale din prolog, pe distanta dintre Buenos Aires si Rosario.<br><br>Autoritatile locale au deschis o ancheta, echipajul chinez urmand sa fie audiat de politie.<br><br>In prologul Dakar-2016, romanul Emanuel Gyenes a ocupat locul 26 la clasa moto.',	NULL,	1,	NULL),
(2,	'Uber a starnit noi controverse dupa ce a avut si tarife de zece ori mai mari in noaptea de Revelion ',	'<strong>&#8203;Uber a starnit noi controverse, mai ales in SUA, dar si in Romania, dupa ce in noaptea de Revelion preturile calatoriilor au fost chiar si de 7-10 ori mai mari decat tarifele standard. Trebuie spus ca Uber are o optiune de preturi dinamice si tarifele cresc in perioadele de varf ale fiecarei zile, insa clientii s-au suparat acum fiindca s-au trezit dupa cursa cu costuri exceptional de mari. Uber a publicat pe 31 decembrie <a target=\"Alta pagina\" href=\"https://newsroom.uber.com/romania/ro/ghid-pentru-revelion/\" rel=\"nofollow\">un ghid</a> in care isi avertiza clientii ca tarifele vor creste puternic in noaptea de Revelion. Urmarea a fost ca o cursa care cu un taxi normal ar fi costat sub 10 lei a ajuns sa fie 62 de lei cu Uber.<br></strong><br>Aplicatia Uber are probleme cu legea in multe tari si controversele se tin lant. Acum, publicul din SUA a criticat masiv compania dupa ce tarifele in noaptea de anul nou au ajuns sa fie atat de mari incat unele persoane au efectuat curse care au costat si peste 300 dolari, cand tariful standard era de sub 50 de dolari.<br><br>Si in Bucuresti tarifele au crescut puternic si <a target=\"Alta pagina\" href=\"http://www.cristianscutariu.ro/uber-facut-revelion-tarife-7-mari-11-5-81-pana-centrul-vechi/\" rel=\"nofollow\">puteti citi aici</a> despre cum au evoluat pe parcursul noptii, iar<a target=\"Alta pagina\" href=\"https://www.facebook.com/photo.php?fbid=1199228186758159&amp;set=a.264555060225481.81496.100000129683046&amp;type=3&amp;theater\" rel=\"nofollow\"> aici</a> despre povestea unei persoane care a paltit 190 lei pentru o calatorie de 11 km in Bucuresti.<br><br>Un alt exemplu tine de o persoana careia i s-au luat de pe card 62 de lei pentru o cursa de 5 km care ar fi costat sub 10 lei cu un taxi clasic. Problema cea mare in cazul de fata este ca estimarea Uber de dinainte de cursa indica 38 de lei, cu 40% mai putin decat utilizatorul a fost nevoit sa plateasca.<br><br>Uber are tarife mai mari decat taxiurile in Bucuresti si este preferata de multi oameni care au avut neplaceri cu taximetristii. Cum imaginea acestora nu este prea grozava in Bucuresti, Uber este vazut ca fiind o alternativa civilizata cu soferi amabili care nu fumeaza in timp ce conduc si nu pun manele.<br><br>',	NULL,	1,	NULL),
(3,	'<font color=\"FF0000\">RETROSPECTIVA</font> Anul 2015 in tehnologie - De la gadget-uri indelung asteptate, pana la automobile mestesugit atacate',	NULL,	NULL,	0,	NULL),
(4,	'Lălăială cu accente și diacritice',	'<strong>Se incheie un an plin de evenimente in tehnologie, un an in care s-au lansat gadget-uri despre care se vorbeste de mult timp si un an in care s-au parafat tranzactii de zeci de miliarde de dolari. Se termina un an in care unele ompanii gigantice au facut schimbari mari si au intrat pe noi teritorii, in timp ce altele fac concedieri. 2015 a fost marcat si de atacuri informatice extrem de sensibile, dar si de batalii legislative ce pot modifica viitorul internetului. In articol puteti citi un scurt rezumat al lui 2015 in tehnologie.</strong><br><br><strong>Gadget-uri</strong><br><br>2015 a fost plin de lansari foarte asteptate, lansari despre care s-a speculat in ultimii doi-trei ani. Apple a tinut capul de afis, iar inceputul anului a fost marcat de zvonuri despre <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-19599567-video-apple-watch-marea-lansare-reactii-diverse-internet-elogii-dispret.htm\">ceasul inteligent</a> care s-a lansat in primavara. Dupa lansare au urmat intrebarile: este cu adevarat util, se va vinde, nu e o nebunie sa existe si o varianta de peste 10.000 de dolari?. Ceasul si-a gasit peste 10 milioane de cumparatori pana in prezent.<br><br>Tot de la Apple a venit si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20411843-live-text-apple-prezinta-cel-mai-mare-ipad-pana-acum-12-9-inci.htm\">cel mai mare iPad de pana acum</a>, modelul Pro cu ecran de 12,9 inci, insa de baza ramane iPhone-ul care genereaza 60% din cifra de afaceri a companiei si care a venit si in 2015 cu o noua generatie. Si Samsung a lansat noua generatie Galaxy S6 edge si noul ceas Gear (S2), insa toti marii producatori au venit cu noi generatii ale smartphone-urilor de varf de gama si piata devine tot mai aglomerata.<br><br>La capitolul terminale despre care s-a discutat mult, <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-19335963-samsung-admite-discret-urile-sale-smart-comenzi-vocale-pot-inregistra-conversatiile-personale-ale-privitorilor.htm\">Samsung a tinut prim-plan-ul</a> in februarie cand revista Daily Beast a descoperit faptul ca grupul coreean isi previne cumparatorii in politicile de confidentialitate ca trebuie sa aiba grija sa nu vorbeasca lucruri personale sensibile in fata unui televizor smart cu comenzi vocale. Asta fiindca cele spuse ar putea fi trimise catre o terta parte daca sistemul de recunoastere vocala este activat. Compania a fost criticata pe motiv ca isi spioneaza clientii, insa Samsung a venit cu o clarificare in care spune ca este total transparenta si oricand comenzile vocale pot fi dezactivate, iar utilizatorii pot vedea usor daca microfonul este pornit sau nu<br><br>Anul acesta a crescut enorm oferta la drone, acestea ieftinindu-se si devenind totodata si mai controversate in ceea ce priveste modul in care pot fi utilizate. Insa dronele reprezinta viitorul curieratului, iar retailerul Amazon a anuntat cum vede impartirea spatiului aerian pentru dronele ce fac livrari si a publicat si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20632544-video-amazon-jeremy-clarkson-prezinta-noi-imagini-dronele-care-vor-face-livrari.htm\">noi imagini</a> cu aceste drone pe care le testeaza.<br><br><strong>Ce au facut gigantii</strong><br><br>Evenimentul software al anului a fost <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20326872-windows-10-este-disponibil-miercuri-atat-upgrade-cat-preinstalat-uri-tablete.htm\">lansarea sistemului de operare Windows 10</a>, la final de iulie. Acum ruleaza pe mai bine de 100 milioane de dispozitive, iar compania isi pune toate sperantele in noul sistem, dupa ce Windows 8 a fost un esec. Compania spune ca este cel mai bun si sigur Windows pe care l-a creat. iar printre noutati se numara asistentul vocal Cortana, browserul Edge si aplicatia integrata Xbox.<br><br>Google a venit cu multe noutati, insa cea mai surprinzatoare a fost anuntata in vara cand s-a anuntat ca Google <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20476441-google-implementeaza-schimbarile-operationale-anuntate-august-devine-alphabet-inc-renunta-motto-don-39-evil.htm\">se va numi Alphabet</a> si va functiona precum un holding format din mai multe divizii cu independenta sporita. Schimbarea este vizibila pentru actionari, nu pentru utilizatorii motorului de cautare. Compania continua sa testeze masinile autonome si cauta un partener din industria auto pentru a le produce in serie si a lansat si proeictul prin care baloane speciale aduc internetul in zone sarace.<br><br>Facebook a avut un an plin, numarul de user depasind 1,5 miliarde, iar afacerile au atins un nivel record. Insa departe de a spune ca Facebook a avut un an ideal, mai ales ca in octombrie Curtea de Justitie a UE a invalidat un acord vechi de 15 ani si parafat de SUA si UE. Acordul Safe Harbour permitea companiilor americane de tehnologie sa transfere in SUA date despre utilizatorii europeni, insa acest lucru a fost contestat de un austriac in varsta de 28 de ani, Max Schrems. El sustinea ca transferarea unui volum atat de mare de date despre europeni in SUA ii expune pe cetatenii europeni spionajului american si programelor ilegale de monitorizare dezvoltate de NSA.<br><br>Insa la Facebook au mai existat o serie de dezvoltari pozitive, Messenger devenind dintr-o simpla aplicatie de chat, o platforma de aplicatii prin care poti face direct rezervari la unele restaurante sau poti chema un Uber, Pentru moment, o serie de functionalitati sunt in test, inclusiv asistetul virtual, insa Messenger va deveni o forta, avand peste 700 milioane de useri.<br><br>Nu toate companiile americane au avut vesti bune de comunicat. <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20428468-hewlett-packard-renunta-peste-25-000-angajati.htm\">Hewlett Packard</a>, care este pe cale sa se scindeze, va reduce cu 25-30.000 numarul de angajati la una dintre cele doua noi societati create. HP a renuntat la 54.000 de angajati in ultimii trei ani, ca parte a unuia dintre cele mai drastice programe de restructurare din sectorul tehnologic.<br><br>Insa tot din America vine si <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20498405-dell-anunta-cea-mai-mare-tranzactie-din-tehnologie-cumpara-compania-stocare-datelor-emc-pentru-67-miliarde-dolari.htm\">cea mai mare tranzactie</a> din istoria tehnologiei. &#8203;Dell a anuntat in octombrie ca a ajuns la un acord si va cumpara cu 67 miliarde dolari compania specializata in stocarea datelor EMC Corporation, parafand cea mai mare tranzactie realizata intre doua companii de tehnologie. Daca cele dpua parti vor obtine toate aprobarile, tranzactia va fi completata intre mai si octombrie 2016.<br><br>Michael Dell a cautat noi domenii in care sa-si extinda compania, dincolo de piata PC-urilor, care este in scadere. Marele pariu tine de stocarea si gestionarea datelor. EMC are afaceri anuale de 24 miliarde dolari si efectivele pe plan mondial sunt de 70.000 de angajati.<br><br><strong>Amenintarile informatice</strong><br><br>Anul a adus in prim plan si amenintari informatice neobisnuite si ingrijoratoare. De ani buni auzim despre atacuri informatice indreptate impotriva unor state sau corporatii, insa incet incet atacurile vor ajunge sa vizeze lucruri mult mai obisnuite, cum ar fi automobilele. In aceasta vara au fost cateva exemple care arata ca masinile sunt vulnerabile, Cel mai mediatizat a fost cazul unui Jeep la care doi specialisti de securitate informatica au preluat controlul de la cativa kilometri distanta, actionand si franele si directia, fara ca cel de la volan sa poata sa schimbe ceva. A fost un test si controlul masinii a fost preluat datorita unor vulnerabilitati in soft-ul sistemului de infotainment al masinii<br><br>Un alt episod a constat in interventia asupra une<a target=\"Alta pagina\" href=\"http://0-100.hotnews.ro/2015/08/06/doi-cercetatori-au-preluat-de-la-distanta-controlul-unei-masini-tesla-pe-care-au-reusit-sa-o-opreasca-din-mers/\">i masini Tesla</a> care a putut fi oprita din mers, insa doar la viteze foarte mici, de sub 10 km/h. Hackerii au avut mai intai acces in interiorul masinii, putand s-o infecteze cu malware, astfel ca episodul nu a fost considerat unul grav.<br><br>Cei doi cercetatori au trimis comenzi masinii de la distanta, de pe un iPhone, reusind sa deschida usile, portbagajul si sa faca astfel incat toate ecranele din bord sa se inchida. Deocamdata aceste atacuri nu reprezinta un pericol fiindca este infim numarul de masini ce pot fi astfel controlate, insa concluzia este ca industria auto mai are mult de lucru la securitatea informatica si nu va putea sa ofere servicii sigure fara a apela la companii si specialisti din securitate IT.<br><br>Un atac informatic sensibil prin efectele sale intime a fost anuntat in iulie si se refera la un site numit Ashley Madison care se adreseaza oamenilor casatoriti care isi cauta o relatie extra-conjugala. Datele a 33 de milioane de useri au ajuns pe mana hackerilor si milioane de utilizatori ai acestui site s-au temut ca sotul/sotia va afla despre relatiile gasite prin intermediul site-ului. Incidentul a declansat o uriasa polemica legata de moralitatea acestui site care incurajeaza useri sa-si insele partenerul de viata, fiindca viata oricum este scurta (n. r sloganul site-ului este Life is short, have an affair). Cei mai radicali au spus ca oamenii ale caror date au ajuns pe mana hackerilor nu sunt victime, ci isi meritau soarta.<br><br>Doua evenimente importante sunt legate de doua voturi in Parlamentul European, ambele avand legatura cu internetul si viitorul acestuia: unul este legat de <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20535642-votul-din-parlamentul-european-pune-neutralitatea-internetului-pericol-amendamentele-gandite-protejeze-fost-respinse-serie-portite-permit-existenta-internetului-doua-viteze.htm\">neutralitate</a>, iar altul, de o <a target=\"Alta pagina\" href=\"http://economie.hotnews.ro/stiri-it-20651840-prima-lege-comuna-securittate-cibernetica-nivelul-fost-agreata-dupa-negocieri-dure.htm\">strategie comuna</a> in fata amenintarilor informatice.<br><br><strong>Legi pentru viitorul internetului</strong><br><br>1. La final de octombrie Parlamentul European a votat legea ce obliga companiile care ofera acces la internet sa trateze tot traficul in mod egal, insa vestea rea este ca o serie de amendamente gandite sa elimine ambiguitatile din lege au fost respinse. Furnizorii au libertatea de a da prioritate anumitor tipuri de trafic si unele servicii vor fi clar avantajate in raport cu altele, ceea ce va dezavantaja companiile mici. Legea contine multe portite ce vor duce la crearea internetului \"cu doua viteze\" exact opusul ideii de neutralitate.<br><br>Legea a fost intens discutata in ultimii patru ani si existenta ei este considerata ca foarte buna. Supararea tine insa de faptul ca, in forma actuala, exista o serie de pasaje interpretabile care dau furnizorilor multa putere de a incetini anumite tipuri de trafic si de a permite viteze mai mari companiilor care platesc pentru asta. Cei mai vehementi spun chiar ca legea va da mana libera la abuzuri.<br><br>2. In decembrie, Parlamentul European, Consiliul UE si Comisia Europeana au cazut de acordul asupra primului pachet legislativ comun la nivelul Uniunii pe domeniul securitatii cibernetice, legile fiind prezentate ca un moment de referinta. Marile companii de tehnologie vor fi obligate sa raporteze autoritatilor nationale cand sistemele le-au fost atacate si pot fi sanctionate daca nu comunica. Nu au fost agreate toate detaliile, insa este un prim pas. Estimarile agentiei europene Enisa arata ca, din cauza breselor de securitate, pierderile anuale sunt intre 260 so 340 miliarde euro.<br><br>Acordul a fost parafat dupa cinci ore de negocieri intre Parlamentul European si reprezentantii tarilor UE, fiind un raspuns la amenintarile cibernetice care sunt, de la zi la zi, tot mai mari.',	NULL,	1,	NULL),
(5,	'Fără titlu? Nu cred...',	NULL,	NULL,	1,	NULL),
(6,	'Pas de place en crèche? Les nonnas et les nounous sont fidèles au poste',	'<div class=\"inner-module\">\r\n						Malgré les efforts entrepris ces 15 dernières années, l\'offre en crèche reste insuffisante. Que peuvent faire les parents si la famille proche ne répond pas à l\'appel? Etat des lieux en Suisse romande.\r\n					</div>\r\n<h3>Encore de nombreuses mères au foyer</h3>\r\n<p>Malgré les progrès constatés, seuls 18% des petits enfants sont pris en charge exclusivement dans des institutions (structures d\'accueil en milieu collectif ou familial). A contrario, 35% des petits bénéficient exclusivement d\'une garde non institutionnelle (famille proche ou particulier), et ceci pas forcément par choix. En effet, des centaines d\'entre eux sont sur la liste d\'attente d\'une structure subventionnée.</p>\r\n<p>En même temps, tous les parents ne souhaitent pas forcément confier leurs bambins à des tiers: 26% des moins de 4 ans sont gardés exclusivement par leurs parents (ce taux serait plus bas en Suisse romande, avec 21% dans le canton de Vaud par exemple).</p>',	NULL,	0,	NULL),
(7,	'\r\nQuatre Tremplins: Peter Prevc s\'envole à Innsbruck et au général, Ammann décevant\r\n',	'<div class=\"inner-module\">\r\n						Déjà vainqueur à Garmisch-Partenkirchen il y a deux jours, le Slovène Peter Prevc a remporté le concours d\'Innsbruck devant l\'Allemand Severin Freud. Prevc possède désormais 19.7 points d\'avance sur son dauphin du jour avant l\'ultime concours de Bischofshofen. Simon Ammann a dû, lui, se contenter d\'une décevante 22e place dans le Tyrol. \r\n					</div>',	NULL,	1,	NULL),
(8,	'Voile: Spindrift 2 ne battra pas le record du tour du monde sans escale',	'<p>La météo a tranché, entre un anticyclone des Açores campé en travers de la route et de violentes tempêtes à suivre avec une mer déchaînée les conditions qui règnent sur l’Atlantique sont particulièrement défavorables pour conclure dans les temps ce tour du monde. Dès aujourd\'hui, les marins de Spindrift 2 vont lever le pied et cesser de naviguer en mode record selon un communiqué du team. </p>',	NULL,	0,	NULL),
(9,	'Sport-Première',	'Le foot, le hockey, le ski, l’athlétisme et tous les autres sports ont rendez-vous dans Sport-Première.\r\n\r\nAu menu, beaucoup de direct des stades, mais aussi des interviews, des reportages et des commentaires pour mettre les compétitions en perspective.\r\n\r\nOn y parle également sport et argent, santé, modes et nouveautés.',	NULL,	0,	NULL),
(10,	'L\'homme qui a foncé sur des soldats inculpé pour tentative d\'homicide',	NULL,	NULL,	1,	NULL),
(11,	'Le juge d\'instruction s\'est déplacé à l\'hôpital pour la mise en examen (inculpation) car le forcené est toujours hospitalisé\", a déclaré à l\'AFP le procureur de Valence, Alex Perrin',	NULL,	NULL,	0,	NULL);

DROP TABLE IF EXISTS `sys_backend_usergroups`;
CREATE TABLE `sys_backend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Backend usergroup name',
  `access` text COLLATE utf8_unicode_ci COMMENT 'json group permissions',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the usergroup deleted?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_backend_usergroups` (`id`, `title`, `access`, `is_deleted`) VALUES
(1,	'Administrators',	NULL,	0),
(2,	'Dummy BE usergroup',	NULL,	0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_backend_users` (`id`, `username`, `password`, `is_deleted`, `is_active`, `usergroup_id`, `name`) VALUES
(1,	'admin',	'$2y$10$j09QNSDTp7YCJuFozNdOIu3lzp.9BaH1igFxhxoCmR/HQZ2WDaBFa',	0,	1,	1,	'Radu Mogoș'),
(2,	'demo',	'$2y$10$7Dv4d0PfHGILrPDJhaVZxeFbtcSjrR/d3rtrLKM2BxC4nQv6JLW8y',	0,	1,	2,	'Demo BE');

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


DROP TABLE IF EXISTS `sys_categories`;
CREATE TABLE `sys_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sorting` int(11) DEFAULT '0',
  `values` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sys_categories_relations`;
CREATE TABLE `sys_categories_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sys_configuration`;
CREATE TABLE `sys_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the domain to which this setting belongs to',
  `language_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the language to which it belongs',
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_configuration` (`id`, `domain_id`, `language_id`, `key`, `value`) VALUES
(1,	1,	0,	'System/Locale',	'ro_RO'),
(2,	1,	1,	'System/Shit',	'workin'),
(3,	1,	0,	'Session/Frontend/Duration',	'3600'),
(4,	1,	2,	'Session/Frontend/Duration',	'360'),
(5,	0,	0,	'Session/Frontend/Duration',	'86400');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_content` (`id`, `page_id`, `type`, `title`, `column_id`, `parent_id`, `value`, `reference_id`, `is_visible`, `is_deleted`, `created_at`, `modified_at`, `sorting`) VALUES
(1,	1,	'content',	'Fully Responsive',	4,	5,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"title\":\"Fully Responsive\",\"icon\":\"fa fa-desktop fa-3x\",\"link\":\"4\",\"content\":\"<p>Blablabla, hope it works.<br>Now, on to the second paragraph :)<br>\\u015ei acum s\\u0103 \\u00eencerc\\u0103m ni\\u015fte caractere scrise \\u00een limba rom\\u00e2n\\u0103 cu diacritice.<br>Se pare ca merge<br><\\/p>\"}}}',	NULL,	1,	0,	NULL,	1486725771,	1),
(2,	4,	'plugin',	'',	1,	0,	'{\"plugin\":{\"extension\":\"News\",\"identifier\":\"news\",\"controller\":\"Index\",\"template\":\"show\",\"action\":\"index\",\"data\":{\"limit\":\"12\",\"order\":\"created_at\"}}}',	NULL,	1,	0,	NULL,	NULL,	26),
(3,	1,	'container',	'Awesome title',	1,	0,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"title\":\"Awesome title\",\"formatColumns\":\"1\"}}}',	NULL,	1,	0,	NULL,	1486725864,	75),
(4,	1,	'content',	'公募プログラムガイドライン',	5,	3,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"title\":\"\\u516c\\u52df\\u30d7\\u30ed\\u30b0\\u30e9\\u30e0\\u30ac\\u30a4\\u30c9\\u30e9\\u30a4\\u30f3\",\"icon\":\"fa fa-pagelines fa-3x\",\"link\":\"4\",\"content\":\"<p>\\u306b\\u3064\\u3044\\u3066\\u4e8b\\u696d\\u3092\\u884c\\u3063\\u3066\\u3044\\u307e\\u3059\\u3002\\u3053\\u308c\\u3089\\u306e\\u5206\\u91ce\\u306b\\u306f\\u3001\\u305d\\u308c\\u305e\\u308c\\u516c\\u52df\\u30d7\\u30ed\\u30b0\\u30e9\\u30e0\\u304c\\u3042\\u308a\\u3001\\u56fd\\u969b\\u4ea4\\u6d41\\u4e8b\\u696d\\u3092\\u4f01\\u753b\\u3092\\u5b9f\\u65bd\\u3059\\u308b\\u500b\\u4eba\\u3084\\u56e3\\u4f53\\u306b\\u5bfe\\u3057\\u3066\\u3001\\u52a9\\u6210\\u91d1\\u3001\\u7814\\u7a76\\u5968\\u5b66\\u91d1\\uff08\\u30d5\\u30a7\\u30ed\\u30fc\\u30b7\\u30c3\\u30d7 \\u300c\\u306f\\u3058\\u3081\\u3066\\u7533\\u8acb\\u3055\\u308c\\u308b\\u65b9\\u3078\\u300d\\u3092\\u304a\\u8aad\\u307f\\u304f\\u3060\\u3055\\u3044\\u3002<\\/p>\"}}}',	NULL,	1,	0,	NULL,	1477341132,	2),
(5,	1,	'container',	'50% stanga, 50% dreapta',	4,	9,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"title\":\"50% stanga, 50% dreapta\",\"formatColumns\":\"6\"}}}',	NULL,	1,	0,	NULL,	1486773260,	4),
(6,	1,	'content',	'Lovely day',	6,	3,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"title\":\"Lovely day\",\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',	NULL,	1,	0,	NULL,	1475653364,	1),
(7,	1,	'container',	'4 elements',	1,	0,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"title\":\"4 elements\",\"formatColumns\":\"1\"}}}',	NULL,	1,	0,	NULL,	1486773279,	139),
(8,	2,	'plugin',	'A new star is born! ConținutCMS',	5,	17,	'{\"plugin\":{\"extension\":\"News\",\"template\":\"show\",\"controller\":\"Index\",\"identifier\":\"news\",\"action\":\"show\",\"data\":{\"title\":\"A new star is born! Con\\u021binutCMS\",\"limit\":\"3\",\"order\":\"title\",\"direction\":\"desc\",\"template\":\"Extensions\\/Local\\/News\\/Resources\\/Private\\/Frontend\\/Templates\\/Index\\/show.template.php\"}}}',	NULL,	1,	0,	NULL,	NULL,	21),
(9,	1,	'container',	'Container cu 1 coloană',	2,	0,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"1column\",\"data\":{\"title\":\"Container cu 1 coloan\\u0103\"}}}',	NULL,	1,	0,	NULL,	1479671529,	112),
(10,	1,	'content',	'2 elements follow now :)',	5,	5,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"2 elements follow now :)\",\"content\":\"Tiny bootstrap-compatible WISWYG rich text editor\\r\\n    <br>\\r\\n\\r\\n\\r\\n\\r\\n<br>\\r\\n\\r\\n\\r\\n\\r\\n  \\r\\n    \\r\\n    <ul class=\\\"numbers-summary\\\">\\r\\n      <li class=\\\"commits\\\">\\r\\n        <a href=\\\"\\/mindmup\\/bootstrap-wysiwyg\\/commits\\/master\\\">\\r\\n            \\r\\n            \\r\\n              67\\r\\n            \\r\\n            commits\\r\\n        <\\/a>\\r\\n      <\\/li>\\r\\n      <li>\\r\\n        <a href=\\\"\\/mindmup\\/bootstrap-wysiwyg\\/branches\\\">\\r\\n          \\r\\n          \\r\\n            2\\r\\n          \\r\\n          branches\\r\\n        <\\/a>\\r\\n      <\\/li>\\r\\n\\r\\n      <li>\\r\\n        <a href=\\\"\\/mindmup\\/bootstrap-wysiwyg\\/releases\\\">\\r\\n          \\r\\n          \\r\\n            0\\r\\n          \\r\\n          releases\\r\\n        <\\/a>\\r\\n      <\\/li>\\r\\n\\r\\n      <li>\\r\\n        \\r\\n  <a href=\\\"\\/mindmup\\/bootstrap-wysiwyg\\/graphs\\/contributors\\\">\\r\\n    \\r\\n    \\r\\n      8\\r\\n    \\r\\n    contributors\\r\\n  <\\/a>\\r\\n      <\\/li>\\r\\n    <\\/ul>\\r\\n\\r\\n      \\r\\n        <ol class=\\\"repository-lang-stats-numbers\\\">\\r\\n          <li>\\r\\n              <a href=\\\"\\/mindmup\\/bootstrap-wysiwyg\\/search?l=javascript\\\">\\r\\n                \\r\\n                JavaScript\\r\\n                99.3%\\r\\n              <\\/a>\\r\\n          <\\/li>\\r\\n        <\\/ol>\\r\\n      <br>\\r\\n    <br>\\r\\n  <br>\\r\\n\\r\\n<br>\"}}}',	NULL,	1,	0,	NULL,	1475438872,	1),
(11,	1,	'content',	'Lorem ipsum but let\'s not forget that this text might span on multiple lines',	7,	3,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"title\":\"Lorem ipsum but let\'s not forget that this text might span on multiple lines\",\"icon\":\"fa fa-edit fa-3x\",\"link\":\"3\",\"content\":\"<p>Lorem ipsum <strong>dolor sit amec<\\/strong> and all the rest of the latin phrases used for text formating should just follow along.<br>Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.<\\/p>\"}}}',	NULL,	1,	0,	NULL,	1477425573,	1),
(12,	1,	'content',	'Moderna',	4,	9,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"CallAction\",\"data\":{\"title\":\"Moderna\",\"subheader\":\"A starting theme for Continut CMS\"}}}',	NULL,	1,	0,	NULL,	1475432339,	3),
(13,	2,	'container',	'Container 4 coloane, care si merge :)',	4,	28,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"title\":\"Container 4 coloane, care si merge :)\",\"formatColumns\":\"1\"}}}',	NULL,	1,	0,	NULL,	NULL,	5),
(14,	2,	'content',	'',	7,	13,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading<u><\\/u> style<u><\\/u><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6><br>\"}}}',	NULL,	1,	1,	NULL,	NULL,	2),
(15,	2,	'content',	NULL,	4,	35,	'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<table><tr><td>Cell1</td><td> Cell 2</td></tr></table><h4>Example of paragraph</h4><p><strong>Lorem ipsum dolor sit amet</strong>, consetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p><p class=\\\"lead\\\">At vero eos et accusam et justo duo dolores et eabum.</p><p><em>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </em>\\n\\t\\t\\t\\t</p>\\n\\t\\t\\t\\t<p>\\n\\t\\t\\t\\t\\t<small>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </small></p>\\t\\t\\t\"\r\n    }\r\n  }\r\n}',	NULL,	1,	1,	NULL,	NULL,	5),
(16,	2,	'content',	'Separator de linie',	4,	31,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"SolidLine\",\"data\":{\"lineType\":\"solid\"}}}',	NULL,	1,	1,	NULL,	NULL,	7),
(17,	2,	'container',	'Ultimele știri',	4,	28,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"title\":\"Ultimele \\u0219tiri\",\"formatColumns\":\"6\"}}}',	NULL,	1,	0,	NULL,	NULL,	6),
(18,	2,	'reference',	NULL,	5,	17,	NULL,	6,	1,	1,	NULL,	NULL,	20),
(19,	2,	'reference',	NULL,	4,	28,	NULL,	5,	1,	1,	NULL,	NULL,	1),
(20,	1,	'content',	'Ha, now has a title',	7,	7,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Ha, now has a title\",\"content\":\"<h4>H1-H6 Heading style (modified in parent)<br><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6>\"}}}',	NULL,	1,	0,	NULL,	1475438937,	1),
(21,	1,	'content',	NULL,	6,	13,	'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<h4>H1-H6 Heading style</h4><h1>Heading H1</h1><h2>HeadingH2</h2><h3>Heading H3</h3><h4>Heading H4</h4><h5>Heading H5</h5><h6>Heading H6</h6>\"\r\n    }\r\n  }\r\n}',	NULL,	1,	0,	NULL,	NULL,	1),
(22,	17,	'content',	'Showing off from another domain :) Sweeeet',	1,	0,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',	NULL,	1,	1,	NULL,	1478508028,	133),
(23,	19,	'content',	'',	1,	0,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"title\":\"\",\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',	NULL,	1,	0,	NULL,	NULL,	14),
(28,	2,	'container',	'Features section',	1,	0,	'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"features\",\"type\":\"container\",\"template\":\"features\",\"data\":[]}}',	NULL,	1,	0,	NULL,	NULL,	14),
(31,	2,	'container',	'About section',	1,	0,	'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"about\",\"type\":\"container\",\"template\":\"about\",\"data\":{\"title\":\"About section\"}}}',	NULL,	1,	0,	NULL,	1478503254,	13),
(32,	2,	'content',	NULL,	4,	28,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"featureImage\",\"type\":\"content\",\"template\":\"FeatureImage\",\"data\":{\"image\":\"\\/Media\\/home_01.png\",\"width\":\"800\",\"height\":\"\"}}}',	NULL,	1,	0,	NULL,	NULL,	7),
(33,	2,	'content',	'Despre noi',	4,	28,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"heading\",\"type\":\"content\",\"template\":\"Heading\",\"data\":{\"title\":\"Despre noi\",\"subtitle\":\"Afla\\u021bi de ce compania noastr\\u0103 este cea mai grozav\\u0103\"}}}',	NULL,	1,	0,	NULL,	NULL,	2),
(34,	2,	'content',	'Prezentare soluții modificate',	4,	31,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"heading\",\"type\":\"content\",\"template\":\"Heading\",\"data\":{\"title\":\"Prezentare solu\\u021bii modificate\",\"subtitle\":\"Ce solu\\u021bii oferim. Care sunt pre\\u021burile \\u0219i avantajele de a ne alege pe noi\"}}}',	NULL,	1,	0,	NULL,	1475431330,	8),
(35,	2,	'container',	'Exemplu paralax',	1,	0,	'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"parallax\",\"type\":\"container\",\"template\":\"parallax\",\"data\":{\"title\":\"Exemplu paralax\",\"image\":\"\\/Media\\/wallpaper.jpg\"}}}',	NULL,	1,	0,	NULL,	NULL,	131),
(36,	2,	'content',	'Design responsiv',	6,	13,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Design responsiv\",\"icon\":\"fa-tablet\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1476563749,	2),
(37,	2,	'content',	'Trăsături excelente',	4,	13,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Tr\\u0103s\\u0103turi excelente\",\"icon\":\"fa-bars\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475434008,	1),
(38,	2,	'content',	'Simplu & ușor',	5,	13,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Simplu & u\\u0219or\",\"icon\":\"fa-folder\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475434021,	1),
(39,	2,	'content',	'Efecte paralax',	7,	13,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Efecte paralax\",\"icon\":\"fa-gear\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475433879,	3),
(40,	2,	'content',	'122',	4,	42,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"counter\",\"type\":\"content\",\"template\":\"Counter\",\"data\":{\"title\":\"122\",\"icon\":\"fa-user\",\"align\":\"text-center\",\"subtitle\":\"Clien\\u021bi mul\\u021bumi\\u021bi\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(41,	2,	'content',	'4226',	5,	42,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"counter\",\"type\":\"content\",\"template\":\"Counter\",\"data\":{\"title\":\"4226\",\"icon\":\"fa-coffee\",\"align\":\"text-center\",\"subtitle\":\"Cafele comandate\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(42,	2,	'container',	'Counter',	4,	35,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"identifier\":\"4columns\",\"type\":\"container\",\"template\":\"4columns\",\"data\":{\"title\":\"Counter\",\"formatColumns\":\"1\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(43,	2,	'content',	'14',	6,	42,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"counter\",\"type\":\"content\",\"template\":\"Counter\",\"data\":{\"title\":\"14\",\"icon\":\"fa-trophy\",\"align\":\"text-center\",\"subtitle\":\"Premii c\\u00e2\\u0219tigate\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(44,	2,	'content',	'232',	7,	42,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"counter\",\"type\":\"content\",\"template\":\"Counter\",\"data\":{\"title\":\"232\",\"icon\":\"fa-camera\",\"align\":\"text-center\",\"subtitle\":\"Poze f\\u0103cute\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(45,	2,	'container',	'Secțiunea servicii',	1,	0,	'{\"container\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"about\",\"type\":\"container\",\"template\":\"about\",\"data\":{\"title\":\"Sec\\u021biunea servicii\"}}}',	NULL,	1,	0,	NULL,	NULL,	132),
(46,	2,	'content',	'Servicii oferite',	4,	45,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"heading\",\"type\":\"content\",\"template\":\"Heading\",\"data\":{\"title\":\"Servicii oferite\",\"subtitle\":\"Lista complet\\u0103 a serviciilor pe care le oferim clien\\u021bilor no\\u0219tri\"}}}',	NULL,	1,	0,	NULL,	1475433298,	2),
(47,	2,	'container',	'',	4,	45,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"identifier\":\"3columns\",\"type\":\"container\",\"template\":\"3columns\",\"data\":{\"title\":\"\"}}}',	NULL,	1,	0,	NULL,	NULL,	3),
(48,	2,	'content',	'Design & programare',	4,	47,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Design & programare\",\"icon\":\"fa-lightbulb-o\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(49,	2,	'content',	'Producție video',	5,	47,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Produc\\u021bie video\",\"icon\":\"fa-tablet\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475431487,	1),
(50,	2,	'content',	'Suport 24/7',	6,	47,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Suport 24\\/7\",\"icon\":\"fa-gear\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(51,	2,	'container',	'',	4,	45,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"identifier\":\"3columns\",\"type\":\"container\",\"template\":\"3columns\",\"data\":{\"title\":\"\"}}}',	NULL,	1,	0,	NULL,	NULL,	4),
(52,	2,	'content',	'Aplicații mobile',	5,	51,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Aplica\\u021bii mobile\",\"icon\":\"fa-tablet\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475431353,	1),
(53,	2,	'content',	'Comerț electronic',	6,	51,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Comer\\u021b electronic\",\"icon\":\"fa-tablet\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475431364,	1),
(54,	2,	'content',	'Social media',	4,	51,	'{\"content\":{\"extension\":\"ThemeAtlas\",\"identifier\":\"aboutBox\",\"type\":\"content\",\"template\":\"AboutBox\",\"data\":{\"title\":\"Social media\",\"icon\":\"fa-tablet\",\"align\":\"text-center\",\"subtitle\":\"Quisque est enim lacinia lobortis da viverra interdum, quam. In sagittis, eros faucibus ullamcorper nibh dolor\"}}}',	NULL,	1,	0,	NULL,	1475431361,	1),
(55,	17,	'container',	'2 colums test',	1,	0,	'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"identifier\":\"2columns\",\"type\":\"container\",\"template\":\"2columns\",\"data\":{\"title\":\"2 colums test\",\"formatColumns\":\"6\"}}}',	NULL,	1,	1,	NULL,	NULL,	6),
(56,	17,	'content',	'I am a simple box',	4,	55,	'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"identifier\":\"box\",\"type\":\"content\",\"template\":\"Box\",\"data\":{\"title\":\"I am a simple box\",\"icon\":\"fa fa-edit fa-3x\",\"link\":\"link goes here\",\"content\":\"I see another simple box, <b>I upvote<\\/b>!\"}}}',	NULL,	1,	1,	NULL,	1478508692,	1),
(57,	40,	'content',	'A new star is born! ConținutCMS',	1,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"jumbotron\",\"type\":\"content\",\"template\":\"jumbotron\",\"data\":{\"title\":\"A new star is born! Con\\u021binutCMS\",\"class\":\"\",\"content\":\"<!--StartFragment-->Responsive all the way, from the Back to the Front. Edit your content on any device or browser* and preview your content right in the Admin interface. Backend and Frontend developers alike will love it, as templates are easily integrated.\\r\\n<br>* - except IE, we really hate it so you use it at your own risk<br> \\r\\n<p class=\\\"links\\\"><a href=\\\"#\\\" class=\\\"btn btn-info\\\">Download<\\/a><a href=\\\"#\\\" class=\\\"btn btn-default\\\">Getting started<\\/a><\\/p><!--EndFragment-->\"}}}',	NULL,	1,	0,	NULL,	1479060494,	2),
(58,	40,	'content',	'A new star is born! ConținutCMS',	4,	57,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"A new star is born! Con\\u021binutCMS\",\"content\":\"Responsive all the way, from the Back to the Front. Edit your content on any device or browser* and preview your content right in the Admin interface. Backend and Frontend developers alike will love it, as templates are easily integrated.\\r\\n<br>* - except IE, we really hate it so you use it at your own risk<br> \\r\\n<p class=\\\"links\\\"><a href=\\\"#\\\" class=\\\"btn btn-info\\\">Download<\\/a><a href=\\\"#\\\" class=\\\"btn btn-default\\\">Getting started<\\/a><\\/p>\"}}}',	NULL,	1,	0,	NULL,	1479061565,	1),
(59,	17,	'content',	'Features',	1,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"jumbotron\",\"type\":\"content\",\"template\":\"jumbotron\",\"data\":{\"title\":\"Features\",\"class\":\"content\",\"content\":\"<p>These features are all part of the Con\\u021binut CMS Core. Additional functionality can be added by <a>installing extensions.<\\/a><\\/p>\\r\\n<hr>\\r\\n<h3 id=\\\"responsive_backend\\\">Responsive Backend and Frontend<\\/h3>\\r\\n<p>It\'s easy to integrate your responsive theme inside Con\\u021binut CMS and you will soon fell in love with how fast a process it is opossed to other existing CMSes.\\r\\n          The Backend is equally responsive, down to the mobile level so that you can easily edit or add content even while on the road.<\\/p>\"}}}',	NULL,	1,	0,	NULL,	1485472291,	136),
(60,	17,	'content',	'Features',	4,	59,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Features\",\"content\":\"\"}}}',	NULL,	1,	0,	NULL,	1479055816,	1),
(61,	17,	'content',	'Core features',	4,	62,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Core features\",\"content\":\"<p>These features are all part of the Con\\u021binut CMS Core. Additional functionality can be added by <a>installing extensions.<\\/a><\\/p>\\r\\n<hr>\\r\\n<h3 id=\\\"responsive_backend\\\">Responsive Backend and Frontend<\\/h3>\\r\\n<p>It\'s easy to integrate your responsive theme inside Con\\u021binut CMS and you will soon fell in love with how fast a process it is opossed to other existing CMSes.\\r\\n          The Backend is equally responsive, down to the mobile level so that you can easily edit or add content even while on the road.<\\/p>\"}}}',	NULL,	1,	0,	NULL,	1485472266,	4),
(62,	17,	'container',	'',	1,	0,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"2columns\",\"type\":\"container\",\"template\":\"2columns\",\"data\":{\"title\":\"\",\"formatColumns\":\"3\"}}}',	NULL,	1,	0,	NULL,	1485472235,	138),
(63,	40,	'container',	'Child of the main jumbotron',	1,	0,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"jumbotron\",\"type\":\"container\",\"template\":\"jumbotron\",\"data\":{\"title\":\"Child of the main jumbotron\"}}}',	NULL,	1,	1,	NULL,	NULL,	3),
(69,	40,	'container',	'subchild',	1,	0,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"jumbotron\",\"type\":\"container\",\"template\":\"jumbotron\",\"data\":{\"title\":\"subchild\"}}}',	NULL,	1,	1,	NULL,	1479060478,	5),
(70,	18,	'container',	'2 columns',	0,	0,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"2columns\",\"type\":\"container\",\"template\":\"2columns\",\"data\":{\"title\":\"2 columns\",\"formatColumns\":\"3\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(71,	40,	'content',	'After or inside?',	4,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"After or inside?\",\"content\":\"Trick question...\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(72,	40,	'content',	'Let\'s try one more time',	4,	63,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Let\'s try one more time\",\"content\":\"Where am I now?\"}}}',	NULL,	1,	0,	NULL,	1479060480,	1),
(73,	17,	'content',	'Johnny Cash - The best',	5,	62,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"video\",\"type\":\"content\",\"template\":\"Video\",\"data\":{\"title\":\"Johnny Cash - The best\",\"video\":\"https:\\/\\/www.youtube.com\\/embed\\/4ScCZQN53s8?rel=0&controls=0\"}}}',	NULL,	1,	0,	NULL,	1486916466,	1),
(74,	18,	'content',	'Documentation',	1,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"jumbotron\",\"type\":\"content\",\"template\":\"jumbotron\",\"data\":{\"title\":\"Documentation\",\"class\":\"content\"}}}',	NULL,	1,	0,	NULL,	NULL,	1),
(75,	18,	'content',	'Documentation',	4,	74,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Documentation\",\"content\":\"Feel free to browse the Con\\u021binut CMS documentation\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(78,	36,	'content',	'Blabla content, not inside a container',	4,	80,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Blabla content, not inside a container\",\"content\":\"Look at me Ma\', I\'m outside a container.\"}}}',	NULL,	1,	0,	NULL,	1479590880,	1),
(79,	36,	'container',	'Half splitted',	0,	78,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"2columns\",\"type\":\"container\",\"template\":\"2columns\",\"data\":{\"title\":\"Half splitted\",\"formatColumns\":\"6\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(80,	36,	'container',	'50/50',	1,	0,	'{\"container\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"2columns\",\"type\":\"container\",\"template\":\"2columns\",\"data\":{\"title\":\"50\\/50\",\"formatColumns\":\"6\"}}}',	NULL,	1,	0,	NULL,	1479591187,	134),
(81,	36,	'content',	'Wadda ya know',	5,	80,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Wadda ya know\",\"content\":\"You <b>CAN <\\/b>create multiple columns...<br>Neat, right?<br><ul><li>Do this<br><\\/li><li>Then do that<br><\\/li><li>And let\'s finish with this<br><\\/li><\\/ul>\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(82,	13,	'content',	'Test sample',	1,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"Test sample\",\"content\":\"Test\"}}}',	NULL,	1,	0,	NULL,	NULL,	0),
(83,	13,	'content',	'After or before?',	1,	0,	'{\"content\":{\"extension\":\"ThemeContinutOrg\",\"identifier\":\"textWithImage\",\"type\":\"content\",\"template\":\"TextWithImage\",\"data\":{\"title\":\"After or before?\",\"content\":\"The test one\"}}}',	NULL,	1,	0,	NULL,	NULL,	0);

DROP TABLE IF EXISTS `sys_domains`;
CREATE TABLE `sys_domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url used by default by the domain',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the domain active?',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting order of the domains',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_domains` (`id`, `title`, `url`, `is_visible`, `sorting`) VALUES
(1,	'Test Website',	'fim-live.com',	1,	0),
(2,	'Federation de la Haute Horlogerie',	'd2.test',	1,	1),
(3,	'Continut.org Main',	'continut.org',	1,	2),
(4,	'dafuq man',	NULL,	0,	NULL);

DROP TABLE IF EXISTS `sys_domain_urls`;
CREATE TABLE `sys_domain_urls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_id` int(11) DEFAULT NULL COMMENT 'parent domain url, if an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Language/Url code, used in the frontend',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  `domain_id` int(10) unsigned NOT NULL COMMENT 'uid of main domain',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'iso2 code for the flag',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title to be displayed in the frontend/backend',
  `sorting` int(10) unsigned NOT NULL COMMENT 'backend sorting order',
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'language locale',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_domain_urls` (`id`, `parent_id`, `url`, `code`, `is_alias`, `domain_id`, `flag`, `title`, `sorting`, `locale`) VALUES
(1,	NULL,	'cms.dev',	'ro',	0,	1,	'ro',	'Română',	0,	'ro_RO'),
(2,	NULL,	'fim-live.fr',	'fr',	0,	1,	'fr',	'Français',	1,	'fr_FR'),
(3,	NULL,	'continut.dev',	'ro',	0,	3,	'ro',	'Limba română',	0,	'ro_RO'),
(4,	NULL,	'danish.test',	'dn',	0,	3,	'da',	'Français SAVED',	5,	'fr_FR'),
(5,	1,	'cms.dev',	'fr',	0,	3,	'fr',	'Test alias 1',	5,	'fr_FR'),
(6,	1,	'www.oldcms.tr',	'',	0,	3,	'tr',	'Another alias',	5,	'tr_TR');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_files` (`id`, `filename`, `filesize`, `location`, `mime`, `created_at`, `modified_at`, `mount_id`) VALUES
(1,	'peles.jpg',	796745,	'Media/',	'image/jpeg',	NULL,	NULL,	1),
(2,	'peles2.jpg',	19859,	'Media/',	'image/jpeg',	NULL,	NULL,	1),
(3,	'peles3.jpg',	2295217,	'Media/',	'image/jpeg',	NULL,	NULL,	1),
(4,	'22550733821_1f2d0fb037_k.jpg',	78911,	'Media/',	'image/jpeg',	NULL,	NULL,	1),
(5,	'21982600108_7718cf5e9a_k.jpg',	3103874,	'Media/',	'image/jpeg',	NULL,	NULL,	1),
(6,	'dakar.png',	NULL,	'Media/',	'image/png',	NULL,	NULL,	1),
(7,	'18412293562_8aff02059f_k.jpg',	NULL,	'Media/',	'image/png',	NULL,	NULL,	1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_file_mounts` (`id`, `title`, `folder`, `type`, `username`, `password`, `url`) VALUES
(1,	'Main local mount',	'/',	'file',	NULL,	NULL,	NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_file_references` (`id`, `file_id`, `foreign_id`, `is_visible`, `is_deleted`, `tablename`, `title`, `alt`, `description`) VALUES
(1,	1,	5,	1,	0,	'ext_news',	'Additional title',	NULL,	'And blabla description'),
(2,	2,	7,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(3,	5,	5,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(4,	4,	4,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(5,	1,	3,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(6,	5,	2,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(7,	6,	1,	1,	0,	'ext_news',	NULL,	NULL,	NULL),
(8,	7,	6,	1,	0,	'ext_news',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `sys_frontend_usergroups`;
CREATE TABLE `sys_frontend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_frontend_usergroups` (`id`, `title`, `access`, `is_deleted`) VALUES
(1,	'Test FE usergroup',	NULL,	0);

DROP TABLE IF EXISTS `sys_frontend_users`;
CREATE TABLE `sys_frontend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  `is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_frontend_users` (`id`, `username`, `password`, `usergroup_id`, `is_deleted`, `is_active`) VALUES
(1,	'ramo',	'pass311',	1,	0,	1);

DROP TABLE IF EXISTS `sys_languages`;
CREATE TABLE `sys_languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `domain_id` int(11) unsigned NOT NULL COMMENT 'the domain this language belongs to',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code of the language',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title shown in the dropdowns',
  `sorting` int(11) unsigned DEFAULT NULL COMMENT 'display order of languages',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'country flag to use in the backend',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_languages` (`id`, `domain_id`, `language_iso3`, `title`, `sorting`, `flag`) VALUES
(1,	1,	'rou',	'Română',	0,	'ro'),
(2,	1,	'fra',	'Français',	1,	'fr'),
(3,	2,	'rou',	'Română',	0,	'ro'),
(4,	2,	'eng',	'English',	1,	'gb'),
(5,	3,	'eng',	'English',	0,	'gb');

DROP TABLE IF EXISTS `sys_notifications`;
CREATE TABLE `sys_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Notification id',
  `message` text NOT NULL COMMENT 'Message text',
  `data` text NOT NULL COMMENT 'Serialized data for the message',
  `link` varchar(255) NOT NULL COMMENT 'Link to a detalied page',
  `user` int(11) unsigned NOT NULL COMMENT 'For which user is this notification? 0 means all',
  `created_at` int(11) unsigned NOT NULL COMMENT 'When was the notification created?',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Has the message been read?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sys_notifications` (`id`, `message`, `data`, `link`, `user`, `created_at`, `is_read`) VALUES
(1,	'backend.notifications.newPage',	'{\"user\":\"Black jack\",\"title\":\"Crazy page\"}',	'',	1,	1486770767,	0);

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
  `is_layout_recursive` tinyint(1) DEFAULT '0' COMMENT 'will this layout be inherited by any subpage created inside it',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_pages` (`id`, `parent_id`, `title`, `language_iso3`, `original_id`, `is_in_menu`, `is_visible`, `is_deleted`, `domain_url_id`, `layout`, `is_layout_recursive`, `frontend_layout`, `backend_layout`, `cached_path`, `sorting`, `slug`, `meta_keywords`, `meta_description`, `start_date`, `end_date`) VALUES
(1,	4,	'Comics HAC!BD remodif',	'rou',	0,	1,	1,	0,	1,	'ThemeBootstrapModerna.homepage',	1,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',	'',	1,	'comics-hac-bd',	'comics,hac,benzi desenate,revista hac',	'Meta descrierea paginii vine aici.\r\nBlablabla',	'2015-12-30 18:00:00',	'0000-00-00 00:00:00'),
(2,	12,	'Revista HAC!',	'rou',	0,	1,	1,	0,	1,	'ThemeAtlas.default',	0,	'/Extensions/Local/ThemeAtlas/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeAtlas/Resources/Private/Backend/Layouts/Default.layout.php',	'1',	2,	'revista-hac',	'meta keywords for this page',	'test meta description',	'1899-11-30 00:00:00',	'2020-11-30 00:00:00'),
(3,	16,	'Albume HAC!BD',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'1',	0,	'albumele-hac',	NULL,	NULL,	NULL,	NULL),
(4,	0,	'Abonamente HAC!BD',	'rou',	0,	1,	1,	0,	1,	'ThemeBootstrapModerna.homepage',	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',	'1',	0,	'abonamente-hacbd',	'',	'vrei sa scrii ceva\r\nnu poti. sau poate ca poti\r\n\r\nincredibil...',	NULL,	NULL),
(5,	0,	'Alt BD',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'12,4,1',	2,	'alt-bd',	NULL,	NULL,	NULL,	NULL),
(6,	5,	'The Walking Dead RO',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'5',	2,	'the-walking-dead-ro',	NULL,	NULL,	NULL,	NULL),
(7,	5,	'Albume BD',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'5',	3,	'albume-bd',	NULL,	NULL,	NULL,	NULL),
(8,	12,	'Indie Comics',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'5',	1,	'indie-comics',	NULL,	NULL,	NULL,	NULL),
(9,	14,	'Haine 2',	'rou',	0,	1,	0,	0,	1,	'',	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'',	0,	'haine',	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(10,	9,	'Tricouri Fete',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'9',	62,	'tricouri-fete',	NULL,	NULL,	NULL,	NULL),
(11,	9,	'Tricouri Băieţi',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'9',	63,	'tricouri-baieti',	NULL,	NULL,	NULL,	NULL),
(12,	4,	'De-ale capului',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'4,1',	4,	'de-ale-capului',	NULL,	NULL,	NULL,	NULL),
(13,	12,	'Postere',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'',	0,	'postere',	NULL,	NULL,	NULL,	NULL),
(14,	13,	'Postere HAC!BD',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'13',	56,	'postere-hacbd',	NULL,	NULL,	NULL,	NULL),
(15,	0,	'Cărți',	'rou',	0,	1,	1,	0,	1,	'',	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'',	1,	'carti',	'',	'',	'2016-11-19 17:19:10',	'2016-11-19 17:19:10'),
(16,	5,	'Altele',	'rou',	0,	1,	1,	0,	1,	NULL,	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'',	0,	'altele',	NULL,	NULL,	NULL,	NULL),
(17,	34,	'Features',	'rou',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	'',	1,	'features',	'',	'',	'2016-11-06 09:33:00',	'2016-11-07 08:33:30'),
(18,	34,	'Documentation',	'rou',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	'17',	0,	'documentation',	'',	'',	'2016-11-07 08:35:53',	'2016-11-07 08:35:53'),
(19,	0,	'Les comics HAC!BD',	'',	1,	1,	1,	0,	2,	'ThemeBootstrapModerna.default',	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	'',	0,	'comicshacfr',	'comics,francais stuff',	'description de la page française',	'2016-11-19 19:55:20',	'2016-11-19 19:55:20'),
(24,	20,	'subpage1',	'rou',	0,	1,	1,	0,	0,	NULL,	0,	NULL,	NULL,	NULL,	0,	'subpage1',	NULL,	NULL,	NULL,	NULL),
(25,	20,	'subpage2',	'rou',	0,	1,	1,	0,	0,	NULL,	0,	NULL,	NULL,	NULL,	0,	'subpage2',	NULL,	NULL,	NULL,	NULL),
(26,	28,	'root1',	'rou',	0,	1,	1,	0,	1,	'ThemeBootstrapModerna.homepage',	0,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',	NULL,	1,	'root1',	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(27,	28,	'root2',	'rou',	0,	1,	1,	0,	1,	'ThemeBootstrap.default',	0,	'/Extensions/Local/ThemeBootstrap/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrap/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	0,	'root2',	'',	'',	'2017-02-10 23:28:02',	'2017-02-10 23:28:02'),
(28,	13,	'root3',	'rou',	0,	1,	0,	0,	1,	'ThemeBootstrapModerna.default',	1,	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	55,	'root3',	'root, test page',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(29,	26,	'subroot1 has changed it\'s title',	'rou',	0,	1,	1,	0,	1,	'',	1,	NULL,	NULL,	NULL,	0,	'subroot1',	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(34,	0,	'Left menu',	'',	0,	0,	0,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	1,	'Left menu',	NULL,	NULL,	NULL,	NULL),
(35,	0,	'Right menu',	'',	0,	0,	0,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	0,	'Right menu',	NULL,	NULL,	NULL,	NULL),
(36,	34,	'Download',	'',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	2,	'download',	'',	'',	'2016-11-19 21:29:32',	'2016-11-19 21:29:32'),
(37,	35,	'Extensions',	'',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	1,	'Extensions',	NULL,	NULL,	NULL,	NULL),
(38,	35,	'Themes',	'',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	0,	'Themes',	NULL,	NULL,	NULL,	NULL),
(39,	35,	'Developer Central',	'',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	2,	'Developer Central',	NULL,	NULL,	NULL,	NULL),
(40,	0,	'Homepage',	'',	0,	1,	1,	0,	3,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	2,	'Homepage',	'',	'',	'2016-11-13 16:20:58',	'2016-11-13 16:20:58'),
(41,	0,	'p1',	'',	0,	1,	1,	0,	4,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	17,	'p1',	NULL,	NULL,	NULL,	NULL),
(42,	0,	'p2',	'',	0,	1,	1,	0,	4,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	17,	'p2',	NULL,	NULL,	NULL,	NULL),
(43,	0,	'p3',	'',	0,	1,	1,	0,	4,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	17,	'p3',	NULL,	NULL,	NULL,	NULL),
(44,	0,	'p4',	'',	0,	1,	1,	0,	4,	'ThemeContinutOrg.default',	0,	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Frontend/Layouts/Default.layout.php',	'/Extensions/Local/ThemeContinutOrg/Resources/Private/Backend/Layouts/Default.layout.php',	NULL,	18,	'p4',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `sys_registry`;
CREATE TABLE `sys_registry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT '0',
  `domain_url_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_registry` (`id`, `key`, `value`, `domain_id`, `domain_url_id`) VALUES
(1,	'System/Locale',	'ro_RO',	0,	0),
(2,	'Settings/Session/FeuserExpire',	'360',	0,	0),
(3,	'Settings/Session/BeuserExpire',	'260',	0,	0);

DROP TABLE IF EXISTS `sys_routes`;
CREATE TABLE `sys_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'path name, used when creating urls',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'actual path mapping',
  `data` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'defaults and requirements, serialized',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_routes` (`id`, `name`, `path`, `data`) VALUES
(1,	'page_id',	'/{language}/{id}',	'a:2:{s:8:\"defaults\";a:5:{s:10:\"_extension\";s:8:\"Frontend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:5:\"index\";s:8:\"language\";s:2:\"ro\";s:2:\"id\";i:0;}s:12:\"requirements\";a:2:{s:2:\"id\";s:3:\"\\d+\";s:8:\"language\";s:8:\"ro|en|fr\";}}'),
(2,	'page_slug',	'/{language}/{slug}',	'a:2:{s:8:\"defaults\";a:5:{s:10:\"_extension\";s:8:\"Frontend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:5:\"index\";s:8:\"language\";s:2:\"ro\";s:2:\"id\";i:0;}s:12:\"requirements\";a:1:{s:8:\"language\";s:8:\"ro|en|fr\";}}'),
(3,	'admin',	'/unused',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:7:\"Backend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:9:\"dashboard\";}}'),
(4,	'news_backend',	'/admin/news/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:4:\"News\";s:11:\"_controller\";s:11:\"NewsBackend\";s:7:\"_action\";s:5:\"index\";}}'),
(5,	'editor',	'/editor/{_controller}/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:6:\"Editor\";s:11:\"_controller\";s:6:\"Editor\";s:7:\"_action\";s:5:\"index\";}}'),
(6,	'admin_backend',	'/admin/{_controller}/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:7:\"Backend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:9:\"dashboard\";}}');

DROP TABLE IF EXISTS `sys_user_sessions`;
CREATE TABLE `sys_user_sessions` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique php session id',
  `session_data` text COLLATE utf8_unicode_ci COMMENT 'session data',
  `session_expires` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of user, BackendUser or FrontendUser',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_user_sessions` (`session_id`, `session_data`, `session_expires`, `user_id`, `user_type`) VALUES
('5cadeb2c812e42275f4214633a34ff9f',	'PHPDEBUGBAR_STACK_DATA|a:0:{}',	1486922681,	NULL,	NULL),
('8d7ff992486ab47e01ef98a25fe9124e',	'user_id|s:1:\"1\";current_domain|s:1:\"3\";current_language|s:1:\"3\";configurationSite|s:5:\"url_2\";PHPDEBUGBAR_STACK_DATA|a:0:{}',	1486922811,	NULL,	NULL),
('d46e0c7ed432e16dd2339f085e85d67b',	'PHPDEBUGBAR_STACK_DATA|a:0:{}',	1486922800,	NULL,	NULL);

-- 2017-02-12 17:08:11
