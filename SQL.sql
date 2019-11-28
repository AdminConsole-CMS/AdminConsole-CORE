CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `article_date` datetime NOT NULL,
  `article_date_gmt` datetime NOT NULL,
  `article_title` varchar(256) NOT NULL,
  `article_name` varchar(256) NOT NULL,
  `article_content` longtext NOT NULL,
  `article_type` varchar(256) NOT NULL,
  `article_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `images` (
  `ID` int(11) NOT NULL,
  `image_date` datetime NOT NULL,
  `image_date_gmt` datetime NOT NULL,
  `image_name` mediumtext NOT NULL,
  `image_alt` varchar(256) NOT NULL,
  `image_size` varchar(256) NOT NULL,
  `image_location` varchar(256) NOT NULL,
  `image_mime` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pages` (
  `ID` int(11) NOT NULL,
  `page_date` datetime NOT NULL,
  `page_date_gmt` datetime NOT NULL,
  `page_title` varchar(256) NOT NULL,
  `page_name` varchar(256) NOT NULL,
  `page_content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `pages`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
