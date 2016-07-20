drop database if exists pov;
create database pov character set utf8;
use pov;

create table titule(
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
opis mediumtext
)engine=innodb;

create table osobe(
sifra int not null primary key auto_increment,
ime varchar(50) not null,
prezime varchar(50) not null,
titula int not null, 
godinarodjenja int,
godinasmrti int,
opis text,
slika varchar(255)
)engine=innodb;

create table strane(
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
brojvojnika int
)engine=innodb;

create table zemlje(
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
vladar int not null
)engine=innodb;


create table ucestvuju(
zemlja int not null,
strana int not null
)engine=innodb;

create table ratovi(
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
stoljece int not null,
gpocetak int,
gkraj int,
stranaa int,
stranab int,
pobjednik varchar(50),
opis text
)engine=innodb;


create table operater(
sifra int not null primary key auto_increment,
korisnik varchar(50) not null,
lozinka char(32) not null,
ime varchar(50),
prezime varchar(50)
)engine=innodb;


alter table osobe add foreign key (titula) references titule(sifra);

alter table zemlje add foreign key (vladar) references osobe(sifra);

alter table ucestvuju add foreign key (zemlja) references zemlje(sifra);
alter table ucestvuju add foreign key (strana) references strane(sifra);

alter table ratovi add foreign key (stranaa) references strane(sifra);
alter table ratovi add foreign key (stranab) references strane(sifra);



#insert u operateri
insert into operater (korisnik,lozinka,ime,prezime) 
values ('ddordevic',md5('ddd'),'Đorđe','Đorđević');
insert into operater (korisnik,lozinka,ime,prezime) 
values ('kmaric',md5('kkk'),'Karlo','Marić');
insert into operater (korisnik,lozinka,ime,prezime) 
values ('dmesic',md5('mmm'),'Dina','Mesić');

