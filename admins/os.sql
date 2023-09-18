-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 02:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `os`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `aaa` int(11) NOT NULL,
  `bbb` int(11) NOT NULL,
  `ccc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'personal care');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `added_date` date DEFAULT NULL,
  `permission` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `description`, `category`, `sub_category`, `added_date`, `permission`) VALUES
(1, 'Solimo Bamboo Fresh Body Lotion', 'No Paraben, Sulphates, Phthlates, Mineral Oil, 100% Vegan, 400 ml .\r\n•	Premium body lotion for daily use \r\n•	Refreshing rustic scent of bamboo mixed w', '1', '1', '2021-02-02', 1),
(2, 'Nivea Nourishing Lotion ', 'Nivea body lotion, nourishing body milk, for very dry skin, 400ml<br>Lasting moisturisation : The deep moisture serum formula gives you moisturized sk', '1', '1', '2021-02-02', 1),
(3, 'Joy Honey & Almonds Advanced Nourishing Body Lotion', 'Advanced nourishing body lotion with a perfect balance of Almond Oil and Honey along with Vitamin E and Aloe Vera <br>Offers deep nourishment and mois', '1', '1', '2021-02-02', 1),
(4, 'Lotus Herbals', 'Quantity: 300ml; Item Form: Cream <br>Focus on dry or stressed areas such as elbows, heels, and knees \r\nCan be used any time your skin is feeling part', '1', '1', '2021-02-02', 1),
(5, 'Vaseline Intensive Care Deep Moisture Body Lotion', 'Vaseline Deep Moisture Body Lotion is India’s No.1 Best-Selling Body Lotion <br>It’s double-action formula contains Glycerin which helps to replenish ', '1', '1', '2021-02-02', 1),
(6, 'Parachute Advansed Body Lotion Deep Nourish', 'Parachute Advance Body Lotion has unique Cocolipid Formula which goes 10 layers deep** in the skin to boost your natural glow<br>Non-sticky fast absor', '1', '1', '2021-02-02', 1),
(7, 'Himalaya Herbals Cocoa Butter Intensive Body Lotion', 'Quantity: 400ml Item Form: Lotion<br>Our moisturizer is enriched with the goodness of Cocoa Butter and Wheat Germ Oil which replenish the lost moistur', '1', '1', '2021-02-02', 1),
(8, 'Mamaearth Vitamin C Body Lotion with Vitamin C & Honey for Radiant Skin ', 'DEEP HYDRATION: Vitamin C promotes even complexion and has anti-aging benefits. Honey soothes, hydrates, and reduces dullness<br> Daily use of the bod', '1', '1', '2021-02-02', 1),
(9, 'Enchanteur Romantic Perfumed Body Lotion', 'Moisture silk aloevera and olive butter <br>\r\nFor beautifully soft silky smooth skin <br>\r\n', '1', '1', '2021-02-02', 1),
(10, 'Yardley London English Lavender Moisturising Hand & Body Lotion', 'Infused with \"flower power\" of natural floral extracts <br>Contains the goodness of 10000 active floral cells in every 100 ml for beautifully soft and', '1', '1', '2021-02-02', 1),
(11, 'Dove Light Hydration Body Lotion', 'Enriched with NutriDUO this rich formula goes beyond the surface to nourish skin 10 layers deep <br>Delivers rich nourihsment yet feel so light  <br>D', '1', '1', '2021-02-02', 1),
(12, 'POND\'S Triple Vitamin Moisturising Body Lotion', 'Body lotion for silky soft, smooth, radiant skin<br>Triple Vitamin moisturizing lotion <br>Gives skin nourishment revealing an amazingly soft skin <br', '1', '1', '2021-02-02', 1),
(13, 'Stayfree Dry Max All Night XL Dry Cover Sanitary Pads For Women Combo 2 Plus 1 Free 3 x 42s (126 pad', 'Stayfree All night dry max sanitary pads for women for all night protection <br>2x better coverage extra long and extra wide sanitary napkins for all ', '1', '2', '2021-02-18', 1),
(14, 'Stayfree Advanced Extra Large All Night Soft Cover Sanitary Pads For Women With Wings, 28 Pads ', '2X better coverage**- extra long and extra wide for all round protection through the night<br>Extra Large with wings-For night flow or heavy flow-Indi', '1', '2', '2021-02-18', 1),
(15, 'Whisper Ultra Clean Sanitary Pads for Women, XL+ 50 Napkins ', 'Locks upto 100% wetness, even odours <br>Odour lock gel that gives you hygienic protection<br> Nearly 40% longer for more coverage vs. Whisper choice ', '1', '2', '2021-02-18', 1),
(16, 'Raho Safe Sanitary Pad Regular with Biodegradable Disposable Bags (40 Pads Count) ', 'Leak proof - Raho Safe Sanitary Pads are 100% leak proof <br>5 layer protection - It provides 5 layer protection <br>Floral fragrance - The floral fra', '1', '2', '2021-02-18', 1),
(17, 'EverEve Ultra Absorbent Heavy Flow Disposable Period Panties for Sanitary Protection M-L (Pack of 2)', 'Innovative Everlock Technology that gives 360° all-round protection to prevent front, back or side leakage<br> Super absorbent micro-beads instantly l', '1', '2', '2021-02-18', 1),
(18, 'Purastep Silicone Gel Heel Pad Socks for Pain Relief for Men and Women (Beige Free Size) - 1 Pair', 'Orthopedic silicone heel protectors: protects heel bone from extreme pressure fatigue and strain prevents thickening of heel skin keeps heel safe from', '1', '3', '2021-02-25', 1),
(19, 'Purastep Unisex Flat Arch Support Pad Socks for Foot Pain Relief, Free Size - 1 Pair ', 'Support pad socks <br>For foot pain relief <br>Package Contains: 1 pair <br>\r\n', '1', '3', '2021-02-25', 1),
(20, 'Purastep Silicone Gel Heel Protector ', 'Gel heel cups provide exceptional support for the heel and ankle reducing pain fatigue and swelling<br> Relieves foot pain caused by heel spurs bone s', '1', '3', '2021-02-25', 1),
(21, 'Lifelong LLPCW04 Rechargeable Pedicure Device for Callus & Dead Skin Removal & Feet Care ', '1 year brand warranty from date of purchase. Full refund of money or replacement with brand new product in case of any manufacturing defect IPX7 water', '1', '3', '2021-02-25', 1),
(22, 'VLCC Pedicure And Manicure Kit ', 'Quantity: Item Form: Oil Cream Organic Product <br>VLCC Natural Science Hand and Foot Care Kit with Ayur Lotion 50 ml<br> From face care body care to ', '1', '3', '2021-02-25', 1),
(23, 'Tony Stark® Foot File Set- Dead Hard ', 'Made of plastic plus stainless steel, which is durable and not easily to deform <br> Contains different foot files, which is more convenient and pract', '1', '3', '2021-02-25', 1),
(24, 'VLCC Pedi Glow Foot Care Kit (Combo Of 4) ', 'Moisturising your feet<br> Smoothened<br> Provides perfect solutions for all foot problems for men and women<br>Country of Origin: India <br>\r\n', '1', '3', '2021-02-25', 1),
(25, 'Himalaya Herbals Foot Care Cream - 20 grams ', 'Heals cracked heals<br> Moisturizes feet<br> Softens feet <br>\r\n', '1', '3', '2021-02-25', 1),
(26, 'GUBB USA Pumice Stone For Feet Foot Dead Skin Remover With Rubber Grip Pedicure Tool For Women & Men', 'For Women and Men <br>\r\nPumice Stone for Feet <br>\r\nFoot Dead Skin Remover <br>\r\n', '1', '3', '2021-02-25', 1),
(27, 'Alexvyan Silicone Gel Orthotic Toe and Finger Separator Cushion Foot Care (Blue) - 1 Pair ', 'Relax those tense toes into a gentle stretch<br> Special for manicure pedicure and nail art<br> Can help many feet related problems including: hammert', '1', '3', '2021-02-25', 1),
(28, 'Mehta Ayurvedic Pharmacy Foot-O-Fresh Foot Spray Foot Care Solution Herbal Formulation - 125 ml (Pac', 'Prevents foul foot odour Diabetic foot care Keeps your feet feeling fresh all day <br>Controls excess foot perspiration \r\n<br>Softens the skin of foot', '1', '3', '2021-02-25', 1),
(29, 'Hair & Care Fruit Oils Green 300ml with Free 100ml ', 'Hair & Care packs the solid nourishment and essentials of fruits for the first time in hair oils in an absolutely new and exciting avatar – “Fruit Oil', '1', '4', '2021-03-01', 1),
(30, 'WOW Skin Science Onion Black Seed Oil Ultimate Hair Care Kit (Shampoo + Hair Conditioner + Hair Oil)', 'Get strong and lustrous hair with this hair kit<br>This kit contains onion oil shampoo onion oil conditioner and onion hair oil which helps to revive ', '1', '4', '2021-03-01', 1),
(31, 'Anti-Hair fall complete care kit - For Healthy & Strong Hair with Amla Bhringraj & Coffee Oils ', 'STRENGTHENS HAIR BY 77 percent<br> NOURISHES & MOISTURIZES <br>AMLA AND BHRINGRAJ OILS CONTROL HAIR FALL<br> HAIR DETOX SYSTEM <br>Inclusions:NATURAL ', '1', '4', '2021-03-01', 1),
(32, 'L\'Oreal Paris Extraordinary Oil Hair Serum for Women and Men', 'THE L\'OREAL PARIS SERUM DEEP NOURISHMENT - L\'Oral Paris Extraordinary Oil Hair Serum gives luscious lightweight hair oil serum for dry hair lifeless h', '1', '4', '2021-03-01', 1),
(33, 'L\'Oreal Paris Total Repair 5 Shampoo 704ml Combo with Conditioner 192.5ml + Serum 40ml FREE ', 'Shampoo: fights the 5 signs of hair damage <br>Conditioner - protects and conditions hair  <br>Serum - ensures smooth, frizz-free hair   <br>Salicylic', '1', '4', '2021-03-01', 1),
(34, 'Biotique Bio Musk Root Fresh Growth Nourishing Treatment 230g ', 'Quantity: 230g; Ayurvedic hair and Scalp Rejuvenating Pack <br>Enriched with Musk Root and Bael extracts to reduce inflammation and restore rich natur', '1', '4', '2021-03-01', 1),
(35, 'Biotique Bio Mountain Ebony Vitalizing Serum For Falling Hair Intensive Hair Growth Treatment 120ML ', 'Quantity: 120ml; Item Form: Lotion <br>Promotes new and healthy hair growth<br> Sulfate Free : No<br> \r\nStimulates hair from root to tip and leaves sc', '1', '4', '2021-03-01', 1),
(36, 'L\'Oreal Paris Smooth Intense Serum 100ml ', 'Crème Formula <br>Nourishes Hair And Calms Frizz; Cleansing Hair From Root To Tip. Organic: Yes. Sulfate free: No <br>Transforms Unruly And Dry Hair T', '1', '4', '2021-03-01', 1),
(37, 'Dabur Ayurvedic Shampoo 640ml : Power of Dus Poshan for 10 Hair Problems ', 'Dabur Ayurvedic Shampoo has the power of 10 Natural Ingredients – Yashtimadhu, Bhringraj Aloe Vera Henna Methi Amla Reethi Almond Rosemary Javakusum <', '1', '4', '2021-03-01', 1),
(38, 'Dove Hair Fall Rescue Shampoo', 'Strengthening Dove shampoo formulated to help prevent hair fall <br>Reduces hair fall by up to 98 percent. Container Type: Plastic Bottle<br> Deeply n', '1', '4', '2021-03-01', 1),
(39, 'Adbeni Special Combo Makeup Sets Pack of 6-C365 ', 'Formation: Foundation:Liquid Compact Powder:Pressed Powder Eyelipliner:Pencil Kajal:Stick Eyeliner:Liquid<<br> \r\nShade: Multi<br> Quantity: Foundation', '1', '5', '2021-03-03', 1),
(40, 'Maybelline New York Colossal Kajal  Black 0.35g ', 'New colossal kajal lasts upto 24 hours <br>Smudge proof and water proof formula <br>Deep intense black colour with sharp definition <br>Boosted with a', '1', '5', '2021-03-03', 1),
(41, 'lowprice 6-in-1 Makeup Sponge (Multicolour) ', 'Colour: Multicolour<br> This sponge suitable for a wide variety of cosmetics such as bb cream concealer foundation blush<br> \r\n6-in-1 Makeup Sponge <b', '1', '5', '2021-03-03', 1),
(42, 'Adbeni All In One Daily Uses Beauty Pack Home Salon Kit with Gift Pack Makeup Pouch GC-929 ', '1pc Foundation, 1pc Kajal, 1pc Stick Sindoor 1pc Lipstic 1pc Velvet Matte N.P 2pc Nail Art 1pc Nail Remover 32pad 1pc 10 Color Eyeshadow 1pc Eyeliner ', '1', '5', '2021-03-03', 1),
(43, 'TYA Makeup kit + 5 pcs Makeup Brush + 2 pc Blender Puff Combo ', 'Two shades compact powders<br> High shine eye shadows <br>Juicy lip colours <br>24 Shades of Eye 3 Shades of Blush 2 Face Powders (1 Shimmer & 1 Non-S', '1', '5', '2021-03-03', 1),
(44, 'Lakme Complexion Care Face Cream', 'Provides UV Protection<br> Moisturizes<br> \r\nConceals<br> Gives Smooth Coverage<br> \r\nLightens Skin <br>Evens skin tone<br> \r\n', '1', '5', '2021-03-03', 1),
(45, 'House of Quirk Makeup Cosmetic Storage Case with Adjustable Compartment - Black(25x22x9cm) ', ' A Must-have for Girls to Store up Cosmetics: Versatile cosmetics storage case decorated with brush slots can keep everything organized provide ample ', '1', '5', '2021-03-03', 1),
(46, 'Maybelline Fit Me Compact Light Ivory 8 g ', 'Gives a naturally perfect-looking complexion<br> Helps you stay 12 hr fair and fresh <br>Contains SPF 28 to protect your skin <br>Suitable for everyda', '1', '5', '2021-03-03', 1),
(47, 'GOPINATHJI® Cosmetic Storage Box Multi Functional Desktop Storage Boxes Drawer Makeup Organizers Sto', 'Cosmetic Storage Box Multi Functional Desktop Storage Boxes Drawer Makeup Organizers Storage Boxes (Colour Multi) \r\nDesk makeup organiser with drawer ', '1', '5', '2021-03-03', 1),
(48, 'Maybelline New York Hypercurl Mascara Waterproof Black 9.2ml ', 'Volume: Wax coating & special bristles that can reach the lash line up to the tip Gives 75% curled effect with a thick pad and lasts 3 times longer wi', '1', '5', '2021-03-03', 1),
(49, 'Lakme Eyeconic Kajal Deep Black', 'Smudge proof and convenient twist- up format for deep stroke. Pencil Form <br>Water proof, lasts up to 22 hrs  <br>\r\nIt is dermatologically tested and', '1', '5', '2021-03-03', 1),
(50, 'Listerine Cool Mint Mouthwash ', 'This pack contains 3 units of Listerine Cool Mint Mouthwash 250 ml <Br>Brushing can miss a billion germs which may lead to various oral problems like ', '1', '6', '2021-03-04', 1),
(51, 'Colgate Strong Teeth Anticavity Toothpaste with Amino Shakti ', 'Colgate Strong Teeth is India’s No.1 Toothpaste now comes in it’s Best Ever formulation - With Amino Shakti <br>It helps add natural calcium to your t', '1', '6', '2021-03-04', 1),
(52, 'Health Vit Activated Charcoal Powder for Natural Teeth Whitening', 'Premium natural activated coconut charcoal teeth whitening solution<br> 100 percent natural, pure and safe for your teeth <br>\r\nWe make a point of usi', '1', '6', '2021-03-04', 1),
(53, 'Colgate Vedshakti Mouth Protect Spray - 10gm (Pack of 3) ', 'Your mouth is the gateway for germs to enter your body<br> Colgate Vedshakti Ayurvedic Natural Mouth Protect Spray helps protect your mouth by killing', '1', '6', '2021-03-04', 1),
(54, 'Delidge 1 pcs Tooth Orthodontic Dental Appliance Trainer Pro Alignment Braces Mouthpieces For Teeth ', 'Saving time: Without repeated visits<br> Simple: Patients can take on and off by themselves<br>Efficient: Short treatment cycle and never rebounded<br', '1', '6', '2021-03-04', 1),
(55, 'Colgate Gentle Enamel Ultra Soft Toothbrush - 4 Pcs ', 'Colgate Gentle Enamel Toothbrush is a super-soft toothbrush specially designed to protect your tooth enamel <br>Colgate Gentle Enamel Toothbrush is ma', '1', '6', '2021-03-04', 1),
(56, 'Sensodyne Sensitive Toothbrush (2+1 Pack) ', 'Specially designed for people with sensitive teeth<br> Provides effective cleaning of the teeth<br> \r\nBroad ergonomic handle ensures comfortable grip ', '1', '6', '2021-03-04', 1),
(57, 'Oral B Pro health Toothbrush Medium ', 'Removes up to 90 percent of plaque in hard-to-reach places <br>Helps improve gum health in four weeks by reducing gingivitis <br>Removes surface stain', '1', '6', '2021-03-04', 1),
(58, 'Dabur Red Paste 600g (Buy 3 Get 1 Free) ', 'Formulated with traditional Indian medicines<br> Protects from all sorts of dental problems and helps with sensitive teeth<br> Reduction in gingivitis', '1', '6', '2021-03-04', 1),
(59, 'Closeup Everfresh+ Anti-Germ Gel Toothpaste Red Hot', 'Closeup Red Hot Everfresh+ Gel Toothpaste now in Triple Fresh Formula harnesses the combined power of 3 components keeping you protected and fresh<br>', '1', '6', '2021-03-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `new_orders`
--

CREATE TABLE `new_orders` (
  `new_orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_orders`
--

INSERT INTO `new_orders` (`new_orders_id`, `product_id`, `status`, `customer_id`, `order_type`) VALUES
(1, 1, 1, 1, 'booking'),
(2, 2, 1, 1, 'delivery'),
(3, 3, 1, 1, 'booking'),
(4, 4, 0, 1, 'delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `availablity` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `product_details_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`item_id`, `store_id`, `availablity`, `quantity`, `price`, `product_details_id`) VALUES
(1, 1, 'yes', '3', '300', 1),
(2, 1, 'yes', '4', '135', 2),
(3, 1, 'yes', '5', '170', 3),
(4, 1, 'yes', '2', '290', 4),
(5, 2, 'yes', '3', '300', 5),
(6, 2, 'yes', '4', '135', 6),
(7, 2, 'yes', '5', '170', 7),
(8, 2, 'yes', '2', '290', 8);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `opening_hours` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `longitude` varchar(150) NOT NULL,
  `latitude` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `opening_hours`, `address`, `status`, `longitude`, `latitude`) VALUES
