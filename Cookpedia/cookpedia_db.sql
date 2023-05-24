-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 08:15 AM
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
-- Database: `cookpedia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `recipe_name` varchar(255) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `steps` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `username`, `recipe_name`, `ingredients`, `steps`, `created_at`, `image`) VALUES
(54, 'athenajamieuy', 'Creamy Leche Flan', '6 pieces Egg Yolk\r\n1 packet NESTLE All Purpose Cream, 125ml chilled\r\n⅔ cup NESTLE Carnation Condensada\r\n½ Vanilla Extract\r\n⅛ Fine Salt\r\n3tb  Sugar\r\n', '1. Mix egg yolks with NESTLÉ® All Purpose Cream, NESTLÉ® Carnation® Condensada, vanilla, and salt.\r\n\r\n2. Add sugar in a large lyanera. Slowly melt sugar over low heat until golden brown. Set aside.\r\n\r\n3. Strain cream mixture into the lyanera. Cover tightly with aluminum foil and steam for 25 minutes. Set aside to cool.\r\n\r\n4. Refrigerate overnight. Unmold into a serving plate and serve well chilled.\r\n', '2023-05-24 07:43:56', 'images/leche flan.jpg'),
(55, 'athenajamieuy', 'Pork Tenderloin with Apples and Onions', '2 (1 1/2 pound) pork tenderloins\r\n2 teaspoons vegetable oil\r\n1 teaspoon sea salt\r\n2 tablespoons vegetable oil, divided, or more as needed\r\n3 medium Granny Smith apples - peeled, cored, and sliced into eighths\r\n2 medium sweet onions, sliced vertically\r\n3 teaspoons chopped fresh thyme, divided\r\n¼ teaspoon ground black pepper, or to taste\r\n1 tablespoon Dijon mustard\r\n1 cup chicken stock\r\n1 tablespoon butter', '1. Preheat the oven to 425 degrees F (220 degrees C).\r\n\r\n2. Trim silver skin from pork tenderloins; pat dry using paper towels. Rub 2 teaspoons vegetable oil over tenderloins, then rub with sea salt.\r\n\r\n3. Heat 1 tablespoon vegetable oil in a large, oven-proof skillet over medium heat until it shimmers. Cook tenderloins in hot oil, rotating to brown all sides, about 10 minutes. Transfer pork to a large plate.\r\n\r\n4. Add remaining 1 tablespoon vegetable oil to any drippings in the skillet. Cook apples and onions in hot oil, stirring occasionally, until onions turn translucent, about 5 minutes; add more oil if the skillet gets dry. Season with 1 teaspoon thyme and black pepper; stir gently to combine. Remove from heat.\r\n\r\n5. Use a pastry brush to spread Dijon mustard evenly over tenderloins. Sprinkle with remaining 2 teaspoons thyme. Nestle tenderloins into the skillet with apple mixture.\r\n\r\n6. Roast, uncovered, in the preheated oven until an instant-read thermometer inserted into the center of tenderloins reads at least 145 degrees F (63 degrees C), about 15 minutes. Remove the skillet from the oven and transfer pork to a large platter. Cover with aluminum foil and let rest.\r\n\r\n7.Meanwhile, pour chicken stock into a saucepan and cook over medium-high heat until reduced by half, 8 to 10 minutes. Pour into the skillet with apple mixture. Cook over medium-high heat until boiling, about 5 minutes; stir in butter until melted.\r\n\r\n8. Slice pork and serve over apple mixture.\r\n', '2023-05-24 07:47:56', 'images/pork.jpg'),
(56, 'athenajamieuy', 'Chicken Sisig', '500 grams chicken breast fillet, grilled\r\n100 g chicken liver, grilled\r\n1 cup diced white onion\r\n2 pcs sliced sili sigang\r\n2 tbsp calamansi juice\r\n2 tbsp Knorr Liquid Seasoning\r\npinch finely ground black pepper\r\n¼ cup Lady\'s Choice Real Mayonnaise\r\negg (optional)\r\nKnorr Liquid Seasoning', '1. In a hot pan, toss together grilled chicken breast, liver, onions and sili sigang.\r\n\r\n2. Season with calamansi juice, Knorr Liquid Seasoning and pepper. Toss well.\r\n\r\n3. Off heat, gently stir in Lady\'s Choice Real Mayonnaise. Serve.\r\n\r\n4. To serve with egg: Transfer mixture into a hot sizzling plate. Break egg on top and stir while plate is still hot. Top with more Knorr Liquid Seasoning as desired.', '2023-05-24 07:50:03', 'images/sisig.jpg'),
(57, 'athenajamieuy', 'Pork Sinigang', '1 tablespoon vegetable oil\r\n1 small onion, chopped\r\n1 teaspoon salt\r\n1 (1/2 inch) piece fresh ginger, chopped\r\n2 plum tomatoes, cut into 1/2-inch dice\r\n1 pound bone-in pork chops\r\n4 cups water, more if needed\r\n1 (1.41 ounce) package tamarind soup base (such as Knorr®)\r\n½ pound fresh green beans, trimmed', '1. Heat vegetable oil in a skillet over medium heat. Add onion; cook and stir until softened and translucent, about 5 minutes. Season with salt.\r\n\r\n2. Stir in ginger, tomatoes, and pork chops. Cover and reduce heat to medium-low. Turn the pork occasionally, until browned.\r\n\r\n3. Pour in water and tamarind soup base. Bring to a boil, then reduce heat and simmer until the pork is tender and cooked through, about 30 minutes.\r\n\r\n4. Stir in green beans and cook until tender.\r\n', '2023-05-24 07:51:45', 'images/sinigang.png'),
(58, 'athenajamieuy', 'Adobong Pusit (Squid Adobo)', '2 ¼ pounds squid, cleaned\r\n½ cup white vinegar\r\n½ cup water\r\nsalt and ground black pepper to taste\r\n2 tablespoons olive oil\r\n1 small onion, minced\r\n2 cloves garlic, minced\r\n1 tomato, chopped\r\n1 tablespoon soy sauce', '1. Combine squid, vinegar, and water in a small pot over medium heat; season with salt and pepper. Simmer for 10 minutes.\r\n\r\n2. Meanwhile, heat olive oil in a saucepan over medium heat; cook and stir onion and garlic in hot oil until softened, 5 to 7 minutes. Stir in tomato and soy sauce.\r\n\r\n3.Pour squid mixture into tomato mixture and bring to a simmer; cook for 20 minutes.\r\n', '2023-05-24 07:53:46', 'images/pusit.jpg'),
(59, 'athenajamieuy', 'Braised Beef Cheeks', '2 tablespoons olive oil\r\n5 pounds trimmed beef cheeks\r\n1 large onion, diced small\r\n1 carrot, diced small\r\n4 cloves garlic, minced\r\n4 cups beef stock\r\n1 cup red wine\r\n⅓ cup dried porcini mushrooms\r\n2 cubes beef bouillon\r\n1 teaspoon dried thyme\r\n2 bay leaves', '1. Preheat oven to 275 degrees F (135 degrees C).\r\n\r\n2. Heat olive oil in a large Dutch oven over medium-high heat. Add beef in batches and cook until browned, about 4 minutes per side. Add onion and carrot; cook until tender, about 20 minutes. Stir in garlic and cook until fragrant, about 2 minutes.\r\n\r\n3. Pour beef stock and wine into the Dutch oven; bring to a boil. Stir in porcini mushrooms, bouillon cubes, thyme, and bay leaves. Lay a piece of parchment paper over the surface. Cover with a tight lid.\r\n\r\n4. Bake in the preheated oven until beef is very tender, 5 to 6 hours.\r\n\r\n5. Transfer beef to a plate. Discard bay leaves. Blend cooking liquid with an immersion blender to make a smooth sauce. Serve beef with sauce.\r\n', '2023-05-24 07:56:20', 'images/beef.jpg'),
(60, 'athenajamieuy', 'One-Pot Ham & Veggie Pasta', '1 tablespoon olive oil\r\n2 ½ cups cubed fully cooked ham\r\n½ cup chopped onion\r\n3 cloves garlic, minced\r\n1 teaspoon Italian seasoning\r\n¼ teaspoon red pepper flakes\r\nsalt and pepper to taste\r\n4 cups low-sodium chicken broth\r\n1 ¼ cups fat free half-and-half\r\n¼ cup all-purpose flour\r\n1 (16 ounce) package farfalle (bow tie) pasta\r\n2 cups frozen peas and carrots\r\n½ cup grated Parmesan cheese\r\nchopped parsley for garnish', '1. Heat olive oil in a large pot over medium heat. Add ham and onion; saute for about 3 minutes. Add garlic and cook until fragrant, about 30 seconds. Stir in Italian seasoning, red pepper flakes, salt and pepper; cook for 2 minutes.\r\n\r\n2. Whisk together chicken broth, half-and-half, and flour in a bowl until smooth; pour into the pot. Stir in farfalle pasta, cover, and cook for 15 minutes.\r\n\r\n3. Add peas and carrots. Cook until pasta is cooked through, about 8 more minutes. Stir in Parmesan cheese and garnish with chopped parsley. Serve immediately.\r\n', '2023-05-24 07:57:36', 'images/vegg.jpg'),
(61, 'athenajamieuy', 'Ube Puto', '2 cups All Purpose Flour\r\n1 cup Sugar\r\n1 tbs Baking Powder\r\n¼ cup Butter, melted\r\n1 piece eggs, beaten\r\n1 packet NESTLÉ All Purpose Cream, 125ml, chilled\r\n1 cup Water\r\n1 ts	ube extract\r\n½ bar melting cheese, grated\r\n¼ cup Butter, melted\r\n', '1. Sift flour, sugar, and baking powder. Combine melted butter, egg, NESTLÉ® All Purpose Cream, water, and ube extract. Mix in wet ingredients to dry ingredients until smooth.\r\n\r\n2. Brush muffin pan with butter. Pour Puto mixture ¾ of the way of the muffin pan. Top with cheese slices. Steam over high heat for 15-20 minutes or until a toothpick comes out clean when inserted in the Puto. Set aside to cool completely.\r\n\r\n3. Remove from the muffin and brush the pot with melted butter. Serve.\r\n', '2023-05-24 08:12:53', 'images/puto.jpg'),
(62, 'athenajamieuy', 'Arroz Con Pollo (Chicken and Rice)', '4 skinless, boneless chicken breast halves, cut into 1-inch pieces\r\n½ teaspoon salt, divided\r\n½ teaspoon ground black pepper, divided\r\n½ teaspoon paprika, divided\r\n3 tablespoons vegetable oil\r\n1 green bell pepper, chopped\r\n¾ cup chopped onion\r\n1 ½ teaspoons minced garlic\r\n1 cup long-grain white rice\r\n1 (14.5 ounce) can chicken broth\r\n1 (14.5 ounce) can stewed tomatoes\r\n½ cup white wine\r\n⅛ teaspoon saffron\r\n1 tablespoon chopped fresh parsley', '1. Season chicken with a 1/4 teaspoon of salt, 1/4 teaspoon pepper, and 1/4 teaspoon paprika.\r\n\r\n2. Heat oil in a large skillet over medium heat. Add seasoned chicken; cook and stir until no longer pink in the center and golden brown on all sides, about 10 minutes. Transfer chicken onto a plate; set aside.\r\n\r\n3. Add green pepper, onions, and garlic to the same skillet; cook and stir for 5 minutes. Add rice; cook and stir until rice is opaque, 1 to 2 minutes. Stir in broth, tomatoes, white wine, and saffron. Stir in remaining 1/4 teaspoon salt, 1/4 teaspoon pepper, and 1/4 teaspoon paprika; bring to a boil, cover, and simmer for 20 minutes.\r\n\r\n4. Add chicken and stir until heated through. Stir in parsley and serve.\r\n', '2023-05-24 08:14:31', 'images/acp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`, `created_at`, `email`, `display_name`) VALUES
(1, 'admin', '1234', 1, '2023-05-18 13:14:01', NULL, NULL),
(11, 'von', '123', 0, '2023-05-23 00:28:18', 'von@gmail.com', 'Vonsogwapo\n'),
(12, 'test', '123', 0, '2023-05-23 15:14:50', 'test123@gmail.com', 'test\n'),
(14, 'athenajamieuy', '122', 0, '2023-05-24 13:39:38', 'athenajamieuy@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
