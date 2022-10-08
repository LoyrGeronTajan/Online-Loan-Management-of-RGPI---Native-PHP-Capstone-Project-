CREATE TABLE `brandname` (
  `id` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `brandname` (`id`, `brandname`,`create_date`) VALUES (1, 'BABY CARE', current_timestamp()),
(2, 'FABRIC CARE', current_timestamp()),
(3, 'FAMILY CARE', current_timestamp()),
(4, 'FEMININE CARE', current_timestamp()),
(5, 'GROOMING', current_timestamp()),
(6, 'HARI CARE', current_timestamp()),
(7, 'HOME CARE', current_timestamp()),
(8, 'ORAL CARE', current_timestamp()),
(9, 'PERSONAL HEALTH CARE', current_timestamp()),
(10, 'SKIN AND PERSONAL CARE', current_timestamp());


ALTER TABLE `brandname`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `brandname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



