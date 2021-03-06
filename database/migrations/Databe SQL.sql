INSERT INTO `quotations` (`id`, `quote_number`, `quote_date`, `quote_purpose`, `quote_cp_name`, `quote_cp_phone`, `quote_cp_email`, `quote_term`, `quote_status`, `quote_company_id`, `quote_created_by`, `quote_updated_by`, `created_at`, `updated_at`) VALUES
(1, 180001, '2018-12-18', 'We need payment while agreed or contact signed We need payment while agreed or contact signed We need payment while agreed or contact signed We need payment while agreed or contact signed', 'Unkown', '0', 'un@123.com', '<div>Term &amp; Condition:</div>\r\n\r\n<ul>\r\n	<li>We need payment while agreed or contact signed.</li>\r\n	<li>After complete document with our check list provided, we need 10 week to complete.</li>\r\n</ul>\r\n\r\n<p>Thank you very much for your interesting our service today. We are looking forward to serve you. This price that we have quoted is valid till 28/December/2018</p>', 1, 1, 5, 5, '2018-12-18 05:52:03', '2018-12-18 06:50:25');

INSERT INTO `quotation_services` (`id`, `qs_price`, `qs_qty`, `qs_description`, `qs_quote_id`, `qs_service_id`, `qs_created_by`, `qs_updated_by`, `created_at`, `updated_at`) VALUES
(5, 450.00, 11, '<p><strong>qweqwe</strong></p>\n\n<ul>\n	<li>wqeqeqewqew1</li>\n	<li>qweqeqweqw1</li>\n</ul>\n\n<p><strong>qweqwe1</strong></p>\n\n<ul>\n	<li>wqeqeqewqew1</li>\n	<li>qweqeqweqw1</li>\n</ul>', 1, 78, 5, 5, '2018-12-18 09:21:57', '2018-12-18 09:31:22'),
(6, 100.00, 11, '<p>qeweqwe&#39;asdasd</p>', 1, 59, 5, 5, '2018-12-18 09:31:57', '2018-12-18 09:32:25'),
(7, 1200.00, 1, '<p>qweqeqwe&#39;</p>', 1, 30, 5, 5, '2018-12-18 09:32:39', '2018-12-18 09:32:39'),
(8, 450.00, 1, '<p>qweqwew&quot;</p>', 1, 78, 5, 5, '2018-12-18 09:32:53', '2018-12-18 09:32:53');

INSERT INTO `user_roles` (`id`, `ur_name`, `ur_description`) VALUES
(1, 'Poweradmin', 'Poweradmin'),
(2, 'Admin', 'Admin'),
(3, 'User', 'User');

