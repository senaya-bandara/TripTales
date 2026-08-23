-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2026 at 06:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wanderlanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogPost`
--

CREATE TABLE `blogPost` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(80) NOT NULL DEFAULT 'Travel Stories',
  `image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blogPost`
--

INSERT INTO `blogPost` (`id`, `user_id`, `title`, `content`, `category`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'A Journey Through the Misty Mountains of Ella', 'There is something special about arriving in Ella.\r\n\r\nAs the train slowly winds through the mountains, the landscape begins to change. Green tea plantations stretch across the hills, mist settles between the valleys, and small villages appear between the trees. By the time you arrive in Ella, it feels as though you have entered a completely different part of Sri Lanka.\r\n\r\nElla is one of those destinations where you don\'t need a strict itinerary. The best experiences often come from simply walking through the town, exploring the surrounding hills, enjoying a cup of tea, and watching the clouds move across the mountains.\r\n\r\nThe Journey to Ella\r\n\r\nFor many travellers, the journey itself is one of the highlights. The train ride through Sri Lanka\'s central highlands is famous for its breathtaking scenery. As the train moves through tunnels, forests and tea plantations, every turn seems to reveal another postcard-worthy view.\r\n\r\nIf you are travelling from Kandy, consider taking the train rather than travelling entirely by road. The slower journey allows you to appreciate the landscape and experience one of Sri Lanka\'s most memorable railway routes.\r\n\r\nThings to See and Do\r\n\r\nOne of the most popular attractions around Ella is the Nine Arches Bridge. Surrounded by dense green vegetation, this historic railway bridge is particularly beautiful when a train passes across it.\r\n\r\nFor travellers looking for a little more adventure, Ella Rock provides an excellent hiking experience. The trail takes you through forests and countryside before reaching a viewpoint overlooking the surrounding mountains.\r\n\r\nLittle Adam\'s Peak is another popular hike and is considerably easier. The climb is relatively short, making it a great option for travellers who want a mountain view without spending several hours on a challenging trail.\r\n\r\nDon\'t forget the Tea Country\r\n\r\nElla is surrounded by some of Sri Lanka\'s finest tea-growing regions. A visit to a tea plantation offers an opportunity to learn about how tea leaves are cultivated, harvested and processed.\r\n\r\nTake some time to speak with local people and enjoy freshly prepared Sri Lankan tea. These simple experiences often become the most memorable parts of a journey.\r\n\r\nThe Best Part of Ella\r\n\r\nPerhaps the best thing about Ella is its atmosphere.\r\n\r\nThere is no need to rush from one attraction to another. Spend the morning walking through the hills, enjoy lunch at a small local restaurant, watch the sunset from a viewpoint and finish the day with a warm cup of Ceylon tea.\r\n\r\nElla reminds us that travelling is not always about how many places we can visit. Sometimes, it is about slowing down and appreciating where we are.\r\n\r\nIf you are planning your next Sri Lankan adventure, put Ella on your list. The mountains, tea plantations, railway journeys and welcoming atmosphere make it a destination worth experiencing.', 'Destinations', 'https://images.squarespace-cdn.com/content/v1/5a3bb03b4c326d76de73ddaa/9732566d-6b33-4a1a-ba0c-1b73ed8848a4/The+Common+Wanderer-9888.jpg', '2026-08-23 12:01:55', '2026-08-23 12:03:27'),
(2, 2, 'A Perfect Day in Galle: History, Sea and Slow Travel', 'A Perfect Day in Galle: History, Sea and Slow Travel\r\n\r\nGalle is one of those places where history and everyday life exist side by side.\r\n\r\nWalking through the streets of Galle Fort, you can see old colonial buildings, small cafés, boutique shops and historic walls overlooking the Indian Ocean. It is a destination that is easy to explore at a relaxed pace, making it perfect for a day of slow travel.\r\n\r\nStart Your Morning at Galle Fort\r\n\r\nBegin your journey by walking through the historic streets of Galle Fort. Take your time exploring the narrow lanes and discovering the architecture that makes the fort unique.\r\n\r\nThe best way to experience the area is without a strict plan. Walk along the fort walls, stop at interesting buildings and enjoy the views of the ocean.\r\n\r\nExplore the Streets\r\n\r\nInside the fort, you will find a mixture of history and modern life. Small cafés and restaurants sit alongside historic buildings, while local businesses continue to operate within the old fortifications.\r\n\r\nTake your camera with you because almost every street offers an interesting photograph.\r\n\r\nWalk Along the Fort Walls\r\n\r\nAs the afternoon approaches, head towards the fort walls overlooking the ocean.\r\n\r\nThe sea breeze and wide views make this one of the best places to slow down and take a break. Watching the waves from the walls gives you a completely different perspective of Galle.\r\n\r\nSunset by the Ocean\r\n\r\nOne of the best ways to finish your visit is to stay until sunset.\r\n\r\nAs the sun begins to disappear over the horizon, the walls and buildings of the fort take on a warm golden glow. Locals and travellers gather along the walls, creating a relaxed atmosphere.\r\n\r\nWhy Visit Galle?\r\n\r\nGalle is more than just a historical attraction. It is a place where you can combine history, culture, food and the ocean in a single trip.\r\n\r\nYou don\'t need several days to appreciate the fort, but you may find yourself wanting to stay longer.\r\n\r\nSometimes the best travel experiences are the simplest ones: walking without a schedule, discovering a new street and watching the sunset by the sea.', 'Travel Stories', 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/a3/63/0c.jpg', '2026-08-23 12:05:12', '2026-08-23 12:05:12'),
(3, 3, 'Chasing Waterfalls: A Day in the Green Heart of Sri Lanka', 'Sri Lanka is full of places where nature feels untouched, and its waterfalls are some of the best examples.\r\n\r\nAway from the busy cities and popular tourist attractions, you can find waterfalls hidden among forests, mountains and small villages. A day spent exploring these places can turn an ordinary weekend into a memorable adventure.\r\n\r\nThe Journey Begins\r\n\r\nThe best part of a waterfall adventure is often the journey itself.\r\n\r\nAs you leave the main roads behind, the scenery gradually changes. Buildings become less frequent, the roads become narrower and green hills begin to surround you.\r\n\r\nAlong the way, stop at small roadside shops and enjoy a cup of freshly prepared tea. These simple moments are often just as enjoyable as reaching the final destination.\r\n\r\nWalking Through Nature\r\n\r\nMany waterfalls require a short walk or hike to reach.\r\n\r\nThe paths may take you through tea plantations, forests and small streams. Take your time and enjoy the sounds of nature around you.\r\n\r\nListen to the birds, watch the changing landscape and enjoy the cool mountain air.\r\n\r\nReaching the Waterfall\r\n\r\nAfter the walk, the sound of rushing water becomes louder.\r\n\r\nSuddenly, the trees open up and the waterfall appears.\r\n\r\nThe cool mist from the water and the surrounding greenery create a refreshing atmosphere. Take a moment to simply enjoy the view before reaching for your camera.\r\n\r\nA Picnic in the Hills\r\n\r\nOne of the best ways to enjoy a waterfall trip is to bring a simple picnic.\r\n\r\nFresh fruit, sandwiches and a bottle of water are usually enough. Find a safe place away from the edge of the waterfall and enjoy lunch surrounded by nature.\r\n\r\nRemember to keep the area clean and take all your rubbish with you.\r\n\r\nTravel Responsibly\r\n\r\nNatural attractions are beautiful because they are relatively untouched.\r\n\r\nWhen visiting waterfalls and forests, avoid leaving plastic or other waste behind. Stay on safe paths, respect local communities and avoid entering areas where swimming or climbing is dangerous.\r\n\r\nSmall actions from every traveller can help protect these places for future visitors.\r\n\r\nThe Perfect Escape\r\n\r\nA waterfall adventure doesn\'t need to be complicated.\r\n\r\nYou don\'t need an expensive hotel or a long itinerary. Sometimes all you need is a free day, a comfortable pair of shoes and the curiosity to explore somewhere new.\r\n\r\nSri Lanka\'s natural beauty is often found beyond the famous attractions. Take the road less travelled, explore the green hills and you may discover a place that becomes one of your favourite memories.', 'Experiences', 'https://do6raq9h04ex.cloudfront.net/sites/8/2023/07/Chasing-Waterfalls-The-5-Most-Spectacular-Cascades-of-Nuwara-Eliya-1050x700-1.jpg', '2026-08-23 12:07:28', '2026-08-23 12:07:28'),
(4, 1, 'Ella — Where the Mountains Meet the Clouds', 'There are places in Sri Lanka where the journey itself becomes part of the adventure, and Ella is one of them. Surrounded by mist-covered mountains, tea plantations, waterfalls and winding roads, this small hill-country town offers a perfect escape from the noise of everyday life.\r\n\r\nOne of the best ways to experience Ella is by simply slowing down. Walk through the tea estates, watch the clouds drift across the mountains, or take a train ride through the spectacular hill country. The famous railway journey between Kandy and Ella is especially memorable, with green valleys, tunnels, bridges and dramatic mountain views appearing along the way.\r\n\r\nElla also offers plenty for those looking for adventure. A hike to Little Adam\'s Peak provides a relatively easy climb with beautiful panoramic views. For a more challenging experience, Ella Rock takes you deeper into the surrounding landscape and rewards the effort with an impressive view over the valley.\r\n\r\nAnother unforgettable stop is Nine Arches Bridge. Hidden between lush greenery and tea-covered hills, the historic railway bridge is one of the area\'s most photographed landmarks. Watching a train slowly cross the bridge makes the experience even more special.\r\n\r\nBut perhaps the greatest attraction of Ella is its atmosphere. The cool mountain air, friendly local communities and relaxed pace make it easy to forget about time.\r\n\r\nElla is more than a destination. It is a place to pause, breathe, explore and create memories that stay long after the journey ends.', 'Destinations', 'https://static1.evcdn.net/images/reduction/1211758_w-3840_h-2160_q-70_m-crop.jpg', '2026-08-23 16:37:40', '2026-08-23 16:37:40'),
(5, 2, 'Arugam Bay: Riding the Waves of Sri Lanka', 'As the morning sun rises over Sri Lanka\'s eastern coast, the waves begin to roll gently toward the shore. Surfers gather along the beach, boards under their arms, waiting for the perfect wave. Welcome to Arugam Bay, one of Sri Lanka\'s most famous surfing destinations.\r\n\r\nArugam Bay has a relaxed atmosphere that makes it easy to forget about time. During the surfing season, the coastline comes alive with travellers from around the world, all drawn by the warm water, tropical weather and consistent waves.\r\n\r\nFor experienced surfers, the main surf point offers long, powerful rides when conditions are right. Beginners can also find quieter stretches of coastline where they can learn the basics with the help of local instructors.\r\n\r\nBut surfing in Arugam Bay is about more than standing on a board. After a morning in the water, there is something special about walking barefoot along the beach, enjoying a fresh tropical meal or watching the sunset over the ocean.\r\n\r\nThe surrounding area offers plenty to explore as well. Lagoons, wildlife and quiet villages provide a completely different experience from the surf breaks. A short journey away can take you from the energy of the beach into peaceful natural landscapes.\r\n\r\nPerhaps the most memorable part of Arugam Bay is its community. Surfers, local fishermen, travellers and small businesses come together to create an atmosphere that feels welcoming and unhurried.\r\n\r\nWhether you\'re catching your first wave or simply watching surfers from the shore, Arugam Bay is a place where the ocean sets the rhythm of the day.\r\n\r\nSometimes the best journeys are the ones that follow the waves.', 'Experiences', 'https://lushpalm.com/wp-content/uploads/2017/08/surfing-sri-lanka-mirissa.jpg', '2026-08-23 16:39:49', '2026-08-23 16:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'senaya', 'senayabandara@gmail.com', '$2y$10$3m4H65ZbAfammSvX6ojhnerVfr0YHJCxFxZL0Wk6JY1xFqXdwiNlC', 'user', '2026-08-23 12:00:20'),
(2, 'uvini', 'uvini@gmail.com', '$2y$10$LLrkuCtzEQPAv0p6xf.zQ.tqsQ0EACjHBsAbzbpd1zb1QHA9amAtC', 'user', '2026-08-23 12:04:15'),
(3, 'shehani', 'shehani@gmail.com', '$2y$10$Xja.AOE0MsNzHBRlf96DT.n2teUwIxNmRO2oSWGeSVICI2GbOfjNi', 'user', '2026-08-23 12:06:11'),
(4, 'nelithma', 'nelithma@gmail.com', '$2y$10$libpMVED0m5SMv2rsEigVOjDWYc2Ka8/9VZnQOlVl8C2L/OPmcwiu', 'user', '2026-08-23 16:38:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogPost`
--
ALTER TABLE `blogPost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_blog_user` (`user_id`),
  ADD KEY `idx_blog_category` (`category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogPost`
--
ALTER TABLE `blogPost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
