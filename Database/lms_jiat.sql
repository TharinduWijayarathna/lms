-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lms_jiat
DROP DATABASE IF EXISTS `lms_jiat`;
CREATE DATABASE IF NOT EXISTS `lms_jiat` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lms_jiat`;

-- Dumping structure for table lms_jiat.academic_officers
DROP TABLE IF EXISTS `academic_officers`;
CREATE TABLE IF NOT EXISTS `academic_officers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `registered_on` date DEFAULT NULL,
  `status_id` int NOT NULL,
  `verification_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_academic_officers_status1_idx` (`status_id`),
  KEY `fk_academic_officers_verification1_idx` (`verification_id`),
  KEY `fk_academic_officers_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_academic_officers_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_academic_officers_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_academic_officers_verification1` FOREIGN KEY (`verification_id`) REFERENCES `verification` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.academic_officers: ~1 rows (approximately)
DELETE FROM `academic_officers`;
/*!40000 ALTER TABLE `academic_officers` DISABLE KEYS */;
INSERT INTO `academic_officers` (`id`, `username`, `first_name`, `last_name`, `email`, `gender_id`, `password`, `verification_code`, `registered_on`, `status_id`, `verification_id`) VALUES
	(1, 'Tharindu', 'Wikum', 'Wijayarathna', 'tharinduwijayarathne87@gmail.com', 1, 'Wikum@123', '62af6f5cb3581', '2022-04-25', 1, 1);
/*!40000 ALTER TABLE `academic_officers` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.added_assignment
DROP TABLE IF EXISTS `added_assignment`;
CREATE TABLE IF NOT EXISTS `added_assignment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `teachers_id` int NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `path` varchar(80) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_added_assignment_subject1_idx` (`subject_id`),
  KEY `fk_added_assignment_grade1_idx` (`grade_id`),
  KEY `fk_added_assignment_teachers1_idx` (`teachers_id`),
  CONSTRAINT `fk_added_assignment_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_added_assignment_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_added_assignment_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.added_assignment: ~2 rows (approximately)
DELETE FROM `added_assignment`;
/*!40000 ALTER TABLE `added_assignment` DISABLE KEYS */;
INSERT INTO `added_assignment` (`id`, `subject_id`, `grade_id`, `teachers_id`, `description`, `path`, `start_date`, `last_date`) VALUES
	(7, 1, 1, 6, 'Simple Web Design', '62b3032059e18.pdf', '2022-06-16', '2022-06-21'),
	(8, 2, 1, 6, 'OOPC Concepts Research', '62aa36f933f8a.pdf', '2022-06-16', '2022-06-29'),
	(10, 2, 1, 6, 'Componenets', '62b3024ceda5b.pdf', '2022-06-13', '2022-06-30');
/*!40000 ALTER TABLE `added_assignment` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `admin_password` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_status_idx` (`status_id`),
  KEY `fk_admin_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_admin_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_admin_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.admin: ~1 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `first_name`, `last_name`, `email`, `gender_id`, `verification_code`, `admin_password`, `status_id`) VALUES
	(1, 'admin', 'Tharindu', 'Wijayarathna', 'tharinduwijayarathne87@gmail.com', 1, '62af684e3351b', 'Wikum@123', 1),
	(5, 'admin', 'Dammika ', 'Jason', 'sendmyemailstoyou@gmail.com', 1, NULL, 'Wikum@123', 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.admin_img
DROP TABLE IF EXISTS `admin_img`;
CREATE TABLE IF NOT EXISTS `admin_img` (
  `id` int NOT NULL,
  `admin_id` int NOT NULL,
  `path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_img_admin1_idx` (`admin_id`),
  CONSTRAINT `fk_admin_img_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.admin_img: ~0 rows (approximately)
DELETE FROM `admin_img`;
/*!40000 ALTER TABLE `admin_img` DISABLE KEYS */;
INSERT INTO `admin_img` (`id`, `admin_id`, `path`) VALUES
	(4, 1, '62a8b1ad8c5d3.jpeg');
/*!40000 ALTER TABLE `admin_img` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.assigned_subject
DROP TABLE IF EXISTS `assigned_subject`;
CREATE TABLE IF NOT EXISTS `assigned_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teachers_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assigned_subject_teachers1_idx` (`teachers_id`),
  KEY `fk_assigned_subject_subject1_idx` (`subject_id`),
  KEY `fk_assigned_subject_grade1_idx` (`grade_id`),
  CONSTRAINT `fk_assigned_subject_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_assigned_subject_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_assigned_subject_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.assigned_subject: ~3 rows (approximately)
DELETE FROM `assigned_subject`;
/*!40000 ALTER TABLE `assigned_subject` DISABLE KEYS */;
INSERT INTO `assigned_subject` (`id`, `teachers_id`, `subject_id`, `grade_id`) VALUES
	(6, 6, 1, 1),
	(7, 6, 5, 1),
	(8, 6, 2, 1),
	(9, 6, 8, 6);