INSERT INTO `users` (`id`, `name`, `email`, `image`, `phone`, `position`, `salary`, `gender`, `status`, `description`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_role_id`) VALUES
(3, 'Phoung Pheakdey', 'pk@dnkservice.com', '1544516546_3.jpg', '099 35 55 52', 'Dnk\'s President', 0.00, 1, 1, 'Testing', NULL, '$2y$10$WAfVduXlAvccqLpw1OcA6eU8nHNm.NEqzGnjVz5nD.ZNGeaUVgB.6', 'REwzgEJfSXNk0LjAeugssiGbXcsOyFEiL3IRU03urbXCNVZiu91U3bWepL58', '2018-12-10 21:03:29', '2018-12-13 05:59:24', 1),
(5, 'Sokun Sovisal', 'vs@gl.com', '1544517697_5.jpg', '098794286', 'IT Officer', 150.00, 1, 1, 'Sovisal', NULL, '$2y$10$/SasYs5RiuoMpe0ywx3ZHOgUNgJD/BGyuK0dLusAi90cpVMmJiLJe', NULL, '2018-12-11 01:38:46', '2018-12-11 01:41:37', 1);

INSERT INTO `provinces` (`id`, `pro_name`, `pro_description`, `created_at`, `updated_at`) VALUES
(1, 'បន្ទាយមានជ័យ', 'Banteay Meanchey', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(2, 'បាត់ដំបង', 'Battambang', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(3, 'កំពង់ចាម', 'Kampong Cham', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(4, 'កំពង់ឆ្នាំង', 'Kampong Chhnang', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(5, 'កំពង់ស្ពឺ', 'Kampong Speu', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(6, 'កំពង់ធំ', 'Kampong Thom', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(7, 'កំពត', 'Kampot', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(8, 'កណ្ដាល', 'Kandal', '2018-12-07 05:14:06', '2018-12-06 22:14:06'),
(9, 'កោះកុង', 'Koh Kong', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(10, 'ក្រចេះ', 'Kratie', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(11, 'មណ្ឌលគិរី', 'Mondul Kiri', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(12, 'ភ្នំពេញ', 'Phnom Penh', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(13, 'ព្រះវិហារ', 'Preah Vihear', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(14, 'ព្រៃវែង', 'Prey Veng', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(15, 'ពោធិ៍សាត់', 'Pursat', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(16, 'រតនគិរី', 'Ratanak', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(17, 'សៀមរាប', 'Siemreap', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(18, 'ព្រះសីហនុ', 'Preah Sihanouk', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(19, 'ស្ទឹងត្រែង', 'Stung Treng', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(20, 'ស្វាយរៀង', 'Svay Rieng', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(21, 'តាកែវ', 'Takeo', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(22, 'ឧត្ដរមានជ័យ', 'Oddar Meanchey', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(23, 'កែប', 'Kep', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(24, 'ប៉ៃលិន', 'Pailin', '2018-12-07 05:13:25', '0000-00-00 00:00:00'),
(25, 'ត្បូងឃ្មុំ', 'Tboung Khmum', '2018-12-07 05:13:25', '0000-00-00 00:00:00');

INSERT INTO `districts` (`id`, `dist_name`, `dist_description`, `dist_code`, `dist_province_id`, `created_at`, `updated_at`) VALUES
(1, 'មង្គលបូរី', 'Mungkul Borey', 102, 1, '2018-12-07 06:17:27', '2018-12-06 23:17:27'),
(2, 'ភ្នំស្រុក', 'Phnum Srok', 103, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(3, 'ព្រះនេត្រព្រះ', 'Preah Netr Preah', 104, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(4, 'អូរជ្រៅ', 'Ou Chrov', 105, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(5, 'សិរីសោភ័ណ', 'Serey Sophorn', 106, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(6, 'ថ្មពួក', 'Thma Puok', 107, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(7, 'ស្វាយចេក', 'Svay Chek', 108, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(8, 'ម៉ាឡៃ', 'Malai', 109, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(9, 'បាណន់', 'Banan', 201, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(10, 'ថ្មគោល', 'Thmor Koul', 202, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(11, 'បវេល', 'Bavel', 204, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(12, 'ឯកភ្នំ', 'Aek Phnum', 205, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(13, 'មោងឫស្សី', 'Maung Russey', 206, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(14, 'រុក្ខគីរី', 'Rukhakiri', 214, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(15, 'រតនមណ្ឌល', 'Ratanak Mondul', 207, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(16, 'សង្កែ', 'Sangke', 208, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(17, 'សំឡូត', 'Samlaut', 209, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(18, 'សំពៅលូន', 'Sampov Loun', 210, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(19, 'ភ្នំព្រឹក', 'Phnum Proek', 211, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(20, 'កំរៀង', 'Kamreang', 212, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(21, 'គាស់ក្រឡ', 'Koas Krala', 213, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(22, 'បាត់ដំបង', 'Battambang', 203, 2, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(23, 'ប៉ោយប៉ែត', 'Poipet', 110, 1, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(24, 'កំពង់ចាម', 'Kampong Cham', 304, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(25, 'បាធាយ​', 'Batheay', 301, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(26, 'ចំការលើ​', 'Chamkar Leu', 302, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(27, 'ជើងព្រៃ​', 'Cheung Prey', 303, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(28, 'កំពង់សៀម​', 'Kampong Siem', 305, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(29, 'កងមាស​', 'Kang Meas', 306, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(30, 'កោះសូទិន​', 'Kaoh Soutin', 307, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(31, 'ព្រៃឈរ​', 'Prey Chhor', 308, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(32, 'ស្រីសន្ធរ​', 'Srey Santhor', 309, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(33, 'ស្ទឹងត្រង់', 'Stueng Trang', 310, 3, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(34, 'បរិបូណ៌', 'Baribour', 401, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(35, 'ជលគីរី', 'Chol Kiri', 402, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(36, 'កំពង់ឆ្នាំង', 'Kampong Chhnang', 403, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(37, 'កំពង់លែង', 'Kampong Leaeng', 404, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(38, 'កំពង់ត្រឡាច', 'Kampong Tralach', 405, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(39, 'រលាប្អៀរ', 'Rolea B\'ier', 406, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(40, 'សាមគ្គីមានជ័យ', 'Sameakki Mean Chey', 407, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(41, 'ទឹកផុស', 'Tuek Phos', 408, 4, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(42, 'បរសេដ្ឋ', 'Borsedth', 501, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(43, 'ច្បារមន', 'Chbar Mon', 502, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(44, 'គងពិសី', 'Kong Pisei', 503, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(45, 'ឱរ៉ាល់', 'Aoral', 504, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(46, 'ឧដុង្គ', 'Odongk', 505, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(47, 'ភ្នំស្រួច', 'Phnum Sruoch', 506, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(48, 'សំរោងទង', 'Samraong Tong', 507, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(49, 'ថ្ពង', 'Thpong', 508, 5, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(50, 'បារាយណ៍', 'Baray', 601, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(51, 'កំពង់ស្វាយ', 'Kampong Svay', 602, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(52, 'ស្ទឹងសែន', 'Stueng Saen', 603, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(53, 'ប្រាសាទបល្ល័ង្ក', 'Prasat Balang', 604, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(54, 'ប្រាសាទសំបូរ', 'Prasat Sambour', 605, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(55, 'សណ្ដាន់', 'Sandan', 606, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(56, 'សន្ទុក', 'Santuk', 607, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(57, 'ស្ទោង', 'Stoung', 608, 6, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(58, 'អង្គរជ័យ', 'Angkor Chey', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(59, 'បន្ទាយមាស', 'Bantay Meas', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(60, 'ឈូក', 'Chouk', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(61, 'ជុំគីរី', 'Chum Kiri', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(62, 'ដងទង់', 'Dong Tung', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(63, 'កំពង់ត្រាច', 'Kampong Trach', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(64, 'កំពត', 'Kampot', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(65, 'ទឹកឈូ', 'Tuek Chu', 0, 7, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(66, 'កណ្ដាលស្ទឹង', 'Kandal Stueng', 801, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(67, 'កៀនស្វាយ', 'Kien Svay', 802, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(68, 'ខ្សាច់កណ្តាល', 'Khsach Kandal', 803, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(69, 'កោះធំ', 'Kaoh Thum', 804, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(70, 'លើកដែក', 'Leuk Daek', 805, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(71, 'ល្វាឯម', 'Lvea Aem', 806, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(72, 'មុខកំពូល', 'Mukh Kampul', 807, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(73, 'អង្គស្នួល', 'Angk Snuol', 808, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(74, 'ពញាឮ', 'Ponhea Lueu', 809, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(75, 'ស្អាង', 'S\'ang', 810, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(76, 'តាខ្មៅ', 'Ta Khmau', 811, 8, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(77, 'បទុមសាគរ', 'Botum Sakor', 901, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(78, 'គីរីសាគរ', 'Kiri Sakor', 902, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(79, 'កោះកុង', 'Koh Kong', 903, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(80, 'ស្មាច់មានជ័យ', 'Smach Mean Chey', 904, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(81, 'មណ្ឌលសីមា', 'Mondol Seima', 905, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(82, 'ស្រែអំបិល', 'Srae Ambel', 906, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(83, 'ថ្មបាំង', 'Thmo Bang', 907, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(84, 'កំពង់សិលា', 'Kampong Seila', 908, 9, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(85, 'ឆ្លូង​', 'Chhloung', 1001, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(86, 'ក្រចេះ', 'Kratie', 1002, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(87, 'ព្រែកប្រសព្វ', 'Preaek Prasab', 1003, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(88, 'សំបូរ', 'Sambour', 1004, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(89, 'ស្នួល', 'Snuol', 1005, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(90, 'ចិត្របុរី', 'Chet Borei', 1006, 10, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(91, 'ស្រុកកែវសីមា', 'Kaev Seima', 1101, 11, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(92, 'ស្រុកកោះញែក', 'Kaoh Nheaek', 1102, 11, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(93, 'ស្រុកអូររាំង', 'Ou Reang', 1103, 11, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(94, 'ស្រុកពេជ្រាដា', 'Pech Chreada', 1104, 11, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(95, 'សែនមនោរម្យ', 'Senmonorom', 1105, 11, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(96, 'ចំការមន', 'Chamkar Mon', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(97, 'ដូនពេញ', 'Doun Penh', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(98, '៧មករា', '7 Meakkakra', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(99, 'ទួលគោក', 'Tuol Kouk', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(100, 'ដង្កោ', 'Dangkao', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(101, 'មានជ័យ', 'Mean Chey', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(102, 'ឫស្សីកែវ', 'Russey Keo', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(103, 'សែនសុខ', 'Sen Sok', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(104, 'ពោធិ៍សែនជ័យ', 'Pur SenChey', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(105, 'ជ្រោយចង្វារ', 'Chraoy Chongvar', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(106, 'ព្រែកព្នៅ', 'Praek Pnov', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(107, 'ច្បារអំពៅ', 'Chbar Ampov', 0, 12, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(108, 'ជ័យសែន', 'Chey Saen', 1301, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(109, 'ឆែប', 'Chhaeb', 1302, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(110, 'ជាំក្សាន្ត', 'Choam Khsant', 1303, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(111, 'គូលែន', 'Kuleaen', 1304, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(112, 'វៀង', 'Rovieng', 1305, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(113, 'សង្គមថ្មី', 'Sangkom Thmei', 1306, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(114, 'ត្បែងមានជ័យ', 'Tbaeng Mean chey', 1307, 13, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(115, 'ព្រៃវែង​', 'Prey Veng', 1401, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(116, 'កំចាយមារ​', 'Kamchay Mea', 1402, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(117, 'កំពង់ត្របែក', 'Kampong Trobek', 1403, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(118, 'កញ្ច្រៀច​', 'Kachreach', 1404, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(119, 'មេសាង​', 'Mesang', 1405, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(120, 'ពាមជរ​', 'Peamchor', 1406, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(121, 'ពាមរ​', 'Peamr', 1407, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(122, 'ពារាំង​', 'Peareang', 1408, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(123, 'ព្រះស្ដេច​', 'Prehsdach', 1409, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(124, 'ស្វាយអន្ទរ​', 'Svay Ontor', 1410, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(125, 'បាភ្នំ​', 'Baphnum', 1411, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(126, 'ស៊ីធរកណ្ដាល​', 'Sithor Kandal', 1412, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(127, 'កំពង់លាវ', 'Kampong Leav', 1413, 14, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(128, 'បាកាន', 'Bakan', 1501, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(129, 'កណ្តៀង', 'Kandeang', 1502, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(130, 'ក្រគរ', 'Krokor', 1503, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(131, 'ភ្នំក្រវាញ', 'Phnum Kravanh', 1504, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(132, 'ពោធិ៍សាត់', 'Pursat', 1505, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(133, 'វាលវែង', 'Veal Veaeng', 1506, 15, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(134, 'អណ្តូងមាស​', 'Andoung Meas', 1601, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(135, 'បានលុង', 'Ban Lung', 1602, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(136, 'បរកែវ', 'Bar Kaev', 1603, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(137, 'កូនមុំ', 'Koun Mom', 1604, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(138, 'លំផាត់', 'Lumphat', 1605, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(139, 'អូរជុំ', 'Ou Chum', 1606, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(140, 'អូរយ៉ាដាវ', 'Ou Ya Dav', 1607, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(141, 'តាវែង', 'Ta Veaeng', 1608, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(142, 'វើនសៃ', 'Veun Sai', 1609, 16, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(143, 'អង្គរជុំ', 'Angkor Chum', 1701, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(144, 'អង្គរធំ', 'Angkor Thum', 1702, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(145, 'បន្ទាយស្រី', 'Banteay Srei', 1703, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(146, 'ជីក្រែង', 'Chi Kraeng', 1704, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(147, 'ក្រឡាញ់', 'Kralanh', 1706, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(148, 'ពួក', 'Puok', 1707, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(149, 'ប្រាសាទបាគង', 'Prasat Bakong', 1709, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(150, 'សៀមរាប', 'Siem Reab', 1710, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(151, 'សូទ្រនិគម', 'Soutr Nikom', 1711, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(152, 'ស្រីស្នំ', 'Srei Snam', 1712, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(153, 'ស្វាយលើ', 'Svay Leu', 1713, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(154, 'វ៉ារិន', 'Varin', 1714, 17, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(155, 'មិត្តភាព', 'Mittakpheap', 1801, 18, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(156, 'ព្រៃនប់', 'Prey Nob', 1802, 18, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(157, 'ស្ទឹងហាវ', 'Stueng Hav', 1803, 18, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(158, 'កំពង់សីលា', 'Kampong Seila', 1804, 18, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(159, 'សេសាន', 'Sesan', 1901, 19, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(160, 'សៀមបូក', 'Siem Bouk', 1902, 19, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(161, 'សៀមប៉ាង', 'Siem Pang', 1903, 19, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(162, 'ស្ទឹងត្រែង', 'Stueng Traeng', 1904, 19, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(163, 'ថាឡាបរិវ៉ាត់', 'Thala Barivat', 1905, 19, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(164, 'ចន្រ្ទា​', 'Chanthrea', 2001, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(165, 'កំពង់រោទិ៍', 'Kampong Rou', 2002, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(166, 'រំដួល', 'Romdoul', 2003, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(167, 'រមាសហែក', 'Romeas Haek', 2004, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(168, 'ស្វាយជ្រំ', 'Svay Chrom', 2005, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(169, 'ស្វាយរៀង', 'Svay Rieng', 2006, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(170, 'ស្វាយទាប', 'Svay Theab', 2007, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(171, 'បាវិត', 'Bavet', 2008, 20, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(172, 'អង្គរបូរី​', 'Angkor Borei', 2101, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(173, 'បាទី', 'Bati', 2102, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(174, 'បូរីជលសារ', 'Borei Cholsar', 2103, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(175, 'គិរីវង់', 'Kiri Vong', 2104, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(176, 'កោះអណ្តែត', 'Kaoh Andaet', 2105, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(177, 'ព្រៃកប្បាស', 'Prey Kabbas', 2106, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(178, 'សំរោង', 'Samraong', 2107, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(179, 'ដូនកែវ', 'Doun Kaev', 2108, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(180, 'ត្រាំកក់', 'Tram Kak', 2109, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(181, 'ទ្រាំង', 'Treang', 2110, 21, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(182, 'ដំណាក់ចង្អើរ', 'Damnak Chang\'aeur', 2201, 23, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(183, 'កែប', 'Kep', 2202, 23, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(184, 'ប៉ៃលិន​', 'Pailin', 2301, 24, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(185, 'សាលា​​ក្រៅ', 'Salakrao', 2302, 24, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(186, 'អន្លង់វែង', 'Anlong Veng', 2201, 22, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(187, 'បន្ទាយអំពិល', 'Banteay Ampil', 2202, 22, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(188, 'ចុងកាល់', 'Chong Kal', 2203, 22, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(189, 'សំរោង', 'Samraong', 2204, 22, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(190, 'ត្រពាំងប្រាសាទ', 'Trapeang Prasat', 2205, 22, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(191, 'ដំបែ', 'Dambe', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(192, 'ក្រូចឆ្មារ', 'Krochhma', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(193, 'មេមត់', 'Memut', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(194, 'អូររាំងឪ', 'Orangov', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(195, 'ពញាក្រែក', 'Punhea Krek', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(196, 'ត្បូងឃ្មុំ', 'Tboung Khmum', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00'),
(197, 'សួង', 'Soung', 0, 25, '2018-12-07 05:12:50', '0000-00-00 00:00:00');

INSERT INTO `mainservices` (`id`, `ms_name`, `ms_description`, `created_at`, `updated_at`) VALUES
(1, 'MoC', 'ក្រសួងពាណិជ្ជកម្ម', '2018-09-17 21:09:26', '2018-09-28 18:28:32'),
(2, 'GDT', 'អគ្គនាយកដ្ឋានពន្ធដារ', '2018-09-17 21:09:26', '2018-09-28 18:28:48'),
(3, 'MoC and GDT', 'Service Package', '2018-09-24 23:25:41', '2018-09-28 18:26:42'),
(4, 'MoEF', '', '2018-09-26 01:12:59', '2018-09-28 18:27:37'),
(5, 'MoLM', '', '2018-09-28 18:28:04', '2018-09-28 18:28:04'),
(6, 'MoLVT', '', '2018-09-28 18:29:15', '2018-09-28 18:29:15'),
(7, 'MoPT', '', '2018-09-28 18:29:37', '2018-09-28 18:29:37'),
(8, 'MoH', '', '2018-09-28 18:29:51', '2018-09-28 18:29:51'),
(9, 'MoHI', 'សិប្បកម្ម និង ឧស្សាហកម្ម', '2018-09-28 18:30:33', '2018-09-28 18:30:33'),
(10, 'MoT', 'Tourist', '2018-10-31 04:13:53', '2018-10-31 04:13:53');

INSERT INTO `services` (`id`, `s_name`, `s_price`, `s_description`, `s_alert`, `s_ms_id`, `s_created_by`, `s_updated_by`, `created_at`, `updated_at`) VALUES
(12, 'Company Reserve Name', 50, '', 0, 1, 5, 5, '2018-09-28 18:32:08', '2018-09-28 18:32:08'),
(13, 'Register proprietorship only at MoC', 400, '', 0, 1, 5, 5, '2018-09-28 18:50:56', '2018-09-28 18:50:56'),
(14, 'Register new company co.,ltd only MoC', 750, '', 0, 1, 5, 5, '2018-09-28 18:59:43', '2018-09-28 18:59:43'),
(15, 'Re-register existing company via online system', 100, '', 0, 1, 5, 5, '2018-09-28 19:05:29', '2018-09-28 19:05:29'),
(16, 'Submit company annual declaration at MoC', 50, '', 0, 1, 5, 5, '2018-09-28 19:09:39', '2018-09-28 19:09:39'),
(17, 'Renew Validity of DoC certificate', 180, '', 0, 1, 5, 5, '2018-09-28 19:16:08', '2018-09-28 19:16:08'),
(18, 'Register TM for local address', 430, '', 0, 1, 5, 5, '2018-09-28 19:35:23', '2018-09-28 19:35:23'),
(19, 'Register TM for oversea address', 530, '', 0, 1, 5, 5, '2018-09-28 19:36:20', '2018-09-28 19:36:20'),
(20, 'Register TM transfer to new owner', 530, '', 0, 1, 5, 5, '2018-09-28 19:42:00', '2018-09-28 19:42:00'),
(21, 'Register exclusive right for max 2 year', 550, '', 0, 1, 5, 5, '2018-09-28 19:42:47', '2018-09-28 19:42:47'),
(22, 'Register new company small tax payer per package', 800, '', 0, 3, 5, 5, '2018-09-28 19:50:19', '2018-09-28 19:50:19'),
(23, 'Register new company medium tax payer per package', 1700, '', 0, 3, 5, 5, '2018-09-28 19:52:21', '2018-09-28 19:59:00'),
(24, 'Register new company big tax payer per package', 2150, '', 0, 3, 5, 5, '2018-09-28 19:58:23', '2018-09-28 19:59:14'),
(25, 'Change company address different tax branch', 1200, '', 0, 3, 5, 5, '2018-09-28 20:02:18', '2018-09-28 20:02:18'),
(26, 'Changing company address withing tax branch', 850, '', 0, 3, 5, 5, '2018-09-28 20:03:53', '2018-09-29 04:56:59'),
(27, 'Company capital top up both MoC and GDT', 700, '', 0, 3, 5, 5, '2018-09-29 05:00:29', '2018-09-29 06:12:22'),
(28, 'Change Company Name both MoC and GDT', 850, '', 0, 3, 5, 5, '2018-09-29 05:02:12', '2018-09-29 06:13:34'),
(29, 'Change or Adding Business objective both MoC and GDT', 1000, '', 0, 3, 5, 5, '2018-09-29 05:04:16', '2018-09-29 06:14:23'),
(30, 'Chage President ( chief company) both MoC and GDT', 1200, '', 0, 3, 5, 5, '2018-09-29 05:07:31', '2018-09-29 06:15:48'),
(31, 'Delite Company both MoC and GDT', 3000, '', 0, 3, 5, 5, '2018-09-29 05:10:50', '2018-09-29 06:16:51'),
(32, 'Create Company branch within Tax branch or warehouse include medium patent', 700, '', 0, 3, 5, 5, '2018-09-29 05:13:23', '2018-09-29 06:23:08'),
(33, 'Create Company branch difference Tax branch or warehouse include medium patent', 1000, '', 0, 3, 5, 5, '2018-09-29 06:26:58', '2018-09-29 06:26:58'),
(34, 'Change shareholder both MoC and GDT', 1200, 'not include stamp tax duty', 0, 3, 5, 5, '2018-09-29 06:36:39', '2018-09-29 06:36:39'),
(35, 'Construction license T3 with our engineering', 3000, 'with 03 Engineering from us', 0, 5, 5, 5, '2018-09-29 06:41:27', '2018-09-29 06:41:27'),
(36, 'Change Construction license from T3 to T2', 7500, '', 0, 5, 5, 5, '2018-09-29 06:43:22', '2018-09-29 06:43:22'),
(37, 'License for Property agent', 2000, '', 0, 4, 5, 5, '2018-09-29 06:46:22', '2018-09-29 06:46:22'),
(38, 'License for Property evaluation agent', 2000, '', 0, 4, 5, 5, '2018-09-29 06:47:54', '2018-09-29 06:47:54'),
(39, 'License for property management agent', 2000, '', 0, 4, 5, 5, '2018-09-29 06:49:25', '2018-09-29 06:49:25'),
(40, 'Renew license for property agent', 1500, '', 0, 4, 5, 5, '2018-09-29 06:51:01', '2018-09-29 06:51:01'),
(41, 'Renew license for property evaluation agent', 1500, '', 0, 4, 5, 5, '2018-09-29 06:55:05', '2018-09-29 06:55:05'),
(42, 'Renew license for property management agent', 1500, '', 0, 4, 5, 5, '2018-09-29 06:56:14', '2018-09-29 06:56:14'),
(43, 'License for pawn (mobile asset)', 3000, '', 0, 4, 5, 5, '2018-09-29 06:58:30', '2018-09-29 06:58:30'),
(44, 'License for Pawn Company ( property)', 3000, '', 0, 4, 5, 5, '2018-09-29 06:59:27', '2018-09-29 06:59:27'),
(45, 'Register company with department or Ministry 1st', 200, '', 0, 6, 5, 5, '2018-09-29 07:04:54', '2018-09-29 07:04:54'),
(46, 'quota normal staff 1 expatriate via 10 locals', 105, '', 0, 6, 5, 5, '2018-09-29 07:06:51', '2018-09-29 07:06:51'),
(47, 'Over quota 1 person ( 3rd)', 65, '', 0, 6, 5, 5, '2018-09-29 07:07:35', '2018-09-29 07:07:35'),
(48, 'Expatriate work permit include medical check up', 275, '', 0, 6, 5, 5, '2018-09-29 07:09:21', '2018-09-29 07:09:21'),
(49, 'Penalty work permit per one year', 100, '', 0, 6, 5, 5, '2018-09-29 07:10:11', '2018-09-29 07:10:11'),
(50, 'Register work permit all process', 580, '', 0, 6, 5, 5, '2018-09-29 07:11:36', '2018-09-29 07:11:36'),
(51, 'Register new patent small tax payer', 400, '', 0, 2, 5, 5, '2018-09-29 07:13:15', '2018-09-29 07:13:15'),
(52, 'Register new patent medium tax payer', 950, 'បុត្រសម្ពន្ធ័ ឬ ការិយាល័យតំណាង', 0, 2, 5, 5, '2018-09-29 07:15:38', '2018-09-29 07:15:38'),
(53, 'Register new patent big tax payer', 1400, '', 0, 2, 5, 5, '2018-09-29 07:17:47', '2018-09-29 07:17:47'),
(54, 'Renew patent for small tax payer', 180, '', 0, 2, 5, 5, '2018-09-29 07:21:03', '2018-09-29 07:21:03'),
(55, 'Renew patent for medium tax payer', 380, '', 0, 2, 5, 5, '2018-09-29 07:23:04', '2018-09-29 07:23:04'),
(56, 'Renew patent for large tax payer L2', 1330, '', 0, 2, 5, 5, '2018-09-29 07:24:18', '2018-09-29 07:24:18'),
(57, 'Register patent large tax payer L1', 1330, '', 0, 2, 5, 5, '2018-09-29 07:30:40', '2018-10-31 02:30:39'),
(58, 'Monthly declaration for small tax payer in AV less 50 transaction', 50, NULL, 0, 2, 5, 5, '2018-09-29 07:34:50', '2018-12-17 07:43:20'),
(59, '** Monthly declaration for small tax payer in AV. 100 transaction', 100, '', 0, 2, 5, 5, '2018-09-29 07:37:01', '2018-10-31 05:16:56'),
(60, 'Monthly declaration for medium tax payer no transaction', 50, NULL, 0, 2, 5, 5, '2018-09-29 07:40:03', '2018-12-17 07:43:14'),
(61, '* Monthly declaration for medium tax payer in AV. 100 transaction', 100, '', 0, 2, 5, 5, '2018-09-29 07:42:30', '2018-10-31 05:17:16'),
(62, 'Monthly declaration for medium tax payer in AV. 200 transaction', 150, NULL, 0, 2, 5, 5, '2018-09-29 07:43:55', '2018-12-17 07:42:47'),
(63, 'Monthly declaration for medium tax payer in AV. 300 transaction', 200, NULL, 0, 2, 5, 5, '2018-09-29 07:44:58', '2018-12-17 07:42:53'),
(64, 'Monthly declaration for medium tax payer in AV. 400 transaction', 250, NULL, 0, 2, 5, 5, '2018-09-29 07:45:58', '2018-12-17 07:43:01'),
(65, 'Monthly declaration for medium tax payer in AV. 500 transaction', 300, NULL, 0, 2, 5, 5, '2018-09-29 07:46:49', '2018-12-17 07:43:08'),
(66, 'Monthly bookkeeping for no transaction', 50, '', 0, 2, 5, 5, '2018-09-29 07:50:03', '2018-09-29 07:50:03'),
(67, 'Monthly bookkeeping for with AV. 100 transaction', 100, '', 0, 2, 5, 5, '2018-09-29 07:51:33', '2018-09-29 07:51:33'),
(68, 'Monthly bookkeeping for with AV. 200 transaction', 150, '', 0, 2, 5, 5, '2018-09-29 07:52:28', '2018-09-29 07:52:28'),
(69, 'Monthly bookkeeping for with AV. 300 transaction', 200, '', 0, 2, 5, 5, '2018-09-29 07:53:42', '2018-09-29 07:53:42'),
(70, 'Monthly bookkeeping for with AV. 400 transaction', 250, '', 0, 2, 5, 5, '2018-09-29 07:54:26', '2018-09-29 07:54:26'),
(71, 'Monthly bookkeeping for with AV. 500 transaction', 300, '', 0, 2, 5, 5, '2018-09-29 07:55:07', '2018-09-29 07:55:07'),
(72, 'ToP for transaction in AV. less then 100', 250, '', 0, 2, 5, 5, '2018-09-29 07:56:48', '2018-09-29 07:56:48'),
(73, 'ToP for transaction in AV. from 100 to 200', 300, '', 0, 2, 5, 5, '2018-09-29 07:58:07', '2018-09-29 07:58:07'),
(74, 'ToP for transaction in AV. from 200 to 300', 350, '', 0, 2, 5, 5, '2018-09-29 07:59:01', '2018-09-29 07:59:01'),
(75, 'ToP for transaction in AV. less 500', 400, '', 0, 2, 5, 5, '2018-09-29 07:59:48', '2018-09-29 07:59:48'),
(76, 'License for transportation', 940, '', 0, 7, 5, 5, '2018-09-29 08:05:05', '2018-09-29 08:05:05'),
(77, 'Renew license transportation', 750, '', 0, 7, 5, 5, '2018-09-29 08:06:03', '2018-09-29 08:06:03'),
(78, 'Add new patent medium tax payer', 450, '', 0, 2, 5, 5, '2018-09-29 08:42:19', '2018-09-29 08:42:19'),
(79, 'Register Medicine company', 2000, '', 0, 8, 5, 5, '2018-10-31 03:07:09', '2018-10-31 03:07:09'),
(80, 'Register cosmetic company to MOH', 1500, 'no need pharmacist representative', 0, 8, 5, 5, '2018-10-31 03:23:27', '2018-10-31 03:23:27'),
(81, 'Register Factory with MoH', 2000, 'valid for 5 years', 0, 8, 5, 5, '2018-10-31 03:24:48', '2018-10-31 03:24:48'),
(82, 'Register medicine with 1 formula', 1200, 'valid for 5 years', 0, 8, 5, 5, '2018-10-31 03:26:00', '2018-10-31 03:26:00'),
(83, 'Register cosmetic product with moh ', 200, 'valid for 5 years', 0, 8, 5, 5, '2018-10-31 03:28:53', '2018-10-31 03:28:53'),
(85, 'Register license for hotel under 100 rooms', 1500, '', 0, 10, 5, 5, '2018-10-31 04:17:34', '2018-10-31 04:17:34'),
(86, 'Register license for ticketing', 0, '', 0, 10, 5, 5, '2018-10-31 04:19:43', '2018-10-31 04:19:43'),
(87, 'License tour in burn', 0, '', 0, 10, 5, 5, '2018-10-31 04:20:45', '2018-10-31 04:20:45'),
(88, 'License tour out burn', 0, '', 0, 10, 5, 5, '2018-10-31 04:22:01', '2018-10-31 04:22:01'),
(89, 'License for restaurant', 0, '', 0, 10, 5, 5, '2018-10-31 04:23:20', '2018-10-31 04:23:20'),
(90, 'License massage and spar', 0, '', 0, 10, 5, 5, '2018-10-31 04:24:29', '2018-10-31 04:24:29'),
(91, 'Prepare document for auditing', 500, '', 0, 2, 5, 5, '2018-10-31 04:46:30', '2018-10-31 04:46:30'),
(92, 'Representative of the owner for technical deal with auditor ', 250, '', 0, 2, 5, 5, '2018-10-31 04:48:02', '2018-10-31 04:48:02'),
(93, 'Others', 0, '', 0, 1, 5, 5, '2018-10-31 05:01:30', '2018-10-31 05:01:30'),
(94, 'Change shareholder', 750, 'need to confirm', 0, 3, 5, 5, '2018-10-31 05:28:12', '2018-10-31 05:28:12');

INSERT INTO `objectives` (`id`, `obj_name`, `obj_description`, `obj_created_by`, `obj_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'អាហរ័ណ នីហរ័ណ (ថ្នាំពេទ្យ)', 'អាហរ័ណ នីហរ័ណ (ថ្នាំពេទ្យ)', 5, 5, '2018-12-17 07:46:29', '2018-12-17 07:46:29'),
(2, 'អាហរ័ណ នីហរ័ណ (ឱសថ និងបរិក្ខាពេទ្យ)', 'អាហរ័ណ នីហរ័ណ (ឱសថ និងបរិក្ខាពេទ្យ)', 5, 5, '2018-12-17 07:51:56', '2018-12-17 07:51:56'),
(3, 'Unkown', 'Unkown', 5, 5, '2018-12-18 02:08:16', '2018-12-18 02:08:16');

