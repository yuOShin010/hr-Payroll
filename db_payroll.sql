-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2022 at 08:22 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_payroll`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_EMPLOYEE_SCHEDULE` (`pTYPE` INT, `pEMPLOYEE_ID` VARCHAR(10), `pDATE_FROM` DATE, `pDATE_TO` DATE, `pSUN` BOOLEAN, `pMON` BOOLEAN, `pTUE` BOOLEAN, `pWED` BOOLEAN, `pTHU` BOOLEAN, `pFRI` BOOLEAN, `pSAT` BOOLEAN, `pSUN_TIME_IN` TIME, `pSUN_TIME_OUT` TIME, `pMON_TIME_IN` TIME, `pMON_TIME_OUT` TIME, `pTUE_TIME_IN` TIME, `pTUE_TIME_OUT` TIME, `pWED_TIME_IN` TIME, `pWED_TIME_OUT` TIME, `pTHU_TIME_IN` TIME, `pTHU_TIME_OUT` TIME, `pFRI_TIME_IN` TIME, `pFRI_TIME_OUT` TIME, `pSAT_TIME_IN` TIME, `pSAT_TIME_OUT` TIME)  BEGIN
	
	-- pTYPE 1 IF WEEKLY, 2 IF HALF MONTH
	DECLARE vCURDATE DATE DEFAULT CURDATE();
	DECLARE vCURDAY VARCHAR(3) DEFAULT '';
	DECLARE vTIME_FROM TIME;
	DECLARE vTIME_TO TIME;
	DECLARE isASSIGNED BOOLEAN;
	DECLARE vWORKING_HOURS TIME;
	
	
	SET vCURDATE = pDATE_FROM;
	WHILE vCURDATE <= pDATE_TO DO
		
		SET vCURDAY = DAYNAME(vCURDATE);
		SET vCURDAY = UPPER(vCURDAY);
		
		CASE vCURDAY
			WHEN 'SUN' THEN SET vTIME_FROM = pSUN_TIME_IN; SET vTIME_TO = pSUN_TIME_OUT; SET isASSIGNED = pSUN; 
			WHEN 'MON' THEN SET vTIME_FROM = pMON_TIME_IN; SET vTIME_TO = pMON_TIME_OUT; SET isASSIGNED = pMON;
			WHEN 'TUE' THEN SET vTIME_FROM = pTUE_TIME_IN; SET vTIME_TO = pTUE_TIME_OUT; SET isASSIGNED = pTUE;
			WHEN 'WED' THEN SET vTIME_FROM = pWED_TIME_IN; SET vTIME_TO = pWED_TIME_OUT; SET isASSIGNED = pWED;
			WHEN 'THU' THEN SET vTIME_FROM = pTHU_TIME_IN; SET vTIME_TO = pTHU_TIME_OUT; SET isASSIGNED = pTHU;
			WHEN 'FRI' THEN SET vTIME_FROM = pFRI_TIME_IN; SET vTIME_TO = pFRI_TIME_OUT; SET isASSIGNED = pFRI;
			WHEN 'SAT' THEN SET vTIME_FROM = pSAT_TIME_IN; SET vTIME_TO = pSAT_TIME_OUT; SET isASSIGNED = pSAT;
			
		END CASE;
		REPLACE INTO tbl_employee_schedule1 (EMPLOYEE_ID, EMPLOYEE_DATE,TIMEFROMS, TIMETOS ,WORKING_HOURS,  ASSIGNED) VALUES 
		(pEMPLOYEE_ID, vCURDATE, vTIME_FROM, vTIME_TO, GET_HOURS(vTIME_FROM, vTIME_TO), isASSIGNED)
		
		;
		
	
		
		
		
		SET vCURDATE = DATE_ADD(vCURDATE, INTERVAL 1 DAY);
	END WHILE;
	
	
	-- comment this 
	-- SELECT * FROM TBL_EMPLOYEE_SCHEDULE;
	
	
	
    END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GET_HOURS` (`pTIME_FROM` TIME, `pTIME_TO` TIME) RETURNS DOUBLE(2,2) BEGIN
    
    DECLARE vTIME_HR INT DEFAULT 0;
    DECLARE vTIME_MINUTE DOUBLE DEFAULT 0.00;
    DECLARE vTOTAL_HR DOUBLE DEFAULT 0.00;
    DECLARE vSTR_TIME_DIFF VARCHAR(5) DEFAULT '';
    
    IF pTIME_TO < pTIME_FROM THEN
		SET pTIME_TO = ADDTIME(pTIME_TO,'24:00');
    END IF;
       
    
    SET vSTR_TIME_DIFF = REPLACE(TIMEDIFF(pTIME_TO, pTIME_FROM),':','');
    
    SET vTIME_HR = SUBSTRING(vSTR_TIME_DIFF,1,2) ;
    SET vTIME_MINUTE = SUBSTRING(vSTR_TIME_DIFF,3,2) / 60;
    SET vTOTAL_HR =   vTIME_HR + vTIME_MINUTE;
    
    IF vTOTAL_HR > 5 THEN
		SET vTOTAL_HR = vTOTAL_HR -1;
    END IF;
    RETURN vTOTAL_HR;
	
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `deduction_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sss` int(7) NOT NULL,
  `tax` int(7) NOT NULL,
  `pag_ibig` int(7) NOT NULL,
  `phil_health` int(7) NOT NULL,
  `sss_loan` int(7) NOT NULL,
  `pag_ibig_loan` int(7) NOT NULL,
  `phil_health_loan` int(7) NOT NULL,
  `others` int(7) NOT NULL,
  `total_deductions` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(10) UNSIGNED NOT NULL,
  `dept_code` varchar(30) NOT NULL,
  `dept_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_code`, `dept_desc`) VALUES
(1, 'BSIT', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY'),
(2, 'BSOA', 'BACHELOR OF SCIENCE IN OA'),
(3, 'BSED', 'BACHELOR SECONDARY EDUCATION'),
(4, 'BEED', 'BACHELOR ELEMENTARY EDUCATION'),
(5, 'BSCRIM', 'BACHELOR OF SCIENCE IN CRIMINOLOGY'),
(6, 'BSTM', 'BACHELOR OF SCIENCE IN TOURISM MANAGEMENT');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `first_name` varchar(30) NOT NULL,
  `middle_in` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` varchar(3) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `stats` varchar(15) DEFAULT NULL,
  `date_hired` date DEFAULT NULL,
  `user_type_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `isActive`, `first_name`, `middle_in`, `last_name`, `age`, `email`, `password`, `contact`, `gender`, `stats`, `date_hired`, `user_type_id`) VALUES
(1, 1, 'admin', 'admin', 'admin', NULL, 'admin@gmail.com', 'admin', NULL, NULL, NULL, NULL, 1),
(2, 1, 'Jayson', 'balate', 'Garcia', NULL, 'garcia04@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, 2),
(3, 1, 'Cams', 'Ree', 'San Pedro', '20', 'jaysongarcia04@gmail.com', '#Sa8080', '0945687123', 'Female', 'Regular', '2022-06-08', 3),
(4, 1, 'arjay', 'aripal', 'laurito', NULL, 'angelsave020@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, 2),
(5, 1, 'arjay', 'aripal', 'laurito', '23', 'jayjay@gmail.com', '#la8080', '09615955229', 'Male', 'Regular', '2022-06-01', 3);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `add_users` AFTER INSERT ON `employee` FOR EACH ROW BEGIN

	insert into users (employee_id, first_name, middle_name, surname, email_addr, `password`, isActive, user_type) values
	(new.employee_id, new.first_name, new.middle_in, new.last_name, new.email, new.password, '1', new.user_type_id);

    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_users` AFTER UPDATE ON `employee` FOR EACH ROW BEGIN
	
	update users set
	`first_name` = new.first_name , `middle_name` = new.middle_in , `surname` = new.last_name, `email_addr` = new.email WHERE employee_id = new.employee_id
	;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `overtime` float NOT NULL,
  `allowance` float NOT NULL,
  `holidays_work` int(3) NOT NULL,
  `leave_days` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `overtime`, `allowance`, `holidays_work`, `leave_days`) VALUES
