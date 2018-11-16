-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 16 nov 2018 om 11:38
-- Serverversie: 5.7.24-0ubuntu0.16.04.1
-- PHP-versie: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vlambeer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_billing_address`
--

CREATE TABLE `tbl_billing_address` (
  `billing_id` int(11) NOT NULL,
  `billing_firstname` varchar(50) DEFAULT NULL,
  `billing_lastname` varchar(50) DEFAULT NULL,
  `billing_streetname` varchar(50) DEFAULT NULL,
  `billing_housenumber` varchar(10) DEFAULT NULL,
  `billing_zipcode` varchar(12) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_country` varchar(100) DEFAULT NULL,
  `billing_state_or_province` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_billing_address`
--

INSERT INTO `tbl_billing_address` (`billing_id`, `billing_firstname`, `billing_lastname`, `billing_streetname`, `billing_housenumber`, `billing_zipcode`, `billing_city`, `billing_country`, `billing_state_or_province`) VALUES
(1, NULL, NULL, 'my second province', 'my second ', 'my second pr', 'my second province', 'my second province', 'my second province');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_cart_to_product`
--

CREATE TABLE `tbl_cart_to_product` (
  `fk_shopping_cart_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `fk_stock_size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_cart_to_product`
--

INSERT INTO `tbl_cart_to_product` (`fk_shopping_cart_id`, `fk_product_id`, `quantity`, `fk_stock_size`) VALUES
(5, 3, 2, 'L'),
(5, 3, 1, 'S'),
(9, 3, 1, 'L'),
(9, 3, 1, 'S'),
(10, 4, 1, 'M'),
(10, 4, 1, 'XL'),
(10, 4, 1, 'L'),
(10, 4, 1, 'S'),
(11, 4, 1, 'M'),
(11, 4, 2, 'L'),
(12, 5, 1, 'M'),
(13, 4, 1, 'XL'),
(14, 4, 1, 'L'),
(11, 4, 4, 'XL'),
(11, 4, 1, 'S'),
(15, 3, 2, 'L'),
(15, 3, 2, 'S'),
(16, 3, 4, 'S'),
(17, 3, 1, 'S'),
(18, 3, 1, 'L'),
(18, 5, 1, 'S'),
(18, 4, 1, 'S'),
(18, 3, 1, 'S'),
(18, 36, 3, 'SAA');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_forum`
--

CREATE TABLE `tbl_forum` (
  `forum_id` int(11) NOT NULL,
  `forum_name` varchar(255) NOT NULL,
  `forum_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_forum`
--

INSERT INTO `tbl_forum` (`forum_id`, `forum_name`, `forum_description`) VALUES
(0, 'Nuclear Throne', 'Some Descriptionfss'),
(1, 'Luftrausers', 'Some Description'),
(2, 'Gun Godz', 'Some Description'),
(3, 'Ridiculous Fishing', 'Some Description'),
(4, 'Serious Sam', 'Some Description'),
(5, 'Super Crate Box', 'Some Description'),
(6, 'Pics and Stuff', 'Some Description'),
(7, 'Off-Topic', 'Some Description');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_forum_moderator`
--

CREATE TABLE `tbl_forum_moderator` (
  `fk_forum_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_forum_moderator`
--

INSERT INTO `tbl_forum_moderator` (`fk_forum_id`, `fk_user_id`) VALUES
(3, 28),
(6, 28),
(7, 28);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `fk_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_vat_id` int(11) NOT NULL,
  `fk_billing_id` int(11) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `order_status` varchar(255) NOT NULL DEFAULT 'To be send',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `fk_user_id`, `fk_vat_id`, `fk_billing_id`, `paid`, `order_status`, `create_date`) VALUES
(1, 8, 1, NULL, 0, 'To be send', '2017-01-24 09:07:56'),
(2, 8, 1, NULL, 0, 'To be send', '2017-01-24 09:08:28'),
(3, 8, 1, NULL, 0, 'To be send', '2017-01-24 09:10:40'),
(4, 8, 1, NULL, 0, 'To be send', '2017-01-24 09:11:04'),
(5, 8, 1, NULL, 0, 'To be send', '2017-01-24 09:11:19'),
(6, 28, 1, NULL, 0, 'Has been send', '2017-01-24 10:40:55'),
(7, 28, 1, NULL, 0, 'Has arrived', '2017-01-24 10:47:15'),
(8, 28, 1, NULL, 0, 'To be send', '2017-01-24 10:54:07'),
(9, 8, 1, NULL, 0, 'To be send', '2017-01-25 09:54:39'),
(10, 8, 1, NULL, 0, 'To be send', '2017-01-25 10:02:38'),
(11, 8, 1, NULL, 0, 'To be send', '2017-01-25 10:09:14'),
(12, 8, 1, NULL, 0, 'To be send', '2017-01-26 08:39:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_order_to_product`
--

CREATE TABLE `tbl_order_to_product` (
  `quantity` int(100) NOT NULL,
  `fk_stock_size` varchar(255) NOT NULL,
  `fk_order_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_order_to_product`
--

INSERT INTO `tbl_order_to_product` (`quantity`, `fk_stock_size`, `fk_order_id`, `fk_product_id`) VALUES
(2, 'L', 1, 3),
(1, 'S', 1, 3),
(1, 'L', 2, 3),
(1, 'S', 2, 3),
(1, 'M', 3, 4),
(1, 'XL', 3, 4),
(1, 'L', 3, 4),
(1, 'S', 3, 4),
(1, 'M', 6, 5),
(1, 'XL', 7, 4),
(1, 'L', 8, 4),
(1, 'M', 9, 4),
(2, 'L', 9, 4),
(4, 'XL', 9, 4),
(1, 'S', 9, 4),
(2, 'L', 10, 3),
(2, 'S', 10, 3),
(4, 'S', 11, 3),
(1, 'S', 12, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int(11) NOT NULL,
  `post_message` text NOT NULL,
  `post_upvotes` int(255) DEFAULT '0',
  `post_date_created` date NOT NULL,
  `post_active` tinyint(1) NOT NULL DEFAULT '1',
  `fk_thread_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) NOT NULL,
  `reply_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_message`, `post_upvotes`, `post_date_created`, `post_active`, `fk_thread_id`, `fk_user_id`, `reply_id`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero.\r\n\r\nSed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Mauris massa. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum.\r\n\r\nNulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit.', 207, '2017-01-09', 1, 1, 11, NULL),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero.\r\n\r\nSed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Mauris massa. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum.\r\n\r\nNulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit.', 75, '2017-01-09', 1, 1, 8, NULL),
(3, 'Dit is een reply test post', 32, '2017-01-09', 1, 1, 10, 1),
(17, '<p>this post is very veryyy off-topic tbh</p>', 0, '0000-00-00', 0, 14, 8, NULL),
(18, '<p>Also a test thread.....</p>', 2, '0000-00-00', 1, 15, 28, NULL),
(19, '<p>k k k k k k k k k k k</p>', 1, '0000-00-00', 1, 16, 28, NULL),
(20, '<p>Jajajaja</p>', 0, '0000-00-00', 1, 17, 25, NULL),
(21, '<p>Dit is een Message</p>', 1, '0000-00-00', 1, 18, 29, NULL),
(22, '<p style="text-align: right;"><strong>ITS TRUE</strong></p>\r\n<p style="text-align: right;"><strong>XDDD</strong></p>\r\n<p style="text-align: right;"><em>yes good</em><strong></strong></p>', 0, '0000-00-00', 1, 19, 8, NULL),
(23, '<p style="text-align: justify;">JUSTIFYYYY</p>', 0, '2017-01-25', 0, 19, 8, NULL),
(24, '<p>&nbsp;kek</p>', 0, '2017-01-25', 1, 19, 8, NULL),
(25, '<p>kekkekekke</p>', 0, '2017-01-25', 1, 19, 8, NULL),
(26, '<p style="text-align: right;"><em><span style="text-decoration: underline;"><strong>Hallo hallo!</strong></span></em></p>', 0, '2017-01-25', 1, 15, 8, NULL),
(27, '<p>JEZUS ZEG</p>', 0, '0000-00-00', 0, 20, 8, NULL),
(28, '<p><em style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #222222; font-family: Helvetica, Arial, Verdana, sans-serif;">What the fuck did you just fucking say about me, you little bitch? I&rsquo;ll have you know I graduated top of my class in the Navy Seals, and I&rsquo;ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I&rsquo;m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the&nbsp;<span class="caps" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 1em; vertical-align: baseline; background: transparent;">USA</span>&nbsp;and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You&rsquo;re fucking dead, kid. I can be anywhere, anytime, and I can kill you in over seven hundred ways, and that&rsquo;s just with my bare hands. Not only am I extensively trained in unarmed combat, but I have access to the entire arsenal of the United States Marine Corps and I will use it to its full extent to wipe your miserable ass off the face of the continent, you little shit. If only you could have known what unholy retribution your little &ldquo;clever&rdquo; comment was about to bring down upon you, maybe you would have held your fucking tongue. But you couldn&rsquo;t, you didn&rsquo;t, and now you&rsquo;re paying the price, you goddamn idiot. I will shit fury all over you and you will drown in it. You&rsquo;re fucking dead, kiddo.</em></p>', 0, '0000-00-00', 0, 21, 8, NULL),
(29, '<h1><strong>What the fuck did you just fucking say about me, you little bitch? I&rsquo;ll have you know I graduated top of my class in the Navy Seals, and I&rsquo;ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I&rsquo;m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the&nbsp;<span class="caps" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 1em; vertical-align: baseline; background: transparent;">USA</span>&nbsp;and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You&rsquo;re fucking dead, kid. I can be anywhere, anytime, and I can kill you in over seven hundred ways, and that&rsquo;s just with my bare hands. Not only am I extensively trained in unarmed combat, but I have access to the entire arsenal of the United States Marine Corps and I will use it to its full extent to wipe your miserable ass off the face of the continent, you little shit. If only you could have known what unholy retribution your little &ldquo;clever&rdquo; comment was about to bring down upon you, maybe you would have held your fucking tongue. But you couldn&rsquo;t, you didn&rsquo;t, and now you&rsquo;re paying the price, you goddamn idiot. I will shit fury all over you and you will drown in it. You&rsquo;re fucking dead, kiddo.</strong></h1>', 0, '2017-01-26', 0, 21, 8, NULL),
(30, '<h1 style="box-sizing: border-box; padding: 0px; margin: 0.67em 0px; font-family: Joystix, sans-serif; font-weight: 500; line-height: 1.1; color: #333333; background-color: #f5f5f5;"><sup>What the </sup>fuck<sup> did you just <sub>fucking</sub> say about me, you little bitch? I&rsquo;ll have you know I graduated top of my class in the Navy Seals, and I&rsquo;ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I&rsquo;m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the&nbsp;<span class="caps" style="box-sizing: border-box; padding: 0px; margin: 0px; border: 0px; outline: 0px; font-size: 1em; vertical-align: baseline; background: transparent;">USA</span>&nbsp;and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You&rsquo;re </sup>fucking<sup> dead, kid. I can be anywhere, anytime, and I can kill you in over seven hundred ways, and that&rsquo;s just with my bare hands. Not only am I extensively trained in unarmed combat, but I have access to the entire arsenal of the United States Marine Corps and I will use it to its full extent to wipe your miserable ass off the face of the continent, you little shit. If only you could have known what unholy retribution your little &ldquo;clever&rdquo; comment was about to bring down upon you, maybe you would have held your fucking tongue. But you couldn&rsquo;t, you didn&rsquo;t, and now you&rsquo;re paying the price, you goddamn idiot. I will shit fury all over you and you will drown in it. You&rsquo;re fucking dead, kiddo.</sup></h1>', 0, '2017-01-26', 1, 21, 8, NULL),
(31, '<p>titel zegt alles</p>', 0, '0000-00-00', 1, 22, 8, NULL),
(32, '<p>echt man</p>', 0, '0000-00-00', 1, 23, 8, NULL),
(33, '<p><code>&lt;img src="https://i.imgur.com/j6f2HdB.jpg"&gt;</code></p>', 0, '0000-00-00', 1, 24, 8, NULL),
(34, '<p>Kan ik al reageren?</p>', 1, '2017-01-26', 1, 1, 8, NULL),
(35, '<p>Nou dan gaan we daar zeker wat aan doen?</p>\r\n<p>Want je kan bijvoorbeeld iets :</p>\r\n<p><strong>dik gedrukt maken</strong></p>\r\n<p><em>Iets schuin zetten</em></p>\r\n<p><span style="text-decoration: line-through;"><em>Striketrough</em></span></p>\r\n<p style="text-align: center;">Of zelfs tekst centreren</p>\r\n<p style="text-align: right;">Super handig toch?</p>\r\n<p style="text-align: left;">of zelfs een code snippet?</p>\r\n<p style="text-align: left;"><code>$(document).ready(function(){</code></p>\r\n<p style="text-align: left;"><code>alert("Hello World");</code></p>\r\n<p style="text-align: left;"><code>});</code></p>\r\n<p style="text-align: left;">Not sure tho</p>\r\n<p>&nbsp;</p>', 0, '2017-01-26', 1, 22, 8, NULL),
(36, '<p>REKT!</p>', 0, '2017-01-26', 1, 16, 30, NULL),
(37, '<p>bart valt op mannen</p>', 0, '2017-01-27', 1, 16, 8, NULL),
(38, '<p>Testerino</p>', 0, '2017-02-05', 1, 1, 8, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_post_rating`
--

CREATE TABLE `tbl_post_rating` (
  `rating_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_post_id` int(11) NOT NULL,
  `rating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_post_rating`
--

INSERT INTO `tbl_post_rating` (`rating_id`, `fk_user_id`, `fk_post_id`, `rating`) VALUES
(1, 8, 2, 1),
(2, 8, 3, 1),
(3, 8, 1, 1),
(4, 8, 2, 1),
(5, 8, 2, 1),
(6, 8, 2, 1),
(7, 8, 3, 1),
(8, 8, 3, 1),
(9, 8, 3, 1),
(10, 8, 3, 1),
(11, 8, 2, 1),
(12, 8, 2, 1),
(13, 8, 2, 1),
(14, 8, 1, 1),
(15, 8, 2, 1),
(16, 8, 2, 1),
(17, 11, 3, 2),
(18, 11, 2, 2),
(19, 28, 1, 1),
(20, 28, 2, 1),
(21, 28, 3, 2),
(22, 25, 18, 1),
(23, 8, 18, 1),
(24, 8, 21, 1),
(25, 30, 19, 1),
(26, 30, 1, 1),
(27, 30, 3, 1),
(28, 30, 34, 1),
(29, 30, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image_path` text NOT NULL,
  `product_description` text NOT NULL,
  `product_date_add` date NOT NULL,
  `product_is_active` tinyint(1) NOT NULL,
  `product_price` int(100) NOT NULL,
  `fk_sale_id` int(11) DEFAULT NULL,
  `fk_product_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_image_path`, `product_description`, `product_date_add`, `product_is_active`, `product_price`, `fk_sale_id`, `fk_product_cat_id`) VALUES
(3, 'Dancing Vlambeer', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/58870b2fa9a8d-585ce35e02f9b-dancing_vlambeer.jpg', '<p>Why is he dancing? I don&rsquo;t know! He is on fire. I&rsquo;d imagine it hurts. Games so hard that sometimes you might feel like you&rsquo;re on fire! Test</p>', '2016-12-23', 1, 40, NULL, 1),
(4, 'Vlambeer Shirt', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/585ce3c0f0af1-shirt.png', '<p>A so if you&rsquo;re a Vlambeer fan, why not proudly wear their iconic logo on your chest? Tell the world, you&rsquo;re a fan of indie gaming!</p>', '2016-12-23', 1, 40, 40, 1),
(5, 'Nuclear Throne Brown', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/585ce3f9326b0-nuc_brown.jpg', '<p>Support both Vlambeer and these struggling mutants by sporting a Nuclear Throne t-shirt, which has mutated into four different colors!</p>', '2016-12-23', 1, 20, NULL, 1),
(6, 'Nuclear Throne Blue', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/585ce4261403c-nuc_blue.jpg', 'Support both Vlambeer and these struggling mutants by sporting a Nuclear Throne t-shirt, which has mutated into four different colors!', '2016-12-23', 1, 40, NULL, 1),
(7, 'Nuclear Throne Red', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/585cf53c4a92f-nuc_red.jpg', 'Support both Vlambeer and these struggling mutants by sporting a Nuclear Throne t-shirt, which has mutated into four different colors!', '2016-12-23', 1, 40, NULL, 1),
(8, 'Nuclear Throne Yellow', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/585cf577349f0-nuc_yellow.jpg', 'Support both Vlambeer and these struggling mutants by sporting a Nuclear Throne t-shirt, which has mutated into four different colors!', '2016-12-23', 1, 40, NULL, 1),
(35, 'Test', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/5889d9d2a9897-logo.jpg', '<p>test</p>', '2017-01-09', 0, 12, NULL, 1),
(36, 'This is a test Produc', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/5874b1be4aa6b-1c5e38d9-676a-4639-9a73-049c65046fe7.jpg', '<p>Not really much</p>', '2017-01-10', 0, 120, NULL, 1),
(37, 'Terrorist monkey', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/5878be3481a40-richmonkey.jpg', '<p><strong>You\'ve been visited by "the terrorist monkey"</strong></p>\r\n<p>Upvote now or have your house bombed by ISIS</p>', '2017-01-13', 0, 420, NULL, 2),
(38, 'Terrorist monkey', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/5878be40465dc-richmonkey.jpg', '<p><strong>You\'ve been visited by "the terrorist monkey"</strong></p>\r\n<p>Upvote now or have your house bombed by ISIS</p>', '2017-01-13', 0, 420, NULL, 1),
(39, 'Terrorist monkey', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/5878bea611e5c-richmonkey.jpg', '<p><strong>You\'ve been visited by "the terrorist monkey"</strong></p>\r\n<p>Upvote now or have your house bombed by ISIS</p>', '2017-01-13', 0, 420, NULL, 1),
(40, 'new product', 'https://vlambeer.badge-webdevelopment.nl/public/img/product_img/587ca69be7138-arrow.png', '<p>new product</p>', '2017-01-16', 0, 666, NULL, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `product_cat_id` int(11) NOT NULL,
  `product_cat_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`product_cat_id`, `product_cat_desc`) VALUES
(1, 'Shirts'),
(2, 'Special bundles'),
(3, 'music'),
(4, 'Miscelanious');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `sale_id` int(11) NOT NULL,
  `sale_percentage` int(100) NOT NULL,
  `sale_image_path` text NOT NULL,
  `sale_date_start` date NOT NULL,
  `sale_date_end` date NOT NULL,
  `sale_date_add` date NOT NULL,
  `sale_is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_sale`
--

INSERT INTO `tbl_sale` (`sale_id`, `sale_percentage`, `sale_image_path`, `sale_date_start`, `sale_date_end`, `sale_date_add`, `sale_is_active`) VALUES
(9, 12, '', '2222-02-22', '2222-02-22', '2017-01-09', 0),
(10, 301, '', '2017-04-15', '2018-02-24', '2017-01-20', 0),
(40, 50, 'http://vlambeer.badge-webdevelopment.nl/public/img/sales_img/58871ddab43ef-slider_shirt.png', '2016-01-12', '2018-01-12', '2017-01-24', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_shopping_cart`
--

CREATE TABLE `tbl_shopping_cart` (
  `shopping_cat_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `shopping_cart_date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_shopping_cart`
--

INSERT INTO `tbl_shopping_cart` (`shopping_cat_id`, `fk_user_id`, `active`, `shopping_cart_date_created`) VALUES
(5, 8, 0, '2017-01-10'),
(6, 11, 0, '2017-01-11'),
(7, 11, 1, '2017-01-11'),
(8, 25, 1, '2017-01-12'),
(9, 8, 0, '2017-01-24'),
(10, 8, 0, '2017-01-24'),
(11, 8, 0, '2017-01-24'),
(12, 28, 0, '2017-01-24'),
(13, 28, 0, '2017-01-24'),
(14, 28, 0, '2017-01-24'),
(15, 8, 0, '2017-01-25'),
(16, 8, 0, '2017-01-25'),
(17, 8, 0, '2017-01-26'),
(18, 8, 1, '2017-02-01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_size` varchar(255) NOT NULL,
  `stock_active` tinyint(1) NOT NULL DEFAULT '1',
  `fk_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_quantity`, `stock_size`, `stock_active`, `fk_product_id`) VALUES
(25, 11, '12', 1, 35),
(26, 1201, 'SAA', 1, 36),
(27, 121, 'M', 1, 36),
(28, 124, 'L', 1, 36),
(29, 420, 'L', 1, 3),
(30, 420, 'S', 1, 3),
(31, 420, 'Big', 1, 37),
(32, 420, 'Small', 1, 37),
(33, 420, 'Big', 0, 38),
(34, 420, 'Big', 0, 39),
(35, 420, 'L', 0, 40),
(36, 2, 'A', 0, 3),
(37, 3, 'b', 0, 3),
(38, 123, 'S', 1, 4),
(39, 56, 'M', 1, 4),
(40, 71, 'L', 1, 4),
(41, 12, 'XL', 1, 4),
(42, 165, 'S', 1, 5),
(43, 76, 'M', 1, 5),
(44, 57, 'L', 1, 5),
(45, 165, 'S', 0, 5),
(46, 76, 'M', 0, 5),
(47, 57, 'L', 0, 5),
(48, 165, 'S', 0, 5),
(49, 76, 'M', 0, 5),
(50, 57, 'L', 0, 5),
(51, 165, 'S', 0, 5),
(52, 76, 'M', 0, 5),
(53, 57, 'L', 0, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_thread`
--

CREATE TABLE `tbl_thread` (
  `thread_id` int(11) NOT NULL,
  `thread_subject` varchar(255) NOT NULL,
  `thread_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `thread_active` tinyint(1) NOT NULL DEFAULT '1',
  `thread_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_user_id` int(11) NOT NULL,
  `fk_forum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_thread`
--

INSERT INTO `tbl_thread` (`thread_id`, `thread_subject`, `thread_sticky`, `thread_active`, `thread_date_created`, `fk_user_id`, `fk_forum_id`) VALUES
(1, 'Nuclear Throne Test Thread 1', 0, 1, '2017-01-08 23:00:00', 11, 0),
(12, 'Nuclear throne test thread 2', 0, 1, '2017-01-18 08:34:32', 10, 0),
(13, 'Nuclear throne test thread 3', 0, 1, '2017-01-18 08:35:20', 11, 0),
(14, '<p>My off-topic post</p>', 0, 0, '2017-01-24 09:41:40', 8, 7),
(15, '<p>Shitpost thread</p>', 0, 1, '2017-01-24 10:08:10', 28, 0),
(16, '<p>This thread needs more shitposts!</p>', 0, 1, '2017-01-24 10:14:13', 28, 0),
(17, '<p><strong></strong><strong>Jazeker</strong></p>', 0, 1, '2017-01-25 09:43:11', 25, 5),
(18, 'Dit is een Title', 0, 1, '2017-01-25 09:51:59', 29, 0),
(19, 'Niemand mag dit spel lol', 0, 1, '2017-01-25 11:13:12', 8, 2),
(20, 'Dit is REDICULOUS', 0, 1, '2017-01-26 07:46:06', 8, 3),
(21, 'this fucking site is fucking slow asfuck tbh', 0, 1, '2017-01-26 08:51:24', 8, 7),
(22, 'ff dit vullen zodat het er mooi uit ziet', 0, 1, '2017-01-26 09:12:34', 8, 1),
(23, 'jaja wwer zon post', 0, 1, '2017-01-26 09:12:56', 8, 4),
(24, 'hidfhod', 0, 1, '2017-01-26 09:15:46', 8, 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `profile_picture_path` text,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `join_date` date NOT NULL,
  `dob` date DEFAULT NULL,
  `phonenumber` varchar(50) DEFAULT NULL,
  `mobilenumber` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `streetname` varchar(50) DEFAULT NULL,
  `housenumber` varchar(10) DEFAULT NULL,
  `zipcode` varchar(12) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state_or_province` varchar(100) DEFAULT NULL,
  `user_gender` tinyint(1) DEFAULT NULL,
  `user_description` text,
  `fk_user_lvl_id` int(11) NOT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `has_newsletter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `profile_picture_path`, `password`, `firstname`, `lastname`, `join_date`, `dob`, `phonenumber`, `mobilenumber`, `email`, `streetname`, `housenumber`, `zipcode`, `city`, `country`, `state_or_province`, `user_gender`, `user_description`, `fk_user_lvl_id`, `is_banned`, `has_newsletter`) VALUES
(8, 'username', 'http://localhost/vlambeer/development/public/img/profile_img/5878a4f7a66bc-catlaptop.jpg', '$2y$10$773IeX7GFjgBorxCI/C4ju.T2XlPPBg/zkd24uP6kQ22cSW1rACP.', 'the on and only', NULL, '2017-01-01', '2017-01-05', '076 no', '06 my number', '2@2.2', 'street 1', 'house 2', 'zip4', 'city 666', 'Netherlands', 'brabant', 0, '<p style="text-align: right;">What the fuck did you just fucking say about me, you little bitch? I&rsquo;ll have you know I graduated top of my class in the Navy Seals, and I&rsquo;ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I&rsquo;m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the&nbsp;<span class="caps" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 1em; vertical-align: baseline; background: transparent;">USA</span>&nbsp;and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You&rsquo;re fucking dead, kid. I can be anywhere, anytime, and I can kill you in over seven hundred ways, and that&rsquo;s just with my bare hands. Not only am I extensively trained in unarmed combat, but I have access to the entire arsenal of the United States Marine Corps and I will use it to its full extent to wipe your miserable ass off the face of the continent, you little shit. If only you could have known what unholy retribution your little &ldquo;clever&rdquo; comment was about to bring down upon you, maybe you would have held your fucking tongue. But you couldn&rsquo;t, you didn&rsquo;t, and now you&rsquo;re paying the price, you goddamn idiot. I will shit fury all over you and you will drown in it. You&rsquo;re fucking dead, kiddo.</p>', 2, 0, 0),
(10, 'admin', 'http://i.imgur.com/rJTbG3n.png', '$2y$10$IWnkURf5R5lqInM7vXr3JeWqK1LwaWOQ62VxNqxGNr8QIRbW2bEuu', '', '', '0000-00-00', '0000-00-00', NULL, '', 'dennis.krijgsman@hotmail.com', '', '', '', '', '', '', 0, NULL, 2, 0, 0),
(11, 'timmie09', 'http://localhost/vlambeer/development/public/img/profile_img/5876015aa32d1-radiusLogo.png', '$2a$07$t9C9ycTT5VJQyh8I3pWhru6lMRj1nb2FNhv81wR5qZfemn.K5YAGe', '', '', '2016-08-17', '2010-10-11', '0606060606', 'werktdit', 'Werktdit@werktdit.com', 'werktdit', '12', 'werktdit', 'werktdit', 'Werkt dit?', 'werktdit', 1, '<p>Werkt dit?</p>', 2, 0, 0),
(24, 'axed', NULL, '$2y$10$CfwjpFf/tjfmi1ErOGY4Qu1KREly4jsW4klFWIOmnTzexL1RDM.le', '', '', '2017-01-12', '0000-00-00', NULL, '', 't.kleintijssink@gmail.com', '', '', '', '', '', '', 0, NULL, 1, 1, 0),
(25, 'JellevD', 'http://localhost/vlambeer/development/public/img/profile_img/5877646b8ec42-ik.jpg', '$2y$10$WXvaRZRzA2.xjc12R1i7f.PNq8h6PpuoXXCt1N1ZCadg/MEy3XbUW', '', '', '2017-01-12', '1995-06-10', '123456789', '123456789', 'osmjelle@live.nl', 'Crossssssssssstreet', '82 duizend', '3210RE', 'Japan', 'The Netherlands', 'Trololol', 0, '<h1>Hello!</h1>\r\n<p>&nbsp;</p>\r\n<p><strong>I&nbsp;<em>am&nbsp;</em></strong><em>Jelle&nbsp;</em>van&nbsp;<strong>D<em>i</em></strong><em>j</em>k</p>', 2, 0, 0),
(26, 'myUserName', NULL, '$2y$10$WJ.B7AFsOehOSqQ..pNYq.mu.nwd7PRAxqyJonJW.kW6Lw/4Iv3vC', 'my name', 'my last name', '2017-01-15', '0000-00-00', '06060606', '', 'myemail@hotmail.com', 'my street name', '39', '0675bv', 'my city', 'my country', 'my province', 1, NULL, 1, 1, 0),
(27, 'hallo', NULL, '$2y$10$rtlrNDQm2rQhq3HiMWx1vunN/N39C8xDCxYE29ED93AJpkkNQpmBu', '', '', '2017-01-16', '0000-00-00', NULL, '', 'hallo@hLLO', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(28, 'moderatortje123', 'http://localhost/vlambeer/development/public/img/profile_img/5887155b4493f-CrimsonChin.jpg', '$2y$10$dpbf1O8Ko.6mOWT7QTQILOIFl53vTo.Yqb/nXfM7mUPzr9QesI.Xm', 'Mod', 'Eratortje', '2017-01-23', '5555-08-10', '0612345678', '0612345678', 'moderator@moderator', 'dingetje', '12', '1111AA', 'Breda', 'Nederland', 'Noord-Brabant', NULL, '<p>Ik ben een moderatortjeeeeeee......</p>\r\n<p>&nbsp;</p>', 4, 0, 0),
(29, 'Duckz0r', NULL, '$2y$10$uphYTu5M.zQvqhaK/m1TJ.3RSkG55TkeZOJMQas1plJKUPLuza8Iu', NULL, NULL, '2017-01-25', NULL, NULL, NULL, 'D@s.nl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0),
(30, 'bardo', 'http://localhost/vlambeer/development/public/img/profile_img/5889de36b83a9-logo.jpg', '$2y$10$1DM7b84e8Zj/GwffEfFZP.b9DqvPQDPn5Sznf4DF/8j2mozLZeniG', '', '', '2017-01-26', '0000-00-00', '', '', 'bartdankmemes@hotmail.com', '', '', '', '', '', '', NULL, '', 1, 0, 0),
(31, 'testerinobambino', NULL, '$2y$10$c9nG4fOrbCbBaVH3a8iWiufkqo.SUm/.ogZWp7w9TbxBYUzhfqg.G', NULL, NULL, '2017-01-27', '2017-01-27', NULL, NULL, 'bart_de_geus@hotmail.com', NULL, NULL, NULL, NULL, 'Magdat?', NULL, 1, NULL, 1, 0, 0),
(32, 'bardonl', NULL, '$2y$10$D1U/OjtUw8ibkA5BcFLS4.bLwZ93NfgVL8j84um9SMqBR.3I0FlV6', NULL, NULL, '2018-10-01', '2018-10-01', NULL, NULL, 'test123@test123.123', NULL, NULL, NULL, NULL, 'Nederland', NULL, 1, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_user_lvl`
--

CREATE TABLE `tbl_user_lvl` (
  `user_lvl_id` int(11) NOT NULL,
  `user_lvl_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_user_lvl`
--

INSERT INTO `tbl_user_lvl` (`user_lvl_id`, `user_lvl_desc`) VALUES
(1, 'User'),
(2, 'Admin'),
(3, 'A god'),
(4, 'Moderator');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_vat`
--

CREATE TABLE `tbl_vat` (
  `vat_id` int(11) NOT NULL,
  `vat_percentage` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_vat`
--

INSERT INTO `tbl_vat` (`vat_id`, `vat_percentage`) VALUES
(1, 21);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbl_billing_address`
--
ALTER TABLE `tbl_billing_address`
  ADD PRIMARY KEY (`billing_id`),
  ADD UNIQUE KEY `billing_id_UNIQUE` (`billing_id`);

--
-- Indexen voor tabel `tbl_cart_to_product`
--
ALTER TABLE `tbl_cart_to_product`
  ADD KEY `fk_shopping_cart_id_idx` (`fk_shopping_cart_id`),
  ADD KEY `fk_product_id_idx` (`fk_product_id`),
  ADD KEY `fk_stock_size` (`fk_stock_size`);

--
-- Indexen voor tabel `tbl_forum`
--
ALTER TABLE `tbl_forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD UNIQUE KEY `idTBL_FORUM_UNIQUE` (`forum_id`);

--
-- Indexen voor tabel `tbl_forum_moderator`
--
ALTER TABLE `tbl_forum_moderator`
  ADD KEY `fk_forum_id` (`fk_forum_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexen voor tabel `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD UNIQUE KEY `invoice_id_UNIQUE` (`invoice_id`),
  ADD KEY `fk_order_id_idx` (`fk_order_id`);

--
-- Indexen voor tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  ADD KEY `fk_user_id_idx` (`fk_user_id`),
  ADD KEY `fk_vat_id_idx` (`fk_vat_id`),
  ADD KEY `fk_billing_id_idx` (`fk_billing_id`);

--
-- Indexen voor tabel `tbl_order_to_product`
--
ALTER TABLE `tbl_order_to_product`
  ADD KEY `fk_product_id_idx` (`fk_product_id`),
  ADD KEY `fk_order_id_idx` (`fk_order_id`),
  ADD KEY `fk_stock_size` (`fk_stock_size`);

--
-- Indexen voor tabel `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id_UNIQUE` (`post_id`),
  ADD KEY `fk_thread_id_idx` (`fk_thread_id`),
  ADD KEY `reply_id_idx` (`reply_id`),
  ADD KEY `fk_user_id_idx` (`fk_user_id`);

--
-- Indexen voor tabel `tbl_post_rating`
--
ALTER TABLE `tbl_post_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_user_id_idx` (`fk_user_id`),
  ADD KEY `fk_post_id_idx` (`fk_post_id`);

--
-- Indexen voor tabel `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id_UNIQUE` (`product_id`),
  ADD KEY `fk_product_cat_id_idx` (`fk_product_cat_id`),
  ADD KEY `fk_sale_id_idx` (`fk_sale_id`);

--
-- Indexen voor tabel `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`product_cat_id`),
  ADD UNIQUE KEY `product_cat_id_UNIQUE` (`product_cat_id`);

--
-- Indexen voor tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD UNIQUE KEY `sale_id_UNIQUE` (`sale_id`);

--
-- Indexen voor tabel `tbl_shopping_cart`
--
ALTER TABLE `tbl_shopping_cart`
  ADD PRIMARY KEY (`shopping_cat_id`),
  ADD UNIQUE KEY `shopping_cat_id_UNIQUE` (`shopping_cat_id`),
  ADD KEY `fk_user_id_idx` (`fk_user_id`);

--
-- Indexen voor tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD UNIQUE KEY `stock_id_UNIQUE` (`stock_id`),
  ADD KEY `fk_product_id_idx` (`fk_product_id`),
  ADD KEY `stock_size` (`stock_size`);

--
-- Indexen voor tabel `tbl_thread`
--
ALTER TABLE `tbl_thread`
  ADD PRIMARY KEY (`thread_id`),
  ADD UNIQUE KEY `thread_id_UNIQUE` (`thread_id`),
  ADD KEY `forum_id_idx` (`fk_forum_id`),
  ADD KEY `fk_user_id_idx` (`fk_user_id`);

--
-- Indexen voor tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_lvl_id_idx` (`fk_user_lvl_id`);

--
-- Indexen voor tabel `tbl_user_lvl`
--
ALTER TABLE `tbl_user_lvl`
  ADD PRIMARY KEY (`user_lvl_id`),
  ADD UNIQUE KEY `user_lvl_id_UNIQUE` (`user_lvl_id`);

--
-- Indexen voor tabel `tbl_vat`
--
ALTER TABLE `tbl_vat`
  ADD PRIMARY KEY (`vat_id`),
  ADD UNIQUE KEY `vat_id_UNIQUE` (`vat_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbl_billing_address`
--
ALTER TABLE `tbl_billing_address`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT voor een tabel `tbl_post_rating`
--
ALTER TABLE `tbl_post_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT voor een tabel `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT voor een tabel `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `product_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT voor een tabel `tbl_shopping_cart`
--
ALTER TABLE `tbl_shopping_cart`
  MODIFY `shopping_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT voor een tabel `tbl_thread`
--
ALTER TABLE `tbl_thread`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT voor een tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT voor een tabel `tbl_user_lvl`
--
ALTER TABLE `tbl_user_lvl`
  MODIFY `user_lvl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `tbl_vat`
--
ALTER TABLE `tbl_vat`
  MODIFY `vat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tbl_cart_to_product`
--
ALTER TABLE `tbl_cart_to_product`
  ADD CONSTRAINT `fk_ctp_shopping_cart_id` FOREIGN KEY (`fk_shopping_cart_id`) REFERENCES `tbl_shopping_cart` (`shopping_cat_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stock_size` FOREIGN KEY (`fk_stock_size`) REFERENCES `tbl_stock` (`stock_size`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product id` FOREIGN KEY (`fk_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `tbl_forum_moderator`
--
ALTER TABLE `tbl_forum_moderator`
  ADD CONSTRAINT `fk_forum_id` FOREIGN KEY (`fk_forum_id`) REFERENCES `tbl_forum` (`forum_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Beperkingen voor tabel `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `fk_invoice_order_id` FOREIGN KEY (`fk_order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_order_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vat_id` FOREIGN KEY (`fk_vat_id`) REFERENCES `tbl_vat` (`vat_id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `tbl_order_to_product`
--
ALTER TABLE `tbl_order_to_product`
  ADD CONSTRAINT `fk_otp_product_id` FOREIGN KEY (`fk_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `x_fk_stock_size` FOREIGN KEY (`fk_stock_size`) REFERENCES `tbl_stock` (`stock_size`);

--
-- Beperkingen voor tabel `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD CONSTRAINT `fk_post_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thread_id` FOREIGN KEY (`fk_thread_id`) REFERENCES `tbl_thread` (`thread_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `reply_id` FOREIGN KEY (`reply_id`) REFERENCES `tbl_post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_post_rating`
--
ALTER TABLE `tbl_post_rating`
  ADD CONSTRAINT `post_id_fk` FOREIGN KEY (`fk_post_id`) REFERENCES `tbl_post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_product_product_cat_id` FOREIGN KEY (`fk_product_cat_id`) REFERENCES `tbl_product_category` (`product_cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_sale_id` FOREIGN KEY (`fk_sale_id`) REFERENCES `tbl_sale` (`sale_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_shopping_cart`
--
ALTER TABLE `tbl_shopping_cart`
  ADD CONSTRAINT `fk_shoppingcart_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`fk_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_thread`
--
ALTER TABLE `tbl_thread`
  ADD CONSTRAINT `fk_thread_forum_id` FOREIGN KEY (`fk_forum_id`) REFERENCES `tbl_forum` (`forum_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thread_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_user_lvl_id` FOREIGN KEY (`fk_user_lvl_id`) REFERENCES `tbl_user_lvl` (`user_lvl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