INSERT INTO `companies` (`id`, `com_name`, `com_phone`, `com_email`, `com_tax_size`, `com_vat_id`, `com_logo`, `com_description`, `com_cus_status`, `com_addr_map`, `com_addr_house`, `com_addr_street`, `com_addr_group`, `com_addr_village`, `com_addr_commune`, `com_cp_name`, `com_cp_phone`, `com_cp_email`, `com_cp_gender`, `com_cp_description`, `com_district_id`, `com_province_id`, `com_objective_id`, `com_created_by`, `com_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Unkown', NULL, NULL, 2, NULL, 'default_company.png', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Unkown', '0', NULL, 1, NULL, 96, 12, 3, 5, 5, '2018-12-18 02:09:31', '2018-12-18 02:09:31'),
(2, 'ដេលី ឡាយសាយអិនស៍', '012 235 537', NULL, 2, 'K009-103015175', 'default_company.png', NULL, '0', NULL, '៨A', '៣៧១', NULL, 'ត្រពាំងឈូក', 'ទឹកថ្លា', 'Ms. Daily life', '012 235 537', 'dailylife@gmail.com', 2, NULL, 103, 12, 2, 5, 5, '2018-12-17 07:54:53', '2018-12-17 07:54:53'),
(3, 'ឌីអ.ទាប ពុយ ហ្វាម៉ា', '012 227 177', 'tp_pharma@yahoo.com', 2, 'K007-109006038', 'default_company.png', NULL, '0', NULL, '០៨A', 'លំ(៣៩៦)', NULL, '០២', 'ស្ទឹងមានជ័យ', 'Mr. Teppuy', '012 227 177', 'tp_pharma@yahoo.com', 1, NULL, 101, 12, 1, 5, 5, '2018-12-17 07:50:32', '2018-12-17 07:50:32');