/*!40000 ALTER TABLE `assigned_subject` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.gender
DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.gender: ~2 rows (approximately)
DELETE FROM `gender`;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.grade
DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.grade: ~6 rows (approximately)
DELETE FROM `grade`;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` (`id`, `grade`) VALUES
	(1, '1st Year'),
	(2, '2nd Year'),
	(3, '3rd Year'),
	(4, '4th Year'),
	(5, '5th Year'),
	(6, 'Repeat Batch');
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.lesson_notes
DROP TABLE IF EXISTS `lesson_notes`;
CREATE TABLE IF NOT EXISTS `lesson_notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `teachers_id` int NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lesson_notes_subject1_idx` (`subject_id`),
  KEY `fk_lesson_notes_grade1_idx` (`grade_id`),
  KEY `fk_lesson_notes_teachers1_idx` (`teachers_id`),
  CONSTRAINT `fk_lesson_notes_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_lesson_notes_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_lesson_notes_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.lesson_notes: ~1 rows (approximately)
DELETE FROM `lesson_notes`;
/*!40000 ALTER TABLE `lesson_notes` DISABLE KEYS */;
INSERT INTO `lesson_notes` (`id`, `subject_id`, `grade_id`, `teachers_id`, `description`, `path`) VALUES
	(16, 8, 6, 6, 'Research Components', '62b2fc21cf816.pdf');
/*!40000 ALTER TABLE `lesson_notes` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.marks
DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `upload_assignment_id` int NOT NULL,
  `marks` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marks_upload_assignment1_idx` (`upload_assignment_id`),
  CONSTRAINT `fk_marks_upload_assignment1` FOREIGN KEY (`upload_assignment_id`) REFERENCES `upload_assignment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.marks: ~0 rows (approximately)
DELETE FROM `marks`;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.officer_img
DROP TABLE IF EXISTS `officer_img`;
CREATE TABLE IF NOT EXISTS `officer_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `academic_officers_id` int NOT NULL,
  `path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_officer_img_academic_officers1_idx` (`academic_officers_id`),
  CONSTRAINT `fk_officer_img_academic_officers1` FOREIGN KEY (`academic_officers_id`) REFERENCES `academic_officers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.officer_img: ~0 rows (approximately)
DELETE FROM `officer_img`;
/*!40000 ALTER TABLE `officer_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `officer_img` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.officer_viewed_status
DROP TABLE IF EXISTS `officer_viewed_status`;
CREATE TABLE IF NOT EXISTS `officer_viewed_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.officer_viewed_status: ~2 rows (approximately)
DELETE FROM `officer_viewed_status`;
/*!40000 ALTER TABLE `officer_viewed_status` DISABLE KEYS */;
INSERT INTO `officer_viewed_status` (`id`, `status`) VALUES
	(1, 'Checked'),
	(2, 'Not Checked');
/*!40000 ALTER TABLE `officer_viewed_status` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.payment
DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `students_id` int NOT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_students1_idx` (`students_id`),
  CONSTRAINT `fk_payment_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.payment: ~0 rows (approximately)
DELETE FROM `payment`;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.payment_data
DROP TABLE IF EXISTS `payment_data`;
CREATE TABLE IF NOT EXISTS `payment_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `students_id` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_data_students1_idx` (`students_id`),
  CONSTRAINT `fk_payment_data_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.payment_data: ~2 rows (approximately)
DELETE FROM `payment_data`;
/*!40000 ALTER TABLE `payment_data` DISABLE KEYS */;
INSERT INTO `payment_data` (`id`, `students_id`, `date`) VALUES
	(1, 1, '2022-06-15'),
	(2, 1, '2022-06-15');
