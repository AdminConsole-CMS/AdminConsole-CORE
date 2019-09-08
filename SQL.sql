
DROP TABLE IF EXISTS `ac_core_post_setup`;
CREATE TABLE IF NOT EXISTS `ac_core_post_setup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(256) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_type` varchar(256) NOT NULL,
  `inherit` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `ac_core_post_setup` (`ID`, `post_title`, `post_content`, `post_type`, `inherit`, `post_date`) VALUES
(1, 'Home', 'This is Homepage!', 'page', 0, 'CURRENT_TIMESTAMP'),
(2, 'Post', 'This is Post!', 'post', 1, 'CURRENT_TIMESTAMP');
COMMIT;