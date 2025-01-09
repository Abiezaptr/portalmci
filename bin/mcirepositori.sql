-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 11:05 AM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_report` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `likes` int(11) NOT NULL,
  `unlikes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `file` text NOT NULL,
  `keyword` text NOT NULL,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `type_id`, `product_id`, `user_id`, `name`, `thumbnail`, `description`, `summary`, `file`, `keyword`, `upload_date`) VALUES
(13, 2, 3, 22, 'Telkomsel One', 'survey_telkomsel_one.png', 'Telkomsel One’s Pain Points and  market awareness, consideration, and expectation', '<p> - 64.60% of respondents are interested in Telkomsel One products. They choose it for its combined services, affordability, and attractive offers. Key factors influencing their decision to purchase such network quality, package price suitability, and clarity of package information.​</p>\r\n<p>- 85.8% never heard of Telkomsel One. From respondent who received, 39.60% learned from social media, 19.8% from website ads. Moreover,  53.7% unfamiliar with the key visual, but find it nice and attractive. Median scores: offer attractiveness 70%, informativeness 68%.​</p>\r\n<p>- From the overall respondents, all the combination packages offered by Telkomsel One emerged as their preferred choices. Upon considering all the features, they found them suitable to their needs and were particularly interested in the ease and simplicity related features.​</p>\r\n<p>- 52.43% of users indicated that while the price is not considered affordable, the product offers excellent value for money.​</p>\r\n<p>- Both factors that consider Telkomsel one as affordability and value for money are attributed to its connectivity speed and quota offered.​</p>\r\n<p>- Only 6.52% have attempted to subscribe. My Telkomsel App remains the most favored sales channel for accessing Telkomsel One. Among both respondents who experiences subscription challenges (40.74%), and those who did not attempt to subscribe (93.48%), the main reason cited was a lack of understanding of Telkomsel One services​</p>\r\n<p>- IndiHome emerges as the top choice among respondents for future consideration, with some mentioning that cellular services alone are sufficient. Biznet and Telkomsel Orbit are following closely.\"</p>', 'Q1_2024_Survey_Telkomsel_One.pdf', 'Telkomsel One, indihome, awareness, consideration, expectation', '2024-07-04 17:13:34'),
(14, 1, 1, 22, 'Consumer Study FBB Jan\'24', 'consumer_jan.png', 'Monthly CSI, NPS, BEI track January 2024', '<p><strong>NPS Highlight : ​</strong></p>\r\n<p>- IndiHome NPS was stable at+ 50 in January\'24. In Area level, Western Jabotabek  IndiHome NPS Level improved +7, the highest in compared with previous period, contrast with Sumbagsel</p>\r\n<p>- Telkomsel Orbit NPS level was improved significantly (+73), mainly contributed by Area 2​</p>\r\n<p>- XL Satu Fiber  NPS declined –6 vs Q4 2023.​</p>\r\n<p>- As for Biznet, the NPS level was relatively stable with both Sumbagut and Jateng DIY, while PUMA suffered great loss.​</p>\r\n<p>- In terms of Speed of internet, IndiHome NPS level was relatively stable, while first media posted +20 and Biznet was +14 NPS level. Both improved.​</p>\r\n<p>- Reason for promoting IndiHome : Connectivity remained the primary reason to promote, Famous brand rose to fifth, while widely used brand fall to 6th place. ​</p>\r\n<p> </p>\r\n<p><strong>CSI highlight :​</strong></p>\r\n<p>- IndiHome CSI perfomance 7.57%  was relative stable, while Telkomsel orbit continued to show positive performance since Q3\'23 7.93% </p>\r\n<p>No major difference and stable performance was found across speed and region. ​</p>\r\n<p>- Telkomsel Orbit saw improvement among loyal user in classification Los 1-3 Years (+0.30)  and 3-5 Years (+0.25)​</p>\r\n<p>- Factor satisfaction of  Indihome was relatively stable, except for Complete channel options in cable TV and Self-care apps experience (+3).​</p>\r\n<p>- Most of the satisfaction level was yet to be on the same level as the closest competition.​</p>\r\n<p>- On the other hand, positive performance, especially MyRepublic and XL Satu Fiber, was yet to impact the CSI level. As Iconnet suffer showed declining in selfcare.​</p>\r\n<p> </p>\r\n<p><strong>Brand Performance :​</strong></p>\r\n<p>- BEI indihome 6.1, performance across brands was relatively stable, even though Indihome equity was declined in Sumbagteng (-0.3), Sumbagsel (-0.3) and Kalimantan (-0.3).​</p>\r\n<p>- Brand Leverage of Wifi Brand on national level generally remained stable, however Indihome Performance has declined across in most of leverage parameters.</p>', 'Q1_2024_KPI_Report_Consumer_Study_Fixed_Jan24.pdf', 'Voice of customer, NPS, CSI, BEI, market share, January', '2024-07-05 15:15:58'),
(16, 2, 2, 22, 'Orbit Naming', 'orbit.png', 'Naming survey for Telkomsel Orbit new launch product for home use with postpaid billing scheme and modem rental service', '<p> - \"Orbit Internet Rumah\" received 3,706 votes, favored by decision-makers (31-40 y.o), primarily in Jawa Barat, Private Company</p>\r\n<p>workers, and households with 5 WiFi users. Impression: Simplicity, ideal for home use.</p>\r\n<p>- \"Orbit Keluarga\" received 1,912 votes, preferred by decision-makers, skewness older age (41-50 y.o & >50 y.o), mainly in Jawa</p>\r\n<p>Barat, Private Company workers, and households with 4 WiFi users. Impression: Family, togetherness.</p>\r\n<p>- \"Orbit In\" received 572 votes, favored by decision-makers and household payers, skewness young and young adults age (<21></p>\r\n<p>(5.9%) & 21-30 y.o (31.2%)) mainly in Jawa Timur + Madura, Private Company workers, and households with 5 WiFi users.</p>\r\n<p>Impression: Simplicity, easy to recall.</p>\r\n<p>- \"Orbit Spot\" received 750 votes, preferred by decision-makers (31-40 y.o) in Jawa Barat, Private Company workers, and</p>\r\n<p>households with 5 WiFi users. Impression: simplicity, easily memorable, and well-placed positioning.</p>\r\n<p>- \"Others\" received 743 votes, with 22% suggesting \"Orbit Home,\" which creates an impression of being well-suited for home use</p>', 'Q1_2024_New_Orbit_Scheme_Naming.pdf', 'orbit, naming, nominasi, launch, product', '2024-07-08 13:32:27'),
(18, 1, 1, 22, 'Issue Report Consumer Study FBB Jan\'24 - Biznet & First Media', 'biznet.png', 'Deep dive First Media & Biznet from data consumer study January 2024', '<p><strong>INDIHOME & BIZNET Customer Profile</strong></p>\r\n<p>- IndiHome and Biznet customer profiles are pretty similar, but different in usage & behavior.Biznet is claimed to have higher ARPU than IndiHome (368K vs 336K) and delivering higher internet speed than Indihome (51-100 Mbps vs 31-40 Mbps)</p>\r\n<p>- Biznet backbone is in Area 2 and Area 3 with moderate brand equity level (BEI > 1.0).</p>\r\n<p> </p>\r\n<p><strong>CSI & NPS INDIHOME VS BIZNET - By region</strong></p>\r\n<p>- Despite having a moderate BEI for Biznet, Sumbagteng is actually less performance in term of NPS and CSI. Following Sumbagteng, Western Jabo and Jabar are dropping in medium box.</p>\r\n<p>- However, Indihome performance is not that good on those regions as well.There are 4 big groups that Indihome needs to catch up Biznet: After-sales Services, Connectivity, Product & Package, and Price & Promo.</p>\r\n<p> </p>\r\n<p><strong>CUSTOMER PERCEIVED INDIHOME VS BIZNET</strong></p>\r\n<p>- For Retention : the attributes relate to selfcare apps user experience and the loyalty program are the attributes in which Indihome is perceived lacking vs. Biznet.</p>\r\n<p>- For Acquisition : in order to target Biznet users, beside accomodating the motives Biznet switcher out – wide coverage, brand popularity and positive testimony </p>\r\n<p>Indihome needs to build good perception of high-quality network, suitable package spec and pricing, fast handling queries, and neat installation.</p>', 'Q1_2024_Issue_Report_January_-_First_Media_Biznet_performance.pdf', 'Voice of customer, NPS, CSI, BEI, market share, comparison, January, IndiHome, Biznet, Performance, Perceived, Perception, Behaviour, usage', '2024-07-08 13:41:06'),
(19, 2, 3, 22, 'Winback PraNPC & CT0', 'winback_pranpc.png', 'Reasons for turning into CT0 & PraNPC, and recommendation caring channel and treatment', '<p> - Most of respondent who claimed to be PraNPC planned to reconnect their IndiHome WiFi when their budget allows (34%), and 33% of them still not sure what their planning to do with their current subscription While respondent who claimed to be CT0, the longer they do not pay the bill the tendency to reconnect is declining​</p>\r\n<p>- The main reason behind the respondents decision to become PraNPC & CT0 is quite similar for the top 1 and 2 reasons that is due to of “saving money/tight budget” (PraNPC: 29%; CT0: 33%), followed by moving place (PraNPC: 13%; CT0: 16%). There’s a difference in the top 3 reason. Customer who claimed to be PraNPC says that they forgot to make payment (13%) meanwhile customer who claimed to be CT0 says that it’s due to the price is getting more expensive (15%).​</p>\r\n<p>- In general, customers feel satisfied with IndiHome,  especially regarding Technician (91% satisfied) and Network (89% satisfied). ​</p>\r\n<p>- Only 26% claimed that they already receive a winback offer by IndiHome. The offer that are offered the most is the Special package offer with higher speed than current package (existing)(86 respondents), 58% says that they’re not intrested in this offer. The offer that got the most positive response is the free late payment penalty (80%), but only 30 respondents claimed that they recieve this offer. ​</p>\r\n<p>- 39% respondents claimed that they’re preferred offer is the Special package offers that are cheaper than the current package (existing), followed by Free late payment penalty (21%). And respondents preferred caring channel is WhatsApp (71%).</p>', 'Q1_2024_Winback_PraNPC_CT0.pdf', 'Churn, praNPC, CT0, winback, indihome, reason for churn', '2024-07-08 13:44:15'),
(20, 1, 1, 22, 'Consumer Study FBB Feb\'24', 'consumer_feb.png', 'Monthly CSI, NPS, BEI track February 2024', '<p><strong>Net Promotor Score (NPS)           </strong>                                                                                                                                                                    </p>\r\n<p>- IndiHome NPS Level Feb’24 +50 are stable in compared to previous month. (NPS corporate target : 49 in Q1, Above target 102%)​</p>\r\n<p>- IndiHome performed positive trend on NPS in Area 1 two consecutive months, Area 1 NPS +46 (+ 4)​</p>\r\n<p>- On the other hand, Telkomsel Orbit is the strongest in A1 (+76), compared to competitors in terms of NPS level, Biznet +60 and MNC Play Indosat Hifi +51 (- 13 Δ2M).  In - contrast to XL satu fiber in A1 shown significantly declined +47 (- 20 Δ1M)​</p>\r\n<p>- Sumbagut Region is driving significant increases in A1, when looking top cities Medan and Banda Aceh​</p>\r\n<p>Looking forward to A2, NPS Level shown declined +52 (- 3 Δ1M)​</p>\r\n<p>- Compared to competitors in Area 2, XL Satu Fiber +59, Oxygen +56, and Iconnet has shown improvement over the 2 months +56 (+17 Δ2M).  . while for Telkomsel Orbit shown decline (-10 Δ1M) but still the highest among them at +66.​</p>\r\n<p>- Central Jabo is driving the significant decline +54 (- 6 Δ1M & - 9 Δ2M), bottom city identified in Kota Jakarta Selatan +37​</p>\r\n<p> </p>\r\n<p><strong>Customer Strength Index (CSI) ​</strong></p>\r\n<p>- IndiHome CSI Feb’24,  7.55 (-0.02 Δ1M, Jan’24 7.57) average industry +`1.84%​``</p>\r\n<p>- Indihome performance is relatively stable in compared to previous period, while Telkomsel Orbit performance is slowly declining Jan’24 7.93%, Now Feb’24 7.84% ( -0.06 Δ1M).​</p>\r\n<p>- Compared to competitors in terms of CSI, Biznet 7.74 (-0.10 Δ1M), Iconnet 7.12 (-0.10 Δ1M), MNC Play + Indosat Hifi 7.22(-0.09 Δ1M),​</p>\r\n<p>- Central jabodetabek also shown decline 7.78 (-0.21 Δ1M) while some area and regions are leading in CSI vs Average Industry; In A1, Sumbagut 7.71 ( +3.84% vs Avg Industry), In A2, western Jabodetabek 7.57 (+3.06% vs Avg Industry), In A4, overall CSI Score 7.69 leading vs avg industry +5.37%, all region are leading vs avg industry, Kalimantan 7.71 (+5.36% vs Avg industry), Sulawesi 7.64 (+3.08% vs Avg Industry), Puma 7.89 ( +4.43 vs Avg Industry)​</p>\r\n<p>- On the other hand, in Bali Nusra, IndiHome CSI is improved but compared to average industry in Bali Nusra -2.16%, Biznet shown getting stronger in CSI score 8.16 (+0.35 Δ1M), followed by CBN Fiber 8.19 (+ 0.38 Δ2M)</p>', 'Q1_2024_KPI_Report_Consumer_Study_Fixed_Feb24.pdf', 'Voice of customer, NPS, CSI, BEI, market share, February, performance, factor satisfaction', '2024-07-08 13:49:44'),
(21, 2, 3, 22, 'New Naming IndiHome Low Segment', 'lowspeed.png', 'new naming for Low Speed Internet (Fixed Broadband) up to 10Mbps that match to lower segment market (SES B & C).​', '<p>- “Easynet by Telkomsel” emerged as the most nominated name, while “Inside by Telkomsel” and “Net Us by Telkomsel” subsequently following after​</p>\r\n<p>- The ”Easynet by Telkomsel” name preferences received 535 votes, with skewness adult age (31-40 y.o). Most of voters are located in Sumatra (22.9%) & Jawa Barat (16.9%), with occupation Merchant or Entrepreneur (20.8%). Majority of respondents claimed that Telkosel campaign influence (63.1%) respondent to choose ”Easynet by Telkomsel” . The name creates impression of easy to remember​</p>\r\n<p>- The ”Inside by Telkomsel” name preferences received 124 votes, with the majority from adult age (21-30 y.o). Most of voters are located in Jawa Barat ( 18.6% ) & Sumatra (18.6%), with occupation Private Company (23.5%). Majority of respondents claimed that Telkosel campaign influence (67.2%) respondent to choose ”Inside by Telkomsel”. The name creates interesting and cool. ​</p>\r\n<p>- The ”Net Us by Telkomsel” name preferences received 108 votes, with the majority adult age (41-50 y.o). Most of voters are located in Sumatra (22.2%) %) & Jawa Timur + Madura (16.7%), with occupation Housewive (17.8%). Majority of respondents claimed that Telkosel campaign influence (62.9%) respondent to choose ”Net Us by Telkomsel”. ”Telkomsel” also come as the top word for first impression, followed by good and affordable network.​</p>\r\n<p>- Majority of respondents claimed that Telkosel campaign influence their decision to choose the top 3 name.</p>', 'Q1_2024_New_Brand_Naming_-_Low_Speed_Internet_(FBB).pdf', 'Indihome, naming, nominasi, new brand', '2024-07-08 13:53:20'),
(23, 2, 3, 22, 'Campaign PSB 3X24 Jam', 'WOW_PSB.png', 'Awareness and Perception about Campaign ', '<p> - The primary factor influencing respondents\' decision on a Wi-Fi provider is internet speed, although other factors have emerged, such as installation SLA. 70% of respondents that use IndiHome stated that their installation took less than 3 days. However, several respondents (25%) and even 5% stated that their IndiHome was installed more than 7 days after work hours.​</p>\r\n<p> - According to 72% of respondents, their Wi-Fi should be set up in less than 3 days, and 31% of them are even expecting having it provided in 24 hours or less.​</p>\r\n<p>- Merely 38% of participants were aware of the WOW PSB 3X24 Jam campaign, and of those who were, only 66.6% could accurately identify the channel on which the campaign was shown. ​</p>\r\n<p>- Overall, the top first impression of this campaign is indeed the Key Visual “3x24 Jam Terpasang”. Unfortunately, more than 70% of the respondents is distracted by other words in the campaign and for Area 3 and Area 4 the top first impression is “Paket Jitu 1”. Meanwhile, the words that are perceived as attractive for respondents is the word “Bebas biaya pasang baru” (26%), followed by the package promo “Paket JITU 1” (21%).​</p>\r\n<p>- The respondents\' preferred incentive to sign up for Wi-Fi is cashback of Rp 50,000 (37%), which is followed by a Netflix voucher (35%). And they expect to get compensation in the form of a monthly bill deduction (51%).</p>', 'Q2_2024_Survey_Campaign_WOW_PSB_3x24_Jam_V2_1.pdf', 'Campaign, PSB, Awareness, perception, pasang baru, aktivasi pelanggan baru, installation, 3x24 jam', '2024-07-08 13:58:31'),
(24, 2, 3, 22, 'Journey PSB IndiHome MyTelkomsel', 'UTPSB_Mytsel.png', 'User Testing New Journey Pasang Baru in MyTelkomsel App', '<p>- Aligned with the findings from quick call survey conducted by CJDX, merely want to see the package price is also found as a reason why users drop from the Choose Package page</p>\r\n<p>- Important information about the penalty was missed by some users, because they perceive the contract agreement is just like long T&C in general. They tend to skip it and just accept it anyway.</p>\r\n<p>- There was no crucial usability issue found that could make them drop, but users find difficulty when tracking order. Their Lacak Order page was not showing anything and there was no follow up information received</p>', 'Q2_2024_UT_PSB_Indihome.pdf', 'Journey, Awareness, PSB, Indihome, My Telkomsel, experience', '2024-07-08 14:01:04'),
(27, 1, 1, 22, 'Consumer Study FBB Mar\'24', 'consumer_mar.png', 'Monthly CSI, NPS, BEI track March 2024', '<p><strong>Net promotor Score ( NPS) Mar\'24 : National Level Tracking​</strong></p>\r\n<p>- In March’2024, IndiHome still manage stable and positive performance +50 over target ( FBB NPS Corporate target for Q1’2024 is +49, above target 102%), While for Orbit NPS level was decline trend +63 (-5, Δ1M).​</p>\r\n<p>- In this period, some of the FBB brand such as Biznet (+ 54) and oxygen.id (+54) had positive performance and above IndiHome Score.​</p>\r\n<p>- IndiHome had positive trend of NPS in Area 1, for two consecutive months, Area 1 NPS was +49 (á 3). Telkomsel orbit remain stqble in A1 +76​</p>\r\n<p>- Compared to competitors in terms of NPS level in A1, some of competitor are inclined and stronger above IndiHome NPS Score Biznet +63 (á 3 Δ1M), First media +55 (+2 Δ1M), MNC Play + Indosat Hifi +57 (+6 Δ1M).​</p>\r\n<p>- Looking forward to A2, NPS Level previously was declined, in this month shown positive performance inclined +52. While for Telkomsel orbit shown negative performances +56 (-9 Δ1M ).​</p>\r\n<p>- Compared to competitors in Area 2, First Media shown inclined performance in A2 +52 (á8 Δ1M), Biznet +56 (+4). Area 3 +48 and Area 4 +54 was stable performance compare previous month.​</p>\r\n<p> </p>\r\n<p><strong>Customer Strength index Mar\'24:​</strong></p>\r\n<p>- IndiHome CSI March’24 continue to have positive trend to 7.59 ( +0.04) while average industry +2.10%​</p>\r\n<p>-  Indihome performance was relatively stable compared to previous period, while Telkomsel Orbit performance was slowly declining. In Feb’24 was 7.84%, by march’24 was 7.73% ê0.11 Δ1M.​</p>\r\n<p>- First Media managed positive CSI performance in Area 2, while XL Satu Fiber in Area 4​</p>\r\n<p>- A slight increase among their premium speed (Above 100 Mbps), CSI 8.39% (+0.23 Δ1M). ​</p>\r\n<p>- New user (Less than 1 year) for indihome quite stable while first media shown significant growth 7.36 (+0.41 Δ1M.)​</p>\r\n<p>- While for LOS > 5 years, Mnc Play+ Indosat Hifi shown significant point CSI 7.94 (+0.13 Δ1M, 0.42 Δ3M. )</p>', 'Q1_2024_KPI_Report_Consumer_Study_Fixed_Mar241.pdf', 'Voice of customer, NPS, CSI, BEI, market share, March, performance, factor satisfaction', '2024-07-09 09:02:24'),
(28, 1, 5, 1, 'Consumer Study Mobile Jan 2024', 'consumer_study_Jan2024.png', 'Sample Description', '-', 'KPI_Report_Consumer_Study_Mobile_Telkomsel_Jan_2024_final.pdf', '', '2024-09-06 16:57:56'),
(29, 1, 5, 1, 'Consumer Study Mobile Feb 2024', 'consumer_study_Feb2024.png', 'Sample Description', '<p>-</p>', 'KPI_Report_Consumer_Study_Mobile_Telkomsel_Feb_2024_final.pdf', '', '2024-09-06 17:00:25'),
(30, 1, 5, 1, 'Consumer Study Mobile Mar 2024', 'consumer_study_Mar2024.png', 'Sample Description', '<p>-</p>', 'KPI_Report_Consumer_Study_Mobile_Telkomsel_Mar_2024_final.pdf', '', '2024-09-06 17:01:50'),
(31, 1, 6, 1, 'Telkomsel Social Media Analysis Report - Januari 2024', 'telkomsel_socialmedia_jan.png', 'Sample Description', '<p>-</p>', 'Telkomsel_Social_Media_Analysis_Report_-_1_-_January_2024_V2_0.pdf', 'social media', '2024-09-09 14:36:00'),
(32, 1, 6, 1, 'Telkomsel Social Media Analysis Report - Februari 2024', 'telkomsel_socialmedia_feb.png', 'Sample Description', '<p>-</p>', 'Telkomsel_Social_Media_Analysis_Report_-_February_2024_V3.pdf', 'social media', '2024-09-09 14:43:56'),
(33, 1, 6, 1, 'Telkomsel Social Media Analysis Report - May 2024', 'telkomsel_socialmedia_may.png', 'Sample Description', '<p>-</p>', 'Telkomsel_Social_Media_Analysis_Report_-_May_2024_V2_4.pdf', '', '2024-09-09 14:47:14'),
(34, 1, 6, 1, 'Telkomsel Social Media Analysis Report - June 2024', 'telkomsel_socialmedia_june.png', 'Sample Description', '<p>-</p>', 'Telkomsel_Social_Media_Analysis_Report_-_June_2024_pptx.pdf', '', '2024-09-09 14:49:35'),
(35, 1, 6, 1, 'Telkomsel Social Media Analysis Report - July 2024', 'telkomsel_socialmedia_july.png', 'Sample Description', '<p>-</p>', 'Telkomsel_Social_Media_Analysis_Report_-_July_2024_V2_1.pdf', '', '2024-09-09 14:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `document_views`
--

CREATE TABLE `document_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `view_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_views`
--

INSERT INTO `document_views` (`id`, `user_id`, `document_id`, `view_time`, `ip_address`) VALUES
(147, 22, 14, '2024-12-20 12:26:11', '192.168.40.172'),
(148, 22, 31, '2024-12-23 06:02:03', '192.168.0.127'),
(149, 22, 32, '2024-12-23 06:07:37', '192.168.0.127'),
(150, 22, 32, '2024-12-23 06:07:55', '192.168.0.127'),
(151, 22, 27, '2024-12-23 06:09:44', '192.168.0.127');

-- --------------------------------------------------------

--
-- Table structure for table `download_views`
--

CREATE TABLE `download_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `download_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(225) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#007bff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE `forum_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`id`, `name`) VALUES
(1, 'Teknologi'),
(2, 'Pengembangan Perangkat Lunak'),
(4, 'Game'),
(5, 'Edukasi'),
(6, 'Bisnis'),
(7, 'Hobi dan Minat'),
(9, 'Berita dan Topik Terkini'),
(12, 'Business Intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `comment` text NOT NULL,
  `likes` int(11) NOT NULL,
  `unlikes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

CREATE TABLE `forum_replies` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reply_text` text DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `unlikes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE `forum_threads` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `content` text NOT NULL,
  `replies_count` int(11) NOT NULL DEFAULT 0,
  `views_count` int(11) DEFAULT 0,
  `user_id` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_threads`
--

INSERT INTO `forum_threads` (`id`, `category_id`, `posted_by`, `title`, `image`, `content`, `replies_count`, `views_count`, `user_id`, `created_at`) VALUES
(4, 2, 12, 'Tips for improving your coding skills', 'download.png', 'Enhancing your coding abilities is a journey that involves practice, learning, and exploration.', 6, 1142, '', '2024-10-01 02:27:08'),
(22, 1, 27, 'Diskusi tentang Teknologi Terbaru', 'teknologi.png', 'Mari kita bahas tentang teknologi terbaru yang sedang berkembang, seperti AI, IoT, dan blockchain. Apa pendapat kalian?', 0, 13, '', '2024-12-23 22:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `invitation_thread_log`
--

CREATE TABLE `invitation_thread_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `invited_by` int(11) NOT NULL,
  `message` text NOT NULL,
  `invitation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `status` enum('Success','Fail') DEFAULT 'Success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `email`, `login_time`, `ip_address`, `browser`, `status`) VALUES
(90, 31, 'mciguest@telkomsel.co.id', '2024-12-22 11:09:50', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(91, 22, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-22 11:11:56', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(92, 31, 'mciguest@telkomsel.co.id', '2024-12-22 11:19:44', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(93, 22, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-22 11:20:01', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(94, 31, 'mciguest@telkomsel.co.id', '2024-12-23 12:48:16', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(95, 22, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-23 12:48:46', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(96, 22, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-23 12:49:27', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(97, 22, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-23 16:53:50', '192.168.40.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(98, 27, 'admin@telkomsel.co.id', '2024-12-23 16:54:37', '192.168.40.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(99, 27, 'admin@telkomsel.co.id', '2024-12-23 17:02:33', '192.168.40.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(100, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2024-12-24 09:37:52', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(101, 27, 'admin@telkomsel.co.id', '2024-12-24 09:38:05', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(102, 27, 'admin@telkomsel.co.id', '2024-12-24 12:37:42', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(103, 31, 'mciguest@telkomsel.co.id', '2025-01-02 10:42:04', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(104, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 12:44:30', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(105, 31, 'mciguest@telkomsel.co.id', '2025-01-02 12:46:30', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(106, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 12:47:07', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(107, 31, 'mciguest@telkomsel.co.id', '2025-01-02 12:54:17', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(108, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 12:55:10', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(109, 27, 'admin@telkomsel.co.id', '2025-01-02 13:32:54', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(110, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 13:35:53', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(111, 27, 'admin@telkomsel.co.id', '2025-01-02 13:36:58', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(112, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 14:12:00', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(113, 27, 'admin@telkomsel.co.id', '2025-01-02 14:13:53', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(114, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 14:14:31', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(115, 27, 'admin@telkomsel.co.id', '2025-01-02 14:15:08', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(116, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 14:15:41', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(117, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 14:16:43', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(118, 27, 'admin@telkomsel.co.id', '2025-01-02 14:16:56', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(119, 31, 'mciguest@telkomsel.co.id', '2025-01-02 14:44:00', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(120, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 14:55:27', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(121, 31, 'mciguest@telkomsel.co.id', '2025-01-02 14:56:26', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(122, 31, 'mciguest@telkomsel.co.id', '2025-01-02 15:01:03', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(123, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 16:06:18', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(124, 31, 'mciguest@telkomsel.co.id', '2025-01-02 16:21:02', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(125, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 16:22:44', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(126, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 16:26:31', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(127, 27, 'admin@telkomsel.co.id', '2025-01-02 17:01:47', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(128, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-02 17:04:11', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Success'),
(129, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 07:33:48', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(130, 27, 'admin@telkomsel.co.id', '2025-01-03 08:14:57', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(131, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 08:18:43', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(132, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 08:23:31', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(133, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 08:36:01', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(134, 27, 'admin@telkomsel.co.id', '2025-01-03 09:27:02', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(135, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 09:28:39', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(136, 27, 'admin@telkomsel.co.id', '2025-01-03 09:29:06', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(137, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 09:30:34', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(138, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-03 09:32:38', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(139, 27, 'admin@telkomsel.co.id', '2025-01-03 09:33:02', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(140, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-07 14:40:29', '192.168.40.87', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(141, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-07 14:56:25', '192.168.91.67', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1 Edg/131.0.0.0', 'Success'),
(142, 27, 'admin@telkomsel.co.id', '2025-01-07 15:00:00', '192.168.91.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(143, 27, 'admin@telkomsel.co.id', '2025-01-08 10:19:21', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(144, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-08 13:38:04', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(145, 27, 'admin@telkomsel.co.id', '2025-01-08 14:31:40', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(146, 27, 'admin@telkomsel.co.id', '2025-01-08 14:36:11', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(147, 27, 'admin@telkomsel.co.id', '2025-01-09 13:48:46', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(148, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-09 14:05:55', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(149, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-09 15:14:11', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(150, 27, 'admin@telkomsel.co.id', '2025-01-09 16:05:29', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(151, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-09 16:08:53', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(152, 27, 'admin@telkomsel.co.id', '2025-01-09 16:11:28', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success'),
(153, 32, 'abieza_sp_risqulloh_x@telkomsel.co.id', '2025-01-09 16:12:03', '192.168.0.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile` tinyint(1) NOT NULL DEFAULT 0,
  `fixed` tinyint(1) NOT NULL DEFAULT 0,
  `digital` tinyint(1) NOT NULL DEFAULT 0,
  `global` tinyint(1) NOT NULL DEFAULT 0,
  `forum` tinyint(11) NOT NULL DEFAULT 0,
  `event` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'FBB'),
(2, 'Orbit'),
(3, 'Indihome'),
(4, 'IPTV & ADD on'),
(5, 'Consumer Study'),
(6, 'Social Media Analysis');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `reply_text` text DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `unlikes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL,
  `image` text NOT NULL,
  `category` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `file` text NOT NULL,
  `content` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `unlikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_category_id`, `title`, `desc`, `image`, `category`, `type`, `file`, `content`, `keywords`, `created_at`, `likes`, `unlikes`) VALUES
(1, NULL, 'Churn Indihome', NULL, 'churn_indihome.png', 'fixed', 'pdf', 'Report_Churn IndiHome Q2 2024.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(2, NULL, 'Indihome Loyalty Program', NULL, 'loyalti_program.png', 'fixed', 'pdf', 'Report_IndiHome Loyalty Program.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(3, NULL, 'EZNet by Telkomsel\r\nSurvey', NULL, 'eznet_telkomsel_survey.png', 'fixed', 'pdf', 'EZNet by Telkomsel Report Survey.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(4, NULL, 'Survey Telkomsel One', NULL, 'survey_telkomsel_one.png', 'fixed', 'pdf', 'Survey_Telkomselone.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(5, NULL, 'Prestudy Dragon Survey', NULL, 'prestudy_dragon_survey.png', 'fixed', 'pdf', 'Result_Pre-Study Project Dragon.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(6, NULL, 'Survey Add On', NULL, 'survey_addon.png', 'fixed', 'pdf', 'Result Add on Survey.pdf', NULL, NULL, '2024-08-14 07:46:10', 0, 0),
(7, NULL, 'Are mobile and fixed broadband substitutes or complements? New empirical evidence from Italy and implications for the digital divide policies.', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies.', 'solution.jpg', 'fixed', 'article', 'Are mobile and fixed broadband substitutes or complements (2020).pdf', 'The potential of mobile broadband to close the geographic digital divide in places without enough fixed broadband infrastructure has received the majority of attention in the literature on broadband strategies. In developed nations, a lot of broadband plans use the assumption that mobile and fixed technologies may be used interchangeably, with bandwidth performance being the main source of restrictions. In this study, we examine the variables affecting people’s private use of mobile broadband to access the Internet through smartphones, taking into account the impact of various Internet applications and the availability of fixed broadband at home. \r\n<p>From this research econometric analysis, based on microdata from Italian individuals, reveals several key findings:</p> \r\n       <ul>\r\n    <li>Mobile and fixed broadband are complementary for activities such as browsing, video streaming, gaming, and cloud services.</li>\r\n    <li>A substitution effect is observed for social networking and music streaming.</li>\r\n</ul>\r\n\r\n<p>Different types of Internet usage require distinct broadband characteristics, not just in terms of bandwidth, but also in aspects like data allowances and ease of connectivity with other devices.</p>\r\n\r\n<p>Overall, Internet activities that demand more bandwidth and data (such as video streaming and cloud services), or are best experienced on home devices (like browsing on desktops with large monitors or streaming on smart-TVs), are more likely to drive mobile broadband adoption when a fixed broadband connection is available at home.</p>', NULL, '2024-08-12 03:02:10', 0, 0),
(8, NULL, 'Customer Experience, Loyalty and Churn in Bundled Telecomunications Services', 'The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. ', 'banner.png', 'fixed', 'article', 'customer experience, loyalty, and churn in bundled telecommunications services (2024).pdf', '<p>The telecom sector is extremely competitive, with operators attacking one another fiercely to attract new clients with a high attrition rate, particularly in bundled services. Gaining an extensive knowledge of the variables impacting telecom operators\' decisions to switch providers for bundled services is the main goal of this research. Quantitative research involving 3,004 users of bundled services from a Portuguese telecom operator is included in the paper. Using logit regression and covariance-based structural equation modeling, the study reveals that:</p>  <ul>     <li>service quality, satisfaction, and customer experience have emerged as the supports of decision-making that play a crucial role in two key aspects</li>     <li>Customers without loyalty contracts are more likely to churns, experiencing a churn probability that is 10% to 18% higher compared to customers with loyalty contracts</li> <li>Customers who are administratively tied to a particular service provider are less likely to consider competing offers, as they are subjected to penalties if they try to switch operators</li> </ul>  <p>This study offers telecommunications managers insights for identifying the main factors to retain customers and curbing customer defection. Additionally, it provides a framework for assessing customer experience within bundled telecom services, which is useful for researchers, managers and marketing practitioners alike.</p>', NULL, '2024-08-12 09:59:10', 0, 0),
(9, NULL, 'Factors influencing the effects of the Starlink Satellite Project on the internet service provider market in Thailand', 'This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand.', 'satelite.webp', 'fixed', 'article', 'Factors influencing the effects of the Starlink Satellite Project in Thailand (2023).pdf', '<p>This quantitative study explores the impact of the Starlink project on the internet service provider market in Thailand. A convenience sampling technique was used to recruit 617 participants, who completed an online questionnaire. The study examined several independent variables, including demographic factors, such as gender, age, education, status and income, and user behavior, such as devices used for internet access, time spent online and social media platforms used. Binary regression was used to analyze the data. The results showed that the Starlink project had a significant impact on the competitive structure of the internet service provider market in Thailand. This impact was influenced by factors such as age, education, income, internet duration, mobile internet use, the use of social media platforms.</p>  \n\n<ul>\n\n<li>younger, more educated, and higher-income individuals tend to benefit more from the Starlink Satellite Project, likely due to their greater access to technology and willingness to adapt to new technologies.</li> \n    \n<li>Additionally, longer internet duration, increased mobile internet use, and frequent use of social media platforms such as Facebook and TikTok were also found to be significant predictors of the positive effects of the Starlink Satellite Project on the internet service.</li> \n\n</ul>  \n\n<p>These findings suggest that the impact of the Starlink Satellite Project may be most beneficial for those who are already well-connected and technologically savvy.</p>', NULL, '2024-08-22 07:37:46', 0, 0),
(10, NULL, 'Consolidated Report Juli 2024', NULL, 'consolidate_report_jul.png', 'digital insight', 'pdf', 'Consolidated Report 202407.pdf', NULL, NULL, '2024-09-03 03:10:58', 0, 0),
(11, NULL, 'Consolidated Report May 2024', NULL, 'consolidate_report_may.png', 'digital insight', 'pdf', 'Consolidated Report 202405.pdf', NULL, NULL, '2024-09-03 03:16:50', 0, 0),
(12, NULL, 'Consumer Study Mobile Jan 2024', NULL, 'consumer_study_Jan2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Jan 2024_final.pdf', NULL, NULL, '2024-09-06 09:18:49', 0, 0),
(13, NULL, 'Consumer Study Mobile Feb 2024', NULL, 'consumer_study_Feb2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Feb 2024_final.pdf', NULL, NULL, '2024-09-06 09:23:50', 0, 0),
(14, NULL, 'Consumer Study Mobile Mar 2024', NULL, 'consumer_study_Mar2024.png', 'mobile', 'pdf', 'KPI Report Consumer Study Mobile Telkomsel Mar 2024_final.pdf', NULL, NULL, '2024-09-06 09:27:36', 0, 0),
(15, NULL, 'Telkomsel Social Media Analysis Report Jan 2024', NULL, 'telkomsel_socialmedia_jan.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - January 2024 V2.0.pdf', NULL, NULL, '2024-09-09 03:32:05', 0, 0),
(16, NULL, 'Telkomsel Social Media Analysis Report Feb 2024', NULL, 'telkomsel_socialmedia_feb.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - February 2024 V3.pdf', NULL, NULL, '2024-09-09 03:32:05', 0, 0),
(17, NULL, 'Telkomsel Social Media Analysis Report Jul 2024', NULL, 'telkomsel_socialmedia_july.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - July 2024 V2.1.pdf', NULL, NULL, '2024-09-09 03:32:05', 0, 0),
(18, NULL, 'Telkomsel Social Media Analysis Report Jun 2024', NULL, 'telkomsel_socialmedia_june.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - June 2024.pptx.pdf', NULL, NULL, '2024-09-09 03:32:05', 0, 0),
(19, NULL, 'Telkomsel Social Media Analysis Report May 2024', NULL, 'telkomsel_socialmedia_may.png', 'mobile', 'pdf', 'Telkomsel Social Media Analysis Report - May 2024 V2.4.pdf', NULL, NULL, '2024-09-09 03:32:05', 0, 0),
(20, NULL, 'Usage and Impact of the internet of things based smart home technology: a quality of life perspective', 'The aim of this paper is to explore the usage and impact of the Internet-of-Things-based Smart Home Technology (IoTSHT) in Malaysia.', 'smart.jpg', 'fixed', 'article', 'Usage and impact of the internet‑of‑things‑based smart home (2024).pdf', '<p>\nThe aim of this paper is to explore the usage and impact of the Internet-of-Things-based Smart Home Technology (IoTSHT) in Malaysia. Face-to-face interviews were conducted with a total of eleven IoT-SHT users who had a minimum of 2-year usage experience. \n</p>  \n\n<p>\nThe semi-structured interview consisted of six questions which were compartmentalized into two sections. Common themes were identified through constant comparison of the inductive data in the coding process. The in-depth interview uncovered six uses of IoT-SHT. Mainly, it was used for real-time remote control, surveillance, sensing, home automation, entertainment, and family communication. It seems clear that the IoT-SHT helped people to save time, changed their lives, improved security, safety, environment condition, fun, convenience, and comfort within the home ground.\n</p>  \n\n<p>\nIt also facilitated better health tracking, family care, and energy conservation. Psychologically, the IoT-SHT also enhanced one’s image, offered better companionship, and improved the sense of belongingness, and closeness within the family. This study fills the research gap by providing insights into how the IoT-SHT was used, thereby benefiting users in Malaysia.\n</p>  \n\n<p>\nWith the arrival of industrial revolution 4.0, a comprehensive knowledge on the usage of IoT is pertinent. The findings of this study may also serve as a foundation for future research in IoT-SHT adoption. Practically, this study accelerates IoT-SHT diffusion by providing insights to vendors in designing better IoT products and services, based on the popular usages and impactful benefits.\n</p>', NULL, '2024-09-11 06:08:13', 0, 0),
(21, NULL, 'The South Korean case of deploying rural broadband via fiber networks by implementing universal service obligation and public private partnership based project', 'Despite broadband being essential infrastructure for conducting basic socio-economic activities and reducing inequality and the digital divide, expanding broadband coverage in rural areas remains a significant challenge in many countries due to high deployment costs.', 'viber.jpg', 'fixed', 'article', 'The South Korean case of deploying rural broadband via fiber (2023).pdf', '<p>\r\nDespite broadband being essential infrastructure for conducting basic socio-economic activities and reducing inequality and the digital divide, expanding broadband coverage in rural areas remains a significant challenge in many countries due to high deployment costs. South Korea, a developed country in terms of fixed broadband penetration, implemented two policies for rural broadband via fiber access networks simultaneously during the COVID-19 pandemic. One is the universal broadband service at 100 Mbps speed introduced in 2020, and the other is the rural broadband project in terms of a public-private partnership (PPP) that proceeded from August 2020 to 2022. While both policies contribute to reducing the broadband gap between the urban and the rural in the country, it is still important to find the optimal cost-effective combination of the plural rural policies as much as possible from the cost perspective. Accordingly, this study proposes an investment cost estimation model for deploying rural broadband via fiber networks in South Korea and evaluates whether implementing two rural broadband policies in the country is cost-effective. The proposed model is designed according to the bottom-up approach, which involves building an efficient network with the latest technologies; thus, it gives a more accurate and reliable estimation of the investment cost of building rural broadband in the South Korean territory. The significant findings of this study are twofold. First, the PPP-based project could make the participating internet service providers (ISPs) deploy broadband at a cost-effective level, similar or lower to the universal service, and then recover the investment cost per building within a reasonable period.  \r\n</p>', NULL, '2024-09-11 06:37:54', 0, 0),
(22, NULL, 'The Influence of Promotion, Product Quality, and Service Quality on Fixed Broadband Internet Consumer Satisfaction', 'This  study  aims  to  empirically  determine  the  acceptance  of  Fixed Broadband  PT  Eka  Mas  Republik  on  the  customer  side.', 'influence.jpg', 'fixed', 'article', 'The Influence of Promotion, Product Quality, and Service Quality on Fixed Broadband Internet Consumer Satisfaction (2024).pdf', '<p>\r\nPT  Eka  Mas  Republikis  a  company  engaged  in  the  field  of  Fixed Broadband internet service providers which aims to provide internet services to the community.  This  study  aims  to  empirically  determine  the  acceptance  of  Fixed Broadband  PT  Eka  Mas  Republik  on  the  customer  side. This  study  uses  a  model adopted  from  the  variables  of  Media  Promotion,  Product  Quality,  Service  Quality, and  Customer  Satisfaction. Furthermore,  the  model  was  analyzed  using  the  Partial Least  Square  Structural  Equation  Model  (SEM-PLS).\r\n</p>  \r\n\r\n<p>\r\nThe  results  showed  varying relationships  between  exogenous  variables  and  endogenous  variables. \r\n</p>\r\n\r\n<ul>\r\n\r\n<li>the service quality variable has a significant effect on the consumer satisfaction variable.</li> \r\n    \r\n<li>the product  quality variable  has  a  significant effect  on  the consumer satisfaction variable,</li> \r\n\r\n<li>the MP variable is proven to be significant to the service quality variable. </li>\r\n\r\n<li>the product  quality variable  is  proven  to  be  significant  to the service  quality variable.</li>\r\n\r\n<li>the  MP  variable  does  not  prove  significant  to  the consumer  satisfaction variable.  </li>\r\n\r\n<li>the MP  X service  quality variable  does  not prove significant to the consumer satisfaction variable. </li>\r\n\r\n<li>the product quality x service  quality variable  does  not  prove  significant  to  the consumer  satisfaction variable.</li>\r\n\r\n</ul>  ', NULL, '2024-09-11 06:53:07', 0, 0),
(23, NULL, 'FIXED BROADBAND AND SUPERFAST BROADBAND MARKETFttH: new subscriptions outpaced deployments in Q1 2024', 'Today, Arcep is publishing its scorecard for the fixed broadband and superfast broadband market in France as of the end of March 2024. In Q1 2024, new FttH subscriptions (+ 810,000) outpaced rollouts (680,000 additional premises passed).', 'fix-broadband.jpg', 'fixed', 'article', 'Fixed broadband and superfast broadband market.pdf', '<p>\r\nToday, Arcep is publishing its scorecard for the fixed broadband and superfast broadband market in France as of the end of March 2024. In Q1 2024, new FttH subscriptions (+ 810,000) outpaced rollouts (680,000 additional premises passed).</p>  \r\n\r\n<p>\r\nROLLOUTS: As of 31 March 2024, 87% of premises in Metropolitan France were eligible to subscribe to a fibre plan, with around 5.5 million remaining to be passed\r\n</p>\r\n\r\n<ul>\r\n\r\n<li>As of 31 March 2024, of the 44.2 million premises in Metropolitan France inventoried by operators, 38.7 million were passed for FttH, and 5.5 million still need to be covered. Optical fibre coverage increased by one point during the quarter, to 87%.</li> \r\n\r\n<li>Over the course of Q1 2024, 680,000 additional premises were passed for FttH – or 19% fewer than in Q1 2023.\r\n    <ul>\r\n        <li>460,000 additional premises in lower density, public-initiative areas were rendered eligible for FttH access, with 3.1 million premises remaining to be covered.</li>\r\n        <li>140,000 additional premises in lower density, private-initiative areas were rendered eligible</li>\r\n        <li>for FttH access, with 1.6 million premises remaining to be covered.</li>\r\n	<li>400,000 additional premises were passed for FttH in those areas covered by calls for</li>\r\n	<li>expressions of local interest (called \"zones AMEL\" in French), with 0.3 million premises</li>\r\n	<li>remaining to be covered.</li>\r\n	<li>40,000 additional premises in very high density areas were passed for FttH, with 0.5 million</li>\r\n	<li>premises remaining to be covered.</li>\r\n    </ul>\r\n</li> \r\n\r\n<li>As of 31 March 2024, 40.3 million premises were covered by fixed superfast broadband services, which translates into a 91% rate of coverage.</li>\r\n\r\n</ul>  ', NULL, '2024-09-11 07:08:16', 0, 0),
(24, NULL, 'Dynamic Competition in Broadband Markets: A2024 Update', 'the International Center for Law & Economics (ICLE) published a white paper\r\non the state of broadband competition', 'shutterstock_2470976447-1.jpg', 'fixed', 'article', 'Broadband-Competition-2024-Update.pdf', '<p>In mid-2021, the International Center for Law & Economics (ICLE) published a white paper</p>  \r\n\r\n<p>on the state of broadband competition in the United States, which concluded that:</p>\r\n\r\n<ul>\r\n\r\n<li>The U.S. broadband market was generally healthy and competitive, with 95.6% of the</li>\r\n<li>population having access to high-speed broadband;</li>\r\n<li>Concentration metrics are poor predictors of competitiveness—broadband markets can be dynamic and competitive even with only a few providers. Indeed, in some cases, increased concentration can result from efficiency gains and innovation, benefiting consumers through better services; and Municipal broadband often requires significant taxpayer subsidies or cross-subsidies from other municipal enterprises, and is thus an example of “predatory entry,” rather than market competition.</li>\r\n<li>Rather than repeat the analysis conducted in the 2021 report, in this report, we investigate the extent to which broadband competition has evolved over the past three years. We find that it has been a rapid evolution:</li>\r\n\r\n</ul>  \r\n\r\n<p>More households are connected to the internet;</p>\r\n\r\n<ul>\r\n\r\n<li>Broadband speeds have increased, while prices have fallen;</li>\r\n<li>More households are served by multiple providers; and</li>\r\n<li>New technologies like satellite and 5G have expanded internet access and intermodal</li>\r\n<li>competition among providers.</li>\r\n\r\n</ul>', NULL, '2024-09-11 07:11:26', 0, 0),
(25, NULL, '5G FWA go to Market Strategies 2023', NULL, '5G FWA.png', 'global', 'pdf', '5G FWA Go to market Strategies 2023.pdf', NULL, NULL, '2024-09-12 07:46:35', 0, 0),
(26, NULL, 'Fixed Mobile Convergence Global Overview 2023 Has Convergence Growth Flatlined', NULL, 'fix_mobile_convergence.png', 'global', 'pdf', 'Fixed Mobile Convergence Global Overview 2023 Has Convergence Growth Flatlined.pdf', NULL, NULL, '2024-09-12 07:51:00', 0, 0),
(27, NULL, 'Singapore Service Provider Market Report', NULL, 'singapore-service-provider-market.png', 'global', 'pdf', 'Singapore Service Provider Market Report PDF.pdf', NULL, NULL, '2024-09-12 07:54:30', 0, 0),
(28, NULL, 'Fiber Access FWA and the Digital Divide', NULL, 'fiber-access-fwa.png', 'global', 'pdf', 'Fiber Access FWA and the Digital Divide.pdf', NULL, NULL, '2024-09-12 07:54:30', 0, 0),
(29, NULL, '2023 Trends to Watch APAC & Sotheast Asia', NULL, '2023-trend-to-watch.png', 'global', 'pdf', '2023 Trends to Watch-APAC & Sotheast Asia.pdf', NULL, NULL, '2024-09-12 07:59:24', 0, 0),
(30, NULL, 'Digital Profile ATT 2023', NULL, 'digital-profile.png', 'global', 'pdf', 'Digital Profile ATT 2023 PDF.pdf', NULL, NULL, '2024-09-12 07:59:24', 0, 0),
(31, NULL, 'Fixed Mobile Convergence Global Overview FMC is on the rise despite the economic downturn 2022', NULL, 'fixed-mobile-2022.png', 'global', 'pdf', 'Fixed Mobile Convergence Global Overview FMC is on the rise despite the economic downturn 2022 PDF.pdf', NULL, NULL, '2024-09-12 08:04:45', 0, 0),
(32, NULL, 'French telco bouygues telecom breaks free from set top boxes and launches first ever triple play offer with smart tv app', NULL, 'french-telco.png', 'global', 'pdf', 'French telco bouygues telecom.pdf', NULL, NULL, '2024-09-12 08:04:45', 0, 0),
(55, NULL, 'Customer Segmentation as a Revenue Generator for profit purposes', NULL, 'Untitled.png', 'mobile', 'pdf', 'Customer_Segmentation_as_a_Revenue_Generator_for_profit_purposes.pdf', NULL, NULL, '2024-12-08 21:32:52', 0, 0),
(56, NULL, '2025 Trends to Watch Service Provider Markets in Asia Oceania', NULL, 'Untitled1.png', 'mobile', 'pdf', '2025_Trends_to_Watch_Service_Provider_Markets_in_Asia_Oceania_PDF.pdf', NULL, NULL, '2024-12-08 21:42:59', 0, 0),
(57, NULL, 'Preparing for 6G Global PoliciesJ StandardsJ and Regulatory Activities', NULL, 'preparing_6g.png', 'mobile', 'pdf', 'Preparing_for_6G_Global_PoliciesJ_StandardsJ_and_Regulatory_ActivitiesPDF.pdf', NULL, NULL, '2024-12-08 23:30:23', 0, 0),
(58, 1, 'Definitive Report Modern online Consumer Behavior', NULL, 'Untitled2.png', 'mobile', 'pdf', 'definitive-report-modern-online-consumer-behavior.pdf', NULL, 'Consumer', '2024-12-08 23:31:12', 0, 0),
(59, NULL, 'Insights 2024 : Attitudes toward AI', NULL, 'Untitled4.png', 'mobile', 'pdf', 'Insights_2024_Attitudes_To_AI_Full_Report.pdf', NULL, 'Technological Innovation, Transparency and Trust, AI Perception', '2024-12-09 20:42:47', 0, 0),
(60, NULL, 'Metaverse Platform Attributes and Customer Experience Measurement', NULL, 'Metaverse_platform.png', 'digital insight', 'pdf', 'DCI_Metaverse_platform_attributes_and_customer_experience_measurement.pdf', NULL, NULL, '2024-12-10 20:29:02', 0, 0),
(61, NULL, 'Ultrahigh Speed Fixed Broadband and Development', NULL, 'Metaverse_platform1.png', 'fixed', 'pdf', 'Fixed_-_2023_-_Arronte_Ledo_-_Ultrahigh‐Speed_Fixed_Broadband_and_Rural_Development.pdf', NULL, NULL, '2024-12-10 20:33:32', 0, 0),
(62, NULL, 'Analysis Of Telkom\'s Strategy And Business Model Fixed', NULL, 'Metaverse_platform2.png', 'fixed', 'pdf', 'Fixed_Analysis_Of_Telkoms_Strategy_And_Business_Model_Fixed.pdf', NULL, NULL, '2024-12-10 20:37:51', 0, 0),
(63, NULL, 'Consumer Engagement in Fixed Broadband', NULL, 'Metaverse_platform4.png', 'fixed', 'pdf', 'fixed_consumer-engagement-in-fixed-broadband-report.pdf', NULL, NULL, '2024-12-10 20:40:46', 0, 0),
(64, NULL, 'Consumer Memory for Television', NULL, 'Metaverse_platform5.png', 'fixed', 'pdf', 'Fixed_Consumer_Memory_for_Television.pdf', NULL, NULL, '2024-12-10 20:43:33', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports_category`
--

CREATE TABLE `reports_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sub_report` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports_category`
--

INSERT INTO `reports_category` (`id`, `name`, `description`, `sub_report`, `created_at`, `updated_at`) VALUES
(1, 'Sales Report', 'Monthly sales report by category', 'Online Sales, In-Store Sales, Wholesale Sales', '2025-01-08 09:01:24', '2025-01-08 09:57:56'),
(2, 'Inventory Report', 'Current inventory status report', 'Electronics, Clothing, Groceries', '2025-01-08 09:53:05', '2025-01-08 09:53:05'),
(3, 'Customer Feedback Report', 'Analysis of customer feedback', 'Product Quality, Customer Service, Delivery Time', '2025-01-08 09:53:05', '2025-01-09 07:04:27'),
(4, 'Financial Report', 'Quarterly financial performance', 'Revenue, Expenses, Profit Margin', '2025-01-08 09:53:05', '2025-01-08 09:53:05'),
(5, 'Marketing Report', 'Overview of marketing campaigns', 'Social Media, Email Campaigns, SEO Performance', '2025-01-08 09:53:05', '2025-01-08 09:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `report_log`
--

CREATE TABLE `report_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `upload_time` datetime NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Regular'),
(2, 'Online Adhoc'),
(3, 'Global insights Study');

-- --------------------------------------------------------

--
-- Table structure for table `upload_log`
--

CREATE TABLE `upload_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `upload_time` datetime NOT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_log`
--

INSERT INTO `upload_log` (`id`, `user_id`, `document_id`, `upload_time`, `message`, `is_read`) VALUES
(8, 1, 12, '2024-07-04 14:52:16', 'Administrator telah menambah dokumen baru, yexevago', 0),
(9, 1, 13, '2024-07-04 17:13:34', 'Administrator telah menambah dokumen baru, Telkomsel One', 0),
(10, 1, 14, '2024-07-05 15:15:58', 'Administrator telah menambah dokumen baru, Consumer Study FBB Jan\'24', 0),
(11, 1, 15, '2024-07-08 13:28:47', 'Administrator telah menambah dokumen baru, Social Media Analysis IndiHome Jan\'24', 0),
(12, 1, 16, '2024-07-08 13:32:27', 'Administrator telah menambah dokumen baru, Orbit Naming', 0),
(13, 1, 17, '2024-07-08 13:37:40', 'Administrator telah menambah dokumen baru, Consumer Study FBB Jan\'24', 0),
(14, 1, 18, '2024-07-08 13:41:06', 'Administrator telah menambah dokumen baru, Issue Report Consumer Study FBB Jan\'24 - Biznet & First Media', 0),
(15, 1, 19, '2024-07-08 13:44:15', 'Administrator telah menambah dokumen baru, Winback PraNPC & CT0', 0),
(16, 1, 20, '2024-07-08 13:49:44', 'Administrator telah menambah dokumen baru, Consumer Study FBB Feb\'24', 0),
(17, 1, 21, '2024-07-08 13:53:20', 'Administrator telah menambah dokumen baru, New Naming IndiHome Low Segment', 0),
(18, 1, 22, '2024-07-08 13:56:25', 'Administrator telah menambah dokumen baru, Social Media Analysis IndiHome Feb\'24', 0),
(19, 1, 23, '2024-07-08 13:58:31', 'Administrator telah menambah dokumen baru, Campaign PSB 3X24 Jam', 0),
(20, 1, 24, '2024-07-08 14:01:04', 'Administrator telah menambah dokumen baru, Journey PSB IndiHome MyTelkomsel', 0),
(21, 1, 25, '2024-07-08 14:03:43', 'Administrator telah menambah dokumen baru, Social Media Analysis IndiHome Mar\'24', 0),
(22, 1, 26, '2024-07-08 14:07:34', 'Administrator telah menambah dokumen baru, Consumer Study FBB Mar\'24', 0),
(23, 1, 27, '2024-07-09 09:02:24', 'Administrator telah menambah dokumen baru, Consumer Study FBB Mar\'24', 0),
(24, 1, 27, '2024-07-09 09:11:46', 'Administrator telah memperbarui dokumen, Consumer Study FBB Mar\'24', 0),
(25, 1, 27, '2024-07-09 09:14:20', 'Administrator telah memperbarui dokumen, Consumer Study FBB Mar\'24', 0),
(26, 1, 28, '2024-09-06 16:57:56', 'Administrator telah menambah dokumen baru, Consumer Study Mobile Jan 2024', 0),
(27, 1, 29, '2024-09-06 17:00:25', 'Administrator telah menambah dokumen baru, Consumer Study Mobile Feb 2024', 0),
(28, 1, 30, '2024-09-06 17:01:50', 'Administrator telah menambah dokumen baru, Consumer Study Mobile Mar 2024', 0),
(29, 1, 31, '2024-09-09 14:36:00', 'Administrator telah menambah dokumen baru, Telkomsel Social Media Analysis Report - Januari 2024', 0),
(30, 1, 31, '2024-09-09 14:39:29', 'Administrator telah memperbarui dokumen, Telkomsel Social Media Analysis Report - Januari 2024', 0),
(31, 1, 32, '2024-09-09 14:43:56', 'Administrator telah menambah dokumen baru, Telkomsel Social Media Analysis Report - Februari 2024', 0),
(32, 1, 33, '2024-09-09 14:47:14', 'Administrator telah menambah dokumen baru, Telkomsel Social Media Analysis Report - May 2024', 0),
(33, 1, 34, '2024-09-09 14:49:35', 'Administrator telah menambah dokumen baru, Telkomsel Social Media Analysis Report - June 2024', 0),
(34, 1, 35, '2024-09-09 14:52:29', 'Administrator telah menambah dokumen baru, Telkomsel Social Media Analysis Report - July 2024', 0),
(35, 22, 36, '2024-12-20 18:52:11', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah menambah dokumen baru, sample document', 0),
(36, 22, 14, '2024-12-23 12:57:04', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Consumer Study FBB Jan\'24', 0),
(37, 22, 18, '2024-12-23 12:58:28', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Issue Report Consumer Study FBB Jan\'24 - Biznet & First Media', 0),
(38, 22, 19, '2024-12-23 12:59:05', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Winback PraNPC & CT0', 0),
(39, 22, 20, '2024-12-23 13:00:18', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Consumer Study FBB Feb\'24', 0),
(40, 22, 16, '2024-12-23 13:04:43', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Orbit Naming', 0),
(41, 22, 21, '2024-12-23 13:05:50', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, New Naming IndiHome Low Segment', 0),
(42, 22, 13, '2024-12-23 13:06:33', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Telkomsel One', 0),
(43, 22, 23, '2024-12-23 13:08:42', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Campaign PSB 3X24 Jam', 0),
(44, 22, 24, '2024-12-23 13:08:59', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Journey PSB IndiHome MyTelkomsel', 0),
(45, 22, 27, '2024-12-23 13:10:08', 'ABIEZA SYAHDILLA PUTERA RISQULLOH telah memperbarui dokumen, Consumer Study FBB Mar\'24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `microsoft_id` text DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `job_title` text DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `status` enum('AKTIF','NONAKTIF','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `microsoft_id`, `avatar`, `job_title`, `role`, `status`, `created_at`, `updated_at`) VALUES
(27, 'Admin', 'admin@telkomsel.co.id', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, '1', 'AKTIF', '2024-12-17 08:41:08', NULL),
(31, 'MCIGuest', 'mciguest@telkomsel.co.id', '482c811da5d5b4bc6d497ffa98491e38', NULL, NULL, 'Guest', '2', 'AKTIF', '2025-01-02 08:00:53', '2024-12-19 07:11:52'),
(32, 'ABIEZA SYAHDILLA PUTERA', 'abieza_sp_risqulloh_x@telkomsel.co.id', '202cb962ac59075b964b07152d234b70', '14c904bb-6872-4098-8b88-afc1585b7066', NULL, '', '2', 'NONAKTIF', '2024-12-23 10:02:20', '2024-12-23 10:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_document_permissions`
--

CREATE TABLE `user_document_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `status` enum('open','close','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_document_permissions`
--

INSERT INTO `user_document_permissions` (`id`, `user_id`, `document_id`, `status`, `created_at`) VALUES
(12, 2, 16, 'open', '2024-07-09 10:24:53'),
(13, 2, 13, 'open', '2024-07-09 10:24:57'),
(14, 2, 14, 'open', '2024-07-09 10:25:02'),
(21, 9, 24, 'open', '2024-10-11 04:07:04'),
(22, 9, 13, 'open', '2024-10-11 04:07:11'),
(23, 26, 13, 'open', '2024-12-17 08:41:38'),
(24, 31, 13, 'open', '2024-12-22 04:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_read_logs`
--

CREATE TABLE `user_read_logs` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

CREATE TABLE `user_views` (
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `last_viewed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_views`
--

INSERT INTO `user_views` (`user_id`, `document_id`, `last_viewed`) VALUES
(22, 14, '2024-12-20 06:26:11'),
(22, 27, '2024-12-23 00:09:44'),
(22, 31, '2024-12-23 00:02:03'),
(22, 32, '2024-12-23 00:07:55');

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
(2, 'Fixed Broadband di Indonesia', 'fixed', 'There are several fixed broadband internet providers in Indonesia. With such a large area, what is the actual user penetration and development of fixed broadband in Indonesia?', 'https://youtu.be/dGow7VXb81Y?feature=shared', '2024-08-14 09:03:40'),
(3, 'Top IPTV Reviews for 2024', 'fixed', 'Insider Streaming is a platform comprised of individual third-party providers who run their own listings, create their own policies, and are responsible for their listing services, and complying with the law. We provide a platform, but Insider Streaming does not provide listing services directly to our users on behalf of our providers. The content uploaded on Insider Streaming\'s platform is generated by independent providers who are not employees, agents, or representatives of Insider Streaming. Providers are responsible for ensuring they have all necessary rights to their content and that they are not infringing or violating any third party\'s rights by posting it. Insider Streaming reserves the right to disable any listing or account that we believe violates our Terms of Use, including our Intellectual Property Policy. Insider Streaming also reserves the right to take action against abusers of Insider Streaming\'s Intellectual Property Policy or our Terms of Use.', 'https://youtu.be/kXDhALUDEpU?feature=shared', '2024-08-14 09:06:34'),
(4, 'I Compared the Best Internet Options! Which One Should You Choose?', 'fixed', 'At a time when the price of everything seems to be going up, you may be able to save money by switching home internet providers. I\'ve tested popular fiber, cable and 5G home internet services. Which one should you choose? In this video, I’ll explain the pros and cons of these three internet services.', 'https://youtu.be/Gxv-cNwXEh4?feature=shared', '2024-08-15 03:40:29'),
(5, 'Is 5G Home Internet BETTER Than Fiber?', 'fixed', 'Could 5G home internet be a better solution than fiber, cable, or satellite?', 'https://youtu.be/9qHb6hQTGtk?feature=shared', '2024-08-15 07:42:45'),
(6, 'What Factors are Driving Fixed-Mobile Convergence? ', 'fixed', 'Listen in as Ed Amoroso, CEO of TAG Cyber, highlights the challenges faced by telecommunications companies when integrating converged security solutions into their existing infrastructure. The primary challenge is the lack of a native platform within the network ecosystem designed to provide cybersecurity. Traditional networks were not built with the capability to adapt to evolving threats, leaving a significant gap in security measures.', 'https://youtu.be/TSqIM8Bvdgs?feature=shared', '2024-08-15 07:48:24'),
(7, 'Consumer behavior', 'mobile', 'As a consumer, you may experience marketing transactions every day. For example, you might want to have a cup of coffee at a Starbucks and decide what kinds of coffee and size you want to have. You might also consider buying a drink using the stars on a Starbucks loyalty card that you earned. Similarly to this, consumers make different kinds of decisions while interacting with marketing stimuli in various situations. consumer behavior is everywhere and every day.', 'https://youtu.be/yv2cp1fmSt0?feature=shared', '2024-09-12 08:50:44'),
(8, 'Consumer Behavior', 'mobile', 'Ever wondered what goes on in the minds of consumers when they make a purchase? You\'re in the right place! Our channel is your gateway to understanding the intricate world of consumer behavior. Whether you\'re a marketer looking to enhance your strategies, a student delving into the depths of psychology, or simply curious about why people buy what they buy, you\'re about to embark on an enlightening journey.', 'https://youtu.be/s-t-PqOaX1E?feature=shared', '2024-09-12 08:52:03'),
(9, 'Consumer Behavior', 'mobile', 'The study of consumer buying behavior is most important for marketers as they can understand the expectation of the consumers. It helps to understand what makes a consumer buy a product. It is important to assess the kind of products liked by consumers so that they can release it to the market. Marketers can understand the likes and dislikes of consumers and design base their marketing efforts based on the findings.', 'https://youtu.be/wF41oVwGnK0?feature=shared', '2024-09-12 08:52:03'),
(10, 'Market Segmentation', 'mobile', 'Different auto manufacturers target significantly different groups of customers. For example, Toyota normally targets people with middle-range incomes who are looking for vehicles with good value for money. When thinking about Toyota, people think of durability, quality, safety, and reliability.', 'https://youtu.be/IrJ1cNIfmsk?feature=shared', '2024-09-12 08:55:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_views`
--
ALTER TABLE `document_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_views`
--
ALTER TABLE `download_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitation_thread_log`
--
ALTER TABLE `invitation_thread_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_ibfk_1` (`comment_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_category`
--
ALTER TABLE `reports_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_log`
--
ALTER TABLE `report_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_log`
--
ALTER TABLE `upload_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_document_permissions`
--
ALTER TABLE `user_document_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_read_logs`
--
ALTER TABLE `user_read_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_id` (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_views`
--
ALTER TABLE `user_views`
  ADD PRIMARY KEY (`user_id`,`document_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `document_views`
--
ALTER TABLE `document_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `download_views`
--
ALTER TABLE `download_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `invitation_thread_log`
--
ALTER TABLE `invitation_thread_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `reports_category`
--
ALTER TABLE `reports_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report_log`
--
ALTER TABLE `report_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload_log`
--
ALTER TABLE `upload_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_document_permissions`
--
ALTER TABLE `user_document_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_read_logs`
--
ALTER TABLE `user_read_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
