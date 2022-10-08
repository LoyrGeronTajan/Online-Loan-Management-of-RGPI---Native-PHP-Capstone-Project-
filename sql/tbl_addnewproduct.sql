CREATE TABLE `addnewproduct`(
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` LONGBLOB NOT NULL,
  `productPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `addnewproduct`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `addnewproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;




