-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2016 at 11:32 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_twcnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_language`
--

CREATE TABLE IF NOT EXISTS `apps_language` (
  `apps_language_id` int(10) unsigned NOT NULL,
  `apps_language_name` varchar(32) NOT NULL,
  `apps_language_active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `apps_language_iso_code` char(2) NOT NULL,
  `apps_language_code` char(5) NOT NULL,
  `apps_language_date_format_lite` char(32) NOT NULL DEFAULT 'Y-m-d',
  `apps_language_date_format_full` char(32) NOT NULL DEFAULT 'Y-m-d H:i:s',
  `apps_language_is_rtl` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apps_language`
--

INSERT INTO `apps_language` (`apps_language_id`, `apps_language_name`, `apps_language_active`, `apps_language_iso_code`, `apps_language_code`, `apps_language_date_format_lite`, `apps_language_date_format_full`, `apps_language_is_rtl`) VALUES
(1, 'English (English)', 1, 'en', 'en-us', 'm/d/Y', 'm/d/Y H:i:s', 0),
(2, 'Indonesia (Indonesia)', 1, 'id', 'id-id', 'Y-m-d', 'Y-m-d H:i:s', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE IF NOT EXISTS `attributes` (
  `attribute_id` int(10) NOT NULL,
  `apps_language_id` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attribute_id`, `apps_language_id`, `name`) VALUES
(3, 1, 'Category'),
(6, 1, 'Color'),
(2, 1, 'Gender'),
(1, 1, 'Size'),
(4, 1, 'Type'),
(5, 1, 'Water Resistant');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE IF NOT EXISTS `attribute_value` (
  `attribute_value_id` int(10) NOT NULL,
  `apps_language_id` int(10) unsigned NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`attribute_value_id`, `apps_language_id`, `value`) VALUES
(1, 1, 'male'),
(2, 1, 'female'),
(3, 1, 'unisex'),
(4, 1, 'Silver'),
(5, 1, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value_combination`
--

CREATE TABLE IF NOT EXISTS `attribute_value_combination` (
  `attribute_value_combination_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_value_combination`
--

INSERT INTO `attribute_value_combination` (`attribute_value_combination_id`, `attribute_id`, `attribute_value_id`) VALUES
(1, 6, 4),
(2, 6, 5),
(3, 2, 1),
(4, 2, 2),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('create-user', '1', NULL),
('delete-user', '1', NULL),
('update-user', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('create-user', 1, 'allow create user', NULL, NULL, NULL, NULL),
('delete-user', 1, 'allow to delete user', NULL, NULL, NULL, NULL),
('update-user', 1, 'allow to update user', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(11) NOT NULL,
  `companies_company_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `companies_company_id`, `branch_name`, `branch_address`, `branch_created_date`, `branch_status`) VALUES
