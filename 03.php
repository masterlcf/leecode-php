<?php

/*给定一个字符串，请你找出其中不含有重复字符的 最长子串 的长度。

示例 1:

输入: "abcabcbb"
输出: 3
解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
示例 2:

输入: "bbbbb"
输出: 1
解释: 因为无重复字符的最长子串是 "b"，所以其长度为 1。
示例 3:

输入: "pwwkew"
输出: 3
解释: 因为无重复字符的最长子串是 "wke"，所以其长度为 3。
     请注意，你的答案必须是 子串 的长度，"pwke" 是一个子序列，不是子串。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/longest-substring-without-repeating-characters*/

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        if (strlen($s) <= 1) {
            return strlen($s);
        }
        $strArr = str_split($s);

        $start = 0;//指向头部
        $end = 0;//指向尾部
        $ans = 0;

        $strlen = '';
        foreach ($strArr as $k => $v) {
            $index = strrpos(substr($strlen, $start, $end - $start), $v);
            if ($index !== false) {
                //字符存在
                $start = $index + 1 + $start;
            }
            $end++;
            $strlen .= $v;
            $ans = max($ans, $end - $start);
        }
        return $ans;
    }
}
