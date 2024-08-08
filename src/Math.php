<?php

namespace Smark\Smark;

class Math
{
    public static function compute($method, $nums): float
    {
        if ($method === 'add') {return array_sum($nums);}

        if ($method === 'minus') {
            // Initialize a variable to hold the result
            $result = $nums[0]; // Start with the first number
            // Iterate through the array starting from the second element
            for ($i = 1; $i < count($nums); $i++) {
                $result -= $nums[$i];
            }
            return $result;
        }

        if ($method === 'multiply') {
            // Initialize a variable to hold the result, starting with 1 (since multiplying by 0 would yield 0)
            $result = 1;
            // Iterate through the array and multiply each element with the current result
            foreach ($nums as $number) {
                $result *= $number;
            }
            return $result;
        }

        if ($method === 'divide') {
            // Initialize a variable to hold the result, starting with the first number
            $result = $nums[0];

            // Iterate through the array starting from the second element
            for ($i = 1; $i < count($nums); $i++) {
                // Check if the current number is not zero before dividing
                if ($nums[$i] != 0) {
                    $result /= $nums[$i];
                } else {
                    // Handle division by zero (if necessary for your use case)
                    echo "Error: Division by zero encountered.";
                    break;
                }
            }
            return $result;
        }
        return 0;
    }

    // Identifier

    public static function isEven($num): bool
    {
        return ($num %2 == 0) ? true : false;
    }

    // linear regression

    public static function linearRegression($xValues, $yValues, $result)
    {
        // Calculate number of data points
        $n = count($xValues);

        // Calculate sums
        $sumX = array_sum($xValues);
        $sumY = array_sum($yValues);

        // Calculate sum of squares
        $sumXSquared = 0;
        $sumXY = 0;
        for ($i = 0; $i < $n; $i++) {
            $sumXSquared += ($xValues[$i] * $xValues[$i]);
            $sumXY += ($xValues[$i] * $yValues[$i]);
        }

        // Calculate slope (m)
        $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXSquared - $sumX * $sumX);

        // Calculate y-intercept (b)
        $intercept = ($sumY - $slope * $sumX) / $n;

        if ($result === 'slope') {
            return $slope;
        } elseif ($result === 'intercept') {
            return $intercept;
        } else {
            // Return an associative array with slope and intercept
            return array(
                'slope' => $slope,
                'intercept' => $intercept
            );
        }
    }

    public static function calculateTotalPrice($items, $discountThreshold, $discountRate, $taxRate) {
        $subtotal = 0;
        // Calculate subtotal
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        // Apply discount if subtotal exceeds the threshold
        if ($subtotal > $discountThreshold) {
            $discount = $subtotal * $discountRate;
            $subtotal -= $discount;
        }
        // Apply tax
        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;
        return $total;
    }

    public static function calculateBMI($weight, $height) {
        // Check if weight and height are positive numbers
        if ($weight <= 0 || $height <= 0) {
            return "Weight and height must be positive numbers.";
        }
        // Calculate BMI
        $bmi = $weight / ($height * $height);
        // Return the BMI value rounded to two decimal places
        return round($bmi, 2);
    }

    public static function generateReceiptNumber() {
        $prefix = "REC"; // Prefix for the receipt number
        $date = date("Ymd"); // Current date in YYYYMMDD format
        $uniqueId = uniqid(); // Generate a unique identifier

        // Combine the prefix, date, and unique identifier to form the receipt number
        $receiptNumber = $prefix . $date . strtoupper($uniqueId);

        return $receiptNumber; // REC20240731A1B2C3D4E5F6
    }

    public static function factorial($number) {
        if ($number < 2) {
            return 1;
        } else {
            return ($number * self::factorial($number - 1));
        }
    }

    public static function fibonacci($n) {
        if ($n <= 1) return $n;
        return self::fibonacci($n - 1) + self::fibonacci($n - 2);
    }

    public static function calculateQuadraticRoots($a, $b, $c) {
        // Check if 'a' is not zero
        if ($a == 0) {
            return "Coefficient 'a' cannot be zero in a quadratic equation.";
        }
    
        // Calculate the discriminant
        $discriminant = ($b * $b) - (4 * $a * $c);
    
        // Check if the discriminant is positive, zero, or negative
        if ($discriminant > 0) {
            // Two real and distinct roots
            $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
            $root2 = (-$b - sqrt($discriminant)) / (2 * $a);
            return ["root1" => $root1, "root2" => $root2];
        } elseif ($discriminant == 0) {
            // One real root (double root)
            $root = -$b / (2 * $a);
            return ["root" => $root];
        } else {
            // Complex roots
            $realPart = -$b / (2 * $a);
            $imaginaryPart = sqrt(-$discriminant) / (2 * $a);
            return [
                "root1" => "$realPart + {$imaginaryPart}i",
                "root2" => "$realPart - {$imaginaryPart}i"
            ];
        }
    }

    public static function gcd($a, $b) {
        // Ensure both inputs are non-negative integers
        if ($a < 0 || $b < 0) {
            return "Invalid input. Please enter non-negative integers.";
        }
    
        // Apply the Euclidean algorithm
        while ($b !== 0) {
            $temp = $b;
            $b = $a % $b;  // Calculate the remainder
            $a = $temp;     // Update 'a' to be the previous 'b'
        }
    
        return $a; // 'a' now contains the GCD
    }

    public static function matrixMultiply($matrixA, $matrixB) {
        // Get the dimensions of the matrices
        $rowsA = count($matrixA);
        $colsA = count($matrixA[0]);
        $rowsB = count($matrixB);
        $colsB = count($matrixB[0]);
    
        // Check if the matrices can be multiplied
        if ($colsA !== $rowsB) {
            return "Matrix multiplication not possible: Number of columns in Matrix A must equal the number of rows in Matrix B.";
        }
    
        // Initialize the resulting matrix with zeros
        $result = array_fill(0, $rowsA, array_fill(0, $colsB, 0));
    
        // Perform matrix multiplication
        for ($i = 0; $i < $rowsA; $i++) {
            for ($j = 0; $j < $colsB; $j++) {
                for ($k = 0; $k < $colsA; $k++) {
                    $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
                }
            }
        }
    
        return $result;
    }

    // Function to perform Gaussian Elimination and solve a system of linear equations
    public static function gaussianElimination($matrix) {
        $n = count($matrix); // Number of equations

        // Forward elimination
        for ($i = 0; $i < $n; $i++) {
            // Search for maximum in this column
            $maxRow = $i;
            for ($k = $i + 1; $k < $n; $k++) {
                if (abs($matrix[$k][$i]) > abs($matrix[$maxRow][$i])) {
                    $maxRow = $k;
                }
            }

            // Swap maximum row with current row (pivot)
            $temp = $matrix[$maxRow];
            $matrix[$maxRow] = $matrix[$i];
            $matrix[$i] = $temp;

            // Make the elements below the pivot equal to zero
            for ($k = $i + 1; $k < $n; $k++) {
                $factor = $matrix[$k][$i] / $matrix[$i][$i];
                for ($j = $i; $j < $n + 1; $j++) {
                    $matrix[$k][$j] -= $factor * $matrix[$i][$j];
                }
            }
        }

        // Back substitution
        $solutions = array_fill(0, $n, 0);
        for ($i = $n - 1; $i >= 0; $i--) {
            $solutions[$i] = $matrix[$i][$n] / $matrix[$i][$i];
            for ($k = $i - 1; $k >= 0; $k--) {
                $matrix[$k][$n] -= $matrix[$k][$i] * $solutions[$i];
            }
        }

        return $solutions;
    }
}
