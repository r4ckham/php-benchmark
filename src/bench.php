<?php

class A {
	public ?string $test;
}

class B {
	public ?string $test = null;
}


function issetTest($limit)
{
	$start = microtime(true);
	for ($i = 0; $i < $limit ; $i++){
		$t = new A();
		
		isset($t->test);
		unset($t);
	}
	
	unset($i);
	return microtime(true) - $start;
}

function nullTest($limit)
{
	$start = microtime(true);
	for ($i = 0; $i < $limit ; $i++){
		$t = new B();
		
		$t->test;
		unset($t);
	}
	
	unset($i);
	return microtime(true) - $start;
	
}

$retry = 1000;
$limit = 100000;

$issetTimes = [];
$nullTimes = [];

$start = microtime(true);
for ($i = 0; $i < $retry ; $i++){
    $nullTimes[] = nullTest($limit);
	$issetTimes[] = issetTest($limit);
}

echo "total time for isset is " . array_sum($issetTimes) . " seconds \n";
echo "max time for isset is : " . max($issetTimes) . " seconds \n";
echo "min time for isset is : " . min($issetTimes) . " seconds \n";
echo "avg time for isset is : " . array_sum($issetTimes) / count($issetTimes) . " seconds \n";
echo "----------------------------------------- \n";
echo "total time for null is " . array_sum($nullTimes) . " seconds \n";
echo "max time for null is : " . max($nullTimes) . " seconds \n";
echo "min time for null is : " . min($nullTimes) . " seconds \n";
echo "avg time for null is : " . array_sum($nullTimes) / count($nullTimes) . " seconds \n";
echo "----------------------------------------- \n";
echo "Benchmark done in " . microtime(true) - $start . " seconds \n" ;


