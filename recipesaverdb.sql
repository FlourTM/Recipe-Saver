-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 03:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipesaverdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `recipeID` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userID`, `recipeID`, `content`, `date`) VALUES
(1, 1, 2, 'I put the oats in first and ground them fine. It was very filling and delicious.', '2023-04-11'),
(2, 18, 1, 'Excellent recipe. I use the sauce on pork roast and chicken as well. Easy to put together quickly. My family loves it!', '2023-04-11'),
(3, 17, 3, 'This was so good! I added strawberries and banana slices to mine and loved it so much', '2023-04-11'),
(4, 20, 4, 'I loved these cookie bars.', '2023-04-11'),
(5, 19, 5, 'I have tried to make homemade potato chips for over 20 years with no success. Until I found this recipe. So easy and so good.', '2023-04-11'),
(6, 21, 3, 'So yummy! Best French toast I\'ve ever had!', '2023-04-11'),
(7, 21, 2, 'This smoothie was pretty good. I decided to also add banana and felt that it made it so much better.', '2023-04-11'),
(8, 22, 7, 'Super easy to put together and tasted delicious! I used a Fuji apple, but I might try a Granny Smith next time just to see how that turns out. Topped with a bit of maple syrup, what could be better?', '2023-04-11'),
(9, 20, 8, 'First time trying tilapia - guess I\'m not a big fan of it', '2023-04-11'),
(10, 25, 9, 'This lemonade was very refreshing and delicious. Perfect amount of sugar', '2023-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `ingredients` longtext NOT NULL,
  `instructions` longtext NOT NULL,
  `prepTime` varchar(255) NOT NULL,
  `cookTime` varchar(255) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `imageType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `category`, `ingredients`, `instructions`, `prepTime`, `cookTime`, `imagePath`, `imageType`) VALUES