#insert u titule
insert into titule (naziv,opis) 
values ('Kralj','Vrhovni vladar države u srednjem vijeku. 
Jedino je titula cara bila veća!');

insert into titule (naziv,opis) 
values ('Vojvoda','Pripadnik plemstva, povijesno prvi ispod kralja ili kraljice,
 a obično upravljaju vojvodstvom.');
 
 insert into titule (naziv,opis) 
values ('Markiz','Najčešće je po rangu iznad grofa, 
odnosno predstavlja ekvivalent/sinonim germanskoj 
tituli markgrofa, a ispod vojvode.');

insert into titule (naziv,opis)
 values ('Car','(od lat. caesar) je vladar, odnosno državni poglavar u državi koja je po državnom uređenju carstvo. Ova se titula obično prenosi naslijeđivanjem i 
 smatra se višom od kraljevske. Car vlada nad puno zemalja i naroda, uključujući eventualno i njihove kraljeve. Jedini nositelj te titule danas je japanski poglavar Akihito.');
 
insert into titule (naziv,opis)
 values ('Knez','Knez ili kneginja (starosl. кънѩѕь) naslov je koji se davao pripadnicima plemstva, a u raznim je povijesnim razdobljima i u raznim krajevima imao različito značenje. U latinskim natpisima i poveljama ovi knezovi obično nose naslov dux, što odgovara vojvodi. Ponekad im je pridavan i naslov princeps, 
 koji zapravo označuje kraljevića, a to daje naslutiti da južnoslavenski „knez“ nije bio doživljavan na isti način kao germanski ili romanski dux, niti kao romanski princeps.');
 
 insert into titule (naziv,opis)
 values ('Sultan','Sultan, u nekim islamskim zemljama i društvima vladar, a naročito vladar osmanlijske porodice, Sultan Sultana, Kan Kanova, Halifa (nasljednik poslanika Muhammeda) i Sjena Allahova na Zemlji, Sluga gradova Mekke, Medine i Kudsa (Jeruzalem). Sultan je ekvivalentan titula kralju.');
 
insert into titule (naziv,opis)
 values ('Kalif','Kalif (arapski: خليفة), titula duhovnog poglavara muslimana koji se smatra nasljednikom Muhameda. Kalifi su vršili svjetovnu i vjersku vlast u prvim državama koje su stvorili Arapi poslije Muhamedove smrti. U 16. stoljeću titulu kalifa nosili su turski sultani.');
 
#insert u osobe

insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Rikard I','Lavljeg Srca',1,1157,1199,'Rikard I. Lavljeg Srca (Oxford, 8. rujna 1157. - Châlus kraj Limogesa, 6. travnja 1199.) engleski kralj od 6. srpnja 1189. do smrti. Također i vojvoda Normandije, Akvitanije, Gaskonje, gospodar Irske, gospodar Cipra, grof od Anjoua, Maine, Nantesa, nadgospodar (overlord) od Bretanje. Nadimak "Lavljeg Srca" je dobio prema svojem ratničkom umijeću. Izvorni naziv je Cœur de Lion na francuskom i Richard the Lionheart na engleskom. Muslimani su ga zvali Melek-Ric i Malek al-Inkitar (kralj Engleske).

Godine 1189. naslijedio je kralja Henrika II. kao treći sin.

Stekao je znatno vojno iskustvo suzbijajući pobunu u francuskoj pokrajini Akvitaniji koju je naslijedio.

Bio je jedan od ključnih sudionika Trećeg križarskog rata, uz francuskog kralja Filipa II Augusta i njemačkog cara Fridrika Barbarossu. Zauzeo je Acru i porazio Saladina u bitci kod Arsufa 1191. godine. Na povratku iz Trećeg križarskog rata 1192. godine zarobio ga je austrijski vojvoda Leopold. Pustio ga je 1194. godine uz otkupninu od 150.000 maraka. Sama isplaćena svota govori o snazi, moći i bogatstvu Engleske u ono doba.

Nakon kraćeg boravka u Engleskoj 1194. godine ponovno je ratovao na kontinentu i to u Francuskoj pokušavajući povratiti posjede koje je izgubio tijekom svoje odsutnosti. Njegova permanentna odsutnost iz Engleske ostavila je tragove na unutarnjem planu budući da je gotovo stalno ratovanje u Trećem križarskom ratu i u Francuskoj iscrpilo gospodarstvo, stvorilo dugove i nezadovoljstvo visokog plemstva. Njegov brat i kasniji nasljednik Ivan mu je tijekom sudjelovanja u Trećem križarskom ratu pokušao preoteti krunu, ali mu se nakon povratka ipak poklonio i priznao ga svojim kraljem.

Poginuo je godine 1199. u Francuskoj prilikom opsade dvorca Aimara grofa od Limogesa. Kako Rikard nije imao djece, nakon njegove smrti naslijedio ga je brat Ivan.','1.gif');

insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('William','Osvajač',1,1066,1087,'Vilim I. Osvajač (engl. William the Conqueror, William the Bastard), normandijski vojvoda i engl. kralj (Falaise, o. 1027 – Rouen, 7. IX. 1087). 

Nezakoniti sin normandijskoga vojvode Roberta I. Vojvoda Normandije od 1035; na vlast došao prema oporučnoj očevoj želji, a uz pristanak normandijskih velikaša i franc. kralja Henrika I. God. 1047. skršio otpor plemstva u Normandiji; 1053. ženidbom s Matildom, kćeri kneza Baldvina, učvrstio se u Flandriji. God. 1063. priključio Normandiji grofoviju Maine i odbio napade franc. kralja Henrika I. 

Kao blizak rođak engl. kralja Eduarda Ispovjednika, najozbiljniji pretendent na engl. krunu. God. 1066. porazio kraj Hastingsa drugog pretendenta, Harolda II., kojega su za kralja Engleske postavili anglosaski velikaši te se okrunio u Westminsterskoj opatiji. Do 1071. pokorio cijelu zemlju. Osvojena područja podijelio među normandijske grofove. U njegovo doba započinje postupno stapanje tada već romaniziranih Normana s Anglosasima u engl. naciju; istodobno jača proces feudalizacije (pretvaranje dotad slobodnih seljaka u kmetove). 

Uveo francuski kao služb. jezik. God. 1085–86. uveo imovni katastar (Domesday Book), učvrstio administraciju lokalnih ustanova, a crkv. hijerarhiju povezao s drž. vlašću. Smrtno ranjen u borbi protiv franc. kralja Filipa I.','2.gif');

insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Luis VII','Augustus',1, 1165,1223,'Luj VII. (1120. - 18. rujna 1180.), francuski kralj od 1137. - 1180. godine

Poslije smrti oca Luja VI. 1. kolovoza 1137. godine jedva punoljetni Luj VII. je postao novi francuski kralj. Pred sam kraj svoga života otac mu je ugovorio vjenčanje s Elenor vojvodkinjom Akvitanije koja je bila dvije godine mlađa od njega. Taj brak je od samog početka bio neuspjeh. Crkveno obrazovani Luj se nije mogao nositi s liberalno obrazovanom Elenor. Ona sama je za svog muža izjavila kako je mislila da se ženi za muškarca, a ne svećenika.

Poslije petnaest godina braka bez muške djece Luj VII se rastavio od supruge odričući se na taj način Akvitanije. Razvedena Elenor s tako velikim mirazom je odmah upala u oči desetak godina mlađem kralju Engleske Henriku II. koji je odmah ženi donoseći Engleskoj ovu veliku francusku pokrajinu. S druge strane Luj je tek u trećem braku dobio sina koji ga je naslijedio.

Za vrijeme svog vladanja on nastavlja očevu politiku slabljenja plemića ne uvidjevši prilike za širenje svoga kraljevstva. Građanski rat koji traje 15 godina tijekom njegovog vladanja u Engleskoj je bila prilika koju nije smio propustiti za izbacivanje Engleske iz Francuske. Umjesto smanjivanja okupiranog teritorija on ga na kraju i proširuje darivanjem Akvitanije.

U doba njegove smrti 18. rujna 1180. godine Engleska vlada s više od pola tadašnje Francuske. Naslijeđen je od dugo čekanog sina Filipa II.','3.jpg');

insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Henrik III.','Salian',4, 1017,1056,'(28 October 1017 – 5 October 1056), called the Black or the Pious, was a member of the Salian Dynasty of Holy Roman Emperors. He was the eldest son of Conrad II of Germany and Gisela of Swabia. His father made him duke of Bavaria (as Henry VI) in 1026, after the death of Duke Henry V.

On Easter Day 1028, after his father was crowned Holy Roman Emperor, Henry was elected and crowned King of Germany in the cathedral of Aachen by Pilgrim, Archbishop of Cologne.

After the death of Herman IV, Duke of Swabia in 1038, his father gave him that duchy (as Henry I), as well as the kingdom of Burgundy, which Conrad had inherited in 1033. Upon the death of his father on 4 June 1039, he became sole ruler of the kingdom and was crowned emperor by Pope Clement II in Rome (1046).',null);

#za križarkse ratove

#5
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Henrik IV','Salian',4, 1050,1106,'Henrik IV. (vjerojatno u Goslaru, 11. studenog 1050. - Lüttich, 7. kolovoza 1106.) bio je sin cara Henrika III. i Agneze od Poiotua. Rimsko-njemački kralj od 1056.; rimsko-njemački car (1084. – 1105.). 31. prosinca 1105. njegov sin i nasljednik Henrik V. prisilio ga je da se odrekne prijestolja.

Henrik IV. bio je jedan od najkontroverznijih srednjovjekovnih careva. Vladao je skoro 50 godina, najdulje od svih srednjovjekovnih careva. Ovaj vladar podijelio je ne samo svoje suvremenike nego i kasnije naraštaje, osobito povjesničare. Njegov sukob s papom Grgurom VII. 
i odlazak u Canossu smatraju se vrhuncem borbe za investituru i među najpoznatijim su događajima europske srednjovjekovne povijesti.','5.jpg');
#6
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Filip I.','Capet',1, 1052,1108,'Filip I. (franc. Philippe Ier) (23. svibnja 1052. ‒  29. srpnja 1108.) bio je kralj Francuske,[1] sin Henrika I. Francuskog i Ane Kijevske.[2] Iako je okrunjen za kralja u dobi od sedam godina, do 1066. je kao regentica vladala njegova majka.

Filipov prvi brak je bio s Bertom Holandskom.[3]

Iako je u braku dobio potrebnog nasljednika, Filip se zaljubio u Bertradu, ženu grofa od Anjoua. Ostavio je Bertu i oženio se Bertradom 1092. Hugo od Diea ga je 1094. po prvi put izopćio; nakon duge šutnje papa Urban II. je godinu dana kasnije ponovio izopćenje na saboru u Clermontu. Kazna je nekoliko puta bila ukidana jer je Filip obećavao da će se razići s Bertradom, ali bi joj se ponovno vratio. Nakon 1104. izopćenje se nije ponavljalo. Kralju se u Francuskoj protivio Ivo Šartrski, poznati kanonski pravnik.

Velik dio Filipove vladavine je, kao i kod njegovog oca, prošao u gušenju pobuna vazala gladnih moći. Godine 1077. je sklopio mir s Vilimom Osvajačem, vojvodom Normandije, koji je odustao od osvajanje Bretanje. Filip je 1082. proširio svoje posjede pripojenjem Vexina, a 1100. je prezeo kontorlu nad Bourgesom.

Za Filipovog vremena je pokrenut i Prvi križarski rat, u kojem on isprva nije sudjelovao zbog sukoba s Urbanom II. Urban mu ionako ne bi dopustio sudjelovanje, jer je prije sazivanja križarskog pohoda potvrdio Filipovo izopćenje. Filipov je brat Hugo od Vermandoisa bio jedan od najznačajnijih sudionika.

Filip je umro u Melunu 29. srpnja 1108. i pokopan je u samostanu Saint-Benoît-sur-Loire – a ne u bazilici Saint-Denis, kao gotovo svi kraljevi iz dinastije Capet. Naslijedio ga je sin Luj VI.','6.png');

#7
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Roger.','Borsa',2, 1060,1111,'Roger Borsa (italijanski: Ruggero Borsa; 1060/1 – 22. veljača 1111) bio je normanski vojvoda Apulije i de facto vladar Južne Italije 
od 1085. do smrti. Bio je sin znamenitog normanskog velmože i osvajača Roberta Guiscarda, ali su mu uglavnom nedostajale Rogerove političke sposobnosti, 
te mu je država najveći dio vladavine provela u feudalnoj anarhiji. Na prijestolje je došao poslije očeve smrti, koja je izazvala višegodišnji i složeni sukob za nasljedstvo sa bratom Bohemundom, završen tek posredovanjem pape Urbana II. Godine 1098. je sudjelovao u znamenitoj opsadi Kapue.
Godine 1092. se oženio za Adelu od Flandrije, kćer grofa Roberta I od Flandrije i udovicu danskog kralja Knuta IV Svetog. S njom je imao sina po imenu Guillaume II, koji ga je naslijedio. Zemlje mu je, uskoro, preuzeo rođak Roger II od Sicilije.','7.jpg');

#8
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Aleksej I.','Komnen',4, 1048,1118,'Aleksije I. Komnen vladao je Bizantskim Carstvom od 1081. do 1118. godine. Reformirao je vojsku (oslanjao se na plaćenike) i upravu. Ratovao je s Pečenezima na sjeveru carstva, Raškom (Srbijom) i Normanima u južnoj Italiji. Zatražio je pomoć pape u borbi protiv "nevjernika" (Arapa) čime je pokrenuo Prvi križarski rat (1096. godine).

Aleksije Komnen dolazi na vlast u dramatičnim trenutcima za Carstvo. S njim na čelo dolazi nova aristokracija nastala feudalizacijom i rušenjem starog tematskog uređenja, vladavina vojnog plemstvo koja će Carstvu osigurati prednost na Istoku za još jedno stoljeće.

Vrelo za doba njegove vlasti su djela njegove kćeri Ane Komnen i njegova privatnog tajnika, prōtasēkrētisa (πρωτασηκρῆτις, protoasecretis) Ivana Zonare.','8.jpg');

#9
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Konstantin I.','Armenski Princ',5, 1035,1103,'Constantine I or Kostandin I (1035–1040 / 1050–1055 – c. 1100 / February 24, 1102 – February 23, 1103) was the second lord of Armenian Cilicia or Lord of the Mountains (1095 – c. 1100 / 1102 / 1103). During his rule, he controlled the greater part of the regions around the Taurus Mountains, and invested much of his efforts in cultivating the lands and rebuilding the towns within his domain. He provided ample provisions to the Crusaders,
 for example during the difficult period of the siege of Antioch in the winter of 1097. He was a passionate adherent of the separated Armenian Church.',null);

#10
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Barkyaruq','ibn Malikshah',6, 1079,1105,'Barkiyaruq was born in 1079/1080,[2] he was the oldest son of Malik Shah I,[3] and a Seljuq princess. He had three brothers named Mahmud I, Ahmed Sanjar, Mehmed I, Dawud, and Ahmad.

During his youth, the succession to the Seljuq sultanate was complicated by the death of two of his half-brothers: Dawud (died 1082) and Ahmad (died 1088), whom both were sons of the Kara-Khanid Princess Turkan Khatun, she also had a named Mahmud (born 1087) which she wanted to succeed his father, while the vizier Nizam al-Mulk and most of the Seljuq army was in favor of Barkiyaruq,[4] the oldest of all Malik Shahs living sons and born to a Seljuq princess. Turkan Khatun then allied with Taj al-Mulk Abul Ghana to try to remove Nizam from his post. Nizam was later assassinated in 1092, which made Barkiyaruq lose a powerful supporter. Barkiyaruqs father eventually died some months later. Turkhan Khatun then took the opportunity of his death, and with the support of Taj al-Mulk, put her 4 year old Mahmud I on the throne, 
while Barkiyaruq was proclaimed as Sultan of the Seljuq Empire at Ray by the faction of the dead vizier Nizam al-Mulk. However, Mahmud I was not the only Seljuq claimant to the throne, several other Seljuq princes such as Arslan-Argun, Mehmed I, and Tutush I, also claimed the throne.[5] Taj al-Mulk was later assassinated by the ghulams of Nizam al-Mulk,[6] while Turkhan Khatun and her son Mahmud I died in 1094. One year later, Barkiyaruq clashed with Tutush I at Ray, where Barkiyaruq managed to emerge victorious and kill Tutush I along with his supporter Ali ibn Faramurz.[7]

In 1105, Barkiyaruq died in Borujerd, and was succeeded by his son Malik Shah II. It has been reported that his body was returned to Isfahan. However, some people say[who?] his tomb is in 5 km north of Borujerd, where today is a historical monument called Zavvarian.','10.jpg');

#11
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Ahmad al-Mustālī','b’il-Lāh',7, 1074,1101,'(16 September 1074 – 12 December 1101), (Arabic: أبو القاسم أحمد المستعلي بالله‎) was the ninth Fatimid Caliph, and believed by the Mustaali Ismaili sect to be the 19th imam. Al-Musta‘li was made caliph by the vizier Malik al-Afdal Shahanshah as the successor to al-Mustansir. By and large, al-Musta‘li was subordinate to Malik al-Afdal. One complication with the selection of al-Musta‘li was that his older brother Nizar was considered by Nizars supporters to be the rightful heir to the throne. This led to a power struggle within the Fatimids, and although Nizars revolt was unsuccessful (ending with his death in prison in 1097), the break from the rules of succession caused a schism amongst the Ismaili Shia. In Seljuk Syria and Persia, the Nizari sect developed, one branch of which is known to history as the Hashshashin. Supporters of Mustalis imamate became known as the Mustaali sect.

During al-Musta‘li s reign, the First Crusade (1099) established the Kingdom of Jerusalem, the County of Tripoli and the Principality of Antioch, which further reduced Fatimid power in Syria and Palestine. He was succeeded by his son Al-Amir (r. 1101–1130), after whose reign the Mustaali sect again split into the Hafizi and Taiyabi sects.',null);

#12
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Malik Dānishmand Aḥmad','Ghāzī',7, 1071,1104,'(died 1104), was the founder of the beylik of Danishmends. After the Turkish advance into Anatolia that followed the Battle of Manzikert, his dynasty controlled the north-central regions in Anatolia.',null);

#13
insert into osobe (ime,prezime,titula,godinarodjenja,godinasmrti,opis,slika) 
values ('Yusuf',' ibn Tashfin',6, 1042,1106,' reigned c. 1061 – 1106) was a sultan (king) of the Almoravid empire. He co-founded the city of Marrakech and led the Muslim forces in the Battle of Zallaqa/Sagrajas.','13.jpg');

#u zemlje

insert into zemlje (naziv,vladar)
values ('Englesko Kraljevstvo',1);

insert into zemlje (naziv,vladar)
values ('Englesko Kraljevstvo',2);

insert into zemlje (naziv,vladar)
values ('Francusko Kraljevstvo',3);

insert into zemlje (naziv,vladar)
values ('Sveto Rimsko Carstvo',4);

insert into zemlje (naziv,vladar)
values ('Sveto Rimsko Carstvo',5);

insert into zemlje (naziv,vladar)
values ('Francusko Kraljevstvo',6);

insert into zemlje (naziv,vladar)
values ('Vojvodstvo Apulia',7);

insert into zemlje (naziv,vladar)
values ('Bizantsko Carstvo',8);

insert into zemlje (naziv,vladar)
values ('Armensko Kraljevstvo Cilicija',9);

insert into zemlje (naziv,vladar)
values ('Carstvo Turskih Seldžuka',10);

insert into zemlje (naziv,vladar)
values ('Kalifat Fatimida',11);

insert into zemlje (naziv,vladar)
values ('Kalifat Danišmenda',12);

insert into zemlje (naziv,vladar)
values ('Sultanat Almoravida',13);

#insert u strane

insert into strane(naziv,brojvojnika)
values('I. križarski rat - križari',null);

insert into strane(naziv,brojvojnika)
values('I. križarski rat - muslimani',null);

#insert u ucestvuju
insert into ucestvuju(zemlja,strana)
values(5,1),(6,1),(7,1),(8,1),(9,1);

insert into ucestvuju(zemlja,strana)
values(10,2),(11,2),(12,2),(13,2);

#insert u ratove

insert into ratovi (naziv,stoljece,gpocetak,gkraj,stranaa,stranab,pobjednik,opis)
values ('I. Križarski rat',11,1096,1099,1,2,'pobjeda Kršćana','Prvi križarski rat (1096. - 1099.) vodili su veliki francuski, flandrijski i normandijski velikaši, među kojima se ističu Godfrid Bouillonski i njegov brat Baldovin. Oni su na Istok krenuli u kolovozu 1096. godine preko Balkana i Bizanta, a već 1097. godine na vojnom pohodu preko Male Azije izborili su i prvu pobjedu osvojivši Niceju (lipanj 1097. godine), zatim pobjedivši u bitki kod Dorileja (srpanj 1097. godine), nakon čega su se domogli Edese i Antiohije (1098). 15. srpnja 1099. osvojili su Jeruzalem, opljačkali ga i počinili velik pokolj stanovništva. Svećenik Rajmund Aguilers napisao je: "U Salomonovom hramu (u Jeruzalemu), gazili smo do koljena u krvi, pa čak i do konjskih uzda, po pravednom i čudesnom Božjem sudu." Oko 40.000 muslimana, zajedno sa Židovima pobijeno je u ta dva dana, i tako je Jeruzalem "očišćen od nevjerničke ruke". Zabilježeno je i da su spalili jednu sinagogu punu Židova. Nakon zauzimanja grada u bazilici Svetoga groba održana je misa zahvale. U njihovim rukama grad je ostao oko 100 godina. Budući da je cilj rata bio ostvaren mnogi su se križari vratili u svoje zemlje. Neki su, međutim, ostali i nastavili se probijati duž istočne sredozemne obale. Oni su na koncu osnovali i četiri križarske države: Jeruzalemsko Kraljevstvo, grofoviju Tripoli, kneževinu Antiohiju te grofoviju Edesu. Središte posljednje osnovane križarske države, Tripoli, križari su osvojili 1109. godine, nakon 6 godina opsade.

1097. Križari stižu u Konstantinopol (današnji Istanbul).
1098. Francuska i normanska vojska zauzele Edesu i Antiohiju.
1099. Križari zauzeli Jeruzalem i podijelili obalno područje na četiri kraljevstva.');




