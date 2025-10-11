<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstWhere('email', 'loquinariojepoy7@gmail.com') ?? User::factory()->create([
            'name' => 'Jepoy Loquinario',
            'email' => 'loquinariojepoy7@gmail.com',
        ]);

        $recipes = array_merge(
            self::breakfastRecipes(),
            self::lunchRecipes(),
            self::dinnerRecipes(),
        );

        foreach ($recipes as $recipe) {
            Recipe::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'name' => $recipe['name'],
                ],
                array_merge($recipe, ['user_id' => $user->id])
            );
        }
    }

    private static function breakfastRecipes(): array
    {
        return [
            [
                'name' => 'Tapsilog',
                'category' => 'breakfast',
                'servings' => 2,
                'calories' => 520,
                'prep_time' => 15,
                'cook_time' => 20,
                'image' => 'https://images.unsplash.com/photo-1525755662778-989d0524087e?auto=format&fit=crop&w=800&q=80',
                'description' => 'Classic Filipino breakfast of marinated beef tapa served with garlic fried rice and a sunny-side egg.',
                'ingredients' => self::lines([
                    '400 g beef sirloin, thinly sliced',
                    '3 cloves garlic, minced',
                    '3 tablespoons soy sauce',
                    '2 tablespoons calamansi juice',
                    '2 cups garlic fried rice',
                    '2 eggs, sunny-side up'
                ]),
                'instructions' => self::lines([
                    'Marinate beef in garlic, soy sauce, calamansi, salt, and pepper for at least 30 minutes.',
                    'Pan-fry the beef over medium-high heat until caramelized.',
                    'Serve alongside garlic fried rice and eggs.',
                    'Add pickled papaya if desired.'
                ]),
            ],
            [
                'name' => 'Longsilog',
                'category' => 'breakfast',
                'servings' => 2,
                'calories' => 540,
                'prep_time' => 10,
                'cook_time' => 18,
                'image' => 'https://images.unsplash.com/photo-1543832923-7098c4631ef9?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sweet and garlicky longganisa sausages served with garlic fried rice and fried eggs.',
                'ingredients' => self::lines([
                    '6 pieces pork longganisa',
                    '1/4 cup water',
                    '2 tablespoons cooking oil',
                    '2 cups garlic fried rice',
                    '2 eggs, fried',
                    'Sliced tomatoes and cucumbers'
                ]),
                'instructions' => self::lines([
                    'Simmer longganisa in water until the liquid evaporates and fat renders.',
                    'Add oil and fry sausages until browned.',
                    'Serve with garlic rice, fried eggs, and fresh vegetables.',
                    'Season rice with extra fried garlic.'
                ]),
            ],
            [
                'name' => 'Bangsilog',
                'category' => 'breakfast',
                'servings' => 2,
                'calories' => 510,
                'prep_time' => 12,
                'cook_time' => 15,
                'image' => 'https://images.unsplash.com/photo-1473093234315-0aee8e21526a?auto=format&fit=crop&w=800&q=80',
                'description' => 'Fried marinated milkfish paired with garlic rice, fried eggs, and pickled papaya.',
                'ingredients' => self::lines([
                    '2 boneless bangus bellies',
                    '1/4 cup cane vinegar',
                    '4 cloves garlic, crushed',
                    '1 teaspoon peppercorns',
                    '2 cups garlic fried rice',
                    '2 eggs, fried'
                ]),
                'instructions' => self::lines([
                    'Marinate bangus in vinegar, garlic, peppercorns, and salt for at least 1 hour.',
                    'Pat dry and fry over medium heat until crisp and golden.',
                    'Serve with garlic rice, fried eggs, and pickled papaya.',
                    'Offer spiced vinegar on the side for dipping.'
                ]),
            ],
            [
                'name' => 'Corned Beef Silog',
                'category' => 'breakfast',
                'servings' => 2,
                'calories' => 480,
                'prep_time' => 8,
                'cook_time' => 12,
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sautéed corned beef with potatoes and onions served with garlic fried rice and eggs.',
                'ingredients' => self::lines([
                    '1 can Filipino-style corned beef',
                    '1 small potato, diced',
                    '1/2 onion, sliced',
                    '2 tablespoons oil',
                    '2 cups garlic fried rice',
                    '2 eggs, fried'
                ]),
                'instructions' => self::lines([
                    'Sauté onions and potatoes in oil until potatoes turn tender.',
                    'Add corned beef and cook until lightly crisped.',
                    'Serve with garlic rice and fried eggs.',
                    'Top with chopped scallions if desired.'
                ]),
            ],
            [
                'name' => 'Chicken Tocino Silog',
                'category' => 'breakfast',
                'servings' => 2,
                'calories' => 500,
                'prep_time' => 15,
                'cook_time' => 16,
                'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sweet cured chicken tocino paired with garlic rice and a runny fried egg.',
                'ingredients' => self::lines([
                    '400 g chicken thigh fillets',
                    '3 tablespoons brown sugar',
                    '2 tablespoons pineapple juice',
                    '1 tablespoon soy sauce',
                    '2 cups garlic fried rice',
                    '2 eggs, fried sunny-side'
                ]),
                'instructions' => self::lines([
                    'Marinate chicken in sugar, pineapple juice, soy sauce, garlic, and salt for at least 2 hours.',
                    'Pan-cook tocino over low heat until caramelized and cooked through.',
                    'Serve with garlic rice and fried eggs.',
                    'Drizzle leftover glaze over the meat if desired.'
                ]),
            ],
            [
                'name' => 'Arroz Caldo',
                'category' => 'breakfast',
                'servings' => 4,
                'calories' => 360,
                'prep_time' => 10,
                'cook_time' => 35,
                'image' => 'https://images.unsplash.com/photo-1481391032119-d89fee407e44?auto=format&fit=crop&w=800&q=80',
                'description' => 'Ginger chicken rice porridge topped with calamansi, scallions, and toasted garlic.',
                'ingredients' => self::lines([
                    '1 cup glutinous rice',
                    '2 tablespoons ginger, julienned',
                    '2 cloves garlic, minced',
                    '300 g chicken thighs, shredded',
                    '5 cups chicken broth',
                    'Calamansi, scallions, and toasted garlic for garnish'
                ]),
                'instructions' => self::lines([
                    'Sauté ginger and garlic until fragrant, then add chicken and cook until lightly browned.',
                    'Stir in rice and broth, simmering until thick and creamy.',
                    'Season with fish sauce, salt, and pepper.',
                    'Top with calamansi juice, scallions, and toasted garlic.'
                ]),
            ],
            [
                'name' => 'Champorado with Tuyo',
                'category' => 'breakfast',
                'servings' => 4,
                'calories' => 310,
                'prep_time' => 5,
                'cook_time' => 35,
                'image' => 'https://images.unsplash.com/photo-1529007196863-d07650a3f0ea?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sticky chocolate rice porridge served with condensed milk and crispy dried fish.',
                'ingredients' => self::lines([
                    '1 cup glutinous rice',
                    '4 cups water',
                    '4 pieces tablea chocolate',
                    '1/2 cup condensed milk',
                    '2 tablespoons sugar',
                    'Pinch of salt',
                    '4 pieces dried fish (tuyo)'
                ]),
                'instructions' => self::lines([
                    'Cook glutinous rice in water until soft and thick.',
                    'Stir in tablea, sugar, and salt until chocolate dissolves.',
                    'Serve warm with condensed milk and fried tuyo on the side.',
                    'Add extra milk or sugar to taste.'
                ]),
            ],
            [
                'name' => 'Tortang Talong',
                'category' => 'breakfast',
                'servings' => 3,
                'calories' => 250,
                'prep_time' => 10,
                'cook_time' => 18,
                'image' => 'https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?auto=format&fit=crop&w=800&q=80',
                'description' => 'Smoky grilled eggplant dipped in eggs and pan-fried to a crisp finish.',
                'ingredients' => self::lines([
                    '3 large eggplants',
                    '4 eggs, beaten',
                    '1 small onion, minced',
                    '1 tomato, diced',
                    '2 tablespoons cooking oil',
                    'Fish sauce or salt to taste'
                ]),
                'instructions' => self::lines([
                    'Char eggplants over open flame until skins blacken, then peel.',
                    'Flatten eggplants and dip in seasoned beaten eggs with onion and tomato.',
                    'Pan-fry in oil until both sides are golden.',
                    'Serve with steamed rice and banana ketchup.'
                ]),
            ],
            [
                'name' => 'Suman at Mangga',
                'category' => 'breakfast',
                'servings' => 4,
                'calories' => 290,
                'prep_time' => 20,
                'cook_time' => 60,
                'image' => 'https://images.unsplash.com/photo-1604908177251-c1983f1490b0?auto=format&fit=crop&w=800&q=80',
                'description' => 'Steamed coconut sticky rice cakes paired with ripe mango and latik sauce.',
                'ingredients' => self::lines([
                    '2 cups glutinous rice',
                    '2 cups coconut milk',
                    '1/2 cup brown sugar',
                    'Banana leaves for wrapping',
                    '2 ripe mangoes, sliced',
                    '1/4 cup coconut caramel (latik)'
                ]),
                'instructions' => self::lines([
                    'Soak rice in sweetened coconut milk for 1 hour.',
                    'Wrap soaked rice in banana leaves and steam for 45 minutes.',
                    'Serve warm with sliced mangoes.',
                    'Drizzle with latik and toasted coconut.'
                ]),
            ],
            [
                'name' => 'Pandesal with Kesong Puti',
                'category' => 'breakfast',
                'servings' => 3,
                'calories' => 280,
                'prep_time' => 5,
                'cook_time' => 5,
                'image' => 'https://images.unsplash.com/photo-1543353071-10c8ba85a904?auto=format&fit=crop&w=800&q=80',
                'description' => 'Warm pandesal filled with creamy kesong puti, tomato slices, and a drizzle of olive oil.',
                'ingredients' => self::lines([
                    '6 pieces freshly baked pandesal',
                    '150 g kesong puti',
                    '1 large tomato, sliced',
                    '1 tablespoon olive oil',
                    'Pinch of sea salt',
                    'Fresh basil leaves'
                ]),
                'instructions' => self::lines([
                    'Warm the pandesal lightly in an oven or pan.',
                    'Layer kesong puti and tomato slices inside each roll.',
                    'Drizzle with olive oil and sprinkle with salt.',
                    'Add basil leaves and serve immediately.'
                ]),
            ],
        ];
    }

    private static function lunchRecipes(): array
    {
        return [
            [
                'name' => 'Chicken Adobo',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 430,
                'prep_time' => 15,
                'cook_time' => 45,
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e7?auto=format&fit=crop&w=800&q=80',
                'description' => 'Slow-simmered chicken in soy sauce, vinegar, garlic, and bay leaves with a rich glaze.',
                'ingredients' => self::lines([
                    '1 kg chicken drumsticks and thighs',
                    '1/2 cup soy sauce',
                    '1/3 cup cane vinegar',
                    '6 cloves garlic, crushed',
                    '3 bay leaves',
                    '1 teaspoon whole peppercorns'
                ]),
                'instructions' => self::lines([
                    'Combine chicken, soy sauce, vinegar, garlic, bay leaves, and peppercorns in a pot.',
                    'Bring to a boil, then simmer for 35 minutes until tender.',
                    'Reduce the sauce until thick and glossy.',
                    'Serve with steamed rice and extra adobo sauce.'
                ]),
            ],
            [
                'name' => 'Sinigang na Baboy',
                'category' => 'lunch',
                'servings' => 5,
                'calories' => 380,
                'prep_time' => 20,
                'cook_time' => 50,
                'image' => 'https://images.unsplash.com/photo-1612009920658-e5604f049ba5?auto=format&fit=crop&w=800&q=80',
                'description' => 'Tamarind-based soup with tender pork, kangkong, radish, and vegetables served piping hot.',
                'ingredients' => self::lines([
                    '800 g pork ribs or belly',
                    '10 cups water',
                    '1 packet tamarind soup base',
                    '1 medium radish, sliced',
                    '2 tomatoes, quartered',
                    '1 cup kangkong leaves'
                ]),
                'instructions' => self::lines([
                    'Boil pork until tender, skimming off impurities.',
                    'Add tamarind base, tomatoes, radish, and chilies; simmer for 10 minutes.',
                    'Season with fish sauce to taste.',
                    'Stir in kangkong just before serving.'
                ]),
            ],
            [
                'name' => 'Kare-Kare',
                'category' => 'lunch',
                'servings' => 6,
                'calories' => 520,
                'prep_time' => 25,
                'cook_time' => 75,
                'image' => 'https://images.unsplash.com/photo-1612874742480-5d54e16deca9?auto=format&fit=crop&w=800&q=80',
                'description' => 'Peanut-based oxtail stew simmered with eggplant, banana heart, and bok choy served with bagoong.',
                'ingredients' => self::lines([
                    '1 kg oxtail or beef shank',
                    '1/2 cup peanut butter',
                    '2 tablespoons annatto water',
                    '1 eggplant, sliced',
                    '1 banana heart, sliced',
                    '1 bunch bok choy',
                    '1/2 cup bagoong alamang'
                ]),
                'instructions' => self::lines([
                    'Simmer oxtail until tender and reserve broth.',
                    'Sauté garlic and onions, then add annatto water and peanut butter.',
                    'Pour in broth and add vegetables to cook until crisp-tender.',
                    'Serve hot with bagoong alamang on the side.'
                ]),
            ],
            [
                'name' => 'Bicol Express',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 480,
                'prep_time' => 15,
                'cook_time' => 30,
                'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?auto=format&fit=crop&w=800&q=80',
                'description' => 'Spicy pork belly stew cooked in coconut milk, shrimp paste, and bird\'s eye chilies.',
                'ingredients' => self::lines([
                    '600 g pork belly, sliced',
                    '1 cup coconut cream',
                    '1 cup coconut milk',
                    '2 tablespoons bagoong alamang',
                    '6 bird\'s eye chilies, sliced',
                    '1 onion, chopped'
                ]),
                'instructions' => self::lines([
                    'Render pork belly until lightly browned.',
                    'Add onions, garlic, and bagoong; cook until aromatic.',
                    'Pour in coconut milk and simmer until pork is tender.',
                    'Stir in coconut cream and chilies; cook until sauce thickens.'
                ]),
            ],
            [
                'name' => 'Pinakbet',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 260,
                'prep_time' => 15,
                'cook_time' => 20,
                'image' => 'https://images.unsplash.com/photo-1525755662778-989d0524087e?auto=format&fit=crop&w=800&q=80',
                'description' => 'Mixed vegetables sautéed with shrimp paste featuring squash, bitter melon, okra, and beans.',
                'ingredients' => self::lines([
                    '200 g pork belly, sliced thin',
                    '1/4 cup bagoong alamang',
                    '1 cup squash cubes',
                    '1 bitter melon, sliced',
                    '6 okra pods, halved',
                    '1 cup yard-long beans, cut into pieces'
                ]),
                'instructions' => self::lines([
                    'Render pork until lightly browned then add garlic and onions.',
                    'Stir in bagoong and sauté vegetables starting with squash.',
                    'Cover and cook until vegetables are tender but not mushy.',
                    'Adjust seasoning and serve immediately.'
                ]),
            ],
            [
                'name' => 'Inihaw na Liempo',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 560,
                'prep_time' => 20,
                'cook_time' => 25,
                'image' => 'https://images.unsplash.com/photo-1625937284777-0d016c04dc8a?auto=format&fit=crop&w=800&q=80',
                'description' => 'Charcoal-grilled pork belly marinated in calamansi, soy sauce, garlic, and brown sugar.',
                'ingredients' => self::lines([
                    '700 g pork belly slabs',
                    '1/4 cup soy sauce',
                    '3 tablespoons calamansi juice',
                    '3 tablespoons brown sugar',
                    '4 cloves garlic, minced',
                    'Banana ketchup for basting'
                ]),
                'instructions' => self::lines([
                    'Marinate pork belly in soy sauce, calamansi, sugar, garlic, and pepper for at least 2 hours.',
                    'Grill over medium-hot coals, basting with banana ketchup until cooked through.',
                    'Rest for 5 minutes before slicing.',
                    'Serve with spicy vinegar dip and steamed rice.'
                ]),
            ],
            [
                'name' => 'Pancit Canton',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 420,
                'prep_time' => 15,
                'cook_time' => 18,
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80',
                'description' => 'Stir-fried egg noodles with pork, shrimp, vegetables, and savory soy-oyster sauce.',
                'ingredients' => self::lines([
                    '250 g pancit canton noodles',
                    '150 g pork strips',
                    '150 g shrimp, peeled',
                    '1 cup shredded cabbage',
                    '1 carrot, julienned',
                    '3 tablespoons soy-oyster sauce'
                ]),
                'instructions' => self::lines([
                    'Sauté pork and shrimp until just cooked; set aside.',
                    'Stir-fry vegetables in garlic and onions.',
                    'Add noodles, broth, and sauce; toss until noodles are tender.',
                    'Return meat and shrimp, then finish with calamansi.'
                ]),
            ],
            [
                'name' => 'Beef Mechado',
                'category' => 'lunch',
                'servings' => 5,
                'calories' => 510,
                'prep_time' => 20,
                'cook_time' => 70,
                'image' => 'https://images.unsplash.com/photo-1613470531314-2264ba2899a3?auto=format&fit=crop&w=800&q=80',
                'description' => 'Tomato-braised beef stew with potatoes, carrots, and bell peppers.',
                'ingredients' => self::lines([
                    '1 kg beef chuck, cubed',
                    '1 cup tomato sauce',
                    '2 tablespoons soy sauce',
                    '2 potatoes, quartered',
                    '2 carrots, cut into chunks',
                    '1 red bell pepper, sliced'
                ]),
                'instructions' => self::lines([
                    'Marinate beef in soy sauce, calamansi, and pepper for 30 minutes.',
                    'Brown beef then simmer with tomato sauce and water until tender.',
                    'Add potatoes and carrots; cook until soft.',
                    'Stir in bell pepper and cook briefly.'
                ]),
            ],
            [
                'name' => 'Pork Binagoongan',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 530,
                'prep_time' => 15,
                'cook_time' => 35,
                'image' => 'https://images.unsplash.com/photo-1525755662778-989d0524087e?auto=format&fit=crop&w=800&q=80',
                'description' => 'Fried pork belly tossed in rich shrimp paste sauce with coconut milk and eggplant.',
                'ingredients' => self::lines([
                    '600 g pork belly, cubed',
                    '1/4 cup bagoong alamang',
                    '1/2 cup coconut milk',
                    '2 eggplants, sliced and fried',
                    '2 tablespoons brown sugar',
                    '2 long chilies, sliced'
                ]),
                'instructions' => self::lines([
                    'Fry pork belly until crisp and set aside.',
                    'Sauté garlic, onions, and bagoong until aromatic.',
                    'Add coconut milk, sugar, and chilies; simmer to thicken.',
                    'Return pork and fried eggplant then toss to coat.'
                ]),
            ],
            [
                'name' => 'Laing with Shrimp',
                'category' => 'lunch',
                'servings' => 4,
                'calories' => 410,
                'prep_time' => 15,
                'cook_time' => 45,
                'image' => 'https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?auto=format&fit=crop&w=800&q=80',
                'description' => 'Dried taro leaves simmered in coconut milk with shrimp and chilies.',
                'ingredients' => self::lines([
                    '4 cups dried taro leaves',
                    '400 ml coconut milk',
                    '200 ml coconut cream',
                    '300 g shrimp, peeled',
                    '4 cloves garlic, minced',
                    '3 bird\'s eye chilies, sliced'
                ]),
                'instructions' => self::lines([
                    'Layer taro leaves in a pot without stirring.',
                    'Pour coconut milk, garlic, ginger, and lemongrass over the leaves.',
                    'Simmer uncovered until liquid is absorbed, then add coconut cream and shrimp.',
                    'Cook on low until taro leaves are tender and flavors meld.'
                ]),
            ],
        ];
    }

    private static function dinnerRecipes(): array
    {
        return [
            [
                'name' => 'Chicken Tinola',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 360,
                'prep_time' => 15,
                'cook_time' => 40,
                'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?auto=format&fit=crop&w=800&q=80',
                'description' => 'Ginger-based chicken soup with green papaya and malunggay leaves.',
                'ingredients' => self::lines([
                    '1 kg chicken pieces',
                    '2 tablespoons ginger, sliced',
                    '4 cloves garlic, minced',
                    '6 cups water or broth',
                    '1 green papaya, wedges',
                    '2 cups malunggay or spinach leaves'
                ]),
                'instructions' => self::lines([
                    'Sauté ginger, garlic, and onions until aromatic.',
                    'Add chicken and cook until lightly browned.',
                    'Pour in water and simmer for 25 minutes.',
                    'Add papaya and malunggay; cook until tender and season with fish sauce.'
                ]),
            ],
            [
                'name' => 'Beef Caldereta',
                'category' => 'dinner',
                'servings' => 6,
                'calories' => 540,
                'prep_time' => 20,
                'cook_time' => 90,
                'image' => 'https://images.unsplash.com/photo-1613470531314-2264ba2899a3?auto=format&fit=crop&w=800&q=80',
                'description' => 'Rich tomato-based beef stew with liver spread, bell peppers, potatoes, and olives.',
                'ingredients' => self::lines([
                    '1.2 kg beef brisket, cubed',
                    '1 cup tomato sauce',
                    '2 tablespoons liver spread',
                    '2 potatoes, cubed',
                    '1 red and 1 green bell pepper, sliced',
                    '1/4 cup green olives'
                ]),
                'instructions' => self::lines([
                    'Brown beef in oil then sauté garlic and onions.',
                    'Add tomato sauce, water, and bay leaves; simmer until beef is tender.',
                    'Stir in liver spread, potatoes, and carrots; cook until vegetables soften.',
                    'Add bell peppers and olives, simmering for 5 minutes more.'
                ]),
            ],
            [
                'name' => 'Inasal na Manok',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 480,
                'prep_time' => 20,
                'cook_time' => 25,
                'image' => 'https://images.unsplash.com/photo-1625937284777-0d016c04dc8a?auto=format&fit=crop&w=800&q=80',
                'description' => 'Bacolod-style grilled chicken marinated in calamansi, lemongrass, and annatto oil.',
                'ingredients' => self::lines([
                    '1 whole chicken, cut into quarters',
                    '1/4 cup calamansi juice',
                    '4 stalks lemongrass, smashed',
                    '4 cloves garlic, minced',
                    '1/4 cup cane vinegar',
                    'Annatto oil for basting'
                ]),
                'instructions' => self::lines([
                    'Marinate chicken overnight in calamansi, vinegar, lemongrass, garlic, sugar, and pepper.',
                    'Grill over hot coals while basting with annatto oil.',
                    'Cook until chicken is charred and juicy.',
                    'Serve with sinamak (spiced vinegar) and rice.'
                ]),
            ],
            [
                'name' => 'Grilled Bangus with Ensaladang Talong',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 420,
                'prep_time' => 20,
                'cook_time' => 18,
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80',
                'description' => 'Butterflied milkfish grilled with garlic butter served with smoky eggplant salad.',
                'ingredients' => self::lines([
                    '2 whole bangus, butterflied',
                    '3 tablespoons calamansi juice',
                    '4 tablespoons garlic butter',
                    '2 eggplants, charred',
                    '2 tomatoes, diced',
                    '1 red onion, minced'
                ]),
                'instructions' => self::lines([
                    'Marinate bangus in calamansi, garlic, and pepper for 30 minutes.',
                    'Grill skin-side down while basting with garlic butter.',
                    'Peel charred eggplants and mix with tomatoes, onions, and vinegar to make ensalada.',
                    'Serve grilled bangus with eggplant salad on the side.'
                ]),
            ],
            [
                'name' => 'Pork Menudo',
                'category' => 'dinner',
                'servings' => 5,
                'calories' => 460,
                'prep_time' => 20,
                'cook_time' => 40,
                'image' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&w=800&q=80',
                'description' => 'Savory pork stew with liver, potatoes, carrots, and bell peppers in tomato sauce.',
                'ingredients' => self::lines([
                    '800 g pork shoulder, diced',
                    '200 g pork liver, diced',
                    '1 cup tomato sauce',
                    '2 potatoes, diced',
                    '1 carrot, diced',
                    '1 red bell pepper, diced'
                ]),
                'instructions' => self::lines([
                    'Sauté garlic and onions then add pork until browned.',
                    'Pour in tomato sauce and water; simmer until pork is tender.',
                    'Add potatoes, carrots, and bell pepper.',
                    'Stir in liver last and cook for 5 minutes more.'
                ]),
            ],
            [
                'name' => 'Sinigang na Hipon',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 320,
                'prep_time' => 15,
                'cook_time' => 25,
                'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?auto=format&fit=crop&w=800&q=80',
                'description' => 'Light tamarind broth loaded with shrimp, sitaw, and kangkong for a refreshing meal.',
                'ingredients' => self::lines([
                    '500 g large shrimp, cleaned',
                    '8 cups water',
                    '1 packet tamarind soup base',
                    '1 cup sitaw (yard-long beans)',
                    '2 tomatoes, wedges',
                    '1 cup kangkong leaves'
                ]),
                'instructions' => self::lines([
                    'Bring water to a boil and add tamarind base with tomatoes and onions.',
                    'Add shrimp and cook until just pink.',
                    'Stir in sitaw and simmer for 3 minutes.',
                    'Add kangkong, season with fish sauce, and serve immediately.'
                ]),
            ],
            [
                'name' => 'Ginataang Sitaw at Kalabasa',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 350,
                'prep_time' => 15,
                'cook_time' => 25,
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e7?auto=format&fit=crop&w=800&q=80',
                'description' => 'Creamy coconut stew of squash, string beans, and tofu with a hint of chili.',
                'ingredients' => self::lines([
                    '2 cups squash cubes',
                    '1 cup sitaw, cut into 2-inch pieces',
                    '300 g tofu, fried and cubed',
                    '400 ml coconut milk',
                    '1 onion, minced',
                    '3 cloves garlic, minced',
                    '2 bird\'s eye chilies'
                ]),
                'instructions' => self::lines([
                    'Sauté garlic and onions, then add squash and cook for 3 minutes.',
                    'Pour in coconut milk and simmer until squash is tender.',
                    'Add sitaw, tofu, and chilies; cook until beans are crisp-tender.',
                    'Season with fish sauce or salt to taste.'
                ]),
            ],
            [
                'name' => 'Crispy Pata with Atchara',
                'category' => 'dinner',
                'servings' => 6,
                'calories' => 640,
                'prep_time' => 25,
                'cook_time' => 120,
                'image' => 'https://images.unsplash.com/photo-1604908177251-c1983f1490b0?auto=format&fit=crop&w=800&q=80',
                'description' => 'Deep-fried pork knuckles with crackling skin served with pickled papaya and dipping sauce.',
                'ingredients' => self::lines([
                    '1 large pork pata (hock)',
                    '1 head garlic, crushed',
                    '2 bay leaves',
                    '1 tablespoon peppercorns',
                    'Oil for deep frying',
                    '1 cup achara and dipping sauce'
                ]),
                'instructions' => self::lines([
                    'Boil pork knuckle with garlic, bay leaves, peppercorns, and salt until tender.',
                    'Drain and chill to dry the skin completely.',
                    'Deep-fry until skin is blistered and crispy.',
                    'Serve with spiced vinegar and achara.'
                ]),
            ],
            [
                'name' => 'Bistek Tagalog',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 430,
                'prep_time' => 15,
                'cook_time' => 30,
                'image' => 'https://images.unsplash.com/photo-1586201375754-14275c72b3ff?auto=format&fit=crop&w=800&q=80',
                'description' => 'Soy-calamansi marinated beef sirloin seared with caramelized onions.',
                'ingredients' => self::lines([
                    '600 g beef sirloin, thinly sliced',
                    '1/4 cup soy sauce',
                    '1/4 cup calamansi juice',
                    '2 large onions, sliced into rings',
                    '4 cloves garlic, minced',
                    '2 tablespoons cooking oil'
                ]),
                'instructions' => self::lines([
                    'Marinate beef in soy sauce, calamansi, garlic, and pepper for 30 minutes.',
                    'Sear beef slices quickly over high heat and set aside.',
                    'Caramelize onions in the same pan then return beef with marinade.',
                    'Simmer until sauce reduces and beef is tender.'
                ]),
            ],
            [
                'name' => 'Garlic Butter Prawns',
                'category' => 'dinner',
                'servings' => 4,
                'calories' => 390,
                'prep_time' => 10,
                'cook_time' => 12,
                'image' => 'https://images.unsplash.com/photo-1575936123452-b67c3203c357?auto=format&fit=crop&w=800&q=80',
                'description' => 'Juicy prawns cooked in butter, garlic, and calamansi with toasted baguette on the side.',
                'ingredients' => self::lines([
                    '700 g large prawns, shells on',
                    '1/2 cup butter',
                    '6 cloves garlic, minced',
                    '2 tablespoons calamansi juice',
                    '1 tablespoon fish sauce',
                    'Chopped parsley and toasted bread'
                ]),
                'instructions' => self::lines([
                    'Melt butter and sauté garlic until fragrant.',
                    'Add prawns and cook until shells turn orange.',
                    'Season with fish sauce, calamansi juice, and pepper.',
                    'Top with parsley and serve with bread or rice.'
                ]),
            ],
        ];
    }

    private static function lines(array $items): string
    {
        return implode(PHP_EOL, $items);
    }
}
