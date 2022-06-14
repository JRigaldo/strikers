<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

$pdo = new PDO('mysql:dbname=strikerblog;host=127.0.0.1', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

//var_dump($faker->sentence($nbWords = 3, $variableNbWords = true));

/** 1ERE LIGNE IGNOR LES CLEF ETRANGERE (CAR LE CODE PASSE PAS SINON) **/
$pdo->exec('SET FOREIGN_KEY_CHECKS=0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
/** REMET LA CLEF ETRANGERE A 1 **/
$pdo->exec('SET FOREIGN_KEY_CHECKS=1');

// TABLEAUX QUI VONT LISTER L'ENSEMBLE DES IDS
$posts = [];
$categories = [];

for ($i = 0; $i < 50; $i++){
    $pdo->exec("INSERT INTO post SET name='{$faker->sentence()}', slug='{$faker->slug}', created_at='{$faker->date} {$faker->time}', content='{$faker->text()}'");
    $posts[] = $pdo->lastInsertId();
}

for ($i = 0; $i < 5; $i++){
    $pdo->exec("INSERT INTO category SET name='{$faker->sentence(3)}', slug='{$faker->slug}'");
    $categories[] = $pdo->lastInsertId();
}

foreach ($posts as $post){
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach ($randomCategories as $category){
        $pdo->exec("INSERT INTO post_category SET post_id=$post, category_id=$category");
    }
}

$password = password_hash('admin', PASSWORD_BCRYPT);

$pdo->exec("INSERT INTO user SET username='asmin', password='$password'");



















