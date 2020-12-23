<?php

/**
 * 给定一个字符串，找到它的第一个不重复的字符，并返回它的索引。如果不存在，则返回 -1。

 

示例：

s = "leetcode"
返回 0

s = "loveleetcode"
返回 2
 

提示：你可以假定该字符串只包含小写字母。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/first-unique-character-in-a-string
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function firstUniqChar($s) {
        $len = strlen($s);
        $ch = [];
        for ($i = 0; $i < 26; $i++) {
            $ch[$i] = -1;
        }

        for ($i = 0; $i < $len; $i++) {
            $j = ord($s[$i]) - 97;

            if ($ch[$j] == -1) {
                $ch[$j] = $i;
            } else {
                $ch[$j] = -2;
            }
        }

        $isMin = 0;
        $min = $len - 1;

        foreach ($ch as $key=>$val) {
            //重复的-2和未出现的字符-1过滤掉，val最小的就是第一个不重复字符的索引
            if ($val >= 0 ) {
                $isMin = 1;
                $min = $val < $min ? $val : $min;
            }
        }
        return $isMin ? $min : -1;
    }
}
