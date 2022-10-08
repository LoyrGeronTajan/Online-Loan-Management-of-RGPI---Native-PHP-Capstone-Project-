CREATE TABLE `tbl_newcommer` (
  `newcommer_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'pending', 
  `newcommer_email` varchar(255) NOT NULL,
  `newcommer_company` varchar(255) NOT NULL,
  `newcommer_businessPermit` LONGBLOB NOT NULL,
  `newcommer_address` varchar(255) NOT NULL,
  `newcommer_contact` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_newcommer`
  ADD PRIMARY KEY (`newcommer_id`);


ALTER TABLE `tbl_newcommer`
  MODIFY `newcommer_id` int(11) NOT NULL AUTO_INCREMENT;





