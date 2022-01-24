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

            $temp = $product[$ret[$i][0]][$ret[$i][1]];

            $harga[] = $temp['harga'];
            $tier[] = $temp['value'];
            $total += $harga[$i];
        }

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

        return $ret;
    }
}

class Fitness
{
    function countPrice($population)
    {
        echo '<pre>';

        $ret = [];
        $items = [];
        $prices = [];
        $stars = [];
        for ($i = 0; $i < Params::POPULATION_SIZE; $i++) {
            if ($population[$i][1] < Params::BUDGET) {

                array_push($items, $population[$i][0]);
                array_push($prices, $population[$i][1]);
                array_push($stars, round(array_sum($population[$i][2]) / 5, 1));
            }
            $ret = [
                'items' => $items,
                'prices' => $prices,
                'stars' => $stars,
            ];
        }
        var_dump($ret['prices']);
        $price =  number_format($this->searchBestIndividu($ret['prices']));
        echo $price;
        $key =  array_search($this->searchBestIndividu($ret['prices']), $ret['prices']);
        echo '<br>';
        print_r($ret['items'][$key]);
    }
    function searchBestIndividu($data)
    {
        return max($data);
    }
}



$initialPopulation = new Population;
$population = $initialPopulation->createPopulation($product);

$fitness = new Fitness;
$fitness->countPrice($population);
