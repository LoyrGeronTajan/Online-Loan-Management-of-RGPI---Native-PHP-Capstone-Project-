CREATE TABLE `cartorder` (
  `id` int(11) NOT NULL,
   `invoiceNo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` tinyint(11) DEFAULT '1',
  `archive` varchar(255) DEFAULT 'NO',
  `order_productname` varchar(255) NOT NULL,
  `order_productqty` varchar(255) NOT NULL,
  `vat` int(11) DEFAULT '12',
  `order_productprice` varchar(255) NOT NULL,
  `productTotal` float NOT NULL,
  `create_date` date NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `cartorder`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cartorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



