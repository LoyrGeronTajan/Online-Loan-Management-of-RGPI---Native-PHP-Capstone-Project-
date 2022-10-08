CREATE TABLE `invoice` (
  `invoiceId` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'notpaid',
   `dateAssigned` date NULL,
   `archive` varchar(255) DEFAULT 'NO',
   `datePaid` date NOT NULL,
  `kaeName` varchar(255) NOT NULL,
  `invoiceNo` varchar(255) NOT NULL,
  `invoiceUsername` varchar(255) NOT NULL,
  `invoiceCompany` varchar(255) NOT NULL,
  `dateDelivered` date NULL,
  `dueDate` date NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceId`);


ALTER TABLE `invoice`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT;



