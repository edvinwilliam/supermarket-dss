<?php
error_reporting(E_ALL);
// My dataset describes cities around the world where I might consider living.
// Each sample (city) consists of 3 features:
//  * Feature 1: average low winter temperature in the city
//  * Feature 2: city population, in millions
//  * Feature 3: does the city have an airport I can fly to from USA directly?
//
// The labels (categories) are 1 (yes) and 0 (no).
// All the data is floating-point.

class Logistic
{
	/**
	 * @var matrix $training
	 */
	private $training;
	/**
	 * @var matrix $labels
	 */
	private $labels;
		
	private $NUM_SAMPLES;
		
	private $NUM_FEATURES;
	
	private $learning_rate = 0.05;
	
	private $steps = 20000; // number of steps to take for gradient descent
	
	private $weights = [];

    private $scaling;
	
	
	public function compute($training, $labels){
		
		$this->training = $training;
		
		$this->labels = $labels;

		$this->NUM_SAMPLES = sizeof($training);
		$this->NUM_FEATURES = sizeof($training[0]);
		//NUM_FEATURES = sizeof($training[0]);
		// Initialize the weights array to random starting values.
		// There are always 1+NUM_FEATURES weights, because the first weight
		// does not correspond to a feature value, since:
		//   weights * features = weight0 + weight1 * feature1 + weight2 * feature2 + ...
		for ($j=0; $j < $this->NUM_FEATURES+1; $j++)
			$this->weights[$j] = mt_rand()/mt_getrandmax()*5.0;
		// Calculate the data we need for feature scaling (mean/variance)
		$this->scaling = $this->calc_feature_scaling($training);
		$temp = array(); // temp array to hold updates for weights during the loop
		for ($n = 0; $n < $this->steps; $n++) {
			// For each weight, perform the gradient descent step and save the result to temp
			for ($j = 0; $j < $this->NUM_FEATURES+1; $j++) {
				$sum_m = 0.0;
				for ($i = 0; $i < $this->NUM_SAMPLES; $i++) {
					$scaled_data = $this->scale($training[$i], $this->scaling);
					$h = $this->hypothesis($scaled_data, $this->weights);
					// The first weight has a dummy 1 "feature" value
					$part = ($h - $labels[$i]) * ($j==0 ? 1.0 : $scaled_data[$j-1]);
					$sum_m = $sum_m + $part;
				}
				$temp[$j] = $this->weights[$j] - $this->learning_rate * $sum_m/$this->NUM_SAMPLES;
			}
			$this->weights = $temp;
		}
		// echo "Executed $n steps\n";
		// echo "Weights: ", $this->vector_to_str($this->weights), "\n";
		// Validate the results
		// print "\nValidating training\n";
		// $correct = 0;
		// for ($i = 0; $i < $this->NUM_SAMPLES; $i++) {
			// $predict = $this->predict($this->scale($training[$i], $this->scaling), $this->weights);
			// printf("Input: %-16s actual: %d, predict: %d", $this->vector_to_str($training[$i]), $labels[$i], $predict);
			// if ($labels[$i] != $predict)
				// print " - miss";
			// print "\n";
			// if ($predict == $labels[$i])
				// $correct++;
		// }
		// printf("Correctness = %.0f%%\n", $correct/$this->NUM_SAMPLES*100.0);
	}
	private function hypothesis($x)
	{
		$score = $this->weights[0]; // free weight
		$k = sizeof($x);
		// Calculate dot product
		for ($i = 0; $i < $k; $i++)
			$score += $this->weights[$i+1] * $x[$i];
		// Run through the sigmoid (logistic) function
		return 1.0/(1.0 + exp(-$score));
	}
	public function predict($input)
	{
		$output = $this->hypothesis($input, $this->weights);
		// Threshold on 0.5
		if ($output >= 0.50)
			$predict = 1;
		else
			$predict = 0;
		return $predict;
	}
	function scale($input, $scaling)
	{
		foreach ($input as $f => &$value) {
			$value = ($value - $scaling['mean'][$f]) /
						$scaling['variance'][$f];
		}
		return $input;
	}
	function calc_feature_scaling($data)
	{
		$mins = array_fill(0, $this->NUM_FEATURES, INF);
		$maxs = array_fill(0, $this->NUM_FEATURES, -INF);
		$sums = array_fill(0, $this->NUM_FEATURES, 0);
		
		$scaling = array('mean' => array(),
						 'variance' => array());
		$N = sizeof($data);
		foreach ($data as $i => $row) {
			foreach ($row as $f => $value) {
				if ($value > $maxs[$f])
					$maxs[$f] = $value;
				if ($value < $mins[$f])
					$mins[$f] = $value;
				$sums[$f] += $value;
			}
		}
		for ($f = 0; $f < $this->NUM_FEATURES; $f++) {
			$scaling['mean'][$f] = $sums[$f] / $N;
			$scaling['variance'][$f] = $maxs[$f] - $mins[$f];
			if ($scaling['variance'][$f] == 0)
				throw new Exception("Feature #$f has the same value in all the samples, invalid data");
		}
		return $scaling;
	}
	function vector_to_str($x)
	{
		return '['.implode(", ", $x).']';
	}
}
?>