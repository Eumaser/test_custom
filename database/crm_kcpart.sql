-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 02:58 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm_kcpart`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_acls`
--

CREATE TABLE `db_acls` (
  `acls_id` int(11) NOT NULL,
  `acls_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `acls_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acls_cd` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `acls_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `acls_seqno` int(11) NOT NULL,
  `acls_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_additional`
--

CREATE TABLE `db_additional` (
  `additional_id` int(11) NOT NULL,
  `additional_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `additional_empl_id` int(11) NOT NULL,
  `additional_date` date NOT NULL,
  `additional_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `additional_amount` decimal(10,2) NOT NULL,
  `additional_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_additional`
--

INSERT INTO `db_additional` (`additional_id`, `additional_type`, `additional_empl_id`, `additional_date`, `additional_remark`, `additional_amount`, `additional_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, '1', 1, '2016-07-08', 'Jul Comm', '255.00', 1, 10000, '2016-07-08 16:24:53', 10000, '2016-07-08 16:25:10'),
(2, '2', 1, '2016-07-08', '', '600.00', 1, 4, '2016-07-08 17:35:37', 4, '2016-07-08 17:35:55'),
(3, '1', 15, '2016-07-29', 'New Project', '300.00', 1, 14, '2016-07-25 09:25:24', 14, '2016-07-25 09:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `db_additionaltype`
--

CREATE TABLE `db_additionaltype` (
  `additionaltype_id` int(11) NOT NULL,
  `additionaltype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `additionaltype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `additionaltype_maxamt` decimal(10,2) NOT NULL,
  `additionaltype_seqno` int(11) NOT NULL,
  `additionaltype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_additionaltype`
--

INSERT INTO `db_additionaltype` (`additionaltype_id`, `additionaltype_code`, `additionaltype_desc`, `additionaltype_maxamt`, `additionaltype_seqno`, `additionaltype_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Commissions', 'Commissions', '0.00', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Bonuses', 'Bonuses', '0.00', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-08 18:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `db_attendance`
--

CREATE TABLE `db_attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_empl` int(11) NOT NULL,
  `attendance_timein` datetime NOT NULL,
  `attendance_timeout` datetime NOT NULL,
  `attendance_project` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_attendance`
--

INSERT INTO `db_attendance` (`attendance_id`, `attendance_empl`, `attendance_timein`, `attendance_timeout`, `attendance_project`, `attendance_date`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(14, 15, '2016-07-25 00:00:00', '2016-07-25 20:37:28', 0, '2016-07-25', 0, '0000-00-00 00:00:00', 10000, '2016-07-25 20:37:28'),
(18, 15, '2016-07-25 20:37:24', '2016-07-25 20:38:16', 1, '2016-07-25', 10000, '2016-07-25 20:37:24', 10000, '2016-07-25 20:38:16'),
(19, 15, '2016-07-25 20:38:21', '2016-07-25 20:38:27', 1, '2016-07-25', 10000, '2016-07-25 20:38:21', 10000, '2016-07-25 20:38:27'),
(20, 15, '2016-07-25 20:38:33', '2016-07-25 20:43:04', 1, '2016-07-25', 10000, '2016-07-25 20:38:33', 10000, '2016-07-25 20:43:04'),
(21, 15, '2016-07-25 20:43:09', '2016-07-25 20:43:15', 1, '2016-07-25', 10000, '2016-07-25 20:43:09', 10000, '2016-07-25 20:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `db_backcharge`
--

CREATE TABLE `db_backcharge` (
  `backcharge_id` int(11) NOT NULL,
  `backcharge_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `backcharge_date` date NOT NULL,
  `backcharge_project` int(11) NOT NULL,
  `backcharge_subcon` int(11) NOT NULL,
  `backcharge_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `backcharge_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_bank`
--

CREATE TABLE `db_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_seqno` int(11) NOT NULL,
  `bank_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_bcline`
--

CREATE TABLE `db_bcline` (
  `bcline_id` int(11) NOT NULL,
  `bcline_backcharge_id` int(11) NOT NULL,
  `bcline_poline_id` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_brand`
--

CREATE TABLE `db_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `brand_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `brand_seqno` int(11) NOT NULL,
  `brand_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_cacc`
--

CREATE TABLE `db_cacc` (
  `cacc_id` int(11) NOT NULL,
  `cacc_acls_id` int(11) NOT NULL,
  `cacc_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cacc_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cacc_relation` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cacc_parent_id` int(11) NOT NULL,
  `cacc_fixed_asset_id` int(11) NOT NULL,
  `cacc_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `cacc_seqno` int(11) NOT NULL,
  `cacc_status` int(11) NOT NULL,
  `cacc_currency_id` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_category`
--

CREATE TABLE `db_category` (
  `category_id` int(11) NOT NULL,
  `category_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `category_seqno` int(11) NOT NULL,
  `category_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_category`
--

INSERT INTO `db_category` (`category_id`, `category_code`, `category_desc`, `category_seqno`, `category_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(7, 'IMPELLER', 'Impeller', 10, 1, 10000, '2017-09-05 12:19:51', 10000, '2017-09-05 12:19:51'),
(8, 'SWP &amp; STRAINER', 'SWP &amp; Strainer', 10, 1, 10000, '2017-09-05 12:20:08', 10000, '2017-09-05 12:20:08'),
(9, 'Detroit Diesel', 'Detroit Diesel', 10, 1, 10000, '2017-09-05 12:20:19', 10000, '2017-09-11 13:42:50'),
(10, 'Flat Shipping Rate', 'Flat Shipping Rate', 40, 1, 10000, '2017-09-21 12:37:54', 10000, '2017-09-21 12:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `db_claim`
--

CREATE TABLE `db_claim` (
  `claim_id` int(11) NOT NULL,
  `claim_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `claim_outlet` int(11) NOT NULL,
  `claim_engineers` int(11) NOT NULL,
  `claim_datefrom` date NOT NULL,
  `claim_dateto` date NOT NULL,
  `claim_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `claim_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_claims`
--

CREATE TABLE `db_claims` (
  `claims_id` int(11) NOT NULL,
  `claims_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `claims_empl_id` int(11) NOT NULL,
  `claims_date` date NOT NULL,
  `claims_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `claims_amount` decimal(10,2) NOT NULL,
  `claims_approvalstatus` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `claims_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_claimsline`
--

CREATE TABLE `db_claimsline` (
  `claimsline_id` int(11) NOT NULL,
  `claimsline_claims_id` int(11) NOT NULL,
  `claimsline_seqno` int(11) NOT NULL,
  `claimsline_date` date NOT NULL,
  `claimsline_type` int(11) NOT NULL,
  `claimsline_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `claimsline_receiptno` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `claimsline_amount` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_claimstype`
--

CREATE TABLE `db_claimstype` (
  `claimstype_id` int(11) NOT NULL,
  `claimstype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `claimstype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `claimstype_maxamt` decimal(10,2) NOT NULL,
  `claimstype_seqno` int(11) NOT NULL,
  `claimstype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_clmd`
--

CREATE TABLE `db_clmd` (
  `clmd_id` int(11) NOT NULL,
  `clmd_claim_id` int(11) NOT NULL,
  `clmd_expenses_id` int(11) NOT NULL,
  `clmd_expenses_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `clmd_date` date NOT NULL,
  `clmd_currency_id` int(11) NOT NULL,
  `clmd_amt` decimal(15,2) NOT NULL,
  `clmd_rate` decimal(10,4) NOT NULL,
  `clmd_samt` decimal(15,2) NOT NULL,
  `clmd_eamt` decimal(15,2) NOT NULL,
  `clmd_isamex` int(11) NOT NULL,
  `clmd_isprep` int(11) NOT NULL,
  `clmd_ispriv` int(11) NOT NULL,
  `clmd_seqno` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_clms`
--

CREATE TABLE `db_clms` (
  `clms_id` int(11) NOT NULL,
  `clms_clmd_id` int(11) NOT NULL,
  `clms_seqno` int(11) NOT NULL,
  `clms_sorder_id` int(11) NOT NULL,
  `clms_percent` decimal(10,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_contact`
--

CREATE TABLE `db_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_partner_id` int(11) NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_tel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact_fax` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_cellphone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact_department` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `contact_position` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `contact_jobtitle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `contact_forename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_seqno` int(11) NOT NULL,
  `contact_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_contact`
--

INSERT INTO `db_contact` (`contact_id`, `contact_partner_id`, `contact_name`, `contact_tel`, `contact_fax`, `contact_email`, `contact_address`, `contact_remark`, `contact_cellphone`, `contact_department`, `contact_position`, `contact_jobtitle`, `contact_forename`, `contact_lastname`, `contact_seqno`, `contact_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(22, 93, 'Edward', '81354729', '', 'edward@alphadesign.com.sg', '', '', '', '', '', '', '', '', 10, 1, 10000, '2017-09-15 17:47:12', 10000, '2017-09-15 17:58:04'),
(23, 93, 'Emily', '81366729', '', 'emily@alphadesign.com.sg', '', '', '', '', '', '', '', '', 10, 1, 10000, '2017-09-15 17:53:00', 10000, '2017-09-15 17:58:09'),
(24, 92, 'Felix', '81924536', '', 'felix@cclaw.com.sg', '', '', '', '', '', '', '', '', 10, 1, 10000, '2017-09-15 17:54:18', 10000, '2017-09-15 17:57:46'),
(25, 92, 'Felicia', '81924589', '', 'felicia@cclaw.com.sg', '', '', '', '', '', '', '', '', 10, 1, 10000, '2017-09-15 17:55:34', 10000, '2017-09-15 17:57:52'),
(26, 93, 'ccsd', 'd', 'sdcsd', '', ' ', 'cd ', '', '', '', '', '', '', 10, 1, 10000, '2017-09-27 14:43:27', 10000, '2017-09-27 14:43:27'),
(27, 93, ' c ', ' c c', 'c c ', ' ', 'c c ', 'c', '', '', '', '', '', '', 10, 1, 10000, '2017-09-27 14:44:03', 10000, '2017-09-27 14:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `db_country`
--

CREATE TABLE `db_country` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `country_seqno` int(11) NOT NULL,
  `country_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_country`
--

INSERT INTO `db_country` (`country_id`, `country_code`, `country_desc`, `country_seqno`, `country_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(32, 'USA', 'USA', 10, 1, 10000, '2017-09-07 16:47:11', 10000, '2017-09-11 14:18:26'),
(33, 'South Korea', 'South Korea', 20, 1, 10000, '2017-09-07 16:47:32', 10000, '2017-09-07 16:47:42'),
(34, 'Japan', 'Japan', 30, 1, 10000, '2017-09-07 16:47:54', 10000, '2017-09-07 16:47:54'),
(35, 'Thailand', 'Thailand', 10, 1, 10000, '2017-11-03 10:38:06', 10000, '2017-11-03 10:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `db_countryitem`
--

CREATE TABLE `db_countryitem` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_seqno` int(11) NOT NULL,
  `country_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_countryitem`
--

INSERT INTO `db_countryitem` (`country_id`, `country_code`, `country_desc`, `country_seqno`, `country_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(32, 'USA', 'USA', 10, 1, 10000, '2017-09-07 16:47:11', 10000, '2017-09-11 14:18:26'),
(33, 'South Korea', 'South Korea', 20, 1, 10000, '2017-09-07 16:47:32', 10000, '2017-09-07 16:47:42'),
(34, 'Japan', 'Japan', 30, 1, 10000, '2017-09-07 16:47:54', 10000, '2017-09-07 16:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `db_cprofile`
--

CREATE TABLE `db_cprofile` (
  `cprofile_id` int(11) NOT NULL,
  `cprofile_name` text COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_fax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_contactemail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_ccemail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_description` text COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_address` text COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_google` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_bank` text COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_acc_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_gst_no` text COLLATE utf8_unicode_ci NOT NULL,
  `cprofile_gst` decimal(10,2) NOT NULL,
  `cprofile_country` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_cprofile`
--

INSERT INTO `db_cprofile` (`cprofile_id`, `cprofile_name`, `cprofile_tel`, `cprofile_fax`, `cprofile_email`, `cprofile_contactemail`, `cprofile_ccemail`, `cprofile_description`, `cprofile_address`, `cprofile_facebook`, `cprofile_twitter`, `cprofile_google`, `cprofile_youtube`, `cprofile_bank`, `cprofile_account`, `cprofile_acc_code`, `cprofile_gst_no`, `cprofile_gst`, `cprofile_country`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'K-C Parts and Services (s) Pte. Ltd.', '(65)62548022', '(65)62547022', 'kcolyer@singnet.com.sg', '', '', '', 'Blk. 15 Lorong 8 Toa Payoh, #06-06 Braddell Tech\r\nSingapore 319262.', '', '', '', '', '', '', '', '198200618M', '7.00', 10, 0, '0000-00-00 00:00:00', 10000, '2017-08-21 16:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `db_crate`
--

CREATE TABLE `db_crate` (
  `crate_id` int(11) NOT NULL,
  `crate_fcurrency_id` int(11) NOT NULL,
  `crate_tcurrency_id` int(11) NOT NULL,
  `crate_rate` decimal(10,4) NOT NULL,
  `crate_fdate` date NOT NULL,
  `crate_tdate` date NOT NULL,
  `crate_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `crate_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_currency`
--

CREATE TABLE `db_currency` (
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `currency_seqno` int(11) NOT NULL,
  `currency_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_currency`
--

INSERT INTO `db_currency` (`currency_id`, `currency_code`, `currency_desc`, `currency_seqno`, `currency_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(2, 'SGD', 'SGD', 10, 1, 0, '2016-02-17 18:29:09', 0, '2016-02-17 19:06:59'),
(4, 'USD', 'USD', 10, 1, 0, '2016-02-29 22:17:24', 0, '2016-02-29 22:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `db_deductions`
--

CREATE TABLE `db_deductions` (
  `deductions_id` int(11) NOT NULL,
  `deductions_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `deductions_empl_id` int(11) NOT NULL,
  `deductions_date` date NOT NULL,
  `deductions_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `deductions_amount` decimal(10,2) NOT NULL,
  `deductions_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_delivery`
--

CREATE TABLE `db_delivery` (
  `delivery_id` int(11) NOT NULL,
  `delivery_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `delivery_seqno` int(11) NOT NULL,
  `delivery_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_delivery`
--

INSERT INTO `db_delivery` (`delivery_id`, `delivery_code`, `delivery_desc`, `delivery_seqno`, `delivery_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'D1', 'Ex-Stock subject to prior sales', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 16:48:13'),
(2, 'D2', 'About # to # days, Ex-Stock Depot subject to prior sale.', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 16:48:40'),
(3, 'D3', 'About 10-12 working days, Ex-Depot subject to prior sale. Please allow 18-20 weeks subject to factory\'s stock for no-stock items.', 30, 1, 0, '2016-03-01 11:16:29', 10000, '2017-09-07 16:48:55'),
(4, 'D4', 'Ex-Stock Factory USA subject to factory stock availability at the time of order.', 40, 1, 10000, '2017-08-21 10:05:52', 10000, '2017-09-07 16:49:11'),
(5, 'D5', 'Ex-Stock South Korea subject to prior sales\r\n', 50, 1, 10000, '2017-09-07 16:49:27', 10000, '2017-09-07 16:49:27'),
(6, 'D6', 'Require 1 day after confirmation subject to prior sale', 60, 1, 10000, '2017-09-07 16:49:40', 10000, '2017-09-07 16:49:40'),
(7, 'D7', 'About # to # working days after order subject to factory\'s stock availability.', 70, 1, 10000, '2017-09-07 16:49:51', 10000, '2017-09-11 13:43:24'),
(8, 'D8', 'About # to # weeks after confirm order subject to factory\'s stock availability.', 80, 1, 10000, '2017-09-07 16:50:12', 10000, '2017-09-07 16:50:12'),
(9, 'D9', 'No stock Items on back-order by Air abt 21-28 days. Airfreight charges applies. (If worldwide no stock, delivery will be 2 to 3 months or more.)', 90, 1, 10000, '2017-09-07 16:50:25', 10000, '2017-09-07 16:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `db_department`
--

CREATE TABLE `db_department` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `department_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `department_seqno` int(11) NOT NULL,
  `department_status` int(11) NOT NULL,
  `department_default` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_department`
--

INSERT INTO `db_department` (`department_id`, `department_code`, `department_desc`, `department_seqno`, `department_status`, `department_default`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(3, 'Admin', 'Admin', 30, 1, 1, 10000, '2016-03-04 09:11:24', 10000, '2016-03-04 09:11:24'),
(4, 'Sales', 'Sales', 40, 1, 1, 10000, '2016-03-04 09:11:32', 10000, '2016-03-04 09:11:32'),
(5, 'Others', 'Others', 50, 1, 1, 10000, '2016-03-04 09:11:39', 10000, '2016-03-04 09:11:39'),
(6, 'Purchaser', 'Purchaser', 60, 1, 1, 10000, '2016-03-04 09:11:51', 13, '2016-08-22 11:39:47'),
(7, 'HR', 'HR', 70, 1, 1, 10000, '2016-03-04 09:12:19', 10000, '2016-03-04 09:12:40'),
(8, 'Purchaser Manager', 'Purchaser Manager', 60, 1, 1, 10000, '2016-03-04 09:11:51', 13, '2016-08-22 11:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `db_empl`
--

CREATE TABLE `db_empl` (
  `empl_id` int(11) NOT NULL,
  `empl_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `empl_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_department` int(11) NOT NULL,
  `empl_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_login_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_login_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_nric` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `empl_birthday` date NOT NULL,
  `empl_joindate` date NOT NULL,
  `empl_group` int(11) NOT NULL,
  `empl_address` text COLLATE utf8_unicode_ci NOT NULL,
  `empl_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `empl_outlet` int(11) NOT NULL,
  `empl_travel_cost` decimal(10,2) NOT NULL,
  `empl_working_cost` decimal(10,2) NOT NULL,
  `empl_currency_id` int(11) NOT NULL,
  `empl_language` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `empl_bank` int(11) NOT NULL,
  `empl_bank_acc_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `empl_nationality` int(11) NOT NULL,
  `empl_emplpass` int(11) NOT NULL,
  `empl_levy_amt` decimal(15,2) NOT NULL,
  `empl_pass_issuance` date NOT NULL,
  `empl_pass_renewal` date NOT NULL,
  `empl_resigndate` date NOT NULL,
  `empl_confirmationdate` date NOT NULL,
  `empl_leave_approved1` int(11) NOT NULL,
  `empl_leave_approved2` int(11) NOT NULL,
  `empl_leave_approved3` int(11) NOT NULL,
  `empl_claims_approved1` int(11) NOT NULL,
  `empl_claims_approved2` int(11) NOT NULL,
  `empl_claims_approved3` int(11) NOT NULL,
  `empl_seqno` int(11) NOT NULL,
  `empl_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_empl`
--

INSERT INTO `db_empl` (`empl_id`, `empl_type`, `empl_code`, `empl_name`, `empl_department`, `empl_email`, `empl_login_email`, `empl_login_password`, `empl_nric`, `empl_mobile`, `empl_tel`, `empl_birthday`, `empl_joindate`, `empl_group`, `empl_address`, `empl_remark`, `empl_outlet`, `empl_travel_cost`, `empl_working_cost`, `empl_currency_id`, `empl_language`, `empl_bank`, `empl_bank_acc_no`, `empl_nationality`, `empl_emplpass`, `empl_levy_amt`, `empl_pass_issuance`, `empl_pass_renewal`, `empl_resigndate`, `empl_confirmationdate`, `empl_leave_approved1`, `empl_leave_approved2`, `empl_leave_approved3`, `empl_claims_approved1`, `empl_claims_approved2`, `empl_claims_approved3`, `empl_seqno`, `empl_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(4, 'EMPLOYEE', 'ADMIN', 'ADMIN', 3, '', 'ADMIN', 'eaed1f8383ad01b69792b9b3d3b26e1c', '', '', '', '0000-00-00', '0000-00-00', 1, '', '', 1, '0.00', '0.00', 2, 'english', 0, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 0, 0, '0000-00-00 00:00:00', 13, '2016-08-22 11:38:38'),
(12, 'EMPLOYEE', 'Empl//0002', 'chinese_account', 4, '', 'chinese', 'a141c0e4f0fea4841d1670e52626a2bd', '', '', '', '0000-00-00', '2016-07-19', 1, '', '', 1, '0.00', '0.00', 0, 'chinese', 0, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 0, 10000, '2016-07-19 11:31:24', 10000, '2016-07-19 12:04:06'),
(13, 'EMPLOYEE', 'Empl0003', 'Adrian Ang', 3, 'account@kcparts.com.sg', 'account@kcparts.com.sg', '97a357060e5db69521a8f45be1675dcd', 'account@kcparts.com.sg', '123456', '112233445566', '0000-00-00', '2016-07-22', 1, 'account@kcparts.com.sg', 'account@kcparts.com.sg', 1, '0.00', '0.00', 0, 'english', 10, '12345678', 1, 2, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '2016-07-23', 0, 0, 0, 0, 0, 0, 10, 1, 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(14, 'EMPLOYEE', 'Empl0004', 'Brandon Boey', 7, 'hr@kcparts.com.sg', 'hr@kcparts.com.sg', '97a357060e5db69521a8f45be1675dcd', 'hr@kcparts.com.sg', '', '', '0000-00-00', '2016-07-20', 4, 'hr@kcparts.com.sg', 'hr@kcparts.com.sg', 1, '0.00', '0.00', 0, 'english', 10, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 1, 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(15, 'EMPLOYEE', 'Empl0005', 'Carmen Choong', 6, 'purchaser@kcparts.com.sg', 'purchaser@kcparts.com.sg', '97a357060e5db69521a8f45be1675dcd', 'purchaser@kcparts.com.sg', '', '', '0000-00-00', '2016-07-21', 3, 'purchaser@kcparts.com.sg', 'purchaser@kcparts.com.sg', 1, '0.00', '0.00', 0, 'english', 10, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 1, 10000, '2016-07-21 10:45:22', 10000, '2017-09-12 11:41:24'),
(16, 'EMPLOYEE', 'Empl0006', 'martin@kcparts.com', 8, 'martin@kcparts.com', 'martin@kcparts.com', '87ea77a5379f32c254a0301cb7277d31', 'martin@kcparts.com', '', '', '0000-00-00', '2016-07-21', 5, 'martin@kcparts.com', 'martin@kcparts.com', 1, '0.00', '0.00', 0, 'english', 10, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 0, 10000, '2016-07-21 10:46:04', 10000, '2017-09-12 11:41:35'),
(17, 'EMPLOYEE', 'Empl0007', 'boss@kcparts.com', 3, 'boss@kcparts.com', 'boss@kcparts.com', '87ea77a5379f32c254a0301cb7277d31', 'boss@kcparts.com', '', '', '0000-00-00', '2016-07-28', 1, 'boss@kcparts.com', 'boss@kcparts.com', 1, '0.00', '0.00', 0, 'english', 10, '', 1, 1, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 0, 10000, '2016-07-28 10:21:32', 10000, '2017-09-12 11:41:46'),
(18, 'EMPLOYEE', 'Empl0008', 'Eng Koon', 3, '', 'EM1', 'cf0f8a088f232d7abe7dbfda9a9e69c9', 'S1495785E', '9831 4666', '', '0000-00-00', '2000-01-01', 2, '15 Lorong Pisang Emas, Singapore 597832', '', 1, '0.00', '0.00', 0, 'chinese', 11, '', 2, 5, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '2000-01-01', 0, 0, 0, 0, 0, 0, 10, 1, 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(19, 'EMPLOYEE', 'Empl0009', 'Nasirah Kamal Luddin', 3, 'na@kcparts.com.sg', 'na@kcparts.com.sg', '97a357060e5db69521a8f45be1675dcd', 'G0866043P', '94554817', '', '0000-00-00', '2017-08-16', 1, '636 Hougang Avenue 8 #03-91', '', 1, '0.00', '0.00', 0, 'english', 10, '', 1, 4, '0.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 10, 1, 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `db_emplleave`
--

CREATE TABLE `db_emplleave` (
  `emplleave_id` int(11) NOT NULL,
  `emplleave_empl` int(11) NOT NULL,
  `emplleave_leavetype` int(11) NOT NULL,
  `emplleave_days` decimal(10,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_emplleave`
--

INSERT INTO `db_emplleave` (`emplleave_id`, `emplleave_empl`, `emplleave_leavetype`, `emplleave_days`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 22, 1, '140.00', 10000, '2016-07-05 14:05:17', 10000, '2016-07-05 14:27:16'),
(2, 22, 2, '69.00', 10000, '2016-07-05 14:05:18', 10000, '2016-07-05 14:27:16'),
(3, 22, 3, '11.00', 10000, '2016-07-05 14:05:18', 10000, '2016-07-05 14:27:16'),
(4, 22, 4, '22.00', 10000, '2016-07-05 14:05:18', 10000, '2016-07-05 14:27:17'),
(5, 22, 5, '44.00', 10000, '2016-07-05 14:05:18', 10000, '2016-07-05 14:27:17'),
(6, 22, 6, '66.00', 10000, '2016-07-05 14:05:18', 10000, '2016-07-05 14:27:17'),
(7, 23, 1, '20.00', 10000, '2016-07-05 14:27:51', 10000, '2016-07-05 14:27:51'),
(8, 23, 2, '25.00', 10000, '2016-07-05 14:27:52', 10000, '2016-07-05 14:27:52'),
(9, 23, 3, '49.00', 10000, '2016-07-05 14:27:52', 10000, '2016-07-05 14:27:52'),
(10, 23, 4, '70.00', 10000, '2016-07-05 14:27:52', 10000, '2016-07-05 14:27:52'),
(11, 23, 5, '122.00', 10000, '2016-07-05 14:27:52', 10000, '2016-07-05 14:27:52'),
(12, 23, 6, '77.00', 10000, '2016-07-05 14:27:52', 10000, '2016-07-05 14:27:52'),
(13, 1, 1, '10.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(14, 1, 2, '20.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(15, 1, 3, '3.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(16, 1, 4, '4.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(17, 1, 5, '5.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(18, 1, 6, '6.00', 10000, '2016-07-05 15:06:54', 10000, '2016-07-07 16:50:37'),
(19, 2, 1, '5.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:39'),
(20, 2, 2, '10.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:39'),
(21, 2, 3, '20.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:39'),
(22, 2, 4, '6.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:39'),
(23, 2, 5, '3.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:40'),
(24, 2, 6, '9.00', 10000, '2016-07-07 09:02:29', 10000, '2016-07-07 20:46:40'),
(25, 3, 1, '0.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(26, 3, 2, '0.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(27, 3, 3, '0.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(28, 3, 4, '0.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(29, 3, 5, '0.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(30, 3, 6, '10.00', 10000, '2016-07-07 10:24:34', 10000, '2016-07-07 10:28:14'),
(32, 1, 1, '0.00', 10000, '2016-07-08 14:20:45', 10000, '2016-07-08 14:20:45'),
(34, 5, 1, '0.00', 10000, '2016-07-08 18:28:16', 10000, '2016-07-08 18:28:16'),
(35, 6, 1, '0.00', 10000, '2016-07-14 12:14:59', 10000, '2016-07-14 12:14:59'),
(36, 7, 1, '0.00', 10000, '2016-07-14 18:02:38', 10000, '2016-07-14 18:02:38'),
(37, 8, 1, '0.00', 10000, '2016-07-14 18:03:08', 10000, '2016-07-14 18:03:08'),
(42, 1, 1, '0.00', 10000, '2016-07-19 11:30:22', 10000, '2016-07-19 11:30:22'),
(68, 12, 1, '11.00', 10000, '2016-07-19 11:53:35', 10000, '2016-07-19 12:03:32'),
(69, 12, 2, '22.00', 10000, '2016-07-19 11:53:35', 10000, '2016-07-19 12:03:33'),
(70, 12, 3, '33.00', 10000, '2016-07-19 11:53:35', 10000, '2016-07-19 12:03:33'),
(71, 12, 4, '44.00', 10000, '2016-07-19 11:53:35', 10000, '2016-07-19 12:03:33'),
(72, 12, 5, '55.00', 10000, '2016-07-19 11:53:36', 10000, '2016-07-19 12:03:33'),
(73, 12, 6, '66.00', 10000, '2016-07-19 11:53:36', 10000, '2016-07-19 12:03:33'),
(80, 13, 1, '10.00', 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(81, 13, 2, '2.00', 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(82, 13, 3, '3.00', 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(83, 13, 4, '4.00', 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(84, 13, 5, '5.00', 10000, '2016-07-19 12:05:18', 10000, '2017-09-12 11:38:33'),
(85, 13, 6, '6.00', 10000, '2016-07-19 12:05:18', 10000, '2016-07-21 13:21:11'),
(86, 14, 1, '0.00', 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(87, 14, 2, '0.00', 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(88, 14, 3, '0.00', 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(89, 14, 4, '0.00', 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(90, 14, 5, '0.00', 10000, '2016-07-20 20:58:14', 10000, '2017-09-12 11:39:15'),
(91, 14, 6, '0.00', 10000, '2016-07-20 20:58:14', 14, '2016-07-25 09:36:00'),
(92, 15, 1, '0.00', 10000, '2016-07-21 10:45:22', 10000, '2017-09-12 11:41:24'),
(93, 15, 2, '0.00', 10000, '2016-07-21 10:45:22', 10000, '2017-09-12 11:41:24'),
(94, 15, 3, '0.00', 10000, '2016-07-21 10:45:23', 10000, '2017-09-12 11:41:24'),
(95, 15, 4, '0.00', 10000, '2016-07-21 10:45:23', 10000, '2017-09-12 11:41:24'),
(96, 15, 5, '0.00', 10000, '2016-07-21 10:45:23', 10000, '2017-09-12 11:41:24'),
(97, 15, 6, '0.00', 10000, '2016-07-21 10:45:23', 10000, '2016-07-21 10:45:23'),
(98, 16, 1, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-08-24 09:25:47'),
(99, 16, 2, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-08-24 09:25:47'),
(100, 16, 3, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-08-24 09:25:47'),
(101, 16, 4, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-08-24 09:25:47'),
(102, 16, 5, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-08-24 09:25:47'),
(103, 16, 6, '0.00', 10000, '2016-07-21 10:46:04', 10000, '2016-07-21 10:46:04'),
(104, 17, 1, '0.00', 10000, '2016-07-28 10:21:32', 13, '2016-08-22 11:39:12'),
(105, 17, 2, '0.00', 10000, '2016-07-28 10:21:32', 13, '2016-08-22 11:39:12'),
(106, 17, 3, '0.00', 10000, '2016-07-28 10:21:32', 13, '2016-08-22 11:39:12'),
(107, 17, 4, '0.00', 10000, '2016-07-28 10:21:32', 13, '2016-08-22 11:39:12'),
(108, 17, 5, '0.00', 10000, '2016-07-28 10:21:32', 13, '2016-08-22 11:39:12'),
(109, 17, 6, '0.00', 10000, '2016-07-28 10:21:32', 10000, '2016-07-28 10:21:32'),
(110, 13, 7, '0.00', 10000, '2016-08-22 11:33:28', 10000, '2017-09-12 11:38:33'),
(111, 17, 7, '0.00', 13, '2016-08-22 11:34:12', 13, '2016-08-22 11:39:12'),
(112, 15, 7, '0.00', 13, '2016-08-22 11:35:23', 10000, '2017-09-12 11:41:24'),
(113, 16, 7, '0.00', 13, '2016-08-22 11:37:18', 10000, '2016-08-24 09:25:47'),
(114, 14, 7, '0.00', 13, '2016-08-22 11:38:55', 10000, '2017-09-12 11:39:15'),
(115, 18, 1, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(116, 18, 2, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(117, 18, 3, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(118, 18, 4, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(119, 18, 5, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(120, 18, 7, '0.00', 10000, '2017-04-19 08:50:22', 10000, '2017-04-19 08:55:39'),
(121, 19, 1, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26'),
(122, 19, 2, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26'),
(123, 19, 3, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26'),
(124, 19, 4, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26'),
(125, 19, 5, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26'),
(126, 19, 7, '0.00', 10000, '2017-08-16 17:33:11', 10000, '2017-09-12 11:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `db_emplpass`
--

CREATE TABLE `db_emplpass` (
  `emplpass_id` int(11) NOT NULL,
  `emplpass_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emplpass_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `emplpass_cpf` int(11) NOT NULL,
  `emplpass_seqno` int(11) NOT NULL,
  `emplpass_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_emplpass`
--

INSERT INTO `db_emplpass` (`emplpass_id`, `emplpass_code`, `emplpass_desc`, `emplpass_cpf`, `emplpass_seqno`, `emplpass_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'WP', 'WP', 0, 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'SP', 'SP', 0, 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'PR', 'PR', 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'EP', 'EP', 1, 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'N.A', 'N.A', 0, 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_emplsalary`
--

CREATE TABLE `db_emplsalary` (
  `emplsalary_id` int(11) NOT NULL,
  `emplsalary_empl_id` int(11) NOT NULL,
  `emplsalary_date` date NOT NULL,
  `emplsalary_amount` decimal(15,2) NOT NULL,
  `emplsalary_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `emplsalary_workday` int(11) NOT NULL,
  `emplsalary_workhours` decimal(10,2) NOT NULL,
  `emplsalary_hourly` decimal(15,2) NOT NULL,
  `emplsalary_overtime` decimal(15,2) NOT NULL,
  `emplsalary_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_emplsalary`
--

INSERT INTO `db_emplsalary` (`emplsalary_id`, `emplsalary_empl_id`, `emplsalary_date`, `emplsalary_amount`, `emplsalary_remark`, `emplsalary_workday`, `emplsalary_workhours`, `emplsalary_hourly`, `emplsalary_overtime`, `emplsalary_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(11, 2, '0000-00-00', '600.00', '', 20, '0.00', '0.00', '0.00', 0, 4, '2016-07-07 20:22:43', 4, '2016-07-07 20:22:43'),
(12, 2, '2016-07-07', '3000.00', '', 20, '0.00', '0.00', '0.00', 0, 4, '2016-07-07 20:24:39', 4, '2016-07-07 20:24:39'),
(13, 2, '2016-07-15', '4000.00', '', 20, '0.00', '0.00', '0.00', 0, 4, '2016-07-07 20:39:41', 4, '2016-07-07 20:39:41'),
(14, 2, '2016-07-28', '8000.00', '', 20, '0.00', '0.00', '0.00', 0, 4, '2016-07-07 20:41:43', 4, '2016-07-07 20:41:43'),
(15, 2, '2016-07-07', '5000.00', 's\nsc\ns\nds', 20, '0.00', '0.00', '0.00', 0, 4, '2016-07-07 20:43:11', 4, '2016-07-07 20:43:11'),
(16, 1, '2016-07-08', '2000.00', '', 20, '0.00', '8.50', '0.00', 0, 4, '2016-07-08 10:14:27', 4, '2016-07-08 10:14:27'),
(17, 1, '2016-09-01', '3000.00', '', 20, '0.00', '0.00', '0.00', 1, 4, '2016-07-08 10:57:09', 4, '2016-07-08 11:16:53'),
(18, 1, '2016-08-01', '2000.00', '', 20, '0.00', '100.00', '15.00', 1, 4, '2016-07-08 10:57:36', 4, '2016-07-08 11:16:47'),
(19, 1, '2016-06-01', '1500.00', '', 21, '0.00', '0.00', '10.00', 1, 4, '2016-07-08 10:59:27', 4, '2016-07-08 11:16:41'),
(20, 4, '2016-07-08', '2500.00', '', 20, '0.00', '0.00', '0.00', 1, 10000, '2016-07-08 11:18:35', 10000, '2016-07-14 09:12:01'),
(21, 12, '2016-07-19', '40.00', 'test', 20, '0.00', '20.00', '30.00', 1, 10000, '2016-07-19 11:57:49', 10000, '2016-07-19 11:57:49'),
(22, 12, '2016-07-23', '30.00', '', 20, '0.00', '40.00', '50.00', 1, 10000, '2016-07-19 11:58:57', 10000, '2016-07-19 11:59:06'),
(23, 13, '2016-07-19', '10.00', '4', 20, '0.00', '20.00', '30.00', 1, 10000, '2016-07-19 12:05:26', 10000, '2016-07-19 12:05:26'),
(24, 14, '2016-07-25', '3000.00', 'test', 20, '0.00', '10.00', '0.00', 1, 10000, '2016-07-25 11:16:28', 10000, '2016-07-25 11:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `db_equipment`
--

CREATE TABLE `db_equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `equipment_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `equipment_project` int(11) NOT NULL,
  `equipment_seqno` int(11) NOT NULL,
  `equipment_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_equiptransfer`
--

CREATE TABLE `db_equiptransfer` (
  `equiptransfer_id` int(11) NOT NULL,
  `equiptransfer_equip_id` int(11) NOT NULL,
  `equiptransfer_currentlocation` int(11) NOT NULL,
  `equiptransfer_transferto` int(11) NOT NULL,
  `equiptransfer_date` date NOT NULL,
  `equiptransfer_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `equiptransfer_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_expenses`
--

CREATE TABLE `db_expenses` (
  `expenses_id` int(11) NOT NULL,
  `expenses_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `expenses_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `expenses_seqno` int(11) NOT NULL,
  `expenses_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_freightcharge`
--

CREATE TABLE `db_freightcharge` (
  `freightcharge_id` int(11) NOT NULL,
  `freightcharge_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `freightcharge_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `freightcharge_seqno` int(11) NOT NULL,
  `freightcharge_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_freightcharge`
--

INSERT INTO `db_freightcharge` (`freightcharge_id`, `freightcharge_code`, `freightcharge_desc`, `freightcharge_seqno`, `freightcharge_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'F1', 'Airfreight &amp; handling charge from USA-SIN to be paid by Buyer. Freight charges will advise after receipt of confirmed order', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 14:24:38'),
(2, 'F2', 'Buyer to arrange for freight & handling from SIN to your designated place.', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-07-17 15:30:23'),
(3, 'F3', 'Min. Freight Charge @ S$150.00 per shipment', 30, 1, 0, '2016-03-01 11:16:29', 10000, '2017-07-17 15:30:30'),
(4, 'F4', 'All Air/Ocean, Inland freight & handling charges are to be paid by Buyer. Transit time from USA to SIN will depend on the mode of shipment.', 40, 1, 10000, '2017-08-21 10:05:52', 10000, '2017-08-21 10:05:52'),
(5, 'F5', 'Processing time about 2-3 weeks after confirm order', 50, 1, 10000, '2017-09-07 16:57:58', 10000, '2017-09-07 16:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `db_group`
--

CREATE TABLE `db_group` (
  `group_id` int(11) NOT NULL,
  `group_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `group_seqno` int(11) NOT NULL,
  `group_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_group`
--

INSERT INTO `db_group` (`group_id`, `group_code`, `group_desc`, `group_seqno`, `group_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Admin', 'Admin', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Sales', 'Sales', 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Purchaser', 'Purchaser', 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'HR', 'HR', 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Purchaser Manager', 'Purchaser Manager', 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Site Coordinator', 'Site Coordinator', 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Sub - Contractor', 'Sub - Contractor', 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_groupcomp`
--

CREATE TABLE `db_groupcomp` (
  `groupcomp_id` int(11) NOT NULL,
  `groupcomp_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `groupcomp_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `groupcomp_seqno` int(11) NOT NULL,
  `groupcomp_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_image`
--

CREATE TABLE `db_image` (
  `image_id` int(11) NOT NULL,
  `ref_table` varchar(100) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_type` varchar(200) NOT NULL,
  `upload_field` int(11) NOT NULL,
  `image_remarks` text NOT NULL,
  `seq_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_image`
--

INSERT INTO `db_image` (`image_id`, `ref_table`, `ref_id`, `image`, `image_type`, `upload_field`, `image_remarks`, `seq_no`, `status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(9, 'db_order', 133, 'BFF.jpg', 'jpg', 0, '', 0, 1, 10000, '2017-09-27 09:19:00', 10000, '2017-09-27 09:19:00'),
(10, 'db_order', 157, '10 (1).jpg', 'jpg', 0, '', 0, 1, 10000, '2017-11-03 16:35:46', 10000, '2017-11-03 16:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `db_industry`
--

CREATE TABLE `db_industry` (
  `industry_id` int(11) NOT NULL,
  `industry_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `industry_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `industry_seqno` int(11) NOT NULL,
  `industry_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_info`
--

CREATE TABLE `db_info` (
  `info_id` int(11) NOT NULL,
  `info_table` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `info_table_id` int(11) NOT NULL,
  `info_table_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `info_action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `info_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `info_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_info`
--

INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(9981, 'db_partner', 91, '', 'Update', 'partner_code => CE-Z001<br>partner_name => Customer from e-commerce<br>partner_iscustomer => 1<br>partner_issupplier => <br>partner_bill_address => <br>partner_ship_address => <br>partner_sales_person => <br>partner_tel => <br>partner_fax => <br>partner_email => <br>partner_currency => <br>partner_outlet => <br>partner_remark => <br>partner_website => <br>partner_credit_limit => <br>partner_industry => <br>partner_debtor_account => <br>partner_creditor_account => <br>partner_seqno => <br>partner_status => 1<br>partner_tel2 => <br>partner_postal_code => 0<br>partner_city => <br>partner_house_no => <br>partner_suburb => <br>partner_address_type => 1<br>partner_group => <br>partner_name_cn => <br>partner_name_thai => <br>partner_bill_address_cn => <br>partner_bill_address_thai => <br>partner_issubcon => <br>partner_issitecoordinator => <br>partner_login_password => bebc729080e59bf4c7cb24e3d062a23c<br>partner_login_id => <br>', 'Update Partner.', 10000, '2017-09-15 09:25:37', 0, '0000-00-00 00:00:00'),
(9982, 'db_partner', 92, '', 'Insert', 'partner_code => CUST00001<br>partner_name => Choong &amp; Chang Pte. Ltd.<br>partner_iscustomer => <br>partner_issupplier => 1<br>partner_bill_address => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>partner_ship_address => <br>partner_sales_person => <br>partner_tel => 6791423<br>partner_fax => <br>partner_email => enquiry@cclaw.com.sg<br>partner_currency => <br>partner_outlet => <br>partner_remark => <br>partner_website => <br>partner_credit_limit => <br>partner_industry => <br>partner_debtor_account => <br>partner_creditor_account => <br>partner_seqno => <br>partner_status => 1<br>partner_tel2 => <br>partner_postal_code => <br>partner_city => <br>partner_house_no => <br>partner_suburb => <br>partner_address_type => 1<br>partner_group => <br>partner_name_cn => <br>partner_name_thai => <br>partner_bill_address_cn => <br>partner_bill_address_thai => <br>partner_issubcon => <br>partner_issitecoordinator => <br>partner_login_password => bebc729080e59bf4c7cb24e3d062a23c<br>partner_login_id => <br>', 'Insert Partner.', 10000, '2017-09-15 17:42:46', 0, '0000-00-00 00:00:00'),
(9983, 'db_partner', 93, '', 'Insert', 'partner_code => CUST00008<br>partner_name => Alpha Design Workshop Pte. Ltd.<br>partner_iscustomer => 1<br>partner_issupplier => <br>partner_bill_address => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>partner_ship_address => <br>partner_sales_person => <br>partner_tel => 62437519<br>partner_fax => <br>partner_email => enquiry@alphadesign.com.sg<br>partner_currency => <br>partner_outlet => <br>partner_remark => <br>partner_website => <br>partner_credit_limit => <br>partner_industry => <br>partner_debtor_account => <br>partner_creditor_account => <br>partner_seqno => <br>partner_status => 1<br>partner_tel2 => <br>partner_postal_code => <br>partner_city => <br>partner_house_no => <br>partner_suburb => <br>partner_address_type => 1<br>partner_group => <br>partner_name_cn => <br>partner_name_thai => <br>partner_bill_address_cn => <br>partner_bill_address_thai => <br>partner_issubcon => <br>partner_issitecoordinator => <br>partner_login_password => bebc729080e59bf4c7cb24e3d062a23c<br>partner_login_id => <br>', 'Insert Partner.', 10000, '2017-09-15 17:45:44', 0, '0000-00-00 00:00:00'),
(9984, 'db_contact', 22, '', 'Insert', 'contact_partner_id => 93<br>contact_name => Edward<br>contact_tel => 81354729<br>contact_email => edward@alphadesign.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => Eng<br>', 'Insert Contact.', 10000, '2017-09-15 17:47:12', 0, '0000-00-00 00:00:00'),
(9985, 'db_contact', 23, '', 'Insert', 'contact_partner_id => 93<br>contact_name => Emily<br>contact_tel => 81366729<br>contact_email => emily@alphadesign.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => Ewe<br>', 'Insert Contact.', 10000, '2017-09-15 17:53:00', 0, '0000-00-00 00:00:00'),
(9986, 'db_contact', 24, '', 'Insert', 'contact_partner_id => 92<br>contact_name => Felix<br>contact_tel => 81924536<br>contact_email => felix@cclaw.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => Foo<br>', 'Insert Contact.', 10000, '2017-09-15 17:54:18', 0, '0000-00-00 00:00:00'),
(9987, 'db_contact', 25, '', 'Insert', 'contact_partner_id => 92<br>contact_name => Felicia<br>contact_tel => 81924589<br>contact_email => felicia@cclaw.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => Foong<br>', 'Insert Contact.', 10000, '2017-09-15 17:55:34', 0, '0000-00-00 00:00:00'),
(9988, 'db_contact', 24, '', 'Update', 'contact_partner_id => 92<br>contact_name => Felix<br>contact_tel => 81924536<br>contact_email => felix@cclaw.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => <br>', 'Update Contact.', 10000, '2017-09-15 17:57:46', 0, '0000-00-00 00:00:00'),
(9989, 'db_contact', 25, '', 'Update', 'contact_partner_id => 92<br>contact_name => Felicia<br>contact_tel => 81924589<br>contact_email => felicia@cclaw.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => <br>', 'Update Contact.', 10000, '2017-09-15 17:57:52', 0, '0000-00-00 00:00:00'),
(9990, 'db_contact', 22, '', 'Update', 'contact_partner_id => 93<br>contact_name => Edward<br>contact_tel => 81354729<br>contact_email => edward@alphadesign.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => <br>', 'Update Contact.', 10000, '2017-09-15 17:58:04', 0, '0000-00-00 00:00:00'),
(9991, 'db_contact', 23, '', 'Update', 'contact_partner_id => 93<br>contact_name => Emily<br>contact_tel => 81366729<br>contact_email => emily@alphadesign.com.sg<br>contact_address => <br>contact_remark => <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => <br>', 'Update Contact.', 10000, '2017-09-15 17:58:09', 0, '0000-00-00 00:00:00'),
(9992, 'db_order', 128, '', 'Insert', 'order_no => KC/0022/17-09/TO<br>order_date => 2017-09-15<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-09-15<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Thank you.<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 7<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 3<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Quotation.<br> Document No : KC/0022/17-09/TO', 10000, '2017-09-15 17:58:52', 0, '0000-00-00 00:00:00'),
(9993, 'db_ordl', 424, '', 'Insert', 'ordl_order_id => 128<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 15<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 15.00<br>ordl_ftotal => 15<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Quotation Line.<br> Document No : KC/0022/17-09/TO', 10000, '2017-09-15 17:59:12', 0, '0000-00-00 00:00:00'),
(9994, 'db_order', 128, '', 'Update', 'order_subtotal => 15.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.05<br>order_grandtotal => 16.05<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0022/17-09/TO', 10000, '2017-09-15 17:59:12', 0, '0000-00-00 00:00:00'),
(9995, 'db_invoice', 61, '', 'Insert', 'invoice_no => IV/170900051<br>invoice_date => 2017-09-15<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 22<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 128<br>invoice_outlet => -1<br>invoice_attentionto_phone => 81354729<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 7<br>invoice_delivery_id => 2<br>invoice_price_id => 2<br>invoice_validity_id => 3<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 2<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => edward@alphadesign.com.sg<br>invoice_attentionto_name => Edward<br>invoice_regards => Thank you.<br>invoice_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Sales Invoice.<br> Document No : IV/170900051', 10000, '2017-09-15 17:59:17', 0, '0000-00-00 00:00:00'),
(9996, 'db_invoice', 61, '', 'Update', 'invoice_subtotal => 15.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.05<br>invoice_grandtotal => 16.05<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/170900051', 10000, '2017-09-15 17:59:17', 0, '0000-00-00 00:00:00'),
(9997, 'db_invl', 155, '', 'Insert', 'invl_invoice_id => 61<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 15.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 15.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 424<br>invl_fuprice => 15.00<br>invl_ftotal => 15.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/170900051', 10000, '2017-09-15 17:59:18', 0, '0000-00-00 00:00:00'),
(9998, 'db_order', 129, '', 'Insert', 'order_no => DO/00038-17<br>order_date => 2017-09-15<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 61<br>order_outlet => -1<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 7<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 3<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_generate_from_type => SI<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_regards => Thank you.<br>order_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Delivery Order.<br> Document No : DO/00038-17', 10000, '2017-09-15 17:59:27', 0, '0000-00-00 00:00:00'),
(9999, 'db_order', 129, '', 'Update', 'order_subtotal => 15.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.05<br>order_grandtotal => 16.05<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00038-17', 10000, '2017-09-15 17:59:27', 0, '0000-00-00 00:00:00'),
(10000, 'db_ordl', 425, '', 'Insert', 'ordl_order_id => 129<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 155<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00038-17', 10000, '2017-09-15 17:59:27', 0, '0000-00-00 00:00:00'),
(10001, 'db_order', 130, '', 'Insert', 'order_no => PU/00041-17<br>order_date => 2017-09-15<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 129<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => Thank you.<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 7<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 3<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Pickup List.<br> Document No : PU/00041-17', 10000, '2017-09-15 17:59:36', 0, '0000-00-00 00:00:00'),
(10002, 'db_order', 130, '', 'Update', 'order_subtotal => 15.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.05<br>order_grandtotal => 16.05<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00041-17', 10000, '2017-09-15 17:59:36', 0, '0000-00-00 00:00:00'),
(10003, 'db_ordl', 426, '', 'Insert', 'ordl_order_id => 130<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 425<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00041-17', 10000, '2017-09-15 17:59:36', 0, '0000-00-00 00:00:00'),
(10004, 'db_stock_transaction', 33821, '', 'Insert', 'documentline_id => 426<br>ref_id => 130<br>quantity => 1.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 93<br>document_date => 2017-09-15<br>', 'Insert 1 transaction.<br> Document No : PU/00041-17', 10000, '2017-09-15 17:59:36', 0, '0000-00-00 00:00:00'),
(10005, 'db_product', 1, '', 'Update', 'product_stock => 51<br>', 'Update 1 stock transaction.<br> Document No : PU/00041-17', 10000, '2017-09-15 17:59:36', 0, '0000-00-00 00:00:00'),
(10006, 'db_order', 131, '', 'Insert', 'order_no => PO/170900088<br>order_date => 2017-09-15<br>order_customer => 92<br>order_salesperson => 15<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => <br>order_term => <br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => PO<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => <br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 9<br>order_delivery_id => 1<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 3<br>order_freightcharge_id => 3<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Purchase Order.<br> Document No : PO/170900088', 10000, '2017-09-15 18:00:51', 0, '0000-00-00 00:00:00'),
(10007, 'db_ordl', 427, '', 'Insert', 'ordl_order_id => 131<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 24<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 12.00<br>ordl_ftotal => 24<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Purchase Order Line.<br> Document No : PO/170900088', 10000, '2017-09-15 18:01:00', 0, '0000-00-00 00:00:00'),
(10008, 'db_order', 131, '', 'Update', 'order_subtotal => 24.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.68<br>order_grandtotal => 25.68<br>order_discheadertotal => 0.00<br>', 'Update Purchase Order.<br> Document No : PO/170900088', 10000, '2017-09-15 18:01:00', 0, '0000-00-00 00:00:00'),
(10009, 'db_order', 132, '', 'Insert', 'order_no => GRN00083<br>order_date => 2017-09-15<br>order_customer => 92<br>order_salesperson => 15<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => GRN<br>order_generate_from => 131<br>order_generate_from_type => PO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 9<br>order_delivery_id => 1<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 3<br>order_freightcharge_id => 3<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc =>  Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.<br>', 'Insert Goods Received Note.<br> Document No : GRN00083', 10000, '2017-09-15 18:01:03', 0, '0000-00-00 00:00:00'),
(10010, 'db_order', 132, '', 'Update', 'order_subtotal => 24.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.68<br>order_grandtotal => 25.68<br>order_discheadertotal => 0.00<br>', 'Update Goods Received Note.<br> Document No : GRN00083', 10000, '2017-09-15 18:01:03', 0, '0000-00-00 00:00:00'),
(10011, 'db_ordl', 428, '', 'Insert', 'ordl_order_id => 132<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 24.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 427<br>ordl_fuprice => 12.00<br>ordl_ftotal => 24.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00083', 10000, '2017-09-15 18:01:03', 0, '0000-00-00 00:00:00'),
(10012, 'db_stock_transaction', 33822, '', 'Insert', 'documentline_id => 428<br>ref_id => 132<br>quantity => 2.00<br>type => IN<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-09-15<br>', 'Insert 1 transaction.<br> Document No : GRN00083', 10000, '2017-09-15 18:01:03', 0, '0000-00-00 00:00:00'),
(10013, 'db_product', 1, '', 'Update', 'product_stock => 53<br>', 'Update 1 stock transaction.<br> Document No : GRN00083', 10000, '2017-09-15 18:01:03', 0, '0000-00-00 00:00:00'),
(10014, 'db_invoice', 62, '', 'Insert', 'invoice_no => IV/170900001/e<br>invoice_date => 2017-09-18<br>invoice_customer => <br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900001/e', 10000, '2017-09-18 17:16:54', 0, '0000-00-00 00:00:00'),
(10015, 'db_invl', 156, '', 'Insert', 'invl_invoice_id => 62<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900001/e', 10000, '2017-09-18 17:16:54', 0, '0000-00-00 00:00:00'),
(10016, 'db_invoice', 62, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900001/e', 10000, '2017-09-18 17:16:54', 0, '0000-00-00 00:00:00'),
(10017, 'db_invoice', 63, '', 'Insert', 'invoice_no => IV/170900003/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900003/e', 10000, '2017-09-18 17:39:34', 0, '0000-00-00 00:00:00'),
(10018, 'db_invl', 157, '', 'Insert', 'invl_invoice_id => 63<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900003/e', 10000, '2017-09-18 17:39:34', 0, '0000-00-00 00:00:00'),
(10019, 'db_invoice', 63, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900003/e', 10000, '2017-09-18 17:39:34', 0, '0000-00-00 00:00:00'),
(10020, 'db_invoice', 64, '', 'Insert', 'invoice_no => IV/170900005/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900005/e', 10000, '2017-09-18 17:41:59', 0, '0000-00-00 00:00:00'),
(10021, 'db_invl', 158, '', 'Insert', 'invl_invoice_id => 64<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900005/e', 10000, '2017-09-18 17:41:59', 0, '0000-00-00 00:00:00'),
(10022, 'db_invoice', 64, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900005/e', 10000, '2017-09-18 17:41:59', 0, '0000-00-00 00:00:00'),
(10023, 'db_invoice', 65, '', 'Insert', 'invoice_no => IV/170900007/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900007/e', 10000, '2017-09-18 17:49:37', 0, '0000-00-00 00:00:00'),
(10024, 'db_invl', 159, '', 'Insert', 'invl_invoice_id => 65<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900007/e', 10000, '2017-09-18 17:49:38', 0, '0000-00-00 00:00:00'),
(10025, 'db_invoice', 65, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900007/e', 10000, '2017-09-18 17:49:38', 0, '0000-00-00 00:00:00'),
(10026, 'db_invoice', 66, '', 'Insert', 'invoice_no => IV/170900009/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900009/e', 10000, '2017-09-18 17:59:04', 0, '0000-00-00 00:00:00'),
(10027, 'db_invl', 160, '', 'Insert', 'invl_invoice_id => 66<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900009/e', 10000, '2017-09-18 17:59:04', 0, '0000-00-00 00:00:00'),
(10028, 'db_invoice', 66, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900009/e', 10000, '2017-09-18 17:59:04', 0, '0000-00-00 00:00:00'),
(10029, 'db_invoice', 67, '', 'Insert', 'invoice_no => IV/170900011/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900011/e', 10000, '2017-09-18 18:05:19', 0, '0000-00-00 00:00:00'),
(10030, 'db_invl', 161, '', 'Insert', 'invl_invoice_id => 67<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900011/e', 10000, '2017-09-18 18:05:19', 0, '0000-00-00 00:00:00'),
(10031, 'db_invoice', 67, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900011/e', 10000, '2017-09-18 18:05:19', 0, '0000-00-00 00:00:00'),
(10032, 'db_invoice', 68, '', 'Insert', 'invoice_no => IV/170900013/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900013/e', 10000, '2017-09-18 18:08:43', 0, '0000-00-00 00:00:00'),
(10033, 'db_invl', 162, '', 'Insert', 'invl_invoice_id => 68<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900013/e', 10000, '2017-09-18 18:08:43', 0, '0000-00-00 00:00:00'),
(10034, 'db_invoice', 68, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900013/e', 10000, '2017-09-18 18:08:43', 0, '0000-00-00 00:00:00'),
(10035, 'db_invoice', 69, '', 'Insert', 'invoice_no => IV/170900015/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900015/e', 10000, '2017-09-18 18:09:41', 0, '0000-00-00 00:00:00'),
(10036, 'db_invl', 163, '', 'Insert', 'invl_invoice_id => 69<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900015/e', 10000, '2017-09-18 18:09:41', 0, '0000-00-00 00:00:00'),
(10037, 'db_invoice', 69, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900015/e', 10000, '2017-09-18 18:09:41', 0, '0000-00-00 00:00:00'),
(10038, 'db_invoice', 70, '', 'Insert', 'invoice_no => IV/170900017/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress =>   \n  <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>   \n  <br>invoice_customerref => <br>invoice_remark => e-SO , customer from e-commerce: \n  \n \n \n  \n  <br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => <br>invoice_attentionto_name =>  <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900017/e', 10000, '2017-09-18 18:09:44', 0, '0000-00-00 00:00:00'),
(10039, 'db_invl', 164, '', 'Insert', 'invl_invoice_id => 70<br>invl_pro_id => <br>invl_pro_desc => <br>invl_qty => <br>invl_uom => <br>invl_uprice => <br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => <br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => <br>invl_ftotal => <br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900017/e', 10000, '2017-09-18 18:09:44', 0, '0000-00-00 00:00:00'),
(10040, 'db_invoice', 70, '', 'Update', 'invoice_subtotal => 0.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900017/e', 10000, '2017-09-18 18:09:44', 0, '0000-00-00 00:00:00'),
(10041, 'db_invoice', 71, '', 'Insert', 'invoice_no => IV/170900019/e<br>invoice_date => 2017-09-18<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 3, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900019/e', 10000, '2017-09-18 18:10:48', 0, '0000-00-00 00:00:00'),
(10042, 'db_invl', 165, '', 'Insert', 'invl_invoice_id => 71<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 2<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900019/e', 10000, '2017-09-18 18:10:48', 0, '0000-00-00 00:00:00'),
(10043, 'db_invoice', 71, '', 'Update', 'invoice_subtotal => 32.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 2.24<br>invoice_grandtotal => 34.24<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900019/e', 10000, '2017-09-18 18:10:48', 0, '0000-00-00 00:00:00'),
(10044, 'db_invoice', 72, '', 'Insert', 'invoice_no => IV/170900021/e<br>invoice_date => 2017-09-19<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 12, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900021/e', 0, '2017-09-19 09:16:05', 0, '0000-00-00 00:00:00'),
(10045, 'db_invl', 166, '', 'Insert', 'invl_invoice_id => 72<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900021/e', 0, '2017-09-19 09:16:05', 0, '0000-00-00 00:00:00'),
(10046, 'db_invoice', 72, '', 'Update', 'invoice_subtotal => 16.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.12<br>invoice_grandtotal => 17.12<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900021/e', 0, '2017-09-19 09:16:05', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10047, 'db_invoice', 73, '', 'Insert', 'invoice_no => IV/170900023/e<br>invoice_date => 2017-09-19<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 50, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900023/e', 0, '2017-09-19 12:18:11', 0, '0000-00-00 00:00:00'),
(10048, 'db_invl', 167, '', 'Insert', 'invl_invoice_id => 73<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 100.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 100.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 100.00<br>invl_ftotal => 100.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900023/e', 0, '2017-09-19 12:18:11', 0, '0000-00-00 00:00:00'),
(10049, 'db_invoice', 73, '', 'Update', 'invoice_subtotal => 100.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900023/e', 0, '2017-09-19 12:18:11', 0, '0000-00-00 00:00:00'),
(10050, 'db_invoice', 74, '', 'Insert', 'invoice_no => IV/170900025/e<br>invoice_date => 2017-09-19<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 33, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900025/e', 0, '2017-09-19 12:26:09', 0, '0000-00-00 00:00:00'),
(10051, 'db_invl', 168, '', 'Insert', 'invl_invoice_id => 74<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 3<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900025/e', 0, '2017-09-19 12:26:09', 0, '0000-00-00 00:00:00'),
(10052, 'db_invoice', 74, '', 'Update', 'invoice_subtotal => 48.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 3.36<br>invoice_grandtotal => 51.36<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900025/e', 0, '2017-09-19 12:26:10', 0, '0000-00-00 00:00:00'),
(10053, 'db_invoice', 75, '', 'Insert', 'invoice_no => IV/170900027/e<br>invoice_date => 2017-09-19<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 33, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900027/e', 0, '2017-09-19 12:26:10', 0, '0000-00-00 00:00:00'),
(10054, 'db_invl', 169, '', 'Insert', 'invl_invoice_id => 75<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 3<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900027/e', 0, '2017-09-19 12:26:10', 0, '0000-00-00 00:00:00'),
(10055, 'db_invoice', 75, '', 'Update', 'invoice_subtotal => 48.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 3.36<br>invoice_grandtotal => 51.36<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900027/e', 0, '2017-09-19 12:26:10', 0, '0000-00-00 00:00:00'),
(10056, 'db_invoice', 76, '', 'Insert', 'invoice_no => IV/170900029/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 34, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900029/e', 0, '2017-09-21 08:56:03', 0, '0000-00-00 00:00:00'),
(10057, 'db_invl', 170, '', 'Insert', 'invl_invoice_id => 76<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 4<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900029/e', 0, '2017-09-21 08:56:03', 0, '0000-00-00 00:00:00'),
(10058, 'db_invoice', 76, '', 'Update', 'invoice_subtotal => 64.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 4.48<br>invoice_grandtotal => 68.48<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900029/e', 0, '2017-09-21 08:56:03', 0, '0000-00-00 00:00:00'),
(10059, 'db_invoice', 77, '', 'Insert', 'invoice_no => IV/170900031/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 34, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900031/e', 0, '2017-09-21 08:56:03', 0, '0000-00-00 00:00:00'),
(10060, 'db_invl', 171, '', 'Insert', 'invl_invoice_id => 77<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 4<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900031/e', 0, '2017-09-21 08:56:03', 0, '0000-00-00 00:00:00'),
(10061, 'db_invoice', 77, '', 'Update', 'invoice_subtotal => 64.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 4.48<br>invoice_grandtotal => 68.48<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900031/e', 0, '2017-09-21 08:56:04', 0, '0000-00-00 00:00:00'),
(10062, 'db_invoice', 78, '', 'Insert', 'invoice_no => IV/170900033/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 35, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900033/e', 0, '2017-09-21 09:07:32', 0, '0000-00-00 00:00:00'),
(10063, 'db_invl', 172, '', 'Insert', 'invl_invoice_id => 78<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900033/e', 0, '2017-09-21 09:07:32', 0, '0000-00-00 00:00:00'),
(10064, 'db_invoice', 78, '', 'Update', 'invoice_subtotal => 16.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.12<br>invoice_grandtotal => 17.12<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900033/e', 0, '2017-09-21 09:07:32', 0, '0000-00-00 00:00:00'),
(10065, 'db_invoice', 79, '', 'Insert', 'invoice_no => IV/170900035/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 35, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900035/e', 0, '2017-09-21 09:07:32', 0, '0000-00-00 00:00:00'),
(10066, 'db_invl', 173, '', 'Insert', 'invl_invoice_id => 79<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900035/e', 0, '2017-09-21 09:07:33', 0, '0000-00-00 00:00:00'),
(10067, 'db_invoice', 79, '', 'Update', 'invoice_subtotal => 16.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.12<br>invoice_grandtotal => 17.12<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900035/e', 0, '2017-09-21 09:07:33', 0, '0000-00-00 00:00:00'),
(10068, 'db_invoice', 80, '', 'Insert', 'invoice_no => IV/170900037/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 51, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900037/e', 0, '2017-09-21 09:11:38', 0, '0000-00-00 00:00:00'),
(10069, 'db_invl', 174, '', 'Insert', 'invl_invoice_id => 80<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 100.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 100.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 100.00<br>invl_ftotal => 100.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900037/e', 0, '2017-09-21 09:11:39', 0, '0000-00-00 00:00:00'),
(10070, 'db_invoice', 80, '', 'Update', 'invoice_subtotal => 100.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900037/e', 0, '2017-09-21 09:11:39', 0, '0000-00-00 00:00:00'),
(10071, 'db_invoice', 81, '', 'Insert', 'invoice_no => IV/170900039/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 36, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900039/e', 0, '2017-09-21 09:21:40', 0, '0000-00-00 00:00:00'),
(10072, 'db_invl', 175, '', 'Insert', 'invl_invoice_id => 81<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 2<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900039/e', 0, '2017-09-21 09:21:40', 0, '0000-00-00 00:00:00'),
(10073, 'db_invoice', 81, '', 'Update', 'invoice_subtotal => 32.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 2.24<br>invoice_grandtotal => 34.24<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900039/e', 0, '2017-09-21 09:21:40', 0, '0000-00-00 00:00:00'),
(10074, 'db_invoice', 82, '', 'Insert', 'invoice_no => IV/170900041/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 37, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900041/e', 0, '2017-09-21 09:48:11', 0, '0000-00-00 00:00:00'),
(10075, 'db_invl', 176, '', 'Insert', 'invl_invoice_id => 82<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 16.00<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 16.00<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900041/e', 0, '2017-09-21 09:48:11', 0, '0000-00-00 00:00:00'),
(10076, 'db_invoice', 82, '', 'Update', 'invoice_subtotal => 16.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.12<br>invoice_grandtotal => 17.12<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900041/e', 0, '2017-09-21 09:48:11', 0, '0000-00-00 00:00:00'),
(10077, 'db_invoice', 83, '', 'Insert', 'invoice_no => IV/170900043/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 38, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900043/e', 0, '2017-09-21 12:34:07', 0, '0000-00-00 00:00:00'),
(10078, 'db_invl', 177, '', 'Insert', 'invl_invoice_id => 83<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 2<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 32<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 32<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900043/e', 0, '2017-09-21 12:34:08', 0, '0000-00-00 00:00:00'),
(10079, 'db_invl', 178, '', 'Insert', 'invl_invoice_id => 83<br>invl_pro_id => 5<br>invl_pro_desc => Impeller<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 29.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 29<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 29.00<br>invl_ftotal => 29<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900043/e', 0, '2017-09-21 12:34:08', 0, '0000-00-00 00:00:00'),
(10080, 'db_invoice', 83, '', 'Update', 'invoice_subtotal => 61.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 4.27<br>invoice_grandtotal => 65.27<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900043/e', 0, '2017-09-21 12:34:08', 0, '0000-00-00 00:00:00'),
(10081, 'db_invoice', 84, '', 'Insert', 'invoice_no => IV/170900045/e<br>invoice_date => 2017-09-21<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 39, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900045/e', 0, '2017-09-21 12:37:37', 0, '0000-00-00 00:00:00'),
(10082, 'db_invl', 179, '', 'Insert', 'invl_invoice_id => 84<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 5<br>invl_uom => <br>invl_uprice => 16.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 80<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 16.00<br>invl_ftotal => 80<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900045/e', 0, '2017-09-21 12:37:37', 0, '0000-00-00 00:00:00'),
(10083, 'db_invl', 180, '', 'Insert', 'invl_invoice_id => 84<br>invl_pro_id => 5<br>invl_pro_desc => Impeller<br>invl_qty => 2<br>invl_uom => <br>invl_uprice => 29.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 58<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 29.00<br>invl_ftotal => 58<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900045/e', 0, '2017-09-21 12:37:37', 0, '0000-00-00 00:00:00'),
(10084, 'db_invoice', 84, '', 'Update', 'invoice_subtotal => 138.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 9.66<br>invoice_grandtotal => 147.66<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900045/e', 0, '2017-09-21 12:37:38', 0, '0000-00-00 00:00:00'),
(10085, 'db_category', 10, '', 'Insert', 'category_code => Flat Shipping Rate<br>category_desc => Flat Shipping Rate<br>category_seqno => 40<br>category_status => 1<br>', 'Insert Category.', 10000, '2017-09-21 12:37:54', 0, '0000-00-00 00:00:00'),
(10086, 'db_product', 11, '', 'Insert', 'product_category => 10<br>product_part_no => flat15<br>product_desc => Flat Shipping Rate<br>product_remark => <br>product_sale_price => 15<br>product_cost_price => 15.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>', 'Insert Product.', 10000, '2017-09-21 12:39:05', 0, '0000-00-00 00:00:00'),
(10087, 'db_order', 133, '', 'Insert', 'order_no => KC/0023/17-09/TO<br>order_date => 2017-09-27<br>order_customer => 93<br>order_salesperson => 19<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-09-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 3<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc => <br>', 'Insert Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:19:00', 0, '0000-00-00 00:00:00'),
(10088, 'db_ordl', 429, '', 'Insert', 'ordl_order_id => 133<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 8.00<br>ordl_uom => 8<br>ordl_uprice => 17.50<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 140<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 17.50<br>ordl_ftotal => 140<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Quotation Line.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:19:33', 0, '0000-00-00 00:00:00'),
(10089, 'db_order', 133, '', 'Update', 'order_subtotal => 140.0000<br>order_disctotal => 0.00<br>order_taxtotal => 9.8<br>order_grandtotal => 149.8<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:19:33', 0, '0000-00-00 00:00:00'),
(10090, 'db_ordl', 429, '', 'Update', 'ordl_order_id => 133<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 8.00<br>ordl_uom => 8<br>ordl_uprice => 0<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 140<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_fuprice => 17.50<br>ordl_pfuprice => <br>ordl_ftotal => 140<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => 8 qty<br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Update Quotation Line.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:19:47', 0, '0000-00-00 00:00:00'),
(10091, 'db_order', 133, '', 'Update', 'order_subtotal => 140.0000<br>order_disctotal => 0.00<br>order_taxtotal => 9.8<br>order_grandtotal => 149.8<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:19:47', 0, '0000-00-00 00:00:00'),
(10092, 'db_ordl', 430, '', 'Insert', 'ordl_order_id => 133<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 13<br>ordl_uprice => 122.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 244<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 122.00<br>ordl_ftotal => 244<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => 2 packs<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>', 'Insert Quotation Line.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:20:18', 0, '0000-00-00 00:00:00'),
(10093, 'db_order', 133, '', 'Update', 'order_subtotal => 384.0000<br>order_disctotal => 0.00<br>order_taxtotal => 26.88<br>order_grandtotal => 410.88<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:20:18', 0, '0000-00-00 00:00:00'),
(10094, 'db_ordl', 431, '', 'Insert', 'ordl_order_id => 133<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 10.00<br>ordl_uom => 13<br>ordl_uprice => 28.55<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 285.5<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 28.55<br>ordl_ftotal => 285.5<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Quotation Line.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:20:45', 0, '0000-00-00 00:00:00'),
(10095, 'db_order', 133, '', 'Update', 'order_subtotal => 669.5000<br>order_disctotal => 0.00<br>order_taxtotal => 46.87<br>order_grandtotal => 716.37<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 09:20:45', 0, '0000-00-00 00:00:00'),
(10096, 'db_invoice', 85, '', 'Insert', 'invoice_no => IV/170900052<br>invoice_date => 2017-09-27<br>invoice_customer => 93<br>invoice_salesperson => 19<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 22<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 133<br>invoice_outlet => -1<br>invoice_attentionto_phone => 81354729<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 3<br>invoice_delivery_id => 2<br>invoice_price_id => 2<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 2<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => edward@alphadesign.com.sg<br>invoice_attentionto_name => Edward<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert Sales Invoice.<br> Document No : IV/170900052', 10000, '2017-09-27 09:21:34', 0, '0000-00-00 00:00:00'),
(10097, 'db_invoice', 85, '', 'Update', 'invoice_subtotal => 669.5000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 46.87<br>invoice_grandtotal => 716.37<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/170900052', 10000, '2017-09-27 09:21:34', 0, '0000-00-00 00:00:00'),
(10098, 'db_invl', 181, '', 'Insert', 'invl_invoice_id => 85<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 8.00<br>invl_uom => 8<br>invl_uprice => 0.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 140.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 429<br>invl_fuprice => 17.50<br>invl_ftotal => 140.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => 8 qty<br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/170900052', 10000, '2017-09-27 09:21:34', 0, '0000-00-00 00:00:00'),
(10099, 'db_invl', 182, '', 'Insert', 'invl_invoice_id => 85<br>invl_pro_id => 34<br>invl_pro_desc => Impeller<br>invl_qty => 2.00<br>invl_uom => 13<br>invl_uprice => 122.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 244.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 430<br>invl_fuprice => 122.00<br>invl_ftotal => 244.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => 2 packs<br>invl_item_type => package<br>', 'Insert Sales Invoice Line.<br> Document No : IV/170900052', 10000, '2017-09-27 09:21:34', 0, '0000-00-00 00:00:00'),
(10100, 'db_invl', 183, '', 'Insert', 'invl_invoice_id => 85<br>invl_pro_id => 5<br>invl_pro_desc => Impeller<br>invl_qty => 10.00<br>invl_uom => 13<br>invl_uprice => 28.55<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 285.50<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 431<br>invl_fuprice => 28.55<br>invl_ftotal => 285.50<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/170900052', 10000, '2017-09-27 09:21:34', 0, '0000-00-00 00:00:00'),
(10101, 'db_order', 134, '', 'Insert', 'order_no => DO/00039-17<br>order_date => 2017-09-27<br>order_customer => 93<br>order_salesperson => 19<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 85<br>order_outlet => -1<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 3<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_generate_from_type => SI<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00039-17', 10000, '2017-09-27 09:22:20', 0, '0000-00-00 00:00:00'),
(10102, 'db_order', 134, '', 'Update', 'order_subtotal => 669.5000<br>order_disctotal => 0.00<br>order_taxtotal => 46.87<br>order_grandtotal => 716.37<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00039-17', 10000, '2017-09-27 09:22:20', 0, '0000-00-00 00:00:00'),
(10103, 'db_ordl', 432, '', 'Insert', 'ordl_order_id => 134<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 8.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 140.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 181<br>ordl_fuprice => 17.50<br>ordl_ftotal => 140.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => 8 qty<br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00039-17', 10000, '2017-09-27 09:22:20', 0, '0000-00-00 00:00:00'),
(10104, 'db_ordl', 433, '', 'Insert', 'ordl_order_id => 134<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 13<br>ordl_uprice => 122.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 244.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 182<br>ordl_fuprice => 122.00<br>ordl_ftotal => 244.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => 2 packs<br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>', 'Insert Delivery Order Line.<br> Document No : DO/00039-17', 10000, '2017-09-27 09:22:20', 0, '0000-00-00 00:00:00'),
(10105, 'db_ordl', 434, '', 'Insert', 'ordl_order_id => 134<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 10.00<br>ordl_uom => 13<br>ordl_uprice => 28.55<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 285.50<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 183<br>ordl_fuprice => 28.55<br>ordl_ftotal => 285.50<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00039-17', 10000, '2017-09-27 09:22:21', 0, '0000-00-00 00:00:00'),
(10106, 'db_order', 135, '', 'Insert', 'order_no => PU/00042-17<br>order_date => 2017-09-27<br>order_customer => 93<br>order_salesperson => 19<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 134<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 3<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10107, 'db_order', 135, '', 'Update', 'order_subtotal => 669.5000<br>order_disctotal => 0.00<br>order_taxtotal => 46.87<br>order_grandtotal => 716.37<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10108, 'db_ordl', 435, '', 'Insert', 'ordl_order_id => 135<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 8.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 140.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 432<br>ordl_fuprice => 17.50<br>ordl_ftotal => 140.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => 8 qty<br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10109, 'db_stock_transaction', 33823, '', 'Insert', 'documentline_id => 435<br>ref_id => 135<br>quantity => 8.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 93<br>document_date => 2017-09-27<br>', 'Insert 1 transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10110, 'db_product', 1, '', 'Update', 'product_stock => 45<br>', 'Update 1 stock transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10111, 'db_ordl', 436, '', 'Insert', 'ordl_order_id => 135<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 13<br>ordl_uprice => 122.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 244.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 433<br>ordl_fuprice => 122.00<br>ordl_ftotal => 244.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => 2 packs<br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => package<br>', 'Insert Pickup List Line.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10112, 'db_stock_transaction', 33824, '', 'Insert', 'documentline_id => 436<br>ref_id => 135<br>quantity => 4<br>type => OUT<br>item_id => 1<br>uom => 13<br>cost => <br>custsupp_id => 93<br>document_date => 2017-09-27<br>', 'Insert 34 transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10113, 'db_product', 1, '', 'Update', 'product_stock => 41<br>', 'Update 1 stock transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10114, 'db_stock_transaction', 33825, '', 'Insert', 'documentline_id => 436<br>ref_id => 135<br>quantity => 6<br>type => OUT<br>item_id => 5<br>uom => 13<br>cost => <br>custsupp_id => 93<br>document_date => 2017-09-27<br>', 'Insert 34 transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10115, 'db_product', 5, '', 'Update', 'product_stock => 37<br>', 'Update 5 stock transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:44', 0, '0000-00-00 00:00:00'),
(10116, 'db_ordl', 437, '', 'Insert', 'ordl_order_id => 135<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 10.00<br>ordl_uom => 13<br>ordl_uprice => 28.55<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 285.50<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 434<br>ordl_fuprice => 28.55<br>ordl_ftotal => 285.50<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:45', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10117, 'db_stock_transaction', 33826, '', 'Insert', 'documentline_id => 437<br>ref_id => 135<br>quantity => 10.00<br>type => OUT<br>item_id => 5<br>uom => 13<br>cost => 20.00<br>custsupp_id => 93<br>document_date => 2017-09-27<br>', 'Insert 5 transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:45', 0, '0000-00-00 00:00:00'),
(10118, 'db_product', 5, '', 'Update', 'product_stock => 27<br>', 'Update 5 stock transaction.<br> Document No : PU/00042-17', 10000, '2017-09-27 09:24:45', 0, '0000-00-00 00:00:00'),
(10119, 'db_order', 136, '', 'Insert', 'order_no => PO/170900089<br>order_date => 2017-09-27<br>order_customer => 92<br>order_salesperson => <br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => <br>order_term => <br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => PO<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => <br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 6<br>order_delivery_id => 1<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 2<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc => <br>', 'Insert Purchase Order.<br> Document No : PO/170900089', 10000, '2017-09-27 09:27:28', 0, '0000-00-00 00:00:00'),
(10120, 'db_ordl', 438, '', 'Insert', 'ordl_order_id => 136<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 10.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 120<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 12.00<br>ordl_ftotal => 120<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Purchase Order Line.<br> Document No : PO/170900089', 10000, '2017-09-27 09:27:42', 0, '0000-00-00 00:00:00'),
(10121, 'db_order', 136, '', 'Update', 'order_subtotal => 120.0000<br>order_disctotal => 0.00<br>order_taxtotal => 8.4<br>order_grandtotal => 128.4<br>order_discheadertotal => 0.00<br>', 'Update Purchase Order.<br> Document No : PO/170900089', 10000, '2017-09-27 09:27:42', 0, '0000-00-00 00:00:00'),
(10122, 'db_ordl', 439, '', 'Insert', 'ordl_order_id => 136<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 12.00<br>ordl_uom => 8<br>ordl_uprice => 20.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 240<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 20.00<br>ordl_ftotal => 240<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Purchase Order Line.<br> Document No : PO/170900089', 10000, '2017-09-27 09:27:49', 0, '0000-00-00 00:00:00'),
(10123, 'db_order', 136, '', 'Update', 'order_subtotal => 360.0000<br>order_disctotal => 0.00<br>order_taxtotal => 25.2<br>order_grandtotal => 385.2<br>order_discheadertotal => 0.00<br>', 'Update Purchase Order.<br> Document No : PO/170900089', 10000, '2017-09-27 09:27:50', 0, '0000-00-00 00:00:00'),
(10124, 'db_order', 137, '', 'Insert', 'order_no => GRN00084<br>order_date => 2017-09-27<br>order_customer => 92<br>order_salesperson => 0<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => GRN<br>order_generate_from => 136<br>order_generate_from_type => PO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 6<br>order_delivery_id => 1<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 2<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc => <br>', 'Insert Goods Received Note.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10125, 'db_order', 137, '', 'Update', 'order_subtotal => 360.0000<br>order_disctotal => 0.00<br>order_taxtotal => 25.2<br>order_grandtotal => 385.2<br>order_discheadertotal => 0.00<br>', 'Update Goods Received Note.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10126, 'db_ordl', 440, '', 'Insert', 'ordl_order_id => 137<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 10.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 438<br>ordl_fuprice => 12.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10127, 'db_stock_transaction', 33827, '', 'Insert', 'documentline_id => 440<br>ref_id => 137<br>quantity => 10.00<br>type => IN<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-09-27<br>', 'Insert 1 transaction.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10128, 'db_product', 1, '', 'Update', 'product_stock => 51<br>', 'Update 1 stock transaction.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10129, 'db_ordl', 441, '', 'Insert', 'ordl_order_id => 137<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 12.00<br>ordl_uom => 8<br>ordl_uprice => 20.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 240.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 439<br>ordl_fuprice => 20.00<br>ordl_ftotal => 240.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10130, 'db_stock_transaction', 33828, '', 'Insert', 'documentline_id => 441<br>ref_id => 137<br>quantity => 12.00<br>type => IN<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 92<br>document_date => 2017-09-27<br>', 'Insert 5 transaction.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10131, 'db_product', 5, '', 'Update', 'product_stock => 39<br>', 'Update 5 stock transaction.<br> Document No : GRN00084', 10000, '2017-09-27 09:27:58', 0, '0000-00-00 00:00:00'),
(10132, 'db_invoice', 86, '', 'Insert', 'invoice_no => IV/170900047/e<br>invoice_date => 2017-09-27<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 41, customer from e-commerce: \nNasirah Luddin \nalvapierre@hotmail.com \n94554817 \n636 Hougang Avenue 8 #03-91  \n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => <br>invoice_currencyrate => <br>invoice_status => 1<br>invoice_prefix_type => eSI<br>invoice_generate_from => <br>invoice_outlet => <br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_project_id => <br>invoice_subcon => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_generate_from_type => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert e-Sales Invoice.<br> Document No : IV/170900047/e', 0, '2017-09-27 09:43:55', 0, '0000-00-00 00:00:00'),
(10133, 'db_invl', 184, '', 'Insert', 'invl_invoice_id => 86<br>invl_pro_id => 7<br>invl_pro_desc => 2\", Flange, M-seal, Imp 8201-01<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 120.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 120<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 120.00<br>invl_ftotal => 120<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900047/e', 0, '2017-09-27 09:43:55', 0, '0000-00-00 00:00:00'),
(10134, 'db_invl', 185, '', 'Insert', 'invl_invoice_id => 86<br>invl_pro_id => 9<br>invl_pro_desc => 3/8\", NPT, 7050-01<br>invl_qty => 1<br>invl_uom => <br>invl_uprice => 52.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 52<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 52.00<br>invl_ftotal => 52<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900047/e', 0, '2017-09-27 09:43:55', 0, '0000-00-00 00:00:00'),
(10135, 'db_invl', 186, '', 'Insert', 'invl_invoice_id => 86<br>invl_pro_id => 5<br>invl_pro_desc => Impeller<br>invl_qty => 2<br>invl_uom => <br>invl_uprice => 28.00<br>invl_disc => <br>invl_istax => <br>invl_taxamt => <br>invl_total => 56<br>invl_pro_no => <br>invl_discamt => <br>invl_seqno => <br>invl_parent => <br>invl_fuprice => 28.00<br>invl_ftotal => 56<br>invl_fdiscamt => <br>invl_ftaxamt => <br>invl_parent_type => Invoice<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert e-Sales Invoice Line.<br> Document No : IV/170900047/e', 0, '2017-09-27 09:43:55', 0, '0000-00-00 00:00:00'),
(10136, 'db_invoice', 86, '', 'Update', 'invoice_subtotal => 228.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 15.96<br>invoice_grandtotal => 243.96<br>invoice_discheadertotal => 0.00<br>', 'Update e-Sales Invoice.<br> Document No : IV/170900047/e', 0, '2017-09-27 09:43:55', 0, '0000-00-00 00:00:00'),
(10137, 'db_invoice', 86, '', 'Update', 'invoice_date => 2017-09-27<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => 636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>invoice_customerref => <br>invoice_remark => e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 94554817<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => 8<br>invoice_delivery_id => 4<br>invoice_price_id => 3<br>invoice_validity_id => 1<br>invoice_transittime_id => 3<br>invoice_freightcharge_id => 3<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 2<br>invoice_remarks_id => 3<br>invoice_country_id => 32<br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Nasirah Luddin<br>invoice_tnc => <br>invoice_regards => <br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-09-27 10:09:11', 0, '0000-00-00 00:00:00'),
(10138, 'db_invoice', 86, '', 'Update', 'invoice_subtotal => 228.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 15.96<br>invoice_grandtotal => 243.96<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/170900047/e', 10000, '2017-09-27 10:09:11', 0, '0000-00-00 00:00:00'),
(10139, 'db_order', 138, '', 'Insert', 'order_no => DO/00040-17<br>order_date => 2017-09-27<br>order_customer => 94<br>order_salesperson => 0<br>order_billaddress => 636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>order_customerref => <br>order_remark => e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 86<br>order_outlet => -1<br>order_attentionto_phone => 94554817<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 8<br>order_delivery_id => 4<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 3<br>order_freightcharge_id => 3<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 3<br>order_country_id => 32<br>order_generate_from_type => eSI<br>order_attentionto_email => alvapierre@hotmail.com<br>order_attentionto_name => Nasirah Luddin<br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00040-17', 10000, '2017-09-27 10:09:34', 0, '0000-00-00 00:00:00'),
(10140, 'db_order', 138, '', 'Update', 'order_subtotal => 228.0000<br>order_disctotal => 0.00<br>order_taxtotal => 15.96<br>order_grandtotal => 243.96<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00040-17', 10000, '2017-09-27 10:09:34', 0, '0000-00-00 00:00:00'),
(10141, 'db_ordl', 442, '', 'Insert', 'ordl_order_id => 138<br>ordl_pro_id => 7<br>ordl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01<br>ordl_qty => 1.00<br>ordl_uom => 0<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 184<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00040-17', 10000, '2017-09-27 10:09:34', 0, '0000-00-00 00:00:00'),
(10142, 'db_ordl', 443, '', 'Insert', 'ordl_order_id => 138<br>ordl_pro_id => 9<br>ordl_pro_desc => 3/8&quot;, NPT, 7050-01<br>ordl_qty => 1.00<br>ordl_uom => 0<br>ordl_uprice => 52.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 52.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 185<br>ordl_fuprice => 52.00<br>ordl_ftotal => 52.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00040-17', 10000, '2017-09-27 10:09:34', 0, '0000-00-00 00:00:00'),
(10143, 'db_ordl', 444, '', 'Insert', 'ordl_order_id => 138<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 0<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 56.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 186<br>ordl_fuprice => 28.00<br>ordl_ftotal => 56.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Insert Delivery Order Line.<br> Document No : DO/00040-17', 10000, '2017-09-27 10:09:34', 0, '0000-00-00 00:00:00'),
(10144, 'db_order', 139, '', 'Insert', 'order_no => PU/00043-17<br>order_date => 2017-09-27<br>order_customer => 94<br>order_salesperson => 0<br>order_billaddress => <br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>order_customerref => <br>order_remark => e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore<br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 138<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 94554817<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 8<br>order_delivery_id => 4<br>order_price_id => 3<br>order_validity_id => 1<br>order_transittime_id => 3<br>order_freightcharge_id => 3<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 3<br>order_country_id => 32<br>order_attentionto_email => alvapierre@hotmail.com<br>order_attentionto_name => Nasirah Luddin<br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:02', 0, '0000-00-00 00:00:00'),
(10145, 'db_order', 139, '', 'Update', 'order_subtotal => 228.0000<br>order_disctotal => 0.00<br>order_taxtotal => 15.96<br>order_grandtotal => 243.96<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:02', 0, '0000-00-00 00:00:00'),
(10146, 'db_ordl', 445, '', 'Insert', 'ordl_order_id => 139<br>ordl_pro_id => 7<br>ordl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01<br>ordl_qty => 1.00<br>ordl_uom => 0<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 442<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:02', 0, '0000-00-00 00:00:00'),
(10147, 'db_stock_transaction', 33829, '', 'Insert', 'documentline_id => 445<br>ref_id => 139<br>quantity => 1.00<br>type => OUT<br>item_id => 7<br>uom => 0<br>cost => 80.00<br>custsupp_id => 94<br>document_date => 2017-09-27<br>', 'Insert 7 transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:02', 0, '0000-00-00 00:00:00'),
(10148, 'db_product', 7, '', 'Update', 'product_stock => 39<br>', 'Update 7 stock transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10149, 'db_ordl', 446, '', 'Insert', 'ordl_order_id => 139<br>ordl_pro_id => 9<br>ordl_pro_desc => 3/8&quot;, NPT, 7050-01<br>ordl_qty => 1.00<br>ordl_uom => 0<br>ordl_uprice => 52.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 52.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 443<br>ordl_fuprice => 52.00<br>ordl_ftotal => 52.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10150, 'db_stock_transaction', 33830, '', 'Insert', 'documentline_id => 446<br>ref_id => 139<br>quantity => 1.00<br>type => OUT<br>item_id => 9<br>uom => 0<br>cost => 50.00<br>custsupp_id => 94<br>document_date => 2017-09-27<br>', 'Insert 9 transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10151, 'db_product', 9, '', 'Update', 'product_stock => 19<br>', 'Update 9 stock transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10152, 'db_ordl', 447, '', 'Insert', 'ordl_order_id => 139<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 0<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 0<br>ordl_taxamt => 0.00<br>ordl_total => 56.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 444<br>ordl_fuprice => 28.00<br>ordl_ftotal => 56.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>', 'Insert Pickup List Line.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10153, 'db_stock_transaction', 33831, '', 'Insert', 'documentline_id => 447<br>ref_id => 139<br>quantity => 2.00<br>type => OUT<br>item_id => 5<br>uom => 0<br>cost => 20.00<br>custsupp_id => 94<br>document_date => 2017-09-27<br>', 'Insert 5 transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10154, 'db_product', 5, '', 'Update', 'product_stock => 37<br>', 'Update 5 stock transaction.<br> Document No : PU/00043-17', 10000, '2017-09-27 10:10:03', 0, '0000-00-00 00:00:00'),
(10155, 'db_invoice', 87, '', 'Insert', 'invoice_no => PCN00021<br>invoice_date => 2017-09-27<br>invoice_customer => 92<br>invoice_salesperson => 18<br>invoice_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_attentionto => 25<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => PCN<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => 81924589<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => 2<br>invoice_delivery_id => 2<br>invoice_price_id => 2<br>invoice_validity_id => 2<br>invoice_transittime_id => 2<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 2<br>invoice_remarks_id => 2<br>invoice_country_id => 32<br>invoice_attentionto_email => <br>invoice_attentionto_name => Felicia<br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Purchase Credit Note.<br> Document No : PCN00021', 10000, '2017-09-27 10:13:31', 0, '0000-00-00 00:00:00'),
(10156, 'db_invl', 187, '', 'Insert', 'invl_invoice_id => 87<br>invl_pro_id => 5<br>invl_pro_desc => Impeller<br>invl_qty => 2.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 20.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 40<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 40<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Purchase Credit Note Line.<br> Document No : PCN00021', 10000, '2017-09-27 10:14:18', 0, '0000-00-00 00:00:00'),
(10157, 'db_stock_transaction', 33832, '', 'Insert', 'documentline_id => 187<br>ref_id => 87<br>quantity => 2.00<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 92<br>document_date => 2017-09-27<br>', 'Insert 5 transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:14:18', 0, '0000-00-00 00:00:00'),
(10158, 'db_product', 5, '', 'Update', 'product_stock => 35<br>', 'Update 5 stock transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:14:18', 0, '0000-00-00 00:00:00'),
(10159, 'db_invoice', 87, '', 'Update', 'invoice_subtotal => 40.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 2.8<br>invoice_grandtotal => 42.8<br>invoice_discheadertotal => 0.00<br>', 'Update Purchase Credit Note.<br> Document No : PCN00021', 10000, '2017-09-27 10:14:18', 0, '0000-00-00 00:00:00'),
(10160, 'db_invl', 188, '', 'Insert', 'invl_invoice_id => 87<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 2.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 12.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 24<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 24<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Purchase Credit Note Line.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:24', 0, '0000-00-00 00:00:00'),
(10161, 'db_stock_transaction', 33833, '', 'Insert', 'documentline_id => 188<br>ref_id => 87<br>quantity => 2.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-09-27<br>', 'Insert 1 transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:24', 0, '0000-00-00 00:00:00'),
(10162, 'db_product', 1, '', 'Update', 'product_stock => 49<br>', 'Update 1 stock transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:24', 0, '0000-00-00 00:00:00'),
(10163, 'db_invoice', 87, '', 'Update', 'invoice_subtotal => 64.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 4.48<br>invoice_grandtotal => 68.48<br>invoice_discheadertotal => 0.00<br>', 'Update Purchase Credit Note.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:24', 0, '0000-00-00 00:00:00'),
(10164, 'db_invl', 188, '', 'Update', 'invl_invoice_id => 87<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 3.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 12.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 36<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 36<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Update Purchase Credit Note Line.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:49', 0, '0000-00-00 00:00:00'),
(10165, 'db_stock_transaction', 33834, '', 'Insert', 'documentline_id => 188<br>ref_id => 87<br>quantity => 3.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-09-27<br>', 'Insert 1 transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:49', 0, '0000-00-00 00:00:00'),
(10166, 'db_product', 1, '', 'Update', 'product_stock => 48<br>', 'Update 1 stock transaction.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:49', 0, '0000-00-00 00:00:00'),
(10167, 'db_invoice', 87, '', 'Update', 'invoice_subtotal => 76.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 5.32<br>invoice_grandtotal => 81.32<br>invoice_discheadertotal => 0.00<br>', 'Update Purchase Credit Note.<br> Document No : PCN00021', 10000, '2017-09-27 10:35:49', 0, '0000-00-00 00:00:00'),
(10168, 'db_product', 12, '', 'Insert', 'product_category => 9<br>product_part_no => 23522737<br>product_desc => gasket<br>product_remark => <br>product_sale_price => 10<br>product_cost_price => 5<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>', 'Insert Product.', 10000, '2017-09-27 14:29:08', 0, '0000-00-00 00:00:00'),
(10169, 'db_product', 12, '', 'Update', 'product_category => 9<br>product_part_no => 23522737<br>product_desc => gasket<br>product_remark => <br>product_sale_price => 10.00<br>product_cost_price => 5.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => qwerty<br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>', 'Update Product.', 10000, '2017-09-27 14:31:19', 0, '0000-00-00 00:00:00'),
(10170, 'db_contact', 26, '', 'Insert', 'contact_partner_id => 93<br>contact_name => ccsd<br>contact_tel => d<br>contact_email => <br>contact_address =>  <br>contact_remark => cd <br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10 dc<br>contact_status => 1<br>contact_fax => sdcsd<br>', 'Insert Contact.', 10000, '2017-09-27 14:43:27', 0, '0000-00-00 00:00:00'),
(10171, 'db_contact', 27, '', 'Insert', 'contact_partner_id => 93<br>contact_name =>  c <br>contact_tel =>  c c<br>contact_email =>  <br>contact_address => c c <br>contact_remark => c<br>contact_cellphone => <br>contact_department => <br>contact_position => <br>contact_jobtitle => <br>contact_forename => <br>contact_lastname => <br>contact_seqno => 10<br>contact_status => 1<br>contact_fax => c c <br>', 'Insert Contact.', 10000, '2017-09-27 14:44:03', 0, '0000-00-00 00:00:00'),
(10172, 'db_ordl', 429, '', 'Update', 'ordl_order_id => 133<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller\n\nAbout # to # days, Ex-Stock Depot subject to prior sale.\n<br>ordl_qty => 8.00<br>ordl_uom => 8<br>ordl_uprice => 0<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 140<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_fuprice => 17.50<br>ordl_pfuprice => <br>ordl_ftotal => 140<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => 8 qty<br>ordl_delivery_date => <br>ordl_item_type => product<br>', 'Update Quotation Line.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 15:01:32', 0, '0000-00-00 00:00:00'),
(10173, 'db_order', 133, '', 'Update', 'order_subtotal => 669.5000<br>order_disctotal => 0.00<br>order_taxtotal => 46.87<br>order_grandtotal => 716.37<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 15:01:33', 0, '0000-00-00 00:00:00'),
(10174, 'db_order', 133, '', 'Update', 'order_date => 2017-09-29<br>order_customer => 93<br>order_salesperson => 19<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-09-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 3<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 2<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc => <br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 15:05:56', 0, '0000-00-00 00:00:00'),
(10175, 'db_order', 133, '', 'Update', 'order_subtotal => 669.5000<br>order_disctotal => 0.00<br>order_taxtotal => 46.87<br>order_grandtotal => 716.37<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0023/17-09/TO', 10000, '2017-09-27 15:05:57', 0, '0000-00-00 00:00:00'),
(10176, 'db_invoice', 88, '', 'Insert', 'invoice_no => IV/700100053<br>invoice_date => 2017-09-27<br>invoice_customer => 94<br>invoice_salesperson => <br>invoice_billaddress => <br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => <br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100053', 10000, '2017-09-27 15:28:57', 0, '0000-00-00 00:00:00'),
(10177, 'db_partner', 95, '', 'Insert', 'partner_code => CUST00010<br>partner_name => William Tyler Building Materials &amp; Construction Pte Ltd<br>partner_iscustomer => 1<br>partner_issupplier => <br>partner_bill_address => 18 Kallang Terrace,\r\nSingapore 538977<br>partner_ship_address => <br>partner_sales_person => <br>partner_tel => 6322 6550<br>partner_fax => <br>partner_email => <br>partner_currency => <br>partner_outlet => <br>partner_remark => <br>partner_website => <br>partner_credit_limit => <br>partner_industry => <br>partner_debtor_account => <br>partner_creditor_account => <br>partner_seqno => <br>partner_status => 1<br>partner_tel2 => <br>partner_postal_code => <br>partner_city => <br>partner_house_no => <br>partner_suburb => <br>partner_address_type => 1<br>partner_group => <br>partner_name_cn => <br>partner_name_thai => <br>partner_bill_address_cn => <br>partner_bill_address_thai => <br>partner_issubcon => <br>partner_issitecoordinator => <br>partner_login_password => bebc729080e59bf4c7cb24e3d062a23c<br>partner_login_id => <br>', 'Insert Partner.', 10000, '2017-10-04 11:48:03', 0, '0000-00-00 00:00:00'),
(10178, 'db_partner', 94, '', 'Update', 'partner_code => CUST00009<br>partner_name => Customer from e-commerce<br>partner_iscustomer => 1<br>partner_issupplier => <br>partner_bill_address => <br>partner_ship_address => <br>partner_sales_person => <br>partner_tel => <br>partner_fax => <br>partner_email => <br>partner_currency => <br>partner_outlet => <br>partner_remark => <br>partner_website => <br>partner_credit_limit => <br>partner_industry => <br>partner_debtor_account => <br>partner_creditor_account => <br>partner_seqno => <br>partner_status => 1<br>partner_tel2 => <br>partner_postal_code => 0<br>partner_city => <br>partner_house_no => <br>partner_suburb => <br>partner_address_type => 1<br>partner_group => <br>partner_name_cn => <br>partner_name_thai => <br>partner_bill_address_cn => <br>partner_bill_address_thai => <br>partner_issubcon => <br>partner_issitecoordinator => <br>partner_login_password => bebc729080e59bf4c7cb24e3d062a23c<br>partner_login_id => <br>', 'Update Partner.', 10000, '2017-10-04 11:49:23', 0, '0000-00-00 00:00:00'),
(10179, 'db_invoice', 88, '', 'Update', 'invoice_status => 0<br>', 'Delete Sales Invoice.<br> Document No : ', 10000, '2017-10-04 11:50:34', 0, '0000-00-00 00:00:00'),
(10180, 'db_invoice', 89, '', 'Insert', 'invoice_no => IV/700100054<br>invoice_date => 2017-10-04<br>invoice_customer => 95<br>invoice_salesperson => 14<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => 94554817<br>invoice_fax => 94554817<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => Peter Poh<br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100054', 10000, '2017-10-04 16:31:43', 0, '0000-00-00 00:00:00'),
(10181, 'db_invoice', 90, '', 'Insert', 'invoice_no => IV/700100055<br>invoice_date => 2017-10-06<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100055', 10000, '2017-10-06 17:00:52', 0, '0000-00-00 00:00:00'),
(10182, 'db_order', 140, '', 'Insert', 'order_no => KC/0024/17-10/TO<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-10-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => 1<br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>', 'Insert Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:52:32', 0, '0000-00-00 00:00:00'),
(10183, 'db_order', 140, '', 'Update', 'order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-10-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => dfgh<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 2<br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => <br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => xdfxdf<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:53:05', 0, '0000-00-00 00:00:00'),
(10184, 'db_order', 140, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:53:05', 0, '0000-00-00 00:00:00'),
(10185, 'db_order', 140, '', 'Update', 'order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-10-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => dfgh<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 2<br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => xdfxdf<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:57:54', 0, '0000-00-00 00:00:00'),
(10186, 'db_order', 140, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:57:55', 0, '0000-00-00 00:00:00'),
(10187, 'db_order', 140, '', 'Update', 'order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-10-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => dfgh<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 2<br>order_delivery_id => 3<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => xdfxdf<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:58:14', 0, '0000-00-00 00:00:00'),
(10188, 'db_order', 140, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0024/17-10/TO', 10000, '2017-10-27 14:58:15', 0, '0000-00-00 00:00:00'),
(10189, 'db_invoice', 91, '', 'Insert', 'invoice_no => IV/171000056<br>invoice_date => 2017-10-27<br>invoice_customer => 93<br>invoice_salesperson => 0<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 140<br>invoice_outlet => -1<br>invoice_attentionto_phone => 62437519<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 2<br>invoice_delivery_id => 3<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 2<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => enquiry@alphadesign.com.sg<br>invoice_attentionto_name => <br>invoice_regards => dfgh<br>invoice_tnc => xdfxdf<br>', 'Insert Sales Invoice.<br> Document No : IV/171000056', 10000, '2017-10-27 15:06:20', 0, '0000-00-00 00:00:00'),
(10190, 'db_invoice', 91, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171000056', 10000, '2017-10-27 15:06:20', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10191, 'db_order', 141, '', 'Insert', 'order_no => DO/00041-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 91<br>order_outlet => -1<br>order_attentionto_phone => 62437519<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 2<br>order_delivery_id => 3<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 2<br>order_remarks_id => 1<br>order_country_id => 32<br>order_generate_from_type => SI<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_regards => dfgh<br>order_tnc => xdfxdf<br>', 'Insert Delivery Order.<br> Document No : DO/00041-17', 10000, '2017-10-27 15:07:01', 0, '0000-00-00 00:00:00'),
(10192, 'db_order', 141, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00041-17', 10000, '2017-10-27 15:07:01', 0, '0000-00-00 00:00:00'),
(10193, 'db_order', 142, '', 'Insert', 'order_no => KC/0025/17-10/TO<br>order_date => 2017-10-27<br>order_customer => 95<br>order_salesperson => <br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-10-27<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>', 'Insert Quotation.<br> Document No : KC/0025/17-10/TO', 10000, '2017-10-27 15:12:54', 0, '0000-00-00 00:00:00'),
(10194, 'db_invoice', 92, '', 'Insert', 'invoice_no => IV/700100057<br>invoice_date => 2017-10-27<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100057', 10000, '2017-10-27 15:17:21', 0, '0000-00-00 00:00:00'),
(10195, 'db_invl', 189, '', 'Insert', 'invl_invoice_id => 92<br>invl_pro_id => 6<br>invl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 100.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 100<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 100<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100057', 10000, '2017-10-27 15:17:26', 0, '0000-00-00 00:00:00'),
(10196, 'db_invoice', 92, '', 'Update', 'invoice_subtotal => 100.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100057', 10000, '2017-10-27 15:17:26', 0, '0000-00-00 00:00:00'),
(10197, 'db_order', 143, '', 'Insert', 'order_no => DO/00042-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 92<br>order_outlet => -1<br>order_attentionto_phone => <br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => <br>order_attentionto_name => <br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00042-17', 10000, '2017-10-27 15:17:44', 0, '0000-00-00 00:00:00'),
(10198, 'db_order', 143, '', 'Update', 'order_subtotal => 100.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7<br>order_grandtotal => 107<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00042-17', 10000, '2017-10-27 15:17:44', 0, '0000-00-00 00:00:00'),
(10199, 'db_order', 144, '', 'Insert', 'order_no => DO/00043-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 92<br>order_outlet => -1<br>order_attentionto_phone => <br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => <br>order_attentionto_name => <br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00043-17', 10000, '2017-10-27 15:17:53', 0, '0000-00-00 00:00:00'),
(10200, 'db_order', 144, '', 'Update', 'order_subtotal => 100.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7<br>order_grandtotal => 107<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00043-17', 10000, '2017-10-27 15:17:54', 0, '0000-00-00 00:00:00'),
(10201, 'db_ordl', 448, '', 'Insert', 'ordl_order_id => 142<br>ordl_pro_id => 12<br>ordl_pro_desc => gasket<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 10.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 10<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 10.00<br>ordl_ftotal => 10<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Quotation Line.<br> Document No : KC/0025/17-10/TO', 10000, '2017-10-27 15:19:17', 0, '0000-00-00 00:00:00'),
(10202, 'db_order', 142, '', 'Update', 'order_subtotal => 10.0000<br>order_disctotal => 0.00<br>order_taxtotal => 0.7<br>order_grandtotal => 10.7<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0025/17-10/TO', 10000, '2017-10-27 15:19:17', 0, '0000-00-00 00:00:00'),
(10203, 'db_invoice', 93, '', 'Insert', 'invoice_no => IV/700100058<br>invoice_date => 2017-10-27<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100058', 10000, '2017-10-27 15:19:41', 0, '0000-00-00 00:00:00'),
(10204, 'db_invl', 190, '', 'Insert', 'invl_invoice_id => 93<br>invl_pro_id => 8<br>invl_pro_desc => 1-1/2&quot;, BSP<br>invl_qty => 5<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 70.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 350<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 350<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100058', 10000, '2017-10-27 15:19:53', 0, '0000-00-00 00:00:00'),
(10205, 'db_invoice', 93, '', 'Update', 'invoice_subtotal => 350.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 24.5<br>invoice_grandtotal => 374.5<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100058', 10000, '2017-10-27 15:19:53', 0, '0000-00-00 00:00:00'),
(10206, 'db_invl', 191, '', 'Insert', 'invl_invoice_id => 93<br>invl_pro_id => 10<br>invl_pro_desc => 3/8&quot;, Hose, 7051-01<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 39.60<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 39.6<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 39.6<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100058', 10000, '2017-10-27 15:19:58', 0, '0000-00-00 00:00:00'),
(10207, 'db_invoice', 93, '', 'Update', 'invoice_subtotal => 389.6000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 27.27<br>invoice_grandtotal => 416.87<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100058', 10000, '2017-10-27 15:19:58', 0, '0000-00-00 00:00:00'),
(10208, 'db_invl', 192, '', 'Insert', 'invl_invoice_id => 93<br>invl_pro_id => 11<br>invl_pro_desc => Flat Shipping Rate<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 15.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 15<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 15<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100058', 10000, '2017-10-27 15:20:06', 0, '0000-00-00 00:00:00'),
(10209, 'db_invoice', 93, '', 'Update', 'invoice_subtotal => 404.6000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 28.32<br>invoice_grandtotal => 432.92<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100058', 10000, '2017-10-27 15:20:07', 0, '0000-00-00 00:00:00'),
(10210, 'db_order', 145, '', 'Insert', 'order_no => DO/00044-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 93<br>order_outlet => -1<br>order_attentionto_phone => <br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => <br>order_attentionto_name => <br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00044-17', 10000, '2017-10-27 15:20:11', 0, '0000-00-00 00:00:00'),
(10211, 'db_order', 145, '', 'Update', 'order_subtotal => 404.6000<br>order_disctotal => 0.00<br>order_taxtotal => 28.32<br>order_grandtotal => 432.92<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00044-17', 10000, '2017-10-27 15:20:11', 0, '0000-00-00 00:00:00'),
(10212, 'db_ordl', 449, '', 'Insert', 'ordl_order_id => 145<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP<br>ordl_qty => 5.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 350.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 190<br>ordl_fuprice => 70.00<br>ordl_ftotal => 350.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00044-17', 10000, '2017-10-27 15:20:11', 0, '0000-00-00 00:00:00'),
(10213, 'db_ordl', 450, '', 'Insert', 'ordl_order_id => 145<br>ordl_pro_id => 10<br>ordl_pro_desc => 3/8&quot;, Hose, 7051-01<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 39.60<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 191<br>ordl_fuprice => 39.60<br>ordl_ftotal => 39.60<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00044-17', 10000, '2017-10-27 15:20:11', 0, '0000-00-00 00:00:00'),
(10214, 'db_ordl', 451, '', 'Insert', 'ordl_order_id => 145<br>ordl_pro_id => 11<br>ordl_pro_desc => Flat Shipping Rate<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 192<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00044-17', 10000, '2017-10-27 15:20:11', 0, '0000-00-00 00:00:00'),
(10215, 'db_ordl', 452, '', 'Insert', 'ordl_order_id => 142<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 15<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 15.00<br>ordl_ftotal => 15<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Quotation Line.<br> Document No : KC/0025/17-10/TO', 10000, '2017-10-27 15:20:32', 0, '0000-00-00 00:00:00'),
(10216, 'db_order', 142, '', 'Update', 'order_subtotal => 25.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.75<br>order_grandtotal => 26.75<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0025/17-10/TO', 10000, '2017-10-27 15:20:32', 0, '0000-00-00 00:00:00'),
(10217, 'db_invoice', 94, '', 'Insert', 'invoice_no => IV/171000059<br>invoice_date => 2017-10-27<br>invoice_customer => 95<br>invoice_salesperson => 0<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 142<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => <br>invoice_tnc => <br>', 'Insert Sales Invoice.<br> Document No : IV/171000059', 10000, '2017-10-27 15:20:41', 0, '0000-00-00 00:00:00'),
(10218, 'db_invoice', 94, '', 'Update', 'invoice_subtotal => 25.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.75<br>invoice_grandtotal => 26.75<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171000059', 10000, '2017-10-27 15:20:41', 0, '0000-00-00 00:00:00'),
(10219, 'db_invl', 193, '', 'Insert', 'invl_invoice_id => 94<br>invl_pro_id => 12<br>invl_pro_desc => gasket<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 10.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 10.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 448<br>invl_fuprice => 10.00<br>invl_ftotal => 10.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171000059', 10000, '2017-10-27 15:20:41', 0, '0000-00-00 00:00:00'),
(10220, 'db_invl', 194, '', 'Insert', 'invl_invoice_id => 94<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 15.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 15.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 452<br>invl_fuprice => 15.00<br>invl_ftotal => 15.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171000059', 10000, '2017-10-27 15:20:41', 0, '0000-00-00 00:00:00'),
(10221, 'db_order', 146, '', 'Insert', 'order_no => PU/00044-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 145<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => <br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10222, 'db_order', 146, '', 'Update', 'order_subtotal => 404.6000<br>order_disctotal => 0.00<br>order_taxtotal => 28.32<br>order_grandtotal => 432.92<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10223, 'db_ordl', 453, '', 'Insert', 'ordl_order_id => 146<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP<br>ordl_qty => 5.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 350.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 449<br>ordl_fuprice => 70.00<br>ordl_ftotal => 350.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10224, 'db_stock_transaction', 33835, '', 'Insert', 'documentline_id => 453<br>ref_id => 146<br>quantity => 5.00<br>type => OUT<br>item_id => 8<br>uom => 8<br>cost => 60.00<br>custsupp_id => 93<br>document_date => 2017-10-27<br>', 'Insert 8 transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10225, 'db_product', 8, '', 'Update', 'product_stock => 12<br>', 'Update 8 stock transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10226, 'db_ordl', 454, '', 'Insert', 'ordl_order_id => 146<br>ordl_pro_id => 10<br>ordl_pro_desc => 3/8&quot;, Hose, 7051-01<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 39.60<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 450<br>ordl_fuprice => 39.60<br>ordl_ftotal => 39.60<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10227, 'db_stock_transaction', 33836, '', 'Insert', 'documentline_id => 454<br>ref_id => 146<br>quantity => 1.00<br>type => OUT<br>item_id => 10<br>uom => 8<br>cost => 35.00<br>custsupp_id => 93<br>document_date => 2017-10-27<br>', 'Insert 10 transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:00', 0, '0000-00-00 00:00:00'),
(10228, 'db_product', 10, '', 'Update', 'product_stock => 34<br>', 'Update 10 stock transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:01', 0, '0000-00-00 00:00:00'),
(10229, 'db_ordl', 455, '', 'Insert', 'ordl_order_id => 146<br>ordl_pro_id => 11<br>ordl_pro_desc => Flat Shipping Rate<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 451<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:01', 0, '0000-00-00 00:00:00'),
(10230, 'db_stock_transaction', 33837, '', 'Insert', 'documentline_id => 455<br>ref_id => 146<br>quantity => 1.00<br>type => OUT<br>item_id => 11<br>uom => 8<br>cost => 15.00<br>custsupp_id => 93<br>document_date => 2017-10-27<br>', 'Insert 11 transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:01', 0, '0000-00-00 00:00:00'),
(10231, 'db_product', 11, '', 'Update', 'product_stock => -1<br>', 'Update 11 stock transaction.<br> Document No : PU/00044-17', 10000, '2017-10-27 15:25:01', 0, '0000-00-00 00:00:00'),
(10232, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10233, 'db_menuprm', 3088, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10234, 'db_menuprm', 3089, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => create<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10235, 'db_menuprm', 3090, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => update<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10236, 'db_menuprm', 3091, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => delete<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10237, 'db_menuprm', 3092, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => generate<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10238, 'db_menuprm', 3093, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => print<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10239, 'db_menuprm', 3094, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 11<br>menuprm_prmcode => approved<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10240, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:52', 0, '0000-00-00 00:00:00'),
(10241, 'db_menuprm', 3095, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10242, 'db_menuprm', 3096, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => create<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10243, 'db_menuprm', 3097, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => update<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10244, 'db_menuprm', 3098, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => delete<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10245, 'db_menuprm', 3099, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => generate<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10246, 'db_menuprm', 3100, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => print<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10247, 'db_menuprm', 3101, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 14<br>menuprm_prmcode => approved<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10248, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10249, 'db_menuprm', 3102, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10250, 'db_menuprm', 3103, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => create<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10251, 'db_menuprm', 3104, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => update<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10252, 'db_menuprm', 3105, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => delete<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:53', 0, '0000-00-00 00:00:00'),
(10253, 'db_menuprm', 3106, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => generate<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:54', 0, '0000-00-00 00:00:00'),
(10254, 'db_menuprm', 3107, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => print<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:54', 0, '0000-00-00 00:00:00'),
(10255, 'db_menuprm', 3108, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 78<br>menuprm_prmcode => approved<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:54', 0, '0000-00-00 00:00:00'),
(10256, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:54', 0, '0000-00-00 00:00:00'),
(10257, 'db_menuprm', 3109, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:54', 0, '0000-00-00 00:00:00'),
(10258, 'db_menuprm', 3110, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => create<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10259, 'db_menuprm', 3111, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => update<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10260, 'db_menuprm', 3112, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => delete<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10261, 'db_menuprm', 3113, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => generate<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10262, 'db_menuprm', 3114, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => print<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10263, 'db_menuprm', 3115, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 85<br>menuprm_prmcode => approved<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10264, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10265, 'db_menuprm', 3116, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10266, 'db_menuprm', 3117, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => create<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10267, 'db_menuprm', 3118, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => update<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10268, 'db_menuprm', 3119, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => delete<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:55', 0, '0000-00-00 00:00:00'),
(10269, 'db_menuprm', 3120, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => generate<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:56', 0, '0000-00-00 00:00:00'),
(10270, 'db_menuprm', 3121, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => print<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:56', 0, '0000-00-00 00:00:00'),
(10271, 'db_menuprm', 3122, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 93<br>menuprm_prmcode => approved<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:56', 0, '0000-00-00 00:00:00'),
(10272, 'db_menuprm', 0, '', 'Delete', 'Delete Menu Permission .', 'Delete Menu Permission .', 10000, '2017-10-27 15:41:56', 0, '0000-00-00 00:00:00'),
(10273, 'db_menuprm', 3123, '', 'Insert', 'menuprm_group_id => 1<br>menuprm_menu_id => 57<br>menuprm_prmcode => access<br>', 'Insert Permission code.', 10000, '2017-10-27 15:41:56', 0, '0000-00-00 00:00:00'),
(10274, 'db_product', 13, '', 'Insert', 'product_category => 9<br>product_part_no => test<br>product_desc => test<br>product_remark => <br>product_sale_price => 5.00<br>product_cost_price => 5.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => US<br>', 'Insert Product.', 10000, '2017-10-27 15:58:40', 0, '0000-00-00 00:00:00'),
(10275, 'db_product', 13, '', 'Update', 'product_category => 7<br>product_part_no => test<br>product_desc => test<br>product_remark => <br>product_sale_price => 5.00<br>product_cost_price => 5.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => US<br>', 'Update Product.', 10000, '2017-10-27 15:59:02', 0, '0000-00-00 00:00:00'),
(10276, 'db_package', 36, '', 'Insert', 'package_part_no => tst01<br>package_desc => test11<br>package_sale_price => 10<br>package_cost_price => <br>package_category => <br>package_brand => <br>package_packagetype => <br>package_outlet => <br>package_barcode => <br>package_remark => <br>package_seqno => <br>package_status => 1<br>package_custom_no => <br>package_weight => <br>package_uom => <br>package_product_wastage => <br>package_labour_profit => <br>', 'Insert Package.', 10000, '2017-10-27 15:59:26', 0, '0000-00-00 00:00:00'),
(10277, 'db_invoice', 95, '', 'Insert', 'invoice_no => IV/700100060<br>invoice_date => 2017-10-27<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 26<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress =>  <br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => SGD<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => d<br>invoice_fax => sdcsd<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_attentionto_email => <br>invoice_attentionto_name => ccsd<br>invoice_tnc => <br>invoice_regards => <br>', 'Insert Sales Invoice.<br> Document No : IV/700100060', 10000, '2017-10-27 16:00:20', 0, '0000-00-00 00:00:00'),
(10278, 'db_invl', 195, '', 'Insert', 'invl_invoice_id => 95<br>invl_pro_id => 1<br>invl_pro_desc => Impeller<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 15.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 15<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 15<br>invl_pro_remark => <br>invl_item_type => product<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100060', 10000, '2017-10-27 16:00:28', 0, '0000-00-00 00:00:00'),
(10279, 'db_invoice', 95, '', 'Update', 'invoice_subtotal => 15.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.05<br>invoice_grandtotal => 16.05<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100060', 10000, '2017-10-27 16:00:29', 0, '0000-00-00 00:00:00'),
(10280, 'db_order', 147, '', 'Insert', 'order_no => DO/00045-17<br>order_date => 2017-10-27<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 26<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress =>  <br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 0<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 95<br>order_outlet => -1<br>order_attentionto_phone => d<br>order_fax => sdcsd<br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 1<br>order_country_id => 32<br>order_generate_from_type => SI<br>order_attentionto_email => <br>order_attentionto_name => ccsd<br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00045-17', 10000, '2017-10-27 16:00:37', 0, '0000-00-00 00:00:00'),
(10281, 'db_order', 147, '', 'Update', 'order_subtotal => 15.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.05<br>order_grandtotal => 16.05<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00045-17', 10000, '2017-10-27 16:00:37', 0, '0000-00-00 00:00:00'),
(10282, 'db_ordl', 456, '', 'Insert', 'ordl_order_id => 147<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 195<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00045-17', 10000, '2017-10-27 16:00:38', 0, '0000-00-00 00:00:00'),
(10283, 'db_product', 1, '', 'Update', 'product_category => 7<br>product_part_no => 6000-01<br>product_desc => Impeller - 6000-01 (from Florida, USA)<br>product_remark => <br>product_sale_price => 15.00<br>product_cost_price => 12.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 6<br>product_insert_types => 3<br>product_diameter => 32.00<br>product_width_depth => 12.00<br>product_shaft_diameter => 8.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 48<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => Florida, USA<br>product_name => Impeller<br>product_lowstock => 11<br>', 'Update Product.', 10000, '2017-11-03 09:53:02', 0, '0000-00-00 00:00:00'),
(10284, 'db_product', 1, '', 'Update', 'product_category => 7<br>product_part_no => 6000-01<br>product_desc => Impeller - 6000-01 (from Florida, USA)<br>product_remark => <br>product_sale_price => 15.00<br>product_cost_price => 12.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 6<br>product_insert_types => 3<br>product_diameter => 32.00<br>product_width_depth => 12.00<br>product_shaft_diameter => 8.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 48<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => Florida, USA<br>product_name => Impeller<br>product_lowstock => 10<br>', 'Update Product.', 10000, '2017-11-03 09:53:13', 0, '0000-00-00 00:00:00'),
(10285, 'db_product', 5, '', 'Update', 'product_category => 7<br>product_part_no => 7000-01<br>product_desc => Impeller - 7000-01 (from New York, USA)<br>product_remark => <br>product_sale_price => 28.00<br>product_cost_price => 20.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 6<br>product_insert_types => 1<br>product_diameter => 39.70<br>product_width_depth => 19.20<br>product_shaft_diameter => 12.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 35<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => New York, USA<br>product_name => Impeller<br>product_lowstock => 10<br>', 'Update Product.', 10000, '2017-11-03 09:56:27', 0, '0000-00-00 00:00:00'),
(10286, 'db_product', 6, '', 'Update', 'product_category => 8<br>product_part_no => JPR-VK2000<br>product_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>product_remark => <br>product_sale_price => 100.00<br>product_cost_price => 80.00<br>product_seqno => <br>product_status => 1<br>product_system_code => PUA006101<br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 1<br>product_sub_group => 2<br>product_n_wt => 7.900<br>product_g_wt => 8.420<br>product_usage => <br>product_enginemodel => <br>product_stock => 80<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => California, USA<br>product_name => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01<br>product_lowstock => 20<br>', 'Update Product.', 10000, '2017-11-03 09:59:32', 0, '0000-00-00 00:00:00'),
(10287, 'db_product', 7, '', 'Update', 'product_category => 8<br>product_part_no => JPR-FU50<br>product_desc => 2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)<br>product_remark => <br>product_sale_price => 120.00<br>product_cost_price => 80.00<br>product_seqno => <br>product_status => 1<br>product_system_code => PUA0027<br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 4<br>product_sub_group => 3<br>product_n_wt => 9.000<br>product_g_wt => 9.500<br>product_usage => <br>product_enginemodel => <br>product_stock => 39<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => California, USA<br>product_name => 2&quot;, Flange, M-seal, Imp 8201-01<br>product_lowstock => 20<br>', 'Update Product.', 10000, '2017-11-03 10:00:18', 0, '0000-00-00 00:00:00'),
(10288, 'db_product', 8, '', 'Update', 'product_category => 8<br>product_part_no => JPR-ST4010<br>product_desc => 1-1/2&quot;, BSP (from California, USA)<br>product_remark => <br>product_sale_price => 70.00<br>product_cost_price => 60.00<br>product_seqno => <br>product_status => 1<br>product_system_code => STR0001<br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 3<br>product_sub_group => 1<br>product_n_wt => 10.260<br>product_g_wt => 11.140<br>product_usage => <br>product_enginemodel => <br>product_stock => 12<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => California, USA<br>product_name => 1-1/2&quot;, BSP<br>product_lowstock => 10<br>', 'Update Product.', 10000, '2017-11-03 10:01:09', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10289, 'db_product', 9, '', 'Update', 'product_category => 8<br>product_part_no => JPR-WB08IP<br>product_desc => 3/8&quot;, NPT, 7050-01 (from New York)<br>product_remark => <br>product_sale_price => 52.00<br>product_cost_price => 50.00<br>product_seqno => <br>product_status => 1<br>product_system_code => PUA0104<br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 4<br>product_sub_group => 3<br>product_n_wt => 1.300<br>product_g_wt => 1.350<br>product_usage => <br>product_enginemodel => <br>product_stock => 19<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => New York, USA<br>product_name => 3/8&quot;, NPT, 7050-01<br>product_lowstock => 10<br>', 'Update Product.', 10000, '2017-11-03 10:02:02', 0, '0000-00-00 00:00:00'),
(10290, 'db_product', 9, '', 'Update', 'product_category => 8<br>product_part_no => JPR-WB08IP<br>product_desc => 3/8&quot;, NPT, 7050-01 (from New York)<br>product_remark => <br>product_sale_price => 52.00<br>product_cost_price => 50.00<br>product_seqno => <br>product_status => 1<br>product_system_code => PUA0104<br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 4<br>product_sub_group => 3<br>product_n_wt => 1.300<br>product_g_wt => 1.350<br>product_usage => <br>product_enginemodel => <br>product_stock => 19<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => New York, USA<br>product_name => 3/8&quot;, NPT, 7050-01<br>product_lowstock => 10<br>', 'Update Product.', 10000, '2017-11-03 10:02:18', 0, '0000-00-00 00:00:00'),
(10291, 'db_countryitem', 35, '', 'Insert', 'country_code => Malaysia<br>country_desc => Malaysia<br>country_seqno => 10<br>country_status => 1<br>', 'Insert Country.', 10000, '2017-11-03 10:37:25', 0, '0000-00-00 00:00:00'),
(10292, 'db_countryitem', 36, '', 'Insert', 'country_code => Singapore<br>country_desc => Singapore<br>country_seqno => 10<br>country_status => 1<br>', 'Insert Country.', 10000, '2017-11-03 10:37:35', 0, '0000-00-00 00:00:00'),
(10293, 'db_country', 35, '', 'Insert', 'country_code => Thailand<br>country_desc => Thailand<br>country_seqno => 10<br>country_status => 1<br>', 'Insert Country.', 10000, '2017-11-03 10:38:06', 0, '0000-00-00 00:00:00'),
(10294, 'db_countryitem', 0, '', 'Delete', 'Delete Country.', 'Delete Country.', 10000, '2017-11-03 10:43:22', 0, '0000-00-00 00:00:00'),
(10295, 'db_countryitem', 0, '', 'Delete', 'Delete Country.', 'Delete Country.', 10000, '2017-11-03 10:44:40', 0, '0000-00-00 00:00:00'),
(10296, 'db_order', 148, '', 'Insert', 'order_no => KC/0026/17-11<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 1<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc => <br>', 'Insert Quotation.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:45:31', 0, '0000-00-00 00:00:00'),
(10297, 'db_ordl', 457, '', 'Insert', 'ordl_order_id => 148<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 30<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 15.00<br>ordl_ftotal => 30<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:50:56', 0, '0000-00-00 00:00:00'),
(10298, 'db_order', 148, '', 'Update', 'order_subtotal => 30.0000<br>order_disctotal => 0.00<br>order_taxtotal => 2.1<br>order_grandtotal => 32.1<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:50:56', 0, '0000-00-00 00:00:00'),
(10299, 'db_ordl', 458, '', 'Insert', 'ordl_order_id => 148<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 56<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 28.00<br>ordl_ftotal => 56<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:51:07', 0, '0000-00-00 00:00:00'),
(10300, 'db_order', 148, '', 'Update', 'order_subtotal => 86.0000<br>order_disctotal => 0.00<br>order_taxtotal => 6.02<br>order_grandtotal => 92.02<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:51:07', 0, '0000-00-00 00:00:00'),
(10301, 'db_ordl', 459, '', 'Insert', 'ordl_order_id => 148<br>ordl_pro_id => 7<br>ordl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)<br>ordl_qty => 3.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 360<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 120.00<br>ordl_ftotal => 360<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:51:17', 0, '0000-00-00 00:00:00'),
(10302, 'db_order', 148, '', 'Update', 'order_subtotal => 446.0000<br>order_disctotal => 0.00<br>order_taxtotal => 31.22<br>order_grandtotal => 477.22<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0026/17-11', 10000, '2017-11-03 10:51:17', 0, '0000-00-00 00:00:00'),
(10303, 'db_invoice', 96, '', 'Insert', 'invoice_no => IV/171100061<br>invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 22<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 4<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 148<br>invoice_outlet => -1<br>invoice_attentionto_phone => 81354729<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 1<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => edward@alphadesign.com.sg<br>invoice_attentionto_name => Edward<br>invoice_regards => KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_tnc => <br>', 'Insert Sales Invoice.<br> Document No : IV/171100061', 10000, '2017-11-03 10:53:04', 0, '0000-00-00 00:00:00'),
(10304, 'db_invoice', 96, '', 'Update', 'invoice_subtotal => 446.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 31.22<br>invoice_grandtotal => 477.22<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171100061', 10000, '2017-11-03 10:53:04', 0, '0000-00-00 00:00:00'),
(10305, 'db_invl', 196, '', 'Insert', 'invl_invoice_id => 96<br>invl_pro_id => 1<br>invl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>invl_qty => 2.00<br>invl_uom => 8<br>invl_uprice => 15.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 30.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 457<br>invl_fuprice => 15.00<br>invl_ftotal => 30.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => Florida, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100061', 10000, '2017-11-03 10:53:04', 0, '0000-00-00 00:00:00'),
(10306, 'db_invl', 197, '', 'Insert', 'invl_invoice_id => 96<br>invl_pro_id => 5<br>invl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>invl_qty => 2.00<br>invl_uom => 8<br>invl_uprice => 28.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 56.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 458<br>invl_fuprice => 28.00<br>invl_ftotal => 56.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => New York, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100061', 10000, '2017-11-03 10:53:04', 0, '0000-00-00 00:00:00'),
(10307, 'db_invl', 198, '', 'Insert', 'invl_invoice_id => 96<br>invl_pro_id => 7<br>invl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)<br>invl_qty => 3.00<br>invl_uom => 8<br>invl_uprice => 120.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 360.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 459<br>invl_fuprice => 120.00<br>invl_ftotal => 360.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => California, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100061', 10000, '2017-11-03 10:53:04', 0, '0000-00-00 00:00:00'),
(10308, 'db_invoice', 96, '', 'Update', 'invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 22<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 4.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 81354729<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => edward@alphadesign.com.sg<br>invoice_attentionto_name => Edward<br>invoice_tnc => <br>invoice_regards => KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_payment => 1<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-11-03 10:54:12', 0, '0000-00-00 00:00:00'),
(10309, 'db_invoice', 96, '', 'Update', 'invoice_subtotal => 446.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 31.22<br>invoice_grandtotal => 477.22<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171100061', 10000, '2017-11-03 10:54:13', 0, '0000-00-00 00:00:00'),
(10310, 'db_order', 149, '', 'Insert', 'order_no => DO/00046-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 96<br>order_outlet => -1<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_regards => KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00046-17', 10000, '2017-11-03 10:54:25', 0, '0000-00-00 00:00:00'),
(10311, 'db_order', 149, '', 'Update', 'order_subtotal => 446.0000<br>order_disctotal => 0.00<br>order_taxtotal => 31.22<br>order_grandtotal => 477.22<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00046-17', 10000, '2017-11-03 10:54:25', 0, '0000-00-00 00:00:00'),
(10312, 'db_ordl', 460, '', 'Insert', 'ordl_order_id => 149<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 30.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 196<br>ordl_fuprice => 15.00<br>ordl_ftotal => 30.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00046-17', 10000, '2017-11-03 10:54:25', 0, '0000-00-00 00:00:00'),
(10313, 'db_ordl', 461, '', 'Insert', 'ordl_order_id => 149<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 56.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 197<br>ordl_fuprice => 28.00<br>ordl_ftotal => 56.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00046-17', 10000, '2017-11-03 10:54:25', 0, '0000-00-00 00:00:00'),
(10314, 'db_ordl', 462, '', 'Insert', 'ordl_order_id => 149<br>ordl_pro_id => 7<br>ordl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)<br>ordl_qty => 3.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 360.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 198<br>ordl_fuprice => 120.00<br>ordl_ftotal => 360.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00046-17', 10000, '2017-11-03 10:54:26', 0, '0000-00-00 00:00:00'),
(10315, 'db_order', 150, '', 'Insert', 'order_no => PU/00045-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 22<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 149<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81354729<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => edward@alphadesign.com.sg<br>order_attentionto_name => Edward<br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10316, 'db_order', 150, '', 'Update', 'order_subtotal => 446.0000<br>order_disctotal => 0.00<br>order_taxtotal => 31.22<br>order_grandtotal => 477.22<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10317, 'db_ordl', 463, '', 'Insert', 'ordl_order_id => 150<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 30.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 460<br>ordl_fuprice => 15.00<br>ordl_ftotal => 30.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10318, 'db_stock_transaction', 33838, '', 'Insert', 'documentline_id => 463<br>ref_id => 150<br>quantity => 2.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 1 transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10319, 'db_product', 1, '', 'Update', 'product_stock => 46<br>', 'Update 1 stock transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10320, 'db_ordl', 464, '', 'Insert', 'ordl_order_id => 150<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 56.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 461<br>ordl_fuprice => 28.00<br>ordl_ftotal => 56.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:45', 0, '0000-00-00 00:00:00'),
(10321, 'db_stock_transaction', 33839, '', 'Insert', 'documentline_id => 464<br>ref_id => 150<br>quantity => 2.00<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 5 transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:46', 0, '0000-00-00 00:00:00'),
(10322, 'db_product', 5, '', 'Update', 'product_stock => 33<br>', 'Update 5 stock transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:46', 0, '0000-00-00 00:00:00'),
(10323, 'db_ordl', 465, '', 'Insert', 'ordl_order_id => 150<br>ordl_pro_id => 7<br>ordl_pro_desc => 2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)<br>ordl_qty => 3.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 360.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 462<br>ordl_fuprice => 120.00<br>ordl_ftotal => 360.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:46', 0, '0000-00-00 00:00:00'),
(10324, 'db_stock_transaction', 33840, '', 'Insert', 'documentline_id => 465<br>ref_id => 150<br>quantity => 3.00<br>type => OUT<br>item_id => 7<br>uom => 8<br>cost => 80.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 7 transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:46', 0, '0000-00-00 00:00:00'),
(10325, 'db_product', 7, '', 'Update', 'product_stock => 36<br>', 'Update 7 stock transaction.<br> Document No : PU/00045-17', 10000, '2017-11-03 10:54:46', 0, '0000-00-00 00:00:00'),
(10326, 'db_invoice', 97, '', 'Insert', 'invoice_no => IV/700100062<br>invoice_date => 2017-11-03<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => 94554817<br>invoice_fax => 94554817<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => William<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>', 'Insert Sales Invoice.<br> Document No : IV/700100062', 10000, '2017-11-03 10:55:50', 0, '0000-00-00 00:00:00'),
(10327, 'db_invl', 199, '', 'Insert', 'invl_invoice_id => 97<br>invl_pro_id => 1<br>invl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 15.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 15<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 15<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => Florida, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100062', 10000, '2017-11-03 10:55:56', 0, '0000-00-00 00:00:00'),
(10328, 'db_invoice', 97, '', 'Update', 'invoice_subtotal => 15.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 1.05<br>invoice_grandtotal => 16.05<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100062', 10000, '2017-11-03 10:55:56', 0, '0000-00-00 00:00:00'),
(10329, 'db_invl', 200, '', 'Insert', 'invl_invoice_id => 97<br>invl_pro_id => 5<br>invl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 28.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 28<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 28<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => New York, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100062', 10000, '2017-11-03 10:55:59', 0, '0000-00-00 00:00:00'),
(10330, 'db_invoice', 97, '', 'Update', 'invoice_subtotal => 43.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 3.01<br>invoice_grandtotal => 46.01<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100062', 10000, '2017-11-03 10:55:59', 0, '0000-00-00 00:00:00'),
(10331, 'db_invl', 201, '', 'Insert', 'invl_invoice_id => 97<br>invl_pro_id => 9<br>invl_pro_desc => 3/8&quot;, NPT, 7050-01 (from New York)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 52.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 52<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 52<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => New York, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/700100062', 10000, '2017-11-03 10:56:04', 0, '0000-00-00 00:00:00'),
(10332, 'db_invoice', 97, '', 'Update', 'invoice_subtotal => 95.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 6.65<br>invoice_grandtotal => 101.65<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100062', 10000, '2017-11-03 10:56:04', 0, '0000-00-00 00:00:00'),
(10333, 'db_invoice', 97, '', 'Update', 'invoice_date => 2017-11-03<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 94554817<br>invoice_fax => 94554817<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => alvapierre@hotmail.com<br>invoice_attentionto_name => William<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-11-03 10:56:07', 0, '0000-00-00 00:00:00'),
(10334, 'db_invoice', 97, '', 'Update', 'invoice_subtotal => 95.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 6.65<br>invoice_grandtotal => 101.65<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100062', 10000, '2017-11-03 10:56:07', 0, '0000-00-00 00:00:00'),
(10335, 'db_order', 151, '', 'Insert', 'order_no => DO/00047-17<br>order_date => 2017-11-03<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 97<br>order_outlet => -1<br>order_attentionto_phone => 94554817<br>order_fax => 94554817<br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => alvapierre@hotmail.com<br>order_attentionto_name => William<br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00047-17', 10000, '2017-11-03 10:56:17', 0, '0000-00-00 00:00:00'),
(10336, 'db_order', 151, '', 'Update', 'order_subtotal => 95.0000<br>order_disctotal => 0.00<br>order_taxtotal => 6.65<br>order_grandtotal => 101.65<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00047-17', 10000, '2017-11-03 10:56:17', 0, '0000-00-00 00:00:00'),
(10337, 'db_ordl', 466, '', 'Insert', 'ordl_order_id => 151<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 199<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00047-17', 10000, '2017-11-03 10:56:17', 0, '0000-00-00 00:00:00'),
(10338, 'db_ordl', 467, '', 'Insert', 'ordl_order_id => 151<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 200<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00047-17', 10000, '2017-11-03 10:56:17', 0, '0000-00-00 00:00:00'),
(10339, 'db_ordl', 468, '', 'Insert', 'ordl_order_id => 151<br>ordl_pro_id => 9<br>ordl_pro_desc => 3/8&quot;, NPT, 7050-01 (from New York)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 52.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 201<br>ordl_fuprice => 52.00<br>ordl_ftotal => 52.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00047-17', 10000, '2017-11-03 10:56:17', 0, '0000-00-00 00:00:00'),
(10340, 'db_order', 152, '', 'Insert', 'order_no => PU/00046-17<br>order_date => 2017-11-03<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 151<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 94554817<br>order_fax => 94554817<br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => alvapierre@hotmail.com<br>order_attentionto_name => William<br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10341, 'db_order', 152, '', 'Update', 'order_subtotal => 95.0000<br>order_disctotal => 0.00<br>order_taxtotal => 6.65<br>order_grandtotal => 101.65<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10342, 'db_ordl', 469, '', 'Insert', 'ordl_order_id => 152<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 466<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10343, 'db_stock_transaction', 33841, '', 'Insert', 'documentline_id => 469<br>ref_id => 152<br>quantity => 1.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 95<br>document_date => 2017-11-03<br>', 'Insert 1 transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10344, 'db_product', 1, '', 'Update', 'product_stock => 45<br>', 'Update 1 stock transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10345, 'db_ordl', 470, '', 'Insert', 'ordl_order_id => 152<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 467<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10346, 'db_stock_transaction', 33842, '', 'Insert', 'documentline_id => 470<br>ref_id => 152<br>quantity => 1.00<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 95<br>document_date => 2017-11-03<br>', 'Insert 5 transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10347, 'db_product', 5, '', 'Update', 'product_stock => 32<br>', 'Update 5 stock transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10348, 'db_ordl', 471, '', 'Insert', 'ordl_order_id => 152<br>ordl_pro_id => 9<br>ordl_pro_desc => 3/8&quot;, NPT, 7050-01 (from New York)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 52.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 468<br>ordl_fuprice => 52.00<br>ordl_ftotal => 52.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:29', 0, '0000-00-00 00:00:00'),
(10349, 'db_stock_transaction', 33843, '', 'Insert', 'documentline_id => 471<br>ref_id => 152<br>quantity => 1.00<br>type => OUT<br>item_id => 9<br>uom => 8<br>cost => 50.00<br>custsupp_id => 95<br>document_date => 2017-11-03<br>', 'Insert 9 transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:30', 0, '0000-00-00 00:00:00'),
(10350, 'db_product', 9, '', 'Update', 'product_stock => 18<br>', 'Update 9 stock transaction.<br> Document No : PU/00046-17', 10000, '2017-11-03 10:56:30', 0, '0000-00-00 00:00:00'),
(10351, 'db_order', 153, '', 'Insert', 'order_no => PO/171100090<br>order_date => 2017-11-03<br>order_customer => 92<br>order_salesperson => 15<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => <br>order_term => <br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => PO<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => <br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc => <br>', 'Insert Purchase Order.<br> Document No : PO/171100090', 10000, '2017-11-03 10:57:17', 0, '0000-00-00 00:00:00'),
(10352, 'db_ordl', 472, '', 'Insert', 'ordl_order_id => 153<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 12<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 12.00<br>ordl_ftotal => 12<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Purchase Order Line.<br> Document No : PO/171100090', 10000, '2017-11-03 10:57:27', 0, '0000-00-00 00:00:00'),
(10353, 'db_order', 153, '', 'Update', 'order_subtotal => 12.0000<br>order_disctotal => 0.00<br>order_taxtotal => 0.84<br>order_grandtotal => 12.84<br>order_discheadertotal => 0.00<br>', 'Update Purchase Order.<br> Document No : PO/171100090', 10000, '2017-11-03 10:57:27', 0, '0000-00-00 00:00:00'),
(10354, 'db_ordl', 473, '', 'Insert', 'ordl_order_id => 153<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 20.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 20<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 20.00<br>ordl_ftotal => 20<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Purchase Order Line.<br> Document No : PO/171100090', 10000, '2017-11-03 11:00:05', 0, '0000-00-00 00:00:00'),
(10355, 'db_order', 153, '', 'Update', 'order_subtotal => 32.0000<br>order_disctotal => 0.00<br>order_taxtotal => 2.24<br>order_grandtotal => 34.24<br>order_discheadertotal => 0.00<br>', 'Update Purchase Order.<br> Document No : PO/171100090', 10000, '2017-11-03 11:00:05', 0, '0000-00-00 00:00:00'),
(10356, 'db_order', 154, '', 'Insert', 'order_no => KC/0027/17-11<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => 1<br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email =>  <br>order_attentionto_name =>  c <br>order_tnc => <br>', 'Insert Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:02:04', 0, '0000-00-00 00:00:00'),
(10357, 'db_ordl', 474, '', 'Insert', 'ordl_order_id => 154<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 70.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 70<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 70.00<br>ordl_ftotal => 70<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:02:21', 0, '0000-00-00 00:00:00'),
(10358, 'db_order', 154, '', 'Update', 'order_subtotal => 70.0000<br>order_disctotal => 0.00<br>order_taxtotal => 4.9<br>order_grandtotal => 74.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:02:21', 0, '0000-00-00 00:00:00'),
(10359, 'db_ordl', 475, '', 'Insert', 'ordl_order_id => 154<br>ordl_pro_id => 6<br>ordl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>ordl_qty => 5<br>ordl_uom => 13<br>ordl_uprice => 200.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 1000<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 200.00<br>ordl_ftotal => 1000<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:02:34', 0, '0000-00-00 00:00:00'),
(10360, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 0.00<br>order_taxtotal => 74.9<br>order_grandtotal => 1144.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:02:34', 0, '0000-00-00 00:00:00'),
(10361, 'db_ordl', 475, '', 'Update', 'ordl_order_id => 154<br>ordl_pro_id => 6<br>ordl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>ordl_qty => 5.00<br>ordl_uom => 13<br>ordl_uprice => 0<br>ordl_disc => 10.00<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 900<br>ordl_pro_no => <br>ordl_discamt => 100<br>ordl_seqno => 10<br>ordl_fuprice => 200.00<br>ordl_pfuprice => <br>ordl_ftotal => 900<br>ordl_fdiscamt => 100<br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Update Quotation Line.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:03:12', 0, '0000-00-00 00:00:00'),
(10362, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 100.00<br>order_taxtotal => 67.9<br>order_grandtotal => 1037.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:03:12', 0, '0000-00-00 00:00:00'),
(10363, 'db_order', 154, '', 'Update', 'order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => <br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email =>  <br>order_attentionto_name =>  c <br>order_tnc => <br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:03:55', 0, '0000-00-00 00:00:00'),
(10364, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 100.00<br>order_taxtotal => 67.9<br>order_grandtotal => 1037.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:03:55', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10365, 'db_order', 154, '', 'Update', 'order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => <br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => <br>order_country_id => 33<br>order_attentionto_email =>  <br>order_attentionto_name =>  c <br>order_tnc => <br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:04:10', 0, '0000-00-00 00:00:00'),
(10366, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 100.00<br>order_taxtotal => 67.9<br>order_grandtotal => 1037.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:04:10', 0, '0000-00-00 00:00:00'),
(10367, 'db_order', 154, '', 'Update', 'order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => <br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 1<br>order_country_id => 33<br>order_attentionto_email =>  <br>order_attentionto_name =>  c <br>order_tnc => <br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:06:30', 0, '0000-00-00 00:00:00'),
(10368, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 100.00<br>order_taxtotal => 67.9<br>order_grandtotal => 1037.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:06:30', 0, '0000-00-00 00:00:00'),
(10369, 'db_order', 154, '', 'Update', 'order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => 1<br>order_freightcharge_id => 2<br>order_pointofdelivery_id => 1<br>order_prefix_id => 1<br>order_remarks_id => 1<br>order_country_id => 33<br>order_attentionto_email =>  <br>order_attentionto_name => Jason<br>order_tnc => <br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:10:45', 0, '0000-00-00 00:00:00'),
(10370, 'db_order', 154, '', 'Update', 'order_subtotal => 1070.0000<br>order_disctotal => 100.00<br>order_taxtotal => 67.9<br>order_grandtotal => 1037.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:10:45', 0, '0000-00-00 00:00:00'),
(10371, 'db_ordl', 476, '', 'Insert', 'ordl_order_id => 154<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 13<br>ordl_uprice => 120.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 120<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 120.00<br>ordl_ftotal => 120<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Quotation Line.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:31:51', 0, '0000-00-00 00:00:00'),
(10372, 'db_order', 154, '', 'Update', 'order_subtotal => 1190.0000<br>order_disctotal => 100.00<br>order_taxtotal => 76.3<br>order_grandtotal => 1166.3<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0027/17-11', 10000, '2017-11-03 11:31:51', 0, '0000-00-00 00:00:00'),
(10373, 'db_invoice', 98, '', 'Insert', 'invoice_no => IV/171100063<br>invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 0<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 27<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 2<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 154<br>invoice_outlet => -1<br>invoice_attentionto_phone =>  c c<br>invoice_fax => c c <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 1<br>invoice_freightcharge_id => 2<br>invoice_pointofdelivery_id => 1<br>invoice_prefix_id => 1<br>invoice_remarks_id => 1<br>invoice_country_id => 33<br>invoice_generate_from_type => QT<br>invoice_attentionto_email =>  <br>invoice_attentionto_name => Jason<br>invoice_regards => <br>invoice_tnc => <br>', 'Insert Sales Invoice.<br> Document No : IV/171100063', 10000, '2017-11-03 11:32:03', 0, '0000-00-00 00:00:00'),
(10374, 'db_invoice', 98, '', 'Update', 'invoice_subtotal => 1190.0000<br>invoice_disctotal => 100.00<br>invoice_taxtotal => 76.3<br>invoice_grandtotal => 1166.3<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171100063', 10000, '2017-11-03 11:32:03', 0, '0000-00-00 00:00:00'),
(10375, 'db_invl', 202, '', 'Insert', 'invl_invoice_id => 98<br>invl_pro_id => 8<br>invl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 70.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 70.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 474<br>invl_fuprice => 70.00<br>invl_ftotal => 70.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => California, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100063', 10000, '2017-11-03 11:32:03', 0, '0000-00-00 00:00:00'),
(10376, 'db_invl', 203, '', 'Insert', 'invl_invoice_id => 98<br>invl_pro_id => 6<br>invl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>invl_qty => 5.00<br>invl_uom => 13<br>invl_uprice => 0.00<br>invl_disc => 10.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 900.00<br>invl_pro_no => <br>invl_discamt => 100.00<br>invl_seqno => 10<br>invl_parent => 475<br>invl_fuprice => 200.00<br>invl_ftotal => 900.00<br>invl_fdiscamt => 100.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => <br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100063', 10000, '2017-11-03 11:32:03', 0, '0000-00-00 00:00:00'),
(10377, 'db_invl', 204, '', 'Insert', 'invl_invoice_id => 98<br>invl_pro_id => 34<br>invl_pro_desc => Impeller<br>invl_qty => 1.00<br>invl_uom => 13<br>invl_uprice => 120.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 120.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 476<br>invl_fuprice => 120.00<br>invl_ftotal => 120.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => package<br>invl_product_location => <br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100063', 10000, '2017-11-03 11:32:03', 0, '0000-00-00 00:00:00'),
(10378, 'db_invoice', 98, '', 'Update', 'invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 27<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 2.0000<br>invoice_status => 1<br>invoice_attentionto_phone =>  c c<br>invoice_fax => c c <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email =>  <br>invoice_attentionto_name => Jason<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-11-03 11:41:28', 0, '0000-00-00 00:00:00'),
(10379, 'db_invoice', 98, '', 'Update', 'invoice_subtotal => 1190.0000<br>invoice_disctotal => 100.00<br>invoice_taxtotal => 76.3<br>invoice_grandtotal => 1166.3<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171100063', 10000, '2017-11-03 11:41:28', 0, '0000-00-00 00:00:00'),
(10380, 'db_order', 155, '', 'Insert', 'order_no => DO/00048-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 2<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 98<br>order_outlet => -1<br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email =>  <br>order_attentionto_name => Jason<br>order_regards => <br>order_tnc => <br>', 'Insert Delivery Order.<br> Document No : DO/00048-17', 10000, '2017-11-03 11:43:59', 0, '0000-00-00 00:00:00'),
(10381, 'db_order', 155, '', 'Update', 'order_subtotal => 1190.0000<br>order_disctotal => 100.00<br>order_taxtotal => 76.3<br>order_grandtotal => 1166.3<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00048-17', 10000, '2017-11-03 11:43:59', 0, '0000-00-00 00:00:00'),
(10382, 'db_ordl', 477, '', 'Insert', 'ordl_order_id => 155<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 70.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 70.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 202<br>ordl_fuprice => 70.00<br>ordl_ftotal => 70.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00048-17', 10000, '2017-11-03 11:43:59', 0, '0000-00-00 00:00:00'),
(10383, 'db_ordl', 478, '', 'Insert', 'ordl_order_id => 155<br>ordl_pro_id => 6<br>ordl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>ordl_qty => 5.00<br>ordl_uom => 13<br>ordl_uprice => 0.00<br>ordl_disc => 10.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 900.00<br>ordl_pro_no => <br>ordl_discamt => 100.00<br>ordl_seqno => 10<br>ordl_parent => 203<br>ordl_fuprice => 200.00<br>ordl_ftotal => 900.00<br>ordl_fdiscamt => 100.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00048-17', 10000, '2017-11-03 11:43:59', 0, '0000-00-00 00:00:00'),
(10384, 'db_ordl', 479, '', 'Insert', 'ordl_order_id => 155<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 13<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 204<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00048-17', 10000, '2017-11-03 11:43:59', 0, '0000-00-00 00:00:00'),
(10385, 'db_order', 156, '', 'Insert', 'order_no => PU/00047-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 27<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 2<br>order_currencyrate => 2.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 155<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone =>  c c<br>order_fax => c c <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email =>  <br>order_attentionto_name => Jason<br>order_tnc => <br>', 'Insert Pickup List.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:23', 0, '0000-00-00 00:00:00'),
(10386, 'db_order', 156, '', 'Update', 'order_subtotal => 1190.0000<br>order_disctotal => 100.00<br>order_taxtotal => 76.3<br>order_grandtotal => 1166.3<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:23', 0, '0000-00-00 00:00:00'),
(10387, 'db_ordl', 480, '', 'Insert', 'ordl_order_id => 156<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 70.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 70.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 477<br>ordl_fuprice => 70.00<br>ordl_ftotal => 70.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:23', 0, '0000-00-00 00:00:00'),
(10388, 'db_stock_transaction', 33844, '', 'Insert', 'documentline_id => 480<br>ref_id => 156<br>quantity => 1.00<br>type => OUT<br>item_id => 8<br>uom => 8<br>cost => 60.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 8 transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10389, 'db_product', 8, '', 'Update', 'product_stock => 11<br>', 'Update 8 stock transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10390, 'db_ordl', 481, '', 'Insert', 'ordl_order_id => 156<br>ordl_pro_id => 6<br>ordl_pro_desc => 1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)<br>ordl_qty => 5.00<br>ordl_uom => 13<br>ordl_uprice => 0.00<br>ordl_disc => 10.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 900.00<br>ordl_pro_no => <br>ordl_discamt => 100.00<br>ordl_seqno => 10<br>ordl_parent => 478<br>ordl_fuprice => 200.00<br>ordl_ftotal => 900.00<br>ordl_fdiscamt => 100.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10391, 'db_stock_transaction', 33845, '', 'Insert', 'documentline_id => 481<br>ref_id => 156<br>quantity => 5.00<br>type => OUT<br>item_id => 6<br>uom => 13<br>cost => 80.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 6 transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10392, 'db_product', 6, '', 'Update', 'product_stock => 75<br>', 'Update 6 stock transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10393, 'db_ordl', 482, '', 'Insert', 'ordl_order_id => 156<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 13<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 479<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10394, 'db_stock_transaction', 33846, '', 'Insert', 'documentline_id => 482<br>ref_id => 156<br>quantity => 2<br>type => OUT<br>item_id => 1<br>uom => 13<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10395, 'db_product', 1, '', 'Update', 'product_stock => 43<br>', 'Update 1 stock transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10396, 'db_stock_transaction', 33847, '', 'Insert', 'documentline_id => 482<br>ref_id => 156<br>quantity => 3<br>type => OUT<br>item_id => 5<br>uom => 13<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10397, 'db_product', 5, '', 'Update', 'product_stock => 29<br>', 'Update 5 stock transaction.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:24', 0, '0000-00-00 00:00:00'),
(10398, 'db_order', 156, '', 'Update', 'order_status => <br>', 'Update Pickup List.<br> Document No : PU/00047-17', 10000, '2017-11-03 11:44:49', 0, '0000-00-00 00:00:00'),
(10399, 'db_order', 152, '', 'Update', 'order_status => <br>', 'Update Pickup List.<br> Document No : PU/00046-17', 10000, '2017-11-03 11:45:25', 0, '0000-00-00 00:00:00'),
(10400, 'db_order', 146, '', 'Update', 'order_status => <br>', 'Update Pickup List.<br> Document No : PU/00044-17', 10000, '2017-11-03 11:45:42', 0, '0000-00-00 00:00:00'),
(10401, 'db_remarks', 5, '', 'Insert', 'remarks_code => QT01<br>remarks_desc => We trust that you will find our quotation acceptable and look forward to receive your confirmation soon.\r\n\r\nBest Regards<br>remarks_seqno => 21<br>remarks_status => 1<br>', 'Insert Remarks.', 10000, '2017-11-03 16:33:37', 0, '0000-00-00 00:00:00'),
(10402, 'db_remarks', 6, '', 'Insert', 'remarks_code => PO01<br>remarks_desc => Please advise the weight &amp; dimension of our orders when ready. We will advise our shipping instructions later.\r\n\r\nAwaiting your prompt acknowledgement.\r\n\r\nBest Regards<br>remarks_seqno => 31<br>remarks_status => 1<br>', 'Insert Remarks.', 10000, '2017-11-03 16:34:07', 0, '0000-00-00 00:00:00'),
(10403, 'db_order', 157, '', 'Insert', 'order_no => KC/0028/17-11<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 23<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 81366729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Thank you for your inquiry dated 3-Nov-2017, we are pleased to quote as follows : <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => 32<br>order_attentionto_email => emily@alphadesign.com.sg<br>order_attentionto_name => Emily<br>order_tnc => <br>order_notes => KC/0028/17-11 for Emily<br>', 'Insert Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:35:46', 0, '0000-00-00 00:00:00'),
(10404, 'db_order', 157, '', 'Update', 'order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 23<br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 81366729<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-11-03<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Thank you for your inquiry dated 3-Nov-2017, we are pleased to quote as follows : <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 5<br>order_country_id => 32<br>order_attentionto_email => emily@alphadesign.com.sg<br>order_attentionto_name => Emily<br>order_tnc => <br>order_notes => KC/0028/17-11 for Emily<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:35:54', 0, '0000-00-00 00:00:00'),
(10405, 'db_order', 157, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:35:54', 0, '0000-00-00 00:00:00'),
(10406, 'db_ordl', 483, '', 'Insert', 'ordl_order_id => 157<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 15<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 15.00<br>ordl_ftotal => 15<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:03', 0, '0000-00-00 00:00:00'),
(10407, 'db_order', 157, '', 'Update', 'order_subtotal => 15.0000<br>order_disctotal => 0.00<br>order_taxtotal => 1.05<br>order_grandtotal => 16.05<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:03', 0, '0000-00-00 00:00:00'),
(10408, 'db_ordl', 484, '', 'Insert', 'ordl_order_id => 157<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 28<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 28.00<br>ordl_ftotal => 28<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:08', 0, '0000-00-00 00:00:00'),
(10409, 'db_order', 157, '', 'Update', 'order_subtotal => 43.0000<br>order_disctotal => 0.00<br>order_taxtotal => 3.01<br>order_grandtotal => 46.01<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:08', 0, '0000-00-00 00:00:00'),
(10410, 'db_ordl', 485, '', 'Insert', 'ordl_order_id => 157<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 120<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 120.00<br>ordl_ftotal => 120<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Quotation Line.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:13', 0, '0000-00-00 00:00:00'),
(10411, 'db_order', 157, '', 'Update', 'order_subtotal => 163.0000<br>order_disctotal => 0.00<br>order_taxtotal => 11.41<br>order_grandtotal => 174.41<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:13', 0, '0000-00-00 00:00:00'),
(10412, 'db_ordl', 486, '', 'Insert', 'ordl_order_id => 157<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 15<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 15.00<br>ordl_ftotal => 15<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:19', 0, '0000-00-00 00:00:00'),
(10413, 'db_order', 157, '', 'Update', 'order_subtotal => 178.0000<br>order_disctotal => 0.00<br>order_taxtotal => 12.46<br>order_grandtotal => 190.46<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:20', 0, '0000-00-00 00:00:00'),
(10414, 'db_ordl', 487, '', 'Insert', 'ordl_order_id => 157<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 28<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 28.00<br>ordl_ftotal => 28<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:23', 0, '0000-00-00 00:00:00'),
(10415, 'db_order', 157, '', 'Update', 'order_subtotal => 206.0000<br>order_disctotal => 0.00<br>order_taxtotal => 14.42<br>order_grandtotal => 220.42<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0028/17-11', 10000, '2017-11-03 16:36:23', 0, '0000-00-00 00:00:00'),
(10416, 'db_invoice', 99, '', 'Insert', 'invoice_no => IV/171100064<br>invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 23<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 4<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 157<br>invoice_outlet => -1<br>invoice_attentionto_phone => 81366729<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 5<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => emily@alphadesign.com.sg<br>invoice_attentionto_name => Emily<br>invoice_regards => Thank you for your inquiry dated 3-Nov-2017, we are pleased to quote as follows : <br>invoice_tnc => <br>invoice_notes => KC/0028/17-11 for Emily<br>', 'Insert Sales Invoice.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:04', 0, '0000-00-00 00:00:00'),
(10417, 'db_invoice', 99, '', 'Update', 'invoice_subtotal => 206.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 14.42<br>invoice_grandtotal => 220.42<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:04', 0, '0000-00-00 00:00:00'),
(10418, 'db_invl', 205, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 1<br>invl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 15.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 15.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 483<br>invl_fuprice => 15.00<br>invl_ftotal => 15.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => Florida, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:04', 0, '0000-00-00 00:00:00'),
(10419, 'db_invl', 206, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 5<br>invl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 28.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 28.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 484<br>invl_fuprice => 28.00<br>invl_ftotal => 28.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => New York, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:04', 0, '0000-00-00 00:00:00'),
(10420, 'db_invl', 207, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 34<br>invl_pro_desc => Impeller<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 120.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 120.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 485<br>invl_fuprice => 120.00<br>invl_ftotal => 120.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => package<br>invl_product_location => <br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:05', 0, '0000-00-00 00:00:00'),
(10421, 'db_invl', 208, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 1<br>invl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 15.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 15.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 486<br>invl_fuprice => 15.00<br>invl_ftotal => 15.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => Florida, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:05', 0, '0000-00-00 00:00:00'),
(10422, 'db_invl', 209, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 5<br>invl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>invl_qty => 1.00<br>invl_uom => 8<br>invl_uprice => 28.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 28.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 487<br>invl_fuprice => 28.00<br>invl_ftotal => 28.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => New York, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:05', 0, '0000-00-00 00:00:00'),
(10423, 'db_invl', 210, '', 'Insert', 'invl_invoice_id => 99<br>invl_pro_id => 34<br>invl_pro_desc => Impeller<br>invl_qty => 2.00<br>invl_uom => 8<br>invl_uprice => 0<br>invl_fuprice => 120.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 240<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 240<br>invl_pro_remark => <br>invl_item_type => package<br>invl_product_location => <br>', 'Insert Sales Invoice Line.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:32', 0, '0000-00-00 00:00:00'),
(10424, 'db_invoice', 99, '', 'Update', 'invoice_subtotal => 446.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 31.22<br>invoice_grandtotal => 477.22<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:32', 0, '0000-00-00 00:00:00'),
(10425, 'db_invoice', 99, '', 'Update', 'invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 23<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => PO000012A<br>invoice_currency => 4<br>invoice_currencyrate => 4.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 81366729<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => emily@alphadesign.com.sg<br>invoice_attentionto_name => Emily<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-11-03 16:37:46', 0, '0000-00-00 00:00:00'),
(10426, 'db_invoice', 99, '', 'Update', 'invoice_subtotal => 446.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 31.22<br>invoice_grandtotal => 477.22<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171100064', 10000, '2017-11-03 16:37:47', 0, '0000-00-00 00:00:00'),
(10427, 'db_invoice', 99, '', 'Update', 'invoice_date => 2017-11-03<br>invoice_customer => 93<br>invoice_salesperson => 13<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 23<br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => PO000012A<br>invoice_currency => 4<br>invoice_currencyrate => 4.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 81366729<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => emily@alphadesign.com.sg<br>invoice_attentionto_name => Emily<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-11-03 16:38:20', 0, '0000-00-00 00:00:00'),
(10428, 'db_invoice', 99, '', 'Update', 'invoice_subtotal => 446.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 31.22<br>invoice_grandtotal => 477.22<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171100064', 10000, '2017-11-03 16:38:20', 0, '0000-00-00 00:00:00'),
(10429, 'db_order', 158, '', 'Insert', 'order_no => DO/00049-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 23<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => PO000012A<br>order_currency => 4<br>order_currencyrate => 4<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 99<br>order_outlet => -1<br>order_attentionto_phone => 81366729<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => emily@alphadesign.com.sg<br>order_attentionto_name => Emily<br>order_regards => <br>order_tnc => <br>order_notes => KC/0028/17-11 for Emily<br>', 'Insert Delivery Order.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10430, 'db_order', 158, '', 'Update', 'order_subtotal => 446.0000<br>order_disctotal => 0.00<br>order_taxtotal => 31.22<br>order_grandtotal => 477.22<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10431, 'db_ordl', 488, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 205<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10432, 'db_ordl', 489, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 206<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10433, 'db_ordl', 490, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 207<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10434, 'db_ordl', 491, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 208<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10435, 'db_ordl', 492, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 209<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:29', 0, '0000-00-00 00:00:00'),
(10436, 'db_ordl', 493, '', 'Insert', 'ordl_order_id => 158<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 240.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 210<br>ordl_fuprice => 120.00<br>ordl_ftotal => 240.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Invoice<br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Delivery Order Line.<br> Document No : DO/00049-17', 10000, '2017-11-03 16:38:30', 0, '0000-00-00 00:00:00'),
(10437, 'db_order', 159, '', 'Insert', 'order_no => PU/00048-17<br>order_date => 2017-11-03<br>order_customer => 93<br>order_salesperson => 13<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 23<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => PO000012A<br>order_currency => 4<br>order_currencyrate => 4.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 158<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81366729<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => emily@alphadesign.com.sg<br>order_attentionto_name => Emily<br>order_tnc => <br>order_notes => KC/0028/17-11 for Emily<br>', 'Insert Pickup List.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:32', 0, '0000-00-00 00:00:00'),
(10438, 'db_order', 159, '', 'Update', 'order_subtotal => 446.0000<br>order_disctotal => 0.00<br>order_taxtotal => 31.22<br>order_grandtotal => 477.22<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10439, 'db_ordl', 494, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 488<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10440, 'db_stock_transaction', 33848, '', 'Insert', 'documentline_id => 494<br>ref_id => 159<br>quantity => 1.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 1 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10441, 'db_product', 1, '', 'Update', 'product_stock => 42<br>', 'Update 1 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10442, 'db_ordl', 495, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 489<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10443, 'db_stock_transaction', 33849, '', 'Insert', 'documentline_id => 495<br>ref_id => 159<br>quantity => 1.00<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 5 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10444, 'db_product', 5, '', 'Update', 'product_stock => 28<br>', 'Update 5 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:33', 0, '0000-00-00 00:00:00'),
(10445, 'db_ordl', 496, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 120.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 120.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 490<br>ordl_fuprice => 120.00<br>ordl_ftotal => 120.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10446, 'db_stock_transaction', 33850, '', 'Insert', 'documentline_id => 496<br>ref_id => 159<br>quantity => 2<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10447, 'db_product', 1, '', 'Update', 'product_stock => 40<br>', 'Update 1 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10448, 'db_stock_transaction', 33851, '', 'Insert', 'documentline_id => 496<br>ref_id => 159<br>quantity => 3<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10449, 'db_product', 5, '', 'Update', 'product_stock => 25<br>', 'Update 5 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10450, 'db_ordl', 497, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 15.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 15.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 491<br>ordl_fuprice => 15.00<br>ordl_ftotal => 15.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:34', 0, '0000-00-00 00:00:00'),
(10451, 'db_stock_transaction', 33852, '', 'Insert', 'documentline_id => 497<br>ref_id => 159<br>quantity => 1.00<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 1 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10452, 'db_product', 1, '', 'Update', 'product_stock => 39<br>', 'Update 1 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10453, 'db_ordl', 498, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 28.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 28.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 492<br>ordl_fuprice => 28.00<br>ordl_ftotal => 28.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10454, 'db_stock_transaction', 33853, '', 'Insert', 'documentline_id => 498<br>ref_id => 159<br>quantity => 1.00<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 5 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10455, 'db_product', 5, '', 'Update', 'product_stock => 24<br>', 'Update 5 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10456, 'db_ordl', 499, '', 'Insert', 'ordl_order_id => 159<br>ordl_pro_id => 34<br>ordl_pro_desc => Impeller<br>ordl_qty => 2.00<br>ordl_uom => 8<br>ordl_uprice => 0.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 240.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 0<br>ordl_parent => 493<br>ordl_fuprice => 120.00<br>ordl_ftotal => 240.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => package<br>ordl_product_location => <br>', 'Insert Pickup List Line.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10457, 'db_stock_transaction', 33854, '', 'Insert', 'documentline_id => 499<br>ref_id => 159<br>quantity => 4<br>type => OUT<br>item_id => 1<br>uom => 8<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:35', 0, '0000-00-00 00:00:00'),
(10458, 'db_product', 1, '', 'Update', 'product_stock => 35<br>', 'Update 1 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:36', 0, '0000-00-00 00:00:00'),
(10459, 'db_stock_transaction', 33855, '', 'Insert', 'documentline_id => 499<br>ref_id => 159<br>quantity => 6<br>type => OUT<br>item_id => 5<br>uom => 8<br>cost => <br>custsupp_id => 93<br>document_date => 2017-11-03<br>', 'Insert 34 transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:36', 0, '0000-00-00 00:00:00'),
(10460, 'db_product', 5, '', 'Update', 'product_stock => 18<br>', 'Update 5 stock transaction.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:39:36', 0, '0000-00-00 00:00:00'),
(10461, 'db_order', 159, '', 'Update', 'order_status => 1<br>', 'Update Pickup List.<br> Document No : PU/00048-17', 10000, '2017-11-03 16:42:16', 0, '0000-00-00 00:00:00'),
(10462, 'db_product', 14, '', 'Insert', 'product_category => 9<br>product_part_no => 23502022FP<br>product_desc => Cylinder Liner<br>product_remark => <br>product_sale_price => 2<br>product_cost_price => 1<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 7E2<br>product_name => 23502022<br>product_lowstock => 12<br>', 'Insert Product.', 10000, '2017-12-13 12:05:23', 0, '0000-00-00 00:00:00'),
(10463, 'db_product', 14, '', 'Update', 'product_category => 9<br>product_part_no => 23502022FP<br>product_desc => Cylinder Liner<br>product_remark => <br>product_sale_price => 2.00<br>product_cost_price => 1.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 7E2<br>product_name => 23502022<br>product_lowstock => 12<br>', 'Update Product.', 10000, '2017-12-13 12:06:13', 0, '0000-00-00 00:00:00'),
(10464, 'db_product', 14, '', 'Update', 'product_category => 9<br>product_part_no => 23502022FP<br>product_desc => Cylinder Liner<br>product_remark => <br>product_sale_price => 2.00<br>product_cost_price => 1.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => <br>product_sub_group => <br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 7E2<br>product_name => 23502022<br>product_lowstock => 12<br>', 'Update Product.', 10000, '2017-12-13 12:07:09', 0, '0000-00-00 00:00:00'),
(10465, 'db_product', 15, '', 'Insert', 'product_category => 9<br>product_part_no => 123456fp<br>product_desc => testing<br>product_remark => <br>product_sale_price => 4<br>product_cost_price => 1<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 6e1<br>product_name => 123456<br>product_lowstock => 500<br>', 'Insert Product.', 10000, '2017-12-13 12:14:51', 0, '0000-00-00 00:00:00'),
(10466, 'db_product', 15, '', 'Update', 'product_category => 8<br>product_part_no => 123456fp<br>product_desc => testing<br>product_remark => <br>product_sale_price => 4.00<br>product_cost_price => 1.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 1<br>product_sub_group => 2<br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 6e1<br>product_name => 123456<br>product_lowstock => 500<br>', 'Update Product.', 10000, '2017-12-13 12:16:29', 0, '0000-00-00 00:00:00'),
(10467, 'db_product', 15, '', 'Update', 'product_category => 9<br>product_part_no => 123456fp<br>product_desc => testing<br>product_remark => <br>product_sale_price => 4.00<br>product_cost_price => 1.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => 0<br>product_insert_types => 0<br>product_diameter => 0.00<br>product_width_depth => 0.00<br>product_shaft_diameter => 0.00<br>product_main_group => 1<br>product_sub_group => 2<br>product_n_wt => 0.000<br>product_g_wt => 0.000<br>product_usage => <br>product_enginemodel => <br>product_stock => 0<br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => 6e1<br>product_name => 123456<br>product_lowstock => 500<br>', 'Update Product.', 10000, '2017-12-13 12:16:45', 0, '0000-00-00 00:00:00'),
(10468, 'db_product', 16, '', 'Insert', 'product_category => 10<br>product_part_no => 123456fp<br>product_desc => <br>product_remark => <br>product_sale_price => 0.00<br>product_cost_price => 0.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => <br>product_name => 123456<br>product_lowstock => <br>', 'Insert Product.', 10000, '2017-12-13 12:17:26', 0, '0000-00-00 00:00:00'),
(10469, 'db_product', 17, '', 'Insert', 'product_category => 9<br>product_part_no => 123456fp<br>product_desc => <br>product_remark => <br>product_sale_price => 0.00<br>product_cost_price => 0.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => <br>product_name => 123456<br>product_lowstock => <br>', 'Insert Product.', 10000, '2017-12-13 12:38:34', 0, '0000-00-00 00:00:00'),
(10470, 'db_package', 37, '', 'Insert', 'package_part_no => 23505022CYK<br>package_desc => Cylinder Kit<br>package_sale_price => 10<br>package_cost_price => <br>package_category => <br>package_brand => <br>package_packagetype => <br>package_outlet => <br>package_barcode => <br>package_remark => Cylinder kit c/w impeller testing<br>package_seqno => <br>package_status => 1<br>package_custom_no => <br>package_weight => <br>package_uom => <br>package_product_wastage => <br>package_labour_profit => <br>', 'Insert Package.', 10000, '2017-12-13 12:46:59', 0, '0000-00-00 00:00:00'),
(10471, 'db_package', 37, '', 'Update', 'package_part_no => 23505022CYK<br>package_desc => Cylinder Kit<br>package_sale_price => 10.00<br>package_cost_price => <br>package_category => <br>package_brand => <br>package_packagetype => <br>package_outlet => <br>package_barcode => <br>package_remark => Cylinder kit c/w impeller testing<br>package_seqno => <br>package_status => 1<br>package_custom_no => <br>package_weight => <br>package_uom => <br>package_product_wastage => <br>package_labour_profit => <br>', 'Update Package.', 10000, '2017-12-13 12:49:33', 0, '0000-00-00 00:00:00'),
(10472, 'db_order', 160, '', 'Insert', 'order_no => KC/0029/17-12<br>order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-13<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => 5<br>order_price_id => 2<br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 3<br>order_country_id => 33<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Quotation.<br> Document No : KC/0029/17-12', 10000, '2017-12-13 13:48:16', 0, '0000-00-00 00:00:00'),
(10473, 'db_order', 160, '', 'Update', 'order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-13<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => <br>order_delivery_id => 5<br>order_price_id => 2<br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 3<br>order_country_id => 33<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Update Quotation.<br> Document No : KC/0029/17-12', 10000, '2017-12-13 13:55:50', 0, '0000-00-00 00:00:00'),
(10474, 'db_order', 160, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0029/17-12', 10000, '2017-12-13 13:55:50', 0, '0000-00-00 00:00:00'),
(10475, 'db_order', 160, '', 'Update', 'order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-13<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => <br>order_delivery_id => 5<br>order_price_id => 2<br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 3<br>order_country_id => 33<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Update Quotation.<br> Document No : KC/0029/17-12', 10000, '2017-12-13 14:19:10', 0, '0000-00-00 00:00:00'),
(10476, 'db_order', 160, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0029/17-12', 10000, '2017-12-13 14:19:10', 0, '0000-00-00 00:00:00'),
(10477, 'db_invoice', 100, '', 'Insert', 'invoice_no => IV/171200065<br>invoice_date => 2017-12-13<br>invoice_customer => 93<br>invoice_salesperson => 0<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 4<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 160<br>invoice_outlet => -1<br>invoice_attentionto_phone => 62437519<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 0<br>invoice_delivery_id => 5<br>invoice_price_id => 2<br>invoice_validity_id => 0<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 3<br>invoice_country_id => 33<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => enquiry@alphadesign.com.sg<br>invoice_attentionto_name => <br>invoice_regards => <br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/171200065', 10000, '2017-12-13 14:20:03', 0, '0000-00-00 00:00:00'),
(10478, 'db_invoice', 100, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171200065', 10000, '2017-12-13 14:20:03', 0, '0000-00-00 00:00:00'),
(10479, 'db_invoice', 100, '', 'Update', 'invoice_date => 2017-12-13<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 4<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 62437519<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => enquiry@alphadesign.com.sg<br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-12-13 14:21:05', 0, '0000-00-00 00:00:00'),
(10480, 'db_invoice', 100, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/171200065', 10000, '2017-12-13 14:21:05', 0, '0000-00-00 00:00:00'),
(10481, 'db_order', 161, '', 'Insert', 'order_no => DO/00050-17<br>order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 100<br>order_outlet => -1<br>order_attentionto_phone => 62437519<br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_regards => <br>order_tnc => <br>order_notes => <br>', 'Insert Delivery Order.<br> Document No : DO/00050-17', 10000, '2017-12-13 14:21:26', 0, '0000-00-00 00:00:00'),
(10482, 'db_order', 161, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00050-17', 10000, '2017-12-13 14:21:26', 0, '0000-00-00 00:00:00'),
(10483, 'db_order', 162, '', 'Insert', 'order_no => PU/00049-17<br>order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 161<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Pickup List.<br> Document No : PU/00049-17', 10000, '2017-12-13 14:21:54', 0, '0000-00-00 00:00:00'),
(10484, 'db_order', 162, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00049-17', 10000, '2017-12-13 14:21:54', 0, '0000-00-00 00:00:00'),
(10485, 'db_invoice', 101, '', 'Insert', 'invoice_no => CN00010<br>invoice_date => 2017-12-13<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SCN<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => <br>', 'Insert Credit Note.<br> Document No : CN00010', 10000, '2017-12-13 14:22:14', 0, '0000-00-00 00:00:00'),
(10486, 'db_invoice', 101, '', 'Update', 'invoice_date => 2017-12-13<br>invoice_customer => 93<br>invoice_salesperson => <br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => <br>', 'Update Credit Note.<br> Document No : ', 10000, '2017-12-13 14:22:28', 0, '0000-00-00 00:00:00'),
(10487, 'db_invoice', 101, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update Credit Note.<br> Document No : CN00010', 10000, '2017-12-13 14:22:28', 0, '0000-00-00 00:00:00'),
(10488, 'db_order', 163, '', 'Insert', 'order_no => KC/0030/17-12<br>order_date => 2017-12-13<br>order_customer => 93<br>order_salesperson => <br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-13<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Quotation.<br> Document No : KC/0030/17-12', 10000, '2017-12-13 14:25:47', 0, '0000-00-00 00:00:00'),
(10489, 'db_invoice', 102, '', 'Insert', 'invoice_no => IV/171200066<br>invoice_date => 2017-12-13<br>invoice_customer => 93<br>invoice_salesperson => 0<br>invoice_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 163<br>invoice_outlet => -1<br>invoice_attentionto_phone => 62437519<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 0<br>invoice_delivery_id => 0<br>invoice_price_id => 0<br>invoice_validity_id => 0<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 0<br>invoice_country_id => 0<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => enquiry@alphadesign.com.sg<br>invoice_attentionto_name => <br>invoice_regards => <br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/171200066', 10000, '2017-12-13 14:26:02', 0, '0000-00-00 00:00:00'),
(10490, 'db_invoice', 102, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171200066', 10000, '2017-12-13 14:26:02', 0, '0000-00-00 00:00:00'),
(10491, 'db_order', 164, '', 'Insert', 'order_no => GRN00085<br>order_date => 2017-12-13<br>order_customer => 92<br>order_salesperson => 15<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => GRN<br>order_generate_from => 153<br>order_generate_from_type => PO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc => <br>order_notes => <br>', 'Insert Goods Received Note.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:42', 0, '0000-00-00 00:00:00'),
(10492, 'db_order', 164, '', 'Update', 'order_subtotal => 32.0000<br>order_disctotal => 0.00<br>order_taxtotal => 2.24<br>order_grandtotal => 34.24<br>order_discheadertotal => 0.00<br>', 'Update Goods Received Note.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:42', 0, '0000-00-00 00:00:00'),
(10493, 'db_ordl', 500, '', 'Insert', 'ordl_order_id => 164<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 12.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 472<br>ordl_fuprice => 12.00<br>ordl_ftotal => 12.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:42', 0, '0000-00-00 00:00:00'),
(10494, 'db_stock_transaction', 33856, '', 'Insert', 'documentline_id => 500<br>ref_id => 164<br>quantity => 1.00<br>type => IN<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-12-13<br>', 'Insert 1 transaction.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:42', 0, '0000-00-00 00:00:00'),
(10495, 'db_product', 1, '', 'Update', 'product_stock => 36<br>', 'Update 1 stock transaction.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:42', 0, '0000-00-00 00:00:00'),
(10496, 'db_ordl', 501, '', 'Insert', 'ordl_order_id => 164<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 20.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 20.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 473<br>ordl_fuprice => 20.00<br>ordl_ftotal => 20.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:43', 0, '0000-00-00 00:00:00'),
(10497, 'db_stock_transaction', 33857, '', 'Insert', 'documentline_id => 501<br>ref_id => 164<br>quantity => 1.00<br>type => IN<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 92<br>document_date => 2017-12-13<br>', 'Insert 5 transaction.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:43', 0, '0000-00-00 00:00:00'),
(10498, 'db_product', 5, '', 'Update', 'product_stock => 19<br>', 'Update 5 stock transaction.<br> Document No : GRN00085', 10000, '2017-12-13 14:29:43', 0, '0000-00-00 00:00:00'),
(10499, 'db_order', 165, '', 'Insert', 'order_no => GRN00086<br>order_date => 2017-12-13<br>order_customer => 92<br>order_salesperson => 15<br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => 25<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => GRN<br>order_generate_from => 153<br>order_generate_from_type => PO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 81924589<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => felicia@cclaw.com.sg<br>order_attentionto_name => Felicia<br>order_tnc => <br>order_notes => <br>', 'Insert Goods Received Note.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:12', 0, '0000-00-00 00:00:00'),
(10500, 'db_order', 165, '', 'Update', 'order_subtotal => 32.0000<br>order_disctotal => 0.00<br>order_taxtotal => 2.24<br>order_grandtotal => 34.24<br>order_discheadertotal => 0.00<br>', 'Update Goods Received Note.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:12', 0, '0000-00-00 00:00:00'),
(10501, 'db_ordl', 502, '', 'Insert', 'ordl_order_id => 165<br>ordl_pro_id => 1<br>ordl_pro_desc => Impeller - 6000-01 (from Florida, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 12.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 12.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 472<br>ordl_fuprice => 12.00<br>ordl_ftotal => 12.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => Florida, USA<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:12', 0, '0000-00-00 00:00:00'),
(10502, 'db_stock_transaction', 33858, '', 'Insert', 'documentline_id => 502<br>ref_id => 165<br>quantity => 1.00<br>type => IN<br>item_id => 1<br>uom => 8<br>cost => 12.00<br>custsupp_id => 92<br>document_date => 2017-12-13<br>', 'Insert 1 transaction.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:12', 0, '0000-00-00 00:00:00'),
(10503, 'db_product', 1, '', 'Update', 'product_stock => 37<br>', 'Update 1 stock transaction.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:12', 0, '0000-00-00 00:00:00'),
(10504, 'db_ordl', 503, '', 'Insert', 'ordl_order_id => 165<br>ordl_pro_id => 5<br>ordl_pro_desc => Impeller - 7000-01 (from New York, USA)<br>ordl_qty => 1.00<br>ordl_uom => 8<br>ordl_uprice => 20.00<br>ordl_disc => 0.00<br>ordl_istax => 1<br>ordl_taxamt => 0.00<br>ordl_total => 20.00<br>ordl_pro_no => <br>ordl_discamt => 0.00<br>ordl_seqno => 10<br>ordl_parent => 473<br>ordl_fuprice => 20.00<br>ordl_ftotal => 20.00<br>ordl_fdiscamt => 0.00<br>ordl_ftaxamt => 0.00<br>ordl_pro_remark => <br>ordl_parent_type => Order<br>ordl_pfuprice => 0.00<br>ordl_delivery_date => 0000-00-00<br>ordl_item_type => product<br>ordl_product_location => New York, USA<br>', 'Insert Goods Received Note Line.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:13', 0, '0000-00-00 00:00:00'),
(10505, 'db_stock_transaction', 33859, '', 'Insert', 'documentline_id => 503<br>ref_id => 165<br>quantity => 1.00<br>type => IN<br>item_id => 5<br>uom => 8<br>cost => 20.00<br>custsupp_id => 92<br>document_date => 2017-12-13<br>', 'Insert 5 transaction.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:13', 0, '0000-00-00 00:00:00'),
(10506, 'db_product', 5, '', 'Update', 'product_stock => 20<br>', 'Update 5 stock transaction.<br> Document No : GRN00086', 10000, '2017-12-13 14:31:13', 0, '0000-00-00 00:00:00'),
(10507, 'db_invoice', 103, '', 'Insert', 'invoice_no => PCN00022<br>invoice_date => 2017-12-13<br>invoice_customer => 92<br>invoice_salesperson => <br>invoice_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => PCN<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => <br>', 'Insert Purchase Credit Note.<br> Document No : PCN00022', 10000, '2017-12-13 14:31:33', 0, '0000-00-00 00:00:00'),
(10508, 'db_invoice', 103, '', 'Update', 'invoice_date => 2017-12-13<br>invoice_customer => 92<br>invoice_salesperson => <br>invoice_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => <br>', 'Update Purchase Credit Note.<br> Document No : ', 10000, '2017-12-13 14:31:39', 0, '0000-00-00 00:00:00'),
(10509, 'db_invoice', 103, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update Purchase Credit Note.<br> Document No : PCN00022', 10000, '2017-12-13 14:31:39', 0, '0000-00-00 00:00:00'),
(10510, 'db_order', 166, '', 'Insert', 'order_no => KC/0031/17-12<br>order_date => 2017-12-19<br>order_customer => 95<br>order_salesperson => <br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-19<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-19 12:38:09', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10511, 'db_order', 166, '', 'Update', 'order_date => 2017-12-19<br>order_customer => 95<br>order_salesperson => <br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-19<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Update Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-19 12:38:20', 0, '0000-00-00 00:00:00'),
(10512, 'db_order', 166, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-19 12:38:20', 0, '0000-00-00 00:00:00'),
(10513, 'db_order', 167, '', 'Insert', 'order_no => PU/00050-17<br>order_date => 2017-12-19<br>order_customer => 93<br>order_salesperson => 0<br>order_billaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 4<br>order_currencyrate => 4.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 161<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => 62437519<br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => enquiry@alphadesign.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Pickup List.<br> Document No : PU/00050-17', 10000, '2017-12-19 12:45:13', 0, '0000-00-00 00:00:00'),
(10514, 'db_order', 167, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00050-17', 10000, '2017-12-19 12:45:14', 0, '0000-00-00 00:00:00'),
(10515, 'db_order', 161, '', 'Update', 'order_status => 1<br>', 'Update Delivery Order.<br> Document No : DO/00050-17', 10000, '2017-12-19 12:48:18', 0, '0000-00-00 00:00:00'),
(10516, 'db_invoice', 104, '', 'Insert', 'invoice_no => IV/700100067<br>invoice_date => 2017-12-19<br>invoice_customer => 95<br>invoice_salesperson => <br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 12465798ssg<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => <br>invoice_outlet => -1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>', 'Insert Sales Invoice.<br> Document No : IV/700100067', 10000, '2017-12-19 12:55:34', 0, '0000-00-00 00:00:00'),
(10517, 'db_invoice', 104, '', 'Update', 'invoice_date => 2017-12-19<br>invoice_customer => 95<br>invoice_salesperson => <br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 12465798ssg<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => <br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2017-12-19 12:56:06', 0, '0000-00-00 00:00:00'),
(10518, 'db_invoice', 104, '', 'Update', 'invoice_subtotal => <br>invoice_disctotal => <br>invoice_taxtotal => 0<br>invoice_grandtotal => 0<br>invoice_discheadertotal => 0.00<br>', 'Update Sales Invoice.<br> Document No : IV/700100067', 10000, '2017-12-19 12:56:06', 0, '0000-00-00 00:00:00'),
(10519, 'db_order', 168, '', 'Insert', 'order_no => DO/00051-17<br>order_date => 2017-12-19<br>order_customer => 95<br>order_salesperson => 0<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => 12465798ssg<br>order_currency => 2<br>order_currencyrate => 2<br>order_status => 1<br>order_prefix_type => DO<br>order_generate_from => 104<br>order_outlet => -1<br>order_attentionto_phone => <br>order_fax => <br>order_project_id => 0<br>order_subcon => 0<br>order_shipping_id => 0<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_generate_from_type => SI<br>order_attentionto_email => <br>order_attentionto_name => <br>order_regards => <br>order_tnc => <br>order_notes => <br>', 'Insert Delivery Order.<br> Document No : DO/00051-17', 10000, '2017-12-19 12:57:06', 0, '0000-00-00 00:00:00'),
(10520, 'db_order', 168, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => <br>', 'Update Delivery Order.<br> Document No : DO/00051-17', 10000, '2017-12-19 12:57:06', 0, '0000-00-00 00:00:00'),
(10521, 'db_order', 169, '', 'Insert', 'order_no => PO/171200091<br>order_date => 2017-12-19<br>order_customer => 92<br>order_salesperson => <br>order_billaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => PO<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 6791423<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => <br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => <br>order_delivery_id => <br>order_price_id => <br>order_validity_id => <br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => <br>order_country_id => <br>order_attentionto_email => enquiry@cclaw.com.sg<br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Purchase Order.<br> Document No : PO/171200091', 10000, '2017-12-19 13:00:34', 0, '0000-00-00 00:00:00'),
(10522, 'db_uom', 16, '', 'Insert', 'uom_code => Pc<br>uom_desc => Pieces<br>uom_seqno => 1<br>uom_status => 1<br>', 'Insert Uom.', 10000, '2017-12-19 13:09:32', 0, '0000-00-00 00:00:00'),
(10523, 'db_product', 18, '', 'Insert', 'product_category => 9<br>product_part_no => dfgfdg<br>product_desc => <br>product_remark => <br>product_sale_price => 0.00<br>product_cost_price => 0.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => <br>product_name => <br>product_lowstock => <br>', 'Insert Product.', 10000, '2017-12-20 10:17:58', 0, '0000-00-00 00:00:00'),
(10524, 'db_product', 19, '', 'Insert', 'product_category => 9<br>product_part_no => P001<br>product_desc => <br>product_remark => <br>product_sale_price => 500<br>product_cost_price => 0.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => <br>product_name => <br>product_lowstock => <br>', 'Insert Product.', 10000, '2017-12-20 10:32:06', 0, '0000-00-00 00:00:00'),
(10525, 'db_ordl', 504, '', 'Insert', 'ordl_order_id => 166<br>ordl_pro_id => 8<br>ordl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>ordl_qty => 1.00<br>ordl_uom => 16<br>ordl_uprice => 70.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 70<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 70.00<br>ordl_ftotal => 70<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => California, USA<br>', 'Insert Quotation Line.<br> Document No : KC/0031/17-12', 10000, '2017-12-20 10:54:13', 0, '0000-00-00 00:00:00'),
(10526, 'db_order', 166, '', 'Update', 'order_subtotal => 70.0000<br>order_disctotal => 0.00<br>order_taxtotal => 4.9<br>order_grandtotal => 74.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-20 10:54:13', 0, '0000-00-00 00:00:00'),
(10527, 'db_order', 166, '', 'Update', 'order_date => 2017-12-19<br>order_customer => 95<br>order_salesperson => <br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2017-12-19<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 2<br>order_price_id => 2<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 2<br>order_country_id => <br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Update Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-20 10:56:58', 0, '0000-00-00 00:00:00'),
(10528, 'db_order', 166, '', 'Update', 'order_subtotal => 70.0000<br>order_disctotal => 0.00<br>order_taxtotal => 4.9<br>order_grandtotal => 74.9<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0031/17-12', 10000, '2017-12-20 10:56:58', 0, '0000-00-00 00:00:00'),
(10529, 'db_invoice', 105, '', 'Insert', 'invoice_no => IV/171200068<br>invoice_date => 2017-12-20<br>invoice_customer => 95<br>invoice_salesperson => 0<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 166<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 2<br>invoice_price_id => 2<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 2<br>invoice_country_id => 0<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => <br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/171200068', 10000, '2017-12-20 11:05:16', 0, '0000-00-00 00:00:00'),
(10530, 'db_invoice', 105, '', 'Update', 'invoice_subtotal => 70.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 4.9<br>invoice_grandtotal => 74.9<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/171200068', 10000, '2017-12-20 11:05:16', 0, '0000-00-00 00:00:00'),
(10531, 'db_invl', 211, '', 'Insert', 'invl_invoice_id => 105<br>invl_pro_id => 8<br>invl_pro_desc => 1-1/2&quot;, BSP (from California, USA)<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 70.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 70.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 504<br>invl_fuprice => 70.00<br>invl_ftotal => 70.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => California, USA<br>', 'Insert Sales Invoice Line.<br> Document No : IV/171200068', 10000, '2017-12-20 11:05:16', 0, '0000-00-00 00:00:00'),
(10532, 'db_product', 20, '', 'Insert', 'product_category => 8<br>product_part_no => <br>product_desc => <br>product_remark => <br>product_sale_price => 0.00<br>product_cost_price => 0.00<br>product_seqno => <br>product_status => 1<br>product_system_code => <br>product_qty_blades => <br>product_insert_types => <br>product_diameter => <br>product_width_depth => <br>product_shaft_diameter => <br>product_main_group => <br>product_sub_group => <br>product_n_wt => <br>product_g_wt => <br>product_usage => <br>product_enginemodel => <br>product_stock => <br>product_cr_jabsco => <br>product_cr_sherwood => <br>product_cr_johnson => <br>product_cr_volvo => <br>product_cr_cef => <br>product_cr_onan => <br>product_cr_kashiyama => <br>product_cr_yanmar => <br>product_cr_doosan => <br>product_cr_others => <br>product_cr_detroits => <br>product_cr_cummins => <br>product_cr_cats => <br>product_location => <br>product_name => <br>product_lowstock => <br>', 'Insert Product.', 10000, '2017-12-20 18:02:33', 0, '0000-00-00 00:00:00'),
(10533, 'db_order', 170, '', 'Insert', 'order_no => PU/00051-17<br>order_date => 2017-12-20<br>order_customer => 95<br>order_salesperson => 0<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => 0<br>order_shipterm => 0<br>order_term => 0<br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => 12465798ssg<br>order_currency => 2<br>order_currencyrate => 2.0000<br>order_status => 1<br>order_prefix_type => PU<br>order_generate_from => 168<br>order_generate_from_type => DO<br>order_outlet => -1<br>order_revtimes => 0<br>order_revdatetime => <br>order_revby => 0<br>order_shipping_id => 0<br>order_attentionto_phone => <br>order_fax => <br>order_subcon => 0<br>order_project_id => 0<br>order_delivery_date => -0001-11-30<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => 0<br>order_verifiedby => 0<br>order_regards => <br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 0<br>order_delivery_id => 0<br>order_price_id => 0<br>order_validity_id => 0<br>order_transittime_id => 0<br>order_freightcharge_id => 0<br>order_pointofdelivery_id => 0<br>order_prefix_id => 0<br>order_remarks_id => 0<br>order_country_id => 0<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Insert Pickup List.<br> Document No : PU/00051-17', 10000, '2017-12-20 18:15:08', 0, '0000-00-00 00:00:00'),
(10534, 'db_order', 170, '', 'Update', 'order_subtotal => <br>order_disctotal => <br>order_taxtotal => 0<br>order_grandtotal => 0<br>order_discheadertotal => 0.00<br>', 'Update Pickup List.<br> Document No : PU/00051-17', 10000, '2017-12-20 18:15:08', 0, '0000-00-00 00:00:00'),
(10535, 'db_order', 171, '', 'Insert', 'order_no => KC/0032/18-01<br>order_date => 2018-01-23<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => <br>order_currencyrate => 1.0000<br>order_status => 1<br>order_prefix_type => QT<br>order_generate_from => <br>order_generate_from_type => <br>order_outlet => -1<br>order_revtimes => <br>order_revdatetime => <br>order_revby => <br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2018-01-23<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Regards,\r\n\r\nThank You<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => EMPLOYEE<br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => Regards,\r\n\r\nThank You<br>', 'Insert Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 15:56:13', 0, '0000-00-00 00:00:00'),
(10536, 'db_ordl', 505, '', 'Insert', 'ordl_order_id => 171<br>ordl_pro_id => 21<br>ordl_pro_desc => Liner Std<br>ordl_qty => 1.00<br>ordl_uom => null<br>ordl_uprice => 46.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 46<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 46.00<br>ordl_ftotal => 46<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => 6Z1<br>', 'Insert Quotation Line.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:27', 0, '0000-00-00 00:00:00'),
(10537, 'db_order', 171, '', 'Update', 'order_subtotal => 46.0000<br>order_disctotal => 0.00<br>order_taxtotal => 3.22<br>order_grandtotal => 49.22<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:29', 0, '0000-00-00 00:00:00'),
(10538, 'db_ordl', 506, '', 'Insert', 'ordl_order_id => 171<br>ordl_pro_id => 1<br>ordl_pro_desc => Rubber Impeller<br>ordl_qty => 5.00<br>ordl_uom => null<br>ordl_uprice => 12.00<br>ordl_disc => 0<br>ordl_istax => 1<br>ordl_taxamt => 0<br>ordl_total => 60<br>ordl_pro_no => <br>ordl_discamt => 0<br>ordl_seqno => 10<br>ordl_parent => <br>ordl_fuprice => 12.00<br>ordl_ftotal => 60<br>ordl_fdiscamt => <br>ordl_ftaxamt => 0<br>ordl_pro_remark => <br>ordl_pfuprice => <br>ordl_delivery_date => <br>ordl_item_type => product<br>ordl_product_location => 6A1<br>', 'Insert Quotation Line.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:42', 0, '0000-00-00 00:00:00'),
(10539, 'db_order', 171, '', 'Update', 'order_subtotal => 106.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7.42<br>order_grandtotal => 113.42<br>order_discheadertotal => 0.00<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:42', 0, '0000-00-00 00:00:00'),
(10540, 'db_order', 171, '', 'Update', 'order_date => 2018-01-23<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2018-01-23<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Regards,\r\n\r\nThank You<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => Regards,\r\n\r\nThank You<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:49', 0, '0000-00-00 00:00:00'),
(10541, 'db_order', 171, '', 'Update', 'order_subtotal => 106.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7<br>order_grandtotal => 107<br>order_discheadertotal => 6.00<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:08:49', 0, '0000-00-00 00:00:00'),
(10542, 'db_order', 171, '', 'Update', 'order_date => 2018-01-23<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2018-01-23<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Regards,\r\n\r\nThank You<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => Regards,\r\n\r\nThank Yous<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:09:14', 0, '0000-00-00 00:00:00'),
(10543, 'db_order', 171, '', 'Update', 'order_subtotal => 106.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7<br>order_grandtotal => 107<br>order_discheadertotal => 6.00<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:09:14', 0, '0000-00-00 00:00:00'),
(10544, 'db_order', 171, '', 'Update', 'order_date => 2018-01-23<br>order_customer => 95<br>order_salesperson => 15<br>order_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_attentionto => <br>order_shipterm => <br>order_term => <br>order_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>order_customerref => <br>order_remark => <br>order_customerpo => <br>order_currency => 0<br>order_currencyrate => 1.0000<br>order_status => 1<br>order_shipping_id => <br>order_attentionto_phone => 6322 6550<br>order_fax => <br>order_subcon => <br>order_project_id => <br>order_delivery_date => 2018-01-23<br>order_job_no => <br>order_requestby => <br>order_agc_requestby => <br>order_approvedby => <br>order_verifiedby => <br>order_regards => Regards,\r\n\r\nThank Yous<br>order_type => <br>order_void_remarks => <br>order_salesperson_prefix => <br>order_paymentterm_id => 1<br>order_delivery_id => 1<br>order_price_id => 1<br>order_validity_id => 1<br>order_transittime_id => <br>order_freightcharge_id => <br>order_pointofdelivery_id => <br>order_prefix_id => <br>order_remarks_id => 1<br>order_country_id => 32<br>order_attentionto_email => <br>order_attentionto_name => <br>order_tnc => <br>order_notes => <br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:09:30', 0, '0000-00-00 00:00:00'),
(10545, 'db_order', 171, '', 'Update', 'order_subtotal => 106.0000<br>order_disctotal => 0.00<br>order_taxtotal => 7<br>order_grandtotal => 107<br>order_discheadertotal => 6.00<br>', 'Update Quotation.<br> Document No : KC/0032/18-01', 10000, '2018-01-23 17:09:30', 0, '0000-00-00 00:00:00'),
(10546, 'db_invoice', 106, '', 'Insert', 'invoice_no => IV/180100069<br>invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 171<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => Regards,\r\n\r\nThank Yous<br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/180100069', 10000, '2018-01-23 17:35:22', 0, '0000-00-00 00:00:00'),
(10547, 'db_invoice', 106, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7.42<br>invoice_grandtotal => 113.42<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/180100069', 10000, '2018-01-23 17:35:22', 0, '0000-00-00 00:00:00'),
(10548, 'db_invl', 212, '', 'Insert', 'invl_invoice_id => 106<br>invl_pro_id => 21<br>invl_pro_desc => Liner Std<br>invl_qty => 1.00<br>invl_uom => 0<br>invl_uprice => 46.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 46.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 505<br>invl_fuprice => 46.00<br>invl_ftotal => 46.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6Z1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100069', 10000, '2018-01-23 17:35:22', 0, '0000-00-00 00:00:00'),
(10549, 'db_invl', 213, '', 'Insert', 'invl_invoice_id => 106<br>invl_pro_id => 1<br>invl_pro_desc => Rubber Impeller<br>invl_qty => 5.00<br>invl_uom => 0<br>invl_uprice => 12.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 60.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 506<br>invl_fuprice => 12.00<br>invl_ftotal => 60.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100069', 10000, '2018-01-23 17:35:22', 0, '0000-00-00 00:00:00'),
(10550, 'db_invoice', 106, '', 'Update', 'invoice_status => 0<br>', 'Delete Sales Invoice.<br> Document No : ', 10000, '2018-01-23 18:06:41', 0, '0000-00-00 00:00:00'),
(10551, 'db_invoice', 107, '', 'Insert', 'invoice_no => IV/180100070<br>invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 171<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => Regards,\r\n\r\nThank Yous<br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/180100070', 10000, '2018-01-23 18:06:54', 0, '0000-00-00 00:00:00'),
(10552, 'db_invoice', 107, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7.42<br>invoice_grandtotal => 113.42<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/180100070', 10000, '2018-01-23 18:06:54', 0, '0000-00-00 00:00:00'),
(10553, 'db_invl', 214, '', 'Insert', 'invl_invoice_id => 107<br>invl_pro_id => 21<br>invl_pro_desc => Liner Std<br>invl_qty => 1.00<br>invl_uom => 0<br>invl_uprice => 46.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 46.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 505<br>invl_fuprice => 46.00<br>invl_ftotal => 46.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6Z1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100070', 10000, '2018-01-23 18:06:54', 0, '0000-00-00 00:00:00'),
(10554, 'db_invl', 215, '', 'Insert', 'invl_invoice_id => 107<br>invl_pro_id => 1<br>invl_pro_desc => Rubber Impeller<br>invl_qty => 5.00<br>invl_uom => 0<br>invl_uprice => 12.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 60.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 506<br>invl_fuprice => 12.00<br>invl_ftotal => 60.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100070', 10000, '2018-01-23 18:06:54', 0, '0000-00-00 00:00:00'),
(10555, 'db_invoice', 107, '', 'Update', 'invoice_status => 0<br>', 'Delete Sales Invoice.<br> Document No : ', 10000, '2018-01-23 18:07:36', 0, '0000-00-00 00:00:00'),
(10556, 'db_invoice', 108, '', 'Insert', 'invoice_no => IV/180100071<br>invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 171<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => Regards,\r\n\r\nThank Yous<br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/180100071', 10000, '2018-01-23 18:09:06', 0, '0000-00-00 00:00:00'),
(10557, 'db_invoice', 108, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7.42<br>invoice_grandtotal => 113.42<br>invoice_discheadertotal => 0<br>', 'Update Sales Invoice.<br> Document No : IV/180100071', 10000, '2018-01-23 18:09:06', 0, '0000-00-00 00:00:00'),
(10558, 'db_invl', 216, '', 'Insert', 'invl_invoice_id => 108<br>invl_pro_id => 21<br>invl_pro_desc => Liner Std<br>invl_qty => 1.00<br>invl_uom => 0<br>invl_uprice => 46.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 46.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 505<br>invl_fuprice => 46.00<br>invl_ftotal => 46.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6Z1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100071', 10000, '2018-01-23 18:09:07', 0, '0000-00-00 00:00:00'),
(10559, 'db_invl', 217, '', 'Insert', 'invl_invoice_id => 108<br>invl_pro_id => 1<br>invl_pro_desc => Rubber Impeller<br>invl_qty => 5.00<br>invl_uom => 0<br>invl_uprice => 12.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 60.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 506<br>invl_fuprice => 12.00<br>invl_ftotal => 60.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100071', 10000, '2018-01-23 18:09:07', 0, '0000-00-00 00:00:00'),
(10560, 'db_invoice', 108, '', 'Update', 'invoice_status => 0<br>', 'Delete Sales Invoice.<br> Document No : ', 10000, '2018-01-23 18:09:33', 0, '0000-00-00 00:00:00'),
(10561, 'db_invoice', 109, '', 'Insert', 'invoice_no => IV/180100072<br>invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => 0<br>invoice_shipterm => 0<br>invoice_term => 0<br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 0<br>invoice_currencyrate => 0<br>invoice_status => 1<br>invoice_prefix_type => SI<br>invoice_generate_from => 171<br>invoice_outlet => -1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_project_id => 0<br>invoice_subcon => 0<br>invoice_shipping_id => 0<br>invoice_paymentterm_id => 1<br>invoice_delivery_id => 1<br>invoice_price_id => 1<br>invoice_validity_id => 1<br>invoice_transittime_id => 0<br>invoice_freightcharge_id => 0<br>invoice_pointofdelivery_id => 0<br>invoice_prefix_id => 0<br>invoice_remarks_id => 1<br>invoice_country_id => 32<br>invoice_generate_from_type => QT<br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_regards => Regards,\r\n\r\nThank Yous<br>invoice_tnc => <br>invoice_notes => <br>', 'Insert Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-23 18:10:59', 0, '0000-00-00 00:00:00'),
(10562, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-23 18:10:59', 0, '0000-00-00 00:00:00'),
(10563, 'db_invl', 218, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 21<br>invl_pro_desc => Liner Std<br>invl_qty => 1.00<br>invl_uom => 0<br>invl_uprice => 46.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 46.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 505<br>invl_fuprice => 46.00<br>invl_ftotal => 46.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6Z1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-23 18:10:59', 0, '0000-00-00 00:00:00'),
(10564, 'db_invl', 219, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 1<br>invl_pro_desc => Rubber Impeller<br>invl_qty => 5.00<br>invl_uom => 0<br>invl_uprice => 12.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0.00<br>invl_total => 60.00<br>invl_pro_no => <br>invl_discamt => 0.00<br>invl_seqno => 10<br>invl_parent => 506<br>invl_fuprice => 12.00<br>invl_ftotal => 60.00<br>invl_fdiscamt => 0.00<br>invl_ftaxamt => 0.00<br>invl_parent_type => Order<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A1<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-23 18:11:00', 0, '0000-00-00 00:00:00'),
(10565, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>invoice_notes => <br>invoice_paymentdate => <br>invoice_paymentremark => <br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:43:03', 0, '0000-00-00 00:00:00'),
(10566, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:43:03', 0, '0000-00-00 00:00:00'),
(10567, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => <br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>invoice_notes => <br>invoice_paymentdate => <br>invoice_paymentremark => <br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:43:07', 0, '0000-00-00 00:00:00'),
(10568, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:43:07', 0, '0000-00-00 00:00:00'),
(10569, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => 2<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:43:14', 0, '0000-00-00 00:00:00'),
(10570, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:43:14', 0, '0000-00-00 00:00:00'),
(10571, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 0<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => 2<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:43:17', 0, '0000-00-00 00:00:00'),
(10572, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:43:17', 0, '0000-00-00 00:00:00'),
(10573, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfds<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:43:26', 0, '0000-00-00 00:00:00'),
(10574, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:43:26', 0, '0000-00-00 00:00:00'),
(10575, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 6.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:44:56', 0, '0000-00-00 00:00:00');
INSERT INTO `db_info` (`info_id`, `info_table`, `info_table_id`, `info_table_no`, `info_action`, `info_desc`, `info_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(10576, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7<br>invoice_grandtotal => 107<br>invoice_discheadertotal => 6.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:44:56', 0, '0000-00-00 00:00:00'),
(10577, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => <br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => <br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 12:45:19', 0, '0000-00-00 00:00:00'),
(10578, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 106.0000<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 3.92<br>invoice_grandtotal => 59.92<br>invoice_discheadertotal => 50<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:45:19', 0, '0000-00-00 00:00:00'),
(10579, 'db_invl', 220, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 6<br>invl_pro_desc => Rubber Impeller\ntest<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.02<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.02<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.02<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A2<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 12:45:50', 0, '0000-00-00 00:00:00'),
(10580, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 122.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 5.04<br>invoice_grandtotal => 77.06<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 12:45:50', 0, '0000-00-00 00:00:00'),
(10581, 'db_invl', 221, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 30<br>invl_pro_desc => Blower Repair Kit (Small Brg)<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 40.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 40<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 40<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 7F3<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 14:28:26', 0, '0000-00-00 00:00:00'),
(10582, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 162.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 7.84<br>invoice_grandtotal => 119.86<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 14:28:26', 0, '0000-00-00 00:00:00'),
(10583, 'db_invl', 222, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 37<br>invl_pro_desc => Cylinder Kit<br>invl_qty => 1.00<br>invl_uom => 9<br>invl_uprice => 0<br>invl_fuprice => 10.00<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 10<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 10<br>invl_pro_remark => <br>invl_item_type => package<br>invl_product_location => <br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 14:28:34', 0, '0000-00-00 00:00:00'),
(10584, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 14:28:34', 0, '0000-00-00 00:00:00'),
(10585, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => 123<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => test<br>invoice_attentionto_name => <br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 14:29:25', 0, '0000-00-00 00:00:00'),
(10586, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 14:29:25', 0, '0000-00-00 00:00:00'),
(10587, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => 123<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => test<br>invoice_attentionto_name => abc<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => <br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 15:02:10', 0, '0000-00-00 00:00:00'),
(10588, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:02:10', 0, '0000-00-00 00:00:00'),
(10589, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 2<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => 123<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => test<br>invoice_attentionto_name => abc<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => test<br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 15:02:15', 0, '0000-00-00 00:00:00'),
(10590, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:02:15', 0, '0000-00-00 00:00:00'),
(10591, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 4<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => 123<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => test<br>invoice_attentionto_name => abc<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => test<br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 15:02:25', 0, '0000-00-00 00:00:00'),
(10592, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:02:25', 0, '0000-00-00 00:00:00'),
(10593, 'db_invoice', 109, '', 'Update', 'invoice_date => 2018-01-23<br>invoice_customer => 95<br>invoice_salesperson => 15<br>invoice_billaddress => 18 Kallang Terrace,\r\nSingapore 538977<br>invoice_attentionto => <br>invoice_shipterm => <br>invoice_term => <br>invoice_shipaddress => 118 Kallang Terrace,\r\nSingapore 538977<br>invoice_customerref => <br>invoice_remark => <br>invoice_customerpo => 1fdss<br>invoice_currency => 4<br>invoice_currencyrate => 1.0000<br>invoice_status => 1<br>invoice_attentionto_phone => 6322 6550<br>invoice_fax => 123<br>invoice_subcon => <br>invoice_project_id => <br>invoice_shipping_id => <br>invoice_discheadertotal => 50.00<br>invoice_paymentterm_id => <br>invoice_delivery_id => <br>invoice_price_id => <br>invoice_validity_id => <br>invoice_transittime_id => <br>invoice_freightcharge_id => <br>invoice_pointofdelivery_id => <br>invoice_prefix_id => <br>invoice_remarks_id => <br>invoice_country_id => <br>invoice_attentionto_email => test<br>invoice_attentionto_name => abc<br>invoice_tnc => <br>invoice_regards => <br>invoice_payment => 1<br>invoice_notes => test<br>invoice_paymentdate => 2018-01-12<br>invoice_paymentremark => sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd<br>', 'Update Sales Invoice.<br> Document No : ', 10000, '2018-01-31 15:03:23', 0, '0000-00-00 00:00:00'),
(10594, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 172.0200<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 8.54<br>invoice_grandtotal => 130.56<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:03:23', 0, '0000-00-00 00:00:00'),
(10595, 'db_invl', 223, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 7<br>invl_pro_desc => Rubber Impeller<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.04<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.04<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.04<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A2<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 15:03:44', 0, '0000-00-00 00:00:00'),
(10596, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 188.0600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 9.66<br>invoice_grandtotal => 147.72<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:03:44', 0, '0000-00-00 00:00:00'),
(10597, 'db_invl', 224, '', 'Insert', 'invl_invoice_id => 109<br>invl_pro_id => 18<br>invl_pro_desc => Rubber Impellera\nd\nsad\nasd\nsad\nas\nds\nad\nasd\nas\ndsa\ndas\nd\nsa<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 18.40<br>invl_disc => 0<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 18.4<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_parent => <br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 18.4<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6A3<br>', 'Insert Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 15:03:52', 0, '0000-00-00 00:00:00'),
(10598, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 15:03:52', 0, '0000-00-00 00:00:00'),
(10599, 'db_invl', 221, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 30<br>invl_pro_desc => Blower Repair Kit (Small Brg)\nzxc\nx\ncx\ncxzc\nzxc\nxz\nczxc<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 40.00<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 40<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 40<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 7.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 16:15:01', 0, '0000-00-00 00:00:00'),
(10600, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 16:15:01', 0, '0000-00-00 00:00:00'),
(10601, 'db_invl', 224, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 18<br>invl_pro_desc => Rubber Impellera\nd\nsad\nasd\nsad\nas\nds\nad\nasd\nas\ndsa\ndas\nd\nsa\n\nxzc\nzxc\n\nxzc\nzx\nczxccxc<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 18.40<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 18.4<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 18.4<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-01-31 16:55:35', 0, '0000-00-00 00:00:00'),
(10602, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-01-31 16:55:35', 0, '0000-00-00 00:00:00'),
(10603, 'db_invl', 220, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 6<br>invl_pro_desc => Rubber Impeller\ntests\ndf\nsf\nsdf\nsd\nf<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.02<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.02<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.02<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-02-01 11:47:01', 0, '0000-00-00 00:00:00'),
(10604, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-02-01 11:47:01', 0, '0000-00-00 00:00:00'),
(10605, 'db_invl', 220, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 6<br>invl_pro_desc => Rubber Impeller A\ntests\ndf\nsf\nsdf\nsd\nf<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.02<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.02<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.02<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-02-01 12:19:48', 0, '0000-00-00 00:00:00'),
(10606, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-02-01 12:19:48', 0, '0000-00-00 00:00:00'),
(10607, 'db_invl', 220, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 6<br>invl_pro_desc => Rubber Impeller A\ntests\ndf\nsf\nsdf\nsd\nf<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.02<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.02<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.02<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-02-01 12:19:50', 0, '0000-00-00 00:00:00'),
(10608, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-02-01 12:19:50', 0, '0000-00-00 00:00:00'),
(10609, 'db_invl', 220, '', 'Update', 'invl_invoice_id => 109<br>invl_pro_id => 6<br>invl_pro_desc => Rubber Impeller Adadadasdasdasdasdasdasdadsadasdasdasdasdsadasd\ntests\ndf\nsf\nsdf\nsd\nf<br>invl_qty => 1.00<br>invl_uom => 16<br>invl_uprice => 0<br>invl_fuprice => 16.02<br>invl_disc => 0.00<br>invl_istax => 1<br>invl_taxamt => 0<br>invl_total => 16.02<br>invl_pro_no => <br>invl_discamt => 0<br>invl_seqno => undefined<br>invl_markup => <br>invl_fdiscamt => <br>invl_ftaxamt => 0<br>invl_ftotal => 16.02<br>invl_pro_remark => <br>invl_item_type => product<br>invl_product_location => 6.00<br>', 'Update Sales Invoice Line.<br> Document No : IV/180100072', 10000, '2018-02-01 15:37:49', 0, '0000-00-00 00:00:00'),
(10610, 'db_invoice', 109, '', 'Update', 'invoice_subtotal => 206.4600<br>invoice_disctotal => 0.00<br>invoice_taxtotal => 10.95<br>invoice_grandtotal => 167.41<br>invoice_discheadertotal => 50.00<br>', 'Update Sales Invoice.<br> Document No : IV/180100072', 10000, '2018-02-01 15:37:49', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_invl`
--

CREATE TABLE `db_invl` (
  `invl_id` int(11) NOT NULL,
  `invl_invoice_id` int(11) NOT NULL,
  `invl_parent` int(11) NOT NULL,
  `invl_parent_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `invl_item_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invl_pro_no` text COLLATE utf8_unicode_ci NOT NULL,
  `invl_pro_id` int(11) NOT NULL,
  `invl_pro_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `invl_qty` decimal(10,2) NOT NULL,
  `invl_uom` int(11) NOT NULL,
  `invl_fuprice` decimal(15,2) NOT NULL,
  `invl_uprice` decimal(15,2) NOT NULL,
  `invl_disc` decimal(10,2) NOT NULL,
  `invl_discamt` decimal(15,2) NOT NULL,
  `invl_fdiscamt` decimal(15,2) NOT NULL,
  `invl_istax` int(11) NOT NULL,
  `invl_taxamt` decimal(15,2) NOT NULL,
  `invl_ftaxamt` decimal(15,2) NOT NULL,
  `invl_ftotal` decimal(15,2) NOT NULL,
  `invl_total` decimal(15,2) NOT NULL,
  `invl_product_location` text COLLATE utf8_unicode_ci NOT NULL,
  `invl_markup` decimal(10,2) NOT NULL,
  `invl_seqno` int(11) NOT NULL,
  `invl_pro_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_invl`
--

INSERT INTO `db_invl` (`invl_id`, `invl_invoice_id`, `invl_parent`, `invl_parent_type`, `invl_item_type`, `invl_pro_no`, `invl_pro_id`, `invl_pro_desc`, `invl_qty`, `invl_uom`, `invl_fuprice`, `invl_uprice`, `invl_disc`, `invl_discamt`, `invl_fdiscamt`, `invl_istax`, `invl_taxamt`, `invl_ftaxamt`, `invl_ftotal`, `invl_total`, `invl_product_location`, `invl_markup`, `invl_seqno`, `invl_pro_remark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(155, 61, 424, 'Order', 'product', '', 1, 'Impeller', '1.00', 8, '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', '', '0.00', 10, '', 10000, '2017-09-15 17:59:18', 10000, '2017-09-15 17:59:18'),
(181, 85, 429, 'Order', 'product', '', 1, 'Impeller', '8.00', 8, '17.50', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '140.00', '140.00', '', '0.00', 10, '8 qty', 10000, '2017-09-27 09:21:34', 10000, '2017-09-27 09:21:34'),
(182, 85, 430, 'Order', 'package', '', 34, 'Impeller', '2.00', 13, '122.00', '122.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '244.00', '244.00', '', '0.00', 10, '2 packs', 10000, '2017-09-27 09:21:34', 10000, '2017-09-27 09:21:34'),
(183, 85, 431, 'Order', 'product', '', 5, 'Impeller', '10.00', 13, '28.55', '28.55', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '285.50', '285.50', '', '0.00', 10, '', 10000, '2017-09-27 09:21:34', 10000, '2017-09-27 09:21:34'),
(184, 86, 0, 'Invoice', 'product', '', 7, '2\", Flange, M-seal, Imp 8201-01', '1.00', 0, '120.00', '120.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '120.00', '120.00', '', '0.00', 0, '', 0, '2017-09-27 09:43:55', 0, '2017-09-27 09:43:55'),
(185, 86, 0, 'Invoice', 'product', '', 9, '3/8\", NPT, 7050-01', '1.00', 0, '52.00', '52.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '52.00', '52.00', '', '0.00', 0, '', 0, '2017-09-27 09:43:55', 0, '2017-09-27 09:43:55'),
(186, 86, 0, 'Invoice', 'product', '', 5, 'Impeller', '2.00', 0, '28.00', '28.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '56.00', '56.00', '', '0.00', 0, '', 0, '2017-09-27 09:43:55', 0, '2017-09-27 09:43:55'),
(187, 87, 0, '', 'product', '', 5, 'Impeller', '2.00', 8, '20.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '40.00', '40.00', '', '0.00', 0, '', 10000, '2017-09-27 10:14:18', 10000, '2017-09-27 10:14:18'),
(188, 87, 0, '', 'product', '', 1, 'Impeller', '3.00', 8, '12.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '36.00', '36.00', '', '0.00', 0, '', 10000, '2017-09-27 10:35:24', 10000, '2017-09-27 10:35:49'),
(189, 92, 0, '', 'product', '', 6, '1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01', '1.00', 8, '100.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '100.00', '100.00', '', '0.00', 0, '', 10000, '2017-10-27 15:17:26', 10000, '2017-10-27 15:17:26'),
(190, 93, 0, '', 'product', '', 8, '1-1/2&quot;, BSP', '5.00', 8, '70.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '350.00', '350.00', '', '0.00', 0, '', 10000, '2017-10-27 15:19:53', 10000, '2017-10-27 15:19:53'),
(191, 93, 0, '', 'product', '', 10, '3/8&quot;, Hose, 7051-01', '1.00', 8, '39.60', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '39.60', '39.60', '', '0.00', 0, '', 10000, '2017-10-27 15:19:58', 10000, '2017-10-27 15:19:58'),
(192, 93, 0, '', 'product', '', 11, 'Flat Shipping Rate', '1.00', 8, '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', '', '0.00', 0, '', 10000, '2017-10-27 15:20:06', 10000, '2017-10-27 15:20:06'),
(193, 94, 448, 'Order', 'product', '', 12, 'gasket', '1.00', 8, '10.00', '10.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '10.00', '10.00', '', '0.00', 10, '', 10000, '2017-10-27 15:20:41', 10000, '2017-10-27 15:20:41'),
(194, 94, 452, 'Order', 'product', '', 1, 'Impeller', '1.00', 8, '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', '', '0.00', 10, '', 10000, '2017-10-27 15:20:41', 10000, '2017-10-27 15:20:41'),
(195, 95, 0, '', 'product', '', 1, 'Impeller', '1.00', 8, '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', '', '0.00', 0, '', 10000, '2017-10-27 16:00:28', 10000, '2017-10-27 16:00:28'),
(196, 96, 457, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '2.00', 8, '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '30.00', '30.00', 'Florida, USA', '0.00', 10, '', 10000, '2017-11-03 10:53:04', 10000, '2017-11-03 10:53:04'),
(197, 96, 458, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '2.00', 8, '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '56.00', '56.00', 'New York, USA', '0.00', 10, '', 10000, '2017-11-03 10:53:04', 10000, '2017-11-03 10:53:04'),
(198, 96, 459, 'Order', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)', '3.00', 8, '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '360.00', '360.00', 'California, USA', '0.00', 10, '', 10000, '2017-11-03 10:53:04', 10000, '2017-11-03 10:53:04'),
(199, 97, 0, '', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', 'Florida, USA', '0.00', 0, '', 10000, '2017-11-03 10:55:56', 10000, '2017-11-03 10:55:56'),
(200, 97, 0, '', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '28.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '28.00', 'New York, USA', '0.00', 0, '', 10000, '2017-11-03 10:55:59', 10000, '2017-11-03 10:55:59'),
(201, 97, 0, '', 'product', '', 9, '3/8&quot;, NPT, 7050-01 (from New York)', '1.00', 8, '52.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '52.00', '52.00', 'New York, USA', '0.00', 0, '', 10000, '2017-11-03 10:56:04', 10000, '2017-11-03 10:56:04'),
(202, 98, 474, 'Order', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 8, '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '70.00', 'California, USA', '0.00', 10, '', 10000, '2017-11-03 11:32:03', 10000, '2017-11-03 11:32:03'),
(203, 98, 475, 'Order', 'product', '', 6, '1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)', '5.00', 13, '200.00', '0.00', '10.00', '100.00', '100.00', 1, '0.00', '0.00', '900.00', '900.00', '', '0.00', 10, '', 10000, '2017-11-03 11:32:03', 10000, '2017-11-03 11:32:03'),
(204, 98, 476, 'Order', 'package', '', 34, 'Impeller', '1.00', 13, '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '120.00', '', '0.00', 10, '', 10000, '2017-11-03 11:32:03', 10000, '2017-11-03 11:32:03'),
(205, 99, 483, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', 'Florida, USA', '0.00', 10, '', 10000, '2017-11-03 16:37:04', 10000, '2017-11-03 16:37:04'),
(206, 99, 484, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '28.00', 'New York, USA', '0.00', 10, '', 10000, '2017-11-03 16:37:04', 10000, '2017-11-03 16:37:04'),
(207, 99, 485, 'Order', 'package', '', 34, 'Impeller', '1.00', 8, '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '120.00', '', '0.00', 10, '', 10000, '2017-11-03 16:37:05', 10000, '2017-11-03 16:37:05'),
(208, 99, 486, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '15.00', 'Florida, USA', '0.00', 10, '', 10000, '2017-11-03 16:37:05', 10000, '2017-11-03 16:37:05'),
(209, 99, 487, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '28.00', 'New York, USA', '0.00', 10, '', 10000, '2017-11-03 16:37:05', 10000, '2017-11-03 16:37:05'),
(210, 99, 0, '', 'package', '', 34, 'Impeller', '2.00', 8, '120.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '240.00', '240.00', '', '0.00', 0, '', 10000, '2017-11-03 16:37:32', 10000, '2017-11-03 16:37:32'),
(211, 105, 504, 'Order', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 16, '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '70.00', 'California, USA', '0.00', 10, '', 10000, '2017-12-20 11:05:16', 10000, '2017-12-20 11:05:16'),
(212, 106, 505, 'Order', 'product', '', 21, 'Liner Std', '1.00', 0, '46.00', '46.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '46.00', '46.00', '6Z1', '0.00', 10, '', 10000, '2018-01-23 17:35:22', 10000, '2018-01-23 17:35:22'),
(213, 106, 506, 'Order', 'product', '', 1, 'Rubber Impeller', '5.00', 0, '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '60.00', '60.00', '6A1', '0.00', 10, '', 10000, '2018-01-23 17:35:22', 10000, '2018-01-23 17:35:22'),
(214, 107, 505, 'Order', 'product', '', 21, 'Liner Std', '1.00', 0, '46.00', '46.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '46.00', '46.00', '6Z1', '0.00', 10, '', 10000, '2018-01-23 18:06:54', 10000, '2018-01-23 18:06:54'),
(215, 107, 506, 'Order', 'product', '', 1, 'Rubber Impeller', '5.00', 0, '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '60.00', '60.00', '6A1', '0.00', 10, '', 10000, '2018-01-23 18:06:54', 10000, '2018-01-23 18:06:54'),
(216, 108, 505, 'Order', 'product', '', 21, 'Liner Std', '1.00', 0, '46.00', '46.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '46.00', '46.00', '6Z1', '0.00', 10, '', 10000, '2018-01-23 18:09:07', 10000, '2018-01-23 18:09:07'),
(217, 108, 506, 'Order', 'product', '', 1, 'Rubber Impeller', '5.00', 0, '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '60.00', '60.00', '6A1', '0.00', 10, '', 10000, '2018-01-23 18:09:07', 10000, '2018-01-23 18:09:07'),
(218, 109, 505, 'Order', 'product', '', 21, 'Liner Std', '1.00', 0, '46.00', '46.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '46.00', '46.00', '6Z1', '0.00', 10, '', 10000, '2018-01-23 18:10:59', 10000, '2018-01-23 18:10:59'),
(219, 109, 506, 'Order', 'product', '', 1, 'Rubber Impeller', '5.00', 0, '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '60.00', '60.00', '6A1', '0.00', 10, '', 10000, '2018-01-23 18:11:00', 10000, '2018-01-23 18:11:00'),
(220, 109, 0, '', 'product', '', 6, 'Rubber Impeller Adadadasdasdasdasdasdasdadsadasdasdasdasdsadasd\ntests\ndf\nsf\nsdf\nsd\nf', '1.00', 16, '16.02', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '16.02', '16.02', '6.00', '0.00', 0, '', 10000, '2018-01-31 12:45:50', 10000, '2018-02-01 15:37:49'),
(221, 109, 0, '', 'product', '', 30, 'Blower Repair Kit (Small Brg)\nzxc\nx\ncx\ncxzc\nzxc\nxz\nczxc', '1.00', 16, '40.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '40.00', '40.00', '7.00', '0.00', 0, '', 10000, '2018-01-31 14:28:26', 10000, '2018-01-31 16:15:01'),
(222, 109, 0, '', 'package', '', 37, 'Cylinder Kit', '1.00', 9, '10.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '10.00', '10.00', '', '0.00', 0, '', 10000, '2018-01-31 14:28:34', 10000, '2018-01-31 14:28:34'),
(223, 109, 0, '', 'product', '', 7, 'Rubber Impeller', '1.00', 16, '16.04', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '16.04', '16.04', '6A2', '0.00', 0, '', 10000, '2018-01-31 15:03:44', 10000, '2018-01-31 15:03:44'),
(224, 109, 0, '', 'product', '', 18, 'Rubber Impellera\nd\nsad\nasd\nsad\nas\nds\nad\nasd\nas\ndsa\ndas\nd\nsa\n\nxzc\nzxc\n\nxzc\nzx\nczxccxc', '1.00', 16, '18.40', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '18.40', '18.40', '6.00', '0.00', 0, '', 10000, '2018-01-31 15:03:52', 10000, '2018-01-31 16:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `db_invoice`
--

CREATE TABLE `db_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_outlet` int(11) NOT NULL,
  `invoice_prefix_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_generate_from` int(11) NOT NULL,
  `invoice_generate_from_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_customer` int(11) NOT NULL,
  `invoice_salesperson` int(11) NOT NULL,
  `invoice_billaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_attentionto` int(11) NOT NULL,
  `invoice_attentionto_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_attentionto_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_attentionto_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_paymentterm_id` int(11) NOT NULL,
  `invoice_paymentterm_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_delivery_id` int(11) NOT NULL,
  `invoice_delivery_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_price_id` int(11) NOT NULL,
  `invoice_price_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_validity_id` int(11) NOT NULL,
  `invoice_validity_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_transittime_id` int(11) NOT NULL,
  `invoice_freightcharge_id` int(11) NOT NULL,
  `invoice_pointofdelivery_id` int(11) NOT NULL,
  `invoice_prefix_id` int(11) NOT NULL,
  `invoice_remarks_id` int(11) NOT NULL,
  `invoice_country_id` int(11) NOT NULL,
  `invoice_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_shipterm` int(11) NOT NULL,
  `invoice_term` int(11) NOT NULL,
  `invoice_tnc` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_shipaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_customerref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_regards` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_customerpo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_currency` int(11) NOT NULL,
  `invoice_currencyrate` decimal(10,4) NOT NULL,
  `invoice_subtotal` decimal(15,2) NOT NULL,
  `invoice_disctotal` decimal(15,2) NOT NULL,
  `invoice_discheadertotal` decimal(15,2) NOT NULL,
  `invoice_taxtotal` decimal(15,2) NOT NULL,
  `invoice_grandtotal` decimal(15,2) NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `invoice_fax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `invoice_weight` decimal(10,2) NOT NULL,
  `invoice_project_id` int(11) NOT NULL,
  `invoice_subcon` int(11) NOT NULL,
  `invoice_supplier_invoice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_shipping_id` int(11) NOT NULL,
  `invoice_payment` int(11) NOT NULL,
  `invoice_paymentdate` date NOT NULL,
  `invoice_paymentremark` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_invoice`
--

INSERT INTO `db_invoice` (`invoice_id`, `invoice_outlet`, `invoice_prefix_type`, `invoice_generate_from`, `invoice_generate_from_type`, `invoice_no`, `invoice_date`, `invoice_customer`, `invoice_salesperson`, `invoice_billaddress`, `invoice_attentionto`, `invoice_attentionto_phone`, `invoice_attentionto_name`, `invoice_attentionto_email`, `invoice_paymentterm_id`, `invoice_paymentterm_remark`, `invoice_delivery_id`, `invoice_delivery_remark`, `invoice_price_id`, `invoice_price_remark`, `invoice_validity_id`, `invoice_validity_remark`, `invoice_transittime_id`, `invoice_freightcharge_id`, `invoice_pointofdelivery_id`, `invoice_prefix_id`, `invoice_remarks_id`, `invoice_country_id`, `invoice_country`, `invoice_shipterm`, `invoice_term`, `invoice_tnc`, `invoice_shipaddress`, `invoice_customerref`, `invoice_remark`, `invoice_regards`, `invoice_customerpo`, `invoice_currency`, `invoice_currencyrate`, `invoice_subtotal`, `invoice_disctotal`, `invoice_discheadertotal`, `invoice_taxtotal`, `invoice_grandtotal`, `invoice_status`, `invoice_fax`, `invoice_notes`, `invoice_weight`, `invoice_project_id`, `invoice_subcon`, `invoice_supplier_invoice`, `invoice_shipping_id`, `invoice_payment`, `invoice_paymentdate`, `invoice_paymentremark`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(61, -1, 'SI', 128, 'QT', 'IV/170900051', '2017-09-15', 93, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, '81354729', 'Edward', 'edward@alphadesign.com.sg', 7, '', 2, '', 2, '', 3, '', 1, 1, 1, 1, 2, 32, '', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', 'Thank you.', '', 0, '0.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-09-15 17:59:17', 10000, '2017-09-15 17:59:17'),
(85, -1, 'SI', 133, 'QT', 'IV/170900052', '2017-09-27', 93, 19, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, '81354729', 'Edward', 'edward@alphadesign.com.sg', 3, '', 2, '', 2, '', 1, '', 1, 1, 1, 1, 2, 32, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 0, '0.0000', '669.50', '0.00', '0.00', '46.87', '716.37', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-09-27 09:21:34', 10000, '2017-09-27 09:21:34'),
(86, 0, 'eSI', 0, '', 'IV/170900047/e', '2017-09-27', 94, 0, '636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', 0, '94554817', 'Nasirah Luddin', 'alvapierre@hotmail.com', 8, '', 4, '', 3, '', 1, '', 3, 3, 1, 2, 3, 32, '', 0, 0, '', '636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', '', 'e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', '', '', 0, '1.0000', '228.00', '0.00', '0.00', '15.96', '243.96', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 0, '2017-09-27 09:43:55', 10000, '2017-09-27 10:09:11'),
(87, -1, 'PCN', 0, '', 'PCN00021', '2017-09-27', 92, 18, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, '81924589', 'Felicia', '', 2, '', 2, '', 2, '', 2, '', 2, 1, 1, 2, 2, 32, '', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', '', '', '', '', 0, '1.0000', '76.00', '0.00', '0.00', '5.32', '81.32', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-09-27 10:13:31', 10000, '2017-09-27 10:35:49'),
(88, -1, 'SI', 0, '', 'IV/700100053', '2017-09-27', 94, 0, '', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-09-27 15:28:57', 10000, '2017-10-04 11:50:34'),
(89, -1, 'SI', 0, '', 'IV/700100054', '2017-10-04', 95, 14, '18 Kallang Terrace,\r\nSingapore 538977', 0, '94554817', 'Peter Poh', 'alvapierre@hotmail.com', 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '94554817', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-04 16:31:43', 10000, '2017-10-04 16:31:43'),
(90, -1, 'SI', 0, '', 'IV/700100055', '2017-10-06', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-06 17:00:52', 10000, '2017-10-06 17:00:52'),
(91, -1, 'SI', 140, 'QT', 'IV/171000056', '2017-10-27', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '62437519', '', 'enquiry@alphadesign.com.sg', 2, '', 3, '', 1, '', 1, '', 1, 1, 1, 2, 1, 32, '', 0, 0, 'xdfxdf', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', 'dfgh', '', 0, '0.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-27 15:06:20', 10000, '2017-10-27 15:06:20'),
(92, -1, 'SI', 0, '', 'IV/700100057', '2017-10-27', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 0, '1.0000', '100.00', '0.00', '0.00', '7.00', '107.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-27 15:17:21', 10000, '2017-10-27 15:17:26'),
(93, -1, 'SI', 0, '', 'IV/700100058', '2017-10-27', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 0, '1.0000', '404.60', '0.00', '0.00', '28.32', '432.92', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-27 15:19:41', 10000, '2017-10-27 15:20:07'),
(94, -1, 'SI', 142, 'QT', 'IV/171000059', '2017-10-27', 95, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', '', '', 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', '', '', 0, '0.0000', '25.00', '0.00', '0.00', '1.75', '26.75', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-27 15:20:41', 10000, '2017-10-27 15:20:41'),
(95, -1, 'SI', 0, '', 'IV/700100060', '2017-10-27', 93, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 26, 'd', 'ccsd', '', 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, 0, '', ' ', '', '', '', '', 0, '1.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, 'sdcsd', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-10-27 16:00:20', 10000, '2017-10-27 16:00:29'),
(96, -1, 'SI', 148, 'QT', 'IV/171100061', '2017-11-03', 93, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, '81354729', 'Edward', 'edward@alphadesign.com.sg', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', 'KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, '', '', '0.00', 0, 0, '', 0, 1, '0000-00-00', '', 10000, '2017-11-03 10:53:04', 10000, '2017-11-03 10:54:13'),
(97, -1, 'SI', 0, '', 'IV/700100062', '2017-11-03', 95, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '94554817', 'William', 'alvapierre@hotmail.com', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', '', '', 4, '1.0000', '95.00', '0.00', '0.00', '6.65', '101.65', 1, '94554817', '', '0.00', 0, 0, '', 0, 1, '0000-00-00', '', 10000, '2017-11-03 10:55:50', 10000, '2017-11-03 10:56:07'),
(98, -1, 'SI', 154, 'QT', 'IV/171100063', '2017-11-03', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 27, ' c c', 'Jason', ' ', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 2, '2.0000', '1190.00', '100.00', '0.00', '76.30', '1166.30', 1, 'c c ', '', '0.00', 0, 0, '', 0, 1, '0000-00-00', '', 10000, '2017-11-03 11:32:03', 10000, '2017-11-03 11:41:28'),
(99, -1, 'SI', 157, 'QT', 'IV/171100064', '2017-11-03', 93, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 23, '81366729', 'Emily', 'emily@alphadesign.com.sg', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', 'PO000012A', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, '', 'KC/0028/17-11 for Emily', '0.00', 0, 0, '', 0, 1, '0000-00-00', '', 10000, '2017-11-03 16:37:04', 10000, '2017-11-03 16:38:20'),
(100, -1, 'SI', 160, 'QT', 'IV/171200065', '2017-12-13', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '62437519', '', 'enquiry@alphadesign.com.sg', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 4, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-13 14:20:03', 10000, '2017-12-13 14:21:05'),
(101, -1, 'SCN', 0, '', 'CN00010', '2017-12-13', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 2, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-13 14:22:14', 10000, '2017-12-13 14:22:28'),
(102, -1, 'SI', 163, 'QT', 'IV/171200066', '2017-12-13', 93, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '62437519', '', 'enquiry@alphadesign.com.sg', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', '', '', 0, '0.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-13 14:26:02', 10000, '2017-12-13 14:26:02'),
(103, -1, 'PCN', 0, '', 'PCN00022', '2017-12-13', 92, 0, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', '', '', '', '', 2, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-13 14:31:33', 10000, '2017-12-13 14:31:39'),
(104, -1, 'SI', 0, '', 'IV/700100067', '2017-12-19', 95, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', '', '12465798ssg', 2, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-19 12:55:34', 10000, '2017-12-19 12:56:06'),
(105, -1, 'SI', 166, 'QT', 'IV/171200068', '2017-12-20', 95, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', '', '', 1, '', 2, '', 2, '', 1, '', 0, 0, 0, 0, 2, 0, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', '', '', 0, '0.0000', '70.00', '0.00', '0.00', '4.90', '74.90', 1, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2017-12-20 11:05:16', 10000, '2017-12-20 11:05:16'),
(106, -1, 'SI', 171, 'QT', 'IV/180100069', '2018-01-23', 95, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', '', '', 1, '', 1, '', 1, '', 1, '', 0, 0, 0, 0, 1, 32, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', 'Regards,\r\n\r\nThank Yous', '', 0, '0.0000', '106.00', '0.00', '0.00', '7.42', '113.42', 0, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2018-01-23 17:35:22', 10000, '2018-01-23 18:06:41'),
(107, -1, 'SI', 171, 'QT', 'IV/180100070', '2018-01-23', 95, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', '', '', 1, '', 1, '', 1, '', 1, '', 0, 0, 0, 0, 1, 32, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', 'Regards,\r\n\r\nThank Yous', '', 0, '0.0000', '106.00', '0.00', '0.00', '7.42', '113.42', 0, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2018-01-23 18:06:54', 10000, '2018-01-23 18:07:36'),
(108, -1, 'SI', 171, 'QT', 'IV/180100071', '2018-01-23', 95, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', '', '', 1, '', 1, '', 1, '', 1, '', 0, 0, 0, 0, 1, 32, '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', '', '', 'Regards,\r\n\r\nThank Yous', '', 0, '0.0000', '106.00', '0.00', '0.00', '7.42', '113.42', 0, '', '', '0.00', 0, 0, '', 0, 0, '0000-00-00', '', 10000, '2018-01-23 18:09:06', 10000, '2018-01-23 18:09:33'),
(109, -1, 'SI', 171, 'QT', 'IV/180100072', '2018-01-23', 95, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '6322 6550', 'abc', 'test', 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, '', '118 Kallang Terrace,\r\nSingapore 538977', '', '', '', '1fdss', 4, '1.0000', '206.46', '0.00', '50.00', '10.95', '167.41', 1, '123', 'test', '0.00', 0, 0, '', 0, 1, '2018-01-12', 'sdfdsasdasd\r\nasd\r\nsd\r\nas\r\ndasd', 10000, '2018-01-23 18:10:59', 10000, '2018-02-01 15:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `db_iscategory`
--

CREATE TABLE `db_iscategory` (
  `iscategory_id` int(11) NOT NULL,
  `isparent_id` int(11) NOT NULL,
  `iscategory_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iscategory_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `iscategory_seqno` int(11) NOT NULL,
  `iscategory_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_iscategory`
--

INSERT INTO `db_iscategory` (`iscategory_id`, `isparent_id`, `iscategory_code`, `iscategory_desc`, `iscategory_seqno`, `iscategory_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(7, 5, 'PB', '', 10, 1, 10000, '2017-05-15 16:05:57', 10000, '2017-06-06 16:40:20'),
(8, 5, 'MB', '', 10, 1, 10000, '2017-05-15 16:06:09', 10000, '2017-06-06 16:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `db_isscategory`
--

CREATE TABLE `db_isscategory` (
  `isscategory_id` int(11) NOT NULL,
  `issparent_id` int(11) NOT NULL,
  `isscategory_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isscategory_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `isscategory_seqno` int(11) NOT NULL,
  `isscategory_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_isscategory`
--

INSERT INTO `db_isscategory` (`isscategory_id`, `issparent_id`, `isscategory_code`, `isscategory_desc`, `isscategory_seqno`, `isscategory_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 0, 'level 3 category', 'level 3 category', 10, 1, 10000, '2017-06-06 16:52:36', 10000, '2017-06-06 16:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `db_labour`
--

CREATE TABLE `db_labour` (
  `labour_id` int(11) NOT NULL,
  `labour_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labour_sale_price` decimal(15,2) NOT NULL,
  `labour_cost_price` decimal(15,4) NOT NULL,
  `labour_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `labour_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `labour_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_labourline`
--

CREATE TABLE `db_labourline` (
  `labourline_id` int(11) NOT NULL,
  `labour_id` int(11) NOT NULL,
  `labourline_partner_id` int(11) NOT NULL,
  `labourline_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `labourline_saleprice` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_lang`
--

CREATE TABLE `db_lang` (
  `lang_id` int(11) NOT NULL,
  `lang_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `lang_seqno` int(11) NOT NULL,
  `lang_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_leave`
--

CREATE TABLE `db_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_empl_id` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `leave_duration` varchar(150) NOT NULL,
  `leave_datefrom` date NOT NULL,
  `leave_dateto` date NOT NULL,
  `leave_total_day` decimal(10,2) NOT NULL,
  `leave_period_half` text NOT NULL,
  `leave_period_hourly` int(11) NOT NULL,
  `leave_reason` text NOT NULL,
  `leave_approvalstatus` varchar(100) NOT NULL,
  `leave_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_leave`
--

INSERT INTO `db_leave` (`leave_id`, `leave_empl_id`, `leave_type`, `leave_duration`, `leave_datefrom`, `leave_dateto`, `leave_total_day`, `leave_period_half`, `leave_period_hourly`, `leave_reason`, `leave_approvalstatus`, `leave_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(18, 15, 1, 'full_day', '2016-07-25', '2016-07-28', '4.00', '', 0, 'travel', 'Approve', 1, 15, '2016-07-25 09:19:09', 14, '2016-07-25 09:23:43'),
(19, 15, 1, 'half_day', '2016-07-29', '2016-07-29', '0.50', 'second_half', 0, '', 'Pending', 1, 15, '2016-07-25 11:55:47', 15, '2016-07-25 11:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `db_leavetype`
--

CREATE TABLE `db_leavetype` (
  `leavetype_id` int(11) NOT NULL,
  `leavetype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `leavetype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `leavetype_default` int(11) NOT NULL,
  `leavetype_seqno` int(11) NOT NULL,
  `leavetype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_leavetype`
--

INSERT INTO `db_leavetype` (`leavetype_id`, `leavetype_code`, `leavetype_desc`, `leavetype_default`, `leavetype_seqno`, `leavetype_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Annual Leave', 'Annual Leave', 0, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-05 14:43:03'),
(2, 'Medical Leave', 'Medical Leave', 14, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-08 10:35:17'),
(3, 'Hospitalisation Leave', 'Hospitalisation Leave', 60, 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Childcare Leave', 'Childcare Leave', 0, 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Marriage Leave', 'Marriage Leave', 0, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Maternity Leave', 'Maternity Leave', 0, 60, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_logininfo`
--

CREATE TABLE `db_logininfo` (
  `logininfo_id` int(11) NOT NULL,
  `logininfo_empl_id` int(11) NOT NULL,
  `logininfo_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_machine`
--

CREATE TABLE `db_machine` (
  `machine_id` int(11) NOT NULL,
  `machine_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `machine_product_key` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `machine_vendor` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `machine_location` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `machine_account_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `machine_manufacturer` int(11) NOT NULL,
  `machine_plant` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `machine_type` int(11) NOT NULL,
  `machine_country` int(11) NOT NULL,
  `machine_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `machine_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `machine_seqno` int(11) NOT NULL,
  `machine_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_machinetype`
--

CREATE TABLE `db_machinetype` (
  `machinetype_id` int(11) NOT NULL,
  `machinetype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `machinetype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `machinetype_seqno` int(11) NOT NULL,
  `machinetype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_maingroup`
--

CREATE TABLE `db_maingroup` (
  `maingroup_id` int(11) NOT NULL,
  `maingroup_name` varchar(50) NOT NULL,
  `maingroup_remark` text NOT NULL,
  `maingroup_seqno` int(11) NOT NULL,
  `maingroup_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_maingroup`
--

INSERT INTO `db_maingroup` (`maingroup_id`, `maingroup_name`, `maingroup_remark`, `maingroup_seqno`, `maingroup_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'SEA WATER PUMP ASSYs', 'SEA WATER PUMP ASSYs', 0, 1, 10000, '2017-09-05 16:14:01', 10000, '2017-09-11 14:07:18'),
(3, 'SEA WATER STRAINERS', 'SEA WATER STRAINERS', 0, 1, 10000, '2017-09-05 16:28:46', 10000, '2017-09-05 16:28:46'),
(4, 'SEA WATER PUMP ASSY', 'SEA WATER PUMP ASSY', 0, 1, 10000, '2017-09-05 16:46:52', 10000, '2017-09-05 16:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `db_manufacturer`
--

CREATE TABLE `db_manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer_seqno` int(11) NOT NULL,
  `manufacturer_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_markup`
--

CREATE TABLE `db_markup` (
  `markup_id` int(11) NOT NULL,
  `markup_country` int(11) NOT NULL,
  `markup_rate` decimal(10,2) NOT NULL,
  `markup_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` date NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_material`
--

CREATE TABLE `db_material` (
  `material_id` int(11) NOT NULL,
  `material_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `material_category` int(11) NOT NULL,
  `material_sale_price` decimal(15,2) NOT NULL,
  `material_cost_price` decimal(15,4) NOT NULL,
  `material_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `material_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `material_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_materialcategory`
--

CREATE TABLE `db_materialcategory` (
  `materialcategory_id` int(11) NOT NULL,
  `materialcategory_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `materialcategory_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `materialcategory_seqno` int(11) NOT NULL,
  `materialcategory_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_materialline`
--

CREATE TABLE `db_materialline` (
  `materialline_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `materialline_partner_id` int(11) NOT NULL,
  `materialline_saleprice` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_menu`
--

CREATE TABLE `db_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_table` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu_shorttype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu_namecn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menu_istap` int(11) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_isrefno` int(11) NOT NULL,
  `menu_seqno` int(11) NOT NULL,
  `menu_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_menu`
--

INSERT INTO `db_menu` (`menu_id`, `menu_table`, `menu_shorttype`, `menu_name`, `menu_namecn`, `menu_path`, `menu_istap`, `menu_parent`, `menu_isrefno`, `menu_seqno`, `menu_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, '', '', 'Dashboard', '', 'dashboard.php', 0, 0, 0, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(2, '', '', 'Catalog', 'åº“å­˜', '', 0, 0, 0, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(4, '', '', 'Purchase', 'é‡‡è´­', '', 0, 0, 0, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(5, '', '', 'Report', '', '', 0, 0, 0, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(6, '', '', 'Listing', '', '', 0, 0, 0, 60, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(7, '', '', 'Setup', 'è®¾å®š', '', 0, 0, 0, 90, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(8, 'db_product', '', 'Product', '', 'product.php', 0, 2, 0, 30, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(11, 'db_order', 'QT', 'Quotation', 'è¯·æ±‚è¡¨æ ¼', 'quotation.php', 0, 57, 1, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-19 11:03:12'),
(12, 'db_order', 'SO', 'Progress Claim', '', 'sales_order.php', 0, 57, 1, 30, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'db_order', 'GRN', 'Goods Received Note', '', 'grn.php', 0, 4, 1, 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'db_invoice', 'SI', 'Sales Invoice', '', 'sales_invoice.php', 0, 57, 1, 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'db_empl', '', 'Employee', '', 'empl.php', 0, 6, 0, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(19, 'db_outl', '', 'Outlet', '', 'outl.php', 0, 7, 0, 10, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'db_refn', '', 'Reference Number', '', 'refn.php', 0, 7, 0, 103, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(21, 'db_menuprm', '', 'User Control', '', 'permission.php', 0, 7, 0, 102, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(28, 'db_producttype', '', 'Product Type', '', 'producttype.php', 0, 7, 0, 70, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(30, 'db_shipterm', '', 'Shipping Term', '', 'shipterm.php', 0, 7, 0, 90, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(31, 'db_brand', '', 'Product Brand', '', 'brand.php', 0, 7, 0, 75, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(32, 'db_country', '', 'Country', '', 'country.php', 0, 7, 0, 106, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(34, '', '', 'Record Information', '', 'recordinfo.php', 0, 5, 0, 10, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(37, 'db_department', '', 'Department', '', 'department.php', 0, 7, 0, 110, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(38, 'db_expenses', '', 'Expenses', '', 'expenses.php', 0, 7, 0, 120, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(39, 'db_order', 'PO', 'Purchase Order', '', 'purchase_order.php', 0, 4, 1, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(40, 'db_material', '', 'Material', '', 'material.php', 0, 2, 0, 10, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, 'db_cprofile', '', 'Company Profile', '', 'cprofile.php', 0, 7, 0, 101, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(43, 'db_paymentterm', '', 'Payment Term', '', 'paymentterm.php', 0, 7, 0, 111, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, 'db_tranremark', '', 'Transaction Remark', '', 'tranremark.php', 0, 7, 0, 180, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 'db_machinetype', '', 'Leave Type', '', 'leavetype.php', 0, 7, 0, 40, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(46, 'db_machinetype', '', 'Claims Type', '', 'claimstype.php', 0, 7, 0, 40, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(47, '', '', 'Additional', '', 'additional.php', 0, 50, 0, 30, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(48, '', '', 'Deductions', '', 'deductions.php', 0, 50, 0, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(49, 'db_machinetype', '', 'Additional Type', '', 'additionaltype.php', 0, 7, 0, 40, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(50, '', '', 'HR', '', '', 0, 0, 0, 70, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(51, '', '', 'Payroll', '', 'payroll.php', 0, 50, 0, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(52, '', '', 'Project', '', '', 0, 0, 0, 30, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(53, '', '', 'Project', '', 'project.php', 0, 52, 1, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(54, 'db_invoice', 'PI', 'Purchase Invoice', '', 'purchase_invoice.php', 0, 4, 1, 40, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(55, '', '', 'Apply Leave', '', 'leave.php', 0, 50, 0, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(56, '', '', 'Language Setting', '', 'langsetting.php', 0, 7, 0, 80, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(57, '', '', 'Sales', '', '', 0, 0, 0, 30, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-19 11:03:12'),
(58, 'db_order', 'PR', 'Request Form', 'è¯·æ±‚è¡¨æ ¼', 'purchase_request.php', 0, 4, 1, 10, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(59, '', '', 'Claims', '', 'claims.php', 0, 50, 0, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(61, 'db_labour', '', 'Labour', '', 'labour.php', 0, 2, 0, 20, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(62, 'db_partner', '', 'Supplier', '', 'partner.php?type=supplier', 0, 6, 0, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(63, 'db_partner', '', 'Customer', '', 'partner.php?type=customer', 0, 6, 0, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(64, 'db_partner', '', 'Sub-Contractor', '', 'partner.php?type=subcon', 0, 6, 0, 50, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(65, 'db_partner', '', 'Site Coordinator', '', 'partner.php?type=sitecoordinator', 0, 6, 0, 50, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:15'),
(66, 'db_materialcategory', '', 'Material Category', '', 'mcategory.php', 0, 7, 0, 40, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(67, 'db_mscategory', '', 'Material Sub-Category', '', 'mscategory.php', 0, 7, 0, 50, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(68, 'db_msscategory', '', 'Material Sub Sub-Category', '', 'msscategory.php', 0, 7, 0, 60, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(69, 'db_category', '', 'Item Category', '', 'category.php', 0, 7, 0, 104, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(70, 'db_iscategory', '', 'Item Sub-Category', '', 'iscategory.php', 0, 7, 0, 80, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(71, 'db_isscategory', '', 'Item Sub Sub-Category', '', 'isscategory.php', 0, 7, 0, 90, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(72, '', '', 'Equipment', '', 'equipment.php', 0, 2, 0, 40, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(73, 'db_order', 'PO', 'Generating', '', 'purchase_generating.php', 0, 4, 1, 15, 0, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(74, '', '', 'Equipment Transfer', '', 'equiptransfer.php', 0, 52, 0, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(75, 'db_uom', '', 'Uom', '', 'uom.php', 0, 7, 0, 107, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(76, '', '', 'Subcon Submit Claim', '', 'pclaim.php', 0, 52, 1, 30, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(77, '', '', 'QA Certify Claim', '', 'pclaim.php?isqa=1', 0, 52, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:17'),
(78, 'db_invoice', 'CN', 'Sales Credit Note', '', 'sales_cn.php', 0, 57, 1, 60, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(79, 'db_package', '', 'Package', '', 'package.php', 0, 2, 0, 30, 1, 10000, '2017-08-14 15:00:00', 10000, '2017-08-14 15:00:00'),
(80, 'db_productpackage', '', 'Product-Old', '', 'productpackage.php', 0, 2, 0, 10, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(81, 'db_delivery', '', 'Delivery', '', 'delivery.php', 0, 7, 0, 109, 1, 0, '0000-00-00 00:00:00', 10000, '2016-08-15 20:19:16'),
(82, 'db_validity', '', 'Validity', '', 'validity.php', 0, 7, 0, 112, 1, 10000, '2016-08-15 20:19:16', 10000, '2016-08-15 20:19:16'),
(83, 'db_price', '', 'Price', '', 'price.php', 0, 7, 0, 110, 1, 10000, '2017-07-27 20:19:16', 10000, '2017-07-27 20:19:16'),
(84, 'db_order', 'PCN', 'Purchase Credit Note', '', 'purchase_cn.php', 0, 4, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-08-27 20:19:16'),
(85, 'db_order', 'DO', 'Delivery Order', '', 'delivery_order.php', 0, 57, 1, 40, 1, 0, '2017-08-27 20:19:16', 10000, '2017-08-29 20:19:16'),
(86, 'db_maingroup', '', 'Product Group', '', 'productgroup.php', 0, 7, 0, 105, 1, 0, '0000-00-00 00:00:00', 10000, '2016-07-27 20:19:16'),
(87, 'db_country', '', 'Item Country of Origin', '', 'country.php?cat=item', 0, 7, 0, 113, 1, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(88, 'db_transittime', '', 'Transit Time', '', 'transittime.php', 0, 7, 0, 130, 0, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(89, 'db_freightcharge', '', 'Freight Charge', '', 'freightcharge.php', 0, 7, 0, 140, 0, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(90, 'db_pointofdelivery', '', 'Point Of Delivery', '', 'pointofdelivery.php', 0, 7, 0, 140, 0, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(91, 'db_prefix', '', 'Prefix', '', 'prefix.php', 0, 7, 0, 150, 0, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(92, 'db_remarks', '', 'Remarks', '', 'remarks.php', 0, 7, 0, 114, 1, 0, '2017-08-27 20:19:16', 10000, '2017-08-27 20:19:16'),
(93, 'db_order', 'PU', 'Pickup List', '', 'pickup.php', 0, 57, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-08-30 20:19:18'),
(94, 'db_partner', '', 'Sales Invoice Summary Report', '', 'report.php?type=summary', 0, 5, 0, 123, 1, 10000, '2017-10-04 00:00:00', 10000, '2017-10-04 00:00:00'),
(95, 'db_partner', '', 'Sales Invoice Detailed Report', '', 'report.php?type=detailed', 0, 5, 0, 125, 1, 10000, '2017-10-04 00:00:00', 10000, '2017-10-04 00:00:00'),
(96, 'db_partner', '', 'Quotation Summary Report', '', 'report2.php?type=summary', 0, 5, 0, 127, 1, 10000, '2017-11-03 00:00:00', 10000, '2017-11-03 00:00:00'),
(97, 'db_partner', '', 'Quotation Detailed  Report', '', 'report2.php?type=detailed', 0, 5, 0, 129, 1, 10000, '2017-11-03 00:00:00', 10000, '2017-11-03 00:00:00'),
(98, 'db_currency', '', 'Currency', '', 'currency.php', 0, 7, 0, 108, 1, 10000, '2017-11-03 00:00:00', 10000, '2017-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_menuprm`
--

CREATE TABLE `db_menuprm` (
  `menuprm_id` int(11) NOT NULL,
  `menuprm_menu_id` int(11) NOT NULL,
  `menuprm_group_id` int(11) NOT NULL,
  `menuprm_prmcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_menuprm`
--

INSERT INTO `db_menuprm` (`menuprm_id`, `menuprm_menu_id`, `menuprm_group_id`, `menuprm_prmcode`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(657, 34, 1, 'access', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(658, 34, 1, 'create', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(659, 34, 1, 'update', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(660, 34, 1, 'delete', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(661, 34, 1, 'generate', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(662, 34, 1, 'print', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(663, 34, 1, 'approved', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(664, 5, 1, 'access', 10000, '2016-03-15 16:32:35', 10000, '2016-03-15 16:32:35'),
(672, 16, 1, 'access', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(673, 16, 1, 'create', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(674, 16, 1, 'update', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(675, 16, 1, 'delete', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(676, 16, 1, 'generate', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(677, 16, 1, 'print', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(678, 16, 1, 'approved', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(679, 17, 1, 'access', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(680, 17, 1, 'create', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(681, 17, 1, 'update', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(682, 17, 1, 'delete', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(683, 17, 1, 'generate', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(684, 17, 1, 'print', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(685, 17, 1, 'approved', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(686, 18, 1, 'access', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(687, 18, 1, 'create', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(688, 18, 1, 'update', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(689, 18, 1, 'delete', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(690, 18, 1, 'generate', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(691, 18, 1, 'print', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(692, 18, 1, 'approved', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(693, 22, 1, 'access', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(694, 22, 1, 'create', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(695, 22, 1, 'update', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(696, 22, 1, 'delete', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(697, 22, 1, 'generate', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(698, 22, 1, 'print', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(699, 22, 1, 'approved', 10000, '2016-03-15 16:32:42', 10000, '2016-03-15 16:32:42'),
(952, 12, 1, 'access', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(953, 12, 1, 'create', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(954, 12, 1, 'update', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(955, 12, 1, 'generate', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(956, 12, 1, 'print', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(957, 12, 1, 'approved', 10000, '2016-06-02 09:26:42', 10000, '2016-06-02 09:26:42'),
(1010, 9, 1, 'access', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1011, 9, 1, 'create', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1012, 9, 1, 'update', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1013, 9, 1, 'generate', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1014, 9, 1, 'print', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1015, 9, 1, 'approved', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1016, 10, 1, 'access', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1017, 10, 1, 'create', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1018, 10, 1, 'update', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1019, 10, 1, 'generate', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1020, 10, 1, 'print', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1021, 10, 1, 'approved', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1022, 24, 1, 'access', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1023, 24, 1, 'create', 10000, '2016-06-13 16:07:01', 10000, '2016-06-13 16:07:01'),
(1024, 24, 1, 'update', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1025, 24, 1, 'generate', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1026, 24, 1, 'print', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1027, 24, 1, 'approved', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1028, 35, 1, 'access', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1029, 35, 1, 'create', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1030, 35, 1, 'update', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1031, 35, 1, 'generate', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1032, 35, 1, 'print', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1033, 35, 1, 'approved', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1034, 3, 1, 'access', 10000, '2016-06-13 16:07:02', 10000, '2016-06-13 16:07:02'),
(1041, 23, 1, 'access', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1042, 23, 1, 'create', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1043, 23, 1, 'update', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1044, 23, 1, 'generate', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1045, 23, 1, 'print', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1046, 23, 1, 'approved', 10000, '2016-06-13 16:07:15', 10000, '2016-06-13 16:07:15'),
(1728, 19, 1, 'access', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1729, 19, 1, 'create', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1730, 19, 1, 'update', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1731, 19, 1, 'delete', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1732, 19, 1, 'generate', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1733, 19, 1, 'print', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1734, 19, 1, 'approved', 10000, '2016-07-15 15:16:58', 10000, '2016-07-15 15:16:58'),
(1749, 25, 1, 'access', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1750, 25, 1, 'create', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1751, 25, 1, 'update', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1752, 25, 1, 'delete', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1753, 25, 1, 'generate', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1754, 25, 1, 'print', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1755, 25, 1, 'approved', 10000, '2016-07-15 15:16:59', 10000, '2016-07-15 15:16:59'),
(1756, 26, 1, 'access', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1757, 26, 1, 'create', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1758, 26, 1, 'update', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1759, 26, 1, 'delete', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1760, 26, 1, 'generate', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1761, 26, 1, 'print', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1762, 26, 1, 'approved', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1763, 27, 1, 'access', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1764, 27, 1, 'create', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1765, 27, 1, 'update', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1766, 27, 1, 'delete', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1767, 27, 1, 'generate', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1768, 27, 1, 'print', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1769, 27, 1, 'approved', 10000, '2016-07-15 15:17:00', 10000, '2016-07-15 15:17:00'),
(1777, 29, 1, 'access', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1778, 29, 1, 'create', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1779, 29, 1, 'update', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1780, 29, 1, 'delete', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1781, 29, 1, 'generate', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1782, 29, 1, 'print', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1783, 29, 1, 'approved', 10000, '2016-07-15 15:17:01', 10000, '2016-07-15 15:17:01'),
(1805, 33, 1, 'access', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1806, 33, 1, 'create', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1807, 33, 1, 'update', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1808, 33, 1, 'delete', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1809, 33, 1, 'generate', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1810, 33, 1, 'print', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1811, 33, 1, 'approved', 10000, '2016-07-15 15:17:03', 10000, '2016-07-15 15:17:03'),
(1812, 36, 1, 'access', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1813, 36, 1, 'create', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1814, 36, 1, 'update', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1815, 36, 1, 'delete', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1816, 36, 1, 'generate', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1817, 36, 1, 'print', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1818, 36, 1, 'approved', 10000, '2016-07-15 15:17:04', 10000, '2016-07-15 15:17:04'),
(1847, 42, 1, 'access', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1848, 42, 1, 'create', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1849, 42, 1, 'update', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1850, 42, 1, 'delete', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1851, 42, 1, 'generate', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1852, 42, 1, 'print', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1853, 42, 1, 'approved', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1854, 43, 1, 'access', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1855, 43, 1, 'create', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1856, 43, 1, 'update', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1857, 43, 1, 'delete', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1858, 43, 1, 'generate', 10000, '2016-07-15 15:17:06', 10000, '2016-07-15 15:17:06'),
(1859, 43, 1, 'print', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1860, 43, 1, 'approved', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1861, 44, 1, 'access', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1862, 44, 1, 'create', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1863, 44, 1, 'update', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1864, 44, 1, 'delete', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1865, 44, 1, 'generate', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1866, 44, 1, 'print', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1867, 44, 1, 'approved', 10000, '2016-07-15 15:17:07', 10000, '2016-07-15 15:17:07'),
(1982, 32, 1, 'access', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1983, 32, 1, 'create', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1984, 32, 1, 'update', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1985, 32, 1, 'delete', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1986, 32, 1, 'generate', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1987, 32, 1, 'print', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1988, 32, 1, 'approved', 10000, '2016-07-19 10:21:20', 10000, '2016-07-19 10:21:20'),
(1989, 37, 1, 'access', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1990, 37, 1, 'create', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1991, 37, 1, 'update', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1992, 37, 1, 'delete', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1993, 37, 1, 'generate', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1994, 37, 1, 'print', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1995, 37, 1, 'approved', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1996, 38, 1, 'access', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1997, 38, 1, 'create', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1998, 38, 1, 'update', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(1999, 38, 1, 'delete', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(2000, 38, 1, 'generate', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(2001, 38, 1, 'print', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(2002, 38, 1, 'approved', 10000, '2016-07-19 10:21:21', 10000, '2016-07-19 10:21:21'),
(2010, 45, 1, 'access', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2011, 45, 1, 'create', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2012, 45, 1, 'update', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2013, 45, 1, 'delete', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2014, 45, 1, 'generate', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2015, 45, 1, 'print', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2016, 45, 1, 'approved', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2017, 46, 1, 'access', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2018, 46, 1, 'create', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2019, 46, 1, 'update', 10000, '2016-07-19 10:21:22', 10000, '2016-07-19 10:21:22'),
(2020, 46, 1, 'delete', 10000, '2016-07-19 10:21:23', 10000, '2016-07-19 10:21:23'),
(2021, 46, 1, 'generate', 10000, '2016-07-19 10:21:23', 10000, '2016-07-19 10:21:23'),
(2022, 46, 1, 'print', 10000, '2016-07-19 10:21:23', 10000, '2016-07-19 10:21:23'),
(2023, 46, 1, 'approved', 10000, '2016-07-19 10:21:23', 10000, '2016-07-19 10:21:23'),
(2038, 49, 1, 'access', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2039, 49, 1, 'create', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2040, 49, 1, 'update', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2041, 49, 1, 'delete', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2042, 49, 1, 'generate', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2043, 49, 1, 'print', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2044, 49, 1, 'approved', 10000, '2016-07-19 10:21:24', 10000, '2016-07-19 10:21:24'),
(2053, 1, 1, 'access', 10000, '2016-07-19 10:37:31', 10000, '2016-07-19 10:37:31'),
(2144, 1, 4, 'access', 10000, '2016-07-20 21:03:50', 10000, '2016-07-20 21:03:50'),
(2145, 1, 3, 'access', 10000, '2016-07-21 10:49:40', 10000, '2016-07-21 10:49:40'),
(2168, 1, 2, 'access', 10000, '2016-07-21 10:50:14', 10000, '2016-07-21 10:50:14'),
(2196, 47, 1, 'access', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2197, 47, 1, 'create', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2198, 47, 1, 'update', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2199, 47, 1, 'delete', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2200, 47, 1, 'generate', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2201, 47, 1, 'print', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2202, 47, 1, 'approved', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2203, 48, 1, 'access', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2204, 48, 1, 'create', 10000, '2016-07-25 09:13:58', 10000, '2016-07-25 09:13:58'),
(2205, 48, 1, 'update', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2206, 48, 1, 'delete', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2207, 48, 1, 'generate', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2208, 48, 1, 'print', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2209, 48, 1, 'approved', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2210, 51, 1, 'access', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2211, 51, 1, 'create', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2212, 51, 1, 'update', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2213, 51, 1, 'delete', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2214, 51, 1, 'generate', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2215, 51, 1, 'print', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2216, 51, 1, 'approved', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2217, 55, 1, 'access', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2218, 55, 1, 'create', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2219, 55, 1, 'update', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2220, 55, 1, 'delete', 10000, '2016-07-25 09:13:59', 10000, '2016-07-25 09:13:59'),
(2221, 55, 1, 'generate', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2222, 55, 1, 'print', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2223, 55, 1, 'approved', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2224, 59, 1, 'access', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2225, 59, 1, 'create', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2226, 59, 1, 'update', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2227, 59, 1, 'delete', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2228, 59, 1, 'generate', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2229, 59, 1, 'print', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2230, 59, 1, 'approved', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2231, 50, 1, 'access', 10000, '2016-07-25 09:14:00', 10000, '2016-07-25 09:14:00'),
(2232, 47, 4, 'access', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2233, 47, 4, 'create', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2234, 47, 4, 'update', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2235, 47, 4, 'delete', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2236, 47, 4, 'generate', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2237, 47, 4, 'print', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2238, 47, 4, 'approved', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2239, 48, 4, 'access', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2240, 48, 4, 'create', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2241, 48, 4, 'update', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2242, 48, 4, 'delete', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2243, 48, 4, 'generate', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2244, 48, 4, 'print', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2245, 48, 4, 'approved', 10000, '2016-07-25 09:24:25', 10000, '2016-07-25 09:24:25'),
(2246, 51, 4, 'access', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2247, 51, 4, 'create', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2248, 51, 4, 'update', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2249, 51, 4, 'delete', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2250, 51, 4, 'generate', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2251, 51, 4, 'print', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2252, 51, 4, 'approved', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2253, 55, 4, 'access', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2254, 55, 4, 'create', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2255, 55, 4, 'update', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2256, 55, 4, 'delete', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2257, 55, 4, 'generate', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2258, 55, 4, 'print', 10000, '2016-07-25 09:24:26', 10000, '2016-07-25 09:24:26'),
(2259, 55, 4, 'approved', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2260, 59, 4, 'access', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2261, 59, 4, 'create', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2262, 59, 4, 'update', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2263, 59, 4, 'delete', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2264, 59, 4, 'generate', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2265, 59, 4, 'print', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2266, 59, 4, 'approved', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2267, 50, 4, 'access', 10000, '2016-07-25 09:24:27', 10000, '2016-07-25 09:24:27'),
(2268, 55, 2, 'access', 10000, '2016-07-25 09:24:43', 10000, '2016-07-25 09:24:43'),
(2269, 55, 2, 'create', 10000, '2016-07-25 09:24:43', 10000, '2016-07-25 09:24:43'),
(2270, 55, 2, 'update', 10000, '2016-07-25 09:24:43', 10000, '2016-07-25 09:24:43'),
(2271, 55, 2, 'delete', 10000, '2016-07-25 09:24:43', 10000, '2016-07-25 09:24:43'),
(2272, 55, 2, 'generate', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2273, 55, 2, 'print', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2274, 59, 2, 'access', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2275, 59, 2, 'create', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2276, 59, 2, 'update', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2277, 59, 2, 'delete', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2278, 59, 2, 'generate', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2279, 59, 2, 'print', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2280, 50, 2, 'access', 10000, '2016-07-25 09:24:44', 10000, '2016-07-25 09:24:44'),
(2332, 15, 4, 'access', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2333, 15, 4, 'create', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2334, 15, 4, 'update', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2335, 15, 4, 'delete', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2336, 15, 4, 'generate', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2337, 15, 4, 'print', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2338, 15, 4, 'approved', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2339, 6, 4, 'access', 10000, '2016-07-25 09:33:26', 10000, '2016-07-25 09:33:26'),
(2340, 37, 4, 'access', 10000, '2016-07-25 09:35:01', 10000, '2016-07-25 09:35:01'),
(2341, 37, 4, 'create', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2342, 37, 4, 'update', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2343, 37, 4, 'delete', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2344, 37, 4, 'generate', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2345, 37, 4, 'print', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2346, 37, 4, 'approved', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2347, 38, 4, 'access', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2348, 38, 4, 'create', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2349, 38, 4, 'update', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2350, 38, 4, 'delete', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2351, 38, 4, 'generate', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2352, 38, 4, 'print', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2353, 38, 4, 'approved', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2354, 45, 4, 'access', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2355, 45, 4, 'create', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2356, 45, 4, 'update', 10000, '2016-07-25 09:35:02', 10000, '2016-07-25 09:35:02'),
(2357, 45, 4, 'delete', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2358, 45, 4, 'generate', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2359, 45, 4, 'print', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2360, 45, 4, 'approved', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2361, 46, 4, 'access', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2362, 46, 4, 'create', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2363, 46, 4, 'update', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2364, 46, 4, 'delete', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2365, 46, 4, 'generate', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2366, 46, 4, 'print', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2367, 46, 4, 'approved', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2368, 49, 4, 'access', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2369, 49, 4, 'create', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2370, 49, 4, 'update', 10000, '2016-07-25 09:35:03', 10000, '2016-07-25 09:35:03'),
(2371, 49, 4, 'delete', 10000, '2016-07-25 09:35:04', 10000, '2016-07-25 09:35:04'),
(2372, 49, 4, 'generate', 10000, '2016-07-25 09:35:04', 10000, '2016-07-25 09:35:04'),
(2373, 49, 4, 'print', 10000, '2016-07-25 09:35:04', 10000, '2016-07-25 09:35:04'),
(2374, 49, 4, 'approved', 10000, '2016-07-25 09:35:04', 10000, '2016-07-25 09:35:04'),
(2375, 7, 4, 'access', 10000, '2016-07-25 09:35:04', 10000, '2016-07-25 09:35:04'),
(2405, 53, 1, 'access', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2406, 53, 1, 'create', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2407, 53, 1, 'update', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2408, 53, 1, 'delete', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2409, 53, 1, 'generate', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2410, 53, 1, 'print', 13, '2016-08-22 11:41:39', 13, '2016-08-22 11:41:39'),
(2411, 53, 1, 'approved', 13, '2016-08-22 11:41:40', 13, '2016-08-22 11:41:40'),
(2412, 52, 1, 'access', 13, '2016-08-22 11:41:40', 13, '2016-08-22 11:41:40'),
(2476, 60, 1, 'access', 10000, '2016-08-23 20:52:47', 10000, '2016-08-23 20:52:47'),
(2477, 60, 1, 'create', 10000, '2016-08-23 20:52:47', 10000, '2016-08-23 20:52:47'),
(2478, 60, 1, 'update', 10000, '2016-08-23 20:52:47', 10000, '2016-08-23 20:52:47'),
(2479, 60, 1, 'delete', 10000, '2016-08-23 20:52:47', 10000, '2016-08-23 20:52:47'),
(2480, 60, 1, 'generate', 10000, '2016-08-23 20:52:47', 10000, '2016-08-23 20:52:47'),
(2481, 60, 1, 'print', 10000, '2016-08-23 20:52:48', 10000, '2016-08-23 20:52:48'),
(2482, 60, 1, 'approved', 10000, '2016-08-23 20:52:48', 10000, '2016-08-23 20:52:48'),
(2484, 39, 3, 'access', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2485, 39, 3, 'create', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2486, 39, 3, 'update', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2487, 39, 3, 'delete', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2488, 39, 3, 'generate', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2489, 39, 3, 'print', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2490, 39, 3, 'approved', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2491, 58, 3, 'access', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2492, 58, 3, 'create', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2493, 58, 3, 'update', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2494, 58, 3, 'delete', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2495, 58, 3, 'generate', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2496, 58, 3, 'print', 10000, '2016-08-24 09:23:21', 10000, '2016-08-24 09:23:21'),
(2497, 58, 3, 'approved', 10000, '2016-08-24 09:23:22', 10000, '2016-08-24 09:23:22'),
(2498, 4, 3, 'access', 10000, '2016-08-24 09:23:22', 10000, '2016-08-24 09:23:22'),
(2499, 1, 5, 'access', 10000, '2016-08-24 09:26:05', 10000, '2016-08-24 09:26:05'),
(2500, 8, 5, 'access', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2501, 8, 5, 'create', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2502, 8, 5, 'update', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2503, 8, 5, 'delete', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2504, 8, 5, 'generate', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2505, 8, 5, 'print', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2506, 8, 5, 'approved', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2507, 2, 5, 'access', 10000, '2016-08-24 09:26:10', 10000, '2016-08-24 09:26:10'),
(2508, 53, 5, 'access', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2509, 53, 5, 'create', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2510, 53, 5, 'update', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2511, 53, 5, 'delete', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2512, 53, 5, 'generate', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2513, 53, 5, 'print', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2514, 53, 5, 'approved', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2515, 52, 5, 'access', 10000, '2016-08-24 09:26:15', 10000, '2016-08-24 09:26:15'),
(2545, 22, 5, 'access', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2546, 22, 5, 'create', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2547, 22, 5, 'update', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2548, 22, 5, 'delete', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2549, 22, 5, 'generate', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2550, 22, 5, 'print', 10000, '2016-08-24 09:26:44', 10000, '2016-08-24 09:26:44'),
(2551, 22, 5, 'approved', 10000, '2016-08-24 09:26:45', 10000, '2016-08-24 09:26:45'),
(2566, 20, 5, 'access', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2567, 20, 5, 'create', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2568, 20, 5, 'update', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2569, 20, 5, 'delete', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2570, 20, 5, 'generate', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2571, 20, 5, 'print', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2572, 20, 5, 'approved', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2573, 28, 5, 'access', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2574, 28, 5, 'create', 10000, '2016-08-24 09:27:11', 10000, '2016-08-24 09:27:11'),
(2575, 28, 5, 'update', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2576, 28, 5, 'delete', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2577, 28, 5, 'generate', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2578, 28, 5, 'print', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2579, 28, 5, 'approved', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2580, 31, 5, 'access', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2581, 31, 5, 'create', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2582, 31, 5, 'update', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2583, 31, 5, 'delete', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2584, 31, 5, 'generate', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2585, 31, 5, 'print', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2586, 31, 5, 'approved', 10000, '2016-08-24 09:27:12', 10000, '2016-08-24 09:27:12'),
(2587, 7, 5, 'access', 10000, '2016-08-24 09:27:13', 10000, '2016-08-24 09:27:13'),
(2647, 13, 5, 'access', 10000, '2016-08-24 10:17:04', 10000, '2016-08-24 10:17:04'),
(2648, 13, 5, 'create', 10000, '2016-08-24 10:17:04', 10000, '2016-08-24 10:17:04'),
(2649, 13, 5, 'update', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2650, 13, 5, 'delete', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2651, 13, 5, 'generate', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2652, 13, 5, 'print', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2653, 13, 5, 'approved', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2654, 39, 5, 'access', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2655, 39, 5, 'create', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2656, 39, 5, 'update', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2657, 39, 5, 'delete', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2658, 39, 5, 'generate', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2659, 39, 5, 'print', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2660, 39, 5, 'approved', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2661, 54, 5, 'generate', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2662, 58, 5, 'access', 10000, '2016-08-24 10:17:05', 10000, '2016-08-24 10:17:05'),
(2663, 58, 5, 'create', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2664, 58, 5, 'update', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2665, 58, 5, 'delete', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2666, 58, 5, 'generate', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2667, 58, 5, 'print', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2668, 58, 5, 'approved', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2669, 60, 5, 'access', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2670, 60, 5, 'create', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2671, 60, 5, 'update', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2672, 60, 5, 'delete', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2673, 60, 5, 'generate', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2674, 60, 5, 'print', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2675, 60, 5, 'approved', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2676, 4, 5, 'access', 10000, '2016-08-24 10:17:06', 10000, '2016-08-24 10:17:06'),
(2715, 58, 6, 'access', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2716, 58, 6, 'create', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2717, 58, 6, 'update', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2718, 58, 6, 'delete', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2719, 58, 6, 'generate', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2720, 58, 6, 'print', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2721, 58, 6, 'approved', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2722, 4, 6, 'access', 10000, '2016-12-27 17:01:09', 10000, '2016-12-27 17:01:09'),
(2797, 28, 1, 'access', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2798, 28, 1, 'create', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2799, 28, 1, 'update', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2800, 28, 1, 'delete', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2801, 28, 1, 'generate', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2802, 28, 1, 'print', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2803, 28, 1, 'approved', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2804, 30, 1, 'access', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2805, 30, 1, 'create', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2806, 30, 1, 'update', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2807, 30, 1, 'delete', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2808, 30, 1, 'generate', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2809, 30, 1, 'print', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2810, 30, 1, 'approved', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2811, 31, 1, 'access', 10000, '2017-03-28 11:23:25', 10000, '2017-03-28 11:23:25'),
(2812, 31, 1, 'create', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2813, 31, 1, 'update', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2814, 31, 1, 'delete', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2815, 31, 1, 'generate', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2816, 31, 1, 'print', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2817, 31, 1, 'approved', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2825, 56, 1, 'access', 10000, '2017-03-28 11:23:26', 10000, '2017-03-28 11:23:26'),
(2826, 56, 1, 'create', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2827, 56, 1, 'update', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2828, 56, 1, 'delete', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2829, 56, 1, 'generate', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2830, 56, 1, 'print', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2831, 56, 1, 'approved', 10000, '2017-03-28 11:23:27', 10000, '2017-03-28 11:23:27'),
(2940, 20, 1, 'access', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2941, 20, 1, 'create', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2942, 20, 1, 'update', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2943, 20, 1, 'delete', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2944, 20, 1, 'generate', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2945, 20, 1, 'print', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2946, 20, 1, 'approved', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2947, 21, 1, 'access', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2948, 21, 1, 'create', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2949, 21, 1, 'update', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2950, 21, 1, 'delete', 10000, '2017-03-30 11:09:39', 10000, '2017-03-30 11:09:39'),
(2951, 21, 1, 'generate', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2952, 21, 1, 'print', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2953, 21, 1, 'approved', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2954, 41, 1, 'access', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2955, 41, 1, 'create', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2956, 41, 1, 'update', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2957, 41, 1, 'delete', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2958, 41, 1, 'generate', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2959, 41, 1, 'print', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2960, 41, 1, 'approved', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2961, 66, 1, 'access', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2962, 66, 1, 'create', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2963, 66, 1, 'update', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2964, 66, 1, 'delete', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2965, 66, 1, 'generate', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2966, 66, 1, 'print', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2967, 66, 1, 'approved', 10000, '2017-03-30 11:09:40', 10000, '2017-03-30 11:09:40'),
(2968, 67, 1, 'access', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2969, 67, 1, 'create', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2970, 67, 1, 'update', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2971, 67, 1, 'delete', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2972, 67, 1, 'generate', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2973, 67, 1, 'print', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2974, 67, 1, 'approved', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2975, 68, 1, 'access', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2976, 68, 1, 'create', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2977, 68, 1, 'update', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2978, 68, 1, 'delete', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2979, 68, 1, 'generate', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2980, 68, 1, 'print', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2981, 68, 1, 'approved', 10000, '2017-03-30 11:09:41', 10000, '2017-03-30 11:09:41'),
(2982, 69, 1, 'access', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2983, 69, 1, 'create', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2984, 69, 1, 'update', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2985, 69, 1, 'delete', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2986, 69, 1, 'generate', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2987, 69, 1, 'print', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2988, 69, 1, 'approved', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2989, 70, 1, 'access', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2990, 70, 1, 'create', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2991, 70, 1, 'update', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2992, 70, 1, 'delete', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2993, 70, 1, 'generate', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2994, 70, 1, 'print', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2995, 70, 1, 'approved', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2996, 71, 1, 'access', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2997, 71, 1, 'create', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2998, 71, 1, 'update', 10000, '2017-03-30 11:09:42', 10000, '2017-03-30 11:09:42'),
(2999, 71, 1, 'delete', 10000, '2017-03-30 11:09:43', 10000, '2017-03-30 11:09:43'),
(3000, 71, 1, 'generate', 10000, '2017-03-30 11:09:43', 10000, '2017-03-30 11:09:43'),
(3001, 71, 1, 'print', 10000, '2017-03-30 11:09:43', 10000, '2017-03-30 11:09:43'),
(3002, 71, 1, 'approved', 10000, '2017-03-30 11:09:43', 10000, '2017-03-30 11:09:43'),
(3003, 7, 1, 'access', 10000, '2017-03-30 11:09:43', 10000, '2017-03-30 11:09:43'),
(3004, 13, 1, 'access', 10000, '2017-04-03 11:23:50', 10000, '2017-04-03 11:23:50'),
(3005, 13, 1, 'create', 10000, '2017-04-03 11:23:50', 10000, '2017-04-03 11:23:50'),
(3006, 13, 1, 'update', 10000, '2017-04-03 11:23:50', 10000, '2017-04-03 11:23:50'),
(3007, 13, 1, 'delete', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3008, 13, 1, 'generate', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3009, 13, 1, 'print', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3010, 13, 1, 'approved', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3011, 39, 1, 'access', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3012, 39, 1, 'create', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3013, 39, 1, 'update', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3014, 39, 1, 'delete', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3015, 39, 1, 'generate', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3016, 39, 1, 'print', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3017, 39, 1, 'approved', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3018, 54, 1, 'access', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3019, 54, 1, 'create', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3020, 54, 1, 'update', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3021, 54, 1, 'delete', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3022, 54, 1, 'generate', 10000, '2017-04-03 11:23:51', 10000, '2017-04-03 11:23:51'),
(3023, 54, 1, 'print', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3024, 54, 1, 'approved', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3025, 58, 1, 'access', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3026, 58, 1, 'create', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3027, 58, 1, 'update', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3028, 58, 1, 'delete', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3029, 58, 1, 'generate', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3030, 58, 1, 'print', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3031, 58, 1, 'approved', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3032, 4, 1, 'access', 10000, '2017-04-03 11:23:52', 10000, '2017-04-03 11:23:52'),
(3033, 8, 1, 'access', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3034, 8, 1, 'create', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3035, 8, 1, 'update', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3036, 8, 1, 'delete', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3037, 8, 1, 'generate', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3038, 8, 1, 'print', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3039, 8, 1, 'approved', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3040, 40, 1, 'access', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3041, 40, 1, 'create', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3042, 40, 1, 'update', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3043, 40, 1, 'delete', 10000, '2017-04-07 11:57:35', 10000, '2017-04-07 11:57:35'),
(3044, 40, 1, 'generate', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3045, 40, 1, 'print', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3046, 40, 1, 'approved', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3047, 61, 1, 'access', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3048, 61, 1, 'create', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3049, 61, 1, 'update', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3050, 61, 1, 'delete', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3051, 61, 1, 'generate', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3052, 61, 1, 'print', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3053, 61, 1, 'approved', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3054, 72, 1, 'access', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3055, 72, 1, 'create', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3056, 72, 1, 'update', 10000, '2017-04-07 11:57:36', 10000, '2017-04-07 11:57:36'),
(3057, 72, 1, 'delete', 10000, '2017-04-07 11:57:37', 10000, '2017-04-07 11:57:37'),
(3058, 72, 1, 'generate', 10000, '2017-04-07 11:57:37', 10000, '2017-04-07 11:57:37'),
(3059, 72, 1, 'print', 10000, '2017-04-07 11:57:37', 10000, '2017-04-07 11:57:37'),
(3060, 72, 1, 'approved', 10000, '2017-04-07 11:57:37', 10000, '2017-04-07 11:57:37'),
(3061, 2, 1, 'access', 10000, '2017-04-07 11:57:37', 10000, '2017-04-07 11:57:37'),
(3070, 76, 7, 'access', 10000, '2017-07-05 12:10:32', 10000, '2017-07-05 12:10:32'),
(3071, 76, 7, 'create', 10000, '2017-07-05 12:10:32', 10000, '2017-07-05 12:10:32'),
(3072, 76, 7, 'update', 10000, '2017-07-05 12:10:32', 10000, '2017-07-05 12:10:32'),
(3073, 76, 7, 'delete', 10000, '2017-07-05 12:10:33', 10000, '2017-07-05 12:10:33'),
(3074, 76, 7, 'generate', 10000, '2017-07-05 12:10:33', 10000, '2017-07-05 12:10:33'),
(3075, 76, 7, 'print', 10000, '2017-07-05 12:10:33', 10000, '2017-07-05 12:10:33'),
(3076, 76, 7, 'approved', 10000, '2017-07-05 12:10:33', 10000, '2017-07-05 12:10:33'),
(3077, 52, 7, 'access', 10000, '2017-07-05 12:10:33', 10000, '2017-07-05 12:10:33'),
(3078, 15, 1, 'access', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3079, 15, 1, 'create', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3080, 15, 1, 'update', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3081, 15, 1, 'delete', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3082, 15, 1, 'generate', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3083, 15, 1, 'print', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3084, 15, 1, 'approved', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3085, 62, 1, 'access', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59');
INSERT INTO `db_menuprm` (`menuprm_id`, `menuprm_menu_id`, `menuprm_group_id`, `menuprm_prmcode`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(3086, 63, 1, 'access', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3087, 6, 1, 'access', 10000, '2017-08-14 10:32:59', 10000, '2017-08-14 10:32:59'),
(3088, 11, 1, 'access', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3089, 11, 1, 'create', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3090, 11, 1, 'update', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3091, 11, 1, 'delete', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3092, 11, 1, 'generate', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3093, 11, 1, 'print', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3094, 11, 1, 'approved', 10000, '2017-10-27 15:41:52', 10000, '2017-10-27 15:41:52'),
(3095, 14, 1, 'access', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3096, 14, 1, 'create', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3097, 14, 1, 'update', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3098, 14, 1, 'delete', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3099, 14, 1, 'generate', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3100, 14, 1, 'print', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3101, 14, 1, 'approved', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3102, 78, 1, 'access', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3103, 78, 1, 'create', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3104, 78, 1, 'update', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3105, 78, 1, 'delete', 10000, '2017-10-27 15:41:53', 10000, '2017-10-27 15:41:53'),
(3106, 78, 1, 'generate', 10000, '2017-10-27 15:41:54', 10000, '2017-10-27 15:41:54'),
(3107, 78, 1, 'print', 10000, '2017-10-27 15:41:54', 10000, '2017-10-27 15:41:54'),
(3108, 78, 1, 'approved', 10000, '2017-10-27 15:41:54', 10000, '2017-10-27 15:41:54'),
(3109, 85, 1, 'access', 10000, '2017-10-27 15:41:54', 10000, '2017-10-27 15:41:54'),
(3110, 85, 1, 'create', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3111, 85, 1, 'update', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3112, 85, 1, 'delete', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3113, 85, 1, 'generate', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3114, 85, 1, 'print', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3115, 85, 1, 'approved', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3116, 93, 1, 'access', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3117, 93, 1, 'create', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3118, 93, 1, 'update', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3119, 93, 1, 'delete', 10000, '2017-10-27 15:41:55', 10000, '2017-10-27 15:41:55'),
(3120, 93, 1, 'generate', 10000, '2017-10-27 15:41:56', 10000, '2017-10-27 15:41:56'),
(3121, 93, 1, 'print', 10000, '2017-10-27 15:41:56', 10000, '2017-10-27 15:41:56'),
(3122, 93, 1, 'approved', 10000, '2017-10-27 15:41:56', 10000, '2017-10-27 15:41:56'),
(3123, 57, 1, 'access', 10000, '2017-10-27 15:41:56', 10000, '2017-10-27 15:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `db_mscategory`
--

CREATE TABLE `db_mscategory` (
  `mscategory_id` int(11) NOT NULL,
  `msparent_id` int(11) NOT NULL,
  `mscategory_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mscategory_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `mscategory_seqno` int(11) NOT NULL,
  `mscategory_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_msscategory`
--

CREATE TABLE `db_msscategory` (
  `msscategory_id` int(11) NOT NULL,
  `mssparent_id` int(11) NOT NULL,
  `msscategory_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `msscategory_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `msscategory_seqno` int(11) NOT NULL,
  `msscategory_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_nationality`
--

CREATE TABLE `db_nationality` (
  `nationality_id` int(11) NOT NULL,
  `nationality_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nationality_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `nationality_seqno` int(11) NOT NULL,
  `nationality_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_nationality`
--

INSERT INTO `db_nationality` (`nationality_id`, `nationality_code`, `nationality_desc`, `nationality_seqno`, `nationality_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Malaysian', 'Malaysian', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Singaporean', 'Singaporean', 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_order`
--

CREATE TABLE `db_order` (
  `order_id` int(11) NOT NULL,
  `order_outlet` int(11) NOT NULL,
  `order_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_prefix_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_generate_from` int(11) NOT NULL,
  `order_generate_from_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `order_customer` int(11) NOT NULL,
  `order_revtimes` int(11) NOT NULL,
  `order_revdatetime` datetime NOT NULL,
  `order_revby` int(11) NOT NULL,
  `order_salesperson` int(11) NOT NULL,
  `order_billaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `order_attentionto` int(11) NOT NULL,
  `order_attentionto_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_attentionto_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_attentionto_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_shipterm` int(11) NOT NULL,
  `order_term` int(11) NOT NULL,
  `order_tnc` text COLLATE utf8_unicode_ci NOT NULL,
  `order_shipaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `order_shipping_id` int(11) NOT NULL,
  `order_customerref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `order_customerpo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_currency` int(11) NOT NULL,
  `order_currencyrate` decimal(10,4) NOT NULL,
  `order_subtotal` decimal(15,2) NOT NULL,
  `order_disctotal` decimal(15,2) NOT NULL,
  `order_discheadertotal` decimal(15,2) NOT NULL,
  `order_taxtotal` decimal(15,2) NOT NULL,
  `order_grandtotal` decimal(15,2) NOT NULL,
  `order_status` int(11) NOT NULL COMMENT '-1 = REV \r\n0 = DELETE \r\n1 = Active',
  `order_isconfirm` int(11) NOT NULL,
  `order_countprint` int(11) NOT NULL,
  `order_fax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `order_subcon` int(11) NOT NULL,
  `order_paymentterm_id` int(11) NOT NULL,
  `order_paymentterm_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `order_delivery_id` int(11) NOT NULL,
  `order_delivery_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `order_price_id` int(11) NOT NULL,
  `order_price_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `order_validity_id` int(11) NOT NULL,
  `order_validity_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `order_transittime_id` int(11) NOT NULL,
  `order_freightcharge_id` int(11) NOT NULL,
  `order_pointofdelivery_id` int(11) NOT NULL,
  `order_prefix_id` int(11) NOT NULL,
  `order_remarks_id` int(11) NOT NULL,
  `order_country_id` int(11) NOT NULL,
  `order_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_project_id` int(11) NOT NULL,
  `order_delivery_date` date NOT NULL,
  `order_job_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_requestby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_agc_requestby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_approvedby` int(11) NOT NULL,
  `order_verifiedby` int(11) NOT NULL,
  `order_regards` text COLLATE utf8_unicode_ci NOT NULL,
  `order_void_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `order_salesperson_prefix` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_order`
--

INSERT INTO `db_order` (`order_id`, `order_outlet`, `order_type`, `order_prefix_type`, `order_generate_from`, `order_generate_from_type`, `order_no`, `order_date`, `order_customer`, `order_revtimes`, `order_revdatetime`, `order_revby`, `order_salesperson`, `order_billaddress`, `order_attentionto`, `order_attentionto_name`, `order_attentionto_phone`, `order_attentionto_email`, `order_shipterm`, `order_term`, `order_tnc`, `order_shipaddress`, `order_shipping_id`, `order_customerref`, `order_remark`, `order_customerpo`, `order_currency`, `order_currencyrate`, `order_subtotal`, `order_disctotal`, `order_discheadertotal`, `order_taxtotal`, `order_grandtotal`, `order_status`, `order_isconfirm`, `order_countprint`, `order_fax`, `order_notes`, `order_subcon`, `order_paymentterm_id`, `order_paymentterm_remark`, `order_delivery_id`, `order_delivery_remark`, `order_price_id`, `order_price_remark`, `order_validity_id`, `order_validity_remark`, `order_transittime_id`, `order_freightcharge_id`, `order_pointofdelivery_id`, `order_prefix_id`, `order_remarks_id`, `order_country_id`, `order_country`, `order_project_id`, `order_delivery_date`, `order_job_no`, `order_requestby`, `order_agc_requestby`, `order_approvedby`, `order_verifiedby`, `order_regards`, `order_void_remarks`, `order_salesperson_prefix`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(128, -1, '', 'QT', 0, '', 'KC/0022/17-09/TO', '2017-09-15', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '1.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, 0, 0, '', '', 0, 7, '', 2, '', 2, '', 3, '', 1, 1, 1, 1, 2, 32, '', 0, '2017-09-15', '', '', '', 0, 0, 'Thank you.', '', 'EMPLOYEE', 10000, '2017-09-15 17:58:52', 10000, '2017-09-15 17:59:12'),
(129, -1, '', 'DO', 61, 'SI', 'DO/00038-17', '2017-09-15', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, 0, 0, '', '', 0, 7, '', 2, '', 2, '', 3, '', 1, 1, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, 'Thank you.', '', '', 10000, '2017-09-15 17:59:27', 10000, '2017-09-15 17:59:27'),
(130, -1, '', 'PU', 129, 'DO', 'PU/00041-17', '2017-09-15', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, 0, 0, '', '', 0, 7, '', 2, '', 2, '', 3, '', 1, 1, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, 'Thank you.', '', 'EMPLOYEE', 10000, '2017-09-15 17:59:36', 10000, '2017-09-15 17:59:36'),
(131, -1, '', 'PO', 0, '', 'PO/170900088', '2017-09-15', 92, 0, '0000-00-00 00:00:00', 0, 15, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '1.0000', '24.00', '0.00', '0.00', '1.68', '25.68', 1, 0, 0, '', '', 0, 9, '', 1, '', 3, '', 1, '', 3, 3, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-15 18:00:51', 10000, '2017-09-15 18:01:00'),
(132, -1, '', 'GRN', 131, 'PO', 'GRN00083', '2017-09-15', 92, 0, '0000-00-00 00:00:00', 0, 15, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, ' Excluded mobile scafolding and stagging work.\r\n All quantities based on final site measurment.\r\n All works carry without paint finish.\r\n All amount shown is subject to GST.', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '1.0000', '24.00', '0.00', '0.00', '1.68', '25.68', 1, 0, 0, '', '', 0, 9, '', 1, '', 3, '', 1, '', 3, 3, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-15 18:01:03', 10000, '2017-09-15 18:01:03'),
(133, -1, '', 'QT', 0, '', 'KC/0023/17-09/TO', '2017-09-29', 93, 0, '0000-00-00 00:00:00', 0, 19, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '1.0000', '669.50', '0.00', '0.00', '46.87', '716.37', 1, 0, 0, '', '', 0, 3, '', 2, '', 2, '', 1, '', 1, 1, 1, 1, 2, 32, '', 0, '2017-09-27', '', '', '', 0, 0, '', '', '', 10000, '2017-09-27 09:19:00', 10000, '2017-09-27 15:05:57'),
(134, -1, '', 'DO', 85, 'SI', 'DO/00039-17', '2017-09-27', 93, 0, '0000-00-00 00:00:00', 0, 19, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '669.50', '0.00', '0.00', '46.87', '716.37', 1, 0, 0, '', '', 0, 3, '', 2, '', 2, '', 1, '', 1, 1, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-09-27 09:22:20', 10000, '2017-09-27 09:22:20'),
(135, -1, '', 'PU', 134, 'DO', 'PU/00042-17', '2017-09-27', 93, 0, '0000-00-00 00:00:00', 0, 19, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '669.50', '0.00', '0.00', '46.87', '716.37', 1, 0, 0, '', '', 0, 3, '', 2, '', 2, '', 1, '', 1, 1, 1, 1, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-27 09:24:44', 10000, '2017-09-27 09:24:44'),
(136, -1, '', 'PO', 0, '', 'PO/170900089', '2017-09-27', 92, 0, '0000-00-00 00:00:00', 0, 0, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '1.0000', '360.00', '0.00', '0.00', '25.20', '385.20', 1, 0, 0, '', '', 0, 6, '', 1, '', 3, '', 1, '', 1, 2, 1, 2, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-27 09:27:28', 10000, '2017-09-27 09:27:50'),
(137, -1, '', 'GRN', 136, 'PO', 'GRN00084', '2017-09-27', 92, 0, '0000-00-00 00:00:00', 0, 0, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '1.0000', '360.00', '0.00', '0.00', '25.20', '385.20', 1, 0, 0, '', '', 0, 6, '', 1, '', 3, '', 1, '', 1, 2, 1, 2, 2, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-27 09:27:58', 10000, '2017-09-27 09:27:58'),
(138, -1, '', 'DO', 86, 'eSI', 'DO/00040-17', '2017-09-27', 94, 0, '0000-00-00 00:00:00', 0, 0, '636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', 0, 'Nasirah Luddin', '94554817', 'alvapierre@hotmail.com', 0, 0, '', '636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', 0, '', 'e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', '', 0, '0.0000', '228.00', '0.00', '0.00', '15.96', '243.96', 1, 0, 0, '', '', 0, 8, '', 4, '', 3, '', 1, '', 3, 3, 1, 2, 3, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-09-27 10:09:34', 10000, '2017-09-27 10:09:34'),
(139, -1, '', 'PU', 138, 'DO', 'PU/00043-17', '2017-09-27', 94, 0, '0000-00-00 00:00:00', 0, 0, '', 0, 'Nasirah Luddin', '94554817', 'alvapierre@hotmail.com', 0, 0, '', '636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', 0, '', 'e-SO 41, customer from e-commerce: \r\nNasirah Luddin \r\nalvapierre@hotmail.com \r\n94554817 \r\n636 Hougang Avenue 8 #03-91  \r\n630636 Singapore Singapore', '', 0, '0.0000', '228.00', '0.00', '0.00', '15.96', '243.96', 1, 0, 0, '', '', 0, 8, '', 4, '', 3, '', 1, '', 3, 3, 1, 2, 3, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-09-27 10:10:02', 10000, '2017-09-27 10:10:02'),
(140, -1, '', 'QT', 0, '', 'KC/0024/17-10/TO', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, 'xdfxdf', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 2, '', 3, '', 1, '', 1, '', 1, 1, 1, 2, 1, 32, '', 0, '2017-10-27', '', '', '', 0, 0, 'dfgh', '', '', 10000, '2017-10-27 14:52:32', 10000, '2017-10-27 14:58:15'),
(141, -1, '', 'DO', 91, 'SI', 'DO/00041-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, 'xdfxdf', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 2, '', 3, '', 1, '', 1, '', 1, 1, 1, 2, 1, 32, '', 0, '0000-00-00', '', '', '', 0, 0, 'dfgh', '', '', 10000, '2017-10-27 15:07:01', 10000, '2017-10-27 15:07:01'),
(142, -1, '', 'QT', 0, '', 'KC/0025/17-10/TO', '2017-10-27', 95, 0, '0000-00-00 00:00:00', 0, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '6322 6550', '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, '1.0000', '25.00', '0.00', '0.00', '1.75', '26.75', 1, 0, 0, '', '', 0, 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, '2017-10-27', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-10-27 15:12:54', 10000, '2017-10-27 15:20:32'),
(143, -1, '', 'DO', 92, 'SI', 'DO/00042-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '100.00', '0.00', '0.00', '7.00', '107.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-10-27 15:17:44', 10000, '2017-10-27 15:17:44'),
(144, -1, '', 'DO', 92, 'SI', 'DO/00043-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '100.00', '0.00', '0.00', '7.00', '107.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-10-27 15:17:53', 10000, '2017-10-27 15:17:54'),
(145, -1, '', 'DO', 93, 'SI', 'DO/00044-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '404.60', '0.00', '0.00', '28.32', '432.92', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-10-27 15:20:11', 10000, '2017-10-27 15:20:11'),
(146, -1, '', 'PU', 145, 'DO', 'PU/00044-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '0.0000', '404.60', '0.00', '0.00', '28.32', '432.92', 0, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-10-27 15:25:00', 10000, '2017-11-03 11:45:42'),
(147, -1, '', 'DO', 95, 'SI', 'DO/00045-17', '2017-10-27', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 26, 'ccsd', 'd', '', 0, 0, '', ' ', 0, '', '', '', 0, '0.0000', '15.00', '0.00', '0.00', '1.05', '16.05', 1, 0, 0, 'sdcsd', '', 0, 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-10-27 16:00:37', 10000, '2017-10-27 16:00:37'),
(148, -1, '', 'QT', 0, '', 'KC/0026/17-11', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '1.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, 0, 0, '', '', 0, 1, '', 1, '', 1, '', 1, '', 1, 1, 1, 1, 1, 32, '', 0, '2017-11-03', '', '', '', 0, 0, 'KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', 'EMPLOYEE', 10000, '2017-11-03 10:45:31', 10000, '2017-11-03 10:51:17'),
(149, -1, '', 'DO', 96, 'SI', 'DO/00046-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, 'KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', '', 10000, '2017-11-03 10:54:25', 10000, '2017-11-03 10:54:25'),
(150, -1, '', 'PU', 149, 'DO', 'PU/00045-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 22, 'Edward', '81354729', 'edward@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, 'KC/0026/17-11\r\nEdward\r\nGotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', 'EMPLOYEE', 10000, '2017-11-03 10:54:45', 10000, '2017-11-03 10:54:45'),
(151, -1, '', 'DO', 97, 'SI', 'DO/00047-17', '2017-11-03', 95, 0, '0000-00-00 00:00:00', 0, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, 'William', '94554817', 'alvapierre@hotmail.com', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 4, '4.0000', '95.00', '0.00', '0.00', '6.65', '101.65', 1, 0, 0, '94554817', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-11-03 10:56:17', 10000, '2017-11-03 10:56:17'),
(152, -1, '', 'PU', 151, 'DO', 'PU/00046-17', '2017-11-03', 95, 0, '0000-00-00 00:00:00', 0, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, 'William', '94554817', 'alvapierre@hotmail.com', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 4, '4.0000', '95.00', '0.00', '0.00', '6.65', '101.65', 0, 0, 0, '94554817', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-11-03 10:56:29', 10000, '2017-11-03 11:45:25'),
(153, -1, '', 'PO', 0, '', 'PO/171100090', '2017-11-03', 92, 0, '0000-00-00 00:00:00', 0, 15, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 4, '1.0000', '32.00', '0.00', '0.00', '2.24', '34.24', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-11-03 10:57:17', 10000, '2017-11-03 11:00:05'),
(154, -1, '', 'QT', 0, '', 'KC/0027/17-11', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 27, 'Jason', ' c c', ' ', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 2, '1.0000', '1190.00', '100.00', '0.00', '76.30', '1166.30', 1, 0, 0, 'c c ', '', 0, 1, '', 1, '', 1, '', 1, '', 1, 2, 1, 1, 1, 33, '', 0, '2017-11-03', '', '', '', 0, 0, '', '', '', 10000, '2017-11-03 11:02:04', 10000, '2017-11-03 11:31:51'),
(155, -1, '', 'DO', 98, 'SI', 'DO/00048-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 27, 'Jason', ' c c', ' ', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 2, '2.0000', '1190.00', '100.00', '0.00', '76.30', '1166.30', 1, 0, 0, 'c c ', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-11-03 11:43:59', 10000, '2017-11-03 11:43:59'),
(156, -1, '', 'PU', 155, 'DO', 'PU/00047-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 27, 'Jason', ' c c', ' ', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 2, '2.0000', '1190.00', '100.00', '0.00', '76.30', '1166.30', 0, 0, 0, 'c c ', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-11-03 11:44:23', 10000, '2017-11-03 11:44:49'),
(157, -1, '', 'QT', 0, '', 'KC/0028/17-11', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 23, 'Emily', '81366729', 'emily@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '1.0000', '206.00', '0.00', '0.00', '14.42', '220.42', 1, 0, 0, '', 'KC/0028/17-11 for Emily', 0, 1, '', 1, '', 1, '', 1, '', 0, 0, 0, 0, 5, 32, '', 0, '2017-11-03', '', '', '', 0, 0, 'Thank you for your inquiry dated 3-Nov-2017, we are pleased to quote as follows : ', '', '', 10000, '2017-11-03 16:35:46', 10000, '2017-11-03 16:36:23'),
(158, -1, '', 'DO', 99, 'SI', 'DO/00049-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 23, 'Emily', '81366729', 'emily@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', 'PO000012A', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, 0, 0, '', 'KC/0028/17-11 for Emily', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(159, -1, '', 'PU', 158, 'DO', 'PU/00048-17', '2017-11-03', 93, 0, '0000-00-00 00:00:00', 0, 13, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 23, 'Emily', '81366729', 'emily@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', 'PO000012A', 4, '4.0000', '446.00', '0.00', '0.00', '31.22', '477.22', 1, 0, 0, '', 'KC/0028/17-11 for Emily', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-11-03 16:39:32', 10000, '2017-11-03 16:42:16'),
(160, -1, '', 'QT', 0, '', 'KC/0029/17-12', '2017-12-13', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 5, '', 2, '', 0, '', 0, 0, 0, 0, 3, 33, '', 0, '2017-12-13', '', '', '', 0, 0, '', '', '', 10000, '2017-12-13 13:48:16', 10000, '2017-12-13 14:19:10'),
(161, -1, '', 'DO', 100, 'SI', 'DO/00050-17', '2017-12-13', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '4.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-12-13 14:21:26', 10000, '2017-12-19 12:48:18'),
(162, -1, '', 'PU', 161, 'DO', 'PU/00049-17', '2017-12-13', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '4.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-13 14:21:54', 10000, '2017-12-13 14:21:54'),
(163, -1, '', 'QT', 0, '', 'KC/0030/17-12', '2017-12-13', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '2017-12-13', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-13 14:25:47', 10000, '2017-12-13 14:25:47'),
(164, -1, '', 'GRN', 153, 'PO', 'GRN00085', '2017-12-13', 92, 0, '0000-00-00 00:00:00', 0, 15, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 4, '1.0000', '32.00', '0.00', '0.00', '2.24', '34.24', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-13 14:29:42', 10000, '2017-12-13 14:29:42'),
(165, -1, '', 'GRN', 153, 'PO', 'GRN00086', '2017-12-13', 92, 0, '0000-00-00 00:00:00', 0, 15, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 25, 'Felicia', '81924589', 'felicia@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 4, '1.0000', '32.00', '0.00', '0.00', '2.24', '34.24', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-13 14:31:12', 10000, '2017-12-13 14:31:12'),
(166, -1, '', 'QT', 0, '', 'KC/0031/17-12', '2017-12-19', 95, 0, '0000-00-00 00:00:00', 0, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '6322 6550', '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, '1.0000', '70.00', '0.00', '0.00', '4.90', '74.90', 1, 0, 0, '', '', 0, 1, '', 2, '', 2, '', 1, '', 0, 0, 0, 0, 2, 0, '', 0, '2017-12-19', '', '', '', 0, 0, '', '', '', 10000, '2017-12-19 12:38:09', 10000, '2017-12-20 10:56:58'),
(167, -1, '', 'PU', 161, 'DO', 'PU/00050-17', '2017-12-19', 93, 0, '0000-00-00 00:00:00', 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '62437519', 'enquiry@alphadesign.com.sg', 0, 0, '', 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', 0, '', '', '', 4, '4.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-19 12:45:13', 10000, '2017-12-19 12:45:14'),
(168, -1, '', 'DO', 104, 'SI', 'DO/00051-17', '2017-12-19', 95, 0, '0000-00-00 00:00:00', 0, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '12465798ssg', 2, '2.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', '', 10000, '2017-12-19 12:57:06', 10000, '2017-12-19 12:57:06'),
(169, -1, '', 'PO', 0, '', 'PO/171200091', '2017-12-19', 92, 0, '0000-00-00 00:00:00', 0, 0, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '6791423', 'enquiry@cclaw.com.sg', 0, 0, '', '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', 0, '', '', '', 0, '1.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-19 13:00:34', 10000, '2017-12-19 13:00:34'),
(170, -1, '', 'PU', 168, 'DO', 'PU/00051-17', '2017-12-20', 95, 0, '0000-00-00 00:00:00', 0, 0, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '12465798ssg', 2, '2.0000', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, 0, '', '', 0, 0, '', 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', '', 0, 0, '', '', 'EMPLOYEE', 10000, '2017-12-20 18:15:08', 10000, '2017-12-20 18:15:08'),
(171, -1, '', 'QT', 0, '', 'KC/0032/18-01', '2018-01-23', 95, 0, '0000-00-00 00:00:00', 0, 15, '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '6322 6550', '', 0, 0, '', '18 Kallang Terrace,\r\nSingapore 538977', 0, '', '', '', 0, '1.0000', '106.00', '0.00', '6.00', '7.00', '107.00', 1, 0, 0, '', '', 0, 1, '', 1, '', 1, '', 1, '', 0, 0, 0, 0, 1, 32, '', 0, '2018-01-23', '', '', '', 0, 0, 'Regards,\r\n\r\nThank Yous', '', '', 10000, '2018-01-23 15:56:13', 10000, '2018-01-23 17:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `db_ordl`
--

CREATE TABLE `db_ordl` (
  `ordl_id` int(11) NOT NULL,
  `ordl_order_id` int(11) NOT NULL,
  `ordl_parent` int(11) NOT NULL,
  `ordl_parent_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ordl_item_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ordl_pro_no` text COLLATE utf8_unicode_ci NOT NULL,
  `ordl_pro_id` int(11) NOT NULL,
  `ordl_pro_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `ordl_qty` decimal(10,2) NOT NULL,
  `ordl_uom` int(11) NOT NULL,
  `ordl_markup` decimal(10,2) NOT NULL,
  `ordl_fuprice` decimal(15,2) NOT NULL,
  `ordl_uprice` decimal(15,2) NOT NULL,
  `ordl_disc` decimal(10,2) NOT NULL,
  `ordl_discamt` decimal(15,2) NOT NULL,
  `ordl_fdiscamt` decimal(15,2) NOT NULL,
  `ordl_istax` int(11) NOT NULL,
  `ordl_taxamt` decimal(15,2) NOT NULL,
  `ordl_ftaxamt` decimal(15,2) NOT NULL,
  `ordl_ftotal` decimal(15,2) NOT NULL,
  `ordl_pfuprice` decimal(10,2) NOT NULL,
  `ordl_total` decimal(15,2) NOT NULL,
  `ordl_product_location` text COLLATE utf8_unicode_ci NOT NULL,
  `ordl_seqno` int(11) NOT NULL,
  `ordl_pro_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `ordl_cancel_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `ordl_delivery_date` date NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_ordl`
--

INSERT INTO `db_ordl` (`ordl_id`, `ordl_order_id`, `ordl_parent`, `ordl_parent_type`, `ordl_item_type`, `ordl_pro_no`, `ordl_pro_id`, `ordl_pro_desc`, `ordl_qty`, `ordl_uom`, `ordl_markup`, `ordl_fuprice`, `ordl_uprice`, `ordl_disc`, `ordl_discamt`, `ordl_fdiscamt`, `ordl_istax`, `ordl_taxamt`, `ordl_ftaxamt`, `ordl_ftotal`, `ordl_pfuprice`, `ordl_total`, `ordl_product_location`, `ordl_seqno`, `ordl_pro_remark`, `ordl_cancel_remark`, `ordl_delivery_date`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(424, 128, 0, '', 'product', '', 1, 'Impeller', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-15 17:59:12', 10000, '2017-09-15 17:59:12'),
(425, 129, 155, 'Invoice', 'product', '', 1, 'Impeller', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-15 17:59:27', 10000, '2017-09-15 17:59:27'),
(426, 130, 425, 'Order', 'product', '', 1, 'Impeller', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-15 17:59:36', 10000, '2017-09-15 17:59:36'),
(427, 131, 0, '', 'product', '', 1, 'Impeller', '2.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '24.00', '0.00', '24.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-15 18:01:00', 10000, '2017-09-15 18:01:00'),
(428, 132, 427, 'Order', 'product', '', 1, 'Impeller', '2.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '24.00', '0.00', '24.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-15 18:01:03', 10000, '2017-09-15 18:01:03'),
(429, 133, 0, '', 'product', '', 1, 'Impeller\n\nAbout # to # days, Ex-Stock Depot subject to prior sale.\n', '8.00', 8, '0.00', '17.50', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '140.00', '0.00', '140.00', '', 10, '8 qty', '', '0000-00-00', 10000, '2017-09-27 09:19:33', 10000, '2017-09-27 15:01:32'),
(430, 133, 0, '', 'package', '', 34, 'Impeller', '2.00', 13, '0.00', '122.00', '122.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '244.00', '0.00', '244.00', '', 10, '2 packs', '', '0000-00-00', 10000, '2017-09-27 09:20:18', 10000, '2017-09-27 09:20:18'),
(431, 133, 0, '', 'product', '', 5, 'Impeller', '10.00', 13, '0.00', '28.55', '28.55', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '285.50', '0.00', '285.50', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:20:45', 10000, '2017-09-27 09:20:45'),
(432, 134, 181, 'Invoice', 'product', '', 1, 'Impeller', '8.00', 8, '0.00', '17.50', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '140.00', '0.00', '140.00', '', 10, '8 qty', '', '0000-00-00', 10000, '2017-09-27 09:22:20', 10000, '2017-09-27 09:22:20'),
(433, 134, 182, 'Invoice', 'package', '', 34, 'Impeller', '2.00', 13, '0.00', '122.00', '122.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '244.00', '0.00', '244.00', '', 10, '2 packs', '', '0000-00-00', 10000, '2017-09-27 09:22:20', 10000, '2017-09-27 09:22:20'),
(434, 134, 183, 'Invoice', 'product', '', 5, 'Impeller', '10.00', 13, '0.00', '28.55', '28.55', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '285.50', '0.00', '285.50', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:22:21', 10000, '2017-09-27 09:22:21'),
(435, 135, 432, 'Order', 'product', '', 1, 'Impeller', '8.00', 8, '0.00', '17.50', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '140.00', '0.00', '140.00', '', 10, '8 qty', '', '0000-00-00', 10000, '2017-09-27 09:24:44', 10000, '2017-09-27 09:24:44'),
(436, 135, 433, 'Order', 'package', '', 34, 'Impeller', '2.00', 13, '0.00', '122.00', '122.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '244.00', '0.00', '244.00', '', 10, '2 packs', '', '0000-00-00', 10000, '2017-09-27 09:24:44', 10000, '2017-09-27 09:24:44'),
(437, 135, 434, 'Order', 'product', '', 5, 'Impeller', '10.00', 13, '0.00', '28.55', '28.55', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '285.50', '0.00', '285.50', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:24:45', 10000, '2017-09-27 09:24:45'),
(438, 136, 0, '', 'product', '', 1, 'Impeller', '10.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:27:42', 10000, '2017-09-27 09:27:42'),
(439, 136, 0, '', 'product', '', 5, 'Impeller', '12.00', 8, '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '240.00', '0.00', '240.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:27:49', 10000, '2017-09-27 09:27:49'),
(440, 137, 438, 'Order', 'product', '', 1, 'Impeller', '10.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:27:58', 10000, '2017-09-27 09:27:58'),
(441, 137, 439, 'Order', 'product', '', 5, 'Impeller', '12.00', 8, '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '240.00', '0.00', '240.00', '', 10, '', '', '0000-00-00', 10000, '2017-09-27 09:27:58', 10000, '2017-09-27 09:27:58'),
(442, 138, 184, 'Invoice', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01', '1.00', 0, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '120.00', '0.00', '120.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:09:34', 10000, '2017-09-27 10:09:34'),
(443, 138, 185, 'Invoice', 'product', '', 9, '3/8&quot;, NPT, 7050-01', '1.00', 0, '0.00', '52.00', '52.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '52.00', '0.00', '52.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:09:34', 10000, '2017-09-27 10:09:34'),
(444, 138, 186, 'Invoice', 'product', '', 5, 'Impeller', '2.00', 0, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '56.00', '0.00', '56.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:09:34', 10000, '2017-09-27 10:09:34'),
(445, 139, 442, 'Order', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01', '1.00', 0, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '120.00', '0.00', '120.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:10:02', 10000, '2017-09-27 10:10:02'),
(446, 139, 443, 'Order', 'product', '', 9, '3/8&quot;, NPT, 7050-01', '1.00', 0, '0.00', '52.00', '52.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '52.00', '0.00', '52.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:10:03', 10000, '2017-09-27 10:10:03'),
(447, 139, 444, 'Order', 'product', '', 5, 'Impeller', '2.00', 0, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '56.00', '0.00', '56.00', '', 0, '', '', '0000-00-00', 10000, '2017-09-27 10:10:03', 10000, '2017-09-27 10:10:03'),
(448, 142, 0, '', 'product', '', 12, 'gasket', '1.00', 8, '0.00', '10.00', '10.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '10.00', '0.00', '10.00', '', 10, '', '', '0000-00-00', 10000, '2017-10-27 15:19:17', 10000, '2017-10-27 15:19:17'),
(449, 145, 190, 'Invoice', 'product', '', 8, '1-1/2&quot;, BSP', '5.00', 8, '0.00', '70.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '350.00', '0.00', '350.00', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:20:11', 10000, '2017-10-27 15:20:11'),
(450, 145, 191, 'Invoice', 'product', '', 10, '3/8&quot;, Hose, 7051-01', '1.00', 8, '0.00', '39.60', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '39.60', '0.00', '39.60', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:20:11', 10000, '2017-10-27 15:20:11'),
(451, 145, 192, 'Invoice', 'product', '', 11, 'Flat Shipping Rate', '1.00', 8, '0.00', '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:20:11', 10000, '2017-10-27 15:20:11'),
(452, 142, 0, '', 'product', '', 1, 'Impeller', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 10, '', '', '0000-00-00', 10000, '2017-10-27 15:20:32', 10000, '2017-10-27 15:20:32'),
(453, 146, 449, 'Order', 'product', '', 8, '1-1/2&quot;, BSP', '5.00', 8, '0.00', '70.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '350.00', '0.00', '350.00', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:25:00', 10000, '2017-10-27 15:25:00'),
(454, 146, 450, 'Order', 'product', '', 10, '3/8&quot;, Hose, 7051-01', '1.00', 8, '0.00', '39.60', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '39.60', '0.00', '39.60', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:25:00', 10000, '2017-10-27 15:25:00'),
(455, 146, 451, 'Order', 'product', '', 11, 'Flat Shipping Rate', '1.00', 8, '0.00', '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 15:25:01', 10000, '2017-10-27 15:25:01'),
(456, 147, 195, 'Invoice', 'product', '', 1, 'Impeller', '1.00', 8, '0.00', '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', '', 0, '', '', '0000-00-00', 10000, '2017-10-27 16:00:38', 10000, '2017-10-27 16:00:38'),
(457, 148, 0, '', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '2.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '30.00', '0.00', '30.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:50:56', 10000, '2017-11-03 10:50:56'),
(458, 148, 0, '', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '2.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '56.00', '0.00', '56.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:51:07', 10000, '2017-11-03 10:51:07'),
(459, 148, 0, '', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)', '3.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '360.00', '0.00', '360.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:51:17', 10000, '2017-11-03 10:51:17'),
(460, 149, 196, 'Invoice', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '2.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '30.00', '0.00', '30.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:25', 10000, '2017-11-03 10:54:25'),
(461, 149, 197, 'Invoice', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '2.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '56.00', '0.00', '56.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:25', 10000, '2017-11-03 10:54:25'),
(462, 149, 198, 'Invoice', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)', '3.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '360.00', '0.00', '360.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:26', 10000, '2017-11-03 10:54:26'),
(463, 150, 460, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '2.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '30.00', '0.00', '30.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:45', 10000, '2017-11-03 10:54:45'),
(464, 150, 461, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '2.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '56.00', '0.00', '56.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:45', 10000, '2017-11-03 10:54:45'),
(465, 150, 462, 'Order', 'product', '', 7, '2&quot;, Flange, M-seal, Imp 8201-01 (from California, USA)', '3.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '360.00', '0.00', '360.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:54:46', 10000, '2017-11-03 10:54:46'),
(466, 151, 199, 'Invoice', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:17', 10000, '2017-11-03 10:56:17'),
(467, 151, 200, 'Invoice', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:17', 10000, '2017-11-03 10:56:17'),
(468, 151, 201, 'Invoice', 'product', '', 9, '3/8&quot;, NPT, 7050-01 (from New York)', '1.00', 8, '0.00', '52.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '52.00', '0.00', '52.00', 'New York, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:17', 10000, '2017-11-03 10:56:17'),
(469, 152, 466, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:29', 10000, '2017-11-03 10:56:29'),
(470, 152, 467, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:29', 10000, '2017-11-03 10:56:29'),
(471, 152, 468, 'Order', 'product', '', 9, '3/8&quot;, NPT, 7050-01 (from New York)', '1.00', 8, '0.00', '52.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '52.00', '0.00', '52.00', 'New York, USA', 0, '', '', '0000-00-00', 10000, '2017-11-03 10:56:29', 10000, '2017-11-03 10:56:29'),
(472, 153, 0, '', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '12.00', '0.00', '12.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 10:57:27', 10000, '2017-11-03 10:57:27'),
(473, 153, 0, '', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '0.00', '20.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:00:05', 10000, '2017-11-03 11:00:05'),
(474, 154, 0, '', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 8, '0.00', '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '0.00', '70.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:02:21', 10000, '2017-11-03 11:02:21'),
(475, 154, 0, '', 'product', '', 6, '1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)', '5.00', 13, '0.00', '200.00', '0.00', '10.00', '100.00', '100.00', 1, '0.00', '0.00', '900.00', '0.00', '900.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:02:34', 10000, '2017-11-03 11:03:12'),
(476, 154, 0, '', 'package', '', 34, 'Impeller', '1.00', 13, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:31:51', 10000, '2017-11-03 11:31:51'),
(477, 155, 202, 'Invoice', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 8, '0.00', '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '0.00', '70.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:43:59', 10000, '2017-11-03 11:43:59'),
(478, 155, 203, 'Invoice', 'product', '', 6, '1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)', '5.00', 13, '0.00', '200.00', '0.00', '10.00', '100.00', '100.00', 1, '0.00', '0.00', '900.00', '0.00', '900.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:43:59', 10000, '2017-11-03 11:43:59'),
(479, 155, 204, 'Invoice', 'package', '', 34, 'Impeller', '1.00', 13, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:43:59', 10000, '2017-11-03 11:43:59'),
(480, 156, 477, 'Order', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 8, '0.00', '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '0.00', '70.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:44:23', 10000, '2017-11-03 11:44:23'),
(481, 156, 478, 'Order', 'product', '', 6, '1-1/2&quot;, Flange, SHA 25mm, M-seal, Imp 8101-01 (from California, USA)', '5.00', 13, '0.00', '200.00', '0.00', '10.00', '100.00', '100.00', 1, '0.00', '0.00', '900.00', '0.00', '900.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:44:24', 10000, '2017-11-03 11:44:24'),
(482, 156, 479, 'Order', 'package', '', 34, 'Impeller', '1.00', 13, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 11:44:24', 10000, '2017-11-03 11:44:24'),
(483, 157, 0, '', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:36:03', 10000, '2017-11-03 16:36:03'),
(484, 157, 0, '', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:36:08', 10000, '2017-11-03 16:36:08'),
(485, 157, 0, '', 'package', '', 34, 'Impeller', '1.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:36:13', 10000, '2017-11-03 16:36:13'),
(486, 157, 0, '', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:36:19', 10000, '2017-11-03 16:36:19'),
(487, 157, 0, '', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:36:23', 10000, '2017-11-03 16:36:23'),
(488, 158, 205, 'Invoice', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(489, 158, 206, 'Invoice', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(490, 158, 207, 'Invoice', 'package', '', 34, 'Impeller', '1.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(491, 158, 208, 'Invoice', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(492, 158, 209, 'Invoice', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:38:29', 10000, '2017-11-03 16:38:29'),
(493, 158, 210, 'Invoice', 'package', '', 34, 'Impeller', '2.00', 8, '0.00', '120.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '240.00', '0.00', '240.00', '', 0, '', '', '0000-00-00', 10000, '2017-11-03 16:38:30', 10000, '2017-11-03 16:38:30'),
(494, 159, 488, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:39:33', 10000, '2017-11-03 16:39:33'),
(495, 159, 489, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:39:33', 10000, '2017-11-03 16:39:33'),
(496, 159, 490, 'Order', 'package', '', 34, 'Impeller', '1.00', 8, '0.00', '120.00', '120.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '120.00', '0.00', '120.00', '', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:39:34', 10000, '2017-11-03 16:39:34'),
(497, 159, 491, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '15.00', '15.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '15.00', '0.00', '15.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:39:34', 10000, '2017-11-03 16:39:34'),
(498, 159, 492, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '28.00', '28.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '28.00', '0.00', '28.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-11-03 16:39:35', 10000, '2017-11-03 16:39:35'),
(499, 159, 493, 'Order', 'package', '', 34, 'Impeller', '2.00', 8, '0.00', '120.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '240.00', '0.00', '240.00', '', 0, '', '', '0000-00-00', 10000, '2017-11-03 16:39:35', 10000, '2017-11-03 16:39:35'),
(500, 164, 472, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '12.00', '0.00', '12.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-12-13 14:29:42', 10000, '2017-12-13 14:29:42'),
(501, 164, 473, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '0.00', '20.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-12-13 14:29:43', 10000, '2017-12-13 14:29:43'),
(502, 165, 472, 'Order', 'product', '', 1, 'Impeller - 6000-01 (from Florida, USA)', '1.00', 8, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '12.00', '0.00', '12.00', 'Florida, USA', 10, '', '', '0000-00-00', 10000, '2017-12-13 14:31:12', 10000, '2017-12-13 14:31:12'),
(503, 165, 473, 'Order', 'product', '', 5, 'Impeller - 7000-01 (from New York, USA)', '1.00', 8, '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '20.00', '0.00', '20.00', 'New York, USA', 10, '', '', '0000-00-00', 10000, '2017-12-13 14:31:13', 10000, '2017-12-13 14:31:13'),
(504, 166, 0, '', 'product', '', 8, '1-1/2&quot;, BSP (from California, USA)', '1.00', 16, '0.00', '70.00', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '70.00', '0.00', '70.00', 'California, USA', 10, '', '', '0000-00-00', 10000, '2017-12-20 10:54:13', 10000, '2017-12-20 10:54:13'),
(505, 171, 0, '', 'product', '', 21, 'Liner Std', '1.00', 0, '0.00', '46.00', '46.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '46.00', '0.00', '46.00', '6Z1', 10, '', '', '0000-00-00', 10000, '2018-01-23 17:08:27', 10000, '2018-01-23 17:08:27'),
(506, 171, 0, '', 'product', '', 1, 'Rubber Impeller', '5.00', 0, '0.00', '12.00', '12.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '60.00', '0.00', '60.00', '6A1', 10, '', '', '0000-00-00', 10000, '2018-01-23 17:08:42', 10000, '2018-01-23 17:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `db_outl`
--

CREATE TABLE `db_outl` (
  `outl_id` int(11) NOT NULL,
  `outl_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `outl_gst` int(11) NOT NULL,
  `outl_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `outl_seqno` int(11) NOT NULL,
  `outl_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_outl`
--

INSERT INTO `db_outl` (`outl_id`, `outl_code`, `outl_gst`, `outl_desc`, `outl_seqno`, `outl_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'KC Parts & Services (S) Pte Ltd', 0, 'KC Parts & Service (S) Pte Ltd', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_package`
--

CREATE TABLE `db_package` (
  `package_id` int(11) NOT NULL,
  `package_part_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `package_code_cn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `package_code_thai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `package_barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `package_desc_cn` text COLLATE utf8_unicode_ci NOT NULL,
  `package_desc_thai` text COLLATE utf8_unicode_ci NOT NULL,
  `package_sale_price` decimal(10,2) NOT NULL,
  `package_cost_price` decimal(10,2) NOT NULL,
  `package_sum_cost` decimal(10,2) NOT NULL,
  `package_sum_sale` decimal(10,2) NOT NULL,
  `package_category` int(11) NOT NULL,
  `package_category2` int(11) NOT NULL,
  `package_category3` int(11) NOT NULL,
  `package_brand` int(11) NOT NULL,
  `package_packagetype` int(11) NOT NULL,
  `package_outlet` int(11) NOT NULL,
  `package_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `package_seqno` int(11) NOT NULL,
  `package_status` int(11) NOT NULL,
  `package_isimport` int(11) NOT NULL,
  `package_custom_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_weight` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `package_uom` int(11) NOT NULL,
  `package_product_wastage` decimal(10,2) NOT NULL,
  `package_labour_profit` decimal(10,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_package`
--

INSERT INTO `db_package` (`package_id`, `package_part_no`, `package_code_cn`, `package_code_thai`, `package_barcode`, `package_desc`, `package_desc_cn`, `package_desc_thai`, `package_sale_price`, `package_cost_price`, `package_sum_cost`, `package_sum_sale`, `package_category`, `package_category2`, `package_category3`, `package_brand`, `package_packagetype`, `package_outlet`, `package_remark`, `package_seqno`, `package_status`, `package_isimport`, `package_custom_no`, `package_weight`, `package_uom`, `package_product_wastage`, `package_labour_profit`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(34, 'KCPACK001A', '', '', '', 'Impeller', '', '', '120.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', 0, '0.00', '0.00', 10000, '2017-09-07 16:13:12', 10000, '2017-09-14 10:51:50'),
(35, 'KCPACK002B', '', '', '', 'SWP &amp; STRAINER - SEA WATER PUMP ASSY Package', '', '', '1460.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, 0, 'SWP &amp; STRAINER - SEA WATER PUMP ASSY Package - ENGINE COOLING PUMPS', 0, 1, 0, '', '', 0, '0.00', '0.00', 10000, '2017-09-11 11:08:51', 10000, '2017-09-11 11:12:17'),
(36, 'tst01', '', '', '', 'test11', '', '', '10.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', 0, '0.00', '0.00', 10000, '2017-10-27 15:59:26', 10000, '2017-10-27 15:59:26'),
(37, '23505022CYK', '', '', '', 'Cylinder Kit', '', '', '10.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, 0, 0, 'Cylinder kit c/w impeller testing', 0, 1, 0, '', '', 0, '0.00', '0.00', 10000, '2017-12-13 12:46:59', 10000, '2017-12-13 12:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `db_partner`
--

CREATE TABLE `db_partner` (
  `partner_id` int(11) NOT NULL,
  `partner_login_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_login_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_name_cn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_name_thai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_bill_address_cn` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_bill_address_thai` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_house_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `partner_suburb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `partner_address_type` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `partner_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partner_iscustomer` int(1) NOT NULL,
  `partner_issupplier` int(11) NOT NULL,
  `partner_issubcon` int(11) NOT NULL,
  `partner_issitecoordinator` int(11) NOT NULL,
  `partner_debtor_account` int(11) NOT NULL,
  `partner_creditor_account` int(11) NOT NULL,
  `partner_bill_address` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_ship_address` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_sales_person` int(11) NOT NULL,
  `partner_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_tel2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_fax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_currency` int(11) NOT NULL,
  `partner_outlet` int(11) NOT NULL,
  `partner_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_website` text COLLATE utf8_unicode_ci NOT NULL,
  `partner_credit_limit` float(10,2) NOT NULL,
  `partner_industry` int(11) NOT NULL,
  `partner_city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `partner_postal_code` int(11) NOT NULL,
  `partner_group` int(11) NOT NULL,
  `partner_country` int(11) NOT NULL,
  `partner_seqno` int(11) NOT NULL,
  `partner_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_partner`
--

INSERT INTO `db_partner` (`partner_id`, `partner_login_id`, `partner_login_password`, `partner_name_cn`, `partner_name_thai`, `partner_bill_address_cn`, `partner_bill_address_thai`, `partner_house_no`, `partner_suburb`, `partner_address_type`, `partner_code`, `partner_name`, `partner_iscustomer`, `partner_issupplier`, `partner_issubcon`, `partner_issitecoordinator`, `partner_debtor_account`, `partner_creditor_account`, `partner_bill_address`, `partner_ship_address`, `partner_sales_person`, `partner_tel`, `partner_tel2`, `partner_fax`, `partner_email`, `partner_currency`, `partner_outlet`, `partner_remark`, `partner_website`, `partner_credit_limit`, `partner_industry`, `partner_city`, `partner_postal_code`, `partner_group`, `partner_country`, `partner_seqno`, `partner_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(92, '', 'bebc729080e59bf4c7cb24e3d062a23c', '', '', '', '', '', '', '1', 'CUST00001', 'Choong &amp; Chang Pte. Ltd.', 0, 1, 0, 0, 0, 0, '08 Tanglin Road,\r\n#08-08 Tanglin Shopping Mall,\r\nSingapore 257889', '', 0, '6791423', '', '', 'enquiry@cclaw.com.sg', 0, 0, '', '', 0.00, 0, '', 0, 0, 0, 0, 1, 10000, '2017-09-15 17:42:46', 10000, '2017-09-15 17:42:46'),
(93, '', 'bebc729080e59bf4c7cb24e3d062a23c', '', '', '', '', '', '', '1', 'CUST00008', 'Alpha Design Workshop Pte. Ltd.', 1, 0, 0, 0, 0, 0, 'Gotham Design Square,\r\nN0.08 Genting Road #08-08,\r\nSingapore 388673', '', 0, '62437519', '', '', 'enquiry@alphadesign.com.sg', 0, 0, '', '', 0.00, 0, '', 0, 0, 0, 0, 1, 10000, '2017-09-15 17:45:44', 10000, '2017-09-15 17:45:44'),
(94, '', 'bebc729080e59bf4c7cb24e3d062a23c', '', '', '', '', '', '', '1', 'CUST00009', 'Customer from e-commerce', 1, 0, 0, 0, 0, 0, '', '', 0, '', '', '', '', 0, 0, '', '', 0.00, 0, '', 0, 0, 0, 0, 1, 10000, '2017-09-15 09:25:19', 10000, '2017-10-04 11:49:23'),
(95, '', 'bebc729080e59bf4c7cb24e3d062a23c', '', '', '', '', '', '', '1', 'CUST00010', 'William Tyler Building Materials &amp; Construction Pte Ltd', 1, 0, 0, 0, 0, 0, '18 Kallang Terrace,\r\nSingapore 538977', '', 0, '6322 6550', '', '', '', 0, 0, '', '', 0.00, 0, '', 0, 0, 0, 0, 1, 10000, '2017-10-04 11:48:03', 10000, '2017-10-04 11:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `db_partneraddresstype`
--

CREATE TABLE `db_partneraddresstype` (
  `partneraddresstype_id` int(11) NOT NULL,
  `partneraddresstype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partneraddresstype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `partneraddresstype_seqno` int(11) NOT NULL,
  `partneraddresstype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_partneraddresstype`
--

INSERT INTO `db_partneraddresstype` (`partneraddresstype_id`, `partneraddresstype_code`, `partneraddresstype_desc`, `partneraddresstype_seqno`, `partneraddresstype_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Bill to / Ship to', 'Bill to / Ship to', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Bill to', 'Bill to', 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Primary', 'Primary', 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Other', 'Other', 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Ship to', 'Ship to', 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Other', 'Other', 60, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_pattendance`
--

CREATE TABLE `db_pattendance` (
  `pattendance_id` int(11) NOT NULL,
  `pattendance_project` int(11) NOT NULL,
  `pattendance_pempl` int(11) NOT NULL,
  `pattendance_date` date NOT NULL,
  `pattendance_ina` int(11) NOT NULL,
  `pattendance_inb` int(11) NOT NULL,
  `pattendance_inc` int(11) NOT NULL,
  `pattendance_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_payline`
--

CREATE TABLE `db_payline` (
  `payline_id` int(11) NOT NULL,
  `payline_payroll_id` int(11) NOT NULL,
  `payline_empl_id` int(11) NOT NULL,
  `payline_department_id` int(11) NOT NULL,
  `payline_salary` decimal(15,2) NOT NULL,
  `payline_additional` decimal(15,2) NOT NULL,
  `payline_deductions` decimal(15,2) NOT NULL,
  `payline_cpf` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` int(11) NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_paymentterm`
--

CREATE TABLE `db_paymentterm` (
  `paymentterm_id` int(11) NOT NULL,
  `paymentterm_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `paymentterm_gst` int(11) NOT NULL,
  `paymentterm_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `paymentterm_seqno` int(11) NOT NULL,
  `paymentterm_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_paymentterm`
--

INSERT INTO `db_paymentterm` (`paymentterm_id`, `paymentterm_code`, `paymentterm_gst`, `paymentterm_desc`, `paymentterm_seqno`, `paymentterm_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'PM1', 0, 'Cash on Collection', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 14:26:36'),
(2, 'PM2', 0, 'Cash on Delivery', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 17:15:12'),
(3, 'PM3', 0, '30 days after collection', 30, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 17:15:32'),
(4, 'PM4', 0, '30 days after delivery', 40, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 17:15:43'),
(5, 'PM5', 0, 'Full Pre-Payment with Purchase Order', 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-07 17:15:56'),
(6, 'PM6', 0, 'Full Pre-Payment by Telegraphic Transfer with Purchase Order. All bank charges or fee pertaining to T/T transfer, whether in the buyer country or in Singapore, are strictly on buyer&rsquo;s account.', 60, 1, 10000, '2017-09-07 17:16:08', 10000, '2017-09-07 17:16:08'),
(7, 'PM7', 0, '50% Pre-Payment with Purchase Order as required by Factory. Balance upon collection of parts.', 70, 1, 10000, '2017-09-07 17:16:26', 10000, '2017-09-07 17:16:31'),
(8, 'PM8', 0, '30% Pre-Payment with Purchase Order as required by Factory. Balance upon collection of parts.', 80, 1, 10000, '2017-09-07 17:16:44', 10000, '2017-09-07 17:16:44'),
(9, 'PM9', 0, 'Payment must be made in 1 bank remittance only otherwise handling charge of S$50.00 for each separate remittance will apply.', 90, 1, 10000, '2017-09-07 17:16:55', 10000, '2017-09-07 17:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `db_payroll`
--

CREATE TABLE `db_payroll` (
  `payroll_id` int(11) NOT NULL,
  `payroll_outlet` int(11) NOT NULL,
  `payroll_department` int(11) NOT NULL,
  `payroll_salary_date` date NOT NULL,
  `payroll_startdate` date NOT NULL,
  `payroll_enddate` date NOT NULL,
  `payroll_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` int(11) NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pclaim`
--

CREATE TABLE `db_pclaim` (
  `pclaim_id` int(11) NOT NULL,
  `pclaim_project_id` int(11) NOT NULL,
  `pclaim_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pclaim_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pclaim_date` date NOT NULL,
  `pclaim_amount` decimal(15,2) NOT NULL,
  `pclaim_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `pclaim_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pclaimline`
--

CREATE TABLE `db_pclaimline` (
  `pclaimline_id` int(11) NOT NULL,
  `pclaimline_pclaim_id` int(11) NOT NULL,
  `pcliamline_pro_id` int(11) NOT NULL,
  `pclaimline_pro_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `pclaimline_qty` decimal(15,2) NOT NULL,
  `pclaimline_uprice` decimal(15,2) NOT NULL,
  `pclaimline_total` decimal(15,2) NOT NULL,
  `pclaimline_pro_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `pclaimline_cerqty` decimal(15,2) NOT NULL,
  `pclaimline_ceruprice` decimal(15,2) NOT NULL,
  `pclaimline_certotal` decimal(15,2) NOT NULL,
  `pclaimline_cerremark` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pempl`
--

CREATE TABLE `db_pempl` (
  `pempl_id` int(11) NOT NULL,
  `pempl_partner_id` int(11) NOT NULL,
  `pempl_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pempl_nric` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pempl_issuedate` date NOT NULL,
  `pempl_wpno` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pempl_expirydate` date NOT NULL,
  `pempl_passport` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pempl_passportissuedate` date NOT NULL,
  `pempl_passportexpirydate` date NOT NULL,
  `pempl_position` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pequipment`
--

CREATE TABLE `db_pequipment` (
  `pequipment_id` int(11) NOT NULL,
  `pequipment_project` int(11) NOT NULL,
  `pequipment_equipment` int(11) NOT NULL,
  `pequipment_location` int(11) NOT NULL,
  `pequipment_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pointofdelivery`
--

CREATE TABLE `db_pointofdelivery` (
  `pointofdelivery_id` int(11) NOT NULL,
  `pointofdelivery_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pointofdelivery_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `pointofdelivery_seqno` int(11) NOT NULL,
  `pointofdelivery_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_pointofdelivery`
--

INSERT INTO `db_pointofdelivery` (`pointofdelivery_id`, `pointofdelivery_code`, `pointofdelivery_desc`, `pointofdelivery_seqno`, `pointofdelivery_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'PD4', 'Ex-Singapore Warehouse', 10, 1, 10000, '2017-08-21 10:05:52', 10000, '2017-09-11 14:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `db_prefix`
--

CREATE TABLE `db_prefix` (
  `prefix_id` int(11) NOT NULL,
  `prefix_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prefix_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `prefix_seqno` int(11) NOT NULL,
  `prefix_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_prefix`
--

INSERT INTO `db_prefix` (`prefix_id`, `prefix_code`, `prefix_desc`, `prefix_seqno`, `prefix_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'P1', 'FP &amp;ndash; FP Diesel USA parts', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 14:26:21'),
(2, 'P2', 'DDC &amp;ndash; Genuine Detroit Diesel parts', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 11:32:00'),
(3, 'P3', 'JMP - JMP Corporation, Korea', 30, 1, 0, '2016-03-01 11:16:29', 10000, '2017-07-17 15:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `db_price`
--

CREATE TABLE `db_price` (
  `price_id` int(11) NOT NULL,
  `price_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `price_seqno` int(11) NOT NULL,
  `price_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_price`
--

INSERT INTO `db_price` (`price_id`, `price_code`, `price_desc`, `price_seqno`, `price_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'P1', 'Quoted in Singapore Dollars (Nett), Excluding 7% GST', 10, 1, 10000, '2017-07-17 16:00:02', 10000, '2017-09-07 16:58:33'),
(2, 'P2', 'Quoted in Singapore Dollars (Nett)', 20, 1, 10000, '2017-07-17 16:00:08', 10000, '2017-09-07 16:58:53'),
(3, 'P3', 'Quoted in USD (Nett)', 30, 1, 10000, '2017-07-17 16:00:13', 10000, '2017-09-07 16:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `db_proaward`
--

CREATE TABLE `db_proaward` (
  `proaward_id` int(11) NOT NULL,
  `proaward_project` int(11) NOT NULL,
  `proaward_ordl_id` int(11) NOT NULL,
  `proaward_ordl_qty` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_probom`
--

CREATE TABLE `db_probom` (
  `probom_id` int(11) NOT NULL,
  `probom_product_id` int(11) DEFAULT NULL,
  `probom_package_id` int(11) DEFAULT NULL,
  `probom_material_id` int(11) NOT NULL,
  `probom_qty` decimal(15,4) NOT NULL,
  `probom_uom_id` int(11) DEFAULT NULL,
  `probom_cost` decimal(15,2) DEFAULT NULL,
  `probom_sale` decimal(15,2) DEFAULT NULL,
  `probom_layer` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_probom`
--

INSERT INTO `db_probom` (`probom_id`, `probom_product_id`, `probom_package_id`, `probom_material_id`, `probom_qty`, `probom_uom_id`, `probom_cost`, `probom_sale`, `probom_layer`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(70, 1, 34, 0, '2.0000', 14, '12.00', '15.00', '0.00', 10000, '2017-09-07 16:13:29', 10000, '2017-09-07 16:13:29'),
(72, 7, 35, 0, '10.0000', 17, '80.00', '120.00', '0.00', 10000, '2017-09-11 11:11:11', 10000, '2017-09-11 11:11:24'),
(73, 9, 35, 0, '5.0000', 17, '50.00', '52.00', '0.00', 10000, '2017-09-11 11:11:47', 10000, '2017-09-11 11:11:56'),
(74, 5, 34, 0, '3.0000', 0, '20.00', '28.00', '0.00', 10000, '2017-09-14 10:51:37', 10000, '2017-09-14 10:51:37'),
(75, 14, 37, 0, '1.0000', 13, '1.00', '2.00', '0.00', 10000, '2017-12-13 12:48:33', 10000, '2017-12-13 12:48:33'),
(76, 5, 37, 0, '1.0000', 0, '20.00', '28.00', '0.00', 10000, '2017-12-13 12:49:09', 10000, '2017-12-13 12:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `db_prodgrp`
--

CREATE TABLE `db_prodgrp` (
  `prodgrp_id` int(11) NOT NULL,
  `prodgrp_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prodgrp_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `prodgrp_seqno` int(11) NOT NULL,
  `prodgrp_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_product`
--

CREATE TABLE `db_product` (
  `product_id` int(11) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_part_no` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_sale_price` decimal(10,2) NOT NULL,
  `product_cost_price` decimal(10,2) NOT NULL,
  `product_seqno` int(11) NOT NULL,
  `product_status` int(11) NOT NULL,
  `product_remark` text NOT NULL,
  `product_system_code` varchar(50) NOT NULL,
  `product_qty_blades` int(11) NOT NULL,
  `product_insert_types` int(11) NOT NULL,
  `product_diameter` decimal(10,2) NOT NULL,
  `product_width_depth` decimal(10,2) NOT NULL,
  `product_shaft_diameter` decimal(10,2) NOT NULL,
  `product_main_group` int(11) NOT NULL,
  `product_sub_group` int(11) NOT NULL,
  `product_n_wt` decimal(10,3) NOT NULL,
  `product_g_wt` decimal(10,3) NOT NULL,
  `product_usage` varchar(255) NOT NULL,
  `product_enginemodel` varchar(255) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_lowstock` int(11) NOT NULL,
  `product_cr_jabsco` varchar(255) NOT NULL,
  `product_cr_sherwood` varchar(255) NOT NULL,
  `product_cr_johnson` varchar(255) NOT NULL,
  `product_cr_volvo` varchar(255) NOT NULL,
  `product_cr_cef` varchar(255) NOT NULL,
  `product_cr_onan` varchar(255) NOT NULL,
  `product_cr_kashiyama` varchar(255) NOT NULL,
  `product_cr_yanmar` varchar(255) NOT NULL,
  `product_cr_doosan` varchar(255) NOT NULL,
  `product_cr_others` varchar(255) NOT NULL,
  `product_cr_detroits` varchar(255) NOT NULL,
  `product_cr_cummins` varchar(255) NOT NULL,
  `product_cr_cats` varchar(255) NOT NULL,
  `product_location` text NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_product`
--

INSERT INTO `db_product` (`product_id`, `product_category`, `product_part_no`, `product_name`, `product_desc`, `product_sale_price`, `product_cost_price`, `product_seqno`, `product_status`, `product_remark`, `product_system_code`, `product_qty_blades`, `product_insert_types`, `product_diameter`, `product_width_depth`, `product_shaft_diameter`, `product_main_group`, `product_sub_group`, `product_n_wt`, `product_g_wt`, `product_usage`, `product_enginemodel`, `product_stock`, `product_lowstock`, `product_cr_jabsco`, `product_cr_sherwood`, `product_cr_johnson`, `product_cr_volvo`, `product_cr_cef`, `product_cr_onan`, `product_cr_kashiyama`, `product_cr_yanmar`, `product_cr_doosan`, `product_cr_others`, `product_cr_detroits`, `product_cr_cummins`, `product_cr_cats`, `product_location`, `updateBy`, `updateDateTime`, `insertBy`, `insertDateTime`) VALUES
(1, 7, '6000-01JMP', '6000-01', 'Rubber Impeller', '12.00', '6.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 7, '7000-01JMP', '7000-01', 'Rubber Impeller', '14.00', '7.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 20, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 7, '7001-01JMP', '7001-01', 'Rubber Impeller', '14.20', '7.10', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 5, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 7, '7013-01JMP', '7013-01', 'Rubber Impeller', '14.26', '7.13', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 10, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 7, '8000-01JMP', '8000-01', 'Rubber Impeller', '16.00', '8.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 30, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 7, '8001-01JMP', '8001-01', 'Rubber Impeller', '16.02', '8.01', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 60, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 7, '8002-01JMP', '8002-01', 'Rubber Impeller', '16.04', '8.02', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 7, '8016-01JMP', '8016-01', 'Rubber Impeller', '16.32', '8.16', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 7, '8100-01JMP', '8100-01', 'Rubber Impeller', '16.20', '8.10', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 7, '8359-01JMP', '8359-01', 'Rubber Impeller', '16.70', '8.35', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 3, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 7, '8400-01JMP', '8400-01', 'Rubber Impeller', '16.80', '8.40', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 5, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 7, '8406-01JMP', '8406-01', 'Rubber Impeller', '16.80', '8.40', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 200, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 7, '8503-01JMP', '8503-01', 'Rubber Impeller', '17.00', '8.50', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 7, '8506-01JMP', '8506-01', 'Rubber Impeller', '17.00', '8.50', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 50, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 7, '9000-01JMP', '9000-01', 'Rubber Impeller', '18.00', '9.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 7, '9001-01JMP', '9001-01', 'Rubber Impeller', '18.20', '9.10', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 4, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 7, '9100-01JMP', '9100-01', 'Rubber Impeller', '18.20', '9.10', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 3, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 7, '9202-01JMP', '9202-01', 'Rubber Impeller', '18.40', '9.20', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 8, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 7, '9206-01JMP', '9206-01', 'Rubber Impeller', '18.40', '9.20', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 2, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 7, '9500-01JMP', '9500-01', 'Rubber Impeller', '19.00', '9.50', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 9, '23502020DDC', '23502020', 'Liner Std', '46.00', '23.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 9, '23502021DDC', '23502021', 'Liner #2', '47.00', '23.50', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 9, '23502022DDC', '23502022', 'Liner #3', '48.00', '24.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 50, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 9, '23514202DDC', '23514202', 'Blower Repair Kit (Large Brg)', '50.00', '25.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 2, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '7A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 9, '23514203DDC', '23514203', 'Blower Repair Kit (Small Brg)', '52.00', '26.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 0, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '7A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 8, '23502020FP', '23502020', 'Liner Std', '26.00', '13.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 10, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 8, '23502021FP', '23502021', 'Liner #2', '27.00', '13.50', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 6, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, 8, '23502022FP', '23502022', 'Liner #3', '28.00', '14.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 12, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, 8, '5115454FP', '5115454', 'Blower Repair Kit (Large Brg)', '40.00', '20.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 8, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '7F3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 8, '23514608FP', '23514608', 'Blower Repair Kit (Small Brg)', '40.00', '20.00', 0, 1, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 9, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '7F3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_productpackage`
--

CREATE TABLE `db_productpackage` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_sale_price` decimal(15,2) NOT NULL,
  `product_cost_price` decimal(15,4) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `product_stock_availability` int(11) NOT NULL,
  `product_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_producttype`
--

CREATE TABLE `db_producttype` (
  `producttype_id` int(11) NOT NULL,
  `producttype_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `producttype_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `producttype_seqno` int(11) NOT NULL,
  `producttype_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_product_bk`
--

CREATE TABLE `db_product_bk` (
  `product_id` int(11) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_part_no` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_sale_price` decimal(10,2) NOT NULL,
  `product_cost_price` decimal(10,2) NOT NULL,
  `product_seqno` int(11) NOT NULL,
  `product_status` int(11) NOT NULL,
  `product_remark` text NOT NULL,
  `product_system_code` varchar(50) NOT NULL,
  `product_qty_blades` int(11) NOT NULL,
  `product_insert_types` int(11) NOT NULL,
  `product_diameter` decimal(10,2) NOT NULL,
  `product_width_depth` decimal(10,2) NOT NULL,
  `product_shaft_diameter` decimal(10,2) NOT NULL,
  `product_main_group` int(11) NOT NULL,
  `product_sub_group` int(11) NOT NULL,
  `product_n_wt` decimal(10,3) NOT NULL,
  `product_g_wt` decimal(10,3) NOT NULL,
  `product_usage` varchar(255) NOT NULL,
  `product_enginemodel` varchar(255) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_lowstock` int(11) NOT NULL,
  `product_cr_jabsco` varchar(255) NOT NULL,
  `product_cr_sherwood` varchar(255) NOT NULL,
  `product_cr_johnson` varchar(255) NOT NULL,
  `product_cr_volvo` varchar(255) NOT NULL,
  `product_cr_cef` varchar(255) NOT NULL,
  `product_cr_onan` varchar(255) NOT NULL,
  `product_cr_kashiyama` varchar(255) NOT NULL,
  `product_cr_yanmar` varchar(255) NOT NULL,
  `product_cr_doosan` varchar(255) NOT NULL,
  `product_cr_others` varchar(255) NOT NULL,
  `product_cr_detroits` varchar(255) NOT NULL,
  `product_cr_cummins` varchar(255) NOT NULL,
  `product_cr_cats` varchar(255) NOT NULL,
  `product_location` text NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_product_bk`
--

INSERT INTO `db_product_bk` (`product_id`, `product_category`, `product_part_no`, `product_name`, `product_desc`, `product_sale_price`, `product_cost_price`, `product_seqno`, `product_status`, `product_remark`, `product_system_code`, `product_qty_blades`, `product_insert_types`, `product_diameter`, `product_width_depth`, `product_shaft_diameter`, `product_main_group`, `product_sub_group`, `product_n_wt`, `product_g_wt`, `product_usage`, `product_enginemodel`, `product_stock`, `product_lowstock`, `product_cr_jabsco`, `product_cr_sherwood`, `product_cr_johnson`, `product_cr_volvo`, `product_cr_cef`, `product_cr_onan`, `product_cr_kashiyama`, `product_cr_yanmar`, `product_cr_doosan`, `product_cr_others`, `product_cr_detroits`, `product_cr_cummins`, `product_cr_cats`, `product_location`, `updateBy`, `updateDateTime`, `insertBy`, `insertDateTime`) VALUES
(1, 7, '6000-01JMP', '6000-01', 'Rubber Impeller', '12.00', '6.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 7, '7000-01JMP', '7000-01', 'Rubber Impeller', '14.00', '7.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 20, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 7, '7001-01JMP', '7001-01', 'Rubber Impeller', '14.20', '7.10', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 5, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 7, '7013-01JMP', '7013-01', 'Rubber Impeller', '14.26', '7.13', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 10, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 7, '8000-01JMP', '8000-01', 'Rubber Impeller', '16.00', '8.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 30, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 7, '8001-01JMP', '8001-01', 'Rubber Impeller', '16.02', '8.01', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 60, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 7, '8002-01JMP', '8002-01', 'Rubber Impeller', '16.04', '8.02', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 7, '8016-01JMP', '8016-01', 'Rubber Impeller', '16.32', '8.16', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 7, '8100-01JMP', '8100-01', 'Rubber Impeller', '16.20', '8.10', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 7, '8359-01JMP', '8359-01', 'Rubber Impeller', '16.70', '8.35', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 3, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 7, '8400-01JMP', '8400-01', 'Rubber Impeller', '16.80', '8.40', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 5, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 7, '8406-01JMP', '8406-01', 'Rubber Impeller', '16.80', '8.40', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 200, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 7, '8503-01JMP', '8503-01', 'Rubber Impeller', '17.00', '8.50', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 7, '8506-01JMP', '8506-01', 'Rubber Impeller', '17.00', '8.50', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 50, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 7, '9000-01JMP', '9000-01', 'Rubber Impeller', '18.00', '9.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 7, '9001-01JMP', '9001-01', 'Rubber Impeller', '18.20', '9.10', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 4, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 7, '9100-01JMP', '9100-01', 'Rubber Impeller', '18.20', '9.10', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 3, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 7, '9202-01JMP', '9202-01', 'Rubber Impeller', '18.40', '9.20', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 8, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 7, '9206-01JMP', '9206-01', 'Rubber Impeller', '18.40', '9.20', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 2, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 7, '9500-01JMP', '9500-01', 'Rubber Impeller', '19.00', '9.50', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6A3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 9, '23502020DDC', '23502020', 'Liner Std', '46.00', '23.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 9, '23502021DDC', '23502021', 'Liner #2', '47.00', '23.50', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 100, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 9, '23502022DDC', '23502022', 'Liner #3', '48.00', '24.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 50, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 9, '23514202DDC', '23514202', 'Blower Repair Kit (Large Brg)', '50.00', '25.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 2, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '7A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 9, '23514203DDC', '23514203', 'Blower Repair Kit (Small Brg)', '52.00', '26.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 0, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '7A2', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 8, '23502020FP', '23502020', 'Liner Std', '26.00', '13.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 10, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 8, '23502021FP', '23502021', 'Liner #2', '27.00', '13.50', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 6, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, 8, '23502022FP', '23502022', 'Liner #3', '28.00', '14.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 12, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '6Z1', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, 8, '5115454FP', '5115454', 'Blower Repair Kit (Large Brg)', '40.00', '20.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 8, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '7F3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 8, '23514608FP', '23514608', 'Blower Repair Kit (Small Brg)', '40.00', '20.00', 0, 0, '', '', 0, 0, '0.00', '0.00', '0.00', 0, 0, '0.000', '0.000', '', '', 9, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '7F3', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_project`
--

CREATE TABLE `db_project` (
  `project_id` int(11) NOT NULL,
  `project_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_code_cn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `project_desc_cn` text COLLATE utf8_unicode_ci NOT NULL,
  `project_price` decimal(15,2) NOT NULL,
  `project_limit` decimal(15,2) NOT NULL,
  `project_startdate` date NOT NULL,
  `project_enddate` date NOT NULL,
  `project_completeddate` date NOT NULL,
  `project_outlet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `project_progress` int(11) NOT NULL,
  `project_leader` int(11) NOT NULL,
  `project_seqno` int(11) NOT NULL,
  `project_status` int(11) NOT NULL,
  `project_subcon` text COLLATE utf8_unicode_ci NOT NULL,
  `project_customer` int(11) NOT NULL,
  `project_site_coordinator` text COLLATE utf8_unicode_ci NOT NULL,
  `project_loaref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_projectstatus`
--

CREATE TABLE `db_projectstatus` (
  `projectstatus_id` int(11) NOT NULL,
  `projectstatus_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `projectstatus_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `projectstatus_seqno` int(11) NOT NULL,
  `projectstatus_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_projectstatus`
--

INSERT INTO `db_projectstatus` (`projectstatus_id`, `projectstatus_code`, `projectstatus_desc`, `projectstatus_seqno`, `projectstatus_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'Complete', 'Complete', 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Incomplete', 'Incomplete', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Processing', 'Processing', 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Cancel', 'Cancel', 40, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_prolabour`
--

CREATE TABLE `db_prolabour` (
  `prolabour_id` int(11) NOT NULL,
  `prolabour_product_id` int(11) NOT NULL,
  `prolabour_labour_id` int(11) NOT NULL,
  `prolabour_qty` decimal(15,4) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pw`
--

CREATE TABLE `db_pw` (
  `pw_id` int(11) NOT NULL,
  `pw_project_id` int(11) NOT NULL,
  `pw_proaward_id` int(11) NOT NULL,
  `pw_pwlocation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pw_labour` int(11) NOT NULL,
  `pw_qty` decimal(10,2) NOT NULL,
  `pw_subcon` int(11) NOT NULL,
  `pw_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_pw`
--

INSERT INTO `db_pw` (`pw_id`, `pw_project_id`, `pw_proaward_id`, `pw_pwlocation`, `pw_labour`, `pw_qty`, `pw_subcon`, `pw_remarks`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 1, 67, 'level 12', 24, '6.00', 27, 'test11', 10000, '2017-05-18 12:24:55', 10000, '2017-05-18 14:49:35'),
(4, 1, 64, 'level 3', 20, '3.00', 19, 'test', 10000, '2017-05-18 14:04:02', 10000, '2017-05-23 18:01:12'),
(5, 1, 67, 'level 9', 25, '2.00', 24, 'ss', 10000, '2017-05-18 15:00:51', 10000, '2017-05-18 15:00:51'),
(6, 1, 68, '', 22, '0.00', 31, '', 10000, '2017-06-22 19:04:51', 10000, '2017-06-22 19:04:51'),
(7, 1, 68, '', 20, '0.00', 0, '', 10000, '2017-06-22 19:05:09', 10000, '2017-06-22 19:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `db_pwl`
--

CREATE TABLE `db_pwl` (
  `pwl_id` int(11) NOT NULL,
  `pwl_pw_id` int(11) NOT NULL,
  `pwl_ordl_id` int(11) NOT NULL,
  `pwl_qty` decimal(15,2) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_pworker`
--

CREATE TABLE `db_pworker` (
  `pworker_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `pempl_id` int(11) NOT NULL,
  `pworker_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `pworker_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_record_curl`
--

CREATE TABLE `db_record_curl` (
  `db_record_id` int(11) NOT NULL,
  `invoice_order_id` varchar(255) NOT NULL,
  `invoice_firstname` varchar(255) NOT NULL,
  `invoice_lastname` varchar(255) NOT NULL,
  `invoice_email` varchar(255) NOT NULL,
  `invoice_telephone` varchar(255) NOT NULL,
  `invoice_payment_address_1` varchar(255) NOT NULL,
  `invoice_payment_address_2` varchar(255) NOT NULL,
  `invoice_payment_city` varchar(255) NOT NULL,
  `invoice_payment_postcode` varchar(255) NOT NULL,
  `invoice_payment_country` varchar(255) NOT NULL,
  `invoice_total` varchar(255) NOT NULL,
  `invoice_product_id` varchar(255) NOT NULL,
  `invoice_model` varchar(255) NOT NULL,
  `invoice_quantity` varchar(255) NOT NULL,
  `invoice_price` varchar(255) NOT NULL,
  `insertDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_refn`
--

CREATE TABLE `db_refn` (
  `refn_id` int(11) NOT NULL,
  `refn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_prefix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_suffix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_length` int(11) NOT NULL,
  `refn_value` int(11) NOT NULL,
  `refn_outl_id` int(11) NOT NULL,
  `refn_seqno` int(11) NOT NULL,
  `refn_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_refn`
--

INSERT INTO `db_refn` (`refn_id`, `refn_name`, `refn_prefix`, `refn_suffix`, `refn_length`, `refn_value`, `refn_outl_id`, `refn_seqno`, `refn_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(2, 'Request Form', 'PRF', '', 5, 81, 1, 10, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:10'),
(3, 'Order', 'CO', '', 5, 1, 1, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:19'),
(4, 'Delivery Order', 'DO/', '', 5, 52, 1, 30, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:26'),
(5, 'Sales Invoice', 'IV/', '', 5, 73, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:33'),
(6, 'Progress Claim', 'PROG', '', 4, 17, 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Quotation_bk', 'HHPL/Q/2017/', '', 4, 2507, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-05-15 17:31:34'),
(8, 'Time Sheet', 'TS', '', 4, 10, 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Empl code', 'Empl', '', 4, 10, 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Time Sheet', 'TS', '', 4, 10, 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Claim', 'CLS', '', 4, 7, 1, 50, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'Purchase Order', 'PO/', '', 5, 92, 1, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:19'),
(13, 'Purchase Invoice', 'PI', '', 5, 59, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:33'),
(14, 'Back Charge', 'BC', '', 5, 9, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:33'),
(15, 'Project', 'L', '', 5, 140, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-05-31 14:40:28'),
(16, 'Goods Received Note', 'GRN', '', 5, 87, 1, 20, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:19'),
(17, 'Pclaim', 'PC', '', 5, 148, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-05-31 14:40:28'),
(18, 'Credit Note', 'CN', '', 5, 11, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:33'),
(19, 'Sales Credit Note', 'SCN', '', 5, 12, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:30'),
(20, 'Purchase Credit Note', 'PCN', '', 5, 23, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2017-05-31 14:40:29'),
(21, 'Pickup List', 'PU/', '', 5, 52, 1, 60, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-02 21:32:33'),
(22, 'Quotation', 'KC/', '/TO', 4, 33, 1, 50, 1, 0, '0000-00-00 00:00:00', 10000, '2017-05-15 17:31:34'),
(23, 'e-Sales Invoice', 'IV/', '/e', 5, 48, 1, 40, 1, 0, '0000-00-00 00:00:00', 10000, '2016-05-12 21:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `db_refncode`
--

CREATE TABLE `db_refncode` (
  `refn_id` int(11) NOT NULL,
  `refn_menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_prefix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_suffix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refn_length` int(11) NOT NULL,
  `refn_value` int(11) NOT NULL,
  `refn_outl_id` int(11) NOT NULL,
  `refn_seqno` int(11) NOT NULL,
  `refn_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_refncode`
--

INSERT INTO `db_refncode` (`refn_id`, `refn_menu_name`, `refn_prefix`, `refn_suffix`, `refn_length`, `refn_value`, `refn_outl_id`, `refn_seqno`, `refn_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(6, 'Empl code', 'empl', '', 4, 24, 4, 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Timesheet', 'tmsh', '', 4, 1, 4, 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_remarks`
--

CREATE TABLE `db_remarks` (
  `remarks_id` int(11) NOT NULL,
  `remarks_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remarks_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `remarks_seqno` int(11) NOT NULL,
  `remarks_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_remarks`
--

INSERT INTO `db_remarks` (`remarks_id`, `remarks_code`, `remarks_desc`, `remarks_seqno`, `remarks_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'R1', 'Price quoted for indent order only.', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 14:26:09'),
(2, 'R2', 'Price quoted is based on part number supplied.', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-07-17 15:30:23'),
(3, 'R3', 'Order once placed cannot be cancelled.', 30, 1, 0, '2016-03-01 11:16:29', 10000, '2017-07-17 15:30:30'),
(4, 'R4', 'Order once placed cannot be cancelled, otherwise a penalty charge of 25% of the total value of goods will apply as required by Depot.', 40, 1, 10000, '2017-08-21 10:05:52', 10000, '2017-08-21 10:05:52'),
(5, 'QT01', 'We trust that you will find our quotation acceptable and look forward to receive your confirmation soon.\r\n\r\nBest Regards', 21, 1, 10000, '2017-11-03 16:33:37', 10000, '2017-11-03 16:33:37'),
(6, 'PO01', 'Please advise the weight &amp; dimension of our orders when ready. We will advise our shipping instructions later.\r\n\r\nAwaiting your prompt acknowledgement.\r\n\r\nBest Regards', 31, 1, 10000, '2017-11-03 16:34:07', 10000, '2017-11-03 16:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `db_serfees`
--

CREATE TABLE `db_serfees` (
  `serfees_id` int(11) NOT NULL,
  `serfees_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serfees_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `serfees_seqno` int(11) NOT NULL,
  `serfees_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_shipaddress`
--

CREATE TABLE `db_shipaddress` (
  `shipping_id` int(11) NOT NULL,
  `shipping_partner_id` int(11) NOT NULL,
  `shipping_address` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_seqno` int(11) NOT NULL,
  `shipping_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_shipterm`
--

CREATE TABLE `db_shipterm` (
  `shipterm_id` int(11) NOT NULL,
  `shipterm_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shipterm_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `shipterm_seqno` int(11) NOT NULL,
  `shipterm_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_shipterm`
--

INSERT INTO `db_shipterm` (`shipterm_id`, `shipterm_code`, `shipterm_desc`, `shipterm_seqno`, `shipterm_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(3, 'FOB', 'FREE ON BOARD', 10, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'FCA', 'FREE CARRIER', 20, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `db_sorder`
--

CREATE TABLE `db_sorder` (
  `sorder_id` int(11) NOT NULL,
  `sorder_outlet` int(11) NOT NULL,
  `sorder_prefix_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_customer` int(11) NOT NULL,
  `sorder_attentionto` int(11) NOT NULL,
  `sorder_date` date NOT NULL,
  `sorder_machine_no` int(11) NOT NULL,
  `sorder_enginit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_country` int(11) NOT NULL,
  `sorder_workkind` int(11) NOT NULL,
  `sorder_groupcomp` int(11) NOT NULL,
  `sorder_offerorder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_prodgrp` int(11) NOT NULL,
  `sorder_complstatus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_branchoff` int(11) NOT NULL,
  `sorder_charging` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_eststartdate` date NOT NULL,
  `sorder_estduration` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_engineers` int(11) NOT NULL,
  `sorder_paymentterm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sorder_availability_enginer` date NOT NULL,
  `sorder_completion_date` date NOT NULL,
  `sorder_serfees` int(11) NOT NULL,
  `sorder_serfees_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `sorder_workcontent` text COLLATE utf8_unicode_ci NOT NULL,
  `sorder_status` int(11) NOT NULL,
  `sorder_tsstatus` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_stock_transaction`
--

CREATE TABLE `db_stock_transaction` (
  `transaction_id` int(11) NOT NULL,
  `documentline_id` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `type` varchar(5) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `uom` varchar(15) NOT NULL,
  `location` varchar(15) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `cost` decimal(10,4) NOT NULL,
  `avg_cost` decimal(10,4) NOT NULL,
  `document_date` date NOT NULL,
  `custsupp_id` varchar(50) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `insertBy` varchar(15) NOT NULL,
  `updateDateTime` datetime NOT NULL,
  `updateBy` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_stock_transaction`
--

INSERT INTO `db_stock_transaction` (`transaction_id`, `documentline_id`, `ref_id`, `quantity`, `type`, `item_code`, `uom`, `location`, `item_id`, `cost`, `avg_cost`, `document_date`, `custsupp_id`, `insertDateTime`, `insertBy`, `updateDateTime`, `updateBy`) VALUES
(33823, '435', '135', '8.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-09-27', '93', '2017-09-27 09:24:44', '10000', '2017-09-27 09:24:44', '10000'),
(33824, '436', '135', '4.0000', 'OUT', '', '13', '', '1', '0.0000', '0.0000', '2017-09-27', '93', '2017-09-27 09:24:44', '10000', '2017-09-27 09:24:44', '10000'),
(33825, '436', '135', '6.0000', 'OUT', '', '13', '', '5', '0.0000', '0.0000', '2017-09-27', '93', '2017-09-27 09:24:44', '10000', '2017-09-27 09:24:44', '10000'),
(33826, '437', '135', '10.0000', 'OUT', '', '13', '', '5', '20.0000', '0.0000', '2017-09-27', '93', '2017-09-27 09:24:45', '10000', '2017-09-27 09:24:45', '10000'),
(33827, '440', '137', '10.0000', 'IN', '', '8', '', '1', '12.0000', '0.0000', '2017-09-27', '92', '2017-09-27 09:27:58', '10000', '2017-09-27 09:27:58', '10000'),
(33828, '441', '137', '12.0000', 'IN', '', '8', '', '5', '20.0000', '0.0000', '2017-09-27', '92', '2017-09-27 09:27:58', '10000', '2017-09-27 09:27:58', '10000'),
(33829, '445', '139', '1.0000', 'OUT', '', '0', '', '7', '80.0000', '0.0000', '2017-09-27', '94', '2017-09-27 10:10:02', '10000', '2017-09-27 10:10:02', '10000'),
(33830, '446', '139', '1.0000', 'OUT', '', '0', '', '9', '50.0000', '0.0000', '2017-09-27', '94', '2017-09-27 10:10:03', '10000', '2017-09-27 10:10:03', '10000'),
(33831, '447', '139', '2.0000', 'OUT', '', '0', '', '5', '20.0000', '0.0000', '2017-09-27', '94', '2017-09-27 10:10:03', '10000', '2017-09-27 10:10:03', '10000'),
(33832, '187', '87', '2.0000', 'OUT', '', '8', '', '5', '20.0000', '0.0000', '2017-09-27', '92', '2017-09-27 10:14:18', '10000', '2017-09-27 10:14:18', '10000'),
(33833, '188', '87', '2.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-09-27', '92', '2017-09-27 10:35:24', '10000', '2017-09-27 10:35:24', '10000'),
(33834, '188', '87', '3.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-09-27', '92', '2017-09-27 10:35:49', '10000', '2017-09-27 10:35:49', '10000'),
(33835, '453', '146', '5.0000', 'OUT', '', '8', '', '8', '60.0000', '0.0000', '2017-10-27', '93', '2017-10-27 15:25:00', '10000', '2017-10-27 15:25:00', '10000'),
(33836, '454', '146', '1.0000', 'OUT', '', '8', '', '10', '35.0000', '0.0000', '2017-10-27', '93', '2017-10-27 15:25:00', '10000', '2017-10-27 15:25:00', '10000'),
(33837, '455', '146', '1.0000', 'OUT', '', '8', '', '11', '15.0000', '0.0000', '2017-10-27', '93', '2017-10-27 15:25:01', '10000', '2017-10-27 15:25:01', '10000'),
(33838, '463', '150', '2.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-11-03', '93', '2017-11-03 10:54:45', '10000', '2017-11-03 10:54:45', '10000'),
(33839, '464', '150', '2.0000', 'OUT', '', '8', '', '5', '20.0000', '0.0000', '2017-11-03', '93', '2017-11-03 10:54:46', '10000', '2017-11-03 10:54:46', '10000'),
(33840, '465', '150', '3.0000', 'OUT', '', '8', '', '7', '80.0000', '0.0000', '2017-11-03', '93', '2017-11-03 10:54:46', '10000', '2017-11-03 10:54:46', '10000'),
(33841, '469', '152', '1.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-11-03', '95', '2017-11-03 10:56:29', '10000', '2017-11-03 10:56:29', '10000'),
(33842, '470', '152', '1.0000', 'OUT', '', '8', '', '5', '20.0000', '0.0000', '2017-11-03', '95', '2017-11-03 10:56:29', '10000', '2017-11-03 10:56:29', '10000'),
(33843, '471', '152', '1.0000', 'OUT', '', '8', '', '9', '50.0000', '0.0000', '2017-11-03', '95', '2017-11-03 10:56:30', '10000', '2017-11-03 10:56:30', '10000'),
(33844, '480', '156', '1.0000', 'OUT', '', '8', '', '8', '60.0000', '0.0000', '2017-11-03', '93', '2017-11-03 11:44:24', '10000', '2017-11-03 11:44:24', '10000'),
(33845, '481', '156', '5.0000', 'OUT', '', '13', '', '6', '80.0000', '0.0000', '2017-11-03', '93', '2017-11-03 11:44:24', '10000', '2017-11-03 11:44:24', '10000'),
(33846, '482', '156', '2.0000', 'OUT', '', '13', '', '1', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 11:44:24', '10000', '2017-11-03 11:44:24', '10000'),
(33847, '482', '156', '3.0000', 'OUT', '', '13', '', '5', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 11:44:24', '10000', '2017-11-03 11:44:24', '10000'),
(33848, '494', '159', '1.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:33', '10000', '2017-11-03 16:39:33', '10000'),
(33849, '495', '159', '1.0000', 'OUT', '', '8', '', '5', '20.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:33', '10000', '2017-11-03 16:39:33', '10000'),
(33850, '496', '159', '2.0000', 'OUT', '', '8', '', '1', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:34', '10000', '2017-11-03 16:39:34', '10000'),
(33851, '496', '159', '3.0000', 'OUT', '', '8', '', '5', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:34', '10000', '2017-11-03 16:39:34', '10000'),
(33852, '497', '159', '1.0000', 'OUT', '', '8', '', '1', '12.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:35', '10000', '2017-11-03 16:39:35', '10000'),
(33853, '498', '159', '1.0000', 'OUT', '', '8', '', '5', '20.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:35', '10000', '2017-11-03 16:39:35', '10000'),
(33854, '499', '159', '4.0000', 'OUT', '', '8', '', '1', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:35', '10000', '2017-11-03 16:39:35', '10000'),
(33855, '499', '159', '6.0000', 'OUT', '', '8', '', '5', '0.0000', '0.0000', '2017-11-03', '93', '2017-11-03 16:39:36', '10000', '2017-11-03 16:39:36', '10000'),
(33856, '500', '164', '1.0000', 'IN', '', '8', '', '1', '12.0000', '0.0000', '2017-12-13', '92', '2017-12-13 14:29:42', '10000', '2017-12-13 14:29:42', '10000'),
(33857, '501', '164', '1.0000', 'IN', '', '8', '', '5', '20.0000', '0.0000', '2017-12-13', '92', '2017-12-13 14:29:43', '10000', '2017-12-13 14:29:43', '10000'),
(33858, '502', '165', '1.0000', 'IN', '', '8', '', '1', '12.0000', '0.0000', '2017-12-13', '92', '2017-12-13 14:31:12', '10000', '2017-12-13 14:31:12', '10000'),
(33859, '503', '165', '1.0000', 'IN', '', '8', '', '5', '20.0000', '0.0000', '2017-12-13', '92', '2017-12-13 14:31:13', '10000', '2017-12-13 14:31:13', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `db_subgroup`
--

CREATE TABLE `db_subgroup` (
  `subgroup_id` int(11) NOT NULL,
  `subgroup_main_id` int(11) NOT NULL,
  `subgroup_name` varchar(50) NOT NULL,
  `subgroup_remark` text NOT NULL,
  `subgroup_seqno` int(11) NOT NULL,
  `subgroup_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_subgroup`
--

INSERT INTO `db_subgroup` (`subgroup_id`, `subgroup_main_id`, `subgroup_name`, `subgroup_remark`, `subgroup_seqno`, `subgroup_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 3, 'SEA WATER STRAINERS', 'SEA WATER STRAINERS', 0, 1, 10000, '2017-09-05 16:46:15', 10000, '2017-09-05 16:46:15'),
(2, 1, 'MULTI PURPOSE IMPELLER  PUMPS', 'MULTI PURPOSE IMPELLER  PUMP', 0, 1, 10000, '2017-09-05 16:46:38', 10000, '2017-09-11 14:16:45'),
(3, 4, 'ENGINE COOLING PUMPS', 'ENGINE COOLING PUMPS', 0, 1, 10000, '2017-09-05 16:47:17', 10000, '2017-09-05 16:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `db_timesheet`
--

CREATE TABLE `db_timesheet` (
  `timesheet_id` int(11) NOT NULL,
  `timesheet_outlet` int(11) NOT NULL,
  `timesheet_so` int(11) NOT NULL,
  `timesheet_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `timesheet_engineers` int(11) NOT NULL,
  `timesheet_date` date NOT NULL,
  `timesheet_ispublicholiday` int(11) NOT NULL,
  `timesheet_otfactor` decimal(10,2) NOT NULL,
  `timesheet_travtimefrom` decimal(10,2) NOT NULL,
  `timesheet_travtimeto` decimal(10,2) NOT NULL,
  `timesheet_rettravtimefrom` decimal(10,2) NOT NULL,
  `timesheet_rettravtimeto` decimal(10,2) NOT NULL,
  `timesheet_workingtimefrom` decimal(10,2) NOT NULL,
  `timesheet_workingtimeto` decimal(10,2) NOT NULL,
  `timesheet_breaktimetrav` decimal(10,2) NOT NULL,
  `timesheet_breaktimework` decimal(10,2) NOT NULL,
  `timesheet_travtimecpl` decimal(10,2) NOT NULL,
  `timesheet_worktimecpl` decimal(10,2) NOT NULL,
  `timesheet_travtimetotal` decimal(10,2) NOT NULL,
  `timesheet_rettravtimetotal` decimal(10,2) NOT NULL,
  `timesheet_workingtimetotal` decimal(10,2) NOT NULL,
  `timesheet_worktimecpltotal` decimal(10,2) NOT NULL,
  `timesheet_chargekeycode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `timesheet_workconducted` text COLLATE utf8_unicode_ci NOT NULL,
  `timesheet_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_trannote`
--

CREATE TABLE `db_trannote` (
  `trannote_id` int(11) NOT NULL,
  `trannote_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trannote_gst` int(11) NOT NULL,
  `trannote_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `trannote_seqno` int(11) NOT NULL,
  `trannote_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_tranremark`
--

CREATE TABLE `db_tranremark` (
  `tranremark_id` int(11) NOT NULL,
  `tranremark_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tranremark_gst` int(11) NOT NULL,
  `tranremark_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `tranremark_seqno` int(11) NOT NULL,
  `tranremark_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_transittime`
--

CREATE TABLE `db_transittime` (
  `transittime_id` int(11) NOT NULL,
  `transittime_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transittime_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `transittime_seqno` int(11) NOT NULL,
  `transittime_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_transittime`
--

INSERT INTO `db_transittime` (`transittime_id`, `transittime_code`, `transittime_desc`, `transittime_seqno`, `transittime_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'T1', 'About 3-4 working days after confirm order', 10, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 14:24:12'),
(2, 'T2', 'About 5-7 working days from USA to SIN', 20, 1, 0, '0000-00-00 00:00:00', 10000, '2017-07-17 15:30:23'),
(3, 'T3', 'Within 3 weeks from USA - SIN after confirm order', 30, 1, 0, '2016-03-01 11:16:29', 10000, '2017-07-17 15:30:30'),
(4, 'T4', 'About 1 week after order ', 10, 1, 10000, '2017-08-21 10:05:52', 10000, '2017-08-21 10:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `db_uom`
--

CREATE TABLE `db_uom` (
  `uom_id` int(11) NOT NULL,
  `uom_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uom_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `uom_seqno` int(11) NOT NULL,
  `uom_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_uom`
--

INSERT INTO `db_uom` (`uom_id`, `uom_code`, `uom_desc`, `uom_seqno`, `uom_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(8, 'mm', 'mm', 20, 1, 0, '2016-02-17 20:56:24', 0, '2016-02-17 20:56:24'),
(9, 'm', 'm', 30, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'kg', 'kg', 70, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'Liter', 'Liter', 80, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'Manday', 'Manday', 90, 1, 0, '0000-00-00 00:00:00', 10000, '2017-09-11 13:43:08'),
(16, 'Pc', 'Pieces', 1, 1, 10000, '2017-12-19 13:09:32', 10000, '2017-12-19 13:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `db_validity`
--

CREATE TABLE `db_validity` (
  `validity_id` int(11) NOT NULL,
  `validity_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validity_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `validity_seqno` int(11) NOT NULL,
  `validity_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_validity`
--

INSERT INTO `db_validity` (`validity_id`, `validity_code`, `validity_desc`, `validity_seqno`, `validity_status`, `insertBy`, `insertDateTime`, `updateBy`, `updateDateTime`) VALUES
(1, 'v1', '14 days hereof', 10, 1, 10000, '2017-04-23 09:27:25', 10000, '2017-09-11 13:43:53'),
(2, 'v2', '30 days hereof', 20, 1, 10000, '2017-04-23 09:27:34', 10000, '2017-09-07 17:17:35'),
(3, 'v3', '60 days hereof', 30, 1, 10000, '2017-07-17 15:40:40', 10000, '2017-09-07 17:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `db_vo`
--

CREATE TABLE `db_vo` (
  `vo_id` int(11) NOT NULL,
  `vo_date` date NOT NULL,
  `vo_ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vo_amount` decimal(15,2) NOT NULL,
  `vo_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_workkind`
--

CREATE TABLE `db_workkind` (
  `workkind_id` int(11) NOT NULL,
  `workkind_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `workkind_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `workkind_seqno` int(11) NOT NULL,
  `workkind_status` int(11) NOT NULL,
  `insertBy` int(11) NOT NULL,
  `insertDateTime` datetime NOT NULL,
  `updateBy` int(11) NOT NULL,
  `updateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_acls`
--
ALTER TABLE `db_acls`
  ADD PRIMARY KEY (`acls_id`);

--
-- Indexes for table `db_additional`
--
ALTER TABLE `db_additional`
  ADD PRIMARY KEY (`additional_id`);

--
-- Indexes for table `db_additionaltype`
--
ALTER TABLE `db_additionaltype`
  ADD PRIMARY KEY (`additionaltype_id`);

--
-- Indexes for table `db_attendance`
--
ALTER TABLE `db_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `db_backcharge`
--
ALTER TABLE `db_backcharge`
  ADD PRIMARY KEY (`backcharge_id`);

--
-- Indexes for table `db_bank`
--
ALTER TABLE `db_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `db_bcline`
--
ALTER TABLE `db_bcline`
  ADD PRIMARY KEY (`bcline_id`);

--
-- Indexes for table `db_brand`
--
ALTER TABLE `db_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `db_cacc`
--
ALTER TABLE `db_cacc`
  ADD PRIMARY KEY (`cacc_id`);

--
-- Indexes for table `db_category`
--
ALTER TABLE `db_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `db_claim`
--
ALTER TABLE `db_claim`
  ADD PRIMARY KEY (`claim_id`);

--
-- Indexes for table `db_claims`
--
ALTER TABLE `db_claims`
  ADD PRIMARY KEY (`claims_id`);

--
-- Indexes for table `db_claimsline`
--
ALTER TABLE `db_claimsline`
  ADD PRIMARY KEY (`claimsline_id`);

--
-- Indexes for table `db_claimstype`
--
ALTER TABLE `db_claimstype`
  ADD PRIMARY KEY (`claimstype_id`);

--
-- Indexes for table `db_clmd`
--
ALTER TABLE `db_clmd`
  ADD PRIMARY KEY (`clmd_id`);

--
-- Indexes for table `db_clms`
--
ALTER TABLE `db_clms`
  ADD PRIMARY KEY (`clms_id`);

--
-- Indexes for table `db_contact`
--
ALTER TABLE `db_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `db_country`
--
ALTER TABLE `db_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `db_countryitem`
--
ALTER TABLE `db_countryitem`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `db_cprofile`
--
ALTER TABLE `db_cprofile`
  ADD PRIMARY KEY (`cprofile_id`),
  ADD UNIQUE KEY `cprofile_id` (`cprofile_id`);

--
-- Indexes for table `db_crate`
--
ALTER TABLE `db_crate`
  ADD PRIMARY KEY (`crate_id`);

--
-- Indexes for table `db_currency`
--
ALTER TABLE `db_currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `db_deductions`
--
ALTER TABLE `db_deductions`
  ADD PRIMARY KEY (`deductions_id`);

--
-- Indexes for table `db_delivery`
--
ALTER TABLE `db_delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `db_department`
--
ALTER TABLE `db_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `db_empl`
--
ALTER TABLE `db_empl`
  ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `db_emplleave`
--
ALTER TABLE `db_emplleave`
  ADD PRIMARY KEY (`emplleave_id`);

--
-- Indexes for table `db_emplpass`
--
ALTER TABLE `db_emplpass`
  ADD PRIMARY KEY (`emplpass_id`);

--
-- Indexes for table `db_emplsalary`
--
ALTER TABLE `db_emplsalary`
  ADD PRIMARY KEY (`emplsalary_id`);

--
-- Indexes for table `db_equipment`
--
ALTER TABLE `db_equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `db_equiptransfer`
--
ALTER TABLE `db_equiptransfer`
  ADD PRIMARY KEY (`equiptransfer_id`);

--
-- Indexes for table `db_expenses`
--
ALTER TABLE `db_expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `db_freightcharge`
--
ALTER TABLE `db_freightcharge`
  ADD PRIMARY KEY (`freightcharge_id`);

--
-- Indexes for table `db_group`
--
ALTER TABLE `db_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `db_groupcomp`
--
ALTER TABLE `db_groupcomp`
  ADD PRIMARY KEY (`groupcomp_id`);

--
-- Indexes for table `db_image`
--
ALTER TABLE `db_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `db_industry`
--
ALTER TABLE `db_industry`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `db_info`
--
ALTER TABLE `db_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `db_invl`
--
ALTER TABLE `db_invl`
  ADD PRIMARY KEY (`invl_id`);

--
-- Indexes for table `db_invoice`
--
ALTER TABLE `db_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `db_iscategory`
--
ALTER TABLE `db_iscategory`
  ADD PRIMARY KEY (`iscategory_id`);

--
-- Indexes for table `db_isscategory`
--
ALTER TABLE `db_isscategory`
  ADD PRIMARY KEY (`isscategory_id`);

--
-- Indexes for table `db_labour`
--
ALTER TABLE `db_labour`
  ADD PRIMARY KEY (`labour_id`);

--
-- Indexes for table `db_labourline`
--
ALTER TABLE `db_labourline`
  ADD PRIMARY KEY (`labourline_id`);

--
-- Indexes for table `db_lang`
--
ALTER TABLE `db_lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `db_leave`
--
ALTER TABLE `db_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `db_leavetype`
--
ALTER TABLE `db_leavetype`
  ADD PRIMARY KEY (`leavetype_id`);

--
-- Indexes for table `db_logininfo`
--
ALTER TABLE `db_logininfo`
  ADD PRIMARY KEY (`logininfo_id`);

--
-- Indexes for table `db_machine`
--
ALTER TABLE `db_machine`
  ADD PRIMARY KEY (`machine_id`);

--
-- Indexes for table `db_machinetype`
--
ALTER TABLE `db_machinetype`
  ADD PRIMARY KEY (`machinetype_id`);

--
-- Indexes for table `db_maingroup`
--
ALTER TABLE `db_maingroup`
  ADD PRIMARY KEY (`maingroup_id`);

--
-- Indexes for table `db_manufacturer`
--
ALTER TABLE `db_manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `db_markup`
--
ALTER TABLE `db_markup`
  ADD PRIMARY KEY (`markup_id`);

--
-- Indexes for table `db_material`
--
ALTER TABLE `db_material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `db_materialcategory`
--
ALTER TABLE `db_materialcategory`
  ADD PRIMARY KEY (`materialcategory_id`);

--
-- Indexes for table `db_materialline`
--
ALTER TABLE `db_materialline`
  ADD PRIMARY KEY (`materialline_id`);

--
-- Indexes for table `db_menu`
--
ALTER TABLE `db_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `db_menuprm`
--
ALTER TABLE `db_menuprm`
  ADD PRIMARY KEY (`menuprm_id`);

--
-- Indexes for table `db_mscategory`
--
ALTER TABLE `db_mscategory`
  ADD PRIMARY KEY (`mscategory_id`);

--
-- Indexes for table `db_msscategory`
--
ALTER TABLE `db_msscategory`
  ADD PRIMARY KEY (`msscategory_id`);

--
-- Indexes for table `db_nationality`
--
ALTER TABLE `db_nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `db_order`
--
ALTER TABLE `db_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `db_ordl`
--
ALTER TABLE `db_ordl`
  ADD PRIMARY KEY (`ordl_id`);

--
-- Indexes for table `db_outl`
--
ALTER TABLE `db_outl`
  ADD PRIMARY KEY (`outl_id`);

--
-- Indexes for table `db_package`
--
ALTER TABLE `db_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `db_partner`
--
ALTER TABLE `db_partner`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indexes for table `db_partneraddresstype`
--
ALTER TABLE `db_partneraddresstype`
  ADD PRIMARY KEY (`partneraddresstype_id`);

--
-- Indexes for table `db_pattendance`
--
ALTER TABLE `db_pattendance`
  ADD PRIMARY KEY (`pattendance_id`);

--
-- Indexes for table `db_payline`
--
ALTER TABLE `db_payline`
  ADD PRIMARY KEY (`payline_id`);

--
-- Indexes for table `db_paymentterm`
--
ALTER TABLE `db_paymentterm`
  ADD PRIMARY KEY (`paymentterm_id`);

--
-- Indexes for table `db_payroll`
--
ALTER TABLE `db_payroll`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `db_pclaim`
--
ALTER TABLE `db_pclaim`
  ADD PRIMARY KEY (`pclaim_id`);

--
-- Indexes for table `db_pclaimline`
--
ALTER TABLE `db_pclaimline`
  ADD PRIMARY KEY (`pclaimline_id`);

--
-- Indexes for table `db_pempl`
--
ALTER TABLE `db_pempl`
  ADD PRIMARY KEY (`pempl_id`);

--
-- Indexes for table `db_pequipment`
--
ALTER TABLE `db_pequipment`
  ADD PRIMARY KEY (`pequipment_id`);

--
-- Indexes for table `db_pointofdelivery`
--
ALTER TABLE `db_pointofdelivery`
  ADD PRIMARY KEY (`pointofdelivery_id`);

--
-- Indexes for table `db_prefix`
--
ALTER TABLE `db_prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `db_price`
--
ALTER TABLE `db_price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `db_proaward`
--
ALTER TABLE `db_proaward`
  ADD PRIMARY KEY (`proaward_id`);

--
-- Indexes for table `db_probom`
--
ALTER TABLE `db_probom`
  ADD PRIMARY KEY (`probom_id`);

--
-- Indexes for table `db_prodgrp`
--
ALTER TABLE `db_prodgrp`
  ADD PRIMARY KEY (`prodgrp_id`);

--
-- Indexes for table `db_product`
--
ALTER TABLE `db_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `db_productpackage`
--
ALTER TABLE `db_productpackage`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `db_producttype`
--
ALTER TABLE `db_producttype`
  ADD PRIMARY KEY (`producttype_id`);

--
-- Indexes for table `db_product_bk`
--
ALTER TABLE `db_product_bk`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `db_project`
--
ALTER TABLE `db_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `db_projectstatus`
--
ALTER TABLE `db_projectstatus`
  ADD PRIMARY KEY (`projectstatus_id`);

--
-- Indexes for table `db_prolabour`
--
ALTER TABLE `db_prolabour`
  ADD PRIMARY KEY (`prolabour_id`);

--
-- Indexes for table `db_pw`
--
ALTER TABLE `db_pw`
  ADD PRIMARY KEY (`pw_id`);

--
-- Indexes for table `db_pwl`
--
ALTER TABLE `db_pwl`
  ADD PRIMARY KEY (`pwl_id`);

--
-- Indexes for table `db_pworker`
--
ALTER TABLE `db_pworker`
  ADD PRIMARY KEY (`pworker_id`);

--
-- Indexes for table `db_record_curl`
--
ALTER TABLE `db_record_curl`
  ADD PRIMARY KEY (`db_record_id`);

--
-- Indexes for table `db_refn`
--
ALTER TABLE `db_refn`
  ADD PRIMARY KEY (`refn_id`);

--
-- Indexes for table `db_refncode`
--
ALTER TABLE `db_refncode`
  ADD PRIMARY KEY (`refn_id`);

--
-- Indexes for table `db_remarks`
--
ALTER TABLE `db_remarks`
  ADD PRIMARY KEY (`remarks_id`);

--
-- Indexes for table `db_serfees`
--
ALTER TABLE `db_serfees`
  ADD PRIMARY KEY (`serfees_id`);

--
-- Indexes for table `db_shipaddress`
--
ALTER TABLE `db_shipaddress`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `db_shipterm`
--
ALTER TABLE `db_shipterm`
  ADD PRIMARY KEY (`shipterm_id`);

--
-- Indexes for table `db_sorder`
--
ALTER TABLE `db_sorder`
  ADD PRIMARY KEY (`sorder_id`);

--
-- Indexes for table `db_stock_transaction`
--
ALTER TABLE `db_stock_transaction`
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `db_subgroup`
--
ALTER TABLE `db_subgroup`
  ADD PRIMARY KEY (`subgroup_id`);

--
-- Indexes for table `db_timesheet`
--
ALTER TABLE `db_timesheet`
  ADD PRIMARY KEY (`timesheet_id`);

--
-- Indexes for table `db_trannote`
--
ALTER TABLE `db_trannote`
  ADD PRIMARY KEY (`trannote_id`);

--
-- Indexes for table `db_tranremark`
--
ALTER TABLE `db_tranremark`
  ADD PRIMARY KEY (`tranremark_id`);

--
-- Indexes for table `db_transittime`
--
ALTER TABLE `db_transittime`
  ADD PRIMARY KEY (`transittime_id`);

--
-- Indexes for table `db_uom`
--
ALTER TABLE `db_uom`
  ADD PRIMARY KEY (`uom_id`);

--
-- Indexes for table `db_validity`
--
ALTER TABLE `db_validity`
  ADD PRIMARY KEY (`validity_id`);

--
-- Indexes for table `db_vo`
--
ALTER TABLE `db_vo`
  ADD PRIMARY KEY (`vo_id`);

--
-- Indexes for table `db_workkind`
--
ALTER TABLE `db_workkind`
  ADD PRIMARY KEY (`workkind_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_acls`
--
ALTER TABLE `db_acls`
  MODIFY `acls_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_additional`
--
ALTER TABLE `db_additional`
  MODIFY `additional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_additionaltype`
--
ALTER TABLE `db_additionaltype`
  MODIFY `additionaltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `db_attendance`
--
ALTER TABLE `db_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `db_backcharge`
--
ALTER TABLE `db_backcharge`
  MODIFY `backcharge_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_bank`
--
ALTER TABLE `db_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_bcline`
--
ALTER TABLE `db_bcline`
  MODIFY `bcline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_brand`
--
ALTER TABLE `db_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_cacc`
--
ALTER TABLE `db_cacc`
  MODIFY `cacc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_category`
--
ALTER TABLE `db_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `db_claim`
--
ALTER TABLE `db_claim`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_claims`
--
ALTER TABLE `db_claims`
  MODIFY `claims_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_claimsline`
--
ALTER TABLE `db_claimsline`
  MODIFY `claimsline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_claimstype`
--
ALTER TABLE `db_claimstype`
  MODIFY `claimstype_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_clmd`
--
ALTER TABLE `db_clmd`
  MODIFY `clmd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_clms`
--
ALTER TABLE `db_clms`
  MODIFY `clms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_contact`
--
ALTER TABLE `db_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `db_country`
--
ALTER TABLE `db_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `db_countryitem`
--
ALTER TABLE `db_countryitem`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `db_cprofile`
--
ALTER TABLE `db_cprofile`
  MODIFY `cprofile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_crate`
--
ALTER TABLE `db_crate`
  MODIFY `crate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_currency`
--
ALTER TABLE `db_currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_deductions`
--
ALTER TABLE `db_deductions`
  MODIFY `deductions_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_delivery`
--
ALTER TABLE `db_delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `db_department`
--
ALTER TABLE `db_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `db_empl`
--
ALTER TABLE `db_empl`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `db_emplleave`
--
ALTER TABLE `db_emplleave`
  MODIFY `emplleave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `db_emplpass`
--
ALTER TABLE `db_emplpass`
  MODIFY `emplpass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `db_emplsalary`
--
ALTER TABLE `db_emplsalary`
  MODIFY `emplsalary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `db_equipment`
--
ALTER TABLE `db_equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_equiptransfer`
--
ALTER TABLE `db_equiptransfer`
  MODIFY `equiptransfer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_expenses`
--
ALTER TABLE `db_expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_freightcharge`
--
ALTER TABLE `db_freightcharge`
  MODIFY `freightcharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `db_group`
--
ALTER TABLE `db_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `db_groupcomp`
--
ALTER TABLE `db_groupcomp`
  MODIFY `groupcomp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_image`
--
ALTER TABLE `db_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `db_industry`
--
ALTER TABLE `db_industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_info`
--
ALTER TABLE `db_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10611;
--
-- AUTO_INCREMENT for table `db_invl`
--
ALTER TABLE `db_invl`
  MODIFY `invl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `db_invoice`
--
ALTER TABLE `db_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `db_iscategory`
--
ALTER TABLE `db_iscategory`
  MODIFY `iscategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `db_isscategory`
--
ALTER TABLE `db_isscategory`
  MODIFY `isscategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_labour`
--
ALTER TABLE `db_labour`
  MODIFY `labour_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_labourline`
--
ALTER TABLE `db_labourline`
  MODIFY `labourline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_lang`
--
ALTER TABLE `db_lang`
  MODIFY `lang_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_leave`
--
ALTER TABLE `db_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `db_leavetype`
--
ALTER TABLE `db_leavetype`
  MODIFY `leavetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `db_logininfo`
--
ALTER TABLE `db_logininfo`
  MODIFY `logininfo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_machine`
--
ALTER TABLE `db_machine`
  MODIFY `machine_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_machinetype`
--
ALTER TABLE `db_machinetype`
  MODIFY `machinetype_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_maingroup`
--
ALTER TABLE `db_maingroup`
  MODIFY `maingroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_manufacturer`
--
ALTER TABLE `db_manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_markup`
--
ALTER TABLE `db_markup`
  MODIFY `markup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_material`
--
ALTER TABLE `db_material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_materialcategory`
--
ALTER TABLE `db_materialcategory`
  MODIFY `materialcategory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_materialline`
--
ALTER TABLE `db_materialline`
  MODIFY `materialline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_menu`
--
ALTER TABLE `db_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `db_menuprm`
--
ALTER TABLE `db_menuprm`
  MODIFY `menuprm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3124;
--
-- AUTO_INCREMENT for table `db_mscategory`
--
ALTER TABLE `db_mscategory`
  MODIFY `mscategory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_msscategory`
--
ALTER TABLE `db_msscategory`
  MODIFY `msscategory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_nationality`
--
ALTER TABLE `db_nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `db_order`
--
ALTER TABLE `db_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `db_ordl`
--
ALTER TABLE `db_ordl`
  MODIFY `ordl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
--
-- AUTO_INCREMENT for table `db_outl`
--
ALTER TABLE `db_outl`
  MODIFY `outl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_package`
--
ALTER TABLE `db_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `db_partner`
--
ALTER TABLE `db_partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `db_partneraddresstype`
--
ALTER TABLE `db_partneraddresstype`
  MODIFY `partneraddresstype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `db_pattendance`
--
ALTER TABLE `db_pattendance`
  MODIFY `pattendance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_payline`
--
ALTER TABLE `db_payline`
  MODIFY `payline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_paymentterm`
--
ALTER TABLE `db_paymentterm`
  MODIFY `paymentterm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `db_payroll`
--
ALTER TABLE `db_payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pclaim`
--
ALTER TABLE `db_pclaim`
  MODIFY `pclaim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pclaimline`
--
ALTER TABLE `db_pclaimline`
  MODIFY `pclaimline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pempl`
--
ALTER TABLE `db_pempl`
  MODIFY `pempl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pequipment`
--
ALTER TABLE `db_pequipment`
  MODIFY `pequipment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pointofdelivery`
--
ALTER TABLE `db_pointofdelivery`
  MODIFY `pointofdelivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_prefix`
--
ALTER TABLE `db_prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_price`
--
ALTER TABLE `db_price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_proaward`
--
ALTER TABLE `db_proaward`
  MODIFY `proaward_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_probom`
--
ALTER TABLE `db_probom`
  MODIFY `probom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `db_prodgrp`
--
ALTER TABLE `db_prodgrp`
  MODIFY `prodgrp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_product`
--
ALTER TABLE `db_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `db_productpackage`
--
ALTER TABLE `db_productpackage`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_producttype`
--
ALTER TABLE `db_producttype`
  MODIFY `producttype_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_product_bk`
--
ALTER TABLE `db_product_bk`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `db_project`
--
ALTER TABLE `db_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_projectstatus`
--
ALTER TABLE `db_projectstatus`
  MODIFY `projectstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_prolabour`
--
ALTER TABLE `db_prolabour`
  MODIFY `prolabour_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pw`
--
ALTER TABLE `db_pw`
  MODIFY `pw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `db_pwl`
--
ALTER TABLE `db_pwl`
  MODIFY `pwl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_pworker`
--
ALTER TABLE `db_pworker`
  MODIFY `pworker_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_record_curl`
--
ALTER TABLE `db_record_curl`
  MODIFY `db_record_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_refn`
--
ALTER TABLE `db_refn`
  MODIFY `refn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `db_refncode`
--
ALTER TABLE `db_refncode`
  MODIFY `refn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `db_remarks`
--
ALTER TABLE `db_remarks`
  MODIFY `remarks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `db_serfees`
--
ALTER TABLE `db_serfees`
  MODIFY `serfees_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_shipaddress`
--
ALTER TABLE `db_shipaddress`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_shipterm`
--
ALTER TABLE `db_shipterm`
  MODIFY `shipterm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_sorder`
--
ALTER TABLE `db_sorder`
  MODIFY `sorder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_stock_transaction`
--
ALTER TABLE `db_stock_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33860;
--
-- AUTO_INCREMENT for table `db_subgroup`
--
ALTER TABLE `db_subgroup`
  MODIFY `subgroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_timesheet`
--
ALTER TABLE `db_timesheet`
  MODIFY `timesheet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_trannote`
--
ALTER TABLE `db_trannote`
  MODIFY `trannote_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_tranremark`
--
ALTER TABLE `db_tranremark`
  MODIFY `tranremark_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_transittime`
--
ALTER TABLE `db_transittime`
  MODIFY `transittime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_uom`
--
ALTER TABLE `db_uom`
  MODIFY `uom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `db_validity`
--
ALTER TABLE `db_validity`
  MODIFY `validity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_vo`
--
ALTER TABLE `db_vo`
  MODIFY `vo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_workkind`
--
ALTER TABLE `db_workkind`
  MODIFY `workkind_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
