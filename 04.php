<?php

/*
给定两个大小为 m 和 n 的正序（从小到大）数组 nums1 和 nums2。

请你找出这两个正序数组的中位数，并且要求算法的时间复杂度为 O(log(m + n))。

你可以假设 nums1 和 nums2 不会同时为空。



示例 1:

nums1 = [1, 3]
nums2 = [2]

则中位数是 2.0
示例 2:

nums1 = [1, 2]
nums2 = [3, 4]

则中位数是 (2 + 3)/2 = 2.5*/

/**
 * @param Integer[] $nums1
 * @param Integer[] $nums2
 * @return Float
 */
function findMedianSortedArrays($nums1, $nums2)
{
    $m = count($nums1);
    $n = count($nums2);

    if ($m > $n) {
        return findMedianSortedArrays($nums2, $nums1);
    }

    $imin = 0;
    $imax = $m;
    $half_len = (int)(($m + $n + 1) / 2);

    while ($imin <= $imax) {
        $i = (int)(($imin + $imax) / 2);
        $j = $half_len - $i;
        if ($i < $m and $nums2[$j - 1] > $nums1[$i]) {
            # i is too small, must increase it
            $imin = $i + 1;
        } elseif ($i > 0 and $nums1[$i - 1] > $nums2[$j]) {
            # i is too big, must decrease it
            $imax = $i - 1;
        } else {
            if ($i == 0) {
                $max_of_left = $nums2[$j - 1];
            } elseif ($j == 0) {
                $max_of_left = $nums1[$i - 1];
            } else {
                $max_of_left = ($nums1[$i - 1] > $nums2[$j - 1]) ? $nums1[$i - 1] : $nums2[$j - 1];
            }

            if (($m + $n) % 2 === 1) {
                return $max_of_left;
            }

            if ($m = $i) {
                $min_of_right = $nums2[$j];
            } elseif ($j == $n) {
                $min_of_right = $nums1[$i];
            } else {
                $min_of_right = ($nums1[$i] < $nums2[$j]) ? $nums1[$i] : $nums2[$j];
            }
            return ($min_of_right + $max_of_left) / 2.0;
        }

    }


}

//$nums1 = [2,2]; $nums2 = [3,4,5];//3
//$nums1 = [1,3]; $nums2 = [2];//2
//$nums1 = [2,2]; $nums2 = [2,2,2,2,2];//2
//$nums1 = [2,3]; $nums2 = [3,4,5,6,7];//4
$nums1 = [2, 3];
$nums2 = [4, 5, 6, 7];//4.5
$a = findMedianSortedArrays($nums1, $nums2);
var_dump($a);
//1592755200  1593360000
//1593360000  1593964800
//1593964800  1594569600
//1594569600  1595174400
