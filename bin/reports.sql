-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 07:51 AM
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
-- Database: `mcirepositori`
--

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
(4, 'Survey Telkomsel One', NULL, 'survey_telkomsel_one.png', 'fixed', 'pdf', 'Survey_Telkomselone.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(5, 'PreStudy Dragon Survey', NULL, 'prestudy_dragon_survey.png', 'fixed', 'pdf', 'Result_Pre-Study Project Dragon.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(6, 'SURVEY ADD ON', NULL, 'survey_addon.png', 'fixed', 'pdf', 'Result Add on Survey.pdf', NULL, '2024-08-14 07:46:10', 0, 0),
(7, 'Are mobile and fixed broadband substitutes or complements? New empirical evidence from Italy and implications for the digital divide policies.', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies.', 'solution.jpg', 'fixed', 'article', 'Are mobile and fixed broadband substitutes or complements (2020).pdf', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies. In developed nations, a lot of broadband plans use the assumption that mobile and fixed technologies may be used interchangeably, with bandwidth performance being the main source of restrictions. In this study, we examine the variables affecting people’s private use of mobile broadband to access the Internet through smartphones, taking into account the impact of various Internet applications and the availability of fixed broadband at home. \n<p>From this research econometric analysis, based on microdata from Italian individuals, reveals several key findings:</p> \n       <ul>\n    <li>Mobile and fixed broadband are complementary for activities such as browsing, video streaming, gaming, and cloud services.</li>\n    <li>A substitution effect is observed for social networking and music streaming.</li>\n</ul>\n\n<p>Different types of Internet usage require distinct broadband characteristics, not just in terms of bandwidth, but also in aspects like data allowances and ease of connectivity with other devices.</p>\n\n<p>Overall, Internet activities that demand more bandwidth and data (such as video streaming and cloud services), or are best experienced on home devices (like browsing on desktops with large monitors or streaming on smart-TVs), are more likely to drive mobile broadband adoption when a fixed broadband connection is available at home.</p>', '2024-08-12 03:02:10', 0, 0),
(8, 'Customer Experience, Loyalty and Churn in Bundled Telecomunications Services', 'The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. ', 'banner.png', 'fixed', 'article', 'customer experience, loyalty, and churn in bundled telecommunications services (2024).pdf', '<p>The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. Gaining an extensive knowledge of the variables impacting telecom operators\' decisions to switch providers for bundled services is the main goal of this research. Quantitative research involving 3,004 users of bundled services from a Portuguese telecom operator is included in the paper. Using logit regression and covariance-based structural equation modeling, the study reveals that:</p>  <ul>     <li>service quality, satisfaction, and customer experience have emerged as the supports of decision-making that play a crucial role in two key aspects</li>     <li>Customers without loyalty contracts are more likely to churns, experiencing a churn probability that is 10% to 18% higher compared to customers with loyalty contracts</li> <li>Customers who are administratively tied to a particular service provider are less likely to consider competing offers, as they are subjected to penalties if they try to switch operators</li> </ul>  <p>This study offers telecommunications managers insights for identifying the main factors to retain customers and curbing customer defection. Additionally, it provides a framework for assessing customer experience within bundled telecom services, which is useful for researchers, managers and marketing practitioners alike.</p>', '2024-08-12 09:59:10', 0, 0),
(9, 'Factors influencing the effects of the Starlink Satellite Project on the internet service provider market in Thailand', 'This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand.', 'satelite.webp', 'fixed', 'article', 'Factors influencing the effects of the Starlink Satellite Project in Thailand (2023).pdf', '<p>This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand. A convenience sampling technique was used to recruit 617 participants, who completed an online questionnaire. The study examined several independent variables, including demographic factors, such as gender, age, education, status and income, and user behavior, such as devices used for internet access, time spent online and social media platforms used. Binary regression was used to analyze the data. The results showed that the Starlink project had a significant impact on the competitive structure of the internet service provider market in Thailand. This impact was influenced by factors such as age, education, income, internet duration, mobile internet use, the use of social media platforms.</p>  \n\n<ul>\n\n<li>younger, more educated, and higher-income individuals tend to benefit more from the Starlink Satellite Project, likely due to their greater access to technology and willingness to adapt to new technologies.</li> \n    \n<li>Additionally, longer internet duration, increased mobile internet use, and frequent use of social media platforms such as Facebook and TikTok were also found to be significant predictors of the positive effects of the Starlink Satellite Project on the internet service.</li> \n\n</ul>  \n\n<p>These findings suggest that the impact of the Starlink Satellite Project may be most beneficial for those who are already well-connected and technologically savvy.</p>', '2024-08-22 07:37:46', 0, 0),
(10, 'Consolidated Report Juli 2024', NULL, 'consolidate_report_jul.png', 'digital insight', 'pdf', 'Consolidated Report 202407.pdf', NULL, '2024-09-03 03:10:58', 0, 0),
(11, 'Consolidated Report May 2024', NULL, 'consolidate_report_may.png', 'digital insight', 'pdf', 'Consolidated Report 202405.pdf', NULL, '2024-09-03 03:16:50', 0, 0),
(12, 'Consumer Study Mobile Jan 2024', NULL, 'consumer_study_Jan2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Jan 2024_final.pdf', NULL, '2024-09-06 09:18:49', 0, 0),
(13, 'Consumer Study Mobile Feb 2024', NULL, 'consumer_study_Feb2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Feb 2024_final.pdf', NULL, '2024-09-06 09:23:50', 0, 0),
(14, 'Consumer Study Mobile Mar 2024', NULL, 'consumer_study_Mar2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Mar 2024_final.pdf', NULL, '2024-09-06 09:27:36', 0, 0),
(15, 'Telkomsel Social Media Analysis Report Jan 2024', NULL, 'telkomsel_socialmedia_jan.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - January 2024 V2.0.pdf', NULL, '2024-09-09 03:32:05', 0, 0),
(16, 'Telkomsel Social Media Analysis Report Feb 2024', NULL, 'telkomsel_socialmedia_feb.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - February 2024 V3.pdf', NULL, '2024-09-09 03:32:05', 0, 0),
(17, 'Telkomsel Social Media Analysis Report Jul 2024', NULL, 'telkomsel_socialmedia_july.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - July 2024 V2.1.pdf', NULL, '2024-09-09 03:32:05', 0, 0),
(18, 'Telkomsel Social Media Analysis Report Jun 2024', NULL, 'telkomsel_socialmedia_june.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - June 2024.pptx.pdf', NULL, '2024-09-09 03:32:05', 0, 0),
(19, 'Telkomsel Social Media Analysis Report May 2024', NULL, 'telkomsel_socialmedia_may.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - May 2024 V2.4.pdf', NULL, '2024-09-09 03:32:05', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
