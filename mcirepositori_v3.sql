-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 09:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcirepositori_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_report` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL,
  `image` text NOT NULL,
  `category` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `file` text NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `unlikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `desc`, `image`, `category`, `type`, `file`, `content`, `created_at`, `likes`, `unlikes`) VALUES
(1, 'Churn Indihome', NULL, 'churn_indihome.png', 'fixed', 'pdf', 'Report_Churn IndiHome Q2 2024.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(2, 'Indihome Loyalty Program', NULL, 'loyalti_program.png', 'fixed', 'pdf', 'Report_IndiHome Loyalty Program.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(3, 'EZNet by Telkomsel\r\nSurvey', NULL, 'eznet_telkomsel_survey.png', 'fixed', 'pdf', 'EZNet by Telkomsel Report Survey.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(4, 'Survey Telkomsel One', NULL, 'survey_telkomsel_one.png', 'fixed', 'pdf', 'Survey Telkomsel One.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(5, 'PreStudy Dragon Survey', NULL, 'prestudy_dragon_survey.png', 'fixed', 'pdf', 'Result_Pre-Study Project Dragon.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(6, 'SURVEY ADD ON', NULL, 'survey_addon.png', 'fixed', 'pdf', 'Result Add on Survey.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(7, 'Are mobile and fixed broadband substitutes or complements? New empirical evidence from Italy and implications for the digital divide policies.', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies.', 'solution.jpg', 'fixed', 'article', 'Are mobile and fixed broadband substitutes or complements (2020).pdf', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies. In developed nations, a lot of broadband plans use the assumption that mobile and fixed technologies may be used interchangeably, with bandwidth performance being the main source of restrictions. In this study, we examine the variables affecting people’s private use of mobile broadband to access the Internet through smartphones, taking into account the impact of various Internet applications and the availability of fixed broadband at home. \n<p>From this research econometric analysis, based on microdata from Italian individuals, reveals several key findings:</p> \n       <ul>\n    <li>Mobile and fixed broadband are complementary for activities such as browsing, video streaming, gaming, and cloud services.</li>\n    <li>A substitution effect is observed for social networking and music streaming.</li>\n</ul>\n\n<p>Different types of Internet usage require distinct broadband characteristics, not just in terms of bandwidth, but also in aspects like data allowances and ease of connectivity with other devices.</p>\n\n<p>Overall, Internet activities that demand more bandwidth and data (such as video streaming and cloud services), or are best experienced on home devices (like browsing on desktops with large monitors or streaming on smart-TVs), are more likely to drive mobile broadband adoption when a fixed broadband connection is available at home.</p>', '2024-08-12 03:02:10', 3, 0),
(8, 'Customer Experience, Loyalty and Churn in Bundled Telecomunications Services', 'The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. ', 'banner.png', 'fixed', 'article', 'customer experience, loyalty, and churn in bundled telecommunications services (2024).pdf', '<p>The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. Gaining an extensive knowledge of the variables impacting telecom operators\' decisions to switch providers for bundled services is the main goal of this research. Quantitative research involving 3,004 users of bundled services from a Portuguese telecom operator is included in the paper. Using logit regression and covariance-based structural equation modeling, the study reveals that:</p>  <ul>     <li>service quality, satisfaction, and customer experience have emerged as the supports of decision-making that play a crucial role in two key aspects</li>     <li>Customers without loyalty contracts are more likely to churns, experiencing a churn probability that is 10% to 18% higher compared to customers with loyalty contracts</li> <li>Customers who are administratively tied to a particular service provider are less likely to consider competing offers, as they are subjected to penalties if they try to switch operators</li> </ul>  <p>This study offers telecommunications managers insights for identifying the main factors to retain customers and curbing customer defection. Additionally, it provides a framework for assessing customer experience within bundled telecom services, which is useful for researchers, managers and marketing practitioners alike.</p>', '2024-08-12 09:59:10', 0, 0),
(9, 'Factors influencing the effects of the Starlink Satellite Project on the internet service provider market in Thailand', 'This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand.', 'satelite.webp', 'fixed', 'article', 'Factors influencing the effects of the Starlink Satellite Project in Thailand (2023).pdf', '<p>This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand. A convenience sampling technique was used to recruit 617 participants, who completed an online questionnaire. The study examined several independent variables, including demographic factors, such as gender, age, education, status and income, and user behavior, such as devices used for internet access, time spent online and social media platforms used. Binary regression was used to analyze the data. The results showed that the Starlink project had a significant impact on the competitive structure of the internet service provider market in Thailand. This impact was influenced by factors such as age, education, income, internet duration, mobile internet use, the use of social media platforms.</p>  \n\n<ul>\n\n<li>younger, more educated, and higher-income individuals tend to benefit more from the Starlink Satellite Project, likely due to their greater access to technology and willingness to adapt to new technologies.</li> \n    \n<li>Additionally, longer internet duration, increased mobile internet use, and frequent use of social media platforms such as Facebook and TikTok were also found to be significant predictors of the positive effects of the Starlink Satellite Project on the internet service.</li> \n\n</ul>  \n\n<p>These findings suggest that the impact of the Starlink Satellite Project may be most beneficial for those who are already well-connected and technologically savvy.</p>', '2024-08-22 07:37:46', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `category`, `description`, `link`, `created_at`) VALUES
(1, 'Voice of Customer', 'fixed', 'In Lean Six Sigma, the voice of the customer (VOC) refers to customer requirements and feedback.  Collecting the VOC helps us define and prioritize process improvement efforts.  Some methods for capturing the VOC include interviews, observations, surveys, reviews, etc.', 'https://youtu.be/Jzcxo_5ifjM?feature=shared', '2024-08-14 08:56:36'),
(2, 'Fixed Broadband di Indonesia', 'fixed', '', 'https://youtu.be/dGow7VXb81Y?feature=shared', '2024-08-14 09:03:40'),
(3, 'Top IPTV Reviews for 2024', 'fixed', '', 'https://youtu.be/kXDhALUDEpU?feature=shared', '2024-08-14 09:06:34'),
(4, 'I Compared the Best Internet Options! Which One Should You Choose?', 'fixed', '', 'https://youtu.be/Gxv-cNwXEh4?feature=shared', '2024-08-15 03:40:29'),
(5, 'Is 5G Home Internet BETTER Than Fiber?', 'fixed', '', 'https://youtu.be/9qHb6hQTGtk?feature=shared', '2024-08-15 07:42:45'),
(6, 'What Factors are Driving Fixed-Mobile Convergence? ', 'fixed', '', 'https://youtu.be/TSqIM8Bvdgs?feature=shared', '2024-08-15 07:48:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;