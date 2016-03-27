<?php
/**
 * https://github.com/SevenEcks/php-quicksort
 * Brendan Butts / bbutts@stormcode.net
 * March, 2016
 * 
 * This code will execute a quicksort algorithm using PHP.  It includes a randomly generated test case.
 * Feel free to fork this code for your own usage.
 */

/**
 * Use recursion to quicksort an unsorted array of N length
 * @param unsorted $array
 * @return sorted $array
 */
function quicksort($array) {
    //get the length of the array and store it since we need to use it multiple times
    $arr_length = count($array);
    /*
     * if the array is length of 0 or 1 it is already sorted so we return
     * it should only ever be 0 on the first call, we should never have a
     * recursive call with 0 items
    */
    if ($arr_length < 2) {
        return $array;
    }
    //select the pivot, could be first index, last index or a random index.
    //it's argued that a random index can reduce computational complexity.
    $pivot = $array[0];
    debug('Pivot', $pivot);
    $left = array();
    $right = array();
    //loop over all the values in our list, excluding the pivot
    for ($i = 1; $i < $arr_length; $i++) {
        //if the value at index $i is less than the pivot, put in left list
        if ($array[$i] < $pivot) {
            $left[] = $array[$i];
        }
        else {
            //if the value is greater than or equal to the pivot, put in the right list
            $right[] = $array[$i];
        }
    }
    debug('Left', $left);
    debug('Right', $right);
    //return a merged array of sorted elements built recursively
    return array_merge(quicksort($left), array($pivot), quicksort($right));
}

/**
 * Debug function which will print out what is happening at
 * various stages of the quicksort, so it can be better understood
 * @param name $name
 * @param data $data
 * @returns null
 */
function debug($name, $data) {
    //check if debugging is disabled
    if (!DEBUG) {
        return;
    }
    echo "---------------------------------------------<br />";
    echo $name . ": </br>";
    print_r($data);
    echo "<br />---------------------------------------------<br />";
}
//define a debug value that can be turned off later
CONST DEBUG = true;
//define the start of the range for our test numbers
CONST NUM_START = 1;
//define the end (inclusive) range of our test numbers
CONST NUM_END = 40;
//generate an ordered array of numbers from 1 to 40 inclusive.
$numbers = range(NUM_START, NUM_END);
//keep the sorted list so we can prove our success later
$numbers_proof = $numbers;
//shuffle the array by reference to randomize the order
shuffle($numbers);

$sorted = quicksort($numbers);
if ($sorted == $numbers_proof) {
    debug('SORTED', $sorted);
}
else {
    debug('SORT-FAILED', $sorted);
}