(1, 'Store 1', '8AM - 10PM', 'street 1', 'open', '76.37327639001194', '10.305894094950643'),
(2, 'Store 2', '9AM to 9PM', 'street2', 'closed', '76.37765375509984', '10.314254133002027'),
(3, 'Store3', '8AM to 10PM', 'street3', 'closed', '76.36578613585569', '10.311223943015694'),
(4, 'Store 4', '9AM to 9PM', 'street4', 'closed', '76.38653', '10.30152');

-- --------------------------------------------------------

--
-- Table structure for table `store_admin`
--

CREATE TABLE `store_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_admin`
--

INSERT INTO `store_admin` (`id`, `username`, `password`) VALUES
(1, 'store1', '1234'),
(2, 'store2', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `sub_category_name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `sub_category_name`, `category_id`) VALUES
(1, 'body lotions', 1),
(2, 'femini', 1),
(3, 'foot care', 1),
(4, 'hair care', 1),
(5, 'make up', 1),
(6, 'mouth care', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` bigint(30) NOT NULL,
  `address` varchar(120) NOT NULL,
  `newsletter_status` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `address`, `newsletter_status`, `email`, `password`) VALUES
(1, 'krishnendu', 'r g', 123456789, 'dsedfdsfffffsfgdhsgdgaseywtgeytweyteyw', 1, 'krishnendugopi8592@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `new_orders`
--
ALTER TABLE `new_orders`
  ADD PRIMARY KEY (`new_orders_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_details_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
