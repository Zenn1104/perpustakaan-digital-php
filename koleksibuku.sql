CREATE TABLE `koleksibuku` (
    `koleksi_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `buku_id` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `koleksibuku`
  ADD PRIMARY KEY (`koleksi_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

ALTER TABLE `koleksibuku`
  MODIFY `koleksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `peminjaman`
  ADD CONSTRAINT `koleksibuku_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksibuku_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;