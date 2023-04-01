-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2021 at 07:39 AM
-- Server version: 5.7.32
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retrocub_client_scope_qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logging`
--

CREATE TABLE `activity_logging` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  `action` varchar(100) NOT NULL,
  `description` text,
  `user_request` text,
  `user_agent` text,
  `ip_address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_logging`
--

INSERT INTO `activity_logging` (`id`, `user_id`, `user_type`, `action`, `description`, `user_request`, `user_agent`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '', 'admin.login', NULL, '{\"_token\":\"YnhY0Qd7Q54sGdOdQGwXLmTQiIcyPwQJvSfFuJxr\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-12 13:14:04', '2021-11-12 13:14:04', NULL),
(2, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:47:44', '2021-11-15 07:47:44', NULL),
(3, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:47:52', '2021-11-15 07:47:52', NULL),
(4, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:47:56', '2021-11-15 07:47:56', NULL),
(5, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:48:06', '2021-11-15 07:48:06', NULL),
(6, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:48:14', '2021-11-15 07:48:14', NULL),
(7, 1, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:53:55', '2021-11-15 07:53:55', NULL),
(8, 1, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 07:53:57', '2021-11-15 07:53:57', NULL),
(9, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:05:43', '2021-11-15 08:05:43', NULL),
(10, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:05:53', '2021-11-15 08:05:53', NULL),
(11, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:06:12', '2021-11-15 08:06:12', NULL),
(12, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:06:40', '2021-11-15 08:06:40', NULL),
(13, 1, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:06:46', '2021-11-15 08:06:46', NULL),
(14, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:10:07', '2021-11-15 08:10:07', NULL),
(15, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:10:36', '2021-11-15 08:10:36', NULL),
(16, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"marrie@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:12:02', '2021-11-15 08:12:02', NULL),
(17, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:12:39', '2021-11-15 08:12:39', NULL),
(18, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"william@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 08:19:16', '2021-11-15 08:19:16', NULL),
(19, 1, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 09:04:15', '2021-11-15 09:04:15', NULL),
(20, 0, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"sr@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 09:07:59', '2021-11-15 09:07:59', NULL),
(21, 122, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 10:21:40', '2021-11-15 10:21:40', NULL),
(22, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 11:55:42', '2021-11-15 11:55:42', NULL),
(23, 122, '', 'admin.add-status', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"title\":\"CS Status\",\"kpi_group_id\":\"6\",\"metric_id\":\"2\",\"custom_metric_title\":\"new metric\",\"type\":\"pin\",\"image_url\":\"#45E5CB|https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/assets\\/images\\/2.png\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 12:02:52', '2021-11-15 12:02:52', NULL),
(24, 122, '', 'admin.add-status', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"title\":\"web status\",\"kpi_group_id\":\"6\",\"metric_id\":\"2\",\"custom_metric_title\":\"abv\",\"type\":\"pin\",\"image_url\":\"#453E4A|https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/assets\\/images\\/3.png\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 12:04:19', '2021-11-15 12:04:19', NULL),
(25, 122, '', 'admin.add-status', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"title\":\"web status\",\"kpi_group_id\":\"6\",\"metric_id\":\"3\",\"custom_metric_title\":\"abv\",\"type\":\"pin\",\"image_url\":\"#453E4A|https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/assets\\/images\\/3.png\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 12:04:25', '2021-11-15 12:04:25', NULL),
(26, 122, '', 'admin.add-status', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"title\":\"qa 3\",\"kpi_group_id\":\"10\",\"metric_id\":\"3\",\"custom_metric_title\":\"klien\",\"type\":\"pin\",\"image_url\":\"#CC7A7A|https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/assets\\/images\\/4.png\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 12:06:46', '2021-11-15 12:06:46', NULL),
(27, 0, '', 'admin.login', NULL, '{\"_token\":\"UOmc08fnKsTMWh20EPETl0n7SD7xAa3NeXVSP8xK\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-15 12:47:26', '2021-11-15 12:47:26', NULL),
(28, 0, '', 'admin.login', NULL, '{\"_token\":\"UOmc08fnKsTMWh20EPETl0n7SD7xAa3NeXVSP8xK\",\"email\":\"company@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-15 12:47:35', '2021-11-15 12:47:35', NULL),
(29, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:10:30', '2021-11-15 13:10:30', NULL),
(30, 122, '', 'admin.add-pin', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"territory_id\":\"0\",\"pin_status_id\":\"2\",\"assignee_user_id\":\"122\",\"house_number\":\"h#2034\",\"unit\":null,\"city\":\"New York\",\"name\":null,\"email\":null,\"house_address\":\"26 Federal Plaza, New York, NY, USA\",\"latitude\":\"40.7157174\",\"longitude\":\"-74.0042539\",\"state\":\"NY\",\"zipcode\":\"10278\",\"phone\":null,\"appointment_title\":[\"new appointment 15 nov\"],\"assign_to_calender\":[\"122\"],\"start_datetime\":[\"2021-11-15T18:12\"],\"end_datetime\":[\"2021-11-17T21:12\"],\"duration\":[\"1\"],\"appointment_notes\":[\"qa notes\"],\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:11:37', '2021-11-15 13:11:37', NULL),
(31, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:11:40', '2021-11-15 13:11:40', NULL),
(32, 122, '', 'admin.territory.save', NULL, '{\"geofence_detail\":\"[{\\\"latitude\\\":40.716178888236136,\\\"longitude\\\":-74.0050330817188},{\\\"latitude\\\":40.71558525520227,\\\"longitude\\\":-74.00567412967337},{\\\"latitude\\\":40.71514002695317,\\\"longitude\\\":-74.00499821300161}]\",\"center_point\":\"{\\\"latitude\\\":40.715634723463864,\\\"longitude\\\":-74.0052351414646}\",\"color\":\"#ff0000\",\"title\":\"qa territory\",\"universe\":\"12302\",\"assignee_user_id\":[\"122\"],\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:16:04', '2021-11-15 13:16:04', NULL),
(33, 122, '', 'admin.territory.update', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"geofence_detail\":\"[{\\\"latitude\\\":40.716178888236136,\\\"longitude\\\":-74.0050330817188},{\\\"latitude\\\":40.71558525520227,\\\"longitude\\\":-74.00567412967337},{\\\"latitude\\\":40.71514002695317,\\\"longitude\\\":-74.00499821300161}]\",\"territory_id\":\"1\",\"center_point\":\"{\\\"latitude\\\":40.715634723463864,\\\"longitude\\\":-74.0052351414646}\",\"color\":\"#ff0000\",\"title\":\"qa territory\",\"universe\":\"12302\",\"assignee_user_id\":[\"122\"],\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:16:41', '2021-11-15 13:16:41', NULL),
(34, 122, '', 'admin.territory.update', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"geofence_detail\":\"[{\\\"latitude\\\":40.716178888236136,\\\"longitude\\\":-74.0050330817188},{\\\"latitude\\\":40.71558525520227,\\\"longitude\\\":-74.00567412967337},{\\\"latitude\\\":40.71514002695317,\\\"longitude\\\":-74.00499821300161}]\",\"territory_id\":\"1\",\"center_point\":\"{\\\"latitude\\\":40.715634723463864,\\\"longitude\\\":-74.0052351414646}\",\"color\":\"#ff0000\",\"title\":\"qa territory\",\"universe\":\"12302\",\"assignee_user_id\":[\"122\"],\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:17:46', '2021-11-15 13:17:46', NULL),
(35, 122, '', 'admin.territory.update', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"geofence_detail\":\"[{\\\"latitude\\\":40.716178888236136,\\\"longitude\\\":-74.0050330817188},{\\\"latitude\\\":40.71558525520227,\\\"longitude\\\":-74.00567412967337},{\\\"latitude\\\":40.71514002695317,\\\"longitude\\\":-74.00499821300161}]\",\"territory_id\":\"1\",\"center_point\":\"{\\\"latitude\\\":40.715634723463864,\\\"longitude\\\":-74.0052351414646}\",\"color\":\"#ff0000\",\"title\":\"qa territory\",\"universe\":\"12302\",\"assignee_user_id\":[\"122\"],\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:20:05', '2021-11-15 13:20:05', NULL),
(36, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:23:19', '2021-11-15 13:23:19', NULL),
(37, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 13:49:14', '2021-11-15 13:49:14', NULL),
(38, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:06:52', '2021-11-15 14:06:52', NULL),
(39, 122, '', 'admin.userpins.export', NULL, '{\"keyword\":null,\"territory\":null,\"status_modified_date\":null,\"updated_at\":null,\"date_filter\":null,\"from_date\":null,\"to_date\":null,\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}},\"user\":{\"id\":122,\"first_name\":\"robert\",\"last_name\":\"klien\",\"parent_id\":0,\"crm_id\":0,\"name\":\"robachik\",\"username\":\"robachik\",\"email\":\"robertk@yopmail.com\",\"mobile_no\":\"+90020098765\",\"password\":\"$2y$10$2S3.ou47sm03I0KImo20Ouuau4lHkBI89Y0Ju8dJvkDuX2z0C5lNG\",\"image_url\":\"https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/images\\/user-placeholder.png\",\"country_id\":null,\"state_id\":null,\"city_id\":null,\"address\":null,\"zipcode\":null,\"gender\":null,\"latitude\":null,\"longitude\":null,\"platform_type\":\"custom\",\"platform_id\":\"0\",\"device_type\":\"web\",\"device_token\":\"d1K3JM5F9Pg0KclFRa_Zv0:APA91bGjEMGGVbDwV2Y7xvveblm1EDj-3VTmcZf6ODAZtsEl5tSHFsf1pyKWjMS8UMu4Dp-njpz0US9m55QxcyISZ6MInuhIEOIEUgJt7Lyqmf7-lOcj6aPEDk_5kYgLCaM-rOSRTb27\",\"is_mobile_verify\":0,\"is_email_verify\":0,\"status_id\":1,\"is_login\":0,\"is_active\":0,\"online_status\":0,\"token\":\"0f1ea989c5116e76760dd261b94dba7d\",\"remember_token\":null,\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":\"2021-11-15 14:06:53\",\"deleted_at\":null,\"num_of_sale_reps\":\"5 to 10\",\"description\":\"abcd\",\"gateway_customer_id\":\"cus_KbEmbC3fgqV1XS\",\"gateway_default_card_id\":\"card_1Jw2IaCYOXmVqQMpqyxzFPfx\",\"gateway_default_card_json\":{\"id\":\"card_1Jw2IaCYOXmVqQMpqyxzFPfx\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"23333\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbEmbC3fgqV1XS\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":12,\"exp_year\":2022,\"fingerprint\":\"bx1eCwx6SQt71PfR\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"user_meta\":{\"pin_view_permission\":\"own_subordinate\",\"pin_edit_permission\":\"own_subordinate\",\"manager_pin_view_permission\":\"\",\"manager_edit_permission\":\"\",\"is_administrator\":\"1\",\"manage_user\":\"1\",\"can_import_pin\":\"1\",\"share_report\":\"1\",\"title\":\"\"},\"parent_user\":null,\"user_team\":null,\"user_role\":{\"id\":122,\"user_id\":122,\"role_id\":2,\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"title\":\"Company\",\"slug\":\"company\"},\"user_company\":{\"employee_user_id\":122,\"company_user_id\":122,\"id\":122,\"name\":\"robachik\",\"email\":\"robertk@yopmail.com\",\"mobile_no\":\"+90020098765\",\"image_url\":null,\"created_at\":\"2021-11-15 10:20:30\"},\"report_to_user\":null}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:06:56', '2021-11-15 14:06:56', NULL),
(40, 122, '', 'admin.userpins.delete-export-file', NULL, '{\"filename\":\"pin_540291636985216\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:06:59', '2021-11-15 14:06:59', NULL);
INSERT INTO `activity_logging` (`id`, `user_id`, `user_type`, `action`, `description`, `user_request`, `user_agent`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(41, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:09:19', '2021-11-15 14:09:19', NULL),
(42, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:12:41', '2021-11-15 14:12:41', NULL),
(43, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:30:04', '2021-11-15 14:30:04', NULL),
(44, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:33:15', '2021-11-15 14:33:15', NULL),
(45, 122, '', 'admin.add-team', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"title\":\"qa team\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 14:58:46', '2021-11-15 14:58:46', NULL),
(46, 122, '', 'admin.add-user', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"name\":\"teamlead\",\"email\":\"teamlead@yopmail.com\",\"mobile_no\":\"3345678\",\"user_report\":\"122\",\"user_meta\":{\"title\":\"TL web\",\"pin_view_permission\":\"own_subordinate_peer_manager\",\"edit_permission\":\"own_subordinate_peer_manager\",\"is_administrator\":\"1\",\"manage_user\":\"1\"},\"team_id\":\"1\",\"revenue_per_sale_amount\":\"12\",\"average_commission_per_sale\":\"22\",\"user_annual_income_target\":\"2\",\"total_work_month_left_to_sell\":\"2\",\"total_work_week_left_to_sell\":\"2\",\"total_contracts_needed\":\"0.09\",\"total_annual_sales_needed\":\"1.09\",\"metric\":{\"reach_rate\":\"0.0022\",\"no_damage_rate\":\"0.0011\",\"denied_rate\":\"0.001\",\"inspection_close_rate\":\"0.002\",\"file_rate\":\"0.003\",\"lost_rate\":\"0.004\",\"damage_rate\":\"0.006\",\"buy_rate\":\"0.007\",\"contract_close_rate\":\"0.008\"},\"kpi_target_sale\":{\"kpi_annual_target\":{\"attempts\":\"2.73306659670296e+25\",\"not_qualified\":\"132280423280.42\",\"lost_opportunity\":\"1731.60\",\"contact\":\"601274651274651238400.00\",\"pre_qualified\":\"43291774.89\",\"sales\":\"0.09\",\"leads\":\"12025493025493024.00\",\"approved\":\"1298.70\",\"sales_opportunities\":\"1136.36\",\"prospects\":\"721529581529.58\",\"not_approved\":\"432.92\"},\"kpi_monthly_target\":{\"attempts\":\"1.36653329835148e+25\",\"not_qualified\":\"66140211640.21\",\"lost_opportunity\":\"865.80\",\"contact\":\"300637325637325619200.00\",\"pre_qualified\":\"21645887.45\",\"sales\":\"0.05\",\"leads\":\"6012746512746512.00\",\"approved\":\"649.35\",\"sales_opportunities\":\"568.18\",\"prospects\":\"360764790764.79\",\"not_approved\":\"216.46\"},\"kpi_weekly_target\":{\"attempts\":\"1.36653329835148e+25\",\"not_qualified\":\"66140211640.21\",\"lost_opportunity\":\"865.80\",\"contact\":\"300637325637325619200.00\",\"pre_qualified\":\"21645887.45\",\"sales\":\"0.05\",\"leads\":\"6012746512746512.00\",\"approved\":\"649.35\",\"sales_opportunities\":\"568.18\",\"prospects\":\"360764790764.79\",\"not_approved\":\"216.46\"}},\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:01:22', '2021-11-15 15:01:22', NULL),
(47, 123, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:02:29', '2021-11-15 15:02:29', NULL),
(48, 123, '', 'admin.change-password', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:02:52', '2021-11-15 15:02:52', NULL),
(49, 123, '', 'admin.add-user', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"name\":\"sales\",\"email\":\"sr@yopmail.com\",\"mobile_no\":\"009867565\",\"user_report\":\"122\",\"user_meta\":{\"title\":\"SR\",\"pin_view_permission\":\"own_subordinate_peer\",\"edit_permission\":\"own_subordinate_peer\",\"is_administrator\":\"1\",\"manage_user\":\"1\"},\"team_id\":\"1\",\"revenue_per_sale_amount\":\"12\",\"average_commission_per_sale\":\"11\",\"user_annual_income_target\":\"1\",\"total_work_month_left_to_sell\":\"2\",\"total_work_week_left_to_sell\":\"3\",\"total_contracts_needed\":\"0.09\",\"total_annual_sales_needed\":\"1.09\",\"metric\":{\"reach_rate\":\"0.001\",\"no_damage_rate\":\"0.002\",\"denied_rate\":\"0.003\",\"inspection_close_rate\":\"0.004\",\"file_rate\":\"0.005\",\"lost_rate\":\"0.006\",\"damage_rate\":\"0.007\",\"buy_rate\":\"0.008\",\"contract_close_rate\":\"0.009\"},\"kpi_target_sale\":{\"kpi_annual_target\":{\"attempts\":\"1.1596243042671612e+25\",\"not_qualified\":\"92769944341.37\",\"lost_opportunity\":\"1363.64\",\"contact\":\"115962430426716127232.00\",\"pre_qualified\":\"22728636.36\",\"sales\":\"0.09\",\"leads\":\"4638497217068645.00\",\"approved\":\"1136.36\",\"sales_opportunities\":\"1010.10\",\"prospects\":\"324694805194.81\",\"not_approved\":\"681.86\"},\"kpi_monthly_target\":{\"attempts\":\"5.798121521335806e+24\",\"not_qualified\":\"46384972170.69\",\"lost_opportunity\":\"681.82\",\"contact\":\"57981215213358063616.00\",\"pre_qualified\":\"11364318.18\",\"sales\":\"0.05\",\"leads\":\"2319248608534322.50\",\"approved\":\"568.18\",\"sales_opportunities\":\"505.05\",\"prospects\":\"162347402597.40\",\"not_approved\":\"340.93\"},\"kpi_weekly_target\":{\"attempts\":\"3.865414347557204e+24\",\"not_qualified\":\"30923314780.46\",\"lost_opportunity\":\"454.55\",\"contact\":\"38654143475572039680.00\",\"pre_qualified\":\"7576212.12\",\"sales\":\"0.03\",\"leads\":\"1546165739022881.75\",\"approved\":\"378.79\",\"sales_opportunities\":\"336.70\",\"prospects\":\"108231601731.60\",\"not_approved\":\"227.29\"}},\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:08:21', '2021-11-15 15:08:21', NULL),
(50, 124, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"sr@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:09:05', '2021-11-15 15:09:05', NULL),
(51, 124, '', 'admin.change-password', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:09:24', '2021-11-15 15:09:24', NULL),
(52, 122, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:11:21', '2021-11-15 15:11:21', NULL),
(53, 122, '', 'admin.change-password', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:11:39', '2021-11-15 15:11:39', NULL),
(54, 122, '', 'admin.add-user', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"name\":\"salesrep\",\"email\":\"salessr@yopmail.com\",\"mobile_no\":\"00987666\",\"user_report\":\"123\",\"user_meta\":{\"title\":\"salesrep\",\"pin_view_permission\":\"own_subordinate_peer\",\"edit_permission\":\"own_subordinate_peer\",\"manage_user\":\"1\"},\"team_id\":\"1\",\"revenue_per_sale_amount\":\"1\",\"average_commission_per_sale\":\"2\",\"user_annual_income_target\":\"2\",\"total_work_month_left_to_sell\":\"3\",\"total_work_week_left_to_sell\":\"2\",\"total_contracts_needed\":\"1.00\",\"total_annual_sales_needed\":\"1.00\",\"metric\":{\"reach_rate\":\"0.001\",\"no_damage_rate\":\"0.002\",\"denied_rate\":\"0.003\",\"inspection_close_rate\":\"0.004\",\"file_rate\":\"0.005\",\"lost_rate\":\"0.006\",\"damage_rate\":\"0.007\",\"buy_rate\":\"0.008\",\"contract_close_rate\":\"0.009\"},\"kpi_target_sale\":{\"kpi_annual_target\":{\"attempts\":\"1.2755867346938775e+26\",\"not_qualified\":\"1020469387755.10\",\"lost_opportunity\":\"15000.00\",\"contact\":\"1.2755867346938775e+21\",\"pre_qualified\":\"250015000.00\",\"sales\":\"1.00\",\"leads\":\"51023469387755104.00\",\"approved\":\"12500.00\",\"sales_opportunities\":\"11111.11\",\"prospects\":\"3571642857142.86\",\"not_approved\":\"7500.45\"},\"kpi_monthly_target\":{\"attempts\":\"4.2519557823129246e+25\",\"not_qualified\":\"340156462585.03\",\"lost_opportunity\":\"5000.00\",\"contact\":\"425195578231292493824.00\",\"pre_qualified\":\"83338333.33\",\"sales\":\"0.33\",\"leads\":\"17007823129251702.00\",\"approved\":\"4166.67\",\"sales_opportunities\":\"3703.70\",\"prospects\":\"1190547619047.62\",\"not_approved\":\"2500.15\"},\"kpi_weekly_target\":{\"attempts\":\"6.377933673469387e+25\",\"not_qualified\":\"510234693877.55\",\"lost_opportunity\":\"7500.00\",\"contact\":\"637793367346938773504.00\",\"pre_qualified\":\"125007500.00\",\"sales\":\"0.50\",\"leads\":\"25511734693877552.00\",\"approved\":\"6250.00\",\"sales_opportunities\":\"5555.56\",\"prospects\":\"1785821428571.43\",\"not_approved\":\"3750.22\"}},\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:13:05', '2021-11-15 15:13:05', NULL),
(55, 125, '', 'admin.login', NULL, '{\"_token\":\"WS4MuncQAReHuEfQMgXvVOglGwSc3tNkZ8LMgTKo\",\"email\":\"salessr@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-15 15:14:16', '2021-11-15 15:14:16', NULL),
(56, 123, '', 'admin.login', NULL, '{\"_token\":\"1jmV7INV0w3bdsTQrJn3WeNg5jNVBBXaOlcxR5aM\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 08:28:30', '2021-11-16 08:28:30', NULL),
(57, 123, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"1jmV7INV0w3bdsTQrJn3WeNg5jNVBBXaOlcxR5aM\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 08:29:43', '2021-11-16 08:29:43', NULL),
(58, 0, '', 'admin.login', NULL, '{\"_token\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:21:44', '2021-11-16 13:21:44', NULL),
(59, 123, '', 'admin.login', NULL, '{\"_token\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:21:56', '2021-11-16 13:21:56', NULL),
(60, 123, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:44:07', '2021-11-16 13:44:07', NULL),
(61, 123, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:44:17', '2021-11-16 13:44:17', NULL),
(62, 123, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:44:38', '2021-11-16 13:44:38', NULL),
(63, 123, '', 'admin.add-appointment', NULL, '{\"_token\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"user_pin_id\":\"1\",\"appointment_title\":\"16 nov\",\"assign_to_calender\":\"122\",\"start_datetime\":\"2021-11-17T18:50\",\"end_datetime\":\"2021-11-18T18:47\",\"duration\":\"1\",\"appointment_notes\":\"appoint notes detail\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:46:09', '2021-11-16 13:46:09', NULL);
INSERT INTO `activity_logging` (`id`, `user_id`, `user_type`, `action`, `description`, `user_request`, `user_agent`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(64, 123, '', 'admin.edit-status', NULL, '{\"_token\":\"zW195HrdifWN6ezRnlgVOhTcJ8N8kWog5cakaPQC\",\"id\":\"2\",\"title\":\"web status\",\"kpi_group_id\":\"7\",\"metric_id\":\"3\",\"custom_metric_title\":\"abv\",\"type\":\"pin\",\"image_url\":\"#453E4A|https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/assets\\/images\\/3.png\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 13:50:37', '2021-11-16 13:50:37', NULL),
(65, 122, '', 'admin.login', NULL, '{\"_token\":\"o5C4zTkoaxjgZwqgFBVr44eGHEOCJe3LtvUmiFux\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36 Edg/95.0.1020.53', '110.93.250.194', '2021-11-16 14:14:36', '2021-11-16 14:14:36', NULL),
(66, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"o5C4zTkoaxjgZwqgFBVr44eGHEOCJe3LtvUmiFux\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36 Edg/95.0.1020.53', '110.93.250.194', '2021-11-16 14:15:14', '2021-11-16 14:15:14', NULL),
(67, 122, '', 'admin.login', NULL, '{\"_token\":\"gMQLcKhkx2ThKlbXrJMKDUoJnXQ8qp6trfAF8ne0\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-16 14:52:09', '2021-11-16 14:52:09', NULL),
(68, 122, '', 'admin.login', NULL, '{\"_token\":\"mT1vGwISwTe3f5GiaCXyvb2V8CULSs1PaemVMODo\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-16 14:52:43', '2021-11-16 14:52:43', NULL),
(69, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"mT1vGwISwTe3f5GiaCXyvb2V8CULSs1PaemVMODo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-16 14:53:06', '2021-11-16 14:53:06', NULL),
(70, 1, '', 'admin.login', NULL, '{\"_token\":\"mT1vGwISwTe3f5GiaCXyvb2V8CULSs1PaemVMODo\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0', '110.93.250.194', '2021-11-16 14:59:01', '2021-11-16 14:59:01', NULL),
(71, 122, '', 'admin.login', NULL, '{\"_token\":\"dTiJjCKJMP7Sa4IL1AQO85vIDDsFQtrtGoUwJHvo\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 16:24:05', '2021-11-16 16:24:05', NULL),
(72, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"dTiJjCKJMP7Sa4IL1AQO85vIDDsFQtrtGoUwJHvo\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 16:24:36', '2021-11-16 16:24:36', NULL),
(73, 122, '', 'admin.login', NULL, '{\"_token\":\"T3BjYJKJlVOGnNe3TyVWXdQdZ4GmoPrjjkz9qfLV\",\"email\":\"robertk@yopmail.com\",\"remember_me\":\"1\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 16:31:37', '2021-11-16 16:31:37', NULL),
(74, 122, '', 'admin.login', NULL, '{\"_token\":\"BDFk6AyL6iCiKRfchryJdjIGKJcsYhW5vWcLu5qj\",\"email\":\"robertk@yopmail.com\",\"remember_me\":\"1\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 17:58:49', '2021-11-16 17:58:49', NULL),
(75, 127, '', 'admin.login', NULL, '{\"_token\":\"BDFk6AyL6iCiKRfchryJdjIGKJcsYhW5vWcLu5qj\",\"email\":\"maddy@retrocube.com\",\"remember_me\":\"1\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 18:00:27', '2021-11-16 18:00:27', NULL),
(76, 127, '', 'admin.update-profile', NULL, '{\"_token\":\"BDFk6AyL6iCiKRfchryJdjIGKJcsYhW5vWcLu5qj\",\"name\":\"Retrocube\",\"mobile_no\":\"+923452129193\",\"gender\":\"male\",\"user_package\":{\"id\":3,\"company_user_id\":0,\"user_id\":127,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-30\",\"status\":\"active\",\"created_at\":\"2021-11-16 17:54:52\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 18:00:49', '2021-11-16 18:00:49', NULL),
(77, 127, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"BDFk6AyL6iCiKRfchryJdjIGKJcsYhW5vWcLu5qj\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":3,\"company_user_id\":0,\"user_id\":127,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-30\",\"status\":\"active\",\"created_at\":\"2021-11-16 17:54:52\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-16 18:00:58', '2021-11-16 18:00:58', NULL),
(78, 129, '', 'admin.login', NULL, '{\"_token\":\"T3BjYJKJlVOGnNe3TyVWXdQdZ4GmoPrjjkz9qfLV\",\"email\":\"paulemersonent@gmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 18:28:12', '2021-11-16 18:28:12', NULL),
(79, 129, '', 'admin.update-profile', NULL, '{\"_token\":\"T3BjYJKJlVOGnNe3TyVWXdQdZ4GmoPrjjkz9qfLV\",\"name\":\"Emerson\",\"mobile_no\":\"8161234567\",\"gender\":\"male\",\"user_package\":{\"id\":5,\"company_user_id\":0,\"user_id\":129,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-30\",\"status\":\"active\",\"created_at\":\"2021-11-16 18:20:48\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}},\"image_url\":{}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 18:40:02', '2021-11-16 18:40:02', NULL),
(80, 0, '', 'admin.login', NULL, '{\"_token\":\"T3BjYJKJlVOGnNe3TyVWXdQdZ4GmoPrjjkz9qfLV\",\"email\":\"paulemersonent@gmail.com\",\"remember_me\":\"1\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 18:47:01', '2021-11-16 18:47:01', NULL),
(81, 0, '', 'admin.login', NULL, '{\"_token\":\"T3BjYJKJlVOGnNe3TyVWXdQdZ4GmoPrjjkz9qfLV\",\"email\":\"paulemersonent@gmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '136.41.2.218', '2021-11-16 18:47:31', '2021-11-16 18:47:31', NULL),
(82, 130, '', 'admin.login', NULL, '{\"_token\":\"6lsFBh9e2Tw1Qpv4xe82SAsjticbdJcJ8uXxwzjn\",\"email\":\"elinasmith@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-17 12:55:59', '2021-11-17 12:55:59', NULL),
(83, 0, '', 'admin.login', NULL, '{\"_token\":\"Vt7QVcoDXCzW4CypeL3oUmirQhuJEu3OO2i4Gkg3\",\"email\":\"paullewis@gmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', '67.48.17.117', '2021-11-18 03:09:50', '2021-11-18 03:09:50', NULL),
(84, 122, '', 'admin.login', NULL, '{\"_token\":\"Vt7QVcoDXCzW4CypeL3oUmirQhuJEu3OO2i4Gkg3\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', '67.48.17.117', '2021-11-18 03:10:16', '2021-11-18 03:10:16', NULL),
(85, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"Vt7QVcoDXCzW4CypeL3oUmirQhuJEu3OO2i4Gkg3\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":1,\"company_user_id\":0,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"0\",\"amount\":\"0\",\"subscription_package_id\":1,\"expire_date\":\"2021-11-29\",\"status\":\"active\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', '67.48.17.117', '2021-11-18 03:12:06', '2021-11-18 03:12:06', NULL),
(86, 0, '', 'admin.login', NULL, '{\"_token\":\"BpSHsbSbcMR87pr0jp8p9PdY6Mat0MxaYuUsFbEq\",\"email\":\"fasd@gmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', '110.93.250.194', '2021-11-18 06:04:33', '2021-11-18 06:04:33', NULL),
(87, 0, '', 'admin.login', NULL, '{\"_token\":\"lkyxXQD6uhkvjG8sZzTT0VT4Xboko4vOklOXIS6x\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-18 08:09:09', '2021-11-18 08:09:09', NULL),
(88, 0, '', 'admin.login', NULL, '{\"_token\":\"lkyxXQD6uhkvjG8sZzTT0VT4Xboko4vOklOXIS6x\",\"email\":\"admin@retrocube.com\",\"remember_me\":\"1\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-18 08:09:19', '2021-11-18 08:09:19', NULL),
(89, 123, '', 'admin.login', NULL, '{\"_token\":\"lkyxXQD6uhkvjG8sZzTT0VT4Xboko4vOklOXIS6x\",\"email\":\"teamlead@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-18 08:09:34', '2021-11-18 08:09:34', NULL),
(90, 0, '', 'admin.login', NULL, '{\"_token\":\"lkyxXQD6uhkvjG8sZzTT0VT4Xboko4vOklOXIS6x\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-18 08:09:55', '2021-11-18 08:09:55', NULL),
(91, 0, '', 'admin.login', NULL, '{\"_token\":\"lkyxXQD6uhkvjG8sZzTT0VT4Xboko4vOklOXIS6x\",\"email\":\"admin@retrocube.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', '110.93.250.194', '2021-11-18 08:10:09', '2021-11-18 08:10:09', NULL),
(92, 122, '', 'admin.login', NULL, '{\"_token\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"email\":\"robertk@yopmail.com\",\"submit\":\"Login\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:02:22', '2021-12-03 02:02:22', NULL),
(93, 122, '', 'admin.upgrade-package', NULL, '{\"_token\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"total_user\":\"6\",\"subscription_package_id\":\"1\",\"charge_amount\":\"270\",\"stripeToken\":\"tok_1K2R7vCYOXmVqQMpgJpDEYNJ\"}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:03:57', '2021-12-03 02:03:57', NULL),
(94, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:07:42', '2021-12-03 02:07:42', NULL),
(95, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:08:05', '2021-12-03 02:08:05', NULL),
(96, 122, '', 'admin.userpins.export', NULL, '{\"keyword\":null,\"territory\":null,\"status_modified_date\":null,\"updated_at\":null,\"date_filter\":null,\"from_date\":null,\"to_date\":null,\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}},\"user\":{\"id\":122,\"first_name\":\"robert\",\"last_name\":\"klien\",\"parent_id\":0,\"crm_id\":0,\"name\":\"robachik\",\"username\":\"robachik\",\"email\":\"robertk@yopmail.com\",\"mobile_no\":\"+90020098765\",\"password\":\"$2y$10$yi\\/2eocmRedRpNOicEiIHOfZTo4xPlDPfCgTjMnvCXAQutYfetwpe\",\"image_url\":\"https:\\/\\/retrocubedev.com\\/qa\\/client_scope\\/public\\/images\\/user-placeholder.png\",\"country_id\":null,\"state_id\":null,\"city_id\":null,\"address\":null,\"zipcode\":null,\"gender\":null,\"latitude\":null,\"longitude\":null,\"platform_type\":\"custom\",\"platform_id\":\"0\",\"device_type\":\"web\",\"device_token\":\"ezDVySfVhzUFUQ38Q-aN2B:APA91bGL_r6utGE0bRvPmsGOWUCevbJYF2fe8rAgl8dnlDEjAFQHnZahtmKf1RvRkPXdEA8i5xyhOeCY4NKTC0pB7i26_wUSkDili9-Ag098XOsOKp_KwgJEJt0GSB65Nz1yltNdsR3e\",\"is_mobile_verify\":0,\"is_email_verify\":0,\"status_id\":1,\"is_login\":0,\"is_active\":0,\"online_status\":0,\"token\":\"e797b67267ca56808e3c52120e0d8b96\",\"remember_token\":\"GQ0g0ZVLApSrP5CF8mnwsMzNvJCAN4k5Ex9SDy43PhWnSgJBg8lZfewjXDHt\",\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":\"2021-12-03 02:08:06\",\"deleted_at\":null,\"num_of_sale_reps\":\"5 to 10\",\"description\":\"abcd\",\"gateway_customer_id\":\"cus_KbEmbC3fgqV1XS\",\"gateway_default_card_id\":\"card_1Jw2IaCYOXmVqQMpqyxzFPfx\",\"gateway_default_card_json\":{\"id\":\"card_1Jw2IaCYOXmVqQMpqyxzFPfx\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"23333\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbEmbC3fgqV1XS\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":12,\"exp_year\":2022,\"fingerprint\":\"bx1eCwx6SQt71PfR\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"user_meta\":{\"pin_view_permission\":\"own_subordinate\",\"pin_edit_permission\":\"own_subordinate\",\"manager_pin_view_permission\":\"\",\"manager_edit_permission\":\"\",\"is_administrator\":\"1\",\"manage_user\":\"1\",\"can_import_pin\":\"1\",\"share_report\":\"1\",\"title\":\"\"},\"parent_user\":null,\"user_team\":null,\"user_role\":{\"id\":122,\"user_id\":122,\"role_id\":2,\"created_at\":\"2021-11-15 10:20:30\",\"updated_at\":null,\"deleted_at\":null,\"title\":\"Company\",\"slug\":\"company\"},\"user_company\":{\"employee_user_id\":122,\"company_user_id\":122,\"id\":122,\"name\":\"robachik\",\"email\":\"robertk@yopmail.com\",\"mobile_no\":\"+90020098765\",\"image_url\":null,\"created_at\":\"2021-11-15 10:20:30\"},\"report_to_user\":null}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:09:17', '2021-12-03 02:09:17', NULL),
(97, 122, '', 'admin.userpins.delete-export-file', NULL, '{\"filename\":\"pin_184111638497357\",\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:09:20', '2021-12-03 02:09:20', NULL),
(98, 122, '', 'admin.add-custom-fields', NULL, '{\"_token\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"field_type\":[\"text\"],\"label\":[\"TEST\"],\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:10:49', '2021-12-03 02:10:49', NULL),
(99, 122, '', 'admin.userpins.list', NULL, '{\"draw\":\"1\",\"columns\":[{\"data\":\"0\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"1\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"2\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"3\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"4\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"5\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"6\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"7\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"8\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"9\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"10\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"11\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"12\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"13\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"14\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"15\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"16\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"17\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"18\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"19\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"20\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}},{\"data\":\"21\",\"name\":null,\"searchable\":\"true\",\"orderable\":\"true\",\"search\":{\"value\":null,\"regex\":\"false\"}}],\"order\":[{\"column\":\"16\",\"dir\":\"desc\"}],\"start\":\"0\",\"length\":\"10\",\"search\":{\"value\":null,\"regex\":\"false\"},\"_csrf\":\"9SnZ3B88WV364uUGSJPxVuXEMoWg4ussxKGJ17dQ\",\"custom_search\":\"keyword=&territory=&status_modified_date=&updated_at=&date_filter=&from_date=&to_date=\",\"user_package\":{\"id\":7,\"company_user_id\":122,\"user_id\":122,\"gateway_type\":\"stripe\",\"gateway_transaction_id\":\"ch_3K2R7xCYOXmVqQMp06PFnABD\",\"amount\":\"270\",\"subscription_package_id\":1,\"expire_date\":\"2022-01-03\",\"status\":\"active\",\"created_at\":\"2021-12-03 02:03:57\",\"updated_at\":\"2021-12-03 02:03:57\",\"deleted_at\":null,\"subscription_package\":{\"id\":1,\"title\":\"Basic\",\"slug\":\"Basic\",\"description\":\"$45\\/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\\r\\n\",\"month_per_user_amount\":\"45.00\",\"trial_period\":14,\"discount\":\"0.00\",\"minimum_user_discount\":\"0\",\"status\":1,\"created_at\":\"2021-08-12 14:39:10\",\"updated_at\":null,\"deleted_at\":null}}}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36', '67.48.17.117', '2021-12-03 02:15:50', '2021-12-03 02:15:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `user_pin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `assignee_user_id` int(11) NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `notes` text,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `creator_user_id`, `user_pin_id`, `title`, `assignee_user_id`, `start_datetime`, `end_datetime`, `duration`, `notes`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 1, 'new appointment 15 nov', 122, '2021-11-15 18:12:00', '2021-11-17 21:12:00', '1', 'qa notes', 1, '2021-11-15 13:11:36', NULL, NULL),
(2, 123, 1, '16 nov', 122, '2021-11-17 18:50:00', '2021-11-18 18:47:00', '1', 'appoint notes detail', 1, '2021-11-16 13:46:09', '2021-11-16 13:46:09', NULL),
(5, 123, 2, '18 nov 2021', 123, '2021-11-18 20:00:00', '2021-11-18 21:00:00', '60', 'Notes', 1, '2021-11-18 13:43:20', '2021-11-18 14:40:05', NULL),
(6, 123, 2, '18 nov 2021', 123, '2021-11-19 08:00:00', '2021-11-25 09:00:00', '8700', 'New notes nov 2021', 1, '2021-11-18 13:48:45', '2021-11-18 13:48:45', NULL),
(7, 123, 2, '18 nov 2021', 123, '2021-11-19 08:00:00', '2021-11-27 09:00:00', '11580', 'New notes', 1, '2021-11-18 13:54:32', '2021-11-18 13:54:32', NULL),
(8, 123, 2, '18 nov 2021', 123, '2021-11-24 09:00:00', '2021-11-24 10:00:00', '60', NULL, 1, '2021-11-18 13:55:35', '2021-11-18 13:57:12', '2021-11-18 13:57:12'),
(9, 123, 2, '18 nov 2021', 123, '2021-11-26 09:00:00', '2021-11-26 10:00:00', '60', 'Testing', 1, '2021-11-18 13:57:50', '2021-11-18 13:59:45', NULL),
(10, 123, 2, '18 nov 2021', 123, '2021-11-24 09:00:00', '2021-11-24 10:00:00', '60', NULL, 1, '2021-11-18 13:58:49', '2021-11-18 13:58:49', NULL),
(11, 123, 3, 'Pin 18 nov 2021', 123, '2021-11-19 08:00:00', '2021-11-19 09:00:00', '60', 'Dd', 1, '2021-11-18 14:39:43', NULL, NULL),
(12, 123, 3, 'Pin 18 nov 2021', 123, '2021-11-21 08:00:00', '2021-11-30 09:00:00', '13020', 'New notes', 1, '2021-11-19 13:22:43', '2021-11-19 13:23:53', NULL),
(13, 123, 9, 'Tester', 123, '2021-12-10 08:00:00', '2021-12-10 09:00:00', '60', 'Test', 1, '2021-12-02 06:22:14', NULL, NULL),
(14, 123, 11, 'Tester', 123, '2021-12-10 08:00:00', '2021-12-10 09:00:00', '60', 'Test', 1, '2021-12-02 06:22:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_content`
--

CREATE TABLE `app_content` (
  `id` int(11) NOT NULL,
  `identifier` varchar(45) NOT NULL,
  `content` longtext NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_url` text,
  `file_data` text,
  `message_type` varchar(100) NOT NULL DEFAULT 'text',
  `ip_address` varchar(100) DEFAULT NULL,
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message_delete`
--

CREATE TABLE `chat_message_delete` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) DEFAULT '0',
  `chat_message_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message_status`
--

CREATE TABLE `chat_message_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) DEFAULT '0',
  `chat_message_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` int(11) NOT NULL,
  `identifier` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `image_url` text,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `type` enum('single','group') NOT NULL,
  `member_limit` int(11) NOT NULL DEFAULT '0',
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_users`
--

CREATE TABLE `chat_room_users` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_owner` int(11) NOT NULL DEFAULT '0',
  `last_chat_message_id` int(11) DEFAULT '0',
  `last_message_timestamp` datetime DEFAULT NULL,
  `unread_message_counts` int(11) DEFAULT '0',
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_kpi_target_sale`
--

CREATE TABLE `company_kpi_target_sale` (
  `id` int(11) NOT NULL,
  `user_company_id` int(11) NOT NULL,
  `company_sale_plan_id` int(11) NOT NULL,
  `kpi_target_sale_type` enum('total_company_wide_kpi_targets','kpi_annual_target','kpi_monthly_target','kpi_weekly_target') NOT NULL,
  `kpi_group_id` int(11) NOT NULL,
  `target_value` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_metric_target`
--

CREATE TABLE `company_metric_target` (
  `id` int(11) NOT NULL,
  `user_company_id` int(11) NOT NULL,
  `company_sales_plan_id` int(11) NOT NULL,
  `metric_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_sales_plan`
--

CREATE TABLE `company_sales_plan` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `company_annual_sales_target` decimal(10,2) NOT NULL,
  `company_year_to_date_sold` decimal(10,2) NOT NULL,
  `left_to_sell` decimal(10,2) NOT NULL,
  `company_average_revenue_per_sale` decimal(10,2) NOT NULL,
  `work_week_left_for_the_year` decimal(10,2) NOT NULL,
  `work_month_left_for_the_year` decimal(10,2) NOT NULL,
  `company_sales_needed_per_week` decimal(10,2) NOT NULL,
  `company_sales_needed_per_month` decimal(10,2) NOT NULL,
  `active_company_sales_rep` decimal(10,2) NOT NULL,
  `average_annual_sales_per_sales_reps` decimal(10,2) NOT NULL,
  `new_hire_rentention_rate` decimal(10,2) NOT NULL,
  `total_sales_reps_needed` decimal(10,2) NOT NULL,
  `new_hire_needed` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field`
--

CREATE TABLE `custom_field` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `field_type` varchar(100) NOT NULL,
  `field_option` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `field_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_field`
--

INSERT INTO `custom_field` (`id`, `company_user_id`, `creator_id`, `label`, `field_type`, `field_option`, `created_at`, `updated_at`, `deleted_at`, `field_name`) VALUES
(1, 122, 122, 'TEST', 'text', NULL, '2021-12-03 02:10:49', NULL, NULL, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `import_history`
--

CREATE TABLE `import_history` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `employee_user_id` int(11) NOT NULL,
  `filename` varchar(150) DEFAULT NULL,
  `total_pin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kpi_groups`
--

CREATE TABLE `kpi_groups` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL DEFAULT '0',
  `employee_user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` text,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kpi_groups`
--

INSERT INTO `kpi_groups` (`id`, `company_user_id`, `employee_user_id`, `title`, `slug`, `image_url`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 0, 'Attempts', 'attempts', NULL, NULL, 1, '2021-03-04 17:30:49', NULL, NULL),
(2, 0, 0, 'Not Qualified', 'not_qualified', NULL, NULL, 1, '2021-03-04 17:31:13', NULL, NULL),
(3, 0, 0, 'Lost Opportunities', 'lost_opportunity', NULL, NULL, 1, '2021-03-04 17:32:07', NULL, NULL),
(4, 0, 0, 'Contacts', 'contact', NULL, NULL, 1, '2021-03-04 17:33:06', NULL, NULL),
(5, 0, 0, 'Pre-Qualified', 'pre_qualified', NULL, NULL, 1, '2021-03-04 17:33:32', NULL, NULL),
(6, 0, 0, 'Sales', 'sales', NULL, NULL, 1, '2021-03-04 17:33:59', NULL, NULL),
(7, 0, 0, 'Leads', 'leads', NULL, NULL, 1, '2021-03-04 17:34:12', NULL, NULL),
(8, 0, 0, 'Approved', 'approved', NULL, NULL, 1, '2021-03-04 17:34:27', NULL, NULL),
(9, 0, 0, 'Sales Opportunities', 'sales_opportunities', NULL, NULL, 1, '2021-03-04 17:34:47', NULL, NULL),
(10, 0, 0, 'Prospects', 'prospects', NULL, NULL, 1, '2021-03-04 17:35:11', NULL, NULL),
(11, 0, 0, 'Not Approved', 'not_approved', NULL, NULL, 1, '2021-03-04 17:37:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `wildcard` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `identifier`, `subject`, `body`, `wildcard`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'registration', 'Welcome to [APP_NAME]', '<table class=\"main\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;\">\r\n   <tr>\r\n      <td class=\"wrapper\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;\">\r\n         <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;\">\r\n            <tr>\r\n               <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Hi [NAME],</p>\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Your account has been created successfully. First, you need to confirm your account. Just press the button below</p>\r\n                   <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0;\"><b>Panel Credential</b></p>\r\n                   <br />\r\n                   <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0;\">URL: [ADMIN_LINK]</p>\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0;\">Email: [EMAIL]</p>\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0;\">Password: [PASSWORD]</p>\r\n                  <br /><br />\r\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;\">\r\n                     <tbody>\r\n                        <tr>\r\n                           <td align=\"left\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;\">\r\n                              <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;\">\r\n                                 <tbody>\r\n                                    <tr>\r\n                                       <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;\"> <a href=\"[LINK]\" target=\"_blank\" style=\"display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;\">Verify Now</a> </td>\r\n                                    </tr>\r\n                                 </tbody>\r\n                              </table>\r\n                           </td>\r\n                        </tr>\r\n                     </tbody>\r\n                  </table>\r\n                  <br>\r\n                  <br>\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Regards,</p>\r\n                  <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">The [APP_NAME] team,</p>\r\n               </td>\r\n            </tr>\r\n         </table>\r\n      </td>\r\n   </tr>\r\n</table>', '[NAME],[APP_NAME],[EMAIL],[PASSWORD],[LINK],[ADMIN_LINK]', '2020-11-11 12:36:52', NULL, NULL),
(2, 'forgot-password', 'Forgot Password Confirmation', '<table class=\"main\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;\">\n                    <tr>\n                        <td class=\"wrapper\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;\">\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;\">\n                                <tr>\n                                    <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">\n                                        <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Hi [USERNAME],</p>\n                                        <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">A request has been made to recover password for your account. Please follow below link to generate new password for your account :</p>\n                                        <p><a href=\"[LINK]\">Reset Password</a></p>\n                                       \n                                        <br>\n                                        <br>\n                                        <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">Regards,</p>\n                                        <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">© [YEAR] [APP_NAME] All Rights reserved.</p>\n                                    </td>\n                                </tr>\n                            </table>\n                        </td>\n                    </tr>\n                </table>', '[YEAR],[USERNAME],[LINK],[APP_URL],[APP_NAME]', '2020-11-11 12:39:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `module_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_url` text NOT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `metrices`
--

CREATE TABLE `metrices` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metrices`
--

INSERT INTO `metrices` (`id`, `title`, `slug`, `description`, `status`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Reach Rate', 'reach_rate', NULL, 1, 1, '2021-03-12 16:50:31', NULL, NULL),
(2, 'Inspection Close Rate', 'inspection_close_rate', NULL, 1, 4, '2021-03-12 16:50:52', NULL, NULL),
(3, 'Damage Rate', 'damage_rate', NULL, 1, 7, '2021-03-12 16:51:05', NULL, NULL),
(4, 'No Damage Rate', 'no_damage_rate', NULL, 1, 2, '2021-03-12 16:51:14', NULL, NULL),
(5, 'File Rate', 'file_rate', NULL, 1, 5, '2021-03-12 16:51:22', NULL, NULL),
(6, 'Buy Rate', 'buy_rate', NULL, 1, 8, '2021-03-12 16:51:29', NULL, NULL),
(7, 'Denied Rate', 'denied_rate', NULL, 1, 3, '2021-03-12 16:51:36', NULL, NULL),
(8, 'Lost Rate', 'lost_rate', NULL, 1, 6, '2021-03-12 16:51:43', NULL, NULL),
(9, 'Contract Close Rate', 'contract_close_rate', NULL, 1, 9, '2021-03-12 16:52:51', NULL, NULL),
(10, 'Projected Sales', 'projected_sales', NULL, 0, 0, '2021-03-12 16:54:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actor_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_module` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('push','email') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_notify` tinyint(1) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_viewed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `unique_id`, `identifier`, `actor_id`, `target_id`, `reference_id`, `reference_module`, `type`, `title`, `description`, `is_notify`, `is_read`, `is_viewed`, `created_at`, `updated_at`) VALUES
(1, '61925c88c6439', 'add_user_pin', 122, 122, 1, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-11-15 13:11:36', '2021-12-03 02:17:59'),
(2, '61925d9429cdc', 'add_territory', 122, 122, 1, 'territory', 'push', 'Client Scope', 'Territory has been assigned to you', 0, 1, 0, '2021-11-15 13:16:04', '2021-12-03 02:17:59'),
(3, '61964ab717d0c', 'add_user_pin', 123, 123, 2, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-11-18 12:44:39', '2021-12-02 06:23:15'),
(4, '6196652fdad53', 'add_territory', 123, 122, 2, 'territory', 'push', 'Client Scope', 'Territory has been assigned to you', 0, 1, 0, '2021-11-18 14:37:35', '2021-12-03 02:17:59'),
(5, '619665af4b1cc', 'add_user_pin', 123, 123, 3, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-11-18 14:39:43', '2021-12-02 06:23:15'),
(6, '6197a2b193681', 'add_territory', 123, 123, 3, 'territory', 'push', 'Client Scope', 'Territory has been assigned to you', 0, 1, 0, '2021-11-19 13:12:17', '2021-12-02 06:23:15'),
(7, '6197bcfcd34ad', 'add_user_pin', 123, 123, 4, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-11-19 15:04:29', '2021-12-02 06:23:15'),
(8, '61a86582d5fe4', 'add_user_pin', 123, 123, 5, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:19:47', '2021-12-02 06:23:15'),
(9, '61a8659cc2785', 'add_user_pin', 123, 123, 6, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:20:13', '2021-12-02 06:23:15'),
(10, '61a865b6cddb5', 'add_user_pin', 123, 123, 7, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:20:39', '2021-12-02 06:23:15'),
(11, '61a865c10bab5', 'add_user_pin', 123, 123, 8, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:20:49', '2021-12-02 06:23:15'),
(12, '61a865c8e12b9', 'add_user_pin', 123, 123, 9, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:20:57', '2021-12-02 06:23:15'),
(13, '61a865d7b76c2', 'add_user_pin', 123, 123, 10, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:21:12', '2021-12-02 06:23:15'),
(14, '61a86641b1a61', 'add_user_pin', 123, 123, 11, 'user_pin', 'push', 'Client Scope', 'Pin has been assigned to you', 0, 1, 0, '2021-12-02 06:22:57', '2021-12-02 06:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE `notification_setting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(100) NOT NULL,
  `meta_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`id`, `user_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 123, 'add_user_pin', '1', '2021-12-02 06:24:52', NULL, NULL),
(23, 123, 'add_territory', '1', '2021-12-02 06:24:52', NULL, NULL),
(24, 123, 'send_chat_message', '1', '2021-12-02 06:24:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super-admin', 1, '2020-11-11 06:14:43', NULL, NULL),
(2, 'Company', 'company', 1, '2020-11-11 06:14:43', NULL, NULL),
(3, 'Team Lead', 'team-lead', 1, '2020-11-11 06:14:43', NULL, NULL),
(4, 'Sales Representative', 'sales-representative', 1, '2020-11-11 06:14:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `identifier` varchar(200) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` text,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `title`, `slug`, `image_url`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Active', 'active', NULL, NULL, '2020-11-11 06:14:42', NULL, NULL),
(2, 'Disabled', 'disabled', NULL, NULL, '2020-11-11 06:14:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_packages`
--

CREATE TABLE `subscription_packages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `month_per_user_amount` decimal(10,2) DEFAULT NULL,
  `trial_period` int(1) NOT NULL DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `minimum_user_discount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_packages`
--

INSERT INTO `subscription_packages` (`id`, `title`, `slug`, `description`, `month_per_user_amount`, `trial_period`, `discount`, `minimum_user_discount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Basic', 'Basic', '$45/month per User,No Contract,14 Day Free Trial,Free Setup,One Hour of Training\r\n', 45.00, 14, 0.00, '0', 1, '2021-08-12 14:39:10', NULL, NULL),
(2, 'Plus', 'Plus', '$40/month per User,1 Year Contract,14 Day Free Trial,Free Setup,One Hour of Training\r\n', 40.00, 14, 0.00, '0', 1, '2021-08-12 14:39:10', NULL, NULL),
(3, 'Elite', 'Elite', '$35/month per User,30% Savings,14 Day Free Trial,Minimum Number of Users is 5,Free Setup,3 Hours of Training,One Year Contract\r\n', 30.00, 14, 30.00, '5', 1, '2021-08-12 14:39:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_company_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` text,
  `description` text,
  `total_member` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `user_id`, `user_company_id`, `title`, `slug`, `image_url`, `description`, `total_member`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 122, 'qa team', 'qa-team', NULL, NULL, 0, 0, '2021-11-15 14:58:46', '2021-11-15 14:58:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `territory`
--

CREATE TABLE `territory` (
  `id` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `color` varchar(100) DEFAULT NULL,
  `geofence_detail` text,
  `status_id` int(11) NOT NULL,
  `center_point` varchar(100) DEFAULT NULL,
  `universe` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `territory`
--

INSERT INTO `territory` (`id`, `creator_user_id`, `title`, `slug`, `description`, `color`, `geofence_detail`, `status_id`, `center_point`, `universe`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 'qa territory', 'qa-territory', NULL, '#ff0000', '[{\"latitude\":40.716178888236136,\"longitude\":-74.0050330817188},{\"latitude\":40.71558525520227,\"longitude\":-74.00567412967337},{\"latitude\":40.71514002695317,\"longitude\":-74.00499821300161}]', 1, '{\"latitude\":40.715634723463864,\"longitude\":-74.0052351414646}', 12302, '2021-11-15 13:16:03', '2021-11-19 12:44:34', NULL),
(2, 123, 'New txt', 'new-txt', NULL, 'rgba(245,135,25,1)', '[{\"latitude\":24.830678651365886,\"longitude\":67.0393218845129},{\"latitude\":24.829938334032633,\"longitude\":67.03888937830925},{\"latitude\":24.830124250556757,\"longitude\":67.03960083425045}]', 1, '{\"latitude\":24.830247078651762,\"longitude\":67.0392706990242}', 12, '2021-11-18 14:37:35', '2021-11-18 14:37:54', '2021-11-18 14:37:54'),
(3, 123, 'Terra 19 nov', 'terra-19-nov', NULL, 'rgba(245,135,25,1)', '[{\"longitude\":67.04156119376421,\"latitude\":24.828871210384555},{\"longitude\":67.04146765172482,\"latitude\":24.829556154507337},{\"longitude\":67.04116523265839,\"latitude\":24.829089991260265}]', 1, '{\"latitude\":24.829172452050717,\"longitude\":67.04139802604914}', 12, '2021-11-19 13:12:17', '2021-11-19 13:12:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `territory_company_maping`
--

CREATE TABLE `territory_company_maping` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `employee_user_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `territory_company_maping`
--

INSERT INTO `territory_company_maping` (`id`, `company_user_id`, `employee_user_id`, `territory_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 122, 122, 2, '2021-11-18 14:37:35', NULL, NULL),
(6, 122, 122, 1, '2021-11-19 12:44:34', NULL, NULL),
(7, 122, 132, 3, '2021-11-19 13:12:17', NULL, NULL),
(8, 122, 123, 3, '2021-11-19 13:12:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `territory_latlong`
--

CREATE TABLE `territory_latlong` (
  `id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `territory_latlong`
--

INSERT INTO `territory_latlong` (`id`, `territory_id`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 2, '24.830678651365886', '67.0393218845129', '2021-11-18 14:37:35', NULL, NULL),
(14, 2, '24.829938334032633', '67.03888937830925', '2021-11-18 14:37:35', NULL, NULL),
(15, 2, '24.830124250556757', '67.03960083425045', '2021-11-18 14:37:35', NULL, NULL),
(16, 1, '40.716178888236136', '-74.0050330817188', '2021-11-19 12:44:35', NULL, NULL),
(17, 1, '40.71558525520227', '-74.00567412967337', '2021-11-19 12:44:35', NULL, NULL),
(18, 1, '40.71514002695317', '-74.00499821300161', '2021-11-19 12:44:35', NULL, NULL),
(19, 3, '24.828871210384555', '67.04156119376421', '2021-11-19 13:12:17', NULL, NULL),
(20, 3, '24.829556154507337', '67.04146765172482', '2021-11-19 13:12:17', NULL, NULL),
(21, 3, '24.829089991260265', '67.04116523265839', '2021-11-19 13:12:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gateway_transaction_id` varchar(150) NOT NULL,
  `gateway_type` varchar(50) NOT NULL,
  `gateway_request` text,
  `gateway_response` text,
  `transaction_type` varchar(50) NOT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `crm_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image_url` text,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` text,
  `zipcode` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `platform_type` varchar(100) NOT NULL DEFAULT 'custom',
  `platform_id` varchar(200) NOT NULL DEFAULT '0',
  `device_type` varchar(100) DEFAULT NULL,
  `device_token` text,
  `is_mobile_verify` int(11) NOT NULL DEFAULT '0',
  `is_email_verify` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL,
  `is_login` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '0',
  `online_status` int(1) NOT NULL DEFAULT '0',
  `token` text NOT NULL,
  `remember_token` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `num_of_sale_reps` varchar(100) DEFAULT NULL,
  `description` text,
  `gateway_customer_id` varchar(255) DEFAULT NULL,
  `gateway_default_card_id` varchar(255) DEFAULT NULL,
  `gateway_default_card_json` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `parent_id`, `crm_id`, `name`, `username`, `email`, `mobile_no`, `password`, `image_url`, `country_id`, `state_id`, `city_id`, `address`, `zipcode`, `gender`, `latitude`, `longitude`, `platform_type`, `platform_id`, `device_type`, `device_token`, `is_mobile_verify`, `is_email_verify`, `status_id`, `is_login`, `is_active`, `online_status`, `token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `num_of_sale_reps`, `description`, `gateway_customer_id`, `gateway_default_card_id`, `gateway_default_card_json`) VALUES
(1, NULL, NULL, 0, 0, 'Retro Cube', 'retro-cube', 'admin@retrocube.com', '1-8882051816', '$2y$10$tvFTvHCS42KCaH3HrA/HgO8wxVMQRf623i2VO6uzrcUdlJr6z/QIy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', 'web', NULL, 1, 1, 1, 0, 0, 0, 'ecc9f65c5ebe9a133e0a52f6a3b4af90', '9tGS1oSCX4Ppggjn63krgfJWuqchEsol6LLCxkDvxtvMfQuAMC3430bWDPlh', '2020-11-11 06:14:43', '2021-11-16 15:11:50', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'robert', 'klien', 0, 0, 'robachik', 'robachik', 'robertk@yopmail.com', '+90020098765', '$2y$10$yi/2eocmRedRpNOicEiIHOfZTo4xPlDPfCgTjMnvCXAQutYfetwpe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', 'web', 'ezDVySfVhzUFUQ38Q-aN2B:APA91bGL_r6utGE0bRvPmsGOWUCevbJYF2fe8rAgl8dnlDEjAFQHnZahtmKf1RvRkPXdEA8i5xyhOeCY4NKTC0pB7i26_wUSkDili9-Ag098XOsOKp_KwgJEJt0GSB65Nz1yltNdsR3e', 0, 0, 1, 0, 0, 0, 'e797b67267ca56808e3c52120e0d8b96', 'GQ0g0ZVLApSrP5CF8mnwsMzNvJCAN4k5Ex9SDy43PhWnSgJBg8lZfewjXDHt', '2021-11-15 10:20:30', '2021-12-03 02:17:59', NULL, '5 to 10', 'abcd', 'cus_KbEmbC3fgqV1XS', 'card_1Jw2IaCYOXmVqQMpqyxzFPfx', '{\"id\":\"card_1Jw2IaCYOXmVqQMpqyxzFPfx\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"23333\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbEmbC3fgqV1XS\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":12,\"exp_year\":2022,\"fingerprint\":\"bx1eCwx6SQt71PfR\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(123, NULL, NULL, 122, 0, 'teamlead', 'teamlead', 'teamlead@yopmail.com', '3345678', '$2y$10$SvrnDudkZ18tCWW/AQLVau/flvzn9Om8lN9Z8H8mPAn9LJ7yYzz2G', '/storage/team/mXZk6y97ezp7x4hN4XVP93rCQOYDctSQKJWke5QJ.jpeg', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'custom', '0', 'ios', 'eX4h5Pb6ovE:APA91bEq5E5smUPTzuUoET2EBKBFjQPn0KyBHsmQjTC8cvsmYZYkBoZ5m5kMYlvIrkg6x8cmysuuwVf4gaEWF9p4ygjiQM0nUiDXYEZUt6vxg2Kck93poTo3sSbzNmwvwfHaRVvH5fkw', 0, 0, 1, 0, 0, 0, '0a59653b6f08ffb332c214f406e1706007b8ed8d8b611896c68387c833fc2c0d', '2JlXQb8hZOnmWqujYhaJlqOd8y3cJY9iFCEUXg1jghiQ4kuAoLNY521kWGZ6', '2021-11-15 15:01:21', '2021-11-19 14:41:25', NULL, NULL, NULL, NULL, NULL, NULL),
(124, NULL, NULL, 123, 0, 'sales', 'sales', 'sr@yopmail.com', '009867565', '$2y$10$/ueExfLAW8.s3Z/tja.8/.fNqZ56qatjHPmQzBhJMHC3BdxaQOTZq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', NULL, NULL, 0, 0, 1, 0, 0, 0, '7b48a875bab3203da7521fc327348911', '3aaImdOsVZk4O4Xdetgu9Q9z1ecQKdElncSYOBbgBsoW1SSxs6xUWwxB2fd6', '2021-11-15 15:08:19', '2021-11-15 15:09:37', NULL, NULL, NULL, NULL, NULL, NULL),
(125, NULL, NULL, 122, 0, 'salesrep', 'salesrep', 'salessr@yopmail.com', '00987666', '$2y$10$01xCQyo5Fre6SBR5eNuK7OBv5Snw9fbVl3V/mnBOroqG04WcCFf8a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', 'web', 'd1K3JM5F9Pg0KclFRa_Zv0:APA91bGjEMGGVbDwV2Y7xvveblm1EDj-3VTmcZf6ODAZtsEl5tSHFsf1pyKWjMS8UMu4Dp-njpz0US9m55QxcyISZ6MInuhIEOIEUgJt7Lyqmf7-lOcj6aPEDk_5kYgLCaM-rOSRTb27', 0, 0, 1, 0, 0, 0, '08193d63bbf7152019bcd92c84527dae', NULL, '2021-11-15 15:13:05', '2021-11-15 15:14:18', NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'Paul', 'Lewis', 0, 0, 'Emerson Enterprises', 'emerson-enterprises', 'paul@emerson-enterprises.com', '9135686359', '$2y$10$Zn7Ruq4eshqPrrwG6VPD..NgxJcyWPpK8eMCk2W7fTEZ6RCil443u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', '1234567890', NULL, 0, 0, 1, 0, 0, 0, '881b369b6178ceb4a70e3f619d6df85068f6e3ed4df1a09b9be6ba973fb44bbf', NULL, '2021-11-16 16:27:16', '2021-11-16 16:27:16', NULL, '11 to 50', 'test', 'cus_Kbhuo0EkyUZ9U4', 'card_1JwUV7CYOXmVqQMpVPkkHQXW', '{\"id\":\"card_1JwUV7CYOXmVqQMpVPkkHQXW\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"66030\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_Kbhuo0EkyUZ9U4\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":1,\"exp_year\":2024,\"fingerprint\":\"b7LCjJvxCu5QFH4K\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(127, 'Maddy', 'Kay', 0, 0, 'Retrocube', 'retrocube', 'maddy@retrocube.com', '+923452129193', '$2y$10$etbgkHGDIMsOzVUt.d4LxOPi0dj3XEzKlW8tuvA7rsh9lgNn.QzZq', NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, 'custom', '0', '1234567890', NULL, 0, 0, 1, 0, 0, 0, '9171e529369bc321a25a1b7a2eefa082', 'buWzNBPgAESrelWWAXi2TJxSHHFcdjEvcJ0XKTjYMtnxh5ziuhJIT16yh8EF', '2021-11-16 17:54:52', '2021-11-16 18:00:49', NULL, '5 to 10', 'Testing', 'cus_KbjKXUqPd4HtZE', 'card_1JwVruCYOXmVqQMp3n5IvccE', '{\"id\":\"card_1JwVruCYOXmVqQMp3n5IvccE\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"54680\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbjKXUqPd4HtZE\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":12,\"exp_year\":2022,\"fingerprint\":\"b7LCjJvxCu5QFH4K\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(128, 'Paul', 'Lewis', 0, 0, 'Emerson', 'emerson', 'paul@emersonpros.com', '9137486940', '$2y$10$AGSsZ7ehdmbp5WroU7y/CO3Ywh4LOewnIgCgKs//Swi1IAoDyD7zS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', '1234567890', NULL, 0, 0, 1, 0, 0, 0, 'a36418d8858d63cba45b2466e2747cb36ef20bf57de6fbe645f43ef83d266118', NULL, '2021-11-16 18:09:17', '2021-11-16 18:09:17', NULL, '51 to 250', 'Test subscription', 'cus_KbjZ9Iosvb6wt9', 'card_1JwW5rCYOXmVqQMpuDuFWtqW', '{\"id\":\"card_1JwW5rCYOXmVqQMpuDuFWtqW\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"66030\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbjZ9Iosvb6wt9\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":1,\"exp_year\":2024,\"fingerprint\":\"b7LCjJvxCu5QFH4K\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(129, 'Paul', 'Lewis', 0, 0, 'Emerson', 'emerson154', 'paulemersonent@gmail.com', '8161234567', '$2y$10$2EovimBzrFFS9ydUw3aRvuOszqePOhDDEF02xb0PSC8W5YFZp20Gi', '/storage/team/elc9r0zHAvGBZaD9VCm76lOIIei9CGL66pqPEWHH.png', NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, 'custom', '0', 'web', NULL, 0, 1, 1, 0, 0, 0, '675d08bccf56995027f99375450d994b', 'lqpjdfglc1MnxmqvLVK5QVVkQNqsVEKlyAU9ITeYNPEpxJrvqkRHjNBkJlo6', '2021-11-16 18:20:48', '2021-11-16 18:40:22', NULL, '51 to 250', 'test subscription', 'cus_KbjkN2IIAmkhPm', 'card_1JwWH0CYOXmVqQMpIqEE9hOg', '{\"id\":\"card_1JwWH0CYOXmVqQMpIqEE9hOg\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"66030\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_KbjkN2IIAmkhPm\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":1,\"exp_year\":2024,\"fingerprint\":\"b7LCjJvxCu5QFH4K\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(130, 'Elina', 'smith', 0, 0, 'test company', 'test-company', 'elinasmith@yopmail.com', '1-4256329856', '$2y$10$3GCJqB4Rk8G41TtWD/GiUOVUvS04PO8SxmXD.Lk/avGQQLe7Euumi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', 'web', 'cu7tvQBRvpKtYM-T4-ACut:APA91bE4vO8y9QGdA9tipRxLqcnZCQzKn-U86OK2v0UQAN7COpNPlCvPDUFbDRWZvd6NWjqwgcec5sbK4VctS167Ve1XVVonR5juj_OztxVQ0IzJant_FpGjYcjcKCcsEcu_eXsz_A0h', 0, 1, 1, 0, 0, 0, 'bbbad7f08cf482f21e9d07de80494351', NULL, '2021-11-17 12:55:25', '2021-11-17 12:56:02', NULL, '2 to 4', 'test description', 'cus_Kc1jWi3POXb0Bm', 'card_1JwnfbCYOXmVqQMpltiJm8Dd', '{\"id\":\"card_1JwnfbCYOXmVqQMpltiJm8Dd\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"12345\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":\"cus_Kc1jWi3POXb0Bm\",\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"bx1eCwx6SQt71PfR\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null}'),
(131, NULL, NULL, 123, 0, 'Kin', 'kin', 'Kinqa@yopmail.com', '0085214455', '$2y$10$NGsvxnz/pfvYOlJAXLt1HeKzG3QwsIACyTmdbuAR4sb9/8WsH6FdG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', NULL, NULL, 0, 0, 1, 0, 0, 0, 'af27a9e3a38d66ab523e83ec42e56862ae42ef00f92178827a19880432e81135', NULL, '2021-11-18 13:16:19', '2021-11-18 13:16:19', NULL, NULL, NULL, NULL, NULL, NULL),
(132, NULL, NULL, 123, 0, 'Hellen', 'hellen', 'Hellenqa@yopmail.com', '005221113', '$2y$10$9RYm9p3TrEQ05D7yN9X3CukRMyc8ehTJPfT4sxAKXLAk/7qENk5E2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'custom', '0', NULL, NULL, 0, 0, 1, 0, 0, 0, '2b3ae8ac183ea0177c56198dd6b40add2ae34d60e6111ba493e678ba0d4e9bba', NULL, '2021-11-18 13:31:05', '2021-11-18 13:31:05', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_company_mapping`
--

CREATE TABLE `user_company_mapping` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `employee_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_company_mapping`
--

INSERT INTO `user_company_mapping` (`id`, `company_user_id`, `employee_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 122, '2021-11-15 10:20:30', NULL, NULL),
(2, 122, 123, '2021-11-15 15:01:21', NULL, NULL),
(3, 122, 124, '2021-11-15 15:08:20', NULL, NULL),
(4, 122, 125, '2021-11-15 15:13:05', NULL, NULL),
(5, 126, 126, '2021-11-16 16:27:16', NULL, NULL),
(6, 127, 127, '2021-11-16 17:54:52', NULL, NULL),
(7, 128, 128, '2021-11-16 18:09:18', NULL, NULL),
(8, 129, 129, '2021-11-16 18:20:48', NULL, NULL),
(9, 130, 130, '2021-11-17 12:55:26', NULL, NULL),
(10, 122, 131, '2021-11-18 13:16:20', NULL, NULL),
(11, 122, 132, '2021-11-18 13:31:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_company_pin_mapping`
--

CREATE TABLE `user_company_pin_mapping` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `user_pin_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_company_pin_mapping`
--

INSERT INTO `user_company_pin_mapping` (`id`, `company_user_id`, `user_pin_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 1, '2021-11-15 13:11:36', NULL, NULL),
(2, 122, 2, '2021-11-18 12:44:38', NULL, NULL),
(3, 122, 3, '2021-11-18 14:39:43', NULL, NULL),
(4, 122, 4, '2021-11-19 15:04:28', NULL, NULL),
(5, 122, 5, '2021-12-02 06:19:46', NULL, NULL),
(6, 122, 6, '2021-12-02 06:20:12', NULL, NULL),
(7, 122, 7, '2021-12-02 06:20:38', NULL, NULL),
(8, 122, 8, '2021-12-02 06:20:48', NULL, NULL),
(9, 122, 9, '2021-12-02 06:20:56', NULL, NULL),
(10, 122, 10, '2021-12-02 06:21:11', NULL, NULL),
(11, 122, 11, '2021-12-02 06:22:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_kpi_target_sale`
--

CREATE TABLE `user_kpi_target_sale` (
  `id` int(11) NOT NULL,
  `user_sales_plan_id` int(11) NOT NULL,
  `kpi_target_sale_type` enum('kpi_annual_target','kpi_monthly_target','kpi_weekly_target') NOT NULL,
  `kpi_group_id` int(11) NOT NULL,
  `target_value` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_kpi_target_sale`
--

INSERT INTO `user_kpi_target_sale` (`id`, `user_sales_plan_id`, `kpi_target_sale_type`, `kpi_group_id`, `target_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 2, 'kpi_annual_target', 1, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(35, 2, 'kpi_annual_target', 2, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(36, 2, 'kpi_annual_target', 3, 1363.64, '2021-11-15 15:08:20', NULL, NULL),
(37, 2, 'kpi_annual_target', 4, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(38, 2, 'kpi_annual_target', 5, 22728636.36, '2021-11-15 15:08:20', NULL, NULL),
(39, 2, 'kpi_annual_target', 6, 0.09, '2021-11-15 15:08:20', NULL, NULL),
(40, 2, 'kpi_annual_target', 7, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(41, 2, 'kpi_annual_target', 8, 1136.36, '2021-11-15 15:08:20', NULL, NULL),
(42, 2, 'kpi_annual_target', 9, 1010.10, '2021-11-15 15:08:20', NULL, NULL),
(43, 2, 'kpi_annual_target', 10, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(44, 2, 'kpi_annual_target', 11, 681.86, '2021-11-15 15:08:20', NULL, NULL),
(45, 2, 'kpi_monthly_target', 1, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(46, 2, 'kpi_monthly_target', 2, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(47, 2, 'kpi_monthly_target', 3, 681.82, '2021-11-15 15:08:20', NULL, NULL),
(48, 2, 'kpi_monthly_target', 4, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(49, 2, 'kpi_monthly_target', 5, 11364318.18, '2021-11-15 15:08:20', NULL, NULL),
(50, 2, 'kpi_monthly_target', 6, 0.05, '2021-11-15 15:08:20', NULL, NULL),
(51, 2, 'kpi_monthly_target', 7, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(52, 2, 'kpi_monthly_target', 8, 568.18, '2021-11-15 15:08:20', NULL, NULL),
(53, 2, 'kpi_monthly_target', 9, 505.05, '2021-11-15 15:08:20', NULL, NULL),
(54, 2, 'kpi_monthly_target', 10, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(55, 2, 'kpi_monthly_target', 11, 340.93, '2021-11-15 15:08:20', NULL, NULL),
(56, 2, 'kpi_weekly_target', 1, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(57, 2, 'kpi_weekly_target', 2, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(58, 2, 'kpi_weekly_target', 3, 454.55, '2021-11-15 15:08:20', NULL, NULL),
(59, 2, 'kpi_weekly_target', 4, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(60, 2, 'kpi_weekly_target', 5, 7576212.12, '2021-11-15 15:08:20', NULL, NULL),
(61, 2, 'kpi_weekly_target', 6, 0.03, '2021-11-15 15:08:20', NULL, NULL),
(62, 2, 'kpi_weekly_target', 7, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(63, 2, 'kpi_weekly_target', 8, 378.79, '2021-11-15 15:08:20', NULL, NULL),
(64, 2, 'kpi_weekly_target', 9, 336.70, '2021-11-15 15:08:20', NULL, NULL),
(65, 2, 'kpi_weekly_target', 10, 99999999.99, '2021-11-15 15:08:20', NULL, NULL),
(66, 2, 'kpi_weekly_target', 11, 227.29, '2021-11-15 15:08:20', NULL, NULL),
(67, 3, 'kpi_annual_target', 1, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(68, 3, 'kpi_annual_target', 2, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(69, 3, 'kpi_annual_target', 3, 15000.00, '2021-11-15 15:13:05', NULL, NULL),
(70, 3, 'kpi_annual_target', 4, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(71, 3, 'kpi_annual_target', 5, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(72, 3, 'kpi_annual_target', 6, 1.00, '2021-11-15 15:13:05', NULL, NULL),
(73, 3, 'kpi_annual_target', 7, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(74, 3, 'kpi_annual_target', 8, 12500.00, '2021-11-15 15:13:05', NULL, NULL),
(75, 3, 'kpi_annual_target', 9, 11111.11, '2021-11-15 15:13:05', NULL, NULL),
(76, 3, 'kpi_annual_target', 10, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(77, 3, 'kpi_annual_target', 11, 7500.45, '2021-11-15 15:13:05', NULL, NULL),
(78, 3, 'kpi_monthly_target', 1, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(79, 3, 'kpi_monthly_target', 2, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(80, 3, 'kpi_monthly_target', 3, 5000.00, '2021-11-15 15:13:05', NULL, NULL),
(81, 3, 'kpi_monthly_target', 4, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(82, 3, 'kpi_monthly_target', 5, 83338333.33, '2021-11-15 15:13:05', NULL, NULL),
(83, 3, 'kpi_monthly_target', 6, 0.33, '2021-11-15 15:13:05', NULL, NULL),
(84, 3, 'kpi_monthly_target', 7, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(85, 3, 'kpi_monthly_target', 8, 4166.67, '2021-11-15 15:13:05', NULL, NULL),
(86, 3, 'kpi_monthly_target', 9, 3703.70, '2021-11-15 15:13:05', NULL, NULL),
(87, 3, 'kpi_monthly_target', 10, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(88, 3, 'kpi_monthly_target', 11, 2500.15, '2021-11-15 15:13:05', NULL, NULL),
(89, 3, 'kpi_weekly_target', 1, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(90, 3, 'kpi_weekly_target', 2, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(91, 3, 'kpi_weekly_target', 3, 7500.00, '2021-11-15 15:13:05', NULL, NULL),
(92, 3, 'kpi_weekly_target', 4, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(93, 3, 'kpi_weekly_target', 5, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(94, 3, 'kpi_weekly_target', 6, 0.50, '2021-11-15 15:13:05', NULL, NULL),
(95, 3, 'kpi_weekly_target', 7, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(96, 3, 'kpi_weekly_target', 8, 6250.00, '2021-11-15 15:13:05', NULL, NULL),
(97, 3, 'kpi_weekly_target', 9, 5555.56, '2021-11-15 15:13:05', NULL, NULL),
(98, 3, 'kpi_weekly_target', 10, 99999999.99, '2021-11-15 15:13:05', NULL, NULL),
(99, 3, 'kpi_weekly_target', 11, 3750.22, '2021-11-15 15:13:05', NULL, NULL),
(100, 4, 'kpi_annual_target', 1, 1279442.18, '2021-11-18 13:31:06', NULL, NULL),
(101, 4, 'kpi_annual_target', 2, 1857.75, '2021-11-18 13:31:06', NULL, NULL),
(102, 4, 'kpi_annual_target', 3, 8.18, '2021-11-18 13:31:06', NULL, NULL),
(103, 4, 'kpi_annual_target', 4, 140738.64, '2021-11-18 13:31:06', NULL, NULL),
(104, 4, 'kpi_annual_target', 5, 99.08, '2021-11-18 13:31:06', NULL, NULL),
(105, 4, 'kpi_annual_target', 6, 1.00, '2021-11-18 13:31:06', NULL, NULL),
(106, 4, 'kpi_annual_target', 7, 15481.25, '2021-11-18 13:31:06', NULL, NULL),
(107, 4, 'kpi_annual_target', 8, 9.09, '2021-11-18 13:31:06', NULL, NULL),
(108, 4, 'kpi_annual_target', 9, 8.33, '2021-11-18 13:31:06', NULL, NULL),
(109, 4, 'kpi_annual_target', 10, 1238.50, '2021-11-18 13:31:06', NULL, NULL),
(110, 4, 'kpi_annual_target', 11, 12.88, '2021-11-18 13:31:06', NULL, NULL),
(111, 4, 'kpi_monthly_target', 1, 639721.09, '2021-11-18 13:31:06', NULL, NULL),
(112, 4, 'kpi_monthly_target', 2, 928.88, '2021-11-18 13:31:06', NULL, NULL),
(113, 4, 'kpi_monthly_target', 3, 4.09, '2021-11-18 13:31:06', NULL, NULL),
(114, 4, 'kpi_monthly_target', 4, 70369.32, '2021-11-18 13:31:06', NULL, NULL),
(115, 4, 'kpi_monthly_target', 5, 49.54, '2021-11-18 13:31:06', NULL, NULL),
(116, 4, 'kpi_monthly_target', 6, 0.50, '2021-11-18 13:31:06', NULL, NULL),
(117, 4, 'kpi_monthly_target', 7, 7740.63, '2021-11-18 13:31:06', NULL, NULL),
(118, 4, 'kpi_monthly_target', 8, 4.54, '2021-11-18 13:31:06', NULL, NULL),
(119, 4, 'kpi_monthly_target', 9, 4.17, '2021-11-18 13:31:06', NULL, NULL),
(120, 4, 'kpi_monthly_target', 10, 619.25, '2021-11-18 13:31:06', NULL, NULL),
(121, 4, 'kpi_monthly_target', 11, 6.44, '2021-11-18 13:31:06', NULL, NULL),
(122, 4, 'kpi_weekly_target', 1, 639721.09, '2021-11-18 13:31:06', NULL, NULL),
(123, 4, 'kpi_weekly_target', 2, 928.88, '2021-11-18 13:31:06', NULL, NULL),
(124, 4, 'kpi_weekly_target', 3, 4.09, '2021-11-18 13:31:06', NULL, NULL),
(125, 4, 'kpi_weekly_target', 4, 70369.32, '2021-11-18 13:31:06', NULL, NULL),
(126, 4, 'kpi_weekly_target', 5, 49.54, '2021-11-18 13:31:06', NULL, NULL),
(127, 4, 'kpi_weekly_target', 6, 0.50, '2021-11-18 13:31:06', NULL, NULL),
(128, 4, 'kpi_weekly_target', 7, 7740.63, '2021-11-18 13:31:06', NULL, NULL),
(129, 4, 'kpi_weekly_target', 8, 4.54, '2021-11-18 13:31:06', NULL, NULL),
(130, 4, 'kpi_weekly_target', 9, 4.17, '2021-11-18 13:31:06', NULL, NULL),
(131, 4, 'kpi_weekly_target', 10, 619.25, '2021-11-18 13:31:06', NULL, NULL),
(132, 4, 'kpi_weekly_target', 11, 6.44, '2021-11-18 13:31:06', NULL, NULL),
(133, 5, 'kpi_annual_target', 1, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(134, 5, 'kpi_annual_target', 2, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(135, 5, 'kpi_annual_target', 3, 45.00, '2021-11-19 12:52:27', NULL, NULL),
(136, 5, 'kpi_annual_target', 4, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(137, 5, 'kpi_annual_target', 5, 2295.00, '2021-11-19 12:52:27', NULL, NULL),
(138, 5, 'kpi_annual_target', 6, 0.90, '2021-11-19 12:52:27', NULL, NULL),
(139, 5, 'kpi_annual_target', 7, 2550000.00, '2021-11-19 12:52:27', NULL, NULL),
(140, 5, 'kpi_annual_target', 8, 22.50, '2021-11-19 12:52:27', NULL, NULL),
(141, 5, 'kpi_annual_target', 9, 18.00, '2021-11-19 12:52:27', NULL, NULL),
(142, 5, 'kpi_annual_target', 10, 76500.00, '2021-11-19 12:52:27', NULL, NULL),
(143, 5, 'kpi_annual_target', 11, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(144, 5, 'kpi_monthly_target', 1, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(145, 5, 'kpi_monthly_target', 2, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(146, 5, 'kpi_monthly_target', 3, 5.63, '2021-11-19 12:52:27', NULL, NULL),
(147, 5, 'kpi_monthly_target', 4, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(148, 5, 'kpi_monthly_target', 5, 286.88, '2021-11-19 12:52:27', NULL, NULL),
(149, 5, 'kpi_monthly_target', 6, 0.11, '2021-11-19 12:52:27', NULL, NULL),
(150, 5, 'kpi_monthly_target', 7, 318750.00, '2021-11-19 12:52:27', NULL, NULL),
(151, 5, 'kpi_monthly_target', 8, 2.81, '2021-11-19 12:52:27', NULL, NULL),
(152, 5, 'kpi_monthly_target', 9, 2.20, '2021-11-19 12:52:27', NULL, NULL),
(153, 5, 'kpi_monthly_target', 10, 9562.50, '2021-11-19 12:52:27', NULL, NULL),
(154, 5, 'kpi_monthly_target', 11, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(155, 5, 'kpi_weekly_target', 1, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(156, 5, 'kpi_weekly_target', 2, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(157, 5, 'kpi_weekly_target', 3, 6.43, '2021-11-19 12:52:27', NULL, NULL),
(158, 5, 'kpi_weekly_target', 4, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(159, 5, 'kpi_weekly_target', 5, 327.86, '2021-11-19 12:52:27', NULL, NULL),
(160, 5, 'kpi_weekly_target', 6, 0.13, '2021-11-19 12:52:27', NULL, NULL),
(161, 5, 'kpi_weekly_target', 7, 364285.71, '2021-11-19 12:52:27', NULL, NULL),
(162, 5, 'kpi_weekly_target', 8, 3.21, '2021-11-19 12:52:27', NULL, NULL),
(163, 5, 'kpi_weekly_target', 9, 2.60, '2021-11-19 12:52:27', NULL, NULL),
(164, 5, 'kpi_weekly_target', 10, 10928.57, '2021-11-19 12:52:27', NULL, NULL),
(165, 5, 'kpi_weekly_target', 11, 0.00, '2021-11-19 12:52:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 'is_administrator', '1', '2021-11-15 10:20:30', NULL, NULL),
(2, 122, 'manage_user', '1', '2021-11-15 10:20:30', NULL, NULL),
(3, 122, 'can_import_pin', '1', '2021-11-15 10:20:30', NULL, NULL),
(4, 122, 'share_report', '1', '2021-11-15 10:20:30', NULL, NULL),
(10, 124, 'title', 'SR', '2021-11-15 15:08:20', NULL, NULL),
(11, 124, 'pin_view_permission', 'own_subordinate_peer', '2021-11-15 15:08:20', NULL, NULL),
(12, 124, 'edit_permission', 'own_subordinate_peer', '2021-11-15 15:08:20', NULL, NULL),
(13, 124, 'is_administrator', '1', '2021-11-15 15:08:20', NULL, NULL),
(14, 124, 'manage_user', '1', '2021-11-15 15:08:20', NULL, NULL),
(15, 125, 'title', 'salesrep', '2021-11-15 15:13:05', NULL, NULL),
(16, 125, 'pin_view_permission', 'own_subordinate_peer', '2021-11-15 15:13:05', NULL, NULL),
(17, 125, 'edit_permission', 'own_subordinate_peer', '2021-11-15 15:13:05', NULL, NULL),
(18, 125, 'manage_user', '1', '2021-11-15 15:13:05', NULL, NULL),
(19, 126, 'is_administrator', '1', '2021-11-16 16:27:16', NULL, NULL),
(20, 126, 'manage_user', '1', '2021-11-16 16:27:16', NULL, NULL),
(21, 126, 'can_import_pin', '1', '2021-11-16 16:27:16', NULL, NULL),
(22, 126, 'share_report', '1', '2021-11-16 16:27:16', NULL, NULL),
(23, 127, 'is_administrator', '1', '2021-11-16 17:54:52', NULL, NULL),
(24, 127, 'manage_user', '1', '2021-11-16 17:54:52', NULL, NULL),
(25, 127, 'can_import_pin', '1', '2021-11-16 17:54:52', NULL, NULL),
(26, 127, 'share_report', '1', '2021-11-16 17:54:52', NULL, NULL),
(27, 128, 'is_administrator', '1', '2021-11-16 18:09:18', NULL, NULL),
(28, 128, 'manage_user', '1', '2021-11-16 18:09:18', NULL, NULL),
(29, 128, 'can_import_pin', '1', '2021-11-16 18:09:18', NULL, NULL),
(30, 128, 'share_report', '1', '2021-11-16 18:09:18', NULL, NULL),
(31, 129, 'is_administrator', '1', '2021-11-16 18:20:48', NULL, NULL),
(32, 129, 'manage_user', '1', '2021-11-16 18:20:48', NULL, NULL),
(33, 129, 'can_import_pin', '1', '2021-11-16 18:20:48', NULL, NULL),
(34, 129, 'share_report', '1', '2021-11-16 18:20:48', NULL, NULL),
(35, 130, 'is_administrator', '1', '2021-11-17 12:55:26', NULL, NULL),
(36, 130, 'manage_user', '1', '2021-11-17 12:55:26', NULL, NULL),
(37, 130, 'can_import_pin', '1', '2021-11-17 12:55:26', NULL, NULL),
(38, 130, 'share_report', '1', '2021-11-17 12:55:26', NULL, NULL),
(39, 131, 'title', 'Client scope', '2021-11-18 13:16:20', NULL, NULL),
(40, 131, 'pin_view_permission', 'own_subordinate_peer_manager', '2021-11-18 13:16:20', NULL, NULL),
(41, 131, 'pin_edit_permission', 'own_subordinate', '2021-11-18 13:16:20', NULL, NULL),
(42, 131, 'is_administrator', '0', '2021-11-18 13:16:20', NULL, NULL),
(43, 131, 'manage_user', '0', '2021-11-18 13:16:20', NULL, NULL),
(44, 131, 'can_import_pin', '0', '2021-11-18 13:16:20', NULL, NULL),
(45, 131, 'share_report', '0', '2021-11-18 13:16:20', NULL, NULL),
(46, 132, 'title', 'New user', '2021-11-18 13:31:06', NULL, NULL),
(47, 132, 'pin_view_permission', 'own_subordinate', '2021-11-18 13:31:06', NULL, NULL),
(48, 132, 'pin_edit_permission', 'own_subordinate', '2021-11-18 13:31:06', NULL, NULL),
(49, 132, 'is_administrator', '0', '2021-11-18 13:31:06', NULL, NULL),
(50, 132, 'manage_user', '0', '2021-11-18 13:31:06', NULL, NULL),
(51, 132, 'can_import_pin', '0', '2021-11-18 13:31:06', NULL, NULL),
(52, 132, 'share_report', '0', '2021-11-18 13:31:06', NULL, NULL),
(53, 123, 'title', 'TL web', '2021-11-19 12:52:26', NULL, NULL),
(54, 123, 'pin_view_permission', 'own_subordinate_peer_manager', '2021-11-19 12:52:26', NULL, NULL),
(55, 123, 'pin_edit_permission', 'own_subordinate', '2021-11-19 12:52:26', NULL, NULL),
(56, 123, 'is_administrator', '1', '2021-11-19 12:52:26', NULL, NULL),
(57, 123, 'manage_user', '1', '2021-11-19 12:52:26', NULL, NULL),
(58, 123, 'can_import_pin', '0', '2021-11-19 12:52:26', NULL, NULL),
(59, 123, 'share_report', '0', '2021-11-19 12:52:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_metric_target`
--

CREATE TABLE `user_metric_target` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_sales_plan_id` int(11) NOT NULL,
  `metric_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_metric_target`
--

INSERT INTO `user_metric_target` (`id`, `user_id`, `user_sales_plan_id`, `metric_id`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 124, 2, 1, 0.00, '2021-11-15 15:08:20', NULL, NULL),
(11, 124, 2, 4, 0.00, '2021-11-15 15:08:20', NULL, NULL),
(12, 124, 2, 7, 0.00, '2021-11-15 15:08:20', NULL, NULL),
(13, 124, 2, 2, 0.00, '2021-11-15 15:08:20', NULL, NULL),
(14, 124, 2, 5, 0.01, '2021-11-15 15:08:20', NULL, NULL),
(15, 124, 2, 8, 0.01, '2021-11-15 15:08:20', NULL, NULL),
(16, 124, 2, 3, 0.01, '2021-11-15 15:08:20', NULL, NULL),
(17, 124, 2, 6, 0.01, '2021-11-15 15:08:20', NULL, NULL),
(18, 124, 2, 9, 0.01, '2021-11-15 15:08:20', NULL, NULL),
(19, 125, 3, 1, 0.00, '2021-11-15 15:13:05', NULL, NULL),
(20, 125, 3, 4, 0.00, '2021-11-15 15:13:05', NULL, NULL),
(21, 125, 3, 7, 0.00, '2021-11-15 15:13:05', NULL, NULL),
(22, 125, 3, 2, 0.00, '2021-11-15 15:13:05', NULL, NULL),
(23, 125, 3, 5, 0.01, '2021-11-15 15:13:05', NULL, NULL),
(24, 125, 3, 8, 0.01, '2021-11-15 15:13:05', NULL, NULL),
(25, 125, 3, 3, 0.01, '2021-11-15 15:13:05', NULL, NULL),
(26, 125, 3, 6, 0.01, '2021-11-15 15:13:05', NULL, NULL),
(27, 125, 3, 9, 0.01, '2021-11-15 15:13:05', NULL, NULL),
(28, 132, 4, 1, 11.00, '2021-11-18 13:31:06', NULL, NULL),
(29, 132, 4, 4, 12.00, '2021-11-18 13:31:06', NULL, NULL),
(30, 132, 4, 7, 13.00, '2021-11-18 13:31:06', NULL, NULL),
(31, 132, 4, 2, 11.00, '2021-11-18 13:31:06', NULL, NULL),
(32, 132, 4, 5, 10.00, '2021-11-18 13:31:06', NULL, NULL),
(33, 132, 4, 8, 9.00, '2021-11-18 13:31:06', NULL, NULL),
(34, 132, 4, 3, 8.00, '2021-11-18 13:31:06', NULL, NULL),
(35, 132, 4, 6, 11.00, '2021-11-18 13:31:06', NULL, NULL),
(36, 132, 4, 9, 12.00, '2021-11-18 13:31:06', NULL, NULL),
(37, 123, 5, 1, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(38, 123, 5, 4, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(39, 123, 5, 7, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(40, 123, 5, 2, 0.00, '2021-11-19 12:52:27', NULL, NULL),
(41, 123, 5, 5, 1.00, '2021-11-19 12:52:27', NULL, NULL),
(42, 123, 5, 8, 2.00, '2021-11-19 12:52:27', NULL, NULL),
(43, 123, 5, 3, 3.00, '2021-11-19 12:52:27', NULL, NULL),
(44, 123, 5, 6, 4.00, '2021-11-19 12:52:27', NULL, NULL),
(45, 123, 5, 9, 5.00, '2021-11-19 12:52:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_password_reset`
--

CREATE TABLE `user_password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reset_token` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_pin`
--

CREATE TABLE `user_pin` (
  `id` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `assignee_user_id` int(11) NOT NULL,
  `pin_status_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `house_number` varchar(100) DEFAULT NULL,
  `house_address` text,
  `unit` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `location_is_verified` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_pin`
--

INSERT INTO `user_pin` (`id`, `creator_user_id`, `assignee_user_id`, `pin_status_id`, `territory_id`, `updated_by`, `house_number`, `house_address`, `unit`, `country`, `state`, `city`, `zipcode`, `latitude`, `longitude`, `name`, `phone`, `email`, `status_id`, `location_is_verified`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 122, 2, 0, 0, 'h#2034', '26 Federal Plaza, New York, NY, USA', NULL, NULL, 'NY', 'New York', '10278', '40.7157174', '-74.0042539', NULL, NULL, NULL, 1, 0, '2021-11-15 13:11:36', '2021-11-15 13:11:36', NULL),
(2, 123, 123, 1, 1, 123, NULL, '5150 Upper Ridge Rd, West Valley City, UT 84118, USA', NULL, NULL, NULL, NULL, NULL, '40.6576738', '-112.035969', '18 nov 2021', '0082136655', 'Rainbow@yopmail.com', 1, 0, '2021-11-18 12:44:38', '2021-11-18 13:43:20', NULL),
(3, 123, 123, 1, 1, 0, NULL, 'Ukiah, CA 95482, USA', NULL, NULL, NULL, NULL, NULL, '39.1501709', '-123.2077831', 'Pin 18 nov 2021', '00821335555', 'Pk@yopmal.com', 1, 0, '2021-11-18 14:39:43', '2021-11-18 14:39:43', NULL),
(4, 123, 123, 1, 1, 0, NULL, '19020 W 151st Terrace, Olathe, KS 66062, USA', NULL, NULL, NULL, NULL, NULL, '38.8543555', '-94.805553', NULL, NULL, NULL, 1, 0, '2021-11-19 15:04:28', '2021-11-19 15:04:28', NULL),
(5, 123, 123, 3, 1, 0, NULL, '16429 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8304572', '-94.9471327', NULL, NULL, NULL, 1, 0, '2021-12-02 06:19:46', '2021-12-02 06:19:46', NULL),
(6, 123, 123, 2, 1, 0, NULL, '16430 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8308414', '-94.9475424', NULL, NULL, NULL, 1, 0, '2021-12-02 06:20:12', '2021-12-02 06:20:12', NULL),
(7, 123, 123, 3, 1, 0, NULL, '16429 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8304326', '-94.9470948', NULL, NULL, NULL, 1, 0, '2021-12-02 06:20:38', '2021-12-02 06:20:38', NULL),
(8, 123, 123, 1, 1, 0, NULL, '16430 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8307852', '-94.9475273', NULL, NULL, NULL, 1, 0, '2021-12-02 06:20:48', '2021-12-02 06:20:48', NULL),
(9, 123, 123, 2, 1, 123, NULL, '16433 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8303853', '-94.9473453', NULL, NULL, NULL, 1, 0, '2021-12-02 06:20:56', '2021-12-02 06:22:14', NULL),
(10, 123, 123, 1, 1, 0, NULL, '16434 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.8307398', '-94.9477637', NULL, NULL, NULL, 1, 0, '2021-12-02 06:21:11', '2021-12-02 06:21:11', NULL),
(11, 123, 123, 2, 1, 0, NULL, '16430 Agnes St, Gardner, KS 66030, USA', NULL, NULL, NULL, NULL, NULL, '38.831389', '-94.9475377', 'Tester', NULL, NULL, 1, 0, '2021-12-02 06:22:57', '2021-12-02 06:22:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_pin_custom_field`
--

CREATE TABLE `user_pin_custom_field` (
  `id` int(11) NOT NULL,
  `user_pin_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_pin_status`
--

CREATE TABLE `user_pin_status` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `kpi_group_id` int(11) NOT NULL,
  `metric_id` int(11) NOT NULL,
  `custom_metric_title` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` text,
  `description` text,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_pin_status`
--

INSERT INTO `user_pin_status` (`id`, `company_user_id`, `creator_user_id`, `kpi_group_id`, `metric_id`, `custom_metric_title`, `title`, `slug`, `image_url`, `description`, `color`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 122, 6, 2, 'new metric', 'CS Status', 'cs-status', 'https://retrocubedev.com/qa/client_scope/public/assets/images/2.png', NULL, '#45E5CB', '2021-11-15 12:02:52', '2021-11-15 12:02:52', NULL),
(2, 122, 122, 7, 3, 'abv', 'web status', 'web-status', 'https://retrocubedev.com/qa/client_scope/public/assets/images/3.png', NULL, '#453E4A', '2021-11-15 12:04:25', '2021-11-16 13:50:37', NULL),
(3, 122, 122, 10, 3, 'klien', 'qa 3', 'qa-3', 'https://retrocubedev.com/qa/client_scope/public/assets/images/4.png', NULL, '#CC7A7A', '2021-11-15 12:06:45', '2021-11-15 12:06:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_pin_update_history`
--

CREATE TABLE `user_pin_update_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_pin_id` int(11) NOT NULL,
  `user_pin_status_id` int(11) NOT NULL,
  `record_json` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_pin_update_history`
--

INSERT INTO `user_pin_update_history` (`id`, `user_id`, `user_pin_id`, `user_pin_status_id`, `record_json`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 122, 1, 2, NULL, '2021-11-15 13:11:36', NULL, NULL),
(2, 123, 2, 1, NULL, '2021-11-18 12:44:39', NULL, NULL),
(3, 123, 2, 1, NULL, '2021-11-18 13:42:55', NULL, NULL),
(4, 123, 2, 1, NULL, '2021-11-18 13:43:20', NULL, NULL),
(5, 123, 3, 1, NULL, '2021-11-18 14:39:43', NULL, NULL),
(6, 123, 4, 1, NULL, '2021-11-19 15:04:28', NULL, NULL),
(7, 123, 5, 3, NULL, '2021-12-02 06:19:46', NULL, NULL),
(8, 123, 6, 2, NULL, '2021-12-02 06:20:12', NULL, NULL),
(9, 123, 7, 3, NULL, '2021-12-02 06:20:38', NULL, NULL),
(10, 123, 8, 1, NULL, '2021-12-02 06:20:48', NULL, NULL),
(11, 123, 9, 2, NULL, '2021-12-02 06:20:56', NULL, NULL),
(12, 123, 10, 1, NULL, '2021-12-02 06:21:11', NULL, NULL),
(13, 123, 9, 2, NULL, '2021-12-02 06:22:14', NULL, NULL),
(14, 123, 11, 2, NULL, '2021-12-02 06:22:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reporting`
--

CREATE TABLE `user_reporting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reporting_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_reporting`
--

INSERT INTO `user_reporting` (`id`, `user_id`, `reporting_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 123, 122, '2021-11-15 15:01:21', NULL, NULL),
(2, 124, 122, '2021-11-15 15:08:20', NULL, NULL),
(3, 125, 123, '2021-11-15 15:13:05', NULL, NULL),
(4, 131, 123, '2021-11-18 13:16:20', NULL, NULL),
(5, 132, 123, '2021-11-18 13:31:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2020-11-11 06:14:43', NULL, NULL),
(122, 122, 2, '2021-11-15 10:20:30', NULL, NULL),
(123, 123, 3, '2021-11-15 15:01:21', NULL, NULL),
(124, 124, 3, '2021-11-15 15:08:20', NULL, NULL),
(125, 125, 3, '2021-11-15 15:13:05', NULL, NULL),
(126, 126, 2, '2021-11-16 16:27:16', NULL, NULL),
(127, 127, 2, '2021-11-16 17:54:52', NULL, NULL),
(128, 128, 2, '2021-11-16 18:09:18', NULL, NULL),
(129, 129, 2, '2021-11-16 18:20:48', NULL, NULL),
(130, 130, 2, '2021-11-17 12:55:25', NULL, NULL),
(131, 131, 4, '2021-11-18 13:16:19', NULL, NULL),
(132, 132, 4, '2021-11-18 13:31:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sales_plan`
--

CREATE TABLE `user_sales_plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `revenue_per_sale_amount` decimal(10,2) NOT NULL,
  `user_annual_income_target` decimal(10,2) NOT NULL,
  `total_annual_sales_needed` decimal(10,2) NOT NULL,
  `total_work_week_left_to_sell` decimal(10,2) NOT NULL,
  `average_commission_per_sale` decimal(10,2) NOT NULL,
  `total_contracts_needed` decimal(10,2) NOT NULL,
  `total_work_month_left_to_sell` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sales_plan`
--

INSERT INTO `user_sales_plan` (`id`, `user_id`, `revenue_per_sale_amount`, `user_annual_income_target`, `total_annual_sales_needed`, `total_work_week_left_to_sell`, `average_commission_per_sale`, `total_contracts_needed`, `total_work_month_left_to_sell`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 124, 12.00, 1.00, 1.09, 3.00, 11.00, 0.09, 2.00, '2021-11-15 15:08:20', '2021-11-15 15:08:20', NULL),
(3, 125, 1.00, 2.00, 1.00, 2.00, 2.00, 1.00, 3.00, '2021-11-15 15:13:05', '2021-11-15 15:13:05', NULL),
(4, 132, 1.00, 1.00, 1.00, 2.00, 1.00, 1.00, 2.00, '2021-11-18 13:31:06', '2021-11-18 13:31:06', NULL),
(5, 123, 11.00, 9.00, 9.90, 7.00, 10.00, 0.90, 8.00, '2021-11-19 12:52:27', '2021-11-19 12:52:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_subscription`
--

CREATE TABLE `user_subscription` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gateway_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'stripe',
  `gateway_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `subscription_package_id` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('active','expired','cancel') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_subscription`
--

INSERT INTO `user_subscription` (`id`, `company_user_id`, `user_id`, `gateway_type`, `gateway_transaction_id`, `amount`, `subscription_package_id`, `expire_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 122, 'stripe', '0', '0', 1, '2021-11-29', 'active', '2021-11-15 10:20:30', NULL, NULL),
(2, 0, 126, 'stripe', '0', '0', 1, '2021-11-30', 'active', '2021-11-16 16:27:16', NULL, NULL),
(3, 0, 127, 'stripe', '0', '0', 1, '2021-11-30', 'active', '2021-11-16 17:54:52', NULL, NULL),
(4, 0, 128, 'stripe', '0', '0', 1, '2021-11-30', 'active', '2021-11-16 18:09:18', NULL, NULL),
(5, 0, 129, 'stripe', '0', '0', 1, '2021-11-30', 'active', '2021-11-16 18:20:48', NULL, NULL),
(6, 0, 130, 'stripe', '0', '0', 1, '2021-12-01', 'active', '2021-11-17 12:55:26', NULL, NULL),
(7, 122, 122, 'stripe', 'ch_3K2R7xCYOXmVqQMp06PFnABD', '270', 1, '2022-01-03', 'active', '2021-12-03 02:03:57', '2021-12-03 02:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_team`
--

CREATE TABLE `user_team` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_team`
--

INSERT INTO `user_team` (`id`, `team_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 123, '2021-11-15 15:01:21', '2021-11-19 12:52:26', NULL),
(2, 1, 124, '2021-11-15 15:08:20', NULL, NULL),
(3, 1, 125, '2021-11-15 15:13:05', NULL, NULL),
(4, 1, 131, '2021-11-18 13:16:19', NULL, NULL),
(5, 1, 132, '2021-11-18 13:31:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tracking`
--

CREATE TABLE `user_tracking` (
  `id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `tracking_user_id` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logging`
--
ALTER TABLE `activity_logging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_content`
--
ALTER TABLE `app_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message_delete`
--
ALTER TABLE `chat_message_delete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message_status`
--
ALTER TABLE `chat_message_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_users`
--
ALTER TABLE `chat_room_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_kpi_target_sale`
--
ALTER TABLE `company_kpi_target_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_metric_target`
--
ALTER TABLE `company_metric_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_sales_plan`
--
ALTER TABLE `company_sales_plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_user_id` (`company_user_id`);

--
-- Indexes for table `custom_field`
--
ALTER TABLE `custom_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_history`
--
ALTER TABLE `import_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_groups`
--
ALTER TABLE `kpi_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metrices`
--
ALTER TABLE `metrices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_setting`
--
ALTER TABLE `notification_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_packages`
--
ALTER TABLE `subscription_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `territory`
--
ALTER TABLE `territory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `territory_company_maping`
--
ALTER TABLE `territory_company_maping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `territory_latlong`
--
ALTER TABLE `territory_latlong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_company_mapping`
--
ALTER TABLE `user_company_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_company_pin_mapping`
--
ALTER TABLE `user_company_pin_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_kpi_target_sale`
--
ALTER TABLE `user_kpi_target_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_metric_target`
--
ALTER TABLE `user_metric_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pin`
--
ALTER TABLE `user_pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pin_custom_field`
--
ALTER TABLE `user_pin_custom_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pin_status`
--
ALTER TABLE `user_pin_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pin_update_history`
--
ALTER TABLE `user_pin_update_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reporting`
--
ALTER TABLE `user_reporting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sales_plan`
--
ALTER TABLE `user_sales_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscription`
--
ALTER TABLE `user_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_team`
--
ALTER TABLE `user_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tracking`
--
ALTER TABLE `user_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`latitude`,`longitude`),
  ADD KEY `tracking_user_id` (`tracking_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logging`
--
ALTER TABLE `activity_logging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `app_content`
--
ALTER TABLE `app_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message_delete`
--
ALTER TABLE `chat_message_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message_status`
--
ALTER TABLE `chat_message_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_room_users`
--
ALTER TABLE `chat_room_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_kpi_target_sale`
--
ALTER TABLE `company_kpi_target_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_metric_target`
--
ALTER TABLE `company_metric_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_sales_plan`
--
ALTER TABLE `company_sales_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field`
--
ALTER TABLE `custom_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_history`
--
ALTER TABLE `import_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kpi_groups`
--
ALTER TABLE `kpi_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metrices`
--
ALTER TABLE `metrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification_setting`
--
ALTER TABLE `notification_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_packages`
--
ALTER TABLE `subscription_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `territory`
--
ALTER TABLE `territory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `territory_company_maping`
--
ALTER TABLE `territory_company_maping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `territory_latlong`
--
ALTER TABLE `territory_latlong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `user_company_mapping`
--
ALTER TABLE `user_company_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_company_pin_mapping`
--
ALTER TABLE `user_company_pin_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_kpi_target_sale`
--
ALTER TABLE `user_kpi_target_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_metric_target`
--
ALTER TABLE `user_metric_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_pin`
--
ALTER TABLE `user_pin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_pin_custom_field`
--
ALTER TABLE `user_pin_custom_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_pin_status`
--
ALTER TABLE `user_pin_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_pin_update_history`
--
ALTER TABLE `user_pin_update_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_reporting`
--
ALTER TABLE `user_reporting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `user_sales_plan`
--
ALTER TABLE `user_sales_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_subscription`
--
ALTER TABLE `user_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_team`
--
ALTER TABLE `user_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tracking`
--
ALTER TABLE `user_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
