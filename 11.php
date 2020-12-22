<?php
/**
 *
 *
 * 11. 盛最多水的容器
给你 n 个非负整数 a1，a2，...，an，每个数代表坐标中的一个点 (i, ai) 。在坐标内画 n 条垂直线，垂直线 i 的两个端点分别为 (i, ai) 和 (i, 0) 。找出其中的两条线，使得它们与 x 轴共同构成的容器可以容纳最多的水。

说明：你不能倾斜容器。


 */

class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height) {
        $p1 = 0;
        $p2 = count($height);
        $area = 0;
        while ($p1 < $p2) {
            $tmp = min($height[$p1], $height[$p2]) * ($p2 - $p1);
            //每次移动小边
            if ($height[$p1] < $height[$p2]) {
                $p1++;
            } else {
                $p2--;
            }
            $area = max($tmp, $area);
        }
        return $area;
    }
}