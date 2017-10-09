-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 09. říj 2017, 16:59
-- Verze serveru: 10.1.26-MariaDB
-- Verze PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `project`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_text` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `product_id`, `comment_text`, `uploaded`) VALUES
(2, 1, 1, 'brb', '2017-01-14 15:04:17'),
(4, 1, 19, 'abc', '2017-01-14 15:08:50'),
(5, 1, 19, 'and', '2017-01-14 15:35:35'),
(6, 1, 19, 'alert(1);', '2017-02-10 08:36:18'),
(7, 2, 7, 'Assassin\'s creed', '2017-09-27 17:14:46'),
(8, 2, 7, 'Assassin\"s creed', '2017-09-27 17:15:09'),
(9, 2, 19, 'dsgfasdv', '2017-09-27 18:10:50');

-- --------------------------------------------------------

--
-- Struktura tabulky `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(30) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Adventury'),
(2, 'Akční'),
(7, 'Plošinovky'),
(4, 'RPG'),
(5, 'Simulátory'),
(6, 'Sportovní'),
(3, 'Strategie');

-- --------------------------------------------------------

--
-- Struktura tabulky `goods_order`
--

CREATE TABLE `goods_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `e_mail` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_czech_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `psc` varchar(6) COLLATE utf8_czech_ci NOT NULL,
  `delivery_means` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `payment_means` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `info` varchar(500) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `goods_order`
--

INSERT INTO `goods_order` (`order_id`, `user_id`, `price`, `first_name`, `last_name`, `e_mail`, `phone`, `street`, `city`, `psc`, `delivery_means`, `payment_means`, `delivered`, `info`) VALUES
(1, 2, 1397, 'Radek', 'Šimíček', 'abcd.abcd@abc.com', '123456789', 'Brb 1547', 'Odr', '12345', 'Česká pošta - balík do ruky', 'Platba dobírkou(platba hotově řidiči)', 0, ''),
(2, NULL, 599, 'dsafasdf', 'asdfasdfasdf', 'asdfasdfas@dsafs', '123456789', 'asdfasdfas', 'adsfasdfasdf', '73532', 'Česká pošta - balík do ruky', 'Převod předem', 0, 'asdfasdfasdfasd'),
(3, 2, 599, 'asdfasdf', 'asdfasdfasd', 'asdfasdfas@dsafs', '123456789', 'asdfasdfas', 'adsfasdfasdf', '73532', 'Přepravní služba PPL', 'Platba dobírkou(platba hotově řidiči)', 0, ''),
(4, 2, 1598, 'asdfasdfasd', 'asdfasdfasdf', 'asdfasdfas@dsafs', '123456789', 'asdfasdfas', 'adsfasdfasdf', '73532', 'Osobní odběr - Ostrava', 'Převod předem', 0, '');

-- --------------------------------------------------------

--
-- Struktura tabulky `order_content`
--

CREATE TABLE `order_content` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `order_content`
--

INSERT INTO `order_content` (`product_id`, `order_id`, `count`) VALUES
(1, 1, 1),
(15, 4, 1),
(19, 1, 2),
(19, 2, 1),
(19, 3, 1),
(19, 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `platform`
--

CREATE TABLE `platform` (
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `platform`
--

INSERT INTO `platform` (`platform_id`, `platform_name`) VALUES
(1, 'PC'),
(3, 'PS3'),
(2, 'PS4'),
(5, 'X360'),
(4, 'XONE');

-- --------------------------------------------------------

--
-- Struktura tabulky `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `platform_name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `genre_name` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `product_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8_czech_ci NOT NULL,
  `picture` varchar(200) COLLATE utf8_czech_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `uploaded` datetime NOT NULL,
  `sold` int(11) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `delivery_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `product`
--

INSERT INTO `product` (`product_id`, `platform_name`, `genre_name`, `product_name`, `description`, `picture`, `price`, `uploaded`, `sold`, `in_stock`, `delivery_time`) VALUES
(1, 'PC', 'RPG', 'Bound by Flame', 'V Bound by Flame budete hrát za žoldáka posedlého plamenným démonem. Hráči, coby oběti démonického vlivu, si budou muset vybírat, jestli přijmou moc, kterou jim nabízí jejich hostitel, nebo si zachovají lidskost a budou se místo toho soustředit na hrdinské vlastnosti. Nepřátelé a nástrahy, čím dál tím děsivější a lítější, vás budou lákat, abyste získali více schopností tak, že část hrdinovy duše zaprodáte démonovi. Postup démonického vlivu se bude zobrazovat na těle hrdiny.V závislosti na volbách hráče a démonickém vlivu budou mít některé kapitoly odlišný scénář a nabídnou jiný zážitek, což hře dodává na znovuhratelnosti. Souboje v reálném čase jsou působivé a dynamické. Pokud hráč zahájí hru jen se základní znalostí souboje, ohnivé magie a zabijáctví, bude se moci specializovat odemykáním a vylepšováním mnoha schopností ze 3 různých vývojových větví. V Bound by Flame si hráči můžou svou postavu upravit podle svého. Během vytváření svého hrdiny si budou moci zvolit pohlaví a rysy v obličeji. To samozřejmě ovlivní i hrdinův démonický vliv. Bound by Flame také obsahuje systém výroby, který umožňuje vytvářet a vylepšovat vybavení včetně zbroje a zbraní. K hráčově výpravě se připojí také několik společníků a podle jeho činů se vztahy s nimi můžou vyvinout v přátelství, lásku či nenávist. Bestiář Bound by Flame je také ohromný. Hráči se budou muset utkat s mnoha působivými příšerami: stínoví draci, lišajové, nemrtví, ledové stvůry… epické střety vás čekají na každém rohu. Kterou cestou se vydáte? Budete prahnout po démonické moci a magii, s jejíž pomocí své nepřátele sežehnete plamenem, anebo dáte přednost bojovým dovednostem a srdnatosti?', 'boun(1).dbyflame.jpg', 199, '2016-07-13 00:00:00', 1503, 7, 1),
(2, 'PC', 'RPG', 'Blackguards', 'Blackguards pokládá hráči jednoduchou otázku. Co by se stalo, kdyby osud světa v tísni nelpěl v rukou ctnostných rytířů v naleštěných zbrojích, ale otěží se záměrem jeho záchrany by se naopak chopili zatracenci a zločinci odsouzení na smrt? Ve hře se ujímáte role usvědčeného a odsouzeného vraha, který se s partou neméně pochybných existencí vydal na dlouhou výpravu skrze jižní Aventurii, jejímž cílem je zabránit pádu světa do temnoty. Postupem skrze kapitoly se postupně dovíte více a více v příběhu plném intrik a nečekaných zvratů, v němž o morální rozhodnutí není nouze. Jak daleko zajdete, aby jste dosáhli svých cílů? The Dark Eye:Blackguards je turn-based RPG od společnosti Daedalic Entertainment. Čeká vás 180 plně trojrozměrných map s řadou interaktivních objektů pro tahové souboje na (do hexagonů rozdělených) bojových polích. Vypomoci si lze v taktických bitvách i více jak 40 speciálními schopnostmi vašich antihrdinů a více jak 90 kouzly', 'blackguard.jpg', 209, '2016-07-14 00:00:00', 150, 0, 2),
(3, 'PC', 'Strategie', 'Cossacks 3', 'Klasická real-time strategie se po dlouhých letech vrací. Znovu vás čeká taktický výcvik jednotek, stavba budov a těžba surovin. Hra se tradičně odehrává v 17. a 18. století s 12 hratelnými národy. Do rukou se vám dostane až 10 000 jednotek současně.Po vydání na vás čeká pět historických kampaní pro jednoho hráče a další budou přibývat v aktualizacích zdarma. Včetně dalších 8 národů, jejichž celkový počet se zastaví na 20. V základní hře to budou Rakousko, Francie, Anglie, Španělsko, Rusko, Ukrajina, Polsko, Švédsko, Prusko, Benátky, Turecko a Alžírsko.V multiplayeru může proti sobě hrát až 8 hráčů, jak v týmech tak i proti počítači. Bitvy budou probíhat na náhodně vygenerovaných mapách.Herní mechanizmy budou kompletně vycházet z prvního dílu Cossacks, který mají hráči dodnes nejraději. Není to však rozhodně finální stav. Hratelnost budou vývojáři z počátku upravovat dle reakcí fanoušku, aby byla opravdu přesně taková, jakou si přejí.', 'cossacks.jpg', 549, '2016-09-20 00:00:00', 30, 10, 3),
(4, 'XONE', 'Sportovní', 'FIFA 17', 'FIFA 17 poprvé využívá nekompromisního výkonu enginu Frostbite a přináší tak revoluci do samotné hratelnosti a prožitku ze hry. Těšit se můžete na inovace ve způsobu myšlení a pohybu fotbalistů či fyzickém kontaktu s protivníky. To vám umožní účinný přechod do ofenzívy, čímž si podmaníte každý okamžik na hřišti. Vůbec poprvé v historii hra nabídne také příběhovou kampaň pro jednoho hráče.Poprvé v sérii FIFA budete moct prožít svůj příběh na hřišti i mimo něj jako Alex Hunter, vycházející hvězda Premier League. Podepište smlouvu s některým z klubů Premier League vedeného reálným trenérem, jenž má v týmu špičkové hráče z celého světa. Vstupte do nového světa a vydejte se na Cestu, na níž vás čeká plno vypjatých vzestupů i pádů. Je těsně před startem sezóny 2016/2017 a vy se ocitáte v roli Alexe Huntera, mladého nadějného Angličana na prahu kariéry v Premier League. Vaším úkolem je zdolat překážky, popasovat se s tíhou slavného fotbalového jména a vybudovat vlastní odkaz. Před Alexem stojí na hřišti, ale i mimo něj, řada velkých nástrah a obtížných rozhodnutí – vy teď máte šanci vydat se spolu s ním na Cestu a zažít fotbal ze strany, kterou důvěrně znají jen hráči nejvyšší soutěže. Jeden z předních enginů v herním průmyslu, Frostbite, přinese ve verzích pro Xbox One, PlayStation 4 a PC autentickou a realisticky zpracovanou akci, kterou hráči zakusí v nových fotbalových světech po boku barvitých postav s emocemi. Frostbite přináší do fotbalových světů ještě více detailů. Těšte se na zcela nová prostředí jako vstupní tunely, šatny, trenérovu kancelář nebo týmové letadlo. Čeká na vás skutečně působivý herní zážitek, který vás vtáhne do fotbalu a umožní vám prožít emoce tohoto sportu na hřišti i mimo něj.', 'fifa17.jpg', 1779, '2016-09-16 00:00:00', 200, 0, 4),
(5, 'X360', 'Adventury', 'Terraria', 'Kopejte, bojujte, objevujte, stavějte! Nic není nemožné v této akčně napěchované dobrodružné hře. Svět je vaším plátnem a samotný terén je vaší barvou. Seberte své nástroje a běžte! Vyrobte zbraně k přemožení různých nepřátel z mnoha biomů. Vykopejte hluboká podzemí k nalezení doplňků, peněz a jiných užitečných věcí. Shromážděte zdroje k vytvoření všeho, co je zapotřebí, aby se stal svět vaším vlastním. Postavte dům, pevnost nebo dokonce zámek. Lidé se tam nastěhují, možná vám dokonce prodají i různá zboží, aby vám vypomohli na vaší cestě. Mějte se však na pozoru, jsou tu daleko větší výzvy, které vás ještě čekají... Jste na ně připraveni?', 'terraria.jpg', 549, '2016-09-08 00:00:00', 10, 10, 5),
(6, 'PS4', 'Simulátory', 'F1 2016', 'Vytvořte si vlastní legendu formule 1. V novém ročníku se vrací propracovaná kariéra, kde během deseti sezón získáte šanci ukázat co ve vás je. Nejprestižnější motorsport na světě ale není žádná selanka. Ihned nebudete na stupních vítězů, ale musíte se na ně propracovat poctivou dřinou. Hra zahrnuje kompletní sezónu 2016 se všemi 21 tratěmi, 22 jezdci a 11 týmy. Poprvé se tak projedete po novém pouličním okruhu Baku v Ázerbájdžánu. Na trať se vrací oblíbený Safety Car a poprvé zde bude Virtuální Safety Car. Aktuální ročník nabídne také vhled do samotného vývoje vozů. Budete spolupracovat se svým agentem, inženýry a celým týmem na vývoji svého vozu, aby mohl být tím nejrychlejším na startovní čáře.', 'f12016.png', 1699, '2016-09-09 00:00:00', 5000, 0, 1),
(7, 'PS3', 'Akční', 'Assassins Creed 4: Black Flag', 'Série s milióny prodaných kusů na svém kontě se nám rozrůstá o další díl. Zapomeňte na hrdiny, z dějů minulých, poznejte nové pohledy, nové hrdiny a nové prostředí, plavte se po černou vlajkou a zakuste sílu moře a větru! Velte své lodi a staňte se hrozbou pro obchodníky. Přichází nová doba a už nyní, je čas na změnu. Assassins Creed IV: Black Flag přichází a bude tu již tento rok.Assassins Creed IV Black Flag vypráví příběh Edwarda Kenwaye, mladého Brita s touhou po nebezpečí a dobrodružství. Edward je nelítostný pirát a zkušený bojovník, který se zaplete do starověké války mezi templáři a asasíny. Hra se odehrává na počátku 18. století a obsahuje jména některých z nejznámějších pirátů historie jako Blackbeard či Charles Vane a zavede hráče na cestu po celé západní Indii v době, jenž je nazývána zlatý věk pirátů.', 'Assassins_Creed_IV_Black_Flag.jpg', 499, '2016-09-04 00:00:00', 300, 10, 1),
(8, 'PC', 'Adventury', 'Broken Age', 'Klasická adventura ze staré školy od legendárního Tima Schafera. Ve hře budete sledovat příběh dvou zdánlivě nesouvisejících postav. Chlapce ve vesmírné lodi Shaye, který nekonečně pluje vesmírem a dívky Velly v pohádkovém království, jenž se má stát obětí obávané nestvůry.Broken Age se zapsal jako průlomový projekt na Kickstarteru a díky nečekaně vysoké vybrané částce se projekt uskutečnil. Zároveň se stal tak obsáhlým titulem, že musel být rozdělen a nyní se dočkáme jeho prvního dílu. Vrhněte se do světa snů, světa plného ambicí, světa kde musíte přežít a kde prožíváte paralelně dva příběhy. Chlapce Shay na kosmické lodi, jenž se snaží uniknout ze spárů diktátorského palubního počítače a dívky Vella v pohádkovém království, kde oběť panen přináší záchranu, ale je tomu opravdu tak. Hra Vám umožní kdykoliv přepínat mezi hrdiny, proto se připravte na příběh příběhů a poznejte nepoznané.', 'broken_age.png', 699, '2016-09-03 00:00:00', 145, 0, 2),
(9, 'PC', 'Akční', '7 Days to Die', '7 Days to Die vykrádá Minecraft a DayZ a vypadá velice dobře. Hráči v této survival hře s otevřeným světem mohou prozkoumávat divočinu, shromažďovat suroviny a vytvářet si své vlastní nástroje, zbraně, opevnění a pasti kolem svých příbytků, které si také musí ze surovin vybudovat. Hlavním úkolem je ale přežít ve světě plném zombie. ', '7days.jpg', 749, '2016-09-01 00:00:00', 800, 10, 3),
(10, 'PC', 'Plošinovky', 'Deadlight: Directors Cut', 'Hororová zombie plošinovka ve vylepšené Directors Cut edici. Čeká vás upravené ovládání, vyladěné animace a celá řada dalších úprav. A k tomu také nový mód Survival Arena, který prověří vaše schopnosti přežít mezi zombie.Děj se odehrává v alternativní minulosti roku 1986 a vypráví příběh Randalla Waynea. Randall je introvert a lehce paranoidní přeživší, jenž se snaží ve světě zničeném zombie apokalypsou najít své blízké. Z ulic zničeného Seattlu, přes rozpadlé kanalizace a zbytky zničeného stadionu budete cestovat směrem k bájnému místu jménem Safe Point.', 'deadlight.jpg', 599, '2016-08-17 00:00:00', 900, 0, 4),
(11, 'PC', 'Simulátory', 'BeamNG.drive ', 'Nejrealističtější simulace automobilových nehod BeamNG Drive je závodní hrou, která se soustředí zejména na realistické pojetí fyziky a demolice. Je postavena na CryEngine 3, ale notně vylepšeném o vlastní fyzikální soft-body engine (deformovatelné objekty), který nemá konkurenci v existujících, ani připravovaných projektech. Jde o revoluci v tom, jak se hry hýbou, ne jak vypadají, což je také jednou z hlavních vizí celého projektu. ', 'beamng.jpg', 799, '2016-08-12 00:00:00', 785, 10, 5),
(12, 'PC', 'Sportovní', 'Blood Bowl 2', 'Hra Blood Bowl 2, která v sobě snoubí Warhammer a americký fotbal, představuje výbušný koktejl tahové strategie, humoru a brutality podle slavné deskové hry od Games Workshop.Nový grafický engine hry Blood Bowl 2 a ctižádostivá realizace přinášejí věrné vyobrazení zuřivé a intenzivní klasiky zápasů v Blood Bowlu. V režimu sólové hry povedete slavné Reikland Reavers, někdejší hvězdný tým v Blood Bowlu. Budete mít za úkol vrátit jim zašlou slávu v příběhové kampani podpořené třeskutě vtipným komentářem Jima a Boba z Cabalvision. Každý zápas v kampani je jedinečný, obsahuje nečekané a překvapivé zvraty, takže zážitek je pokaždé jiný! Režimy pro více hráčů jsou větší a bohatší než kdy dřív. V trvalém online režimu si můžete vytvořit a spravovat vlastní tým složený z jedné z osmi ras ze světa Warhammer – těmi jsou lidé, orkové, trpaslíci, skaveni, vyšší elfové, temní elfové, chaoti a nováčci z Bretonnie. Svůj tým budete rozvíjet, získávat zkušenosti a odemykat si nové schopnosti. Ale pozor! Veškeré ztráty na hřišti jsou trvalé... Pořádejte kompletně upravitelné turnaje od kvalifikace až po finále a pomocí nového trhu přestupů nakupujte a prodávejte své hráče a sestavte si vlastní bloodbowlový tým snů! ', 'bloodbowl.jpg', 599, '2016-09-30 00:00:00', 789, 0, 1),
(13, 'PS3', 'Akční', 'Alien: Isolation', 'Poznejte skutečný význam slova strach v Alien: Isolation, hře žánru \"survival horror\" zasazené do atmosféry neutuchající hrůzy a smrtelného nebezpečí. Patnáct let po událostech z filmu Vetřelec se Amanda, dcera Ellen Ripleyové, vydává zjistit pravdu o zmizení své matky, a tím začíná její vlastní zoufalý boj o přežití. V roli Amandy se budete pohybovat v neuvěřitelně nepřátelském světě, obklopeni zoufalými a zpanikařenými lidmi a ohrožováni nepředvídatelným a nemilosrdným vetřelcem. Bez speciální výbavy či přípravy musíte hledat improvizovaná řešení nejrůznějších situací, používat svůj důvtip a okolní předměty a zařízení. Ne jen proto, abyste ve své misi uspěli, ale abyste vůbec zůstali naživu.', 'alien_isolation_ps3.jpg', 599, '2016-09-17 00:00:00', 320, 10, 2),
(14, 'PS3', 'RPG', 'Atelier Shallie: Alchemists of the Dusk Sea', 'Vyberte si, zda budete hrát za odměřenou a soustředěnou Shallisteru, nebo za ambiciozní a energickou Shallotte. Ač mají odlišný vzhled i mentalitu, obě mají shodnou přezdívku \"Shallie\". Shallistera je dcerou klanového vůdce, která se vydává na výpravu za vyřešením potíží, které postihly její domovinu. Shallotte se pro změnu snaží proslavit na poli alchymie. Zakuste příběh z pohledu obou dívek v této hře, která zahrnuje mnoho odboček a různých zakončení pro každou z nich. Další pokračování japonského RPG z řady Atelier, ve kterém máme možnost hrát hned za dvě alchymistky. Hra opět nabízí klasické možnosti alchymistických her, které spočívají v přípravě, sbírání ingrediencí, vyrábění předmětů a jejich používání v soubojích. Chybět samozřejmě nebude ani systém vylepšování postavy.', 'Atelier_Shallie_cover.jpg', 1199, '2016-10-02 00:00:00', 753, 0, 1),
(15, 'PS3', 'Simulátory', 'Farming Simulator 2015 ', 'Farming Simulator 15 vás zve do náročného světa moderního farmaření. Postavte se výzvám farmářského života včetně chovu zvířat jako krávy, slepice a ovce, pěstování plodin a jejich prodeje. Starejte se o svou farmu a rozvíjejte ji v obrovském otevřeném světě, které nyní obsahuje i zcela nové severské prostředí. Seznamte se s obyvateli, kteří vám zadají úkoly, a dokažte, že jste všestranně nadaný farmář! Farming Simulator 15 představuje novou aktivitu: kácení stromů! Starejte se o les na své mapě pomocí nových dostupných vozidel a strojů jako třeba nákladních vozů na klády, motorových pil, štěpkovačů a přívěsů. Aby byla vaše vozidla čistá, navštěvujte pravidelně myčky. Kdo by ve své garáži chtěl špinavý traktor? Farming Simulator 15 také přichází s online režimy a službami. Starejte se o farmu až s 10 přáteli online nebo na místní síti. Také můžete sdílet modifikace, vozidla a vybavení s hráči z celého světa, což vám umožní v podstatě neomezený obsah a bezpočet hodin herní doby! ', 'farmingcover.jpg', 999, '2016-09-21 00:00:00', 667, 9, 2),
(16, 'PS3', 'Sportovní', 'NBA 2K15', 'NBA 2K15 je pokračováním série simulátorů NBA a její tváří se tento rok stal čtyřnásobný šampion bodování NBA a nedávno korunovaný držitel ceny pro nejužitečnějšího hráče NBA pro rok 2014, Kevin Durant z Oklahoma City Thunder. Nový díl zároveň představuje opravdovou next gen sportovní hru, kde je kladen důraz na reálnost pohybů postav, každého svalu a i fyziku míče. Hru NBA 2K15 vyvíjí Visual Concepts.', 'NBA_2K15_cover_art.jpg', 699, '2016-08-13 00:00:00', 1945, 0, 3),
(17, 'PS4', 'Adventury', 'Batman: The Telltale Series ', 'Objevte dalekosáhlé následky svých rozhodnutí jako Temný rytíř. Mistři epizodických filmových her z Telltale představují svoji zatím nejambicióznější hru. Jako Batman narazíte na klasické spojence i protivníky a jako Bruce Wayne pocítíte co opravdu znamená, býti mužem v kápi.Drsný a násilný příběh od autorů herní série The Walking Dead otřese jak samotným Brucem, tak i už tak křehkou stabilitou Gotham City. Vaše volby v průběhu hry vytvoří novou kapitolu v životě výstředního průmyslníka a netopýřího detektiva.', 'Batman-The-Telltale-Series-ps4-free-download.jpg', 899, '2016-09-30 00:00:00', 3700, 8, 4),
(18, 'PS4', 'Akční', 'Aegis of Earth: Protonovus Assault', 'Frenetická akční strategie, kde budete plánovat a budovat svoji obranu proti hordám monstrózních nepřátel. Ti totiž mají v plánu vyhladit vás z povrchu zemského, jelikož vaše město je poslední baštou lidstva.Zapojte se do dynamické obrany města pomocí revoluční herní mechaniky, ve které otáčíte celým svým městem při míření na nepřátele. Neponechejte žádný kvadrant nedotčený, nepřátelé pochodují ze všech stran!Budete velet a zlepšovat pestrou nabídku jednotek a obřích zbraní. Díky napínavým herním mechanikám budete stále ve středu dění. Decimujte nepřátelské řady nepusťte je ani na krok do vašeho města.', 'Aegis_of_Earth_Vita_cover_art.jpg', 1399, '2016-10-12 00:00:00', 1564, 0, 5),
(19, 'PS4', 'Plošinovky', 'Super Meat Boy', 'Super Meat Boy je plošinovka kde hrajete za kostku masa, která se snaží zachránit svou přítelkyni před zlým zárodkem v nádobě, který je oblečený ve smokingu. Náš masitý hrdina bude skákat ze zdí, přes moře cirkulárek, skrz hroutící se jeskyně a bazény použitých jehel. Obětuje svoje vlastní pohodlí, aby zachránil svou dámu v nesnázích. Super Meat Boy přináší obtížnost ze staré školy - z klasických NES titulů jako Mega Man 2, Ghost and Goblins a Super Mario Bros. 2 (japonské verze) a přivádí je zpět k dokonalému a základnímu skákání. Zvyšující se obtížnost, od těžké po ničící duši, dovede Meat boye skrz staré nepoužívané nemocnice, továrny na sůl a dokonce do samotného pekla.A pokud by přes 300 single player úrovní nebylo dost, Super Meat Boy přidá navíc neuvěřitelné souboje s bossy, editor úrovní a hromadu odemykatelných secretů, pokřivené zóny a skryté postavy.', '936full-super-meat-boy-cover.jpg', 599, '2016-10-16 00:00:00', 1240, 4, 1),
(20, 'PS4', 'RPG', 'Dark Souls III', 'Pokračování dnes již legendární RPG série vám opět nedá nic zadarmo. Ať už jste nováček nebo Souls fanoušek, čeká vás jen to nejhorší. Opět se až po uši ponoříte do temného fantasy světa, okusíte nelítostnou krutost a ztratíte pojem o čase. To vše díky brutální, ale férové hratelnosti a ohromující grafice. Světy Dark Souls jsou vždy unikátním zážitkem, který jinde nenajdete. Ve třetím díle tomu nebude jinak a rádi se v jeho dechberoucích temných kulisách budete opakovaně ztrácet a umírat. Samotný soubojový systém se dočkal spousty zpestření a úprav, ale stále vychází ze základů Souls série. Každá chyba je tedy po zásluze potrestána. Těšit se však můžete na ještě pestřejší paletu zbraní a unikátní herní styly.V Dark Souls III se představí nová verze unikátního online režimu, který tato série založila. Režim souvisle integruje všechny hráče a jednotlivé interakce do příběhu pro jednoho hráče.Díky dynamickému nasvícení a dalším vizuálním efektům se zcela ponoříte do temného fantasy světa. Světa plného zákeřných nástrah a děsivých nepřátel, před kterými budete zavírat oči.', 'darksouls3.jpg', 1699, '2016-09-28 00:00:00', 4425, 0, 2),
(21, 'PS4', 'Sportovní', 'NHL 17', 'Prožijte svůj hokejový sen v nových režimech Draft šampionů a Světový pohár, podmaňte si led díky komplexnímu ovládání autenticky reagujících brankářů, zcela novému pojetí soubojů před brankou v útočné i obranné třetině a vylepšenému systému kolizní fyziky. Jednoduše ten nejlepší herní hokejový zážitek. To je NHL 17.Bez ohledu na způsob hraní vám NHL 17 nabízí nové režimy, v nichž si zahrajete za oblíbené týmy a hráče. V Draftu šampionů zažijte fiktivní draft, v němž si sestavíte tým plný hvězd, nebo na Světovém poháru zabojujte o národní čest. Fanoušci Be a GM se mohou těšit na evoluci ve správě týmu. Nově budete mít možnost dohlédnout na celý byznys v režimu Organizace, v němž vám připadne na starost vše od stánkového prodeje po přestěhování týmu. Pozvedněte svůj tým v EA SPORTS Hockey League na novou úroveň postupným odemykáním předmětů vlastní úpravy. Pomocí Editoru týmu pro EASHL a Be a Pro si upravte dresy k obrazu svému, nebo ve zcela novém Editoru stadionů v režimech EASHL a Organizace si vytvořte domácí halu, o které jste vždycky snili. Upravte si každičký detail od povrchu ledu přes gólové světlo a výsledkovou tabuli až po gólovou znělku a světelné efekty, které dodají šťávu důležitým momentům vašeho týmu.Hokejové zápasy se vyhrávají a prohrávají před brankou. Nový systém soubojů před brankou vám umožní porvat se o klíčový prostor v brankovišti, a to jak před vlastní, tak soupeřovou klecí. Brankáři působí autenticky díky svému vzhledu i chování doplněnému o realistické postoje a zásluhou dokonalejší umělé inteligence provádí lepší reflexivní zákroky – lépe čtou hru, a proto mohou zareagovat hbitým atletickým pohybem, nebo zablokovat puk tělem. Inovované hity, přihrávky, přebírání puku a bruslení vám dovolí získat navrch v každé části kluziště. ', 'ps4-nhl-17_ie1422763.jpg', 1799, '2016-10-15 00:00:00', 325, 10, 3),
(22, 'PS4', 'Strategie', 'Dungeons 2', 'Pán jeskyně se vrací – a tentokrát to myslí vážně! V Dungeons 2 uhasíte neukojitelnou žízeň Temného pána po pomstě a najmete si děsuplná nová monstra ze všech koutů podsvětí, aby vykonávala vaše zlé rozkazy. Převzít vládu nad podsvětím však nestačí – tentokrát Pán jeskyně rozšíří svou moc i na lidské červy a pokusí se ovládnout náš svět. Ujměte se role mocného Pána jeskyně a vybudujte síť jedinečných a hrůzostrašných jeskyní. Najměte si armádu strašlivých příšer a ovládněte dvě nové frakce. Připravte se na obranu svého království proti těm vlezlým hrdinům nebo vyjděte na povrch a veďte válku s jejich lidskými městy. Pomocí „Ruky hrůzy“ přímo ovládejte své poskoky, vydávejte rozkazy a nebojte se někoho pořádně proplesknout, aby sekal latinu. Rozsáhlá příběhová kampaň je nabita ještě temnějším humorem, který proslavil původní Dungeons. Navíc je opepřena řadou narážek na různé fantasy knihy, filmy a seriály. Své schopnosti můžete vyzkoušet ve čtyřech různých herních režimech až pro čtyři další Pány jeskyně přes LAN či online.', 'dungeons(1).jpg', 999, '2016-10-22 00:00:00', 123, 0, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_czech_ci NOT NULL,
  `joined` datetime NOT NULL,
  `user_email` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `joined`, `user_email`, `admin`) VALUES
(1, 'NoSkilzz', '$2y$12$Tkgw52Lb4pP1kJDxI5ta.eBcRUAdQ1Q0NElahc2a6OQRTuMAaWEgK', '2016-12-12 19:32:38', 'asdf@fdsv.com', 1),
(2, 'NoSkilz', '$2y$12$9/O/ogA2Jv/ED56iMqz/lurvNKrmpPVLLbXBr/Lhab4nCUUaGSiFa', '2017-02-22 11:25:48', 'abcd.abcd@abc.com', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_user_comments` (`user_id`),
  ADD KEY `fk_product_comments` (`product_id`);

--
-- Klíče pro tabulku `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Klíče pro tabulku `goods_order`
--
ALTER TABLE `goods_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_goods_order` (`user_id`);

--
-- Klíče pro tabulku `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `fk_goods_order_order_content` (`order_id`);

--
-- Klíče pro tabulku `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`platform_id`),
  ADD UNIQUE KEY `platform_name` (`platform_name`);

--
-- Klíče pro tabulku `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_platform_product` (`platform_name`),
  ADD KEY `fk_genre_product` (`genre_name`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `goods_order`
--
ALTER TABLE `goods_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `platform`
--
ALTER TABLE `platform`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_product_comments` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_comments` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `goods_order`
--
ALTER TABLE `goods_order`
  ADD CONSTRAINT `fk_user_goods_order` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `fk_goods_order_order_content` FOREIGN KEY (`order_id`) REFERENCES `goods_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_order_content` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_genre_product` FOREIGN KEY (`genre_name`) REFERENCES `genre` (`genre_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_platform_product` FOREIGN KEY (`platform_name`) REFERENCES `platform` (`platform_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