/*!40000 ALTER TABLE `payment_data` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.status: ~2 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Deactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nic` varchar(12) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `registered_on` date DEFAULT NULL,
  `status_id` int NOT NULL,
  `verification_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `trial_or_paid_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_academic_officers_status1_idx` (`status_id`),
  KEY `fk_academic_officers_verification1_idx` (`verification_id`),
  KEY `fk_academic_officers_gender1_idx` (`gender_id`),
  KEY `fk_students_grade1_idx` (`grade_id`),
  KEY `fk_students_trial_or_paid1_idx` (`trial_or_paid_id`),
  CONSTRAINT `fk_academic_officers_gender10` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_academic_officers_status10` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_academic_officers_verification10` FOREIGN KEY (`verification_id`) REFERENCES `verification` (`id`),
  CONSTRAINT `fk_students_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_students_trial_or_paid1` FOREIGN KEY (`trial_or_paid_id`) REFERENCES `trial_or_paid` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.students: ~4 rows (approximately)
DELETE FROM `students`;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `nic`, `first_name`, `last_name`, `email`, `gender_id`, `password`, `verification_code`, `registered_on`, `status_id`, `verification_id`, `grade_id`, `trial_or_paid_id`) VALUES
	(1, '200131913369', 'Wikum', 'Wijayarathna', 'tharinduwi87@gmail.com', 1, 'Wikum@123', '31241241sdas', '2022-04-26', 1, 1, 1, 2),
	(2, '200131903369', 'Tharindu', 'Wijayarathna', 'tharinduwijayarathne87@gmail.com', 1, 'wikum123', '62af6d2704bad', '2022-06-16', 1, 1, 4, 1),
	(3, '200531903323', 'Kasun', 'Wijayarathna', 'ravindukasun2005@gmail.com', 1, 'Kasun123', '62b2db803e93c', '2022-06-22', 1, 2, 1, 1);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.student_img
DROP TABLE IF EXISTS `student_img`;
CREATE TABLE IF NOT EXISTS `student_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `students_id` int NOT NULL,
  `path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_img_students1_idx` (`students_id`),
  CONSTRAINT `fk_student_img_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.student_img: ~0 rows (approximately)
DELETE FROM `student_img`;
/*!40000 ALTER TABLE `student_img` DISABLE KEYS */;
INSERT INTO `student_img` (`id`, `students_id`, `path`) VALUES
	(1, 1, '62a2371f95c59.png');
/*!40000 ALTER TABLE `student_img` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.student_results
DROP TABLE IF EXISTS `student_results`;
CREATE TABLE IF NOT EXISTS `student_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `upload_assignment_id` int NOT NULL,
  `students_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `result` int NOT NULL,
  `officer_viewed_status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_results_students1_idx` (`students_id`),
  KEY `fk_student_results_subject1_idx` (`subject_id`),
  KEY `fk_student_results_grade1_idx` (`grade_id`),
  KEY `fk_student_results_upload_assignment1_idx` (`upload_assignment_id`),
  KEY `fk_student_results_officer_viewed_status1_idx` (`officer_viewed_status_id`),
  CONSTRAINT `fk_student_results_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_student_results_officer_viewed_status1` FOREIGN KEY (`officer_viewed_status_id`) REFERENCES `officer_viewed_status` (`id`),
  CONSTRAINT `fk_student_results_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`),
  CONSTRAINT `fk_student_results_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_student_results_upload_assignment1` FOREIGN KEY (`upload_assignment_id`) REFERENCES `upload_assignment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.student_results: ~2 rows (approximately)
DELETE FROM `student_results`;
/*!40000 ALTER TABLE `student_results` DISABLE KEYS */;
INSERT INTO `student_results` (`id`, `upload_assignment_id`, `students_id`, `subject_id`, `grade_id`, `result`, `officer_viewed_status_id`) VALUES
	(1, 5, 1, 1, 1, 50, 1),
	(2, 6, 1, 2, 1, 70, 1),
	(3, 7, 1, 2, 1, 60, 1);