(1, 3, 10, 200, 1, 1),
(2, 5, 2, 100, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_desc`) VALUES
(1, 'Dept. Head'),
(2, 'Teacher'),
(3, 'Office Staff'),
(4, 'Secretary'),
(5, 'Utility');

-- --------------------------------------------------------

--
-- Table structure for table `salary_report`
--

CREATE TABLE `salary_report` (
  `salary_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `hours_pay` float NOT NULL,
  `ot_pay` float NOT NULL,
  `holidays_pay` float NOT NULL,
  `leave_days_pay` float NOT NULL,
  `allowance_pay` float NOT NULL,
  `sss` float NOT NULL,
  `tax` float NOT NULL,
  `pag_ibig` float NOT NULL,
  `phil_health` float NOT NULL,
  `others` float NOT NULL,
  `gross_pay` float NOT NULL,
  `total_deductions` float NOT NULL,
  `net_pay` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_report`
--

INSERT INTO `salary_report` (`salary_id`, `employee_id`, `hours_pay`, `ot_pay`, `holidays_pay`, `leave_days_pay`, `allowance_pay`, `sss`, `tax`, `pag_ibig`, `phil_health`, `others`, `gross_pay`, `total_deductions`, `net_pay`) VALUES
(1, 3, 3220, 1390, 960.7, 369.5, 200, 107.81, 15.31, 50, 40.84, 0, 6140.2, 213.97, 5926.23),
(2, 5, 736, 278, 1921.4, 369.5, 100, 59.98, 15.31, 33.05, 22.72, 0, 3404.9, 131.07, 3273.83);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `total_workHrs` int(10) NOT NULL,
  `d_from` date NOT NULL,
  `d_to` date NOT NULL,
  `days_works` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `employee_id`, `total_workHrs`, `d_from`, `d_to`, `days_works`) VALUES
(1, 3, 35, '2022-06-08', '2022-06-16', 9),
(2, 5, 8, '2022-06-01', '2022-06-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_department_position`
--

CREATE TABLE `tbl_employee_department_position` (
  `id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee_department_position`
--

INSERT INTO `tbl_employee_department_position` (`id`, `employee_id`, `dept_id`, `position_id`) VALUES
(1, 3, 5, 3),
(2, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payroll`
--

CREATE TABLE `tbl_employee_payroll` (
  `id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee_payroll`
--

INSERT INTO `tbl_employee_payroll` (`id`, `employee_id`, `dept_id`, `position_id`) VALUES
(1, 3, 5, 3),
(2, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_salary`
--

CREATE TABLE `tbl_employee_salary` (
  `id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee_salary`
--

INSERT INTO `tbl_employee_salary` (`id`, `employee_id`, `dept_id`, `position_id`) VALUES
(1, 3, 5, 3),
(2, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_schedule`
--

CREATE TABLE `tbl_employee_schedule` (
  `id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee_schedule`
--

INSERT INTO `tbl_employee_schedule` (`id`, `employee_id`, `dept_id`, `position_id`) VALUES
(1, 3, 5, 3),
(2, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email_addr` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `user_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `employee_id`, `first_name`, `middle_name`, `surname`, `email_addr`, `password`, `isActive`, `user_type`) VALUES
(1, 1, 'admin', 'admin', 'admin', 'admin@gmail.com', 'admin', 1, '1'),
(2, 2, 'Jayson', 'balate', 'Garcia', 'garcia04@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2'),
(3, 3, 'Cams', 'Ree', 'San Pedro', 'jaysongarcia04@gmail.com', '#Sa8080', 1, '3'),
(4, 4, 'arjay', 'aripal', 'laurito', 'angelsave020@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2'),
(5, 5, 'arjay', 'aripal', 'laurito', 'jayjay@gmail.com', '#la8080', 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(10) NOT NULL,
  `user_type_code` varchar(20) NOT NULL,
  `user_type_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_code`, `user_type_desc`) VALUES
(1, 'Admin', 'Administrator'),
(2, 'HR', 'Human Resource'),
(3, 'Emp', 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`deduction_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_report`
--
ALTER TABLE `salary_report`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `tbl_employee_department_position`
--
ALTER TABLE `tbl_employee_department_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee_schedule`
--
ALTER TABLE `tbl_employee_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_report`
--
ALTER TABLE `salary_report`
  MODIFY `salary_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee_department_position`
--
ALTER TABLE `tbl_employee_department_position`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee_schedule`
--
ALTER TABLE `tbl_employee_schedule`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
