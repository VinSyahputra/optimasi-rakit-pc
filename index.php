<?php
require 'product.php';
// echo '<pre>';
// print_r($product['vga']);

class Params
{

    const POPULATION_SIZE = 5;
    const BUDGET = 17000000; //17.000.000
}

class Individu
{
    function createIndividu($product)
    {
        $total = 0;
        $products = ['processor', 'mainboard', 'memory', 'vga', 'harddisk'];
        for ($i = 0; $i < count($product); $i++) {
            $ret[] = [$products[$i], rand(0, 4)];
            // echo '<pre>';
            // print_r($ret[$i][0]);
            // echo '<br>';
            // print_r($product[$ret[$i][0]][$ret[$i][1]]);
            $temp = $product[$ret[$i][0]][$ret[$i][1]];

            $harga[] = $temp['harga'];
            $tier[] = $temp['value'];
            $total += $harga[$i];
        }
        // print_r($ret[2][1]);
        //$product[namaAssosiatif][productTerpilih]
        // print_r($product[$ret[2][0]][$ret[0][1]]);
        // print_r($ret);
        // echo 'harga :' . $total;
        return [$ret, $total, $tier];
    }
}

class Population
{
    function createPopulation($product)
    {
        $individu = new Individu;
        for ($i = 0; $i < Params::POPULATION_SIZE; $i++) {
            $ret[] = $individu->createIndividu($product);
        }
        //[individu][product]
        // print_r($ret[1][2]);
        return $ret;
        // print_r($ret);
    }
}

class Fitness
{
    function countPrice($population)
    {
        echo '<pre>';
        // print_r($population[1][2]);

        for ($i = 0; $i < Params::POPULATION_SIZE; $i++) {
            if ($population[$i][1] < Params::BUDGET) {

                print_r($population[$i][0]);
                echo 'Total Harga Rakit PC : Rp. ';
                print_r(number_format($population[$i][1]));
                echo '<br>';
                echo 'Star : ' . round(array_sum($population[$i][2]) / 5, 1);
                echo '<br>';
                echo '<br>';
                echo '<br>';
            }
        }
    }
}

// $individu = new Individu;
// $individu->createIndividu($product);

$initialPopulation = new Population;
$population = $initialPopulation->createPopulation($product);

$fitness = new Fitness;
$fitness->countPrice($population);