(1, 1, 'HEAD OFFICE', 'tulodong', '2015-09-20 19:24:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_description` text NOT NULL,
  `brand_country` varchar(50) NOT NULL,
  `brand_logo` text NOT NULL,
  `brand_logo_hover` text NOT NULL,
  `brand_created_date` datetime NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL,
  `brand_sequence` int(11) NOT NULL,
  `brand_featured` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_description`, `brand_country`, `brand_logo`, `brand_logo_hover`, `brand_created_date`, `brand_status`, `brand_sequence`, `brand_featured`) VALUES
(1, 'Aark Collective', 'First launched on February 2013, this very young brand from Melbourne, Australia is known as a timepiece company specializing in unique user-interface and clever function that will withstand the test of time. Aiming for perfect harmony between design, function, and aesthetic, each watch has a unique function of movements to balancing those three factors.', 'SWEDEN', '1.png', '', '2015-09-25 16:30:44', 'active', 1, 1),
(2, 'Daniel Wellington', 'The story behind Daniel Wellington begins with a trip half  way around the globe where Filip Tysander, the founder of Daniel Wellington, met an intriguing gentleman from the British Isles. He had an impeccable style and loved to wear his Rolexes an old weathered nato straps. His name? Daniel Wellington. Inspired by the beautiful mix of classic meets modern, Filip Tysander created this much loved collection with interchangeable nato straps and classic leather straps. Its versatility and unique look has appealed to both men and women internationally. ', '', '2.png', '', '2015-09-25 16:30:44', 'active', 2, 1),
(3, 'THE WATCH CO', 'Established in 2013, THE WATCH CO. was started with a passion for timepieces & an appreciation for creativity and good design. THE WATCH CO. is a multi-brand retail concept aiming to offer a unique selection of independent brands & contemporary designers. Aspiring to innovate & develop a model & provide collections that are unique & push the boundaries of what is deemed conventional in Indonesia.', '', '3.png', '', '2015-09-25 16:30:44', 'active', 3, 1),
(4, 'Braun', 'Braun clocks and watches are first released in 1971. The infamous German industrial designer, Dieter Rams and Deitrich Lubs were the mastermind behind the project; and, with their “Less But Better” design philosophy they produced a number of memorable products for Braun including some of the best travel alarm clocks around, over the last 40 years, Braun time pieces were characterized by their pure, highly functional and timeless design with no superfluous details: every feature directly reflects a function.', 'SWEDEN', '4.png', '', '2015-09-25 16:30:44', 'active', 4, 1),
(5, 'Eastpak', 'With roots in the US military, Eastpak is a lifestyle brand founded in Boston, USA, specializing in the design, development & manufacturing of bags, backpacks, travel gear and accessories.', '', '5.png', '', '2015-09-25 16:30:44', 'active', 5, 1),
(6, 'RAINS', 'RAINS was inspired by the rainy streets and surroundings the Danish capital, Copenhagen. In a combination of modern city life with all its diversity and colorfulness and the need for practical outerwear, RAINS was established as a new interpretation of the traditional raincoat. The modern individual’s need of combining style and function became the foundation, opening a whole a new world of perceiving rainy days as beautiful and inspiring. The mission of RAINS is to inspire and motivate one to explore positive outdoor moments in everyday life. ', '', '6.png', '', '2015-09-25 16:30:44', 'active', 6, 0),
(7, 'TSOVET', 'We’re obsessed by the details, so we started making watches that make a lasting impression. It is something we’ve been doing for a long time. Born and raised in California, we have lived in the geographical epicenter that has produced innovative designers and engineers from various creative fields. Their connection and creative contribution inspires us to explore innovative ways to engineer, develop and build better premium watches. We thrive on spending long days and sleepless nights thinking about every last detail in all aspects of our business. It’s all about creating products that are committed to the truth; we live what we make and we make what we live.\n\n', '', '7.png', '', '2015-09-25 16:30:44', 'active', 7, 0),
(8, 'VOID', 'VOID Watches is an independent boutique watch brand launched in 2008 as the single vision of Swedish designer David Ericsson. It has a unique take on watch design using simple yet expressive shapes, giving each watch an almost architectural expression. Just like a great building is designed to fit its environment, all VOID Watches are made to sit perfectly on your wrist. The design draws heavily on the Scandinavian design tradition using simple geometries and materials often founded in architecture.\n', '', '8.png', '', '2015-09-25 16:30:44', 'active', 8, 0),
(9, 'Hypergrand', 'Hypergrand is founded by Leroy Xavier Zhong, mechanical & aerospace engineer turned watches designer. Hypergrand’s products inherit Leroy’s clean industrial design and quality construct that exceed most fashion wares, and embraces the versatility and expressiveness of smart-casual street fashion. Hypergrand created the world’s first graphic art printed nato strap – creating pragmatic magic in the form of easily interchangeable watch straps laced with a variety of prints, monograms and art work.', '', '9.png', '', '2015-09-25 16:30:44', 'active', 9, 0),
(10, 'Autodromo', 'The world of AUTODROMO is the creative vision of founder Bradley Price, an industrial designer who set out to craft unique products that express the spirit of motoring. Autodromo’s design philosophy blends a contemporary, minimalist sensibility with mid-century vintage character. The resulting products are equally at home in past and present. Everything is designed in-house with a small, passionate team with the goal of creating a special, memorable experience for the discerning individual.', '', '10.png', '', '2015-09-25 16:30:44', 'active', 10, 0),
(11, 'AIAIAI', 'AIAIAI is an audio design company dedicated to developing high quality audio products for everyday use. AIAIAI’s modern, minimalist headphones and earphones deliver clear, amplified sound. Headquartered in Copenhagen, AIAIAI is proud to contribute to Denmark’s worldwide reputation as leader in acoustic and electro-acoustic design and engineering. Informed by a heritage of Scandinavian design, AIAIAI strives to create high quality, accessible audio products that deliver value far beyond trend-driven aesthetics.', '', '11.png', '', '2015-09-25 16:30:44', 'active', 11, 0),
(12, 'HARD GRAFT', 'Founded in 2007 by designers Monie.Ka and James Teal. Hard Graft was born in Austria and raised in London with an ambitious worldwide outlook. Clever, thoughtful and unexpected designs are carefully developed and mastered. Juxtaposing new ideas with skilled workmanship utilizing rich, premium and highly resourceful materials. Luxury goods balancing the traditional and the contemporary, while always changing but holding onto the good. “Live as dreamers who believe in the great.”\n<br>\nAtelier Collection\nThe Hard Graft atelier collection is the deep story of traditional Italian artisanal leather mastery employing contemporary aesthetics.\n', '', '12.png', '', '2015-09-25 16:30:44', 'active', 12, 0),
(13, 'Bulbul', 'Bulbul is a contemporary Danish watch brand, which was launched in Copenhagen, 2013 by entrepreneur and globetrotter Jacob Juul. Bulbul works with cherry picked creatives that represents the best of today’s generation of designers. Bulbul strives to merge cool Copenhagen creativity with industry craftsmanship, high quality materials, and extraordinary aesthetics.', '', '13.png', '', '2015-09-25 16:30:44', 'active', 13, 0),
(14, 'LIMA', 'Lima is a design studio based in Indonesia specializing in creating natural & simple lifestyle products. Lima watch is the first product launched by the small design studio.\n\nLima watch was made with a simple philosophy in the mind of the designer, "Adding value to a small piece of wood with good design".\n', '', '14.png', '', '2015-09-25 16:30:44', 'active', 14, 0),
(15, 'QWSTION', 'Based in Switzerland, QWSTION is a brand that was launched to bridge the gap between “Functional sports bags and elegant fashion bags”. Today, the label creates stylish storage solutions for modern lifestyles and each of its bags were intended for everyday use by independent, creative individuals. ', '', '16.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(16, 'TRIWA', 'TRIWA is a young and independent watch and accessory brand. All their designs are developed in their designs are developed in their Stockholm-based creative studio, where the city and its people are the main influences when it comes to the seasonal collections.\n\nThrough a mixture of Swedish contemporary design and classic silhouettes, TRIWA create the watches and accessories with the finest details and materials. \n', '', '17.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(17, 'YSTUDIO', 'YSTUDIO is from Taiwan, founded in 2012. YSTUDIO explores a vanishing culture, devoting themselves to linking past memories and modern life, making fine artifacts for whoever is serious with their life. With a strong belief and value in the simplicity of design, their products are created for people to use in their daily life and feel the beauty of objects. \n', '', '18.png', '', '2015-09-25 16:30:44', 'active', 15, 0),
(18, 'FROM TINY ISLANDS', 'From Tiny Islands compiles tales of wondrous lands, speaks of solitude and freedom, deem precious those that other might not, value those that others may dismiss.\n\nEstablished in 2013, from tiny islands is an independent Indonesian jewelry brand born from the vision of two friends who share a common interest in compiling things from around the world. Their journey is expressed through the creation of ingenious, quality-made jewelry. Our creations are inspired by a lust for life. They are meant to remind you of the beauty of the immaterial. They are a keepsake that we hope would compel you to undertake your own journey and write your own story.\n', '', '20.png', '', '2015-09-25 16:30:44', 'active', 16, 0),
(19, 'B MAGAZINE', 'B is an ad-less monthly publication that introduces one well-balanced brand unearthed from around the globe in each issue. Between its covers, B not only shares untold stories behind the brand but also its sentiment and culture that any readers interested in brand marketing and management can leaf through with ease.', '', '22.png', '', '2015-09-25 16:30:44', 'active', 17, 0),
(20, 'SUNDAY SOMEWHERE', 'Sunday Somewhere is a Sydney-based eyewear brand founded by Dave Allison in 2010. The brand philosophy is simple. Each model is beautifully crafted, classic and modern. It is focused upon detail, quality, simplicity and originality. \n\nSunday Somewhere''s aesthetic is influenced by both the past and future. With references to classic vintage frames, intricate modern detailing and futuristic materials, the finish is practical, a wearable modernity. This ''classic with a twist'' collection makes Sunday Somewhere fresh, covetable, timeless.\n', '', '23.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(21, 'ALA CHAMP', 'Ala Champ magazine is a bi-monthly, bilingual, graphic & image based journal created to inform and inspire a creative culture.\n\nPassionate about originality, being unique and independent, each issue of champ features emerging talent and those established in the international art, design, photography, and style communities.\n', '', '26.png', '', '2015-09-25 16:30:44', 'active', 18, 0),
(22, 'KITMEN KEUNG', 'Aiming at producing industrial works that are niche and come in a limited quantity each season, Kitmen Keung proposes designs that cater to the individual seeking for fineness and distinctiveness. Each piece of work is a result of careful attention to details, production technique and the overall composition of design, which harmoniously blend the archetypal imagery of contemporary habitations and the fine cultivation of moderate designs. ', '', '27.png', '', '2015-09-25 16:30:44', 'active', 19, 0),
(23, 'HYPEBEAST', 'HYPEBEAST magazine is a publication dedicated to today’s lifestyle and fashion landscape. Promoting developments in fashion, arts and design, HYPEBEAST is a premier magazine for cultural enthusiasts, tastemakers & influencers alike.', '', '28.png', '', '2015-09-25 16:30:44', 'inactive', 23, 0),
(24, 'CEREAL MAGAZINE', 'Cereal Magazine, a bi-annual culture, travel and lifestyle publication divided into city-specific chapters, focusing on places, people, products and photography.', '', '29.png', '', '2015-09-25 16:30:44', 'active', 20, 0),
(25, 'BELLROY', 'Sharing their first product in 2010, Bellroy exists to slim your wallet, creating products that are elegant, functional and delightful to use. Bellroy are constantly learning and continually improving the solutions and insights they share to help you move effortlessly between your worlds.', '', '30.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(26, 'UNIFORM WARES', 'Uniform Wares is a British design and engineering. Each Uniform Wares timepiece is a carefully balanced exercise exploring the relationships between engineering, aesthetics, function, material choice and surface finish.', '', '31.png', '', '2015-09-25 16:30:44', 'active', 21, 0),
(27, 'PHASE X VOYEJ', 'Phase is the new endeavor of PT KAMI GAWI BERJAYA, the collective behind The Watch Co. a new development where we are aiming to focus on product design and the lifestyle market. We strive to innovative and develop model that is unique and pushes the boundaries of what is deemed conventional in Indonesia. We believe in supporting the local creative and innovators, the originators, the small players and the start-ups. Phase is a journal undertaken with ideals and dreams of seeking knowledge and experience, a collaborative endeavor, an experiment of exploration, design and learning. Born of the vision to expand horizons and to connect and create a community sharing the same lovers, interest and passions.\n<br><br>\nFor the first ever collection, phase collaborated with VOYEJ, local purveyors of leather goods. Combining our collective minds to create two articles which directly reflect the ideology of both brands: Argus – a sleekly design compact wallet, and Ault – a nato leather watch strap.\n', '', '32.png', '', '2015-09-25 16:30:44', 'active', 22, 0),
(28, 'KINFOLK', 'Founded in 2011, Kinfolk is a lifestyle magazine published quarterly by Ouur that explores ways for readers to simplify their lives, cultivate community and spend more time with friends and family.', '', '33.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(29, 'HYPETRAK', 'HYPETRAK magazine as a publication serves to capture the cultural dynamism of the music industry around the world. Music, the way of life with its creativity and vibrancy.', '', '34.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(30, 'SUPER', 'SUPER by RETROSUPERFUTURE is leading brand producing outstanding contemporary eyewear. Founded in Italy in 2007 by Daniel Beckerman, super has become highly popular for its eclectic collection of colorful acetate sunglasses.', '', '35.png', '', '2015-09-25 16:30:44', 'inactive', 0, 0),
(31, 'SQUARESTREET', 'Founded in 2010 in Stockholm, Sweden, SQUARESTREET designs and develops elegant, contemporary timepieces with one foot in minimalist modernity elegant, contemporary timepieces with one foot in minimalist modernity and the other firmly rooted in traditional wristwatch aesthetics.\n\nAll SQUARESTREET products carry a distinctly Scandinavian touch with a certain cleanness and sharpness that only comes when material, color and cut intersect perfectly. Curated goods made from meticulously selected material and developed with a blend of innovation and tradition.\n\nSQUARESTREET does not follow, nor does it lead, instead it lives by its of laws of simplicity, functionality and beauty.', '', '36.png', '', '2015-09-25 16:30:44', 'active', 23, 0),
(32, 'BY N', 'Borne of the desire to make everyday objects just a little easier to use, and design that delights just by looking at it, BY N create answers to the needs that arise naturally in everyday life. With the aim to put a bit of surprise into the emotions that we all encounter during interactions with everyday objects, BY N hopes to be a brand that can find its way into being included in all aspects of daily life.', '', '37.png', '', '2015-09-25 16:30:44', 'active', 24, 0),
(33, 'DESIGN HOUSE STOCKHOLM', 'Founded by Anders Fardig, Design House Stockholm started as creative product development company for other brands in 1992. The Design House Stockholm product collection was launched in 1997.', '', '38.png', '', '2015-09-25 16:30:44', 'active', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands_banner`
--

CREATE TABLE IF NOT EXISTS `brands_banner` (
  `brand_banner_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL,
  `brand_banner_small_banner` text,
  `brand_banner_filename` text NOT NULL,
  `brand_banner_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands_banner`
--

INSERT INTO `brands_banner` (`brand_banner_id`, `brands_brand_id`, `brand_banner_small_banner`, `brand_banner_filename`, `brand_banner_status`) VALUES
(2, 1, 'watches.png', 'AARK.jpg', 'Active'),
(3, 2, 'watches.png', 'DW.jpg', 'Active'),
(4, 3, 'watches.png', 'TWC.jpg', 'Active'),
(5, 4, 'watches.png', 'BRAUN.jpg', 'Active'),
(6, 5, 'watches.png', 'EASTPAK.jpg', 'Active'),
(7, 6, 'watches.png', 'RAINS.jpg', 'Active'),
(8, 7, 'watches.png', 'TSOVET.jpg', 'Active'),
(9, 8, 'watches.png', 'VOID.jpg', 'Active'),
(10, 9, 'watches.png', 'HYPER.png', 'Active'),
(11, 10, 'watches.png', 'AUTODROMO.jpg', 'Active'),
(12, 11, 'watches.png', 'AIAIAI.jpg', 'Active'),
(13, 12, 'watches.png', 'HARDGRAFT.jpg', 'Active'),
(14, 13, 'watches.png', 'BULBUL.jpg', 'Active'),
(15, 14, 'watches.png', 'LIMA.jpg', 'Active'),
(16, 15, 'watches.png', 'QWSTION.jpg', 'Active'),
(17, 16, 'watches.png', 'TRIWA.jpg', 'Active'),
(18, 17, 'watches.png', 'YSTUDIO.jpg', 'Active'),
(19, 18, 'watches.png', 'FTI.jpg', 'Active'),
(20, 19, 'watches.png', 'B.jpg', 'Active'),
(21, 20, 'watches.png', 'SUNDAY.jpg', 'Active'),
(22, 21, 'watches.png', 'CHAMP.jpg', 'Active'),
(23, 22, 'watches.png', 'KITMEN.jpg', 'Active'),
(24, 23, 'watches.png', 'HYPEBEAST.jpg', 'Active'),
(25, 24, 'watches.png', 'CEREAL.jpg', 'Active'),
(26, 25, 'watches.png', 'BELLROY.jpg', 'Active'),
(27, 26, 'watches.png', 'UNIFORM-WARES.jpg', 'Active'),
(28, 27, 'watches.png', 'PHASE.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `brands_banner_detail`
--

CREATE TABLE IF NOT EXISTS `brands_banner_detail` (
  `brands_banner_detail_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL,
  `brands_banner_detail_slide_image` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands_banner_detail`
--

INSERT INTO `brands_banner_detail` (`brands_banner_detail_id`, `brands_brand_id`, `brands_banner_detail_slide_image`) VALUES
(3, 1, 'bellroy-3.jpg'),
(4, 1, 'bellroy-2.jpg'),
(5, 4, 'bellroy-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `brands_collection`
--

CREATE TABLE IF NOT EXISTS `brands_collection` (
  `brands_collection_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL,
  `brands_collection_name` varchar(50) NOT NULL,
  `brands_collection_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands_collection`
--

INSERT INTO `brands_collection` (`brands_collection_id`, `brands_brand_id`, `brands_collection_name`, `brands_collection_status`) VALUES
(1, 1, 'TIDE', 1),
(2, 1, 'SHELL', 1),
(3, 2, 'CLASSIC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL,
  `id_parent` int(10) unsigned NOT NULL,
  `level_depth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `is_root_category` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `id_parent`, `level_depth`, `active`, `date_created`, `date_updated`, `position`, `is_root_category`) VALUES
(1, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(2, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(3, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(4, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(5, 2, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(6, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_detail`
--

CREATE TABLE IF NOT EXISTS `category_detail` (
  `category_id` int(10) unsigned NOT NULL,
  `apps_language_id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `link_rewrite` varchar(128) NOT NULL,
  `meta_title` varchar(128) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_detail`
--

INSERT INTO `category_detail` (`category_id`, `apps_language_id`, `name`, `description`, `link_rewrite`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 1, 'MEN', NULL, 'men', NULL, NULL, NULL),
(2, 1, 'WOMEN', NULL, 'women', NULL, NULL, NULL),
(3, 1, 'UNISEX', NULL, 'unisex', NULL, NULL, NULL),
(4, 1, 'WATCHES', NULL, 'watches', NULL, NULL, NULL),
(5, 1, 'WATCHES', NULL, 'watches', NULL, NULL, NULL),
(6, 1, 'WATCHES', NULL, 'watches', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `company_about` text NOT NULL,
  `company_profile` text NOT NULL,
  `company_phone` varchar(15) NOT NULL,
  `company_logo` text NOT NULL,
  `company_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `company_email`, `company_address`, `company_about`, `company_profile`, `company_phone`, `company_logo`, `company_created_date`, `company_status`) VALUES
(2, 'PT KAMI GAWI BERJAYA', 'mail@kgbgroup.co.id', 'tulodong bawah 4 lama kebayoran baru', '', '', '02155445', '20150925_a35ff5ec3acebfa5ee6e109d61b1710e.jpg', '2015-09-25 15:12:03', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE IF NOT EXISTS `departements` (
  `departement_id` int(11) NOT NULL,
  `departement_name` varchar(50) NOT NULL,
  `branches_branch_id` int(11) NOT NULL,
  `companies_company_id` int(11) NOT NULL,
  `departement_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `departement_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`departement_id`, `departement_name`, `branches_branch_id`, `companies_company_id`, `departement_created_date`, `departement_status`) VALUES
(1, 'IT', 1, 2, '2015-09-20 19:25:08', 'active'),
(2, 'Marketing', 1, 2, '2016-01-12 16:13:59', 'active'),
(3, 'Finance', 1, 2, '2016-01-13 09:28:38', 'active'),
(4, 'Design', 1, 2, '2016-01-13 10:54:49', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `director_id` int(11) NOT NULL,
  `director_name` varchar(50) NOT NULL,
  `director_photo1` text NOT NULL,
  `director_photo2` text NOT NULL,
  `director_short_description` text NOT NULL,
  `director_long_description` text NOT NULL,
  `director_status` enum('Active','Inactive') NOT NULL,
  `director_sequence` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`director_id`, `director_name`, `director_photo1`, `director_photo2`, `director_short_description`, `director_long_description`, `director_status`, `director_sequence`) VALUES
(1, 'TEDDY KOENTJORO', 'd1.jpg', 'i1.jpg', '<p>Ted is an experimenter, a forward thinker with a sense of vision that looks towards the future and outside the norm. His secondary education was undertaken in both Singapore and Beijing, China.</p>', '<p>Ted is an experimenter, a forward thinker with a sense of vision that looks towards the future and outside the norm. His secondary education was undertaken in both Singapore and Beijing, China.\n<br><br>\nTed&rsquo;s tertiary education was completed at the Swiss German University where he majored in Business. Following the completion of his studies, Ted has then gone to excel in a range of industries and fields, from 2008 he has held the position of Director at PT. Intraco Lestari, a contracting and construction company based in Jakarta; he is also Co-Founder and Managing Director of The Watch Co.; CEO and Founder of PT. Kami Gawi Berjaya; and in 2015 he became Partner in the establishment of PT. Indonesia Digital Masa.\n<br><br>\nAt PT KGB, Ted is responsible for business development and overseeing the entire operations of the company. His personal interests include music, design, art, technology, philosophy and business entrepreneurship.&nbsp;</p>\n', 'Active', 1),
(2, 'ERICK SUSANTO', 'd3.jpg', 'i3.jpg', '<p>Erick is a Dependable, responsible and logical individual who brings a sense of rationality to the operations of PT KGB. Erick undertook his tertiary education at the Beijing Language and Culture University (BLCU)</p>', 'Erick is a Dependable, responsible and logical individual who brings a sense of rationality to the operations of PT KGB. Erick undertook his tertiary education at the Beijing Language and Culture University (BLCU), Jakarta from 2005-2009, completing a Bachelor of Literature Chinese Language (Sarjana Bahasa Mandarin), majoring in Economics and Trading (Mandarin). \n                                    <br><br>\n                                    His studies equipped him to undertake a number of roles giving him comprehensive knowledge and experience. Erick has worked at The Bank of China in Research and Development (2009-2010); as Operational Director at Halo Energy & Resources (Coal Trading Company) (2011-2015); and Partner and Chief Finance Officer at PT Kami Gawi Berjaya/The Watch Co (2013-Present).\n                                    <br><br>\n                                    He has bought his extensive past experiences to PT KGB, where he is responsible for Human Resources and the Legal and Finance Department. Erick’s personal interests include diving, music, politics, technology, travel and business.', 'Active', 2),
(3, 'EZRA SATRIA KOSASIH', 'd2.jpg', 'i2.jpg', '<p>Ezra is an optimist who provides guidance, understanding and positive influences to PT KGB. Ezra’s is the younger of two children and his personality is reflective of his upbringing, with his father specializing in training and management consultancy and his mother working in psychology.</p>', '<p>Ezra is an optimist who provides guidance, understanding and positive influences to PT KGB. Ezra&rsquo;s is the younger of two children and his personality is reflective of his upbringing, with his father specializing in training and management consultancy and his mother working in psychology.\n<br><br>\n&nbsp;He undertook his tertiary education at the Institut Bisnis dan informatika Indonesia (iBii), Jakarta from 2005-2009, completing a Bachelor Degree (Sarjana Ekonomi), and majoring in Entrepreneurial Management. He has a diverse and extensive range of experience in a variety of fields. Ezra has worked as a Financial Analyst (2009-2011); Business Development Manager at a publishing company (2011-2012); CEO of a lifestyle magazine (2012-2013); Founder and Project Coordinator at Drop of Hope from 2012 (dropofhope.co) and Partner and Chief Retail Officer at PT Kami Gawi Berjaya.\n<br><br>\nHis responsibilities are to oversee and coordinate the overalll operations of the retail department at PT Kami Gawi Berjaya/The Watch Co. Ezra&rsquo;s personal interests include photography, reading, music, art, politics, technology, design, culture, travel, business and community outreach.&nbsp; &nbsp;&nbsp;</p>\n', 'Active', 3),
(4, 'FLORENCIA WIDYASTRI', 'd4.jpg', 'i4.jpg', '<p>Florencia is a highly motivated and career driven individual. She undertook her secondary education at SMA Santa Theresia from 2007 and graduated in 2010.</p>', '<p>Florencia is a highly motivated and career driven individual. She undertook her secondary education at SMA Santa Theresia from 2007 and graduated in 2010.\n<br><br>\nFlorencia excelled in her tertiary degree at Universitas Pelita Harapan, which she completed during the years of 2010-2013. She has extensive experience in the field of public relations, where she assisted in the coordination of the UPH Radio program on her university campus. Following the completion of her tertiary studies she completed an internship at Daniel Wellington Watches. Utilizing her degree, knowledge and experiences, she has been responsible for a number of roles in The Watch Co. since its establishment in 2012.\n<br><br>\nShe now manages and is responsible for The Watch Co.&rsquo;s purchasing, merchandising, distribution and retail operations. Florencia&rsquo;s personal interests include music, reading fiction and the contemporary arts.&nbsp; &nbsp;&nbsp;</p>\n', 'Active', 4);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
  `feature_id` int(11) NOT NULL,
  `feature_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`feature_id`, `feature_name`) VALUES
(1, 'Weight'),
(2, 'Type'),
(3, 'Category');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `file_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_status` enum('active','inactive') NOT NULL,
  `file_sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homebanner`
--

CREATE TABLE IF NOT EXISTS `homebanner` (
  `homebanner_id` int(11) NOT NULL,
  `homebanner_name` varchar(50) NOT NULL,
  `homebanner_images` text NOT NULL,
  `homebanner_description` text NOT NULL,
  `homebanner_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `homebanner_status` enum('active','inactive') NOT NULL,
  `homebanner_sequence` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homebanner`
--

INSERT INTO `homebanner` (`homebanner_id`, `homebanner_name`, `homebanner_images`, `homebanner_description`, `homebanner_created_date`, `homebanner_status`, `homebanner_sequence`) VALUES
(5, 'aaaaaa', '1.jpg', 'adasdas', '2015-09-25 14:25:18', 'active', 1),
(6, 'aaaaaa', '2.jpg', 'adasdas', '2015-09-25 14:25:18', 'active', 2),
(7, 'aaaaaa', '3.jpg', 'adasdas', '2015-09-25 14:25:18', 'active', 3),
(8, 'aaaaaa', '4.jpg', 'adasdas', '2015-09-25 14:25:18', 'active', 4),
(9, 'aaaaaa', '5.jpg', 'adasdas', '2015-09-25 14:25:18', 'active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `journal_id` int(11) NOT NULL,
  `jounal_title` int(11) NOT NULL,
  `journal_author_id` int(11) NOT NULL,
  `journal_created_date` datetime NOT NULL,
  `journal_modified_date` datetime NOT NULL,
  `journal_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal_category`
--

CREATE TABLE IF NOT EXISTS `journal_category` (
  `journal_category_id` int(11) NOT NULL,
  `journal_category_name` varchar(50) NOT NULL,
  `journal_category_status` tinyint(1) NOT NULL,
  `journal_category_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `journal_category_date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal_category`
--

INSERT INTO `journal_category` (`journal_category_id`, `journal_category_name`, `journal_category_status`, `journal_category_date_created`, `journal_category_date_modified`) VALUES
(1, 'architecture', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(2, 'art', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(3, 'design', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(4, 'fashion', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(5, 'lifestyle', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(6, 'music', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00'),
(7, 'travel', 1, '2016-01-15 08:21:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `journal_related`
--

CREATE TABLE IF NOT EXISTS `journal_related` (
  `journal_related_id` int(11) NOT NULL,
  `journal_parent_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `module` varchar(20) NOT NULL,
  `action` varchar(10) NOT NULL,
  `id_onChanged` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `fullname`, `module`, `action`, `id_onChanged`, `date_time`) VALUES
(3, 'Hari', 'products', 'create', 1, '2016-01-12 06:18:42'),
(4, 'Hari', 'user', 'create', 9, '2016-01-12 06:51:40'),
(5, 'Hari', 'user', 'create', 10, '2016-01-12 07:06:16'),
(7, 'Hari', 'group', 'create', 5, '2016-01-12 07:11:50'),
(8, 'Hari', 'module', 'create', 8, '2016-01-12 07:15:54'),
(9, 'Hari', 'group', 'update', 1, '2016-01-12 07:43:06'),
(10, 'Hari', 'group', 'update', 1, '2016-01-12 07:43:17'),
(11, 'Hari', 'module', 'update', 1, '2016-01-12 07:50:50'),
(12, 'Hari', 'module', 'update', 1, '2016-01-12 07:50:58'),
(13, 'Hari', 'user', 'create', 11, '2016-01-12 08:33:52'),
(14, 'Hari', 'module', 'create', 9, '2016-01-12 08:35:49'),
(15, 'Hari', 'module', 'create', 10, '2016-01-12 08:36:44'),
(16, 'marketing', 'user', 'create', 12, '2016-01-12 08:59:59'),
(17, 'marketing', 'user', 'create', 13, '2016-01-12 09:03:11'),
(18, 'marketing', 'departement', 'create', 2, '2016-01-12 09:14:00'),
(19, 'marketing', 'user', 'create', 14, '2016-01-12 09:40:06'),
(20, 'marketing', 'user', 'create', 17, '2016-01-12 10:00:28'),
(21, 'marketing', 'user', 'create', 20, '2016-01-13 03:39:27'),
(22, 'marketing', 'group', 'create', 6, '2016-01-13 03:43:56'),
(23, 'marketing', 'group', 'update', 1, '2016-01-13 03:46:11'),
(24, 'marketing', 'group', 'update', 1, '2016-01-13 03:46:20'),
(25, 'marketing', 'module', 'create', 11, '2016-01-13 03:50:23'),
(26, 'marketing', 'module', 'update', 1, '2016-01-13 03:51:12'),
(27, 'marketing', 'module', 'update', 1, '2016-01-13 03:51:27'),
(28, 'marketing', 'departement', 'create', 4, '2016-01-13 03:54:50'),
(29, 'marketing', 'departement', 'update', 1, '2016-01-13 03:57:51'),
(30, 'marketing', 'departement', 'update', 1, '2016-01-13 03:58:06'),
(31, 'marketing', 'departement', 'update', 1, '2016-01-13 04:00:03'),
(32, 'marketing', 'company', 'create', 5, '2016-01-13 04:10:44'),
(33, 'marketing', 'branches', 'create', 2, '2016-01-13 04:30:34'),
(34, 'marketing', 'branches', 'update', 1, '2016-01-13 04:33:31'),
(35, 'marketing', 'branches', 'update', 1, '2016-01-13 04:33:40'),
(36, 'marketing', 'branches', 'update', 1, '2016-01-13 04:34:04'),
(37, 'Hari', 'user', 'create', 7, '2016-01-15 04:44:25'),
(38, 'Hari', 'productfeatures', 'create', 3, '2016-01-22 04:15:25'),
(39, 'Hari', 'productfeatures', 'add value', 4, '2016-01-22 04:42:26'),
(40, 'Hari', 'productfeatures', 'add value', 5, '2016-01-22 04:43:26'),
(41, 'Hari', 'productfeatures', 'add value', 6, '2016-01-22 04:44:56'),
(42, 'Hari', 'productfeatures', 'add value', 7, '2016-01-22 04:46:53'),
(43, 'Hari', 'productfeatures', 'add value', 8, '2016-01-22 04:47:10'),
(44, 'Hari', 'productfeatures', 'add value', 9, '2016-01-22 04:47:29'),
(45, 'Hari', 'productfeatures', 'del. value', 1, '2016-01-22 06:28:26'),
(46, 'Hari', 'productfeatures', 'del. value', 5, '2016-01-22 06:28:33'),
(47, 'Hari', 'productfeatures', 'del. value', 2, '2016-01-22 06:32:18'),
(48, 'Hari', 'productfeatures', 'del. value', 6, '2016-01-22 06:33:33'),
(49, 'Hari', 'productfeatures', 'edit value', 3, '2016-01-22 06:39:58'),
(50, 'Hari', 'productfeatures', 'edit value', 3, '2016-01-22 06:40:13'),
(51, 'Hari', 'productfeatures', 'update', 1, '2016-01-22 06:42:00'),
(52, 'Hari', 'productfeatures', 'update', 1, '2016-01-22 06:43:02'),
(53, 'Hari', 'productfeatures', 'add value', 10, '2016-01-22 07:10:08'),
(54, 'Hari', 'productfeatures', 'add value', 11, '2016-01-22 07:10:24'),
(55, 'Hari', 'productfeatures', 'add value', 12, '2016-01-22 07:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_parent_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_created_date` datetime NOT NULL,
  `menu_status` enum('active','inactive') NOT NULL,
  `menu_sequence` int(11) NOT NULL,
  `menu_icons` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_parent_id`, `menu_name`, `menu_created_date`, `menu_status`, `menu_sequence`, `menu_icons`) VALUES
(1, 0, 'Home', '2015-09-20 00:00:00', 'active', 1, ''),
(2, 0, 'Brands', '2015-09-20 00:00:00', 'active', 2, ''),
(3, 0, 'Stores', '0000-00-00 00:00:00', 'active', 3, ''),
(4, 0, 'News', '0000-00-00 00:00:00', 'active', 4, ''),
(5, 0, 'Career', '0000-00-00 00:00:00', 'active', 5, ''),
(6, 0, 'Settings', '0000-00-00 00:00:00', 'active', 6, ''),
(7, 6, 'Company', '0000-00-00 00:00:00', 'active', 1, ''),
(8, 6, 'Users', '0000-00-00 00:00:00', 'active', 2, ''),
(9, 6, 'Home Banner', '0000-00-00 00:00:00', 'active', 3, ''),
(10, 6, 'Social Media', '0000-00-00 00:00:00', 'active', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1441963249),
('m130524_201442_init', 1441963302);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL,
  `module_group_id` int(11) NOT NULL,
  `module_controller` varchar(100) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `show_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_group_id`, `module_controller`, `module_name`, `show_number`) VALUES
(1, 1, 'user', 'Users', 1),
(2, 1, 'group', 'Group', 2),
(3, 2, 'products', 'Products', 1),
(4, 2, 'categories', 'Categories', 2),
(6, 2, 'monitoring', 'Monitoring', 3),
(7, 2, 'productAttributes', 'Product Attributes', 4),
(8, 2, 'brands', 'Brands', 6),
(9, 1, 'module', 'Module', 6),
(10, 1, 'permissions', 'Permissions', 8),
(11, 2, 'tags', 'Tags', 8),
(12, 1, 'departement', 'Departement', 3),
(13, 1, 'company', 'Company', 4),
(14, 1, 'branches', 'Branches', 5),
(15, 1, 'modulegroup', 'Module Group', 7),
(17, 2, 'productfeatures', 'Product Features', 5),
(18, 2, 'suppliers', 'Suppliers', 7),
(19, 2, 'attachments', 'Attachments', 9),
(20, 3, 'orders', 'Orders', 1),
(21, 3, 'invoices', 'Invoices', 2),
(22, 3, 'merchandiseReturns', 'Merchandise Returns', 3),
(23, 3, 'deliverySlips', 'Delivery Slips', 4),
(24, 3, 'statuses', 'Statuses', 5),
(25, 3, 'orderMessages', 'Order Messages', 6),
(26, 4, 'customers', 'Customers', 1),
(27, 4, 'addresses', 'Addresses', 2),
(28, 4, 'groups', 'Groups', 3),
(29, 4, 'shoppingCarts', 'Shopping Carts', 1),
(30, 4, 'customerService', 'Customer Service', 5),
(31, 4, 'contacts', 'Contacts', 6),
(32, 4, 'titles', 'Titles', 7),
(33, 5, 'carriers', 'Carriers', 1),
(34, 5, 'preferences', 'Preferences', 2),
(35, 6, 'localization', 'Localization', 1),
(36, 6, 'languages', 'Languages', 2),
(37, 6, 'currencies', 'Currencies', 3),
(38, 6, 'translations', 'Translations', 4),
(39, 7, 'homebanner', 'Home Banner', 1),
(40, 7, 'social', 'Social Media', 2),
(41, 8, 'dashboard', 'Dashboard', 1),
(42, 1, 'PermissionsCheck', 'Permissions Check', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_group`
--

CREATE TABLE IF NOT EXISTS `module_group` (
  `module_group_id` int(11) NOT NULL,
  `module_group_name` varchar(50) NOT NULL,
  `show_number` int(11) NOT NULL,
  `glyphicon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_group`
--

INSERT INTO `module_group` (`module_group_id`, `module_group_name`, `show_number`, `glyphicon`) VALUES
(1, 'Administration', 8, 'fa fa-key'),
(2, 'Catalogue', 2, 'glyphicon glyphicon-book'),
(3, 'Orders', 3, 'glyphicon glyphicon-shopping-cart'),
(4, 'Customers', 4, 'fa fa-users'),
(5, 'Shipping', 5, 'fa fa-truck'),
(6, 'Localization', 6, 'glyphicon glyphicon-globe'),
(7, 'Settings', 7, 'glyphicon glyphicon-cog'),
(8, 'Home', 1, 'glyphicon glyphicon-home');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL,
  `news_caption` varchar(50) NOT NULL,
  `news_short_description` text NOT NULL,
  `news_long_description` text NOT NULL,
  `news_thumbnail` text NOT NULL,
  `news_featured_banner` text NOT NULL,
  `news_video_url` varchar(50) NOT NULL,
  `news_publish_date` date NOT NULL,
  `news_periode_start_date` datetime NOT NULL,
  `news_periode_end_date` datetime NOT NULL,
  `news_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_status` enum('active','inactive') NOT NULL,
  `news_featured` enum('YES','NO') NOT NULL,
  `news_sequence` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_caption`, `news_short_description`, `news_long_description`, `news_thumbnail`, `news_featured_banner`, `news_video_url`, `news_publish_date`, `news_periode_start_date`, `news_periode_end_date`, `news_created_date`, `news_status`, `news_featured`, `news_sequence`) VALUES
(2, 'EVENT', 'RAINS Pop-Up Store at Plaza Indonesia', 'Starting from November 27th 2015, RAINS Christmas Pop-Up Store can be visited at Plaza Indonesia level 2. The collection including waterproof jackets and bags are available for purchase. The pop-up store will run until December 13th 2015.\n\nThe RAINS pop-up opens:\nMon - Sun : 10 AM - 10 PM\n', 'news-1.jpg', 'featured-news.jpg', 'http://youtube.com', '2015-12-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-09-26 16:27:42', 'active', 'YES', 1),
(3, 'EVENT', 'From Tiny Islands Christmas Pop-Up Store at Plaza Indonesia\n<br>', 'From Tiny Islands joins Plaza Indonesia Christmas Pop-Up Store from November 27th until December 13th 2015. Located at Plaza Indonesia level 2, the complete collection including rings, earrings, necklaces, and bracelets are available for purchase.\n\nThe From Tiny Islands pop-up opens:\nMon - Sun : 10 AM - 10 PM\n', 'news-2.jpg', '', 'http://youtube.com', '2015-12-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-09-26 16:27:42', 'active', 'YES', 2),
(4, 'EVENT', 'The Watch Co. Store is Now Open at Grand Indonesia \n\n<br><br>', 'You can now find The Watch Co. store at Grand Indonesia level 2. Watch brands like Daniel Wellington, Aark Collective, Braun, Tsovet, Hypergrand and Void Watches are available in store.\n\nThe Watch Co.\nGrand Indonesia\nLevel 2, SB-2 Island 3A\n', 'news-3.jpg', '', 'http://youtube.com', '2015-12-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-09-26 16:27:42', 'active', 'YES', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `view_access` int(11) NOT NULL,
  `add_access` int(11) NOT NULL,
  `update_access` int(11) NOT NULL,
  `delete_access` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `module_id`, `view_access`, `add_access`, `update_access`, `delete_access`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 2, 1, 0, 0, 0, 0),
(6, 2, 2, 0, 0, 0, 0),
(7, 2, 3, 1, 1, 1, 1),
(8, 2, 4, 1, 1, 1, 1),
(9, 3, 1, 1, 0, 0, 0),
(10, 3, 2, 0, 1, 0, 0),
(11, 3, 3, 0, 0, 1, 0),
(12, 3, 4, 0, 0, 0, 1),
(16, 1, 6, 1, 1, 1, 1),
(17, 2, 6, 1, 1, 1, 1),
(18, 3, 6, 0, 0, 0, 0),
(19, 1, 7, 1, 1, 1, 1),
(20, 2, 7, 1, 1, 1, 1),
(21, 3, 7, 0, 0, 0, 0),
(22, 5, 1, 0, 0, 0, 0),
(23, 5, 2, 0, 0, 0, 0),
(24, 5, 3, 1, 1, 1, 1),
(25, 5, 4, 0, 0, 0, 0),
(26, 5, 6, 0, 0, 0, 0),
(27, 5, 7, 0, 0, 0, 0),
(28, 1, 8, 1, 1, 1, 1),
(29, 2, 8, 1, 1, 1, 1),
(30, 3, 8, 0, 0, 0, 0),
(31, 5, 8, 0, 0, 0, 0),
(32, 1, 9, 1, 1, 1, 1),
(33, 2, 9, 0, 0, 0, 0),
(34, 3, 9, 0, 0, 0, 0),
(35, 5, 9, 0, 0, 0, 0),
(36, 1, 10, 1, 1, 1, 1),
(37, 2, 10, 0, 0, 0, 0),
(38, 3, 10, 0, 0, 0, 0),
(39, 5, 10, 0, 0, 0, 0),
(40, 6, 1, 0, 0, 0, 0),
(41, 6, 2, 0, 0, 0, 0),
(42, 6, 3, 0, 0, 0, 0),
(43, 6, 4, 0, 0, 0, 0),
(44, 6, 6, 0, 0, 0, 0),
(45, 6, 7, 0, 0, 0, 0),
(46, 6, 8, 0, 0, 0, 0),
(47, 6, 9, 0, 0, 0, 0),
(48, 6, 10, 0, 0, 0, 0),
(49, 1, 11, 1, 1, 1, 1),
(50, 2, 11, 0, 0, 0, 0),
(51, 3, 11, 0, 0, 0, 0),
(52, 5, 11, 0, 0, 0, 0),
(53, 6, 11, 0, 0, 0, 0),
(54, 1, 17, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `suppliers_supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL,
  `brands_collection_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `minimal_quantity` int(11) NOT NULL,
  `price` int(18) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `available_for_order` tinyint(1) NOT NULL DEFAULT '1',
  `available_date` date NOT NULL,
  `product_condition` enum('new','used','refurbished') NOT NULL DEFAULT 'new',
  `show_price` tinyint(1) NOT NULL DEFAULT '1',
  `visibility` enum('both','catalog','search','none') NOT NULL DEFAULT 'both',
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_category_id`, `suppliers_supplier_id`, `category_id`, `brands_brand_id`, `brands_collection_id`, `quantity`, `minimal_quantity`, `price`, `width`, `height`, `depth`, `weight`, `active`, `available_for_order`, `available_date`, `product_condition`, `show_price`, `visibility`, `date_created`, `date_updated`) VALUES
(5, 5, 0, 0, 2, 2, 0, 0, 2450000, 0, 0, 0, 0, 1, 1, '0000-00-00', 'new', 1, 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 0, 0, 2, 2, 0, 0, 1850000, 0, 0, 0, 0, 1, 1, '0000-00-00', 'new', 1, 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, 0, 0, 2, 3, 0, 0, 2300000, 0, 0, 0, 0, 1, 1, '0000-00-00', 'new', 1, 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 0, 0, 2, 3, 0, 0, 2300000, 0, 0, 0, 0, 1, 1, '0000-00-00', 'new', 1, 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 5, 0, 0, 1, 3, 0, 0, 1850000, 0, 0, 0, 0, 1, 1, '0000-00-00', 'new', 1, 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_attribute_id` int(10) unsigned NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`product_attribute_id`, `product_id`) VALUES
(1, 6),
(7, 5),
(8, 7),
(9, 7),
(13, 9),
(15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_combination`
--

CREATE TABLE IF NOT EXISTS `product_attribute_combination` (
  `product_attribute_combination_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `product_attribute_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attribute_combination`
--

INSERT INTO `product_attribute_combination` (`product_attribute_combination_id`, `attribute_id`, `attribute_value_id`, `product_attribute_id`) VALUES
(1, 6, 4, 1),
(5, 6, 5, 7),
(6, 6, 4, 8),
(7, 6, 5, 9),
(11, 6, 4, 13),
(13, 6, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_image`
--

CREATE TABLE IF NOT EXISTS `product_attribute_image` (
  `id_product_attribute` int(10) unsigned NOT NULL,
  `product_image_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attribute_image`
--

INSERT INTO `product_attribute_image` (`id_product_attribute`, `product_image_id`) VALUES
(1, 6),
(8, 7),
(5, 8),
(13, 8),
(10, 10),
(14, 10),
(15, 10),
(9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_name` varchar(50) NOT NULL,
  `product_category_images` text NOT NULL,
  `product_category_description` text NOT NULL,
  `product_category_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_category_status` enum('active','inactive') NOT NULL,
  `product_category_sequence` int(11) NOT NULL,
  `product_category_featured` int(1) NOT NULL,
  `link_rewrite` varchar(50) NOT NULL,
  `has_child` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`, `product_category_images`, `product_category_description`, `product_category_created_date`, `product_category_status`, `product_category_sequence`, `product_category_featured`, `link_rewrite`, `has_child`) VALUES
(5, 'watches', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 1, 1, 'watches/all-product', 1),
(6, 'straps', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 2, 1, 'straps/all-product', 1),
(7, 'essentials', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 3, 1, '', 0),
(8, 'shop social', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 4, 1, 'shop-social', 0),
(9, 'brands', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 5, 1, 'brands', 0),
(10, 'journal', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 6, 1, 'journal', 0),
(11, 'gift', 'watches.png', 'adasdas', '2015-09-25 14:25:18', 'active', 7, 1, 'gift', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category_brands`
--

CREATE TABLE IF NOT EXISTS `product_category_brands` (
  `product_category_brands_id` int(11) NOT NULL,
  `product_category_category_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category_brands`
--

INSERT INTO `product_category_brands` (`product_category_brands_id`, `product_category_category_id`, `brands_brand_id`) VALUES
(1, 5, 1),
(2, 5, 10),
(3, 5, 13),
(4, 6, 2),
(5, 6, 9),
(6, 5, 2),
(7, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE IF NOT EXISTS `product_detail` (
  `product_id` int(10) unsigned NOT NULL,
  `apps_language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `description` text,
  `spesification` text,
  `link_rewrite` varchar(128) NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_title` varchar(128) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `available_now` varchar(255) DEFAULT NULL,
  `available_later` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_id`, `apps_language_id`, `description`, `spesification`, `link_rewrite`, `meta_description`, `meta_keywords`, `meta_title`, `name`, `available_now`, `available_later`) VALUES
(5, 1, '<p>The Daniel Wellington watch is suitable for every occasion. Regardless if you&rsquo;re attending a black tie event, playing a game of tennis or enjoying a sunny day at the beach club &ndash; the Daniel Wellington is a beautiful companion.</p>\r\n\r\n<p>Not only that, but with interchangeable straps you can have a different watch for every day of the week.</p>\r\n', '<table border="0" cellpadding="0" cellspacing="0" style="width:336pt">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:15pt; width:48pt">Finishing&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td colspan="2" style="width:96pt">: Polished</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Index&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Swarovski stones</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Glass&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Mineral glass</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Strap&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Nato nylon</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Buckle&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Polished&nbsp;&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Dimension&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: 34mm x 6mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Band width&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>: 17mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Movement&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="3">: Quartz Miyota movement</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Function&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Hour | Minute&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Water resistant&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="4">: 3 ATM (avoid all contact with water)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'classy-winchester-34mm', '', NULL, '', 'NATOSTRAP CLASSY CAMBRIDGE', NULL, NULL),
(6, 1, '<p>The Daniel Wellington watch is suitable for every occasion. Regardless if you&rsquo;re attending a black tie event, playing a game of tennis or enjoying a sunny day at the beach club &ndash; the Daniel Wellington is a beautiful companion.</p>\r\n\r\n<p>Not only that, but with interchangeable straps you can have a different watch for every day of the week.</p>\r\n', '<table border="0" cellpadding="0" cellspacing="0" style="width:692px">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:15.75pt; width:128pt">Dimension</td>\r\n			<td style="width:10pt">:</td>\r\n			<td style="width:381pt">26 mm x 6 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Band width&nbsp;</td>\r\n			<td>:</td>\r\n			<td>13 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Finishing</td>\r\n			<td>:</td>\r\n			<td>Rose gold</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Glass</td>\r\n			<td>:</td>\r\n			<td>Mineral glass</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Strap</td>\r\n			<td>:</td>\r\n			<td>Natostrap</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Buckle</td>\r\n			<td>:</td>\r\n			<td>Rose gold buckle&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Movement</td>\r\n			<td>:</td>\r\n			<td>Quartz Japan citizen GL20 movement</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Function</td>\r\n			<td>:</td>\r\n			<td>Hour | Minute&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Water resistant</td>\r\n			<td>:</td>\r\n			<td>3 ATM (avoid all contact with water)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'daniel-wellington-classy-winchester', '', NULL, '', 'CLASSY WINCHESTER', NULL, NULL),
(7, 1, '<p>The Daniel Wellington watch is suitable for every occasion. Regardless if you&rsquo;re attending a black tie event, playing a game of tennis or enjoying a sunny day at the beach club &ndash; the Daniel Wellington is a beautiful companion.</p>\r\n\r\n<p>Not only that, but with interchangeable straps you can have a different watch for every day of the week.</p>\r\n', '<table border="0" cellpadding="0" cellspacing="0" style="width:384pt">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:15pt; width:48pt">Finishing&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td colspan="4" style="width:192pt">: Available in Rose gold / Polished silver</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Glass&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Mineral glass</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Strap&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Leather strap</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Buckle&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="5">: Available in Rose gold / Polished silver buckle&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Dimension&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: 26mm x 6mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Band width&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>: 13mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Movement&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="4">: Quartz japan citizen GL20 movement</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Function&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Hour | Minute&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Water resistant&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="4">: 3 ATM (avoid all contact with water)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'classy-cardiff', '', NULL, '', 'CLASSY CARDIFF', NULL, NULL),
(9, 1, '<p>The Daniel Wellington watch is suitable for every occasion. Regardless if you&rsquo;re attending a black tie event, playing a game of tennis or enjoying a sunny day at the beach club &ndash; the Daniel Wellington is a beautiful companion.</p>\r\n\r\n<p>Not only that, but with interchangeable straps you can have a different watch for every day of the week.</p>\r\n', '<table border="0" cellpadding="0" cellspacing="0" style="width:692px">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:15.75pt; width:128pt">Dimension</td>\r\n			<td style="width:10pt">:</td>\r\n			<td style="width:381pt">26 mm x 6 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Band width&nbsp;</td>\r\n			<td>:</td>\r\n			<td>13 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Finishing</td>\r\n			<td>:</td>\r\n			<td>Rose gold</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Glass</td>\r\n			<td>:</td>\r\n			<td>Mineral glass</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Strap</td>\r\n			<td>:</td>\r\n			<td>Leather strap</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Buckle</td>\r\n			<td>:</td>\r\n			<td>Rose gold buckle&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Movement</td>\r\n			<td>:</td>\r\n			<td>Quartz Japan citizen GL20 movement</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Function</td>\r\n			<td>:</td>\r\n			<td>Hour | Minute&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15.75pt">Water resistant</td>\r\n			<td>:</td>\r\n			<td>3 ATM (avoid all contact with water)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'classy-york', '', NULL, '', 'CLASSY YORKK', NULL, NULL),
(10, 1, '<p>The Daniel Wellington watch is suitable for every occasion. Regardless if you&rsquo;re attending a black tie event, playing a game of tennis or enjoying a sunny day at the beach club &ndash; the Daniel Wellington is a beautiful companion.</p>\r\n\r\n<p>Not only that, but with interchangeable straps you can have a different watch for every day of the week.</p>\r\n', '<table border="0" cellpadding="0" cellspacing="0" style="width:384pt">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:15pt; width:48pt">Finishing&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n			<td colspan="4" style="width:192pt">: Available in Rose gold / Polished silver</td>\r\n			<td style="width:48pt">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Glass&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Mineral glass</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Strap&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Nato strap</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Buckle&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="5">: Available in Rose gold / Polished silver buckle&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Dimension&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: 26mm x 6mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Band width&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>: 13mm</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Movement&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="4">: Quartz japan citizen GL20 movement</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="height:15pt">Function&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="2">: Hour | Minute&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="height:15pt">Water resistant&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td colspan="4">: 3 ATM (avoid all contact with water)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'classy-glasgow', '', NULL, '', 'CLASSY GLASGOW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature`
--

CREATE TABLE IF NOT EXISTS `product_feature` (
  `product_feature_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `feature_value_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature`
--

INSERT INTO `product_feature` (`product_feature_id`, `feature_id`, `product_id`, `feature_value_id`) VALUES
(1, 1, 9, 4),
(2, 2, 9, 8),
(3, 3, 9, 12),
(4, 1, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature_value`
--

CREATE TABLE IF NOT EXISTS `product_feature_value` (
  `feature_value_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `feature_value_name` varchar(100) NOT NULL,
  `feature_value_value` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature_value`
--

INSERT INTO `product_feature_value` (`feature_value_id`, `feature_id`, `feature_value_name`, `feature_value_value`) VALUES
(3, 1, '750 gr', '750'),
(4, 1, '250 gr', '250'),
(7, 2, 'Quartz', 'quartz'),
(8, 2, 'Automatic', 'automatic'),
(9, 2, 'Manual', 'manual'),
(10, 3, 'Performance', 'performance'),
(11, 3, 'Minimalist', 'minimalist'),
(12, 3, 'Classic', 'classic');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `product_image_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `position` smallint(2) unsigned NOT NULL DEFAULT '0',
  `cover` tinyint(1) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `position`, `cover`) VALUES
(5, 5, 0, 1),
(6, 6, 0, 1),
(7, 7, 0, 1),
(8, 9, 0, 1),
(10, 9, 0, NULL),
(11, 9, 0, NULL),
(12, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_related`
--

CREATE TABLE IF NOT EXISTS `product_related` (
  `product_related_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_parent_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_related`
--

INSERT INTO `product_related` (`product_related_id`, `product_id`, `product_parent_id`) VALUES
(30, 5, 7),
(31, 6, 7),
(35, 6, 5),
(36, 5, 6),
(37, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE IF NOT EXISTS `product_stock` (
  `product_stock_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_attribute_id` int(11) unsigned NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`product_stock_id`, `product_id`, `product_attribute_id`, `quantity`) VALUES
(20, 7, 0, 4),
(37, 5, 0, 0),
(38, 6, 1, 5),
(39, 6, 4, 1),
(40, 10, 0, 0),
(41, 5, 7, 0),
(42, 7, 8, 0),
(43, 7, 9, 0),
(68, 9, 13, 0),
(69, 9, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_id` int(10) unsigned NOT NULL,
  `product_tag_detail_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag_detail`
--

CREATE TABLE IF NOT EXISTS `product_tag_detail` (
  `product_tag_detail_id` int(10) unsigned NOT NULL,
  `apps_language_id` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `store_type` enum('retail','distribution') NOT NULL,
  `store_marketplace` enum('online','offline') NOT NULL,
  `store_separator` char(1) NOT NULL,
  `store_location` varchar(30) NOT NULL,
  `store_address` text NOT NULL,
  `store_thumbnail` text NOT NULL,
  `store_contact_person` varchar(50) NOT NULL,
  `store_contact_number` text NOT NULL,
  `store_sequence` int(11) NOT NULL,
  `store_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `store_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_name`, `store_type`, `store_marketplace`, `store_separator`, `store_location`, `store_address`, `store_thumbnail`, `store_contact_person`, `store_contact_number`, `store_sequence`, `store_created_date`, `store_status`) VALUES
(6, 'PLAZA INDONESIA', 'retail', 'offline', '-', 'Jakarta', 'LV.2 #1001B\nJALAN M.H. THAMRIN NO. 28 - 30, CENTRAL JAKARTA,\nDKI JAKARTA 10350, INDONESIA\n', '-', '-', '+62 2129924203', 1, '2015-11-30 15:36:58', 'active'),
(7, 'PLAZA INDONESIA', 'retail', 'offline', '-', 'Jakarta', 'LV.3 #3B\r\nJALAN M.H. THAMRIN NO. 28 - 30, CENTRAL JAKARTA,\r\nDKI JAKARTA 10350, INDONESIA', '-', '-', '+62 2129924203', 1, '2015-11-30 15:36:58', 'active'),
(8, 'PACIFIC PLACE', 'retail', 'offline', '-', 'Jakarta', 'LV.3 KIOS 3A\r\nSENAYAN KEBAYORAN BARU, SOUTH JAKARTA CITY\r\nJAKARTA 12190, INDONESIA', '-', '-', '+62 2157973656', 1, '2015-11-30 15:36:58', 'active'),
(9, 'LIPPO MALL PURI', 'retail', 'offline', '-', 'Jakarta', 'GF #25B \r\nJALAN PURI INDAH RAYA BLOK U1, CBD\r\nPURI INDAH, JAKARTA BARAT,\r\nJAKARTA 11610, INDONESIA', '-', '-', '', 1, '2015-11-30 15:36:58', 'active'),
(12, 'SUMMMARECON MALL SERPONG 2', 'retail', 'offline', '-', 'TANGERANG', 'LV.1 IC 06\r\nJALAN BOULEVARD GADING SERPONG,\r\nSENTRA GADING SERPONG KEC,\r\nTANGERANG BANTEN 15810 INDONESIA', '-', '-', '', 1, '2015-11-30 15:36:58', 'active'),
(13, 'PLAZA AMBARRUKMO', 'retail', 'offline', '-', 'YOGYAKARTA', 'ISLAND GROUND FLOOR UNIT W\r\nJL. LAKSDA ADISUCIPTO NO. B1, SPECIAL REGION OF\r\nYOGYAKARTA 55281, INDONESIA\r\n', '-', '-', '+62 2744331257', 1, '2015-11-30 15:36:58', 'active'),
(14, 'CENTRE POINT', 'retail', 'offline', '-', 'MEDAN', 'GF #34A \r\nKOMPLEK MEDAN CENTRE POINT\r\nJALAN TIMOR BLOK H NO.1\r\nMEDAN 20231\r\n', '-', '-', '+62 6180510638', 1, '2015-11-30 15:36:58', 'active'),
(15, 'TUNJUNGAN PLAZA 3', 'retail', 'offline', '-', 'SURABAYA', 'LV. 1 PC-K-1-03\nJALAN BASUKI RAHMAT 8-12\nSURABAYA, JAWA TIMUR 60261\n', '-', '-', '+62 315468150', 1, '2015-11-30 15:36:58', 'active'),
(52, '707', 'distribution', 'offline', '', 'JAKARTA', 'Jalan Kemang Raya No. 8B, Jakarta Selatan 12730', '', '', '+6221 7180051', 1, '2015-12-01 10:23:08', 'active'),
(53, '', '', '', '', '', '', '', '', '', 0, '2015-12-01 10:23:08', ''),
(54, 'BERRYBENKA', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(55, 'BOBOBOBO', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(56, 'COTTON INK', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(57, 'MARIS STORE', 'distribution', 'offline', '', 'JAKARTA', 'Jalan Panglima Polim Raya No.9, Kebayoran Baru, Jakarta Selatan 12160', '', '', '+62217208681', 1, '2015-12-01 10:23:08', 'active'),
(58, 'MATAHARIMALL', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(59, 'MONSTORE', 'distribution', 'offline', '', 'JAKARTA', 'Mall Kota Kasablanka L1 - Raya Kav. 88Jalan Casablanca Raya Kav. 88 No. 50, Kota Kasablanka', '', '', ' +622129488649', 1, '2015-12-01 10:23:08', 'active'),
(60, 'MOREBYMORELLO', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(61, 'SHOPDECA', 'distribution', 'online', '', '', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(62, 'SOLEPLAY', 'distribution', 'offline', '', 'JAKARTA', 'Jalan HOS. Cokroaminoto No. 100. Jakarta Pusat', '', '', '+6221 2302643', 1, '2015-12-01 10:23:08', 'active'),
(63, 'STANDARD DENIM SUPPLY', 'distribution', 'offline', '', 'JAKARTA', 'Plaza Senayan LV 2 Unit 238A-240A, Jalan Asia Afrika No. 8, Jakarta Selatan, DKI Jakarta 10270 ', '', '', '+62215725670', 1, '2015-12-01 10:23:08', 'active'),
(64, 'THE CUFFLINKS STORE', 'distribution', 'offline', '', 'JAKARTA', 'Plaza Senayan Lv. 2 Unit #236B, Jalan Asia Afrika No. 8, Jakarta Selatan, DKI Jakarta 10270', '', '', '+62215725110', 1, '2015-12-01 10:23:08', 'active'),
(65, 'THE CUFFLINKS STORE', 'distribution', 'offline', '', 'JAKARTA', 'Pondok Indah Mall 1 Lv. 1 Unit #115A, Jalan Metro Pondok Indah, Jakarta Selatan, DKI Jakarta 12310', '', '', '+62217506840', 1, '2015-12-01 10:23:08', 'active'),
(66, 'THE CUFFLINKS STORE', 'distribution', 'offline', '', 'JAKARTA', 'Grand Indonesia, Jalan M.H. Thamrin No.1, Jakarta Pusat 10310', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(67, 'THE CUFFLINKS STORE', 'distribution', 'offline', '', 'JAKARTA', 'Pacific Place Lv. 4 Unit 4B, Jalan Jend. Sudirman Kav. 52-53, Jakarta Selatan 12190', '', '', '+622157973025', 1, '2015-12-01 10:23:08', 'active'),
(68, 'THE GOODS DEPT.', 'distribution', 'offline', '', 'JAKARTA', 'Pacific Place Lv. 1 Unit #1-02, Jalan Jend. Sudirman Kav. 52-53, Jakarta Selatan, DKI Jakarta 12190', '', '', '+622157973644', 1, '2015-12-01 10:23:08', 'active'),
(69, 'THE GOODS DEPT.', 'distribution', 'offline', '', 'JAKARTA', 'Pondok Indah Mall 2 Lv. 3 Unit #321, Jalan Metro Pondok Indah, Jakarta Selatan, DKI Jakarta 12310', '', '', '+622175920997', 1, '2015-12-01 10:23:08', 'active'),
(70, 'THE GOODS DEPT.', 'distribution', 'offline', '', 'JAKARTA', 'Lotte Shopping Avenue Lv. 1 Unit 1F #18-19 Jalan Prof. Dr. Satrio Kav. 3-5, Karet, Kuningan, Jakarta 12940', '', '', '+622129889117', 1, '2015-12-01 10:23:08', 'active'),
(71, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Summarecon Mal Serpong Ground Floor Unit #01B, Jalan Boulevard Gading Serpong, Tangerang, Banten', '', '', '+62215461337', 1, '2015-12-01 10:23:08', 'active'),
(72, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Lippo Mall Kemang Lv. 3 Unit #07A, Jalan 36 Pangeran Antasari, Jakarta Selatan, DKI Jakarta 12150 ', '', '', '+622129528390', 1, '2015-12-01 10:23:08', 'active'),
(73, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Lippo Mall Kemang Lv. 3 Unit #07A, Jalan 36 Pangeran Antasari, Jakarta Selatan, DKI Jakarta 12150 ', '', '', '+622129528390', 1, '2015-12-01 10:23:08', 'active'),
(74, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Kota Kasablanka Lower Ground Unit #43, Jalan Casablanca Raya Kav. 88, Jakarta Selatan, 12870', '', '', '+622129488674', 1, '2015-12-01 10:23:08', 'active'),
(75, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Lotte Shopping Avenue Lv. 4 Unit #20, Jalan Prof. Dr. Satrio Kav. 3 - 5, Jakarta Selatan, DKI Jakarta 12940', '', '', '+622129889413', 1, '2015-12-01 10:23:08', 'active'),
(76, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Mal Kelapa Gading 2 Ground Floor Unit #119, Jalan Boulevard Kelapa Gading Blok M, Jak Ut 14240', '', '', '+622145853710', 1, '2015-12-01 10:23:08', 'active'),
(77, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Mall Puri Indah Lv. 1 Unit L1–146 A, Jalan Puri Agung, Jakarta Barat, DKI Jakarta 11610', '', '', '+622158357196', 1, '2015-12-01 10:23:08', 'active'),
(78, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Lippo Mall Puri Lv. 1 Unit 1F-77, Jalan Puri Indah, Raya Blok U1 CBD, Jakarta Barat, 11610', '', '', '+622129111099', 1, '2015-12-01 10:23:08', 'active'),
(79, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Pacific Place Lv. B1 Unit B1-02, Jalan Jend. Sudirman Kav. 52 – 53, Jakarta Selatan, DKI Jakarta 12190', '', '', '+622157973119', 1, '2015-12-01 10:23:08', 'active'),
(80, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Grand Indonesia LG Unit EM-LG-20, Jalan M.H. Thamrin No.1, Jakarta Pusat 10310', '', '', '+622123580016', 1, '2015-12-01 10:23:08', 'active'),
(81, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Summarecon Mal Bekasi GF Unit #121A, Jalan Bulevar Ahmad Yani Blok M, Bekasi, Jawa Barat 17142 ', '', '', '+622129572337', 1, '2015-12-01 10:23:08', 'active'),
(82, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'AEON Mall #G-70, Jl. BSD Raya Utama, Desa Sampora, Kecamatan Cisauk, Tangerang', '', '', '+622129168299', 1, '2015-12-01 10:23:08', 'active'),
(83, 'URBANLIFE', 'distribution', 'offline', '', 'JAKARTA', 'Jl. Dewi Sri No.168 Kuta, Bandung, Bali', '', '', '+623614727318', 1, '2015-12-01 10:23:08', 'active'),
(84, 'WIDELY PROJECT', 'distribution', 'offline', '', 'JAKARTA', 'Jalan Panglima Polim 5 No. 36, Melawai, Kebayoran Baru, Jakarta Selatan', '', '', '', 1, '2015-12-01 10:23:08', 'inactive'),
(85, 'WIDELY PROJECT', 'distribution', 'offline', '', 'JAKARTA', 'Jalan RE. Martadinata, No. 107, Jawa Barat, Indonesia', '', '', '+62227231278', 1, '2015-12-01 10:23:08', 'active'),
(86, 'DANIEL WELLINGTON BOOTH', 'distribution', 'offline', '', 'JAKARTA', 'Plaza Indonesia level 3, Jalan MH Thamrin Kav 28 - 30', '', '', '+622129924204', 1, '2015-12-01 10:23:08', 'active'),
(87, 'DANIEL WELLINGTON BOOTH', 'distribution', 'offline', '', 'JAKARTA', 'Summarecon Mal Serpong Lv. 1 Unit 1F-IC 06, Jalan Boulevard Gading Serpong', '', '', '+622129310656', 1, '2015-12-01 10:23:08', 'active'),
(88, 'DANIEL WELLINGTON BOOTH', 'distribution', 'offline', '', 'JAKARTA', 'AEON Mall IC-106, Jl. BSD Raya Utama, Desa Sampora, Kecamatan Cisauk, Tangerang', '', '', '+622129168380', 1, '2015-12-01 10:23:08', 'active'),
(89, 'DANIEL WELLINGTON BOOTH', 'distribution', 'offline', '', 'JAKARTA', 'Tunjungan Plaza III Lv. 1 Unit PC-K-1-03, Jalan Basuki Rahmat 8 - 12', '', '', '+62315468150', 1, '2015-12-01 10:23:08', 'active'),
(90, 'HYPERGRAND BOOTH', 'distribution', 'offline', '', 'JAKARTA', 'Summarecon Mal Serpong Lv. 1 Unit 1F-IC 06, Jalan Boulevard Gading Serpong', '', '', '+622129310656', 1, '2015-12-01 10:23:08', 'inactive'),
(91, 'GUDANG JAM', 'distribution', 'offline', '', 'Bandung', 'Jalan Ternate No. 29 Bandung', '', '', '+62224237797', 1, '2015-12-01 10:23:08', 'inactive'),
(92, 'HAPPY GO LUCKY', 'distribution', 'offline', '', 'Bandung', 'Jl. Ciliwung No.14, Bandung Wetan, Kota Bandung', '', '', '+62227234162', 1, '2015-12-01 10:23:08', 'inactive'),
(93, 'GATE STORE', 'distribution', 'offline', '', 'YOGYAKARTA', 'Jl. Pandega Karya 290, Kaliurang KM 5, D.I. Yogyakarta 55821', '', '', '+622749305577', 1, '2015-12-01 10:23:08', 'inactive'),
(94, 'ORE STORE', 'distribution', 'offline', '', 'SURABAYA', 'Jl. Untung Suropati 83, Surabaya, Jawa Timur 60264 ', '', '', '+62315682074\r\n', 1, '2015-12-01 10:23:08', 'inactive'),
(95, 'THE TIME LABS', 'distribution', 'offline', '', 'Surabaya', 'Ruko Pakuwon Town Square FR 1 No. 12, 2nd Floor Pakuwon City, Surabaya', '', '', '', 1, '2015-12-01 10:23:08', 'inactive'),
(96, 'BURO', 'distribution', 'offline', '', 'Bali', 'Jalan Petitenget 88x 2nd Floor, Kerobokan, Denpasar, Bali 80361', '', '', '', 1, '2015-12-01 10:23:08', 'inactive'),
(97, 'DEUS', 'distribution', 'offline', '', 'BALI', 'Jalan Batu Mejan No. 8, Canggu, Bali 80361 ', '', '', '+623613683385', 1, '2015-12-01 10:23:08', 'inactive'),
(98, 'DEUS', 'distribution', 'offline', '', 'BALI', 'Jalan Laksamana 3B, Oberoi,Bali', '', '', '', 1, '2015-12-01 10:23:08', 'inactive'),
(99, 'DEUS', 'distribution', 'offline', '', 'BALI', 'Jl. Raya Petitenget No. 886A Seminyak\r\nKuta\r\n\r\n', '', '', '+623612020254\r\n', 1, '2015-12-01 10:23:08', 'active'),
(100, 'KIOSK BALI', 'distribution', 'offline', '', 'JAKARTA', 'Jl. Kayu Cendana No. 1 Seminyak, Bali', '', '', '0361 8371064\r\n', 1, '2015-12-01 10:23:08', 'active'),
(101, 'KIOSK BALI', 'distribution', 'offline', '', 'BALI', 'Jl. Raya Seminyak no. 65', '', '', '0361 732132', 1, '2015-12-01 10:23:08', 'active'),
(102, 'ABBEY ROAD', 'distribution', 'offline', '', 'MEDAN', 'Jalan S. Parman, Kompleks MBC Blok D 11-12, Medan', '', '', '(061) 4560540', 1, '2015-12-01 10:23:08', 'active'),
(103, 'OTOKO', 'distribution', 'offline', '', 'JAKARTA', 'Lot 14 Basement Fairgrounds, Jalan Jend. Sudirman Kav. 52-53, Kawasan SCBD, Jakarta 12410', '', '', '+622151401014', 1, '2015-12-01 10:23:08', 'inactive'),
(104, 'LOOKS LIKE LIFE', 'distribution', 'offline', '', 'SURABAYA', 'Jl. Ir. Dr. H. Soekarno 25 (MERR - Rungkut) Surabaya', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(105, 'TOIDIHOLIC', 'distribution', 'offline', '', 'Lampung', 'Jalan Way Rarem No. 7 Pahoman', '', '', '+628975908016', 1, '2015-12-01 10:23:08', 'active'),
(106, 'BUCK STORE', 'distribution', 'offline', '', 'SEMARANG', 'Jl. Ngesrep Barat I No. 9, Semarang, Jawa Tengah 50262 ', '', '', '+6282135022080\r\n', 1, '2015-12-01 10:23:08', 'inactive'),
(107, 'FLAVA', 'distribution', 'offline', '', 'Bandung', 'Jalan Cihampelas No. 177, Bandung 40131\r\n', '', '', '+6281573409954\r\n', 1, '2015-12-01 10:23:08', 'active'),
(108, 'PENNY STORE', 'distribution', 'offline', '', 'JAKARTA', 'Jalan Bangka Raya No.107, Jakarta', '', '', '+62217182388\r\n', 1, '2015-12-01 10:23:08', 'inactive'),
(109, 'ORBIS', 'distribution', 'offline', '', 'JAKARTA', 'Jl. Panglima Polim V No.36, Kby. Baru, Jakarta Selatan', '', '', '+622172783935\r\n', 1, '2015-12-01 10:23:08', 'active'),
(110, 'UNIONGOODS', 'distribution', 'offline', '', 'Bandung', 'Jl. Palasari No. 45, Jawa Barat, Indonesia\r\n', '', '', '+6281809309313\r\n', 1, '2015-12-01 10:23:08', 'active'),
(111, 'FOLK', 'distribution', 'offline', '', 'Bandung', 'Jl Demangan Baru No 3, Yogyakarta\r\n', '', '', '+6287839151904\r\n', 1, '2015-12-01 10:23:08', 'active'),
(112, 'POP SCENE', 'distribution', 'offline', '', 'Tasikmalaya', 'JL. Dewi Sartika No. 21, Tasikmalaya\r\n', '', '', '+628112125533\r\n', 1, '2015-12-01 10:23:08', 'active'),
(113, 'POP SHOP', 'distribution', 'offline', '', 'Bandung', 'Jl. Cimanuk No.11, Bandung\r\n', '', '', '+62227275449\r\n', 1, '2015-12-01 10:23:08', 'active'),
(114, 'LO-VING STORE', 'distribution', 'offline', '', 'Makassar', 'JL Monginsidi, No. 38, Kec. Makassar\r\n', '', '', '+62411875819\r\n', 1, '2015-12-01 10:23:08', 'active'),
(115, 'KIXXX', 'distribution', 'offline', '', 'JAKARTA', 'FJL Building, Jl. Kemang Raya 25. Jakarta Selatan 12730\r\n', '', '', ' +62878 80000237\r\n', 1, '2015-12-01 10:23:08', 'active'),
(116, 'ODD', 'distribution', 'offline', '', 'Bandung', 'Jl. Karangsari No. 10, Setiabudi, Bandung\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(117, 'ODD', 'distribution', 'offline', '', 'Bali', '', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(118, 'OMG+', 'distribution', 'offline', '', 'SURABAYA', 'Tunjungan Plaza 5 Lt. 3 Unit 2, Surabaya\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(119, 'VERONA', 'distribution', 'offline', '', 'Pekanbaru', 'Jl. Jend. Sudirman No. 122ABC, Pekanbaru\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(120, 'BALI WATCH', 'distribution', 'offline', '', 'Semarang', 'Paragon City Lt. 1 No. 17A, Jl. Pemuda 118, Semarang\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(121, 'BALI WATCH', 'distribution', 'offline', '', 'Semarang', 'Murni Building Blok K, Jl. Gajahmada 144, Semarang\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(122, 'Y GOODS', 'distribution', 'offline', '', 'Lampung', 'Jl. Cut Nyak Dien No. 62, Bandar Lampung\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active'),
(123, 'ART & SCIENCE', 'distribution', 'offline', '', 'Lampung', 'Grand Indonesia East Mall, LG Unit 40-41, Jl. MH Thamrin No. 1, Jakarta Pusat', '', '', '+6221 23581221\r\n', 1, '2015-12-01 10:23:08', 'active'),
(124, 'MAHKOTA WATCH', 'distribution', 'offline', '', 'Palembang', 'Palembang Indah Mall Lt. 1 No. 78, Palembang 30134\r\n', '', '', '', 1, '2015-12-01 10:23:08', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `stores_brands`
--

CREATE TABLE IF NOT EXISTS `stores_brands` (
  `stores_brands_id` int(11) NOT NULL,
  `stores_store_id` int(11) NOT NULL,
  `brands_brand_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_brands`
--

INSERT INTO `stores_brands` (`stores_brands_id`, `stores_store_id`, `brands_brand_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `group_name`) VALUES
(1, 'Super Admin'),
(2, 'Logistic'),
(3, 'Finance'),
(5, 'Marketing'),
(6, 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `profile_photo` blob NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departements_departement_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `group_id`, `profile_photo`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `departements_departement_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hari', 'Hari', 1, '', 'GQ4t0UsYts4dzaZOnsOOKHSNSf7PgPM8', '$2y$13$0R8ychOoZMtsNgS.h1Q/5.zswJu22SKPpp3QwWHy2STbbOUwy0CGO', NULL, 'hari@thewatch.co', 1, 10, 1441963409, 1441963409),
(5, 'admin', 'administrator', 0, 0x31, 'XB5ffUHlxGo3QuC5BmA3Ob_ID3zPO-1I', '$2y$13$xYbGQDAEx7xFf5XHdbNKEes.Dzw/Wu43SL7EHgatWhSAYKM9HtrwC', NULL, 'admin@mail.com', 1, 10, 1442990371, 1442990371),
(7, 'tomo', 'tomo', 1, '', 'QxQyhzZYiC2Zyak169rvtIT4MF0bgNMQ', '$2y$13$l71I/CuZhhWVwOPy15NO.eOzcl77OozZ6dKeqR1ag0wUljOA./ax.', NULL, 'adsadsa', 1, 10, 1452833064, 1452833064);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_language`
--
ALTER TABLE `apps_language`
  ADD PRIMARY KEY (`apps_language_id`),
  ADD KEY `lang_iso_code` (`apps_language_iso_code`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attribute_id`,`apps_language_id`),
  ADD KEY `id_lang` (`apps_language_id`,`name`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`attribute_value_id`,`apps_language_id`);

--
-- Indexes for table `attribute_value_combination`
--
ALTER TABLE `attribute_value_combination`
  ADD PRIMARY KEY (`attribute_value_combination_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `brands_banner`
--
ALTER TABLE `brands_banner`
  ADD PRIMARY KEY (`brand_banner_id`);

--
-- Indexes for table `brands_banner_detail`
--
ALTER TABLE `brands_banner_detail`
  ADD PRIMARY KEY (`brands_banner_detail_id`);

--
-- Indexes for table `brands_collection`
--
ALTER TABLE `brands_collection`
  ADD PRIMARY KEY (`brands_collection_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_parent` (`id_parent`),
  ADD KEY `nleftrightactive` (`active`),
  ADD KEY `level_depth` (`level_depth`),
  ADD KEY `activenleft` (`active`),
  ADD KEY `activenright` (`active`);

--
-- Indexes for table `category_detail`
--
ALTER TABLE `category_detail`
  ADD PRIMARY KEY (`category_id`,`apps_language_id`),
  ADD KEY `category_name` (`name`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`departement_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `homebanner`
--
ALTER TABLE `homebanner`
  ADD PRIMARY KEY (`homebanner_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `journal_category`
--
ALTER TABLE `journal_category`
  ADD PRIMARY KEY (`journal_category_id`);

--
-- Indexes for table `journal_related`
--
ALTER TABLE `journal_related`
  ADD PRIMARY KEY (`journal_related_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_group`
--
ALTER TABLE `module_group`
  ADD PRIMARY KEY (`module_group_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`product_attribute_id`),
  ADD KEY `id_product_id_product_attribute` (`product_attribute_id`);

--
-- Indexes for table `product_attribute_combination`
--
ALTER TABLE `product_attribute_combination`
  ADD PRIMARY KEY (`product_attribute_combination_id`);

--
-- Indexes for table `product_attribute_image`
--
ALTER TABLE `product_attribute_image`
  ADD PRIMARY KEY (`id_product_attribute`,`product_image_id`),
  ADD KEY `id_image` (`product_image_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_category_brands`
--
ALTER TABLE `product_category_brands`
  ADD PRIMARY KEY (`product_category_brands_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`product_id`,`apps_language_id`),
  ADD KEY `id_lang` (`apps_language_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `product_feature`
--
ALTER TABLE `product_feature`
  ADD PRIMARY KEY (`product_feature_id`);

--
-- Indexes for table `product_feature_value`
--
ALTER TABLE `product_feature_value`
  ADD PRIMARY KEY (`feature_value_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD UNIQUE KEY `id_product_cover` (`product_id`,`cover`),
  ADD UNIQUE KEY `idx_product_image` (`product_image_id`,`product_id`,`cover`),
  ADD KEY `image_product` (`product_id`);

--
-- Indexes for table `product_related`
--
ALTER TABLE `product_related`
  ADD PRIMARY KEY (`product_related_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`product_stock_id`),
  ADD UNIQUE KEY `product_sqlstock` (`product_id`,`product_attribute_id`),
  ADD KEY `id_product` (`product_id`),
  ADD KEY `id_product_attribute` (`product_attribute_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_id`,`product_tag_detail_id`),
  ADD KEY `id_tag` (`product_tag_detail_id`),
  ADD KEY `id_lang` (`product_tag_detail_id`);

--
-- Indexes for table `product_tag_detail`
--
ALTER TABLE `product_tag_detail`
  ADD PRIMARY KEY (`product_tag_detail_id`),
  ADD KEY `tag_name` (`name`),
  ADD KEY `id_lang` (`apps_language_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `stores_brands`
--
ALTER TABLE `stores_brands`
  ADD PRIMARY KEY (`stores_brands_id`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_language`
--
ALTER TABLE `apps_language`
  MODIFY `apps_language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attribute_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `attribute_value_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `attribute_value_combination`
--
ALTER TABLE `attribute_value_combination`
  MODIFY `attribute_value_combination_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `brands_banner`
--
ALTER TABLE `brands_banner`
  MODIFY `brand_banner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `brands_banner_detail`
--
ALTER TABLE `brands_banner_detail`
  MODIFY `brands_banner_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `brands_collection`
--
ALTER TABLE `brands_collection`
  MODIFY `brands_collection_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `departement_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homebanner`
--
ALTER TABLE `homebanner`
  MODIFY `homebanner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `journal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `journal_category`
--
ALTER TABLE `journal_category`
  MODIFY `journal_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `journal_related`
--
ALTER TABLE `journal_related`
  MODIFY `journal_related_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `module_group`
--
ALTER TABLE `module_group`
  MODIFY `module_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `product_attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `product_attribute_combination`
--
ALTER TABLE `product_attribute_combination`
  MODIFY `product_attribute_combination_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_category_brands`
--
ALTER TABLE `product_category_brands`
  MODIFY `product_category_brands_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_feature`
--
ALTER TABLE `product_feature`
  MODIFY `product_feature_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_feature_value`
--
ALTER TABLE `product_feature_value`
  MODIFY `feature_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_related`
--
ALTER TABLE `product_related`
  MODIFY `product_related_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `product_stock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `product_tag_detail`
--
ALTER TABLE `product_tag_detail`
  MODIFY `product_tag_detail_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `stores_brands`
--
ALTER TABLE `stores_brands`
  MODIFY `stores_brands_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