(1, 'Honey Garlic Pork Chops', 'Dinners', '6 (4 oz) pork chops; ½ cup ketchup; 2 2⁄3 tablespoons honey; 2 tablespoons soy sauce; 2 cloves garlic, crushed', 'Preheat pan on medium heat with light oil.; Whisk ketchup, honey, soy sauce, and garlic together in a bowl to make the glaze.; Sear the pork chops on both sides. Lightly brush glaze onto each side of the pork chops and cook until no longer pink in the center, about 7-9 minutes per side. The pork chops should read 145 degrees F with a thermometer.; Serve hot and enjoy!', '10', '15', '../uploads/honey-garlic-pork-chops.jpeg', 'image/jpeg'),
(2, 'Strawberry Oatmeal Smoothie', 'Drinks', '1 cup soy milk; ½ cup rolled oats; 14 frozen strawberries; 1 banana, broken into chunks; 1 ½ teaspoons white sugar (Optional); ½ teaspoon vanilla extract (Optional)', 'Blend soy milk, oats, strawberries, and banana in a blender until smooth.; Add sugar and vanilla, then blend again until smooth.; Pour into glasses and serve.', '5', '0', '../uploads/strawberry-oatmeal-breakfast-smoothie.jpeg', 'image/jpeg'),
(3, 'Croissant French Toast', 'Breakfast', '4 large croissants, halved horizontally, left out overnight; 3 large eggs; ½ cup half-and-half; 1 tablespoon white sugar; 2 teaspoons vanilla extract; ½ teaspoon ground cinnamon; ¼ teaspoon salt; 1 pinch ground nutmeg; 2 tablespoons unsalted butter', 'Preheat the oven to 200 degrees F (95 degrees C).; Whisk eggs, half-and-half, sugar, vanilla, cinnamon, salt, and nutmeg together in a shallow bowl. Dip each croissant half into the egg mixture, one at a time, flipping it and lightly pressing down, until well coated.; Melt the butter in a large skillet over medium heat.; Add four croissant halves, cut side down. Fry until browned on both sides, turning once, 2 to 3 minutes per side. Transfer to the oven to keep warm while you cook the remaining croissants.; Serve warm with your favorite toppings.', '10', '15', '../uploads/croissant-french-toast.jpeg', 'image/jpeg'),
(4, 'Mocha Cookie Bars', 'Desserts', '1 tablespoon instant espresso powder; 1 tablespoon strong brewed coffee; 1 cup all-purpose flour; ¼ cup unsweetened cocoa powder; ½ teaspoon cream of tartar; ½ teaspoon baking soda; ½ teaspoon salt; ¼ teaspoon ground cinnamon; ½ cup unsalted butter, softened; ½ cup white sugar; ¼ cup firmly packed brown sugar; 1 large egg, at room temperature; 2 teaspoons vanilla extract; 1 tablespoon white sugar (for the topping); ½ teaspoon ground cinnamon (for the topping)', 'Preheat the oven to 350 degrees F (175 degrees C). Line an 8x8-inch square pan with enough parchment paper to have overhang on all sides.; Stir espresso powder and coffee together in a small bowl until espresso powder is completely dissolved.; Whisk flour, cocoa, cream of tartar, baking soda, salt, and 1/4 teaspoon cinnamon together in a bowl, set aside.; Beat butter, 1/2 cup white sugar, and brown sugar with an electric mixer together until light and fluffy in a bowl. Beat in espresso mixture, egg, and vanilla until well combined. Stir in flour mixture, mix until a dough just begins to form. Press dough firmly and evenly into the prepared pan using lightly floured hands.; Whisk 1 tablespoon white sugar and remaining 1/2 teaspoon cinnamon together in a small bowl, sprinkle sugar mixture evenly over the dough.; Bake in the preheated oven just until the dough in the center of the pan feels barely set, 20 to 23 minutes.; Allow cookies to cool in the pan for 10 minutes. Use the overhanging parchment to lift cookies out to a wire rack, cool completely before cutting into bars.', '15', '20', '../uploads/Mocha-Cookie-Bars.jpeg', 'image/jpeg'),
(5, 'Homestyle Potato Chips', 'Snacks', '4 medium potatoes, peeled and sliced paper-thin; 3 tablespoons salt, plus more to taste; 1 quart oil for deep frying', 'Transfer potato slices to a large bowl of cold water as you slice them.; Drain slices and rinse under cold water. Refill the bowl with water, add 3 tablespoons salt, and put slices back in the bowl. Let potatoes soak in the salty water for at least 30 minutes.; Drain and rinse slices again. Pat dry.; Heat oil in a deep-fryer to 365 degrees F (185 degrees C).; Working in small batches, fry potato slices until golden. Remove with a slotted spoon and drain on paper towels. Continue until all of the slices are fried.; Season potato chips with additional salt if desired.', '30', '25', '../uploads/homestyle-potato-chips.jpeg', 'image/jpeg'),
(6, 'Cookies and Cream Brownies', 'Desserts', '1 ½ cups white sugar; ¾ cup all-purpose flour; ½ cup high-quality unsweetened cocoa powder; ½ teaspoon salt; ¼ teaspoon baking powder; ¾ cup unsalted butter, melted; 3 large eggs; 1 teaspoon vanilla extract; 32 chocolate sandwich cookies (such as Oreo®), divided; 1 (8 ounce) container frozen whipped topping (such as Cool Whip®), thawed', 'Preheat the oven to 350 degrees F (175 degrees C). Grease a 9-inch square baking pan.; Mix sugar, flour, cocoa powder, salt, and baking powder together in a mixing bowl.; Whisk butter, eggs, and vanilla together in a separate bowl. Add butter mixture to the flour mixture and mix until well combined.; Pour 1/2 of the batter into the prepared baking pan and smooth out with a spatula. Add 16 OREO® cookies in an even layer (4 rows of 4 cookies), then spread the remaining 1/2 of the batter over top.; Bake in the preheated oven until edges are brown and center is set, 30 to 35 minutes.; Remove pan from the oven and set on a wire rack. Let brownies cool completely, at least 30 minutes.; Crush 12 of the remaining OREO® cookies. Place the whipped topping in a bowl and fold in the crushed cookies. Spread over the top of the brownies. Crush the remaining 4 cookies, then sprinkle over the top of the whipped cream mixture.; Keep refrigerated until you are ready to slice and serve.', '25', '30', '../uploads/Cookies-and-Cream-Brownies.jpeg', 'image/jpeg'),
(7, 'Apple Fritter Pancakes', 'Breakfast', '1 large egg; 1 tablespoon white sugar; ⅛ teaspoon ground cinnamon, or to taste; 1 pinch ground ginger; 1 pinch nutmeg; ¼ teaspoon kosher salt; ⅛ teaspoon pure vanilla extract; 1 cup shredded apple; 1 teaspoon lemon juice; ½ cup all-purpose flour, or as needed; ¼ teaspoon baking powder; ⅛ teaspoon baking soda; 2 tablespoons melted butter', 'Combine egg, sugar, cinnamon, ginger, nutmeg, kosher salt, and vanilla extract in a bowl. Whisk until well combined and lightly foamy.; Add shredded apple and lemon juice and fold in with a spatula until well combined.; Add flour, baking powder, and baking soda. Mix until flour disappears and batter is thick yet spoonable.; Melt butter in a skillet over medium heat. Add tablespoonfuls of apple batter to the hot butter and cook until browned, about 3 minutes. Turn and cook until apple pancakes spring back to the touch and are browned on the other side, an additional 3 minutes.', '10', '6', '../uploads/Apple-Fritter-Pancakes.jpeg', 'image/jpeg'),
(8, 'Pan-Seared Tilapia', 'Dinners', '4 (4 ounce) tilapia fillets; salt and ground black pepper to taste; ½ cup all-purpose flour; 1 tablespoon olive oil; 2 tablespoons unsalted butter, melted; 1 tablespoon lemon juice, or to taste (Optional); 1 teaspoon chopped fresh flat-leaf parsley, or to taste (Optional); ½ teaspoon chopped fresh thyme, or to taste (Optional)', 'Rinse tilapia fillets in cold water and pat dry with paper towels. Season both sides of each fillet with salt and pepper.; Place flour in a shallow dish. Gently press each fillet into the flour to coat and shake off any excess.; Heat olive oil in a large skillet over medium-high heat. Cook tilapia fillets in the hot oil, in batches if necessary, until fish flakes easily with a fork, about 4 minutes per side.; Brush melted butter onto the tilapia fillets in the last minute before removing from the skillet.; Drizzle fillets with lemon juice and garnish with parsley and thyme.', '5', '10', '../uploads/pan-seared-tilapia.jpeg', 'image/jpeg'),
(9, 'Old-Fashioned Lemonade', 'Drinks', '6 lemons; 1 cup white sugar; 6 cups water, or more as needed', 'Juice lemons; you should have 1 cup juice.; Combine juice, sugar, and water in a 1/2-gallon pitcher. Stir until sugar dissolves. Taste and add more water if desired.; Chill and serve over ice.', '10', '0', '../uploads/old-fashioned-lemonade.jpeg', 'image/jpeg'),
(10, 'Kettle Corn', 'Snacks', '¼ cup vegetable oil; ½ cup unpopped popcorn kernels; ¼ cup white sugar', 'Heat vegetable oil in a large pot over medium heat. Stir in popcorn kernels and sugar.; Cover and shake the pot constantly to prevent sugar from burning. When popping has slowed to once every 2 to 3 seconds, remove the pot from the heat and shake for a few minutes until popping stops.; Pour popcorn into a large bowl and allow to cool, stirring occasionally to break up large clumps.', '5', '15', '../uploads/kettle-corn.jpeg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `savedrecipes`
--

CREATE TABLE `savedrecipes` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `recipeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedrecipes`
--

INSERT INTO `savedrecipes` (`id`, `userID`, `recipeID`) VALUES
(1, 1, 2),
(2, 18, 1),
(3, 17, 3),
(4, 20, 4),
(5, 19, 5),
(6, 21, 3),
(7, 21, 2),
(8, 22, 6),
(9, 22, 7),
(10, 25, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `pass_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `pass_hash`, `email`, `phone`) VALUES
(1, 'Gabriella', 'Green', '$2y$10$R6UzH9PhcDLD.LvZQ5OWn.gy1y9.bDa3.CW/rZ2tmQYQpjGYfbiIm', 'gabriellag726@gmail.com', NULL),
(17, 'John', 'Doe', '$2y$10$BYhfCf.bgmzu1cKf19naTuCEODxE33ImHSEvWcdVXJZmgYe63Ogt6', 'johndoe@gmail.com', NULL),
(18, 'Kathy', 'Smith', '$2y$10$bXXP9xfPa9om.McZBgtBWOYvXhz2ww6shLvMpknhb7KX7FCIQXLCe', 'kathysmith@gmail.com', '5555555555'),
(19, 'Kyle', 'Lewis', '$2y$10$jDWSXcVWIeoGQjWuezQRX.ORgqAYybynb85cos0QYiRn1n/Y4ewNC', 'kylelewis@gmail.com', NULL),
(20, 'Jake', 'Johnson', '$2y$10$vy5TfLVGSbYCEXlf9KLNAe19oyEawk/OZNXphZljIrEbPWBHJoifq', 'jakejohnson@gmail.com', NULL),
(21, 'Steve', 'Oliver', '$2y$10$0uchym3rCWrnkKFXJfUQP.jORo3.UliB6y8rI3fOtWShqNfqplKn2', 'steveoliver@gmail.com', '1234567890'),
(22, 'Roger', 'Whittington', '$2y$10$F2XKwEkYJV6WZgo7XKiiS.w.I7v24akNNl/gKn9WtzUqDLjTh.ZR2', 'rogerwhittington@gmail.com', NULL),
(23, 'Clarke', 'Griffin', '$2y$10$3P4ea9H3OiuJ2onjilur/.KraScF9LTLUQOU9aNQOQw.xiRkaduAS', 'clarkegriffin@gmail.com', '9879873344'),
(24, 'Blake', 'Freyer', '$2y$10$n/Yc6JWW6l14G.Z4l48t5O8/KjPpiDj0rsrQ.0ex8pQWd.pUSAcp6', 'blakefreyer@gmail.com', NULL),
(25, 'Chris', 'Murphy', '$2y$10$fJyWSn.ecUBpzLGHQwRCUO9vHOgJObWYxJ.G4ZQDvTXEtstWKNE0S', 'chrismurphy@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userrecipes`
--

CREATE TABLE `userrecipes` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `recipeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrecipes`
--

INSERT INTO `userrecipes` (`id`, `userID`, `recipeID`) VALUES
(1, 1, 1),
(2, 17, 2),
(3, 18, 3),
(4, 19, 4),
(5, 20, 5),
(6, 21, 6),
(7, 21, 7),
(8, 22, 8),
(9, 23, 9),
(10, 24, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savedrecipes`
--
ALTER TABLE `savedrecipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `userrecipes`
--
ALTER TABLE `userrecipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `savedrecipes`
--
ALTER TABLE `savedrecipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userrecipes`
--
ALTER TABLE `userrecipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
