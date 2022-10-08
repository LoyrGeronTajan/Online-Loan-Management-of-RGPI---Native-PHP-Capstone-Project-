
CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255)NOT NULL,
  `userImage` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

-- INSERT INTO `usertype` (`id`, `role`, `username`, `password`, `name`,`email`) VALUES
-- (1, 'admin', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Operations Manager','Operations@gmail.com'),
-- (2, 'user', 'KAE', 'e2fc714c4727ee9395f324cd2e7f331f', 'Key Account Executive','Executive@gmail.com');
INSERT INTO usertype (id, role, username, password, name,email, userImage) VALUES
(1, 'admin', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Operations Manager','Operations@gmail.com',LOAD_FILE('../assets/img/employee/bryan.png')),
(2, 'user', 'KAE', 'e2fc714c4727ee9395f324cd2e7f331f', 'Key Account Executive','Executive@gmail.com',LOAD_FILE('../assets/img/employee/phenalone.png'));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

