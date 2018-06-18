
<?php
    /*
    $prices = [
        [
            'price' => 21999,
            'shop_name' => 'Shop 1',
            'shop_link' => 'http://'
        ], 
        [
            'price' => 21550,
            'shop_name' => 'Shop 2',
            'shop_link' => 'http://'
        ], 
        [
            'price' => 21950,
            'shop_name' => 'Shop 2',
            'shop_link' => 'http://'
        ], 
        [
            'price' => 21350,
            'shop_name' => 'Shop 2',
            'shop_link' => 'http://'
        ], 
        [
            'price' => 21050,
            'shop_name' => 'Shop 2',
            'shop_link' => 'http://'
        ]
    ];

    $elements​ = $prices;

    function ​ShellSort​($elements​) {
        $k​ = 0;                            // O(1)
        $length​​​ = count($elements​);         // O(1)
        $gap​[0] = (int)($length​​​ / 2);       // O(1)
        while ( $gap​[$k​] > 1)                                                     // O(N)
        {
            $k​++;                                                                  // +
            $gap​[$k​] = (int)($gap​[$k​ - 1] / 2);
        }
        for ($i = 0; $i <= $k; $i++)                                                // O(N)
        {
            $step​​​ = $gap​[$ki];                                                      // *
            for ($j = $step​​​; $j < $length​​​; $j++)                                  // O(N)
            { 
                $temp = $elements​[$j];                                                // *
                $p = $j - $step;
                while ( $p >= 0 && $temp['price'] < $elements​[$p]['price'])        // O(N)
                {
                    $elements​[$p + $step​​​] = $elements​[$p];
                    $p = $p - $step​​​;
                }
                $elements​[$p + $step​​​] = $temp;
            }
        }
        return $elements​;                                                          // O(1)
    }

    // O(1) + O(1) + O(1) + O(N) + O(N * N * N) +O(1)
    // O(4) + O(N) + O(N^3)
    // O(4 + N + N^3)
    // O(N^3)
    */

    $array = [3,1,21, 23, 24, 40, 75, 74, 76, 78, 77, 900, 2100, 3000, 2200, 2400, 2500, 4,6,7,10, 11, 41, 50, 65, 86, 98, 101, 190, 5, 1100, 1200, 2, 2300, 102, 104, 103, 5000, 4999];

    $count_array = count($array);

    $buff = [];
    $left = 0;

    $right = $count_array - 1;
   
    function MergeSort($array, $buff, $left, $right)
    {

        if ($left == $right) 
        { 
            $buff[$left] = $array[$left];
            return $buff;
        }

        $middle = round(($left + $right) / 2) - 1;

        $l_buff = MergeSort($array, $buff, $left, $middle);
        $r_buff = MergeSort($array, $buff, $middle + 1, $right);

        $target = ($l_buff == $array) ? $buff : $array;

        $l_cur = $left;
        $r_cur = $middle + 1;

        for ($i = $left ; $i <= $right; $i++) 
        { 
            if ($l_cur <= $middle && $r_cur <= $right)
            {
                if ($l_buff[$l_cur] < $r_buff[$r_cur])
                {
                    $target[$i] = $l_buff[$l_cur];
                    $l_cur++;
                }
                else
                {
                    $target[$i] = $r_buff[$r_cur];
                    $r_cur++;
                }
            }
            else if ($l_cur <= $middle)
            {
                $target[$i] = $l_buff[$l_cur];
                $l_cur++;
            }
            else
            {
                $target[$i] = $r_buff[$r_cur];
                $r_cur++;
            }
        }
        return $target;
    }

    echo "<pre>";
    var_dump(MergeSort($array, $buff, $left, $right));
    echo "</pre>";


