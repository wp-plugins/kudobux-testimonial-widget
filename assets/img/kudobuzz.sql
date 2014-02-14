-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2014 at 02:05 PM
-- Server version: 5.5.35
-- PHP Version: 5.4.6-1ubuntu1.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kudobuzz`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `primary_fb_page` bigint(20) DEFAULT NULL,
  `primary_tw_acc` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `background_image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conversion_btn_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conversion_btn_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conversion_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_widget_embedded` tinyint(1) NOT NULL DEFAULT '0',
  `is_widget_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `account_name` (`account_name`),
  KEY `user_id` (`user_id`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=874 ;

-- --------------------------------------------------------

--
-- Table structure for table `account_social_page`
--

CREATE TABLE IF NOT EXISTS `account_social_page` (
  `account_id` int(11) NOT NULL,
  `social_profile_id` bigint(20) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `channel_id` int(11) NOT NULL,
  PRIMARY KEY (`account_id`,`social_profile_id`),
  KEY `account_id` (`account_id`),
  KEY `social_profile_id` (`social_profile_id`),
  KEY `channel_id` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `bulk_mail_settings`
--

CREATE TABLE IF NOT EXISTS `bulk_mail_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sending_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8_unicode_ci,
  `test_email` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `datefield` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'twitter handler/facebook username/email',
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel_id` int(3) DEFAULT NULL,
  `platform_id` int(3) DEFAULT NULL,
  `profile_pic` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`,`channel_id`,`platform_id`,`shop`,`account_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shop` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(15) NOT NULL,
  `account_id` int(15) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop`,`user_id`,`account_id`),
  KEY `account_id` (`account_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_feed`
--

CREATE TABLE IF NOT EXISTS `custom_feed` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '1',
  `is_kudos` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK960691AC47140EFE` (`user_id`),
  KEY `account_id` (`account_id`),
  KEY `is_kudos` (`is_kudos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_feed_from_user`
--

CREATE TABLE IF NOT EXISTS `custom_feed_from_user` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '1',
  `is_read` int(1) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `is_kudos` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK960691AC47140EFE` (`user_id`),
  KEY `account_id` (`account_id`),
  KEY `publish` (`publish`),
  KEY `is_read` (`is_read`),
  KEY `is_kudos` (`is_kudos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(3) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` bigint(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`,`email`,`account_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_account`
--

CREATE TABLE IF NOT EXISTS `facebook_account` (
  `id` bigint(20) NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `FKAB8A5B447140EFE` (`user_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_comment`
--

CREATE TABLE IF NOT EXISTS `facebook_comment` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `analysed` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `from_user_id` bigint(20) NOT NULL,
  `media_href` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_src` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `sentiment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_post_facebook_page_facebook_account_id` bigint(20) NOT NULL,
  `facebook_post_facebook_page_facebook_account_user_id` bigint(20) NOT NULL,
  `facebook_post_facebook_page_id` bigint(20) NOT NULL,
  `facebook_post_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`facebook_post_facebook_page_facebook_account_id`,`facebook_post_facebook_page_facebook_account_user_id`,`facebook_post_facebook_page_id`,`facebook_post_id`,`id`),
  KEY `FK898B09E669666F8D` (`facebook_post_facebook_page_facebook_account_id`,`facebook_post_facebook_page_facebook_account_user_id`,`facebook_post_facebook_page_id`,`facebook_post_id`),
  KEY `facebook_post_id` (`facebook_post_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_feed`
--

CREATE TABLE IF NOT EXISTS `facebook_feed` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `analysed` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `entity_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_fbuser_id` bigint(20) NOT NULL,
  `media_href` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_src` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `post_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sentiment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_page_facebook_account_id` bigint(20) DEFAULT NULL,
  `facebook_page_facebook_account_user_id` bigint(20) DEFAULT NULL,
  `facebook_page_id` bigint(20) DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `is_kudos` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_id` (`entity_id`,`facebook_page_facebook_account_user_id`,`facebook_page_id`),
  KEY `FK6098CF774E6E4395` (`facebook_page_facebook_account_id`,`facebook_page_facebook_account_user_id`,`facebook_page_id`),
  KEY `facebook_page_facebook_account_id` (`facebook_page_facebook_account_id`),
  KEY `facebook_page_facebook_account_user_id` (`facebook_page_facebook_account_user_id`),
  KEY `facebook_page_id` (`facebook_page_id`),
  KEY `entity_id_3` (`entity_id`),
  KEY `type` (`type`),
  KEY `is_read` (`is_read`),
  KEY `post_type` (`post_type`),
  KEY `analysed` (`analysed`),
  KEY `is_kudos` (`is_kudos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46711 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_page`
--

CREATE TABLE IF NOT EXISTS `facebook_page` (
  `id` bigint(20) NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `crawled` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_account_id` bigint(20) NOT NULL,
  `facebook_account_user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`facebook_account_id`,`facebook_account_user_id`,`id`),
  KEY `FK609D4C689090AEED` (`facebook_account_id`,`facebook_account_user_id`),
  KEY `facebook_account_user_id` (`facebook_account_user_id`),
  KEY `facebook_account_id` (`facebook_account_id`),
  KEY `active` (`active`),
  KEY `crawled` (`crawled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_post`
--

CREATE TABLE IF NOT EXISTS `facebook_post` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `analysed` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `from_user_id` bigint(20) NOT NULL,
  `is_kudos` tinyint(1) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `sentiment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_page_facebook_account_id` bigint(20) NOT NULL,
  `facebook_page_facebook_account_user_id` bigint(20) NOT NULL,
  `facebook_page_id` bigint(20) NOT NULL,
  `media_href` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_src` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`facebook_page_facebook_account_id`,`facebook_page_facebook_account_user_id`,`facebook_page_id`,`id`),
  KEY `FK609D82794E6E4395` (`facebook_page_facebook_account_id`,`facebook_page_facebook_account_user_id`,`facebook_page_id`),
  KEY `created_at` (`created_at`),
  KEY `is_kudos` (`is_kudos`),
  KEY `sentiment` (`sentiment`),
  KEY `type` (`type`),
  KEY `analysed` (`analysed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `full_page_widget_settings`
--

CREATE TABLE IF NOT EXISTS `full_page_widget_settings` (
  `user_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `widget_type_id` int(2) NOT NULL,
  `max_width` int(4) NOT NULL,
  `review_text_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name_text_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `background_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image_background_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  KEY `user_id` (`user_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_contact`
--

CREATE TABLE IF NOT EXISTS `group_contact` (
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kudo`
--

CREATE TABLE IF NOT EXISTS `kudo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `entityid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `profile_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `channel_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `account_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_review` int(1) NOT NULL DEFAULT '0' COMMENT '1 if it is a review',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entityid_2` (`entityid`,`user_id`),
  KEY `FK326775C63BB736` (`channel_id`),
  KEY `FK32677547140EFE` (`user_id`),
  KEY `is_review` (`is_review`),
  KEY `entityid` (`entityid`),
  KEY `account_id` (`account_id`),
  KEY `position` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2073 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE IF NOT EXISTS `mail_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `days_interval` int(11) NOT NULL,
  `subject` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sending_email` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `test_email` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `after_purchase_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_mails_been_sent_today` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `after_purchase_active` (`after_purchase_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages_sent`
--

CREATE TABLE IF NOT EXISTS `messages_sent` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `channel_id` int(3) NOT NULL,
  `reciever_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(25) NOT NULL,
  `entity_id` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'This could be the kudobuzz shop_orders_id/tweet id, facebook post id',
  PRIMARY KEY (`id`),
  KEY `date` (`date`,`channel_id`,`account_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `account_id` (`account_id`),
  KEY `channel_id` (`channel_id`),
  KEY `reciever_id` (`reciever_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1601 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_rules`
--

CREATE TABLE IF NOT EXISTS `message_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(24) NOT NULL,
  `account_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(2) NOT NULL,
  `coupon_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tw_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `fb_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mail_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `is_active` (`is_active`),
  KEY `type` (`type`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_rules_products`
--

CREATE TABLE IF NOT EXISTS `message_rules_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_rule_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promoted_today` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `promoted_today` (`promoted_today`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `account_id` int(11) NOT NULL,
  `review` tinyint(1) NOT NULL,
  `feed` tinyint(1) NOT NULL,
  `daily_reports` tinyint(1) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preview_messages`
--

CREATE TABLE IF NOT EXISTS `preview_messages` (
  `id` int(3) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_clicks`
--

CREATE TABLE IF NOT EXISTS `product_clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `agent` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `referrer` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`date`),
  KEY `user_id` (`user_id`,`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_review_form_settings`
--

CREATE TABLE IF NOT EXISTS `product_review_form_settings` (
  `account_id` bigint(11) NOT NULL,
  `text_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_button_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `background_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `posts_per_page` int(6) DEFAULT NULL,
  `max_width` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_status` tinyint(1) DEFAULT '1',
  `title_message` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE IF NOT EXISTS `reviewer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_id` int(2) NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signed_up_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`,`channel_id`),
  KEY `channel_id` (`channel_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=107 ;

-- --------------------------------------------------------

--
-- Table structure for table `review_votes`
--

CREATE TABLE IF NOT EXISTS `review_votes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `review_id` varchar(40) DEFAULT NULL,
  `product_info_id` int(11) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `has_voted` int(1) DEFAULT '0' COMMENT '1 -> The user has voted up ; 0 The user has voted down',
  `vote_up` int(1) DEFAULT '0',
  `vote_down` int(1) DEFAULT '0',
  `ip_address` varchar(15) DEFAULT NULL,
  `review_type` int(1) DEFAULT NULL COMMENT '1 => site review ; 2 => product review',
  `voted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vote_up` (`vote_up`),
  KEY `vote_down` (`vote_down`),
  KEY `review_id` (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shop` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `account_id` bigint(11) NOT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crawled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sets it to 1 when new orders are crawled ',
  `source` int(10) NOT NULL DEFAULT '0' COMMENT 'check platform table for corresponding values',
  `api_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`shop`,`user_id`,`account_id`),
  KEY `shop` (`shop`),
  KEY `user_id` (`user_id`),
  KEY `seo_activated` (`seo_activated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_line_items`
--

CREATE TABLE IF NOT EXISTS `shop_line_items` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `shop_orders_id` bigint(26) NOT NULL,
  `line_id` bigint(26) DEFAULT NULL,
  `product_id` varchar(200) NOT NULL,
  `quantity` int(12) NOT NULL DEFAULT '1',
  `requires_shipping` tinyint(1) NOT NULL,
  `sku` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shopify_orders_id` (`shop_orders_id`,`line_id`,`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1104 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE IF NOT EXISTS `shop_orders` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `source` int(1) NOT NULL DEFAULT '0',
  `shop` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` bigint(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepts_marketing` tinyint(1) DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_order_id` bigint(26) DEFAULT NULL,
  `customer_image_url` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fulfillment_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `financial_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email_sent` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop`,`account_id`),
  KEY `email` (`email`),
  KEY `email_sent` (`email_sent`),
  KEY `account_id` (`account_id`),
  KEY `shop_2` (`shop`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=684 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_info`
--

CREATE TABLE IF NOT EXISTS `shop_product_info` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(40) NOT NULL,
  `account_id` bigint(40) NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `data_url` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_url_short` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bread_crumbs` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `handle` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_product_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8_unicode_ci,
  `updated` smallint(1) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clicks` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`domain`),
  KEY `user_id_2` (`user_id`,`account_id`),
  KEY `product_id` (`product_id`(255)),
  KEY `handle` (`handle`(255)),
  KEY `updated` (`updated`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9097 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_review`
--

CREATE TABLE IF NOT EXISTS `shop_product_review` (
  `product_info_id` bigint(25) NOT NULL,
  `source` int(1) NOT NULL DEFAULT '0' COMMENT '0 for shopify - 1 for tictail',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` float NOT NULL,
  `review_user_id` bigint(20) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `is_after_purchase` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `is_kudos` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_info_id`,`review_user_id`),
  KEY `product_info_id` (`product_info_id`),
  KEY `publish` (`publish`),
  KEY `is_read` (`is_read`),
  KEY `review_user_id` (`review_user_id`),
  KEY `source` (`source`),
  KEY `is_after_purchase` (`is_after_purchase`),
  KEY `user_id` (`user_id`,`account_id`),
  KEY `account_id` (`account_id`),
  KEY `is_kudos` (`is_kudos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=196 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider_widget_settings`
--

CREATE TABLE IF NOT EXISTS `slider_widget_settings` (
  `user_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `widget_type_id` int(2) NOT NULL,
  `max_width` int(4) NOT NULL,
  `review_text_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name_text_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `background_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image_background_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  KEY `user_id` (`user_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_leads_searches`
--

CREATE TABLE IF NOT EXISTS `social_leads_searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `search_term` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `num_of_results` int(3) NOT NULL,
  `channel_id` int(3) NOT NULL,
  `search_file_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`,`account_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `social_leads_settings`
--

CREATE TABLE IF NOT EXISTS `social_leads_settings` (
  `account_id` int(11) NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `industry` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE IF NOT EXISTS `tweet` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `entityid` bigint(20) NOT NULL,
  `analysed` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `from_user_id` bigint(20) DEFAULT NULL,
  `in_reply_to_status_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in_reply_to_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_kudos` tinyint(1) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `screen_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sentiment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_account_id` bigint(20) NOT NULL,
  `twitter_account_user_id` bigint(20) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `entityid` (`entityid`,`twitter_account_id`,`twitter_account_user_id`),
  KEY `FK69A46716F1EA648` (`twitter_account_id`,`twitter_account_user_id`),
  KEY `twitter_account_user_id` (`twitter_account_user_id`),
  KEY `twitter_account_id` (`twitter_account_id`),
  KEY `id` (`entityid`),
  KEY `analysed` (`analysed`),
  KEY `type` (`type`),
  KEY `created_at` (`created_at`),
  KEY `sentiment` (`sentiment`),
  KEY `is_read` (`is_read`),
  KEY `is_kudos` (`is_kudos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12397 ;

-- --------------------------------------------------------

--
-- Table structure for table `twitter_account`
--

CREATE TABLE IF NOT EXISTS `twitter_account` (
  `id` bigint(20) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `crawled` tinyint(1) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_token_secret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `screen_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`user_id`),
  KEY `FK2B38B86147140EFE` (`user_id`),
  KEY `id` (`id`),
  KEY `crawled` (`crawled`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_2` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cc2801cdc07e9ee5b52cf29c9abd6a57',
  `profile_pic_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signed_up` datetime DEFAULT NULL,
  `vanity_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connected` tinyint(1) NOT NULL DEFAULT '0',
  `plateform_type` int(2) DEFAULT NULL COMMENT '0 for website - 1 for wordpress - 2 for shopify - 3 for tictail - 4 for Magento - 5 Bigcommerce',
  PRIMARY KEY (`id`),
  KEY `password` (`password`),
  KEY `vanity_name` (`vanity_name`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_form`
--

CREATE TABLE IF NOT EXISTS `web_form` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_message` text,
  `thank_you_message` text,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `account_id` (`account_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `widget_settings`
--

CREATE TABLE IF NOT EXISTS `widget_settings` (
  `user_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `widget_type_id` int(11) NOT NULL,
  `title_font` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_font` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'arial',
  `content_font_size` int(2) NOT NULL DEFAULT '12',
  `background_colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `top_border_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wdg_default_state` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `font_colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `height` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_font_colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_font_size` int(11) NOT NULL DEFAULT '14',
  `title_font_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widget_type` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `alignment` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `wdg_invite_user_txt` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `single_kudo_header` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'A review that is genuine, written by an actual person.',
  `father_christmas` int(11) NOT NULL DEFAULT '0' COMMENT '0 => hidden and 1 => shown',
  `show_widget` int(11) NOT NULL DEFAULT '1' COMMENT '0 => hidden ; 1 => shown',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`,`account_id`),
  KEY `user_id` (`user_id`),
  KEY `account_id` (`account_id`),
  KEY `show_widget` (`show_widget`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widget_type`
--

CREATE TABLE IF NOT EXISTS `widget_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(10) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_feed`
--
ALTER TABLE `custom_feed`
  ADD CONSTRAINT `custom_feed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK960691AC47140EFE` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `facebook_account`
--
ALTER TABLE `facebook_account`
  ADD CONSTRAINT `facebook_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKAB8A5B447140EFE` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `facebook_page`
--
ALTER TABLE `facebook_page`
  ADD CONSTRAINT `facebook_page_ibfk_1` FOREIGN KEY (`facebook_account_id`, `facebook_account_user_id`) REFERENCES `facebook_account` (`id`, `user_id`),
  ADD CONSTRAINT `FK609D4C689090AEED` FOREIGN KEY (`facebook_account_id`, `facebook_account_user_id`) REFERENCES `facebook_account` (`id`, `user_id`);

--
-- Constraints for table `facebook_post`
--
ALTER TABLE `facebook_post`
  ADD CONSTRAINT `facebook_post_ibfk_1` FOREIGN KEY (`facebook_page_facebook_account_id`, `facebook_page_facebook_account_user_id`, `facebook_page_id`) REFERENCES `facebook_page` (`facebook_account_id`, `facebook_account_user_id`, `id`),
  ADD CONSTRAINT `FK609D82794E6E4395` FOREIGN KEY (`facebook_page_facebook_account_id`, `facebook_page_facebook_account_user_id`, `facebook_page_id`) REFERENCES `facebook_page` (`facebook_account_id`, `facebook_account_user_id`, `id`);

--
-- Constraints for table `kudo`
--
ALTER TABLE `kudo`
  ADD CONSTRAINT `FK32677547140EFE` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK326775C63BB736` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`),
  ADD CONSTRAINT `kudo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `kudo_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `FK7B35504647140EFE` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `FK69A46716F1EA648` FOREIGN KEY (`twitter_account_id`, `twitter_account_user_id`) REFERENCES `twitter_account` (`id`, `user_id`),
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`twitter_account_id`, `twitter_account_user_id`) REFERENCES `twitter_account` (`id`, `user_id`);

--
-- Constraints for table `twitter_account`
--
ALTER TABLE `twitter_account`
  ADD CONSTRAINT `FK2B38B86147140EFE` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `twitter_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
