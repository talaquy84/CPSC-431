

CREATE TABLE IF NOT EXISTS `mst_question` (
  `que_id` int(5) NOT NULL,
  `que_desc` varchar(150) DEFAULT NULL,
  `ans1` varchar(75) DEFAULT NULL,
  `ans2` varchar(75) DEFAULT NULL,
  `ans3` varchar(75) DEFAULT NULL,
  `ans4` varchar(75) DEFAULT NULL,
  `true_ans` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
