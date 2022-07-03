-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2019 at 04:33 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `active`) VALUES
(1, '30-Minute Recipes', 1),
(2, 'Comfort food', 1),
(3, 'Lunch', 1),
(4, 'The Best', 1),
(5, 'Summer Cooking', 1),
(6, 'To Freeze', 1),
(7, 'For Kids', 1),
(8, 'Healthy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient_id` int(20) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `quantity` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredient_id`, `recipe_id`, `name`, `quantity`) VALUES
(1, 6, 'white chocolate, chopped', '4 oz (115 g)'),
(2, 6, 'cream', '1 3/4 cups (430 ml) 35%'),
(3, 6, 'gelatin', '1/2 tsp '),
(4, 6, 'water', '1 tbsp (15 ml) '),
(5, 6, 'lemon juice', '1/2 cup (125 ml) '),
(6, 6, 'sugar', '1/2 cup (105 g)'),
(7, 6, 'eggs', '3'),
(8, 6, 'cold unsalted butter, diced', '1/4 cup (55 g)');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `meal_id` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`meal_id`, `name`, `active`) VALUES
(1, 'Main Dish', 1),
(2, 'Appetizer', 1),
(3, 'Dessert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `preparation`
--

CREATE TABLE `preparation` (
  `preparation_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `step_name` text NOT NULL,
  `step_number` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preparation`
--

INSERT INTO `preparation` (`preparation_id`, `recipe_id`, `step_name`, `step_number`) VALUES
(1, 6, 'Place the white chocolate in a bowl. Set aside.', 1),
(2, 6, 'In a pot, bring the cream to a boil. Pour the hot cream over the white chocolate and let rest 1 minute without stirring. Whisk until smooth. Cover with plastic wrap directly on the surface. Refrigerate for 8 hours or overnight.', 2),
(3, 6, 'Meanwhile, in a small bowl, sprinkle the gelatin over the water. Let bloom for 5 minutes.', 3),
(4, 6, 'In a small pot, bring the lemon juice and ¼ cup (55 g) of the sugar to a boil.', 4),
(5, 6, 'In another bowl, whisk together the eggs with the remaining sugar. Gradually whisk the warm lemon mixture into the egg mixture to temper.', 5),
(6, 6, 'Pour the mixture back into the pot. Cook over low heat, whisking constantly and scraping the bottom and sides of the pot, until the mixture thickens and coats the back of a spoon, about 3 minutes.', 6),
(7, 6, 'Remove from the heat. Whisk in the gelatin until completely dissolved. Let cool, stirring occasionally, until the mixture reaches 99°F (37°C), about 15 minutes. Add the butter all at once. Beat with a hand blender until smooth. Cover with plastic wrap directly on the surface of the cream. Refrigerate for 1 hour.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `user_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`user_id`, `recipe_id`, `rating`) VALUES
(3, 1, 4),
(3, 2, 4),
(3, 3, 1),
(3, 4, 3),
(3, 5, 3),
(4, 1, 2),
(4, 2, 3),
(4, 3, 5),
(4, 6, 3),
(6, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `meal_id` int(1) NOT NULL DEFAULT '1',
  `recipe_date` date NOT NULL,
  `preparation_time` int(3) NOT NULL,
  `cooking_time` int(3) NOT NULL,
  `servings` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `name`, `image_name`, `active`, `meal_id`, `recipe_date`, `preparation_time`, `cooking_time`, `servings`) VALUES
(1, 'Creamy Broccoli Pizza', 'CreamyBroccoliPizza.jpg', 1, 1, '2019-07-08', 45, 50, 3),
(2, 'Barbecue Tempeh Sandwiches with Coleslaw', 'Barbecue.jpg', 1, 1, '2019-07-01', 30, 6, 4),
(3, 'Beef Kibbeh', 'BeefKibbeh.jpg', 1, 2, '2019-06-05', 45, 12, 18),
(4, 'Potato Bombas', 'PotatoBombas.jpg', 1, 2, '2019-03-02', 45, 45, 14),
(5, 'Orange and Chocolate Cassata Cake', 'OrangeandChocolate.jpg', 1, 3, '2019-07-02', 50, 35, 10),
(6, 'Lemon Chiffon Cake', 'LemonChiffonCake.jpg', 1, 3, '2019-07-04', 135, 50, 12),
(7, 'Pasta Salad with Lemon and Tuscan Kale', 'PastaSaladwithLemon.jpg', 1, 1, '2019-07-03', 45, 20, 4),
(8, 'Blueberry Saucew', 'BlueberrySauce.jpg', 1, 3, '2019-07-03', 15, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_categories`
--

CREATE TABLE `recipe_categories` (
  `recipe_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_categories`
--

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`) VALUES
(1, 2),
(1, 7),
(3, 4),
(3, 8),
(5, 6),
(6, 6),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `Name`, `active`) VALUES
(1, 'Admin', 1),
(2, 'Member', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `username`, `password`, `salt`, `active`, `role_id`) VALUES
(3, 'Krunalkumar', 'Patel', 'onlyforextrause1@gmail.co', 'Krunalkumar', '$2a$05$bb0b2c20da80fc59513c7OuzXSlp6PRzDGK0FWoDavKaAAZ.sE1JO', '$2a$05$bb0b2c20da80fc59513c7c$', 1, 1),
(4, 'sa', 'sa', 'sa@gmail.com', 'sa', '$2y$05$c12e01f2a13ff5587e1e9eEnjJ0Y3b88ZsWqHOO9ynejAnB5c.jQm', '$2y$05$c12e01f2a13ff5587e1e9e$', 1, 2),
(6, 'zhe', 'yang', 'zhe@gmail.com', 'zhe', '$2y$05$57cb5a26334a6c1d5e27cuBkbyI0lc0Tb7KEgkj9AtN0Ues6kbPnC', '$2y$05$57cb5a26334a6c1d5e27c4$', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`recipe_id`),
  ADD KEY `favorites_recipe_id_FK` (`recipe_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `ingredient_recipe_id_FK` (`recipe_id`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `preparation`
--
ALTER TABLE `preparation`
  ADD PRIMARY KEY (`preparation_id`,`recipe_id`,`step_number`),
  ADD KEY `preparation_recipe_id_FK` (`recipe_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`user_id`,`recipe_id`),
  ADD KEY `rating_recipe_id_FK` (`recipe_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `recipe_meal_id_FK` (`meal_id`);

--
-- Indexes for table `recipe_categories`
--
ALTER TABLE `recipe_categories`
  ADD PRIMARY KEY (`recipe_id`,`category_id`),
  ADD KEY `recipe_categories_category_id_FK` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_role_id_FK` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `meal_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `preparation`
--
ALTER TABLE `preparation`
  MODIFY `preparation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_recipe_id_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`),
  ADD CONSTRAINT `favorites_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_recipe_id_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

--
-- Constraints for table `preparation`
--
ALTER TABLE `preparation`
  ADD CONSTRAINT `preparation_recipe_id_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_recipe_id_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`),
  ADD CONSTRAINT `rating_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_meal_id_FK` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`meal_id`);

--
-- Constraints for table `recipe_categories`
--
ALTER TABLE `recipe_categories`
  ADD CONSTRAINT `recipe_categories_category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `recipe_categories_recipe_id_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
