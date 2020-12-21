<?php


class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n) {
        //双指针移动，从大到小
        $p1 =  $m - 1;
        $p2 = $n - 1;
        $p = $m + $n -1;
        while($p1 >=0 && $p2 >= 0) {
            if ($nums1[$p1] > $nums2[$p2]) {
                $nums1[$p] = $nums1[$p1];
                $p1--;
            } else {
                $nums1[$p] = $nums2[$p2];
                $p2--;
            }
            $p--;
        }
        //如果p2先小于0 p1和p指针无需变动，如果p1小于0，将p2剩余的元素从右到左添加至nums1
        if ($p1 < 0) {
            while ($p >= 0) {
                $nums1[$p] = $nums2[$p2];
                $p2--;
                $p--;
            }
        }
    }
}