/*!40000 ALTER TABLE `student_results` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.subject
DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.subject: ~6 rows (approximately)
DELETE FROM `subject`;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` (`id`, `subject`) VALUES
	(1, 'Web Programming'),
	(2, 'OOPC'),
	(3, 'DBMS'),
	(4, 'SAD'),
	(5, 'Robotics'),
	(6, 'Mathematics for CS'),
	(7, 'Android'),
	(8, 'RM');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.teachers
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `registered_on` date DEFAULT NULL,
  `status_id` int NOT NULL,
  `verification_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teachers_status1_idx` (`status_id`),
  KEY `fk_teachers_verification1_idx` (`verification_id`),
  KEY `fk_teachers_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_teachers_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_teachers_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_teachers_verification1` FOREIGN KEY (`verification_id`) REFERENCES `verification` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.teachers: ~1 rows (approximately)
DELETE FROM `teachers`;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` (`id`, `username`, `first_name`, `last_name`, `email`, `gender_id`, `password`, `verification_code`, `registered_on`, `status_id`, `verification_id`) VALUES
	(6, 'sumith', 'Sumith', 'Perera', 'sumithperera@gmail.com', 1, 'sumith@123', '6266d2c8998ea', '2022-04-26', 1, 1);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.teacher_img
DROP TABLE IF EXISTS `teacher_img`;
CREATE TABLE IF NOT EXISTS `teacher_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teachers_id` int NOT NULL,
  `path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_img_teachers1_idx` (`teachers_id`),
  CONSTRAINT `fk_teacher_img_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.teacher_img: ~0 rows (approximately)
DELETE FROM `teacher_img`;
/*!40000 ALTER TABLE `teacher_img` DISABLE KEYS */;
INSERT INTO `teacher_img` (`id`, `teachers_id`, `path`) VALUES
	(1, 6, '62b2fc8587e5e.png');
/*!40000 ALTER TABLE `teacher_img` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.trial_or_paid
DROP TABLE IF EXISTS `trial_or_paid`;
CREATE TABLE IF NOT EXISTS `trial_or_paid` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.trial_or_paid: ~2 rows (approximately)
DELETE FROM `trial_or_paid`;
/*!40000 ALTER TABLE `trial_or_paid` DISABLE KEYS */;
INSERT INTO `trial_or_paid` (`id`, `status`) VALUES
	(1, 'Trial'),
	(2, 'Paid');
/*!40000 ALTER TABLE `trial_or_paid` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.upload_assignment
DROP TABLE IF EXISTS `upload_assignment`;
CREATE TABLE IF NOT EXISTS `upload_assignment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `students_id` int NOT NULL,
  `path` varchar(80) DEFAULT NULL,
  `added_assignment_id` int NOT NULL,
  `viewed_or_not_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_upload_assignment_subject1_idx` (`subject_id`),
  KEY `fk_upload_assignment_grade1_idx` (`grade_id`),
  KEY `fk_upload_assignment_students1_idx` (`students_id`),
  KEY `fk_upload_assignment_added_assignment1_idx` (`added_assignment_id`),
  KEY `fk_upload_assignment_viewed_or_not1_idx` (`viewed_or_not_id`),
  CONSTRAINT `fk_upload_assignment_added_assignment1` FOREIGN KEY (`added_assignment_id`) REFERENCES `added_assignment` (`id`),
  CONSTRAINT `fk_upload_assignment_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_upload_assignment_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`),
  CONSTRAINT `fk_upload_assignment_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_upload_assignment_viewed_or_not1` FOREIGN KEY (`viewed_or_not_id`) REFERENCES `viewed_or_not` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.upload_assignment: ~3 rows (approximately)
DELETE FROM `upload_assignment`;
/*!40000 ALTER TABLE `upload_assignment` DISABLE KEYS */;
INSERT INTO `upload_assignment` (`id`, `subject_id`, `grade_id`, `students_id`, `path`, `added_assignment_id`, `viewed_or_not_id`) VALUES
	(5, 1, 1, 1, '62aa35378a342.pdf', 7, 1),
	(6, 2, 1, 1, '62aa3704f2537.pdf', 8, 1),
	(7, 2, 1, 1, '62b303a46e3c7.pdf', 10, 1);
/*!40000 ALTER TABLE `upload_assignment` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.verification
DROP TABLE IF EXISTS `verification`;
CREATE TABLE IF NOT EXISTS `verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.verification: ~2 rows (approximately)
DELETE FROM `verification`;
/*!40000 ALTER TABLE `verification` DISABLE KEYS */;
INSERT INTO `verification` (`id`, `status`) VALUES
	(1, 'Verified'),
	(2, 'Not Verified');
/*!40000 ALTER TABLE `verification` ENABLE KEYS */;

-- Dumping structure for table lms_jiat.viewed_or_not
DROP TABLE IF EXISTS `viewed_or_not`;
CREATE TABLE IF NOT EXISTS `viewed_or_not` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table lms_jiat.viewed_or_not: ~2 rows (approximately)
DELETE FROM `viewed_or_not`;
/*!40000 ALTER TABLE `viewed_or_not` DISABLE KEYS */;
INSERT INTO `viewed_or_not` (`id`, `status`) VALUES
	(1, 'Viewed'),
	(2, 'Not Viewed');
/*!40000 ALTER TABLE `viewed_or_not` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
