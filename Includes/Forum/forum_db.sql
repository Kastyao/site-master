-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 08 2013 г., 16:24
-- Версия сервера: 5.1.66
-- Версия PHP: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `forum_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `global_theme`
--

CREATE TABLE IF NOT EXISTS `global_theme` (
  `id_global_theme` int(2) NOT NULL AUTO_INCREMENT,
  `name` char(40) COLLATE utf8_bin NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_global_theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `global_theme`
--

INSERT INTO `global_theme` (`id_global_theme`, `name`, `hidden`) VALUES
(1, 'Âîïðîñû ïî ôîðóìó', 0),
(2, 'Îôèöèàëüíûå âîïðîñû', 0),
(3, 'Èíñòèòóòû', 0),
(4, 'Òðóäîóñòðîéñòâó âûïóñêíèêîâ è ñòóäåíòîâ', 0),
(5, 'Òåõíè÷åñêèå âîïðîñû', 0),
(6, 'Îòäûõ è ðàçâëå÷åíèÿ', 0),
(7, 'Îáüÿâëåíèÿ', 0),
(14, 'Îáñóæäåíèå ïðîáëåì ôîðóìà', 1),
(15, 'Ïîæåëàíèÿ', 1),
(16, 'Îáñóæäåíèå ïîëüçîâàòåëåé', 1),
(17, 'Îáðàçîâàíèå', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub_theme` smallint(6) NOT NULL,
  `id_user` smallint(6) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `file` text COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=176 ;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id_message`, `id_sub_theme`, `id_user`, `text`, `file`, `data`) VALUES
(4, 8, 1, 'Ïðåäñòàâèòåëü Àðìèè îáîðîíû Èçðàèëÿ ñîîáùèë, ÷òî â ðåçóëüòàòå íàïàäåíèÿ íà Ôëîòèëèþ ñâîáîäû, íàïðàâëÿâøóþñÿ ñ ãóìàíèòàðíûì ãðóçîì â Ãàçó, ïîãèáëè 9 ÷åëîâåê.\r\n\r\nÎá ýòîì ñîîáùàåò AFP. \r\n\r\nÏî åãî ñëîâàì, ðàñïðîñòðàíåííûå ðàíåå ñîîáùåíèÿ î 10 èëè äàæå 19 ïîãèáøèõ áûëè îñíîâàíû íà íåâåðíîé èíôîðìàöèè. \r\n\r\nÏî äàííûì èíôîðìàãåíòñòâà, â õîäå îïåðàöèè ðàíåíû áûëè îò 20 äî 30 ÷åëîâåê, íàõîäèâøèõñÿ íà áîðòó ñóäîâ "ôëîòèëèè", à òàêæå ñåìåðî èçðàèëüñêèõ ñîëäàò, äâîå èç êîòîðûõ íàõîäÿòñÿ â òÿæåëîì ñîñòîÿíèè.\r\n\r\n  Èçðàèëüñêèå âîåííûå àòàêîâàëè ñóäíî ïðàâîçàùèòíèêîâ: äåñÿòü ÷åëîâåê ïîãèáëè \r\n Íàïîìíèì, ñåìü ñóäîâ ñ ïðàâîçàùèòíèêàìè è ãóìàíèòàðíûì ãðóçîì ïûòàëèñü ïðîðâàòüñÿ ê ñåêòîðó Ãàçà, êîòîðûé áëîêèðîâàí èçðàèëüñêèìè âîåííûì ñ òåõ ïîð, êàê ê âëàñòè òàì ïðèøëî ðàäèêàëüíîå äâèæåíèå ÕÀÌÀÑ. Â íî÷ü íà 31 ìàÿ èçðàèëüñêèé ñïåöíàç  âûñàäèëñÿ íà ñóäà Ôëîòèëèè; íà áîðòó òóðåöêîãî ñóäíà Ìàâè Ìàðìàðà áûë îòêðûò îãîíü. \r\n\r\nÈçðàèëü óòâåðæäàåò, ÷òî âîåííûå íà÷àëè ñòðåëÿòü ïîñëå òîãî, êàê âñòðåòèëè îæåñòî÷åííîå âîîðóæåííîå ñîïðîòèâëåíèå ñî ñòîðîíû íàõîäèâøèõñÿ òàì ëþäåé. \r\nÒóðöèÿ, ãåíñåê ÎÎÍ Ïàí Ãè Ìóí, ÌÈÄ ÐÔ è ïðåçèäåíò Ôðàíöèè Íèêîëÿ Ñàðêîçè îñóäèëè äåéñòâèÿ èçðàèëüñêèõ âîåííûõ. Ïðåìüåð Òóðöèè Ðåäæåï Òàéèï Ýðäîãàí ïîîáåùàë ñîçâàòü ýêñòðåííîå çàñåäàíèå ïðåäñòàâèòåëåé ÍÀÒÎ â ñâÿçè ñ íàïàäåíèåì Èçðàèëÿ íà ñóäà. Êðîìå òîãî, Òóðöèÿ îòîçâàëà ïîñëà èç Èçðàèëÿ.', '', '2010-06-01 01:01:23'),
(5, 9, 1, 'Ïðåçèäåíò Óêðàèíû Âèêòîð ßíóêîâè÷ íàçíà÷èë Àíäðåÿ Áåðåçíîãî ïîñëîì Óêðàèíû â Àâñòðèè, à Àëåêñàíäðà Êóï÷èøèíà ïîñëîì Óêðàèíû âî Ôðàíöèè.\r\n\r\nÑîîòâåòñòâóþùèå óêàçû ¹652/2010 è ¹653/2010 îò 31 ìàÿ ðàçìåùåíû íà îôèöèàëüíîé ìàéòå ãëàâû ãîñóäàðñòâà â ïîíåäåëüíèê.\r\n\r\nÁåðåçíîé çàíèìàë äîëæíîñòü çàììèíèñòðà ýêîíîìèêè ñ èþíÿ 2005 ãîäà ïî íîÿáðü 2006 ãîäà, äî ýòîãî ñ ñåíòÿáðÿ 2003 ãîäà îí áûë çàììèíèñòðà ýêîíîìèêè è ïî âîïðîñàì åâðîïåéñêîé èíòåãðàöèè. \r\n\r\nÐàíåå îí âîçãëàâëÿë òîðãîâî-ýêîíîìè÷åñêóþ ìèññèþ Óêðàèíû â Øâåéöàðèè.\r\n\r\nÊóï÷èøèí ñ ôåâðàëÿ 2008 ãîäà ðàáîòàåò çàìåñòèòåëåì ìèíèñòðà èíîñòðàííûõ äåë. \r\n\r\nÄî ýòîãî, ñ íîÿáðÿ 2005 ãîäà, îí çàíèìàë äîëæíîñòü ïîñëà Óêðàèíû â Íèäåðëàíäàõ.\r\n\r\nÊàê ñîîáùàëîñü, 12 ìàÿ ßíóêîâè÷ óâîëèë ðÿä ïîñëîâ è ïðåäñòàâèòåëåé Óêðàèíû â äðóãèõ ãîñóäàðñòâàõ ñ çàíèìàåìûõ äîëæíîñòåé, â ÷àñòíîñòè, ïîñëà Óêðàèíû â Àâñòðèè Åâãåíèÿ ×îðíîáðûâêî è ïîñëà Óêðàèíû âî Ôðàíöèè, Ìîíàêî è ïîñòîÿííîãî ïðåäñòàâèòåëÿ Óêðàèíû ïðè ÞÍÅÑÊÎ Êîíñòàíòèíà Òèìîøåíêî.', '', '2010-06-01 01:07:49'),
(7, 11, 1, 'Ïðî÷èòàë íåäàâíî ðîìàí ñèåé ïèñàòåëüíèöû..\r\n[u]"Îáüÿâëåíî óáèéñòâî"[/u] - âñåì ñîâåòóþ !!\r\nÏîñîâåòóéòå ÷òî òî åù¸ èç å¸ ïðîèçâåäåíèé..', '', '2010-06-01 01:13:32'),
(8, 12, 1, 'Ïðîäà¸òñÿ äèïëîìíàÿ ðàáîòà ïî ïðîãðàììèðîâàíèþ )', '', '2010-06-01 01:23:09'),
(9, 13, 1, 'Òðåáóåòñÿ ïîìîùü â íàïèñàíèè ñëîæíîé ïðîãðàììû..îòïèñûâàåòåñü êîãî èíòåðåñóåò', '', '2010-06-01 01:31:25'),
(10, 14, 1, 'Èãðà ïîõîæà íà Öåïî÷êó, íî íåìíîãî îòëè÷àåòñÿ..\r\n\r\nÏÐÀÂÈËÀ ÈÃÐÛ: \r\n1. Èãðàþùèé ïðåâðàùàåò ñóùåñòâèòåëüíîå èç ïîñëåäíåãî ñëîâîñî÷åòàíèÿ â ïðèëàãàòåëüíîå è ñîçäà¸ò íîâîå ñëîâîñî÷åòàíèå. \r\n2. Åñëè èç ñóùåñòâèòåëüíîãî ïîñëåäíåãî ñëîâîñî÷åòàíèÿ íåëüçÿ ñîçäàòü ïðèëàãàòåëüíîå (ïðèìåð: Ïîòåðÿííîå ïîðòìîíå), òî âìåñòî íåãî áåðåòñÿ ñèíîíèì (ïðèìåð: êîøåë¸ê - êîøåëüêîâûé ëîâ êîøåëüêîâûé ñåéíåð è ò.ï.).', '', '2010-06-01 01:32:07'),
(11, 15, 1, 'ÑÀÁÆ\r\n\r\n500$', '', '2010-06-01 01:32:38'),
(12, 9, 10, 'ñâåðøèëîñü :clap::clap:', '', '2010-06-01 02:06:59'),
(169, 112, 1, 'Âîññòàíîâëåíèå äàííûõ ñ íåèñïðàâíûõ æåñòêèõ äèñêîâ, ôëåøåê, CD, DVD, äèñêåò è ò. ï.\r\nÐåìîíò æåñòêèõ äèñêîâ. Äèàãíîñòèêà áåñïëàòíà.\r\nÂèòàëèé Ðîçèçíàíûé.\r\nÒåë.: 050-90-70-564, 495-785\r\nwww: [URL="http://rozik.od.ua"]http://rozik.od.ua[/URL]\r\ne-mail: rozik@homei.net.ua\r\nICQ: 406458378', '', '2010-06-26 13:04:29'),
(168, 111, 1, '[URL="http://bt.od.ua"]http://bt.od.ua[/URL] - îäåññêèé òîððåíò-òðåêåð', '', '2010-06-26 13:03:11'),
(170, 113, 1, 'À êàêèå ó êîãî ëþáèìûå ôèëüìû?', '', '2010-06-26 13:10:02'),
(149, 92, 1, '×èñëî æåðòâ îïîëçíåé è íàâîäíåíèé, âûçâàííûõ òðîïè÷åñêèì øòîðìîì Àãàòà â Öåíòðàëüíîé Àìåðèêå, äîñòèãëî ïî ìåíüøåé ìåðå 131 ÷åëîâåêà. \r\nÎá ýòîì ñîîáùàåò Associated Press. \r\n\r\nÑèëüíåå äðóãèõ ñòðàí ðåãèîíà ïîñòðàäàëà Ãâàòåìàëà. Çäåñü ïîãèáøèìè ÷èñëÿòñÿ 108 ÷åëîâåê, åùå 53 ïðîïàëè áåç âåñòè. Ïî ñëîâàì ïðåçèäåíòà ñòðàíû Àëüâàðî Êîëîìà, â íàñòîÿùåå âðåìÿ ìíîãèå ðàéîíû ñòðàíû ïîëíîñòüþ îòðåçàíû îò âíåøíåãî ìèðà. Ñïàñàòåëè ïûòàþòñÿ äîáðàòüñÿ òóäà ïî âîçäóõó, îäíàêî ýòîìó ïðåïÿòñòâóþò ïëîõèå ìåòåîóñëîâèÿ. \r\n\r\nÆåðòâàìè òðîïè÷åñêîãî øòîðìà Àãàòà ñòàëè îêîëî 90 ÷åëîâåê \r\nÏî èíôîðìàöèè êàíàëà CNN, 14 ÷åëîâåê òàêæå ÷èñëÿòñÿ ïîãèáøèìè â Ãîíäóðàñå. Ðàíåå òàêæå ñîîáùàëîñü î äåâÿòè æåðòâàõ íàâîäíåíèé â Ñàëüâàäîðå. \r\n\r\nÂ íåêîòîðûõ îáëàñòÿõ êîëè÷åñòâî âûïàâøèõ îñàäêîâ ïðåâûñèëî 100 ñàíòèìåòðîâ, ÷åãî íå ñëó÷àëîñü çäåñü ïîñëåäíèå 60 ëåò. Ñêîðîñòü âåòðà äîñòèãàëà 20 ìåòðîâ â ñåêóíäó (72 êèëîìåòðîâ â ÷àñ). \r\nØòîðì ñôîðìèðîâàëñÿ â ñóááîòó, 29 ìàÿ, íàä Òèõèì îêåàíîì è íà÷àë òåðÿòü ñèëó â ãîðàõ íà çàïàäå Ãâàòåìàëû â âîñêðåñåíüå âå÷åðîì. Òåì íå ìåíåå, ïî ïðîãíîçàì ñèíîïòèêîâ, ïðîëèâíûå äîæäè ìîãóò ïðîäëèòüñÿ åùå íåñêîëüêî äíåé. \r\n\r\nÐàíåå ñîîáùàëîñü î 90 ïîãèáøèõ.', '', '2010-06-22 12:23:52'),
(150, 92, 16, '[font face=''Courier''][font color=cadetblue]Óæàñíàÿ òðàãåäèÿ[/color][/font]', '', '2010-06-22 12:24:56'),
(173, 115, 1, 'Càíèòàðíî-ýïèäåìèîëîãè÷åñêàÿ ñëóæáà Îäåññêîé îáëàñòè â ñâÿçè ñ îñàäêàìè áîëüøîé èíòåíñèâíîñòè âðåìåííî çàêðûëà òðè ïëÿæà â Îäåññå.\r\n\r\nÎá ýòîì ñîîáùèëà â ñóááîòó çàìåñòèòåëü ãëàâíîãî ãîñóäàðñòâåííîãî ñàíèòàðíîãî âðà÷à Îäåññêîé îáëàñòè Íèíà Âåãåðæèíñêàÿ. \r\n\r\nÇàêðûòû, â ÷àñòíîñòè, ïëÿæè Àðêàäèÿ, 10 ñò. Áîëüøîãî Ôîíòàíà, 16 ñò. Áîëüøîãî Ôîíòàíà.\r\n\r\nÏî ñëîâàì Âåãåðæèíñêîé, â íî÷ü ñ 24 íà 25 èþíÿ, â ïðèáðåæíóþ çîíó ìîðÿ ñ òåððèòîðèè ãîðîäà ïî ëèâíåñòîêàì, âîçìîæíî, ïîïàëè ðàçëè÷íûå çàãðÿçíÿþùèå âåùåñòâà ñ òåððèòîðèè æèëîé çàñòðîéêè Îäåññû.\r\n\r\nÌîðñêîå âîäîïîëüçîâàíèå íà âûøåóïîìÿíóòûõ ïëÿæàõ áóäåò âîññòàíîâëåíî ïîñëå ïðîâåäåíèÿ ëàáîðàòîðíîãî àíàëèçà êà÷åñòâà âîäû.\r\n\r\nÍàïîìíèì, 24 èþíÿ ñîîáùàëîñü, ÷òî Ìèíèñòåðñòâî çäðàâîîõðàíåíèÿ Óêðàèíû ñîîáùèëî, ÷òî â þæíûõ îáëàñòÿõ ñòðàíû è â Êèåâå èç-çà íåñîîòâåòñòâèÿ ñàíèòàðíûì íîðìàì çàêðûòû áîëåå 300 ïëÿæåé.', '', '2010-06-27 11:54:48'),
(174, 116, 1, 'dsada da ', '', '2010-06-27 12:31:11');

-- --------------------------------------------------------

--
-- Структура таблицы `private_messages_inbox`
--

CREATE TABLE IF NOT EXISTS `private_messages_inbox` (
  `id_private_messages` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_send` int(11) NOT NULL,
  `id_user_get` int(11) NOT NULL,
  `theme` text COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  `read_` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_private_messages`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `private_messages_inbox`
--

INSERT INTO `private_messages_inbox` (`id_private_messages`, `id_user_send`, `id_user_get`, `theme`, `text`, `data`, `read_`) VALUES
(24, 1, 13, '222222222', 'asdadsasda', '2010-06-17 13:32:45', 1),
(34, 1, 16, 'Äîáðîãî âðåìåíè ñóòîê', 'Ïðèâåò', '2010-06-22 12:31:05', 1),
(35, 1, 16, 'Íóæíà òâîÿ ïîìîùü', 'Ïîìîãè ìíå', '2010-06-22 12:31:26', 0),
(36, 1, 13, 'Ìîäåðàòîð', 'Íå õîòåëè áû âû ñòàòü ìîäåðàòîðîì ?', '2010-06-22 12:31:59', 0),
(37, 1, 17, 'Áóãàãàøåíüêà', 'îëîëîëîë', '2010-06-26 13:15:50', 1),
(38, 1, 1, 'asd', '[b]asd[/b] [u]dsa dsa [/u]', '2010-06-27 12:02:12', 1),
(40, 1, 1, ' dsad sa', '[b]d sdsa da[/b] [URL="d sad sa"]d sa dsa[/URL]', '2010-06-27 12:06:19', 1),
(41, 1, 1, 'eqw v', 'wq qwb e', '2010-06-27 12:06:48', 1),
(42, 1, 1, 'eqw v', '[b]d sad sad asd[/b] [quote]d sad sa[/quote] :cry::cry::dance:', '2010-06-27 12:27:54', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `private_messages_outbox`
--

CREATE TABLE IF NOT EXISTS `private_messages_outbox` (
  `id_private_messages` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_send` int(11) NOT NULL,
  `id_user_get` int(11) NOT NULL,
  `theme` text COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  `read_` smallint(1) NOT NULL,
  PRIMARY KEY (`id_private_messages`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `private_messages_outbox`
--

INSERT INTO `private_messages_outbox` (`id_private_messages`, `id_user_send`, `id_user_get`, `theme`, `text`, `data`, `read_`) VALUES
(26, 13, 1, '123', '123', '2010-06-18 12:01:24', 1),
(27, 13, 1, '4444444', '44444', '2010-06-18 12:01:41', 1),
(28, 13, 1, 'aaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', '2010-06-18 12:04:44', 1),
(34, 1, 16, 'Íóæíà òâîÿ ïîìîùü', 'Ïîìîãè ìíå', '2010-06-22 12:31:26', 1),
(31, 13, 13, 'asd', 'asd', '2010-06-20 13:20:49', 1),
(33, 1, 16, 'Äîáðîãî âðåìåíè ñóòîê', 'Ïðèâåò', '2010-06-22 12:31:05', 1),
(35, 1, 13, 'Ìîäåðàòîð', 'Íå õîòåëè áû âû ñòàòü ìîäåðàòîðîì ?', '2010-06-22 12:31:59', 1),
(41, 1, 1, 'eqw v', '[b]d sad sad asd[/b] [quote]d sad sa[/quote] :cry::cry::dance:', '2010-06-27 12:27:54', 1),
(38, 1, 1, 'asd a', '[i]d sad as[/i] [quote]d sadsa [/quote] [b]dsa das [/b]', '2010-06-27 12:05:01', 1),
(39, 1, 1, ' dsad sa', '[b]d sdsa da[/b] [URL="d sad sa"]d sa dsa[/URL]', '2010-06-27 12:06:19', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reputation`
--

CREATE TABLE IF NOT EXISTS `reputation` (
  `id_reputation` int(5) NOT NULL AUTO_INCREMENT,
  `id_user_send_reputation` int(11) NOT NULL,
  `id_user_get_reputation` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `rep` smallint(2) NOT NULL,
  PRIMARY KEY (`id_reputation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `reputation`
--

INSERT INTO `reputation` (`id_reputation`, `id_user_send_reputation`, `id_user_get_reputation`, `id_message`, `comment`, `rep`) VALUES
(1, 15, 1, 5, 'Ñïàñèáî', 1),
(2, 13, 1, 7, 'papapa', 1),
(3, 15, 1, 7, 'a imenno da', 1),
(4, 1, 16, 175, '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `smiles`
--

CREATE TABLE IF NOT EXISTS `smiles` (
  `id_smile` tinyint(2) NOT NULL AUTO_INCREMENT,
  `smile` varchar(15) COLLATE utf8_bin NOT NULL,
  `dvoe` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_smile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=53 ;

--
-- Дамп данных таблицы `smiles`
--

INSERT INTO `smiles` (`id_smile`, `smile`, `dvoe`) VALUES
(1, '2funny.gif', ':2funny:'),
(2, 'afro.gif', ':afro:'),
(3, 'angel.gif', ':angel:'),
(4, 'azn.gif', ':azn:'),
(5, 'blush.gif', ':blush:'),
(6, 'cheesy.gif', ':cheesy:'),
(7, 'clap.gif', ':clap:'),
(8, 'claps.gif', ':claps:'),
(9, 'cool.gif', ':cool:'),
(10, 'cry.gif', ':cry:'),
(11, 'dance.gif', ':dance:'),
(12, 'dirol.gif', ':dirol:'),
(13, 'embarassed.gif', ':embarassed:'),
(14, 'evil.gif', ':evil:'),
(15, 'ext_crybaby.gif', ':ext_crybaby:'),
(16, 'ext_sleep.gif', ':ext_sleep:'),
(17, 'friends.gif', ':friends:'),
(18, 'frusty.gif', ':frusty:'),
(19, 'furious.gif', ':furious:'),
(20, 'g.gif', ':g:'),
(21, 'ges_bow.gif', ':ges_bow:'),
(22, 'grin.gif', ':grin:'),
(23, 'harhar.gif', ':harhar:'),
(24, 'helpsmilie.gif', ':helpsmilie:'),
(25, 'huh.gif', ':huh:'),
(26, 'icon_wink2.gif', ':icon_wink2:'),
(27, 'knuppel2.gif', ':knuppel2:'),
(28, 'laugh.gif', ':laugh:'),
(29, 'lips.gif', ':lips:'),
(30, 'lipsrsealed.gif', ':lipsrsealed:'),
(31, 'lol2.gif', ':lol2:'),
(32, 'mega_shok.gif', ':mega_shok:'),
(33, 'nea.gif', ':nea:'),
(34, 'nono.gif', ':nono:'),
(35, 'pardon.gif', ':pardon:'),
(36, 'respect.gif', ':respect:'),
(37, 'rofl.gif', ':rofl:'),
(38, 'rolleyes.gif', ':rolleyes:'),
(39, 'sad.gif', ':sad:'),
(40, 'search.gif', ':search:'),
(41, 'shok.gif', ':shok:'),
(42, 'smiley.gif', ':smiley:'),
(43, 'sorry.gif', ':sorry:'),
(44, 'thumbdown.gif', ':thumbdown:'),
(45, 'thumbsup.gif', ':thumbsup:'),
(46, 'tickedoff.gif', ':tickedoff:'),
(47, 'undecided.gif', ':undecided:'),
(48, 'v.gif', ':v:'),
(49, 'whistlio.gif', ':whistlio:'),
(50, 'wink.gif', ':wink:'),
(51, 'wub2.gif', ':wub2:'),
(52, 'yikes.gif', ':yikes:');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_theme`
--

CREATE TABLE IF NOT EXISTS `sub_theme` (
  `id_sub_theme` smallint(2) NOT NULL AUTO_INCREMENT,
  `id_theme` smallint(2) NOT NULL,
  `id_user` smallint(5) NOT NULL,
  `name` char(200) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  `watchings` int(5) NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `attached` smallint(1) NOT NULL,
  PRIMARY KEY (`id_sub_theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=117 ;

--
-- Дамп данных таблицы `sub_theme`
--

INSERT INTO `sub_theme` (`id_sub_theme`, `id_theme`, `id_user`, `name`, `data`, `watchings`, `locked`, `attached`) VALUES
(8, 1, 1, 'Èçðàèëü íàçâàë òî÷íîå ÷èñëî æåðòâ íàïàäåíèÿ íà Ôëîòèëèþ ñâîáîäû', '2010-06-01 01:01:14', 88, 0, 0),
(9, 2, 1, 'ßíóêîâè÷ íàçíà÷èë íîâûõ ïîñëîâ â Àâñòðèè è Ôðàíöèè', '2010-06-01 01:07:49', 17, 0, 0),
(11, 12, 1, 'Àãàòà Êðèñòè', '2010-06-01 01:13:32', 15, 0, 0),
(12, 17, 1, 'Ïðîäàì äèïëîì', '2010-06-01 01:23:09', 7, 0, 0),
(13, 25, 1, 'Íóæíà ïîìîùü', '2010-06-01 01:31:25', 5, 0, 0),
(14, 26, 1, 'Çàöåïèëèñü', '2010-06-01 01:32:07', 3, 0, 0),
(15, 31, 1, 'Ïðîäàì NOKIA 3310', '2010-06-01 01:32:38', 8, 0, 0),
(111, 22, 1, 'http://bt.od.ua - îäåññêèé òîððåíò-òðåêåð', '2010-06-26 13:02:44', 1, 0, 0),
(113, 27, 1, 'Ëþáèìûé ôèëüì', '2010-06-26 13:10:02', 4, 0, 0),
(112, 23, 1, 'Âîññòàíîâëåíèå äàííûõ â Îäåññå', '2010-06-26 13:04:29', 1, 0, 0),
(115, 3, 1, 'ÑÝÑ çàêðûëà òðè ïëÿæà â Îäåññå', '2010-06-27 11:54:48', 2, 0, 0),
(116, 4, 1, ' wdsad sad sa', '2010-06-27 12:31:11', 3, 0, 0),
(92, 1, 1, 'Òðîïè÷åñêèé øòîðì â Öåíòðàëüíîé Àìåðèêå óíåñ æèçíè áîëåå 130 ÷åëîâåê', '2010-06-22 12:23:52', 13, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` tinyint(2) NOT NULL AUTO_INCREMENT,
  `id_global_theme` tinyint(2) NOT NULL,
  `name` char(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=53 ;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id_theme`, `id_global_theme`, `name`) VALUES
(1, 1, 'Ïðàâèëà ôîðóìà'),
(2, 1, 'Íîâîñòè ôîðóìà'),
(3, 1, 'FAQ'),
(4, 1, 'Ïðåäëîæåíèÿ è çàìå÷àíèÿ'),
(12, 2, 'Âîïðîñû ê ðóêîâîäñòâó ÎÍÓ'),
(13, 2, 'Ïîñòóïëåíèå â íàø óíèâåðñèòåò'),
(14, 2, 'Àññîöèàöèÿ âûïóñêíèêîâ ÎÍÓ\r\n'),
(51, 17, 'Íîâîñòè ÎÍÓ'),
(50, 17, 'Äèñòàíöèîííîå îáðàçîâàíèå'),
(17, 3, 'ÈÌÝÌ'),
(18, 3, 'ÈÑÍ'),
(49, 17, 'Ñòàòüè'),
(20, 4, 'Âàêàíñèè äëÿ âûïóñêíèêîâ è ñòóäåíòîâ'),
(21, 4, 'Âîïðîñû òðóäîóñòðîéñòâà äëÿ âûïóñêíèêîâ'),
(22, 5, 'Òåõíè÷åñêàÿ ïîääåðæêà'),
(23, 5, 'Ïðîãðàììíîå îáåñïå÷åíèå'),
(24, 5, 'Æåëåçî'),
(25, 5, 'Ïðîãðàììèðîâàíèå'),
(26, 6, 'Ôîðóìíûå èãðû'),
(27, 6, 'Êèíî è âèäåî'),
(28, 6, 'Ìóçûêà'),
(29, 6, 'Þìîð'),
(52, 6, 'Îáùåíèå'),
(31, 7, 'Ìîáèëüíûå òåëåôîíû'),
(32, 7, 'Êíèãè, äèñêè, êàññåòû'),
(33, 7, 'Íåäâèæèìîñòü'),
(34, 7, 'Ìåáåëü è âñå äëÿ äîìà'),
(35, 7, 'Óñëóãè'),
(36, 7, 'Ðàáîòà'),
(46, 5, 'Ñàéòû è ïî÷òà ÎÍÓ'),
(48, 17, 'Àðìèÿ è óíèâåð'),
(47, 17, 'Ãðàíòû, ñòèïåíäèè, êîíêóðñû');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `login` char(20) COLLATE utf8_bin NOT NULL,
  `password` char(25) COLLATE utf8_bin NOT NULL,
  `admin` smallint(1) NOT NULL,
  `sex` char(10) COLLATE utf8_bin NOT NULL,
  `age` smallint(2) NOT NULL,
  `avatar` text COLLATE utf8_bin NOT NULL,
  `email` char(25) COLLATE utf8_bin NOT NULL,
  `icq` varchar(10) COLLATE utf8_bin NOT NULL,
  `themes` int(5) NOT NULL,
  `texts` int(7) NOT NULL,
  `status` char(20) COLLATE utf8_bin NOT NULL,
  `podpis` char(200) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `last_enter` datetime NOT NULL,
  `ban` smallint(1) NOT NULL DEFAULT '0',
  `online` smallint(1) NOT NULL DEFAULT '0',
  `reputation` mediumint(5) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `admin`, `sex`, `age`, `avatar`, `email`, `icq`, `themes`, `texts`, `status`, `podpis`, `date`, `last_enter`, `ban`, `online`, `reputation`) VALUES
(1, 'admin', '123', 1, 'Ìóæñêîé', 35, 'Penguins.jpg', 'asd@mail.ru', '12345', 102, 135, 'Ó÷àñòíèê', 'îò', '2010-05-25 11:53:48', '2013-05-08 16:14:04', 0, 1, 6),
(2, 'asd', 'ASD', 1, 'Ìóæñêîé', 12, 'Koala.jpg', 'asd@mail.ru', '123', 1, 8, 'Íîâè÷îê', '123', '2010-05-26 14:46:10', '2013-05-08 16:07:48', 0, 0, 6),
(3, 'qwer', 'qwe', 0, 'Ìóæñêîé', 12, 'default.jpg', 'qwe@qwe.ru', '', 2, 2, 'Íîâè÷îê', '', '2010-05-30 13:52:45', '2010-05-31 15:55:11', 0, 0, 6),
(4, '123', '123', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@asd.ru', '', 1, 1, 'Íîâè÷îê', '', '2010-05-30 13:54:22', '2010-05-30 13:54:22', 0, 0, 6),
(5, 'qwerty', '123', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@mail.ru', '', 2, 2, 'Íîâè÷îê', '', '2010-05-30 13:55:15', '2010-06-02 14:23:22', 0, 0, 6),
(7, 'xxx', 'xxx', 1, 'Ìóæñêîé', 12, 'default.jpg', 'xxx@xxx.ru', '', 1, 2, 'Íîâè÷îê', '', '2010-05-30 13:58:09', '2010-05-30 13:58:44', 0, 0, 6),
(8, 'www', 'www', 0, 'Ìóæñêîé', 12, 'Koala.jpg', 'www@mail.ru', '123', 3, 3, 'Íîâè÷îê', 'dsgfe fdgrthg', '2010-05-31 15:55:36', '2010-05-31 15:56:48', 0, 0, 6),
(9, 'aaaa', 'aaaaaa', 0, 'Ìóæñêîé', 21, 'Chrysanthemum.jpg', 'dsewre@mds.ru', '46556554', 2, 4, 'Íîâè÷îê', 'qqqqqqqqqqqqq', '2010-05-31 16:15:12', '2010-05-31 16:26:36', 0, 0, 6),
(10, 'patr', '123', 0, 'Ìóæñêîé', 19, 'default.jpg', 'fdfd@asd.ru', '4325675', 1, 2, 'Íîâè÷îê', '', '2010-06-01 02:06:30', '2010-06-01 02:53:00', 0, 0, 6),
(11, 'qwertyuiop', '1', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@mail.ru', '', 1, 1, 'Íîâè÷îê', '', '2010-06-01 12:26:20', '2010-06-01 12:26:20', 0, 0, 6),
(12, 'aaa', 'aaa', 0, 'Ìóæñêîé', 12, 'default.jpg', 'aaa@mail.ru', '', 1, 2, 'Íîâè÷îê', '', '2010-06-15 16:11:51', '2010-06-16 14:32:21', 0, 0, 6),
(13, 'wwww', 'wwwww', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@mail.ru', '', 4, 10, 'Íîâè÷îê', '', '2010-06-15 16:34:17', '2010-06-21 14:40:04', 0, 0, 6),
(14, 'asdf', 'asd', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@asd.ru', '', 0, 0, 'Íîâè÷îê', '', '2010-06-20 16:05:53', '2010-06-20 16:05:53', 0, 0, 6),
(15, 'baba', '123', 0, 'Ìóæñêîé', 12, 'default.jpg', 'ad@mail.ru', '', 0, 0, 'Íîâè÷îê', '', '2010-06-21 12:39:59', '2010-06-22 12:09:23', 0, 0, 6),
(16, 'Last', '123', 0, 'Ìóæñêîé', 12, 'default.jpg', 'asd@mail.ru', '', 1, 3, 'Íîâè÷îê', '', '2010-06-22 12:24:19', '2010-06-27 13:11:51', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `vote_answer`
--

CREATE TABLE IF NOT EXISTS `vote_answer` (
  `id_vote_answer` int(5) NOT NULL AUTO_INCREMENT,
  `id_vote_id_sub_theme` int(5) NOT NULL,
  `answer` char(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_vote_answer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `vote_answer`
--

INSERT INTO `vote_answer` (`id_vote_answer`, `id_vote_id_sub_theme`, `answer`) VALUES
(1, 2, 'Èñïàíèÿ'),
(2, 2, 'Èòàëèÿ'),
(3, 2, 'Áðàçèëèÿ'),
(4, 2, 'Ãåðìàíèÿ'),
(5, 3, 'dsfsd'),
(6, 3, 'f sdfs'),
(7, 4, '123'),
(8, 4, '123');

-- --------------------------------------------------------

--
-- Структура таблицы `vote_answer_user`
--

CREATE TABLE IF NOT EXISTS `vote_answer_user` (
  `id_vote_answer_user` int(5) NOT NULL AUTO_INCREMENT,
  `id_vote_answer` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  PRIMARY KEY (`id_vote_answer_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `vote_answer_user`
--

INSERT INTO `vote_answer_user` (`id_vote_answer_user`, `id_vote_answer`, `id_user`) VALUES
(1, 6, 1),
(2, 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `vote_id_sub_theme`
--

CREATE TABLE IF NOT EXISTS `vote_id_sub_theme` (
  `id_vote_id_sub_theme` int(5) NOT NULL AUTO_INCREMENT,
  `id_sub_theme` int(5) NOT NULL,
  `vote_name` char(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_vote_id_sub_theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `vote_id_sub_theme`
--

INSERT INTO `vote_id_sub_theme` (`id_vote_id_sub_theme`, `id_sub_theme`, `vote_name`) VALUES
(1, 97, '×åìïèîí ìèðà 2010 ?'),
(2, 98, '×åìïèîí 2010'),
(3, 105, 'f sdf ds');
